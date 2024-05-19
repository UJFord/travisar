<?php
session_start();
require "../../functions/connections.php";
require "../../functions/functions.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travis | Help </title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/travis-light.svg">
    <!-- CSS -->
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- font awesome kit -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

    <!-- CUSTOM CSS -->
    <!-- global -->
    <link rel="stylesheet" href="../../css/global-declarations.css">

    <link rel="stylesheet" href="../css/help.css">

    <!-- script for access control -->
    <script src="../../js/access-control.js"></script>
    <script src="../../js/window.js"></script>

    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
    </script>
</head>

<body>
    <div class="container-fluid p-0 min-vh-100 d-flex flex-column">

        <!-- NAVBAR -->
        <div class="container-fluid position-fixed p-0">
            <?php require "../../nav/nav.php" ?>
        </div>

        <div class="container d-flex pt-5" style="flex-grow: 1;">
            <div class="row w-100">

                <!-- side nav -->
                <div class="col-4 col-lg-2 border-end overflow-y-auto">
                    <div id="help-sidenav" class="pt-5 d-flex flex-column align-items-strech">

                        <!-- introduction -->
                        <div class="row mb-3">
                            <div class="col-2">
                                <i class="fa-solid fa-book-open"></i>
                            </div>
                            <nav class="col nav nav-pills d-flex flex-column">
                                <h6 class="fw-bold ps-2">Getting Started</h6>
                                <a class="active nav-link fw-bold fs-6 flex-fill small-font py-1 ps-3 help-sidenav-link" href="">Introduction</a>
                            </nav>
                        </div>

                        <!-- viewing -->
                        <div class="row mb-3">
                            <div class="col-2">
                                <i class="fa-solid fa-leaf"></i>
                            </div>
                            <nav class="col nav nav-pills d-flex flex-column">
                                <h6 class="fw-bold ps-2">Crops List</h6>
                                <a class="link-dark nav-link fw-bold fs-6 flex-fill small-font py-1 ps-3 help-sidenav-link" href="content.php">Overview</a>
                            </nav>
                        </div>

                        <!-- viewing -->
                        <div class="row">
                            <div class="col-2">
                                <i class="fa-solid fa-upload"></i>
                            </div>
                            <nav class="col nav nav-pills d-flex flex-column">
                                <h6 class="fw-bold ps-2">Contribute</h6>
                                <a class="link-dark nav-link fw-bold fs-6k flex-fill small-font py-1 ps-3 help-sidenav-link" href="contribute.php">Signing Up</a>
                                <a class="link-dark nav-link fw-bold fs-6k flex-fill small-font py-1 ps-3 help-sidenav-link" href="submission.php">Submission</a>
                            </nav>
                        </div>
                    </div>
                </div>
                </nav>

                <!-- main -->
                <div class="col">
                    <div class="container">

                        <!-- heading -->
                        <h1 class="pt-5 fw-bold">Get Started with TRAVIS</h1>
                        <h3 class="fw-light">Documenting traditional crop varieties in Sarangani Province, preserving heritage.</h3>

                        <!-- homepage link -->
                        <div class="row d-flex justify-content-center mt-5">
                            <h3 class="fw-bold">Homepage</h3>
                            <p>Check out the homepage and see what we offer.</p>
                            <a href="" class="btn btn-success w-auto p-3 px-4 fw-bold"> Go to Homepage</a>
                        </div>
                    </div>
                </div>

                <!-- right column -->
                <div class="col-2 border-start"></div>

            </div>
        </div>
    </div>
    </div>

    <!-- SCRIPT -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- custom -->
    <script src="../../js/access.js"></script>
    <script src="../js/nav.js"></script>
</body>

</html>