<!-- Modal for viewing request items -->
<div class="modal fade" id="approvereqitem_<?php echo $Request['Request_Id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Approve</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="crud-operation.php">
                        <input type="hidden" name="Request_Id" value="<?php echo $Request['Request_Id']; ?>">

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
                                    <div class="col-md-4 text-dark">Date requested:</div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $Request['DateRequest']; ?>" readonly>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-3">
                                    <div class="col-md-4 text-dark">Status:</div>
                                    <div class="col-md-8">
                                        <label for=""><?php echo isset($Request['Status']) ? '<option selected>' . $Request['Status'] . '</option>' : '<option selected></option>'; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        // Fetch items for the specific request
                        $requestItems = [];
                        $queryItems = "SELECT
                        tbl_request.*,
                        tbl_request_item.*,
                        tbl_items.item_name,
                        tb_uom.*,
                        (tbl_request_item.Unit_Price *  tbl_request_item.QuantityRequested) AS ItemTotalAmount, -- Individual item total amount
                        SUM(tbl_request_item.Unit_Price *  tbl_request_item.QuantityRequested) OVER (PARTITION BY tbl_request_item.Request_Id) AS OverallApproveTotalAmount -- Overall total amount for the request
                    FROM
                        tbl_request
                    INNER JOIN tbl_request_item ON tbl_request.Request_Id = tbl_request_item.Request_Id
                    INNER JOIN tbl_items ON tbl_items.id = tbl_request_item.Item_Id
                    INNER join tb_uom on tb_uom.uom_id = tbl_request_item.Uom where tbl_request_item.Request_Id= :requestNo";
                    
                        $stmtItems = $db->prepare($queryItems);
                        $stmtItems->bindParam(':requestNo', $Request['Request_Id']);
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
                                    <th>Qty Request</th>
                                    <th>UOM</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Qty Approve</th>
                                    <th>Qty Approve Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="request-tbody">
                                <?php foreach ($requestItems as $item) { ?>
                                    <input type="hidden" name="item_ids[]" value="<?php echo $item['Item_Id']; ?>">

                                    <tr>
                                        <td><?php echo $item['item_name']; ?></td>
                                        <td class="text-right">₱<?php echo number_format($item['Unit_Price'], 2); ?></td>
                                        <td class=""><?php echo $item['QuantityRequested']; ?></td>
                                        <td><?php echo $item['Uom']; ?></td>
                                        <td><?php echo $item['Status']; ?></td>
                                        <td class="">₱<?php echo number_format($item['ItemTotalAmount'], 2); ?></td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="number" name="quantity_approve[<?php echo $item['Item_Id']; ?>]" class="form-control form-control-sm" placeholder="Quantity" required onchange="calculateApproveTotal(this)">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="text" name="quantity_approve_total[]" class="form-control form-control-sm" placeholder="Total" readonly>
                                            </div>
                                        </td>
                                        <td>
                                            <select name="statitem[<?php echo $item['Item_Id']; ?>]" class="form-select form-select-sm">
                                                <option value="Approve" selected>Approve</option>
                                                <option value="Disapproved">Disapproved</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td id="total_request_amount" colspan="6" class="text-end">Total Amount: ₱<?php echo number_format($requestItems[0]['OverallApproveTotalAmount'], 2); ?></td>
                                    <td colspan="2  " name="total_approve_amount" class="total-approve-amount">Total Amount: ₱ 0.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="approve_req" class="btn btn-primary">Approve</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                function calculateApproveTotal(input) {
                    var quantityApproved = parseInt(input.value) || 0;
                    var unitPrice = parseFloat(input.closest('tr').querySelector('td:nth-child(2)').innerText.replace(/[^\d.]/g, '')) || 0;

                    var totalApprove = unitPrice * quantityApproved;


                    // If total is negative, set the input value to 0
                    if (totalApprove < 0) {
                        input.value = 0;
                        totalApprove = 0; // Set total to 0 to prevent negative values
                    }

                    // Update the total approve field in the same row
                    input.closest('tr').querySelector('input[name="quantity_approve_total[]"]').value = '₱' + totalApprove.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    // Recalculate the total approve amount for all rows in the same request
                    calculateTotalApproveAmount(input.closest('.request-tbody'));
                }

                function calculateTotalApproveAmount(tbody) {
                    var totalApproveAmount = 0;
                    tbody.querySelectorAll('input[name="quantity_approve_total[]"]').forEach(function(input) {
                        totalApproveAmount += parseFloat(input.value.replace(/[^\d.]/g, '')) || 0;
                    });

                    // Format total approve amount with comma for thousands
                    var formattedTotalApprove = 'Total Amount: ₱' + totalApproveAmount.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    // Update the total approve amount field for the corresponding request
                    tbody.parentElement.querySelector('.total-approve-amount').innerText = formattedTotalApprove;
                }
            </script>
        </div>
    </div>
</div>