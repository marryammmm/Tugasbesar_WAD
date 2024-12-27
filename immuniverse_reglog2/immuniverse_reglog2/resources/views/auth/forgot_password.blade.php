<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - IMMUNIVERSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/resetpas-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <!-- Tombol Back -->
        <div class="back-button-container">
            <a href="{{ route('auth.login') }}" class="btn-back">
                <img src="{{ asset('images/back.png') }}" alt="Back" class="back-icon" style="width: 30px; height: auto;">
            </a>
        </div>

        <!-- Bagian Form -->
        <div class="form-section">
            <div class="form-content">
            <h3 class="form-title text-center">
            <h3 class="form-title">
    <i class="fas fa-envelope icon-envelope"></i>
    Masukkan Alamat Email Anda
</h3>


                {{-- Tampilkan pesan flash --}}
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

                {{-- Form untuk validasi email --}}
                <form action="{{ route('auth.forgot_password_process') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
                    </div>
                    <button type="submit" class="btn btn-primary custom-button">Lanjutkan</button>
                </form>
            </div>
        </div>

        <!-- Bagian Info -->
        <div class="info-section">
            <div class="info-content">
                <img src="{{ asset('images/doctor-image.png') }}" alt="Doctor" class="doctor-image" style="width: 500px; height: auto;">
                <h5 class="text-shimmer">Your Health, Our Priority</h5>
                <p class="text-shimmer">Reset your password to regain access to your account.</p>
            </div>
        </div>
    </div>
</body>
</html>
