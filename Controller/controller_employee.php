<?php
require_once "config/connection.php";

class Employee extends Connection
{
    // public function view_all_employee_ids(){
    //     $conn = $this->open();
    //     $sql = "SELECT employee_id FROM tbl_employee WHERE status = 'Active'";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
    //     return $result;
    // }

    // function view_employee_type() {
    //     $conn = $this->open();
    //     // Fetch all employee types
    //     $sql = "SELECT `employee_type` FROM `tbl_employee_type`";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute();
    //     $employee_types = $stmt->fetchAll(PDO::FETCH_COLUMN);
    //     return $employee_types;
    // }

    function add_employee_position($employee_type, $employee_departments,$status,$type) {
        $conn = $this->open();

        try {
            $conn->beginTransaction();

            // Check if the category exists in the business_category table
            $sql = "SELECT `employee_type_id` FROM `tbl_employee_type` WHERE `employee_type` = :employee_type AND `status` = 'Active'";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':employee_type', $employee_type);
            $stmt->execute();
            $employee_type_id = $stmt->fetchColumn();
            
            // Insert business sub-categories into business_position table
            foreach($employee_departments as $position) {
                $insert_position_sql = "INSERT INTO `tbl_employee_position` (`employee_type_id`, `position`, `status`,`type`) 
                                            VALUES (:employee_type_id, :position,:status,:type)";
                $insert_position_stmt = $conn->prepare($insert_position_sql);
                $insert_position_stmt->bindParam(':employee_type_id', $employee_type_id);
                $insert_position_stmt->bindParam(':position', $position);
                $insert_position_stmt->bindParam(':status', $status);
                $insert_position_stmt->bindParam(':type', $type);
                $insert_position_stmt->execute();

            }
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
        }

        $this->close();
    }
}
?>