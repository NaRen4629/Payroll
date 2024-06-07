<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Controller/controller_position.php';
if(isset($_POST['deletePosition'])){
    $position_id = $_POST['position_id'];

    $position = new Position();
    $position->delete_position($position_id);
    
}

?>

<!-- Delete -->
<div class="modal fade" id="deletePosition_<?php echo $Position['position_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <h2 class="text-center"><?php echo $Position['position'] . ' - ' . $Position['type']; ?></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="delete_postion.php">
                    <input type="hidden" name="position_id" value="<?php echo $Position['position_id']; ?>">
                    <button type="submit" name="deletePosition" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>