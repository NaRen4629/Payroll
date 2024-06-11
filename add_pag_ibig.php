<div class="modal fade" id="addPag_Ibig" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pag Ibig</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add_salary.php" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="range_from"><span class="required">*</span> Fund Salary From:</label>
                            <input type="text" name="range_from[]" class="form-control form-control-sm" value="1" readonly dir="rtl">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="range_to"><span class="required">*</span> Fund Salary To:</label>
                            <input type="text" name="range_to[]" class="form-control form-control-sm"  dir="rtl">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="employee_percentage"><span class="required">*</span> Employee Percentage:</label>
                            <input type="text" name="employee_percentage[]" class="form-control form-control-sm"  dir="rtl">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="paste-new-forms"></div>
                </div>
                <div class="modal-footer">
                    <legend>
                        <h6 class="text-dark">NOTE: <span class="required">*</span> Indicates Required Fields</h6>
                    </legend>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addDeductions" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
