<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'Controller/controller_salary.php';
if (isset($_POST['addSalary'])) {
    $employee_id = $_POST['select_box'];
    $effective_date = $_POST['effective_date'];

    $salary = null; // Initialize salary variable

    // Check if basic pay or hourly rate is provided and assign the salary accordingly
    if (!empty($_POST['basic_pay'])) {
        $salary = $_POST['basic_pay'];
    } elseif (!empty($_POST['hourly_rate'])) {
        $salary = $_POST['hourly_rate'];
    }

    if ($salary !== null) { // Ensure salary is not null before proceeding
        $Salary = new Salary();
        $Salary->add_salary($employee_id, $salary,$effective_date);
    } else {
        // Handle case where neither basic pay nor hourly rate is provided
        $_SESSION['Salary-alert_success'] = 'Salary information missing for employee ID: ' . $employee_id;
        $_SESSION['Salary-alert_type'] = 'danger';
    }
}
?>

<div class="modal fade" id="addSalary" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Salary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_salary.php" method="post">
                    <div class="mb-3">
                        <label for="select_box" class="form-label">Select Employee</label>
                        <select name="select_box" class="form-select" id="select_box" required>
                            <option value="" selected disabled>Select Employee</option>
                            <?php foreach ($employee_salaries as $employee_salary) : ?>
                                <option value="<?php echo $employee_salary['salary_id']; ?>" data-employee-type="<?php echo $employee_salary['salary_type']; ?>" data-employee-position="<?php echo $employee_salary['position']; ?>">
                                    <?php echo $employee_salary['full_name']; ?> - <?php echo $employee_salary['salary']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="employee_position" class="form-label">Employee Position</label>
                        <input type="text" name="employee_position" class="form-control" id="employee_position" readonly>
                    </div>
                    <div class="row mb-2 align-items-center">
                                    <label for="inputEffectiveDate" class="col-sm-3 col-form-label"><span class="required">*</span>Effective Date:</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control" name="effective_date">
                                    </div>
                                </div>
                    <div id="regularFields" style="display: none;">
                        <div class="mb-3">
                            <label for="basic_pay" class="form-label">Basic Pay (Monthly Rate)</label>
                            <input type="text" name="basic_pay" class="form-control" id="basic_pay">
                        </div>
                    </div>
                    <div id="notRegularFields" style="display: none;">
                        <div class="mb-3">
                            <label for="hourly_rate" class="form-label">Hourly Rate</label>
                            <input type="text" name="hourly_rate" class="form-control" id="hourly_rate">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <small class="text-muted"><span class="required">* </span>Indicates required fields</small>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addSalary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var select_box_element = document.querySelector('#select_box');
        dselect(select_box_element, {
            search: true
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var select_box_element = document.querySelector('#select_box');
        var regularFields = document.getElementById('regularFields');
        var notRegularFields = document.getElementById('notRegularFields');
        var employeePosition = document.getElementById('employee_position');

        select_box_element.addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            var employeeType = selectedOption.getAttribute('data-employee-type');
            var position = selectedOption.getAttribute('data-employee-position');

            employeePosition.value = position;

            if (employeeType === 'Monthly Rate') {
                regularFields.style.display = 'block';
                notRegularFields.style.display = 'none';
            } else if (employeeType === 'Hourly Rate') {
                regularFields.style.display = 'none';
                notRegularFields.style.display = 'block';
            } else {
                regularFields.style.display = 'none';
                notRegularFields.style.display = 'none';
            }
        });

        var initialOption = select_box_element.options[select_box_element.selectedIndex];
        var initialEmployeeType = initialOption.getAttribute('data-employee-type');
        var initialPosition = initialOption.getAttribute('data-employee-position');

        employeePosition.value = initialPosition;

        if (initialEmployeeType === 'Monthly Rate') {
            regularFields.style.display = 'block';
        } else if (initialEmployeeType === 'Hourly Rate') {
            notRegularFields.style.display = 'block';
        }
    });
</script>