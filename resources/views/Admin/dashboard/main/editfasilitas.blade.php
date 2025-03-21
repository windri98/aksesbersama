

<div id="editfasilitas" class="sec_modal" >   
    <div class="logincontainer">
    <div class="form-container">
        <div class="form-header">
            <h2>Edit Fasilitas</h2>
            <button class="lihat closemodal" onclick="closeModallocal()">X</button>
        </div>
        <form id="modalForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="unit_nomor">Unit</label>
                <input type="text" name="unit_nomor" value="" placeholder="No Fasilitas">
            </div>
            
            <div class="form-group">
                <label for="fasilitas">Nama Fasilitas</label>
                <input type="text" name="fasilitas" value="" placeholder="Nama Fasilitas">
            </div>

            <div class="form-group">
                    <label name="kategori" for="kategori">Kategori</label>
                    <select name="kategori">
                        @foreach ($hasilreq2 as $getdata)
                            <option value="{{ $getdata['kategori'] }}">{{ $getdata['kategori'] }}  </option>
                        @endforeach
                    </select>
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
                {{-- @if(!empty($datafoto)) --}}
                    <div class="file-input gridedit" id="foto-container1" >
                        <input type="hidden" name="fotogambar" >
                        <div class="simulation">
                            <img name="datafoto" class="foto" src="" alt="Report Image">
                            <div class="simulationfoto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 24 24" fill="none" stroke="#E4C59E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            </svg>
                            <span>Max ...</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#E4C59E" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                <path d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                <path d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                <path d="M4 20h14"></path>
                            </svg>
                            <span>Total Digunakan ...</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E4C59E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-corner-down-right">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 6v6a3 3 0 0 0 3 3h10l-4 -4m0 8l4 -4"></path>
                            </svg>
                                <div class="huruf">
                                    <span>Terakhir digunakan ...</span>
                                </div>
                            </div>
                        </div>
                        <a href="#" id="remove-foto">Ganti foto</a>
                    </div>
                {{-- @else --}}
                    <div class="file-input" id="foto-container2" style="display: none;">
                        <label class="file-input-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M18 15v3h-3v2h3v3h2v-3h3v-2h-3v-3zm-4.7 6H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2v8.3c-.6-.2-1.3-.3-2-.3c-1.1 0-2.2.3-3.1.9L14.5 12L11 16.5l-2.5-3L5 18h8.1c-.1.3-.1.7-.1 1c0 .7.1 1.4.3 2"/>
                            </svg>
                            <span data-default-text="Tambah gambar">Tambah gambar</span>
                            <input type="file" name="gambar" id="gambar" onchange="updateFileName(this)">
                        </label>
                    </div>
                {{-- @endif --}}
            </div>
            <div class="form-group">
                    <div class="file-input gridedit" id="icon-container1" >
                        <input type="hidden" name="fotoicon" >
                    <div class="simulation">
                        <div class="simulationicon">
                            <img name="dataicon" class="icon1" src="" alt="Report Image">
                            <h3 name="spanfasilitas"></h3>
                            <div class="bookoleh">
                                <span>Dibooking Oleh </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="M1 12c2.028-4.152 6.192-7 11-7s8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7m11 3.5a3.5 3.5 0 1 0 0-7a3.5 3.5 0 0 0 0 7"></path>
                                </svg>
                                <span>Lihat</span>
                            </div>
                        </div>
                    </div>
                        <a href="#" id="remove-icon">Ganti icon</a>
                        
                    </div>
                    <div class="file-input" id="icon-container2" style="display: none;">
                        <label class="file-input-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M18 15v3h-3v2h3v3h2v-3h3v-2h-3v-3zm-4.7 6H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2v8.3c-.6-.2-1.3-.3-2-.3c-1.1 0-2.2.3-3.1.9L14.5 12L11 16.5l-2.5-3L5 18h8.1c-.1.3-.1.7-.1 1c0 .7.1 1.4.3 2"/>
                            </svg>
                            <span data-default-text="Tambah icon">Tambah icon</span>
                            <input type="file" name="icon" id="icon" onchange="updateFileName(this)">
                        </label>
                    </div>
              
            </div>
            <div class="form-buttons">
                <button type="button" class="selesai" onclick="closeModallocal()">Cancel</button>
                <button type="submit" class="konfirmasi">Update</button>
            </div>
        </form>
    </div>
</div>
</div>
<script>

    // Fungsi untuk menutup semua modal dan reload halaman
    // function closeModallocal() {
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
</script>