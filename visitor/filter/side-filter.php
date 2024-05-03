<div id="side-filter" class="col-3 d-flex flex-column rounded border overflow-y-auto p-0">

    <!-- title -->
    <div class="border-bottom d-flex align-items-center w-100 py-1 px-3 bg-light">
        <h6 class="fw-semibold m-0 me-auto small-font">FILTERS</h6>
        <!-- help -->
        <a href="#" class="">
            <i class="bi bi-question-circle"></i>
        </a>
    </div>
    <!-- filter actions -->
    <div class="d-flex py-3 px-3">
        <!-- search -->
        <div class="input-group">
            <span class="input-group-text" id="filter-search"><i class="bi bi-search"></i></span>
            <input type="text" id="searchInput" class="form-control small-font" placeholder="Search Crops" aria-label="Search" aria-describedby="filter-search">
            <!-- Add a clear button -->
            <button id="clearButton" class="btn btn-secondary small-font" onclick="clearSearch()">Clear</button>
        </div>
    </div>

    <!-- Varieties -->
    <div class="py-2 px-3 w-100">
        <div id="variety-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#variety-filters" role="button" aria-expanded="true" aria-controls="variety-filters">
            <i id="varietyChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1 rotate-chevron"></i>
            <a class="fw-bold text-success col text-decoration-none" href="">Variety</a>
        </div>

        <!-- crops filters -->
        <div id="variety-filters" class="collapse w-100 mb-2">

        </div>
    </div>

    <!-- terrain -->
    <div class="py-2 px-3">
        <div id="terrain-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#terrain-filters" role="button" aria-expanded="true" aria-controls="terrain-filters">
            <i id="terrainChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1 rotate-chevron"></i>
            <a class="fw-bold text-success col text-decoration-none" href="">All Terrains</a>
        </div>
        <!-- terrains filters -->
        <div id="terrain-filters" class="collapse mb-2">

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Hill</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Flat</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Steep</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Mud</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Hill</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Flat</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Steep</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Mud</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Hill</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Flat</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Steep</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Mud</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Hill</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Flat</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Steep</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                <label for="">Mud</label>
            </div>

        </div>
    </div>

    <!-- all municipalities -->
    <div class="pt-2 pb-1 px-3">
        <div id="mun-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#municipality-filters" role="button" aria-expanded="true" aria-controls="municipalty-filters">
            <i id="munChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark col-1 rotate-chevron"></i>
            <a class="fw-bold text-success col text-decoration-none" href="">All Municipalities</a>
        </div>
        <div id="municipality-filters" class="collapse w-100 mb-2">

            <div class="ms-3">
                <input class="form-check-input municipality-filter" type="checkbox" id="" value="">
                <label for="">Alabel</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input municipality-filter" type="checkbox" id="" value="">
                <label for="">Maasim</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input municipality-filter" type="checkbox" id="" value="">
                <label for="">Kiamba</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input municipality-filter" type="checkbox" id="" value="">
                <label for="">Malungon</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input municipality-filter" type="checkbox" id="" value="">
                <label for="">Malandag</label>
            </div>

        </div>
    </div>

    <!-- all barangay -->
    <div class="pt-2 pb-1 px-3">
        <div id="brgy-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#brgy-filters" role="button" aria-expanded="true" aria-controls="brgy-filters">
            <i id="brgyChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark col-1 rotate-chevron"></i>
            <a class="fw-bold text-success col text-decoration-none" href="">Barangay</a>
        </div>
        <div id="brgy-filters" class="collapse w-100 mb-2">

            <div class="ms-3">
                <input class="form-check-input" type="checkbox" name="" id="">
                <label for="">Poblacion</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input" type="checkbox" name="" id="">
                <label for="">Poblacion</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input" type="checkbox" name="" id="">
                <label for="">Poblacion</label>
            </div>

            <div class="ms-3">
                <input class="form-check-input" type="checkbox" name="" id="">
                <label for="">Poblacion</label>
            </div>
        </div>
    </div>

    <!-- button to submit filter -->
    <div class="d-flex py-3 px-3">
        <div class="input-group d-flex flex-row-reverse">
            <button id="searchButton" class="btn btn-success fw-semibold" onclick="applyFilters()"><i class="fa-solid fa-filter me-1 small-font"></i>Filter</button>
        </div>
    </div>
</div>