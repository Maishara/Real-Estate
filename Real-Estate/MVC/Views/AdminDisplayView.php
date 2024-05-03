<!DOCTYPE html>
<html>
<head>
    <title>Pending Verifications</title>
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
        <th>Link</th>
        <th>Agent</th>
        <th>Action</th>
    </tr>

    <?php
    require_once('../Model/AdminDisplayModel.php');
    $listings = fetchPendingListings();

    foreach ($listings as $row) {
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['location']}</td>
                <td>{$row['status']}</td>
                <td>{$row['price']}</td>
                <td>{$row['description']}</td>
                <td>{$row['decision']}</td>
                <td><a href='../../Property_details.php?location={$row['location']}'>View Details</a></td>
                <td>{$row['username']}</td>
                <td>";

        if ($_SESSION['User_Type'] == 'Admin') {
            echo "<a href='../Controller/ApprovePropertyController.php?location={$row['location']}&action=approve'>Approve</a>
                  <a href='../Controller/ApprovePropertyController.php?location={$row['location']}&action=reject'>Reject</a>";
        }

        echo "</td></tr>";
    }
    ?>
</table>

</body>
</html>
