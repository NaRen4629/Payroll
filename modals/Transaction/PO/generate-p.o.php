<?php
if (!function_exists('get_request_items')) {
    // Function to retrieve request items
    function get_request_items($request_id)
    {
        global $db;
        $query = "SELECT
                    Item,
                    Unit_Price,
                    Uom,
                    Quantity,  -- Assuming Quantity is the field representing the requested quantity
                    Total       -- Assuming Total is the field representing the total amount
                FROM tbl_request_item
                WHERE request_id = :request_id";
        $statement = $db->prepare($query);
        $statement->bindParam(':request_id', $request_id);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}


if (!function_exists('get_approve_details')) {
    // Function to retrieve approval details
    function get_approve_details($request_id)
    {
        global $db;
        $query = "SELECT 
                    quantityapprove,
                    quantity_approve_total,
                    quantity_approve_totalAmount,
                    dateapprove
                FROM tbl_approve 
                WHERE request_id = :request_id";
        $statement = $db->prepare($query);
        $statement->bindParam(':request_id', $request_id);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
?>

<!-- Modal for viewing request items -->
<div class="modal fade" id="generatePO_<?php echo $Request['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Generate purchase order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                //req num auto generated
                $database = new Connection();
                $con = $database->open();

                $query = "SELECT MAX(CAST(SUBSTRING_INDEX(po_id, '-', -1) AS UNSIGNED)) AS max_id FROM tbl_po";
                $result = $con->query($query);
                $row = $result->fetch();

                if ($row) {
                    $max_id = $row['max_id'];
                    $incremented_id = ($max_id === null) ? 1 : $max_id + 1;
                    $po = "PO" . date("mdY") . "-" . sprintf('%02d', $incremented_id);
                } else {
                    $po = ""; // Default value if there is an error
                }

                $approveDetails = get_approve_details($Request['request_id']);
                ?>

                <div class="container-fluid">

                    <form method="POST" action="">
                        <div class="row">
                            <div class=" text-center">
                                <h3 class="font-weight-bold text-dark">STI-College Ormoc, INC</h3>
                                <h6 class=" text-dark pb-3">Centrum Building, Aviles Street, Ormoc City</h6>
                                <h2 class="font-weight-bold text-dark pb-4">AUTHORITHY TO PURCHASE</h2>
                            </div>
                            <!-- Left Column -->
                            <div class="col-md-6">

                                <!-- PO No -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">PO No:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $po ?>" readonly>
                                    </div>
                                </div>
                                <!-- Request No -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Request No:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['Request_No']; ?>" readonly>
                                    </div>
                                </div>

                                <!-- Requested By -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Requested By:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['requestedby_name']; ?>" readonly>

                                    </div>
                                </div>

                                <!-- Supplier -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Supplier:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['supplier_businessname']; ?>" readonly>

                                    </div>
                                </div>


                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">

                                <!-- Date Request -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Date request:</div>
                                    <div class="col-md-8">
                                        <?php
                                        $date_request = date("Y-m-d");
                                        ?>
                                        <input type="text" class="form-control form-control-sm" id="dateRequest" name="dateRequest[]" value="<?php echo $date_request; ?>" readonly>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Status:</div>
                                    <div class="col-md-8">
                                        <label for=""><?php echo isset($Request['req_status']) ? '<option selected>' . $Request['req_status'] . '</option>' : '<option selected>Pending</option>'; ?></label>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Unit Price</th>
                                    <th>Approve Quantity</th>
                                    <th>UOM</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $requestItems = get_request_items($Request['request_id']);
                                $approve = get_approve_details($Request['request_id']);

                                foreach ($requestItems as $item) {
                                ?>
                                    <tr>
                                        <td><?php echo $item['Item']; ?></td>
                                        <td>₱<?php echo number_format($item['Unit_Price'], 2); ?></td>
                                        <td><?php echo isset($approve['quantityapprove']) ? $approve['quantityapprove'] : ''; ?></td>
                                        <td><?php echo $Request['uomname']; ?></td>
                                        <td>
                                            <?php
                                            if (isset($approve['quantityapprove'])) {
                                                echo '₱' . number_format($item['Unit_Price'] * $approve['quantityapprove'], 2);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="text-end">Total Amount:</td>
                                    <td>
                                        <?php
                                        $totalAmount = array_sum(array_column($requestItems, 'Unit_Price', 'quantityapprove'));
                                        echo '₱' . number_format($totalAmount, 2);
                                        ?>
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                    </form>

                </div>
            </div>


        </div>
    </div>
</div>