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
<div class="modal fade" id="viewreqitem_<?php echo $Request['Request_Id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">View view req item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
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
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['RequestedByName']; ?>" readonly>

                                    </div>
                                </div>

                                <!-- Supplier -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Supplier:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['businessname']; ?>" readonly>
                                    </div>
                                </div>


                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Date Approve -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Date approve:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" id="dateapprove[]" name="dateapprove[]" value="" readonly>
                                    </div>
                                </div>

                                <!-- Date Request -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Date request:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['date_request']; ?>" readonly>
                                    </div>
                                </div>
                                <!-- Status -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Status:</div>
                                    <div class="col-md-8">
                                        <select id="reqstatus" name="reqstatus" class="form-select form-select-sm" readonly>
                                            <?php echo isset($Request['Status']) ? '<option selected>' . $Request['Status'] . '</option>' : '<option selected>Pending</option>'; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>UOM</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $requestItems = get_request_items($Request['Request_Id']);

                                foreach ($requestItems as $item) {
                                ?>
                                    <input type="hidden" name="item_ids[]" value="<?php echo $item['id']; ?>">
                                    <?PHP echo $item['id'] ?>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="" class="btn btn-primary">Save</button>
                        </div>

                    </form>

                </div>
            </div>


        </div>
    </div>
</div>