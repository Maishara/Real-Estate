<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";

if (isset($_SESSION['Username'])) {
    $currentUsername = $_SESSION['Username'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['submit'])) {
        $date = $_POST['date'];
        $available = isset($_POST['available']) ? 1 : 0;

        $sql = "SELECT * FROM agent WHERE username = '$currentUsername'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $agent = $result->fetch_assoc();
            $agent_id = $agent['agent_id'];

            $sql = "SELECT * FROM agent_availability WHERE date = '$date' AND agent_id = $agent_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $sql = "UPDATE agent_availability SET available = $available WHERE date = '$date' AND agent_id = $agent_id";
            } else {
                $sql = "INSERT INTO agent_availability (date, available, agent_id) VALUES ('$date', $available, $agent_id)";
            }

            if ($conn->query($sql) === TRUE) {
                echo "Availability set successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Agent not found.";
        }

        $conn->close();
    }
} else {
    echo "User is not logged in.";
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Agent Availability</title>
</head>
<body>
    <h1>Set Your Availability</h1>
    <fieldset>
    <form method="POST" action="set_availability.php">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        
        <label for="available">Available:</label>
        <input type="checkbox" id="available" name="available" value="1"> Yes<br><br>
        
        <input type="submit" name="submit" value="Set Availability">
    </form>
</fieldset>
</body>
</html>

