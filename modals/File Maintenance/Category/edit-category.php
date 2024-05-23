<!-- Edit category -->
<div class="modal fade" id="edit_<?php echo $cat['cat_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                <form method="POST" action="crud-operation.php">

                    <input type="hidden" class="form-control form-control-sm" name="categoryId" value="<?php echo $cat['cat_id']; ?>">

                    <div class="row">
                        <div class="col-sm-4 pt-3">Category Name:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="categoryName" value="<?php echo $cat['cat_name']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Classification:</div>
                        <div class="col-sm-7 pt-3">
                            <select id="classification" name="classification" class="form-select form-select-sm" required>
                                <?php
                                foreach ($classification as $cls) {
                                    $selected = ($cat['classification'] == $cls['classification']) ? 'selected' : '';
                                    echo "<option value='" . $cls['classi_id'] . "' $selected>" . $cls['classification'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark">Description:</div>
                        <div class="col-sm-7 pt-3">
                            <textarea type="text" class="form-control form-control-sm" id="catdescription" name="catdescription"><?php echo $cat['cat_description']; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3">Status:</div>
                        <div class="col-sm-7 pb-3 pt-3">
                            <select id="categoryStatus" name="categoryStatus" class="form-select form-select-sm">
                                <option value="Active" <?php echo ($cat['cat_status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                <option value="Inactive" <?php echo ($cat['cat_status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="editCategory">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
