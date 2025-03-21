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
            <a href="#" data-type="Nama Fasilitas">Nama Fasilitas</a>
            <a href="#" data-type="Kategori">Kategori</a>
        </div>
    </div>
</div>

   <div class="main">
        {{-- @if (!empty($hasilreq1)) --}}
        <div class="sec_addnew">
            <a href="#" class="triggermodal" data-target="tambahfasilitas" >
            <button class="tambah">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2"/></svg>
                <span>Tambah Fasilitas</span></button></a>     
            </div> 
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
    <table id="dataTable" class="kelofasil">
        <thead>
            <tr>
                <th>No</th>
                <th>Unit</th>
                <th>Nama Fasilitas</th>
                <th>Kategori</th>
                <th>Kapasitas</th>
                <th>Max Time</th>
                <th>Foto</th>
                <th>Icon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $dataunit = [];
            $datafasil = [];
            $datakagor = [];
            $datakapas = [];
            $datajam = [];
            $datafoto = [];
            $dataicon = [];
            @endphp
            @foreach ($hasilreq1 as $getdata)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $getdata['unit_nomor'] }}</td>
                <td>{{ $getdata['fasilitas'] }}</td>
                <td>{{ $getdata['kategori'] }}</td>
                <td>{{ $getdata['kapasitas'] }} Orang</td>
                <td>{{ $getdata['maxjam'] }} </td>
                <td>{{ $getdata['foto'] }}</td>
                <td>{{ $getdata['icon'] }}</td>
                <td>
                <a href="/deletefasilitas/{{ $getdata['id_fasilitas'] }}">
                    <button class="hapus"  type="button">Hapus</button></a>
                <a href="#" class="triggermodal" data-target="editfasilitas" data-index="{{ $loop->index }}" data-route="{{ route('UpdateFasilitas', ['id' => $getdata['id_fasilitas']]) }}" >
                    <button class="edit">Edit</button></a>
                    {{-- onclick="getSelectedValues()" --}}
                </td>
            </tr>
            @php
            $dataunit[] = $getdata['unit_nomor'];   
            $datafasil[] = $getdata['fasilitas'];   
            $datakagor[] =$getdata['kategori']; 
            $datakapas[] =$getdata['kapasitas'];
            $datajam[] =$getdata['maxjam'];
            $datafoto[] =$getdata['foto'];
            $dataicon[] =$getdata['icon'];
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
@include('Admin.dashboard.main.editfasilitas')
@include('Admin.dashboard.main.tambahfasilitas')   
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalForm = document.getElementById('modalForm');
    const methodField = document.getElementById('methodField');

    document.querySelectorAll('.triggermodal').forEach(button => {
        button.addEventListener('click', function () {
            const route = this.getAttribute('data-route');
            const method = 'POST'; 
            modalForm.setAttribute('action', route);
            methodField.value = ''; 
        });
    });
});

function closeModallocal() {
    const modals = document.querySelectorAll('.sec_modal');
    modals.forEach(modal => {
        modal.style.display = 'none'; // Sembunyikan semua modal
    });
    location.reload(); // Refresh halaman
}

// Event untuk menutup modal ketika klik di luar modal
document.addEventListener('click', function (event) {
    const target = event.target;

    // Cek apakah klik terjadi di dalam modal, tombol pemicu modal, atau elemen dropdown/input
    if (
        !target.closest('.logincontainer') && 
        !target.closest('.triggermodal') && 
        !target.closest('.dropdown-menu') && 
        !target.closest('input')
    ) {
        closeModallocal(); // Panggil fungsi close modal
    }
});



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
            const namefasilCell = row.cells[2].textContent.toLowerCase();
            const kategoriCell = row.cells[3].textContent.toLowerCase();
            let match = false;
            if (searchType === 'Nama Fasilitas') {
                match = namefasilCell.includes(searchValue);
            } else if (searchType === 'Kategori') {
                match = kategoriCell.includes(searchValue);
            } else if (searchType === 'Cari Berdasarkan') {
                match =
                    namefasilCell.includes(searchValue) ||
                    kategoriCell.includes(searchValue)
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
            const dataunit = @json($dataunit);
            const datafasil = @json($datafasil);
            const datakagor = @json($datakagor);
            const datakapas = @json($datakapas);
            const datajam = @json($datajam);
            const datafoto = @json($datafoto);
            const dataicon = @json($dataicon);
            const storageUrl = "{{ env('API_BASE_URL').'/storage/img/' }}";
            if (datafasil[index] !== undefined) {
                show.querySelector('input[name="unit_nomor"]').value = dataunit[index] || '';
                show.querySelector('input[name="fasilitas"]').value = datafasil[index] || '';
                show.querySelector('h3[name="spanfasilitas"]').textContent = datafasil[index] || '';
                show.querySelector('select[name="kategori"]').value  = datakagor[index] || '';
                show.querySelector('input[name="kapasitas"]').value = datakapas[index] || '';
                show.querySelector('input[name="maxjam"]').value = datajam[index] || '';
                show.querySelector('input[name="fotogambar"]').value = datafoto[index] || '';
                show.querySelector('input[name="fotoicon"]').value = dataicon[index] || '';
                const fotoImg = show.querySelector('img[name="datafoto"]');
                if (fotoImg) {
                    fotoImg.src = storageUrl + datafoto[index] || storageUrl;
                }
                const iconImg = show.querySelector('img[name="dataicon"]');
                if (iconImg) {
                    iconImg.src = storageUrl + dataicon[index] || storageUrl;
                }
            } else {
                console.error('Index tidak valid: ' + index);
            }
        } else {
            console.error('Modal dengan target ' + target + ' tidak ditemukan.');
        }
    });
});

        //    function updateFileName(inputElement) {
        //     const label = inputElement.closest('.file-input-container').querySelector('span');
        //     if (inputElement.files.length > 0) {
        //         label.textContent = inputElement.files[0].name; 
        //     } else {
        //         label.textContent = "Tambah gambar"; 
        //     }
        // }

function updateFileName(inputElement) {
    const label = inputElement.previousElementSibling;
    const validExtensions = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/icon']; // Tipe file gambar yang valid
    let invalidFiles = 0;

    if (inputElement.files.length > 0) {

        Array.from(inputElement.files).forEach(file => {
            if (!validExtensions.includes(file.type)) {
                invalidFiles++; 
            }
        });

        if (invalidFiles > 0) {
            alert(`${invalidFiles} file bukan gambar dan tidak ditambahkan.`);
        }
        const validFileNames = Array.from(inputElement.files)
            .filter(file => validExtensions.includes(file.type))
            .map(file => file.name);

        if (validFileNames.length > 0) {
            label.textContent = validFileNames.join(', '); 
        } else {
            label.textContent = label.dataset.defaultText; 
        }
    } else {
        label.textContent = label.dataset.defaultText; 
    }
}


document.querySelectorAll('.triggermodal').forEach(trigger => {
        trigger.addEventListener('click', function (event) {
            event.preventDefault();

            // Tangkap data-index dari triggermodal
            const modalIndex = this.getAttribute('data-index');
            const modalId = this.getAttribute('data-target'); // Ambil target modal
            //console.log('Data Index dari triggermodal:', modalIndex);

            // Tambahkan atribut data-index ke modal
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.setAttribute('data-index', modalIndex);
                
                // Tambahkan data-index ke elemen-elemen terkait hanya di modal aktif
                const elementsToUpdate = [
                    'icon-container1',
                    'icon-container2',
                    'foto-container1',
                    'foto-container2',
                    'kategori-container1',
                    'kategori-container2',
                    'kategori-container3',
                    'kategori-container4',
                    'input[name="fotoicon"]',
                    'input[name="fotogambar"]',
                    'input[name="newkategori"]'
                ];

                elementsToUpdate.forEach(selector => {
                    const element = modal.querySelector(`#${selector}, ${selector}`);
                    if (element) {
                        element.setAttribute('data-index', modalIndex);
                        //console.log(`Atribut data-index "${modalIndex}" ditambahkan ke elemen ${selector}.`);
                    //} else {
                        //console.error(`Elemen "${selector}" tidak ditemukan di dalam modal "${modalId}".`);
                    }
                });
            } else {
                console.error(`Modal dengan ID "${modalId}" tidak ditemukan.`);
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('#remove-icon').forEach(removeIconButton => {
        removeIconButton.addEventListener('click', function (event) {
            event.preventDefault();
            const modalIndex = this.closest('.sec_modal').getAttribute('data-index');
            console.log('Data Index dari triggermodal:', modalIndex); // Log data-index dari triggermodal
            const iconContainer1 = document.querySelector(`#icon-container1[data-index="${modalIndex}"]`);
            const iconContainer2 = document.querySelector(`#icon-container2[data-index="${modalIndex}"]`);
            const hiddenInput1 = document.querySelector(`input[name="fotoicon"][data-index="${modalIndex}"]`);

            if (iconContainer1) {
                iconContainer1.style.display = 'none';
            }
            if (iconContainer2) {
                iconContainer2.style.display = 'block';
            }
            if (hiddenInput1) {
                hiddenInput1.value = '';
            }
        });
    });

    document.querySelectorAll('#remove-foto').forEach(removeFotoButton => {
        removeFotoButton.addEventListener('click', function (event) {
            event.preventDefault();
            const modalIndex = this.closest('.sec_modal').getAttribute('data-index');
            console.log('Data Index dari triggermodal:', modalIndex); // Log data-index dari triggermodal
            const fotoContainer1 = document.querySelector(`#foto-container1[data-index="${modalIndex}"]`);
            const fotoContainer2 = document.querySelector(`#foto-container2[data-index="${modalIndex}"]`);
            const hiddenInput2 = document.querySelector(`input[name="fotogambar"][data-index="${modalIndex}"]`);

            if (fotoContainer1) {
                fotoContainer1.style.display = 'none';
            }
            if (fotoContainer2) {
                fotoContainer2.style.display = 'block';
            }
            if (hiddenInput2) {
                hiddenInput2.value = '';
            }
        });
    });

    document.querySelectorAll('#remove-kategori').forEach(removeIconButton => {
        removeIconButton.addEventListener('click', function (event) {
            event.preventDefault();
            const modalIndex = this.closest('.sec_modal').getAttribute('data-index');
            console.log('Data Index dari triggermodal:', modalIndex); // Log data-index dari triggermodal
            const kategoriContainer1 = document.querySelector(`#kategori-container1[data-index="${modalIndex}"]`);
            const kategoriContainer2 = document.querySelector(`#kategori-container2[data-index="${modalIndex}"]`);
            const kategoriContainer3 = document.querySelector(`#kategori-container3[data-index="${modalIndex}"]`);
            const kategoriContainer4 = document.querySelector(`#kategori-container4[data-index="${modalIndex}"]`);

            if (kategoriContainer1) {
                kategoriContainer1.style.display = 'none';
                kategoriContainer3.style.display = 'none';
            }
            if (kategoriContainer2) {
                kategoriContainer2.style.display = 'flex';
                kategoriContainer4.style.display = 'flex';
            }
        });
    });

    document.querySelectorAll('#batal-kategori').forEach(BatalIconButton => {
        BatalIconButton.addEventListener('click', function (event) {
            event.preventDefault();
            const modalIndex = this.closest('.sec_modal').getAttribute('data-index');
            console.log('Data Index dari triggermodal:', modalIndex); // Log data-index dari triggermodal
            const kategoriContainer1 = document.querySelector(`#kategori-container1[data-index="${modalIndex}"]`);
            const kategoriContainer2 = document.querySelector(`#kategori-container2[data-index="${modalIndex}"]`);
            const kategoriContainer3 = document.querySelector(`#kategori-container3[data-index="${modalIndex}"]`);
            const kategoriContainer4 = document.querySelector(`#kategori-container4[data-index="${modalIndex}"]`);
            const KategoriInput = document.querySelector(`input[name="newkategori"][data-index="${modalIndex}"]`);

            // const fotoContainer1 = document.querySelector(`#foto-container1[data-index="${modalIndex}"]`);
            // const fotoContainer2 = document.querySelector(`#foto-container2[data-index="${modalIndex}"]`);
            // const hiddenInput2 = document.querySelector(`input[name="fotogambar"][data-index="${modalIndex}"]`);

            // const iconContainer1 = document.querySelector(`#icon-container1[data-index="${modalIndex}"]`);
            // const iconContainer2 = document.querySelector(`#icon-container2[data-index="${modalIndex}"]`);
            // const hiddenInput1 = document.querySelector(`input[name="fotoicon"][data-index="${modalIndex}"]`);

            if (kategoriContainer4) {
                kategoriContainer1.style.display = 'flex';
                kategoriContainer3.style.display = 'block';
                kategoriContainer2.style.display = 'none';
                kategoriContainer4.style.display = 'none';
                KategoriInput.value = '';

                // fotoContainer1.style.display = 'grid';
                // fotoContainer2.style.display = 'none';
                // hiddenInput2.value = '';

                // iconContainer1.style.display = 'grid';
                // iconContainer2.style.display = 'none';
                // hiddenInput2.value = '';

            }
        });
    });
    
});

  

</script>
@endsection