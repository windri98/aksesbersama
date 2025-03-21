@extends('User.index')
@section('maincontent')
@include('User.layouts.headerbackuser')
@if (!$hasilreq1)
    <div class="col setcol">
        <div class="empty">
            <span>Tidak Ada Data Fasilitas</span>
        </div>
    </div>
    @else   
        <div class="col">
            <div class="secfasilitas">
                <div class="section4  overflow-scroll scroll-content ">
                    @php
                        $fasilitasDisplayed = [];
                    @endphp
                    @foreach ($hasilreq1 as $getlink)
                    @if (count($hasilreq1)=== 1)
                    <a style="width: 100%" id="searchData2-kategori" href="javascript:void(0)"> <div style="width: 100%" class="buttonlog setbutton" onclick="toggleSelectKategori(this)">
                        <span >{{ $getlink['fasilitas']['fasilitas'] }}</span>
                    </div></a>
                    @else
                        @if (!in_array($getlink['fasilitas']['fasilitas'], $fasilitasDisplayed))
                            <a id="searchData2-kategori" href="javascript:void(0)"> <div class="buttonlog setbutton" onclick="toggleSelectKategori(this)">
                                <span >{{ $getlink['fasilitas']['fasilitas'] }}</span>
                            </div></a>
                            @php
                            $fasilitasDisplayed[] = $getlink['fasilitas']['fasilitas'];
                            @endphp
                        @endif
                    @endif
                    @endforeach
                 
                </div>
            </div>
        </div>

        <div class="col setcol">
            @foreach ($hasilreq1 as $getlink)
            <a href="{{ route ('bookingfasilitas',['id' => $getlink["fasilitas"]['id_fasilitas']]) }}">
            <div class="sectionkategori">
                <div class="datatengah">
                    <h2 class="kategori">{{ $getlink['fasilitas']['fasilitas']   }} {{ $getlink['fasilitas']['unit_nomor'] }}</h2>
                    <img class="foto" src="{{ env('API_BASE_URL') .'/storage/img/'. $getlink['fasilitas']['foto'] }}" alt="Result Image">
                </div>    

                <div class="databawah">
                    <div class="subsecbag3">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="#E4C59E"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                        <span>Max. {{ $getlink['fasilitas'] ['kapasitas'] }} Orang</span>
                    </div>

                    <div class="subsecbag3">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="#E4C59E"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M4 20h14" />
                        </svg>
                        <span>Total Digunakan : {{ $getlink["total_booking"]}}</span>
                    </div>
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="#E4C59E"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-down-right">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 6v6a3 3 0 0 0 3 3h10l-4 -4m0 8l4 -4" />
                    </svg>
                   <div  class="huruf">
                        <span>Terakhir digunakan oleh : {{ $getlink["last_booking"]["username"] ?? '-' }}</span>
                    </div>
                </div>
            </div>
            </a>
            @endforeach 
        </div>
    @endif 
<script>
    function toggleSelectKategori(element) {
    document.querySelectorAll('.buttonlog.setbutton').forEach(btn => {
        
        btn.classList.remove('selected');
    });

    element.classList.add('selected');
}
</script>
@endsection  
