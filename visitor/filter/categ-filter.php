<?php

$isCorn = false;
$isRice = false;
$isRoot = false;

// get current page
$current_page_path = $_SERVER['REQUEST_URI'];
switch ($current_page_path) {
    case "/travisar/visitor/corn.php":
        $isCorn = true;
        break;
    case "/travisar/visitor/rice.php":
        $isRice = true;
        break;
    case "/travisar/visitor/root.php":
        $isRoot = true;
        break;
}

?>

<div class="container-fluid border-bottom mt-4">
    <div class="container">
        <div class="row">

            <!-- category filter -->
            <a href="corn.php" class="col-1 bar-filter-categ border-bottom border-<?php echo ($isCorn) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                <img class="categ-link-img" src="img/corn-svgrepo-com.svg" alt="" srcset="">
                <div class="fw-bold">Corn</div>
            </a>
            <a href="rice.php" class="col-1 bar-filter-categ border-bottom border-<?php echo ($isRice) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                <img class="categ-link-img" src="img/rice-grain-svgrepo-com.svg" alt="" srcset="">
                <div class="fw-bold">Rice</div>
            </a>
            <a href="root.php" class="col-1 bar-filter-categ border-bottom border-<?php echo ($isRoot) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                <img class="categ-link-img" src="img/carrot-svgrepo-com.svg" alt="" srcset="">
                <div class="fw-bold">Root</div>
            </a>

            <!-- divider -->
            <div class="col"></div>

            <!-- view type -->
            <div class="col-1 d-flex justify-content-center align-items-center">
                <button class="btn btn-light border m-2 px-2 py-1  d-flex flex-row " type="button">
                    <i class="bi bi-grid-fill text-primary-emphasis me-2"></i>
                    <div class="fw-semibold">Tile</div>
                </button>
            </div>

        </div>
    </div>
</div>