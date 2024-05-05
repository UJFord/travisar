<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";

$isAll = false;
$isCorn = false;
$isRice = false;
$isRoot = false;

// get current page
$current_page_path = $_SERVER['REQUEST_URI'];
switch ($current_page_path) {
    case "/travisar/visitor/all.php":
        $isAll = true;
        break;
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

<div class="container-fluid border-bottom">
    <div class="container">
        <div class="row pt-2">

            <!-- category filter -->
            <!-- all -->
            <a href="all.php" class="col-1 bar-filter-categ border-bottom border-<?= ($isAll) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                <img class="categ-link-img" src="img/grass.svg" alt="" srcset="">
                <div class="fw-bold">All</div>
            </a>

            <!-- corn -->
            <a href="corn.php" class="col-1 bar-filter-categ border-bottom border-<?= ($isCorn) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                <img class="categ-link-img" src="img/corn.svg" alt="" srcset="">
                <div class="fw-bold">Corn</div>
            </a>

            <!-- rice -->
            <a href="rice.php" class="col-1 bar-filter-categ border-bottom border-<?= ($isRice) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                <img class="categ-link-img" src="img/rice.svg" alt="" srcset="">
                <div class="fw-bold">Rice</div>
            </a>

            <!-- root -->
            <a href="root.php" class="col-1 bar-filter-categ border-bottom border-<?= ($isRoot) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                <img class="categ-link-img" src="img/potato.svg" alt="" srcset="">
                <div class="fw-bold">Root</div>
            </a>

            <!-- divider -->
            <div class="col"></div>

            <!-- view type -->
            <div class="col-sm-5 col-md-4 col-lg-3 col-xl-2 d-flex justify-content-end align-items-center">
                <div class="row w-100 d-flex justify-content-end align-items-center pe-2">

                    <button id="view-type-button" class="col-4 h-100 btn btn-light border">
                        <i class="view-type-icon bi bi-list-ul fw-bolder text-primary-emphasis"></i>
                        <i class="view-type-icon bi bi-grid-fill text-primary-emphasis d-none"></i>
                    </button>

                    <button id="map-toggler" class="col-12 col-md- col-lg-6 h-100 btn btn-light border ms-2 py-2">
                        <span class="map-toggle d-flex"><i class="fa-solid fa-map me-2"></i><span class="small-font fw-bold">Map</span></span>
                        <span class="list-toggle d-flex d-none"><i class="fa-solid fa-list me-2"></i><span class="small-font fw-bold">List</span></span>
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>