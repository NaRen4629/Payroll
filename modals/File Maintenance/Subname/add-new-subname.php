<!-- Modal for adding a new sub name -->
<div class="modal" id="newsubnameModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="" method="post" action="crud-operation.php">
                <div class="modal-header">
                    <h5 class="modal-title">Add sub category name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-5 pt-3 text-dark">Sub name:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" id="newSubName" name="newSubName" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" name="addsubname">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>