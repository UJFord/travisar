<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="edit-item-modal-brgy" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit Barangay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" action="location-page/code/code-brgy.php" autocomplete="off" method="POST" class=" py-3 px-5" onsubmit="validateAndSubmitForm(event)">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="locationData">
                            <!-- municipality AND barangay -->
                            <div class="row mb-3 location-row">
                                <!-- municipality name -->
                                <div class="col-5">
                                    <label for="municipality-Name" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                                    <input type="text" id="municipality-Name-Edit" name="municipality_name" class="form-control" readonly disabled>
                                </div>w

                                <!-- barangay name -->
                                <div class="col-5">
                                    <label for="barangay-Name" class="form-label small-font">Barangay Name<span style="color: red;">*</span></label>
                                    <input type="text" id="barangay-Name" name="barangay_name" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <div class="">
                        <input type="hidden" name="barangay_id" id="barangay_id-Edit">
                        <button type="submit" name="update" onclick="validateAndSubmitForm()" class="btn btn-success">Edit</button>
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
    // Function to validate input and submit the form
    function validateAndSubmitForm(event) {
        // Validate the form
        if (validateForm()) {
            // If validation succeeds, submit the form
            submitForm();
        }
    }

    // Function to validate input
    function validateForm() {
        // Get the values from the form
        var barangay_name = document.forms["Form"]["barangay_name"].value;

        // Check if the required fields are not empty
        if (barangay_name === "") {
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
                url: "location-page/code/code-brgy.php",
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

    function switchTab(tabName, event) {
        // prevent submitting the form
        event.preventDefault();

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }
</script>