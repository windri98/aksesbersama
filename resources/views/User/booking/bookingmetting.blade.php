@extends('User.index')
@section('maincontent')
@include('User.layouts.headerbackuser')
   
        <div class="col">
                <div class="datatengah">
                    <img class="foto" src="{{ env('API_BASE_URL') .'/storage/img/'. $hasilreq1['fasilitas']['foto'] }}" alt="Report Image">
                </div>    

                <div class="section2">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 4a6 6 0 1 0 0 12a6 6 0 0 0 0-12m0 1.75a2.5 2.5 0 0 1 1.88 4.148c.565.456.92 1.117.92 1.852c0 1.38-1.254 2.5-2.8 2.5s-2.8-1.12-2.8-2.5c0-.735.355-1.396.92-1.853A2.5 2.5 0 0 1 12 7.75m0 5c-.754 0-1.3.488-1.3 1s.547 1 1.3 1c.754 0 1.3-.488 1.3-1s-.546-1-1.3-1m0-3.5a1 1 0 1 0 0 2a1 1 0 0 0 0-2"/>
                    </svg> --}}
                    <img class="fotosvg" src="{{ env('API_BASE_URL') .'/storage/img/'. $hasilreq1['fasilitas']["icon"] }}" alt="Report Image">
                    <h2 style="font-weight: 400"> {{ $hasilreq1['fasilitas']['fasilitas']}} {{ $hasilreq1['fasilitas']['unit_nomor'] }}</h2>   
                {{-- </div>
        
                <div class="section2bag1"> --}}
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="#E4C59E"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                        <span>Max. {{ $hasilreq1['fasilitas']['kapasitas'] }} Orang</span>
                </div>
        </div>

            <div class="col">
                <div class="section2">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M7 14h.013" />
                        <path d="M10.01 14h.005" />
                        <path d="M13.01 14h.005" />
                        <path d="M16.015 14h.005" />
                        <path d="M13.015 17h.005" />
                        <path d="M7.01 17h.005" />
                        <path d="M10.01 17h.005" />
                    </svg>
                    <h2 style="font-weight: 700"> Tentukan Tanggal</h2>   
                </div>

                <form>
                <div class="subsection2">
                        <div  class="datetimepicker" id="datetimepicker1">
                            <input type="hidden"  >
                        </div>
                        <div  class="datetimepicker" id="datetimepicker2">
                            <input type="hidden"  >
                        </div> 
                </div>
            </form>
        </div>
        <div class="col">  
            <div class="sectiondetailbook">
                <div class="section2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M11.795 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4"/>
                        <path d="M14 18a4 4 0 1 0 8 0a4 4 0 1 0-8 0m1-15v4M7 3v4m-4 4h16"/>
                        <path d="M18 16.496V18l1 1"/></g>
                    </svg>
                        <h2>Detail Booking</h2>
                </div>
                <div class="subsectiondelbook">
                    <div class="subsectionjudul">
                        <h3>Pilih Tanggal</h3>
                    </div>
                    <h4>Fasilitas yang dibooking : {{ $hasilreq1['fasilitas']['fasilitas'] }}</h4>
                    <div class="detailjam-container">
                    </div>
                </div>                
            </div>
        </div>
    <div class="col">  
        <div class="sectionwaktu">
            <div class="section2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M17 3.34a10 10 0 1 1-14.995 8.984L2 12l.005-.324A10 10 0 0 1 17 3.34M12 6a1 1 0 0 0-.993.883L11 7v5l.009.131a1 1 0 0 0 .197.477l.087.1l3 3l.094.082a1 1 0 0 0 1.226 0l.094-.083l.083-.094a1 1 0 0 0 0-1.226l-.083-.094L13 11.585V7l-.007-.117A1 1 0 0 0 12 6"/>
                </svg>
                    <h2>Tentukan Waktu</h2>
            </div>
                <div class="subsectionwaktu">
                    <a style="float: left" href="javascript:void(0)"> 
                        <div class="subwaktujdl" onclick="toggleAMPM1('AM', this)">
                        <span>AM</span>
                        </div>
                    </a>
                    <a style="float: right;" href="javascript:void(0)"> 
                        <div class="subwaktujdl" onclick="toggleAMPM1('PM', this)">
                        <span>PM</span>
                        </div>
                    </a>
                </div>

                    <button class="buttonbook triggermodal" data-target="showbooking" data-index="index6" data-route="{{ route('createmetting', ['id' => $hasilreq1['fasilitas']['id_fasilitas']]) }}" onclick="getSelectedValues()">Booking Sekarang</button>

            </div>
        </div>
@include('User.layouts.confirm1')            
        <script>
        const apiBaseUrl = "{{ env('API_BASE_URL') }}";
           let idFasilitas;
     
            document.addEventListener("DOMContentLoaded", function () {
   
                idFasilitas = {{ $hasilreq1['fasilitas']['id_fasilitas'] ?? 'null' }};
           
            });
            
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
        </script>
        <script src="/js/datetime.js"></script>        
@endsection  
