<style>
    #modalDialog {
        margin-top: 35vh;
    }

    #confirmModal {
        backdrop-filter: blur(5px);
    }
</style>
<div class="modal fade" id="confirmModalDraft" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalDialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="close-label-draft">
                Are you sure you want to close the window? Any unsaved changes will be lost.
            </div>
            <div class="modal-body" id="delete-label-draft">
                Are you sure you want to delete the draft? It would be permanently deleted.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="delete" class="btn btn-danger" id="confirmDeleteDraft">Delete</button>
                <button type="button" class="btn btn-success" id="confirmCloseBtnDraft">Confirm</button>
            </div>
        </div>
    </div>
</div>