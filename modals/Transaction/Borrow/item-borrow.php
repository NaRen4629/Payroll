<!-- add req -->
<div class="modal fade" id="borrowModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Borrow Equipment</h5>
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


                function fill_item_select_box($con)
                {
                    $output = '';
                    $query = "SELECT i.item_id, c.cat_name, s.sub_name, br.brand_name
                              FROM tbl_items i
                              LEFT JOIN tbl_subcategory s ON i.subcategory_id = s.sub_cat_id
                              LEFT JOIN tbl_category c ON s.category_id = c.cat_id
                              LEFT JOIN tbl_brand br ON i.brand_id = br.brand_id

                              ORDER BY i.brand_id ASC";

                    $statement = $con->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();

                    foreach ($result as $row) {
                        $item_id = $row["brand_name"];
                        $cat_name = $row["cat_name"];
                        $sub_name = $row["sub_name"];

                        // Format the option value as desired (e.g., ITEM01-keyboard-wired-11032023)
                        $option_value = "$item_id-$cat_name-$sub_name";

                        $output .= '<option value="' . $option_value . '">' . $option_value . '</option>';
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
                        <input type="hidden" name="request_id" value="<?php echo $Request['request_id']; ?>">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Request No -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Request No:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" id="requestNumber" name="Request_No[]" value="<?php echo $request_id; ?>" readonly>
                                    </div>
                                </div>

                                <!-- Supplier -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark"><span class="required">*</span>When:</div>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control form-control-sm" id="requestDate" name="Request_Date" required>
                                        <div class="invalid-feedback">
                                            Please select a valid date.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Date Request -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Date Request:</div>
                                    <div class="col-md-8">
                                        <?php
                                        $date_request = date("m-d-y");
                                        ?>
                                        <input type="text" class="form-control form-control-sm" id="dateRequest" name="dateRequest[]" value="<?php echo $date_request; ?>" readonly>
                                    </div>
                                </div>

                                <!-- "To" Date -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark"><span class="required">*</span>To:</div>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control form-control-sm" id="toDate" name="To_Date" required>
                                        <div class="invalid-feedback">
                                            Please select a valid date.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- dynamic form -->
                        <div class="row main-form">
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-4 text-dark"><span class="required">*</span>Item Name:</div>
                                        <div class="col-md-8">
                                            <label for="itemname[]" class="form-label visually-hidden"><span class="required">*</span>Item Name</label>
                                            <select id="itemname" name="itemname[]" class="form-select form-select-sm" required>
                                                <option value="">Item Name</option>
                                                <?php echo fill_item_select_box($con); ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select item name.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-4 text-dark"><span class="required">*</span>Quantity:</div>
                                        <div class="col-md-8">
                                            <div class="">
                                                <label for="product_qty[]" class="form-label visually-hidden"><span class="required">*</span>Quantity</label>
                                                <div class="d-flex">
                                                    <input type="number" name="product_qty[]" class="form-control form-control-sm" required>
                                                    <button type="button" class="add-more-form btn btn-success btn-sm ms-2"><i class="fa-solid fa-plus"></i></button>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter quantity.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="paste-new-forms"></div>

                            <div class="col-md-5 mb-3">
                                <label for="purpose[]" class="form-label"><span class="required">*</span>Purpose:</label>
                                <div class="input-group">
                                    <textarea type="text" class="form-control form-control-sm" name="purpose[]" required></textarea>
                                    <div class="invalid-feedback">
                                        Please enter the purpose of the request.
                                    </div>
                                </div>
                            </div>

                            <!-- Requested By -->
                            <div class="col-md-5 mb-3">
                                <label for="requestedby[]" class="form-label"><span class="required">*</span>Requested By:</label>
                                <div class="input-group">
                                    <select id="requestedby" name="requestedby[]" class="form-select form-select-sm" required>
                                        <option value="">Select Employee</option>
                                        <?php echo fill_employee_select_box($con); ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select requested by.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <legend>
                                <h6 class="text-dark">NOTE: <span class="required">* </span>Indicates Required Fields</h6>
                            </legend>
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="savereq" class="btn btn-sm btn-primary float-end">Save</button>
                        </div>

                        <script>
                            $(document).ready(function() {
                                function getItemOptions() {
                                    return <?php echo json_encode(fill_item_select_box($con)); ?>;
                                }
                                $(document).on('click', '.remove-btn', function() {
                                    $(this).closest('.main-form').remove();
                                    calculateTotalAmount();
                                });
                                $(document).on('click', '.add-more-form', function() {
                                    var newForm = '      <div class="row main-form">\
                            <div class="row">\
                                <div class="col-md-6">\
                                    <div class="row mb-3">\
                                        <div class="col-md-4 text-dark"><span class="required">*</span>Item Name:</div>\
                                        <div class="col-md-8">\
                                            <label for="itemname[]" class="form-label visually-hidden"><span class="required">*</span>Item Name</label>\
                                            <select id="itemname" name="itemname[]" class="form-select form-select-sm" required>\
                                                <option value="">Item Name</option>\
                                                <?php echo fill_item_select_box($con); ?>\
                                            </select>\
                                            <div class="invalid-feedback">\
                                                Please select item name.\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="col-md-6">\
                                    <div class="row mb-3">\
                                        <div class="col-md-4 text-dark"><span class="required">*</span>Quantity:</div>\
                                        <div class="col-md-8">\
                                            <div class="">\
                                                <label for="product_qty[]" class="form-label visually-hidden"><span class="required">*</span>Quantity</label>\
                                                <div class="d-flex">\
                                                    <input type="number" name="product_qty[]" class="form-control form-control-sm" required>\
                                                    <button type="button" class="remove-btn btn btn-danger btn-sm ms-2"><i class="fa-solid fa-trash"></i></button>\
                                                </div>\
                                                <div class="invalid-feedback">\
                                                    Please enter quantity.\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
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
</div>