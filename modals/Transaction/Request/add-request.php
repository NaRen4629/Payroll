<!-- add req -->
<div class="modal fade" id="addreqModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Request Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <?php
                //req num auto generated
                $database = new Connection();
                $con = $database->open();

                $query = "SELECT MAX(CAST(SUBSTRING_INDEX(request_id, '-', -1) AS UNSIGNED)) AS max_id FROM tbl_request";
                $result = $con->query($query);
                $row = $result->fetch();

                if ($row) {
                    $max_id = $row['max_id'];
                    $incremented_id = ($max_id === null) ? 1 : $max_id + 1;
                    $request_id = "REQ" . date("mdY") . "-" . sprintf('%03d', $incremented_id);
                } else {
                    $request_id = ""; // Default value if there is an error
                }



                function fill_uom_select_box($con)
                {
                    $output = '';
                    $query = "SELECT * FROM tb_uom ORDER BY uomname ASC";
                    $statement = $con->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach ($result as $row) {
                        $output .= '<option value="' . $row["uom_id"] . '">' . $row["uomname"] . '</option>';
                    }
                    return $output;
                }

                function fill_item_select_box($con)
                {
                    $output = '';
                    $query = "SELECT i.id, i.item_id, c.cat_name, s.sub_name, br.brand_name
                              FROM tbl_items i
                              LEFT JOIN tbl_subcategory s ON i.subcategory_id = s.sub_cat_id
                              LEFT JOIN tbl_category c ON s.category_id = c.cat_id
                              LEFT JOIN tbl_brand br ON i.brand_id = br.brand_id

                              ORDER BY i.brand_id ASC";

                    $statement = $con->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();

                    foreach ($result as $row) {
                        $brand_name = $row["brand_name"];
                        $cat_name = $row["cat_name"];
                        $sub_name = $row["sub_name"];
                        $item_id = $row["id"];

                        $option_value = "$brand_name-$cat_name-$sub_name";

                        $output .= '<option value="' . $item_id . '">' . $option_value . '</option>';
                    }

                    return $output;
                }

                function fill_supplier_select_box($con)
                {
                    $output = '';
                    $query = "SELECT suppid, businessname FROM tb_supplier ORDER BY businessname ASC";
                    $statement = $con->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach ($result as $row) {
                        $business_name = $row["businessname"];
                        $suppid = $row["suppid"]; // Get the supplier ID
                        $output .= '<option value="' . $suppid . '">' . $business_name . '</option>'; // Assign the business name as the display value
                    }
                    return $output;
                }
                function fill_employee_select_box($con)
                {
                    $output = '';
                    $query = "SELECT emp_ID, CONCAT(First_Name, ' ', Middle_Name, ' ', Last_Name) AS employee_name FROM tbl_employee_information ORDER BY employee_name ASC";
                    $statement = $con->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach ($result as $row) {
                        $employee_name = $row["employee_name"];
                        $emp_ID = $row["emp_ID"]; // Get the employee ID
                        $output .= '<option value="' . $emp_ID . '">' . $employee_name . '</option>'; // Assign the concatenated name as the display value
                    }
                    return $output;
                }

                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form method="POST" action="crud-operation.php" id="insert_form" class="needs-validation" novalidate>
                        <input type="hidden" name="request_id" value="<?php echo $Request['Request_No']; ?>">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Request No -->
                                <div class="row mb-3">
                                    <div class="col-md-5 text-dark">Request No:</div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control form-control-sm" id="requestNumber" name="Request_No[]" value="<?php echo $request_id; ?>" readonly>
                                    </div>
                                </div>

                                <!-- Supplier -->
                                <div class="row mb-3">
                                    <div class="col-md-5 text-dark"><span class="required">*</span>Supplier:</div>
                                    <div class="col-md-7">
                                        <select id="" name="supplier[]" class="form-select form-select-sm" required>
                                            <option value="">Select Supplier</option>
                                            <?php echo fill_supplier_select_box($con); ?>
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
                                    <div class="col-md-5 text-dark">Date Request:</div>
                                    <div class="col-md-7">
                                        <?php
                                        $date_request = date("m/d/Y");
                                        ?>
                                        <input type="text" class="form-control form-control-sm" id="dateRequest" name="dateRequest[]" value="<?php echo $date_request; ?>" readonly>
                                    </div>
                                </div>
                                <!-- Requested By -->
                                <div class="row mb-3">
                                    <div class="col-md-5 text-dark"><span class="required">*</span>Requested By:</div>
                                    <div class="col-md-7">
                                        <select id="requestedby" name="requestedby[]" class="form-select form-select-sm" required>
                                            <option value="">Select Employee</option>
                                            <?php echo fill_employee_select_box($con); ?>
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
                                    <?php echo fill_item_select_box($con); ?>
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
                                    <?php echo fill_uom_select_box($con); ?>
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
                        function calculateTotal(priceInput, quantityInput, totalInput) {
                            var price = parseFloat(priceInput.val().replace(/[^\d.]/g, '')) || 0;
                            var quantity = parseInt(quantityInput.val()) || 0;
                            var total = price * quantity;
                            totalInput.val('₱' + total.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }));
                        }


                        function formatCurrency(input) {
                            var value = input.val().replace(/[^\d.]/g, ''); // Remove non-numeric characters except dot
                            var cursorPosition = input[0].selectionStart; // Save cursor position
                            value = parseFloat(value) || 0;
                            var formattedValue = '₱' + value.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                            input.val(formattedValue);

                            // Restore cursor position
                            input[0].setSelectionRange(cursorPosition, cursorPosition);
                        }

                        function calculateTotalAmount() {
                            var totalAmount = 0;
                            $('input[name="product_total[]"]').each(function() {
                                totalAmount += parseFloat($(this).val().replace(/[^\d.]/g, '')) || 0;
                            });

                            // Format total amount with comma for thousands
                            var formattedTotal = '₱' + totalAmount.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });

                            $('input[name="totalamount"]').val(formattedTotal);
                        }



                        calculateTotal($('input[name="product_price[]"]'), $('input[name="product_qty[]"]'), $('input[name="product_total[]"]'));
                        formatCurrency($('input[name="product_price[]"]'));
                        calculateTotalAmount();

                        $(document).on('input', 'input[name="product_price[]"], input[name="product_qty[]"]', function() {
                            var priceInput = $(this).closest('.main-form').find('input[name="product_price[]"]');
                            var quantityInput = $(this).closest('.main-form').find('input[name="product_qty[]"]');
                            var totalInput = $(this).closest('.main-form').find('input[name="product_total[]"]');

                            calculateTotal(priceInput, quantityInput, totalInput);
                            formatCurrency(priceInput);
                            calculateTotalAmount();
                        });

                        $(document).on('click', '.remove-btn', function() {
                            $(this).closest('.main-form').remove();
                            calculateTotalAmount();
                        });

                        function getItemOptions() {
                            return <?php echo json_encode(fill_item_select_box($con)); ?>;
                        }

                        function getUomOptions() {
                            return <?php echo json_encode(fill_uom_select_box($con)); ?>;
                        }

                        $(document).on('click', '.add-more-form', function() {
                            var newForm = '<div class="row main-form">\
                <div class="col-md-3 mb-3">\
                    <label for="itemname[]"><span class="required">*</span>Item Name</label>\
                    <select id="itemname" name="itemname[]" class="form-select form-select-sm" required>\
                        <option value="">Item Name</option>' + getItemOptions() + '\
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
                        <option value="">UOM</option>' + getUomOptions() + '\
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