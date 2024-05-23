<?php
if (!function_exists('get_request_items')) {
    // Function to retrieve request items
    function get_request_items($request_id)
    {
        global $db;
        $query = "SELECT *, SUM(total) AS total_amount FROM tbl_request_item WHERE request_id = :request_id GROUP BY request_id";
        $statement = $db->prepare($query);
        $statement->bindParam(':request_id', $request_id);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}

?>

<!-- Modal for viewing request items -->
<div class="modal fade" id="approvereqitem_<?php echo $Request['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Approve req item dummy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="POST" action="crud-operation.php">
                    <input type="hidden" name="request_id" value="<?php echo $Request['request_id']; ?>">
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
                                    <input type="text" class="form-control form-control-sm" value="<?php echo $Request['date_request']; ?>" readonly>
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
                                <th>Qty request</th>
                                <th>UOM</th>
                                <th>Total</th>
                                <th>Qty approve</th>
                                <th>Qty approve total</th>
                            </tr>
                        </thead>
                        <tbody class="request-tbody">
                            <?php
                            $requestItems = get_request_items($Request['request_id']);
                            foreach ($requestItems as $index => $item) {
                            ?>
                                <tr>
                                    <td><?php echo $item['Item']; ?></td>
                                    <td><?php echo $item['Unit_Price']; ?></td>
                                    <td><?php echo $item['Quantity']; ?></td>
                                    <td><?php echo $Request['uomname']; ?></td>
                                    <td><?php echo $item['total']; ?></td>
                                    <td>
                                        <div class="col-sm-7">
                                            <input type="number" name="quantity_approve[]" class="form-control form-control-sm" placeholder="Qty" required onchange="calculateApproveTotal(this)">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-sm-10">
                                            <input type="text" name="quantity_approve_total[]" class="form-control form-control-sm" placeholder="Total" readonly>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="4" class="text-end">Total Amount:</td>
                                <td id="total_request_amount"><?php echo $requestItems[0]['total_amount']; ?></td>
                                <td colspan="1" class="text-end">Total Amount:</td>
                                <td name="total_approve_amount" class="total-approve-amount">0.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="approve_req" class="btn btn-primary">Approve</button>
                    </div>
                </form>

                <script>
                    function calculateApproveTotal(input) {
                        var quantityApproved = parseInt(input.value) || 0;
                        var unitPrice = parseFloat(input.closest('tr').querySelector('td:nth-child(2)').innerText.replace(/[^\d.]/g, '')) || 0;

                        var totalApprove = unitPrice * quantityApproved;

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
                        var formattedTotalApprove = '₱' + totalApproveAmount.toLocaleString('en-US', {
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