<!-- sir roel view req item  -->
<!-- Modal for viewing request items -->
<div class="modal fade" id="viewreqitem_<?php echo $Request['Request_No']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                                <!-- Date Request -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Date request:</div>
                                    <div class="col-md-8">
                                        <?php
                                        // $date_request = date("m/d/Y");
                                        ?>
                                        <input type="text" class="form-control form-control-sm" id="dateRequest" name="dateRequest[]" value="<?php echo $Request['DateRequest']; ?>" readonly>
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
                        <?php
                        // Fetch items for the specific request
                        $requestItems = [];
                        $queryItems = "SELECT * FROM `request_with_items_itemtotal_totalamount` WHERE `Request_No` = :requestNo";
                        $stmtItems = $db->prepare($queryItems);
                        $stmtItems->bindParam(':requestNo', $Request['Request_No']);
                        $stmtItems->execute();

                        while ($item = $stmtItems->fetch(PDO::FETCH_ASSOC)) {
                            $requestItems[] = $item;
                        }
                        ?>
                        <table id="dataTable" class="table table-striped table table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>UOM</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($requestItems as $item) {
                                ?>
                                    <tr>
                                        <!-- Display item details -->
                                        <td><?php echo $item['item_name']; ?></td>
                                        <td class="text-right">₱<?php echo number_format($item['Unit_Price'], 2); ?></td>
                                        <td class=""><?php echo $item['QuantityRequested']; ?></td>
                                        <td><?php echo $item['uomname']; ?></td>
                                        <td><?php echo $item['ItemStatus']; ?></td>
                                        <td class="text-right">₱<?php echo number_format($item['ItemTotalAmount'], 2); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="5" class="text-right">Total Amount:</td>
                                    <td class="text-right">₱<?php echo number_format($requestItems[0]['OverallTotalAmount'], 2); ?></td>
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