<?php 
$servername="localhost";
$username="root";
$pass="";
$dbname="maishara";
$conn= new mysqli($servername,$username,$pass,$dbname);
$username=$_GET["edit_a"];

if(isset($_GET['submit']))
{
    $A_name = $_GET['Name'];
    $email = $_GET['Email'];
    $username = $_GET['Username'];
    $Password = $_GET['Password'];
    $gender= $_GET['Gender'];
    $dob= $_GET['Date_of_Birth'];
    $utype= $_GET['User_Type'];
   $sql2=("Update a_reg set Name='$A_name',Email='$email',Username='$username',Password='$Password',Gender='$gender',Date_of_Birth='$dob', User_Type='$utype'where Username='$username'");
   mysqli_query($conn,$sql2);
   header("location:Welcome_A.php");
}
$sql="select * from a_reg where Username='$username'";
$res=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>
  
  <title></title>
</head>
<body>
  <form method="get">
   <?php while($r= mysqli_fetch_assoc($res)){ ?>
     Name: <input type="text" name="Name" value="<?php echo $r["Name"] ; ?>"><br>
     Email: <input type="text" name="Email" value="<?php echo $r["Email"] ; ?>"><br>
     Username: <input type="text" name="Username"value="<?php echo $r["Username"] ; ?>"readonly><br>
     Password: <input type="text" name="Password"value="<?php echo $r["Password"] ; ?>"><br>
     Gender: <input type="text" name="Gender"value="<?php echo $r["Gender"] ; ?>"><br>
     Date of Birth: <input type="date" name="Date_of_Birth"value="<?php echo $r["Date_of_Birth"] ; ?>"><br>
     User Type: <input type="text" name="User_Type"value="<?php echo $r["User_Type"] ; ?>"readonly><br>
  <?php } ?>
     <button type="submit" name="submit">Edit</button>
    </form>
</body>
</html>