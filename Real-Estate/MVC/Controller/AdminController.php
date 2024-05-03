<?php

include '../Model/AdminModel.php';

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "maishara";
$conn = new mysqli($servername, $username, $pass, $dbname);

$loggedInUsername = $_SESSION['Username'];

$userDetails = getUserDetails($conn, $loggedInUsername);

// Handle logout
if(isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../Views/SigninView.php');
    exit();
}


?>
