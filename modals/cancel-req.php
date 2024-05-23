<!-- cancel req -->
<div class="modal fade" id="cancelreqitem_<?php echo $Request['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                <h5 class="modal-title font-weight-bold text-primary" id="myModalLabel">Cancel Request</h5>

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
            </div>
            <div class="modal-body">    
                <h1 class="text-center">Are you sure you want to cancel this request?</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <form method="POST" action="crud-operation.php">
                <input type="hidden" name="request_id" value="<?php echo $Request['request_id']; ?>">
                    <button type="submit" name="cancelreq" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
