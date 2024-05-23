<!-- add category -->
<div class="modal fade" id="classificationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add Classification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form method="POST" action="crud-operation.php" class="needs-validation" novalidate>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Classification:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" name="classification" value="" required>
                        <div class="invalid-feedback">
                            Please enter classification name.
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark">Description:</div>
                        <div class="col-sm-7 pt-3">
                            <textarea type="text" class="form-control form-control-sm" id="claDescription" name="claDescription"></textarea>
                        <div class="valid-feedback">
                            Optional.
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 pt-3 text-dark">Status:</div>
                        <div class="col-sm-7 pb-3 pt-3">
                            <select id="classificationStatus" name="classificationStatus" class="form-select form-select-sm" required>
                                <option selected>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6 class="text-dark">NOTE: <span class="required"> * </span>Indicates Required Fields</h6>
                        </legend>

                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="addClassification">Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>