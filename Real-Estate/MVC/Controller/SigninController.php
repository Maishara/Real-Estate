<?php
require_once ('../Model/SigninModel.php');

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "maishara";

$conn = new mysqli($servername, $username, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$model = new LoginModel($conn);

if (isset($_GET['submit'])) {
    $Username = $_GET['Username'];
    $Password = $_GET['Password'];
    
    $userType = $model->loginUser($Username, $Password);

    if ($userType === 'Invalid') {
        echo "Invalid User";
    } else {
        switch ($userType) {
            case 'Admin':
                header("Location: ../Views/AdminView.php");
                break;
            case 'Agent':
                header("Location: ../Views/AgentView.php");
                break;
            case 'Buyer':
                header("Location: Welcome_B.php");
                break;
            default:
                echo "Invalid User";
                break;
        }
    }
}


include 'SigninView.php';
?>
