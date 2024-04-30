<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="edit-item-modal" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit</h5>
                <button type="button" id="close-modal-btn-edit" class="btn-close" aria-label="Close"></button>
            </div>

            <div id="error-messages-Edit">

            </div>
            <!-- body -->
            <form id="form-panel-Edit" name="Form" action="modals/crud-code/pest-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="Edit-User">
                            <!-- user id hidden -->
                            <input type="hidden" name="pest_idEdit" id="pest_idEdit">
                            <!-- pest name-->
                            <div class="row mb-3">
                                <!-- pest name -->
                                <div class="col">
                                    <label for="pest-NameEdit" class="form-label small-font">Pest Name:<span style="color: red;">*</span></label>
                                    <input type="text" id="pest-NameEdit" name="pest_nameEdit" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- confirm -->
                <?php require "modals/pest-tabs/confirm.php"; ?>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" id="deleteButton" class="btn btn-danger" data-id="delete">Delete</i></button>
                    <div class="">
                        <button type="button" id="cancel-modal-btn-edit" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="edit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- for submission -->
<script>
    // EDIT SCRIPT
    const tableRows = document.querySelectorAll('.edit_data');
    tableRowsDraft.forEach(row => {

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Use the crop_id as needed
            // console.log("Crop ID: " + id);

            // Assuming you have jQuery available
            $.ajax({
                url: 'modals/fetch/fetch_crop-edit.php',
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
                        console.log(value['category_variety_name']);

                        // Fetch the old image and pass it to the fetchOldImage function
                        //fetchOldImageSeedDraft(value.crop_seed_image);
                        // Fetch the old image and pass it to the fetchOldImage function
                        //fetchOldImageVegDraft(value.crop_vegetative_image);
                        // Fetch the old image and pass it to the fetchOldImage function
                        //fetchOldImageReproDraft(value.crop_reproductive_image);

                        if (value['crop_seed_image'] != null && value['crop_seed_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesSeed = value['crop_seed_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesSeed.forEach(function(filename) {
                                $('#previewSeed').append(`<img src="modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        if (value['crop_vegetative_image'] != null && value['crop_vegetative_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesVeg = value['crop_vegetative_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesVeg.forEach(function(filename) {
                                $('#previewVeg').append(`<img src="modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        if (value['crop_reproductive_image'] != null && value['crop_reproductive_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesRepro = value['crop_reproductive_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesRepro.forEach(function(filename) {
                                $('#previewReproductive').append(`<img src="modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        // setting the available data on the traits tab depending on the category of the selected crop
                        if (value['category_name'] === 'Corn') {
                            // Show the div for Corn
                            $('#cornMorph').show();
                            $('#cornAgro').show();
                            $('#withoutSensory').show();
                            $('#withoutSensory-More').show();
                            // Hide the divs for Rice and Root Crop
                            $('#riceMorph').hide();
                            $('#riceAgro').hide();
                            $('#root_cropMorph').hide();
                            $('#root_cropAgro').hide();
                            $('#edit-sensory-tab').hide();
                            $('#withSensory').hide();
                            $('#withSensory-More').hide();

                            // morph traits for corn
                            // vegetative state
                            $('#corn-heightEdit').append($('<option>', {
                                value: value['corn_plant_height'],
                                text: value['corn_plant_height'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#corn-leafWidth').append($('<option>', {
                                value: value['corn_leaf_width'],
                                text: value['corn_leaf_width'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#corn-leafLength').append($('<option>', {
                                value: value['corn_leaf_length'],
                                text: value['corn_leaf_length'],
                                selected: true,
                                style: 'display: none;'
                            }));

                            // Reproductive state corn
                            $('#corn-yield-capacity').append($('<option>', {
                                value: value['corn_yield_capacity'],
                                text: value['corn_yield_capacity'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#corn-seed-length').val(value['seed_length']);
                            $('#corn-seed-width').val(value['seed_width']);
                            $('#corn-seed-shape').val(value['seed_shape']);
                            $('#corn-seed-color').val(value['seed_color']);

                            $('#pest_other_check').prop('checked', value['corn_pest_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#pest_other_check').prop('checked')) {
                                $('#pest-other').removeClass('d-none'); // Remove the 'd-none' class to show the element
                            } else {
                                $('#pest-other').addClass('d-none'); // Add the 'd-none' class to hide the element
                            }
                            // Set the value of the 'Other' textarea
                            $('#pest').val(value['corn_pest_other_desc']);

                            $('#abiotic_other_check').prop('checked', value['corn_abiotic_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#abiotic_other_check').prop('checked')) {
                                $('#abiotic_other').removeClass('d-none');
                            } else {
                                $('#abiotic_other').addClass('d-none');
                            }
                            // Set the value of the 'Other' textarea
                            $('#abiotic_other-desc').val(value['corn_abiotic_other_desc']);
                        } else if (value['category_name'] === 'Rice') {
                            // Show the div for Rice
                            $('#riceMorph').show();
                            $('#riceAgro').show();
                            $('#edit-sensory-tab').show();
                            $('#withSensory').show();
                            $('#withSensory-More').show();
                            // Hide the divs for Corn and Root Crop
                            $('#cornMorph').hide();
                            $('#cornAgro').hide();
                            $('#root_cropMorph').hide();
                            $('#root_cropAgro').hide();
                            $('#withoutSensory').hide();
                            $('#withoutSensory-More').hide();

                            // morph traits for rice
                            // vegetative state
                            $('#height-tall').append($('<option>', {
                                value: value['rice_plant_height'],
                                text: value['rice_plant_height'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#leafWidth').append($('<option>', {
                                value: value['rice_leaf_width'],
                                text: value['rice_leaf_width'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#leafLength').append($('<option>', {
                                value: value['rice_leaf_length'],
                                text: value['rice_leaf_length'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#tilleringAbility').append($('<option>', {
                                value: value['rice_tillering_ability'],
                                text: value['rice_tillering_ability'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#rice-maturityTime').append($('<option>', {
                                value: value['rice_maturity_time'],
                                text: value['rice_maturity_time'],
                                selected: true,
                                style: 'display: none;'
                            }));

                            // Reproductive state rice
                            $('#rice-yield-capacity').val(value['rice_yield_capacity']);
                            // panicle traits
                            $('#pan-length').val(value['panicle_length']);
                            $('#pan-width').val(value['panicle_width']);
                            $('#pan-enclosed').val(value['panicle_enclosed_by']);
                            $('#panicle-features').val(value['panicle_remarkable_features']);

                            // seed traits
                            $('#rice-seed-length').val(value['seed_length']);
                            $('#rice-seed-width').val(value['seed_width']);
                            $('#rice-seed-shape').val(value['seed_shape']);
                            $('#rice-seed-color').val(value['seed_color']);

                            // flag leaf traits
                            $('#flag-length').val(value['flag_length']);
                            $('#flag-width').val(value['flag_width']);
                            $('#Pubescence').val(value['pubescence']);
                            $('#flag-features').val(value['flag_remarkable_features']);
                            $('#purplishStripes').prop('checked', value['purplish_stripes']);

                            // sensory traits of cooked rice
                            $('#sensory-aroma').val(value['aroma']);
                            $('#cooked-rice').val(value['quality_cooked_rice']);
                            $('#leftover-rice').val(value['quality_leftover_rice']);
                            // volume expansion and Glutinous
                            $('#volExpansion').prop('checked', value['volume_expansion']);
                            $('#glutinousity').prop('checked', value['glutinous']);
                            // hardness
                            if (value['hardness'] === 'Soft') {
                                $('#hardness-Soft').prop('checked', true);
                            } else if (value['hardness'] === 'Hard') {
                                $('#hardness-Hard').prop('checked', true);
                            }

                            $('#pest_other_check').prop('checked', value['rice_pest_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#pest_other_check').prop('checked')) {
                                $('#pest-other').removeClass('d-none'); // Remove the 'd-none' class to show the element
                            } else {
                                $('#pest-other').addClass('d-none'); // Add the 'd-none' class to hide the element
                            }
                            // Set the value of the 'Other' textarea
                            $('#pest').val(value['rice_pest_other_desc']);

                            $('#abiotic_other_check').prop('checked', value['rice_abiotic_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#abiotic_other_check').prop('checked')) {
                                $('#abiotic_other').removeClass('d-none');
                            } else {
                                $('#abiotic_other').addClass('d-none');
                            }
                            // Set the value of the 'Other' textarea
                            $('#abiotic_other-desc').val(value['rice_abiotic_other_desc']);
                        } else if (value['category_name'] === 'Root Crop') {
                            // Show the div for Root Crop
                            $('#root_cropMorph').show();
                            $('#root_cropAgro').show();
                            $('#withoutSensory').show();
                            $('#withoutSensory-More').show();
                            // Hide the divs for Corn and Rice
                            $('#cornMorph').hide();
                            $('#cornAgro').hide();
                            $('#riceMorph').hide();
                            $('#riceAgro').hide();
                            $('#edit-sensory-tab').hide();
                            $('#withSensory').hide();
                            $('#withSensory-More').hide();

                            // morph traits for rootCrop
                            // vegetative state
                            $('#rootCrop-height-tall-edit').append($('<option>', {
                                value: value['rootcrop_plant_height'],
                                text: value['rootcrop_plant_height'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#rootCrop-leafWidth').append($('<option>', {
                                value: value['rootcrop_leaf_width'],
                                text: value['rootcrop_leaf_width'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#rootCrop-leafLength').append($('<option>', {
                                value: value['rootcrop_leaf_length'],
                                text: value['rootcrop_leaf_length'],
                                selected: true,
                                style: 'display: none;'
                            }));
                            $('#rootCrop-steam-leaf-desc').val(value['rootcrop_stem_leaf_desc']);

                            // Reproductive state rootCrop
                            // Root Crop traits
                            $('#rootCrop-eating-quality').val(value['eating_quality']);
                            $('#rootCrop-color').val(value['rootcrop_color']);
                            $('#rootCrop-sweetness').val(value['sweetness']);
                            $('#rootCrop-remarkableFeatures').val(value['rootcrop_remarkable_features']);

                            $('#pest_other_check').prop('checked', value['rootcrop_pest_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#pest_other_check').prop('checked')) {
                                $('#pest-other').removeClass('d-none'); // Remove the 'd-none' class to show the element
                            } else {
                                $('#pest-other').addClass('d-none'); // Add the 'd-none' class to hide the element
                            }
                            // Set the value of the 'Other' textarea
                            $('#pest').val(value['rootcrop_pest_other_desc']);

                            $('#abiotic_other_check').prop('checked', value['rootcrop_abiotic_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#abiotic_other_check').prop('checked')) {
                                $('#abiotic_other').removeClass('d-none');
                            } else {
                                $('#abiotic_other').addClass('d-none');
                            }
                            // Set the value of the 'Other' textarea
                            $('#abiotic_other-desc').val(value['rootcrop_abiotic_other_desc']);
                        } else {
                            // Default case, hide all divs
                            $('#cornMorph').hide();
                            $('#riceMorph').hide();
                            $('#root_cropMorph').hide();
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
                        $('#crop_idDraft').val(id);
                        // statusIDdraft
                        $('#statusIDdraft').val(value['status_id']);
                        // referencesIDdraft
                        $('#referencesIDdraft').val(value['references_id']);
                        // categoryIDdraft
                        $('#categoryIDdraft').val(value['category_id']);
                        // crop_location_id
                        $('#crop_location_id').val(value['crop_location_id']);
                        // characteristics_id
                        $('#Char_id').val(value['characteristics_id']);
                        // cultural_aspect_id
                        $('#cultural_aspect-Edit').val(value['cultural_aspect_id']);
                        // disease_resistanceIDdraft
                        $('#disease_resistanceIDdraft').val(value['disease_resistance_id']);
                        // seed_traitsIDdraft
                        $('#seed_traitsIDdraft').val(value['seed_traits_id']);
                        // utilization_culturalIDdraft
                        $('#utilization_culturalIDdraft').val(value['utilization_cultural_id']);
                        // abiotic_resistanceIDdraft and abiotic_resistance_riceIDdraft
                        $('#abiotic_resistanceIDdraft').val(value['abiotic_resistance_id']);
                        $('#abiotic_resistance_riceIDdraft').val(value['abiotic_resistance_rice_id']);

                        // id for corn
                        $('#corn_traitsIDdraft').val(value['corn_traits_id']);
                        $('#vegetative_state_cornIDdraft').val(value['vegetative_state_corn_id']);
                        $('#reproductive_state_cornIDdraft').val(value['reproductive_state_corn_id']);
                        $('#pest_resistance_cornIDdraft').val(value['pest_resistance_corn_id']);
                        $('#corn_pest_otherIDdraft').val(value['corn_pest_other_id']);
                        $('#corn_abiotic_otherIDdraft').val(value['corn_abiotic_other_id']);

                        // id for rice
                        $('#rice_traitsIDdraft').val(value['rice_traits_id']);
                        $('#pest_resistance_riceIDdraft').val(value['pest_resistance_rice_id']);
                        $('#vegetative_state_riceIDdraft').val(value['vegetative_state_rice_id']);
                        $('#reproductive_state_riceIDdraft').val(value['reproductive_state_rice_id']);
                        $('#panicle_traits_riceIDdraft').val(value['panicle_traits_rice_id']);
                        $('#flag_leaf_traits_riceIDdraft').val(value['flag_leaf_traits_rice_id']);
                        $('#sensory_traits_riceIDdraft').val(value['sensory_traits_rice_id']);
                        $('#rice_pest_otherIDdraft').val(value['rice_pest_other_id']);
                        $('#rice_abiotic_otherIDdraft').val(value['rice_abiotic_other_id']);

                        // id for root crop
                        $('#root_crop_traitsIDdraft').val(value['root_crop_traits_id']);
                        $('#vegetative_state_rootcropIDdraft').val(value['vegetative_state_rootcrop_id']);
                        $('#pest_resistance_rootcropIDdraft').val(value['pest_resistance_rootcrop_id']);
                        $('#rootcrop_traitsIDdraft').val(value['rootcrop_traits_id']);
                        $('#corn_pest_otherIDdraft').val(value['corn_pest_other_id']);
                        $('#rootcrop_pest_otherIDdraft').val(value['rootcrop_pest_other_id']);
                        $('#rootcrop_abiotic_otherIDdraft').val(value['rootcrop_abiotic_other_id']);

                        // old image/current image
                        $('#old_image_seedDraft').val(value['crop_seed_image']);
                        $('#old_image_vegDraft').val(value['crop_vegetative_image']);
                        $('#old_image_repDraft').val(value['crop_reproductive_image']);

                        // example ni sya kung gusto nimo i dikit ang duwa ka value
                        // $('#crop_variety').val(value['unique_code'] + '(' + value['crop_variety'] + ') ');

                        $('#descDraf').val(value['crop_description']);
                        $('#nameMeanDraf').val(value['meaning_of_name']);
                        // current_crop_variety
                        $('#Variety-NameDraft').val(value['crop_variety']);
                        // currentUniqueCode
                        $('#currentUniqueCode').val(value['unique_code']);

                        // Utilization and Cultural Importance
                        $('#Significance').val(value['significance']);
                        $('#Use').val(value['use']);
                        $('#indigenous-utilization').val(value['indigenous_utilization']);
                        $('#remarkable-features').val(value['remarkable_features']);

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
                                $('#new-url-container').append(`
                            <div class="url-list-item mb-2">
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
                        $('#Sitio').val(value['sitio_name']);
                        // coordInput
                        $('#coordInput').val(value['coordinates']);
                        // Update the select data of loc.php locations
                        if (value['category_name']) {
                            $('#Category').append($('<option>', {
                                value: value['category_name'],
                                text: value['category_name'],
                                selected: true, // Make the option selected
                                style: 'display: none;' // Hide the option
                            }));
                        }
                        if (value['category_name']) {
                            $('#categoryVarietyDraft').append($('<option>', {
                                value: value['category_variety_name'],
                                text: value['category_variety_name'],
                                selected: true, // Make the option selected
                                style: 'display: none;' // Hide the option
                            }));
                        }

                        if (value['terrain_name']) {
                            $('#terrainDraft').append($('<option>', {
                                value: value['terrain_name'],
                                text: value['terrain_name'],
                                selected: true, // Make the option selected
                                style: 'display: none;' // Hide the option
                            }));
                        }
                        if (value['barangay_id']) {
                            $('#BarangayDraft').append($('<option>', {
                                value: value['barangay_id'],
                                text: value['barangay_name'],
                                selected: true,
                                style: 'display: none;'
                            }));
                        }
                        if (value['municipality_id']) {
                            $('#MunicipalityDraft').append($('<option>', {
                                value: value['municipality_id'],
                                text: value['municipality_name'],
                                selected: true,
                                style: 'display: none;'
                            }));
                        }

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
        });
    });

    // Function to validate input 
    function validateFormEdit() {
        var pest_name = document.getElementById('pest-NameEdit').value;

        var errors = [];

        // Check if the required fields are not empty
        if (pest_name === "" || pest_name === null) {
            errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
        }

        // Display first error only
        if (errors.length > 0) {
            var errorString = errors[0]; // Get the first error
            document.getElementById("error-messages-Edit").innerHTML = errorString;
            return false;
        }

        // If no errors, clear error messages
        document.getElementById("error-messages-Edit").innerHTML = "";
        return true;
    }

    // Function to submit the form and refresh notifications
    function submitFormEdit() {
        var form = document.getElementById('form-panel-Edit');
        if (form) {
            // Create a new FormData object
            var formData = new FormData(form);

            // Append additional data
            formData.append('edit', 'true');

            // Send a POST request using AJAX
            $.ajax({
                url: "modals/crud-code/pest-code.php",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    // Reset the form
                    form.reset();
                    // Reload the page or do other actions if needed
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Form submission error:", textStatus, errorThrown);
                    // Handle error if needed
                }
            });
        }
    }
</script>

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
        var editModal = document.getElementById('edit-item-modal');
        var editModalInstance = bootstrap.Modal.getInstance(editModal);
        editModalInstance.hide();

        // Remove the modal backdrop
        $('.modal-backdrop').remove();
    }

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
    document.getElementById('confirmDeleteBtnEdit').addEventListener('click', function() {
        // Send a request to delete the category
        $.ajax({
            url: 'modals/crud-code/pest-code.php',
            type: 'POST',
            data: {
                'delete': 'delete',
                'pest_resistance_id': document.getElementById('pest_idEdit').value
            },
            success: function(response) {
                // Handle the response from the server
                console.log('Pest deleted:', response);

                // Close the confirmation modal
                //confirmModalInstanceEdit.hide();

                // Optionally, you can reload the page or update the UI
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error deleting category:', error);
            }
        });
    });
</script>