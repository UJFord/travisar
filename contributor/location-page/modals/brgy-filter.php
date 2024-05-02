<div class="col col-3">
    <div class="d-flex flex-column align-items-start rounded border overflow-hidden">

        <!-- title -->
        <div class="border-bottom d-flex align-items-center w-100 py-1 px-3 bg-light">
            <h6 class="fw-semibold fs-6 m-0 me-auto">FILTERS</h6>
            <!-- help -->
            <!-- <a href="#" class="">
                <i class="bi bi-question-circle"></i>
            </a> -->
        </div>

        <!-- filter actions -->
        <div class="d-flex py-3 px-3">
            <!-- search -->
            <div class="input-group">
                <span class="input-group-text" id="filter-search"><i class="bi bi-search"></i></span>
                <input type="text" id="searchInput" class="form-control small-font" placeholder="Search Barangay" aria-label="Search" aria-describedby="filter-search">
                <!-- Add a clear button -->
                <button id="clearButton" class="btn btn-secondary" onclick="clearSearch()">Clear</button>
            </div>
        </div>

        <!-- all municipalities -->
        <div class="pt-2 pb-1 px-3 w-100">
            <div id="mun-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#municipality-filters" role="button" aria-expanded="true" aria-controls="municipalty-filters">
                <i id="munChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark col-1"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">All Municipalities</a>
            </div>

            <?php
            $query = "SELECT * FROM municipality order by municipality_name ASC";
            $query_run = pg_query($conn, $query);

            if ($query_run) {
                while ($row = pg_fetch_array($query_run)) {
            ?>
                    <div id="municipality-filters" class="collapse show w-100 mb-2">
                        <input class="form-check-input municipality-filter" type="checkbox" id="municipality<?= $row['municipality_id']; ?>" value="<?= $row['municipality_id']; ?>">
                        <label for="municipality<?= $row['municipality_id']; ?>"><?= $row['municipality_name']; ?></label>
                    </div>
            <?php
                }
            } else {
                echo "No category found";
            }
            ?>
        </div>

        <!-- button to submit filter -->
        <div class="d-flex py-3 px-3">
            <div class="input-group">
                <button id="searchButton" class="btn btn-primary" onclick="applyFilters()">Filter</button>
            </div>
        </div>
    </div>
</div>
<!-- script to hide the municipality filter dropdown -->
<script>
    // chevron toggler

    let munToggler = document.querySelector('#mun-filter-dropdown-toggler');

    let munChev = document.querySelector('#munChev');

    function toggleChevron(element) {
        element.classList.toggle('rotate-chevron');
    }

    munToggler.onclick = () => toggleChevron(munChev);
</script>