<!-- Navbar -->
<nav class="navbar">
    @if (!$iconname)
        <h1>Dashboard</h1>
            @else
                <h1>{{ $iconname }}</h1>
                    @endif
   
    <div class="nav-right">
        <div class="timedas">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/></svg>
            <span class="time"></span>
        </div>
            <!-- Notification Icon -->
        <div class="icon-box">
            <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 17V18H0V17L2 15V9C2 5.9 4.03 3.17 7 2.29V2C7 1.46957 7.21071 0.960859 7.58579 0.585786C7.96086 0.210714 8.46957 0 9 0C9.53043 0 10.0391 0.210714 10.4142 0.585786C10.7893 0.960859 11 1.46957 11 2V2.29C13.97 3.17 16 5.9 16 9V15L18 17ZM11 19C11 19.5304 10.7893 20.0391 10.4142 20.4142C10.0391 20.7893 9.53043 21 9 21C8.46957 21 7.96086 20.7893 7.58579 20.4142C7.21071 20.0391 7 19.5304 7 19" fill="#E4C59E"/>
            </svg>
        </div>
        <div class="user dropdown">
            <button class="user btn">
                <!-- User Icon -->
                <div class="iconuser-hover">
                    <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.25 10C13.8467 10 14.419 10.2371 14.841 10.659C15.2629 11.081 15.5 11.6533 15.5 12.25V13C15.5 15.9565 12.71 19 8 19C3.29 19 0.5 15.9565 0.5 13V12.25C0.5 11.6533 0.737053 11.081 1.15901 10.659C1.58097 10.2371 2.15326 10 2.75 10H13.25ZM8 0.25C9.09402 0.25 10.1432 0.684597 10.9168 1.45818C11.6904 2.23177 12.125 3.28098 12.125 4.375C12.125 5.46902 11.6904 6.51823 10.9168 7.29182C10.1432 8.0654 9.09402 8.5 8 8.5C6.90598 8.5 5.85677 8.0654 5.08318 7.29182C4.3096 6.51823 3.875 5.46902 3.875 4.375C3.875 3.28098 4.3096 2.23177 5.08318 1.45818C5.85677 0.684597 6.90598 0.25 8 0.25Z" fill="#171717"/>
                    </svg>
                </div>
                
                <!-- Chevron Icon -->
                <svg class="chevron-icon" width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L6 6L11 1" stroke="#E4C59E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <div class="dropdown-menu">
                {{-- <a href="#">Profile</a>
                <a href="#">Settings</a> --}}
                <a href="{{ route('logoutadmin') }}">Logout</a>
            </div>
        </div>
    </div>
</nav>
<script>

function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit',
        hour12: true 
    });
    const dateString = now.toLocaleDateString('en-US', { 
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    });
    document.querySelector('.time').textContent = `${timeString} Today ${dateString}`;
}

updateTime();
setInterval(updateTime, 60000);
</script>