<div class="modal" id="view_<?php echo $item['id']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Item Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">Item Name: </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $item['item_name']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Category Name:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $item['cat_name'];?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Sub Category:</div>
                    <div class="col-sm-7 pt-2">
                    <input type="text" class="form-control form-control-sm" placeholder=" <?php echo $item['sub_name'];?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Brand Name:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $item['brand_name'];?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Model:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $item['model'];?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Item Description:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $item['item_description'];?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Item Status:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $item['item_status'];?>" readonly>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>