<?php
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" id="insert_form" class="needs-validation" action="add_offset.php" novalidate>
                        <div class="paste-new-forms">
                            <input type="hidden" id="employee_id" name="employee_id">
                            <div class="row main-form">
                                <div class="col-sm-12 mb-3">
                                    <label for="search" class="form-label">Search</label>
                                    <input type="text" class="form-control" id="search" name="searchEmployee" placeholder="Search..." required>
                                    <div class="invalid-feedback">
                                        Please provide a search term.
                                    </div>
                                    <div id="searchResult"></div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="hours" class="form-label">Hours</label>
                                    <input type="text" class="form-control" id="hours" name="hours" placeholder="Hours" required>
                                    <div class="invalid-feedback">
                                        Please provide the hours.
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3" id="totalOffsetContainer">
                                    <label for="total_offset" class="form-label">Total Offset</label>
                                    <input type="text" class="form-control" id="total_offset" name="total_offset" readonly>
                                    <div class="invalid-feedback">
                                        Please provide the total offset.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="addOffset" class="btn btn-primary btn-sm float-end">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#search').on('keyup', function(){
        var query = $(this).val();
        if(query != ''){
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {query: query},
                success: function(data){
                    $('#searchResult').html(data);
                }
            });
        } else {
            $('#searchResult').html('');
        }
    });

    $(document).on('click', '.search-item', function(){
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
