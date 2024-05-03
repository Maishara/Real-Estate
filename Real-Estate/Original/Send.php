<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara"; // Replace with your actual database name
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $sender = $_SESSION['Username']; // Assuming the sender is the logged-in user
    $receiver = $_POST['receiver'];
    $subject=$_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (sender_username, receiver_username, subject, content, timestamp) VALUES ('$sender', '$receiver', '$subject', '$message', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Compose Message</title>
</head>
<body>
    <h1>Compose a Message</h1>
    <form method="POST" action="send.php">
        <label for="receiver">Recipient:</label>
        <input type="text" id="receiver" name="receiver" required><br><br>
        
        <label for="subject">Subject:</label><br>
        <textarea id="subject" name="subject"> </textarea><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="5" cols="30" required></textarea><br><br>
        
        <input type="submit" name="submit" value="Send Message">
    </form>
</body>
</html>
