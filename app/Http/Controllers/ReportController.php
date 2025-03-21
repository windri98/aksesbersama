<?php

namespace App\Http\Controllers;
use App\Models\Complaintkamar;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;
use App\Models\reportImage;
use Illuminate\Support\Facades\Auth;
use App\Exports\keluhankamar;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //
    public function keluhanpengaduan(Request $request)
    {
  
        $perPage = (int) $request->input('per_page', 10);
        $requests = Report::whereIn('status',['Pending', 'Sedang Diproses'])
        ->with(['reportImages'])
        ->paginate($perPage);

                if (!empty($requests)) {
                    return view('Admin.dashboard.main.keluhan_pengaduan',[
                        'hasilreq1' => $requests->items(), 
                        'iconname' => 'Keluhan & Pengaduan',
                        'pagination' => [
                            'current_page' => $requests->currentPage(),
                            'last_page' => $requests->lastPage(),
                            'per_page' => $requests->perPage(),
                            'total' => $requests->total(),
                        ]
                    ]);
                }
        return view('Admin.dashboard.main.keluhan_pengaduan', [
            'iconname' => 'Keluhan & Pengaduan',
            'hasilreq1' => [],  
        ])->with('error', "Gagal memuat data.");

    }

        public function update(Request $request, $id)
    {
        
        $request->validate([
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);
        $complaint = Report::findOrFail($id);
        $complaint->update([
            'status' => $request->status,
            'description' => $request->description,
        ]);

    try {
        $Complaintkamar = Report::where('id', $request['noId'])->first();
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $Complaintkamar->status = 'Sedang Diproses';
        $Complaintkamar->save();
        return redirect()->back()->with('success','Report progress successfully');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function export(Request $request, $id)
    {

        $data = Report::with('reportImages')->find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    
        $filename = 'Report_Id_' . $id . '_User_' . ($data->username ?? 'No_User') . '.xlsx';
        $path = "exports/{$filename}";
        Excel::store(new keluhankamar($data->toArray(), $id), $path, 'local'); 
    
        if (Storage::exists($path)) {
            return response()->download(storage_path("app/{$path}"))->deleteFileAfterSend(true);
        }
        else {
            return redirect()->back()->with('error', 'Gagal mengunduh file Excel.');
        }

    }

    public function donecomplaint(Request $request, $id)
    {
        try {
            $Complaintkamar = Report::findOrFail($id);
    
            if (Auth::user()->role !== 'admin') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $Complaintkamar->status = 'Selesai';
            $Complaintkamar->save();
           
            return redirect()->back()->with(['success', 'Metting Done Complaint successfully.', 'data' => $Complaintkamar]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Meeting request not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $apiToken = session('api_token');
            if (!$apiToken) {
                return redirect()->back()->with('error', 'Token tidak ditemukan. Silakan login ulang.');
            } 

            $request->validate([
                'room_number' => 'required|string',
                'kategori' => 'required|string',
                'keterangan' => 'required|string',
               // 'images' => 'required|array',
                'images.*' => 'file|mimes:jpeg,png,jpg,gif|max:2048', // Validasi setiap file
            ]);

            $httpRequest = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
            ]);
            if ($request->file('images')) {
         
            $httpRequest = $httpRequest->attach(
                'room_number',
                $request->room_number
            )->attach(
                'kategori',
                $request->kategori
            )->attach(
                'keterangan',
                $request->keterangan
            );

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $httpRequest = $httpRequest->attach(
                        'images[]', // Gunakan key array "images[]"
                        fopen($file->getPathname(), 'r'),
                        $file->getClientOriginalName()
                    );
                }
            }
            $response = $httpRequest->post(config('services.api_base_url') . '/complaints-requests');
        } else {

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
            ])->post(config('services.api_base_url') . '/complaints-requests', [
                'room_number' => $request->room_number,
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan, // Tambahkan konfirmasi
            ]);
        }
            if ($response->successful()) {
                $success = $response->json();
                return redirect()->back()->with('success', $success['message']);
            }
            // Tangani error dari API
            $error = json_decode($response->body(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $error = ['message' => 'Response tidak valid.'];
            }
            return back()->with('errorlogin', 'Data failed: ' . ($error['message'] ?? 'Unknown error'));
        } catch (\Exception $e) {
            // Tangani error jika API tidak bisa diakses atau error lainnya
            return back()->with('errorlogin', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }
  
    public function register(Request $request)
    {
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

        $response = Http::post('https://int-mnr-21.bostoni.pro/api/register', $validData);

        if ($response->successful()) {
            $data = $response->json()['data'];
            session([
                'id_card' => $data['id_card'],
                'username' => $data['username'],
                'role' => $data['role'] ?? 'user', 
                'api_token' => $data['token'],
            ]);
          
            return redirect()->route('dashboard')->with('success', 'Register berhasil! Token berhasil disimpan.');
        }
         // Jika request gagal
        $errorMessage = $response->json()['message'] ?? 'Terjadi kesalahan saat mendaftar.';
        $errors = $response->json()['errors'] ?? [];
        return back()->with('error', $errorMessage)->withErrors($errors)->withInput();
    }


}
