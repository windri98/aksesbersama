<div id="showlogin" class="sec_modal">    
    <div class="logincontainer">
        <div class="formlogin">
            <h3>Masuk</h3>
            <form action="{{ route('loginuser') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="formsublogin">
                    <div class="list_input">
                        <input type="text" name="username" id="userlogin" placeholder="Username" value="">
                            <div class="password-container">
                                <input type="password" name="password" id="password1" placeholder="Password" value="">
                                    <i class="toggle-password" data-toggle-id="password1" onclick="togglePassword(event, 'password1')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                            <path fill="currentColor" d="M9.5 7A8.5 8.5 0 0 0 1 15.5v7a8.5 8.5 0 0 0 15 5.477A8.5 8.5 0 0 0 31 22.5v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.5 7m5.345 4.8A8.5 8.5 0 0 0 14 15.5v7c0 1.326.304 2.581.845 3.7A6.5 6.5 0 0 1 3 22.5v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0v-1a6.5 6.5 0 0 1 11.845-3.7M16 15.5a6.5 6.5 0 1 1 13 0v7a6.5 6.5 0 1 1-13 0v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0zm-7.324 1.361c-.371.31-.99.177-1.383-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294s.41 1.105.038 1.414m13.02-1.414c.393.472.41 1.105.04 1.414c-.372.31-.992.177-1.384-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294"/>
                                        </svg>
                                    </i>
                            </div>
                    </div>
                    <div class="list_forgot">
                        <a href="#" class="triggermodal" data-target="shownotif" data-index="index3" onclick="closeModal()">Lupa Password ?</a>
                    </div>
    
                    <div class="list_input">
                        <button class="btn_submit" type="submit" id="btnlogin" name=""> <span>Masuk</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 15.289L15.288 12L12 8.711l-.688.689l2.1 2.1H8.5v1h4.912l-2.1 2.1zM12.003 21q-1.867 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M12 20q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/>
                        </svg></button>
                    </div>
    
                    <div class="list_daftar">
                        <span>Atau</span>
                        <a href="#" class="triggermodal" data-target="showdaftar" data-index="index2" onclick="closeModal()">Daftar</a>
                    </div>
                </div>
            </form>
        </div>
        <span class="closemodal" onclick="closeModal()">X</span>
    </div>
    </div>
