<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IMMUNIVERSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth\login-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="form-section">
            <div class="form-content">
            <h3 class="text-center mb-4" style="font-size: 35px; color:rgb(38, 160, 40); padding-top: 1px; padding-bottom: 35px;">Login</h3>
                @if (session('message'))
                    <div id="popup-message">
                        <span><i class="fas fa-exclamation-circle"></i> {{ session('message') }}</span>
                        <button class="close-btn" onclick="closePopup()">×</button>
                    </div>
                    <script>
                        setTimeout(function() {
                            const popup = document.getElementById('popup-message');
                            if (popup) {
                                popup.style.transition = 'opacity 1s';
                                popup.style.opacity = '0';
                                setTimeout(() => popup.remove(), 1000);
                            }
                        }, 3000);

                        function closePopup() {
                            const popup = document.getElementById('popup-message');
                            if (popup) {
                                popup.remove();
                            }
                        }
                    </script>
                @endif

                <form action="{{ route('auth.login_process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
                    </div>
                    <div class="mb-3 position-relative">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                    </div>
                    <form>
    <!-- Tambahkan elemen "Lupa Password?" di atas tombol login -->
    <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('auth.forgot_password') }}" class="text-success" style="font-size: 14px; padding: 5px;">Lupa Password?</a>
</div>
    <!-- Tombol login tetap di bawah -->
    <div class="center-button">
    <button type="submit" class="btn btn-primary custom-button" style="text-align: center;">Login</button>
    </div>
</form>

<div class="text-center mt-3">
<p style="font-size: 14px; padding: 5px;">
    Belum memiliki akun? 
    <a href="{{ route('auth.register') }}" class="text-success" style="font-size: 14px;">Daftar Disini</a>
</p>
</div>
            </div>
        </div>
        <div class="info-section">
            <div class="info-content">
                <img src="{{ asset('images/doctor-image.png') }}" alt="Doctor" class="doctor-image" style="width: 390px; height: auto;">
                <h5 class="text-shimmer">Your Health, Our Priority</h5>
                <p class="text-shimmer">Connect with trusted health experts anytime, anywhere.</p>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.querySelector('input[name="password"]');
            const icon = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
