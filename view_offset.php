<div class="modal fade" id="ViewtOffset_<?php echo $employee['employee_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="myModalLabel">View Offset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="edit_user.php" method="post" class="row g-3" id="editUserForm">
                    <input type="hidden" class="form-control form-control-sm" name="employee_id" value="<?php echo $employee['employee_id']; ?>">
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Employee Name</label>
                        <input type="text" class="form-control form-control-sm" id="employeeName" name="employee_name" value="<?php echo $employee['employee_name']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control form-control-sm" id="position" name="position" value="<?php echo $employee['position']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control form-control-sm" id="department" name="department" value="<?php echo $employee['department']; ?>" readonly>
                    </div>
                    <!-- Add more fields as needed for Total Current Offset, Date Time Start, Time End, Show Total, Reason -->
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
