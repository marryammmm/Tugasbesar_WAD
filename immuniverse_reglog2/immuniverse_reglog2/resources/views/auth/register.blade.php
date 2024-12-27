<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - IMMUNIVERSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/register-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="form-section">
            <div class="form-content">
                <h3 class="text-center mb-4" style="font-size: 35px; color:rgb(45, 142, 65);">Registrasi</h3>
                
                {{-- Tampilkan error validasi --}}
                @if (session('message'))
<div id="popup-message">
    <span>{{ session('message') }}</span>
    <button class="close-btn" onclick="closePopup()">×</button>
</div>
@endif

@if ($errors->any())
<div id="popup-message">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button class="close-btn" onclick="closePopup()">×</button>
</div>
@endif

@if (session('message'))
<div id="popup-message">
    <span><i class="fas fa-exclamation-circle"></i> {{ session('message') }}</span>
    <button class="close-btn" onclick="closePopup()">×</button>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('popup-message');
        if (popup) {
            setTimeout(function() {
                popup.style.opacity = '0'; // Fade out
                setTimeout(() => popup.remove(), 500); // Hapus elemen setelah animasi
            }, 3000); // Tampil selama 3 detik
        }
    });

    function closePopup() {
        const popup = document.getElementById('popup-message');
        if (popup) {
            popup.remove();
        }
    }
</script>
@endif


                {{-- Form registrasi --}}
                <form action="{{ route('auth.register_process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="full_name" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
                    </div>
                    <div class="mb-3 position-relative">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <i class="fas fa-eye toggle-password" data-target="password" onclick="togglePassword(this)"></i>
                    </div>
                    <div class="mb-3 position-relative">
                        <input type="password" id="confirm_password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                        <i class="fas fa-eye toggle-password" data-target="confirm_password" onclick="togglePassword(this)"></i>
                    </div>
                    <div class="mb-3">
                        <select name="gender" class="form-control" required>
                            <option value="" disabled selected>Gender</option>
                            <option value="Male">Laki-laki</option>
                            <option value="Female">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="security_question" class="form-label">
                            Pilih Pertanyaan Keamanan
                            <i class="fas fa-question-circle faq-icon" onclick="toggleFaq()"></i>
                        </label>
                        <select name="security_question" class="form-control" required>
                            <option value="" disabled selected>Pilih Pertanyaan</option>
                            <option value="Apa hewan favorit anda saat kecil?">Apa nama makanan favorit Anda saat kecil?</option>
                            <option value="Siapa nama teman di sekolah dasar anda?">Siapa nama teman di sekolah dasar Anda?</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="security_answer" class="form-control" placeholder="Jawaban Anda" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <div class="text-center mt-3">
                <p class="text-bawah">Sudah memiliki akun? <a href="{{ route('auth.login') }}" class="text-success">Login Disini</a></p>
                </div>
            </div>
        </div>
        <div class="info-section">
            <div class="info-content">
                <img src="{{ asset('images/doctor-image.png') }}" alt="Doctor" class="doctor-image" style="width: 406px; height: auto;">
                <h5 class="text-shimmer">Your Health, Our Priority</h5>
                <p class="text-shimmer">Join IMMUNIVERSE and take the first step to better health!</p>
            </div>
        </div>
    </div>

    {{-- Popup FAQ --}}
    <div class="faq-popup" id="faqPopup">
        <div class="faq-popup-content">
            <p>Ini adalah pertanyaan keamanan yang akan digunakan untuk memverifikasi identitas Anda jika Anda lupa password. Pastikan jawabannya mudah Anda ingat tetapi sulit ditebak oleh orang lain.</p>
            <button class="close-btn" onclick="toggleFaq()">Tutup</button>
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

        function toggleFaq() {
            const faqPopup = document.getElementById("faqPopup");
            faqPopup.style.display = faqPopup.style.display === "block" ? "none" : "block";
        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const popup = document.getElementById('popup-message');
        if (popup) {
            // Hilangkan pop-up setelah 3 detik
            setTimeout(function () {
                popup.style.opacity = '0'; // Animasi fade-out
                setTimeout(() => popup.remove(), 500); // Hapus elemen setelah animasi
            }, 3000);
        }
    });

    function closePopup() {
        const popup = document.getElementById('popup-message');
        if (popup) {
            popup.remove();
        }
    }
</script>
</body>
</html>
