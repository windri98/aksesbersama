{{-- @extends('index')
@section('maincontent') --}}
{{-- @include('layouts.headeruser')
@include('layouts.sidebar') --}}
<div id="pencarian" class="panel panel-right">
    <div class="navbar"  >
        <div class="secnavbar">
            <a href="javascript:void(0)" id="closepencarian"><div class="logopencarian">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M11.884 6.116a1.25 1.25 0 0 0-1.768 0l-5 5a1.25 1.25 0 0 0 0 1.768l5 5a1.25 1.25 0 0 0 1.768-1.768L9.018 13.25H18a1.25 1.25 0 1 0 0-2.5H9.018l2.866-2.866a1.25 1.25 0 0 0 0-1.768"/>
                </svg>
            </div></a>
            <div class="logomasuk grubsearchtable">
               <input type="search" id="searchData1-fasilitas" placeholder="Cari Fasilitas">
            </div>
        </div>
    </div>

        <div class="setcol"> 
         
            @if(!Cache::has('fasilitas'))
                <div class="empty">
                    <span>Tidak Ada Data Fasilitas</span>
                </div>
                @else       
                @foreach (Cache::get('fasilitas') as $getlink)
                <a href="{{ route ('bookingfasilitas',['id' => $getlink["fasilitas"]['id_fasilitas']]) }}"><div class="sectionresult" > 
                           <div class="subsectionresult">
                                <h2 class="fasilitas">{{ $getlink["fasilitas"]['fasilitas']}}  {{ $getlink["fasilitas"]['unit_nomor'] }}</h2>
                                <div class="subsecbag2">
                                    <div class="subsecbag1">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="#E4C59E"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        </svg>
                                            <span>Max. {{ $getlink["fasilitas"]['kapasitas'] }} Orang</span>
                                    </div>
                                    <div class="subsecbag1">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="#E4C59E"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M4 20h14" />
                                        </svg>
                                            <span>Total Digunakan : {{ $getlink["total_booking"]}}</span>
                                    </div>
                                </div> 
                                <div class="subsecbag1">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="#E4C59E"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-corner-down-right">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M6 6v6a3 3 0 0 0 3 3h10l-4 -4m0 8l4 -4" />
                                    </svg> 
                                    <div  class="huruf">
                                        <span>Terakhir digunakan oleh : {{ $getlink["last_booking"]["username"] ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($getlink['fasilitas']['foto']))
                                <img class="img-preview" src="{{ env('API_BASE_URL') .'/storage/img/'. $getlink['fasilitas']['foto'] }}" alt="Report Image">
                                @else
                            <img class="img-preview" src="/img/kamar.png" alt="gambar profile">
                        @endif
                    </div></a>
                @endforeach   
            @endif
        </div>
</div>
