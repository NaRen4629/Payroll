<?php
require_once "config/connection.php";

class Salary extends Connection
{

function get_all_employee_salary() {
        $conn = $this->open();
        $sql = "SELECT 
    e.employee_id,
    e.employee_number,
    CONCAT(e.first_name, ' ', e.middle_name) AS full_name,
    e.last_name,
    s.salary_id,
    s.salary
FROM 
    tbl_employee e
INNER JOIN 
    tbl_employee_salary s ON e.employee_id = s.employee_salary
WHERE 
    s.salary IS NULL;
";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>