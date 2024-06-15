<?php
require_once "config/connection.php";

class Salary extends Connection
{

    function get_all_employee_salary()
    {
        $conn = $this->open();
        $sql = "SELECT e.employee_id,e.employee_number,CONCAT(e.first_name, ' ', e.last_name) AS full_name,s.*, ep.*,dept.*,ed.*
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

    function add_salary($employee_salary, $salary, $effective_date)
    {
        $conn = $this->open();

        try {
            $conn->beginTransaction();

            // Fetch employee and position details
            $sql = "SELECT
                        e.employee_id,
                        e.employee_number,
                        CONCAT(e.first_name, ' ', e.last_name) AS full_name,
                        ep.*
                    FROM
                        tbl_employee e
                    INNER JOIN tbl_employee_details ed ON
                        e.employee_id = ed.employee_details_id
                    INNER JOIN tbl_position ep ON
                        ep.position_id = ed.employee_details_position
                    WHERE
                        e.employee_id = :employee_salary
                        AND ep.salary_type IN ('Monthly Rate', 'Hourly Rate')";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':employee_salary', $employee_salary);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                $_SESSION['Salary-alert_success'] = 'Employee or position not found';
                $_SESSION['Salary-alert_type'] = 'danger';
                $conn->rollBack();
                $this->close();
                header('Location: School_Admin_Salary.php');
                exit();
            }

            // Update salary
            $update_user = "UPDATE tbl_employee_salary 
                            SET salary = :salary, effective_date = :effective_date
                            WHERE salary_id = :employee_salary";

            $update_stmt = $conn->prepare($update_user);
            $update_stmt->bindParam(':employee_salary', $employee_salary);
            $update_stmt->bindParam(':effective_date', $effective_date);
            $update_stmt->bindParam(':salary', $salary);

            $update_stmt->execute();

            if ($update_stmt->rowCount() > 0) {
                // Check if the salary_type is Monthly Rate
                if ($result['salary_type'] == 'Monthly Rate') {
                    // Get SSS ID using the getSSSId method
                    $sss_id = $this->getSSSId($conn, 'tbl_contribution_sss', $effective_date);
                    if (!$sss_id) {
                        throw new Exception("No active SSS contribution available for employee ID:");
                    }

                    // Insert into tbl_employee_contribution_deductions
                    $insert_contribution = "INSERT INTO tbl_employee_contribution_deductions (employee_id,sss_id)
                                            VALUES (:employee_salary,:sss_id)";

                    $insert_stmt = $conn->prepare($insert_contribution);
                    $insert_stmt->bindParam(':employee_salary', $employee_salary);
                    $insert_stmt->bindParam(':sss_id', $sss_id);
                    $insert_stmt->execute();
                }

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

    function add_salary_adjustment($id_salary, $salary_adjustment, $reason, $effective_date)
    {
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

    private function update_employee_salary($conn, $id_salary, $salary_adjustment)
    {
        $update_salary = "UPDATE `tbl_employee_salary` SET `salary` = `salary` + :salary_adjustment WHERE `salary_id` = :id_salary";
        $update_stmt = $conn->prepare($update_salary);
        $update_stmt->bindParam(':salary_adjustment', $salary_adjustment);
        $update_stmt->bindParam(':id_salary', $id_salary);
        $update_stmt->execute();
    }



    function view_salary_adjustments($id_salary)
    {
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
                    INNER JOIN tbl_employee_details ed ON e.employee_id = ed.employee_details_id
                    INNER JOIN tbl_position ep ON ep.position_id = ed.employee_details_position
                    LEFT JOIN tbl_department dept ON dept.department_id = ed.employee_details_department
                    INNER JOIN tbl_employee_salary s ON e.employee_id = s.employee_salary
                    INNER JOIN tbl_employee_salary_adjustment esa ON s.salary_id = esa.id_salary
                WHERE
                    esa.id_salary = ?;";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':salary_id', $id_salary, PDO::PARAM_INT);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function add_contribution_sss($contribution_name, $date_created, $status, $minimum_prices, $maximum_prices, $employee_compensations, $sss_rates, $totals){
        $conn = $this->open();
        try {

            // Begin transaction
            $conn->beginTransaction();

            // Update the last active contribution to 'Inactive'
            $update_sql_inactive_last = "UPDATE `tbl_contribution_sss` 
                SET `status` = 'Inactive' 
                WHERE `status` = 'Active' 
                ORDER BY `date_created` DESC 
                LIMIT 1";
            $conn->exec($update_sql_inactive_last);

            // Insert into tbl_contribution_sss
            $insert_sql_sss_contribution = "INSERT INTO `tbl_contribution_sss` (`contribution_name`, `date_created`, `status`) VALUES (:contribution_name, :date_created, :status)";
            $insert_stmt_sss_contribution = $conn->prepare($insert_sql_sss_contribution);
            $insert_stmt_sss_contribution->bindParam(':contribution_name', $contribution_name);
            $insert_stmt_sss_contribution->bindParam(':date_created', $date_created);
            $insert_stmt_sss_contribution->bindParam(':status', $status);
            $insert_stmt_sss_contribution->execute();

            // Get the ID of the newly inserted contribution
            $sss_id = $conn->lastInsertId();

            // Insert into tbl_contribution_sss_contents for each item
            $insert_sql_sss_contribution_content = "INSERT INTO `tbl_contribution_sss_contents` (`sss_id`, `minimum_price`, `maximum_price`, `employee_compensation`, `sss_rate`, `total`) VALUES (:sss_id, :minimum_price, :maximum_price, :employee_compensation, :sss_rate, :total)";
            $insert_stmt_sss_contribution_content = $conn->prepare($insert_sql_sss_contribution_content);

            // Loop through arrays to insert multiple rows
            for ($i = 0; $i < count($minimum_prices); $i++) {
                // Bind parameters for each iteration
                $insert_stmt_sss_contribution_content->bindParam(':sss_id', $sss_id);
                $insert_stmt_sss_contribution_content->bindParam(':minimum_price', $minimum_prices[$i]);
                $insert_stmt_sss_contribution_content->bindParam(':maximum_price', $maximum_prices[$i]);
                $insert_stmt_sss_contribution_content->bindParam(':employee_compensation', $employee_compensations[$i]);
                $insert_stmt_sss_contribution_content->bindParam(':sss_rate', $sss_rates[$i]);
                $insert_stmt_sss_contribution_content->bindParam(':total', $totals[$i]);
                $insert_stmt_sss_contribution_content->execute();
            }

            // Update tbl_employee_salary with the new sss_id for non-part-time employees
            // Update tbl_employee_salary with the new sss_id for non-part-time employees
            $update_sql_employee_salary = "UPDATE `tbl_employee_contribution_deductions` 
                        SET `sss_id` = :sss_id 
                        WHERE `employee_id` IN (
                            SELECT `details_id` 
                            FROM `tbl_employee_details` 
                            JOIN `tbl_position` ON `tbl_employee_details`.`employee_details_position` = `tbl_position`.`position_id`
                            WHERE `tbl_position`.`salary_type` = 'Monthly Rate'
                        )";

            $update_stmt_employee_salary = $conn->prepare($update_sql_employee_salary);
            $update_stmt_employee_salary->bindParam(':sss_id', $sss_id);
            $update_stmt_employee_salary->execute();


            // Commit the transaction
            $conn->commit();

            // Close statement and connection
            $insert_stmt_sss_contribution->closeCursor();
            $insert_stmt_sss_contribution_content->closeCursor();

            $_SESSION['SSS-alert_success'] = 'Position added successfully';
            $_SESSION['SSS-alert_type'] = 'success';
        
            header('Location: Accounting_SSS.php');
            exit(); // Exit after redirect
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['SSS-alert_success'] = 'Error adding position: ' . $e->getMessage();
            $_SESSION['SSS-alert_type'] = 'danger';
            header('Location: Accounting_SSS.php');
            exit(); // Exit after redirect
        }
        $this->close();
    }


    /*  function view_salary_adjustments($salary_id) {
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
LEFT JOIN tbl_department dept ON
    dept.department_id = ed.employee_details_department
INNER JOIN tbl_employee_salary s ON
    e.employee_id = s.employee_salary
INNER JOIN tbl_employee_salary_adjustment esa ON
    s.salary_id = esa.id_salary
WHERE
    esa.id_salary = s.salary_id;";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':salary_id', $salary_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }*/

    private function getSSSId($conn, $table, $effective_date)
    {
        $sss_id = null;

        // Retrieve the latest active SSS ID based on the effective date
        $sssQuery = "SELECT sss_id FROM $table WHERE date_created <= :effective_date AND status = 'Active' ORDER BY date_created DESC LIMIT 1";
        $sssStmt = $conn->prepare($sssQuery);
        $sssStmt->bindParam(':effective_date', $effective_date);
        $sssStmt->execute();

        $rowSSS = $sssStmt->fetch(PDO::FETCH_ASSOC);

        if ($rowSSS && isset($rowSSS['sss_id'])) {
            $sss_id = $rowSSS['sss_id']; // Store the retrieved SSS ID
        }

        if (!$sss_id) {
            // If no specific SSS ID is found based on the effective date, use the latest active SSS ID
            $defaultSSSQuery = "SELECT sss_id FROM $table WHERE status = 'Active' ORDER BY date_created DESC LIMIT 1";
            $defaultSSSStmt = $conn->prepare($defaultSSSQuery);
            $defaultSSSStmt->execute();
            $rowDefaultSSS = $defaultSSSStmt->fetch(PDO::FETCH_ASSOC);

            if ($rowDefaultSSS && isset($rowDefaultSSS['sss_id'])) {
                $sss_id = $rowDefaultSSS['sss_id']; // Store the fallback SSS ID
            }
        }

        if (!$sss_id) {
            throw new Exception("No active SSS contribution available for the specified effective date.");
        }

        return $sss_id;
    }
}
