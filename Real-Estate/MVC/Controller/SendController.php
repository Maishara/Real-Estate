<?php
session_start();
require_once('../Model/SendModel.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara"; // Replace with your actual database name
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $sender = $_SESSION['Username'];
    $receiver = $_POST['receiver'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $result = sendMessage($conn, $sender, $receiver, $subject, $message);

    if ($result === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
