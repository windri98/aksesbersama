
    <div id="inforeport" class="sec_modal">   
        <div class="logincontainer">
            <div class="form-container">
                <div class="form-header">
                    <h2>Info Keluhan</h2>
                    <button class="lihat closemodal" onclick="closeModal()">X</button>
                </div>
                <form action="{{ route('proses') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="noId" name="noId" readonly>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" readonly>
                        </div>
                        <div class="form-group">
                            <label for="noKamar">No. Kamar</label>
                            <input type="text" id="noKamar" name="room_number" readonly>
                        </div>
                    </div>
                  
                    <div class="form-row">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" id="kategori" name="kategori" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" id="status" name="status" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Pengaduan</label>
                            <input type="text" id="tanggal" name="created_at" readonly>
                        </div>
                        <div class="form-group">
                            <label for="waktu">Waktu</label>
                            <input type="text" id="waktu" name="created_at_time" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="4" readonly></textarea>
                    </div>
    
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <div class="img_form overflow-scroll">
                            <div class="image-upload-container"></div>
                        </div>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="selesai" onclick="closeModal()">Kembali</button>
                        <button type="submit" class="konfirmasi">Proses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>

</script>