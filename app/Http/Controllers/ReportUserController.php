<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\ReportImage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
class ReportUserController extends Controller
{
    //


    public function detail($id)
    {
        $user = Auth::user();
        $data1 = collect(Cache::get("reports-requests-{$user->username}"))->firstWhere('id', $id);

        return view('User.report.detailreport',[
                'iconname' => 'Detail Pengaduan',
                'hasilreq1' => $data1,
            ]);
    }

    public function create(Request $request)
    {

        try {

            $request->validate([
                'room_number' => 'required|string',
                'kategori' => 'required|string',
                'keterangan' => 'required|string',
               // 'images' => 'required|array',
               // 'images.*' => 'file|mimes:jpeg,png,jpg,gif|max:2048', // Validasi setiap file
               //'images.*' => 'file|mimetypes:image/jpeg,image/png,image/gif|max:2048',
               'images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ], [
                'images.*.file' => 'Terdapat file yang tidak valid.', // Pesan jika file tidak valid
                'images.*.mimes' => 'format: JPEG, PNG, JPG, GIF dan WEBP yang diizinkan.', // Pesan jika tipe file tidak valid
                'images.*.max' => 'Ukuran file maksimal adalah 10MB.', // Pesan jika ukuran file terlalu besar
            ]);
 
            $user = Auth::user();
  
            $newComplaint = Report::create([
                'username' => $user->username,
                'room_number' => $request->room_number,
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan,
                //'image' => $request->hasFile('image') ? $request->file('image')->store('complaints') : null,
                'status' => 'pending',
            ]);

            if ($request->file('images')) {
                $filePaths = []; // Array untuk menyimpan path file
                foreach ($request->file('images') as $img) {
                   
                    // $file = Image::make($img)
                    // ->encode('jpg', 80) // Konversi ke JPG dengan kualitas 80%
                    // ->resize(800, null, function ($constraint) {
                    //     $constraint->aspectRatio(); // Pertahankan rasio
                    //     $constraint->upsize(); // Cegah pembesaran gambar
                    // });
                    $image = new \Imagick($img->getPathname()); // Gunakan Imagick langsung
                    $image->setImageFormat('jpg'); // Konversi ke JPG
                    $image->setImageCompressionQuality(80); // Kompresi kualitas 80%
                    $image->stripImage(); // Hapus metadata untuk ukuran lebih kecil
                    // Resize gambar dengan mempertahankan aspect ratio
                    $width = 800;
                    $image->resizeImage($width, 0, \Imagick::FILTER_LANCZOS, 1);
                    
                    $fileName = time() . '_' . uniqid() . '.jpg';
                    $directoryPath = storage_path('app/public/img');
                    // Buat folder jika belum ada
                    if (!file_exists($directoryPath)) {
                        mkdir($directoryPath, 0755, true);
                    }
                     // Simpan file ke direktori
                    $filePath = $directoryPath . '/' . $fileName;
                    $image->writeImage($filePath); // Simpan gambar ke path

                    $filePaths[] = [
                        'id_report' => $newComplaint->id,
                        'username' => $user->username,
                        'room_number' => $request->room_number,
                        //'image' => 'img/' . $fileName,
                        'image' => $fileName,
                        //'image' => $file->store('uploads', 'public'),
                        'created_at' => now(), // Tambahkan timestamp
                        'updated_at' => now(),
                    ];
                    $image->clear();
                    $image->destroy(); // Hapus dari memori untuk optimasi
                } 
                ReportImage::insert($filePaths);
                return redirect()->back()->with([
                    'success' => 'Complaint created successfully!',
                    'data' => $newComplaint,
                    'images' => $filePaths,
                ]);
    
            }

                return redirect()->back()->with([
                    'success' => "Complaint created successfully! No images uploaded",
                    'data' => $newComplaint,
                ]);

        } catch (\Exception $e) {

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }
    public function register(Request $request)
    {

        // Validasi data input
        $validData = $request->validate([
            //'username' => 'required|string|max:255',
            'id_card' => 'required|string|max:5',
            'room_number' => 'required|string|max:10',
            'password' => 'required|string|min:8',
        ], [
            'passlama.required' => 'Password Lama wajib diisi.',
            'passbaru.required' => 'Password Baru wajib diisi.',
            'passbaru.min' => 'Password Baru harus minimal 8 karakter.',
            'repass.required' => 'Konfirmasi Password Baru wajib diisi.',
            'repass.same' => 'Konfirmasi Password Baru harus sama dengan Password Baru.',
        ]); 
        // Kirim request POST ke API
        $response = Http::post(env('API_BASE_URL') .'/register', $validData);
        // dd($response);
        // Jika request berhasil
        if ($response->successful()) {
            // Ambil data dari respons AP
            $data = $response->json()['data'];
    
            // Simpan data ke dalam session
            session([
                'id_card' => $data['id_card'],
                'username' => $data['username'],
                'role' => $data['role'] ?? 'user', // Default role jika tidak ada
                'api_token' => $data['token'],
            ]);
          
            return redirect()->route('dashboarduser')->with('success', 'Register berhasil! Token berhasil disimpan.');
        }
         // Jika request gagal
        $errorMessage = $response->json()['message'] ?? 'Terjadi kesalahan saat mendaftar.';
        $errors = $response->json()['errors'] ?? [];
        return back()->with('error', $errorMessage)->withErrors($errors)->withInput();
    }


}
