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
            <form id="form-panel-Edit" name="Form" action="user-page/code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
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
                                    <input type="text" id="first-NameEdit" name="first_name" class="form-control">
                                </div>

                                <!-- Last name -->
                                <div class="col">
                                    <label for="last-NameEdit" class="form-label small-font">Last Name<span style="color: red;">*</span></label>
                                    <input type="text" id="last-NameEdit" name="last_name" class="form-control">
                                </div>
                                <!-- Gender -->
                                <div class="col">
                                    <label for="GenderEdit" class="form-label small-font">Gender</label>
                                    <input type="text" id="GenderEdit" name="gender" class="form-control">
                                </div>
                            </div>

                            <!-- Username and email -->
                            <div class="row mb-3">
                                <!-- Email -->
                                <div class="col">
                                    <label for="EmailEdit" class="form-label small-font">Email<span style="color: red;">*</span></label>
                                    <input type="text" id="EmailEdit" name="email" class="form-control">
                                </div>
                                <!-- user name -->
                                <div class="col">
                                    <label for="user-NameEdit" class="form-label small-font">Username</label>
                                    <input type="text" id="user-NameEdit" name="username" class="form-control">
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="row mb-3">
                                <!-- Password -->
                                <div class="col">
                                    <label for="PasswordEdit" class="form-label small-font">Password<span style="color: red;">*</span></label>
                                    <input type="text" id="PasswordEdit" name="password" class="form-control">
                                </div>

                                <!-- Confirm Password -->
                                <div class="col">
                                    <label for="Confirm-PasswordEdit" class="form-label small-font">Confirm Password<span style="color: red;">*</span></label>
                                    <input type="text" id="Confirm-PasswordEdit" name="confirm_password" class="form-control">
                                </div>
                            </div>

                            <!-- Affiliation -->
                            <div class="row mb-3">
                                <!-- Affiliation -->
                                <div class="col">
                                    <label for="AffiliationEdit" class="form-label small-font">Affiliation</label>
                                    <input type="text" id="AffiliationEdit" name="affiliation" class="form-control">
                                </div>
                                <!-- Account Type -->
                                <div class="col">
                                    <label for="Account_TypeEdit" class="form-label small-font">Account Type<span style="color: red;">*</span></label>
                                    <select name="account_type_id" id="Account_TypeEdit" class="form-select">
                                        <?php
                                        $query = "SELECT * from account_type where type_name != 'Curator'";
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
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <div class="">
                        <button type="submit" name="save" class="btn btn-success">Save</button>
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
    // EDIT SCRIPT
    const tableRows = document.querySelectorAll('.edit_data');
    tableRows.forEach(row => {

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Use the crop_id as needed
            // console.log("Crop ID: " + id);

            // Assuming you have jQuery available
            $.ajax({
                url: 'user-page/modals/fetch.php',
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
                        $('#user-NameEdit').val(value['username']);
                        $('#AffiliationEdit').val(value['affiliation']);
                        $('#Account_TypeEdit').val(value['crop_id']);
                        $('#Account_TypeEdit').append($('<option>', {
                            value: value['type_id'],
                            text: value['type_name']
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
    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form element
        var form = document.getElementById('form-panel-Edit');
        // Add an event listener for the form submission
        form.addEventListener("submit", function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();
            if (validateFormEdit()) {
                // If validation succeeds, submit the form
                submitFormEdit();
            }
        });
    });

    // Function to validate input 
    function validateFormEdit() {
        var firstName = document.getElementById('first-NameEdit').value;
        var lastName = document.getElementById('last-NameEdit').value;
        var email = document.getElementById('EmailEdit').value;
        var password = document.getElementById('PasswordEdit').value;
        var confirmPassword = document.getElementById('Confirm-PasswordEdit').value;
        var accountType = document.getElementById('Account_TypeEdit').value;

        var errors = [];

        // Check if the required fields are not empty
        if (firstName === "" || lastName === "" || email === "" || password === "" || confirmPassword === "" || accountType === "") {
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

        // Validate password length
        if (password.length < 8) {
            errors.push("<div class='error text-center' style='color:red;'>Password must be at least 8 characters.</div>");
            document.getElementById('PasswordEdit').classList.add('is-invalid'); // Corrected element ID
        } else {
            document.getElementById('PasswordEdit').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate password match
        if (password !== confirmPassword) {
            errors.push("<div class='error text-center' style='color:red;'>Passwords must match.</div>");
            document.getElementById('Confirm-PasswordEdit').classList.add('is-invalid'); // Corrected element ID
        } else {
            document.getElementById('Confirm-PasswordEdit').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
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
    function submitFormEdit() {
        var form = document.getElementById('form-panel-Edit');
        if (form) {
            // Create a new FormData object
            var formData = new FormData(form);

            // Append additional data
            formData.append('click_edit_btn', 'true');

            // Send a POST request using AJAX
            $.ajax({
                url: "user-page/code/code.php",
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