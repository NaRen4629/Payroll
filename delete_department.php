<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_department.php';
if(isset($_POST['deleteDepartment'])){
    $department_id = $_POST['department_id'];

    $Department = new Department();
    $Department->delete_department($department_id);
    
}
?>

<!-- Delete -->
<div class="modal fade" id="deleteDepartment<?php echo $Department['department_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">    
                <p class="text-center">Are you sure you want to delete the department?</p>
                <h2 class="text-center"><?php echo $Department['department_code'] . ' - ' . $Department['department_name']; ?></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="delete_department.php">
                    <input type="hidden" name="department_id" value="<?php echo $Department['department_id']; ?>">
                    <button type="submit" name="deleteDepartment" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
