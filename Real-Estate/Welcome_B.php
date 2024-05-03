<?php 
session_start(); // Make sure to start the session

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "maishara";
$conn = new mysqli($servername, $username, $pass, $dbname);

// Retrieve the logged-in user's username from the session
$loggedInUsername = $_SESSION['Username'];

// Query the database for the logged-in user's data
$sql = "SELECT * FROM B_reg WHERE Username='$loggedInUsername'";
$res = mysqli_query($conn, $sql);


if(!isset($_SESSION['Username'])) 
{
		header('location: Signin.php');
}

else{
	if(isset($_GET['logout']))
{
	session_destroy();
	header('location: Signin.php');

}
}
if(isset($_POST['del']))
{
    $username= $_POST['del'];
    $sql1="Delete from B_reg where Username='$username'";
     mysqli_query($conn,$sql1);
     $sql2="Delete from user where Username='$username'";
     mysqli_query($conn,$sql2);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<?php while($r= mysqli_fetch_assoc($res)){ ?>
    <p> Welcome <?php echo $r["Username"] ; ?>!
    <form action="Welcome_B.php" method='GET'>
    <button name="logout">Logout</button> </form></p>
    
 
<br>
  <table border="1" >
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Username</th>
      <th>Password</th>
      <th>Gender</th>
      <th>Date of Birth</th>
      <th>User Type</th>
    </tr>
    
    <tr>
      <td><?php echo $r["Name"] ; ?></td>
      <td><?php echo $r["Email"] ; ?></td>
      <td><?php echo $r["Username"] ; ?></td>
      <td><?php echo $r["Password"] ; ?></td>
      <td><?php echo $r["Gender"] ; ?></td>
      <td><?php echo $r["Date_of_Birth"] ; ?></td>
      <td><?php echo $r["User_Type"] ; ?></td>
      <td>
        <form method="get" action="edit_B.php">
      <button type="submit" name="edit" value="<?php echo $r["Username"] ; ?>">Edit</button>   </form>
      </td>
      
       <td><button type="submit" name="del" value="<?php echo $r["Username"] ; ?>">Delete</button>   </td>
    </tr>
  <?php } ?>
  </table>
  <br>
  <br>
  <br>

  <h2>Listed properties</h2>
  <?php
  $sql = "SELECT * FROM listing ";
$res = mysqli_query($conn, $sql);
while($r= mysqli_fetch_assoc($res)){ ?>
<table border="1" >
    <tr>
    <th>Title</th>
        <th>Location</th>
        <th>Status</th>
        <th>Price</th>
        <th>Description</th>
        <th>Decision</th>
        

    </tr>
    <tr>
    <td><?php echo $r["title"] ; ?></td>
      <td><?php echo $r["location"] ; ?></td>
      <td><?php echo $r["status"] ; ?></td>
      <td><?php echo $r["price"] ; ?></td>
      <td><?php echo $r["description"] ; ?></td>
      <td><?php echo $r["decision"] ; ?></td>
      
      <td>
        <<form method="post" action="appointment.php">
        <input type="hidden" name="location" value="<?php echo $r['location']; ?>">
        <button type="submit" name="request_appointment">Request for Appointment</button>
</form>
      </td>
      
  <?php } ?>
     
      
</table>

 
  

</body>
</html>