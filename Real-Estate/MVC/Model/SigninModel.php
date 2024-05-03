<?php
session_start();

class LoginModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function loginUser($Username, $Password) {
        $sql = "SELECT * FROM user WHERE Username='$Username' AND Password='$Password'";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $userDetails = $result->fetch_assoc();
            $_SESSION['Username'] = $userDetails['Username'];
            $_SESSION['User_Type'] = $userDetails['User_Type'];
            return $userDetails['User_Type'];
        } else {
            return 'Invalid';
        }
    }
}
?>
