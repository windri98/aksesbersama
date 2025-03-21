
<div id="editpengguna" class="sec_modal">   
    <div class="logincontainer">
    <div class="form-container">
        <div class="form-header">
            <h2>Edit Pengguna</h2>
            <button class="lihat closemodal" onclick="closeModal()">X</button>
        </div>
        <form action="{{ route('update') }}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="idCard">ID Card</label>
                <input type="text" name="idCard" readonly>
            </div>
            
            <div class="form-group">
                <label for="datsur">Username</label>
                <input type="text" name="datsur" readonly>
            </div>
            
            <div class="form-group">
                <label for="datno">No. Kamar</label>
                <input type="text" name="datno">
            </div>
            
            <div class="form-group">
                <label for="datsta">Status</label>
                <select name="datsta">
                    <option value="user">User</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
            
            <div class="form-buttons">
                <button type="button" class="selesai" onclick="closeModal()">Cancel</button>
                <button type="submit" class="konfirmasi">Update</button>
            </div>
        </form>
    </div>
</div>
</div>
