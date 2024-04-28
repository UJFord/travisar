<?php
session_start();
require('../functions/functions.php');
require('../functions/connections.php');

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = login($_POST);
    if (count($errors) == 0) {
        header("location: ../contributor/crop-page/crop.php");
        die();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Travisar</title>

    <!-- STYLESHEETS -->
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CUSTOM -->
    <!-- global declarations -->
    <!-- Check access when the page loads -->
</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>

                    <?php
                    include "../functions/message.php";
                    ?>

                    <div>
                        <?php if (count($errors) > 0) : ?>
                            <?php foreach ($errors as $error) : ?>
                                <?= $error ?> <br>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- login starts here -->

                    <div class="card-body">
                        <form action="" method="POST" class="text-center">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="d-grid mb-3">
                                <input class="btn btn-primary" type="submit" name="submit" value="login">
                            </div>
                        </form>
                        <!-- login form ends here -->
                        <p class="text-center">Return to homepage? - <a href="../index.php">Go Back</a></p>
                        <p class="text-center">Want to signup? - <a href="signup.php">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <!--bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
</body>

</html>