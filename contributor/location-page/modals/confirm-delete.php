<style>
    #modalDialogDelete {
        margin-top: 35vh;
    }

    #confirmModalDelete {
        backdrop-filter: blur(5px);
    }
</style>

<div class="modal fade" id="confirmModalDelete" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalDialogDelete">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this location?.
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtnRow">Delete</button>
            </div>
        </div>
    </div>
</div>