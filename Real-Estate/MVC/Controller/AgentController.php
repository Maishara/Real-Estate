<?php
    require_once('../Model/AgentModel.php'); // Include the model

    $welcomeModel = new WelcomeModel();

    if (!isset($_SESSION['Username'])) {
        header('location: ../Views/SigninView.php');
    } else {
        if (isset($_GET['logout'])) {
            session_destroy();
            header('location: ../Views/SigninView.php');
        }
    }

    if (isset($_POST['del'])) {
        $username = $_POST['Username'];
        $welcomeModel->deleteUser($username);
        header('location:../Views/SigninView.php');
    }

    ?>