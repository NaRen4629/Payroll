<!-- Edit brand-->
<div class="modal fade" id="edit_<?php echo $brand['brand_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel"> Edit Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form method="POST" action="crud-operation.php?id=<?php echo $brand['brand_id']; ?>">
                    <input type="hidden" class="form-control form-control-sm" name="brandId" value="<?php echo $brand['brand_id']; ?>">
                    <div class="row">
                        <div class="col-sm-4"><span class="required">*</span>Brand Name:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form-control-sm" name="brandName" value="<?php echo $brand['brand_name']; ?>" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Status:</div>
                        <div class="col-sm-7 pb-3 pt-3">
                            <select id="brandStatus" name="brandStatus" class="form-select form-select-sm" required>
                                <option selected><?php echo $brand['brand_status']; ?></option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="editBrand">Update</button>

                    </div>
                </form>

            </div>


        </div>
    </div>
</div>