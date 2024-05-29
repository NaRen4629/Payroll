<?php
include_once('config/connection.php'); // Make sure this path is correct

class Offset extends Connection
{
    function add_offset($employee_id, $hours)
    { 
         $conn = $this->open();
        try {
            $conn->beginTransaction();

            // Check if the offset for this employee_id already exists
            $check_sql_offset = "SELECT offset_id, total_offset FROM `tbl_offset` WHERE employee_id = :employee_id";
            $check_stmt_offset = $conn->prepare($check_sql_offset);
            $check_stmt_offset->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
            $check_stmt_offset->execute();

            $existing_offset = $check_stmt_offset->fetch(PDO::FETCH_ASSOC);

            if ($existing_offset) {
                // Offset already exists, update the total_offset
                $new_total_offset = $existing_offset['total_offset'] + $hours;

                $update_sql_offset = "UPDATE `tbl_offset` SET `total_offset` = :new_total_offset WHERE `offset_id` = :offset_id";
                $update_stmt_offset = $conn->prepare($update_sql_offset);
                $update_stmt_offset->bindParam(':new_total_offset', $new_total_offset, PDO::PARAM_INT);
                $update_stmt_offset->bindParam(':offset_id', $existing_offset['offset_id'], PDO::PARAM_INT);
                $update_stmt_offset->execute();

                $offset_id = $existing_offset['offset_id'];
            } else {
                // Insert into tbl_offset
                $insert_sql_offset = "INSERT INTO `tbl_offset` (`employee_id`, `total_offset`) 
                                    VALUES (:employee_id, :total_offset)";
                $insert_stmt_offset = $conn->prepare($insert_sql_offset);
                $insert_stmt_offset->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
                $insert_stmt_offset->bindParam(':total_offset', $hours, PDO::PARAM_INT);
                $insert_stmt_offset->execute();

                // Get the ID of the newly inserted offset
                $offset_id = $conn->lastInsertId();
            }

            // Check if offset_id already exists in tbl_offset_contents
            $check_sql_contents = "SELECT COUNT(*) AS count FROM `tbl_offset_contents` WHERE offset_id = :offset_id";
            $check_stmt_contents = $conn->prepare($check_sql_contents);
            $check_stmt_contents->bindParam(':offset_id', $offset_id, PDO::PARAM_INT);
            $check_stmt_contents->execute();

            $content_exists = $check_stmt_contents->fetch(PDO::FETCH_ASSOC)['count'];

            if ($content_exists == 0) {
                // Insert into tbl_offset_contents with only offset_id
                $insert_sql_contents = "INSERT INTO `tbl_offset_contents` (`offset_id`) 
                                    VALUES (:offset_id)";
                $insert_stmt_contents = $conn->prepare($insert_sql_contents);
                $insert_stmt_contents->bindParam(':offset_id', $offset_id, PDO::PARAM_INT);
                $insert_stmt_contents->execute();
            }

            // Commit the transaction
            $conn->commit();

            // Close statements
            if (isset($insert_stmt_offset)) {
                $insert_stmt_offset->closeCursor();
            }
            if (isset($insert_stmt_contents)) {
                $insert_stmt_contents->closeCursor();
            }

            return true; // Success
        } catch (PDOException $e) {
            // Rollback the transaction if an error occurred
            $conn->rollback();

            // Handle errors (optional)
            die("Error: " . $e->getMessage());
        }
        $this->close();
        }
}
?>
