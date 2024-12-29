<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Alamat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/confirm-style.css') }}">
</head>
<body>
    <div class="confirmation-container">
        <!-- Header -->
        <h1 class="header-title">Konfirmasi Alamat</h1>

        <!-- Map Image -->
        <div class="map-container">
            <img src="{{ asset('images/konfirmasimaps.gif') }}" alt="Peta Konfirmasi" class="map-image">
        </div>

        <!-- Address Section -->
        <div class="address-section">
    <p><strong>Alamat penjemputan anda:</strong></p>
    <p>📍{!! nl2br(e($booking->address->address)) !!}</p>
</div>
<hr class="divider">

        <!-- Confirmation Question -->
        <p class="confirmation-question">Alamat penjemputan anda sudah benar?</p>

        <!-- Buttons -->
        <div class="button-container">
            <form action="{{ route('booking.confirm', $booking) }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="correct" value="1">
                <button type="submit" class="btn btn-success">YA</button>
            </form>
            <button class="btn btn-danger" onclick="togglePopup()">EDIT</button>
        </div>

        <!-- Popup for Editing Address -->
        <div id="popup" class="popup">
            <div class="popup-content">
                <form action="{{ route('booking.confirm', $booking) }}" method="POST">
                    @csrf
                    <input type="hidden" name="update_address" value="1">
                    <label for="new_address">Masukkan Alamat Penjemputan</label>
                    <input type="text" id="new_address" name="new_address" class="form-control" placeholder="Masukkan alamat baru">
                    <button type="submit" class="btn btn-warning mt-3">Edit Alamat</button>
                    <button type="button" class="btn btn-secondary mt-3" onclick="togglePopup()">Tutup</button>
                </form>
            </div>
        </div>
    <script>
   function togglePopup() {
    console.log('togglePopup called');
    const popup = document.getElementById('popup');
    if (!popup) {
        console.error('Popup element not found');
        return;
    }
    if (popup.style.display === 'block') {
        popup.style.display = 'none';
        console.log('Popup hidden');
    } else {
        popup.style.display = 'block';
        console.log('Popup shown');
    }
}

</script>

</body>
</html>
