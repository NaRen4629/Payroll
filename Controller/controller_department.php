<?php
include_once('config/connection.php'); // Make sure this path is correct

class Department extends Connection {

    function add_department($department_type,$department_code,$department_name,$status) {
        $conn = $this->open();
    
        try {
            // Check if the department already exists
            $check_department_query = "SELECT COUNT(*) FROM `tbl_department` WHERE `department_name` = :department_name";
            $check_stmt = $conn->prepare($check_department_query);
            $check_stmt->bindParam(':department_name', $department_name);
            $check_stmt->execute();
            $department_count = $check_stmt->fetchColumn();
    
            if ($department_count > 0) {
                $_SESSION['Department-alert_success'] = 'Department already exists';
                $_SESSION['Department-alert_type'] = 'danger';
                header('Location: Payroll_Master_Department.php');
                exit(); // Exit after redirect
            }
    
            $conn->beginTransaction();
    
            // Insert the department
            $insert_department_query = "INSERT INTO `tbl_department` (`department_type`, `department_code`, `department_name`, `status`)
                                        VALUES (:department_type, :department_code, :department_name, :status)";
            $insert_stmt = $conn->prepare($insert_department_query);
            // Assuming department type and code are provided elsewhere in your application
            $insert_stmt->bindParam(':department_type', $department_type);
            $insert_stmt->bindParam(':department_code', $department_code);
            $insert_stmt->bindParam(':department_name', $department_name);
            $insert_stmt->bindParam(':status', $status);

            $insert_stmt->execute();
    
            $conn->commit();
            $_SESSION['Department-alert_success'] = 'Department added successfully';
            $_SESSION['Department-alert_type'] = 'success';
    
            header('Location: Payroll_Master_Department.php');
            exit(); // Exit after redirect
    
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Department-alert_success'] = 'Error adding department: ' . $e->getMessage();
            $_SESSION['Department-alert_type'] = 'danger';
            header('Location: Payroll_Master_Department.php');
            exit(); // Exit after redirect
        }
    
        $this->close();
    }
    

    function update_department($department_id, $department_type, $department_code, $department_name, $status){
        $conn = $this->open();
        
        try {
            $conn->beginTransaction();
    
            // Update query with placeholders
            $update_department = "UPDATE `tbl_department` SET 
                `department_type` = :department_type,
                `department_code` = :department_code,
                `department_name` = :department_name,
                `status` = :status
                WHERE `department_id` = :department_id";
    
            $update_stmt = $conn->prepare($update_department);
            
            // Bind parameters
            $update_stmt->bindParam(':department_type', $department_type, PDO::PARAM_STR);
            $update_stmt->bindParam(':department_code', $department_code, PDO::PARAM_STR);
            $update_stmt->bindParam(':department_name', $department_name, PDO::PARAM_STR);
            $update_stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $update_stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
            
            // Execute the update
            $update_stmt->execute();
    
            if ($update_stmt->rowCount() > 0) {
                // Update successful
                $_SESSION['Department-alert_success'] = 'Department updated successfully';
                $_SESSION['Department-alert_type'] = 'success';
            } else {
                // No rows affected, something went wrong
                $_SESSION['Department-alert_success'] = 'No changes made.';
                $_SESSION['Department-alert_type'] = 'danger';
            }
    
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Department-alert_success'] = 'Error updating department: ' . $e->getMessage();
            $_SESSION['Department-alert_type'] = 'danger';
        }
    
        $this->close();
        header('Location: Payroll_Master_Department.php');
        exit(); // Exit after redirect
    }
    
    
    function delete_department($department_id) {
        $conn = $this->open();

        try {
            $conn->beginTransaction();

            $delete_position = "DELETE FROM `tbl_department` WHERE `department_id` = :department_id ";

            $insert_stmt_delete_position = $conn->prepare($delete_position);
            $insert_stmt_delete_position->bindParam(':department_id', $department_id);
    
            $insert_stmt_delete_position->execute();

            $conn->commit();
            $_SESSION['Department-alert_success'] = 'Department deleted successfully';
            $_SESSION['Department-alert_type'] = 'danger';
        
            header('Location: Payroll_Master_Department.php');
            exit(); // Exit after redirect
        
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Department-alert_success'] = 'Error adding position: ' . $e->getMessage();
            $_SESSION['Department-alert_type'] = 'danger';
            header('Location: Payroll_Master_Department.php');
            exit();        }

        $this->close();
    }

}
?>
