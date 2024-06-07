<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_position.php';

if (isset($_POST['addPosition'])) {
    $employee_type = $_POST['employe_type'];
    $position_name = $_POST['position'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    $position = new Position();
    $position->add_position($employee_type, $position_name, $type, $status);
}
?>

<div class="modal fade" id="addPosition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_position.php" method="post">
                    <div class="mb-3 row">
                        <label for="position" class="col-sm-3 col-form-label">Type:</label>
                        <div class="col-sm-9 d-flex align-items-center">
                            <select name="employe_type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Staff">Staff</option>
                                <option value="Faculty">Faculty</option>
                            </select>
                        </div>
                    </div>

                    <div class="paste-new-forms">
                        <div class="row main-form">
                            <div class="mb-3 row">
                                <label for="position" class="col-sm-3 col-form-label">Position</label>
                                <div class="col-sm-9 d-flex align-items-center">
                                    <input type="text" class="form-control" name="position" pattern="[a-zA-Z ]+" title="Position should contain only letters and spaces" required>
                                    <div class="invalid-feedback">Position should contain only letters and spaces</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="position" class="col-sm-3 col-form-label">Employment Type:</label>
                        <div class="col-sm-9 d-flex align-items-center">
                            <select name="type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Regular">Regular</option>
                                <option value="Not Regular">Not Regular</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="holidayType" class="col-sm-3 col-form-label"><span class="required">*</span>Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status" required>
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="addPosition" class="btn btn-sm btn-primary float-end">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>