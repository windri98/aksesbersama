@extends('Admin.dashboard.index')

@section('content')

@if (session('errorlogin'))
<div id="shownotifwrong" class="sec_modal" style="display: flex;">
    <div class="logincontainer">
        <div class="formnotif">
            <div class="formsubnotif">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg>
                <span>{{ session('errorlogin') }}</span>
            </div>
        </div>
        <span class="closemodal triggermodal" data-target="showlogin" data-index="index1" onclick="closeModal()">X</span>
    </div>
</div>
@endif

@if (session('success'))
    <div id="shownotifsuccess" class="sec_modal" style="display: flex;">
        <div class="logincontainer">
            <div class="formnotif">
                <div class="formsubnotif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 1024 1024"><path fill="currentColor" d="M512 64a448 448 0 1 1 0 896a448 448 0 0 1 0-896m-55.808 536.384l-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.27 38.27 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($errors->any() || session('error'))
<div id="shownotifwrong" class="sec_modal" style="display: flex;">
    <div class="logincontainer">
        <div class="formnotif">
            <div class="formsubnotif">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg>
                @if (session('error'))
                    <span>{{ session('error') }}</span>
                @endif
                @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                        @endforeach
                   
                @endif
            </div>
        </div>
        <span class="closemodal triggermodal" data-target="showdaftar" data-index="index2" onclick="closeModal()">X</span>
    </div>
</div>
@endif
        <div class="sec_search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14"/></svg>
            <input type="text"  id="searchInput" placeholder="Cari data...">
            <div class="cari dropdown"><span id="searchType">Cari Berdasarkan</Span>
                <button class="subcari btn">
                    <svg class="chevron-icon" width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L6 6L11 1" stroke="#E4C59E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <div class="dropdown-menu">
                    <a href="#" data-type="Username">Username</a>
                    <a href="#" data-type="Fasilitas">Nama Fasilitas</a>
                    <a href="#" data-type="Status">Status</a>
                </div>
            </div>
        </div>

<div class="main">
    {{-- @if (!empty($hasilreq1)) --}}
            <form method="GET" action="{{ url()->current() }}">
                <label for="per_page">Items per page:</label>
                <select name="per_page" id="per_page" onchange="this.form.submit()">
                    <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page', 10) == 20 ? 'selected' : '' }}>20</option>
                    <option value="30" {{ request('per_page', 10) == 30 ? 'selected' : '' }}>30</option>
                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>
    <table id="dataTable" class="kelobok">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Card</th>
                <th>Username</th>
                <th>Nama Fasilitas</th>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @php
            $dataidcard = [];
            $dataid = [];
            $datauser = [];
            $dataidfasil = [];
            $datafasil = [];
            $datakategori = [];
            $datadate = [];
            $datatime = [];
            $datastatus = [];
           
            $datadatepend = [];
            $datatimepend = [];
            $datalsan = [];
            @endphp
            
            @foreach ($hasilreq1 as $getdata )

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $getdata['userid'] ?? 'User is Not Found' }}</td>
                <td>{{ $getdata['booking']['username'] }}</td>
                <td>{{ $getdata['booking']['fasilitas']['fasilitas']}}</td>
                <td>{{ $getdata['booking']['date'] }}</td>
                <td>{{ $getdata['booking']['start_time'] }}</td>
                <td>{{ $getdata['booking']['end_time'] }}</td>
                <td>{{ $getdata['booking']['status'] }}</td>
                @if($getdata['booking']['status'] === "pending")  
                <td><a href="#" class="triggermodal" data-target="lihatkelolabooking" data-index="{{ $loop->index }}">
                    <button class="lihat">Lihat</button></a>
                </td>
                @else
             
                <td><a href="/deletebooking/{{ $getdata['booking']['id_booking'] }}">
                    <button class="hapus" type="button">Hapus</button></a>
                    <a href="#" class="triggermodal" data-target="editkelolabooking" data-index="{{ $loop->index }}">
                        <button class="edit">Edit</button></a>
                </td>
                @endif
            </tr>
            @php
            $dataidcard[] = $getdata['userid'];   
            $dataid[] = $getdata['booking']['id_booking'];   
            $datauser[] =$getdata['booking']['username']; 
            $dataidfasil[] =$getdata['booking']['fasilitas']['id_fasilitas'];
            $datafasil[] =$getdata['booking']['fasilitas']['fasilitas'];
            $datakategori[] =$getdata['booking']['fasilitas']['kategori'];
            $datadate[] =$getdata['booking']['date'];
            $datatime[] =$getdata['booking']['start_time'];
            $datastatus[] =$getdata['booking']['status'];
            $datadatepend[] = $getdata['pending']['date'] ?? ''; 
            $datatimepend[] = $getdata['pending']['requested_start'] ?? ''; 
            $datalsan[] =$getdata['pending']['alasan'] ?? ''; 
            @endphp
            @endforeach 
        </tbody>

    </table>
 
        <div class="pagination">
            <a id="previousButton" href="{{ $pagination['current_page'] > 1 ? request()->fullUrlWithQuery(['page' => $pagination['current_page'] - 1, 'per_page' => request('per_page', 10)]) : '#' }}">
                <button class="lihat" {{ $pagination['current_page'] <= 1 ? 'disabled' : '' }}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20 11v2H8l5.5 5.5l-1.42 1.42L4.16 12l7.92-7.92L13.5 5.5L8 11z" />
                    </svg>
                    <span>Previous</span>
                </button>
            </a>
        <div class="pagincenter">
            @for ($i = 1; $i <= $pagination['last_page']; $i++)
                <a href="{{ request()->fullUrlWithQuery(['page' => $i, 'per_page' => request('per_page', 10)]) }}" 
                class="{{ $pagination['current_page'] == $i ? 'active' : '' }}">
                {{ $i }}
                </a>
            @endfor
        </div>
            <a id="nextButton" href="{{ $pagination['current_page'] < $pagination['last_page'] ? request()->fullUrlWithQuery(['page' => $pagination['current_page'] + 1, 'per_page' => request('per_page', 10)]) : '#' }}">
                <button class="lihat" {{ $pagination['current_page'] >= $pagination['last_page'] ? 'disabled' : '' }}>
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 11v2h12l-5.5 5.5l1.42 1.42L19.84 12l-7.92-7.92L10.5 5.5L16 11z" />
                    </svg>
                </button>
            </a>

    </div>
    {{-- @else
        <p>No bookings available.</p>
        @php
        $dataidcard[] ='';   
        $dataid[] = '';   
        $datauser[] =''; 
        $dataidfasil[] ='';
        $datafasil[] ='';
        $datakategori[] ='';
        $datadate[] ='';
        $datatime[] ='';
        $datastatus[] ='';
        $datadatepend[] = ''; 
        $datatimepend[] = ''; 
        $datalsan[] =''; 
        @endphp
    @endif --}}
    @include('Admin.dashboard.main.lihatkelolabooking')  
    @include('Admin.dashboard.main.editkelolabooking')  
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchTypeSpan = document.getElementById('searchType');
    const dropdownItems = document.querySelectorAll('.dropdown-menu a');
    const tableRows = document.querySelectorAll('#dataTable tbody tr');

    dropdownItems.forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            const searchType = this.getAttribute('data-type');
            searchTypeSpan.textContent = searchType;
        });
    });

    searchInput.addEventListener('input', function () {
        const searchValue = this.value.toLowerCase(); 
        const searchType = searchTypeSpan.textContent; 
        let visibleRowIndex = 1;
        tableRows.forEach(row => {
            const usernameCell = row.cells[2].textContent.toLowerCase();
            const fasilitasCell = row.cells[3].textContent.toLowerCase();
            const statusCell = row.cells[7].textContent.toLowerCase();
            let match = false;
            if (searchType === 'Username') {
                match = usernameCell.includes(searchValue);
            } else if (searchType === 'Fasilitas') {
                match = fasilitasCell.includes(searchValue);
            } else if (searchType === 'Status') {
                match = statusCell.includes(searchValue);
            } else if (searchType === 'Cari Berdasarkan') {
                match =
                    usernameCell.includes(searchValue) ||
                    fasilitasCell.includes(searchValue) ||
                    statusCell.includes(searchValue);
            }
            row.style.display = match ? '' : 'none';
            if (match) {
                row.style.display = ''; 
                row.cells[0].textContent = visibleRowIndex++;
            } else {
                row.style.display = 'none';
            }
        });
    });
});

        document.addEventListener("DOMContentLoaded", function () {
        const previousButton = document.querySelector("#previousButton");
        const nextButton = document.querySelector("#nextButton");

        if (previousButton) {
            if (previousButton.getAttribute("href") === "#") {
                previousButton.style.pointerEvents = "none";
                previousButton.style.cursor = "not-allowed";
                previousButton.querySelector("button").disabled = true;
            }
        }

        if (nextButton) {
            if (nextButton.getAttribute("href") === "#") {
                nextButton.style.pointerEvents = "none";
                nextButton.style.cursor = "not-allowed";
                nextButton.querySelector("button").disabled = true;
            }
        }
    });

        document.querySelector('.cari').addEventListener('click', function(e) {
            e.stopPropagation();
            document.querySelector('.cari').classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.cari')) {
                document.querySelector('.cari').classList.remove('active');
            }
        });
    
document.querySelectorAll('.triggermodal').forEach(button => {
    button.addEventListener('click', function () {
        const index = parseInt(this.getAttribute('data-index'));
        const target = this.getAttribute('data-target');
        const show = document.getElementById(target);
        if (show) {
            const datidcard = @json($dataidcard);
            const datid = @json($dataid);
            const datsur = @json($datauser);
            const datfas = @json($datafasil);
            const datidfas = @json($dataidfasil);
            const datkategori = @json($datakategori);
            const datdate = @json($datadate);
            const dattime = @json($datatime);
            const datsta = @json($datastatus);
            const datdatepen = @json($datadatepend);
            const dattimepen = @json($datatimepend);
            const datalsan = @json($datalsan);
            
        if (datsur[index] !== undefined) {
            if (target === 'lihatkelolabooking') {
                show.querySelector('input[name="datid1"]').value = datid[index] || '';
                show.querySelector('input[name="datid2"]').value = datid[index] || '';
                show.querySelector('input[name="datsur"]').value = datsur[index] || '';
                show.querySelector('input[name="fasilitas"]').value = datfas[index] || '';
                show.querySelector('input[name="status"]').value = datsta[index] || '';
                show.querySelector('input[name="tanggalawal"]').value = datdate[index] || '';
                show.querySelector('input[name="waktuawal"]').value = dattime[index] || '';
                show.querySelector('input[name="tanggalubah"]').value = datdatepen[index] || '';
                show.querySelector('input[name="waktuubah"]').value = dattimepen[index] || '';
                show.querySelector('textarea[name="alasan"]').value = datalsan[index] || '';
            
            } else if (target === 'editkelolabooking') {
                show.querySelector('input[name="datid3"]').value = datid[index] || '';
                show.querySelector('input[name="idfasil"]').value = datidfas[index] || '';
                show.querySelector('input[name="dtkagor"]').value = datkategori[index] || '';
                show.querySelector('input[name="idCard"]').value = datidcard[index] || '';
                show.querySelector('input[name="datsur"]').value = datsur[index] || '';
                show.querySelector('select[name="fasilitas"]').value = datfas[index] || '';
                show.querySelector('input[name="tanggalawal"]').value = datdate[index] || '';
                show.querySelector('select[name="waktu"]').value = dattime[index] || '';
                    const fasilitasSelect = show.querySelector('select[name="fasilitas"]');
                    const selectedOption = fasilitasSelect.options[fasilitasSelect.selectedIndex];
                    const selectedKategori = selectedOption.getAttribute('data-kategori');
                    console.log("Kategori Terpilih:", selectedKategori);
                    const waktuContainer = show.querySelector('#waktu-container'); 
                    if (selectedKategori === 'Ruang Meeting') {
                        waktuContainer.innerHTML = `
                            <label for="waktu">Waktu</label>
                            <select id="waktu" name="waktu">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        `;
                        const waktuSelect = show.querySelector('select[name="waktu"]');
                        waktuSelect.value = dattime[index] || 'AM'; 
                    } else {
                        waktuContainer.innerHTML = `
                            <label for="waktu">Waktu</label>
                            <select id="waktu" name="waktu">
                                ${Array.from({ length: 24 }, (_, i) => `
                                    <option value="${String(i).padStart(2, '0')}:00">${String(i).padStart(2, '0')}:00</option>
                                `).join('')}
                            </select>
                        `;
                        const waktuSelect = show.querySelector('select[name="waktu"]');
                        waktuSelect.value = dattime[index] || '00:00';
                    }
                }
            } else {
                console.error('Index tidak valid: ' + index);
            }
        } else {
            console.error('Modal dengan target ' + target + ' tidak ditemukan.');
        }
    });
});

    function updateWaktu() {
        const fasilitasSelect = document.getElementById('fasilitas'); 
        const waktuContainer = document.getElementById('waktu-container'); 
        const selectedOption = fasilitasSelect.options[fasilitasSelect.selectedIndex]; 
        const selectedKategori = selectedOption.getAttribute('data-kategori');
        let waktuDropdown = '';

        if (selectedKategori === 'Ruang Meeting') {
            waktuDropdown = `
                <label for="waktu">Waktu</label>
                <select id="waktu" name="waktu">
                    <option>AM</option>
                    <option>PM</option>
                </select>
            `;
        } else {
            waktuDropdown = `
                <label for="waktu">Waktu</label>
                <select id="waktu" name="waktu">
                    ${Array.from({ length: 24 }, (_, i) => `
                        <option>${String(i).padStart(2, '0')}:00</option>
                    `).join('')}
                </select>
            `;
        }

        waktuContainer.innerHTML = waktuDropdown; 
    }

    document.addEventListener('DOMContentLoaded', updateWaktu);
</script>
@endsection
