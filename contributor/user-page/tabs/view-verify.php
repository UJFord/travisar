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
                                <div class="col">
                                    <label for="genderView" class="form-label"><strong>Gender:</strong></label>
                                    <h6 id="genderView"></h6>
                                </div>

                                <!-- Email -->
                                <div class="col">
                                    <label for="emailView" class="form-label"><strong>Email:</strong></label>
                                    <h6 id="emailView"></h6>
                                </div>

                                <!-- contact info -->
                                <div class="col">
                                    <label for="contact_numView" class="form-label"><strong>Contact Number:</strong></label>
                                    <h6 id="contact_numView"></h6>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Affiliation -->
                                <div class="col">
                                    <label for="affiliationView" class="form-label"><strong>Affiliation:</strong></label>
                                    <h6 id="affiliationView"></h6>
                                </div>

                                <!-- Affiliation email -->
                                <div class="col">
                                    <label for="affiliation_emailView" class="form-label"><strong>Affiliated Org Email:</strong></label>
                                    <h6 id="affiliation_emailView"></h6>
                                </div>

                                <!-- Affiliation contact number -->
                                <div class="col">
                                    <label for="affiliation_contact_numView" class="form-label"><strong>Affiliated Org Contact:</strong></label>
                                    <h6 id="affiliation_contact_numView"></h6>
                                </div>
                            </div>
                        </div>

                        <!-- confirm -->
                        <?php require "tabs/verify-confirm.php"; ?>
                        <div>
                        </div>
                    </div>

                    <!-- footer -->
                    <div class="modal-footer d-flex justify-content-end">
                        <div class="">
                            <button type="button" id="deleteButton" class="btn btn-danger">Reject</i></button>
                            <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="rejectButton" class="btn btn-success">Approve</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

<!-- for submitting the approve or rejected -->
<script>
    // Function to set up event listeners for the modal
    function setupModalEventListenersEdit() {
        // Remove event listeners to prevent duplication
        document.getElementById('rejectButton').removeEventListener('click', closeModalEdit);
        document.getElementById('deleteButton').removeEventListener('click', deleteModalEdit);

        // add Event listener for the button
        document.getElementById('rejectButton').addEventListener('click', closeModalEdit);
        document.getElementById('deleteButton').addEventListener('click', deleteModalEdit);
    }
    // Global variable to store the modal instance
    var confirmModalInstanceEdit;

    // Custom function to close the modal
    function closeModalEdit() {
        // Get the modal element
        var confirmModal = document.getElementById('confirmModalEdit');

        // Create a new Bootstrap modal instance if it doesn't exist
        if (!confirmModalInstanceEdit) {
            confirmModalInstanceEdit = new bootstrap.Modal(confirmModal);
        }

        // Show the confirmation modal
        confirmModalInstanceEdit.show();

        // to show which button should show on the confirm modal
        document.getElementById('confirmApproveBtnEdit').style.display = 'block';
        document.getElementById('confirmDeleteBtnEdit').style.display = 'none';
        // to show which label should show on the confirm modal
        document.getElementById('approve-label').style.display = 'block';
        document.getElementById('delete-label').style.display = 'none';
    }
    // Wait for the DOM to be fully loaded
    // document.addEventListener("DOMContentLoaded", function() {
    //     // Get the form element
    //     var form = document.getElementById('form-panel-Edit');
    //     // Add an event listener for the form submission
    //     form.addEventListener("submit", function(event) {
    //         // Prevent the default form submission behavior
    //         event.preventDefault();
    //         if (validateFormEdit()) {
    //             // If validation succeeds, submit the form
    //             submitFormEdit();
    //         }
    //     });
    // });

    function deleteModalEdit(event) {
        // Prevent the default behavior of the button (e.g., form submission)
        event.preventDefault();

        // Get the id of the button clicked
        var buttonId = event.target.getAttribute('data-id');

        // Get the modal element
        var confirmModal = document.getElementById('confirmModalEdit');

        // Create a new Bootstrap modal instance if it doesn't exist
        if (!confirmModalInstanceEdit) {
            confirmModalInstanceEdit = new bootstrap.Modal(confirmModal);
        }

        // Show the confirmation modal
        confirmModalInstanceEdit.show();

        // to show which button should show on the confirm modal
        document.getElementById('confirmApproveBtnEdit').style.display = 'none';
        document.getElementById('confirmDeleteBtnEdit').style.display = 'block';
        // to show which label should show on the confirm modal
        document.getElementById('approve-label').style.display = 'none';
        document.getElementById('delete-label').style.display = 'block';
    }
    // Event listener for when the modal is shown
    document.getElementById('view-item-modal-partners').addEventListener('shown.bs.modal', function() {
        setupModalEventListenersEdit();
    });

    // Event listener for when the confirmation modal is hidden
    document.getElementById('confirmModalEdit').addEventListener('hidden.bs.modal', function() {
        // Reset the confirmModalInstanceEdit
        confirmModalInstanceEdit = null;
    });

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