<?php 
$errors=$data=array();
session_start();
$servername="localhost";
$username="root";
$pass="";
$dbname="maishara";
$conn= new mysqli($servername,$username,$pass,$dbname);


 if(isset($_POST['Register'])) {
    $uname = $_POST['Username'];
    $email = $_POST['Email'];
    $lnumber = $_POST['License_Number'];
    $pass = $_POST['Password'];
    $repass = $_POST['Rpassword'];
    $utype= $_POST['User_Type'];
    $phone= $_POST['Phone'];
    $ans1=$_POST['ans1'];
    $ans2=$_POST['ans2'];
 
    // Validate Name
    if (empty($uname)) {
        $errors[] = "Username is required.";
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
    if (empty($lnumber)) {
        $errors[] = "License is required.";
        echo "License is required.";
    } 
 
    // Validate Password
    if (empty($pass)) {
        $errors[] = "Password is required.";
        echo "Password is required.";
    } elseif (strlen($pass) < 6) {
        $errors[] = "Password should be at least 6 characters long.";
        echo "Password should be at least 6 characters long.";
    } elseif (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).+$/", $pass)) {
        $errors[] = "Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        echo "Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
 
    }
 
    // Validate Confirm Password
    if (empty($repass) || $pass != $repass) {
        $errors[] = "Passwords do not match. Please try again.";
        echo "Passwords do not match. Please try again.";
    }
 
   
    // Validate User Type
    if (empty($utype)) {
        $errors[] = "User Type is required.";
        echo "User Type is required.";
    }

    if (empty($ans1)) {
        $errors[] = "Field cannot be empty";
        echo "Field cannot be empty";
    }
    if (empty($ans2)) {
        $errors[] = "Field cannot be empty";
        echo "Field cannot be empty";
    }
 
    if (empty($errors)) {
        
       $sql2 = ("Insert into agent (Username,Email,License_Number,Password,User_Type,Phone,ans1,ans2) Values ('$uname', '$email', '$lnumber', '$pass','$utype','$phone','$ans1','$ans2')");
       mysqli_query($conn,$sql2);
       $sql3=("Insert into user (Username,Password, User_Type,ans1,ans2) Values ( '$uname', '$pass','$utype','$ans1','$ans2')");
       mysqli_query($conn,$sql3);
 
        $_SESSION['Username'] = $uname;
        $_SESSION['User_Type'] = $utype;
        session_destroy();
        header("Location: Registration.php");
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







$sql="select * from agent";
$res= mysqli_query($conn,$sql);


?>



<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h1>Registration form</h1>

<form method="POST" action="Registration.php">
Username<input type="text" name="Username"><br>
<br>
Email:<input type="text" name="Email"><br>
<br>
License_Number:<input type="text" name="License_Number"><br>
<br>
Password:<input type="password" name="Password"><br>
<br>
Retype Password:<input type="password" name="Rpassword"><br>
<br>

User Type:<input type="text" name="User_Type" value="Agent"><br>
<br>
Phone number:<input type="number" name="Phone"><br>
<br>
<br>
<b>Security Questions</b><br>
In what city were you born<input type="text" id="ans1" name="ans1" value="<?php if (isset($data['ans1'])) echo $data['ans1']; ?>"><br><br>
What was the name of your first school?<input type="text" id="ans2" name="ans2" value="<?php if (isset($data['ans2'])) echo $data['ans2']; ?>"><br><br>
<input type="submit" name="Register" value="Register">
 <br>
 <a href= "Signin.php"> Click here to Login </a>
 
</form>



</body>
</html>
