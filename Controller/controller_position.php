<?php
include_once('config/connection.php'); // Make sure this path is correct

class Position extends Connection {

    function add_position($employee_type, $position_name, $type, $status) {
        $conn = $this->open();
    
        try {
            // Check if the position already exists
            $check_position_query = "SELECT COUNT(*) FROM `tbl_position` WHERE `position` = :position";
            $check_stmt = $conn->prepare($check_position_query);
            $check_stmt->bindParam(':position', $position_name);
            $check_stmt->execute();
            $position_count = $check_stmt->fetchColumn();
    
            if ($position_count > 0) {
                // Position already exists, return an error message
                $_SESSION['Position-alert_success'] = 'Position already exists';
                $_SESSION['Position-alert_type'] = 'danger';
                header('Location: Payroll_Master_Position.php');
                exit(); // Exit after redirect
            }
    
            $conn->beginTransaction();
    
            $insert_position = "INSERT INTO `tbl_position`(`employee_type`, `position`, `type`, `status`)
                            VALUES (:employee_type, :position, :type, :status)";
    
            $insert_stmt_insert_position = $conn->prepare($insert_position);
            $insert_stmt_insert_position->bindParam(':employee_type', $employee_type);
            $insert_stmt_insert_position->bindParam(':position', $position_name);
            $insert_stmt_insert_position->bindParam(':type', $type);
            $insert_stmt_insert_position->bindParam(':status', $status);
            $insert_stmt_insert_position->execute();
    
            $conn->commit();
            $_SESSION['Position-alert_success'] = 'Position added successfully';
            $_SESSION['Position-alert_type'] = 'success';
        
            header('Location: Payroll_Master_Position.php');
            exit(); // Exit after redirect
        
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Position-alert_success'] = 'Error adding position: ' . $e->getMessage();
            $_SESSION['Position-alert_type'] = 'danger';
            header('Location: Payroll_Master_Position.php');
            exit(); // Exit after redirect
        }
    
        $this->close();
    }

    function update_position($employee_type, $position_name, $type, $status, $position_id){
        $conn = $this->open();
    
        try {
            $conn->beginTransaction();
    
            $update_user = "UPDATE `tbl_position` SET `employee_type` = :employee_type, `position` = :position_name, `type` = :type, `status` = :status WHERE `position_id` = :position_id";
    
            $update_stmt = $conn->prepare($update_user);
            $update_stmt->bindParam(':employee_type', $employee_type);
            $update_stmt->bindParam(':position_name', $position_name);
            $update_stmt->bindParam(':type', $type);
            $update_stmt->bindParam(':status', $status);
            $update_stmt->bindParam(':position_id', $position_id);
    
            $update_stmt->execute();
    
            if ($update_stmt->rowCount() > 0) {
                // Update successful
                $_SESSION['Position-alert_success'] = 'Position updated successfully';
                $_SESSION['Position-alert_type'] = 'success';
            } else {
                // No rows affected, something went wrong
                $_SESSION['Position-alert_success'] = 'No changes made';
                $_SESSION['Position-alert_type'] = 'danger';
            }
    
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Position-alert_success'] = 'Error updating position: ' . $e->getMessage();
            $_SESSION['Position-alert_type'] = 'danger';
        }
    
        $this->close();
        header('Location: Payroll_Master_Position.php');
        exit(); // Exit after redirect
    }
    
    function delete_position($position_id) {
        $conn = $this->open();

        try {
            $conn->beginTransaction();

            $delete_position = "DELETE FROM `tbl_position` WHERE `position_id` = :position_id ";

            $insert_stmt_delete_position = $conn->prepare($delete_position);
            $insert_stmt_delete_position->bindParam(':position_id', $position_id);
    
            $insert_stmt_delete_position->execute();

            $conn->commit();
            $_SESSION['Position-alert_success'] = 'Position deleted successfully';
            $_SESSION['Position-alert_type'] = 'danger';
        
            header('Location: Payroll_Master_Position.php');
            exit(); // Exit after redirect
        
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Position-alert_success'] = 'Error adding position: ' . $e->getMessage();
            $_SESSION['Position-alert_type'] = 'danger';
            header('Location: Payroll_Master_Position.php');
            exit();        }

        $this->close();
    }

    public function getEmployeeTypes() {
        $employee_types = [];
        $conn = $this->open(); // Open the connection

        if ($conn) {
            $query = "SELECT DISTINCT employee_type FROM tbl_position";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $employee_types[] = $row['employee_type'];
            }

            $this->close(); // Close the connection
        }

        return $employee_types;
    }
}
?>
