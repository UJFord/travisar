<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travis | Home</title>
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
    <!-- landing.css -->
    <link rel="stylesheet" href="../css/about.css?v=1.0">
    <!-- script for access control -->
    <script src="../js/access-control.js"></script>
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
    </script>
</head>

<body class="" style="">
    <!-- NAVBAR -->
    <?php require "../../nav/nav.php" ?>

    <!-- SARANGANI -->
    <!-- title -->
    <div class="container-fluid bg-light">
        <div class="container">
            <div class="row py-5 mb-4">
                <h1 class="about-head text-center">COLLABORATORS</h1>
            </div>
        </div>
    </div>

    <!-- collaborators -->
    <div class="container mb-5">
        <div class="row mx-5 d-flex justify-content-center align-items-center">

            <!-- sarangani seal-->
            <div class="col-8 col-lg-6 mb-5">
                <div class="row">
                    <a href="https://www.facebook.com/opagsarangani/" target="_blank" class="col-4 d-flex justify-content-center align-items-center">
                        <img class="collab-img img-fluid" src="../img/Province_of_Sarangani_-_Official_Seal.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h4>Office of Provincial Agriculturist - Sarangani Province</h4>
                        <h6 class="text-secondary">Partnered Agency</h6>
                    </div>
                </div>
            </div>

            <!-- msu seal-->
            <div class="col-8 col-lg-6 mb-5">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-4 d-flex justify-content-center align-items-center">
                        <img class="collab-img img-fluid" src="../img/msu-gensan-logo-85758e.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h4>Mindanao State University - General Santos</h4>
                        <h6 class="text-secondary">Implementing Agency</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contianer mb-5">

        <div class="row my-2  mx-5 d-flex justify-content-center align-items-center">

            <!-- jits -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/jits.jpg"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Junior Information Technology Society</h5>
                        <!-- <h6 class="small-font text-secondary">y</h6> -->
                    </div>
                </div>
            </div>

            <!-- it physics -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/itphysics.jpg"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Information Technology and Physics Department</h5>
                        <!-- <h6 class="small-font text-secondary">y</h6> -->
                    </div>
                </div>
            </div>

        </div>

        <div class="row my-2 mx-5 d-flex justify-content-center align-items-center">

            <!-- jits -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/saad.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Special Area for Agricultural Development</h5>
                        <!-- <h6 class="small-font text-secondary"></h6> -->
                    </div>
                </div>
            </div>

            <!-- alabel -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/cropped-alabel-500px-1.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Municipality of Alabel</h5>
                        <!-- <h6 class="small-font text-secondary"></h6> -->
                    </div>
                </div>
            </div>

        </div>

        <div class="row my-2 mx-5 d-flex justify-content-center align-items-center">

            <!-- glan -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/glan.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Municipality of Glan</h5>
                        <!-- <h6 class="small-font text-secondary"></h6> -->
                    </div>
                </div>
            </div>

            <!-- kiamba -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/kiamba.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Municipality of Kiamba</h5>
                        <!-- <h6 class="small-font text-secondary"></h6> -->
                    </div>
                </div>
            </div>

        </div>

        <div class="row my-2 mx-5 d-flex justify-content-center align-items-center">

            <!-- maasim -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/maasim.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Municipality of Maasim</h5>
                        <!-- <h6 class="small-font text-secondary"></h6> -->
                    </div>
                </div>
            </div>

            <!-- Maitum -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/maitum.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Municipality of Maitum</h5>
                        <!-- <h6 class="small-font text-secondary"></h6> -->
                    </div>
                </div>
            </div>

        </div>

        <div class="row my-2 mx-5 d-flex justify-content-center align-items-center">

            <!-- Malungon -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/malungon.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Municipality of Malungon</h5>
                        <!-- <h6 class="small-font text-secondary"></h6> -->
                    </div>
                </div>
            </div>

            <!-- Malapatan -->
            <div class="col-4">
                <div class="row">
                    <a href="https://msugensan.edu.ph/" target="_blank" class="col-3 d-flex justify-content-center align-items-center">
                        <img class="collab-img-mini img-fluid" src="../img/malapatan.png"></img>
                    </a>
                    <div class="col d-flex flex-column justify-content-center align-items-bottom">
                        <h5>Municipality of Malapatan</h5>
                        <!-- <h6 class="small-font text-secondary"></h6> -->
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- FOOTER -->
    <?php require "../../nav/foot.php" ?>


    <!-- SCRIPT -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CUSTOM -->
    <script src="js/nav.js"></script>
</body>

</html>