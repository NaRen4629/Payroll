<!-- <php

include 'session.php';
// Check if the user level is "Admin"
// if ($_SESSION["Userlevel"] == "School Admin") {
//     // Redirect to the appropriate page for Admin
//     header('location: SchooL_Admin_index.php');
//     exit();
// }
include 'includes/Payroll-Master-header.php';
include 'config/connection.php';
?> -->
<?php
include 'session.php';
include 'includes/Payroll-Master-header.php';
include 'config/connection.php';
require_once 'Controller/controller_user.php';
    $user = new User();
?>


<!-- Begin Page Content -->

<div class="container-fluid">

<?php if (isset($_SESSION['Leave-Setttings-alert_success']) && $_SESSION['Leave-Setttings-alert_success'] != '') { ?>
    <?php if ($_SESSION['Leave-Setttings-alert_type'] == 'success') { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Leave-Setttings-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } elseif ($_SESSION['Leave-Setttings-alert_type'] == 'danger') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Leave-Setttings-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php unset($_SESSION['Leave-Setttings-alert_success']);
          unset($_SESSION['Leave-Setttings-alert_type']);
} ?>

    <div class="page-title">
        <h3 class="font-weight-bold text-primary">Leave Settings</h3>
    </div>

    <!-- DataTables Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->   
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addleaveSetting">Add Leave Settings</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>
                        <th>Leave Credit Info</th>
                        <th>Default Credits</th>
                        <th>Status</th>

                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        // Include our connection
                        $database = new Connection();
                        $db = $database->open();
                        try {
                            $sql = 'SELECT * FROM tbl_leave_credits_settings';
                            foreach ($db->query($sql) as $Leave_credit) {
                                ?>
                                <tr>
                                    <td>
                                        Code:<?php echo $Leave_credit['leave_credit_code']; ?>
                                    <br>
                                        Leave Credit Name:<?php echo $Leave_credit['leave_credit_name'];?>
                                    <br>
                                        Leave Credit Name:<?php echo $Leave_credit['description'];?>
                                    </td>
                                    <td><?php echo $Leave_credit['default_credits']; ?></td>
                                  
                                    <td><?php echo $Leave_credit['status']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Buttons">
                                            <!-- <a href="#editUser_<php echo $Leave_credit['Leave-Setttings_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa-solid fa-pen"></i> Edit</a>
                                            <a href="#deleteUer_<php echo $Leave_credit['Leave-Setttings_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Delete</a>
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
    <?php include 'add_leave_settings.php'; ?>

</div>
<!-- /.container-fluid -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>
