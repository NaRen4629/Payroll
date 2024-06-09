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
LEFT JOIN tbl_department dept ON
    dept.department_id = ed.employee_details_department
INNER JOIN tbl_employee_salary s ON
    e.employee_id = s.employee_salary
WHERE
    s.salary IS NULL AND ep.salary_type IN('Monthly Rate', 'Hourly Rate');";

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

    function add_salary_adjustment($id_salary, $salary_adjustment, $reason, $effective_date) {
        $conn = $this->open();
        date_default_timezone_set('Asia/Manila');
        $current_date = date('Y-m-d');

        try {
            $conn->beginTransaction();

            // Insert the salary adjustment record
            $insert_position = "INSERT INTO `tbl_employee_salary_adjustment`(`id_salary`, `salary_adjustment`, `reason`, `effective_date`)
                                VALUES (:id_salary, :salary_adjustment, :reason, :effective_date)";
            $insert_stmt_insert_position = $conn->prepare($insert_position);
            $insert_stmt_insert_position->bindParam(':id_salary', $id_salary);
            $insert_stmt_insert_position->bindParam(':salary_adjustment', $salary_adjustment);
            $insert_stmt_insert_position->bindParam(':reason', $reason);
            $insert_stmt_insert_position->bindParam(':effective_date', $effective_date);
            $insert_stmt_insert_position->execute();

            // Check if the effective date is today and update the salary accordingly
            if ($effective_date == $current_date) {
                $this->update_employee_salary($conn, $id_salary, $salary_adjustment);
            }

            $conn->commit();
            $_SESSION['Salary-alert_success'] = 'Salary adjustment added successfully';
            $_SESSION['Salary-alert_type'] = 'success';

            header('Location: School_Admin_Salary.php');
            exit(); // Exit after redirect

        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Salary-alert_success'] = 'Error adding salary adjustment: ' . $e->getMessage();
            $_SESSION['Salary-alert_type'] = 'danger';
            header('Location: School_Admin_Salary.php');
            exit(); // Exit after redirect
        }

        $this->close();
    }

    private function update_employee_salary($conn, $id_salary, $salary_adjustment) {
        $update_salary = "UPDATE `tbl_employee_salary` SET `salary` = `salary` + :salary_adjustment WHERE `salary_id` = :id_salary";
        $update_stmt = $conn->prepare($update_salary);
        $update_stmt->bindParam(':salary_adjustment', $salary_adjustment);
        $update_stmt->bindParam(':id_salary', $id_salary);
        $update_stmt->execute();
    }

    function view_salary_adjustments() {
        $conn = $this->open();
        $sql = "SELECT
    e.employee_id,
    e.employee_number,
    CONCAT(e.first_name, ' ', e.last_name) AS full_name,
    s.*,
    ep.*,
    dept.*,
    ed.*,
    esa.*
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
INNER JOIN tbl_employee_salary_adjustment esa ON
s.salary_id = esa.id_salary;";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    /*
SELECT
    e.employee_id,
    e.employee_number,
    CONCAT(e.first_name, ' ', e.last_name) AS full_name,
    s.*,
    ep.*,
    dept.*,
    ed.*,
    esa.*
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
INNER JOIN tbl_employee_salary_adjustment esa ON
s.salary_id = esa.id_salary;  
  */

}

