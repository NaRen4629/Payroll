<?php
include 'session.php';
include 'includes/Payroll-Master-header.php';
include 'config/connection.php';
require_once 'Controller/controller_leave.php';


$Leave = new Leave();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if (isset($_SESSION['Leave-alert_success']) && $_SESSION['Leave-alert_success'] != '') { ?>
        <?php if ($_SESSION['Leave-alert_type'] == 'success') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['Leave-alert_success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } elseif ($_SESSION['Leave-alert_type'] == 'danger') { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['Leave-alert_success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
    <?php unset($_SESSION['Leave-alert_success']);
        unset($_SESSION['Leave-alert_type']);
    } ?>

    <div class="page-title">
        <h3 class="font-weight-bold text-primary">Leave Credits</h3>
    </div>

    <!-- DataTables Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addleave">Add Leave Credits</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>
                        <tr>
                            <!-- <th>Employee</th> -->
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>Used Offset Hours</th>
                            <th>Remaining Hours</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include our connection
                        $database = new Connection();
                        $db = $database->open();
                        try {
                            $sql = "SELECT * FROM display_leave_employee_content3 ORDER BY full_name ;";
                            foreach ($db->query($sql) as $leave) {
                        ?>
                                <tr>

                                    <td><?php echo $leave['full_name']; ?></td>
                                    <td><?php echo $leave['leave_total_credits']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Buttons">
                                            <!-- <a href="#ViewtOffset_<php echo $leave['employee_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal"><i class="fa-solid fa-pen"></i> View</a> -->
                                            <!-- <php include('view_offset.php'); ?> -->
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
    <?php include 'add_leave.php'; ?>
</div>
<!-- /.container-fluid -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>