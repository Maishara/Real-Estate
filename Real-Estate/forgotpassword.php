<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";
 
$conn = new mysqli($servername, $username, $password, $dbname);
 
if (isset($_POST['submit'])) {
    $username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING);
    $ans1 = htmlspecialchars($_POST['ans1']);
    $ans2 = htmlspecialchars($_POST['ans2']);
 
    $sql = "SELECT * FROM user WHERE Username='$username' AND ans1='$ans1' AND ans2='$ans2'";
    $result = mysqli_query($conn, $sql);
 
    if ($result->num_rows > 0) {
        $_SESSION['Username'] = $username; 
        header('location: resetPassword.php');
    } else {
        $error_message = "Incorrect answers. Please try again.";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
 
<body>
    <center>
        <form method="POST">
            <fieldset style="width:30%">
                <legend><b>Forgot Password</b></legend>
                <?php if (isset($error_message)) { ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php } ?>
                <table>
                    <tr>
                        <th>
                            <label for="username">Username</label>
                        </th>
                        <td>:
                            <input type="text" id="username" name="Username"><br>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="ans1">In what city were you born?</label>
                        </th>
                        <td>:
                            <input type="text" id="ans1" name="ans1"><br>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="ans2">What was the name of your first school?</label>
                        </th>
                        <td>:
                            <input type="text" id="ans2" name="ans2"><br>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <input type="submit" name="submit" value="Submit">
                        </th>
                        <td>
                            <a href="Signin.php">Back to Login</a><br>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </center>
</body>
</html>
 