<?php
if (!function_exists('get_request_items')) {
    // Function to retrieve request items
    function get_request_items($request_id)
    {
        global $db;
        $sql = 'SELECT * FROM `view-po-items` WHERE Request_Id = :request_id';

        $statement = $db->prepare($sql);
        $statement->bindParam(':request_id', $request_id);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
?>

<!-- Modal for viewing request items -->
<div class="modal fade" id="generatePO_<?php echo $Request['Request_Id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Generate Purchased Order</h5>
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
                    $po = "PO-" . date("mdY") . "-" . sprintf('%02d', $incremented_id);
                } else {
                    $po = ""; // Default value if there is an error
                }
                ?>
                <div class="container-fluid">
                    <form method="POST" action="crud-operation.php">
                        <input type="hidden" name="request_id" value="<?php echo $Request['Request_Id']; ?>">
                        <div class="row">

                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- PO No -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">PO No:</div>
                                    <div class="col-md-8">
                                        <input type="text" name="po" class="form-control form-control-sm" value="<?php echo $po ?>" readonly>
                                    </div>
                                </div>

                                <!-- Supplier -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Supplier:</div>
                                    <div class="col-md-8">
                                        <input type="text" name="supplierPo" class="form-control form-control-sm" value="<?php echo $Request['businessname']; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Requested By -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Requested By:</div>
                                    <div class="col-md-8">
                                        <input type="text" name="requestedBy" class="form-control form-control-sm" value="<?php echo $Request['First_Name'] . ' ' . $Request['Last_Name']; ?>" readonly>
                                    </div>
                                </div>
                                <!-- Request No -->
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <input type="hidden" name="reqNoPO" class="form-control form-control-sm" value="<?php echo $Request['Request_No']; ?>" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity Approve</th>
                                    <th>UOM</th>
                                    <th>Approve Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $requestItems = get_request_items($Request['Request_Id']);

                                foreach ($requestItems as $item) {
                                ?>
                                    <input type="hidden" name="item_ids[]" value="<?php echo $item['id']; ?>">
                                    <tr>
                                        <td><?php echo $item['item_name']; ?></td>
                                        <td class="">₱<?php echo number_format($item['Unit_Price'], 2); ?></td>
                                        <td class="float-end"><?php echo $item['QuantityApproved']; ?></td>
                                        <td><?php echo $item['uomname']; ?></td>
                                        <td class="float-end">₱<?php echo number_format($item['ItemTotalAmount'], 2); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="text-end">Total Amount:</td>
                                    <td>₱<?php echo number_format($requestItems[0]['OverallApproveTotalAmount'], 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="addPo" class="btn btn-sm btn-primary">Generate Purchase Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>