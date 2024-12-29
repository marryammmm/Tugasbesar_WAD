<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/loading-style.css') }}">
    <script>
        // Timer untuk hitung mundur
        let timeRemaining = 5; // 5 detik
        const redirectUrl = "{{ route('booking.confirm', $booking) }}"; // URL tahap selanjutnya

        function startCountdown() {
            const timer = setInterval(() => {
                timeRemaining--;
                document.getElementById('countdown').textContent = `${timeRemaining} detik`;
                if (timeRemaining <= 0) {
                    clearInterval(timer);
                    // Arahkan ke tahap berikutnya
                    window.location.href = redirectUrl;
                }
            }, 1000); // Update setiap 1 detik
        }

        // Mulai hitung mundur saat halaman dimuat
        document.addEventListener("DOMContentLoaded", startCountdown);
    </script>
</head>
<body>
<div class="loading-container">
    <div class="loading-box">
        <!-- Header -->
        <h1 class="loading-header">Menghubungi Driver Ambulan</h1>
        
        <!-- GIF Animasi -->
        <img src="{{ asset('images/ambulanotw.gif') }}" alt="Loading Call" class="loading-gif">

        <!-- Countdown Text -->
        <p class="loading-text">
            Harap tunggu selama <span id="countdown">5 detik</span>
        </p>

        <!-- Button -->
        <form action="{{ route('booking.cancel', $booking) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-cancel">Batalkan Pemesanan</button>
        </form>
    </div>
</div>
</body>
</html>
