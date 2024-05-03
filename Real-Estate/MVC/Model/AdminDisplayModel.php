<?php
session_start();

function fetchPendingListings() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "maishara";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM listing";
    $result = $conn->query($sql);
    $listings = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $listings[] = $row;
        }
    }

    $conn->close();
    return $listings;
}
// Define the function to update the property verification status
function updatePropertyVerification($conn, $location, $action) {
    if ($action === 'approve') {
        $sql = "UPDATE listing SET verified = 1, decision = 'approved' WHERE location='$location'";
    } elseif ($action === 'reject') {
        $sql = "UPDATE listing SET verified = 0, decision = 'rejected' WHERE location='$location'";
    }

    return mysqli_query($conn, $sql);
}

?>
