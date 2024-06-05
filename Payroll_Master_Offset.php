<?php
include 'session.php';
include 'includes/Payroll-Master-header.php';
include 'config/connection.php';
require_once 'Controller/controller_user.php';
$user = new User();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<?php if (isset($_SESSION['Offset-alert_success']) && $_SESSION['Offset-alert_success'] != '') { ?>
    <?php if ($_SESSION['Offset-alert_type'] == 'success') { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Offset-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } elseif ($_SESSION['Offset-alert_type'] == 'danger') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Offset-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php unset($_SESSION['Offset-alert_success']);
          unset($_SESSION['Offset-alert_type']);
} ?>

<div class="page-title">
    <h3 class="font-weight-bold text-primary">Offset</h3>
</div>

<!-- DataTables Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- Button trigger modal -->   
        <!-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addOffset">Add Offset</button> -->
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Total Offset Hours</th>
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
                        $sql = "SELECT * FROM view_offset_contents;";
                        foreach ($db->query($sql) as $employee) {
                            ?>
                            <tr>
                                <td><?php echo $employee['full_name']; ?></td>
                                <td><?php echo $employee['offset_hours']; ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Buttons">    
                                    <a href="#viewOffset_<?php echo $employee['employee_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal"><i class="fa-solid fa-pen"></i>View Offset</a>
                                        <?php include('view_offset.php'); ?>
                                    <a href="#addOffset_<?php echo $employee['employee_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa-solid fa-pen"></i>Add Credit Offset</a>
                                        <?php include('add_offset_use.php'); ?>

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
<?php include 'add_offset.php'; ?>
</div>
<!-- /.container-fluid -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>
