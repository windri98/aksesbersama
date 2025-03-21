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
            <a href="#" data-type="No.Kamar">No.Kamar</a>
            <a href="#" data-type="Kategori">Kategori</a>
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
    <table id="dataTable" class="kelorep">

        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>No.Kamar</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $dataid = []; 
            $datanokam = []; 
            $datauser = [];
            $datakat = [];
            $datastatus = [];
            $datatgl = [];
            $datawkt = [];
            $dataket = [];
            $dataimg = [];
            @endphp
         
            @foreach ($hasilreq1 as $getlink)
  
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $getlink['username'] }}</td>
                <td>{{ $getlink['room_number'] }}</td>
                <td>{{ $getlink['kategori']  }}</td>
                <td>{{ $getlink['status'] }}</td>
                <td><span>{{ \Carbon\Carbon::parse($getlink['created_at'])->format('d-m-Y')}}</span></td>
                <td><span>{{ \Carbon\Carbon::parse($getlink['created_at'])->format('H:i:s')}}</span></td>
                @if($getlink['status'] === "sedang diproses")  
                <td><a href="/export/{{ $getlink['id'] }}">
                    <button class="export">Export</button></a>
                    <a href="/donecomplaint/{{ $getlink['id'] }}">
                    <button class="selesai">selesai</button></a>
                </td>
                @else
                <td><a href="#" class="triggermodal" data-target="inforeport" data-index="{{ $loop->index }}">
                    <button class="lihat">Lihat</button></a>
                </td>
                @endif
            </tr>
            @php
            $dataid[] = $getlink['id']; 
            $datanokam[] = $getlink['room_number']; 
            $datauser[] = $getlink['username'];
            $datakat[] = $getlink['kategori'];
            $datastatus[] = $getlink['status'];
            $datatgl[] = \Carbon\Carbon::parse($getlink['created_at'])->format('d-m-Y'); 
            $datawkt[] = \Carbon\Carbon::parse($getlink['created_at'])->format('H:i:s');
            $dataket[] = $getlink['keterangan'];
            if (isset($getlink['reportImages'])) {
                $images = [];
                foreach ($getlink['reportImages'] as $image) {
                    $images[] = $image['image'];
                }
                $dataimg[] = $images;
            } else {
                $dataimg[] = [];
            }
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
    @endif --}}
@include('Admin.dashboard.main.inforeport')   
@include('Admin.dashboard.main.showImg')
</div>   
<script>
    const apiStorageUrl = "{{ env('API_BASE_URL').'/storage/img/' }}";
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
            const usernameCell = row.cells[1].textContent.toLowerCase();
            const kmrnameCell = row.cells[2].textContent.toLowerCase();
            const kategoriCell = row.cells[3].textContent.toLowerCase();
            const statusCell = row.cells[4].textContent.toLowerCase();
            let match = false;
            if (searchType === 'Username') {
                match = usernameCell.includes(searchValue);
            } else if (searchType === 'No.Kamar') {
                match = kmrnameCell.includes(searchValue);
            } else if (searchType === 'Kategori') {
                match = kategoriCell.includes(searchValue);
            } else if (searchType === 'Status') {
                match = statusCell.includes(searchValue);
            } else if (searchType === 'Cari Berdasarkan') {
                match =
                    usernameCell.includes(searchValue) ||
                    kmrnameCell.includes(searchValue) ||
                    kategoriCell.includes(searchValue) ||
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
        const dataId = @json($dataid);
        const dataNoKam = @json($datanokam);
        const dataUser = @json($datauser);
        const dataKat = @json($datakat);
        const dataStatus = @json($datastatus);
        const dataTgl = @json($datatgl);
        const dataWkt = @json($datawkt);
        const dataKet = @json($dataket);
        const dataImg = @json($dataimg);
        if (index >= dataNoKam.length) {
            console.error('Index tidak valid:', index);
            return;
        }
        document.getElementById('noId').value = dataId[index] || '';
        document.getElementById('noKamar').value = dataNoKam[index] || '';
        document.getElementById('username').value = dataUser[index] || '';
        document.getElementById('kategori').value = dataKat[index] || '';
        document.getElementById('status').value = dataStatus[index] || '';
        document.getElementById('tanggal').value = dataTgl[index] || '';
        document.getElementById('waktu').value = dataWkt[index] || '';
        document.getElementById('keterangan').value = dataKet[index] || '';
     
        const imageContainer = document.querySelector('.image-upload-container');
        imageContainer.innerHTML = '';
        if ((dataImg[index] || []).length > 0) {
        (dataImg[index] || []).forEach((image, imgIndex) => {
            const imgElement = document.createElement('img');
            imgElement.src = `${apiStorageUrl}${image}`;
            imgElement.alt = 'Report Image';
            imgElement.style = 'max-width: 150px; margin: 5px;';
            imgElement.style.cursor = 'pointer';
            imgElement.addEventListener('click', () => {
                 console.log('Image clicked!');
                 openImageModal(dataImg[index], imgIndex);
                });
            imageContainer.appendChild(imgElement);
        });
            } else {
            const svgElement = `
                <svg xmlns="http://www.w3.org/2000/svg" width="126" height="126" viewBox="0 0 48 48">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                        <path d="M39 6H9a3 3 0 0 0-3 3v30a3 3 0 0 0 3 3h30a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3"/>
                        <path d="M18 23a5 5 0 1 0 0-10a5 5 0 0 0 0 10m24 13L31 26l-10 9l-7-6l-8 6"/>
                    </g>
                </svg>
            `;
            const spanElement = document.createElement('span');
            spanElement.textContent = 'No Image';
            spanElement.style.color = '#000000';
            spanElement.style.alignContent  = 'center';
            imageContainer.innerHTML = svgElement;
            imageContainer.appendChild(spanElement);
        }
    });
});
    function openImageModal(images, startIndex) {
        const modal = document.getElementById('showImg');
        const imgElement = modal.querySelector('img[name="img"]');
        let currentIndex = startIndex;
        function updateImage() {
            imgElement.src = `${apiStorageUrl}${images[currentIndex]}`;
        }
        modal.querySelector('#nextImg').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            updateImage();
        });
        modal.querySelector('#prevImg').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateImage();
        });
        modal.style.display = 'block';
        updateImage();
    }

    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('showImg').style.display = 'none';
    });
</script>
@endsection
