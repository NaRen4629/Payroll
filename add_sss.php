<div class="modal fade" id="addSalary" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SSS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_salary.php" method="post">
                    <div class="row main-form">
                        <div class="col-md-3 mb-3">
                            <label for="range_from"><span class="required">*</span>Range From:</label>
                            <input type="text" name="range_from[]" class="form-control form-control-sm" value="1" readonly dir="rtl">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="range_to"><span class="required">*</span>Range To:</label>
                            <input type="text" name="range_to[]" class="form-control form-control-sm" required dir="rtl">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="employee_compensation"><span class="required">*</span>Employee Compensation:</label>
                            <input type="text" name="employee_compensation[]" class="form-control form-control-sm" required dir="rtl">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="product_total">Total:</label>
                            <div class="input-group">
                                <input type="text" name="product_total[]" class="form-control form-control-sm" readonly dir="rtl">
                                <button type="button" class="btn btn-success btn-sm add-more-form ms-2"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="paste-new-forms"></div>
                    <div class="modal-footer">
                        <legend>
                            <h6 class="text-dark">NOTE: <span class="required">*</span> Indicates Required Fields</h6>
                        </legend>
                        <div class="col-md-6">
                            <label class="form-label text-dark mb-0">SSS Rate:</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="sssRateInput" name="sss_rates[]" readonly>
                                <button type="button" class="btn btn-success btn-sm ms-2" onclick="enableEdit()">Edit</button>
                                <button type="button" class="btn btn-primary btn-sm ms-2 d-none" id="saveButton" onclick="saveChanges()">Save</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="addDeductions" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function calculateTotal() {
            var sssRate = parseFloat($('#sssRateInput').val()) || 0;
            $('.main-form').each(function() {
                var employeeCompensation = parseFloat($(this).find('input[name="employee_compensation[]"]').val()) || 0;
                var productTotal = employeeCompensation * sssRate;
                $(this).find('input[name="product_total[]"]').val(productTotal.toFixed(2));
            });
        }

        $(document).on('input', 'input[name="employee_compensation[]"], #sssRateInput', calculateTotal);

        $(document).on('click', '.add-more-form', function() {
            var lastRangeTo = $('input[name="range_to[]"]').last().val();
            var lastECInput = $('.main-form:last').find('input[name="employee_compensation[]"]');
            var lastEC = parseFloat(lastECInput.val());
            var incrementedEC = isNaN(lastEC) ? '' : lastEC + 500;
            var newForm = `
                <div class="row main-form">
                    <div class="col-md-3 mb-3">
                        <label for="range_from"><span class="required">*</span>Range From:</label>
                        <input type="text" name="range_from[]" class="form-control form-control-sm" value="${lastRangeTo}" required readonly dir="rtl">
                        <div class="invalid-feedback">Please enter range from.</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="range_to"><span class="required">*</span>Range To:</label>
                        <input type="text" name="range_to[]" class="form-control form-control-sm" required dir="rtl">
                        <div class="invalid-feedback">Please enter range to.</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="employee_compensation"><span class="required">*</span>Employee Compensation:</label>
                        <input type="text" name="employee_compensation[]" class="form-control form-control-sm" required value="${incrementedEC}" dir="rtl" readonly>
                        <div class="invalid-feedback">Please enter employee compensation.</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="product_total">Total:</label>
                        <div class="input-group">
                            <input type="text" name="product_total[]" class="form-control form-control-sm" readonly dir="rtl">
                            <button type="button" class="btn btn-danger btn-sm remove-btn ms-2"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            `;
            $('.paste-new-forms').append(newForm);
            calculateTotal(); // Calculate total for the newly added form
        });

        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.main-form').remove();
            calculateTotal();
        });
    });

    function enableEdit() {
        document.getElementById('sssRateInput').removeAttribute('readonly');
        document.getElementById('saveButton').classList.remove('d-none');
    }

    function saveChanges() {
        document.getElementById('sssRateInput').setAttribute('readonly', 'readonly');
        document.getElementById('saveButton').classList.add('d-none');
        $(document).trigger('input', '#sssRateInput');
    }
</script>
