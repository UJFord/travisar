<!-- STYLE -->
<!-- STYLE -->
<style>
    .btn-selected {
        background-color: #000;
        color: white;
    }

    .modal-tab:hover {
        color: grey;
    }

    .modal-header {
        position: relative;
    }
</style>

<!-- HTML -->
<div class="modal fade" id="import-item-modal" tabindex="-1" aria-labelledby="add-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog ">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title small-font" id="add-label">Import Crops</h5>
                <div>
                    <button type="button" class="btn-close navbar" aria-label="Close" id="navbar-example2" class="navbar navbar-light bg-light px-3" data-bs-dismiss="modal"></button>
                </div>
            </div>

            <div id="message-error">
            </div>

            <!-- body -->
            <div class="modal-body">

                <!-- category filter -->
                <h5 class="fw-bold">Choose Category</h5>
                <div class="row">
                    <div class="input-group flex-nowrap">
                        <button class="btn btn-dark flex-fill">Rice</button>
                        <button class="btn btn-dark flex-fill">Corn</button>
                        <button class="btn btn-dark flex-fill">Root <span class="d-block">Crops</span></button>
                    </div>
                </div>

            </div>

            <!-- footer -->
            <div class="modal-footer d-flex justify-content-end">
                <div class="">
                    <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="" name="" class="btn btn-success">Import<i class="fa-solid fa-file-import"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    // keep the modal on
    window.onload = function() {
        const dataModal = new bootstrap.Modal(document.getElementById('export-item-modal'), {
            keyboard: false
        });
        dataModal.show();
    };

    // $(document).ready(function() {
    //     function updateButtonStyles() {
    //         $('.btn-check').each(function() {
    //             var label = $('label[for="' + $(this).attr('id') + '"]');
    //             if ($(this).is(':checked')) {
    //                 label.addClass('btn-selected text-white').addClass('btn-success');
    //             } else {
    //                 label.removeClass('btn-selected text-white').removeClass('btn-success');
    //             }
    //         });
    //     }

    //     // Initial check to apply the class to the default checked button
    //     updateButtonStyles();

    //     // Change event to update styles
    //     $('.btn-check').change(updateButtonStyles);
    // });
</script>