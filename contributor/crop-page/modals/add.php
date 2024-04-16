<!-- STYLE -->
<style>
    .modal-tab:hover {
        color: grey;
    }
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Add Crop</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel-add" name="Form" action="crop-page/modals/crud-code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="py-3 px-5">
                <div class="modal-body">
                    <!-- TAB LIST NAVIGATION -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active small-font modal-tab" id="gen-tab" data-bs-toggle="tab" data-bs-target="#gen-tab-pane" type="button" role="tab" aria-controls="gen-tab-pane" aria-selected="false"><i class="fa-solid fa-lightbulb me-1"></i>General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="more-tab" data-bs-toggle="tab" data-bs-target="#more-tab-pane" type="button" role="tab" aria-controls="more-tab-pane" aria-selected="true"><i class="fa-solid fa-leaf me-1"></i>Morphology</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="sensory-tab" data-bs-toggle="tab" data-bs-target="#sensory-tab-pane" type="button" role="tab" aria-controls="sensory-tab-pane" aria-selected="true"><i class="fa-solid fa-utensils me-1"></i>Sensory</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="agro-tab" data-bs-toggle="tab" data-bs-target="#agro-tab-pane" type="button" role="tab" aria-controls="agro-tab-pane" aria-selected="true"><i class="fa-solid fa-seedling me-1"></i>Agronomy</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small-font modal-tab" id="cultural-tab" data-bs-toggle="tab" data-bs-target="#cultural-tab-pane" type="button" role="tab" aria-controls="cultural-tab-pane" aria-selected="false"><i class="fa-solid fa-sun me-1"></i>Importance</button>
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
                            <?php require "tabs/agro.php" ?>
                            <!-- sensory traits -->
                            <?php require "tabs/sensory.php" ?>
                            <!-- cultural -->
                            <?php require "tabs/cultural.php" ?>

                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <div class="">
                        <button type="submit" name="save" class="btn btn-success">Save</button>
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
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

        // Form is valid, submit the form
        submitForm();
    });

    // Function to submit the form and refresh notifications
    function submitForm() {
        // Get the form reference
        var form = document.getElementById('form-panel-add');
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

<!-- JavaScript for the select for category variety -->
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
        xhr.open('GET', 'crop-page/modals/fetch/fetch_varieties.php?category_id=' + categoryId, true);
        xhr.send();
    }

    document.getElementById('Category').addEventListener('change', function() {
        var categoryId = this.value;
        var categoryVarietySelect = document.getElementById('categoryVariety');
        var categoryVarietySelectContainer = document.getElementById('category-Variety');
        if (categoryId === '3') {
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
        categoryVarietySelect.innerHTML = ''; // Clear existing options
        varieties.forEach(function(variety) {
            var option = document.createElement('option');
            option.value = variety.category_variety_id;
            option.text = variety.category_variety_name;
            categoryVarietySelect.appendChild(option);
        });
    }
</script>

<!-- script for the morphological and agronomic characteristics display -->
<script>
    // Function to display the morphological characteristics based on the selected category
    function showMorphologicalCharacteristics(categoryId) {
        // morph traits
        var cornMorph = document.getElementById('cornMorph');
        var riceMorph = document.getElementById('riceMorph');
        var rootCropMorph = document.getElementById('root_cropMorph');
        // agronomic traits
        var cornAgro = document.getElementById('cornAgro');
        var riceAgro = document.getElementById('riceAgro');
        var rootCropAgro = document.getElementById('root_cropAgro');

        // sensory tab
        var sensoryTab = document.getElementById('sensory-tab');
        var withSensory = document.getElementById('withSensory');
        var withoutSensory = document.getElementById('withoutSensory');
        var withSensory_More = document.getElementById('withSensory-More');
        var withoutSensory_More = document.getElementById('withoutSensory-More');

        // Hide all morphological characteristics sections
        cornMorph.style.display = 'none';
        riceMorph.style.display = 'none';
        rootCropMorph.style.display = 'none';

        // Hide all agronomic characteristics sections
        cornAgro.style.display = 'none';
        riceAgro.style.display = 'none';
        rootCropAgro.style.display = 'none';

        // Hide rice sensory tab
        sensoryTab.style.display = 'none';
        withSensory.style.display = 'none';
        withoutSensory.style.display = 'none';
        withSensory_More.style.display = 'none';
        withoutSensory_More.style.display = 'none';

        // Show the relevant morphological characteristics section based on selected category
        if (categoryId === '4') {
            cornMorph.style.display = 'block';
            cornAgro.style.display = 'block';
            withoutSensory.style.display = 'block';
            withoutSensory_More.style.display = 'block';
        } else if (categoryId === '1') {
            riceMorph.style.display = 'block';
            riceAgro.style.display = 'block';
            sensoryTab.style.display = 'block';
            withSensory.style.display = 'block';
            withSensory_More.style.display = 'block';
        } else if (categoryId === '2') {
            rootCropMorph.style.display = 'block';
            rootCropAgro.style.display = 'block';
            withoutSensory.style.display = 'block';
            withoutSensory_More.style.display = 'block';
        }
    }

    // Function to display the morphological and agronomy tab data based on the selected category
    function noCategory(categoryId) {
        // Your existing code to show/hide sections based on the category...

        // Check if the categoryId is empty or null
        if (!categoryId) {
            // Show an alert to prompt the user to select a crop category
            alert('Please select a crop category to view the data in this tab.');
        }
    }

    // Add event listeners to the "More" and "Agro" tabs
    document.getElementById('more-tab').addEventListener('click', function() {
        noCategory(document.getElementById('Category').value);
    });

    document.getElementById('agro-tab').addEventListener('click', function() {
        noCategory(document.getElementById('Category').value);
    });
</script>