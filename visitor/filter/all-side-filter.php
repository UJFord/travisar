<style>
    .hidden {
        display: none;
    }
</style>
<div id="side-filter-container" class="col-3">

    <div id="side-filter" class=" d-flex flex-column rounded border overflow-y-auto p-0">

        <!-- title -->
        <div class="border-bottom d-flex align-items-center  py-1 px-3 bg-light">
            <h6 class="fw-semibold m-0 me-auto small-font">FILTERS</h6>

        </div>
        <!-- filter actions -->
        <div class="d-flex py-3 px-3">
            <!-- search -->
            <div class="input-group">
                <span class="input-group-text" id="filter-search"><i class="bi bi-search"></i></span>
                <input type="text" id="searchInput" class="form-control small-font" placeholder="Search Crops" aria-label="Search" aria-describedby="filter-search">
            </div>
        </div>

        <!-- all crops -->
        <div class="py-2 px-3">
            <div id="crop-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#crop-filters" role="button" aria-expanded="true" aria-controls="crop-filters">
                <i id="cropChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1 rotate-chevron"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">Crops</a>
            </div>

            <?php
            $query = "SELECT * FROM category order by category_name ASC";
            $query_run = pg_query($conn, $query);

            if ($query_run) {
                while ($row = pg_fetch_array($query_run)) {
            ?>
                    <!-- crops filters -->
                    <div id="crop-filters" class="collapse ps-4 my-2">
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

        <!-- Varieties -->
        <div class="py-2 px-3" id="variety-div">
            <div id="variety-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#variety-filters" role="button" aria-expanded="true" aria-controls="variety-filters">
                <i id="varietyChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1 rotate-chevron"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">Variety</a>
            </div>

            <!-- crops filters -->
            <div id="variety-filters" class="collapse  mb-2">

            </div>
        </div>

        <!-- terrain -->
        <div class="py-2 px-3">
            <div id="terrain-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#terrain-filters" role="button" aria-expanded="true" aria-controls="terrain-filters">
                <i id="terrainChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1 rotate-chevron"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">Terrains</a>
            </div>
            <?php
            $query = "SELECT * FROM terrain order by terrain_name ASC";
            $query_run = pg_query($conn, $query);

            if ($query_run) {
                while ($row = pg_fetch_array($query_run)) {
            ?>
                    <!-- terrains filters -->
                    <div id="terrain-filters" class="collapse ps-4 my-2">
                        <input class="form-check-input terrain-filter" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
                        <label for="terrain<?= $row['terrain_id']; ?>"><?= $row['terrain_name']; ?></label>
                    </div>
            <?php
                }
            } else {
                echo "No terrain found";
            }
            ?>
        </div>

        <!-- all municipalities -->
        <div class="pt-2 pb-1 px-3">
            <div id="mun-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#municipality-filters" role="button" aria-expanded="true" aria-controls="municipalty-filters">
                <i id="munChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark col-1 rotate-chevron"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">Municipalities</a>
            </div>
            <?php
            $query = "SELECT * FROM municipality order by municipality_name ASC";
            $query_run = pg_query($conn, $query);

            if ($query_run) {
                while ($row = pg_fetch_array($query_run)) {
            ?>
                    <div id="municipality-filters" class="collapse ps-4 my-2">
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

        <!-- all barangay -->
        <div class="pt-2 pb-1 px-3" id="barangay-div">
            <div id="brgy-filter-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#brgy-filters" role="button" aria-expanded="true" aria-controls="brgy-filters">
                <i id="brgyChev" class="chevron-dropdown-btn fas fa-chevron-down text-dark col-1 rotate-chevron"></i>
                <a class="fw-bold text-success col text-decoration-none" href="">Barangay</a>
            </div>
            <div id="brgy-filters" class="collapse ps-4 mb-2">
            </div>
        </div>

        <!-- button to submit filter -->
        <div class="py-2 row border-bottom m-0 mt-3">
            <!-- Add a clear button -->
            <div class="d-flex justify-content-end col">
                <button id="clearButton" class="btn btn-link link-dark hidden me-3" onclick="clearSearch()">Clear<i class="fa-solid fa-eraser ms-1"></i></button>
                <button id="searchButton" class="btn btn-success fw-semibold" onclick="applyFilters()">Filter<i class="fa-solid fa-filter small-font ms-1"></i></button>
            </div>
        </div>
    </div>

</div>

<!-- script for populating varieties and barangay and the chevron toggler -->
<script>
    let selectedMunicipalities = [];

    // Function to fetch and populate the barangay filter based on the selected municipalities
    function populateBarangayFilter() {
        let barangayFilter = document.getElementById('brgy-filters');
        let barangayChev = document.getElementById('brgyChev');

        // Clear existing options
        barangayFilter.innerHTML = '';

        // Fetch and populate barangay options for each selected municipality
        selectedMunicipalities.forEach(municipalityid => {
            fetch('fetch/fetch_filter-brgy.php?municipality_id=' + municipalityid)
                .then(response => response.json())
                .then(data => {
                    // Populate options
                    data.forEach(barangay => {
                        barangayFilter.innerHTML += `
                        <div class="collapse show  my-2">
                            <input class="form-check-input brgy-filter" type="checkbox" id="barangay${barangay.barangay_id}" value="${barangay.barangay_id}">
                            <label for="barangay${barangay.barangay_id}">${barangay.barangay_name}</label>
                        </div>
                    `;
                    });
                    // Show the barangay filter
                    barangayFilter.classList.add('show');
                    // barangayChev.classList.add('rotate-chevron');
                })
                .catch(error => console.error('Error:', error));
        });
    }
    // Function to show or hide the barangay filter based on the selected municipalities
    function toggleBarangayFilterVisibility() {
        let barangayFilter = document.getElementById('barangay-div');
        let selectedMunicipalityCheckboxes = document.querySelectorAll('.municipality-filter:checked');

        if (selectedMunicipalityCheckboxes.length > 0) {
            // Show the barangay filter
            barangayFilter.classList.remove('hidden');
        } else {
            // Hide the barangay filter
            barangayFilter.classList.add('hidden');
        }
    }

    // Add event listeners to municipality checkboxes
    document.querySelectorAll('.municipality-filter').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                // Remove unchecked municipality from the array
                selectedMunicipalities = selectedMunicipalities.filter(id => id !== this.value);
            } else {
                // Add checked municipality to the array
                selectedMunicipalities.push(this.value);
            }
            populateBarangayFilter();
            toggleBarangayFilterVisibility();
        });
    });

    let selectedCategories = [];

    // Function to fetch and populate the variety filter based on the selected categories
    function populateVarietyFilter() {
        let varietyFilter = document.getElementById('variety-filters');
        let varietyChev = document.getElementById('varietyChev');

        // Clear existing options
        varietyFilter.innerHTML = '';

        // Fetch and populate variety options for each selected category
        selectedCategories.forEach(categoryId => {
            fetch('fetch/fetch_filter.php?category_id=' + categoryId)
                .then(response => response.json())
                .then(data => {
                    // Populate options
                    data.forEach(variety => {
                        varietyFilter.innerHTML += `
                            <div class="collapse show ps-4 mb-2">
                                <input class="form-check-input variety-filter" type="checkbox" id="category_variety${variety.category_variety_id}" value="${variety.category_variety_id}">
                                <label for="category_variety${variety.category_variety_id}">${variety.category_variety_name}</label>
                            </div>
                        `;
                    });
                    // Show the variety filter
                    varietyFilter.classList.add('show');
                    // varietyChev.classList.add('rotate-chevron');
                })
                .catch(error => console.error('Error:', error));
        });
    }
    // Function to show or hide the variety filter based on the selected categories
    function toggleVarietyFilterVisibility() {
        let varietyFilter = document.getElementById('variety-div');
        let selectedCategoryCheckboxes = document.querySelectorAll('.crop-filter:checked');

        if (selectedCategoryCheckboxes.length > 0) {
            // Show the variety filter
            varietyFilter.classList.remove('hidden');
        } else {
            // Hide the variety filter
            varietyFilter.classList.add('hidden');
        }
    }

    // Add event listeners to category checkboxes
    document.querySelectorAll('.crop-filter').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                // Remove unchecked category from the array
                selectedCategories = selectedCategories.filter(id => id !== this.value);
            } else {
                // Add checked category to the array
                selectedCategories.push(this.value);
            }
            populateVarietyFilter();
            toggleVarietyFilterVisibility();
        });
    });

    // Function to show or hide the clear button based on selected filters and search input
    function toggleClearButtonVisibility() {
        let clearButton = document.getElementById('clearButton');
        let selectedCategoryCheckboxes = document.querySelectorAll('.crop-filter:checked');
        let selectedMunicipalityCheckboxes = document.querySelectorAll('.municipality-filter:checked');
        let selectedTerrainCheckboxes = document.querySelectorAll('.terrain-filter:checked');
        let searchInput = document.getElementById('searchInput').value.trim();

        if (selectedCategoryCheckboxes.length > 0 || selectedMunicipalityCheckboxes.length > 0 || selectedTerrainCheckboxes.length > 0 || searchInput !== '') {
            // Show the clear button
            clearButton.classList.remove('hidden');
        } else {
            // Hide the clear button
            clearButton.classList.add('hidden');
        }
    }

    // Add event listeners to category, municipality, and terrain checkboxes
    document.querySelectorAll('.crop-filter, .municipality-filter, .terrain-filter').forEach(checkbox => {
        checkbox.addEventListener('change', toggleClearButtonVisibility);
    });

    // Add event listener to search input
    document.getElementById('searchInput').addEventListener('input', toggleClearButtonVisibility);

    // Check if any filters or search input are already populated on page load
    toggleClearButtonVisibility();

    // chevron toggler
    let cropToggler = document.querySelector('#crop-filter-dropdown-toggler');
    let varietyToggler = document.querySelector('#variety-filter-dropdown-toggler');
    let terrainToggler = document.querySelector('#terrain-filter-dropdown-toggler');
    let munToggler = document.querySelector('#mun-filter-dropdown-toggler');
    let brgyToggler = document.querySelector('#brgy-filter-dropdown-toggler');

    let cropChev = document.querySelector('#cropChev');
    let varietyChev = document.querySelector('#varietyChev');
    let terrainChev = document.querySelector('#terrainChev');
    let munChev = document.querySelector('#munChev');
    let brgyChev = document.querySelector('#brgyChev');

    function toggleChevron(element) {
        element.classList.toggle('rotate-chevron');
    }

    cropToggler.onclick = () => toggleChevron(cropChev);
    varietyToggler.onclick = () => toggleChevron(varietyChev);
    terrainToggler.onclick = () => toggleChevron(terrainChev);
    munToggler.onclick = () => toggleChevron(munChev);
    brgyToggler.onclick = () => toggleChevron(brgyChev);

    // Hide the variety and barangay filters initially  
    document.getElementById('variety-div').classList.add('hidden');
    document.getElementById('barangay-div').classList.add('hidden');

    // Check if all category checkboxes are unchecked
    function checkAllCategoryCheckboxesUnchecked() {
        let selectedCategoryCheckboxes = document.querySelectorAll('.crop-filter:checked');
        return selectedCategoryCheckboxes.length === 0;
    }

    // Check if all municipality checkboxes are unchecked
    function checkAllMunicipalityCheckboxesUnchecked() {
        let selectedMunicipalityCheckboxes = document.querySelectorAll('.municipality-filter:checked');
        return selectedMunicipalityCheckboxes.length === 0;
    }

    // Check if all category checkboxes are unchecked and hide variety filter
    if (checkAllCategoryCheckboxesUnchecked()) {
        document.getElementById('variety-div').classList.add('hidden');
    }

    // Check if all municipality checkboxes are unchecked and hide barangay filter
    if (checkAllMunicipalityCheckboxesUnchecked()) {
        document.getElementById('barangay-div').classList.add('hidden');
    }
</script>