<?php
function getUserDetails($conn, $username) {
    $sql = "SELECT * FROM a_reg WHERE Username='$username'";
    return mysqli_query($conn, $sql);
}

function updateUserDetails($conn, $name, $email, $password, $gender, $dob, $username) {
    $sql = "UPDATE a_reg SET Name='$name', Email='$email', Password='$password', Gender='$gender', Date_of_Birth='$dob' WHERE Username='$username'";
    return mysqli_query($conn, $sql);
}
?>
