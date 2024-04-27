<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="close-label">
                Are you sure you want to close the modal? Any unsaved changes will be lost.
            </div>
            <div class="modal-body" id="reject-label">
                Are you sure you want to reject the submission?. State the reason.
                <div class="">
                    <input id="Remarks" type="text" name="remarks" class="form-control">
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmCloseBtn">Close Tab</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="rejected" class="btn btn-success" id="confirmRejectBtn">Confirm</button>
            </div>
        </div>
    </div>
</div>