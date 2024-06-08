<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        #select_box {
            width: 100%; /* You can set a specific width like 300px if needed */
        }
    </style>
    <script src="library/dselect.js"></script>
</head>
<div class="modal fade" id="addSalary" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Salary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_user.php" method="post">
                    <div class="mb-3">
                        <label for="select_box" class="form-label">Select Employee</label>
                        <select name="select_box" class="form-select" id="select_box" required>
                            <option value="" selected disabled>Select Employee</option>
                            <?php foreach ($employee_salaries as $employee_salary) : ?>
                                <option value="<?php echo $employee_salary['salary_id']; ?>">
                                    <?php echo $employee_salary['full_name']; ?> - <?php echo $employee_salary['salary']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    
                    <div class="modal-footer">
                        <small class="text-muted"><span class="required">* </span>Indicates required fields</small>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addUsers">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var select_box_element = document.querySelector('#select_box');
        dselect(select_box_element, { search: true });
    });
</script>
