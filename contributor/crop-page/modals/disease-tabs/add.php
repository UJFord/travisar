<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Add Diseases</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" action="modals/crud-code/disease-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="mb-3">
                        <button type="button" id="add-row" class="btn btn-secondary" style="margin-left: 10px; background-color: var(--mainBrand);">Add</button>
                    </div>
                    <div class="container">
                        <div id="locationData">
                            <!-- Disease -->
                            <div class="row mb-3 disease-row">
                                <!-- Disease name -->
                                <div class="col-5">
                                    <label for="disease-Name_1" class="form-label small-font">Disease Name<span style="color: red;">*</span></label>
                                    <input type="text" name="disease_name_1" id="disease-Name_1" class="form-control">
                                    <div id="error-messages_1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
                        <input type="hidden" name="save">
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="save" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- for submission -->
<script>
    // for adding and removing rows dynamically
    // i set the names for each input field to be unique name attribute 
    // (province_name_1, province_name_2 and so on)
    // for when the form is submitted hiwalay ang pag save
    document.addEventListener('DOMContentLoaded', function() {
        const addRowButton = document.getElementById('add-row');
        const locationData = document.getElementById('locationData');
        let rowCounter = 1;

        addRowButton.addEventListener('click', function() {
            rowCounter++;
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-3', 'disease-row');
            newRow.innerHTML = `
                <div class="col-5">
                    <label for="disease-Name_${rowCounter}" class="form-label small-font">Disease Name<span style="color: red;">*</span></label>
                    <input type="text" name="disease_name_${rowCounter}" id="disease-Name_${rowCounter}" class="form-control">

                </div>
                <div class="col-2" style="padding-top: 25px;">
                    <button type="button" class="btn btn-secondary remove-row" style="background-color: #dc3545;">Remove</button>
                </div>
            `;
            locationData.appendChild(newRow);
        });

        locationData.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.disease-row').remove();
            }
        });

        window.addEventListener('beforeunload', function(e) {
            // Reset the form data here
            locationData.innerHTML = '';
            rowCounter = 1; // Reset the row counter
        });
    });

    document.getElementById('form-panel').addEventListener('submit', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        if (validateForm()) {
            // console.log('Submit add');
            checkDiseaseExists();
        }
    });
    // Function to validate input
    function validateForm() {
        var diseaseNameInputs = document.querySelectorAll('input[name^="disease_name_"]');
        var isValid = true;

        diseaseNameInputs.forEach(function(input, index) {
            var diseaseName = input.value.trim();
            var errorMessageId = "error-messages_" + (index + 1); // Generate unique error message id for each row
            var errorMessageContainer = document.getElementById(errorMessageId);

            if (diseaseName === "") {
                // Show error message if disease name is empty
                var errorMessage = "<div class='error text-center' style='color:red;'>Please fill up required fields.</div>";
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
                // No error, clear error message container
                if (errorMessageContainer) {
                    errorMessageContainer.innerHTML = "";
                }
            }

            // Update or create error message container
            if (errorMessageContainer && errorMessage) {
                errorMessageContainer.innerHTML = errorMessage;
            } else if (errorMessage) {
                var newErrorMessageContainer = document.createElement('div');
                newErrorMessageContainer.id = errorMessageId;
                newErrorMessageContainer.innerHTML = errorMessage;
                input.parentNode.appendChild(newErrorMessageContainer);
            }
        });

        return isValid;
    }


    // Function to check if disease name already exists
    function checkDiseaseExists() {
        var inputs = document.querySelectorAll('[id^="disease-Name_"]');
        var diseaseNames = Array.from(inputs).map(input => input.value.trim());
        var hasError = false; // Flag to track if any error occurs

        // Send a GET request to check if the disease names already exist
        diseaseNames.forEach(function(diseaseName, index) {
            $.ajax({
                url: "modals/fetch/fetch_disease-tab.php",
                method: "GET",
                data: {
                    'check_disease': diseaseName
                },
                success: function(data) {
                    if (data.exists) {
                        // Disease name already exists, show error message
                        var errorMessageId = "error-messages_" + (index + 1);
                        var errorMessageContainer = document.getElementById(errorMessageId);
                        if (errorMessageContainer) {
                            errorMessageContainer.innerHTML = "<div class='error text-center' style='color:red;'>Disease name, " + diseaseName + " already exists for Row " + (index + 1) + "</div>";
                        }
                        hasError = true; // Set flag to true if error occurs
                        event.preventDefault();
                    } else {
                        // Disease name doesn't exist
                        if (!hasError && index === diseaseNames.length - 1) {
                            // If no error encountered so far and it's the last iteration, submit the form
                            submitForm();
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Disease name check error:", textStatus, errorThrown);
                    hasError = true; // Set flag to true if error occurs
                }
            });
        });
    }

    // Function to submit the form and refresh notifications
    function submitForm() {
        console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel');
        // Trigger the form submission
        if (form) {
            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "modals/crud-code/disease-code.php",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
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

<!-- script for blur event -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to add blur event listener to disease name input field
        function addBlurEventListener(input) {
            input.addEventListener('blur', function() {
                // Call a function to validate the input when it loses focus
                validateDiseaseName(input);
            });
        }

        // Function to validate disease name input
        function validateDiseaseName(input) {
            var diseaseName = input.value.trim();
            var errorMessageId = input.id.replace('disease-Name_', 'error-messages_');
            var errorMessageContainer = document.getElementById(errorMessageId);

            if (diseaseName === "") {
                // Show error message if disease name is empty
                showErrorMessage(errorMessageContainer, "Please fill up required field.");
                input.classList.add('is-invalid');
            } else {
                // Remove error message and invalid class if disease name is not empty
                hideErrorMessage(errorMessageContainer);
                input.classList.remove('is-invalid');
            }
        }

        // Function to show error message
        function showErrorMessage(container, message) {
            if (container) {
                container.innerHTML = "<div class='error text-center' style='color:red;'>" + message + "</div>";
            }
        }

        // Function to hide error message
        function hideErrorMessage(container) {
            if (container) {
                container.innerHTML = "";
            }
        }

        // Add blur event listener to existing disease name input fields
        var existingDiseaseNameInputs = document.querySelectorAll('input[name^="disease_name_"]');
        existingDiseaseNameInputs.forEach(function(input) {
            addBlurEventListener(input);
        });

        // Add click event listener to the "Add" button to handle dynamically added rows
        var addRowButton = document.getElementById('add-row');
        if (addRowButton) {
            addRowButton.addEventListener('click', function() {
                // Select the newly added disease name input field
                var newRow = document.querySelector('.disease-row:last-child input[name^="disease_name_"]');
                if (newRow) {
                    // Add blur event listener to the newly added disease name input field
                    addBlurEventListener(newRow);
                }
            });
        }
    });
</script>