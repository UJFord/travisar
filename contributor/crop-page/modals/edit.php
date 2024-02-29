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

<!-- script for getting the on the edit -->
<script>
    // EDIT SCRIPT
    const tableRows = document.querySelectorAll('.edit_data');

    tableRows.forEach(row => {

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Use the crop_id as needed
            // console.log("Crop ID: " + id);

            // Assuming you have jQuery available
            $.ajax({
                url: 'crop-page/modals/crud-code/try.php',
                type: 'POST',
                data: {
                    'click_edit_btn': true,
                    'crop_id': id,
                },
                success: function(response) {
                    // Handle the response from the PHP script
                    // console.log('Response:', response);

                    $.each(response, function(key, value) {
                        // Append options to select element
                        // console.log(value['barangay_name']);

                        $('#crop_variety_select').append($('<option>', {
                            value: value['crop_variety'],
                            text: value['crop_variety']
                        }));
                        // gi comment out sa nako kay kuwaon pa nako ang data sa db na ma show sa data sa loc
                        $('#BarangaySelect').append($('<option>', {
                            value: value['barangay_name'],
                            text: value['barangay_name']
                        }));
                        $('#MunicipalitySelect').append($('<option>', {
                            value: value['municipality_name'],
                            text: value['municipality_name']
                        }));
                        $('#crop_variety').val(value['crop_variety']);
                        $('#ScienceName').val(value['scientific_name']);
                        $('#UniqueFeat').val(value['unique_features']);
                        $('#MainEcosystem').val(value['role_in_maintaining_upland_ecosystem']);
                        $('#description').val(value['crop_description']);
                        $('#neighbourhood').val(value['neighbourhood']);
                        $('#coordInput').val(value['coordinates']);

                    });

                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });

            // Show the modal
            const dataModal = new bootstrap.Modal(document.getElementById('edit-item-modal'), {
                keyboard: false
            });
            dataModal.show();
        });
    });

    // tab switching
    // next button
    function switchTab(tabName) {
        // prevent submitting the form
        event.preventDefault();

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }
</script>