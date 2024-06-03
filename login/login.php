<?php
session_start();
require('../functions/functions.php');
require('../functions/connections.php');

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = login($_POST);
    if (count($errors) == 0) {
        header("location: ../visitor/home.php");
        die();
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
    <title>Travis | Login</title>

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

<body class="">

    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <?php
            include "../functions/message.php";
            ?>
            <!-- form -->
            <div class="col-4">
                <form method="POST" class="border rounded-4 bg-light py-5 px-5 needs-validation" novalidate>

                    <!-- logo -->
                    <div class="row d-flex justify-content-center align-items-center">
                        <img class="col-6" src="../img/travis.svg" alt="" srcset="">
                    </div>

                    <!-- heading -->
                    <div class="row d-flex justify-content-center align-items-center py-4">
                        <h3 class="text-center">Login</h3>
                    </div>

                    <div id="email-exists-feedback" class="alert alert-danger rounded-4 invalid-feedback" role="alert">
                        Email or password does not exist.
                    </div>

                    <!-- email -->
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="fs-6 form-control rounded-4" id="login-email" placeholder="name@example.com" required>
                        <label for="login-email" class="fs-6">Email</label>
                        <div id="email-error" class="invalid-feedback">
                            Please enter email.
                        </div>
                    </div>

                    <!-- password -->
                    <div class="form-floating">
                        <input type="password" name="password" class="fs-6 form-control rounded-4" id="login-password" placeholder="Password" required>
                        <label for="login-password" class="fs-6">Password</label>
                        <div id="pass-error" class="invalid-feedback">
                            Please enter password.
                        </div>
                    </div>

                    <!-- login btn -->
                    <div class="d-flex justify-content-center align-items-center my-3">
                        <button class="btn btn-success rounded-4 fw-bold w-100 py-3" type="submit" name="login-submit" value="login">Login</button>
                    </div>
                    <!-- sign up -->
                    <div class="d-flex justify-content-center align-items-center my-3">
                        Be a Contributor.<a href="register.php" class="ms-1"> Sign Up!</a>
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
            form.addEventListener('submit', async event => { // Make the function async
                event.preventDefault()
                event.stopPropagation()

                if (!form.checkValidity()) {
                    form.classList.add('was-validated')
                    return;
                }
                // Check if email already exists in the database
                const email = form.querySelector('#login-email').value;
                const password = form.querySelector('#login-password').value;
                const formData = new FormData();
                formData.append('email', email); // Append email
                formData.append('password', password); // Append password

                // console.log('FormData:', formData); // Log the FormData object

                const response = await fetch('fetch/check_login.php', {
                    method: 'POST',
                    body: formData
                });
                //const responseText = await response.text();
                //console.log('Response:', response);
                const data = await response.json();

                if (data.exists) {
                    form.querySelector('#login-email').classList.remove('is-invalid');
                    form.querySelector('#login-password').classList.remove('is-invalid');
                    document.getElementById('email-exists-feedback').style.display = 'none';

                    form.submit();
                } else {
                    form.querySelector('#login-email').classList.add('is-invalid');
                    form.querySelector('#login-password').classList.add('is-invalid');
                    document.getElementById('email-exists-feedback').style.display = 'block';
                    document.getElementById('email-error').style.display = 'none';
                    document.getElementById('pass-error').style.display = 'none';
                    document.body.classList.add('error-mode');
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

</html>