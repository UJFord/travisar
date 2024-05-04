<style>
    #modalDialogEdit {
        margin-top: 35vh;
    }

    #confirmModalEdit {
        backdrop-filter: blur(5px);
    }
</style>
<div class="modal fade" id="confirmModalEdit" tabindex="-1" aria-labelledby="confirmModalEditLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalDialogEdit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalEditLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="approve-label">
                Are you sure you want to approve the user? Please review all credentials for accuracy.
            </div>
            <div class="modal-body" id="delete-label">
                Are you sure you want to reject the user? This action will remove all associated data.
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="delete" class="btn btn-success" id="confirmDeleteBtnEdit">Confirm</button>
                <button type="submit" class="btn btn-success" name="approve" id="confirmApproveBtnEdit">Confirm</button>
            </div>
        </div>
    </div>
</div>