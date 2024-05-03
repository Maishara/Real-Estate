<?php 
session_start(); 

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "maishara";
$conn = new mysqli($servername, $username, $pass, $dbname);


$loggedInUsername = $_SESSION['Username'];


$sql = "SELECT * FROM agent WHERE Username='$loggedInUsername'";
$res = mysqli_query($conn, $sql);


if(!isset($_SESSION['Username'])) 
{
		header('location: Signin.php');
}

if(isset($_POST['del']))
{
    $username= $_POST['Username'];
    $sql1="Delete from agent where Username='$username'";
     mysqli_query($conn,$sql1);
    $sql2="Delete from user where Username='$username'";
     mysqli_query($conn,$sql2);
    header('location:Signin.php');
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>
  
  </title>
  
</head>
<body>
  <fieldset>
<?php while($r= mysqli_fetch_assoc($res)){ ?>
    
<br>
  <table border="1" >
    <tr>
      <th>Username</th>
      <th>Email</th>
      <th>Agent License</th>
      <th>Phone</th>
    </tr>
    
    <tr>
      <td><?php echo $r["Username"] ; ?></td>
      <td><?php echo $r["Email"] ; ?></td>
      <td><?php echo $r["License_Number"] ; ?></td>
      <td><?php echo $r["Phone"] ; ?></td>
     
      <td>
        <form method="get" action="edit.php">
      <button type="submit" name="edit" value="<?php echo $r["Username"] ; ?>">Edit</button>   </form>
      </td>
      
       
    </tr>
  <?php } ?>
  </table>
</fieldset>
</body>
</html>