<!-- STYLE -->
<style>
    .btn-selected {
        /* background-color: #000; */
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
<div class="modal fade" id="export-item-modal" tabindex="-1" aria-labelledby="add-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h6 class="modal-title" id="add-label">Export Crops</h6>
                <div>
                    <button type="button" class="btn-close navbar" aria-label="Close" id="navbar-example2" class="navbar navbar-light bg-light px-3" data-bs-dismiss="modal"></button>
                </div>
            </div>
            <div id="message-error"></div>
            <!-- body -->
            <div class="modal-body">
                <div class="container">
                    <form action="modals/crud-code/">

                    </form>
                    <!-- category filter -->
                    <h6 class=" mb-3 fw-bold">Select Category</h6>
                    <div class="row mb-3 d-flex justify-content-center">
                        <div class="btn-group align-item-center border p-0 w-75" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check btn-export" name="options" id="corn" autocomplete="off" checked>
                            <label class="btn fw-bolder border-end-0 d-flex flex-column justify-content-center align-items-center btn-success" for="corn"><span>Corn</span></label>
                            <input type="radio" class="btn-check btn-export" name="options" id="rice" autocomplete="off">
                            <label class="btn fw-bolder d-flex flex-column justify-content-center align-items-center" for="rice"><span>Rice</span></label>
                            <input type="radio" class="btn-check btn-export" name="options" id="root-crops" autocomplete="off">
                            <label class="btn fw-bolder border-start-0 d-flex flex-column justify-content-center align-items-center" for="root-crops"><span>Root</span> <span class="">Crops</span></label>
                        </div>
                    </div>

                    <!-- terrain -->
                    <h6 class="mb-3 fw-bold">Select Terrain</h6>
                    <div class="row mb-5 px-3">
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Flat
                            </label>
                        </div>
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Hillside
                            </label>
                        </div>
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Rolling
                            </label>
                        </div>
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Sloping
                            </label>
                        </div>
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Steep
                            </label>
                        </div>
                    </div>

                    <!-- municipality -->
                    <h6 class="mb-3 fw-bold">Select Municipality</h6>
                    <div class="row mb-5 px-3">

                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Alabel
                            </label>
                        </div>

                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Kiamba
                            </label>
                        </div>

                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Malapatan
                            </label>
                        </div>

                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Maasim
                            </label>
                        </div>
                    </div>

                    <!-- barangay -->
                    <h6 class="mb-3 fw-bold">Select Barangay</h6>
                    <div class="row mb-5 px-3">

                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Poblacion
                            </label>
                        </div>

                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Koronadal Proper
                            </label>
                        </div>

                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Malapatan
                            </label>
                        </div>

                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" value="" id="">
                            <label class="form-check-label" for="">
                                Maasim
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <!-- footer -->
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn border btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn border btn-success" data-bs-dismiss="modal">Export <i class="fa-solid fa-file-export"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    // keep the modal on
    // window.onload = function() {
    //     const dataModal = new bootstrap.Modal(document.getElementById('export-item-modal'), {
    //         keyboard: false
    //     });
    //     dataModal.show();
    // };

    $(document).ready(function() {
        function updateButtonStylesEx() {
            $('.btn-check').each(function() {
                var label = $('label[for="' + $(this).attr('id') + '"]');
                if ($(this).is(':checked')) {
                    label.addClass('btn-selected text-white').addClass('btn-success');
                } else {
                    label.removeClass('btn-selected text-white').removeClass('btn-success');
                }
            });
        }

        // Initial check to apply the class to the default checked button
        // updateButtonStylesEx();

        // Change event to update styles
        $('.btn-check').change(updateButtonStylesEx);
    });
</script>