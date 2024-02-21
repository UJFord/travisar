<?php
session_start();
require('../functions/connections.php');
require('../functions/functions.php');

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = signup($_POST);

    if (count($errors) == 0) {
        $_SESSION['message'] = "<div class='success'>Signup successful wait for the verification in your email.</div>";
        header("location: login-form.php");
        die();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="css/signup.css">

</head>

<body>

    <div class="login">
        <h1 class="text-center">Sign Up</h1>
        <br><br>

        <?php
        if (isset($_SESSION['failed'])) {
            echo $_SESSION['failed'];
            unset($_SESSION['failed']);
        }
        ?>

        <div>
            <?php if (count($errors) > 0) : ?>
                <?php foreach ($errors as $error) : ?>
                    <?= $error ?> <br>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <br>
        <!-- Login Form starts here -->

        <form action="" autocomplete="off" method="POST" class="form text-center">
            <p class="title">Register </p>
            <p class="message">Signup now and get to help us in our endeavor. </p>
            <div class="flex">
                <label>
                    <input class="input" name="first_name" type="text" placeholder="" required="">
                    <span>Firstname</span>
                </label>

                <label>
                    <input class="input" name="last_name" type="text" placeholder="" required="">
                    <span>Lastname</span>
                </label>
            </div>

            <label>
                <input class="input" name="gender" type="text" placeholder="" required="">
                <span>Gender</span>
            </label>

            <label>
                <input class="input" name="username" type="text" placeholder="" required="">
                <span>Username</span>
            </label>

            <label>
                <input class="input" name="email" type="email" placeholder="" required="">
                <span>Email</span>
            </label>

            <label>
                <input class="input" name="password" type="password" placeholder="" required="">
                <span>Password</span>
            </label>
            <label>
                <input class="input" name="password2" type="password" placeholder="" required="">
                <span>Confirm password</span>
            </label>

            <label>
                <input class="input" name="affiliation" type="text" placeholder="" required="">
                <span>Affiliation</span>
            </label>
            <input type="submit" name="submit" value="Signup" class="submit">
            <p class="signin">Already have an acount ? <a href="login-form.php">Signin</a> </p>
        </form>

        <!-- Login Form ends here -->

    </div>

</body>

</html>