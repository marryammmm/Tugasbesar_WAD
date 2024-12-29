<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detail-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

</head>
<body>
    <div class="page-container">
        <div class="detail-box">
            <div class="map-container">
                <img src="{{ asset('images/detailpemesanan.gif') }}" alt="Detail Peta" class="map-image">
                <div class="detail-card">
                    <div class="header-card">
                        Detail Pesanan
                    </div>
                    <div class="content">
                        <p class="status">
                            <strong>Status Pemesanan:</strong> <span id="status">{{ $booking->status }}</span>
                        </p>
                        <table class="table table-borderless">
    <tr>
        <th>
            <i class="bi bi-truck"></i> Nama Ambulans:
        </th>
    </tr>
    <tr>
        <td>
            {{ $booking->ambulance->name }}
        </td>
    </tr>
    <tr>
        <th>
            <i class="bi bi-clock-fill"></i> Estimasi Waktu:
        </th>
    </tr>
    <tr>
        <td id="time">
            10 menit
        </td>
    </tr>
    <tr>
        <th>
            <i class="bi bi-geo-alt-fill"></i> Alamat Penjemputan:
        </th>
    </tr>
    <tr>
        <td>
            {{ $booking->address->address }}
        </td>
    </tr>
</table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let timeRemaining = 11;
        const bookingId = {{ $booking->id }};

        function updateTime() {
            if (timeRemaining > 0) {
                timeRemaining--;
                document.getElementById('time').innerText = timeRemaining + " menit";
            } else {
                fetch(`/booking/${bookingId}/auto-complete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.status === 'success') {
                          window.location.href = "{{ route('booking.complete', $booking) }}";
                      }
                  });
            }
        }

        setInterval(updateTime, 1000);
    </script>
</body>
</html>
