@extends('User.index')
@section('maincontent')
@include('User.layouts.headerbackuser')
@include('User.layouts.showImg')
        <div class="col setcol">
            <div class="ubahpas">
                <div class="datatengah">
                    @if (!empty($hasilreq1['reportImages'][0]['image']))
                    <img class="foto" src="{{ env('API_BASE_URL') .'/storage/img/'. $hasilreq1['reportImages'][0]['image']  }}" alt="Report Image">
                        @else
                            <img class="foto" src="/img/kamar.png" alt="gambar profile">
                            @endif
                        <div class="sedbookdateprofil">
                            <span>Status Saat ini</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10m6-10a6 6 0 0 1-12 0h6V6a6 6 0 0 1 6 6"/>
                            </svg>
                            <span>{{ $hasilreq1['status'] }}</span>  
                        </div>
                </div> 
                    <div class="list_form">
                        <span>Kategori / Pengaduan terkait</span>
                        <input type="text" id="" name="web" value="{{ $hasilreq1['kategori'] }}" readonly>
                    </div>
                    <div class="list_form">
                        <span>Tanggal Pengaduan</span>
                        <input type="text" id="" name="web" value="{{ \Carbon\Carbon::parse($hasilreq1['created_at'])->format('d-m-Y') }}" readonly>
                    </div>
                    <div class="list_form">
                        <span>Keterangan</span>
                        <div class="list_formbook">
                            <textarea style="height: 120px" name="link" id="" cols="30" rows="1" readonly>{{ $hasilreq1['keterangan'] }}</textarea>
                        </div>
                    </div>
                    <div class="list_form">
                        <span>Lampiran1</span>
                            <div class="img_form overflow-scroll" >
                        <div  id="image-preview-container" > 
                            @php
                            $dataimg = [];
                            @endphp
                            @foreach ($hasilreq1['reportImages'] as $image) 
                            <a href="#" class="triggermodal trigger-galery-modal" data-target="showImg" data-index="{{ $loop->index }}">
                            <img class="img-preview"style="max-width: 150px; margin: 5px;" src="{{ env('API_BASE_URL') .'/storage/img/'. $image['image'] }}" alt="Report Image">
                            </a>
                            @php
                            $dataimg[] = env('API_BASE_URL') .'/storage/img/'. $image['image'];
                            @endphp
                            @endforeach  

                        </div>
                            </div>
                        </div>
                    </div>
            </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dataimg = @json($dataimg); 
    const modal = document.getElementById('showImg'); 
    const imgElement = modal.querySelector('img[name="img"]');
    let currentIndex = 0; 
 
    document.querySelectorAll('.triggermodal').forEach(button => {
        button.addEventListener('click', function () {
            event.preventDefault();

            currentIndex = parseInt(this.getAttribute('data-index'), 10);

            if (dataimg.length > 0) {
                if (currentIndex >= 0 && dataimg[currentIndex]) {
                    imgElement.src = dataimg[currentIndex];
                } else {
                    console.error('Index tidak valid atau gambar tidak ditemukan.');
                }
                modal.style.display = 'block';
            } else {
                console.error('Tidak ada data gambar yang tersedia.');
            }
        });
    });

    document.getElementById('nextImg').addEventListener('click', function () {
        if (dataimg.length > 0) {
            event.preventDefault();
            currentIndex = (currentIndex + 1) % dataimg.length;
            imgElement.src = dataimg[currentIndex];
        }
    });
    
    document.getElementById('prevImg').addEventListener('click', function () {
        if (dataimg.length > 0) {
            event.preventDefault();
            currentIndex = (currentIndex - 1 + dataimg.length) % dataimg.length; 
            imgElement.src = dataimg[currentIndex];
        }
    });
});

</script>           
@endsection    