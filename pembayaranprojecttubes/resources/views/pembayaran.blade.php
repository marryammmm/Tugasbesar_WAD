<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immuniverse";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi dan Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5dc;
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center">Konsultasi dan Pembayaran</h1>

    <!-- Daftar Konsultasi -->
    <div class="card mb-4">
        <div class="card-header">Daftar Konsultasi</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>Jadwal</th>
                    <th>Keahlian</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = $conn->query("SELECT * FROM konsultasi");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['dokter']}</td>
                                <td>{$row['jadwal']}</td>
                                <td>{$row['keluhan']}</td>
                                <td><button class='btn btn-primary btn-sm' onclick='showPaymentForm({$row['id']})'>Tambah Pembayaran</button></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form Pembayaran -->
    <div class="card mb-4" id="paymentForm" style="display: none;">
        <div class="card-header">Form Pembayaran</div>
        <div class="card-body">
            <form method="POST" action="save_pembayaran.php">
                <input type="hidden" id="konsultasiId" name="konsultasi_id">
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="hidePaymentForm()">Batal</button>
            </form>
        </div>
    </div>

    <!-- Daftar Pembayaran -->
    <div class="card">
        <div class="card-header">Daftar Pembayaran</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>ID Konsultasi</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = $conn->query("SELECT * FROM pembayaran");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['konsultasi_id']}</td>
                                <td>{$row['jumlah']}</td>
                                <td>{$row['tanggal']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Tidak ada data pembayaran</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function showPaymentForm(konsultasiId) {
        document.getElementById('paymentForm').style.display = 'block';
        document.getElementById('konsultasiId').value = konsultasiId;
    }

    function hidePaymentForm() {
        document.getElementById('paymentForm').style.display = 'none';
    }
</script>
</body>
</html>
