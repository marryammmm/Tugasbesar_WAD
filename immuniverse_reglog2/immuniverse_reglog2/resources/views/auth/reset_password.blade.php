<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - IMMUNIVERSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/resetpas-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .toggle-password:hover {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="form-section">
            <div class="form-content">
                <h3 class="text-center mb-4" style="font-size: 23px; color:rgb(38, 160, 40);">Masukkan Password Baru</h3>

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

                {{-- Form untuk reset password --}}
                <form action="{{ route('auth.reset_password_process') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3 position-relative">
                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Password Baru" required minlength="6">
                        <i class="fas fa-eye toggle-password" data-target="new_password" onclick="togglePassword(this)"></i>
                    </div>
                    <div class="mb-3 position-relative">
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru" required minlength="6">
                        <i class="fas fa-eye toggle-password" data-target="new_password_confirmation" onclick="togglePassword(this)"></i>
                    </div>
                    <button type="submit" class="btn btn-primary custom-button">Reset Password</button>
                </form>
            </div>
        </div>
        <div class="info-section">
            <div class="info-content">
            <img src="{{ asset('images/doctor-image.png') }}" alt="Doctor" class="doctor-image" style="width: 390px; height: auto;">
                <h5 class="text-shimmer">Your Health, Our Priority</h5>
                <p class="text-shimmer">Create a new password to regain access to your account.</p>
            </div>
        </div>
    </div>
    <script>
        function togglePassword(element) {
            const targetId = element.getAttribute("data-target");
            const targetInput = document.getElementById(targetId);
            if (targetInput.type === "password") {
                targetInput.type = "text";
                element.classList.remove("fa-eye");
                element.classList.add("fa-eye-slash");
            } else {
                targetInput.type = "password";
                element.classList.remove("fa-eye-slash");
                element.classList.add("fa-eye");
            }
        }
    </script>
        
</body>

</html>
