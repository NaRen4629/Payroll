<!-- Add Subcategory Modal -->
<div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
                    $database = new Connection();
                    $db = $database->open();

                    if ($db) {
                        $category_query = "SELECT cat_name FROM tbl_category ORDER BY cat_name ASC";

                        $category_result = $db->query($category_query);

                        if ($category_result) {
                            $catName = array();

                            while ($row = $category_result->fetch(PDO::FETCH_ASSOC)) {
                                $catName[] = $row['cat_name'];
                            }
                            $category_result = null;
                        } else {
                            echo "Error in executing the query: " . $db->errorInfo()[2];
                        }

                        $database->close();
                    } else {
                        echo "Error in connecting to the database.";
                    }
                    ?>
            <div class="modal-body">
                <form method="POST" action="crud-operation.php">
                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Category Name:</div>
                        <div class="col-sm-7 pb-3 pt-3">
                            <select id="categoryName" name="categoryName" class="form-select form-select-sm" required>
                                <?php
                                // Output the options for category dropdown
                                foreach ($catName as $cat) {
                                    echo "<option value='$cat'>$cat</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Sub Category:</div>
                        <div class="col-sm-7 pb-3 pt-3">
                            <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="subcategoryName" value="" required>

                            </div>
                
                        </div>
                    </div>

                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6 class="text-dark"><span class="required">* </span>Indicates required fields</h6>
                        </legend>

                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="addSubCategory">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
