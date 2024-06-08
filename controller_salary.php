<?php
require_once "config/connection.php";

class Salary extends Connection
{

function get_all_employee_salary() {
        $conn = $this->open();
        $sql = "SELECT *
        FROM tbl_employee_salary
        WHERE salary IS NULL;";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>