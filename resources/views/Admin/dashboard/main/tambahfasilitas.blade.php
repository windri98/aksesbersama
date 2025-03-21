
<div id="tambahfasilitas" class="sec_modal">   
    <div class="logincontainer">
    <div class="form-container">
        <div class="form-header">
            <h2>Tambah Fasilitas</h2>
            <button class="lihat closemodal" onclick="closeModallocal()">X</button>
        </div>
        <form action="{{ route('TambahFasilitas') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="unit_nomor">Unit</label>
                <input type="text" name="unit_nomor" value="" placeholder="No Fasilitas">
            </div>
            
            <div class="form-group">
                <label for="fasilitas">Nama Fasilitas</label>
                <input type="text" name="fasilitas" value="" placeholder="Nama Fasilitas">
            </div>
      

            <div class="form-row">
                <div class="form-group"  id="kategori-container3">
                    <label for="kategori">Kategori</label>
                    <select name="kategori">
                        @foreach ($hasilreq2 as $getdata)
                            <option value="{{ $getdata['kategori'] }}">{{ $getdata['kategori'] }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group form-row"  id="kategori-container1">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2"/></svg>
                <a href="#" id="remove-kategori"> 
                    <span>Kategori</span>
                </a>
            </div>
        
            <div class="form-row" id="kategori-container2" style="display: none;">
                <div class="form-group">
                    <label for="newkategori">Icon Kategori</label>
                    <label class="file-input-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18 15v3h-3v2h3v3h2v-3h3v-2h-3v-3zm-4.7 6H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2v8.3c-.6-.2-1.3-.3-2-.3c-1.1 0-2.2.3-3.1.9L14.5 12L11 16.5l-2.5-3L5 18h8.1c-.1.3-.1.7-.1 1c0 .7.1 1.4.3 2"/>
                        </svg>
                        <span style="max-width: 160px;" data-default-text="Tambah Icon">Tambah Icon</span>
                        <input type="file" name="kategoriicon" id="kategoriicon" onchange="updateFileName(this)">
                    </label>
                </div>
                <div class="form-group">
                    <label for="newkategori">New Kategori</label>
                    <input type="text" name="newkategori" value="" placeholder="Kategori Baru" >
                </div>
            </div>

            <div class="form-group form-row"  id="kategori-container4" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M21 12a9 9 0 1 1-18 0a9 9 0 0 1 18 0M7.293 16.707a1 1 0 0 1 0-1.414L10.586 12L7.293 8.707a1 1 0 0 1 1.414-1.414L12 10.586l3.293-3.293a1 1 0 1 1 1.414 1.414L13.414 12l3.293 3.293a1 1 0 0 1-1.414 1.414L12 13.414l-3.293 3.293a1 1 0 0 1-1.414 0" clip-rule="evenodd"/></svg>
                <a href="#" id="batal-kategori"> 
                    <span>Batal tambah kategori</span>
                </a>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kapasitas">Kapasitas Orang</label>
                    <input type="text" name="kapasitas" value="" placeholder="Angka 1 - 100...">
                </div>
                <div class="form-group">
                    <label for="maxjam">Jam yang diperbolehkan</label>
                    <input type="text" name="maxjam" value="" placeholder="Angka 1 - 100...">
                </div>
            </div>

            <div class="form-group">
                    <div class="file-input">
                        <label class="file-input-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18 15v3h-3v2h3v3h2v-3h3v-2h-3v-3zm-4.7 6H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2v8.3c-.6-.2-1.3-.3-2-.3c-1.1 0-2.2.3-3.1.9L14.5 12L11 16.5l-2.5-3L5 18h8.1c-.1.3-.1.7-.1 1c0 .7.1 1.4.3 2"/></svg>
                            <span data-default-text="Tambah gambar">Tambah gambar</span>
                        <input type="file" name="gambar" id="gambar" onchange="updateFileName(this)">
                        {{-- <span class="file-icon">📁</span> --}}
                    </div>
            </div>
            <div class="form-group">
                    <div class="file-input">
                        <label class="file-input-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18 15v3h-3v2h3v3h2v-3h3v-2h-3v-3zm-4.7 6H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2v8.3c-.6-.2-1.3-.3-2-.3c-1.1 0-2.2.3-3.1.9L14.5 12L11 16.5l-2.5-3L5 18h8.1c-.1.3-.1.7-.1 1c0 .7.1 1.4.3 2"/></svg>
                            <span data-default-text="Tambah icon">Tambah icon</span>
                        <input type="file" name="icon" id="icon" onchange="updateFileName(this)">
                        {{-- <span class="file-icon">📁</span> --}}
                    </div>
            </div>
            
            <div class="form-buttons">
                <button type="button" class="selesai" onclick="closeModallocal()">Cancel</button>
                <button type="submit" class="konfirmasi">Tambah</button>
            </div>
        </form>
    </div>
</div>
</div>
<script>
      // Fungsi untuk menutup semua modal dan reload halaman
    //   function closeModallocal() {
    //     const modals = document.querySelectorAll('.sec_modal');
    //     modals.forEach(modal => {
    //         modal.style.display = 'none'; // Sembunyikan semua modal
    //     });
    //     location.reload(); // Refresh halaman
    // }
    // // Event untuk menutup modal ketika klik di luar modal
    // document.addEventListener('click', function (event) {
    //     const target = event.target;

    //     // Cek apakah target bukan bagian dari modal dan bukan tombol pemicu modal
    //     if (!target.closest('.logincontainer') && !target.closest('.triggermodal')) {
    //         closeModallocal(); // Panggil fungsi close modal
    //     }
    // });

    // //Event untuk menutup modal ketika tombol close diklik
    // document.querySelectorAll('.closemodal').forEach(closeButton => {
    //     closeButton.addEventListener('click', function () {
    //         closeModallocal(); // Panggil fungsi close modal
    //     });
    // });

        //    function updateFileName(inputElement) {
        //     const label = inputElement.closest('.file-input-container').querySelector('span');
        //     if (inputElement.files.length > 0) {
        //         label.textContent = inputElement.files[0].name;
        //     } else {
        //         label.textContent = "Tambah gambar";
        //     }
        // }

//     function updateFileName(inputElement) {
//     const label = inputElement.previousElementSibling;
//     const validExtensions = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/icon']; // Tipe file gambar yang valid
//     let invalidFiles = 0;

//     if (inputElement.files.length > 0) {
//         Array.from(inputElement.files).forEach(file => {
//             if (!validExtensions.includes(file.type)) {
//                 invalidFiles++;
//             }
//         });

//         if (invalidFiles > 0) {
//             alert(`${invalidFiles} file bukan gambar dan tidak ditambahkan.`);
//         }

//         const validFileNames = Array.from(inputElement.files)
//             .filter(file => validExtensions.includes(file.type))
//             .map(file => file.name);

//         if (validFileNames.length > 0) {
//             label.textContent = validFileNames.join(', '); 
//         } else {
//             label.textContent = label.dataset.defaultText;
//         }
//     } else {
//         label.textContent = label.dataset.defaultText;
//     }
// }
</script>