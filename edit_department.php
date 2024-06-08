<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_department.php'; // Adjust this to your controller file

if (isset($_POST['editDepartment'])) {
    $department_id = $_POST['department_id'];
    $department_type = $_POST['department_type'];
    $department_code = $_POST['department_code'];
    $department_name = $_POST['department_name'];
    $status = $_POST['status'];

    $Department = new Department(); // Create an instance of the Position class
    $Department->update_department($department_id, $department_type, $department_code, $department_name, $status);
}
?>

<div class="modal fade" id="editDepartment<?php echo $Department['department_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="editDepartmentLabel">Edit Department</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit_department.php" method="post" class="row g-3" id="editDepartmentForm_<?php echo $Department['department_id']; ?>">
                    <input type="hidden" class="form-control form-control-sm" name="department_id" value="<?php echo $Department['department_id']; ?>">
                    <div class="mb-3 row">
                        <label for="departmentType" class="col-sm-3 col-form-label">Type:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="department_type" value="Faculty" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="departmentCode" class="col-sm-3 col-form-label">Department Code:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="department_code" value="<?php echo $Department['department_code']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="departmentName" class="col-sm-3 col-form-label">Department:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="department_name" value="<?php echo $Department['department_name']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-3 col-form-label"><span class="required">*</span>Status:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status" required>
                                <option value="Active" <?php if ($Department['status'] == 'Active') echo 'selected'; ?>>Active</option>
                                <option value="Inactive" <?php if ($Department['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6><span class="required">* </span>Indicates required fields</h6>
                        </legend>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editDepartment">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
