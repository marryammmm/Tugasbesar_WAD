<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5dc; /* Beige background */
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin-top: 40px;
            flex: 1;
        }

        .alert {
            font-size: 16px;
            border-radius: 8px;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .btn-primary, .btn-success, .btn-warning, .btn-danger {
            border-radius: 20px;
            border: none;
        }

        /* Edit button (yellow) */
        .btn-warning {
            background-color: #ffc107; /* Yellow color */
        }

        .btn-warning:hover {
            background-color: #e0a800; /* Darker yellow for hover */
        }

        /* Delete button (red) */
        .btn-danger {
            background-color: #dc3545; /* Red color */
        }

        .btn-danger:hover {
            background-color: #c82333; /* Darker red for hover */
        }

        footer {
            background-color: #b4bfa1; /* Sage footer color */
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: 30px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: #fff;
            text-decoration: none;
        }

        h1 {
            text-align: center; /* Centering the title */
        }

        /* Card headers and content */
        .card-header {
            font-size: 1.25rem;
            font-weight: 600;
            background-color: #f1f1f1;
        }

        .card-body {
            font-size: 1rem;
            color: #555;
        }

        /* Button enhancements */
        .btn {
            padding: 8px 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Immuniverse | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
