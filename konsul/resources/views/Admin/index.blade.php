<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat Interface</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5dc; /* Beige */
            font-family: 'Arial', sans-serif;
            color: #4a4a4a;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        h1 {
            font-weight: bold;
            color: #3e7d64; /* Sage */
            margin-bottom: 30px;
        }

        .card {
            background-color: #e7f2e9; /* Sage */
            border: none;
            border-radius: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #3e7d64; /* Sage (darker) */
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .message-box {
            margin-bottom: 20px;
        }

        .message-box p {
            margin: 0;
            padding: 0;
        }

        .message-box strong {
            color: #3e7d64; /* Sage */
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 15px 0;
            background-color: #3e7d64; /* Sage */
            color: white;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: #3e7d64;
            border: none;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background-color: #356a55;
        }

        textarea,
        select {
            border: 1px solid #ced4da;
            border-radius: 10px;
        }

        textarea:focus,
        select:focus {
            outline: none;
            border-color: #3e7d64;
            box-shadow: 0px 0px 5px rgba(62, 125, 100, 0.5);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Immuniverse Admin Chat Interface</h1>

        <!-- Display success message -->
        @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <!-- Riwayat Percakapan -->
        <div class="card">
            <div class="card-header">
                <h5>Riwayat Percakapan</h5>
            </div>
            <div class="card-body">
                @if($conversations->count() > 0)
                @foreach($conversations as $conversation)
                <div class="message-box">
                    <p><strong>User:</strong> {{ $conversation->user_input }}</p>
                    <p><strong>Bot/Admin:</strong> {{ $conversation->bot_response }}</p>
                    <!-- Tombol Edit dan Delete -->
                    <div class="d-flex justify-content-end">
                        <!-- Tombol Edit -->
                        <button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $conversation->id }}">Edit</button>

                        <!-- Tombol Delete -->
                        <form action="{{ route('chat.destroy', $conversation->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus percakapan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                    <hr>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $conversation->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $conversation->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $conversation->id }}">Edit Percakapan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('chat.update', $conversation->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="user_input{{ $conversation->id }}" class="form-label">User Input:</label>
                                        <textarea name="user_input" id="user_input{{ $conversation->id }}" class="form-control" required>{{ $conversation->user_input }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bot_response{{ $conversation->id }}" class="form-label">Bot Response:</label>
                                        <textarea name="bot_response" id="bot_response{{ $conversation->id }}" class="form-control" required>{{ $conversation->bot_response }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>Belum ada percakapan.</p>
                @endif
            </div>
        </div>

        <!-- Form Kirim Pesan Admin dan Update Respon Chatbot -->
        <div class="card">
            <div class="card-header">
                <h5>Kirim Pesan ke User & Update Respon Chatbot</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('chat.send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="admin_message" class="form-label">Pesan User:</label>
                        <textarea name="admin_message" id="admin_message" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="stage" class="form-label">Stage:</label>
                        <select name="stage" id="stage" class="form-control" required>
                            <option value="greeting">Greeting</option>
                            <option value="check_health">Check Health</option>
                            <option value="closing">Closing</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="chatbot_response" class="form-label">Respon Chatbot:</label>
                        <textarea name="chatbot_response" id="chatbot_response" rows="3" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim Pesan & Update Respon</button>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Immuniverse Admin Chat Interface. Built with care for the community.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
