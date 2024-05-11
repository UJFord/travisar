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
                        <button class="btn btn-success rounded-4 fw-bold w-100 py-3" type="submit" name="submit" value="login">Login</button>
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
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
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

                if (!data.exists) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.querySelector('#login-email').classList.add('is-invalid');
                    form.querySelector('#login-password').classList.add('is-invalid');
                    document.getElementById('email-exists-feedback').style.display = 'block'; // Display the error message
                    document.getElementById('email-error').style.display = 'none'; // Hide the error message if email doesn't exist
                    document.getElementById('pass-error').style.display = 'none'; // Hide the error message if email doesn't exist
                } else {
                    form.querySelector('#login-email').classList.remove('is-invalid');
                    form.querySelector('#login-password').classList.remove('is-invalid');
                    document.getElementById('email-exists-feedback').style.display = 'none'; // Hide the error message if email exists
                    document.getElementById('email-error').style.display = 'block'; // Display the error message
                    document.getElementById('pass-error').style.display = 'none'; // Hide the error message if email exists
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>


</html>