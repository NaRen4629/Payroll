<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $uom['uom_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel"> Edit UOM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form method="POST" action="crud-operation.php?id=<?php echo $uom['uom_id']; ?>">
                <input type="hidden" class="form-control form-control-sm" name="uom_id" value="<?php echo $uom['uom_id']; ?>">
                    <div class="row">
                        <div class="col-sm-4"><span class="required">*</span>UOM Name:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form-control-sm" name="uomname" value="<?php echo $uom['uomname']; ?>">
                        </div>
                        </div>
                    <div class="row">
                        <div class="col-sm-4 pt-2">UOM Description</div>
                        <div class="col-sm-7 pb-3 pt-2">
                            <textarea type="text" class="form-control form-control-sm" name="UOMdescription" value=""><?php echo $uom['UOMdescription']; ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="editUOM">Update</button>

                    </div>
                </form>

            </div>


        </div>
    </div>
</div>