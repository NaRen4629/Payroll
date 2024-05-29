<!-- add req -->
<div class="modal fade" id="addleave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Leave <i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

             <!-- Begin Page Content -->
<div class="container-fluid">
    <form method="POST" action="crud-operation.php" id="insert_form" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="code" class="form-label">Code <span class="required">*</span></label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="required">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="credits" class="form-label">Default Credits <span class="required">*</span></label>
            <input type="number" class="form-control" id="credits" name="credits" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status <span class="required">*</span></label>
            <select class="form-select" id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <div class="modal-footer">
            <legend>
                <h6 class="text-dark">NOTE: <span class="required">* </span>Indicates Required Fields</h6>
            </legend>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="savereq" class="btn btn-sm btn-primary float-end">Save</button>
        </div>
    </form>
</div><!-- /.container-fluid -->

            </div>
        </div>
    </div>
</div>