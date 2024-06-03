<?php
session_start();
require('../functions/connections.php');
require('../functions/functions.php');
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = signup($_POST);

    if (count($errors) == 0) {
        $_SESSION['message'] = "<div class='success'>Signup successful wait for the verification in your email.</div>";
        //sleep(5);
        header("location: register-confirm.php");
        exit();
    }
}
?>
<style>
    .error-mode .form-control.is-invalid,
    .error-mode .was-validated .form-control:invalid {
        border-color: var(--bs-form-invalid-border-color) !important;
        padding-right: calc(1.5em + .75rem) !important;
        background-image: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 12 12\' width=\'12\' height=\'12\' fill=\'none\' stroke=\'%23dc3545\'%3e%3ccircle cx=\'6\' cy=\'6\' r=\'4.5\'/%3e%3cpath stroke-linejoin=\'round\' d=\'M5.8 3.6h.4L6 6.5z\'/%3e%3ccircle cx=\'6\' cy=\'8.2\' r=\'.6\' fill=\'%23dc3545\' stroke=\'none\'/%3e%3c/svg%3e') !important;
        background-repeat: no-repeat !important;
        background-position: right calc(.375em + .1875rem) center !important;
        background-size: calc(.75em + .375rem) calc(.75em + .375rem) !important;
    }
</style>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travis | Register</title>

    <!-- ROBOTO -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="../css/global-declarations.css">
    <link rel="stylesheet" href="css/login.css">
    <!-- script for the window alert -->
    <script src="../js/window.js"></script>
</head>

<body class="" style="overflow:hidden">

    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <!-- form -->
            <div class="col-10">
                <form action="" method="POST" class="border rounded-4 bg-light p-5 pb-4 needs-validation" novalidate>
                    <!-- logo -->
                    <div class="row d-flex justify-content-center align-items-center">
                        <img class="col-4" src="../img/travis.svg" alt="" srcset="">
                    </div>

                    <!-- heading -->
                    <div class="row d-flex justify-content-center align-items-center py-3">
                        <h4 class="text-center">Register</h4>
                    </div>

                    <!-- name -->
                    <div class="row mb-4">
                        <div class="col-5">
                            <label for="f-name" class="form-label small-font">Firstname <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control rounded-3" id="f-name" name="first_name" placeholder="" required>
                            <div class="invalid-feedback">
                                Please provide first name.
                            </div>
                        </div>
                        <div class="col-5">
                            <label for="lname" class="form-label small-font">Lastname <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="fs-6 form-control rounded-3" id="lname" name="last_name" placeholder="" required>
                            <div class="invalid-feedback">
                                Please provide last name.
                            </div>
                        </div>

                        <div class="col-2">
                            <label for="reg-gender" class="form-label small-font">Gender</label>
                            <select name="gender" id="reg-gender" class="fs-6 form-select rounded-3">
                                <option value="" selected disabled hidden></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Rather not say">Rather not say</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <!-- email -->
                        <div class="col-4">
                            <label for="reg-email" class="form-label small-font">Email <span class="text-danger ms-1">*</span></label>
                            <input type="email" class="fs-6 form-control rounded-3" id="reg-email" name="email" placeholder="" required>
                            <div id="email-error" class="invalid-feedback">
                                Please enter your email.
                            </div>
                            <!-- Add this <div> for displaying password length error message -->
                            <div id="email-exists-feedback" class="invalid-feedback">
                                Email already exists.
                            </div>
                        </div>

                        <!-- number -->
                        <div class="col-4">
                            <label for="reg-contact_num" class="form-label small-font">Contact Number <span class="text-danger ms-1">*</span></label>
                            <input type="tel" class="fs-6 form-control rounded-3" id="reg-contact_num" name="contact_num" placeholder="" required>
                            <div id="contact_num-error" class="invalid-feedback">
                                Please enter your contact number.
                            </div>
                        </div>

                        <!-- username -->
                        <div class="col-4 mb-2">
                            <label for="reg-uname" class="form-label small-font">Username</label>
                            <input type="text" class="fs-6 form-control rounded-3" id="reg-uname" name="username" placeholder="">
                        </div>
                    </div>

                    <!-- password and confirm password -->
                    <div class="row mb-4">
                        <!-- password -->
                        <div class="col-6">
                            <label for="reg-pass" class="form-label small-font">Password <span class="text-danger ms-1">*</span></label>
                            <input type="password" class="fs-6 form-control rounded-3" id="reg-pass" name="password" placeholder="" required>
                            <div id="password-length-error" class="invalid-feedback">
                                Please enter password.
                            </div>
                            <!-- Add this <div> for displaying password length error message -->
                            <div id="password-length-length" class="invalid-feedback">
                                Password must be at least 8 characters long.
                            </div>
                        </div>
                        <!-- Confirm -->
                        <div class="col-6">
                            <label for="reg-confirm" class="form-label small-font">Confirm Password <span class="text-danger ms-1">*</span></label>
                            <input type="password" class="fs-6 form-control rounded-3" id="reg-confirm" name="password2" placeholder="" required>
                            <div class="invalid-feedback">
                                The password must match.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <!-- affiliation -->
                        <div class="col-4">
                            <label for="reg-affiliation" class="form-label small-font">Affiliation <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="fs-6 form-control rounded-3" id="reg-affiliation" name="affiliation" placeholder="" required>
                            <div class="invalid-feedback">
                                Please provide affiliation.
                            </div>
                        </div>

                        <!-- affiliation email -->
                        <div class="col-4">
                            <label for="reg-affiliation_email" class="form-label small-font">Email of Affiliated Organization</label>
                            <input type="email" class="fs-6 form-control rounded-3" id="reg-affiliation_email" name="affiliated_email" placeholder="">
                            <div class="invalid-feedback">
                                Please provide email of affiliated organization.
                            </div>
                        </div>

                        <!-- affiliation contact number -->
                        <div class="col-4">
                            <label for="reg-affiliation_contactNum" class="form-label small-font">Contact Number of Affiliated Organization</label>
                            <input type="tel" class="fs-6 form-control rounded-3" id="reg-affiliation_contactNum" name="affiliated_contact_num" placeholder="">
                        </div>
                    </div>

                    <!-- Signup btn -->
                    <div class="row d-flex justify-content-center align-items-center my-3">
                        <button class="col-6 btn btn-success rounded-3 fw-bold py-3" type="submit" value="Signup" class="submit">Sign Up!</button>
                    </div>

                    <!-- sign up -->
                    <div class="d-flex justify-content-center align-items-center my-1 small-font">
                        Already a Contributor?<a href="login.php" class="ms-1"> Login!</a>
                    </div>

                    <!-- help -->
                    <div class="d-flex justify-content-center align-items-center my-1 small-font">
                        Check our <a href="../visitor/help/contribute.php" class="mx-1">Help</a> page for your questions.
                    </div>

                    <!-- visitor page -->
                    <div class="d-flex justify-content-center align-items-center small-font">
                        Return to<a href="../visitor/home.php" class="ms-1"> Home Page</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<script>
    (() => {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', async event => {
                event.preventDefault(); // Always prevent the default form submission
                event.stopPropagation();

                let isValid = true; // Flag to track the form's validity

                if (!form.checkValidity()) {
                    isValid = false;
                }

                // Add custom validation for password match
                if (form.checkValidity() && form.querySelector('#reg-pass').value !== form.querySelector('#reg-confirm').value) {
                    form.querySelector('#reg-confirm').classList.add('is-invalid');
                    isValid = false;
                } else {
                    form.querySelector('#reg-confirm').classList.remove('is-invalid');
                }

                // Add custom validation for password length
                if (form.checkValidity() && form.querySelector('#reg-pass').value.length < 8) {
                    form.querySelector('#reg-pass').classList.add('is-invalid');
                    document.getElementById('password-length-error').style.display = 'none'; // Display the error message
                    document.getElementById('password-length-length').style.display = 'block'; // Display the length message
                    isValid = false;
                    document.body.classList.add('error-mode');
                } else {
                    form.querySelector('#reg-pass').classList.remove('is-invalid');
                    document.getElementById('password-length-length').style.display = 'none'; // Hide the length message if password length is valid
                    document.getElementById('password-length-error').style.display = 'none'; // Display the error message
                }

                // Check if email already exists in the database
                const email = form.querySelector('#reg-email').value;
                const formData = new FormData();
                formData.append('email', email);

                const response = await fetch('fetch/check_email.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                // Checking if email exists
                if (data.exists) {
                    form.querySelector('#reg-email').classList.add('is-invalid');
                    document.getElementById('email-exists-feedback').style.display = 'block'; // Display the error message
                    document.getElementById('email-error').style.display = 'none'; // Display the error message
                    isValid = false;
                    document.body.classList.add('error-mode');
                } else {
                    form.querySelector('#reg-email').classList.remove('is-invalid');
                    document.getElementById('email-exists-feedback').style.display = 'none'; // Hide the error message if email doesn't exist
                }

                form.classList.add('was-validated');

                if (isValid) {
                    form.submit(); // Manually submit the form if all validations pass
                }
            }, false);
        });
    })();
</script>

<!-- for making user that the contact number is only number and limited to 11 -->
<script>
    document.getElementById('reg-contact_num').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
        if (value.length > 11) {
            value = value.slice(0, 11); // Limit to 11 digits
        }
        // Add spaces after the 4th and 7th digits
        value = value.replace(/(\d{4})(\d{3})(\d{0,4})/, '$1 $2 $3').trim();
        e.target.value = value;
    });

    document.getElementById('reg-affiliation_contactNum').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
        if (value.length > 11) {
            value = value.slice(0, 11); // Limit to 11 digits
        }
        // Add spaces after the 4th and 7th digits
        value = value.replace(/(\d{4})(\d{3})(\d{0,4})/, '$1 $2 $3').trim();
        e.target.value = value;
    });
</script>

</html>