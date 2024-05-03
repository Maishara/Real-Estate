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

$location = $_GET['location'];

$sql = "SELECT * FROM listing WHERE location = '$location'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $property = mysqli_fetch_assoc($result);

    echo "<fieldset><h1>{$property['title']}</h1>";
    echo "<p>{$property['location']}</p>";
    echo "<p>{$property['description']}</p>";
    echo "<p>{$property['price']} {$property['status']}</p>";
    
    // Display the image if available
    if (!empty($property['image_url'])) {
        echo "<img src='{$property['image_url']}' alt='Property Image' width='300'>";
    }
    echo "<p><h3>Agent assigned: {$property['username']}</p></h3>";
    echo "</fieldset>";
    

    // Display the live location map using Leaflet.js
    echo "<div id='map' style='height: 400px;'></div>";
    echo "<script src='https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js'></script>";
    echo "<script>
        var map = L.map('map').setView([{$property['lat']}, {$property['lon']}], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([{$property['lat']}, {$property['lon']}]).addTo(map)
            .bindPopup('{$property['title']}')
            .openPopup();
    </script>";

    // No need to retrieve availability information from agent_availability table

} else {
    echo "No property details found for the specified location.";
}

$conn->close();
?>
