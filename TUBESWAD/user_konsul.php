<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immuniverse"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Dokter - User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5dc; /* Beige */
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #fdfaf1;
            border: 1px solid #e0e0d1;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #556b2f; /* Sage Green */
        }
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #556b2f;
            color: white;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #556b2f;
            border: none;
        }
        .btn-primary:hover {
            background-color: #6b8e23;
        }
        .btn-secondary {
            background-color: #d3d3c0;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #c2c2a8;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Konsultasi Dokter - User</h1>
        <hr>

        <!-- Form Input Konsultasi -->
        <div class="card">
            <div class="card-header">Form Konsultasi</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="dokter" class="form-label">Pilih Dokter</label>
                        <select name="dokter" id="dokter" class="form-control" required>
                            <option value="">-- Pilih Dokter --</option>
                            <?php
                            // Query untuk mendapatkan daftar dokter
                            $result = $conn->query("SELECT id, nama FROM dokter");

                            // Periksa jika query berhasil
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Tidak ada dokter tersedia</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jadwal" class="form-label">Jadwal Konsultasi</label>
                        <input type="datetime-local" name="jadwal" id="jadwal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea name="keluhan" id="keluhan" class="form-control" rows="3" placeholder="Masukkan keluhan Anda" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        // Proses pengiriman data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari formulir
            $dokter_id = $_POST['dokter'];
            $jadwal = $_POST['jadwal'];
            $keluhan = $_POST['keluhan'];

            // Validasi inputan
            if (empty($dokter_id) || empty($jadwal) || empty($keluhan)) {
                echo "<div class='alert alert-danger mt-3'>Semua field harus diisi!</div>";
            } else {
                // Simpan ke database menggunakan prepared statement
                $sql = "INSERT INTO konsultasi (dokter_id, jadwal, keluhan) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $dokter_id, $jadwal, $keluhan);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success mt-3'>Konsultasi berhasil disimpan!</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Gagal menyimpan konsultasi: " . $stmt->error . "</div>";
                }

                $stmt->close();
            }
        }
        ?>

    </div>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
