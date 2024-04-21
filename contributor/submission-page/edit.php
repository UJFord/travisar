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
            <form id="form-panel-edit" name="Form" action="submission-page/code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="py-3 px-5">
                <div class="modal-body edit-modal-body">
                    <!-- TAB LIST NAVIGATION -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active small-font modal-tab" id="edit-gen-tab" data-bs-toggle="tab" data-bs-target="#edit-gen-tab-pane" type="button" role="tab" aria-controls="edit-gen-tab-pane" aria-selected="false"><i class="fa-solid fa-lightbulb me-1"></i>General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="edit-more-tab" data-bs-toggle="tab" data-bs-target="#edit-more-tab-pane" type="button" role="tab" aria-controls="edit-more-tab-pane" aria-selected="true"><i class="fa-solid fa-leaf me-1"></i>Morphology</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="edit-sensory-tab" data-bs-toggle="tab" data-bs-target="#edit-sensory-tab-pane" type="button" role="tab" aria-controls="edit-sensory-tab-pane" aria-selected="true"><i class="fa-solid fa-utensils me-1"></i>Sensory</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="edit-agro-tab" data-bs-toggle="tab" data-bs-target="#edit-agro-tab-pane" type="button" role="tab" aria-controls="edit-agro-tab-pane" aria-selected="true"><i class="fa-solid fa-seedling me-1"></i>Agronomy</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="edit-cultural-tab" data-bs-toggle="tab" data-bs-target="#edit-cultural-tab-pane" type="button" role="tab" aria-controls="edit-cultural-tab-pane" aria-selected="false"><i class="fa-solid fa-sun me-1"></i>Importance</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="edit-references-tab" data-bs-toggle="tab" data-bs-target="#edit-references-tab-pane" type="button" role="tab" aria-controls="edit-references-tab-pane" aria-selected="false"><i class="fa-solid fa-book me-1"></i></i>References</button>
                        </li>
                    </ul>
                    <div class="container">
                        <div class="tab-content mt-2">
                            <!-- general -->
                            <?php require "submission-page/tabs/gen.php" ?>
                            <!-- cultural -->
                            <?php require "submission-page/tabs/cultural.php" ?>
                            <!-- more optional info -->
                            <?php require "submission-page/tabs/more.php" ?>
                            <!-- agro info -->
                            <?php require "submission-page/tabs/agro.php" ?>
                            <!-- sensory info -->
                            <?php require "submission-page/tabs/sensory.php" ?>
                            <!-- references -->
                            <?php require "submission-page/tabs/references.php" ?>
                            <!-- confirm -->
                            <?php require "submission-page/tabs/confirm.php" ?>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" id="deleteButton" class="btn btn-danger" data-id="delete">Delete</i></button>
                    <div class="">
                        <button type="button" id="cancel-modal-btn-edit" class="btn border bg-light">Cancel</button>
                        <button type="submit" id="editButton" name="update" class="btn btn-success">Save</button>
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

<!-- script for getting the on the edit -->
<script>
    document.getElementById('form-panel-edit').addEventListener('submit', function(event) {

        // Get the selected category
        var selectedCategory = document.getElementById('categoryID').value;
        var cornMorph = document.getElementById('cornMorph-Edit');
        var riceMorph = document.getElementById('riceMorph-Edit');
        var rootCropMorph = document.getElementById('root_cropMorph-Edit');

        // Form is valid, submit the form
        submitForm();
    });

    // Function to submit the form and refresh notifications
    function submitForm() {
        console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel-edit');
        // Trigger the form submission
        if (form) {
            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "submission-page/code/code.php",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log("Form submitted successfully", data);
                    // Reset the form
                    form.reset();
                    // Reload unseen notifications
                    load_unseen_notification();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Form submission error:", textStatus, errorThrown);
                    // Handle error if needed
                }
            });
        }
    }

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
                url: 'submission-page/fetch/fetch_crop-edit.php',
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
                        console.log(value['action']);

                        // set modal name depending if it is draft or edit
                        if (value['action'] === 'draft') {
                            $('#edit-label').text('Draft');
                            $('#draftButton').show();
                            $('#editButton').hide();
                        } else {
                            $('#edit-label').text('Edit');
                            $('#editButton').show();
                            $('#draftButton').hide();
                        }

                        // Fetch the old image and pass it to the fetchOldImage function
                        fetchOldImage(value.crop_seed_image);

                        if (value['crop_seed_image'] != null && value['crop_seed_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesSeed = value['crop_seed_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesSeed.forEach(function(filename) {
                                $('#previewSeedEdit').append(`<img src="crop-page/modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        if (value['crop_vegetative_image'] != null && value['crop_vegetative_image'] != '') {
                            $('#previewVegEdit').append(`<img src="crop-page/modals/img/${value['crop_vegetative_image']}" class="m-2 img-thumbnail" style="height: 200px;">`);
                        }

                        if (value['crop_reproductive_image'] != null && value['crop_reproductive_image'] != '') {
                            $('#previewReproductiveEdit').append(`<img src="crop-page/modals/img/${value['crop_reproductive_image']}" class="m-2 img-thumbnail" style="height: 200px;">`);
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
                            $('#riceMorph-Edit :input').prop('disabled', true);
                            $('#root_cropMorph-Edit :input').prop('disabled', true);

                            // morph traits for corn
                            // vegetative state
                            $('#corn-heightEdit').append($('<option>', {
                                value: value['corn_plant_height']
                            }));
                            $('#corn-leafWidth-Edit').append($('<option>', {
                                value: value['corn_leaf_width']
                            }));
                            $('#corn-leafLength-Edit').append($('<option>', {
                                value: value['corn_leaf_length']
                            }));

                            // Reproductive state corn
                            $('#corn-yield-capacity-Edit').val(value['corn_yield_capacity']);
                            $('#corn-seed-length-Edit').val(value['seed_length']);
                            $('#corn-seed-width-Edit').val(value['seed_width']);
                            $('#corn-seed-shape-Edit').val(value['seed_shape']);
                            $('#corn-seed-color-Edit').val(value['seed_color']);

                            // pest resistance corn
                            $('#cornBorers-Edit').prop('checked', value['corn_borers'] == 1);
                            $('#Earworm-Edit').prop('checked', value['earworms'] == 1);
                            $('#spider-mites-Edit').prop('checked', value['spider_mites'] == 1);
                            $('#corn-blackBug-Edit').prop('checked', value['corn_black_bug'] == 1);
                            $('#corn-army-worms-Edit').prop('checked', value['corn_army_worms'] == 1);
                            $('#leaf-aphid-Edit').prop('checked', value['leaf_aphid'] == 1);
                            $('#corn-cutWorms-Edit').prop('checked', value['corn_cutworms'] == 1);
                            $('#rice-Birds-Edit').prop('checked', value['corn_birds'] == 1);
                            $('#corn-ants-Edit').prop('checked', value['corn_ants'] == 1);
                            $('#corn-rats-Edit').prop('checked', value['corn_rats'] == 1);
                            $('#corn-other-check-Edit').prop('checked', value['corn_others'] == 1);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#corn-other-check-Edit').prop('checked')) {
                                $('.corn-pest-other-edit').show();
                            } else {
                                $('.corn-pest-other-edit').hide();
                            }
                            // Set the value of the 'Other' textarea
                            $('#corn-other-Edit').val(value['corn_others_desc']);

                            // disease resistance corn
                            $('#corn-Bacterial-Edit').prop('checked', value['bacterial'] == 1);
                            $('#corn-Fungus-Edit').prop('checked', value['fungus'] == 1);
                            $('#corn-Viral-Edit').prop('checked', value['viral'] == 1);

                            // abiotic resistance resistance corn
                            $('#corn-Drought-Edit').prop('checked', value['drought'] == 1);
                            $('#corn-Salinity-Edit').prop('checked', value['salinity'] == 1);
                            $('#corn-Heat-Edit').prop('checked', value['heat'] == 1);
                            $('#corn-abiotic-other-check-Edit').prop('checked', value['abiotic_other'] == 1);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            // baliktad ang if else statement kay katok ang code ambot nganuman
                            if ($('#corn-abiotic-other-check-Edit').prop('checked')) {
                                $('.corn-abiotic-other').show();
                            } else {
                                $('.corn-abiotic-other').hide();
                            }
                            // Set the value of the 'Other' textarea
                            $('#corn-abiotic-other-Edit').val(value['abiotic_other_desc']);
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
                            $('#cornMorph-Edit :input').prop('disabled', true);
                            $('#root_cropMorph-Edit :input').prop('disabled', true);

                            // morph traits for rice
                            // vegetative state
                            if (value['rice_plant_height'] === 'Tall') {
                                $('#height-tall-Edit').prop('checked', true);
                            } else if (value['rice_plant_height'] === 'Average') {
                                $('#height-average-Edit').prop('checked', true);
                            } else if (value['rice_plant_height'] === 'Short') {
                                $('#height-short-Edit').prop('checked', true);
                            }
                            $('#leafWidth-Edit').append($('<option>', {
                                value: value['rice_leaf_width'],
                            }));
                            $('#leafLength-Edit').append($('<option>', {
                                value: value['rice_leaf_length']
                            }));
                            $('#tilleringAbility-Edit').append($('<option>', {
                                value: value['rice_tillering_ability']
                            }));
                            $('#rice-maturityTime-Edit').append($('<option>', {
                                value: value['rice_maturity_time']
                            }));

                            // Reproductive state rice
                            $('#rice-yield-capacity-Edit').val(value['rice_yield_capacity']);
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
                            $('#volExpansionEdit').prop('checked', value['volume_expansion']);
                            $('#glutinousityEdit').prop('checked', value['glutinous']);
                            // hardness
                            if (value['hardness'] === 'Soft') {
                                $('#hardness-Soft-Edit').prop('checked', true);
                            } else if (value['hardness'] === 'Hard') {
                                $('#hardness-Hard-Edit').prop('checked', true);
                            }

                            // pest resistance rice
                            $('#riceBorers-Edit').prop('checked', value['rice_borers'] == 1);
                            $('#riceSnail-Edit').prop('checked', value['rice_snail'] == 1);
                            $('#Hoppers-Edit').prop('checked', value['hoppers'] == 1);
                            $('#rice-blackBug-Edit').prop('checked', value['rice_black_bug'] == 1);
                            $('#Leptocorisa-Edit').prop('checked', value['leptocorisa'] == 1);
                            $('#leaf-folder-Edit').prop('checked', value['leaf_folder'] == 1);
                            $('#rice-birds-Edit').prop('checked', value['rice_birds'] == 1);
                            $('#rice-ants-Edit').prop('checked', value['rice_ants'] == 1);
                            $('#rice-rats-Edit').prop('checked', value['rice_rats'] == 1);
                            $('#rice-armyWorms-Edit').prop('checked', value['rice_army_worms'] == 1);
                            $('#rice-other-check-Edit').prop('checked', value['rice_others'] == 1);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#rice-other-check-Edit').prop('checked')) {
                                $('.rice-pest-other-edit').show();
                            } else {
                                $('.rice-pest-other-edit').hide();
                            }
                            // Set the value of the 'Other' textarea
                            $('#rice-other-Edit').val(value['rice_others_desc']);

                            // disease resistance rice
                            $('#rice-Bacterial-Edit').prop('checked', value['bacterial'] == 1);
                            $('#rice-Fungus-Edit').prop('checked', value['fungus'] == 1);
                            $('#rice-Viral-Edit').prop('checked', value['viral'] == 1);

                            // abiotic resistance resistance rice
                            $('#riceDrought-Edit').prop('checked', value['rice_drought'] == 1);
                            $('#riceSalinity-Edit').prop('checked', value['rice_salinity'] == 1);
                            $('#riceHeat-Edit').prop('checked', value['rice_heat'] == 1);
                            $('#harmful-radiation-Edit').prop('checked', value['harmful_radiation'] == 1);
                            $('#rice-abiotic-other-check-Edit').prop('checked', value['rice_abiotic_other'] == 1);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            // baliktad ang if else statement kay katok ang code ambot nganuman
                            if ($('#rice-abiotic-other-check-Edit').prop('checked')) {
                                $('.rice-abiotic-other').show();
                            } else {
                                $('.rice-abiotic-other').hide();
                            }
                            // Set the value of the 'Other' textarea
                            $('#rice-abiotic-other-desc-Edit').val(value['rice_abiotic_other_desc']);
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
                            $('#riceMorph-Edit :input').prop('disabled', true);
                            $('#cornMorph-Edit :input').prop('disabled', true);

                            // morph traits for rootCrop
                            // vegetative state
                            if (value['rootcrop_plant_height'] === 'Tall') {
                                $('#rootCrop-height-tall-edit').prop('checked', true);
                            } else if (value['rootcrop_plant_height'] === 'Average') {
                                $('#rootCrop-height-average-edit').prop('checked', true);
                            } else if (value['rootcrop_plant_height'] === 'Short') {
                                $('#rootCrop-height-short-edit').prop('checked', true);
                            }
                            $('#rootCrop-leafWidth-Edit').append($('<option>', {
                                value: value['rootcrop_leaf_width']
                            }));
                            $('#rootCrop-leafLength-Edit').append($('<option>', {
                                value: value['rootcrop_leaf_length']
                            }));
                            $('#rootCrop-steam-leaf-desc-Edit').val(value['rootcrop_stem_leaf_desc']);

                            // Reproductive state rootCrop
                            // Root Crop traits
                            $('#rootCrop-eating-quality-Edit').val(value['eating_quality']);
                            $('#rootCrop-color-Edit').val(value['rootcrop_color']);
                            $('#rootCrop-sweetness-Edit').val(value['sweetness']);
                            $('#rootCrop-remarkableFeatures-Edit').val(value['rootcrop_remarkable_features']);

                            // pest resistance rootCrop
                            $('#rootAphids-Edit').prop('checked', value['root_aphids'] == 1);
                            $('#root-knot-nematodes-Edit').prop('checked', value['root_knot_nematodes'] == 1);
                            $('#rootCrop-cutworms-Edit').prop('checked', value['rootcrop_cutworms'] == 1);
                            $('#rootCrop-whiteGRubs-Edit').prop('checked', value['white_grubs'] == 1);
                            $('#Termites-Edit').prop('checked', value['termites'] == 1);
                            $('#Weevils-Edit').prop('checked', value['weevils'] == 1);
                            $('#flea-beetles-Edit').prop('checked', value['flea_beetles'] == 1);
                            $('#rootCrop-snails-Edit').prop('checked', value['rootcrop_snails'] == 1);
                            $('#rootCrop-ants-Edit').prop('checked', value['rootcrop_ants'] == 1);
                            $('#rootCrop-rats-Edit').prop('checked', value['rootcrop_rats'] == 1);
                            $('#rootCrop-other-check-Edit').prop('checked', value['rootcrop_others'] == 1);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#rootCrop-other-check-Edit').prop('checked')) {
                                $('.rootCrop-other').show();
                            } else {
                                $('.rootCrop-other').hide();
                            }
                            // Set the value of the 'Other' textarea
                            $('#rootCrop-other-Edit').val(value['rootcrop_others_desc']);

                            // disease resistance rootCrop
                            $('#rootCrop-Bacterial-Edit').prop('checked', value['bacterial'] == 1);
                            $('#rootCrop-Fungus-Edit').prop('checked', value['fungus'] == 1);
                            $('#rootCrop-Viral-Edit').prop('checked', value['viral'] == 1);

                            // abiotic resistance resistance rootCrop
                            $('#rootCrop-Drought-Edit').prop('checked', value['drought'] == 1);
                            $('#rootCrop-Salinity-Edit').prop('checked', value['salinity'] == 1);
                            $('#rootCrop-Heat-Edit').prop('checked', value['heat'] == 1);
                            $('#rootCrop-abiotic-Edit').prop('checked', value['abiotic_other'] == 1);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            // baliktad ang if else statement kay katok ang code ambot nganuman
                            if ($('#rootCrop-abiotic-Edit').prop('checked')) {
                                $('.rootCrop-abiotic-other').show();
                            } else {
                                $('.rootCrop-abiotic-other').hide();
                            }
                            // Set the value of the 'Other' textarea
                            $('#rootCrop-abiotic-other-Edit').val(value['abiotic_other_desc']);
                        } else {
                            // Default case, hide all divs
                            $('#corn-Edit').hide();
                            $('#riceMorph-Edit').hide();
                            $('#root_cropMorph-Edit').hide();
                        }

                        // crop_id
                        $('#crop_id').val(id);
                        // userID
                        $('#userID').val(value['user_id']);
                        // statusID
                        $('#statusID').val(value['status_id']);
                        // referencesID
                        $('#referencesID').val(value['references_id']);
                        // categoryID
                        $('#categoryID').val(value['category_id']);
                        // category_varietyID
                        $('#category_varietyID').val(value['category_variety_id']);
                        // terrainID
                        $('#terrainID').val(value['terrain_id']);
                        // unique_codeID
                        $('#unique_codeID').val(value['unique_code_id']);
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

                        // id for rice
                        $('#pest_resistance_riceID').val(value['pest_resistance_rice_id']);
                        $('#vegetative_state_riceID').val(value['vegetative_state_rice_id']);
                        $('#reproductive_state_riceID').val(value['reproductive_state_rice_id']);
                        $('#panicle_traits_riceID').val(value['panicle_traits_rice_id']);
                        $('#flag_leaf_traits_riceID').val(value['flag_leaf_traits_rice_id']);
                        $('#sensory_traits_riceID').val(value['sensory_traits_rice_id']);

                        // id for root crop
                        $('#root_crop_traitsID').val(value['root_crop_traits_id']);
                        $('#vegetative_state_rootcropID').val(value['vegetative_state_rootcrop_id']);
                        $('#pest_resistance_rootcropID').val(value['pest_resistance_rootcrop_id']);
                        $('#rootcrop_traitsID').val(value['rootcrop_traits_id']);

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
                        $('#neighborhoodEdit').val(value['neighborhood']);
                        // coordInput
                        $('#coordEdit').val(value['coordinates']);
                        // Update the select data of loc.php locations
                        $('#crop_variety_select').append($('<option>', {
                            value: value['crop_variety'],
                            text: value['crop_variety']
                        }));
                        $('#BarangaySelect').append($('<option>', {
                            value: value['barangay_name'],
                            text: value['barangay_name']
                        }));
                        $('#MunicipalitySelect').append($('<option>', {
                            value: value['municipality_name'],
                            text: value['municipality_name']
                        }));

                        // Add municipality to the array
                        municipalities.push(value['municipality_name']);

                        // Append options to MunicipalitySelect
                        $('#MunicipalitySelect').empty(); // Clear previous options
                        municipalities.forEach(function(municipality) {
                            var selected = (municipality === value['municipality_name']) ? 'selected' : '';
                            $('#MunicipalitySelect').append('<option value="' + municipality + '" ' + selected + '>' + municipality + '</option>');
                        });

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

    // tab switching
    // next button
    function switchTab(tabName) {
        // prevent submitting the form
        event.preventDefault();

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }

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