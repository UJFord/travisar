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
                    <div id="head-text" class="fw-bolder fs-1 text-white ">Preserve Traditional Crop Farmer's Knowledge</div>
                    <div id="head-subtitle" class=" fs-5 text-light mb-4">We Document Traditional Rice, Corn, and Root Crops of Sarangani</div>
                    <div class="head-link ps-3 row">
                        <a href="" class="col-2 btn btn-light fw-5 fw-bold icon-link icon-link-hover p-2 px-3 me-3 d-flex justify-content-center">Crops List<i class="bi bi-arrow-right fw-bold"></i></a>
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
    <div class="container">
        <div class="row my-5">

            <!-- Crops List -->
            <div class="col mx-3">
                <div class="row fs-5">
                    <!-- Icon -->
                    <div class="col-1 d-flex justify-content-start align-items-center p-0">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                    <!-- Description -->
                    <div class="col fw-bold p-0">
                        Crops List
                    </div>
                </div>
                <div class="row mt-2">
                    <p class="p-0">
                        A webpage devoted to showcasing the various crops listed within our extensive agricultural database.</p>
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
                    <p class="p-0">A visual map displaying pins at the last known locations of each item in our database for easy reference and tracking.</p>
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
                    <p class="p-0">Be a contributor and join us in our goal to improve Travis.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SYSTEM LINKS -->
    <div class="container my-5">
        <div class="row">

            <!-- system links -->
            <div class="col-8">
                <div class="row d-flex flex-column align-items-center">

                    <!-- navigate to crops -->
                    <div class="card col-9 p-0 mb-3">
                        <img src="https://images.unsplash.com/photo-1592997571659-0b21ff64313b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top sys-link-img" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Crops</h5>
                            <p class="card-text">Discover Traditional Crops Cultivated in Sarangani and Uncover the Rich Agricultural Heritage of the Region.</p>
                            <a href="#" class="btn btn-light border float-end">Explore Now!</a>
                        </div>
                    </div>

                    <!-- navigate to map -->
                    <div class="card col-9 p-0 mb-3">
                        <img src="img/map.png" class="card-img-top sys-link-img" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Map</h5>
                            <p class="card-text">Navigate Our Map for an Interactive Journey Through the Rich Diversity of Traditional Agriculture in the Province.</p>
                            <a href="#" class="btn btn-light border float-end">Navigate Now!</a>
                        </div>
                    </div>

                    <div class="col-9 d-flex flex-row justify-content-between p-0">
                        <!-- navigate to contributors -->
                        <div class="card p-0 mb-3 me-3">
                            <img src="https://images.unsplash.com/photo-1508780709619-79562169bc64?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top sys-link-img-half" alt="...">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Contribute</h5>
                                <p class="card-text">Join Our Community and Share Your Valuable Knowledge to Enrich Our Comprehensive Database, Enhancing Agricultural Insights for Sustainable Development.</p>
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
                                <p class="card-text">Explore Our Website for Detailed Information on Our Crop Initiatives, Projects, and Collaborative Efforts in Agricultural Development.</p>
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