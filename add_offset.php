<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Check if session is not started and then start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_offset.php';

if (isset($_POST['addOffset'])) {
    $employee_id = $_POST['employee_id'];
    // $Offset1 = $_POST['total_offset'];
    $hours = $_POST['hours'];

    $offset = new Offset(); // Instantiate the Offset class
    $result = $offset->add_offset($employee_id, $hours); // Call the add_offset method


    $_SESSION['Offset-alert_success'] = 'Offset added successfully';
    $_SESSION['Offset-alert_type'] = 'success';

    // Redirect to the same page after processing the form
    header('Location: Payroll_Master_Offset.php');
    exit();
}
?>

<head>


</head>

<div class="modal fade" id="addOffset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add Offset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" id="insert_form" class="needs-validation" action="add_offset.php" novalidate>
                        <div class="paste-new-forms">
                            <input type="hidden" id="employee_id" name="employee_id">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="search" class="form-label">Employee Name:</label>
                                    <input type="text" class="form-control" id="search" name="searchEmployee" placeholder="Search..." required>
                                    <div class="invalid-feedback">Please provide a search term.</div>
                                    <div id="searchResult" class="list-group" style="position: absolute; z-index: 1000;"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="totalOffsetContainer" class="form-label">Total Credit:</label>
                                    <input type="text" id="totalOffsetContainer" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="position" class="form-label">Position:</label>
                                    <input type="text" id="position" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="department" class="form-label">Department:</label>
                                    <input type="text" id="department" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Date:</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                    <div class="invalid-feedback">Please select a date.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="hours" class="form-label">Hours:</label>
                                    <input type="number" class="form-control" id="hours" name="hours" min="1" max="24" required>
                                    <div class="invalid-feedback">Please enter a valid number of hours.</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="time_from" class="form-label">Time Start:</label>
                                    <input type="time" class="form-control" id="time_from" name="time_from" required>
                                    <div class="invalid-feedback">Please select a start time.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="time_to" class="form-label">Time End:</label>
                                    <input type="time" class="form-control" id="time_to" name="time_to" required>
                                    <div class="invalid-feedback">Please select an end time.</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="reason" class="form-label">Reason:</label>
                                    <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                    <div class="invalid-feedback">Please provide a reason.</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="total" class="form-label">Total Hours:</label>
                                    <input type="text" class="form-control" id="total" name="total" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="addOffset" class="btn btn-primary">Add Offset</button>
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
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {
                        query: query
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
            var totalOffset = $(this).data('total-offset'); // Add this line
            $('#search').val(text);
            $('#employee_id').val(id);
            $('#total_offset').val(totalOffset); // Set the total offset value
            $('#searchResult').html('');

            // Show and make the total offset field read-only
            $('#totalOffsetContainer').show();
        });

        // No need to hide the total offset field on modal open
    });
</script>