<!-- add category -->
<div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add Item brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="crud-operation.php" class="needs-validation" novalidate>

                    <div class="row">
                        <div class="col-sm-4 text-dark"><span class="required">*</span>Brand Name:</div>
                        <div class="col-sm-7 pb-3">
                            <input type="text" class="form-control form-control-sm" name="brandName" value="" required>
                            <div class="invalid-feedback">
                                Please enter brand name.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 text-dark">Status:</div>
                        <div class="col-sm-7 pb-3">
                            <select id="brandStatus" name="brandStatus" class="form-select form-select-sm">
                                <option selected>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6 class="text-dark"><span class="required">* </span>Indicates required fields</h6>
                        </legend>

                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="addBrand">Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>