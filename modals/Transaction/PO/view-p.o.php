<?php
if (!function_exists('get_request_itemsView')) {
    // Function to retrieve request items
    function get_request_itemsView($request_id)
    {
        global $db;
        $query = "
        SELECT 
    a.request_id AS approve_request_id,
    a.quantityapprove,
    a.quantity_approve_total,
    a.quantity_approve_totalAmount,
    a.dateapprove,
    r.*,
    uom.*
FROM
    tbl_approve a
JOIN
    tbl_request_item r ON a.request_id = r.request_id
                      AND a.id = r.id
JOIN
    tb_uom uom ON r.Uom = uom.uom_id
WHERE
    r.request_id = :request_id
ORDER BY r.id ASC
";

        $statement = $db->prepare($query);
        $statement->bindParam(':request_id', $request_id);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
?>
<!-- sir roel view req item  -->
<!-- Modal for viewing request items -->
<div class="modal fade" id="viewPo_<?php echo $Request['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">View req item</h5>
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
                                    <th>Quantity Approve</th>
                                    <th>UOM</th>
                                    <th>Approve Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $requestItems = get_request_itemsView($Request['request_id']);
                                foreach ($requestItems as $item) {
                                ?> <tr>
                                        <td><?php echo $item['Item']; ?></td>
                                        <td class="">₱<?php echo number_format($item['Unit_Price'], 2); ?></td>
                                        <td class="float-end"><?php echo $item['quantityapprove']; ?></td>
                                        <td><?php echo $item['uomname']; ?></td>
                                        <td class="float-end">₱<?php echo number_format($item['quantity_approve_total'], 2); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="text-end">Total Amount:</td>
                                    <td>₱<?php echo number_format($requestItems[0]['quantity_approve_totalAmount'], 2); ?></td>
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