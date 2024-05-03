<!DOCTYPE html>
<html>
<head>
    <title>Edit User Details</title>
</head>
<body>
    <form method="get">
        <?php while ($r = mysqli_fetch_assoc($userDetails)) { ?>
            Name: <input type="text" name="Name" value="<?php echo $r["Name"]; ?>"><br>
            Email: <input type="text" name="Email" value="<?php echo $r["Email"]; ?>"><br>
            Username: <input type="text" name="Username" value="<?php echo $r["Username"]; ?>" readonly><br>
            Password: <input type="text" name="Password" value="<?php echo $r["Password"]; ?>"><br>
            Gender: <input type="text" name="Gender" value="<?php echo $r["Gender"]; ?>"><br>
            Date of Birth: <input type="date" name="Date_of_Birth" value="<?php echo $r["Date_of_Birth"]; ?>"><br>
            User Type: <input type="text" name="User_Type" value="<?php echo $r["User_Type"]; ?>" readonly><br>
        <?php } ?>
        <button type="submit" name="submit">Edit</button>
    </form>
</body>
</html>
