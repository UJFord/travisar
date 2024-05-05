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
    <!-- CSS -->
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- freemen -->
    <link href="https://fonts.googleapis.com/css2?family=Freeman&family=Kanit&display=swap" rel="stylesheet">

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
                <div class="col-8 d-flex flex-column justify-content-end">
                    <div id="head-text" class="fw-bolder fs-1 text-white ">Welcome to <span><img id="logo-in-header" src="img/travis-light.svg" alt="" srcset=""></span></div>
                    <div id="head-subtitle" class=" fs-5 text-light mb-4">Seeds of the Past, Harvest of the Future: The Traditional Crop Varieties Information System is a comprehensive repository housing various information on morphological characteristics, sensory traits, agronomic features, and the cultural significance and utilization of traditional crops including rice, corn, and root crops.</div>
                    <div class="head-link ps-3 row">
                        <a href="" class="col-2 btn btn-light fw-5 fw-bold icon-link icon-link-hover p-2 px-3 me-3 d-flex justify-content-center">Explore<i class="bi bi-arrow-right fw-bold"></i></a>
                        <div class="col-2 text-light small-font">Over Hundreds of Crops Listed!</div>
                    </div>
                </div>

                <!-- sarangani image -->
                <div class="col">
                    <div class="head-img-container d-flex justify-content-center align-items-center">
                        <img id="head-img" src="img/sarMap.svg" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- FEATURES -->
    <div class="container my-5 bg-white">
        <div class="row mb-3">
            <h3 id="feature-title" class="text-center fw-bold">Features</h3>
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

            <!-- <div class="row mb-3">
                <h4 id="quick-link-title" class="text-center fw-bold">Quick Links</h4>
            </div> -->

            <!-- crop  -->
            <div class="row py-5  d-flex justify-content-center align-items-center">

                <div class="qlink-img-container col-6 d-flex justify-content-center align-items-center">
                    <img src="img/undraw_forming_ideas_re_2afc.svg" alt="" srcset="">
                </div>

                <div class="col d-flex flex-column justify-content-center">
                    <h4 class="fw-bold">Crops</h4>
                    <p>Discover traditional crop varieties cultivated in Sarangani and uncover the rich agricultural heritage of the province.</p>
                    <div class="row ps-3">
                        <a href="" id="crop-qlink" class="col-3 btn qlink-link btn-success border fw-5 fw-bold icon-link icon-link-hover p-2 px-3 me-3 d-flex justify-content-center">
                            Explore Now
                            <i class="bi bi-arrow-right fw-bold"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- map -->
            <div class="row py-5">

                <div class="col d-flex flex-column justify-content-center">
                    <h4 class="fw-bold">Crops</h4>
                    <p>Discover traditional crop varieties cultivated in Sarangani and uncover the rich agricultural heritage of the province.</p>
                    <div class="row ps-3">
                        <a href="" id="map-qlink" class="col-3 btn qlink-link btn-success fw-5 fw-bold icon-link icon-link-hover p-2 px-3 me-3 d-flex justify-content-center">
                            Navigate
                            <i class="bi bi-arrow-right fw-bold"></i>
                        </a>
                    </div>
                </div>

                <div class="qlink-img-container col-6 d-flex justify-content-center align-items-center">
                    <img src="img/undraw_location_search_re_ttoj.svg" alt="" srcset="">
                </div>
            </div>

            <div class="row">

                <!-- system links -->
                <div class="col-12">
                    <div class="row d-flex flex-column align-items-center">

                        <!-- navigate to crops -->
                        <div class="card col-6 p-0 mb-3">
                            <img src="https://images.unsplash.com/photo-1592997571659-0b21ff64313b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top sys-link-img" alt="...">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Crops</h5>
                                <p class="card-text">Discover traditional crop varieties cultivated in Sarangani and uncover the rich agricultural heritage of the province.</p>
                                <a href="#" class="btn btn-light border float-end">Explore Now!</a>
                            </div>
                        </div>

                        <!-- navigate to map -->
                        <div class="card col-6 p-0 mb-3">
                            <img src="img/map.png" class="card-img-top sys-link-img" alt="...">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Map</h5>
                                <p class="card-text">Navigate our map for an interactive journey through the distribution of traditional crop varieties across the province.</p>
                                <a href="#" class="btn btn-light border float-end">Navigate Now!</a>
                            </div>
                        </div>

                        <div class="col-6 d-flex flex-row justify-content-between p-0">
                            <!-- navigate to contributors -->
                            <div class="card p-0 mb-3 me-3">
                                <img src="https://images.unsplash.com/photo-1508780709619-79562169bc64?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top sys-link-img-half" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Contribute</h5>
                                    <p class="card-text">Join our community and share your valuable knowledge to enrich our comprehensive database, providing deeper agricultural insights for sustainable development.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-light border float-end">Sign Up Now!</a>
                                </div>
                            </div>

                            <!-- navigate to about -->
                            <div class="card p-0 mb-3">
                                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top sys-link-img-half" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">About Travis</h5>
                                    <p class="card-text">Learn more about TRAVIS, designed to store information about traditional crop varieties in Sarangani Province, including their morphological characteristics, sensory traits, agronomic traits, and cultural utilization and importance.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-light border float-end streched-link">Check Out!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">

                    <!-- socicals -->
                    <div class="row d-flex flex-column align-items-center mb-5">
                        <div class="col-10">
                            <div class="card">
                                <div class="card-header">
                                    Socials
                                </div>
                                <div class="card-body d-flex">
                                    <a href="" class="btn btn-link link-secondary fs-5"><i class="fa-brands fa-facebook"></i></a>
                                    <a href="" class="btn btn-link link-secondary fs-5"><i class="fa-brands fa-youtube"></i></i></a>
                                    <a href="" class="btn btn-link link-secondary fs-5"><i class="fa-brands fa-square-x-twitter"></i></a>
                                    <a href="" class="btn btn-link link-secondary fs-5"><i class="fa-brands fa-viber"></i></a>
                                    <a href="" class="btn btn-link link-secondary fs-5"><i class="fa-brands fa-github"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- partners -->
                    <div class="row d-flex flex-column align-items-center">
                        <div class="col-10">
                            <div class="card">
                                <div class="card-header">
                                    Partners
                                </div>
                                <div class="row card-body d-flex">
                                    <a href="https://msugensan.edu.ph/" class="col-4 btn btn-link link-secondary fs-5" target="_blank"><img src="img/msu-gensan-logo-85758e.png" class="partners-item" alt="" srcset=""></i></a>
                                    <a href="https://www.facebook.com/JITSmsugsc" class="col-4 btn btn-link link-secondary fs-5" target="_blank"><img src="img/jits.jpg" class="partners-item" alt="" srcset=""></i></a>
                                    <a href="https://www.facebook.com/opagsarangani/" class="col-4 btn btn-link link-secondary fs-5" target="_blank"><img src="img/Province_of_Sarangani_-_Official_Seal.png" class="partners-item" alt="" srcset=""></i></a>
                                    <a href="https://saad.da.gov.ph/priority_provinces/region-xii/sarangani" class="col-4 btn btn-link link-secondary fs-5" target="_blank"><img src="img/saad.png" class="partners-item" alt="" srcset=""></i></a>
                                    <a href="" class="col-4 btn btn-link link-secondary fs-5" target="_blank"><img src="img/Department_of_Agriculture_of_the_Philippines.png" class="partners-item" alt="" srcset=""></i></a>
                                    <a href="https://kiamba.gov.ph/" class="col-4 btn btn-link link-secondary fs-5" target="_blank"><img src="img/kiamba.png" class="partners-item" alt="" srcset=""></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CUSTOM -->
    <script src="js/home.js"></script>
    <script src="js/nav.js"></script>
</body>

</html>