<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="container"> 
        <div class="bg-circle bottom-left"></div>
        <div class="bg-circle top-right"></div>

        <div class="login-container">
            <div class="login-card">
                <div class="logo-container">
                    <div class="logo">
                        <img src="/images/icon-aksesbersama.png" alt="User Icon">
                    </div>
                </div>

                <div id="alertModal" class="modal" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="success-icon">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 6.55556V11M11 15.4444H11.0111M21 11C21 12.3132 20.7413 13.6136 20.2388 14.8268C19.7363 16.0401 18.9997 17.1425 18.0711 18.0711C17.1425 18.9997 16.0401 19.7363 14.8268 20.2388C13.6136 20.7413 12.3132 21 11 21C9.68678 21 8.38642 20.7413 7.17317 20.2388C5.95991 19.7363 4.85752 18.9997 3.92893 18.0711C3.00035 17.1425 2.26375 16.0401 1.7612 14.8268C1.25866 13.6136 1 12.3132 1 11C1 8.34784 2.05357 5.8043 3.92893 3.92893C5.8043 2.05357 8.34784 1 11 1C13.6522 1 16.1957 2.05357 18.0711 3.92893C19.9464 5.8043 21 8.34784 21 11Z" stroke="#E4C59E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <p id="alertModalMessage" class="message-text"></p>
                                <button class="close-modal" onclick="closeModal()">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login Form -->
                <form class="login-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-container">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6666 18.0024V16.3358C16.6666 15.4517 16.3154 14.6039 15.6903 13.9788C15.0652 13.3536 14.2173 13.0024 13.3333 13.0024H6.66658C5.78253 13.0024 4.93468 13.3536 4.30956 13.9788C3.68444 14.6039 3.33325 15.4517 3.33325 16.3358V18.0024" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.0001 9.66911C11.841 9.66911 13.3334 8.17672 13.3334 6.33577C13.3334 4.49483 11.841 3.00244 10.0001 3.00244C8.15913 3.00244 6.66675 4.49483 6.66675 6.33577C6.66675 8.17672 8.15913 9.66911 10.0001 9.66911Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <input type="text" name="username" placeholder="Admin" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-container">
                        <svg id="togglePassword"  width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5244 9.66895H3.2959C2.56779 9.66895 1.97754 10.4151 1.97754 11.3356V17.1689C1.97754 18.0894 2.56779 18.8356 3.2959 18.8356H12.5244C13.2525 18.8356 13.8428 18.0894 13.8428 17.1689V11.3356C13.8428 10.4151 13.2525 9.66895 12.5244 9.66895Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.61426 9.66895V6.33561C4.61426 5.23054 4.9615 4.17074 5.5796 3.38933C6.1977 2.60793 7.03603 2.16895 7.91016 2.16895C8.78428 2.16895 9.62261 2.60793 10.2407 3.38933C10.8588 4.17074 11.2061 5.23054 11.2061 6.33561V9.66895" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <input type="password" id="passwordInput" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <button type="submit" class="login-btn">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    // ===============untuk alert=================
    document.addEventListener("DOMContentLoaded", function () {
    function showModal(message) {
        const modal = document.getElementById('alertModal');
        const messageElement = document.getElementById('alertModalMessage');
        messageElement.innerText = message;
        modal.style.display = 'flex';
    }

    function closeModal() {
        const modal = document.getElementById('alertModal');
        modal.style.display = 'none';
    }

    const errorMessage = "{{ $errors->any() ? $errors->first() : '' }}";
    const successMessage = "{{ session('success') }}";

    if (errorMessage) {
        showModal(errorMessage);
    } else if (successMessage) {
        showModal(successMessage);
    }
    window.closeModal = closeModal;
});

// =================untuk lihat password===============
document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("passwordInput");

    togglePassword.addEventListener("click", function () {
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
        if (type === "text") {
            togglePassword.innerHTML = `
                <path d="M12.5244 9.66895H3.2959C2.56779 9.66895 1.97754 10.4151 1.97754 11.3356V17.1689C1.97754 18.0894 2.56779 18.8356 3.2959 18.8356H12.5244C13.2525 18.8356 13.8428 18.0894 13.8428 17.1689V11.3356C13.8428 10.4151 13.2525 9.66895 12.5244 9.66895Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.61426 6.16895C4.61426 4.23054 6.03603 2.66895 7.91016 2.66895C9.78428 2.66895 11.2061 4.23054 11.2061 6.16895V7.66895" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
            `;
        } else {
            togglePassword.innerHTML = `
                <path d="M12.5244 9.66895H3.2959C2.56779 9.66895 1.97754 10.4151 1.97754 11.3356V17.1689C1.97754 18.0894 2.56779 18.8356 3.2959 18.8356H12.5244C13.2525 18.8356 13.8428 18.0894 13.8428 17.1689V11.3356C13.8428 10.4151 13.2525 9.66895 12.5244 9.66895Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.61426 9.66895V6.33561C4.61426 5.23054 4.9615 4.17074 5.5796 3.38933C6.1977 2.60793 7.03603 2.16895 7.91016 2.16895C8.78428 2.16895 9.62261 2.60793 10.2407 3.38933C10.8588 4.17074 11.2061 5.23054 11.2061 6.33561V9.66895" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
            `;
        }
    });
});
</script>
</html>