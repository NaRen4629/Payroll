<?php
include_once('config/connection.php'); // Make sure this path is correct

class Holiday extends Connection {

    function add_holiday($date_from, $date_to, $type_of_holiday, $name_of_holiday, $status) {
        $conn = $this->open();
    
        try {
            
            $check_position_query = "SELECT COUNT(*) FROM `tbl_holiday` WHERE `name_of_holiday` = :name_of_holiday";
            $check_stmt = $conn->prepare($check_position_query);
            $check_stmt->bindParam(':name_of_holiday', $name_of_holiday);
            $check_stmt->execute();
            $position_count = $check_stmt->fetchColumn();
    
            if ($position_count > 0) {
                // Position already exists, return an error message
                $_SESSION['Holiday-alert_success'] = 'Holiday already exists';
                $_SESSION['Holiday-alert_type'] = 'danger';
                header('Location: Payroll_Master_Holiday.php');
                exit(); // Exit after redirect
            }
    
            $conn->beginTransaction();
    
            $insert_position = "INSERT INTO `tbl_holiday`(`date_from`, `date_to`, `type_of_holiday`, `name_of_holiday`,`status`)
                            VALUES (:date_from, :date_to, :type_of_holiday, :name_of_holiday, :status)";
    
            $insert_stmt_insert_position = $conn->prepare($insert_position);
            $insert_stmt_insert_position->bindParam(':date_from', $date_from);
            $insert_stmt_insert_position->bindParam(':date_to', $date_to);
            $insert_stmt_insert_position->bindParam(':type_of_holiday', $type_of_holiday);
            $insert_stmt_insert_position->bindParam(':name_of_holiday', $name_of_holiday);
            $insert_stmt_insert_position->bindParam(':status', $status);
            $insert_stmt_insert_position->execute();
    
            $conn->commit();
            $_SESSION['Holiday-alert_success'] = 'Position added successfully';
            $_SESSION['Holiday-alert_type'] = 'success';
        
            header('Location: Payroll_Master_Holiday.php');
            exit(); // Exit after redirect
        
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Holiday-alert_success'] = 'Error adding position: ' . $e->getMessage();
            $_SESSION['Holiday-alert_type'] = 'danger';
            header('Location: Payroll_Master_Holiday.php');
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
                $_SESSION['Holiday-alert_success'] = 'Position updated successfully';
                $_SESSION['Holiday-alert_type'] = 'success';
            } else {
                // No rows affected, something went wrong
                $_SESSION['Holiday-alert_success'] = 'No changes made';
                $_SESSION['Holiday-alert_type'] = 'danger';
            }
    
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Holiday-alert_success'] = 'Error updating position: ' . $e->getMessage();
            $_SESSION['Holiday-alert_type'] = 'danger';
        }
    
        $this->close();
        header('Location: Payroll_Master_Holiday.php');
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
            $_SESSION['Holiday-alert_success'] = 'Position deleted successfully';
            $_SESSION['Holiday-alert_type'] = 'danger';
        
            header('Location: Payroll_Master_Holiday.php');
            exit(); // Exit after redirect
        
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['Holiday-alert_success'] = 'Error adding position: ' . $e->getMessage();
            $_SESSION['Holiday-alert_type'] = 'danger';
            header('Location: Payroll_Master_Holiday.php');
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
