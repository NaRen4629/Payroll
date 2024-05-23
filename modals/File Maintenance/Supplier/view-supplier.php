<div class="modal" id="view_<?php echo $supp['suppid']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Supplier Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">Firstname:</div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $supp['firstname']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">M.I.:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $supp['middlename']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Lastname:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $supp['lastname']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Business Name:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $supp['businessname']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Business Address:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $supp['businessaddress']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Phone No.:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $supp['phonenumber']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Telephone No.:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $supp['telephonenumber']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Email:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $supp['email']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 pt-2">Status:</div>
                    <div class="col-sm-7 pt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="<?php echo $supp['status']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>