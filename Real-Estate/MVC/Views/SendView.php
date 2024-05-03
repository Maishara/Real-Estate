<!DOCTYPE html>
<html>
<head>
    <title>Compose Message</title>
</head>
<body>
    <h1>Compose a Message</h1>
    <form method="POST" action="SendController.php">
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
