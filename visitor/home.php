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
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

    <!-- CAROUSEL -->
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1444858291040-58f756a3bdd6?q=80&w=1978&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100 carousel-img" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://plus.unsplash.com/premium_photo-1664123873245-bd178d77ca19?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100 carousel-img" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1560493676-04071c5f467b?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100 carousel-img" alt="...">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
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
                            <p class="card-text">Navigate Our Map for an Interactive Journey Through the Rich Diversity of Traditional Agriculture in the Region.</p>
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
                            <img src="https://images.pexels.com/photos/1438072/pexels-photo-1438072.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top sys-link-img-half" alt="...">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">About Travis</h5>
                                <p class="card-text">Explore Our Website for Detailed Information on Our Crop Initiatives, Projects, and Collaborative Efforts in Agricultural Development.</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-light border float-end">Check Out!</a>
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
                                <a href="" class="col-4 btn btn-link link-secondary fs-5"><img src="img/msu-gensan-logo-85758e.png" class="partners-item" alt="" srcset=""></i></a>
                                <a href="" class="col-4 btn btn-link link-secondary fs-5"><img src="img/Province_of_Sarangani_-_Official_Seal.png" class="partners-item" alt="" srcset=""></i></a>
                                <a href="" class="col-4 btn btn-link link-secondary fs-5"><img src="img/Department_of_Agriculture_of_the_Philippines.png" class="partners-item" alt="" srcset=""></i></a>
                                <a href="" class="col-4 btn btn-link link-secondary fs-5"><img src="img/430144392_852452413559156_7438506279784221589_n.jpg" class="partners-item" alt="" srcset=""></i></a>
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