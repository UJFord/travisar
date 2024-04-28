<div class="container-fluid border-bottom d-flex justify-content-center p-3">
    <!-- search -->
    <div class="input-group w-25 me-4">
        <input type="text" id="searchInput" class="form-control bg-light" placeholder="Search" aria-label="Search" aria-describedby="filter-search">
        <button id="search-btn" class="input-group-text btn" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <!-- filter -->
    <!-- filter trigger -->
    <button id="filter-trigger" type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#filter-modal">
        <i class="fa-solid fa-sliders small-font me-2"></i>Filter
    </button>
    <button id="clearButton" type="button" class="btn btn-light" onclick="clearSearch()">
        <i class="fa-solid fa-eraser small-font me-2"></i>CLEAR
    </button>

    <!-- filter modal -->
    <div id="filter-modal" class="modal fade" tabindex="-1" aria-labelledby="filter-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- head -->
                <div class="modal-header d-flex justify-content-center position-relative">
                    <h1 class="modal-title small-font fw-bold" id="exampleModalLabel">FILTERS</h1>
                    <button id="close-filter-btn" type="button" class="btn-close position-absolute small-font" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- content -->
                <div class="modal-body">
                    <!-- crop type -->
                    <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title">Crop Type</h5>
                        <div class="d-flex justify-content-center mb-2">
                            <div class="rounded d-flex flex-row overflow-hidden border">
                                <?php
                                $query = "SELECT * FROM category order by category_name ASC";
                                $query_run = pg_query($conn, $query);

                                if ($query_run) {
                                    while ($row = pg_fetch_array($query_run)) {
                                ?>
                                        <!-- crops filters -->
                                        <input type="radio" name="crop_type" id="crop_<?= $row['category_name'] ?>" class="d-none crop-filter" value="<?= $row['category_id'] ?>">
                                        <label for="crop_<?= $row['category_name'] ?>" class="filter-crop-type bg-dark bg-gradient text-light fw-semibold py-3 px-5 border-0"><?= $row['category_name'] ?></label>
                                <?php
                                    }
                                } else {
                                    echo "No category found";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- municipality -->
                    <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title">Location</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <?php
                                $query = "SELECT * FROM municipality order by municipality_name ASC";
                                $query_run = pg_query($conn, $query);

                                if ($query_run) {
                                    while ($row = pg_fetch_array($query_run)) {
                                ?>
                                        <!-- crops filters -->
                                        <div id="municipality-filter" class="form-check mb-2 w-25">
                                            <input type="checkbox" class="form-check-input municipality-filter" id="municipality<?= $row['municipality_id'] ?>" value="<?= $row['municipality_id'] ?>">
                                            <label for="municipality<?= $row['municipality_id'] ?>" class="form-check-label"><?= $row['municipality_name'] ?></label>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "No municipality found";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Terrain -->
                    <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title">Terrain</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <?php
                                $query = "SELECT * FROM terrain order by terrain_name ASC";
                                $query_run = pg_query($conn, $query);

                                if ($query_run) {
                                    while ($row = pg_fetch_array($query_run)) {
                                ?>
                                        <!-- terrain filters -->
                                        <div class="form-check mb-2 w-25">
                                            <input type="checkbox" id="terrain<?= $row['terrain_id'] ?>" class="form-check-input terrain-filter" value="<?= $row['terrain_id'] ?>">
                                            <label for="terrain<?= $row['terrain_id'] ?>" class="form-check-label"><?= $row['terrain_name'] ?></label>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "No terrain found";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- barangay -->
                    <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title col-2">Barangay</h5>
                        <h6 class="small-font col-4">(select a municipality to show)</h6>

                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <!-- Barangay filters -->
                                <div id="brgy-filters" class="form-check mb-2 w-25">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- pest resistance -->
                    <!-- <div class="container border-bottom pb-w mb-4">
                        <h5 class="filter-title">Pest Resistance</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <?php
                                $query = "SELECT * FROM pest_resistance order by pest_name ASC";
                                $query_run = pg_query($conn, $query);

                                if ($query_run) {
                                    while ($row = pg_fetch_array($query_run)) {
                                ?>
                                        <div class="form-check mb-2 w-25">
                                            <input type="checkbox" id="pest<?= $row['pest_resistance_id'] ?>" class="form-check-input pest-filter" value="<?= $row['pest_resistance_id'] ?>">
                                            <label for="pest<?= $row['pest_resistance_id'] ?>" class="form-check-label"><?= $row['pest_name'] ?></label>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "No municipality found";
                                }
                                ?>
                            </div>
                        </div>
                    </div> -->

                    <!-- disease ressistance -->
                    <!-- <div class="container border-bottom pb-2 mb-4">
                        <h5 class="filter-title">Disease Resistance</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <?php
                                $query = "SELECT * FROM disease_resistance order by disease_name ASC";
                                $query_run = pg_query($conn, $query);

                                if ($query_run) {
                                    while ($row = pg_fetch_array($query_run)) {
                                ?>
                                        <div class="form-check mb-2 w-25">
                                            <input type="checkbox" id="disease<?= $row['disease_resistance_id'] ?>" class="form-check-input disease-filter" value="<?= $row['disease_resistance_id'] ?>">
                                            <label for="disease<?= $row['disease_resistance_id'] ?>" class="form-check-label"><?= $row['disease_name'] ?></label>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "No disease resistance found";
                                }
                                ?>
                            </div>
                        </div>
                    </div> -->

                    <!-- resistance to abiotic stress -->
                    <!-- <div class="container pb-2">
                        <h5 class="filter-title">Resistance to Abiotic Stress</h5>
                        <div class="row">
                            <div class="d-flex flex-wrap">
                                <?php
                                $query = "SELECT * FROM abiotic_resistance order by abiotic_name ASC";
                                $query_run = pg_query($conn, $query);

                                if ($query_run) {
                                    while ($row = pg_fetch_array($query_run)) {
                                ?>
                                        <div class="form-check mb-2 w-25">
                                            <input type="checkbox" id="abiotic<?= $row['abiotic_resistance_id'] ?>" class="form-check-input abiotic-filter" value="<?= $row['abiotic_resistance_id'] ?>">
                                            <label for="abiotic<?= $row['abiotic_resistance_id'] ?>" class="form-check-label"><?= $row['abiotic_name'] ?></label>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "No abiotic resistance found";
                                }
                                ?>
                            </div>
                        </div>
                    </div> -->
                </div>

                <!-- actions -->
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn border btn-light bg-gradient">Clear All</button>
                    <button id="searchButton" type="button" class="btn btn-success bg-gradient" onclick="applyFilters()">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>
</div>