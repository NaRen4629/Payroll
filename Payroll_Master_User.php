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
?>


<!-- Begin Page Content -->

<div class="container-fluid">

    <?php if (isset($_SESSION['User-alert']) && $_SESSION['User-alert'] != '') { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['User-alert']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['User-alert']);
    } ?>

    <div class="page-title">
        <h3 class="font-weight-bold text-primary">User's</h3>
    </div>

    <!-- DataTables Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->   
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">Add User</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Password</th>
                        <th>User Level </th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        // Include our connection
                        $database = new Connection();
                        $db = $database->open();
                        try {
                            $sql = 'SELECT * FROM tbl_user_level';
                            foreach ($db->query($sql) as $Users) {
                                ?>
                                <tr>
                                    <td><?php echo $Users['user_id']; ?></td>
                                    <td><?php echo $Users['Employee_ID']; ?></td>
                                    <td><?php echo $Users['Password']; ?></td>
                                    <td><?php echo $Users['Userlevel']; ?></td>
                                    <td><?php echo $Users['Status']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Buttons">
                                            <!-- <a href="#editUser_<?php echo $Users['user_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa-solid fa-pen"></i> Edit</a>
                                            <a href="#deleteUer_<?php echo $Users['user_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Delete</a> -->
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
    <?php include 'add_user.php'; ?>

    <!-- <?php include 'modals/Payroll_Master/Maintenance/User/add_user.php'; ?> -->
</div>
<!-- /.container-fluid -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>
