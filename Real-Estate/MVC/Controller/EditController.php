<?php
session_start();
require_once('../Model/EditModel.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_GET["edit"];
$userDetails = getUserDetails($conn, $username);

if (isset($_GET['submit'])) {
    $A_name = $_GET['Name'];
    $email = $_GET['Email'];
    $username = $_GET['Username'];
    $password = $_GET['Password'];
    $gender = $_GET['Gender'];
    $dob = $_GET['Date_of_Birth'];
    $utype = $_GET['User_Type'];

    updateUserDetails($conn, $A_name, $email, $password, $gender, $dob, $username);
    header("location:../Views/AdminView.php");
}

include '../Views/EditView.php';
$conn->close();
?>
