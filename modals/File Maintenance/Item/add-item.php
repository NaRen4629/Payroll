<!-- add category -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_capstone";
$conn = mysqli_connect($servername, $username, $password, $dbname);
?>

<?php
$database = new Connection();
$con = $database->open();

$query2 = "SELECT MAX(CAST(SUBSTRING(item_id, 5) AS UNSIGNED)) AS max_id FROM tbl_items";
$result2 = mysqli_query($conn, $query2);
$row = mysqli_fetch_assoc($result2);
$max_id = $row['max_id'];

if ($max_id === null) {
    $item_id = "ITEM01";
} else {
    $item_id = "ITEM" . sprintf('%02d', $max_id + 1);
}


?>


<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="crud-operation.php" class="needs-validation" novalidate>
                    <input type="hidden" class="form-control form-control-sm" name="suppid" value="">

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark">Item ID:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="itemid" value="<?php echo $item_id ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Item Name:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="itemname" value="" required>
                            <div class="invalid-feedback">
                                Please enter item name.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Category Name:</div>
                        <div class="col-sm-7 pt-3">
                            <select class="form-select form-select-sm" name="select" id="selectID" required>
                                <option selected disabled value="">Choose...</option>
                                <?php include('config/conn.php'); ?>
                                <?php $sql = "SELECT * FROM tbl_category";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_name'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select category name.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Sub Category:</div>
                        <div class="col-sm-7 pt-3">
                            <select class="form-select form-select-sm" id="show" name="catsubname" required>
                                <option selected disabled value="">Choose...</option>

                            </select>
                            <div class="invalid-feedback">
                                Please select subcategory name.
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#selectID').change(function() {
                                var Stdid = $('#selectID').val();

                                $.ajax({
                                    type: 'POST',
                                    url: 'fetch.php',
                                    data: {
                                        id: Stdid
                                    },
                                    success: function(data) {
                                        $('#show').html(data);
                                    }
                                });
                            });
                        });
                    </script>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Brand:</div>
                        <div class="col-sm-7 pt-3">
                            <select id="brand" name="brand" class="form-select form-select-sm" required>
                                <option selected disabled value="">Choose...</option>

                                <?php include('config/conn.php'); ?>
                                <?php $sql = "SELECT * FROM tbl_brand";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?php echo $row['brand_id'] ?>"><?php echo $row['brand_name'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select brand name.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Model:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="model" value="" required>
                            <div class="invalid-feedback">
                                Please enter model name.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark">Description:</div>
                        <div class="col-sm-7 pt-3">
                            <textarea type="text" class="form-control form-control-sm" name="description" value=""></textarea>
                            <div class="valid-feedback">
                                Optional.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Status:</div>
                        <div class="col-sm-7 pb-3 pt-3">
                            <select id="itemStatus" name="itemStatus" class="form-select form-select-sm">
                                <option selected>Active</option>
                                <option>Inactive</option>
                            </select>
                            <div class="valid-feedback">
                                Default value is active.
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6 class="text-dark">NOTE: <span class="required"> * </span>Indicates required fields.</h6>
                        </legend>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="addItems">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>