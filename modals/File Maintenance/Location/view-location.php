<div class="modal" id="view_<?php echo $loc['loc_id']; ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered"">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary">View Location Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-4">Room No.:</div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" value="<?php echo $loc['roomnumber']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Room Type:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" value="<?php echo $loc['roomtype']; ?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 pt-2">Description:</div>
                    <div class="col-sm-7 pt-2">
                        <textarea cols="44" rows="5" class="form-control form-control-sm" readonly><?php echo $loc['roomdescription']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Status:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" value="<?php echo $loc['roomstatus']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>