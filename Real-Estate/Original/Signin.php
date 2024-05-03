<?php
session_start();
$servername="localhost";
$username="root";
$pass="";
$dbname="maishara";
$conn= new mysqli($servername,$username,$pass,$dbname);
if(isset($_GET['submit'])) {
 
    $Username=$_GET['Username'];
    $Password=$_GET['Password'];
    $sql1="select * from user where Username='$Username' and Password='$Password'";
    $ares=mysqli_query($conn,$sql1);
    if($ares->num_rows>0)
    {
		while($r=mysqli_fetch_assoc($ares))
	{
		$_SESSION['Username']=$r["Username"];
		$_SESSION['User_Type']=$r["User_Type"];

		if($r['User_Type']==='Admin')
		{
			header("Location:Welcome_A.php");
		}
		elseif($r['User_Type']==='Agent')
		{

		header("location: Welcome.php");
		}
		elseif($r['User_Type']==='Buyer')
		{

		header("location: Welcome_B.php");
		}
	}
	}
	else
	{
		echo "Invalid User";
	}
	
}
 
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body style="background-image: url('<?php echo 'Signin.png'; ?>'); background-size: cover;">
<center>
<h1><a href="Homepage.php">BD Homes </a></h1>
<form method="GET" action="Signin.php">
<fieldset style="background-color: rgba(255, 255, 255, 0.9); padding: 10px;">
<legend><b>LOGIN</b></legend>
<table>
<tr>
<td>
<label for="Username">Username :</label>
</td>
<td>
<input type="text" id="Username" name="Username"><br>
</td>
</tr>
<tr>
<td>
<label for="Password">Password :</label>
</td>
<td>
<input type="Password" id="Password" name="Password" placeholder="<=8 chars, use(@,#,$,%)"><br>
</td>
</tr>
</table>
<p>____________________________________________</p>

<input type="submit" name="submit" value="Login">
<a href="forgotpassword.php">Forgot Password?</a>
</fieldset>
<a href="Icon.php">Don't have an account? Click here to register</a>
</form>
</center>
</body>
</html>