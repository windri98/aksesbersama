@extends('Admin.dashboard.index')

@section('content')
    
    <div class="cardBox">

        <a href="{{ route('kelolabooking') }}"><div class="card">
            <div>
                <div class="numbers">{{ $totals['total_booking'] }}</div>
                <div class="cardName">Total Booking</div>
            </div>
            <div class="iconBx">
                <svg width="26" height="30" viewBox="0 0 26 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.3334 21.5718V12.3332C24.3334 7.30517 24.3334 4.7905 22.7707 3.22917C21.208 1.66784 18.6947 1.6665 13.6667 1.6665H12.3334C7.30535 1.6665 4.79069 1.6665 3.22935 3.22917C1.66802 4.79184 1.66669 7.30517 1.66669 12.3332V24.9998" stroke="#E4C59E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.3334 21.6667H5.00002C4.11597 21.6667 3.26812 22.0179 2.643 22.643C2.01788 23.2681 1.66669 24.1159 1.66669 25C1.66669 25.8841 2.01788 26.7319 2.643 27.357C3.26812 27.9821 4.11597 28.3333 5.00002 28.3333H24.3334M9.00002 12.7693L10.8787 14.7507C11.8787 15.8053 12.3787 16.3333 13 16.3333C13.6214 16.3333 14.1214 15.8053 15.1214 14.7507L17 12.768M13 16.2173V7" stroke="#E4C59E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.3333 21.6665C23.4493 21.6665 22.6014 22.0177 21.9763 22.6428C21.3512 23.2679 21 24.1158 21 24.9998C21 25.8839 21.3512 26.7317 21.9763 27.3569C22.6014 27.982 23.4493 28.3332 24.3333 28.3332" stroke="#E4C59E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
            </div>
        </div></a>

        <a href="{{ route('kelolapengguna') }}"><div class="card">
            <div>
                <div class="numbers">{{ $totals['total_user'] }}</div>
                <div class="cardName">Total Pengguna</div>
            </div>
            <div class="iconBx">
                <svg width="24" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.66667 7.99984C4.66667 6.05492 5.43928 4.18965 6.81455 2.81439C8.18982 1.43912 10.0551 0.666504 12 0.666504C13.9449 0.666504 15.8102 1.43912 17.1855 2.81439C18.5607 4.18965 19.3333 6.05492 19.3333 7.99984C19.3333 9.94476 18.5607 11.81 17.1855 13.1853C15.8102 14.5606 13.9449 15.3332 12 15.3332C10.0551 15.3332 8.18982 14.5606 6.81455 13.1853C5.43928 11.81 4.66667 9.94476 4.66667 7.99984ZM0 23.3332C0 21.5651 0.702379 19.8694 1.95262 18.6191C3.20286 17.3689 4.89856 16.6665 6.66667 16.6665H17.3333C19.1014 16.6665 20.7971 17.3689 22.0474 18.6191C23.2976 19.8694 24 21.5651 24 23.3332V27.3332H0V23.3332Z" fill="#E4C59E"/>
                    </svg>
            </div>
        </div></a>

        <a href="{{ route('kelolafasilitas') }}"><div class="card">
            <div>
                <div class="numbers">{{ $totals['total_fasilitas'] }}</div>
                <div class="cardName">Total Fasilitas</div>
            </div>
            <div class="iconBx">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 28H28M12 10.6667H13.3333M12 16H13.3333M12 21.3333H13.3333M18.6667 10.6667H20M18.6667 16H20M18.6667 21.3333H20M6.66667 28V6.66667C6.66667 5.95942 6.94762 5.28115 7.44772 4.78105C7.94781 4.28095 8.62609 4 9.33333 4H22.6667C23.3739 4 24.0522 4.28095 24.5523 4.78105C25.0524 5.28115 25.3333 5.95942 25.3333 6.66667V28" stroke="#E4C59E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
            </div>
        </div></a>

        <a href="{{ route('keluhanpengaduan') }}"><div class="card">
            <div>
                
                <div class="numbers"> {{ $totals['total_done'] }} / {{ $totals['total_report'] }}</div>
                <div class="cardName">Total Keluhan</div>
                <div class="numpendpro">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 2a8 8 0 1 0 0 16a8 8 0 0 0 0-16m0 2a1 1 0 0 1 .993.883L13 7v4.586l2.707 2.707a1 1 0 0 1-1.32 1.497l-.094-.083l-3-3a1 1 0 0 1-.284-.576L11 12V7a1 1 0 0 1 1-1"/></g></svg>
                    <span>Pending : {{ $totals['total_pending'] }}</span> 
                    <svg style="margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32"><path fill="currentColor" d="M16 2a14 14 0 1 0 14 14A14.016 14.016 0 0 0 16 2m0 26a12 12 0 0 1 0-24v12l8.481 8.481A11.96 11.96 0 0 1 16 28"/></svg>
                    <span>Proses : {{ $totals['total_proses'] }}</span>
                </div>
            </div>

            <div class="iconBx">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.0787 22.0572V14.6452M28.3333 15.9998C28.3354 17.6191 28.0179 19.2229 27.399 20.7193C26.7801 22.2156 25.872 23.5751 24.7267 24.7198C23.5808 25.866 22.2203 26.775 20.7229 27.395C19.2256 28.015 17.6207 28.3338 16 28.3332C14.2557 28.337 12.5307 27.9688 10.94 27.2532L5.784 28.0158C5.528 28.0576 5.26567 28.0363 5.01978 27.9537C4.7739 27.8711 4.5519 27.7297 4.37308 27.5418C4.19425 27.3539 4.064 27.1252 3.99364 26.8755C3.92328 26.6259 3.91493 26.3628 3.96933 26.1092L4.68533 20.8785C4.00426 19.3427 3.65705 17.6798 3.66667 15.9998C3.6646 14.3805 3.98211 12.7768 4.60102 11.2804C5.21992 9.78407 6.12804 8.42457 7.27333 7.27984C8.41919 6.13373 9.77969 5.22469 11.2771 4.60469C12.7744 3.98469 14.3793 3.66589 16 3.6665C19.2728 3.66672 22.4117 4.96638 24.7267 7.27984C25.8714 8.42501 26.7791 9.78459 27.398 11.2808C28.0168 12.7771 28.3347 14.3807 28.3333 15.9998Z" stroke="#E4C59E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.9213 9.94238H15.9293" stroke="#E4C59E" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
            </div>
        </div></a>

    </div>


        <div class="gridcontainer">
            <!-- Chart Section -->
            <div id="item1" class="chart1">
                {{-- width="300" height="300" --}}
            <canvas id="bookingChart"></canvas>
            </div>
            {{-- //kalender --}}
            <div  id="item3" class="calendar">
                <div class="calendar-header">
                    <button class="nav-btn" id="prevMonth">&lt;</button>
                    <h2 id="monthDisplay">December 2024</h2>
                    <button class="nav-btn" id="nextMonth">&gt;</button>
                </div>
                <div class="weekdays">
                    <div>Mo</div>
                    <div>Tu</div>
                    <div>We</div>
                    <div>Th</div>
                    <div>Fr</div>
                    <div>Sa</div>
                    <div>Su</div>
                </div>
                <div class="calendar-grid" id="calendarDays">
                    <!-- Days will be populated by JavaScript -->
                </div>
            </div>
     
            <!-- Statistics Section -->
            <div id="item2" class="statistics">
                <h2>Statistik Harian</h2>
                <div class="stat-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>Booking Hari Ini : {{ $top_facility_today }}</span>
                    <span class="highlight">Fasilitas Terpopuler : {{ $topBookings['nama_fasilitas'] }} ({{ $topBookings['topBookings'] }} Booking)</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-user-plus"></i>
                    <span>Pengguna Baru : {{ $user_summary['total_user'] }}</span>
                    <span class="status">Pending : {{ $user_summary['pending_role'] }} | Confrim By Admin : {{ $user_summary['user_role'] }}</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Keluhan Baru : {{ $report_summary['total_reports'] }}</span>
                    <span class="status">Selesai : {{ $report_summary['selesai'] }} | Pending : {{ $report_summary['pending'] }} | Dalam Proses : {{ $report_summary['sedang_diproses'] }}</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-cogs"></i>
                    <span>Penggunaan Fasilitas : {{ $facility_summary['fasilitas_digunakan'] }}/{{ $facility_summary['total_fasilitas'] }}</span>
                    <span class="status">Fasilitas Digunakan : {{ $facility_summary['fasilitas_digunakan'] }}</span>
                </div>
            </div>

                    <!-- Chart Section2 -->
                <div class="sectchart2">
                    <p>Penggunaan Fasilitas <button class="lihat" id="filterMonth">Bulan</button> <button class="lihat" id="filterYear">tahun</button></p>
                    <div id="item4" class="chart2">
                        <canvas id="doughnut" width="300" height="300"></canvas>
                    </div>
                </div>
        </div>
@endsection