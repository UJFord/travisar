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

            <!-- body -->
            <form id="form-panel-add" name="Form" action="code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="Add-User">
                            <!-- First name and Last Name -->
                            <div class="row mb-3">
                                <!-- First name -->
                                <div class="col">
                                    <label for="first-Name" class="form-label small-font">First Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" id="first-Name" name="first_name" class="form-control">
                                    <div id="error-messages-first"></div>
                                </div>

                                <!-- Last name -->
                                <div class="col">
                                    <label for="last-Name" class="form-label small-font">Last Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" id="last-Name" name="last_name" class="form-control">
                                    <div id="error-messages-last"></div>
                                </div>

                                <!-- Gender -->
                                <div class="col">
                                    <label for="Gender" class="form-label small-font">Gender</label>
                                    <select name="gender" id="Gender" class="form-select">
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
                                    <label for="Email" class="form-label small-font">Email<span class="text-danger ms-1">*</span></label>
                                    <input type="text" id="Email" name="email" class="form-control">
                                    <div id="error-messages-email"></div>
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
                                    <label for="Password" class="form-label small-font">Password<span class="text-danger ms-1">*</span></label>
                                    <input type="password" id="Password" name="password" class="form-control">
                                    <div id="error-messages-pass1"></div>
                                    <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">(Password must be more than 8 letters)</div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col">
                                    <label for="Confirm-Password" class="form-label small-font">Confirm Password<span class="text-danger ms-1">*</span></label>
                                    <input type="password" id="Confirm-Password" name="confirm_password" class="form-control">
                                    <div id="error-messages-pass2"></div>
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
                                    <label for="AccountType" class="form-label small-font">Account Type<span class="text-danger ms-1">*</span></label>
                                    <select name="account_type_id" id="AccountType" class="form-select">
                                        <option value="" disabled selected hidden>Select Account Type</option>
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
                                    <div id="error-messages-acc"></div>
                                    <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">(Select user rank)</div>
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

<!-- Script for limiting the input for the crop variety name -->
<script>
    // Get the input element
    var firstElement = document.getElementById('first-Name');
    var lastElement = document.getElementById('last-Name');

    // Add an event listener for keypress event
    firstElement.addEventListener('keypress', function(e) {
        // Get the key code of the pressed key
        var keyCode = e.keyCode || e.which;

        // Allow letters (A-Z and a-z), spaces (32), underscores (95), and dashes (45)
        if (!(keyCode >= 65 && keyCode <= 90) && // A-Z
            !(keyCode >= 97 && keyCode <= 122) && // a-z
            keyCode !== 32 && // space
            keyCode !== 95 && // underscore
            keyCode !== 45 // dash
        ) {
            // Prevent default behavior if the key is not allowed
            e.preventDefault();
        }
    });

    // Add an event listener for keypress event
    lastElement.addEventListener('keypress', function(e) {
        // Get the key code of the pressed key
        var keyCode = e.keyCode || e.which;

        // Allow letters (A-Z and a-z), spaces (32), underscores (95), and dashes (45)
        if (!(keyCode >= 65 && keyCode <= 90) && // A-Z
            !(keyCode >= 97 && keyCode <= 122) && // a-z
            keyCode !== 32 && // space
            keyCode !== 95 && // underscore
            keyCode !== 45 // dash
        ) {
            // Prevent default behavior if the key is not allowed
            e.preventDefault();
        }
    });
</script>

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

        var isValid = true;

        // Check if the required fields are not empty
        if (firstName === "") {
            document.getElementById("error-messages-first").innerHTML = "<div class='error text-center small-font' style='color:red;'>Please enter your first name.</div>";
            document.getElementById('first-Name').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else {
            document.getElementById("error-messages-first").innerHTML = "";
            document.getElementById('first-Name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        if (lastName === "") {
            document.getElementById("error-messages-last").innerHTML = "<div class='error text-center small-font' style='color:red;'>Please enter your last name.</div>";
            document.getElementById('last-Name').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else {
            document.getElementById("error-messages-last").innerHTML = "";
            document.getElementById('last-Name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        if (email === "") {
            document.getElementById("error-messages-email").innerHTML = "<div class='error text-center small-font' style='color:red;'>Please enter your email.</div>";
            document.getElementById('Email').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else {
            document.getElementById("error-messages-email").innerHTML = "";
            document.getElementById('Email').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        if (password === "") {
            document.getElementById("error-messages-pass1").innerHTML = "<div class='error text-center small-font' style='color:red;'>Please enter your password.</div>";
            document.getElementById('Password').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else {
            document.getElementById("error-messages-pass1").innerHTML = "";
            document.getElementById('Password').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        if (confirmPassword === "") {
            document.getElementById("error-messages-pass2").innerHTML = "<div class='error text-center small-font' style='color:red;'>Please confirm your password.</div>";
            document.getElementById('Confirm-Password').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else if (password !== confirmPassword) {
            document.getElementById("error-messages-pass2").innerHTML = "<div class='error text-center small-font' style='color:red;'>Password must match.</div>";
            document.getElementById('Confirm-Password').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else {
            document.getElementById("error-messages-pass2").innerHTML = "";
            document.getElementById('Confirm-Password').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        if (accountType === "") {
            document.getElementById("error-messages-acc").innerHTML = "<div class='error text-center small-font' style='color:red;'>Please select your account type.</div>";
            document.getElementById('AccountType').classList.add('is-invalid'); // Add 'is-invalid' class to select
            isValid = false;
        } else {
            document.getElementById("error-messages-acc").innerHTML = "";
            document.getElementById('AccountType').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate first name
        if (!/^[a-zA-Z ]+$/.test(firstName)) {
            document.getElementById("error-messages-first").innerHTML = "<div class='error text-center small-font' style='color:red;'>Please enter a valid first name.</div>";
            document.getElementById('first-Name').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else {
            document.getElementById("error-messages-first").innerHTML = "";
            document.getElementById('first-Name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate last name
        if (!/^[a-zA-Z ]+$/.test(lastName)) {
            document.getElementById("error-messages-last").innerHTML = "<div class='error text-center small-font' style='color:red;'>Please enter a valid last name.</div>";
            document.getElementById('last-Name').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else {
            document.getElementById("error-messages-last").innerHTML = "";
            document.getElementById('last-Name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate email
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            document.getElementById("error-messages-email").innerHTML = "<div class='error text-center small-font' style='color:red;'>Please enter a valid email.</div>";
            document.getElementById('Email').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else {
            document.getElementById("error-messages-email").innerHTML = "";
            document.getElementById('Email').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Validate password length
        if (password.length < 8) {
            document.getElementById("error-messages-pass1").innerHTML = "<div class='error text-center small-font' style='color:red;'>Password must be at least 8 characters.</div>";
            document.getElementById('Password').classList.add('is-invalid'); // Add 'is-invalid' class to input
            isValid = false;
        } else {
            document.getElementById("error-messages-pass1").innerHTML = "";
            document.getElementById('Password').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        return isValid;
    }

    // Function to submit the form and refresh notifications
    function submitForm() {
        var form = document.getElementById('form-panel-add');
        if (form) {
            // Create a new FormData object
            var formData = new FormData(form);

            // Send a POST request using AJAX
            $.ajax({
                url: "code/code.php",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    //console.log(data);
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
<!-- script for the blur event -->
<script>
    // Function to add blur event listeners to input fields with asterisks
    function addBlurEventListeners() {
        // Get all input fields with asterisks
        var inputsWithAsterisks = document.querySelectorAll('.form-label .text-danger.ms-1');

        // Add blur event listener to each input field
        inputsWithAsterisks.forEach(function(input) {
            var label = input.closest('.form-label');
            var inputField = label.nextElementSibling;

            inputField.addEventListener('blur', function() {
                if (inputField.value.trim() === "") {
                    inputField.classList.add('is-invalid');
                    inputField.nextElementSibling.innerHTML = "<div class='error text-center small-font' style='color:red;'>This field is required.</div>";
                } else {
                    inputField.classList.remove('is-invalid');
                    inputField.nextElementSibling.innerHTML = ""; // Clear error message if input is not empty
                }
            });
        });
    }

    // Call the function to add blur event listeners when the document is loaded
    document.addEventListener('DOMContentLoaded', function() {
        addBlurEventListeners();
    });
</script>