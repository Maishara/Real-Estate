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
    require_once('../Model/ADModel.php'); // Include the model

    // Create an instance of the AgentModel
    $agentModel = new AgentModel();

    // Get agent details from the model
    $agents = $agentModel->getAgentDetails();

    if (!empty($agents)) {
        foreach ($agents as $agent) {
            echo '<div class="agent-box">';
            echo '<div class="agent-details">';
            echo '<div><span class="agent-label">Username:</span> ' . $agent["Username"] . '</div>';
            echo '<div><span class="agent-label">Email:</span> ' . $agent["Email"] . '</div>';
            echo '<div><span class="agent-label">Agent License:</span> ' . $agent["License_Number"] . '</div>';
            echo '<div><span class="agent-label">Phone:</span> ' . $agent["Phone"] . '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No agents found</p>";
    }

    // Close the database connection
    $agentModel->closeConnection();
    ?>
  </div>
</body>
</html>
