
<div id="lihatkelolabooking" class="sec_modal" >   
    <div class="logincontainer">
        <div class="form-container">
            <div class="form-header">
                <h2>Info Booking</h2>
                <button class="lihat closemodal" onclick="closeModal()">X</button>
            </div>    
                <div class="form-group">
                    <label for="datsur">Username</label>
                    <input type="text" name="datsur" readonly>
                </div>
                
                <div class="form-group">
                    <label for="fasilitas">Nama Fasilitas</label>
                    <input type="text" name="fasilitas" readonly>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" readonly>
                </div>
    
                <div class="form-row">
                    <div class="form-group half">
                        <label for="tanggalawal">Tanggal Awal</label>
                        <input type="text" name="tanggalawal" readonly>
                    </div>
                    <div class="form-group half">
                        <label for="waktuawal">Waktu Awal</label>
                        <input type="text" name="waktuawal" readonly>
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="form-group half">
                        <label for="tanggalubah">Tanggal Ubah</label>
                        <input type="text" name="tanggalubah" readonly>
                    </div>
                    <div class="form-group half">
                        <label for="waktuubah">Waktu Ubah</label>
                        <input type="text" name="waktuubah" readonly>
                    </div>
                </div>
    
                <div class="form-group">
                    <label for="alasan">Alasan Perubahan</label>
                    <textarea name="alasan" rows="4" readonly></textarea>
                </div>
                
                <div class="form-buttons">
                    
                    
                    <form id="rejectForm" action="{{ route('reject1') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="datid1" id="rejectDatid">
                        <button type="submit" class="tolak">Reject</button>
                    </form>
                    <form id="approveForm" action="{{ route('approve1') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="datid2" id="approveDatid">
                        <button type="submit" class="konfirmasi">Approve</button>
                    </form>

                </div>
        </div>
    </div>
</div>