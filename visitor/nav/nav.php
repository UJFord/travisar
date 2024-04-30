<!-- get current page to choose the active link -->
<?php
// current page path
$current_page_path = $_SERVER['REQUEST_URI'];

// current page html boolean
$current_page_isHome = false;
$current_page_isCrop = false;

switch ($current_page_path) {
    case "/travisar/visitor/home.php":
        $current_page_isHome = true;
        break;
    case "/travisar/visitor/crop.php":
        $current_page_isCrop = true;
        break;
    case "/travisar/visitor/view-crop.php":
        $current_page_isCrop = true;
        break;
}
?>

<!-- font awesome kit -->
<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

<!-- NAVBAR -->
<div class="navbar navbar-dark navbar-expand-sm" id="main-nav">
    <div class="container">

        <!-- logo -->
        <a href="home.php" class="navbar-brand h1"><i class="fa-solid fa-crop-simple"></i></a>

        <!-- hamburger button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navLink">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- nav links -->
        <div class="collapse navbar-collapse" id="navLink">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- home page link -->
                <li class="nav-item">
                    <!-- add active class when at home.php -->
                    <a class="nav-link fw-bold me-2 <?php if ($current_page_isHome) {
                                                            echo "active";
                                                        } ?>" aria-current="page" href="home.php">Home</a>
                </li>
                <!-- crop page link -->
                <li class="nav-item fw-bold me-2">
                    <!-- add active class when at crop.php -->
                    <a class="nav-link <?php if ($current_page_isCrop) {
                                            echo "active";
                                        } ?>" href="crop.php">Crops</a>
                </li>

                <!-- ADMIN -->

                <!-- all crops -->
                <div class="nav-item  ms-5 me-2 border-start border-light
                ">
                    <a href="" class="nav-link">All Crops</a>
                </div>

                <!-- my crops -->
                <div class="nav-item fw-semibold me-2">
                    <a href="" class="nav-link">My Crops</a>
                </div>

                <!-- crop management -->
                <div class="nav-item fw-semibold me-2 dropdown">
                    <a href="" id="mng-nav" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Crop Management
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="mng-nav">
                        <li><a href="" class="dropdown-item">Pending</a></li>
                        <li><a href="" class="dropdown-item">Approved</a></li>
                        <li><a href="" class="dropdown-item">Rejected</a></li>
                    </ul>
                </div>

                <!-- settings -->
                <div class="nav-item fw-semibold me-2 dropdown">
                    <a href="#" id="set-nav" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Settings
                    </a>
                    <ul id="set-nav-menu" class="dropdown-menu">

                        <!-- crop settings -->
                        <li class="dropend">
                            <button id="set-nav-crop" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                Crop Settings
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="set-nav-crop">
                                <li><a href="#" class="dropdown-item">Crop Category</a></li>
                                <li><a href="#" class="dropdown-item">Category Variety</a></li>
                                <li><a href="#" class="dropdown-item">Abiotic Resistance</a></li>
                                <li><a href="#" class="dropdown-item">Disease Resistance</a></li>
                                <li><a href="#" class="dropdown-item">Pest Resistance</a></li>
                            </ul>
                        </li>

                        <!-- location settings -->
                        <li class="dropend">
                            <button id="set-nav-loc" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                Location Settings
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="set-nav-loc">
                                <li><a href="#" class="dropdown-item">Barangay</a></li>
                                <li><a href="#" class="dropdown-item">Municipality</a></li>
                            </ul>
                        </li>

                        <!-- user accounts -->
                        <li class="dropend">
                            <button id="set-nav-usr" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                User Account
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="set-nav-usr">
                                <li><a href="#" class="dropdown-item">Users</a></li>
                                <li><a href="#" class="dropdown-item">Verification</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>

            </ul>
        </div>

        <!-- contributors link -->
        <a href="../login/login-form.php" class="link-light link-offset-3 link-underline link-underline-opacity-0 rounded-pill px-3 py-2" id="contributor-link">Contribute to Travis</a>
    </div>
</div>