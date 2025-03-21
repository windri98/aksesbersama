@extends('User.index')
@section('maincontent')
@include('User.layouts.headeruser')

    <div class="col setcol">  
        <div class="sedbook">
            <div class="subsectionprogress setsubsecpro">
                @foreach ($hasilreq4 as $getlink)
                    <div class="subprogress">
                        <div class="sublaptprogress setsublapt">
                        <div class="jadwalicon ">
                            @if (!empty($getlink['fasilitas']['foto']))
                            <img class="seticon" src="{{ env('API_BASE_URL') .'/storage/img/'. $getlink['fasilitas']['foto'] }}" alt="Report Image">
                            @else
                            <img class="seticon" src="/img/icon-aksesbersama_0.png" alt="">
                            @endif
                        </div>
                        <div class="subjadwalfasilitas">
                            <span style="font-size: 14px; font-weight: 600;">{{ $getlink['fasilitas']['fasilitas'] }} {{ $getlink['fasilitas']['unit_nomor'] }}</span>
                            <div class="subjadwaldatefasilitas">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($getlink['date'])->translatedFormat('d F Y')}}  </span>
                            </div>  
                            <div class="subjadwaldatefasilitas">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0-18 0"/>
                                    <path d="M12 7v5l3 3"/></g>
                                </svg>
                                @if ($getlink['start_time'] === "AM" || $getlink['start_time'] === "PM")
                                <span>{{ $getlink['start_time']}} </span>
                                @else
                                <span>{{ \Carbon\Carbon::parse($getlink['start_time'])->format('H:i')}} Wib</span>
                                @endif
                            </div>
                        </div>
                        <div class="subjadwaledit">
                            @if($getlink['status'] === "pending")  
                            <div class="subjadwaleditstatus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0-18 0m9 0l-3 2m3-7v5"/>
                                </svg>
                                    <span>Pending</span>
                            </div>
                            @elseif ($getlink['status'] === "berhasil") 
                            <div class="subjadwaleditstatus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M17 3.34a10 10 0 1 1-14.995 8.984L2 12l.005-.324A10 10 0 0 1 17 3.34m-1.293 5.953a1 1 0 0 0-1.32-.083l-.094.083L11 12.585l-1.293-1.292l-.094-.083a1 1 0 0 0-1.403 1.403l.083.094l2 2l.094.083a1 1 0 0 0 1.226 0l.094-.083l4-4l.083-.094a1 1 0 0 0-.083-1.32"/>
                                </svg>
                                    <span>Berhasil</span>
                            </div>
                            @elseif ($getlink['status'] === "ditolak") 
                            <div class="subjadwaleditstatus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                ><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1-19.995.324L2 12l.004-.28C2.152 6.327 6.57 2 12 2m.01 13l-.127.007a1 1 0 0 0 0 1.986L12 17l.127-.007a1 1 0 0 0 0-1.986zM12 7a1 1 0 0 0-.993.883L11 8v4l.007.117a1 1 0 0 0 1.986 0L13 12V8l-.007-.117A1 1 0 0 0 12 7"/>
                                </svg>
                                    <span>Ditolak</span>
                            </div>
                            @endif
                            <div class="subjadwaleditdelete">
                            <a href="{{ route('editjadwal', [
                            'id' => $getlink['id_booking']
                            ]) }}">  
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"/>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3"/></g>
                                    </svg>
                                </a>
                        
                                <a href="{{ route('deletebooking', [
                                'id' => $getlink['id_booking']
                                ]) }}" onclick="handleClick(event, this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection    