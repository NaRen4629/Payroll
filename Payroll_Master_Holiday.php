<?php
include 'session.php';
include 'includes/Payroll-Master-header.php';
include 'config/connection.php';
// require_once 'Controller/controller_Holiday.php';
// $Holiday = new Holiday();
?>

<!-- Begin Page Content -->

<div class="container-fluid">

<?php if (isset($_SESSION['Holiday-alert_success']) && $_SESSION['Holiday-alert_success'] != '') { ?>
    <?php if ($_SESSION['Holiday-alert_type'] == 'success') { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Holiday-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } elseif ($_SESSION['Holiday-alert_type'] == 'danger') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Holiday-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php unset($_SESSION['Holiday-alert_success']);
          unset($_SESSION['Holiday-alert_type']);
} ?>

    <div class="page-title">
        <h3 class="font-weight-bold text-primary">Holiday</h3>
    </div>

    <!-- DataTables Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->   
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addHoliday">Add Holiday</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Holiday Name</th>
                            <th>Date</th>
                            <th>Type of Holiday</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include our connection
                        $database = new Connection();
                        $db = $database->open();
                        try {
                            $sql = 'SELECT * from tbl_Holiday';
                            foreach ($db->query($sql) as $Holiday) {
                                ?>
                                <tr>
                                    <td><?php echo $Holiday['name_of_holiday']; ?></td>
                                    <td>
                                       Date From: <?php echo $Holiday['date_from']; ?><br>
                                       <?php if ($Holiday['date_to'] != '0000-00-00') { ?>
                                           Date To: <?php echo $Holiday['date_to']; ?>
                                       <?php } ?>
                                    </td>
                                    <td><?php echo $Holiday['type_of_holiday']; ?></td>
                                    <td><?php echo $Holiday['status']; ?></td>

                                   
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Buttons">
                                            <a href="#editHoliday_<?php echo $Holiday['holiday_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-pen"></i> Edit</a>
                                            <a href="#deleteHoliday_<?php echo $Holiday['holiday_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Delete</a>
                                       <?php include('edit_holiday.php');?>
                                       <?php include('delete_holiday.php');?>

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
    <?php include 'add_holiday.php'; ?>

    <!-- <?php include 'modals/Payroll_Master/Maintenance/User/add_user.php'; ?> -->
</div>
<!-- /.container-fluid -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>
