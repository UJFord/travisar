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
            <form id="form-panel" name="Form" action="crop-page/modals/crud-code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body edit-modal-body">
                    <!-- TAB LIST NAVIGATION -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active small-font modal-tab" id="edit-gen-tab" data-bs-toggle="tab" data-bs-target="#edit-gen-tab-pane" type="button" role="tab" aria-controls="edit-gen-tab-pane" aria-selected="true"><i class="fa-solid fa-info me-1"></i>General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="edit-loc-tab" data-bs-toggle="tab" data-bs-target="#edit-loc-tab-pane" type="button" role="tab" aria-controls="edit-loc-tab-pane" aria-selected="false"><i class="fa-solid fa-location-dot me-1"></i>Location</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="edit-more-tab" data-bs-toggle="tab" data-bs-target="#edit-more-tab-pane" type="button" role="tab" aria-controls="edit-more-tab-pane" aria-selected="false"><i class="fa-solid fa-ellipsis me-1"></i>More</button>
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
        // console.log('submitForm function called');
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
                        console.log(value['unique_code']);

                        // Split the image filenames by comma
                        var imageFilenames = value['crop_image'].split(',');

                        // Iterate over each filename and append an image element to the preview container
                        imageFilenames.forEach(function(filename) {
                            $('#previewEdit').append(`<img src="crop-page/modals/img/${filename.trim()}" class="m-2 img-thumbnail" style="height: 200px;">`);
                        });

                        // Fetch the old image and pass it to the fetchOldImage function
                        fetchOldImage(value.crop_image);

                        // crop_id
                        $('#crop_id').val(id);
                        // crop_location_id
                        $('#crop_location_id').val(value['crop_location_id']);
                        // crop_field_id
                        $('#crop_field_id').val(value['crop_field_id']);
                        // characteristics_id
                        $('#Char_id').val(value['characteristics_id']);
                        // cultural_aspect_id
                        $('#cultural_aspect-Edit').val(value['cultural_aspect_id']);

                        // old image/current image
                        $('#oldImageInput').val(value['crop_image']);
                        // Format the input_date
                        $('#input_dateEdit').text(moment(value['input_date']).format('YYYY-MM-DD HH:mm'));

                        // Check if the category is 'other' and show/hide the otherCategoryInputEdit div accordingly
                        if (value['category_name'] === 'Other') {
                            $('#otherCategoryInputEdit').css('display', 'block');
                            $('#otherCategoryEdit').text(value['other_category_name']);
                        } else {
                            $('#otherCategoryInputEdit').css('display', 'none');
                        }
                        $('#CategoryEdit').text(value['category_name']);
                        $('#fieldEdit').text(value['field_name']);
                        $('#firstName').text(value['first_name']);
                        $('#uniqueCode').text(value['unique_code']);

                        // input elements with the new data on gen.php and loc.php
                        //gen.php

                        // example ni sya kung gusto nimo i dikit ang duwa ka value
                        // $('#crop_variety').val(value['unique_code'] + '(' + value['crop_variety'] + ') ');

                        $('#crop_variety').val(value['crop_variety']);
                        $('#ScienceName').val(value['scientific_name']);
                        $('#LocalName').val(value['crop_local_name']);
                        $('#NameOrigin').val(value['name_origin']);
                        $('#description').val(value['crop_description']);

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

                        // characteristics
                        $('#TasteEdit').val(value['taste']);
                        $('#AromaEdit').val(value['aroma']);
                        $('#MaturationEdit').val(value['maturation']);
                        $('#PestEdit').val(value['pest']);
                        $('#DiseaseEdit').val(value['diseases']);

                        // cultural aspect
                        $('#Cultural-SignificanceEdit').val(value['cultural_significance']);
                        $('#Spiritual-SignificanceEdit').val(value['spiritual_significance']);
                        $('#Cultural-ImportanceEdit').val(value['cultural_importance']);
                        $('#Cultural-UseEdit').val(value['cultural_use']);

                        // Add a marker to the map based on the coordinates
                        var coordinates = value['coordinates'].split(',');
                        var lat = parseFloat(coordinates[0]);
                        var lng = parseFloat(coordinates[1]);
                        var marker = L.marker([lat, lng]).addTo(mapEdit);
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