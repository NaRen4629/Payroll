<?php
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

class Connection {
    private $server = "mysql:host=localhost;dbname=db_payroll";
    private $username = "root";
    private $password = "";
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );
    protected $conn;

    public function open() {
        try {
            $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
            return $this->conn;
        } catch (PDOException $e) {
            error_log("Connection error: " . $e->getMessage());
            return null;
        }
    }

    public function close() {
        $this->conn = null;
    }
}
?>
