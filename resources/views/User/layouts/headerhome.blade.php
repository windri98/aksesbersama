
@if (session('successlogout'))
    <div id="shownotifsuccess" class="sec_modal" style="display: flex;">
        <div class="logincontainer">
            <div class="formnotif">
                <div class="formsubnotif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" d="M512 64a448 448 0 1 1 0 896a448 448 0 0 1 0-896m-55.808 536.384l-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.27 38.27 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336z"/></svg>
                    <span>{{ session('successlogout') }}</span>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('errorlogin'))
<div id="shownotifwrong" class="sec_modal" style="display: flex;">
    <div class="logincontainer">
        <div class="formnotif">
            <div class="formsubnotif">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg>
                <span>{{ session('errorlogin') }}</span>
            </div>
        </div>
        <span class="closemodal triggermodal" data-target="showlogin" data-index="index1" onclick="closeModal()">X</span>
    </div>
</div>
@endif

@if (session('errorkeluar'))
<div id="shownotifwrong" class="sec_modal" style="display: flex;">
    <div class="logincontainer">
        <div class="formnotif">
            <div class="formsubnotif">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg>
                <span>{{ session('errorkeluar') }}</span>
            </div>
        </div>
        <span class="closemodal triggermodal" data-target="showlogin" data-index="index1" onclick="closeModal()">X</span>
    </div>
</div>
@endif

@if (session('success'))
    <div id="shownotifsuccess" class="sec_modal" style="display: flex;">
        <div class="logincontainer">
            <div class="formnotif">
                <div class="formsubnotif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" d="M512 64a448 448 0 1 1 0 896a448 448 0 0 1 0-896m-55.808 536.384l-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.27 38.27 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
    </div>
@endif
{{-- @if ($errors->any() || session('error')) --}}
@if ($errors->any() || session('error'))
<div id="shownotifwrong" class="sec_modal" style="display: flex;">
    <div class="logincontainer">
        <div class="formnotif">
            <div class="formsubnotif">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg>
                @if (session('error'))
                    <span>{{ session('error') }}</span>
                @endif
                @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                        @endforeach
                   
                @endif
            </div>
        </div>
        <span class="closemodal triggermodal" data-target="showdaftar" data-index="index2" onclick="closeModal()">X</span>
    </div>
</div>
@endif


<div class="navbar">
    <div class="secnavbar">
        <div class="logo">
            <a href="{{ route('dashboarduser') }}">
            <img src="/img/icon-aksesbersama_0.png" alt="">
            </a>
            <h2>A<span>KSES</span>B<span>ERSAMA</span></h2>
        </div>
        <div class="logomasuk">
   
            <a href="#" class="triggermodal" data-target="showlogin" data-index="index1">
                <div class="buttonlog">         
                        <span>Masuk</span>
                </div></a>
            </div>
    </div>
</div>

@include('User.layouts.login')
@include('User.layouts.register')

<div id="shownotif" class="sec_modal">
<div class="logincontainer">
    <div class="formnotif">
      
            <div class="formsubnotif">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg>
                <span>Silahkan Hubungi Admin Untuk Reset Password</span>
            </div>
    </div>
    <span class="closemodal triggermodal" data-target="showlogin" data-index="index1 onclick="closeModal()">X</span>
</div>
</div>