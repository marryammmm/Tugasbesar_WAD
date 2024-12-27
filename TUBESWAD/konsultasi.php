<?php
// Menghubungkan ke database
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
    <title>Konsultasi Dokter - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5dc;
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
            color: #556b2f;
        }
        .card-header {
            background-color: #556b2f;
            color: white;
        }
        .btn-primary {
            background-color: #556b2f;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Konsultasi Dokter - Admin</h1>
        <hr>

        <div class="card mb-4">
            <div class="card-header">Form Konsultasi</div>
            <div class="card-body">
                <form id="formKonsultasi">
                    <input type="hidden" id="konsultasiId">
                    <div class="mb-3">
                        <label for="dokter" class="form-label">Nama Dokter</label>
                        <input type="text" class="form-control" id="dokter" placeholder="Masukkan nama dokter" required>
                    </div>
                    <div class="mb-3">
                        <label for="jadwal" class="form-label">Jadwal</label>
                        <input type="datetime-local" class="form-control" id="jadwal" required>
                    </div>
                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keahlian</label>
                        <textarea class="form-control" id="keluhan" rows="3" placeholder="Masukkan keahlian dokter" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Daftar Konsultasi</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Jadwal</th>
                            <th>Keahlian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelKonsultasi">
                        <!-- Data akan di-load dari server -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let konsultasiList = [];

        async function loadKonsultasi() {
            try {
                const response = await fetch('load_konsultasi.php');
                if (!response.ok) {
                    throw new Error('Gagal memuat data');
                }
                konsultasiList = await response.json();
                renderTable();
            } catch (error) {
                console.error('Error loading data:', error);
                alert('Terjadi kesalahan saat memuat data konsultasi.');
            }
        }

        function renderTable() {
            const table = document.getElementById('tabelKonsultasi');
            table.innerHTML = '';
            konsultasiList.forEach((item, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.dokter}</td>
                        <td>${new Date(item.jadwal).toLocaleString()}</td>
                        <td>${item.keluhan}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editKonsultasi(${index})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteKonsultasi(${item.id})">Hapus</button>
                        </td>
                    </tr>`;
                table.innerHTML += row;
            });
        }

        document.getElementById('formKonsultasi').addEventListener('submit', async function (e) {
            e.preventDefault();

            const id = document.getElementById('konsultasiId').value;
            const dokter = document.getElementById('dokter').value.trim();
            const jadwal = document.getElementById('jadwal').value;
            const keluhan = document.getElementById('keluhan').value.trim();

            if (!dokter || !jadwal || !keluhan) {
                alert('Semua bidang harus diisi.');
                return;
            }

            try {
                const response = await fetch('save_konsultasi.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id, dokter, jadwal, keluhan }),
                });
                const result = await response.text();
                alert(result);
                loadKonsultasi();
                document.getElementById('formKonsultasi').reset();
            } catch (error) {
                console.error('Error saving data:', error);
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });

        function editKonsultasi(index) {
            const konsultasi = konsultasiList[index];
            document.getElementById('konsultasiId').value = konsultasi.id;
            document.getElementById('dokter').value = konsultasi.dokter;
            document.getElementById('jadwal').value = konsultasi.jadwal;
            document.getElementById('keluhan').value = konsultasi.keluhan;
        }

        async function deleteKonsultasi(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                try {
                    const response = await fetch('delete_konsultasi.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id }),
                    });
                    const result = await response.text();
                    alert(result);
                    loadKonsultasi();
                } catch (error) {
                    console.error('Error deleting data:', error);
                    alert('Terjadi kesalahan saat menghapus data.');
                }
            }
        }

        loadKonsultasi();
    </script>
</body>
</html>
