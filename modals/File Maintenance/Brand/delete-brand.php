<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $brand['brand_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                <h5 class="modal-title font-weight-bold text-primary" id="myModalLabel">Delete Brand</h5>

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
            </div>
            <div class="modal-body">    
                <p class="text-center">Are you sure you want to delete?</p>
                <h2 class="text-center"><?php echo $brand['brand_name'].' '.$brand['brand_status']; ?></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                <form method="POST" action="crud-operation.php">
                    <input type="hidden" name="brand_id" value="<?php echo $brand['brand_id']; ?>">
                    <button type="submit" name="deleteBrand" class="btn btn-sm btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
