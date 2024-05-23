<div class="modal fade" id="receive_<?php echo $Request['po_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Receive</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
            </div>

            <div class="modal-body">

                <form method="POST" action="crud-operation.php" id="insert_form" class="needs-validation" novalidate>
                    <input type="hidden" name="request_id" value="<?php echo $Request['request_id']; ?>">
                    <input type="hidden" name="po_id" value="<?php echo $Request['po_id']; ?>">

                    <div class="row">

                        <div class="col-md-2 text-dark">P.O:</div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control form-control-sm" value="<?php echo $Request['PoNo']; ?>" readonly>

                        </div>

                        <div class="col-md-2 text-dark">Received From</div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control form-control-sm" value="<?php echo $Request['supplier_businessname']; ?>" name="businessname" id="businessname" readonly>

                        </div>

                        <div class="col-md-2 text-dark"><span class="required">*</span>Reference Inv./D.R No:</div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control form-control-sm" name="Reference_Invoice_No" id="Reference_Invoice_No" required>
                            <div class="invalid-feedback">
                                Please enter reference invoice or depositary receipt.
                            </div>
                        </div>

                        <div class="col-md-2 text-dark">Address:</div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control form-control-sm" value="<?php echo $Request['businessaddress']; ?>" name="businessaddress" id="businessAddress" readonly>
                        </div>
                        <!-- 
                        <div class="col-md-2 text-dark"><span class="required">*</span>Date Receive:</div>
                        <div class="col-md-4 mb-3">
                            <input type="date" class="form-control form-control-sm" name="Received_Date" id="Received_Date" required>
                            <div class="invalid-feedback">
                                Please enter date receive.
                            </div>
                        </div> -->

                        <?php
                        // Fetch items for the specific request
                        $requestItems = [];
                        $queryItems = "SELECT
                        tbl_request.*,
                        tbl_request_item.*,
                        tbl_items.item_name,
                        tb_uom.*,
                        (tbl_request_item.Unit_Price *  tbl_request_item.QuantityRequested) AS ItemTotalAmount,
                        SUM(tbl_request_item.Unit_Price *  tbl_request_item.QuantityRequested) OVER (PARTITION BY tbl_request_item.Request_Id) AS OverallApproveTotalAmount
                    FROM
                        tbl_request
                    INNER JOIN tbl_request_item ON tbl_request.Request_Id = tbl_request_item.Request_Id AND tbl_request_item.Status = 'Approve'
                    INNER JOIN tbl_items ON tbl_items.id = tbl_request_item.Item_Id
                    INNER join tb_uom on tb_uom.uom_id = tbl_request_item.Uom where tbl_request_item.Request_Id= :requestNo";
                    
                        $stmtItems = $db->prepare($queryItems);
                        $stmtItems->bindParam(':requestNo', $Request['Request_Id']);
                        $stmtItems->execute();

                        while ($item = $stmtItems->fetch(PDO::FETCH_ASSOC)) {
                            $requestItems[] = $item;
                        }
                        ?>
                        <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Unit Price</th>
                                    <th>Approve Quantity P.O</th>
                                    <th>UOM</th>
                                    <th>Total</th>
                                    <th>Receive Quantity</th>
                                    <th>Difference </th>
                                    <th>Action </th>

                                    <!-- <th>Receive Quantity Total</th> -->
                                </tr>
                            </thead>
                            <tbody class="request-tbody">
                                <?php

                                foreach ($requestItems as $item) {
                                    
                                ?>
                                    <input type="hidden" name="item_ids[]" value="<?php echo $item['id']; ?>"> 
                         
                                    <tr>
                                        <td><?php echo $item['item_name']; ?></td>
                                        <td class="">₱<?php echo number_format($item['Unit_Price'], 2); ?></td>
                                        <td class="float-end"><?php echo $item['QuantityApproved']; ?></td>
                                        <td><?php echo $item['uomname']; ?></td>
                                        <td class="float-end">₱<?php echo number_format($item['ItemTotalAmount'], 2); ?></td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="number" name="receive_quantity[<?php echo $item['id']; ?>]" class="form-control form-control-sm" placeholder="Quantity" required onchange="calculateReceiveTotal(this)">
                                                <div class="invalid-feedback">
                                                    Please enter receive quantity.
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="col-sm-10">
                                                <input type="number" name="difference[<?php echo $item['id']; ?>]" class="form-control form-control-sm" placeholder="Quantity" readonly>
                                                <div class="invalid-feedback">
                                                    Please enter receive quantity.
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <select name="statitem[<?php echo $item['Item_Id']; ?>]" class="form-select form-select-sm">
                                                <option value="Wrong Item" >Wrong Item</option>
                                                <option value="Damaged Item" >Damaged Item</option>
                                                <option value="Lacking" >Lacking</option>
                                            </select>
                                       
                                        </td>
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

                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="addReceiving" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
        <script>
            function calculateReceiveTotal(input) {
                var itemId = input.name.match(/\d+/)[0];
                var row = input.closest('tr');

                // Get quantityApproved value
                var quantityApprovedCell = row.querySelector('.float-end');
                var quantityApproved = parseFloat(quantityApprovedCell.textContent) || 0;

                // Get receiveQuantity value
                var receiveQuantity = parseFloat(input.value) || 0;

                var difference = quantityApproved - receiveQuantity;

                // Update the corresponding difference input field
                var differenceInput = row.querySelector('input[name="difference[' + itemId + ']"]');
                if (differenceInput) {
                    differenceInput.value = difference;
                }
            }
        </script>
    </div>
</div>