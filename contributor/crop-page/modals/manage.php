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
                <h5 class="modal-title" id="view-item-modal-label">Manage</h5>
                <button type="button" id="close-modal-btn-View" class="btn-close" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel-view" name="Form" action="modals/crud-code/pending-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body view-modal-body">
                    <!-- TAB LIST NAVIGATION -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active small-font modal-tab" id="view-gen-tab" data-bs-toggle="tab" data-bs-target="#view-gen-tab-pane" type="button" role="tab" aria-controls="view-gen-tab-pane" aria-selected="false"><i class="fa-solid fa-lightbulb me-1"></i>General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="view-more-tab" data-bs-toggle="tab" data-bs-target="#view-more-tab-pane" type="button" role="tab" aria-controls="view-more-tab-pane" aria-selected="true"><i class="fa-solid fa-leaf me-1"></i>Morphology</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="view-sensory-tab" data-bs-toggle="tab" data-bs-target="#view-sensory-tab-pane" type="button" role="tab" aria-controls="view-sensory-tab-pane" aria-selected="true"><i class="fa-solid fa-utensils me-1"></i>Sensory</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="view-agro-tab" data-bs-toggle="tab" data-bs-target="#view-agro-tab-pane" type="button" role="tab" aria-controls="view-agro-tab-pane" aria-selected="true"><i class="fa-solid fa-seedling me-1"></i>Agronomy</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="view-cultural-tab" data-bs-toggle="tab" data-bs-target="#view-cultural-tab-pane" type="button" role="tab" aria-controls="view-cultural-tab-pane" aria-selected="false"><i class="fa-solid fa-sun me-1"></i>Importance</button>
                        </li>
                    </ul>
                    <div class="container">
                        <div class="tab-content mt-2">
                            <!-- general -->
                            <?php require "manage-tabs/gen.php" ?>
                            <!-- cultural -->
                            <?php require "manage-tabs/cultural.php" ?>
                            <!-- more optional info -->
                            <?php require "manage-tabs/more.php" ?>
                            <!-- agro info -->
                            <?php require "manage-tabs/agro.php" ?>
                            <!-- sensory info -->
                            <?php require "manage-tabs/sensory.php" ?>
                            <!-- confirm info -->
                            <?php require "manage-tabs/confirm.php" ?>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" id="rejectButton-View" class="btn btn-danger">Reject</i></button>
                    <div class="approveButtonView">
                        <button type="button" id="cancel-modal-btn-View" class="btn border bg-light">Cancel</button>
                        <button type="submit" name="approve" class="btn btn-success me-2">Approve</i></button>
                    </div>
                    <div class="updateButtonView">
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
        var selectedCategoryView = document.getElementById('categoryIDView').value;
        var cornMorphView = document.getElementById('cornMorph-View');
        var riceMorphView = document.getElementById('riceMorph-View');
        var rootCropMorphView = document.getElementById('root_cropMorph-View');

        // Disable inputs based on the selected category
        if (selectedCategoryView !== '4') {
            disableInputs(cornMorphView);
        }

        if (selectedCategoryView !== '1') {
            disableInputs(riceMorphView);
        }

        if (selectedCategoryView !== '2') {
            disableInputs(rootCropMorphView);
        }
        // Form is valid, submit the form
        submitFormView();
    });

    // Function to submit the form and refresh notifications
    function submitFormView() {
        console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel-view');
        // Trigger the form submission
        if (form) {
            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "modals/crud-code/pending-code.php",
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
    const tableRowsView = document.querySelectorAll('.view_data');
    // Define an array to store municipalities
    var municipalities = [];

    tableRowsView.forEach(row => {

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
                        console.log(value['corn_abiotic_other_desc']);

                        // setting which button should appear depending on it's status
                        if (value['action'] === 'Updating') {
                            // show update button
                            $('.updateButtonView').show();
                            // hide approve button
                            $('.approveButtonView').hide();
                        } else if (value['action'] === 'Pending') {
                            // hide approve button
                            $('.approveButtonView').show();
                            // show update button
                            $('.updateButtonView').hide();
                        } else {
                            // hide approve button
                            $('.approveButtonView').hide();
                            // show update button
                            $('.updateButtonView').hide();
                            $('#rejectButton').hide();
                        }

                        if (value['crop_seed_image'] != null && value['crop_seed_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesSeed = value['crop_seed_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesSeed.forEach(function(filename) {
                                $('#previewSeedView').append(`<img src="modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        if (value['crop_vegetative_image'] != null && value['crop_vegetative_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesVeg = value['crop_vegetative_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesVeg.forEach(function(filename) {
                                $('#previewVegView').append(`<img src="modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        if (value['crop_reproductive_image'] != null && value['crop_reproductive_image'] != '') {
                            // Split the image filenames by comma
                            var imageFilenamesRepro = value['crop_reproductive_image'].split(',');
                            // Iterate over each filename and append an image element to the preview container
                            imageFilenamesRepro.forEach(function(filename) {
                                $('#previewReproductiveView').append(`<img src="modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                            });
                        }

                        // setting the available data on the traits tab depending on the category of the selected crop
                        if (value['category_name'] === 'Corn') {
                            // Show the div for Corn
                            $('#cornMorph-View').show();
                            $('#cornAgro-View').show();
                            $('#withoutSensory-View').show();
                            $('#withoutSensory-View-More').show();
                            // Hide the divs for Rice and Root Crop
                            $('#riceMorph-View').hide();
                            $('#riceAgro-View').hide();
                            $('#root_cropMorph-View').hide();
                            $('#root_cropAgro-View').hide();
                            $('#view-sensory-tab').hide();
                            $('#withSensory-View').hide();
                            $('#withSensory-View-More').hide();

                            // morph traits for corn
                            // vegetative state
                            $('#corn-heightView').text(value['corn_plant_height']);
                            $('#corn-leafWidth-View').text(value['corn_leaf_width']);
                            $('#corn-leafLength-View').text(value['corn_leaf_length']);

                            // Reproductive state corn
                            $('#corn-yield-capacity-View').text(value['corn_yield_capacity']);
                            $('#corn-seed-length-View').text(value['seed_length']);
                            $('#corn-seed-width-View').text(value['seed_width']);
                            $('#corn-seed-shape-View').text(value['seed_shape']);
                            $('#corn-seed-color-View').text(value['seed_color']);

                            $('#pest_other_checkView').prop('checked', value['corn_pest_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#pest_other_checkView').prop('checked')) {
                                $('#pest-otherView').removeClass('d-none'); // Remove the 'd-none' class to show the element
                            } else {
                                $('#pest-otherView').addClass('d-none'); // Add the 'd-none' class to hide the element
                            }
                            // Set the value of the 'Other' textarea
                            $('#pestView').val(value['corn_pest_other_desc']);

                            $('#abiotic_other_checkView').prop('checked', value['corn_abiotic_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#abiotic_other_checkView').prop('checked')) {
                                $('#abiotic_otherView').removeClass('d-none');
                            } else {
                                $('#abiotic_otherView').addClass('d-none');
                            }
                            // Set the value of the 'Other' textarea
                            $('#abiotic_other-descView').val(value['corn_abiotic_other_desc']);
                        } else if (value['category_name'] === 'Rice') {
                            // Show the div for Rice
                            $('#riceMorph-View').show();
                            $('#riceAgro-View').show();
                            $('#view-sensory-tab').show();
                            $('#withSensory-View').show();
                            $('#withSensory-View-More').show();
                            // Hide the divs for Corn and Root Crop
                            $('#cornMorph-View').hide();
                            $('#cornAgro-View').hide();
                            $('#root_cropMorph-View').hide();
                            $('#root_cropAgro-View').hide();
                            $('#withoutSensory-View').hide();
                            $('#withoutSensory-View-More').hide();

                            // morph traits for rice
                            // vegetative state
                            $('#rice-height-View').text(value['rice_plant_height']);
                            $('#leafWidth-View').text(value['rice_leaf_width']);
                            $('#leafLength-View').text(value['rice_leaf_length']);
                            $('#tilleringAbility-View').text(value['rice_tillering_ability']);
                            $('#rice-maturityTime-View').text(value['rice_maturity_time']);

                            // Reproductive state rice
                            $('#rice-yield-capacity-View').text(value['rice_yield_capacity']);
                            // panicle traits
                            $('#pan-length-View').text(value['panicle_length']);
                            $('#pan-width-View').text(value['panicle_width']);
                            $('#pan-enclosed-View').text(value['panicle_enclosed_by']);
                            $('#pan-features-View').text(value['panicle_remarkable_features']);

                            // seed traits
                            $('#rice-seed-length-View').text(value['seed_length']);
                            $('#rice-seed-width-View').text(value['seed_width']);
                            $('#rice-seed-shape-View').text(value['seed_shape']);
                            $('#rice-seed-color-View').text(value['seed_color']);

                            // flag leaf traits
                            $('#flag-length-View').text(value['flag_length']);
                            $('#flag-width-View').text(value['flag_width']);
                            $('#Pubescence-View').text(value['pubescence']);
                            $('#flag-features-View').text(value['flag_remarkable_features']);
                            $('#purplishStripes-View').prop('checked', value['purplish_stripes']);

                            // sensory traits of cooked rice
                            $('#sensory-aroma-View').val(value['aroma']);
                            $('#cooked-rice-View').val(value['quality_cooked_rice']);
                            $('#leftover-rice-View').val(value['quality_leftover_rice']);
                            // volume expansion and Glutinous
                            $('#volExpansionView').prop('checked', value['volume_expansion']);
                            $('#glutinousityView').prop('checked', value['glutinous']);
                            // hardness
                            if (value['hardness'] === 'Soft') {
                                $('#hardness-Soft-View').prop('checked', true);
                            } else if (value['hardness'] === 'Hard') {
                                $('#hardness-Hard-View').prop('checked', true);
                            }

                            $('#pest_other_checkView').prop('checked', value['rice_pest_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#pest_other_checkView').prop('checked')) {
                                $('#pest-otherView').removeClass('d-none'); // Remove the 'd-none' class to show the element
                            } else {
                                $('#pest-otherView').addClass('d-none'); // Add the 'd-none' class to hide the element
                            }
                            // Set the value of the 'Other' textarea
                            $('#pestView').val(value['rice_pest_other_desc']);

                            $('#abiotic_other_checkView').prop('checked', value['rice_abiotic_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#abiotic_other_checkView').prop('checked')) {
                                $('#abiotic_otherView').removeClass('d-none');
                            } else {
                                $('#abiotic_otherView').addClass('d-none');
                            }
                            // Set the value of the 'Other' textarea
                            $('#abiotic_other-descView').val(value['rice_abiotic_other_desc']);
                        } else if (value['category_name'] === 'Root Crop') {
                            // Show the div for Root Crop
                            $('#root_cropMorph-View').show();
                            $('#root_cropAgro-View').show();
                            $('#withoutSensory-View').show();
                            $('#withoutSensory-View-More').show();
                            // Hide the divs for Corn and Rice
                            $('#cornMorph-View').hide();
                            $('#cornAgro-View').hide();
                            $('#riceMorph-View').hide();
                            $('#riceAgro-View').hide();
                            $('#view-sensory-tab').hide();
                            $('#withSensory-View').hide();
                            $('#withSensory-View-More').hide();

                            // morph traits for rootCrop
                            // vegetative state
                            $('#rootCrop-height-View').text(value['rootcrop_plant_height']);
                            $('#rootCrop-leafWidth-View').text(value['rootcrop_leaf_width']);
                            $('#rootCrop-leafLength-View').text(value['rootcrop_leaf_length']);
                            $('#rootCrop-steam-leaf-desc-View').text(value['rootcrop_stem_leaf_desc']);

                            // Reproductive state rootCrop
                            // Root Crop traits
                            $('#rootCrop-eating-quality-View').text(value['eating_quality']);
                            $('#rootCrop-color-View').text(value['rootcrop_color']);
                            $('#rootCrop-sweetness-View').text(value['sweetness']);
                            $('#rootCrop-remarkableFeatures-View').text(value['rootcrop_remarkable_features']);

                            $('#pest_other_checkView').prop('checked', value['rootcrop_pest_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#pest_other_checkView').prop('checked')) {
                                $('#pest-otherView').removeClass('d-none'); // Remove the 'd-none' class to show the element
                            } else {
                                $('#pest-otherView').addClass('d-none'); // Add the 'd-none' class to hide the element
                            }
                            // Set the value of the 'Other' textarea
                            $('#pestView').val(value['rootcrop_pest_other_desc']);

                            $('#abiotic_other_checkView').prop('checked', value['rootcrop_abiotic_other']);
                            // Show the 'Other' textarea if 'other' checkbox is checked
                            if ($('#abiotic_other_checkView').prop('checked')) {
                                $('#abiotic_otherView').removeClass('d-none');
                            } else {
                                $('#abiotic_otherView').addClass('d-none');
                            }
                            // Set the value of the 'Other' textarea
                            $('#abiotic_other-descView').val(value['rootcrop_abiotic_other_desc']);
                        } else {
                            // Default case, hide all divs
                            $('#corn-View').hide();
                            $('#riceMorph-View').hide();
                            $('#root_cropMorph-View').hide();
                        }

                        // pest resistances
                        if (value['pest_resistances']) {
                            var pestIds = value['pest_resistances'].replace('{', '').replace('}', '').split(',').map(Number).filter(Boolean); // Remove curly braces, convert string to array of numbers, and remove NaN and falsy values
                            pestIds.forEach(function(pest_id) {
                                $('#pest_resistance_View' + pest_id).prop('checked', true);
                            });
                            //console.log(pestIds);
                        }

                        // disease resistance
                        if (value['disease_resistances']) {
                            var diseaseIds = value['disease_resistances'].replace('{', '').replace('}', '').split(',').map(Number).filter(Boolean); // Remove curly braces, convert string to array of numbers, and remove NaN and falsy values
                            diseaseIds.forEach(function(disease_id) {
                                $('#disease_resistance_View' + disease_id).prop('checked', true);
                            });
                            //console.log(diseaseIds);
                        }

                        // abiotic resistance
                        if (value['abiotic_resistances']) {
                            var abioticIds = value['abiotic_resistances'].replace('{', '').replace('}', '').split(',').map(Number).filter(Boolean); // Remove curly braces, convert string to array of numbers, and remove NaN and falsy values
                            abioticIds.forEach(function(abiotic_id) {
                                $('#abiotic_resistance_View' + abiotic_id).prop('checked', true);
                            });
                            //console.log(abioticIds);
                        }

                        // crop_id
                        $('#crop_idView').val(id);
                        // statusID
                        $('#statusIDView').val(value['status_id']);
                        // referencesID
                        $('#referencesIDView').val(value['references_id']);
                        // categoryID
                        $('#categoryIDView').val(value['category_id']);
                        // current_crop_variety
                        $('#current_crop_varietyView').val(value['crop_variety']);
                        // currentUniqueCode
                        $('#currentUniqueCodeView').val(value['unique_code']);
                        // crop_location_id
                        $('#crop_location_idView').val(value['crop_location_id']);
                        // characteristics_id
                        $('#Char_idView').val(value['characteristics_id']);
                        // cultural_aspect_id
                        $('#cultural_aspect-View').val(value['cultural_aspect_id']);
                        // disease_resistanceID
                        $('#disease_resistanceIDView').val(value['disease_resistance_id']);
                        // seed_traitsID
                        $('#seed_traitsIDView').val(value['seed_traits_id']);
                        // utilization_culturalID
                        $('#utilization_culturalIDView').val(value['utilization_cultural_id']);
                        // abiotic_resistanceID and abiotic_resistance_riceID
                        $('#abiotic_resistanceIDView').val(value['abiotic_resistance_id']);
                        $('#abiotic_resistance_riceIDView').val(value['abiotic_resistance_rice_id']);

                        // id for corn
                        $('#corn_traitsIDView').val(value['corn_traits_id']);
                        $('#vegetative_state_cornIDView').val(value['vegetative_state_corn_id']);
                        $('#reproductive_state_cornIDView').val(value['reproductive_state_corn_id']);
                        $('#pest_resistance_cornIDView').val(value['pest_resistance_corn_id']);
                        $('#corn_pest_otherIDView').val(value['corn_pest_other_id']);
                        $('#corn_abiotic_otherIDView').val(value['corn_abiotic_other_id']);

                        // id for rice
                        $('#rice_traitsIDView').val(value['rice_traits_id']);
                        $('#pest_resistance_riceIDView').val(value['pest_resistance_rice_id']);
                        $('#vegetative_state_riceIDView').val(value['vegetative_state_rice_id']);
                        $('#reproductive_state_riceIDView').val(value['reproductive_state_rice_id']);
                        $('#panicle_traits_riceIDView').val(value['panicle_traits_rice_id']);
                        $('#flag_leaf_traits_riceIDView').val(value['flag_leaf_traits_rice_id']);
                        $('#sensory_traits_riceIDView').val(value['sensory_traits_rice_id']);
                        $('#rice_pest_otherIDView').val(value['rice_pest_other_id']);
                        $('#rice_abiotic_otherIDView').val(value['rice_abiotic_other_id']);

                        // id for root crop
                        $('#root_crop_traitsIDView').val(value['root_crop_traits_id']);
                        $('#vegetative_state_rootcropIDView').val(value['vegetative_state_rootcrop_id']);
                        $('#pest_resistance_rootcropIDView').val(value['pest_resistance_rootcrop_id']);
                        $('#rootcrop_traitsIDView').val(value['rootcrop_traits_id']);
                        $('#corn_pest_otherIDView').val(value['corn_pest_other_id']);
                        $('#rootcrop_pest_otherIDView').val(value['rootcrop_pest_other_id']);
                        $('#rootcrop_abiotic_otherIDView').val(value['rootcrop_abiotic_other_id']);

                        // old image/current image
                        $('#old_image_seedView').val(value['crop_seed_image']);
                        $('#old_image_vegView').val(value['crop_vegetative_image']);
                        $('#old_image_repView').val(value['crop_reproductive_image']);
                        // Format the input_date
                        $('#input_dateView').text(moment(value['input_date']).format('YYYY-MM-DD HH:mm'));

                        $('#CategoryView').text(value['category_name']);
                        $('#categoryVarietyView').text(value['category_variety_name']);
                        $('#firstNameView').text(value['first_name']);
                        $('#uniqueCodeView').text(value['unique_code']);

                        // example ni sya kung gusto nimo i dikit ang duwa ka value
                        // $('#crop_variety').val(value['unique_code'] + '(' + value['crop_variety'] + ') ');

                        $('#crop_varietyView').text(value['crop_variety']);
                        $('#descriptionView').text(value['crop_description']);
                        $('#nameMeaningView').text(value['meaning_of_name']);
                        // terrain name
                        $('#categoryTerrainView').text(value['terrain_name']);

                        // Utilization and Cultural Importance
                        $('#SignificanceView').text(value['significance']);
                        $('#UseView').text(value['use']);
                        $('#indigenous-utilization-View').text(value['indigenous_utilization']);
                        $('#remarkable-features-View').text(value['remarkable_features']);

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
                                $('#new-url-container-View').append(`
                                    <div class="url-list-item-view mb-2">
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
                        $('#ProvinceView').text(value['province_name']);
                        $('#MunicipalitySelectView').text(value['municipality_name']);
                        $('#BarangaySelectView').text(value['barangay_name']);
                        $('#SitioView').text(value['sitio_name']);
                        // coordInput
                        $('#coordView').text(value['coordinates']);
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
                                var markerView = L.marker([lat, lng]).addTo(mapView);
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
            const dataModalView = new bootstrap.Modal(document.getElementById('view-item-modal'), {
                keyboard: false
            });
            dataModalView.show();
        });
    });

    // tab switching
    // next button
    function switchTabView(tabName) {
        // prevent submitting the form
        event.preventDefault();

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }
</script>

<!-- SCRIPT for closing the modal -->
<script>
    // Function to set up event listeners for the modal
    function setupModalEventListenersView() {
        // Remove event listeners to prevent duplication
        document.getElementById('close-modal-btn-View').removeEventListener('click', closeModalView);
        document.getElementById('cancel-modal-btn-View').removeEventListener('click', closeModalView);
        document.getElementById('cancel-modal-btn-update').removeEventListener('click', closeModalView);
        document.getElementById('rejectButton-View').removeEventListener('click', rejectModalView);

        // Event listener for the close button
        document.getElementById('close-modal-btn-View').addEventListener('click', closeModalView);

        // Event listener for the cancel button
        document.getElementById('cancel-modal-btn-View').addEventListener('click', closeModalView);
        document.getElementById('cancel-modal-btn-update').addEventListener('click', closeModalView);
        document.getElementById('rejectButton-View').addEventListener('click', rejectModalView);

    }

    // Global variable to store the modal instance
    var confirmModalInstanceView;

    // Custom function to close the modal
    function closeModalView() {
        var addModal = document.getElementById('view-item-modal');
        var addModalInstance = bootstrap.Modal.getInstance(addModal);
        addModalInstance.hide();

        // Remove the modal backdrop
        $('.modal-backdrop').remove();
    }

    function rejectModalView(event) {
        // Prevent the default behavior of the button (e.g., form submission)
        event.preventDefault();

        // Get the modal element
        var confirmModalView = document.getElementById('confirmModalView');

        // Create a new Bootstrap modal instance if it doesn't exist
        if (!confirmModalInstanceView) {
            confirmModalInstanceView = new bootstrap.Modal(confirmModalView);
        }

        // Show the confirmation modal
        confirmModalInstanceView.show();

        // to show which button should show on the confirm modal
        document.getElementById('confirmCloseBtnView').style.display = 'none';
        document.getElementById('confirmRejectBtnView').style.display = 'block';
        // to show which label should show on the confirm modal
        document.getElementById('close-labelView').style.display = 'none';
        document.getElementById('reject-labelView').style.display = 'block';
    }

    // Event listener for when the modal is shown
    document.getElementById('view-item-modal').addEventListener('shown.bs.modal', function() {
        setupModalEventListenersView();
    });

    // Event listener for when the confirmation modal is hidden
    document.getElementById('confirmModalView').addEventListener('hidden.bs.modal', function() {
        // Reset the confirmModalInstanceView
        confirmModalInstanceView = null;
    });
</script>