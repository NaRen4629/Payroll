<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $wkst['wkstn_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel"> Edit Workstation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <form method="POST" action="crud-operation.php?id=<?php echo $wkst['wkstn_id']; ?>">
                    <input type="hidden" class="form-control form-control-sm" name="workstation_id" value="<?php echo $wkst['wkstn_id']; ?>">
                    <div class="row">
                        <div class="col-sm-5"><span class="required">*</span>Workstation Name:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form-control-sm" name="workstationname" value="<?php echo $wkst['workstationname']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 pt-2"> Description</div>
                        <div class="col-sm-7 pt-2">
                            <textarea type="text" class="form-control form-control-sm" name="workstationdescription" value=""> <?php echo $wkst['workstationdescription']; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 pt-2">Status</div>
                        <div class="col-sm-7 pb-3 pt-2">
                            <select id="workstationstatus" name="workstationstatus" class="form-select form-select-sm">
                                <option selected><?php echo $wkst['workstationstatus']; ?></option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="editworkstation">Update</button>

                    </div>
                </form>

            </div>


        </div>
    </div>
</div>