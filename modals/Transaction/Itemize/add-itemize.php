
<div class="modal fade" id="addItemize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="crud-operation.php">
                <?php
                    $database = new Connection();
                    $db = $database->open();

                    if ($db) {
                        $category_query = "SELECT cat_name FROM tbl_category ORDER BY cat_name ASC";
                        $subcategory_query = "SELECT sub_name FROM tbl_subcategory ORDER BY sub_name ASC";

                        $category_result = $db->query($category_query);
                        $subcategory_result = $db->query($subcategory_query); // Fetch subcategory data

                        if ($category_result && $subcategory_result) {
                            $catName = array();
                            $subName = array(); // Create an array for subcategory names

                            while ($row = $category_result->fetch(PDO::FETCH_ASSOC)) {
                                $catName[] = $row['cat_name'];
                            }

                            while ($row = $subcategory_result->fetch(PDO::FETCH_ASSOC)) {
                                $subName[] = $row['sub_name']; // Fetch and store subcategory names
                            }

                            $category_result = null;
                            $subcategory_result = null; // Close the result sets
                        } else {
                            echo "Error in executing the query: " . $db->errorInfo()[2];
                        }

                        $database->close();
                    } else {
                        echo "Error in connecting to the database.";
                    }
                    ?>

                        <div class="row">
                            <div class="col-md-4 text-dark">Date request:</div>
                            <div class="col-md-8">
                                <?php
                                $date_request = date("m-d-y");
                                ?>
                                <input type="text" class="form-control form-control-sm" id="date_Itemize" name="date_Itemize" value="<?php echo $date_request; ?>" readonly>

                            </div>
                        </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Recieving No:</div>
                        <div class="col-sm-7 pt-3">
                        <select id="Receving_No" name="Receving_No" class="form-select form-select-sm">
                                <option selected>Recieving 1</option>
                                <option>Recieving 2</option>
                            </select>
                        </div>
                    </div>

                     
                       

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Serial No:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="Serial_No"  id = "Serial_No" value="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark">Item Description:</div>
                        <div class="col-sm-7 pt-3">
                            <textarea type="text" class="form-control form-control-sm" name="item_description" value=""></textarea>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Category Name:</div>
                        <div class="col-sm-7 pb-3 pt-3">
                            <select id="cat_name" name="cat_name" class="form-select form-select-sm" required>
                                <?php
                                // Output the options in the select dropdown
                                foreach ($catName as $cat) {
                                    echo "<option value='$cat'>$cat</option>";
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6 class="text-dark"><span class="required">* </span>Indicates required fields</h6>
                        </legend>

                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="addItemize">Add</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>