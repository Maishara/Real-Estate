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
    <?php
    require_once('../Controller/AgentController.php');

    $loggedInUsername = $_SESSION['Username'];
    $res = $welcomeModel->getAgentDetails($loggedInUsername);

    if ($res && mysqli_num_rows($res) > 0) {
        while ($r = mysqli_fetch_assoc($res)) {
            echo '<h2><p> Welcome ' . $r["Username"] . '!</h2>';
        }
    }
    ?>
    <form action="../Controller/AgentController.php" method='GET'>
    <button name="logout" style="right:20px;top:10px;position:fixed;">Logout</button> </form></p>
    
    
    </table>
    
   
    <p style="text-alignment:center;"> <a href="../../Account.php"><img src="Account.jpeg" alt="Settings" width="75" height="75"> Profile Settings </a> </p>
    <br>
  
  
    <p style="text-alignment:center;"> <a href="../../Listing.php"><img src="listing.png" alt="Add listing" width="75" height="75"> Add to Property Listing </a> </p>
    <br>
    
    <p style="text-alignment:center;"> <a href="../Controller/AdminDisplayController.php"><img src="status.png" alt="check approval" width="75" height="75"> Check the approval status here </a> </p>
    <br>
    
  
    <div class="dropdown">
      <img src="message.png" alt="set availability" width="75" height="75"> Message
      <div class="dropdown-content">
          <a href="SendView.php">Send Messages</a>
          <a href="../Controller/InboxController.php">Inbox</a>
      </div>
  </div>
   
  </fieldset>
  
  </body>
  </html>
