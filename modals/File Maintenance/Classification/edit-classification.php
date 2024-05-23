<!-- edit classification -->
<div class="modal fade" id="edit_<?php echo $classi['classi_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Edit Classification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="crud-operation.php?id=<?php echo $classi['classi_id']; ?>">

                    <input type="hidden" class="form-control form-control-sm" name="classificationId" value="<?php echo $classi['classi_id']; ?>">

                    <div class="row">
                        <div class="col-sm-4 pt-3">Classification:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="classification" value="<?php echo $classi['classification']; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-2">Description:</div>
                        <div class="col-sm-7 pt-2">
                            <textarea type="text" class="form-control form-control-sm" name="claDescription" value=""><?php echo $classi['classi_description']; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3">Status:</div>
                        <div class="col-sm-7 pb-3 pt-3">
                            <select id="classificationStatus" name="classificationStatus" class="form-select form-select-sm" value="<?php echo $classi['classi_status']; ?>" required>
                                <option salected><?php echo $classi['classi_status']; ?></option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="editClassification">Save</button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>