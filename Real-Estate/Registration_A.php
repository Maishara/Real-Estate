<?php
 $errors=$data=array();
session_start();
$servername="localhost";
$username="root";
$pass="";
$dbname="maishara";
$conn= new mysqli($servername,$username,$pass,$dbname);
if(isset($_GET['submit'])) 
{
    $A_name = $_GET['Name'];
    $email = $_GET['Email'];
    $Username = $_GET['Username'];
    $Password = $_GET['Password'];
    $Rpass = $_GET['Confirm_Password'];
    $gender= $_GET['Gender'];
    $dob= $_GET['Date_of_Birth'];
    $utype= $_GET['User_Type'];
    $ans1=$_GET['ans1'];
    $ans2=$_GET['ans2'];
 
    
 
    $errors = [];
 
    // Validate Name
    if (empty($A_name)) {
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
    if (empty($ans1)) {
        $errors[] = "Field cannot be empty";
        echo "Field cannot be empty";
    }
    if (empty($ans2)) {
        $errors[] = "Field cannot be empty";
        echo "Field cannot be empty";
    }
 
    if (empty($errors)) {
        
       $sql2 = ("Insert into a_Reg (Name,Email,Username,Password,Gender,Date_of_Birth, User_Type,ans1,ans2) Values ('$A_name', '$email', '$Username', '$Password','$gender','$dob','$utype','$ans1','$ans2')");
       mysqli_query($conn,$sql2);
       $sql3=("Insert into user (Username,Password, User_Type,ans1,ans2) Values ( '$Username', '$Password','$utype','$ans1','$ans2')");
       mysqli_query($conn,$sql3);
 
        $_SESSION['Username'] = $Username;
        $_SESSION['User_Type'] = $utype;
        session_destroy();
        header("Location: Registration_A.php");
        exit();
    }
}
 

$sql="select * from a_Reg";
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
<td width="200" colspan="2">
<fieldset>
<legend>Security Questions</legend>
<table>
    <tr>
        <td>
        <label for="answer1">In what city were you born?</label>
        </td>
        <td>
        <input type="text" id="ans1" name="ans1" value="<?php if (isset($data['ans1'])) echo $data['ans1']; ?>"><br>
        </td>
    </tr>
    <tr>
        <td>
        <label for="answer2">What was the name of your first school?</label>
        </td>
        <td>
        <input type="text" id="ans2" name="ans2" value="<?php if (isset($data['ans2'])) echo $data['ans2']; ?>"><br>
        </td>
    </tr>
</table>
</fieldset>
</td>
</tr>
<tr>
<td width="200">
<label align="left" for="User_Type">User_Type </label>
</td>
<td>
                        :<input required type="text" name="User_Type" value="Admin"/>
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