@extends('user.index')
@section('maincontent')
@include('user.layouts.headeruser')


    <div class="col setcol">  
        <div class="sectionwaktu">
            <div class="subsectionwaktu">
                    <a style="float: left" href="javascript:void(0)"> 
                        <div class="subhistory selected1" onclick="toggleBOKE('Book', this)" id="Book-btn">
                        <span>Booking</span>
                        </div>
                    </a>
                    <a style="float: right;" href="javascript:void(0)"> 
                        <div class="subhistory" onclick="toggleBOKE('Kelu', this)" id="Kelu-btn">
                        <span>Keluhan</span>
                        </div>
                    </a>
            </div>

                <div id="Bookings">
                    @if (!$hasilreq2)
                        <div class="empty">
                            <span>Tidak Ada Data Booking</span>
                        </div>
                        @else 
                            <table>
                                <thead>
                                    <tr class="head_table">
                                        <th style="width: clamp(20%, 25%, 30%)">Date</th>
                                        <th style="width: clamp(30%, 35%, 40%)">Time</th>
                                        <th style="width: clamp(20%, 30%, 30%)">Fasilitas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hasilreq2 as $getlink)
                                        <tr>
                                            <td><span>{{ \Carbon\Carbon::parse( $getlink['date'])->format('d-m-Y')}}</span></td>
                                            @if ($getlink['start_time'] === "AM" || $getlink['start_time'] === "PM")
                                            <td><span>{{ $getlink['start_time']}} </span></td>
                                            @else
                                            <td><span>{{ \Carbon\Carbon::parse($getlink['start_time'])->format('H:i')}} Wib - {{ \Carbon\Carbon::parse($getlink['end_time'])->format('H:i')}} Wib</span></td>
                                            @endif
                                            <td><span>{{ $getlink['fasilitas']['fasilitas'] }} {{ $getlink['fasilitas']['unit_nomor'] }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif    
                    </div>    

                <div id="Keluhans" class="hidden">
                @if (!$hasilreq1)
                    <div class="empty">
                        <span>Tidak Ada Data Booking</span>
                    </div>
                    @else       
                            <table>
                                <thead>
                                    <tr class="head_table">
                                        <th style="width: clamp(20%, 25%, 30%)">Date</th>
                                        <th style="width: clamp(30%, 35%, 40%)">Time</th>
                                        <th style="width: clamp(20%, 30%, 30%)">Keluahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hasilreq1 as $getlink)
                                        <tr>
                                            <td><span>{{ \Carbon\Carbon::parse( $getlink['created_at'])->format('d-m-Y')}}</span></td>
                                            <td><span>{{ \Carbon\Carbon::parse($getlink['created_at'])->format('H:i')}} Wib</span></td>
                                            <td style="text-align: start"><span>{{ $getlink['kategori']}}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    @endif
                </div>
            </div>
    </div>
@endsection
