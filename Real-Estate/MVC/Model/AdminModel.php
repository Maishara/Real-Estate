<?php
session_start();


function getUserDetails($conn, $loggedInUsername) {
    $sql = "SELECT * FROM a_reg WHERE Username='$loggedInUsername'";
    $res = mysqli_query($conn, $sql);
    // Fetch and return user details
    return $res;
}

// Add more functions for agent details, pending verifications, etc.
?>
