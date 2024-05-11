<style>
    .hidden {
        display: none;
    }
</style>
<div class="col col-3">
    <div class="flex-column align-items-start rounded border overflow-hidden">

        <!-- title -->
        <div class="border-bottom d-flex align-items-center w-100 py-1 px-3 bg-light">
            <h6 class="fw-semibold fs-6 m-0 me-auto">FILTERS</h6>
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
                <input type="text" id="searchInput" class="form-control small-font" placeholder="Search variety" aria-label="Search" aria-describedby="filter-search">
            </div>
        </div>

        <!-- all crops -->
        <div class="py-2 px-3 w-100 border-bottom">
            <div id="crop-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#crop-filters" role="button" aria-expanded="true" aria-controls="crop-filters">
                <i id="cropChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">All Crops</a>
            </div>

            <?php
            $query = "SELECT * FROM category order by category_name ASC";
            $query_run = pg_query($conn, $query);

            if ($query_run) {
                while ($row = pg_fetch_array($query_run)) {
            ?>
                    <!-- crops filters -->
                    <div id="crop-filters" class="collapse show w-100 mb-2">
                        <input class="form-check-input crop-filter" type="checkbox" id="category<?= $row['category_id']; ?>" value="<?= $row['category_id']; ?>">
                        <label for="category<?= $row['category_id']; ?>"><?= $row['category_name']; ?></label>
                    </div>
            <?php
                }
            } else {
                echo "No category found";
            }
            ?>
        </div>

        <!-- button to submit filter -->
        <div class="py-3 px-3 row">
            <div class="input-group col">
                <button id="searchButton" class="btn btn-primary" onclick="applyFilters()">Filter</button>
            </div>
            <div class="col">
                <!-- Add a clear button -->
                <button id="clearButton" class="btn btn-secondary" onclick="clearSearch()">Clear</button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    // Function to show or hide the clear button based on selected filters and search input
    function toggleClearButtonVisibility() {
        let clearButton = document.getElementById('clearButton');
        let selectedCategoryCheckboxes = document.querySelectorAll('.crop-filter:checked');
        let searchInput = document.getElementById('searchInput').value.trim();

        if (selectedCategoryCheckboxes.length > 0 || searchInput !== '') {
            // Show the clear button
            clearButton.classList.remove('hidden');
        } else {
            // Hide the clear button
            clearButton.classList.add('hidden');
        }
    }

    // Add event listeners to category, municipality, and terrain checkboxes
    document.querySelectorAll('.crop-filter').forEach(checkbox => {
        checkbox.addEventListener('change', toggleClearButtonVisibility);
    });

    // Add event listener to search input
    document.getElementById('searchInput').addEventListener('input', toggleClearButtonVisibility);

    // Check if any filters or search input are already populated on page load
    toggleClearButtonVisibility();

    // chevron toggler
    let cropToggler = document.querySelector('#crop-filter-dropdown-toggler');

    let cropChev = document.querySelector('#cropChev');

    function toggleChevron(element) {
        element.classList.toggle('rotate-chevron');
    }

    cropToggler.onclick = () => toggleChevron(cropChev);
</script>