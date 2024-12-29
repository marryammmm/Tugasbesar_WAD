<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Immuniverse Chatbot</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        /* Global body styles */
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

        /* Chat container styles */
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

        /* Chat header styles */
        .chat-header {
            background: #4caf50; /* Green header */
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Chat body styles */
        .chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f9f9f9;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Chat message styles */
        .chat-message {
            max-width: 75%;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            word-wrap: break-word;
        }

        /* User message styles */
        .chat-message.user {
            align-self: flex-end;
            background: #4caf50;
            color: white;
        }

        /* Bot message styles */
        .chat-message.bot {
            align-self: flex-start;
            background: #e0e0e0;
            color: #333;
        }

        /* Chat footer styles */
        .chat-footer {
            display: flex;
            padding: 15px;
            background: #fff;
            border-top: 1px solid #ddd;
        }

        /* Textarea input styles */
        textarea {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            margin-right: 15px;
            background-color: #f0f8f4; /* Light sage green */
            color: #333;
            resize: none;
        }

        textarea::placeholder {
            color: #8e8e80; /* Sage green placeholder */
        }

        /* Button styles */
        button {
            padding: 6px 10px; /* Further reduced padding */
            background: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            font-size: 10px; /* Smaller font size */
        }

        button:hover {
            background: #388e3c;
        }

        /* Exit button styles */
        .exit-button {
            padding: 5px 10px;
            background: #e53935;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            cursor: pointer;
        }

        /* Media query for responsiveness */
        @media (max-width: 768px) {
            .chat-container {
                height: 90%;
                width: 100%;
            }
        }
    </style>
    <script>
        async function sendInput() {
    const chatBody = document.querySelector(".chat-body");
    const userMessage = document.getElementById("user_input").value;

    // Append user's message
    const userMessageElement = document.createElement("div");
    userMessageElement.className = "chat-message user";
    userMessageElement.textContent = userMessage;
    chatBody.appendChild(userMessageElement);

    chatBody.scrollTop = chatBody.scrollHeight;

    // Prepare form data
    const formData = new FormData();
    formData.append("user_input", userMessage);
    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    try {
    // Fetch bot response
    const response = await fetch("http://127.0.0.1:8000/chat", {
        method: "POST",
        headers: {
            "Accept": "application/json"
        },
        body: formData
    });

    const data = await response.json();

    // Append bot's message
    const botMessage = document.createElement("div");
    botMessage.className = "chat-message bot";
    botMessage.textContent = data.response;
    chatBody.appendChild(botMessage);

    // Check specific response to add a button
    if (data.response.includes("Boleh, silahkan melanjutkan ke halaman konsul, berikut jadwal dari dokter kami")) {
        const button = document.createElement("button");
        button.className = "schedule-button";
        button.textContent = "Lihat Jadwal Dokter";
        button.onclick = () => window.location.href = "/user/schedules";
        
        const buttonContainer = document.createElement("div");
        buttonContainer.style.textAlign = "center";
        buttonContainer.style.marginTop = "10px";
        buttonContainer.appendChild(button);
        
        chatBody.appendChild(buttonContainer);
    }

    chatBody.scrollTop = chatBody.scrollHeight;
    document.getElementById("user_input").value = "";
} catch (error) {
    console.error("Error sending input:", error);
}

}

    </script>
</head>

<body>
    <div class="chat-container">
        <div class="chat-header">
            <span>Immuniverse</span>
            <button class="exit-button" onclick="location.reload()">Keluar</button>
        </div>
        <div class="chat-body">
            <div class="chat-message bot">Halo Immunitezen! Bagaimana saya bisa membantu Anda?</div>
        </div>
        <div class="chat-footer">
            <textarea id="user_input" placeholder="Ketik pesan Anda..." rows="3"></textarea>
            <button onclick="sendInput()">Kirim</button>
        </div>
    </div>
</body>

</html>
