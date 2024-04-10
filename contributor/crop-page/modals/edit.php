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
            <form id="form-panel" name="Form" action="crop-page/modals/crud-code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="py-3 px-5">
                <div class="modal-body edit-modal-body">
                    <!-- TAB LIST NAVIGATION -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active small-font modal-tab" id="edit-gen-tab" data-bs-toggle="tab" data-bs-target="#edit-gen-tab-pane" type="button" role="tab" aria-controls="edit-gen-tab-pane" aria-selected="true"><i class="fa-solid fa-lightbulb me-1"></i>General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="edit-more-tab" data-bs-toggle="tab" data-bs-target="#edit-more-tab-pane" type="button" role="tab" aria-controls="edit-more-tab-pane" aria-selected="false"><i class="fa-solid fa-leaf me-1"></i>Traits</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="edit-loc-tab" data-bs-toggle="tab" data-bs-target="#edit-loc-tab-pane" type="button" role="tab" aria-controls="edit-loc-tab-pane" aria-selected="false"><i class="fa-solid fa-location-dot me-1"></i>Location</button>
                        </li>
                    </ul>
                    <div class="container">
                        <div class="tab-content mt-2">
                            <!-- general -->
                            <?php require "edit-tabs/gen.php" ?>
                            <!-- location -->
                            <?php require "edit-tabs/loc.php" ?>
                            <!-- more optional info -->
                            <?php require "edit-tabs/more.php" ?>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <div class="">
                        <button type="submit" name="edit" class="btn btn-success">Save</button>
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <button type="button" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- script for getting the on the edit -->
<script>
    document.getElementById('form-panel').addEventListener('submit', function(event) {
        var isValid = true;
        // Check if any required fields are empty
        var requiredFields = document.querySelectorAll('input[required], select[required], textarea[required]');
        requiredFields.forEach(function(field) {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            // Prevent the form from submitting
            event.preventDefault();
            event.stopPropagation();
            return false;
        }

        // Form is valid, submit the form
        submitForm();
    });

    // Function to submit the form and refresh notifications
    function submitForm() {
        console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel');
        // Trigger the form submission
        if (form) {
            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "crop-page/modals/crud-code/code.php",
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
                url: 'crop-page/modals/fetch/fetch_crop-edit.php',
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
                        console.log(value['corn_borers']);

                        // // Iterate over each filename and append an image element to the preview container
                        // imageFilenames.forEach(function(filename) {
                        //     $('#previewEdit').append(`<img src="crop-page/modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                        // });

                        // Fetch the old image and pass it to the fetchOldImage function
                        fetchOldImage(value.crop_image);

                        // setting the available data on the traits tab depending on the category of the selected crop
                        if (value['category_name'] === 'Corn') {
                            // Show the div for Corn
                            $('#cornMorph-Edit').show();
                            // Hide the divs for Rice and Root Crop
                            $('#riceMorph-Edit').hide();
                            $('#root_cropMorph-Edit').hide();

                            // morph traits for corn
                            // vegetative state
                            if (value['corn_plant_height'] === 'Tall') {
                                $('#corn-height-tall-edit').prop('checked', true);
                            } else if (value['corn_plant_height'] === 'Average') {
                                $('#corn-height-average-edit').prop('checked', true);
                            } else if (value['corn_plant_height'] === 'Short') {
                                $('#corn-height-short-edit').prop('checked', true);
                            }
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
                            $('#corn-Salinity-Edit').prop('checked', value['salnity'] == 1);
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
                            // Hide the divs for Corn and Root Crop
                            $('#cornMorph-Edit').hide();
                            $('#root_cropMorph-Edit').hide();

                            // morph traits for rice
                            // vegetative state
                            if (value['rice_plant_height'] === 'Tall') {
                                $('#height-tall-edit').prop('checked', true);
                            } else if (value['rice_plant_height'] === 'Average') {
                                $('#height-average-edit').prop('checked', true);
                            } else if (value['rice_plant_height'] === 'Short') {
                                $('#height-short-edit').prop('checked', true);
                            }
                            $('#leafWidth-Edit').append($('<option>', {
                                value: value['rice_leaf_width']
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
                            $('#purplishStripes-Edit').val(value['purplish_stripes']);
                            $('#Pubescence-Edit').val(value['pubescence']);
                            $('#flag-features-Edit').val(value['flag_remarkable_features']);

                            // sensory traits of cooked rice
                            $('#sensory-aroma-Edit').val(value['aroma']);
                            $('#cooked-rice-Edit').val(value['quality_cooked_rice']);
                            $('#leftover-rice-Edit').val(value['quality_leftover_rice']);
                            // volume expansion
                            if (value['volume_expansion'] === 'Yes') {
                                $('#expansion-Yes-Edit').prop('checked', true);
                            } else if (value['volume_expansion'] === 'No') {
                                $('#expansion-No-Edit').prop('checked', true);
                            }
                            // glutinous
                            if (value['glutinous'] === 'Yes') {
                                $('#glutinous-Yes-Edit').prop('checked', true);
                            } else if (value['glutinous'] === 'No') {
                                $('#glutinous-No-Edit').prop('checked', true);
                            }
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
                            $('#riceDrought-Edit').prop('checked', value['drought'] == 1);
                            $('#riceSalinity-Edit').prop('checked', value['salnity'] == 1);
                            $('#riceHeat-Edit').prop('checked', value['heat'] == 1);
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
                            // Hide the divs for Corn and Rice
                            $('#cornMorph-Edit').hide();
                            $('#riceMorph-Edit').hide();
                        } else {
                            // Default case, hide all divs
                            $('#cornMorph-Edit').hide();
                            $('#riceMorph-Edit').hide();
                            $('#root_cropMorph-Edit').hide();
                        }

                        // crop_id
                        $('#crop_id').val(id);
                        // crop_location_id
                        $('#crop_location_id').val(value['crop_location_id']);
                        // terrain name
                        $('#categoryTerrainEdit').text(value['terrain_name']);
                        // characteristics_id
                        $('#Char_id').val(value['characteristics_id']);
                        // cultural_aspect_id
                        $('#cultural_aspect-Edit').val(value['cultural_aspect_id']);

                        // old image/current image
                        $('#oldImageInput').val(value['crop_image']);
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
</script>