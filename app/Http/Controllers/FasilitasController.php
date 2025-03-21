<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Fasilitas;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FasilitasController extends Controller
{
    public function LihatSemuaFasilitas(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $kategori = Kategori::all();
        $fasilitas = Fasilitas::paginate($perPage);

    if (!empty($fasilitas)) {
        return view('Admin.dashboard.main.kelolafasilitas', [
            'iconname' => 'Kelola Fasilitas',
            //'hasilreq1' =>  $response1->json()
            'hasilreq1' =>  $fasilitas->items(),
            'hasilreq2' =>  $kategori,
            'pagination' => [
                'current_page' => $fasilitas->currentPage(), 
                'last_page' => $fasilitas->lastPage(),
                'per_page' => $fasilitas->perPage(),
                'total' => $fasilitas->total(), 
            ]
            
        ]);
    }
    return view('Admin.dashboard.main.kelolafasilitas', [
        'iconname' => 'Kelola Fasilitas',
        'hasilreq1' => [],  
        'hasilreq2' => [],  
    ])->with('error', "Gagal memuat data.");
}

public function TambahFasilitas(Request $request)
{

    try {
        $validated = $request->validate([
            'unit_nomor' => 'required|string',
            'fasilitas' => 'required|string',
            'kategori' => 'required|string',
            'newkategori' => 'nullable|string|required_with:kategoriicon',
            'kapasitas' => 'required|integer',
            'maxjam' => 'required|integer',
            'kategoriicon' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240', 
            'gambar' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'icon' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ], [
            'newkategori.required_with' => 'Kategori Baru harus diisi jika Icon Kategori diunggah.',
            'kategoriicon.required_with' => 'Icon Kategori harus diunggah jika Kategori Baru diisi.',
            'gambar.required' => 'Gambar tidak boleh kosong.',
            'icon.required' => 'Icon tidak boleh kosong.',
            'unit_nomor.required' => 'Unit nomor tidak boleh kosong.',
            'fasilitas.required' => 'Fasilitas tidak boleh kosong.',
            'kategori.required' => 'Kategori tidak boleh kosong.',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong.',
            'kapasitas.integer' => 'Kapasitas harus berupa angka.',
            'maxjam.required' => 'Max Jam tidak boleh kosong.',
            'maxjam.integer' => 'Max Jam harus berupa angka.',
        ]);
        if (!is_null($request->newkategori) && !$request->hasFile('kategoriicon')) {
            return back()->withErrors(['kategoriicon' => 'Icon Kategori tidak boleh kosong jika kategori baru diisi.']);
        }

        if (is_null($request->newkategori) && $request->hasFile('kategoriicon')) {
            return back()->withErrors(['newkategori' => 'Kategori Baru tidak boleh kosong jika Icon Kategori diunggah.']);
        }
        if ($request->filled('newkategori')) {
            
            $kategori = Kategori::where('kategori', $request->newkategori)->first();
            if ($kategori) {
                return redirect()->back()->with('error', 'Kategori Sudah Ada Didatabase.');
            }
          
            // Proses file `icon`
            $kategoriiconFile = $request->file('kategoriicon');
            $file3 = Image::make($kategoriiconFile)
            ->encode('jpg', 80)
            ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio(); 
                $constraint->upsize();
            });
            $kategoriiconFileName = time() . '_' . uniqid() . '.jpg';
            $kategoriiconFilePath  = storage_path('app/public/img');
            if (!file_exists($kategoriiconFilePath )) {
                mkdir($kategoriiconFilePath , 0755, true);
            }
            $filePathkategoriicon = $kategoriiconFilePath . '/' . $kategoriiconFileName;
            $file3->save($filePathkategoriicon);
            $validate['icon'] = $kategoriiconFileName; // Simpan path relatif
            $validate['kategori'] = $request->newkategori;
            $newkategori = Kategori::create($validate);


            $validated['kategori'] = $newkategori->kategori;

        } else {
        
            $validated['kategori'] = $request->kategori; // Misalnya gunakan kategori lama jika tidak ada input baru
        }
        $kategori = Kategori::where('kategori', $validated['kategori'])->first();
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }
    
        $validated['id_kategori'] = $kategori->id;
    
        $fasilitas = Fasilitas::where('fasilitas', $validated['fasilitas'])
        ->where('unit_nomor', $validated['unit_nomor'])
        ->where('id_kategori', $validated['id_kategori'])
        ->first();

        if ($fasilitas) {
            return redirect()->back()->with('error', 'Fasilitas ini Sudah Ada didatabase.');
        }

        $fotoFile = $request->file('gambar');
        
        $file1 = Image::make($fotoFile)
        ->encode('jpg', 80) 
        ->resize(800, null, function ($constraint) {
            $constraint->aspectRatio(); 
            $constraint->upsize(); 
        });
        $fotoFileName = time() . '_' . uniqid() . '.jpg';
        $fotoFilePath  = storage_path('app/public/img');

        if (!file_exists($fotoFilePath)) {
            mkdir($fotoFilePath, 0755, true);
        }
        $filePathfoto = $fotoFilePath  . '/' . $fotoFileName;
        $file1->save($filePathfoto); 

        $iconFile = $request->file('icon');
        $file2 = Image::make($iconFile)
        ->encode('jpg', 80) 
        ->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize(); 
        });
        $iconFileName = time() . '_' . uniqid() . '.jpg';
        $iconFilePath  = storage_path('app/public/img');

        if (!file_exists($iconFilePath )) {
            mkdir($iconFilePath , 0755, true);
        }

        $filePathicon = $iconFilePath . '/' . $iconFileName;
        $file2->save($filePathicon); 
     
        $validated['foto'] = $fotoFileName; 
        $validated['icon'] = $iconFileName;

        $fasilitas = Fasilitas::create($validated);

        return redirect()->back()->with('success', 'Fasilitas berhasil ditambahkan.');

    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


public function UpdateFasilitas(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'unit_nomor' => 'required|string',
            'fasilitas' => 'required|string',
            'kategori' => 'required|string',
            'kapasitas' => 'required|integer',
            'maxjam' => 'required|integer',
            'fotogambar' => 'nullable|string',
            'fotoicon' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240', 
            'icon' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ], [
            'gambar.required' => 'Gambar tidak boleh kosong.',
            'gambar.*.file' => 'Terdapat file yang tidak valid.', 
            'gambar.*.mimes' => 'format: JPEG, PNG, JPG, GIF dan WEBP yang diizinkan.', 
            'gambar.*.max' => 'Ukuran file maksimal adalah 10MB.',
            'icon.required' => 'Icon tidak boleh kosong.',
            'icon.*.file' => 'Terdapat file yang tidak valid.', 
            'icon.*.mimes' => 'format: JPEG, PNG, JPG, GIF dan WEBP yang diizinkan.',
            'icon.*.max' => 'Ukuran file maksimal adalah 10MB.', 
            'unit_nomor.required' => 'Unit nomor tidak boleh kosong.',
            'fasilitas.required' => 'Fasilitas tidak boleh kosong.',
            'kategori.required' => 'Kategori tidak boleh kosong.',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong.',
            'kapasitas.integer' => 'Kapasitas harus berupa angka.',
            'maxjam.required' => 'Max Jam tidak boleh kosong.',
            'maxjam.integer' => 'Max Jam harus berupa angka.',
        ]);
        if (is_null($request->fotogambar) && !$request->hasFile('gambar')) {
            return back()->withErrors(['gambar' => 'Gambar tidak boleh kosong']);
        }
        
        if (is_null($request->fotoicon) && !$request->hasFile('icon')) {
            return back()->withErrors(['icon' => 'Icon tidak boleh kosong']);
        }
        $kategori = Kategori::where('kategori', $validated['kategori'])->first();
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }
        $validated['id_kategori'] = $kategori->id;

        $fasilitas = Fasilitas::where('id_fasilitas', $id)
        ->first();
        if (!$fasilitas) {
            return redirect()->back()->with('error', 'Fasilitas ini Tidak Ada didatabase.');
        }
    
        if ($fasilitas->fasilitas !== $validated['fasilitas'] || $fasilitas->unit_nomor !== $validated['unit_nomor'] || $fasilitas->id_kategori != $validated['id_kategori']) {
            $fasilitascek = Fasilitas::where('fasilitas', $validated['fasilitas'])
            ->where('unit_nomor', $validated['unit_nomor'])
            ->where('id_kategori', $validated['id_kategori'])
            ->first();

            if ($fasilitascek) {
                return redirect()->back()->with('error', 'Fasilitas ini Sudah Ada didatabase.');
            }
        }
        if ($request->hasFile('gambar')) {
                $fotoFile = $request->file('gambar');
                $fotoFileName = time() . '_' . uniqid() . '.jpg';
                $fotoFilePath = storage_path('app/public/img/' . $fotoFileName);

                $file1 = Image::make($fotoFile)
                    ->encode('jpg', 80)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                $file1->save($fotoFilePath);
            } else {
                $fotoFileName = $validated['fotogambar'];
            }
            if ($request->hasFile('icon')) {
                $iconFile = $request->file('icon');
                $iconFileName = time() . '_' . uniqid() . '.jpg';
                $iconFilePath = storage_path('app/public/img/' . $iconFileName);

                $file2 = Image::make($iconFile)
                    ->encode('jpg', 80)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                $file2->save($iconFilePath);
            } else {
                $iconFileName = $validated['fotoicon'];
            }
                $fasilitas->update(array_merge($validated, [
                    'foto' => $fotoFileName,
                    'icon' => $iconFileName,
                ]));

        return redirect()->back()->with('success', 'Fasilitas berhasil diperbarui.');

    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    // Method untuk menampilkan fasilitas berdasarkan ID
    public function deletefasilitas($id)
    {
        $fasilitas = Fasilitas::where('id_fasilitas', $id)->firstOrFail();
        $fasilitas->delete();
        return redirect()->back()->with('success', 'Fasilitas berhasil dihapus.');
    }



}
