<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body style="background-image: url('Signin.png'); background-size: cover;">
    <center>
    <h1><a href="../../Homepage.php">BD Homes</a></h1>

        <form method="GET" action="../Controller/SigninController.php">
            <fieldset style="background-color: rgba(255, 255, 255, 0.9); padding: 10px;">
                <legend><b>LOGIN</b></legend>
                <table>
                    <tr>
                        <td><label for="Username">Username :</label></td>
                        <td><input type="text" id="Username" name="Username"><br></td>
                    </tr>
                    <tr>
                        <td><label for="Password">Password :</label></td>
                        <td><input type="Password" id="Password" name="Password" placeholder="<=8 chars, use(@,#,$,%)"><br></td>
                    </tr>
                </table>
                <p>____________________________________________</p>
                <input type="submit" name="submit" value="Login">
                <a href="../../forgotpassword.php">Forgot Password?</a>
            </fieldset>
            <a href="Icon.php">Don't have an account? Click here to register</a>
        </form>
    </center>
</body>
</html>
