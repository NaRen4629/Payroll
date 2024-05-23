<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $subcat['sub_cat_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Edit Supplier Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form method="POST" action="crud-operation.php?id=<?php echo $subcat['sub_cat_id']; ?>">
                <input type="hidden" class="form-control form-control-sm" name="sub_cat_id" value="<?php echo $subcat['sub_cat_id']; ?>">
                    <div class="row">
                        <div class="col-sm-4"><span class="required">*</span>Subname:</div>
                        <div class="col-sm-7 pb-3">
                            <input type="text" class="form-control form-control-sm" name="subname" value="<?php echo $subcat['sub_name']; ?>">
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="editsubname">Update</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>