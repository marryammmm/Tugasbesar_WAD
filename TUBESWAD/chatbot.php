<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immuniverse";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['response' => 'Connection failed: ' . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_input = strtolower(trim($_POST['user_input'] ?? '')); // Normalize input to lowercase
    $stage = $_SESSION['stage'] ?? 'greeting'; // Default stage is 'greeting'
    $response = "";

    if ($user_input === 'keluar') {
        session_destroy();
        echo json_encode(['response' => 'Terima kasih telah menggunakan Immuniverse. Sampai jumpa!']);
        exit;
    }

    // Use prepared statement to fetch the bot's response
    $stmt = $conn->prepare("SELECT bot_response FROM chatbot_responses WHERE stage = ? AND LOWER(user_input) = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("ss", $stage, $user_input);
        $stmt->execute();
        $stmt->bind_result($response);
        $stmt->fetch();
        $stmt->close();
    } else {
        $response = "Maaf, terjadi kesalahan pada sistem. Mohon coba lagi nanti.";
    }

    // Handle unknown input
    if (!$response) {
        // Provide fallback response specific to the stage
        switch ($stage) {
            case 'greeting':
                $response = "Halo Immunitezen! Bagaimana saya bisa membantu Anda?";
                break;
            case 'check_health':
                $response = "Mohon maaf, saya tidak memahami permintaan Anda. Coba tanyakan tentang kesehatan Anda.";
                break;
            case 'closing':
                $response = "Terima kasih telah menggunakan Immuniverse. Sampai jumpa lagi!";
                break;
            default:
                $response = "Maaf, saya tidak mengerti. Mohon coba lagi.";
                break;
        }
    }

    // Update session stage based on the current stage and user input
    switch ($stage) {
        case 'greeting':
            $_SESSION['stage'] = 'check_health';
            break;
        case 'check_health':
            $_SESSION['stage'] = 'closing';
            break;
        case 'closing':
            $_SESSION['stage'] = 'greeting';
            break;
        default:
            $_SESSION['stage'] = 'greeting';
            break;
    }

    // Respond back to the user
    echo json_encode(['response' => $response]);
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immuniverse Counseling</title>
    <style>
        /* Styles for the chat interface */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc; /* Beige background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .chat-container {
            width: 100%;
            max-width: 450px;
            height: 80%;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .chat-header {
            background: #4caf50; /* Green header */
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f9f9f9;
            display: flex;
            flex-direction: column;
            gap: 15px;
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
            padding: 15px;
            background: #fff;
            border-top: 1px solid #ddd;
        }
        input[type="text"] {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            margin-right: 15px;
            background-color: #f0f8f4; /* Light sage green */
            color: #333;
        }
        input[type="text"]::placeholder {
            color: #8e8e80; /* Sage green placeholder */
        }
        button {
            padding: 12px 18px;
            background: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            font-size: 14px;
        }
        button:hover {
            background: #388e3c;
        }
        /* Responsiveness */
        @media (max-width: 768px) {
            .chat-container {
                height: 90%;
                width: 100%;
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
        <div class="chat-header">Immuniverse
            <button onclick="location.reload()" style="float: right; padding: 5px 10px; background: #e53935; color: white; border: none; border-radius: 5px; font-size: 12px;">Keluar</button>
        </div>
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
