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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message_id = $_POST['message_id'];

    // Update the status of the message to 'read' in your database
    $update_sql = "UPDATE messages SET status = 'read' WHERE message_id = '$message_id'";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: Inbox.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
