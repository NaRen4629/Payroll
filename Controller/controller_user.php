<?php
include_once('config/connection.php'); // Make sure this path is correct

class User extends Connection {

    function add_user($Employee_ID, $Password, $Userlevel, $Status) {
        $conn = $this->open();

        try {
            $conn->beginTransaction();

            $insert_user = "INSERT INTO `tbl_user_level`(`Employee_ID`, `Password`, `Userlevel`, `Status`)
                            VALUES (:Employee_ID, :Password, :Userlevel, :Status)";

            $insert_stmt_insert_user = $conn->prepare($insert_user);
            $insert_stmt_insert_user->bindParam(':Employee_ID', $Employee_ID);
            $insert_stmt_insert_user->bindParam(':Password', $Password);
            $insert_stmt_insert_user->bindParam(':Userlevel', $Userlevel);
            $insert_stmt_insert_user->bindParam(':Status', $Status);
            $insert_stmt_insert_user->execute();

            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
        }

        $this->close();
    }

    function update_user($Employee_ID, $Password, $Userlevel, $Status, $user_id) {
        $conn = $this->open();
    
        try {
            $conn->beginTransaction();
    
            $update_user = "UPDATE `tbl_user_level` SET `Employee_ID` = :Employee_ID, `Password` = :Password, `Userlevel` = :Userlevel, `Status` = :Status WHERE `user_id` = :user_id";
    
            $update_stmt = $conn->prepare($update_user);
            $update_stmt->bindParam(':Employee_ID', $Employee_ID);
            $update_stmt->bindParam(':Password', $Password);
            $update_stmt->bindParam(':Userlevel', $Userlevel);
            $update_stmt->bindParam(':Status', $Status);
            $update_stmt->bindParam(':user_id', $user_id);
    
            $update_stmt->execute();
    
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            // Handle exception
        }
    
        $this->close();
    }
    
    function delete_user($user_id) {
        $conn = $this->open();

        try {
            $conn->beginTransaction();

            $delete_user = "DELETE FROM `tbl_user_level` WHERE `user_id` = :user_id ";

            $insert_stmt_delete_user = $conn->prepare($delete_user);
            $insert_stmt_delete_user->bindParam(':user_id', $user_id);
    
            $insert_stmt_delete_user->execute();

            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
        }

        $this->close();
    }

}
?>
