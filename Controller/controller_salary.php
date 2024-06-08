<?php
require_once "config/connection.php";

class Salary extends Connection
{

    function get_all_employee_salary()
    {
        $conn = $this->open();
        $sql = "SELECT
    e.employee_id,
    e.employee_number,
    CONCAT(e.first_name, ' ', e.last_name) AS full_name,
    s.*,
    ep.*,
    dept.*,
    ed.*
FROM
    tbl_employee e
INNER JOIN tbl_employee_details ed ON
    e.employee_id = ed.employee_details_id
INNER JOIN tbl_position ep ON
    ep.position_id = ed.employee_details_position
left JOIN tbl_department dept ON
    dept.department_id = ed.employee_details_department
INNER JOIN tbl_employee_salary s ON
    e.employee_id = s.employee_salary
WHERE
    s.salary IS NULL AND ep.type IN('Regular', 'Not Regular')";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function add_salary($employee_salary, $salary){ 
        $conn = $this->open();
    
        try {
            $conn->beginTransaction();
    
            $update_user = "UPDATE tbl_employee_salary 
                                SET salary = :salary 
                                WHERE salary_id = :employee_salary";
    
            $update_stmt = $conn->prepare($update_user);
            $update_stmt->bindParam(':employee_salary', $employee_salary);
            $update_stmt->bindParam(':salary', $salary);
    
            $update_stmt->execute();
    
            if ($update_stmt->rowCount() > 0) {
                // Update successful
                $_SESSION['Salary-alert_success'] = 'Salary Added successfully';
                $_SESSION['Salary-alert_type'] = 'success';
            } else {
                // No rows affected, something went wrong
                $_SESSION['Salary-alert_success'] = 'No changes made';
                $_SESSION['Salary-alert_type'] = 'danger';
            }
    
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Salary-alert_success'] = 'Error updating position: ' . $e->getMessage();
            $_SESSION['Salary-alert_type'] = 'danger';
        }
    
        $this->close();
        header('Location: School_Admin_Salary.php');
        exit(); // Exit after redirect
    }

}

