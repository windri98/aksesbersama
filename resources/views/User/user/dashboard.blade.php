@extends('User.index')
@section('maincontent')
@include('User.layouts.headeruser')

        <div class="col">
            <div class="sedbook">
                <img src="/img/banner.png" alt="gambar lotto21">
            </div>
        </div>
        <div class="col">  
          
            <div class="sectionprogress">
                    <div class="section2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M6.5 7h11M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1"/>
                        <path d="M6 4v2a6 6 0 1 0 12 0V4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1"/></g>
                    </svg>
                        <h2>Progress Pengaduan</h2>
                        <div class="secnavreport">
                            <a href="#" id="toggleReport"><div class="buttonlog">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><g fill="none">
                                <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                                <path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g>
                            </svg>         
                                    <span>Report / Keluhan Kamar</span>
                            </div></a>
                        </div>
                    </div>   
       
            @if (empty($reports))
                <div class="empty">
                    <span>Tidak Ada Data Report</span>
                    </div>
                        @else 
                <div class="subsectionprogress overflow-y-scroll">
                @foreach ($reports as $getlink)

                    <div class="subprogress setsubprogress">
                        <div class="subjadwalprogress">
                            
                        @if (!empty($getlink['reportImages'][0]['image']))
                            <img src="{{ env('API_BASE_URL') .'/storage/img/'. $getlink['reportImages'][0]['image'] }}" alt="Report Image">
                            @else
                            <img src="/img/kamar.png" alt="gambar profile">
                        @endif
                        </div>
                        <div class="subjadwalfasilitas setsubjadwal">
                            <span style="font-size: 16px; font-weight: 600;">{{ $getlink['room_number'] }} | {{ $getlink['keterangan'] }}</span>
                            <div class="sedbookdateprofil">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($getlink['created_at'])->translatedFormat('d-m-Y')}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2.5 2.5"/>
                                    <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z"/></g>
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($getlink['created_at'])->format('H:i')}} wib</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10m6-10a6 6 0 0 1-12 0h6V6a6 6 0 0 1 6 6"/>
                                </svg>
                                <span>{{ $getlink['status'] }}</span>
                            </div>  
                            </div>
                    
                            <a href="{{ route('detailreport', [
                                    'id' => $getlink['id']
                                    ]) }}" >
                                    <div class="buttonlog setbuttonlog">     
                                <span>Details</span>
                        </div></a>
                    </div>
                @endforeach
                </div>
                @endif
            </div>
        </div>
            <div class="col"> 
                <div class="sedbook">
                    <div class="section2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M12 20H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h12v5"/>
                        <path d="M13 16H6a2 2 0 0 0-2 2m11 1l3 3l3-3m-3 3v-9"/></g>
                    </svg>
                    <h2>Sedang dibooking</h2> 
                    </div>

        @if(!Cache::has('merged-bookings'))
            <div class="empty">
                <span>Tidak Ada Data Booking</span>
            </div>
        @else                 
            <div class="sedbooksect2">
                <div class="sedbooksect1">
                    @foreach (Cache::get('merged-bookings') as $getlink)
         
                        <div class="sedbooksubsect1">
                            <div class="sedbooksubsect2">
                                <div class="sedbookconprofil">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="#171717" d="M12 11.385q-1.237 0-2.119-.882T9 8.385t.881-2.12T12 5.386t2.119.88t.881 2.12t-.881 2.118t-2.119.882m-7 7.23V16.97q0-.619.36-1.158q.361-.54.97-.838q1.416-.679 2.834-1.018q1.417-.34 2.836-.34t2.837.34t2.832 1.018q.61.298.97.838q.361.539.361 1.158v1.646z"/>
                                    </svg>
                                    <span style="font-size: 14px; font-weight: 700;">{{ $getlink['booking']['fasilitas']['fasilitas'] }}  {{ $getlink['booking']['fasilitas']['unit_nomor'] }}</span>
                                    <span style="font-size: 12px;  font-weight: 400;">Dibooking Oleh : <Span style="font-size: 12px;  font-weight: 400; color: #CAA16E;">{{ $getlink['booking']['username'] }} </Span> </span>
                                </div>   
                                <div class="sedbookdateprofil setseddateprofil">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($getlink['booking']['date'])->translatedFormat('d F Y')}}  </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2.5 2.5"/>
                                        <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z"/></g>
                                    </svg>
                                    @if ($getlink['booking']['start_time'] === "AM" || $getlink['booking']['start_time'] === "PM")
                                    <span>{{ $getlink['booking']['start_time']}} </span>
                                    @else
                                    <span>{{ \Carbon\Carbon::parse($getlink['booking']['start_time'])->format('H:i')}} wib</span>
                                    @endif
                                </div>  
                            </div>     
                        </div>   
                    @endforeach
                </div>   
                    <div  class="sedbooksect1">
                        @foreach (Cache::get('merged-bookings') as $getlink)
                            <div class="sedbooksubsect1">
                                <div class="sedbooksubsect2">
                                    <div class="sedbookconprofil">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="#171717" d="M12 11.385q-1.237 0-2.119-.882T9 8.385t.881-2.12T12 5.386t2.119.88t.881 2.12t-.881 2.118t-2.119.882m-7 7.23V16.97q0-.619.36-1.158q.361-.54.97-.838q1.416-.679 2.834-1.018q1.417-.34 2.836-.34t2.837.34t2.832 1.018q.61.298.97.838q.361.539.361 1.158v1.646z"/>
                                        </svg>
                                        <span style="font-size: 14px; font-weight: 700;">{{ $getlink['booking']['fasilitas']['fasilitas'] }}  {{ $getlink['booking']['fasilitas']['unit_nomor'] }}</span>
                                        <span style="font-size: 12px;  font-weight: 400;">Dibooking Oleh : <Span style="font-size: 12px;  font-weight: 400; color: #CAA16E;">{{ $getlink['booking']['username'] }} </Span> </span>
                                    </div>   
                                    <div class="sedbookdateprofil setseddateprofil">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($getlink['booking']['date'])->translatedFormat('d F Y')}}  </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2.5 2.5"/>
                                            <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z"/></g>
                                        </svg>
                                        @if ($getlink['booking']['start_time'] === "AM" || $getlink['booking']['start_time'] === "PM")
                                        <span>{{ $getlink['booking']['start_time']}} </span>
                                        @else
                                        <span>{{ \Carbon\Carbon::parse($getlink['booking']['start_time'])->format('H:i')}} wib</span>
                                        @endif
                                    </div>  
                                </div>     
                            </div>   
                        @endforeach
                    </div> 
                </div> 
            @endif
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
                    <h2 style="font-weight: 700"> Jadwal Booking</h2>   
                </div>

                <form>
                <div class="subsection2">
                        <div  class="datetimepicker" id="datetimecutompicker1" >
                            <input type="hidden"  >
                        </div>
                        <div  class="datetimepicker" id="datetimecutompicker2">
                            <input type="hidden"  > 
                        </div>
                        @include('User.layouts.modaldate')     
                </div>
            </form>  
        </div>

        
        <div class="col">  
            <div class="sectionfasilitas">
                    <div class="section2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M9 8h1m-1 4h1m-1 4h1m4-8h1m-1 4h1m-1 4h1M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>
                        </svg>
                        <h2>Fasilitas Tersedia</h2>
                    </div>
                 
                    <div class="section4  overflow-scroll scroll-content ">
                        
                        @if(!Cache::has('fasilitas'))
                            <div class="empty">
                                <span>Tidak Ada Data Fasilitas</span>
                            </div>
                            @else       
                            @foreach (Cache::get('fasilitas') as $getlink)
                                <div class="subsectionfasilitas">
                                    @if (!empty($getlink['fasilitas']['foto']))
                                        <img src="{{ env('API_BASE_URL') .'/storage/img/'. $getlink['fasilitas']['foto'] }}" alt="Report Image">
                                        @else
                                        <img src="/img/kamar.png" alt="gambar profile">
                                    @endif
                                    <h3>{{ $getlink["fasilitas"]['fasilitas']}}  {{ $getlink["fasilitas"]['unit_nomor'] }}</h2>
                                    <div class="subsectionfasilitas1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z"/>
                                        </svg>
                                        <span>Max : {{ $getlink["fasilitas"]['kapasitas'] }} Orang</span>
                                    </div>
                                    <div class="usersecfasilitas">
                                        <span>Terakhir Digunakan Oleh :</span>
                                        <span>{{ $getlink["last_booking"]['username'] ?? '-'  }}</span>
                                    </div>      
                                    <a href="{{ route ('bookingfasilitas',['id' => $getlink["fasilitas"]['id_fasilitas']]) }}"><div class="btnsecfasilitas" >
                                        <span>Booking</span>
                                    </div></a>
                                </div>   
                            @endforeach
                        @endif    
                        </div>   
                    </div>    
                </div>

    <div class="col">  
        <div class="sectionjadwal">
            <div class="secnavbar">
                <div class="section2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4.5M16 3v4M8 3v4m-4 4h16m-3 6a2 2 0 1 0 4 0a2 2 0 1 0-4 0m5 5a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2"/>
                    </svg>
                    <h2>Jadwal Saya</h2>
                </div>
                    <a href="{{ route('jadwalsaya') }}" ><div class="buttonlog">     
                                <span>Lihat Semua</span>
                        </div></a>
                </div>

        @if (!empty($bookingsaya))
            <div class="subsectionjadwal">
                    @foreach (array_slice($bookingsaya->toArray(), 0, 4) as $getlink)
                   
                    <div class="subjadwal">
                        <div class="subjadwalicon">
                            @if (!empty($getlink['fasilitas']['foto']))
                            <img src="{{ env('API_BASE_URL') .'/storage/img/'. $getlink['fasilitas']['foto'] }}" alt="Report Image">
                            @else
                            <img src="/img/kamar.png" alt="gambar profile">
                            @endif
                        </div>
                        <div class="subjadwalfasilitas">
                            <span style="font-size: 14px; font-weight: 700;">{{ $getlink['fasilitas']['fasilitas'] }} {{ $getlink['fasilitas']['unit_nomor'] }}</span>
                            <div class="subjadwaldatefasilitas">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($getlink['date'])->translatedFormat('d F Y')}}  </span>
                            </div>  
                        </div>
                    </div>
                @endforeach
            </div>
            @else 
            <div class="empty">
                <span>Tidak Ada Data Booking</span>
            </div>
            @endif
        </div>
    </div>

   
    <script>
        
    document.addEventListener("DOMContentLoaded", function () {
    const datetimePicker1 = document.querySelector('#datetimecutompicker1');
    const datetimePicker2 = document.querySelector('#datetimecutompicker2');
    const apiBaseUrl = "{{ env('API_BASE_URL') }}";
    
    let globalDatesWithData = []; 
    const idFasilitas = 1;

    async function fetchUnavailableDates(apiUrl) {
        try {
            const response = await fetch(apiUrl);
            if (response.ok) {
                const { unavailable_dates } = await response.json();

                globalDatesWithData = unavailable_dates || [];

                colorDatesWithData(globalDatesWithData);

                return unavailable_dates || [];
            } else {
                console.error("Gagal mendapatkan unavailable dates:", response.status);
                return [];
            }
        } catch (error) {
            console.error("Error fetching unavailable dates:", error);
            return [];
        }
    }
 
    function colorDatesWithData(datesWithData) {
        const dateCounts = datesWithData.reduce((counts, date) => {
            counts[date] = (counts[date] || 0) + 1;
            return counts;
        }, {});

        setTimeout(() => {
            const flatpickrDays = document.querySelectorAll(".flatpickr-day");
            if (!flatpickrDays || flatpickrDays.length === 0) {
                console.warn("Elemen flatpickr-day tidak ditemukan.");
                return;
            }

            flatpickrDays.forEach(dayElement => {
                const ariaLabel = dayElement.getAttribute("aria-label");
                if (!ariaLabel) return;

                const dayDate = new Date(ariaLabel).toLocaleDateString('en-CA');

                if (dateCounts[dayDate]) {
                    dayElement.classList.add("highlighted-date"); 
                }
            });
        }, 100);
    }

function closeModalIfClickedOutside(event) {
    const modal = document.getElementById("showmodaldate");
    if (modal && !modal.contains(event.target) && !datetimePicker1.contains(event.target) && !datetimePicker2.contains(event.target)) {
        modal.style.display = "none";
    }
}
document.addEventListener("click", closeModalIfClickedOutside);


const picker1 = flatpickr(datetimePicker1, {
    dateFormat: "Y-m-d",
    inline: true,
    minDate: "today",

    onChange: function (selectedDates, dateStr, instance) {
        if (dateStr) {
            //console.log(dateStr);
            selectedDate = dateStr;
            picker2.clear();
            const clickedElement = document.querySelector(
                `.flatpickr-day[aria-label="${new Date(dateStr).toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric',
                })}"]`
            );
            //console.log(clickedElement);

            fetchBookingsByDate(dateStr, 1, clickedElement, datetimePicker1);
        }
        colorDatesWithData(globalDatesWithData);
    },

    onReady: async function () {
        const unavailableDates = await fetchUnavailableDates(
            `${apiBaseUrl}/fetch-unavailable-times`
        );
        globalDatesWithData = unavailableDates;
        colorDatesWithData(globalDatesWithData);
        //console.log("render");

        const flatpickrDays = document.querySelectorAll(".flatpickr-day");
        //console.log(flatpickrDays.length);

        flatpickrDays.forEach((day) => {
            //console.log(day);

            day.addEventListener("click", function (event) {
                //console.log(day);
                handleDateClick(day, datetimePicker1);
            });
        });
    }
});


const picker2 = flatpickr(datetimePicker2, {
    dateFormat: "Y-m-d",
    inline: true,
    minDate: new Date(new Date().setMonth(new Date().getMonth() + 1)).setDate(1),

    onChange: function (selectedDates, dateStr, instance) {
        if (dateStr) {
            selectedDate = dateStr;
            picker1.clear(); 
            //console.log(dateStr);
            const clickedElement = document.querySelector(
                `.flatpickr-day[aria-label="${new Date(dateStr).toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric',
                })}"]`
            );
            //console.log(clickedElement);

            fetchBookingsByDate(dateStr, 1, clickedElement, datetimePicker1);
        }
        colorDatesWithData(globalDatesWithData);
    },

    onReady: async function () {
        const unavailableDates = await fetchUnavailableDates(
            `${apiBaseUrl}/fetch-unavailable-times`
        );
        globalDatesWithData = unavailableDates;
        colorDatesWithData(globalDatesWithData);
        //console.log("untuk picker2.");

        const flatpickrDays = document.querySelectorAll("#datetimecutompicker2 .flatpickr-day");
        //console.log(flatpickrDays.length);

        flatpickrDays.forEach((day) => {
            //console.log(day);

            day.addEventListener("click", function (event) {
                //console.log(day);

                handleDateClick(day, datetimePicker2);
            });
        });
    }
});

function handleDateClick(dayElement, container) {
    if (dayElement && dayElement.classList.contains("flatpickr-day")) {
        const date = dayElement.getAttribute("aria-label");
        //console.log(dayElement);

        if (date) {
            fetchBookingsByDate(date, 1, dayElement, container);
        } else {
            console.error("Atribut aria-label tidak ditemukan.");
        }
    } else {
        console.error("Elemen bukan bagian dari Flatpickr atau elemen yang diklik tidak ditemukan.");
    }
}

async function fetchBookingsByDate(date, idFasilitas, clickedElement, container) {
    try {
        //console.log(date, idFasilitas, clickedElement, container);
        const response = await fetch(
            `${apiBaseUrl}/myriquesbeliar?date=${date}&id_fasilitas=${idFasilitas}`
        );
        
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        //console.log(data);

        const groupedData = groupBookingsByID(data.bookings);
        const modal = document.getElementById("showmodaldate");
        const modalContent = modal.querySelector(".formmodaldate");

        if (!groupedData || Object.keys(groupedData).length === 0) {
            //console.warn("Grouped data is empty. Hiding modal.");
            modal.style.display = "none";
            return;
        }

        if (modalContent) {
            modalContent.innerHTML = generateBookingHTML(groupedData);

            if (clickedElement) {
                const rect = clickedElement.getBoundingClientRect();
                const containerRect = container.getBoundingClientRect();
                const topOffset = rect.top - containerRect.top + container.scrollTop + clickedElement.offsetHeight;
                const leftOffset = rect.left - containerRect.left + container.scrollLeft;
              
                if (container === datetimePicker1) {
                modal.style.top = `${topOffset + 121}px`; 
                modal.style.left = `${leftOffset - 20}px`;
            } else if (container === datetimePicker2) {
                modal.style.top = `${topOffset + 121}px`;
                modal.style.left = `${leftOffset - 225}px`;
            }

            } else {
                modal.style.top = `205px`;
            }

            modal.style.position = "absolute";
            modal.style.display = "block";
        } else {
            console.error("Modal content area not found.");
        }
    } catch (error) {
        console.error("Error fetching bookings:", error);
    }
}

function groupBookingsByID(bookings) {
    return bookings.reduce((groups, booking) => {
        const id = booking.nama;
        if (!groups[id]) {
            groups[id] = [];
        }
        groups[id].push({
            time: booking.time,
            username: booking.username,
            status: booking.status
        });
        return groups;
    }, {});
}

function generateBookingHTML(groupedData) {
    return Object.keys(groupedData)
        .map(id => {
            const bookings = groupedData[id]
                .map(
                    booking => `
                    <div class="detailbooking">
                        <span>${booking.time}</span>
                        <span> | Dibooking Oleh: ${booking.username}</span>
                        <span> | Status: ${booking.status}</span>
                    </div>`
                )
                .join('');
            return `<div><h3 style = "text-decoration: underline">Fasilitas: ${id}</h3>${bookings}</div>`;
        })
        .join('');
}

});

</script>
        
@endsection    
