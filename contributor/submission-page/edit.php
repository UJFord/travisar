<!-- STYLE -->
<style>
    .modal-tab:hover {
        color: grey;
    }
</style>

<!-- EDIT MODAL -->
<div class="modal fade" id="edit-item-modal" tabindex="-1" aria-labelledby="edit-label" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-label"></h5>
                <button type="button" id="close-modal-btn-edit" class="btn-close" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel-edit" name="Form" action="crud-code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="py-3 px-5">
                <div class="modal-body edit-modal-body">
                    <!-- TAB LIST NAVIGATION -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active small-font modal-tab text-dark" id="edit-gen-tab" data-bs-toggle="tab" data-bs-target="#edit-gen-tab-pane" type="button" role="tab" aria-controls="edit-gen-tab-pane" aria-selected="false"><i class="fa-solid fa-lightbulb me-1"></i>General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="edit-more-tab" data-bs-toggle="tab" data-bs-target="#edit-more-tab-pane" type="button" role="tab" aria-controls="edit-more-tab-pane" aria-selected="true"><i class="fa-solid fa-leaf me-1"></i>Morphology</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="edit-sensory-tab" data-bs-toggle="tab" data-bs-target="#edit-sensory-tab-pane" type="button" role="tab" aria-controls="edit-sensory-tab-pane" aria-selected="true"><i class="fa-solid fa-utensils me-1"></i>Sensory</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="edit-agro-tab" data-bs-toggle="tab" data-bs-target="#edit-agro-tab-pane" type="button" role="tab" aria-controls="edit-agro-tab-pane" aria-selected="true"><i class="fa-solid fa-seedling me-1"></i>Agronomy</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="edit-cultural-tab" data-bs-toggle="tab" data-bs-target="#edit-cultural-tab-pane" type="button" role="tab" aria-controls="edit-cultural-tab-pane" aria-selected="false"><i class="fa-solid fa-sun me-1"></i>Importance</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="edit-references-tab" data-bs-toggle="tab" data-bs-target="#edit-references-tab-pane" type="button" role="tab" aria-controls="edit-references-tab-pane" aria-selected="false"><i class="fa-solid fa-book me-1"></i></i>References</button>
                        </li>
                    </ul>
                    <div class="container">
                        <div class="tab-content mt-2">
                            <input type="hidden" name="user_id" value="<?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) {
                                                                            echo $_SESSION['USER']['user_id'];
                                                                        } ?>">
                            <!-- general -->
                            <?php require "edit-tabs/gen.php" ?>
                            <!-- cultural -->
                            <?php require "edit-tabs/cultural.php"
                            ?>
                            <!-- more optional info -->
                            <?php require "edit-tabs/more.php"
                            ?>
                            <!-- agro info -->
                            <?php require "edit-tabs/agro.php"
                            ?>
                            <!-- sensory info -->
                            <?php require "edit-tabs/sensory.php"
                            ?>
                            <!-- references -->
                            <?php require "edit-tabs/references.php"
                            ?>
                            <!-- confirm -->
                            <?php require "edit-tabs/confirm.php" ?>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" id="deleteButton" class="btn btn-danger admin-only" data-id="delete">Delete</i></button>
                    <div class="">
                        <button type="button" id="cancel-modal-btn-edit" class="btn border bg-light">Cancel</button>
                        <?php
                        if (isset($_SESSION['rank']) && $_SESSION['rank'] === 'Admin' || $_SESSION['rank'] === 'Curator') {
                        ?>
                            <button type="submit" id="editButton" name="edit" class="btn btn-success">Save</button>
                        <?php
                        } else if (isset($_SESSION['rank']) && $_SESSION['rank'] === 'Contributor') {
                        ?>
                            <button type="submit" id="editButton" name="edit" class="btn btn-success">Submit</button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- SCRIPT for closing the modal -->
<script>
    // Function to set up event listeners for the modal
    function setupModalEventListenersEdit() {
        // Remove event listeners to prevent duplication
        document.getElementById('close-modal-btn-edit').removeEventListener('click', closeModalEdit);
        document.getElementById('cancel-modal-btn-edit').removeEventListener('click', closeModalEdit);
        document.getElementById('deleteButton').removeEventListener('click', deleteModalEdit);

        // Event listener for the close button
        document.getElementById('close-modal-btn-edit').addEventListener('click', closeModalEdit);

        // Event listener for the cancel button
        document.getElementById('cancel-modal-btn-edit').addEventListener('click', closeModalEdit);
        document.getElementById('deleteButton').addEventListener('click', deleteModalEdit);
    }
    // Global variable to store the modal instance
    var confirmModalInstanceEdit;

    // Custom function to close the modal
    function closeModalEdit() {
        // Get the modal element
        var confirmModal = document.getElementById('confirmModalEdit');

        // Create a new Bootstrap modal instance if it doesn't exist
        if (!confirmModalInstanceEdit) {
            confirmModalInstanceEdit = new bootstrap.Modal(confirmModal);
        }

        // Show the confirmation modal
        confirmModalInstanceEdit.show();
        $('input, textarea, select').prop('readonly', false);
        $('select').prop('disabled', false);
        $('input[type="file"]').prop('disabled', false);
        $('input[type="checkbox"]').prop('disabled', false);
        $('input[type="radio"]').prop('disabled', false);

        // to show which button should show on the confirm modal
        document.getElementById('confirmCloseBtnEdit').style.display = 'block';
        document.getElementById('confirmDeleteBtnEdit').style.display = 'none';
        // to show which label should show on the confirm modal
        document.getElementById('close-label').style.display = 'block';
        document.getElementById('delete-label').style.display = 'none';
    }

    // Event listener for the confirm button click
    document.getElementById('confirmCloseBtnEdit').addEventListener('click', function() {
        var confirmModal = document.getElementById('confirmModalEdit');
        var confirmModalInstanceEdit = bootstrap.Modal.getInstance(confirmModal);
        confirmModalInstanceEdit.hide();

        var editModal = document.getElementById('edit-item-modal');
        var editModalInstance = bootstrap.Modal.getInstance(editModal);
        editModalInstance.hide();

        // Remove the modal backdrop
        $('.modal-backdrop').remove();
    });

    function deleteModalEdit(event) {
        // Prevent the default behavior of the button (e.g., form submission)
        event.preventDefault();

        // Get the id of the button clicked
        var buttonId = event.target.getAttribute('data-id');

        // Get the modal element
        var confirmModal = document.getElementById('confirmModalEdit');

        // Create a new Bootstrap modal instance if it doesn't exist
        if (!confirmModalInstanceEdit) {
            confirmModalInstanceEdit = new bootstrap.Modal(confirmModal);
        }

        // Show the confirmation modal
        confirmModalInstanceEdit.show();

        // Pass the buttonId to the confirm modal
        document.getElementById('confirmModalEdit').setAttribute('data-id', buttonId);

        // to show which button should show on the confirm modal
        document.getElementById('confirmCloseBtnEdit').style.display = 'none';
        document.getElementById('confirmDeleteBtnEdit').style.display = 'block';
        // to show which label should show on the confirm modal
        document.getElementById('close-label').style.display = 'none';
        document.getElementById('delete-label').style.display = 'block';
    }
    // Event listener for when the modal is shown
    document.getElementById('edit-item-modal').addEventListener('shown.bs.modal', function() {
        setupModalEventListenersEdit();
    });

    // Event listener for when the confirmation modal is hidden
    document.getElementById('confirmModalEdit').addEventListener('hidden.bs.modal', function() {
        // Reset the confirmModalInstanceEdit
        confirmModalInstanceEdit = null;
    });
</script>

<!-- script for getting the data on the edit -->
<script>
    // EDIT SCRIPT
    const tableRows = document.querySelectorAll('.edit_data');
    // Define an array to store municipalities
    var municipalities = [];

    tableRows.forEach(row => {

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Use the crop_id as needed
            // console.log("Crop ID: " + id);

            // Assuming you have jQuery available
            $.ajax({
                url: 'fetch/fetch_crop-edit.php',
                type: 'POST',
                data: {
                    'click_edit_btn': true,
                    'crop_id': id,
                },
                success: function(response) {
                    // Handle the response from the PHP script
                    // console.log('Response:', response);

                    // Clear the current preview
                    $('#preview').empty();

                    $.each(response, function(key, value) {
                        // Append options to select element
                        console.log(value['corn_abiotic_other_desc']);
                        $('#previewSeedEdit').empty();
                        $('#previewVegEdit').empty();
                        $('#previewReproductiveEdit').empty();

                        if (value['action'] === 'Pending' || value['action'] === 'Updating' || value['action'] === 'Rejected') {
                            $('#edit-label').text("View");
                            $('#deleteButton').hide();
                            $('#editButton').hide();
                            $('#add-ref').hide();
                            $('input, textarea, select').prop('readonly', true);
                            $('select').prop('disabled', true); // For select elements, 'readonly' is not a valid property, so we use 'disabled'
                            $('input[type="file"]').prop('disabled', true); // Disable file input elements
                            $('input[type="checkbox"]').prop('disabled', true);
                            $('input[type="radio"]').prop('disabled', true);
                        } else {
                            $('#edit-label').text("Edit");
                            $('#editButton').show();
                            $('#add-ref').show();
                            $('input, textarea, select').prop('readonly', false);
                            $('select').prop('disabled', false); // For select elements, 'readonly' is not a valid property, so we use 'disabled'
                            $('input[type="file"]').prop('disabled', false); // Disable file input elements
                            $('input[type="checkbox"]').prop('disabled', false);
                            $('input[type="radio"]').prop('disabled', false);

                        }

                        // Fetch the old image and pass it to the fetchOldImage function
                        fetchOldImageSeed(value.crop_seed_image);
                        // Fetch the old image and pass it to the fetchOldImage function
                        fetchOldImageVeg(value.crop_vegetative_image);
                        // Fetch the old image and pass it to the fetchOldImage function
                        fetchOldImageRepro(value.crop_reproductive_image);

                        if (value['crop_seed_image'] != null && value['crop_seed_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesSeed = value['crop_seed_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesSeed.forEach(function(filename) {
                                $('#previewSeedEdit').append(`<img src="../crop-page/modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        if (value['crop_vegetative_image'] != null && value['crop_vegetative_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesVeg = value['crop_vegetative_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesVeg.forEach(function(filename) {
                                $('#previewVegEdit').append(`<img src="../crop-page/modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        if (value['crop_reproductive_image'] != null && value['crop_reproductive_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesRepro = value['crop_reproductive_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesRepro.forEach(function(filename) {
                                $('#previewReproductiveEdit').append(`<img src="../crop-page/modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        // setting the available data on the traits tab depending on the category of the selected crop
                        if (value['category_name'] === 'Corn') {
                            // Show the div for Corn
                            $('#cornMorph-Edit').show();
                            $('#cornAgro-Edit').show();
                            $('#withoutSensory-Edit').show();
                            $('#withoutSensory-Edit-More').show();
                            // Hide the divs for Rice and Root Crop
                            $('#riceMorph-Edit').hide();
                            $('#riceAgro-Edit').hide();
                            $('#root_cropMorph-Edit').hide();
                            $('#root_cropAgro-Edit').hide();
                            $('#edit-sensory-tab').hide();
                            $('#withSensory-Edit').hide();
                            $('#withSensory-Edit-More').hide();

                            // morph traits for corn
                            // vegetative state
                            if (value['corn_plant_height'] === null || value['corn_plant_height'] === '') {
                                $('#corn-heightEdit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#corn-heightEdit').append($('<option>', {
                                    value: value['corn_plant_height'],
                                    text: value['corn_plant_height'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['corn_leaf_width'] === null || value['corn_leaf_width'] === '') {
                                $('#corn-leafWidth-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#corn-leafWidth-Edit').append($('<option>', {
                                    value: value['corn_leaf_width'],
                                    text: value['corn_leaf_width'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['corn_leaf_length'] === null || value['corn_leaf_length'] === '') {
                                $('#corn-leafLength-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#corn-leafLength-Edit').append($('<option>', {
                                    value: value['corn_leaf_length'],
                                    text: value['corn_leaf_length'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['corn_yield_capacity'] === null || value['corn_yield_capacity'] === '') {
                                $('#corn-yield-capacity-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#corn-yield-capacity-Edit').append($('<option>', {
                                    value: value['corn_yield_capacity'],
                                    text: value['corn_yield_capacity'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            $('#corn-seed-length-Edit').val(value['seed_length']);
                            $('#corn-seed-width-Edit').val(value['seed_width']);
                            $('#corn-seed-shape-Edit').val(value['seed_shape']);
                            $('#corn-seed-color-Edit').val(value['seed_color']);

                            if (value['corn_pest_other']) {
                                $('#pest_other_checkEdit').prop('checked', true);
                                $('#pest-otherEdit').toggle(true);
                                $('#pestEdit').val(value['corn_pest_other_desc']);
                            } else {
                                $('#pest_other_checkEdit').prop('checked', false);
                                $('#pest-otherEdit').toggle(false);
                            }

                            if (value['corn_abiotic_other']) {
                                $('#abiotic_other_checkEdit').prop('checked', true);
                                $('#abiotic_otherEdit').toggle(true);
                                $('#abiotic_other-descEdit').val(value['corn_abiotic_other_desc']);
                            } else {
                                $('#abiotic_other_checkEdit').prop('checked', false);
                                $('#abiotic_otherEdit').toggle(false);
                            }
                        } else if (value['category_name'] === 'Rice') {
                            // Show the div for Rice
                            $('#riceMorph-Edit').show();
                            $('#riceAgro-Edit').show();
                            $('#edit-sensory-tab').show();
                            $('#withSensory-Edit').show();
                            $('#withSensory-Edit-More').show();
                            // Hide the divs for Corn and Root Crop
                            $('#cornMorph-Edit').hide();
                            $('#cornAgro-Edit').hide();
                            $('#root_cropMorph-Edit').hide();
                            $('#root_cropAgro-Edit').hide();
                            $('#withoutSensory-Edit').hide();
                            $('#withoutSensory-Edit-More').hide();

                            // morph traits for rice
                            // vegetative state
                            if (value['rice_plant_height'] === null || value['rice_plant_height'] === '') {
                                $('#rice-height-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#rice-height-Edit').append($('<option>', {
                                    value: value['rice_plant_height'],
                                    text: value['rice_plant_height'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['rice_leaf_width'] === null || value['rice_leaf_width'] === '') {
                                $('#leafWidth-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#leafWidth-Edit').append($('<option>', {
                                    value: value['rice_leaf_width'],
                                    text: value['rice_leaf_width'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['rice_leaf_length'] === null || value['rice_leaf_length'] === '') {
                                $('#leafLength-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#leafLength-Edit').append($('<option>', {
                                    value: value['rice_leaf_length'],
                                    text: value['rice_leaf_length'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['rice_tillering_ability'] === null || value['rice_tillering_ability'] === '') {
                                $('#tilleringAbility-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#tilleringAbility-Edit').append($('<option>', {
                                    value: value['rice_tillering_ability'],
                                    text: value['rice_tillering_ability'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['rice_maturity_time'] === null || value['rice_maturity_time'] === '') {
                                $('#rice-maturityTime-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#rice-maturityTime-Edit').append($('<option>', {
                                    value: value['rice_maturity_time'],
                                    text: value['rice_maturity_time'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['rice_yield_capacity'] === null || value['rice_yield_capacity'] === '') {
                                $('#rice-yield-capacity-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#rice-yield-capacity-Edit').append($('<option>', {
                                    value: value['rice_yield_capacity'],
                                    text: value['rice_yield_capacity'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            // panicle traits
                            $('#pan-length-Edit').val(value['panicle_length']);
                            $('#pan-width-Edit').val(value['panicle_width']);
                            $('#pan-enclosed-Edit').val(value['panicle_enclosed_by']);
                            $('#panicle-features-Edit').val(value['panicle_remarkable_features']);

                            // seed traits
                            $('#rice-seed-length-Edit').val(value['seed_length']);
                            $('#rice-seed-width-Edit').val(value['seed_width']);
                            $('#rice-seed-shape-Edit').val(value['seed_shape']);
                            $('#rice-seed-color-Edit').val(value['seed_color']);

                            // flag leaf traits
                            $('#flag-length-Edit').val(value['flag_length']);
                            $('#flag-width-Edit').val(value['flag_width']);
                            $('#Pubescence-Edit').val(value['pubescence']);
                            $('#flag-features-Edit').val(value['flag_remarkable_features']);
                            $('#purplishStripes-Edit').prop('checked', value['purplish_stripes']);

                            // sensory traits of cooked rice
                            $('#sensory-aroma-Edit').val(value['aroma']);
                            $('#cooked-rice-Edit').val(value['quality_cooked_rice']);
                            $('#leftover-rice-Edit').val(value['quality_leftover_rice']);
                            // volume expansion and Glutinous
                            // Set the checked property for volume_expansion
                            $('#volExpansionEdit').prop('checked',
                                value['volume_expansion'] === '1' ||
                                value['volume_expansion'] === true ||
                                value['volume_expansion'] === 't'
                            );

                            // Set the checked property for glutinous
                            $('#glutinousityEdit').prop('checked',
                                value['glutinous'] === '1' ||
                                value['glutinous'] === true ||
                                value['glutinous'] === 't'
                            );

                            // texture
                            if (value['texture'] === 'Soft') {
                                $('#hardness-Soft-Edit').prop('checked', true);
                            } else if (value['texture'] === 'Hard') {
                                $('#hardness-Hard-Edit').prop('checked', true);
                            }

                            if (value['rice_pest_other']) {
                                $('#pest_other_checkEdit').prop('checked', true);
                                $('#pest-otherEdit').toggle(true);
                                $('#pestEdit').val(value['rice_pest_other_desc']);
                            } else {
                                $('#pest_other_checkEdit').prop('checked', false);
                                $('#pest-otherEdit').toggle(false);
                            }

                            if (value['rice_abiotic_other']) {
                                $('#abiotic_other_checkEdit').prop('checked', true);
                                $('#abiotic_otherEdit').toggle(true);
                                $('#abiotic_other-descEdit').val(value['rice_abiotic_other_desc']);
                            } else {
                                $('#abiotic_other_checkEdit').prop('checked', false);
                                $('#abiotic_otherEdit').toggle(false);
                            }

                        } else if (value['category_name'] === 'Root Crop') {
                            // Show the div for Root Crop
                            $('#root_cropMorph-Edit').show();
                            $('#root_cropAgro-Edit').show();
                            $('#withoutSensory-Edit').show();
                            $('#withoutSensory-Edit-More').show();
                            // Hide the divs for Corn and Rice
                            $('#cornMorph-Edit').hide();
                            $('#cornAgro-Edit').hide();
                            $('#riceMorph-Edit').hide();
                            $('#riceAgro-Edit').hide();
                            $('#edit-sensory-tab').hide();
                            $('#withSensory-Edit').hide();
                            $('#withSensory-Edit-More').hide();

                            // morph traits for rootCrop
                            // vegetative state
                            if (value['rootcrop_plant_height'] === null || value['rootcrop_plant_height'] === '') {
                                $('#rootCrop-height-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#rootCrop-height-Edit').append($('<option>', {
                                    value: value['rootcrop_plant_height'],
                                    text: value['rootcrop_plant_height'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['rootcrop_leaf_width'] === null || value['rootcrop_leaf_width'] === '') {
                                $('#rootCrop-leafWidth-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#rootCrop-leafWidth-Edit').append($('<option>', {
                                    value: value['rootcrop_leaf_width'],
                                    text: value['rootcrop_leaf_width'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            if (value['rootcrop_leaf_length'] === null || value['rootcrop_leaf_length'] === '') {
                                $('#rootCrop-leafLength-Edit').append($('<option>', {
                                    value: '',
                                    text: 'Select an option',
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            } else {
                                $('#rootCrop-leafLength-Edit').append($('<option>', {
                                    value: value['rootcrop_leaf_length'],
                                    text: value['rootcrop_leaf_length'],
                                    selected: true,
                                    style: 'display: none;'
                                }));
                            }

                            $('#rootCrop-steam-leaf-desc-Edit').val(value['rootcrop_stem_leaf_desc']);

                            // Reproductive state rootCrop
                            // Root Crop traits
                            $('#rootCrop-eating-quality-Edit').val(value['eating_quality']);
                            $('#rootCrop-color-Edit').val(value['rootcrop_color']);
                            $('#rootCrop-sweetness-Edit').val(value['sweetness']);
                            $('#rootCrop-remarkableFeatures-Edit').val(value['rootcrop_remarkable_features']);

                            if (value['rootcrop_pest_other']) {
                                $('#pest_other_checkEdit').prop('checked', true);
                                $('#pest-otherEdit').toggle(true);
                                $('#pestEdit').val(value['rootcrop_pest_other_desc']);
                            } else {
                                $('#pest_other_checkEdit').prop('checked', false);
                                $('#pest-otherEdit').toggle(false);
                            }

                            if (value['rootcrop_abiotic_other']) {
                                $('#abiotic_other_checkEdit').prop('checked', true);
                                $('#abiotic_otherEdit').toggle(true);
                                $('#abiotic_other-descEdit').val(value['rootcrop_abiotic_other_desc']);
                            } else {
                                $('#abiotic_other_checkEdit').prop('checked', false);
                                $('#abiotic_otherEdit').toggle(false);
                            }
                        } else {
                            // Default case, hide all divs
                            $('#cornMorph-Edit').hide();
                            $('#riceMorph-Edit').hide();
                            $('#root_cropMorph-Edit').hide();
                        }

                        // pest resistances
                        if (value['pest_resistances']) {
                            var pestIds = value['pest_resistances'].replace('{', '').replace('}', '').split(',').map(Number).filter(Boolean); // Remove curly braces, convert string to array of numbers, and remove NaN and falsy values
                            pestIds.forEach(function(pest_id) {
                                $('#pest_resistance_Edit' + pest_id).prop('checked', true);
                            });
                            //console.log(pestIds);
                        }

                        // disease resistance
                        if (value['disease_resistances']) {
                            var diseaseIds = value['disease_resistances'].replace('{', '').replace('}', '').split(',').map(Number).filter(Boolean); // Remove curly braces, convert string to array of numbers, and remove NaN and falsy values
                            diseaseIds.forEach(function(disease_id) {
                                $('#disease_resistance_Edit' + disease_id).prop('checked', true);
                            });
                            //console.log(diseaseIds);
                        }

                        // abiotic resistance
                        if (value['abiotic_resistances']) {
                            var abioticIds = value['abiotic_resistances'].replace('{', '').replace('}', '').split(',').map(Number).filter(Boolean); // Remove curly braces, convert string to array of numbers, and remove NaN and falsy values
                            abioticIds.forEach(function(abiotic_id) {
                                $('#abiotic_resistance_Edit' + abiotic_id).prop('checked', true);
                            });
                            //console.log(abioticIds);
                        }

                        // crop_id
                        $('#status_action').val(value['action']);
                        $('#crop_id').val(id);
                        // statusID
                        $('#statusID').val(value['status_id']);
                        // referencesID
                        $('#referencesID').val(value['references_id']);
                        // categoryID
                        $('#categoryID').val(value['category_id']);
                        // terrainID
                        $('#terrainID').val(value['terrain_id']);
                        // category_varietyID
                        $('#category_varietyID').val(value['category_variety_id']);
                        // unique_codeID
                        $('#unique_codeID').val(value['unique_code']);
                        // current_crop_variety
                        $('#current_crop_variety').val(value['crop_variety']);
                        // currentUniqueCode
                        $('#currentUniqueCode').val(value['unique_code']);
                        // crop_location_id
                        $('#crop_location_id').val(value['crop_location_id']);
                        // terrain name
                        $('#categoryTerrainEdit').text(value['terrain_name']);
                        // characteristics_id
                        $('#Char_id').val(value['characteristics_id']);
                        // cultural_aspect_id
                        $('#cultural_aspect-Edit').val(value['cultural_aspect_id']);
                        // disease_resistanceID
                        $('#disease_resistanceID').val(value['disease_resistance_id']);
                        // seed_traitsID
                        $('#seed_traitsID').val(value['seed_traits_id']);
                        // utilization_culturalID
                        $('#utilization_culturalID').val(value['utilization_cultural_id']);
                        // abiotic_resistanceID and abiotic_resistance_riceID
                        $('#abiotic_resistanceID').val(value['abiotic_resistance_id']);
                        $('#abiotic_resistance_riceID').val(value['abiotic_resistance_rice_id']);

                        // id for corn
                        $('#corn_traitsID').val(value['corn_traits_id']);
                        $('#vegetative_state_cornID').val(value['vegetative_state_corn_id']);
                        $('#reproductive_state_cornID').val(value['reproductive_state_corn_id']);
                        $('#pest_resistance_cornID').val(value['pest_resistance_corn_id']);
                        $('#corn_pest_otherID').val(value['corn_pest_other_id']);
                        $('#corn_abiotic_otherID').val(value['corn_abiotic_other_id']);

                        // id for rice
                        $('#rice_traitsID').val(value['rice_traits_id']);
                        $('#pest_resistance_riceID').val(value['pest_resistance_rice_id']);
                        $('#vegetative_state_riceID').val(value['vegetative_state_rice_id']);
                        $('#reproductive_state_riceID').val(value['reproductive_state_rice_id']);
                        $('#panicle_traits_riceID').val(value['panicle_traits_rice_id']);
                        $('#flag_leaf_traits_riceID').val(value['flag_leaf_traits_rice_id']);
                        $('#sensory_traits_riceID').val(value['sensory_traits_rice_id']);
                        $('#rice_pest_otherID').val(value['rice_pest_other_id']);
                        $('#rice_abiotic_otherID').val(value['rice_abiotic_other_id']);

                        // id for root crop
                        $('#root_crop_traitsID').val(value['root_crop_traits_id']);
                        $('#vegetative_state_rootcropID').val(value['vegetative_state_rootcrop_id']);
                        $('#pest_resistance_rootcropID').val(value['pest_resistance_rootcrop_id']);
                        $('#rootcrop_traitsID').val(value['rootcrop_traits_id']);
                        $('#corn_pest_otherID').val(value['corn_pest_other_id']);
                        $('#rootcrop_pest_otherID').val(value['rootcrop_pest_other_id']);
                        $('#rootcrop_abiotic_otherID').val(value['rootcrop_abiotic_other_id']);

                        // old image/current image
                        $('#old_image_seed').val(value['crop_seed_image']);
                        $('#old_image_veg').val(value['crop_vegetative_image']);
                        $('#old_image_rep').val(value['crop_reproductive_image']);
                        // Format the input_date
                        $('#input_dateEdit').text(moment(value['input_date']).format('YYYY-MM-DD HH:mm'));

                        $('#CategoryEdit').text(value['category_name']);
                        $('#categoryVarietyEdit').text(value['category_variety_name']);
                        $('#firstName').text(value['first_name']);
                        $('#uniqueCode').text(value['unique_code']);

                        // example ni sya kung gusto nimo i dikit ang duwa ka value
                        // $('#crop_variety').val(value['unique_code'] + '(' + value['crop_variety'] + ') ');

                        $('#crop_variety').val(value['crop_variety']);
                        $('#ScienceName').val(value['scientific_name']);
                        $('#LocalName').val(value['crop_local_name']);
                        $('#NameOrigin').val(value['name_origin']);
                        $('#description').val(value['crop_description']);
                        $('#nameMeaning').val(value['meaning_of_name']);
                        $('#rarityEdit').text(value['rarity']);

                        // Utilization and Cultural Importance
                        $('#SignificanceEdit').val(value['significance']);
                        $('#UseEdit').val(value['use']);
                        $('#indigenous-utilization-Edit').val(value['indigenous_utilization']);
                        $('#remarkable-features-Edit').val(value['remarkable_features']);

                        // References
                        let referenceNumber = 1; // Initialize reference number
                        if (value['link'] != null && value['link'] != '') {

                            // Split the reference link by comma
                            var referLinks = value['link'].split(',');
                            // Iterate over each filename and append a link element to the preview container
                            referLinks.forEach(function(filename) {
                                // Check if the URL is absolute
                                if (!/^https?:\/\//i.test(filename)) {
                                    // If not, prepend "http://"
                                    filename = "http://" + filename;
                                }
                                $('#new-url-container-Edit').append(`
                                    <div class="url-list-item-edit mb-2">
                                        <label class="form-label small-font">Old Reference ${referenceNumber}</label>
                                        <div class="d-flex">
                                            <input type="text" name="old_references_${referenceNumber}" value="${filename}" class="form-control small-font readonly">
                                            <button type="button" class="btn btn-link">
                                                <i class="fa-solid fa-circle-minus fs-5 text-danger" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                `);
                                referenceNumber++; // Increment reference number for the next input field
                            });
                        }

                        //loc.php
                        $('#SitioEdit').val(value['sitio_name']);
                        // coordInput
                        $('#coordEdit').val(value['coordinates']);
                        // Update the select data of loc.php locations
                        $('#crop_variety_select').append($('<option>', {
                            value: value['crop_variety'],
                            text: value['crop_variety'],
                            selected: true, // Make the option selected
                            style: 'display: none;' // Hide the option
                        }));

                        $('#BarangaySelect').append($('<option>', {
                            value: value['barangay_id'],
                            text: value['barangay_name'],
                            selected: true,
                            style: 'display: none;'
                        }));
                        $('#MunicipalitySelect').append($('<option>', {
                            value: value['municipality_id'],
                            text: value['municipality_name'],
                            selected: true,
                            style: 'display: none;'
                        }));

                        // // Ensure municipalitiesID array is defined
                        // var municipalitiesID = [];
                        // var municipalitiesName = [];

                        // // Add municipality to the array
                        // municipalitiesID.push(value['municipality_id']);
                        // municipalitiesName.push(value['municipality_name']);

                        // // Save the selected municipality ID
                        // var selectedMunicipalityID = value['municipality_id'];

                        // // Append options to MunicipalitySelect
                        // $('#MunicipalitySelect').empty(); // Clear previous options
                        // municipalitiesID.forEach(function(municipalityID, index) {
                        //     var selected = (municipalityID === selectedMunicipalityID) ? 'selected' : '';
                        //     $('#MunicipalitySelect').append('<option value="' + municipalityID + '" ' + selected + '>' + municipalitiesName[index] + '</option>');
                        // });

                        // Add a marker to the map based on the coordinates if they exist
                        if (value['coordinates']) {
                            var coordinates = value['coordinates'].split(',');
                            var lat = parseFloat(coordinates[0]);
                            var lng = parseFloat(coordinates[1]);

                            if (!isNaN(lat) && !isNaN(lng)) {
                                var markerEdit = L.marker([lat, lng]).addTo(mapEdit);
                            } else {
                                // console.error('Invalid coordinates or no coordinates available');
                            }
                        }
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

    $(document).ready(function() {
        // Initialize the modal
        const dataModal = new bootstrap.Modal(document.getElementById('edit-item-modal'), {
            keyboard: false
        });

        // Show the modal when a table row is clicked
        tableRows.forEach(row => {
            row.addEventListener('click', () => {
                // Your existing code to populate the modal here

                // Show the modal
                dataModal.show();
            });
        });
    });
</script>

<!-- script for submitting data -->
<script>
    var firstErrorElementEdit = null;
    var currentTabEdit = 'edit-gen';
    var seedImageEdit = document.getElementById('imageInputSeedEdit');
    var vegImageEdit = document.getElementById('imageInputVegetativeEdit');
    var reproImageEdit = document.getElementById('imageInputReproductiveEdit');

    // Function to validate input
    function validateFormEdit(event) {
        var cropVariety = document.getElementById("crop_variety").value
        var province = document.getElementById("ProvinceEdit").value
        var municipality = document.getElementById("MunicipalitySelect").value
        var barangay = document.getElementById("BarangaySelect").value

        var isValidEdit = true;

        // Check if the required fields are not empty
        if (cropVariety === "" || cropVariety === null) {
            document.getElementById('crop_variety').classList.add('is-invalid');
            document.getElementById('varietyName-error-edit').innerText = "Please enter a variety name.";
            isValidEdit = false;
            if (!firstErrorElementEdit) {
                firstErrorElementEdit = document.getElementById('crop_variety');
            }
        } else {
            document.getElementById('crop_variety').classList.remove('is-invalid');
            document.getElementById('varietyName-error-edit').innerText = "";
        }

        if (province === null || province === "") {
            document.getElementById('ProvinceEdit').classList.add('is-invalid');
            document.getElementById('province-error-edit').innerText = "Please enter a province name.";
            isValidEdit = false;
            if (!firstErrorElementEdit) {
                firstErrorElementEdit = document.getElementById('ProvinceEdit');
            }
        } else {
            document.getElementById('ProvinceEdit').classList.remove('is-invalid');
            document.getElementById('province-error-edit').innerText = "";
        }

        if (municipality === null || municipality === "") {
            document.getElementById('MunicipalitySelect').classList.add('is-invalid');
            document.getElementById('municipality-error-edit').innerText = "Please enter a municipality name.";
            isValidEdit = false;
            if (!firstErrorElementEdit) {
                firstErrorElementEdit = document.getElementById('MunicipalitySelect');
            }
        } else {
            document.getElementById('MunicipalitySelect').classList.remove('is-invalid');
            document.getElementById('municipality-error-edit').innerText = "";
        }

        if (barangay === null || barangay === "") {
            document.getElementById('BarangaySelect').classList.add('is-invalid');
            document.getElementById('barangay-error-edit').innerText = "Please enter a barangay name.";
            isValidEdit = false;
            if (!firstErrorElementEdit) {
                firstErrorElementEdit = document.getElementById('BarangaySelect');
            }
        } else {
            document.getElementById('BarangaySelect').classList.remove('is-invalid');
            document.getElementById('barangay-error-edit').innerText = "";
        }

        // Check if the image size exceeds the limit (5MB) for the seed image
        if (seedImageEdit.files.length > 0) {
            var isValidImageSeedEdit = validateImagesSeedEdit();
            if (!isValidImageSeedEdit) {
                isValidEdit = false;
                firstErrorElementEdit = document.getElementById('imageInputSeedEdit');
            }
        }

        // Check if the image size exceeds the limit (5MB) for the seed image
        if (vegImageEdit.files.length > 0) {
            var isValidImageVegEdit = validateImagesVegEdit();
            if (!isValidImageVegEdit) {
                isValidEdit = false;
                firstErrorElementEdit = document.getElementById('imageInputVegetativeEdit');
            }
        }

        // Check if the image size exceeds the limit (5MB) for the seed image
        if (reproImageEdit.files.length > 0) {
            var isValidImageReproEdit = validateImagesReproEdit();
            if (!isValidImageReproEdit) {
                isValidEdit = false;
                firstErrorElementEdit = document.getElementById('imageInputReproductiveEdit');
            }
        }

        // Focus on the first element with an error
        if (firstErrorElementEdit) {
            firstErrorElementEdit.focus();
            event.preventDefault(); // Prevent the form from submitting by default
            // Switch back to the tab with the error
            switchTabEdit(currentTabEdit);
        }

        return isValidEdit;
    }


    // Validation function
    function validateImagesSeedEdit() {
        var isValidEdit = true;
        var inputElementSeedEdit = document.getElementById('imageInputSeedEdit');
        var files = inputElementSeedEdit.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.size > 5 * 1024 * 1024) {
                inputElementSeedEdit.classList.add('is-invalid');
                document.getElementById('imageInputSeedEdit-error-edit').innerText = "Image must not exceed 5MB.";
                isValidEdit = false;
                if (!firstErrorElementEdit) {
                    firstErrorElementEdit = document.getElementById('imageInputSeedEdit');
                }
            }
        }

        if (isValidEdit) {
            inputElementSeedEdit.classList.remove('is-invalid');
            document.getElementById('imageInputSeedEdit-error-edit').innerText = "";
        }

        return isValidEdit;
    }

    function validateImagesVegEdit() {
        var isValidEdit = true;
        var inputElementVegEdit = document.getElementById('imageInputVegetativeEdit');
        var files = inputElementVegEdit.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.size > 5 * 1024 * 1024) {
                inputElementVegEdit.classList.add('is-invalid');
                document.getElementById('imageInputVegetativeEdit-error-edit').innerText = "Image must not exceed 5MB.";
                isValidEdit = false;
                if (!firstErrorElementEdit) {
                    firstErrorElementEdit = document.getElementById('imageInputVegetativeEdit');
                }
            }
        }

        if (isValidEdit) {
            inputElementVegEdit.classList.remove('is-invalid');
            document.getElementById('imageInputVegetativeEdit-error-edit').innerText = "";
        }

        return isValidEdit;
    }

    function validateImagesReproEdit() {
        var isValidEdit = true;
        var inputElementReproEdit = document.getElementById('imageInputReproductiveEdit');
        var files = inputElementReproEdit.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.size > 5 * 1024 * 1024) {
                inputElementReproEdit.classList.add('is-invalid');
                document.getElementById('imageInputReproductiveEdit-error-edit').innerText = "Image must not exceed 5MB.";
                isValidEdit = false;
                if (!firstErrorElementEdit) {
                    firstErrorElementEdit = document.getElementById('imageInputReproductiveEdit');
                }
            }
        }

        if (isValidEdit) {
            inputElementReproEdit.classList.remove('is-invalid');
            document.getElementById('imageInputReproductiveEdit-error-edit').innerText = "";
        }

        return isValidEdit;
    }

    document.getElementById('form-panel-edit').addEventListener('submit', function(event) {
        // Reset the first error element before validation
        firstErrorElementEdit = null;

        // Get the selected category
        var selectedCategoryEdit = document.getElementById('categoryID').value;
        var cornMorphEdit = document.getElementById('cornMorph-Edit');
        var riceMorphEdit = document.getElementById('riceMorph-Edit');
        var rootCropMorphEdit = document.getElementById('root_cropMorph-Edit');

        // Disable inputs based on the selected category
        if (selectedCategoryEdit !== '4') {
            disableInputs(cornMorphEdit);
        }

        if (selectedCategoryEdit !== '1') {
            disableInputs(riceMorphEdit);
        }

        if (selectedCategoryEdit !== '2') {
            disableInputs(rootCropMorphEdit);
        }
        if (validateFormEdit(event)) {
            // If validation succeeds, submit the form
            submitFormEdit();
        }
    });

    // Function to submit the form and refresh notifications
    function submitFormEdit() {
        //console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel-edit');
        // Trigger the form submission
        if (form) {
            if (validateFormEdit()) { // Validate the form
                // Perform AJAX submission or other necessary actions
                $.ajax({
                    url: "crud-code/code.php",
                    method: "POST",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log("Form Edit submitted successfully", data);
                        // Reset the form
                        form.reset();
                        location.reload();
                        // Reload unseen notifications
                        //load_unseen_notification();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Form submission error:", textStatus, errorThrown);
                        // Handle error if needed
                    }
                });
            } else {
                // Form validation failed, do not submit
                console.log("Form validation failed, submission aborted.");
            }
        }
    }

    // tab switching
    // next button
    function switchTabEdit(tabName) {
        // prevent submitting the form
        event.preventDefault();
        // Set the currentTabEdit to the tabName
        currentTabEdit = tabName;

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }
</script>