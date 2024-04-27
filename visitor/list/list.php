<div class="container my-4">
    <!-- result counter -->
    <div class="row">
        <div class="container small-font fw-semibold mb-2 ms-2">
            Showing Results <span class="text-primary">1-10</span> out of <span class="text-primary">254</span>
        </div>
    </div>
    <div class="row">
        <!-- Crop List Table -->
        <?php require "list/table.php"?>

        <div id="map" class="col-9 border rounded">
        </div>
    </div>
    <!-- legend -->
    <div class="row d-flex justify-content-end small-font my-2">
        <div class="w-auto">
            <img class="legend-ico" src="img/corn-svgrepo-com.svg" alt="" srcset="">
            Corn
        </div>
        <div class="w-auto">
            <img class="legend-ico" src="img/rice-grain-svgrepo-com.svg" alt="" srcset="">
            Rice
        </div>
        <div class="w-auto">
            <img class="legend-ico" src="img/carrot-svgrepo-com.svg" alt="" srcset="">
            Root Crop
        </div>
    </div>
</div>