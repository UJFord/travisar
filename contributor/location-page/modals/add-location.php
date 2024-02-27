<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Add Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" action="crop-page/modals/crud-code/try.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div>
                        <button type="button" id="add-row" class="btn btn-secondary">Add</button>
                    </div>
                    <div class="container">
                        <div id="locationData">
                            <!-- Province AND Municipality -->
                            <div class="row mb-3 location-row">
                                <!-- province name -->
                                <div class="col-5">
                                    <label for="province-Name" class="form-label small-font">Province Name<span style="color: red;">*</span></label>
                                    <input type="text" name="province_name_1" class="form-control">
                                </div>

                                <!-- municipality name -->
                                <div class="col-5">
                                    <label for="municipality-Name" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                                    <input type="text" name="municipality_name_1" class="form-control">
                                </div>

                                <div class="col-2">
                                    <button type="button" class="btn btn-secondary remove-row">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <div class="">
                        <button type="submit" name="save" onclick="validateAndSubmitForm()" class="btn btn-success">Save</button>
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <button type="button" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- for submission -->
<script>
    // for adding and removing rows dynamically
    // i set the names for each input field to be unique name attribute 
    // (province_name_1, municipality_name_1, province_name_2, municipality_name_2, and so on)
    // for when the form is submitted hiwalay ang pag save
    document.addEventListener('DOMContentLoaded', function() {
        const addRowButton = document.getElementById('add-row');
        const locationData = document.getElementById('locationData');
        let rowCounter = 1;

        addRowButton.addEventListener('click', function() {
            rowCounter++;
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-3', 'location-row');
            newRow.innerHTML = `
            <div class="col-5">
                <label for="province-Name" class="form-label small-font">Province Name<span style="color: red;">*</span></label>
                <input type="text" name="province_name_${rowCounter}" class="form-control">
            </div>
            <div class="col-5">
                <label for="municipality-Name" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                <input type="text" name="municipality_name_${rowCounter}" class="form-control">
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-secondary remove-row">Remove</button>
            </div>
        `;
            locationData.appendChild(newRow);
        });

        locationData.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.location-row').remove();
            }
        });

        window.addEventListener('beforeunload', function(e) {
            // Reset the form data here
            locationData.innerHTML = '';
            rowCounter = 1; // Reset the row counter
        });
    });


    // Function to validate input and submit the form
    function validateAndSubmitForm() {
        // Validate the form
        if (validateForm()) {
            // If validation succeeds, submit the form
            submitForm();
        }
    }

    // Function to validate input
    function validateForm() {
        // Get the values from the form
        var cropName = document.forms["Form"]["crop_variety"].value;

        // Check if the required fields are not empty
        if (cropName === "") {
            alert("Please fill out all required fields.");
            return false; // Prevent form submission
        }
        // You can add more validation checks if needed
        return true; // Allow form submission
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
                url: "http://localhost/travisar/contributor/crop-page/modals/try.php",
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

    // tab switching
    // next button

    function switchTab(tabName) {
        // prevent submitting the form
        event.preventDefault();

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }
</script>