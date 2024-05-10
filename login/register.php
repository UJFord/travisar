<?php
session_start();
require('../functions/connections.php');
require('../functions/functions.php');
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = signup($_POST);

    if (count($errors) == 0) {
        $_SESSION['message'] = "<div class='success'>Signup successful wait for the verification in your email.</div>";
        sleep(5);
        header("location: login.php");
        exit();
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tavisar | Login</title>

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

<body class="py-5">

    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <!-- form -->
            <div class="col-6">
                <form action="" method="POST" class="border rounded-4 bg-light py-5 px-5 needs-validation" novalidate>

                    <!-- logo -->
                    <div class="row d-flex justify-content-center align-items-center">
                        <img class="col-6" src="../img/travis.svg" alt="" srcset="">
                    </div>

                    <!-- heading -->
                    <div class="row d-flex justify-content-center align-items-center py-4">
                        <h3 class="text-center">Register</h3>
                    </div>

                    <!-- firstname -->
                    <div class="row d-flex justify-content-between mb-3">
                        <div class="col-6 form-floating">
                            <input type="text" class="fs-6 form-control rounded-4" id="f-name" name="first_name" placeholder="name@example.com" required>
                            <label for="f-name" class="fs-6 ms-3">Firstname</label>
                            <div class="invalid-feedback">
                                Please provide first name.
                            </div>
                        </div>
                        <div class="col-6 form-floating ">
                            <input type="text" class="fs-6 form-control rounded-4" id="lname" name="last_name" placeholder="name@example.com" required>
                            <label for="lname" class="fs-6 ms-3">Lastname</label>
                            <div class="invalid-feedback">
                                Please provide last name.
                            </div>
                        </div>
                    </div>

                    <!-- gender -->
                    <div class="form-floating mb-3">
                        <select name="gender" id="reg-gender" class="fs-6 form-select rounded-4" required>
                            <option value="" selected disabled hidden></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Rather not say">Rather not say</option>
                        </select>
                        <label for="reg-gender" class="fs-6">Gender</label>
                        <div class="invalid-feedback">
                            Please select a gender.
                        </div>
                    </div>

                    <!-- username -->
                    <div class="form-floating mb-3">
                        <input type="text" class="fs-6 form-control rounded-4" id="reg-uname" name="username" placeholder="Username" required>
                        <label for="reg-uname" class="fs-6">Username</label>
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>

                    <!-- email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="fs-6 form-control rounded-4" id="reg-email" name="email" placeholder="Email" required>
                        <label for="reg-email" class="fs-6">Email</label>
                        <div id="email-error" class="invalid-feedback">
                            Please enter your email.
                        </div>
                        <!-- Add this <div> for displaying password length error message -->
                        <div id="email-exists-feedback" class="invalid-feedback">
                            Email already exists.
                        </div>
                    </div>

                    <!-- password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="fs-6 form-control rounded-4" id="reg-pass" name="password" placeholder="Password" required>
                        <label for="reg-pass" class="fs-6">Password</label>
                        <div id="password-length-error" class="invalid-feedback">
                            Please enter password.
                        </div>
                        <!-- Add this <div> for displaying password length error message -->
                        <div id="password-length-length" class="invalid-feedback">
                            Password must be at least 8 characters long.
                        </div>
                    </div>

                    <!-- Confirm -->
                    <div class="form-floating mb-3">
                        <input type="password" class="fs-6 form-control rounded-4" id="reg-confirm" name="password2" placeholder="Confirm Password" required>
                        <label for="reg-confirm" class="fs-6">Confirm Password</label>
                        <div class="invalid-feedback">
                            Please confirm password.
                        </div>
                    </div>

                    <!-- affiliation -->
                    <div class="form-floating mb-3">
                        <input type="text" class="fs-6 form-control rounded-4" id="reg-affiliation" name="affiliation" placeholder="Affiliation" required>
                        <label for="reg-affiliation" class="fs-6">Affiliation</label>
                        <div class="invalid-feedback">
                            Please provide affiliation.
                        </div>
                    </div>

                    <!-- Signup btn -->
                    <div class="d-flex justify-content-center align-items-center my-3">
                        <button class="btn btn-success rounded-4 fw-bold w-100 py-3" type="submit" value="Signup" class="submit">Sign Up!</button>
                    </div>

                    <!-- sign up -->
                    <div class="d-flex justify-content-center align-items-center my-3">
                        Already a Contributor?<a href="login.php" class="ms-1"> Login!</a>
                    </div>

                    <!-- visitor page -->
                    <div class="d-flex justify-content-center align-items-center">
                        Back to<a href="../visitor/home.php" class="ms-1"> Visitor's Page</a>
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
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', async event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                // Add custom validation for password match
                if (form.checkValidity() && form.querySelector('#reg-pass').value !== form.querySelector('#reg-confirm').value) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.querySelector('#reg-confirm').classList.add('is-invalid')
                }

                // Add custom validation for password length
                if (form.checkValidity() && form.querySelector('#reg-pass').value.length < 8) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.querySelector('#reg-pass').classList.add('is-invalid')
                    document.getElementById('password-length-length').style.display = 'block'; // Display the error message
                    document.getElementById('password-length-error').style.display = 'none'; // Display the error message
                } else {
                    document.getElementById('password-length-length').style.display = 'none'; // Hide the error message if password length is valid
                    document.getElementById('password-length-error').style.display = 'block'; // Display the error message
                }

                // Check if email already exists in the database
                const email = form.querySelector('#reg-email').value;
                const formData = new FormData();
                formData.append('email', email);

                const response = await fetch('check_email.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.exists) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.querySelector('#reg-email').classList.add('is-invalid');
                    document.getElementById('email-exists-feedback').style.display = 'block'; // Display the error message
                    document.getElementById('email-error').style.display = 'none'; // Display the error message
                } else {
                    form.querySelector('#reg-email').classList.remove('is-invalid');
                    document.getElementById('email-exists-feedback').style.display = 'none'; // Hide the error message if email doesn't exist
                    document.getElementById('email-error').style.display = 'block'; // Display the error message
                }

                form.classList.add('was-validated')
            }, false)

            // Add event listener for password confirmation validation on keyup
            form.querySelector('#reg-confirm').addEventListener('keyup', () => {
                const passwordInput = form.querySelector('#reg-pass').value
                const confirmPasswordInput = form.querySelector('#reg-confirm').value
                const confirmPasswordField = form.querySelector('#reg-confirm')

                if (passwordInput === confirmPasswordInput) {
                    confirmPasswordField.classList.remove('is-invalid')
                } else {
                    confirmPasswordField.classList.add('is-invalid')
                }
            })

            // Add event listener for password length validation on keyup
            form.querySelector('#reg-pass').addEventListener('keyup', () => {
                const passwordLength = form.querySelector('#reg-pass').value.length
                const passwordField = form.querySelector('#reg-pass')

                if (passwordLength >= 8) {
                    passwordField.classList.remove('is-invalid')
                } else {
                    passwordField.classList.add('is-invalid')
                }
            })
        })
    })()
</script>

</html>