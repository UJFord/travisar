<style>
    #modalDialog {
        margin-top: 35vh;
    }

    #confirmModal {
        backdrop-filter: blur(5px);
    }
</style>
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalDialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to close the window? If you don't want to lose your data save it as draft otherwise confirm.
            </div>

            <div class="modal-footer">
                <button type="submit" id="confirmDraft" name="draft" class="btn btn-success">Save as Draft</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmCloseBtn">Confirm</button>
            </div>
        </div>
    </div>
</div>