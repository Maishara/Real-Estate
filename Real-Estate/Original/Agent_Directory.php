<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Agent Details</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
    }
    .agent-box {
      width: 300px;
      padding: 20px;
      margin: 10px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }
    .agent-details {
      display: flex;
      flex-direction: column;
    }
    .agent-details div {
      margin-bottom: 10px;
    }
    .agent-label {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Agent Directory</h1>
  <div class="container">
    <?php
    // Your PHP code to fetch agent details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "maishara";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM agent";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
      while ($r = mysqli_fetch_assoc($res)) {
        echo '<div class="agent-box">';
        echo '<div class="agent-details">';
        echo '<div><span class="agent-label">Username:</span> ' . $r["Username"] . '</div>';
        echo '<div><span class="agent-label">Email:</span> ' . $r["Email"] . '</div>';
        echo '<div><span class="agent-label">Agent License:</span> ' . $r["License_Number"] . '</div>';
        echo '<div><span class="agent-label">Phone:</span> ' . $r["Phone"] . '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo "<p>No agents found</p>";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
