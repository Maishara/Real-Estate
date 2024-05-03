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

else{
	if(isset($_GET['logout']))
{
	session_destroy();
	header('location: Signin.php');

}
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
<style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
  <fieldset>
<?php while($r= mysqli_fetch_assoc($res)){ ?>
    <h2><p> Welcome <?php echo $r["Username"] ; ?>!</h2>
    <form action="Welcome.php" method='GET'>
    <button name="logout" style="right:20px;top:10px;position:fixed;">Logout</button> </form></p>
    
  <?php } ?>
  </table>
  
 
  <p style="text-alignment:center;"> <a href="Account.php"><img src="Account.jpeg" alt="Settings" width="75" height="75"> Profile Settings </a> </p>
  <br>


  <p style="text-alignment:center;"> <a href="Listing.php"><img src="listing.png" alt="Add listing" width="75" height="75"> Add to Property Listing </a> </p>
  <br>
  
  <p style="text-alignment:center;"> <a href="Admin_Display.php"><img src="status.png" alt="check approval" width="75" height="75"> Check the approval status here </a> </p>
  <br>
  

  <div class="dropdown">
    <img src="message.png" alt="set availability" width="75" height="75"> Message
    <div class="dropdown-content">
        <a href="Send.php">Send Messages</a>
        <a href="Inbox.php">Inbox</a>
    </div>
</div>
 
</fieldset>

</body>
</html>