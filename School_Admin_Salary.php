<?php
include 'session.php';
include 'includes/School-Admin-header.php';
include 'config/connection.php';
require_once 'Controller/controller_salary.php';

$Salary = new Salary();
$employee_salaries = $Salary->get_all_employee_salary();
$view_salary_adjustments =$Salary->view_salary_adjustments();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="library/dselect.js"></script>
</head>

<body>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <?php if (isset($_SESSION['Salary-alert_success']) && $_SESSION['Salary-alert_success'] != '') { ?>
            <div class="alert alert-<?php echo $_SESSION['Salary-alert_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['Salary-alert_success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php unset($_SESSION['Salary-alert_success']);
            unset($_SESSION['Salary-alert_type']);
        } ?>

        <div class="page-title">
            <h3 class="font-weight-bold text-primary">Salary</h3>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSalary">Add Salary</button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Employee Type</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $database = new Connection();
                                $db = $database->open();

                                $sql = "SELECT
    e.employee_id,
    e.employee_number,
    CONCAT(e.first_name, ' ', e.last_name) AS full_name,
    s.*,
    ep.*,
    dept.*,
    ed.*
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
    ep.type IN('Regular', 'Not Regular')";

                                $stmt = $db->query($sql);

                                while ($Salary = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $status = $Salary['salary'] === null ? 'Not yet set' : 'Set';
                                    $statusClass = $status === 'Not yet set' ? 'text-danger' :  'text-success';

                            ?>
                                    <tr>
                                        <td><?php echo $Salary['full_name']; ?></td>
                                        <td><?php echo $Salary['employee_type']; ?></td>
                                        <td><?php echo $Salary['type']; ?></td>
                                        <td class="<?php echo $statusClass; ?>"><?php echo $status; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Buttons">
                                                <?php if ($status === 'Set') { ?>
                                                    <a href="#addSalaryAdjustment<?php echo $Salary['salary_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa-solid fa-pen"></i> Add Salary Adjustment</a>
                                                    <?php include('add_salary_adjustment.php'); ?>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } catch (PDOException $e) {
                                echo "There is some problem in connection: " . $e->getMessage();
                            }
                            $database->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include 'add_salary.php'; ?>
    </div>
    <!-- /.container-fluid -->

    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>
</body>

</html>
