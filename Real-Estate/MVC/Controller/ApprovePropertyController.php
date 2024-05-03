<?php
session_start();
require_once('../Model/AdminDisplayModel.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$location = $_GET['location'];
$action = $_GET['action'];

if ($_SESSION['User_Type'] == 'Admin') {
    $result = updatePropertyVerification($conn, $location, $action);

    if ($result === TRUE) {
        header("Location: ../Views/AdminDisplayView.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Unauthorized access.";
}

$conn->close();
?>
