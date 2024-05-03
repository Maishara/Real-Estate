<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maishara";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get search parameters from the form
    $property_status = $_GET['property_status'];
    $property_price = $_GET['property_price'];

    // Prepare the SQL query based on search parameters
    $sql = "SELECT * FROM listing WHERE verified = 1 AND decision = 'approved'";

    // Append conditions based on search parameters
    if (!empty($property_status)) {
        $sql .= " AND status = '$property_status'";
    }

    if (!empty($property_price)) {
        // Modify the SQL query to match the 'BDT' format in the price column
        $sql .= " AND price LIKE 'BDT $property_price'";
    }

    // Execute the query
    $result = $conn->query($sql);

    // Display search results
    if ($result && $result->num_rows > 0) {
        while ($property = $result->fetch_assoc()) {
            // Display the properties matching the search criteria
            echo "<div class='property-box'>";
            echo "<fieldset style='background-color: rgba(255, 255, 255, 0.9); padding: 10px;'>";
            echo "<h2><a href='Property_details.php?location={$property['location']}'>{$property['title']}</a></h2>";
            echo "</fieldset>";
            echo "</div>";
        }
    } else {
        echo "No properties found matching the search criteria.";
    }
}

$conn->close();
?>
