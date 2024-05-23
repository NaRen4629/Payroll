<!-- add category -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $database = new Connection();
            $db = $database->open();

            if ($db) {
                $classification_query = "SELECT classi_id, classification FROM tbl_classification ORDER BY classification ASC";

                $classification_result = $db->query($classification_query);

                if ($classification_result) {
                    $classification = array();

                    while ($row = $classification_result->fetch(PDO::FETCH_ASSOC)) {
                        $classification[] = $row;
                    }

                    $classification_result = null;
                } else {
                    echo "Error in executing the query: " . $db->errorInfo()[2];
                }

                $database->close();
            } else {
                echo "Error in connecting to the database.";
            }
            ?>
            <div class="modal-body">

                <form method="POST" action="crud-operation.php" class="needs-validation" novalidate>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Category Name:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="categoryName" value="" required>
                            <div class="invalid-feedback">
                                Please enter category name.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Classification:</div>
                        <div class="col-sm-7 pt-3">
                            <select id="classification" name="classification" class="form-select form-select-sm" required>
                                <option selected disabled value="">Choose...</option>
                                <?php
                                // Output the options for classification dropdown
                                foreach ($classification as $cls) {
                                    echo "<option value='" . $cls['classi_id'] . "'>" . $cls['classification'] . "</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select classification name.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark">Description:</div>
                        <div class="col-sm-7 pt-3">
                            <textarea type="text" class="form-control form-control-sm" id="catdescription" name="catdescription"></textarea>
                            <div class="valid-feedback">
                                Optional.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark">Status:</div>
                        <div class="col-sm-7 pb-3 pt-3">
                            <select id="categoryStatus" name="categoryStatus" class="form-select form-select-sm" required>
                                <option selected>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6 class="text-dark">NOTE: <span class="required"> * </span>Indicates Required Fields</h6>
                        </legend>

                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="addCategory">Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>