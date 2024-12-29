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

// Query untuk mengambil data artikel
$query = "SELECT title, summary, image_url, video_url FROM articles"; // Tambahkan kolom video_url
$result = $conn->query($query);

// Memeriksa apakah query berhasil
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Kesehatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --main-color: #91AC8F; /* Hijau pastel */
            --secondary-color: #859F3D; /* Hijau lebih tua */
            --accent-color: #A5B68D; /* Hijau gelap */
            --text-color: #2F4F4F; /* Hijau tua */
            --background-color: #E9EED9; /* Latar belakang terang */
            --hover-color: #A5B68D; /* Warna hover */
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(45deg, var(--main-color), var(--secondary-color));
            text-align: center;
            padding: 40px 20px;
            color: white;
            border-bottom: 5px solid var(--accent-color);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin: 0;
        }

        .header p {
            font-size: 1.5rem;
            margin: 10px 0;
            font-weight: 300;
        }

        .container {
            padding: 30px;
            padding-bottom: 70px; /* Menambah ruang untuk footer */
        }

        .article-card {
            background-color: white;
            border: 2px solid var(--main-color);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: row;
            gap: 20px;
            align-items: center;
        }

        .article-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .article-card img {
            border-radius: 10px;
            width: 300px;
            height: 200px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .article-card .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .article-card h2 {
            font-size: 2rem;
            color: var(--accent-color);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .article-card p {
            font-size: 1.1rem;
            color: var(--text-color);
            line-height: 1.6;
            margin: 0;
            margin-bottom: 15px;
        }

        .btn-custom {
            background-color: var(--accent-color);
            color: white;
            border-radius: 50px;
            padding: 12px 24px;
            border: none;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            align-self: flex-start;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--hover-color);
        }

        .footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            left: 0;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }

            .header p {
                font-size: 1.2rem;
            }

            .article-card {
                flex-direction: column;
                text-align: center;
            }

            .article-card img {
                width: 100%;
                height: auto;
            }

            .article-card h2 {
                font-size: 1.7rem;
            }

            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Artikel Immuniverse</h1>
        <p>Temukan informasi kesehatan terkini dan terpercaya</p>
    </div>

    <div class="container">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="article-card">
                <img src="<?= $row['image_url']; ?>" alt="Article Image">
                <div class="content">
                    <h2><?= $row['title']; ?></h2>
                    <p><?= $row['summary']; ?></p>
                    <!-- Tombol "Watch Video" yang mengarah ke video YouTube -->
                    <a href="<?= $row['video_url']; ?>" target="_blank" class="btn btn-custom">Watch Video</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="footer">
        <p>&copy; 2024 Artikel Immuniverse. Semua hak dilindungi.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Menutup koneksi database
$conn->close();
?>
