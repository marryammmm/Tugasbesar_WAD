<?php
session_start();

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

$stage = $_SESSION['stage'] ?? 'greeting';
$response = "";
$user_input = strtolower(trim($_POST['user_input'] ?? ''));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($stage === 'greeting') {
        $response = "Hallo Immunitezen! :) Apa yang kamu rasakan hari ini? (sakit/sehat)";
        $_SESSION['stage'] = 'check_health';
        // Simpan percakapan ke database (Create)
        $stmt = $conn->prepare("INSERT INTO conversations (user_input, bot_response) VALUES (?, ?)");
        $stmt->bind_param("ss", $user_input, $response);
        $stmt->execute();
    } elseif ($stage === 'check_health') {
        if ($user_input === 'sehat') {
            $response = "Senang mendengar itu! selalu jaga kesehatan yaa!!";
            $_SESSION['stage'] = 'end';
        } elseif ($user_input === 'sakit') {
            $response = "Apakah kepala mu sakit? (iya/tidak)";
            $_SESSION['stage'] = 'headache';
        } else {
            $response = "Mohon jawab dengan 'sakit' atau 'sehat'.";
        }
        // Simpan percakapan ke database (Create)
        $stmt = $conn->prepare("INSERT INTO conversations (user_input, bot_response) VALUES (?, ?)");
        $stmt->bind_param("ss", $user_input, $response);
        $stmt->execute();
    } elseif ($stage === 'headache') {
        if ($user_input === 'iya') {
            $response = "Istirahat yang cukup dan minum air putih yang banyak ya!";
            $_SESSION['stage'] = 'end';
        } elseif ($user_input === 'tidak') {
            $response = "Apakah kamu merasa mual? (iya/tidak)";
            $_SESSION['stage'] = 'nausea';
        } else {
            $response = "Mohon jawab dengan 'iya' atau 'tidak'.";
        }
        // Simpan percakapan ke database (Create)
        $stmt = $conn->prepare("INSERT INTO conversations (user_input, bot_response) VALUES (?, ?)");
        $stmt->bind_param("ss", $user_input, $response);
        $stmt->execute();
    } elseif ($stage === 'nausea') {
        if ($user_input === 'iya') {
            $response = "Minum obat lanzoprazol sebelum makan dan tunggu 30 menit, lalu makan yang cukup.";
            $_SESSION['stage'] = 'end';
        } elseif ($user_input === 'tidak') {
            $response = "Apakah kamu pilek? (iya/tidak)";
            $_SESSION['stage'] = 'cold';
        } else {
            $response = "Mohon jawab dengan 'iya' atau 'tidak'.";
        }
        // Simpan percakapan ke database (Create)
        $stmt = $conn->prepare("INSERT INTO conversations (user_input, bot_response) VALUES (?, ?)");
        $stmt->bind_param("ss", $user_input, $response);
        $stmt->execute();
    } elseif ($stage === 'cold') {
        if ($user_input === 'iya') {
            $response = "Istirahat yang cukup.";
            $_SESSION['stage'] = 'end';
        } elseif ($user_input === 'tidak') {
            $response = "Hallo Immunitezen! :) Apa yang kamu rasakan hari ini? (sakit/sehat)";
            $_SESSION['stage'] = 'check_health';
        } else {
            $response = "Mohon jawab dengan 'iya' atau 'tidak'.";
        }
        // Simpan percakapan ke database (Create)
        $stmt = $conn->prepare("INSERT INTO conversations (user_input, bot_response) VALUES (?, ?)");
        $stmt->bind_param("ss", $user_input, $response);
        $stmt->execute();
    } elseif ($stage === 'end') {
        $response = "Obrolan selesai. Semoga Anda sehat selalu!";
        session_destroy();
    }

    // Mengambil percakapan terakhir untuk dibaca (Read)
    $stmt = $conn->prepare("SELECT * FROM conversations ORDER BY created_at DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $last_conversation = $result->fetch_assoc();

    echo json_encode(['response' => $response, 'last_conversation' => $last_conversation]);
    exit;
}

// Menutup koneksi database
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immuniverse Counseling</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .chat-container {
            width: 100%;
            max-width: 400px;
            height: 90%;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .chat-header {
            background: #4caf50;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background: #f9f9f9;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .chat-message {
            max-width: 75%;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
        }
        .chat-message.user {
            align-self: flex-end;
            background: #4caf50;
            color: white;
        }
        .chat-message.bot {
            align-self: flex-start;
            background: #e0e0e0;
            color: #333;
        }
        .chat-footer {
            display: flex;
            padding: 10px;
            background: #fff;
            border-top: 1px solid #ddd;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            margin-right: 10px;
        }
        button {
            padding: 10px 15px;
            background: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #388e3c;
        }

        /* Responsiveness */
        @media (max-width: 600px) {
            .chat-container {
                max-width: 100%;
                height: 100%;
            }
        }
    </style>
    <script>
        async function sendInput() {
            const userInput = document.getElementById("user_input").value;
            const chatBody = document.querySelector(".chat-body");
            const formData = new FormData();
            formData.append("user_input", userInput);

            // Append user's message
            const userMessage = document.createElement("div");
            userMessage.className = "chat-message user";
            userMessage.textContent = userInput;
            chatBody.appendChild(userMessage);

            // Fetch bot response
            const response = await fetch("", { method: "POST", body: formData });
            const data = await response.json();

            // Append bot's message
            const botMessage = document.createElement("div");
            botMessage.className = "chat-message bot";
            botMessage.textContent = data.response;
            chatBody.appendChild(botMessage);

            chatBody.scrollTop = chatBody.scrollHeight;
            document.getElementById("user_input").value = "";
        }
    </script>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">Immuniverse</div>
        <div class="chat-body">
            <div class="chat-message bot">Hallo Immunitezen!</div>
        </div>
        <div class="chat-footer">
            <input type="text" id="user_input" placeholder="Ketik pesan Anda..." />
            <button onclick="sendInput()">Kirim</button>
        </div>
    </div>
</body>
</html>
