<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_holiday.php';

if (isset($_POST['addHoliday'])) {
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    $type_of_holiday = $_POST['type_of_holiday'];
    $name_of_holiday = $_POST['name_of_holiday'];
    $status = $_POST['status'];

    $Holiday = new Holiday();
    $Holiday->add_holiday($date_from, $date_to, $type_of_holiday, $name_of_holiday, $status);
}
?>

<div class="modal fade" id="addHoliday" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Holiday</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_holiday.php" method="post">
                    <div class="row main-form">
                        <!-- Date From and Date To in the same row -->
                        <div class="mb-3 row align-items-center">
                            <label for="dateFrom" class="col-sm-2 col-form-label"><span class="required">*</span>Date From</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="date_from" required>
                            </div>
                            <label for="dateTo" class="col-sm-2 col-form-label">Date To</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="date_to">
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="holidayType" class="col-sm-3 col-form-label"><span class="required">*</span>Type of Holiday</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="type_of_holiday" required>
                                    <option value="">Select Type</option>
                                    <option>Local School Declaration</option>
                                    <option>Special (Non-Working) Holidays</option>
                                    <option>Regular Holiday</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="holidayName" class="col-sm-3 col-form-label"><span class="required">*</span>Name of Holiday</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name_of_holiday" required>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="holidayType" class="col-sm-3 col-form-label">Status:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status" required>
                                    <option value="Active" selected>Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="addHoliday" class="btn btn-sm btn-primary float-end">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>