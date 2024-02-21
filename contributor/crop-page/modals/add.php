<!-- STYLE -->
<style>
    .modal-tab:hover {
        color: grey;
    }
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <div class="modal-body">
                <!-- TAB LIST NAVIGATION -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link small-font modal-tab" id="gen-tab" data-bs-toggle="tab" data-bs-target="#gen-tab-pane" type="button" role="tab" aria-controls="gen-tab-pane" aria-selected="false"><i class="fa-solid fa-info"></i></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active small-font modal-tab" id="loc-tab" data-bs-toggle="tab" data-bs-target="#loc-tab-pane" type="button" role="tab" aria-controls="loc-tab-pane" aria-selected="true"><i class="fa-solid fa-location-dot"></i> </button>
                    </li>
                </ul>
                <div class="container">

                    <div class="tab-content mt-2">
                        <!-- general -->
                        <?php require "tabs/gen.php" ?>
                        <!-- location -->
                        <?php require "tabs/loc.php" ?>
                    </div>

                </div>
            </div>

            <!-- footer -->
            <div class="modal-footer d-flex justify-content-between">
                <div class="">
                    <button type="button" class="btn btn-success">Save</button>
                    <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                </div>
                <button type="button" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    // keep the modal on
    window.onload = function() {
        const dataModal = new bootstrap.Modal(document.getElementById('add-item-modal'), {
            keyboard: false
        });
        dataModal.show();
    };
</script>