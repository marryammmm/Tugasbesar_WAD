<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Ambulans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/choose-style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

    <!-- Alamat Penjemputan -->
    <div class="pickup-address">
    <p>
        <strong></strong> {{ $address->address }}
        <i class="bi bi-geo-alt-fill"></i> <!-- Hanya ikon lokasi -->
    </p>
</div>



    <!-- Ambulance List -->
    <div class="container mt-4">
    <h2 class="ambulance-heading">Ambulan di Sekitar Anda</h2>
    <hr class="heading-line">
    <div class="ambulance-list">
        <!-- Ambulance 1 -->
        <div class="ambulance-card">
            <img src="{{ asset('images/ambulan1.png') }}" alt="Ambulance RSAI Bandung" class="ambulance-img">
            <div class="ambulance-details">
                <h5>Ambulance RSAI Bandung</h5>
                <p><i class="bi bi-geo-alt-fill"></i> 300 m</p>
                <p><i class="bi bi-clock-fill"></i> ~10 Menit</p>
                <p><i class="bi bi-person-fill"></i> Tenaga Kesehatan ✔️</p>
                <p><i class="bi bi-briefcase-fill"></i> P3K ✔️</p>
                <p class="price">Rp 15,000</p>
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="address_id" value="{{ $address->id }}">
                    <input type="hidden" name="ambulance_id" value="1">
                    <button type="submit" class="btn btn-pilih">Pilih</button>
                </form>
            </div>
        </div>

        <!-- Ambulance 2 -->
        <div class="ambulance-card">
            <img src="{{ asset('images/ambulan2.png') }}" alt="Ambulance Mayapada" class="ambulance-img">
            <div class="ambulance-details">
                <h5>Ambulance Mayapada</h5>
                <p><i class="bi bi-geo-alt-fill"></i> 400 m</p>
                <p><i class="bi bi-clock-fill"></i> ~10 Menit</p>
                <p><i class="bi bi-person-fill"></i> Tenaga Kesehatan ✔️</p>
                <p><i class="bi bi-briefcase-fill"></i> P3K ✔️</p>
                <p class="price">Rp 15,000</p>
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="address_id" value="{{ $address->id }}">
                    <input type="hidden" name="ambulance_id" value="2">
                    <button type="submit" class="btn btn-pilih">Pilih</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
