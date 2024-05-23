 <!-- Modal Add Supplier-->
 <div class="modal fade" id="wkstnModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Workstation Information</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <!-- Multi Columns Form -->
                 <form method="POST" action="crud-operation.php" id="wkstnForm">

                     <div class="row">
                         <div class="col-sm-5 pt-3"><span class="required">*</span>Workstation Name:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" name="wname" value="">
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-2">Description</div>
                         <div class="col-sm-7 pt-2">
                             <textarea type="text" class="form-control form-control-sm" name="wdescription" value=""></textarea>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-5 pt-2">Status</div>
                         <div class="col-sm-7 pb-3 pt-2">
                             <select id="wstatus" name="wstatus" class="form-select form-select-sm">
                                 <option selected>Active</option>
                                 <option>Inactive</option>
                             </select>
                         </div>
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-sm btn-primary" name="addwkstn">Save</button>
                     </div>
                 </form><!-- End Multi Columns Form -->
             </div>

         </div>
     </div>
 </div><!-- Modal Add Supplier-->