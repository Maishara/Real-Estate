<?php
session_start();

class WelcomeModel {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "maishara";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAgentDetails($loggedInUsername) {
        $sql = "SELECT * FROM agent WHERE Username='$loggedInUsername'";
        $res = mysqli_query($this->conn, $sql);
        return $res;
    }

    public function deleteUser($username) {
        $sql1 = "DELETE FROM agent WHERE Username='$username'";
        mysqli_query($this->conn, $sql1);
        $sql2 = "DELETE FROM user WHERE Username='$username'";
        mysqli_query($this->conn, $sql2);
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
