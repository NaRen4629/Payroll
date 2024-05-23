<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $subcat['sub_cat_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                <h5 class="modal-title font-weight-bold text-primary" id="myModalLabel">Delete Sub Category</h5>

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
            </div>
            <div class="modal-body">    
                <p class="text-center">Are you sure you want to delete?</p>
                <h2 class="text-center">Subname: <?php echo $subcat['sub_name'];?></h2>
                <h2 class="text-center">Status: <?php echo $subcat['sub_cat_status'];?></h2>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                <form method="POST" action="crud-operation.php">
                    <input type="hidden" name="subcatId" value="<?php echo $subcat['sub_cat_id']; ?>">
                    <button type="submit" name="deleteSubCatName" class="btn btn-sm btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
