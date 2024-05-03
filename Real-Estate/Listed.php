<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$location = $_POST['location'];
$status = $_POST['status'];
$price = $_POST['price'];
$description = $_POST['description'];
$username = $_POST['username'];
$latitude = $_POST['latitude']; // Add the line to fetch latitude
$longitude = $_POST['longitude']; // Add the line to fetch longitude

// Handle image upload
$targetDir = "uploads/"; // Directory where images will be stored
$targetFile = $targetDir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Allow certain image file formats (e.g., jpg, jpeg, png)
$allowedExtensions = array("jpg", "jpeg", "png");
if (in_array($imageFileType, $allowedExtensions)) {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
}

// Insert property details into the database including latitude and longitude
$sql_listing = "INSERT INTO listing (title, location, status, price, description, verified, decision, username, image_url, lat, lon) 
                VALUES ('$title', '$location', '$status', '$price', '$description', 0, 'pending', '$username', '$targetFile', '$latitude', '$longitude')";

if ($conn->query($sql_listing) === TRUE) {
    header("Location: Listing.php?submit=1");
    exit();
} else {
    echo "Error: " . $sql_listing . "<br>" . $conn->error;
}

$conn->close();
?>
