<?php
if (!function_exists('get_request_itemsView')) {
    // Function to retrieve request items
    function get_request_itemsView($request_id)
    {
        global $db;
        $query = "SELECT
        tbl_po.PoNo AS PoNo,
        tbl_po.request_id AS Request_Id,
        tbl_receive_item.Reason AS Reason,
        tbl_request.Request_No AS Request_No,
        tbl_items.item_name AS item_name,
        tbl_receive_item.QuantityReceived AS QuantityReceived,
        tbl_receive_item.Difference AS Difference
    FROM
        tbl_po
   INNER JOIN tbl_backorder ON tbl_po.request_id = tbl_backorder.Request_Id
   INNER JOIN tbl_backorder_item ON tbl_backorder.id = tbl_backorder_item.id
   INNER JOIN tbl_receive_item ON tbl_backorder_item.receive_id = tbl_receive_item.id
   INNER JOIN tbl_request ON tbl_po.request_id = tbl_request.Request_Id
   INNER JOIN tbl_items ON tbl_receive_item.item = tbl_items.id
    WHERE
        tbl_receive_item.Difference > 0 AND tbl_request.Request_Id = :request_id";

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
<div class="modal fade" id="viewbackorder_<?php echo $Request['Request_Id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">View Back Order Items</h5>
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

                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Po No:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['PoNo']; ?>" readonly>
                                    </div>
                                </div>
<!-- 
                                Requested By
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Requested By:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['requestedby_name']; ?>" readonly>

                                    </div>
                                </div>

                                Supplier
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Supplier:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['supplier_businessname']; ?>" readonly>

                                    </div>
                                </div> -->


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
                                    <th>Quantity Receive</th>
                                    <th>Back Order</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $requestItems = get_request_itemsView($Request['Request_Id']);
                                foreach ($requestItems as $item) {
                                ?> <tr>
                                        <td><?php echo $item['item_name']; ?></td>
                                        <td class="float-end"><?php echo $item['QuantityReceived']; ?></td>
                                        <td><?php echo $item['Difference']; ?></td>
                                        <td><?php echo $item['Reason']; ?></td>

                                    </tr>
                                <?php
                                }
                                ?>
                            
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