<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Selesai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/completed-style.css') }}">
</head>
<body>
    <div class="outer-container">
        <!-- Wadah Utama -->
        <div class="main-container">
            <!-- Success Video -->
            <div class="success-video">
                <video autoplay muted playsinline>
                    <source src="{{ asset('videos/finish.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Judul -->
            <h1 class="title">Pesanan Selesai!</h1>

             <!-- Detail Box -->
        <div class="detail-box">
            <p><strong>Alamat Penjemputan:</strong> {{ $booking->address->address }}</p>
            <p><strong>Asal Ambulans:</strong> {{ $booking->ambulance->name }}</p>
            <p><strong>Status Pemesanan:</strong> {{ $booking->status }}</p>
            

               <!-- Cetak Bukti -->
               <p class="text-end cetak-bukti">
    <a href="{{ route('booking.receipt', ['booking' => $booking->id]) }}" class="btn-link">Cetak Bukti</a>
</p>
            </div>
            </div>
            <!-- Tombol Kembali -->
            <a href="{{ route('booking.create') }}" class="btn btn-secondary back-button">Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>
