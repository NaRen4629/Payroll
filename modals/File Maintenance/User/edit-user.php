<div class="modal fade" id="editUser_<?php echo  $Users['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title font-weight-bold text-primary" id="myModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
            </div>
            <div class="modal-body">
            <form action="crud-operation.php" method="post" class="row g-3" id="">
            <input type="hidden" class="form-control form-control-sm" name="user_id" value="<?php echo $Users['user_id']; ?>">
                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>Employee ID:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" id="idEmployee_ID" name="Employee_ID" value="<?php echo $Users['Employee_ID']; ?>">
                            <!-- // <div id="ErrorEmployee_ID" class="invalid-feedback">Please fill in your document.</div> -->
                        </div>
                       
                    </div>

                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>Password:</div>
                        <div class="col-sm-7 pt-3">
                            <input type="text" class="form-control form-control-sm" id="idPassword" name="Password" value="<?php echo $Users['Password']; ?>"
                                >
                        </div>
                        <div id="ErrorPassword" class="invalid-feedback">Please fill in your document.</div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>User level:</div>
                        <div class="col-sm-7 pb-2 pt-3">
                            <select id="Userlevel" name="Userlevel" class="form-select form-select-sm"   onchange="showTextInput()">
                                <option ></option>
                                <option value="Admin" <?php echo ($Users['Userlevel'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="Faculty" <?php echo ($Users['Userlevel'] == 'Faculty') ? 'selected' : ''; ?>>Faculty</option>
                                <option value="Staff" <?php echo ($Users['Userlevel'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                            </select>
                            
                        </div>
                    </div>

                   
                    <div class="row">
                        <div class="col-sm-5 pt-3"><span class="required">*</span>Status:</div>
                        <div class="col-sm-7 pb-2 pt-3">
                            <select id="Status" name="Status" class="form-select form-select-sm" value="<?php echo $Users['Status']; ?>">
                              
                                <option value="Active" <?php echo ($Users['Status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                <option value="Inactive" <?php echo ($Users['Status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <legend class="pt-3">
                            <h6><span class="required">* </span>Indicates required fields</h6>
                        </legend>

                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn    btn-sm btn-primary" id="ideditUser" name="editUser">Edit User</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- 
<script>
document.getElementById('ideditUser').addEventListener('click', function(event) {
    var idEmployee_ID = document.getElementById('idEmployee_ID');
    var ErrorEmployee_ID = document.getElementById('ErrorEmployee_ID');
    var isValid = true;

    // Employee ID validation
    var PasswordValue = idEmployee_ID.value.trim();

    if (PasswordValue === '') {
      idEmployee_ID.classList.add('is-invalid');
      ErrorEmployee_ID.textContent = 'Please fill in the Employee ID.';
      ErrorEmployee_ID.style.display = 'block';
      isValid = false;
    } else if (!/^[A-Za-z\s]+$/.test(PasswordValue)) {
      idEmployee_ID.classList.add('is-invalid');
      ErrorEmployee_ID.textContent = 'Only letters and spaces are allowed for the Employee ID.';
      ErrorEmployee_ID.style.display = 'block';
      isValid = false;
    } else {
      idEmployee_ID.classList.remove('is-invalid');
      ErrorEmployee_ID.style.display = 'none';
    }

    // Password validation
    var IdPassword = document.getElementById('idPassword');
    var ErrorPassword = document.getElementById('ErrorPassword');
    
    var PasswordValue = IdPassword.value.trim();

    if (PasswordValue === '') {
      IdPassword.classList.add('is-invalid');
      ErrorPassword.textContent = 'Please fill in the Password.';
      ErrorPassword.style.display = 'block';
      isValid = false;
    } else if (!/^[A-Za-z\s]+$/.test(PasswordValue)) {
      IdPassword.classList.add('is-invalid');
      ErrorPassword.textContent = 'Only letters and spaces are allowed for the Password.';
      ErrorPassword.style.display = 'block';
      isValid = false;
    } else {
      IdPassword.classList.remove('is-invalid');
      ErrorPassword.style.display = 'none';
    }

    if (!isValid) {
      event.preventDefault(); 
    }
});

</script> -->