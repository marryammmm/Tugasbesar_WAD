<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Bukti Pemesanan</title>
    <!-- Path absolut ke CSS -->
    <style>
        /* Wadah Utama */

.receipt-container {
    background-color:rgb(255, 255, 255); /* Warna latar belakang */
    max-width: 400px; /* Lebar maksimum */
    height: 480px; /* Tinggi tetap 300px */
    margin: 50px auto; /* Margin tengah */
    padding: 0px; /* Ruang dalam */
    border-radius: 10px; /* Sudut melengkung */
    font-family: Arial, sans-serif; /* Font */
    border: 1px solid #ddd; /* Border */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan */
    margin-top: 120px;
}


/* Header */
.header {
    background-color: #568e5a; /* Warna hijau header */
    padding: 5px 5px; /* Ruang dalam */
    display: flex;
    justify-content: space-between; /* Konten di kiri dan kanan */
    align-items: center;
    border-radius: 0px 0px 0 0; /* Sudut atas melengkung */
    color: #ffffff; /* Warna teks putih */
    line-height: 0;
}

.logo {
    width: 70px; /* Ukuran logo */
    height: auto; /* Menyesuaikan tinggi */
}

.header-text {
    text-align: right; /* Teks rata kanan */
    font-size: 10px; /* Ukuran font */
    color: #ffffff; /* Warna teks */
    margin-left: auto;
}

/* Pesan Terima Kasih */
.thank-you {
    font-size: 10px; /* Ukuran font */
    text-align: left; /* Teks rata tengah */
    margin: 20px 0; /* Margin atas dan bawah */
    color: #333; /* Warna teks */
    font-weight: normal; /* Teks tebal */
    padding-left: 10px; 
    margin-bottom: 25px;
}

/* Total Box */
.total-box {
    background-color: #ffffff; /* Warna latar putih */
    border: 1px solid #ddd; /* Border abu */
    padding: 5px; /* Ruang dalam */
    border-radius: 5px; /* Sudut melengkung */
    display: flex; /* Flexbox */
    justify-content: space-between; /* Konten rata kiri-kanan */
    align-items: center; /* Konten rata tengah */
    margin-bottom: 20px; /* Margin bawah */
    max-width: 50%; /* Pastikan kotak tidak melewati batas */
    box-sizing: border-box; /* Pastikan padding dihitung dalam lebar */
    margin: 0 auto;
    font-size: 10px; /* Ukuran font teks */
    font-weight: normal; /* Pastikan teks tidak bold */
    
    
}

.total-box p {
    margin: 0; /* Hapus margin bawaan */
}

.total-box .price {
    font-size: 10px; /* Ukuran font harga */
    color: #568e5a; /* Warna hijau */
    font-weight: bold; /* Teks tebal */
}

/* Judul Bagian */
.section-title {
    font-size: 10px; /* Ukuran font */
    margin-bottom: 10px; /* Margin bawah */
    color: #333; /* Warna teks */
    font-weight: bold; /* Teks tebal */
    padding-left: 10px; 
    margin-top: 30px;
}


/* Detail Box */
.detail-box {
    background-color: #ffffff; /* Warna latar putih */
    border: 1px solid #ddd; /* Border abu */
    padding: 15px; /* Ruang dalam */
    border-radius: 5px; /* Sudut melengkung */
    margin-bottom: 50px; /* Margin bawah */
    display: grid; /* Gunakan grid */
    grid-template-columns: repeat(2, 1fr); /* Kolom 2 dengan ukuran sama */
    gap: 4px; /* Jarak antar kolom */
    max-width: 80%; /* Pastikan kotak tidak melewati batas */
    margin: 0 auto;
    margin-top: 10px;

}

.detail-box p {
    font-size: 10px; /* Ukuran font */
    color: #555; /* Warna teks abu */
    margin: 10px 0; /* Jarak antar paragraf */
    line-height: 1.4; /* Spasi antar baris */
}

.detail-box p strong {
    display: block; /* Label ditampilkan sebagai blok (di atas) */
    font-weight: bold; /* Teks label tebal */
    color: #333; /* Warna teks label */
    margin-bottom: 5px; /* Jarak antara label dan value */
    margin-top: -10px;
}

.detail-box p span {
    display: block; /* Value juga ditampilkan sebagai blok */
    color: #555; /* Warna teks value */
    font-weight: normal; /* Pastikan value tidak bold */
}

/* Footer (Hak Cipta) */
.footer {
    text-align: center; /* Rata tengah */
    font-size: 5px; /* Ukuran font kecil */
    color: #aaa; /* Warna abu-abu terang */
    margin-top: 100px; /* Jarak atas */
}

/* Tombol Download */
.text-end {
    text-align: center; /* Teks rata kanan */
    margin-top: 40px; /* Margin atas */
}

.btn-primary {
    padding: 3px 14px;
    background-color: #568e5a;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 10px;
    display: inline-flex;
    align-items: center;
    gap: 6px;

    /* Atur posisi */
    position: relative;
    top: -33px; /* Geser ke atas */
    left: 118px; /* Geser ke kanan */
}


.btn-primary:hover {
    background-color:rgb(104, 192, 149); 
}

/* Ikon PDF */
.btn-primary i {
    font-size: 16px; /* Ukuran ikon */
    color: #ffffff; /* Warna ikon */
}

    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Header -->
        <div class="header">
            <div class="header-text">
                <p>Tanggal Pemesanan: {{ $booking->created_at->format('d M Y') }}</p>
                <p>ID Pemesanan: {{ $booking->id }}</p>
            </div>
        </div>

        <!-- Pesan Terima Kasih -->
        <h2 class="thank-you">Terimakasih Telah menggunakan Layanan Pemesanan Ambulan Kami !</h2>

        <!-- Total Dibayar -->
        <div class="total-box">
            <p>Total Dibayar</p>
            <p class="price">Rp.15.000</p>
        </div>

        <!-- Detail Perjalanan -->
        <h3 class="section-title">Detail Perjalanan</h3>
        <div class="detail-box">
    <p>
        <strong>Nama Ambulans:</strong>
        <span>{{ $booking->ambulance->name }}</span>
    </p>
    <p>
        <strong>Dijemput Dari:</strong>
        <span>{{ $booking->address->address }}</span>
    </p>
    <p>
        <strong>Tanggal Pemesanan:</strong>
        <span>{{ $booking->created_at->format('d M Y') }}</span>
    </p>
</div>


        <!-- Tombol Download -->
        <div class="text-end">
            <a href="{{ route('booking.receipt.download', ['booking' => $booking->id]) }}" class="btn-primary">
                <i class="fas fa-file-pdf"></i> Download Bukti
            </a>
        </div>
        <!-- Footer -->
<footer class="footer">
    <p>©️Immuniverse 2024 All Rights Reserved</p>
   
</footer>

    </div>
</body>
</html>
