<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_user.php';
if(isset($_POST['deleteUser'])){
    $user_id = $_POST['user_id'];

    $user = new User();
    $user->delete_user($user_id);
    
    $_SESSION['User-alert_success'] = 'User Deleted';
    $_SESSION['User-alert_type'] = 'danger';

    // Redirect to the same page after processing the form
    header('Location: Payroll_Master_User.php');
    exit();
}

?>
<!-- Delete -->
<div class="modal fade" id="deleteUer_<?php echo $Users['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                <h5 class="modal-title" id="myModalLabel">Delete Supplier</h5>
             
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 
            </div>
            <div class="modal-body">    
                <p class="text-center">Are you sure you want to delete?</p>
                <h2 class="text-center"><?php echo $Users['Employee_ID'].' '.$Users['Userlevel']; ?></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="delete_user.php">
                    <input type="hidden" name="user_id" value="<?php echo $Users['user_id']; ?>">
                    <button type="submit" name="deleteUser" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>