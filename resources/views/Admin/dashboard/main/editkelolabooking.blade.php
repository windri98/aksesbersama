<div id="editkelolabooking" class="sec_modal" >   
    <div class="logincontainer">
        <div class="form-container">
            <div class="form-header">
                <h2>Edit Booking</h2>
                <button class="lihat closemodal" onclick="closeModal()">X</button>
            </div>
            {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
            <form id="editForm" action="{{ route('updatebookingadmin') }}"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="idCard">ID Card</label>
                    <input type="text" id="idCard" name="idCard" readonly>
                </div>
                <input type="hidden" name="datid3">
                <div class="form-group">
                    <label for="datsur">Username</label>
                    <input type="text" id="username" name="datsur" readonly>
                </div>
                <input type="hidden" name="idfasil">
                <div class="form-group">
                    <label  for="fasilitas">Fasilitas</label>
                    <select name="fasilitas"  id="fasilitas" onchange="updateWaktu(this.value)">
                        @foreach ($hasilreq2 as $getdata)
                        <option value="{{ $getdata['fasilitas'] }}" 
                        data-kategori="{{ $getdata['kategori'] }}" 
                        {{ $getdata['kategori'] === 'Ruang Meeting' ? 'selected' : '' }}>
                        {{ $getdata['fasilitas'] }}
                        </option>
                        @endforeach
                    </select>
                </div> 
                <input type="hidden" name="dtkagor">
                <div class="form-row">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="" name="tanggalawal">
                    </div>
                    <div class="form-group" id="waktu-container">
                        <label for="waktu">Waktu</label>
                        <select id="waktu" name="waktu">
                        </select>
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="button" class="selesai" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="konfirmasi">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
</html>