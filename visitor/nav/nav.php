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

<!-- NAVBAR -->
<div class="navbar navbar-dark navbar-expand-md" id="main-nav">
    <div class="container">

        <!-- logo -->
        <a href="home.php" class="navbar-brand h1"><i class="fa-solid fa-crop-simple"></i></a>

        <!-- hamburger button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navLink">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- nav links -->
        <div class="collapse navbar-collapse" id="navLink">

            <!-- VISITOR -->
            <ul class="navbar-nav me-auto">

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

                <!-- about -->
                <li class="nav-item fw-semibold me-2">
                    <a href="" class="nav-link">About</a>
                </li>

            </ul>

            <!-- ADMIN -->
            <?php require 'nav/admin-nav.php'?>

            <!-- VISITOR -->
            <?php require 'nav/visit-nav.php'?>
        </div>


    </div>
</div>