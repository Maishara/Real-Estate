<!DOCTYPE html>
<html>
<head>
    <title>Pending Verfications</title>
</head>
<body>

<h2>Pending Property Submissions</h2>

<table border="1">
    <tr>
        <th>Title</th>
        <th>Location</th>
        <th>Status</th>
        <th>Price</th>
        <th>Description</th>
        <th>Decision</th>
        <th>Link </th>
        <th>Agent </th>
        <th>Action</th>
        
    </tr>

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

    $sql = "SELECT * FROM listing ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['location']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['decision']}</td>
                    <td> <a href='Property_details.php?location={$row['location']}'>View Details</a></td>
                    <td>{$row['username']}</td>
                    <td>";
            if ($_SESSION['User_Type'] == 'Admin') {
                echo "<a href='approve_property.php?location={$row['location']}&action=approve'>Approve</a>
                      <a href='approve_property.php?location={$row['location']}&action=reject'>Reject</a>";
            }
            echo "</td></tr>";
        }
    }


    $conn->close();
    ?>

</table>


</body>
</html>
