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