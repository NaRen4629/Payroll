<?php
if (!function_exists('get_request_itemsReceive')) {
    // Function to retrieve request items
    function get_request_itemsReceive($request_id)
    {
        global $db;
        $query = "SELECT 
    a.request_id AS approve_request_id,
    a.quantityapprove,
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
JOIN tbl_po tp ON a.request_id = tp.request_id

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
<!-- receive -->

<div class="modal fade" id="receive_<?php echo $Request['po_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Itemize</h5>
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

                        <div class="col-md-2 text-dark">Date:</div>
                        <div class="col-md-4 mb-3">
                            <?php
                            $date_request = date("m-d-Y");
                            ?>
                            <input type="text" class="form-control form-control-sm" id="Order_Receive_Date" name="Order_Receive_Date" value="<?php echo $date_request; ?>" readonly>
                        </div>


                        <div class="col-md-2 text-dark">Received From</div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control form-control-sm" value="<?php echo $Request['supplier_businessname']; ?>" name="businessname" id="businessname" readonly>

                        </div>

                        <div class="col-md-2 text-dark">Address:</div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control form-control-sm" value="<?php echo $Request['businessaddress']; ?>" name="businessaddress" id="businessAddress" readonly>
                        </div>

                        <div class="col-md-2 text-dark"><span class="required">*</span>Date Receive:</div>
                        <div class="col-md-4 mb-3">
                            <input type="date" class="form-control form-control-sm" name="Received_Date" id="Received_Date" required>
                            <div class="invalid-feedback">
                                Please enter date receive.
                            </div>
                        </div>


                        <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Receive Quantity</th>
                                    <th>Serial Number</th>
                                </tr>
                            </thead>
                            <tbody class="request-tbody">
                                <?php
                                $requestItems = get_request_itemsReceive($Request['request_id']);
                                foreach ($requestItems as $item) {
                                ?>
                                    <tr>
                                        <td><?php echo $item['Item']; ?></td>
                                        <td class=""><?php echo $item['quantityapprove']; ?></td>
                                        <td>
                                            <?php for ($i = 1; $i <= $item['quantityapprove']; $i++) { ?>
                                                <input type="text" name="serialNum[<?php echo $item['Item']; ?>][]" class="form-control form-control-sm" placeholder="Serial Number <?php echo $i; ?>" required>
                                           <div class="invalid-feedback">Please enter serial number.</div>
                                           
                                                <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>



                        <div class="col-md-2 text-dark">Second Count:</div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control form-control-sm" name="Second_Count" id="Second_Count">
                        </div>

                        <div class="col-md-2 text-dark">Received By:</div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control form-control-sm" name="Received_By" id="Received_By">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="itemize" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>