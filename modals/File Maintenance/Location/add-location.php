 <!-- Modal Add Supplier-->
 <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Location Information</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <?php
                $database = new Connection();
                $db = $database->open();

                if ($db) {
                    $roomtypes_query = "SELECT roomtypes FROM tb_roomtypes ORDER BY roomtypes ASC";
                    $roomtypes_result = $db->query($roomtypes_query);

                    if ($roomtypes_result) {
                        $roomType = array();

                        while ($row = $roomtypes_result->fetch(PDO::FETCH_ASSOC)) {
                            $roomType[] = $row['roomtypes'];
                        }
                        $roomtypes_result = null;
                    } else {
                        echo "Error in executing the query: " . $db->errorInfo()[2];
                    }
                    $database->close();
                } else {
                    echo "Error in connecting to the database.";
                }
                ?>
             <div class="modal-body">
                 <!-- Multi Columns Form -->
                 <form action="crud-operation.php" method="post" class="row g-3 needs-validation" id="locationForm" novalidate>

                     <div class="row">
                         <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Room No.:</div>
                         <div class="col-sm-7 pt-3">
                             <input type="text" class="form-control form-control-sm" name="roomnumber" value="" required>
                             <div class="invalid-feedback">
                                 Please enter room number.
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-4 pt-3 text-dark"><span class="required">*</span>Room Type.:</div>
                         <div class="col-sm-7 pt-3">
                             <select id="roomtype" name="roomtype" class="form-select form-select-sm" required>
                                 <option value="" disabled selected>Select a room type</option>
                                 <?php
                                    // Output the options in the select dropdown
                                    foreach ($roomType as $rmtp) {
                                        echo "<option value='$rmtp'>$rmtp</option>";
                                    }
                                    ?>
                             </select>
                             <div class="invalid-feedback">
                                 Please select room type.
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-4 pt-3 text-dark">Description:</div>
                         <div class="col-sm-7 pt-3">
                             <textarea type="text" class="form-control form-control-sm" id="roomdescription" name="roomdescription"></textarea>
                             <div class="valid-feedback">
                                 Optional.
                             </div>
                            </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-4 pt-3 text-dark">Status:</div>
                         <div class="col-sm-7 pb-3 pt-3">
                             <select id="roomstatus" name="roomstatus" class="form-select form-select-sm" required>
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
                         <button type="submit" class="btn btn-sm btn-primary" name="addlocation">Save</button>
                     </div>


                 </form><!-- End Multi Columns Form -->
             </div>

         </div>
     </div>
 </div><!-- Modal Add Supplier-->