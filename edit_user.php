<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_user.php';

if(isset($_POST['editUser'])){
    $user_id = $_POST['user_id'];
    $Employee_ID = $_POST['Employee_ID'];
    $Password = $_POST['Password'];
    $Userlevel = $_POST['Userlevel'];
    $Status = 'Inactive';

    $user = new User();
    $user->update_user($Employee_ID, $Password, $Userlevel, $Status, $user_id);

    // Set a session variable to indicate success
    $_SESSION['User-alert'] = 'User Updated successfully';

    // Redirect to the same page after processing the form
    header('Location: Payroll_Master_User.php');
    exit();
}

?>
<div class="modal fade" id="editUser_<?php echo $Users['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="myModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="edit_user.php" method="post" class="row g-3" id="">
                    <input type="hidden" class="form-control form-control-sm" name="user_id" value="<?php echo $Users['user_id']; ?>">
                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>Employee ID:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" id="idEmployee_ID" name="Employee_ID" value="<?php echo $Users['Employee_ID']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>Password:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" id="Password" name="Password" value="<?php echo $Users['Password']; ?>">
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>User level:</div>
                        <div class="col-sm-7 pb-2 pt-3">
                            <select id="Userlevel" name="Userlevel" class="form-select form-select-sm"   onchange="showTextInput()">
                                <option ></option>
                                <option value="Admin" <?php echo ($Users['Userlevel'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="Faculty" <?php echo ($Users['Userlevel'] == 'Faculty') ? 'selected' : ''; ?>>Faculty</option>
                                <option value="Staff" <?php echo ($Users['Userlevel'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6><span class="required">* </span>Indicates required fields</h6>
                        </legend>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="ideditUser" name="editUser">Edit User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
