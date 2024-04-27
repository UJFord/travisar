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
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex mx-auto">
                <!-- home page link -->
                <li class="nav-item">
                    <!-- add active class when at home.php -->
                    <a class="nav-link <?php if ($current_page_isHome) {
                                            echo "active";
                                        } ?>" aria-current="page" href="home.php">Home</a>
                </li>
                <!-- crop page link -->
                <li class="nav-item">
                    <!-- add active class when at crop.php -->
                    <a class="nav-link <?php if ($current_page_isCrop) {
                                            echo "active";
                                        } ?>" href="crop.php">Crops</a>
                </li>
            </ul>
        </div>

        <!-- contributors link -->
        <a href="../login/login-form.php" class="link-light link-offset-3 link-underline link-underline-opacity-0 rounded-pill px-3 py-2" id="contributor-link">Contribute to Travis</a>
    </div>
</div>