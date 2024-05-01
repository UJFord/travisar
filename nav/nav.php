<?php
// Define the base URL of your local server
define('BASE_URL', 'http://localhost/travisar');

//get current page to choose the active link
// current page path
$current_page_path = $_SERVER['REQUEST_URI'];

// current page html boolean
$current_page_isHome = false;
$current_page_isCrop = false;
$current_page_isCrop_page = false;
$current_page_isSettings = false;
$current_page_isSubmission = false;
$current_page_isManagement = false;


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
    case "/travisar/contributor/crop-page/crop.php":
        $current_page_isCrop_page = true;
        break;
    case "/travisar/contributor/crop-page/category-variety.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/crop-page/crop-category.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/crop-page/abiotic-resistance.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/crop-page/disease-resistance.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/crop-page/pest-resistance.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/location-page/municipality.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/location-page/barangay.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/user-page/partners.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/user-page/verify-user.php":
        $current_page_isSettings = true;
        break;
    case "/travisar/contributor/submission-page/submission.php":
        $current_page_isSubmission = true;
        break;

        //! wala sya ga work diko kabalo deopdown mangud
    case "/travisar/contributor/approval-page/pending.php":
        $current_page_isManagement = true;
        break;
    case "/travisar/contributor/approval-page/approved.php":
        $current_page_isManagement = true;
        break;
    case "/travisar/contributor/approval-page/rejected.php":
        $current_page_isManagement = true;
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
                                                    } ?>" aria-current="page" href="<?php echo BASE_URL . '/' . 'visitor/home.php'; ?>">Home</a>
                </li>

                <!-- crop page link -->
                <li class="nav-item fw-bold me-2">
                    <!-- add active class when at crop.php -->
                    <a class="nav-link <?php if ($current_page_isCrop) {
                                            echo "active";
                                        } ?>" href="<?php echo BASE_URL . '/' . 'visitor/crop.php'; ?>">Crops</a>
                </li>

                <!-- about -->
                <li class="nav-item fw-semibold me-2">
                    <a href="" class="nav-link">About</a>
                </li>

            </ul>

            <!-- ADMIN -->
            <ul class="navbar-nav">

                <!-- all crops -->
                <div class="nav-item me-2">
                    <a class="nav-link fw-bold me-2 <?php if ($current_page_isCrop_page) {
                                                        echo "active";
                                                    } ?>" aria-current="page" href="<?php echo BASE_URL . '/' . 'contributor/crop-page/crop.php'; ?>">All Crops</a>
                </div>

                <!-- my crops -->
                <div class="nav-item fw-semibold me-2">
                    <a class="nav-link fw-bold me-2 <?php if ($current_page_isSubmission) {
                                                        echo "active";
                                                    } ?>" aria-current="page" href="<?php echo BASE_URL . '/' . 'contributor/submission-page/submission.php'; ?>">My Crops</a>
                </div>

                <!-- crop management -->
                <div class="nav-item fw-semibold me-2 dropdown">

                    <a href="" id="mng-nav" class="nav-link dropdown-toggle <?php if ($current_page_isManagement) {
                                                                                echo "active";
                                                                            } ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Crop Management
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="mng-nav">
                        <li>
                            <a class="dropdown-item" href="<?php echo BASE_URL . '/' . 'contributor/approval-page/pending.php'; ?>">Pending</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo BASE_URL . '/' . 'contributor/approval-page/approved.php'; ?>">Approved</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo BASE_URL . '/' . 'contributor/approval-page/rejected.php'; ?>">Rejected</a>
                        </li>
                    </ul>
                </div>

                <!-- settings -->
                <div class="nav-item fw-semibold me-4 dropdown">

                    <a href="#" id="set-nav" class="nav-link dropdown-toggle <?php if ($current_page_isSettings) {
                                                                                    echo "active";
                                                                                } ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Settings
                    </a>

                    <ul id="set-nav-menu" class="dropdown-menu  dropdown-menu-md-end">

                        <!-- crop settings -->
                        <li class="dropend">
                            <button id="set-nav-crop" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                Crop Settings
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="set-nav-crop">
                                <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/crop-category.php'; ?>" class="dropdown-item">Crop Category</a></li>
                                <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/category-variety.php'; ?>" class="dropdown-item">Category Variety</a></li>
                                <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/abiotic-resistance.php'; ?>" class="dropdown-item">Abiotic Resistance</a></li>
                                <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/disease-resistance.php'; ?>" class="dropdown-item">Disease Resistance</a></li>
                                <li><a href="<?php echo BASE_URL . '/' . 'contributor/crop-page/pest-resistance.php'; ?>" class="dropdown-item">Pest Resistance</a></li>
                            </ul>
                        </li>

                        <!-- location settings -->
                        <li class="dropend">
                            <button id="set-nav-loc" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                Location Settings
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="set-nav-loc">
                                <li><a href="<?php echo BASE_URL . '/' . 'contributor/location-page/barangay.php'; ?>" class="dropdown-item">Barangay</a></li>
                                <li><a href="<?php echo BASE_URL . '/' . 'contributor/location-page/municipality.php'; ?>" class="dropdown-item">Municipality</a></li>
                            </ul>
                        </li>

                        <!-- user accounts -->
                        <li class="dropend">
                            <button id="set-nav-usr" role="button" class="dropdown-item dropdown-toggle set-nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                User Account
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="set-nav-usr">
                                <li><a href="<?php echo BASE_URL . '/' . 'contributor/user-page/partners.php'; ?>" class="dropdown-item">Users</a></li>
                                <li><a href="<?php echo BASE_URL . '/' . 'contributor/user-page/verify-user.php'; ?>" class="dropdown-item">Verification</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>


                <!-- user profile -->
                <div class="nav-item fw-semibold me-2 dropdown">
                    <a href="" id="profile-btn" class="nav-link dropdown-toggle d-" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-md-end">

                        <!-- login info -->
                        <li>
                            <a href="" class="dropdown-item d-flex align-items-center pb-2">
                                <i class="fa-solid fa-address-card me-2" style="width:20px"></i>
                                <div>
                                    <div class="small-font">Logged In as</div>
                                    <div class="fw-semibold">John Doe</div>
                                </div>
                            </a>
                        </li>

                        <!-- settings -->
                        <li>
                            <a href="" class="dropdown-item"><i class="fa-solid fa-gears me-2"></i>Settings</a>
                        </li>

                        <li class="dropdown-divider m-0"></li>

                        <!-- logout -->
                        <li>
                            <a href="" id="logout-link" class="dropdown-item text-danger"><i class="fa-solid fa-right-from-bracket me-2" style="width:20px"></i>Logout</a>
                        </li>
                    </ul>
                </div>

            </ul>

            <!-- VISITOR -->
            <a id="contributor-link" href="../login/login-form.php" class="d-none link-light link-offset-3 link-underline link-underline-opacity-0 rounded-pill px-3 py-2">Contribute to Travis</a>
        </div>
    </div>
</div>