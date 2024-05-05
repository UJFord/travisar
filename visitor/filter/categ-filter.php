<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";

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

            <?php
            $query = "SELECT * from category";
            $query_run = pg_query($conn, $query);
            if ($query_run) {
                while ($row = pg_fetch_assoc($query_run)) {
                    $category_name = $row['category_name'];

                    if ($category_name === "Root Crop") {
                        $category_name = "Root Crop";
            ?>
                        <!-- category filter -->
                        <a href="corn.php?category_id=<?= $row['category_id'] ?>" class="col-1 bar-filter-categ border-bottom border-<?= ($isCorn) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                            <img class="categ-link-img" src="img/corn-svgrepo-com.svg" alt="" srcset="">
                            <div class="fw-bold">Corn</div>
                        </a>
                    <?php
                    } elseif ($category_name === "Rice") {
                        $category_name = "Rice";
                    ?>
                        <!-- category filter -->
                        <a href="root.php?category_id=<?= $row['category_id'] ?>" class="col-1 bar-filter-categ border-bottom border-<?= ($isRoot) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                            <img class="categ-link-img" src="img/carrot-svgrepo-com.svg" alt="" srcset="">
                            <div class="fw-bold">Root</div>
                        </a>
                    <?php
                    } elseif ($category_name === "Corn") {
                        $category_name = "Corn";
                    ?>
                        <!-- category filter -->
                        <a href="rice.php?category_id=<?= $row['category_id'] ?>" class="col-1 bar-filter-categ border-bottom border-<?= ($isRice) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                            <img class="categ-link-img" src="img/rice-grain-svgrepo-com.svg" alt="" srcset="">
                            <div class="fw-bold">Rice</div>
                        </a>
                    <?php
                    } elseif ($category_name === "All") {
                        $category_name = "All";
                    ?>
                        <!-- category filter -->
                        <a href="root.php?category_id=<?= $row['category_id'] ?>" class="col-1 bar-filter-categ border-bottom border-<?= ($isRoot) ? 'success' : 'light'; ?> border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                            <img class="categ-link-img" src="img/carrot-svgrepo-com.svg" alt="" srcset="">
                            <div class="fw-bold">All</div>
                        </a>
            <?php
                    }
                }
            }
            ?>

            <!-- divider -->
            <div class="col"></div>

            <!-- view type -->
            <div class="col-1 d-flex justify-content-center align-items-center">
                <button id="view-type-button" class="btn btn-light border m-2 px-2 py-1  d-flex flex-row " type="button">
                    <i class="view-type-icon bi bi-list-ul fw-bolder text-primary-emphasis"></i>
                    <i class="view-type-icon bi bi-grid-fill text-primary-emphasis d-none"></i>
                </button>
            </div>

        </div>

    </div>
</div>