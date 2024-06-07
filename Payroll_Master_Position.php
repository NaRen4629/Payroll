<?php
include 'session.php';
include 'includes/Payroll-Master-header.php';
include 'config/connection.php';
require_once 'Controller/controller_position.php';
$position = new Position();

?>


<!-- Begin Page Content -->

<div class="container-fluid">

<?php if (isset($_SESSION['Position-alert_success']) && $_SESSION['Position-alert_success'] != '') { ?>
    <?php if ($_SESSION['Position-alert_type'] == 'success') { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Position-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } elseif ($_SESSION['Position-alert_type'] == 'danger') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Position-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php unset($_SESSION['Position-alert_success']);
          unset($_SESSION['Position-alert_type']);
} ?>

    <div class="page-title">
        <h3 class="font-weight-bold text-primary">Position</h3>
    </div>

    <!-- DataTables Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->   
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPosition">Add Position</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>
                        <th>Type</th>
                        <th>Position Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        // Include our connection
                        $database = new Connection();
                        $db = $database->open();
                        try {
                            $sql = 'SELECT * from tbl_position';
                            foreach ($db->query($sql) as $Position) {
                                ?>
                                <tr>
                                    <td><?php echo $Position['employee_type']; ?></td>
                                    <td><?php echo $Position['position']; ?></td>
                                    <td><?php echo $Position['type']; ?></td>
                                    <td><?php echo $Position['status']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Buttons">
                                            <a href="#editPosition_<?php echo $Position['position_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa-solid fa-pen"></i> Edit</a>
                                            <a href="#deletePosition_<?php echo $Position['position_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Delete</a>
                                       <?php include('edit_position.php');?>
                                       <?php include('delete_postion.php');?>

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
    <?php include 'add_position.php'; ?>

    <!-- <?php include 'modals/Payroll_Master/Maintenance/User/add_user.php'; ?> -->
</div>
<!-- /.container-fluid -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>
