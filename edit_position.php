<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_user.php';
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
                <form action="edit_user.php" method="post" class="row g-3" id="editUserForm_<?php echo $Position['position_id']; ?>">
                    <input type="hidden" class="form-control form-control-sm" name="position_id" value="<?php echo $Position['position_id']; ?>">
                    <div class="mb-3 row">
                        <label for="employe_type" class="col-sm-4 col-form-label">Employee Type:</label>
                        <div class="col-sm-8">
                            <select name="employe_type" class="form-control" required>
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
                                <option value="Regular">Regular</option>
                                <option value="Not Regular">Not Regular</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-4 col-form-label"><span class="required">*</span>Status:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="status" required>
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6><span class="required">* </span>Indicates required fields</h6>
                        </legend>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editUserBtn_<?php echo $Position['position_id']; ?>" name="editUser">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
