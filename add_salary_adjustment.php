<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_salary.php';

if (isset($_POST['saveSalaryAdjustment'])) {
    $id_salary = $_POST['id_salary'];
    $salary_adjustment = $_POST['salary_adjustment'];
    $reason = $_POST['reason'];
    $effectivity_date = $_POST['effectivity_date'];

    $Salary = new Salary();
    $Salary->add_salary_adjustment($id_salary, $salary_adjustment, $reason, $effectivity_date);
    
}
?>
<div class="modal fade" id="addSalaryAdjustment<?php echo $Salary['salary_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="myModalLabel">Add Salary Adjustment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="add_salary_adjustment.php" method="post" class="row g-3">
                    <input type="hidden" class="form-control" name="id_salary" value="<?php echo $Salary['salary_id']; ?>">

                    <div class="col-md-6 mb-3">
                        <label for="employeeName" class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="employeeName" name="employee_name" value="<?php echo $Salary['full_name']; ?>" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" value="<?php echo $Salary['position']; ?>" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department" value="<?php echo $Salary['department_name']; ?>" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="currentSalary" class="form-label">Current Salary</label>
                        <input type="text" class="form-control" id="currentSalary" name="current_salary" value="<?php echo $Salary['salary']; ?>" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="salaryAdjustment" class="form-label">Salary Adjustment</label>
                        <input type="text" class="form-control" id="salaryAdjustment" name="salary_adjustment" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="effectiveDate" class="form-label">Effective Date</label>
                        <input type="date" class="form-control" id="effective_date" name="effectivity_date" required>
                    </div>


                            <!-- Salary Adjustments Table -->
        <h2>Salary Adjustments</h2>
        <table class="table">
    <thead>
        <tr>
            <th>Salary Adjustment</th>
            <th>Reason</th>
            <th>Effective Date</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        foreach ($view_salary_adjustments as $adjustment) {
 $formatdate = date("F d,Y", strtotime($adjustment['effective_date'])); 

            echo "<tr>";
            echo "<td>" . $adjustment['salary_adjustment'] . "</td>";
            echo "<td>" . $adjustment['reason'] . "</td>";
            echo "<td>" . $formatdate ."</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

                    

                    <div class="modal-footer mt-3">
                        <legend class="pt-3">
                            <h6><span class="required">* </span>Indicates required fields</h6>
                        </legend>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="ideditUser" name="saveSalaryAdjustment">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>