<?php
ob_start();
include 'session.php';

include('includes/Payroll-Master-header.php');
include 'config/connect.php';

include 'Controller/controller_employee.php';

$employee = new Employee();
// $types = $employee->get_type();
$staff_positions = $employee->get_all_staff_position();
$faculty_positions = $employee->get_all_faculty_position();
$faculty_departments = $employee->get_faculty_department();


if (isset($_POST['addEmployee'])) {
    $employee_number = $_POST['employee_number'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $civil_status = $_POST['civil_status'];
    $date_hired = $_POST['date_hired'];
    $status = $_POST['status'];
    $contact_no = $_POST['contact_no'];
    $email_address = $_POST['email_address'];
    $province = $_POST['province'];
    $brangay = $_POST['brangay'];
    $street = $_POST['street'];
    $position_id = $_POST['position_id'];
    $department_id = $_POST['department_id'];


    $result = $employee->add_employee_info(
        $employee_number, $first_name, $middle_name, $last_name, $date_of_birth, $gender, $civil_status,
        $date_hired, $status, $contact_no, $email_address, $province, $brangay, $street, $position_id, $department_id);

}
ob_end_flush();
?>

<div class="container-fluid">
    <form method="post" class="needs-validation" novalidate>
        <div class="card">
            <h5 class="card-header">Personal Information</h5>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="employee_id" class="col-sm-3 col-form-label"><span class="required">*</span>Employee ID:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="employee_id" name="employee_number" class="form-control" aria-describedby="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group row">
                                <label for="date_hired" class="col-sm-3 col-form-label">Date Hired:</label>
                                <div class="col-sm-9">
                                    <input type="date" id="date_hired" name="date_hired" class="form-control" aria-describedby="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="last_name" class="col-sm-3 col-form-label"><span class="required">*</span>Last Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="last_name" name="last_name" class="form-control" aria-describedby="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status:</label>
                                <div class="col-sm-9">
                                    <select id="status" name="status" class="form-control">
                                        <option value="Active" selected>Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="first_name" class="col-sm-3 col-form-label"><span class="required">*</span>First Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="first_name" name="first_name" class="form-control" aria-describedby="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="contact_number" class="col-sm-3 col-form-label"><span class="required">*</span>Contact Number:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="contact_number" name="contact_no" class="form-control" aria-describedby="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="middle_name" class="col-sm-3 col-form-label">Middle Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="middle_name" name="middle_name" class="form-control" aria-describedby="">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="email_address" class="col-sm-3 col-form-label"><span class="required">*</span>Email Address:</label>
                                <div class="col-sm-9">
                                    <input type="email" id="email_address" name="email_address" class="form-control" aria-describedby="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="date_of_birth" class="col-sm-3 col-form-label"><span class="required">*</span>Date of Birth:</label>
                                <div class="col-sm-9">
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" aria-describedby="" required>
                                    <div id="dob-error" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group row">
                                <label for="address" class="col-sm-3 col-form-label"><span class="required">*</span>Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="gender" class="col-sm-3 col-form-label"><span class="required">*</span>Gender:</label>
                                <div class="col-sm-9">
                                    <select id="gender" name="gender" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <!-- <option value="lgbtq">LGBTQ</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="province_city" class="col-sm-3 col-form-label"><span class="required">*</span>Province/City:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="province_city" name="province" class="form-control" aria-describedby="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="civil_status" class="col-sm-3 col-form-label"><span class="required">*</span>Civil Status:</label>
                                <div class="col-sm-9">
                                    <!-- <input type="text" id="civil_status" name="civil_status" class="form-control" aria-describedby=""> -->
                                    <select id="civil_status" name="civil_status" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <!-- <option value="lgbtq">LGBTQ</option> -->
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="baranggay" class="col-sm-3 col-form-label"><span class="required">*</span>Baranggay:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="baranggay" name="brangay" class="form-control" aria-describedby="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="street" class="col-sm-3 col-form-label"><span class="required">*</span>Street:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="street" name="street" class="form-control" aria-describedby="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end tag sa div sa personal infromation-->
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Contribution</h5>
                    <div class="card-body">
                        <div class="container-fluid">

                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-5S">
                                        <label for="" class="col-form-label">Pag-ibig Number:</label>
                                    </div>
                                    <div class="col-sm-5S">
                                        <input type="text" id="pagibig" name="pagibig" class="form-control" aria-describedby="">
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-5S">
                                        <label for="" class="col-form-label">SSS:</label>
                                    </div>
                                    <div class="col-sm-5S">
                                        <input type="text" id="sss" name="sss" class="form-control" aria-describedby="">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-5S">
                                        <label for="" class="col-form-label">Phil Health No:</label>
                                    </div>
                                    <div class="col-sm-5S">
                                        <input type="text" id="philhealth" name="philhealth" class="form-control" aria-describedby="">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-5S">
                                        <label for="" class="col-form-label">TIN:</label>
                                    </div>
                                    <div class="col-sm-5S">
                                        <input type="text" id="tin" name="tin" class="form-control" aria-describedby="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Bank Details</h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-5S">
                                        <label for="" class="col-form-label">Account No:</label>
                                    </div>
                                    <div class="col-sm-5S">
                                        <input type="text" id="account_no" name="account_no" class="form-control" aria-describedby="">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-5S">
                                        <label for="" class="col-form-label">Account Name:</label>
                                    </div>
                                    <div class="col-sm-5S">
                                        <input type="text" id="account_name" name="account_name" class="form-control" aria-describedby="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="card">
            <h5 class="card-header">Employee Details</h5>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="employee_type_id" class="col-sm-3 col-form-label"><span class="required">*</span>Type:</label>
                                <div class="col-sm-9">
                                    <select id="employee_type_id" class="form-control" name="employee_type_id" required>
                                        <option value="">Select</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Faculty">Faculty</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="positionField">
                                <label for="position_id" class="col-sm-3 col-form-label"><span class="required">*</span>Position Title:</label>
                                <div class="col-sm-9">
                                    <select id="position_id" class="form-control" name="position_id" required>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="Part_time_hourlyrate" style="display: none;">
                                <label for="additional_field" class="col-sm-3 col-form-label"><span class="required">*</span>Hourly Rate:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="additional_field" name="additional_field" placeholder="Enter Hourly Rate">
                                </div>
                            </div>

                            <div class="form-group row" id="Regular_basic_salary" style="display: none;">
                                <!-- <label for="additional_field" class="col-sm-3 col-form-label"><span class="required">*</span>Basic Salary:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="additional_field" name="additional_field" placeholder="Enter Basic Salary">
                                </div> -->
                            </div>

                            <div class="form-group row" id="Faculty_part_time_position" style="display: none;">
                                <label for="department_id" class="col-sm-3 col-form-label">Department:</label>
                                <div class="col-sm-9">
                                    <select id="department_id" class="form-control" name="department_id">
                                        <option value="" selected>Select</option> <!-- Ensure this option is selected by default -->
                                        <?php foreach ($faculty_departments as $faculty_department) { ?>
                                            <option value="<?php echo $faculty_department['department_id']; ?>">
                                                <?php echo $faculty_department['department_code'] . ' - ' . $faculty_department['department_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="partTimeCheckbox" style="display: none;">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <!-- <input class="form-check-input" type="checkbox" name="part_time" value="" id="flexCheckDefault" name="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">Part Time</label> -->
                                    </div>
                                </div>
                            </div>
                            <!-- 
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Part Time</label>
                        </div> -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- end tag sa div sa employee detail-->
        </div>

        <br>



        <div class="card-header py-2">
            <button type="submit" name="addEmployee" class="btn btn-sm btn-primary float-end">Save</button>
    </form>
</div>
</div>


<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>


<script>
    document.getElementById('employee_type_id').addEventListener('change', function() {
        var selectedValue = this.value;
        var partTimeCheckbox = document.getElementById('partTimeCheckbox');
        var Part_time_hourlyrate = document.getElementById('Part_time_hourlyrate');
        var Faculty_part_time_position = document.getElementById('Faculty_part_time_position');

        // Reset the additional field to default state
        partTimeCheckbox.style.display = 'none';
        Part_time_hourlyrate.style.display = 'none';
        Regular_basic_salary.style.display = 'none';
        Faculty_part_time_position.style.display = 'none';

        if (selectedValue === 'Staff') {
            // Populate the position dropdown with staff positions
            var positionDropdown = document.getElementById('position_id');
            positionDropdown.innerHTML = '<option value="">Select</option>';
            <?php foreach ($staff_positions as $staff_position) { ?>
                positionDropdown.innerHTML += '<option value="<?php echo $staff_position['position_id']; ?>"><?php echo $staff_position['position']; ?></option>';
            <?php } ?>
            partTimeCheckbox.style.display = 'block';

        }

        // Show/hide additional field based on selected value
        else if (selectedValue === 'Faculty') { // Assuming 'Faculty' has employee_type_id 2
            var positionDropdown = document.getElementById('position_id');
            positionDropdown.innerHTML = '<option value="">Select</option>';
            <?php foreach ($faculty_positions as $faculty_position) { ?>
                positionDropdown.innerHTML += '<option value="<?php echo $faculty_position['position_id']; ?>"><?php echo $faculty_position['position']; ?></option>';
            <?php } ?>
            Faculty_part_time_position.style.display = 'block';
        } else {
            // If employee type is not 'Faculty', hide the department dropdown
            Faculty_part_time_position.style.display = 'none';

            // Reset the department dropdown to default state
            var departmentDropdown = document.getElementById('department_id');
            departmentDropdown.selectedIndex = 0;
        }
    });

    // Show/hide additional field based on selected position
    // document.getElementById('position_id').addEventListener('change', function() {
    //     var selectedPosition = this.value;
    //     var Part_time_hourlyrate = document.getElementById('Part_time_hourlyrate');
    //     var Regular_basic_salary = document.getElementById('Regular_basic_salary');

    //     Part_time_hourlyrate.style.display = (selectedPosition === '4') ? 'block' : 'none';
    //     Regular_basic_salary.style.display = (selectedPosition === '5') ? 'block' : 'none';
    // });

    // Show/hide additional field based on checkbox status
    // document.getElementById('flexCheckDefault').addEventListener('change', function() {
    //     var additionalField = document.getElementById('Part_time_hourlyrate');
    //     additionalField.style.display = this.checked ? 'block' : 'none';
    // });

    
</script>