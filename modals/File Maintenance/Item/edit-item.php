<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Edit Item Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form method="POST" action="crud-operation.php?id=<?php echo $item['id']; ?>">
                <input type="hidden" class="form-control form-control-sm" name="id" value="<?php echo $item['id']; ?>">
                    <div class="row">
                        <div class="col-sm-4"><span class="required">*</span>Item Name: </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form-control-sm" name="item_name" value="<?php echo $item['item_name']; ?>">
                        </div>
                    </div>
               
                    <div class="row">
                        <div class="col-sm-4 pt-2"><span class="required">*</span>Model:</div>
                        <div class="col-sm-7 pt-2">
                            <input type="text" class="form-control form-control-sm" name="model" value="<?php echo $item['model']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 pt-2">Item Description:</div>
                        <div class="col-sm-7 pt-2">
                            <input type="text" class="form-control form-control-sm" name="item_description" value="<?php echo $item['item_description']; ?>">
                        </div>
                    </div>
          
                    
                    <div class="row">
                        <div class="col-sm-4 pt-2"><span class="required">*</span>Status:</div>
                        <div class="col-sm-7 pb-3 pt-2">
                            <select id="status" name="status" class="form-select form-select-sm">
                              
                            <option value="Active" <?php echo ($item['item_status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                <option value="Inactive" <?php echo ($item['item_status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="edititem">Update</button>

                    </div>
                </form>

            </div>


        </div>
    </div>
</div>