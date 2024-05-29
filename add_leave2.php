<!-- add req -->
<div class="modal fade" id="addleave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Request Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form method="POST" action="crud-operation.php" id="insert_form" class="needs-validation" novalidate>
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Request No -->
                                <div class="row mb-3">
                                    <div class="col-md-5 text-dark">Employee Name:</div>
                                    <div class="col-md-7">
                                    </div>
                                </div>

                                <!-- Supplier -->
                                <div class="row mb-3">
                                    <div class="col-md-5 text-dark"><span class="required">*</span>Position:</div>
                                    <div class="col-md-7">
                                        <select id="" name="supplier[]" class="form-select form-select-sm" required>
                                            <option value="">Select Supplier</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select supplier.
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-5 text-dark"><span class="required">*</span>Department:</div>
                                    <div class="col-md-7">
                                        <select id="" name="supplier[]" class="form-select form-select-sm" required>
                                            <option value="">Select Supplier</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select supplier.
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Date Request -->
                                <div class="row mb-3">
                                    <div class="col-md-5 text-dark">Total Leave Credits:</div>
                                    <div class="col-md-7">
                                        
                                    </div>
                                </div>
                                <!-- Requested By -->
                                <div class="row mb-3"style="display: none;">  
                                    <div class="col-md-5 text-dark"><span class="required">*</span>Requested By:</div>
                                    <div class="col-md-7">
                                        <select id="requestedby" name="requestedby[]" class="form-select form-select-sm" required>
                                            <option value="">Select Employee</option>
                                            
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select requested by.
                                        </div>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-3 d-none">
                                    <div class="col-md-7">
                                        <select type="hidden" id="reqstatus" name="reqstatus[]" class="form-select form-select-sm">
                                            <option type="hidden" selected>Pending</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- dynamic form -->
                        <div class="row main-form">
                            <div class="col-md-3 mb-3">
                                <label for="itemname[]"><span class="required">*</span>Item Name</label>
                                <select id="itemname" name="itemname[]" class="form-select form-select-sm" required>
                                    <option value="">Item Name</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select item name.
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="product_price[]"><span class="required">*</span>Unit Price</label>
                                <input type="text" name="product_price[]" pattern="^(?!₱0\.00$).*$" class="form-control form-control-sm" required>
                                <div class="invalid-feedback">
                                    Please enter unit price.
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="product_qty[]"><span class="required">*</span>Quantity</label>
                                <input type="number" name="product_qty[]" pattern="^(?!₱0\.00$).*" class="form-control form-control-sm" required>
                                <div class="invalid-feedback">
                                    Please enter quantity.
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="uom[]"><span class="required">*</span>UOM</label>
                                <select id="" name="uom[]" class="form-select form-select-sm" required>
                                    <option value="">UOM</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select unit of measures.
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="product_total[]">Total</label>
                                <div class="d-flex">
                                    <input type="text" name="product_total[]" class="form-control form-control-sm" style="width: 100px;" readonly>
                                    <button type="button" class="add-more-form btn btn-success btn-sm ms-2"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>


                            <div class="paste-new-forms"></div>

                            <div class="col-2 pt-3 text-dark"><span class="required">*</span>Purpose:</div>
                            <div class="col-5 pt-3 mb-3">
                                <textarea type="text" class="form-control form-control-sm" name="purpose[]" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter purpose of request.
                                </div>
                            </div>

                            <div class="col-md-2 mb-3 text-dark">Total Amount:</div>
                            <div class="col-md-2 mb-3">
                                <input type="text" class="form-control form-control-sm" name="totalamount" readonly>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <legend>
                                <h6 class="text-dark">NOTE: <span class="required">* </span>Indicates Required Fields</h6>
                            </legend>
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="savereq" class="btn btn-sm btn-primary float-end">Save</button>
                        </div>
                    </form>
                </div><!-- /.container-fluid -->
                <script>
                    $(document).ready(function() {
                   
                        $(document).on('click', '.remove-btn', function() {
                            $(this).closest('.main-form').remove();
                            calculateTotalAmount();
                        });

                      
                        $(document).on('click', '.add-more-form', function() {
                            var newForm = '<div class="row main-form">\
                <div class="col-md-3 mb-3">\
                    <label for="itemname[]"><span class="required">*</span>Item Name</label>\
                    <select id="itemname" name="itemname[]" class="form-select form-select-sm" required>\
                        <option value="">Item Name</option>\
                    </select>\
                    <div class="invalid-feedback">\
                        Please select item name.\
                    </div>\
                </div>\
                <div class="col-md-2 mb-3">\
                    <label for="product_price[]"><span class="required">*</span>Unit Price</label>\
                    <div class="input-group">\
                    <input type="text" name="product_price[]" pattern="^(?!₱0\.00$).*$" class="form-control form-control-sm" required>\
                    <div class="invalid-feedback">\
                        Please enter unit price.\
                    </div>\
                    </div>\
                </div>\
                <div class="col-md-2 mb-3">\
                    <label for="product_qty[]"><span class="required">*</span>Quantity</label>\
                    <input type="number" name="product_qty[]" class="form-control form-control-sm" required>\
                    <div class="invalid-feedback">\
                        Please enter quantity.\
                    </div>\
                    </div>\
                <div class="col-md-2 mb-3">\
                    <label for="uom[]"><span class="required">*</span>UOM</label>\
                    <select id="" name="uom[]" class="form-select form-select-sm" required>\
                        <option value="">UOM</option>\
                    </select>\
                    <div class="invalid-feedback">\
                        Please select unit of measure.\
                    </div>\
                </div>\
                <div class="col-md-2 mb-3">\
                    <label for="product_total[]">Total</label>\
                    <div class="d-flex">\
                        <input type="text" name="product_total[]" class="form-control form-control-sm" style="width: 100px;" readonly>\
                        <button type="button" class="remove-btn btn btn-danger btn-sm ms-2"><i class="fa-solid fa-trash"></i></button>\
                    </div>\
                </div>\
            </div>';

                            $('.paste-new-forms').append(newForm);
                        });
                    });
                </script>


            </div>
        </div>
    </div>
</div>