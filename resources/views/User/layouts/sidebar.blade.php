
        <div id="sidebar" class="panel sidebar">
            <div class="navbar"  >
                    <div class="secnavbar">
                        <div class="logo">
                            <img src="/img/icon-aksesbersama_0.png" alt="">
                            <h2>A<span>KSES</span>B<span>ERSAMA</span></h2>
                        </div>
                        <div class="logomasuk">
                            <a href="javascript:void(0)" id="closeSidebar">
                                <div class="buttonclose">         
                                        <span>X</span>
                                </div></a>
                        </div>
                    </div>
            </div>
          
        <div class="col">
            <div class="side0">
            <a href=""> <div class="sideiconprofil">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#171717" d="M12 11.385q-1.237 0-2.119-.882T9 8.385t.881-2.12T12 5.386t2.119.88t.881 2.12t-.881 2.118t-2.119.882m-7 7.23V16.97q0-.619.36-1.158q.361-.54.97-.838q1.416-.679 2.834-1.018q1.417-.34 2.836-.34t2.837.34t2.832 1.018q.61.298.97.838q.361.539.361 1.158v1.646z"/>
                </svg>
                <span style="font-weight: 700">Username : {{ session('username') }}</span>
                <span style="font-weight: 400">ID Card : {{ session('id_card') }}</span>
            </div></a>
                 

                    <a href="{{ route ('history') }}"><div class="button">
                    <span>Riwayat</span>
                </div></a>
            </div>
        </div>
     
        <div class="col">    
            <div class="side1">  
                <a href="{{ route('dashboarduser') }}">  <div class="sideiconlist">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1"/>
                </svg>
                    <span>Beranda</span>
                </div></a>
                <a href="{{ route('profil') }}"> <div class="sideiconlist">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512">
                        <path fill="currentColor" fill-rule="evenodd" d="M256 42.667A213.333 213.333 0 0 1 469.334 256c0 117.821-95.513 213.334-213.334 213.334c-117.82 0-213.333-95.513-213.333-213.334C42.667 138.18 138.18 42.667 256 42.667m21.334 234.667h-42.667c-52.815 0-98.158 31.987-117.715 77.648c30.944 43.391 81.692 71.685 139.048 71.685s108.104-28.294 139.049-71.688c-19.557-45.658-64.9-77.645-117.715-77.645M256 106.667c-35.346 0-64 28.654-64 64s28.654 64 64 64s64-28.654 64-64s-28.653-64-64-64"/>
                    </svg>
                        <span>Profil</span>
                    </div></a>
            </div>
        </div>        
        
        <div class="col">      
            <div class="side2">
                <div class="side2sec1">
                    <h3>Kategori</h3>
                </div> 
               
                @foreach (Cache::get('kategori') as $getlink)
                    <a href="{{ route('getkategori', ['id' => $getlink['kategori']])}}"><div class="sideiconkategori">
                        {{-- @if (file_exists($getlink["icon"])) --}}
                        @if (!empty($getlink["icon"]))
                        <img src="{{ env('API_BASE_URL') .'/storage/img/'. $getlink["icon"] }}" alt="Report Image">
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="currentColor">
                            <path d="M18 16.5a4.5 4.5 0 0 1-4.5 4.5A4.5 4.5 0 0 1 9 16.5c0-2.486 2.014-4.5 4.5-4.5s4.5 2.014 4.5 4.5M4 28.333C4 24.787 10.33 23 13.5 23s9.5 1.787 9.5 5.333V36H4zM39 16.5a4.5 4.5 0 0 1-4.5 4.5a4.5 4.5 0 0 1-4.5-4.5c0-2.486 2.014-4.5 4.5-4.5s4.5 2.014 4.5 4.5M27 15a3 3 0 1 1-6 0a3 3 0 1 1 6 0m-2 13.333C25 24.787 31.33 23 34.5 23s9.5 1.787 9.5 5.333V36H25z"/><path fill-rule="evenodd" d="M28.75 22.185q-.4.147-.788.313c-1.17.5-2.353 1.176-3.272 2.08c-.246.243-.48.508-.69.797a6.5 6.5 0 0 0-.69-.797c-.919-.904-2.101-1.58-3.273-2.08a17 17 0 0 0-.788-.313C20.772 21.396 22.73 21 24 21s3.228.396 4.75 1.185" clip-rule="evenodd"/></g>
                        </svg>
                        @endif
                        <span>{{ $getlink["kategori"] }}</span>
                    </div></a>
                @endforeach
            </div>
        </div>
        

        <div class="col">    
            <div class="side3">  
            <a href="{{ route('logout') }}"> <div class="sideiconlist">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 64 64">
                    <path fill="currentColor" d="M32 2C15.432 2 2 15.432 2 32s13.432 30 30 30s30-13.432 30-30S48.568 2 32 2m1.693 46V37.428H15V27.143h18.693V16L49 32z"/>
                </svg>
                    <span>Logout</span>
                </div></a>
            </div>
        </div>    
</div>
