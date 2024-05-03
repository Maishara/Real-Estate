<?php 
$servername="localhost";
$username="root";
$pass="";
$dbname="maishara";
$conn= new mysqli($servername,$username,$pass,$dbname);
$username=$_GET['edit'];

if(isset($_GET['submit']))
{
 $username=$_GET['Username'];
 $email=$_GET['Email'];
 $lnumber=$_GET['License_Number'];
 $phone=$_GET['Phone'];
 $sql2="update agent set Email='$email', License_Number='$lnumber', Phone='$phone' where Username='$username'";
 mysqli_query($conn,$sql2);
 header("location:Welcome.php");
}
$sql="select * from agent where Username='$username'";
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
     Username: <input type="text" name="Username" value="<?php echo $r["Username"] ; ?>" readonly><br>
     Email: <input type="text" name="Email" value="<?php echo $r["Email"] ; ?>"><br>
     Agent License: <input type="text" name="License_Number"value="<?php echo $r["License_Number"] ; ?>"><br>
     Phone: <input type="number" name="Phone"value="<?php echo $r["Phone"] ; ?>"><br>
  <?php } ?>
     <button type="submit" name="submit">Edit</button>
    </form>
</body>
</html>