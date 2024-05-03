<?php 
session_start(); // Make sure to start the session

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "maishara";
$conn = new mysqli($servername, $username, $pass, $dbname);


$loggedInUsername = $_SESSION['Username'];

// Query the database for the logged-in user's data
$sql = "SELECT * FROM a_reg WHERE Username='$loggedInUsername'";
$res = mysqli_query($conn, $sql);





	if(isset($_GET['logout']))
{
	session_destroy();
	header('location: Signin.php');

}

if(isset($_POST['del']))
{
    $username= $_POST['del'];
    $sql1="Delete from a_reg where Username='$username'";
     mysqli_query($conn,$sql1);
    
}
?>

<!DOCTYPE html>
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
<h1> <center> Admin Dashboard </h1>
<div style="display: inline-block; text-align: left; width: 33%;"><a href="Homepage.php">Go to homepage</a></div>
<form action="Welcome_A.php" method='GET'>
<div style="display: inline-block; text-align: right; width: 100%;"><button name='logout'>Logout</button></div>
</form>
<br>
<?php while($r= mysqli_fetch_assoc($res)){ ?>
    <h3><p> Welcome <?php echo $r["Username"] ; ?></h3>
<h2> Edit your profile</h2>
<table border="1" >
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Username</th>
      <th>Password</th>
      <th>Gender</th>
      <th>Date_of_Birth</th>
      <th>User_Type</th>

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
        <form method="get" action="edit_A.php">
      <button type="submit" name="edit_a" value="<?php echo $r["Username"] ; ?>">Edit</button>   </form>
      </td>
      
       <td><button type="submit" name="del" value="<?php echo $r["Username"] ; ?>">Delete</button>   </td>
    </tr>
  <?php } ?>
     
      
</table>
<br>
<h2> Agent Directory </h2>
<?php 
$sql = "SELECT * FROM agent ";
$res = mysqli_query($conn, $sql);

while($r= mysqli_fetch_assoc($res)){ ?>

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
      
       <td><button type="submit" name="del" value="<?php echo $r["Username"] ; ?>">Delete</button>   </td>
    </tr>
  <?php } ?>
     
      
</table>


<h2> View Pending Verifications </h2>
<a href="Admin_Display.php"> Pending </a> <br> <br>

<div class="dropdown">
    <img src="message.png" alt="set availability" width="75" height="75"> Message
    <div class="dropdown-content">
        <a href="Send.php">Send Messages</a>
        <a href="Inbox.php">Inbox</a>
    </div>
</div>



</body>
</html>

