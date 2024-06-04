<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="edit-item-modal-user" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="error-messages-Edit">

            </div>
            <!-- body -->
            <form id="form-panel-Edit" name="Form" action="code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="Edit-User">
                            <!-- user id hidden -->
                            <input type="hidden" name="user_id" id="user_idEdit">
                            <!-- First name and Last Name -->
                            <div class="row mb-3">
                                <!-- First name -->
                                <div class="col">
                                    <label for="first-NameEdit" class="form-label small-font">First Name<span style="color: red;">*</span></label>
                                    <input type="text" id="first-NameEdit" name="first_nameEdit" class="form-control">
                                </div>

                                <!-- Last name -->
                                <div class="col">
                                    <label for="last-NameEdit" class="form-label small-font">Last Name<span style="color: red;">*</span></label>
                                    <input type="text" id="last-NameEdit" name="last_nameEdit" class="form-control">
                                </div>

                                <!-- Gender -->
                                <div class="col">
                                    <label for="GenderEdit" class="form-label small-font">Gender</label>
                                    <select name="genderEdit" id="GenderEdit" class="form-select">
                                        <option value="" selected disabled hidden>Select an option</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Username and email -->
                            <div class="row mb-3">
                                <!-- Email -->
                                <div class="col">
                                    <label for="EmailEdit" class="form-label small-font">Email<span style="color: red;">*</span></label>
                                    <input type="text" id="EmailEdit" name="emailEdit" class="form-control">
                                </div>

                                <!-- Contact # -->
                                <div class="col">
                                    <label for="Contact_NumberEdit" class="form-label small-font">Contact Number<span class="text-danger ms-1">*</span></label>
                                    <input type="tel" id="Contact_NumberEdit" name="contact_numEdit" class="form-control" placeholder="0922 523 3324" pattern="[0-9]{4} [0-9]{3} [0-9]{4}">
                                    <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Format: 0922 523 3324</div>
                                </div>
                                <!-- user name -->
                                <div class="col">
                                    <label for="user-NameEdit" class="form-label small-font">Username</label>
                                    <input type="text" id="user-NameEdit" name="usernameEdit" class="form-control">
                                </div>
                            </div>

                            <!-- Affiliation -->
                            <div class="row mb-3">
                                <!-- Affiliation -->
                                <div class="col">
                                    <label for="AffiliationEdit" class="form-label small-font">Affiliation</label>
                                    <input type="text" id="AffiliationEdit" name="affiliationEdit" class="form-control">
                                </div>

                                <!-- affiliated org Email -->
                                <div class="col">
                                    <label for="affiliated_company_EmailEdit" class="form-label small-font">Email of Affiliated Organization</label>
                                    <input type="text" id="affiliated_company_EmailEdit" name="affiliated_emailEdit" class="form-control">
                                    <div id="error-messages-affiliatedEmail"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Org Contact # -->
                                <div class="col">
                                    <label for="affiliated_Contact_NumberEdit" class="form-label small-font">Contact Number of Affiliated Organization</label>
                                    <input type="tel" id="affiliated_Contact_NumberEdit" name="affiliated_contact_numEdit" class="form-control" placeholder="0922 523 3324" pattern="[0-9]{4} [0-9]{3} [0-9]{4}">
                                    <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Format: 0922 523 3324</div>
                                    <div id="error-messages-contact-number" class="text-danger"></div>
                                </div>

                                <!-- Account Type -->
                                <div class="col">
                                    <label for="Account_TypeEdit" class="form-label small-font">Account Type<span style="color: red;">*</span></label>
                                    <select name="account_type_idEdit" id="Account_TypeEdit" class="form-select">
                                        <?php
                                        $query = "SELECT * from account_type";
                                        $query_run = pg_query($conn, $query);

                                        $count = pg_num_rows($query_run);

                                        // if count is greater than 0 there is data
                                        if ($count > 0) {
                                            // loop for displaying all categories
                                            while ($row = pg_fetch_assoc($query_run)) {
                                                $account_type_id = $row['account_type_id'];
                                                $type_name = $row['type_name'];
                                        ?>
                                                <option value="<?= $account_type_id; ?>"><?= $type_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <?php require "tabs/user-confirm.php"; ?>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
                        <!-- <button type="button" id="deleteButton" class="btn btn-danger">Delete</button> -->
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="rejectButton" name="save" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- SCRIPT FOR CONTACT NUMBER -->
<script>
    document.getElementById('Contact_NumberEdit').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
        if (value.length > 11) {
            value = value.slice(0, 11); // Limit to 11 digits
        }
        // Add spaces after the 4th and 7th digits
        value = value.replace(/(\d{4})(\d{3})(\d{0,4})/, '$1 $2 $3').trim();
        e.target.value = value;
    });

    document.getElementById('affiliated_Contact_NumberEdit').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
        if (value.length > 11) {
            value = value.slice(0, 11); // Limit to 11 digits
        }
        // Add spaces after the 4th and 7th digits
        value = value.replace(/(\d{4})(\d{3})(\d{0,4})/, '$1 $2 $3').trim();
        e.target.value = value;
    });
</script>
<!-- for submission -->
<script>
    // Function to set up event listeners for the modal
    function setupModalEventListenersEdit() {
        // Remove event listeners to prevent duplication
        //document.getElementById('rejectButton').removeEventListener('click', closeModalEdit);
        //document.getElementById('deleteButton').removeEventListener('click', deleteModalEdit);

        // add Event listener for the button
        //document.getElementById('rejectButton').addEventListener('click', closeModalEdit);
        //document.getElementById('deleteButton').addEventListener('click', deleteModalEdit);
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
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form element
        var form = document.getElementById('form-panel-Edit');
        // Add an event listener for the form submission
        form.addEventListener("submit", function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();
            if (event.submitter.name === 'delete') {
                // console.log('Submit na draft');
                event.target.setAttribute('name', 'delete');

                deleteFormEdit();
            } else {
                // Validate the form if not submitted as a draft
                if (validateFormEdit()) {
                    // If validation succeeds, submit the form
                    submitFormEdit();
                }
            }
        });
    });

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

        // Pass the buttonId to the confirm modal
        document.getElementById('confirmModalEdit').setAttribute('data-id', buttonId);

        // to show which button should show on the confirm modal
        document.getElementById('confirmApproveBtnEdit').style.display = 'none';
        document.getElementById('confirmDeleteBtnEdit').style.display = 'block';
        // to show which label should show on the confirm modal
        document.getElementById('approve-label').style.display = 'none';
        document.getElementById('delete-label').style.display = 'block';
    }
    // Event listener for when the modal is shown
    // document.getElementById('edit-item-modal-user').addEventListener('shown.bs.modal', function() {
    //     setupModalEventListenersEdit();
    // });

    // Event listener for when the confirmation modal is hidden
    document.getElementById('confirmModalEdit').addEventListener('hidden.bs.modal', function() {
        // Reset the confirmModalInstanceEdit
        confirmModalInstanceEdit = null;
    });

    // Function to validate input 
    function validateFormEdit() {
        var firstName = document.getElementById('first-NameEdit').value;
        var lastName = document.getElementById('last-NameEdit').value;
        var email = document.getElementById('EmailEdit').value;
        var accountType = document.getElementById('Account_TypeEdit').value;

        var errors = [];

        // Check if the required fields are not empty
        if (firstName === "" || lastName === "" || email === "" || accountType === "") {
            errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
        }

        // Validate first name
        if (!/^[a-zA-Z ]+$/.test(firstName)) {
            errors.push("<div class='error text-center' style='color:red;'>Please enter a valid first name.</div>");
            document.getElementById('first-NameEdit').classList.add('is-invalid'); // Corrected element ID
        } else {
            document.getElementById('first-NameEdit').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate last name
        if (!/^[a-zA-Z ]+$/.test(lastName)) {
            errors.push("<div class='error text-center' style='color:red;'>Please enter a valid last name.</div>");
            document.getElementById('last-NameEdit').classList.add('is-invalid'); // Corrected element ID
        } else {
            document.getElementById('last-NameEdit').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate email
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            errors.push("<div class='error text-center' style='color:red;'>Please enter a valid email.</div>");
            document.getElementById('EmailEdit').classList.add('is-invalid'); // Corrected element ID
        } else {
            document.getElementById('EmailEdit').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Display first error only
        if (errors.length > 0) {
            var errorString = errors[0]; // Get the first error
            document.getElementById("error-messages-Edit").innerHTML = errorString;
            return false;
        }

        // If no errors, clear error messages
        document.getElementById("error-messages-Edit").innerHTML = "";
        return true;
    }
    // Function to submit the form and refresh notifications
    function deleteFormEdit() {
        var form = document.getElementById('form-panel-Edit');
        if (form) {
            // Create a new FormData object
            var formData = new FormData(form);

            // Append additional data
            formData.append('delete_user', 'true');

            // Send a POST request using AJAX
            $.ajax({
                url: "code/code.php",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    // Reset the form
                    form.reset();
                    // Reload the page or do other actions if needed
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Form submission error:", textStatus, errorThrown);
                    // Handle error if needed
                }
            });
        }
    }

    // Function to submit the form and refresh notifications
    function submitFormEdit() {
        var form = document.getElementById('form-panel-Edit');
        if (form) {
            // Create a new FormData object
            var formData = new FormData(form);

            // Append additional data
            formData.append('click_edit_btn', 'true');

            // Send a POST request using AJAX
            $.ajax({
                url: "code/code.php",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    // Reset the form
                    form.reset();
                    // Reload the page or do other actions if needed
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Form submission error:", textStatus, errorThrown);
                    // Handle error if needed
                }
            });
        }
    }
</script>

<!-- script for getting the user data -->
<script>
    // EDIT SCRIPT
    const tableRows = document.querySelectorAll('.edit_data');
    tableRows.forEach(row => {

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Assuming you have jQuery available
            $.ajax({
                url: 'modals/fetch.php',
                type: 'POST',
                data: {
                    'click_edit_btn': true,
                    'user_id': id,
                },
                success: function(response) {
                    // Handle the response from the PHP script
                    // console.log('Response:', response);

                    // Clear the current preview
                    $('#preview').empty();

                    $.each(response, function(key, value) {
                        // Append options to select element
                        // console.log(value['rice_plant_height']);

                        // crop_id
                        $('#user_idEdit').val(id);
                        $('#first-NameEdit').val(value['first_name']);
                        $('#last-NameEdit').val(value['last_name']);
                        $('#GenderEdit').val(value['gender']);
                        $('#EmailEdit').val(value['email']);
                        $('#Contact_NumberEdit').val(value['contact_num']);
                        $('#user-NameEdit').val(value['username']);
                        $('#AffiliationEdit').val(value['affiliation']);
                        $('#affiliated_company_EmailEdit').val(value['affiliated_email']);
                        $('#affiliated_Contact_NumberEdit').val(value['affiliated_contact_num']);
                        $('#Account_TypeEdit').append($('<option>', {
                            value: value['account_type_id'],
                            text: value['type_name'],
                            hidden: true,
                            selected: true
                        }));
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }

            });

            // Show the modal
            const dataModal = new bootstrap.Modal(document.getElementById('edit-item-modal-user'), {
                keyboard: false
            });
            dataModal.show();
        });
    });
</script>