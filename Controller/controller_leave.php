<?php
include_once('config/connection.php');

class Leave extends Connection {

    function add_leave_settings($leave_credit_code, $leave_credit_name, $description, $default_credits, $status) {
        $conn = $this->open();

        try {
            $conn->beginTransaction();

            $insert_leave = "INSERT INTO `tbl_leave_credits_settings`(`leave_credit_code`, `leave_credit_name`, `description`, `default_credits`, `status`)
                            VALUES (:leave_credit_code, :leave_credit_name, :description, :default_credits, :status)";

            $insert_stmt_insert_leave = $conn->prepare($insert_leave);
            $insert_stmt_insert_leave->bindParam(':leave_credit_code', $leave_credit_code);
            $insert_stmt_insert_leave->bindParam(':leave_credit_name', $leave_credit_name);
            $insert_stmt_insert_leave->bindParam(':description', $description);
            $insert_stmt_insert_leave->bindParam(':default_credits', $default_credits);
            $insert_stmt_insert_leave->bindParam(':status', $status);
            $insert_stmt_insert_leave->execute();

            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            echo "Error: " . $e->getMessage(); // Output error message if transaction fails
        }

        $this->close();
    }
    
    function view_leave_credits_type() {
        $conn = $this->open();
        $sql = "SELECT credits_settings, leave_credit_code, leave_credit_name FROM tbl_leave_credits_settings ORDER BY credits_settings";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function add_leave_employee($details_id, $schedule_contents) {
        $conn = $this->open();

        try {
            $conn->beginTransaction();

            // Get credits_settings from view_leave_credits_type()
            $leave_credits_type = $this->view_leave_credits_type();
            if (empty($leave_credits_type)) {
                throw new Exception("No leave credit settings found.");
            }
            $credits_settings = $leave_credits_type[0]['credits_settings'];

            // Insert into tbl_leave_credits
            $insert_sql_leave_credits = "INSERT INTO `tbl_leave_credits` (details_id, credits_settings) 
                                         VALUES (:details_id, :credits_settings)";
            $insert_stmt_leave_credits = $conn->prepare($insert_sql_leave_credits);
            $insert_stmt_leave_credits->bindParam(':details_id', $details_id, PDO::PARAM_INT);
            $insert_stmt_leave_credits->bindParam(':credits_settings', $credits_settings, PDO::PARAM_INT);
            $insert_stmt_leave_credits->execute();

            // Get the ID of the newly inserted leave credits
            $leave_credits_id = $conn->lastInsertId();

            // Insert into tbl_leave_credits_content for each item
            $insert_sql_leave_credits_content = "INSERT INTO `tbl_leave_credits_content` (leave_credits, date, time_from, time_to, total_credits) 
                                                 VALUES (:leave_credits, :date, :time_from, :time_to, :total_credits)";
            $insert_stmt_leave_credits_content = $conn->prepare($insert_sql_leave_credits_content);
            $insert_stmt_leave_credits_content->bindParam(':leave_credits', $leave_credits_id, PDO::PARAM_INT);

            // Loop through schedule contents to insert multiple rows
            foreach ($schedule_contents as $content) {
                $insert_stmt_leave_credits_content->bindParam(':date', $content['date'], PDO::PARAM_STR);
                $insert_stmt_leave_credits_content->bindParam(':time_from', $content['time_from'], PDO::PARAM_STR);
                $insert_stmt_leave_credits_content->bindParam(':time_to', $content['time_to'], PDO::PARAM_STR);
                $insert_stmt_leave_credits_content->bindParam(':total_credits', $content['total_credits'], PDO::PARAM_STR);
                $insert_stmt_leave_credits_content->execute();
            }

            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            throw $e; // Rethrow exception to handle it in add_leave.php
        } finally {
            $this->close();
        }
    }
}
?>