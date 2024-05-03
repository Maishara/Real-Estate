<html>
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
<body>

<h1>Inbox</h1>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display received messages
        echo '<div class="message">';
        echo "<p><strong>From:</strong> {$row['sender_username']}</p>";
        echo "<p><strong>Subject:</strong> {$row['subject']}</p>";
        echo "<p><strong>Message:</strong> {$row['content']}</p>";
        echo "<p><strong>Sent At:</strong> {$row['timestamp']}</p>";
        echo "<form action='../../ReadMessage.php' method='POST'>"; // Form to update message status
        echo "<input type='hidden' name='message_id' value='{$row['message_id']}'>";
        echo "<input type='submit' name='read' value='Mark as Read'>"; // Button to mark as read
        echo "</form>";
        echo '</div>';
    }
} else {
    echo "<p>No messages in the inbox.</p>";
}
?>

</body>
</html>
