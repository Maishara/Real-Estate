<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM listing ";
$res = mysqli_query($conn, $sql);
?>