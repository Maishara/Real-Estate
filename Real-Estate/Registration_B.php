<?php
 
session_start();
$servername="localhost";
$username="root";
$pass="";
$dbname="maishara";
$conn= new mysqli($servername,$username,$pass,$dbname);
if(isset($_GET['submit'])) 
{
    $B_name = $_GET['Name'];
    $email = $_GET['Email'];
    $Username = $_GET['Username'];
    $Password = $_GET['Password'];
    $Rpass = $_GET['Confirm_Password'];
    $gender= $_GET['Gender'];
    $dob= $_GET['Date_of_Birth'];
    $utype= $_GET['User_Type'];
 
    $errors = [];
 
    // Validate Name
    if (empty($B_name)) {
        $errors[] = "Name is required.";
        echo "Name is required.";
    }
 
    // Validate Email
    if (empty($email)) {
        $errors[] = "Email is required.";
        echo "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email. Please provide a valid email address.";
        echo "Invalid Email. Please provide a valid email address.";
    }
 
    // Validate Username
    if (empty($Username)) {
        $errors[] = "Username is required.";
        echo "Username is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $Username)) {
        $errors[] = "Invalid Username. Please use only letters and numbers.";
        echo "Invalid Username. Please use only letters and numbers.";
    }
 
    // Validate Password
    if (empty($Password)) {
        $errors[] = "Password is required.";
        echo "Password is required.";
    } elseif (strlen($Password) < 6) {
        $errors[] = "Password should be at least 6 characters long.";
        echo "Password should be at least 6 characters long.";
    } elseif (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).+$/", $Password)) {
        $errors[] = "Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        echo "Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
 
    }
 
    // Validate Confirm Password
    if (empty($Rpass) || $Password != $Rpass) {
        $errors[] = "Passwords do not match. Please try again.";
        echo "Passwords do not match. Please try again.";
    }
 
    // Validate Gender
    if (empty($gender)) {
        $errors[] = "Gender is required.";
        echo "Gender is required.";
    }
 
    // Validate Date of Birth
    if (empty($dob) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $dob)) {
        $errors[] = "Invalid Date of Birth. Please use the format YYYY-MM-DD.";
        echo "Invalid Date of Birth. Please use the format YYYY-MM-DD.";
    }
 
    // Validate User Type
    if (empty($utype)) {
        $errors[] = "User Type is required.";
        echo "User Type is required.";
    }
 
    if (empty($errors)) {
        // Insert data into the database and proceed with registration
       $sql2 = ("Insert into B_Reg (Name,Email,Username,Password,Gender,Date_of_Birth, User_Type) Values ('$B_name', '$email', '$Username', '$Password','$gender','$dob','$utype')");
       mysqli_query($conn,$sql2);
       $sql3=("Insert into user (Username,Password, User_Type) Values ( '$Username', '$Password','$utype')");
       mysqli_query($conn,$sql3);
 
        $_SESSION['Username'] = $Username;
        $_SESSION['User_Type'] = $utype;
        session_destroy();
        header("Location: Welcome_B.php");
        exit();
    }
 
    
 
    /*if($Password==$Rpass)
    {
    $sql2 = ("Insert into A_Reg (Name,Email,Username,Password,Confirm_Password,Gender,Date_of_Birth, User_Type) Values ('$A_name', '$email', '$Username', '$Password','$Rpass','$gender','$dob','$utype')");
    mysqli_query($conn,$sql2);
    $sql3=("Insert into login (Username,Password) Values ('$Username','$Password')");
    mysqli_query($conn,$sql3);
    $_SESSION['Username'] = $Username;
    $_SESSION['User_Type'] = $utype;
    header("Location: Welcome.php");
    echo "Registration done successfully!";
    exit(); 
    }
    else 
    {
        echo "Passwords do not match. Please try again.";
    }*/
}

 

$sql="select * from B_Reg";
$res= mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
 
<html>
<head>
<title>Registration</title>
</head>
<body>
<center>
<form method="GET">
<fieldset style="width:50%">
<legend><b>REGISTRATION</b></legend>
<table>
<tr>
<td width="200">
<label align="left" for="Name">Name </label>
</td>
<td>
                        :<input type="text" name="Name" />
</td>
</tr>
<tr>
<td width="200">
<label align="left" for="Email">Email</label>
</td>
<td>
                        :<input required type="email" name="Email" />
</td>
</tr>
<tr>
<td width="200">
<label align="left" for="Username">Username</label>
</td>
<td>
                        :<input required type="text" name="Username" />
</td>
</tr>
<tr>
<td width="200">
<label align="left" for="Password">Password </label>
</td>
<td>
                        :<input required type="Password" name="Password" />
</td>
</tr>
<tr>
<td width="200">
<label align="left" for="Confirm_Password">Confirm Password </label>
</td>
<td>
                        :<input required type="Password" name="Confirm_Password" />
</td>
</tr>
<tr>
<td width="200" colspan="2">
<fieldset>
<legend>Gender</legend>
<input type="radio" id="male" name="Gender" value="Male" />
<label for="male">Male</label>
<input type="radio" id="female" name="Gender" value="Female" />
<label for="female">Female</label>
<input type="radio" id="others" name="Gender" value="Others" />
<label for="others">Others</label>
</fieldset>
</td>
</tr>
<tr>
<td width="200" colspan="2">
<fieldset>
<legend>Date of Birth</legend>
 
                            <input type="date" name="Date_of_Birth" />
</fieldset>
</td>
</tr>
<tr>
<td width="200">
<label align="left" for="User_Type">User_Type </label>
</td>
<td>
                        :<input required type="text" name="User_Type" value="Buyer"/>
</td>
</tr>
<tr>
<td align="left" colspan="2">
<input type="submit" name="submit"/>
</td>
</tr>
 
            </table>
</fieldset>
<a href="Signin.php">Signin Page</a>
</form>
</center>
</body>
</html>