<?php
session_start();
include('config/connect.php');

$tbl_name = "tbl_user_level"; // Table name 

if(isset($_POST['Login'])) {
    $Employee_ID = $_POST['Employee_ID'];
    $Password = $_POST['Password'];

    $Employee_ID = stripslashes($Employee_ID);
    $Password = stripslashes($Password);
    $Employee_ID = mysqli_real_escape_string($db, $Employee_ID);
    $Password = mysqli_real_escape_string($db, $Password);

    $sql = "SELECT * FROM $tbl_name WHERE Employee_ID='$Employee_ID' and Password='$Password'";
    $result = mysqli_query($db, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $rows = mysqli_fetch_assoc($result);

            $_SESSION["Employee_ID"] = $Employee_ID;
            $_SESSION["Userlevel"] = $rows['Userlevel'];
            $_SESSION["Status"] = $rows['Status'];

            if ($_SESSION["Userlevel"] == 'Payroll Master' &&  $_SESSION["Status"] == "Active") {
                header('location: PayrollMaster_index.php');
                exit();
            }
        
            elseif ($_SESSION["Userlevel"] == 'Accounting'  &&  $_SESSION["Status"] == "Active") {
                header('location: Accounting_index.php');
                exit();
            }
            elseif ($_SESSION["Userlevel"] == 'School Admin'  &&  $_SESSION["Status"] == "Active") {
                header('location: School_Admin_index.php');
                exit();
            }
        } else {
            // Handle login failure (e.g., display an error message)
            $error = "Invalid Username or Password";
        }
    }
}

// Include login.php and pass the error message
include('login.php');
?>