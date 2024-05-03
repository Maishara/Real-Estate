<?php
class AgentModel {
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

    public function getAgentDetails() {
        $agentDetails = [];
        $sql = "SELECT * FROM agent";
        $res = $this->conn->query($sql);

        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $agentDetails[] = $row;
            }
        }
        return $agentDetails;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
