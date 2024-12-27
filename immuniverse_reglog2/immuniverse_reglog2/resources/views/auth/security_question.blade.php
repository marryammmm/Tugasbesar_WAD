<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Question - IMMUNIVERSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/resetpas-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="form-section">
        <div class="form-content">
    <h3 class="form-title">
        <i class="fas fa-lock icon-lock"></i>
        Pertanyaan Keamanan
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

                {{-- Form untuk menjawab pertanyaan keamanan --}}
                <form action="{{ route('auth.security_question_process') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" value="{{ $security_question }}" disabled>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="security_answer" class="form-control" placeholder="Masukkan jawaban Anda" required>
                    </div>
                    <button type="submit" class="btn btn-primary custom-button">Submit</button>
                </form>
            </div>
        </div>
        <div class="info-section">
            <div class="info-content">
                <img src="{{ asset('images/doctor-image.png') }}" alt="Doctor" class="doctor-image" style="width: 500px; height: auto;">
                <h5 class="text-shimmer">Your Health, Our Priority</h5>
                <p class="text-shimmer">Answer your security question to proceed further.</p>
            </div>
        </div>
    </div>
</body>
</html>
