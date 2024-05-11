<style>
    #modalDialog {
        margin-top: 5vh;
    }

    #confirmModalEdit {
        backdrop-filter: blur(5px);
    }
</style>
<div class="modal fade" id="confirmModalEdit" tabindex="-1" aria-labelledby="confirmModalEditLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalDialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalEditLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="delete-label">
                Are you sure you want to delete the disease? All data would be lost.
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" name="delete" class="btn btn-success" id="confirmDeleteBtnEdit">Confirm</button>
            </div>
        </div>
    </div>
</div>