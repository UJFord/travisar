<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="view-item-modal-partners" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">View Contributor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel-verify" name="Form" action="code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <!-- hidden id's -->
                    <input type="hidden" name="user_id" id="user_idVerify">
                    <input type="hidden" name="email" id="emailVerify">

                    <div class="container">
                        <div id="UserData">
                            <!-- First and Last name, gender -->
                            <div class="row mb-3 location-brgy">
                                <!-- first name -->
                                <div class="col-5">
                                    <label for="first_nameView" class="form-label small-font"><strong>First Name:</strong></label>
                                    <h6 id="first_nameView"></h6>
                                </div>

                                <!-- last name -->
                                <div class="col-5">
                                    <label for="last_nameView" class="form-label small-font"><strong>Last Name:</strong></label>
                                    <h6 id="last_nameView"></h6>
                                </div>
                            </div>

                            <!-- Gender, Email, and Affiliation name -->
                            <div class="row mb-3 location-brgy">
                                <!-- Gender -->
                                <div class="col-5">
                                    <label for="genderView" class="form-label small-font"><strong>Gender:</strong></label>
                                    <h6 id="genderView"></h6>
                                </div>

                                <!-- Email -->
                                <div class="col-5">
                                    <label for="emailView" class="form-label small-font"><strong>Email:</strong></label>
                                    <h6 id="emailView"></h6>
                                </div>
                            </div>
                            <!-- Affiliation -->
                            <div class="col-5">
                                <label for="affiliationView" class="form-label small-font"><strong>Affiliation:</strong></label>
                                <h6 id="affiliationView"></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <div class="">
                        <button type="submit" name="approve" class="btn btn-success">Approve</button>
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <button type="button" class="btn btn-danger">Reject</i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- for submitting the approve or rejected -->
<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form element
        var form = document.getElementById('form-panel-verify');
        // Add an event listener for the form submission
        form.addEventListener("submit", function(event) {
            // If validation succeeds, submit the form
            submitForm();
        });
    });

    // Function to submit the form and refresh notifications
    function submitForm() {
        // console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel-verify');
        // Trigger the form submission
        if (form) {
            // Create a new FormData object
            var formData = new FormData(form);

            // Append additional data
            formData.append('click_verify_btn', 'true');

            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "code/code.php",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log("Form submitted successfully", data);
                    // Reset the form
                    // form.reset();
                    // // Reload unseen notifications
                    // load_unseen_notification();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Form submission error:", textStatus, errorThrown);
                    // Handle error if needed
                }
            });
        }
    }
</script>