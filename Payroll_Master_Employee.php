<?php
include 'session.php';
include 'includes/Payroll-Master-header.php';
include 'config/connection.php';
require_once 'Controller/controller_user.php';
?>


<!-- Begin Page Content -->

<div class="container-fluid">

    <?php if (isset($_SESSION['Employee-alert_success']) && $_SESSION['Employee-alert_success'] != '') { ?>
        <?php if ($_SESSION['Employee-alert_type'] == 'success') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['Employee-alert_success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } elseif ($_SESSION['Employee-alert_type'] == 'danger') { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['Employee-alert_success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
    <?php unset($_SESSION['Employee-alert_success']);
        unset($_SESSION['Employee-alert_type']);
    } ?>

    <div class="page-title">
        <h3 class="font-weight-bold text-primary">Employee Details</h3>
    </div>

    <!-- DataTables Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">Add Employee</button> -->
            <a href="add_employee.php"class="btn btn-sm btn-primary">Add Employee</a>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>

                        <th>Employee Number</th>
                        <th>Employee Full Name</th>

                    </thead>
                    <tbody>
                        <?php
                        // Include our connection
                        $database = new Connection();
                        $db = $database->open();
                        try {
                            $sql = 'SELECT * from tbl_employee';
                            foreach ($db->query($sql) as $employee) {
                        ?>
                                <tr>
                                    <td><?php echo $employee['employee_number']; ?></td>
                                    <td><?php echo $employee['first_name'] . '  ' . $employee['last_name']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Buttons">
                                            <!-- <a href="#editUser_<php echo $employee['user_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa-solid fa-pen"></i> Edit</a>
                                            <a href="#deleteUer_<php echo $employee['user_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Delete</a>
                                       <php     include('edit_user.php');?>
                                       <php     include('delete_user.php');?> -->

                                        </div>
                                    </td>
                                </tr>

                        <?php
                            }
                        } catch (PDOException $e) {
                            echo "There is some problem in connection: " . $e->getMessage();
                        }

                        // Close connection
                        $database->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <?php include 'modals/Payroll_Master/Maintenance/User/add_user.php'; ?> -->
</div>
<!-- /.container-fluid -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>