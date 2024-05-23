 <!-- Modal Add Supplier-->
 <?php
    $database = new Connection();
    $conn = $database->open();

    $query2 = "select * from tb_supplier order by suppid desc limit 2";
    $result2 = $conn->query($query2);
    $row = $result2->fetch();
    $last_id = $row['suppid'];

    if ($last_id == "") {
        $supplier_id = "SUPP1";
    } else {
        $supplier_id = substr($last_id, 4);
        $supplier_id = intval($supplier_id);
        $supplier_id = "SUPP" . ($supplier_id + 1);
    }
    $database->close();
    ?>
 <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Supplier Information</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <!-- Multi Columns Form -->
                 <form method="POST" action="crud-operation.php" id="" class="row g-3 needs-validation" novalidate>

                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark"><span class="required">*</span>Supplier ID:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" name="suppid" value="<?php echo $supplier_id ?>" readonly>
                             <span class="validation-msg" id="firstname-validation"></span>

                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark"><span class="required">*</span>First Name:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" id="firstname" name="firstname" value="" required>
                             <div class="invalid-feedback">
                                 Please enter first name.
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark">M.I:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" id="middlename" name="middlename" value="">
                             <div class="valid-feedback">
                                 Optional.
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark"><span class="required">*</span>Lastname:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" id="lastname" name="lastname" value="" required>
                             <div class="invalid-feedback">
                                 Please enter lastname.
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark"><span class="required">*</span>Business Name:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" id="businessname" name="businessname" value="" required>
                             <div class="invalid-feedback">
                                 Please enter business name.
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark"><span class="required">*</span>Business Address:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" id="businessaddress" name="businessaddress" value="" required>
                             <div class="invalid-feedback">
                                 Please enter business address.
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark"><span class="required">*</span>Phone No:</div>
                         <div class="col-sm-7 pt-3">
                             <div class="input-group input-group-sm">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">+63</span>
                                 </div>
                                 <input type="text" class="form-control form-control-sm" pattern="^9\d{9}$" placeholder="9876543210" maxlength="10" id="phonenumber" name="phonenumber" value="" required>
                                 <div class="invalid-feedback">
                                     Please enter phone number. It should start with the number nine.
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark">Telephone No:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" placeholder="000-00-000" name="telephonenumber" id="telephonenumber">
                             <div class="valid-feedback">
                                 Optional.
                             </div>
                         </div>
                     </div>

                     <!--telephone validation-->
                     <script>
                         const inputElement = document.getElementById("telephonenumber");

                         inputElement.addEventListener("input", function() {

                             const sanitizedValue = this.value.replace(/\D/g, "");

                             const formattedValue = `${sanitizedValue.slice(0, 3)}-${sanitizedValue.slice(3, 5)}-${sanitizedValue.slice(5, 8)}`;

                             this.value = formattedValue;
                         });
                     </script>



                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark">Email:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" id="email" name="email" value="">
                             <div class="valid-feedback">
                                 Optional.
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-3 text-dark"><span class="required">*</span>Status:</div>
                         <div class="col-sm-7 pb-2 pt-3">
                             <select id="status" name="status" class="form-select form-select-sm">
                                 <option selected>Active</option>
                                 <option>Inactive</option>
                             </select>
                         </div>
                     </div>

                     <div class="modal-footer">
                         <legend class="pt-3">
                             <h6 text-dark><span class="required">* </span>Indicates required fields</h6>
                         </legend>

                         <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-sm btn-primary" name="addSupplier">Save</button>
                     </div>
                 </form><!-- End Multi Columns Form -->
             </div>

         </div>
     </div>
 </div><!-- Modal Add Supplier-->