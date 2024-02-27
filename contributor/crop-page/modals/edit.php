<!-- STYLE -->
<style>
    .modal-tab:hover {
        color: grey;
    }
</style>

<!-- EDIT MODAL -->
<div class="modal fade" id="edit-item-modal" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" action="crop-page/modals/crud-code/try.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body edit-modal-body">
                    <!-- TAB LIST NAVIGATION -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active small-font modal-tab" id="gen-tab" data-bs-toggle="tab" data-bs-target="#gen-tab-pane" type="button" role="tab" aria-controls="gen-tab-pane" aria-selected="true"><i class="fa-solid fa-info"></i></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="loc-tab" data-bs-toggle="tab" data-bs-target="#loc-tab-pane" type="button" role="tab" aria-controls="loc-tab-pane" aria-selected="false"><i class="fa-solid fa-location-dot"></i> </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="more-tab" data-bs-toggle="tab" data-bs-target="#more-tab-pane" type="button" role="tab" aria-controls="more-tab-pane" aria-selected="false"><i class="fa-solid fa-ellipsis"></i></button>
                        </li>
                    </ul>
                    <div class="container">

                        <div class="tab-content mt-2">
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Check if the crop_id field is set in the POST data
                                if (isset($_POST["crop_id"])) {
                                    // Retrieve the value of crop_id from the POST data
                                    $crop_id = $_POST["crop_id"];

                                    // Use the $crop_id variable as needed
                                    echo "Crop ID: " . $crop_id;
                                } else {
                                    // crop_id is not set in the POST data
                                    echo "Crop ID is not set";
                                }
                            }else{
                                echo "nop isd";
                            }

                            ?>
                            <!-- general -->
                            <?php require "edit-tabs/gen.php" ?>
                            <!-- location -->
                            <?php require "edit-tabs/loc.php" ?>
                            <!-- mroe optional info -->
                            <?php require "edit-tabs/more.php" ?>
                        </div>

                    </div>
                </div>
            </form>

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

<script>
    // EDIT SCRIPT
    const tableRows = document.querySelectorAll('.table tbody tr');

    tableRows.forEach(row => {
        // Prevent default click behavior on checkbox and ellipsis
        row.querySelector('.form-check-input').addEventListener('click', (event) => {
            event.stopPropagation();
        });

        row.querySelector('.fa-solid.fa-ellipsis-vertical.btn').addEventListener('click', (event) => {
            event.stopPropagation();
        });

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Populate the modal content
            const modalBody = document.querySelector('.edit-modal-body.modal-body');
            modalBody.innerHTML += `
                <input type="hidden" name="crop_id" value="${id}">
            `;

            // Show the modal
            const dataModal = new bootstrap.Modal(document.getElementById('edit-item-modal'), {
                keyboard: false
            });
            dataModal.show();
        });
    });
</script>