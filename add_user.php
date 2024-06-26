<?php
// Check if session is not started and then start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_user.php';

if (isset($_POST['addUsers'])) {
    $Employee_ID = $_POST['Employee_ID'];
    $Password = $_POST['Password'];
    $Userlevel = $_POST['Userlevel'];
    $Status = $_POST['Status'];

    $user = new User();
    $user->add_user($Employee_ID, $Password, $Userlevel, $Status);

    $_SESSION['User-alert_success'] = 'User added successfully';
    $_SESSION['User-alert_type'] = 'success';

    // Redirect to the same page after processing the form
    header('Location: Payroll_Master_User.php');
    exit();
}
?>


<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Multi Columns Form -->
                <form action="add_user.php" method="post" id="">
                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>Employee ID:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="Employee_ID" value="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>Password:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="Password" value="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>User level:</div>
                        <div class="col-sm-7 pb-2 pt-3">
                            <select id="dropdown" name="Userlevel" class="form-select form-select-sm"  onchange="showTextInput()">
                                <option>Admin</option>
                                <option>Accounting</option>
                                <option>Faculty</option>
                                <option>School Admin</option>
                            </select>
                            <div>
                                <input type="text" class="form-control form-control-sm" name="customInput" id="customOption" style="display: none;"
                                    placeholder="Enter Another User Level">
                            </div>
                        </div>
                    </div>

                    <div class="row" id="addUserLevelButton" style="display: none;">
                        <div class="col-sm-5 pt-3"></div>
                        <div class="col-sm-7 pb-2 pt-3">
                            <input type="submit" name="addButton" value="Add Another User Level" class="btn btn-sm btn-primary">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>Status:</div>
                        <div class="col-sm-7 pb-2 pt-3">
                            <select id="Status" name="Status" class="form-select form-select-sm" >
                                <option value=""></option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6><span class="required">* </span>Indicates required fields</h6>
                        </legend>

                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="addUsers">Save</button>
                    </div>
                </form><!-- End Multi Columns Form -->
            </div>
        </div>
    </div>
</div>
