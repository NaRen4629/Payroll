<?php
require_once "config/connection.php";

class Employee extends Connection
{
    function get_faculty_department() {
        $conn = $this->open();
        $sql = "SELECT * FROM tbl_department WHERE department_type = 'Faculty' and status ='Active';";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_all_faculty_position() {
        $conn = $this->open();
        $sql = "SELECT * from tbl_position where employee_type = 'Faculty' and status = 'Active';";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function get_all_staff_position() {
        $conn = $this->open();
        $sql = "SELECT * from tbl_position where employee_type = 'Staff' and status = 'Active';";
  
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function add_employee_info($employee_number, $first_name, $middle_name, $last_name, $date_of_birth, $gender, $civil_status,
    $date_hired, $status, $contact_no, $email_address, $province, $brangay, $street, $position_id, $department_id) {
    $conn = $this->open();

    try {
        // Begin transaction
        $conn->beginTransaction();

        // Prepare the SQL statement to insert employee personal information
        $sql_employee_info = "INSERT INTO tbl_employee (employee_number, first_name, middle_name, last_name, date_of_birth, gender, civil_status, date_hired, status, contact_no, email_address, province, brangay, street) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_employee_info = $conn->prepare($sql_employee_info);
        // Bind parameters for employee personal information
        $stmt_employee_info->execute([$employee_number, $first_name, $middle_name, $last_name, $date_of_birth, $gender, $civil_status, $date_hired, $status, $contact_no, $email_address, $province, $brangay, $street]);

        // Retrieve the auto-generated employee_id
        $employee_id = $conn->lastInsertId();

        // Prepare the SQL statement to insert employee details
        $sql_employee_details = "INSERT INTO tbl_employee_details (employee_details_id, employee_details_position, employee_details_department) VALUES (?, ?, ?)";
        $stmt_employee_details = $conn->prepare($sql_employee_details);

        // Bind parameters for employee details
        if (empty($department_id)) {
            // If department_id is empty, bind NULL
            $stmt_employee_details->execute([$employee_id, $position_id, null]);
        } else {
            $stmt_employee_details->execute([$employee_id, $position_id, $department_id]);
        }

        $sql_employee_salary = "INSERT INTO tbl_employee_salary (employee_salary) VALUES (?)";
        $sql_employee_salary = $conn->prepare($sql_employee_salary);
        $sql_employee_salary->execute([$employee_id]);

        

        // Commit transaction
        $conn->commit();
        $_SESSION['Employee-alert_success'] = 'Employee Added Successfully';
        $_SESSION['Employee-alert_type'] = 'success';

        header('Location: Payroll_Master_Employee.php');
        exit(); // Exit after redirect
    } catch (PDOException $e) {
        // Rollback transaction
        $conn->rollBack();
        $_SESSION['Employee-alert_success'] = 'Error adding position: ' . $e->getMessage();
        $_SESSION['Employee-alert_type'] = 'danger';
        header('Location: Payroll_Master_Employee.php');
        exit(); // Exit after redirect
    }

    // Close connection
    $this->close();
}

}
?>