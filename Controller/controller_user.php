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
}
?>
