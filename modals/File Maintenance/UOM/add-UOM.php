 <!-- Modal Add Supplier-->
 <div class="modal fade" id="UOMModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-md modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add UOM</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <!-- Multi Columns Form -->
                 <form action="crud-operation.php" method="post" id="UOMForm" class="needs-validation" novalidate>

                     <div class="row">
                         <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>UOM Name:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" name="uomname" value="" required>
                             <div class="invalid-feedback">
                                 Please enter unit of measures.
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-4 pt-3 text-dark">Description:</div>
                         <div class="col-sm-7 pb-3 pt-3">
                             <textarea type="text" class="form-control form-control-sm" id="UOMdescription" name="UOMdescription"></textarea>
                             <div class="valid-feedback">
                                 Optional.
                             </div>
                         </div>
                     </div>

                     <div class="modal-footer">
                         <legend class="pt-3">
                             <h6 class="text-dark">NOTE: <span class="required"> * </span>Indicates Required Fields</h6>
                         </legend>
                         <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-sm btn-primary" name="adduom">Save</button>
                     </div>
                 </form><!-- End Multi Columns Form -->
             </div>

         </div>
     </div>
 </div><!-- Modal Add Supplier-->