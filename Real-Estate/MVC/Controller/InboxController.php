<?php

require_once('../Model/InboxModel.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loggedInUsername = $_SESSION['Username'];

$result = fetchReceivedMessages($conn, $loggedInUsername);

include '../Views/InboxView.php';

$conn->close();
?>
