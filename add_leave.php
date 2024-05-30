<?php
// Check if session is not started and then start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('config/connection.php');
require_once 'Controller/controller_leave.php';

$Leave = new Leave();
$view_leave_credits_types = $Leave->view_leave_credits_type();

if (isset($_POST['addLeave'])) {
    $details_id = $_POST['employee_id'];
    
    // Prepare the $schedule_contents array
    $schedule_contents = [
        [
            'date' => $_POST['date'],
            'time_from' => $_POST['time_from'],
            'time_to' => $_POST['time_to'],
            'total_credits' => 0 // Assuming you will calculate the total credits somewhere
        ]
    ];

    // Adding detailed error handling
    try {
        $Leave->add_leave_employee($details_id, $schedule_contents);

        $_SESSION['Leave-alert_success'] = 'Leave added successfully';
        $_SESSION['Leave-alert_type'] = 'success';

        // Redirect to the same page after processing the form  
        header('Location: Payroll_Maaster_Leave.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['Leave-alert_success'] = 'Failed to add leave: ' . $e->getMessage();
        $_SESSION['Leave-alert_type'] = 'danger';
    }
}
?>



<div class="modal fade" id="addleave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add Offset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" id="insert_form" class="needs-validation" action="add_leave.php" novalidate>
                        <div class="paste-new-forms">
                            <input type="hidden" id="employee_id" name="employee_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-5 text-dark">Employee Name:</div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="search" name="searchEmployee" placeholder="Search..." required>
                                            <div class="invalid-feedback">
                                                Please provide a search term.
                                            </div>
                                            <div id="searchResult" class="list-group" style="position: absolute; z-index: 1000;"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                    <div class="col-md-5 text-dark">Position:</div>
                                    <div class="col-md-7">
                                        <input type="text" id="position" class="form-control" name="position" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-5 text-dark">Department:</div>
                                    <div class="col-md-7">
                                        <input type="text" id="department" class="form-control" name="department" readonly>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for="leave_type" class="form-label"><span class="required">*</span>Type of Leave:</label>
                            <select class="form-select" id="leave_type" name="leave_type" required>
                                <?php foreach ($view_leave_credits_types as $leave_creadits) : ?>
                                    <option value="<?php echo htmlspecialchars($leave_creadits['credits_settings']); ?>">
                                        <?php echo htmlspecialchars($leave_creadits['leave_credit_name']); ?> (<?php echo htmlspecialchars($leave_creadits['leave_credit_code']); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                            <div class="row main-form">
                                <div class="col-md-6 mb-3">
                                    <label for="date" class="form-label"><span class="required">*</span>Date:</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                    <div class="invalid-feedback">Please select a date.</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="time_from" class="form-label"><span class="required">*</span>Time From:</label>
                                    <input type="time" class="form-control" id="time_from" name="time_from" required>
                                    <div class="invalid-feedback">Please select a start time.</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="time_to" class="form-label"><span class="required">*</span>Time To:</label>
                                    <input type="time" class="form-control" id="time_to" name="time_to" required>
                                    <div class="invalid-feedback">Please select an end time.</div>
                                </div>
                            </div>
                            <br>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="day" class="form-label">
                                        <h4>Total Day of Leave:</h4>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="addLeave" class="btn btn-primary btn-sm float-end">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query3 = $(this).val();
            if (query3 != '') {
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {
                        query3: query3
                    },
                    success: function(data) {
                        $('#searchResult').html(data);
                    }
                });
            } else {
                $('#searchResult').html('');
            }
        });

        $(document).on('click', '.search-item', function() {
            var text = $(this).text();
            var id = $(this).data('id');
            var position = $(this).data('position');
            var department = $(this).data('department_id');

            $('#search').val(text);
            $('#employee_id').val(id);
            $('#searchResult').html('');
            $('#position').val(position);
            $('#department').val(department);
        });

        // No need to hide the total offset field on modal open
    });
</script>