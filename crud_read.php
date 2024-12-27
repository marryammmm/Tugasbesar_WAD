<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Artikel Immuniverse</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E9EED9; /* Warna beige sebagai background */
            color: #4CAF50; /* Warna hijau pastel untuk teks utama */
            font-family: 'Arial', sans-serif;
        }
        .header {
            background: linear-gradient(135deg, #91AC8F, #859F3D); /* Hijau pastel dan hijau lebih gelap */
            padding: 20px;
            text-align: center;
            color: white;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .header p {
            margin: 0;
            font-size: 1.2rem;
        }
        .article-card {
            background-color: #FFFFFF; /* Latar belakang kartu artikel putih */
            border: none;
            border-radius: 15px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .article-card img {
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }
        .article-card .content {
            flex: 1;
        }
        .footer {
            background-color: #91AC8F; /* Warna hijau pastel */
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 20px 20px 0 0;
            margin-top: 50px;
        }
        .btn-custom {
            background-color: #4CAF50; /* Hijau pastel untuk tombol */
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #388E3C; /* Hijau lebih gelap saat hover */
        }
        .btn-danger {
            background-color: #FFCDD2; /* Warna merah muda untuk tombol hapus */
            border-radius: 50px;
        }
        .btn-danger:hover {
            background-color: #E57373; /* Merah lebih gelap saat hover */
        }
        .btn-primary {
            border-radius: 50px;
        }
        .modal-content {
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Artikel Immuniverse</h1>
        <p>Temukan informasi kesehatan terkini dan terpercaya</p>
    </div>

    <div class="container my-5">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "immuniverse";

        // Koneksi ke database
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['add'])) {
                // Menangani penambahan artikel baru
                $title = $_POST['title'];
                $summary = $_POST['summary'];
                $image_url = '';
                $video_url = $_POST['video_url']; // Menambahkan URL video

                // Menangani upload gambar
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $target_dir = "uploads/"; // Folder untuk menyimpan gambar
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);

                    // Cek jika file sudah ada
                    if (file_exists($target_file)) {
                        echo "File sudah ada.";
                    } else {
                        // Pastikan folder uploads ada
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0777, true); // Membuat folder uploads jika belum ada
                        }

                        // Pindahkan file ke folder target
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $image_url = $target_file;
                        } else {
                            echo "Terjadi kesalahan saat mengunggah file.";
                        }
                    }
                }

                // Menyimpan data artikel ke database
                $sql = "INSERT INTO articles (title, summary, image_url, video_url) VALUES ('$title', '$summary', '$image_url', '$video_url')";
                $conn->query($sql);
            } elseif (isset($_POST['delete'])) {
                // Menangani penghapusan artikel
                $id = $_POST['id'];
                $sql = "DELETE FROM articles WHERE id=$id";
                $conn->query($sql);
            } elseif (isset($_POST['update'])) {
                // Menangani pembaruan artikel
                $id = $_POST['id'];
                $title = $_POST['title'];
                $summary = $_POST['summary'];
                $image_url = $_POST['image_url']; // Gambar lama tetap digunakan jika tidak ada gambar baru
                $video_url = $_POST['video_url']; // Menambahkan URL video

                // Menangani upload gambar jika ada
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);

                    // Cek jika file sudah ada
                    if (file_exists($target_file)) {
                        echo "File sudah ada.";
                    } else {
                        // Pastikan folder uploads ada
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0777, true); // Membuat folder uploads jika belum ada
                        }

                        // Pindahkan file ke folder target
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $image_url = $target_file;
                        } else {
                            echo "Terjadi kesalahan saat mengunggah file.";
                        }
                    }
                }

                // Update artikel di database
                $sql = "UPDATE articles SET title='$title', summary='$summary', image_url='$image_url', video_url='$video_url' WHERE id=$id";
                $conn->query($sql);
            }
        }

        // Menampilkan artikel
        $sql = "SELECT * FROM articles";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<div class='article-card'>";
            echo "<img src='" . $row['image_url'] . "' alt='Article Image' class='img-fluid'>";
            echo "<div class='content'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p>" . $row['summary'] . "</p>";

            // Menampilkan video jika ada
            if (!empty($row['video_url'])) {
                echo "<div class='my-3'>";
                echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/" . parse_youtube_id($row['video_url']) . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                echo "</div>";
            }

            echo "<div class='d-flex justify-content-start mt-3'>";
            echo "<form method='post' class='d-inline me-2'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<button name='delete' class='btn btn-danger'>Hapus</button>";
            echo "</form>";
            echo "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateModal' onclick='fillUpdateForm(`{$row['id']}`, `{$row['title']}`, `{$row['summary']}`, `{$row['image_url']}`, `{$row['video_url']}`)'>Edit</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        $conn->close();

        // Fungsi untuk mengambil ID video YouTube
        function parse_youtube_id($url) {
            preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/[^\n\s]+|(?:v|e(?:mbed)?)\/([^\/\n\s]+))|youtu\.be\/([^\/\n\s]+))/', $url, $matches);
            return $matches[1] ?? $matches[2] ?? '';
        }
        ?>

        <button class="btn btn-custom my-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Artikel</button>

        <!-- Modal untuk menambah artikel -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Artikel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="summary" class="form-label">Ringkasan</label>
                                <textarea class="form-control" name="summary" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="video_url" class="form-label">URL Video YouTube</label>
                                <input type="text" class="form-control" name="video_url" placeholder="https://www.youtube.com/watch?v=video_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="add" class="btn btn-custom">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal untuk mengedit artikel -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Edit Artikel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="update-id">
                            <div class="mb-3">
                                <label for="update-title" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="title" id="update-title" required>
                            </div>
                            <div class="mb-3">
                                <label for="update-summary" class="form-label">Ringkasan</label>
                                <textarea class="form-control" name="summary" id="update-summary" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="update-image" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="image" id="update-image" accept="image/*">
                                <input type="hidden" name="image_url" id="update-image-url">
                            </div>
                            <div class="mb-3">
                                <label for="update-video_url" class="form-label">URL Video YouTube</label>
                                <input type="text" class="form-control" name="video_url" id="update-video_url" placeholder="https://www.youtube.com/watch?v=video_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="update" class="btn btn-custom">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Artikel Immuniverse. Semua hak dilindungi.</p>
    </div>

    <script>
        function fillUpdateForm(id, title, summary, imageUrl, videoUrl) {
            document.getElementById('update-id').value = id;
            document.getElementById('update-title').value = title;
            document.getElementById('update-summary').value = summary;
            document.getElementById('update-image-url').value = imageUrl;
            document.getElementById('update-video_url').value = videoUrl;
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
