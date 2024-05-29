<?php
include 'session.php';
include 'includes/Payroll-Master-header.php';
include 'config/connection.php';
require_once 'Controller/controller_user.php';
$user = new User();

function displayField($field, $part_time) {
    if ($part_time == 'part_time') {
        if ($field == 1) {
            return "part-time";
        } elseif ($field == 0) {
            return "full-time";
        }
    } else {
        if (!empty($field)) {
            return $field;
        } else {
            return "N/A";
        }
    }
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<?php if (isset($_SESSION['User-alert_success']) && $_SESSION['User-alert_success'] != '') { ?>
    <?php if ($_SESSION['User-alert_type'] == 'success') { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['User-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } elseif ($_SESSION['User-alert_type'] == 'danger') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['User-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php unset($_SESSION['User-alert_success']);
          unset($_SESSION['User-alert_type']);
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
                        <!-- <th>Employee</th>
                        <th>Employee Name</th>
                        <th>Total Offset Hours</th>
                        <th>Used Offset Hours</th>
                        <th>Remaining Hours</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include our connection
                    $database = new Connection();
                    $db = $database->open();
                    try {
                        $sql = "SELECT * FROM display_employee ORDER BY full_name ;";
                        foreach ($db->query($sql) as $employee) {
                            ?>
                            <!-- <tr>
                                <td>
                                    Employee: <php echo displayField($employee['full_name'], 'full_name'); ?>
                                    <br>
                                    Position: <php echo displayField($employee['position'], 'position'); ?>
                                    <br>
                                    Department: <php echo displayField($employee['department_name'], 'department_name'); ?>
                                    <br>
                                    Employment Type: <php echo displayField($employee['part_time'], 'part_time'); ?>
                                </td>
                                 <td><php echo $employee['total_offset']; ?></td>
                                <td><php echo $employee['used_offset']; ?></td> 
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Buttons">
                                        <a href="#ViewtOffset_<php echo $employee['employee_id']; ?>" class="btn btn-info btn-sm" data-toggle="modal"><i class="fa-solid fa-pen"></i> View</a>
                                        <php include('view_offset.php'); ?>
                                    </div>
                                </td>
                            </tr> -->
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
