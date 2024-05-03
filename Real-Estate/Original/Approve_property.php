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

$location = $_GET['location'];
$action = $_GET['action'];

if ($_SESSION['User_Type'] == 'Admin') {
    if ($action === 'approve') {
        $sql = "UPDATE listing SET verified = 1, decision = 'approved' WHERE location='$location'";
    } elseif ($action === 'reject') {
        $sql = "UPDATE listing SET verified = 0, decision = 'rejected' WHERE location='$location'";

    }

    if (mysqli_query($conn, $sql)==TRUE) {
        header("Location: Admin_Display.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Unauthorized access.";
}

$conn->close();
?>