<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Add Abiotic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" action="modals/crud-code/abiotic-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="mb-3">
                        <button type="button" id="add-row" class="btn btn-secondary" style="margin-left: 10px; background-color: var(--mainBrand);">Add</button>
                    </div>
                    <div class="container">
                        <div id="locationData">
                            <!-- abiotic -->
                            <div class="row mb-3 abiotic-row">
                                <!-- abiotic name -->
                                <div class="col-5">
                                    <label for="abiotic-Name_1" class="form-label small-font">Abiotic Name<span style="color: red;">*</span></label>
                                    <input type="text" name="abiotic_name_1" id="abiotic-Name_1" class="form-control">
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
<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Other JavaScript code here...

        const addRowButton = document.getElementById('add-row');
        const locationData = document.getElementById('locationData');
        let rowCounter = 1;

        addRowButton.addEventListener('click', function() {
            rowCounter++;
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-3', 'abiotic-row');
            newRow.innerHTML = `
                <div class="col-5">
                    <label for="abiotic-Name_${rowCounter}" class="form-label small-font">Abiotic Name<span style="color: red;">*</span></label>
                    <input id="abiotic-Name_${rowCounter}" type="text" name="abiotic_name_${rowCounter}" class="form-control">
                    <div id="error-messages_${rowCounter}" class="error-messages"></div>
                </div>
                <div class="col-2" style="padding-top: 25px;">
                    <button type="button" class="btn btn-secondary remove-row" style="background-color: #dc3545;">Remove</button>
                </div>
            `;
            locationData.appendChild(newRow);

            // Add event listener for blur event to the newly added input field
            const newAbioticNameInput = newRow.querySelector(`#abiotic-Name_${rowCounter}`);
            newAbioticNameInput.addEventListener('blur', function(event) {
                validateAbioticName(event.target);
            });
        });

        // Add blur event listeners to existing input fields
        const existingAbioticNameInputs = document.querySelectorAll('input[name^="abiotic_name_"]');
        existingAbioticNameInputs.forEach(function(input) {
            input.addEventListener('blur', function(event) {
                validateAbioticName(event.target);
            });
        });

        locationData.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.abiotic-row').remove();
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
            checkAbioticExists();
        }
    });
    // Function to validate input
    function validateForm() {
        var isValid = true;
        var abioticNameInputs = document.querySelectorAll('input[name^="abiotic_name_"]');

        abioticNameInputs.forEach(function(input) {
            if (!validateAbioticName(input)) {
                isValid = false;
            }
        });

        return isValid;
    }

    // Function to validate abiotic name
    function validateAbioticName(input) {
        var abioticName = input.value.trim();
        var errorMessageContainer = input.parentNode.querySelector('.error-messages');
        var isValid = true;

        if (abioticName === "") {
            isValid = false;
            var errorMessage = "<div class='error text-center' style='color:red;'>Please fill up required fields.</div>";
            if (errorMessageContainer) {
                errorMessageContainer.innerHTML = errorMessage;
            } else {
                var newErrorMessageContainer = document.createElement('div');
                newErrorMessageContainer.className = 'error-messages';
                newErrorMessageContainer.innerHTML = errorMessage;
                input.parentNode.appendChild(newErrorMessageContainer);
            }
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
            if (errorMessageContainer) {
                errorMessageContainer.innerHTML = "";
            }
        }

        return isValid;
    }

    // Function to check if abiotic name already exists
    function checkAbioticExists() {
        var inputs = document.querySelectorAll('[id^="abiotic-Name_"]');
        var abioticNames = Array.from(inputs).map(input => input.value.trim());
        var hasError = false; // Flag to track if any error occurs

        // Send a GET request to check if the abiotic names already exist
        abioticNames.forEach(function(abioticName, index) {
            $.ajax({
                url: "modals/fetch/fetch_abiotic-tab.php",
                method: "GET",
                data: {
                    'check_abiotic': abioticName
                },
                success: function(data) {
                    if (data.exists) {
                        // Abiotic name already exists, show error message
                        var errorMessageContainer = document.getElementById(`error-messages_${index + 1}`);
                        if (errorMessageContainer) {
                            errorMessageContainer.innerHTML = "<div class='error text-center' style='color:red;'>Abiotic name " + abioticName + " already exists for Row " + (index + 1) + "</div>";
                        }
                        hasError = true; // Set flag to true if error occurs
                        event.preventDefault();
                    } else {
                        // Abiotic name doesn't exist
                        if (!hasError && index === abioticNames.length - 1) {
                            // If no error encountered so far and it's the last iteration, submit the form
                            submitForm();
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Abiotic name check error:", textStatus, errorThrown);
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
                url: "modals/crud-code/abiotic-code.php",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    //console.log(data);
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