<div class="modal fade" id="confirmModalEdit" tabindex="-1" aria-labelledby="confirmModalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalEditLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to close the modal? Any unsaved changes will be lost.
                <div id="coords-help" class="form-text mb-2" style="font-size: 0.8rem;">(to be saved as draft fill up the required field first.)</div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmCloseBtn">Close Tab</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="draft" class="btn btn-success">Save as Draft</button>
            </div>
        </div>
    </div>
</div>