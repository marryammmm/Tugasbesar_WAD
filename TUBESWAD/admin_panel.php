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
    die("Connection failed: " . $conn->connect_error);
}

// Admin panel functions for adding, updating, and deleting responses
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        // Add a new chatbot response
        $stage = $_POST['stage'];
        $user_input = $_POST['user_input'];
        $bot_response = $_POST['bot_response'];

        $stmt = $conn->prepare("INSERT INTO chatbot_responses (stage, user_input, bot_response) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $stage, $user_input, $bot_response);
        $stmt->execute();
        $stmt->close();
    } elseif ($_POST['action'] == 'update') {
        // Update an existing response
        $id = $_POST['id'];
        $bot_response = $_POST['bot_response'];

        $stmt = $conn->prepare("UPDATE chatbot_responses SET bot_response = ? WHERE id = ?");
        $stmt->bind_param("si", $bot_response, $id);
        $stmt->execute();
        $stmt->close();
    } elseif ($_POST['action'] == 'delete') {
        // Delete a response
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM chatbot_responses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all responses for the admin
$responses = $conn->query("SELECT * FROM chatbot_responses ORDER BY created_at DESC");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Chatbot Responses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc; /* Beige background */
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1, h2 {
            color: #4c9a2a; /* Sage Green */
            text-align: center;
        }

        .admin-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-container {
            margin-bottom: 30px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input, .form-container textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-container button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #4c9a2a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #3a7d1b;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4c9a2a;
            color: white;
        }

        .actions button {
            background-color: #f1c40f;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .actions button:hover {
            background-color: #f39c12;
        }

        .textarea-update {
            width: 100%;
            max-width: 300px;
            margin: 5px;
        }

    </style>
</head>
<body>

    <!-- Admin Panel -->
    <div class="admin-container">
        <h1>Admin Panel - Manage Chatbot Responses</h1>

        <!-- Add Response Form -->
        <div class="form-container">
            <h2>Add New Response</h2>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <div>
                    <label for="stage">Stage:</label>
                    <input type="text" id="stage" name="stage" required>
                </div>
                <div>
                    <label for="user_input">User Input:</label>
                    <input type="text" id="user_input" name="user_input" required>
                </div>
                <div>
                    <label for="bot_response">Bot Response:</label>
                    <textarea id="bot_response" name="bot_response" rows="4" required></textarea>
                </div>
                <button type="submit">Add Response</button>
            </form>
        </div>

        <!-- Display Existing Responses -->
        <h2>Existing Responses</h2>
        <table>
            <tr>
                <th>Stage</th>
                <th>User Input</th>
                <th>Bot Response</th>
                <th>Actions</th>
            </tr>
            <?php if ($responses->num_rows > 0): ?>
                <?php while ($row = $responses->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['stage']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_input']); ?></td>
                        <td><?php echo htmlspecialchars($row['bot_response']); ?></td>
                        <td class="actions">
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <textarea class="textarea-update" name="bot_response" rows="2"><?php echo htmlspecialchars($row['bot_response']); ?></textarea>
                                <button type="submit">Update</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">No responses found.</td></tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>
