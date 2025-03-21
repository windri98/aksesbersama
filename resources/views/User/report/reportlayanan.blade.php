        
        <div id="report" class="panel panel-right">
            <div class="navbar">
                <div class="secnavbar setsecnavbar">
                    <a href="javascript:void(0)" id="closereport"><div class="logopencarian">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M11.884 6.116a1.25 1.25 0 0 0-1.768 0l-5 5a1.25 1.25 0 0 0 0 1.768l5 5a1.25 1.25 0 0 0 1.768-1.768L9.018 13.25H18a1.25 1.25 0 1 0 0-2.5H9.018l2.866-2.866a1.25 1.25 0 0 0 0-1.768"/>
                        </svg>
                    </div></a>
                    <div class="logo">
                        <img src="/img/icon-aksesbersama_0.png" alt="">
                        <h2>Keluhan dan Pengaduan Layanan Karyawan</h2>
                    </div>
                </div>
            </div>
        <div class="col">
            <div class="ubahpas">
                <form action="{{ route('createreport') }}"  id="uploadForm"   method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="list_form">
                        <span>Username</span>
                        <input type="text" id="" name="username" value="{{ session('username') }}" readonly>
                    </div>
            
                    <div class="list_form">
                        <span>No. Kamar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem" viewBox="0 0 16 16">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.75 7.75h-12m6-6v12m-3.5-2.5l7-7m0 7l-7-7"/>
                        </svg>
                        <input type="text" id="" name="room_number" value="{{ session('no_kamar') }}" readonly>
                    </div>
                    <div class="list_form">
                        <span>Kategori</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem" viewBox="0 0 16 16">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.75 7.75h-12m6-6v12m-3.5-2.5l7-7m0 7l-7-7"/>
                        </svg>
                        <select class="form-select" name="kategori" aria-label="Default select example" required>
                            <option class="sec_selected" value="" selected place>Pilih Kategori</option>
                            <option value="Keluhan Kamar">Keluhan Kamar</option>
                            <option value="Pengaduan Fasilitas">Pengaduan Fasilitas</option>
                            <option value="Lainnya">Lainnya</option>
                            {{-- @foreach ($categories as $category)
                            @if(old('category_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}  </option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}  </option>
                            @endif
                            @endforeach --}}
                          </select>
                    </div>

                    <div class="list_form">
                        <span>Keterangan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem" viewBox="0 0 16 16">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.75 7.75h-12m6-6v12m-3.5-2.5l7-7m0 7l-7-7"/>
                        </svg>
                    <div class="list_formbook">
                        <textarea  name="keterangan" id="textreport" cols="30" rows="1" placeholder="Tulis Keterangan" maxlength="150" required></textarea>
                        <span id="charreport">150 karakter</span>
                    </div>
                    </div>
                    <div class="img_form overflow-scroll">
                        <div class="custom-file-upload">
                            <div id="image-preview-container"></div>
                            <label for="images" class="custom-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M18 15v3h-3v2h3v3h2v-3h3v-2h-3v-3zm-4.7 6H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2v8.3c-.6-.2-1.3-.3-2-.3c-1.1 0-2.2.3-3.1.9L14.5 12L11 16.5l-2.5-3L5 18h8.1c-.1.3-.1.7-.1 1c0 .7.1 1.4.3 2"/>
                                </svg>
                                <span>Upload Images</span>
                            </label>
                            <input type="file" id="images" name="images[]" multiple onchange="previewImages(); updateFileNames();">
                        </div>
                        <div id="file-names" class="mt-2">No files chosen</div>
                    </div>
                    
                    <div class="button_form">
                        <button class="sec_sub sec_siz2"  type="submit" name="" onclick="sendAllFiles(); handleClick(event, this);">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>


    </script>