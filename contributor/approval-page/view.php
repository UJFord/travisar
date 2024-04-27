<!-- STYLE -->
<style>
    .modal-tab:hover {
        color: grey;
    }
</style>

<!-- EDIT MODAL -->
<div class="modal fade" id="view-item-modal" tabindex="-1" aria-labelledby="view-item-modal-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="view-item-modal-label">View</h5>
                <button type="button" id="close-modal-btn" class="btn-close" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel-view" name="Form" action="pending-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
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
                    </ul>
                    <div class="container">
                        <div class="tab-content mt-2">
                            <!-- general -->
                            <?php require "tabs/gen.php" ?>
                            <!-- cultural -->
                            <?php require "tabs/cultural.php" ?>
                            <!-- more optional info -->
                            <?php require "tabs/more.php" ?>
                            <!-- agro info -->
                            <?php require "tabs/agro.php" ?>
                            <!-- sensory info -->
                            <?php require "tabs/sensory.php" ?>
                            <!-- confirm info -->
                            <?php require "tabs/confirm.php" ?>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" id="rejectButton" class="btn btn-danger">Reject</i></button>
                    <div class="approveButton">
                        <button type="button" id="cancel-modal-btn" class="btn border bg-light">Cancel</button>
                        <button type="submit" name="approve" class="btn btn-success me-2">Approve</i></button>
                    </div>
                    <div class="updateButton">
                        <button type="button" id="cancel-modal-btn-update" class="btn border bg-light">Cancel</button>
                        <button type="submit" name="update" class="btn btn-success me-2">Update</i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- script for getting the data on the view -->
<script>
    document.getElementById('form-panel-view').addEventListener('submit', function(event) {

        // Get the selected category
        var selectedCategory = document.getElementById('categoryID').value;
        var cornMorph = document.getElementById('cornMorph-Edit');
        var riceMorph = document.getElementById('riceMorph-Edit');
        var rootCropMorph = document.getElementById('root_cropMorph-Edit');

        // Disable inputs based on the selected category
        if (selectedCategory !== '4') {
            disableInputs(cornMorph);
        }

        if (selectedCategory !== '1') {
            disableInputs(riceMorph);
        }

        if (selectedCategory !== '2') {
            disableInputs(rootCropMorph);
        }
        // Form is valid, submit the form
        submitForm();
    });

    // Function to submit the form and refresh notifications
    function submitForm() {
        console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel-view');
        // Trigger the form submission
        if (form) {
            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "pending-code.php",
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

    // VIEW SCRIPT
    const tableRows = document.querySelectorAll('.view_data');
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

                        // setting which button should appear depending on it's status
                        if (value['action'] === 'updating') {
                            // show update button
                            $('.updateButton').show();
                            // hide approve button
                            $('.approveButton').hide();
                        } else if (value['action'] === 'pending') {
                            // hide approve button
                            $('.approveButton').show();
                            // show update button
                            $('.updateButton').hide();
                        } else {
                            // hide approve button
                            $('.approveButton').hide();
                            // show update button
                            $('.updateButton').hide();
                            $('#rejectButton').hide();
                        }

                        // Fetch the old image and pass it to the fetchOldImage function
                        fetchOldImage(value.crop_seed_image);

                        if (value['crop_seed_image'] != null && value['crop_seed_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesSeed = value['crop_seed_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesSeed.forEach(function(filename) {
                                $('#previewSeedEdit').append(`<img src="../crop-page/modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        if (value['crop_vegetative_image'] != null && value['crop_vegetative_image'] != '') {
                            $('#previewVegEdit').append(`<img src="../crop-page/modals/img/${value['crop_vegetative_image']}" class="m-2 img-thumbnail" style="height: 200px;">`);
                        }

                        if (value['crop_reproductive_image'] != null && value['crop_reproductive_image'] != '') {
                            $('#previewReproductiveEdit').append(`<img src="../crop-page/modals/img/${value['crop_reproductive_image']}" class="m-2 img-thumbnail" style="height: 200px;">`);
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
                            $('#corn-heightEdit').text(value['corn_plant_height']);
                            $('#corn-leafWidth-Edit').text(value['corn_leaf_width']);
                            $('#corn-leafLength-Edit').text(value['corn_leaf_length']);

                            // Reproductive state corn
                            $('#corn-yield-capacity-Edit').text(value['corn_yield_capacity']);
                            $('#corn-seed-length-Edit').text(value['seed_length']);
                            $('#corn-seed-width-Edit').text(value['seed_width']);
                            $('#corn-seed-shape-Edit').text(value['seed_shape']);
                            $('#corn-seed-color-Edit').text(value['seed_color']);

                            $('#pest_other_checkEdit').prop('checked', value['corn_pest_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#pest_other_checkEdit').prop('checked')) {
                                $('#pest-otherEdit').removeClass('d-none'); // Remove the 'd-none' class to show the element
                            } else {
                                $('#pest-otherEdit').addClass('d-none'); // Add the 'd-none' class to hide the element
                            }
                            // Set the value of the 'Other' textarea
                            $('#pestEdit').val(value['corn_pest_other_desc']);

                            $('#abiotic_other_checkEdit').prop('checked', value['corn_abiotic_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#abiotic_other_checkEdit').prop('checked')) {
                                $('#abiotic_otherEdit').removeClass('d-none');
                            } else {
                                $('#abiotic_otherEdit').addClass('d-none');
                            }
                            // Set the value of the 'Other' textarea
                            $('#abiotic_other-descEdit').val(value['corn_abiotic_other_desc']);
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
                            $('#rice-height-Edit').text(value['rice_plant_height']);
                            $('#leafWidth-Edit').text(value['rice_leaf_width']);
                            $('#leafLength-Edit').text(value['rice_leaf_length']);
                            $('#tilleringAbility-Edit').text(value['rice_tillering_ability']);
                            $('#rice-maturityTime-Edit').text(value['rice_maturity_time']);

                            // Reproductive state rice
                            $('#rice-yield-capacity-Edit').text(value['rice_yield_capacity']);
                            // panicle traits
                            $('#pan-length-Edit').text(value['panicle_length']);
                            $('#pan-width-Edit').text(value['panicle_width']);
                            $('#pan-enclosed-Edit').text(value['panicle_enclosed_by']);
                            $('#pan-features-Edit').text(value['panicle_remarkable_features']);

                            // seed traits
                            $('#rice-seed-length-Edit').text(value['seed_length']);
                            $('#rice-seed-width-Edit').text(value['seed_width']);
                            $('#rice-seed-shape-Edit').text(value['seed_shape']);
                            $('#rice-seed-color-Edit').text(value['seed_color']);

                            // flag leaf traits
                            $('#flag-length-Edit').text(value['flag_length']);
                            $('#flag-width-Edit').text(value['flag_width']);
                            $('#Pubescence-Edit').text(value['pubescence']);
                            $('#flag-features-Edit').text(value['flag_remarkable_features']);
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

                            $('#pest_other_checkEdit').prop('checked', value['rice_pest_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#pest_other_checkEdit').prop('checked')) {
                                $('#pest-otherEdit').removeClass('d-none'); // Remove the 'd-none' class to show the element
                            } else {
                                $('#pest-otherEdit').addClass('d-none'); // Add the 'd-none' class to hide the element
                            }
                            // Set the value of the 'Other' textarea
                            $('#pestEdit').val(value['rice_pest_other_desc']);

                            $('#abiotic_other_checkEdit').prop('checked', value['rice_abiotic_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#abiotic_other_checkEdit').prop('checked')) {
                                $('#abiotic_otherEdit').removeClass('d-none');
                            } else {
                                $('#abiotic_otherEdit').addClass('d-none');
                            }
                            // Set the value of the 'Other' textarea
                            $('#abiotic_other-descEdit').val(value['rice_abiotic_other_desc']);
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

                            $('#pest_other_checkEdit').prop('checked', value['rootcrop_pest_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#pest_other_checkEdit').prop('checked')) {
                                $('#pest-otherEdit').removeClass('d-none'); // Remove the 'd-none' class to show the element
                            } else {
                                $('#pest-otherEdit').addClass('d-none'); // Add the 'd-none' class to hide the element
                            }
                            // Set the value of the 'Other' textarea
                            $('#pestEdit').val(value['rootcrop_pest_other_desc']);

                            $('#abiotic_other_checkEdit').prop('checked', value['rootcrop_abiotic_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#abiotic_other_checkEdit').prop('checked')) {
                                $('#abiotic_otherEdit').removeClass('d-none');
                            } else {
                                $('#abiotic_otherEdit').addClass('d-none');
                            }
                            // Set the value of the 'Other' textarea
                            $('#abiotic_other-descEdit').val(value['rootcrop_abiotic_other_desc']);
                        } else {
                            // Default case, hide all divs
                            $('#corn-Edit').hide();
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
                        $('#crop_id').val(id);
                        // statusID
                        $('#statusID').val(value['status_id']);
                        // referencesID
                        $('#referencesID').val(value['references_id']);
                        // categoryID
                        $('#categoryID').val(value['category_id']);
                        // current_crop_variety
                        $('#current_crop_variety').val(value['crop_variety']);
                        // currentUniqueCode
                        $('#currentUniqueCode').val(value['unique_code']);
                        // crop_location_id
                        $('#crop_location_id').val(value['crop_location_id']);
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

                        $('#crop_variety').text(value['crop_variety']);
                        $('#ScienceName').text(value['scientific_name']);
                        $('#description').text(value['crop_description']);
                        $('#nameMeaning').text(value['meaning_of_name']);
                        // terrain name
                        $('#categoryTerrainEdit').text(value['terrain_name']);

                        // Utilization and Cultural Importance
                        $('#SignificanceEdit').text(value['significance']);
                        $('#UseEdit').text(value['use']);
                        $('#indigenous-utilization-Edit').text(value['indigenous_utilization']);
                        $('#remarkable-features-Edit').text(value['remarkable_features']);

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
                        $('#ProvinceEdit').text(value['province_name']);
                        $('#MunicipalitySelect').text(value['municipality_name']);
                        $('#BarangaySelect').text(value['barangay_name']);
                        $('#SitioEdit').text(value['sitio_name']);
                        // coordInput
                        $('#coordEdit').text(value['coordinates']);
                        // Update the select data of loc.php locations
                        $('#crop_variety_select').append($('<option>', {
                            value: value['crop_variety'],
                            text: value['crop_variety'],
                            selected: true, // Make the option selected
                            style: 'display: none;' // Hide the option
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
            const dataModal = new bootstrap.Modal(document.getElementById('view-item-modal'), {
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
        const dataModal = new bootstrap.Modal(document.getElementById('view-item-modal'), {
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

<!-- SCRIPT for closing the modal -->
<script>
    // Function to set up event listeners for the modal
    function setupModalEventListeners() {
        // Remove event listeners to prevent duplication
        document.getElementById('close-modal-btn').removeEventListener('click', closeModal);
        document.getElementById('cancel-modal-btn').removeEventListener('click', closeModal);
        document.getElementById('cancel-modal-btn-update').removeEventListener('click', closeModal);
        document.getElementById('rejectButton').removeEventListener('click', rejectModalEdit);

        // Event listener for the close button
        document.getElementById('close-modal-btn').addEventListener('click', closeModal);

        // Event listener for the cancel button
        document.getElementById('cancel-modal-btn').addEventListener('click', closeModal);
        document.getElementById('cancel-modal-btn-update').addEventListener('click', closeModal);
        document.getElementById('rejectButton').addEventListener('click', rejectModalEdit);

    }

    // Global variable to store the modal instance
    var confirmModalInstance;

    // Custom function to close the modal
    function closeModal() {
        var addModal = document.getElementById('view-item-modal');
        var addModalInstance = bootstrap.Modal.getInstance(addModal);
        addModalInstance.hide();

        // Remove the modal backdrop
        $('.modal-backdrop').remove();
    }

    function rejectModalEdit(event) {
        // Prevent the default behavior of the button (e.g., form submission)
        event.preventDefault();

        // Get the modal element
        var confirmModal = document.getElementById('confirmModal');

        // Create a new Bootstrap modal instance if it doesn't exist
        if (!confirmModalInstance) {
            confirmModalInstance = new bootstrap.Modal(confirmModal);
        }

        // Show the confirmation modal
        confirmModalInstance.show();

        // to show which button should show on the confirm modal
        document.getElementById('confirmCloseBtn').style.display = 'none';
        document.getElementById('confirmRejectBtn').style.display = 'block';
        // to show which label should show on the confirm modal
        document.getElementById('close-label').style.display = 'none';
        document.getElementById('reject-label').style.display = 'block';
    }

    // Event listener for when the modal is shown
    document.getElementById('view-item-modal').addEventListener('shown.bs.modal', function() {
        setupModalEventListeners();
    });

    // Event listener for when the confirmation modal is hidden
    document.getElementById('confirmModal').addEventListener('hidden.bs.modal', function() {
        // Reset the confirmModalInstance
        confirmModalInstance = null;
    });
</script>