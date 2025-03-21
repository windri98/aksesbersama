
@extends('User.index')
@section('maincontent')
@include('User.layouts.headerhome')
        <div class="col">
            
            @if(Cache::has('fasilitas'))
                @foreach (Cache::get('fasilitas') as $getlink)
                    <div class="judulatas">
                        <div class="iconjudul">
                            @if (!empty($getlink["fasilitas"]['icon']))
                            <img class="fotosvg" src="{{ env('API_BASE_URL') .'/storage/img/'. $getlink["fasilitas"]['icon'] }}" alt="Result Icon">
                            @else
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                <path d="M15 19l2 2l4 -4" />
                            </svg>
                            @endif
                       
                        </div>
                            <h3 style="font-weight: 700">{{ $getlink["fasilitas"]['fasilitas'] }}</h3>  
                        <div class="bookoleh">          
                            <h3 style="font-weight: 300">Dibooking oleh</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd" d="M1 12c2.028-4.152 6.192-7 11-7s8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7m11 3.5a3.5 3.5 0 1 0 0-7a3.5 3.5 0 0 0 0 7"/>
                            </svg>
                            <a href="#" class="triggermodal" data-target="showlogin" data-index="index1">
                                <span>Lihat</span>
                                    </a>
                        </div>       
                    </div>
             
                    <div class="datatengah">
                        <h2>{{ $getlink["fasilitas"]['fasilitas'] }} {{ $getlink["fasilitas"]['unit_nomor'] }}</h2>
                        @if (!empty($getlink['fasilitas']['foto']))
                                <img class="foto" src="{{ env('API_BASE_URL') .'/storage/img/'. $getlink["fasilitas"]['foto'] }}" alt="Result Image">
                            @else
                                <img class="foto" src="/img/kamar.png" alt="gambar profile">
                        @endif
                    </div>    

                    <div class="databawah">
                        <div class="subsecbag3">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="#E4C59E"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                            <span>Max. {{ $getlink["fasilitas"]['kapasitas'] }} Orang</span>
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
                @endforeach
                @else    
                <div class="empty">
                    <span>Tidak Ada Data Fasilitas</span>
                </div>  
            @endif 
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
                    <h2 style="font-weight: 700"> Schedule</h2>  
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M1 12c2.028-4.152 6.192-7 11-7s8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7m11 3.5a3.5 3.5 0 1 0 0-7a3.5 3.5 0 0 0 0 7"/>
                        </svg>
                        <a href="#" class="triggermodal" data-target="showlogin" data-index="index1">
                            <span>Lihat</span>
                        </a>
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
            <div class="section3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m22.9 21.2l-4.1-4.1c.4-1 .2-2.3-.7-3.1c-.9-.9-2.2-1.1-3.3-.6l1.9 1.9l-1.4 1.4l-2-2c-.5 1.1-.3 2.4.6 3.4c.9.9 2.1 1.1 3.1.7l4.1 4.1c.2.2.5.2.6 0l1-1c.3-.3.3-.6.2-.7M10 12c2.2 0 4-1.8 4-4s-1.8-4-4-4s-4 1.8-4 4s1.8 4 4 4m0-6c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m3 14H2v-3c0-2.7 5.3-4 8-4c.5 0 1.2.1 1.9.2c-.4.5-.6 1.1-.8 1.8c-.4 0-.7-.1-1.1-.1c-3 0-6.1 1.5-6.1 2.1v1.1h7.6c.3.8.9 1.4 1.5 1.9"/>
                </svg>
                <h2>Keluhan Kamar Dan Pengaduan Layanan Karyawan</h2>
            </div>
            <div class="section4  overflow-scroll ">
                @if(Cache::has('reports'))
                    @foreach (array_slice(Cache::get('reports')->toArray(), 0, 10) as $getlink)
                            <div class="subsection4">
                                @if (!empty($getlink["report_images"]) && count($getlink["report_images"]) > 0)
                                @foreach ($getlink["report_images"] as $image)
                                    <img class="foto2" src="{{ env('API_BASE_URL') .'/storage/img/' . $image['image'] }}" alt="Result Image">
                                    @break
                                @endforeach
                                @else
                                    <img class="foto2" src="/img/kamar.png" alt="gambar profile">
                                @endif
                                <a href="">Keluhan {{ $getlink['room_number'] }} </a>
                               @if($getlink['status'] === "Sedang Diproses")
                               <div class="subsec4">
                                    <p class="successprogress">{{ $getlink['status'] }} </p>
                                 </div>  
                               @else
                                <div class="subsec4">
                                    <p class="onprogress">{{ $getlink['status'] }} </p>
                                </div>  
                                @endif
                            </div>     
                        @endforeach 
                    @else    
                    <div class="empty">
                        <span>Tidak Ada Data Keluhan Dan Pengaduan</span>
                    </div> 
                @endif               
            </div> 

            <div class="section5">
                <a href="#" class="triggermodal" data-target="showlogin" data-index="index1">
                    <span>Lihat Lainnya</span>
                </a>
            </div>   
    </div>
@endsection     

