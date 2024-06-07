<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_position.php'; // Adjust this to your controller file

if(isset($_POST['editUser'])){
    $position_id = $_POST['position_id'];
    $employee_type = $_POST['employee_type'];
    $type = $_POST['type'];
    $position_name = $_POST['position'];
    $status = $_POST['status'];

    $position = new Position(); // Create an instance of the Position class
    $position->update_position($employee_type, $position_name, $type, $status, $position_id);
}


?>


<div class="modal fade" id="editPosition_<?php echo $Position['position_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editPositionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="editPositionLabel">Edit User Position</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <br>
            <div class="modal-body">
                <form action="edit_position.php" method="post" class="row g-3" id="editUserForm_<?php echo $Position['position_id']; ?>">
                    <input type="hidden" class="form-control form-control-sm" name="position_id" value="<?php echo $Position['position_id']; ?>">
                    <div class="mb-3 row">
                        <label for="employee_type" class="col-sm-4 col-form-label">Employee Type:</label>
                        <div class="col-sm-8">
                            <select name="employee_type" class="form-control" required>
                            <option value="">Select</option>
                                <option value="Faculty" <?php if ($Position['employee_type'] == 'Faculty') echo 'selected'; ?>>Faculty</option>
                                <option value="Staff" <?php if ($Position['employee_type'] == 'Staff') echo 'selected'; ?>>Staff</option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="position" class="col-sm-4 col-form-label">Position:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="position" pattern="[a-zA-Z ]+" title="Position should contain only letters and spaces" value="<?php echo $Position['position']; ?>" required>
                            <div class="invalid-feedback">Position should contain only letters and spaces</div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="type" class="col-sm-4 col-form-label">Employment Type:</label>
                        <div class="col-sm-8">
                            <select name="type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Regular" <?php if ($Position['type'] == 'Regular') echo 'selected'; ?>>Regular</option>
                                <option value="Not Regular" <?php if ($Position['type'] == 'Not Regular') echo 'selected'; ?>>Not Regular</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-4 col-form-label"><span class="required">*</span>status:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="status" required>
                                <option value="Active" <?php if ($Position['status'] == 'Active') echo 'selected'; ?>>Active</option>
                                <option value="Inactive" <?php if ($Position['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6><span class="required">* </span>Indicates required fields</h6>
                        </legend>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editPosition<?php echo $Position['position_id']; ?>" name="editUser">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
