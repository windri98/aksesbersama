@extends('User.index')
@section('maincontent')
@include('User.layouts.headeruser')
     
            <div class="col setcol">
                <div class="side1">
                <a href=""> <div class="sideiconprofil sideseticonprofil">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="#171717" d="M12 11.385q-1.237 0-2.119-.882T9 8.385t.881-2.12T12 5.386t2.119.88t.881 2.12t-.881 2.118t-2.119.882m-7 7.23V16.97q0-.619.36-1.158q.361-.54.97-.838q1.416-.679 2.834-1.018q1.417-.34 2.836-.34t2.837.34t2.832 1.018q.61.298.97.838q.361.539.361 1.158v1.646z"/>
                    </svg>
                    <span style="font-weight: 700">Username : {{ session('username') }}</span>
                    <span style="font-weight: 400">ID Card : {{ session('id_card') }}</span>
                </div></a>
            </div>
            <div class="side1 setside1">
                <span>No. Kamar : {{ session('no_kamar') }}</span>
                </div>
                
            <div class="side1 setside1">
                <a href="{{ route('ubahpassword') }}"> <div class="ubahpassword">
                    <span>Ubah Password</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 12 24">
                        <defs><path id="weuiArrowOutlined0" fill="currentColor" d="m7.588 12.43l-1.061 1.06L.748 7.713a.996.996 0 0 1 0-1.413L6.527.52l1.06 1.06l-5.424 5.425z"/>
                        </defs><use fill-rule="evenodd" href="#weuiArrowOutlined0" transform="rotate(-180 5.02 9.505)"/>
                    </svg>
                </div></a>
            </div>
                <div  class="subsection4">
                    <a href="{{ route('logout') }}"><div class="button"> 
                        @csrf    
                        <span>Logout</span>
                        </div></a>
                </div>
            </div>
     
@endsection    
