<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_department.php';

if (isset($_POST['addDepartment'])) {
    $department_type = $_POST['department_type'];
    $department_code = $_POST['department_code'];
    $department_name = $_POST['department_name'];
    $status = $_POST['status'];

    $Department = new Department();
    $Department->add_department($department_type, $department_code, $department_name, $status);
}
?>

<div class="modal fade" id="addDepartment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_department.php" method="post">
                    <div class="mb-3 row">
                        <label for="position" class="col-sm-3 col-form-label">Type:</label>
                        <div class="col-sm-9 d-flex align-items-center">
                            <select name="department_type" class="form-control" required readonly>
                                <option value="Faculty" selected>Faculty</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="Department" class="col-sm-3 col-form-label">Department Code:</label>
                        <div class="col-sm-9 d-flex align-items-center">
                            <input type="text" class="form-control" name="department_code">
                            <!-- <button type="button" class="add-more-form btn btn-success btn-sm mt-2"><i class="fa-solid fa-plus"></i></button> -->
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <label for="position" class="col-sm-3 col-form-label">Department:</label>
                        <div class="col-sm-9 d-flex align-items-center">
                            <input type="text" class="form-control form-control-sm" name="department_name" value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="position" class="col-sm-3 col-form-label">Status:</label>
                        <div class="col-sm-9 d-flex align-items-center">
                            <select name="status" class="form-control" required>
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="addDepartment" class="btn btn-sm btn-primary float-end">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>