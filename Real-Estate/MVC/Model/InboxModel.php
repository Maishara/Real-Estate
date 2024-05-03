<?php
session_start();

function fetchReceivedMessages($conn, $loggedInUsername) {
    $sql = "SELECT * FROM messages WHERE receiver_username = '$loggedInUsername' ORDER BY timestamp DESC";
    return $conn->query($sql);
}
?>
