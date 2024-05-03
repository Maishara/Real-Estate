<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['submit'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $username = $_SESSION['Username'];
        $sql = "UPDATE user SET password='$new_password' WHERE Username='$username'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Fetch user type from the user table
            $sql = "SELECT User_Type FROM user WHERE Username='$username'";
            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userType = $row['User_Type'];

                // Update password based on user type
                if ($userType === 'Admin') {
                    $sql = "UPDATE a_reg SET password='$new_password' WHERE Username='$username'";
                } elseif ($userType === 'Agent') {
                    $sql = "UPDATE agent SET password='$new_password' WHERE Username='$username'";
                }

                mysqli_query($conn, $sql);
            }

            header('location: Signin.php'); 
            exit();
        } else {
            $error_message = "Password reset failed. Please try again.";
        }
    } else {
        $error_message = "Password and confirmation do not match.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>

<body>
    <center>
        <form method="POST">
            <fieldset style="width:30%">
                <legend><b>Reset Password</b></legend>
                <?php if (isset($error_message)) { ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php } ?>
                <table>
                    <tr>
                        <th>
                            <label for="new_password">New Password</label>
                        </th>
                        <td>:
                            <input type="password" id="new_password" name="new_password" required><br>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="confirm_password">Confirm Password</label>
                        </th>
                        <td>:
                            <input type="password" id="confirm_password" name="confirm_password" required><br>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <input type="submit" name="submit" value="Reset Password">
                        </th>
                        <td>
                            <a href="login.php">Back to Login</a><br>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </center>
</body>
</html>
