<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in user's username
$loggedInUsername = $_SESSION['Username'];

// Fetch received messages for the logged-in user from the database
$sql = "SELECT * FROM messages WHERE receiver_username = '$loggedInUsername' ORDER BY timestamp DESC";
$result = $conn->query($sql);

echo '<html>
<head>
    <title>Inbox</title>
    <style>
        .message {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
        }
        .message p {
            margin: 5px 0;
        }
    </style>
</head>
<body>';

echo '<h1>Inbox</h1>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display received messages
        echo '<div class="message">';
        echo "<p><strong>From:</strong> {$row['sender_username']}</p>";
        echo "<p><strong>Subject:</strong> {$row['subject']}</p>";
        echo "<p><strong>Message:</strong> {$row['content']}</p>";
        echo "<p><strong>Sent At:</strong> {$row['timestamp']}</p>";
        echo "<form action='ReadMessage.php' method='POST'>"; // Form to update message status
        echo "<input type='hidden' name='message_id' value='{$row['message_id']}'>";
        echo "<input type='submit' name='read' value='Mark as Read'>"; // Button to mark as read
        echo "</form>";
        echo '</div>';
    }
} else {
    echo "<p>No messages in the inbox.</p>";
}

echo '</body>
</html>';

$conn->close();
?>
