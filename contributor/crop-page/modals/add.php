<!-- STYLE -->
<style>
    .modal-tab:hover {
        color: grey;
    }

    .modal-header {
        position: relative;
    }

    #close-modal-btn {
        position: fixed;
        right: 21%;
    }
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="add-label">Add Crops</h5>
                <div>
                    <button type="button" id="close-modal-btn" class="btn-close navbar" aria-label="Close" id="navbar-example2" class="navbar navbar-light bg-light px-3"></button>
                </div>
            </div>

            <div id="message-error">
            </div>

            <!-- body -->
            <form id="form-panel-add" name="Form" action="modals/crud-code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="py-3 px-5">
                <div class="modal-body">
                    <!-- TAB LIST NAVIGATION -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active small-font modal-tab text-dark" id="gen-tab" data-bs-toggle="tab" data-bs-target="#gen-tab-pane" type="button" role="tab" aria-controls="gen-tab-pane" aria-selected="false"><i class="fa-solid fa-lightbulb me-1"></i>General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="more-tab" data-bs-toggle="tab" data-bs-target="#more-tab-pane" type="button" role="tab" aria-controls="more-tab-pane" aria-selected="true"><i class="fa-solid fa-leaf me-1"></i>Morphology</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="sensory-tab" data-bs-toggle="tab" data-bs-target="#sensory-tab-pane" type="button" role="tab" aria-controls="sensory-tab-pane" aria-selected="true"><i class="fa-solid fa-utensils me-1"></i>Sensory</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="agro-tab" data-bs-toggle="tab" data-bs-target="#agro-tab-pane" type="button" role="tab" aria-controls="agro-tab-pane" aria-selected="true"><i class="fa-solid fa-seedling me-1"></i>Agronomy</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="cultural-tab" data-bs-toggle="tab" data-bs-target="#cultural-tab-pane" type="button" role="tab" aria-controls="cultural-tab-pane" aria-selected="false"><i class="fa-solid fa-sun me-1"></i>Importance</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab text-dark" id="references-tab" data-bs-toggle="tab" data-bs-target="#references-tab-pane" type="button" role="tab" aria-controls="references-tab-pane" aria-selected="false"><i class="fa-solid fa-book me-1"></i></i>References</button>
                        </li>
                    </ul>
                    <div class="container">
                        <div class="tab-content mt-2">
                            <input type="hidden" name="user_id" value="<?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) {
                                                                            echo $_SESSION['USER']['user_id'];
                                                                        } ?>">
                            <!-- general -->
                            <?php require "tabs/gen.php" ?>
                            <!-- more optional info -->
                            <?php require "tabs/more.php" ?>
                            <!-- agronomic traits -->
                            <?php require "tabs/agro.php"
                            ?>
                            <!-- sensory traits -->
                            <?php require "tabs/sensory.php"
                            ?>
                            <!-- cultural -->
                            <?php require "tabs/cultural.php"
                            ?>
                            <!-- references -->
                            <?php require "tabs/references.php"
                            ?>
                            <!-- confirm -->
                            <?php require "tabs/confirm.php" ?>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
                        <button type="button" id="cancel-modal-btn" class="btn border bg-light">Cancel</button>
                        <button type="submit" id="saveButton" name="save" class="btn btn-success">Save</button>
                        <button type="submit" id="draftButton" name="save_draft" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<!-- <script>
    // keep the modal on
    window.onload = function() {
        const dataModal = new bootstrap.Modal(document.getElementById('add-item-modal'), {
            keyboard: false
        });
        dataModal.show();
    };
</script> -->

<!-- <script>
    // Get the button element
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");

    // When the user scrolls, update the button's position
    window.onscroll = function() {
        // Calculate the new top position of the button
        var topPosition = window.pageYOffset + window.innerHeight - scrollToTopBtn.offsetHeight - 20;

        // Set the button's new top position
        scrollToTopBtn.style.top = topPosition + "px";

        // Show or hide the button based on the scroll position
        if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    };

    // When the user clicks on the button, scroll to the top of the document
    scrollToTopBtn.addEventListener("click", function() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
</script> -->

<!-- SCRIPT for closing the modal -->
<script>
    // Function to set up event listeners for the modal
    function setupModalEventListeners() {
        // Remove event listeners to prevent duplication
        document.getElementById('close-modal-btn').removeEventListener('click', closeModal);
        document.getElementById('cancel-modal-btn').removeEventListener('click', closeModal);

        // Event listener for the close button
        document.getElementById('close-modal-btn').addEventListener('click', closeModal);

        // Event listener for the cancel button
        document.getElementById('cancel-modal-btn').addEventListener('click', closeModal);
    }

    // Global variable to store the modal instance
    var confirmModalInstance;

    // Custom function to close the modal
    function closeModal() {
        // Get the modal element
        var confirmModal = document.getElementById('confirmModal');

        // Create a new Bootstrap modal instance if it doesn't exist
        if (!confirmModalInstance) {
            confirmModalInstance = new bootstrap.Modal(confirmModal);
        }

        // Show the confirmation modal
        confirmModalInstance.show();
    }

    // Event listener for the confirm button click
    document.getElementById('confirmCloseBtn').addEventListener('click', function() {
        var confirmModal = document.getElementById('confirmModal');
        var confirmModalInstance = bootstrap.Modal.getInstance(confirmModal);
        confirmModalInstance.hide();

        var addModal = document.getElementById('add-item-modal');
        var addModalInstance = bootstrap.Modal.getInstance(addModal);
        addModalInstance.hide();
        var form = document.getElementById('form-panel-add');

        // Reset the form
        form.reset();
    });


    // Event listener for when the modal is shown
    document.getElementById('add-item-modal').addEventListener('shown.bs.modal', function() {
        setupModalEventListeners();
    });

    // Event listener for when the confirmation modal is hidden
    document.getElementById('confirmModal').addEventListener('hidden.bs.modal', function() {
        // Reset the confirmModalInstance
        confirmModalInstance = null;
    });
</script>

<!-- for submission -->
<script>
    document.getElementById('form-panel-add').addEventListener('submit', function(event) {
        // Get the selected category
        var selectedCategory = document.getElementById('Category').value;
        var cornMorph = document.getElementById('cornMorph');
        var riceMorph = document.getElementById('riceMorph');
        var rootCropMorph = document.getElementById('root_cropMorph');

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

        // Check if the form is being submitted as a draft
        if (event.submitter.name === 'draft') {
            // console.log('Submit na draft');
            event.target.setAttribute('name', 'draft');
            submitForm();
        } else {
            // Validate the form if not submitted as a draft
            if (validateForm()) {
                // If validation succeeds, submit the form
                submitForm();
            }
        }
    });

    // Function to submit the form and refresh notifications
    function submitForm() {
        // Get the form reference
        var form = document.getElementById('form-panel-add');
        // Trigger the form submission
        if (form) {
            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "modals/crud-code/code.php",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
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

    // Function to validate input
    function validateForm() {
        var categoryID = document.forms["Form"]["category_id"].value;
        var category_varietyID = document.forms["Form"]["category_variety_id"].value;
        var cropVariety = document.forms["Form"]["crop_variety"].value;
        var terrainID = document.forms["Form"]["terrain_id"].value;
        var province = document.forms["Form"]["province"].value;
        var municipality = document.forms["Form"]["municipality"].value;
        var barangay = document.forms["Form"]["barangay"].value;

        var isValid = true;
        var firstErrorElement = null;

        // Check if the required fields are not empty
        if (categoryID === "" || categoryID === null) {
            document.getElementById('Category').classList.add('is-invalid');
            document.getElementById('category-error').innerText = "Please select crop category.";
            isValid = false;
            if (!firstErrorElement) {
                firstErrorElement = document.getElementById('Category');
            }
        } else {
            document.getElementById('Category').classList.remove('is-invalid');
            document.getElementById('category-error').innerText = "";
        }

        if (category_varietyID === null || category_varietyID === "") {
            document.getElementById('categoryVariety').classList.add('is-invalid');
            document.getElementById('categoryVariety-error').innerText = "Please select a category variety.";
            isValid = false;
            if (!firstErrorElement) {
                firstErrorElement = document.getElementById('categoryVariety');
            }
        } else {
            document.getElementById('categoryVariety').classList.remove('is-invalid');
            document.getElementById('categoryVariety-error').innerText = "";
        }

        if (cropVariety === "" || cropVariety === null) {
            document.getElementById('Variety-Name').classList.add('is-invalid');
            document.getElementById('varietyName-error').innerText = "Please enter a variety name.";
            isValid = false;
            if (!firstErrorElement) {
                firstErrorElement = document.getElementById('Variety-Name');
            }
        } else {
            document.getElementById('Variety-Name').classList.remove('is-invalid');
            document.getElementById('varietyName-error').innerText = "";
        }

        if (terrainID === null || terrainID === "") {
            document.getElementById('terrain').classList.add('is-invalid');
            document.getElementById('terrain-error').innerText = "Please enter a terrain name.";
            isValid = false;
            if (!firstErrorElement) {
                firstErrorElement = document.getElementById('terrain');
            }
        } else {
            document.getElementById('terrain').classList.remove('is-invalid');
            document.getElementById('terrain-error').innerText = "";
        }

        if (province === null || province === "") {
            document.getElementById('Province').classList.add('is-invalid');
            document.getElementById('province-error').innerText = "Please enter a province name.";
            isValid = false;
            if (!firstErrorElement) {
                firstErrorElement = document.getElementById('Province');
            }
        } else {
            document.getElementById('Province').classList.remove('is-invalid');
            document.getElementById('province-error').innerText = "";
        }

        if (municipality === null || municipality === "") {
            document.getElementById('Municipality').classList.add('is-invalid');
            document.getElementById('municipality-error').innerText = "Please enter a municipality name.";
            isValid = false;
            if (!firstErrorElement) {
                firstErrorElement = document.getElementById('Municipality');
            }
        } else {
            document.getElementById('Municipality').classList.remove('is-invalid');
            document.getElementById('municipality-error').innerText = "";
        }

        if (barangay === null || barangay === "") {
            document.getElementById('Barangay').classList.add('is-invalid');
            document.getElementById('barangay-error').innerText = "Please enter a barangay name.";
            isValid = false;
            if (!firstErrorElement) {
                firstErrorElement = document.getElementById('Barangay');
            }
        } else {
            document.getElementById('Barangay').classList.remove('is-invalid');
            document.getElementById('barangay-error').innerText = "";
        }

        // Focus on the first element with an error
        if (firstErrorElement) {
            firstErrorElement.focus();
            event.preventDefault(); // Prevent the form from submitting by default
        }

        return isValid;
    }

    // Prevent tab switching when there are validation errors
    var tabPane = document.getElementById('myTab');
    tabPane.addEventListener('show.bs.tab', function(event) {
        if (!validateForm()) {
            // document.getElementById('message-error').innerHTML = "<div class='error text-center' style='color:red;'>To switch tab fill up required fields</div>";
            event.preventDefault();
        } else {
            // document.getElementById('message-error').innerHTML = "";
        }
    });

    function disableInputs(container) {
        var inputs = container.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = true;
        }
    }

    // tab switching
    // next button
    function switchTab(tabName) {
        // prevent submitting the form
        event.preventDefault();

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }
</script>

<!-- JavaScript for the select for category variety ang show the morph, sensory and agro tab -->
<script>
    // JavaScript for the select for category variety
    // Function to fetch and display initial category variety based on the initial category
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch varieties for the initial selected category
        var initialCategoryId = document.getElementById('Category').value;
        fetchVarieties(initialCategoryId);
    });

    // Function to fetch and display initial morphological characteristics based on the initial category
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch the initial category value
        var initialCategoryId = document.getElementById('Category').value;
        // Call the function to display the corresponding morphological characteristics
        showMorphologicalCharacteristics(initialCategoryId);
    });

    // Event listener for changing the category select element
    document.getElementById('Category').addEventListener('change', function() {
        var selectedCategory = this.value;
        // Call the function to display the corresponding morphological characteristics
        showMorphologicalCharacteristics(selectedCategory);
    });

    function fetchVarieties(categoryId) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    var varieties = JSON.parse(this.responseText);
                    populateVarieties(varieties);
                } else {
                    console.error('Failed to fetch varieties. Status:', this.status);
                }
            }
        };
        xhr.onerror = function() {
            console.error('An error occurred during the request.');
        };
        xhr.open('GET', 'modals/fetch/fetch_varieties.php?category_id=' + categoryId, true);
        xhr.send();
    }

    document.getElementById('Category').addEventListener('change', function() {
        var categoryId = this.value;
        var categoryVarietySelect = document.getElementById('categoryVariety');
        var categoryVarietySelectContainer = document.getElementById('category-Variety');
        if (categoryId === '') {
            categoryVarietySelectContainer.style.display = 'none';
        } else {
            categoryVarietySelectContainer.style.display = 'block';
            fetchVarieties(categoryId);
        }

        // Call the function to display the corresponding morphological characteristics
        showMorphologicalCharacteristics(categoryId);
    });

    function populateVarieties(varieties) {
        var categoryVarietySelect = document.getElementById('categoryVariety');
        categoryVarietySelect.innerHTML = '<option value="" disabled selected hidden class="colorize">Select One</option>'; // Clear existing options

        // Add other options
        varieties.forEach(function(variety) {
            var option = document.createElement('option');
            option.value = variety.category_variety_id;
            option.text = variety.category_variety_name;
            categoryVarietySelect.appendChild(option);
        });
    }

    // Function to display the morphological characteristics based on the selected category
    function showMorphologicalCharacteristics(categoryId) {
        // morph traits
        var cornMorph = document.getElementById('cornMorph');
        var riceMorph = document.getElementById('riceMorph');
        var rootCropMorph = document.getElementById('root_cropMorph');

        // sensory tab
        var sensoryTab = document.getElementById('sensory-tab');
        var withSensory = document.getElementById('withSensory');
        var withoutSensory = document.getElementById('withoutSensory');
        var withSensory_More = document.getElementById('withSensory-More');
        var withoutSensory_More = document.getElementById('withoutSensory-More');

        // Hide all sections
        [cornMorph, riceMorph, rootCropMorph, sensoryTab, withSensory, withoutSensory, withSensory_More, withoutSensory_More]
        .forEach(element => {
            if (element) {
                element.style.display = 'none';
            }
        });

        // Show the relevant sections based on selected category
        // check if the category exists
        if (categoryId === '4') {
            [cornMorph, withoutSensory, withoutSensory_More]
            .forEach(element => {
                if (element) {
                    element.style.display = 'block';
                }
            });
        } else if (categoryId === '1') {
            [riceMorph, sensoryTab, withSensory, withSensory_More]
            .forEach(element => {
                if (element) {
                    element.style.display = 'block';
                }
            });
        } else if (categoryId === '2') {
            [rootCropMorph, withoutSensory, withoutSensory_More]
            .forEach(element => {
                if (element) {
                    element.style.display = 'block';
                }
            });
        }
    }
</script>

<!-- script for the morphological and agronomic characteristics display -->
<script>

</script>

<!-- script for getting draft data -->
<script>
    // EDIT SCRIPT
    const tableRowsAdd = document.querySelectorAll('.draft_data');
    // Define an array to store municipalities
    var municipalities = [];

    tableRowsAdd.forEach(row => {

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Use the crop_id as needed
            // console.log("Crop ID: " + id);

            // Assuming you have jQuery available
            $.ajax({
                url: 'modals/fetch/fetch_crop-edit.php',
                type: 'POST',
                data: {
                    'click_draft_btn': true,
                    'crop_id': id,
                },
                success: function(response) {
                    // Handle the response from the PHP script
                    // console.log('Response:', response);

                    // Clear the current preview
                    $('#preview').empty();

                    $.each(response, function(key, value) {
                        // Append options to select element
                        console.log(value['crop_variety']);

                        // set modal name and buttons depending if it is draft or edit
                        if (value['action'] === 'draft') {
                            $('#add-label').text('Draft');
                            $('#draftButton').show();
                            $('#saveButton').hide();
                        } else {
                            $('#add-label').text('Add Crop');
                            $('#saveButton').show();
                            $('#draftButton').hide();
                        }

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

                        $('#desc').val(value['crop_description']);
                        $('#nameMean').val(value['meaning_of_name']);
                        // current_crop_variety
                        $('#Variety-Name').val(value['crop_variety']);
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

                            $('#categoryVariety').append($('<option>', {
                                value: value['category_variety_name'],
                                text: value['category_variety_name'],
                                selected: true, // Make the option selected
                                style: 'display: none;' // Hide the option
                            }));
                        }
                        if (value['terrain_name']) {
                            $('#terrain').append($('<option>', {
                                value: value['terrain_name'],
                                text: value['terrain_name'],
                                selected: true, // Make the option selected
                                style: 'display: none;' // Hide the option
                            }));
                        }
                        if (value['barangay_id']) {
                            $('#Barangay').append($('<option>', {
                                value: value['barangay_id'],
                                text: value['barangay_name'],
                                selected: true,
                                style: 'display: none;'
                            }));
                        }
                        if (value['municipality_id']) {
                            $('#Municipality').append($('<option>', {
                                value: value['municipality_id'],
                                text: value['municipality_name'],
                                selected: true,
                                style: 'display: none;'
                            }));
                        }

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
        });
    });
</script>