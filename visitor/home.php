<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";
?>

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
    <link rel="stylesheet" href="../css/global-declarations.css">
    <!-- landing.css -->
    <link rel="stylesheet" href="css/landing.css?v=1.0">
    <!-- script for access control -->
    <script src="../js/access-control.js"></script>
    <script src="../js/window.js"></script>

    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
    </script>
</head>

<body>
    <!-- NAVBAR -->
    <?php require "../nav/nav.php" ?>

    <!-- HEADER -->
    <header id="head" class="container-fluid py-5">
        <div class="container">
            <div class="row">

                <!-- left -->
                <div class="col-8 d-flex flex-column justify-content-end pt-5">
                    <div id="head-text" class="fw-bolder fs-1 text-white mb-2 pt-5">Welcome to <span><img class="pb-3 " id="logo-in-header" src="img/travis-light.svg" alt="" srcset=""></span></div>
                    <div id="head-subtitle" class=" fs-5 text-light mb-4">Seeds of the Past, Harvest of the Future: The Traditional Crop Varieties Information System is a comprehensive repository housing various information on morphological characteristics, sensory traits, agronomic features, and the cultural significance and utilization of traditional crops including rice, corn, and root crops.</div>
                    <div class="head-link ps-3 row">
                        <a href="all.php" class="col-2 btn btn-light fw-5 fw-bold icon-link icon-link-hover p-2 px-3 me-3 d-flex justify-content-center">Explore<i class="bi bi-arrow-right fw-bold"></i></a>
                    </div>
                </div>

                <!-- sarangani image -->
                <div class="col-4">
                    <div class="head-img-container d-flex justify-content-center align-items-center">
                        <!-- <img id="head-img" src="img/sarMap.svg" alt="" srcset=""> -->
                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- FEATURES -->
    <div class="container my-5 bg-white">
        <div class="row mb-5">
            <h2 id="feature-title" class="text-center fw-bold">FEATURES</h3>
        </div>
        <div class="row">

            <!-- Crops List -->
            <div class="col mx-3">
                <div class="row fs-5">
                    <!-- Icon -->
                    <div class="col-1 d-flex justify-content-start align-items-center p-0">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                    <!-- Description -->
                    <div class="col fw-bold p-0">
                        Crops Database
                    </div>
                </div>
                <div class="row mt-2">
                    <p class="p-0">Explore our extensive collection of information about traditional crop varieties, including their morphological characteristics, sensory traits, agronomic traits, and cultural utilization and importance.
                    </p>
                </div>
            </div>

            <!-- Map -->
            <div class="col mx-3">
                <div class="row fs-5">
                    <!-- Icon -->
                    <div class="col-1 d-flex justify-content-start align-items-center p-0">
                        <i class="fa-solid fa-earth-asia"></i>
                    </div>
                    <!-- Description -->
                    <div class="col fw-bold p-0">
                        Interactive Map
                    </div>
                </div>
                <div class="row mt-2">
                    <p class="p-0">Navigate our interactive map to explore the geographical distribution of traditional crop varieties. Discover where each crop is cultivated, learn about regional variations, and gain insights into their significance in different areas.</p>
                </div>
            </div>

            <!-- Contribute -->
            <div class="col mx-3">
                <div class="row fs-5">
                    <!-- Icon -->
                    <div class="col-1 d-flex justify-content-start align-items-center p-0">
                        <i class="fa-solid fa-upload"></i>
                    </div>
                    <!-- Description -->
                    <div class="col fw-bold">
                        Contribute
                    </div>
                </div>
                <div class="row mt-2">
                    <p class="p-0">Join our community by registering as a contributor. Share your knowledge and expertise about traditional crop varieties, helping to enrich our database for fellow enthusiasts and researchers in the country.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- QUICK LINKS -->
    <div id="quick-link-container" class="container-fluid bg-light">
        <div class="container">

            <!-- crop  -->
            <div class="row p-5  d-flex justify-content-center align-items-center">

                <div class="qlink-img-container col-6 d-flex justify-content-start align-items-center">
                    <img class="rounded-3" src="https://images.unsplash.com/photo-1592997571659-0b21ff64313b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top sys-link-img" alt="" srcset="">
                </div>

                <div class="col d-flex flex-column justify-content-center">
                    <h4 class="fw-bold">Crops</h4>
                    <p>Discover traditional crop varieties cultivated in Sarangani and uncover the rich agricultural heritage of the province.</p>
                    <div class="row ps-2">
                        <a href="crop.php" id="crop-qlink" class="col-9 col-md-7 col-lg-5 col-xl-4 btn qlink-link btn-success border fw-5 fw-bold icon-link icon-link-hover p-2 px-3 me-3 d-flex justify-content-center">
                            Explore Now!
                            <i class="bi bi-arrow-right fw-bold"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- map -->
            <div class="row p-5">

                <div class="col d-flex flex-column justify-content-center">
                    <h4 class="fw-bold">Map</h4>
                    <p>Navigate our map for an interactive journey through the distribution of traditional crop varieties across the province..</p>
                    <div class="row ps-2">
                        <a href="all.php?map=open" id="map-qlink" class="col-9 col-md-7 col-lg-5 col-xl-4 btn qlink-link btn-success fw-5 fw-bold icon-link icon-link-hover p-2 px-3 me-3 d-flex justify-content-center">
                            Navigate!
                            <i class="bi bi-arrow-right fw-bold"></i>
                        </a>
                    </div>
                </div>

                <div class="qlink-img-container col-6 d-flex justify-content-end align-items-center">
                    <img class="rounded-3" src="img/map.png" alt="" srcset="">
                </div>
            </div>

            <!-- contirbute  -->
            <div class="row p-5  d-flex justify-content-center align-items-center">

                <div class="qlink-img-container col-6 d-flex justify-content-start align-items-center">
                    <img class="rounded-3" src="https://images.unsplash.com/photo-1508780709619-79562169bc64?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top sys-link-img" alt="" srcset="">
                </div>

                <div class="col d-flex flex-column justify-content-center">
                    <h4 class="fw-bold">Contribute</h4>
                    <p>Join our community and share your valuable knowledge to enrich our comprehensive database, providing deeper agricultural insights for sustainable development.</p>
                    <div class="row ps-2">
                        <a href="../login/login.php" id="crop-qlink" class="col-9 col-md-7 col-lg-5 col-xl-4 btn qlink-link btn-success border fw-5 fw-bold icon-link icon-link-hover p-2 px-3 me-3 d-flex justify-content-center">
                            Sign Up Now!
                            <i class="bi bi-arrow-right fw-bold"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- About Travis -->
            <div class="row p-5">

                <div class="col d-flex flex-column justify-content-center">
                    <h4 class="fw-bold">About TRAVIS</h4>
                    <p>Learn more about TRAVIS, designed to store information about traditional crop varieties in Sarangani Province, including their morphological characteristics, sensory traits, agronomic traits, and cultural utilization and importance.</p>
                    <div class="row ps-2">
                        <a href="about/travis.php" id="map-qlink" class="col-9 col-md-7 col-lg-5 col-xl-4 btn qlink-link btn-success fw-5 fw-bold icon-link icon-link-hover p-2 px-3 me-3 d-flex justify-content-center">
                            Learn More!
                            <i class="bi bi-arrow-right fw-bold"></i>
                        </a>
                    </div>
                </div>

                <div class="qlink-img-container col-6 d-flex justify-content-end align-items-center">
                    <img class="rounded-3" src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" srcset="">
                </div>
            </div>
        </div>
    </div>

    <!-- PARTNERS -->
    <div class="container-fluid bg-white">
        <div class="container py-5">
            <div class="row">
                <h2 id="partners-title" class="text-center fw-bold mb-5">OUR PARTNERS</h2>
            </div>
            <div class="row">
                <!-- main -->
                <div class="col">
                    <div class="row d-flex justify-content-center">
                        <img src="img/Province_of_Sarangani_-_Official_Seal.png" class="col-4" alt="" srcset="">
                        <img src="img/msu-gensan-logo-85758e.png" class="col-4" alt="" srcset="">
                    </div>
                </div>
                <!-- other -->
                <div class="col">
                    <div class="row">
                        <img src="img/jits.jpg" class="col-2 p-3" alt="" srcset="">
                        <img src="img/itphysics.jpg" class="col-2 p-3" alt="" srcset="">
                        <img src="img/saad.png" class="col-2 p-3" alt="" srcset="">
                        <img src="img/cropped-alabel-500px-1.png" class="col-2 p-3" alt="" srcset="">
                        <img src="img/glan.png" class="col-2 p-3" alt="" srcset="">
                        <img src="img/kiamba.png" class="col-2 p-3" alt="" srcset="">
                        <img src="img/maasim.png" class="col-2 p-3" alt="" srcset="">
                        <img src="img/maitum.png" class="col-2 p-3" alt="" srcset="">
                        <img src="img/malungon.png" class="col-2 p-3" alt="" srcset="">
                        <img src="img/malapatan.png" class="col-2 p-3" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require "../nav/foot.php" ?>

    <!-- SCRIPT -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CUSTOM -->
    <script src="js/nav.js"></script>
    <script src="js/home.js"></script>
</body>

</html>