<?php
function sendMessage($conn, $sender, $receiver, $subject, $message) {
    $sql = "INSERT INTO messages (sender_username, receiver_username, subject, content, timestamp) VALUES ('$sender', '$receiver', '$subject', '$message', NOW())";

    return $conn->query($sql);
}
?>
