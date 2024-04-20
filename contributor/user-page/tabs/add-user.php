<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal-user" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="add-item-modal-label">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="error-messages">

            </div>
            <!-- body -->
            <form id="form-panel-add" name="Form" action="user-page/code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="Add-User">
                            <!-- First name and Last Name -->
                            <div class="row mb-3">
                                <!-- First name -->
                                <div class="col">
                                    <label for="first-Name" class="form-label small-font">First Name<span style="color: red;">*</span></label>
                                    <input type="text" id="first-Name" name="first_name" class="form-control">
                                </div>

                                <!-- Last name -->
                                <div class="col">
                                    <label for="last-Name" class="form-label small-font">Last Name<span style="color: red;">*</span></label>
                                    <input type="text" id="last-Name" name="last_name" class="form-control">
                                </div>
                                <!-- Gender -->
                                <div class="col">
                                    <label for="Gender" class="form-label small-font">Gender</label>
                                    <input type="text" id="Gender" name="gender" class="form-control">
                                </div>
                            </div>

                            <!-- Username and email -->
                            <div class="row mb-3">
                                <!-- Email -->
                                <div class="col">
                                    <label for="Email" class="form-label small-font">Email<span style="color: red;">*</span></label>
                                    <input type="text" id="Email" name="email" class="form-control">
                                </div>
                                <!-- user name -->
                                <div class="col">
                                    <label for="user-Name" class="form-label small-font">Username</label>
                                    <input type="text" id="user-Name" name="username" class="form-control">
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="row mb-3">
                                <!-- Password -->
                                <div class="col">
                                    <label for="Password" class="form-label small-font">Password<span style="color: red;">*</span></label>
                                    <input type="password" id="Password" name="password" class="form-control">
                                    <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">(Password must be more than 8 letters)</div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col">
                                    <label for="Confirm-Password" class="form-label small-font">Confirm Password<span style="color: red;">*</span></label>
                                    <input type="password" id="Confirm-Password" name="confirm_password" class="form-control">
                                    <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">(Passwords must match)</div>
                                </div>
                            </div>

                            <!-- Affiliation -->
                            <div class="row mb-3">
                                <!-- Affiliation -->
                                <div class="col">
                                    <label for="Affiliation" class="form-label small-font">Affiliation</label>
                                    <input type="text" id="Affiliation" name="affiliation" class="form-control">
                                </div>
                                <!-- Account Type -->
                                <div class="col">
                                    <label for="AccountType" class="form-label small-font">Account Type<span style="color: red;">*</span></label>
                                    <select name="account_type_id" id="AccountType" class="form-select">
                                        <option value="" disabled selected>Select Account Type</option>
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
                                    <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">(Select user rank)</div>
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

<!-- <script>
    const firstName = document.getElementById('first-name');
    const lastName = document.getElementById('last-name');
    const email = document.getElementById('email');
    const password = document.getElementById('Password');
    const passwordConfirm = document.getElementById('Confirm-Password');
    const accountType = document.getElementById('AccountType');
    const errorElement = document.getElementById('error-messages');
    const form = document.getElementById('form-panel-add');

    form.addEventListener('submit', (e) => {
        let messages = [];

        // Check if the required fields are not empty
        if (firstName.value === "" || firstName.value === null) {
            messages.push('Name is required');
        }
        if(messages.length > 0) {
            e.preventDefault();
            errorElement.innerText = messages.join(', ');
        }
    })
</script> -->

<!-- for submission -->
<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form element
        var form = document.getElementById('form-panel-add');
        // Add an event listener for the form submission
        form.addEventListener("submit", function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();
            // Validate the form
            if (validateForm()) {
                // If validation succeeds, submit the form
                submitForm();
            }
        });
    });

    // Function to validate input
    function validateForm() {
        var firstName = document.forms["Form"]["first_name"].value;
        var lastName = document.forms["Form"]["last_name"].value;
        var email = document.forms["Form"]["email"].value;
        var password = document.forms["Form"]["password"].value;
        var confirmPassword = document.forms["Form"]["confirm_password"].value;
        var accountType = document.forms["Form"]["AccountType"].value;

        var errors = [];

        // Check if the required fields are not empty
        if (firstName === "" || lastName === "" || email === "" || password === "" || confirmPassword === "" || accountType === "") {
            errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
            document.getElementById('AccountType').classList.add('is-invalid'); // Add 'is-invalid' class to select field
        } else {
            document.getElementById('AccountType').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }


        // Validate first name
        if (!/^[a-zA-Z ]+$/.test(firstName)) {
            errors.push("<div class='error text-center' style='color:red;'>Please enter a valid first name.</div>");
            document.getElementById('first-Name').classList.add('is-invalid'); // Add 'is-invalid' class to input
        } else {
            document.getElementById('first-Name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate last name
        if (!/^[a-zA-Z ]+$/.test(lastName)) {
            errors.push("<div class='error text-center' style='color:red;'>Please enter a valid last name.</div>");
            document.getElementById('last-Name').classList.add('is-invalid'); // Add 'is-invalid' class to input
        } else {
            document.getElementById('last-Name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate email
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            errors.push("<div class='error text-center' style='color:red;'>Please enter a valid email.</div>");
            document.getElementById('Email').classList.add('is-invalid'); // Add 'is-invalid' class to input
        } else {
            document.getElementById('Email').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate password length
        if (password.length < 8) {
            errors.push("<div class='error text-center' style='color:red;'>Password must be at least 8 characters.</div>");
            document.getElementById('Password').classList.add('is-invalid'); // Add 'is-invalid' class to input
        } else {
            document.getElementById('Password').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate password match
        if (password !== confirmPassword) {
            errors.push("<div class='error text-center' style='color:red;'>Passwords must match.</div>");
            document.getElementById('Confirm-Password').classList.add('is-invalid'); // Add 'is-invalid' class to input
        } else {
            document.getElementById('Confirm-Password').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Display first error only
        if (errors.length > 0) {
            var errorString = errors[0]; // Get the first error
            document.getElementById("error-messages").innerHTML = errorString;
            return false;
        }

        // If no errors, clear error messages
        document.getElementById("error-messages").innerHTML = "";
        return true;
    }


    // Function to submit the form and refresh notifications
    function submitForm() {
        var form = document.getElementById('form-panel-add');
        if (form) {
            // Create a new FormData object
            var formData = new FormData(form);

            // Append additional data
            formData.append('click_add_btn', 'true');

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
                    // form.reset();
                    // // Reload the page or do other actions if needed
                    // location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Form submission error:", textStatus, errorThrown);
                    // Handle error if needed
                }
            });
        }
    }
</script>