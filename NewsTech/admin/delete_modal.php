<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Box</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h3>Are you sure you want to delete this post?</h3>
            </div>
            <div class="modal-footer">
                <form id="delete_modal" method="post">
                    <input type="hidden" name="delete_id" value="" id="delete_id">
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>