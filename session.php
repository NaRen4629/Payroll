<!-- ?php
include('config/connect.php');
session_start();
$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db, "select Employee_ID from tbl_employee_information where Employee_ID = '$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['Employee_ID'];

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
    die();
} -->


<!-- 
<php
include('config/connect.php');
session_start();
$user_check = $_SESSION['Employee_ID'];

$ses_sql = mysqli_query($db, "select Employee_ID from tbl_user_level where Employee_ID = '$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['Employee_ID'];

if (!isset($_SESSION['Employee_ID'])) {
    header("location: login.php");
    die();
}
?> -->



<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('config/connect.php');
if (!isset($_SESSION['Employee_ID'])) {
    header("location: login.php");
    die();
}

$user_check = $_SESSION['Employee_ID'];

// Check if the connection is established and the query runs successfully
if ($db) {
    $ses_sql = mysqli_query($db, "SELECT Employee_ID FROM tbl_user_level WHERE Employee_ID = '$user_check'");
    if ($ses_sql) {
        $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
        $login_session = $row['Employee_ID'];
    } else {
        // Handle the case where the query fails
        echo "Error: Could not execute query.";
        exit();
    }
} else {
    // Handle the case where the connection fails
    echo "Error: Database connection failed.";
    exit();
}
?>

