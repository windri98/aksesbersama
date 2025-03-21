<nav>
    <ul>
        <a href="{{ route('Admindashboard') }}">
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M3 12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm0 8a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-8a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1zm1-17a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z"/></svg>
                Dashboard
            </li>
        </a>
        <a href="{{ route('kelolabooking') }}">
            <li><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19.39 10.74L11 19.13V22H6c-1.11 0-2-.89-2-2V4a2 2 0 0 1 2-2h1v7l2.5-1.5L12 9V2h6a2 2 0 0 1 2 2v6.3c-.22.12-.43.26-.61.44M13 19.96V22h2.04l6.13-6.12l-2.04-2.05zm9.85-6.49l-1.32-1.32c-.2-.2-.53-.2-.72 0l-.98.98l2.04 2.04l.98-.98c.2-.19.2-.52 0-.72"/></svg>
                Kelola booking
            </li>
        </a>
        <a href="{{ route('kelolapengguna') }}">
            <li><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24"><path fill="currentColor" d="M14 21v-3.075l5.525-5.5q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-5.5 5.5zM4 20v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13q.925 0 1.825.113t1.8.362L12 17.1V20zm16.575-4.6l.925-.975l-.925-.925l-.95.95zM12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12"/></svg>
            Kelola pengguna</li>
        </a>
        <a href="{{ route('kelolafasilitas') }}">
            <li><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M9 8h1m-1 4h1m-1 4h1m4-8h1m-1 4h1m-1 4h1M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/></svg>
                Kelola fasilitas</li>
        </a>
        <a href="{{ route('keluhanpengaduan') }}">
            <li><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.996 9.013h.008m0-2.004V4.505M22 6.792c0 2.646-2.24 4.792-5.004 4.792q-.488 0-.968-.09c-.23-.043-.344-.064-.425-.052c-.08.012-.194.072-.42.194a3.25 3.25 0 0 1-2.114.329c.274-.338.46-.743.543-1.177c.05-.265-.074-.523-.26-.712a4.67 4.67 0 0 1-1.36-3.284c0-2.646 2.24-4.792 5.004-4.792S22 4.146 22 6.792M7.502 22H4.718c-.323 0-.648-.046-.945-.173c-.966-.415-1.457-.964-1.685-1.307a.54.54 0 0 1 .03-.631c1.12-1.488 3.716-2.386 5.384-2.386M7.507 22h2.783c.324 0 .648-.046.945-.173c.967-.415 1.457-.964 1.686-1.307a.54.54 0 0 0-.03-.631c-1.12-1.488-3.716-2.386-5.384-2.386m2.778-5.214a2.776 2.776 0 0 1-2.778 2.772a2.776 2.776 0 0 1-2.78-2.772a2.776 2.776 0 0 1 2.78-2.773a2.776 2.776 0 0 1 2.778 2.773" color="currentColor"/></svg>
                Keluhan dan pengaduan</li>
        </a>
        <a href="#" class="triggermodal" data-target="pushnotification">
            <li><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m17.58 6.25l1.77 1.77L14.37 13H12.6v-1.77zm3.27-.44l-1.06-1.06c-.2-.2-.51-.2-.71 0l-.85.85L20 7.37l.85-.85c.2-.2.2-.52 0-.71M18 12.2V17h2v2H4v-2h2v-7c0-2.79 1.91-5.14 4.5-5.8V2h3v2.2c.82.21 1.57.59 2.21 1.09L10.6 10.4V15h4.6zM10 20h4c0 1.1-.9 2-2 2s-2-.9-2-2"/></svg>
                Push Notification</li>
        </a>
    </ul>
</nav>

<div class="logout">
    <a href="{{ route('logoutadmin') }}">
       <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="currentColor"><path fill-rule="evenodd" d="M11 20a1 1 0 0 0-1-1H5V5h5a1 1 0 1 0 0-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h5a1 1 0 0 0 1-1" clip-rule="evenodd"/><path d="M21.714 12.7a1 1 0 0 0 .286-.697v-.006a1 1 0 0 0-.293-.704l-4-4a1 1 0 1 0-1.414 1.414L18.586 11H9a1 1 0 1 0 0 2h9.586l-2.293 2.293a1 1 0 0 0 1.414 1.414l4-4z"/></g></svg>
            <span>Log out</span>
            {{-- <i class="fas fa-sign-out-alt"></i> Log out --}}
    </a>
</div>