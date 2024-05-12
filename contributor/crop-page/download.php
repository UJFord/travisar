<style>
    #modalDialogDelete {
        margin-top: 5vh;
    }

    #confirmModalDownload {
        backdrop-filter: blur(5px);
    }
</style>

<div class="modal fade" id="confirmModalDownload" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalDialogDelete">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Download</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="side-filter-container" class="">

                    <div id="side-filter" class=" d-flex flex-column rounded border overflow-y-auto p-0">

                        <!-- title -->
                        <div class="border-bottom d-flex align-items-center  py-1 px-3 bg-light">
                            <h6 class="fw-semibold m-0 me-auto" style="font-size: 1.5rem;">FILTERS</h6>

                        </div>
                        <!-- filter actions -->
                        <!-- all status -->
                        <div class="py-2 px-3">
                            <div id="status-filterDownload-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#status-filterDownloads" role="button" aria-expanded="true" aria-controls="status-filterDownloads">
                                <i id="statusChevDownload" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1 rotate-chevron"></i>
                                <a class="fw-bold text-success col text-decoration-none" href="">Status</a>
                            </div>

                            <?php
                            $query = "SELECT DISTINCT action FROM status order by action ASC";
                            $query_run = pg_query($conn, $query);

                            if ($query_run) {
                                while ($row = pg_fetch_array($query_run)) {
                            ?>
                                    <!-- status filters -->
                                    <div id="status-filterDownloads" class="collapse ps-4 mb-2">
                                        <input class="form-check-input status-filterDownload" type="checkbox" id="status<?= $row['action']; ?>" value="<?= $row['action']; ?>">
                                        <label for="status<?= $row['action']; ?>"><?= $row['action']; ?></label>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "No status found";
                            }
                            ?>
                        </div>

                        <!-- all crops -->
                        <div class="py-2 px-3">
                            <div id="crop-filterDownload-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#crop-filterDownloads" role="button" aria-expanded="true" aria-controls="crop-filterDownloads">
                                <i id="cropChevDownload" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1 rotate-chevron"></i>
                                <a class="fw-bold text-success col text-decoration-none" href="">Crops</a>
                            </div>

                            <?php
                            $query = "SELECT * FROM category order by category_name ASC";
                            $query_run = pg_query($conn, $query);

                            if ($query_run) {
                                while ($row = pg_fetch_array($query_run)) {
                            ?>
                                    <!-- crops filters -->
                                    <div id="crop-filterDownloads" class="  llapse ps-4 my-2">
                                        <input class="form-check-input crop-filterDownload" type="checkbox" id="category<?= $row['category_id']; ?>" value="<?= $row['category_id']; ?>">
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
                        <div class="py-2 px-3" id="variety-divDownload">
                            <div id="variety-filterDownload-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#variety-filtersDownload" role="button" aria-expanded="true" aria-controls="variety-filtersDownload">
                                <i id="varietyChevDownload" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1 rotate-chevron"></i>
                                <a class="fw-bold text-success col text-decoration-none" href="">Variety</a>
                            </div>

                            <!-- crops filters -->
                            <div id="variety-filtersDownload" class="collapse  mb-2">

                            </div>
                        </div>

                        <!-- terrain -->
                        <div class="py-2 px-3">
                            <div id="terrain-filterDownload-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#terrain-filterDownloads" role="button" aria-expanded="true" aria-controls="terrain-filterDownloads">
                                <i id="terrainChevDownload" class="chevron-dropdown-btn fas fa-chevron-down text-dark text-center col-1 rotate-chevron"></i>
                                <a class="fw-bold text-success col text-decoration-none" href="">Terrains</a>
                            </div>
                            <?php
                            $query = "SELECT * FROM terrain order by terrain_name ASC";
                            $query_run = pg_query($conn, $query);

                            if ($query_run) {
                                while ($row = pg_fetch_array($query_run)) {
                            ?>
                                    <!-- terrains filters -->
                                    <div id="terrain-filterDownloads" class="collapse ps-4 my-2">
                                        <input class="form-check-input terrain-filterDownload" type="checkbox" id="terrain<?= $row['terrain_id']; ?>" value="<?= $row['terrain_id']; ?>">
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
                            <div id="mun-filterDownload-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#municipality-filterDownloads" role="button" aria-expanded="true" aria-controls="municipalty-filters">
                                <i id="munChevDownload" class="chevron-dropdown-btn fas fa-chevron-down text-dark col-1 rotate-chevron"></i>
                                <a class="fw-bold text-success col text-decoration-none" href="">Municipalities</a>
                            </div>
                            <?php
                            $query = "SELECT * FROM municipality order by municipality_name ASC";
                            $query_run = pg_query($conn, $query);

                            if ($query_run) {
                                while ($row = pg_fetch_array($query_run)) {
                            ?>
                                    <div id="municipality-filterDownloads" class="collapse ps-4 my-2">
                                        <input class="form-check-input municipality-filterDownload" type="checkbox" id="municipality<?= $row['municipality_id']; ?>" value="<?= $row['municipality_id']; ?>">
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
                        <div class="pt-2 pb-1 px-3" id="barangay-divDownload">
                            <div id="brgy-filterDownload-dropdown-toggler" class="row d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="collapse" href="#brgy-filters-Download" role="button" aria-expanded="true" aria-controls="brgy-filters-Download">
                                <i id="brgyChevDownload" class="chevron-dropdown-btn fas fa-chevron-down text-dark col-1 rotate-chevron"></i>
                                <a class="fw-bold text-success col text-decoration-none" href="">Barangay</a>
                            </div>
                            <div id="brgy-filters-Download" class="collapse ps-4 mb-2">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtnRow">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- script for populating varieties and barangay and the chevron toggler -->
<script>
    let selectedMunicipalitiesDownload = [];

    // Function to fetch and populate the barangay filter based on the selected municipalities
    function populateBarangayFilterDownload() {
        let barangayFilterDownload = document.getElementById('brgy-filters-Download');
        let barangayChevDownload = document.getElementById('brgyChevDownload');

        // Clear existing options
        barangayFilterDownload.innerHTML = '';

        // Fetch and populate barangay options for each selected municipality
        selectedMunicipalitiesDownload.forEach(municipalityid => {
            fetch('modals/fetch/fetch_filter-brgy.php?municipality_id=' + municipalityid)
                .then(response => response.json())
                .then(data => {
                    // Populate options
                    data.forEach(barangay => {
                        barangayFilterDownload.innerHTML += `
                        <div class="collapse show  my-2">
                            <input class="form-check-input brgy-filter" type="checkbox" id="barangayDownload${barangay.barangay_id}" value="${barangay.barangay_id}">
                            <label for="barangayDownload${barangay.barangay_id}">${barangay.barangay_name}</label>
                        </div>
                    `;
                    });
                    // Show the barangay filter
                    barangayFilterDownload.classList.add('show');
                    // barangayChevDownload.classList.add('rotate-chevron');
                })
                .catch(error => console.error('Error:', error));
        });
    }
    // Function to show or hide the barangay filter based on the selected municipalities
    function toggleBarangayFilterVisibilityDownload() {
        let barangayFilterDownload = document.getElementById('barangay-divDownload');
        let selectedMunicipalityCheckboxesDownload = document.querySelectorAll('.municipality-filterDownload:checked');

        if (selectedMunicipalityCheckboxesDownload.length > 0) {
            // Show the barangay filter
            barangayFilterDownload.classList.remove('hidden');
        } else {
            // Hide the barangay filter
            barangayFilterDownload.classList.add('hidden');
        }
    }

    // Add event listeners to municipality checkboxes
    document.querySelectorAll('.municipality-filterDownload').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                // Remove unchecked municipality from the array
                selectedMunicipalitiesDownload = selectedMunicipalitiesDownload.filter(id => id !== this.value);
            } else {
                // Add checked municipality to the array
                selectedMunicipalitiesDownload.push(this.value);
            }
            populateBarangayFilterDownload();
            toggleBarangayFilterVisibilityDownload();
        });
    });

    let selectedCategoriesDownload = [];

    // Function to fetch and populate the variety filter based on the selected categories
    function populateVarietyFilterDownload() {
        let varietyFilterDownload = document.getElementById('variety-filtersDownload');
        let varietyChevDownload = document.getElementById('varietyChevDownload');

        // Clear existing options
        varietyFilterDownload.innerHTML = '';

        // Fetch and populate variety options for each selected category
        selectedCategoriesDownload.forEach(categoryId => {
            fetch('modals/fetch/fetch_filter.php?category_id=' + categoryId)
                .then(response => response.json())
                .then(data => {
                    // Populate options
                    data.forEach(variety => {
                        varietyFilterDownload.innerHTML += `
                            <div class="collapse show ps-4 mb-2">
                                <input class="form-check-input variety-filter" type="checkbox" id="category_varietyDownload${variety.category_variety_id}" value="${variety.category_variety_id}">
                                <label for="category_varietyDownload${variety.category_variety_id}">${variety.category_variety_name}</label>
                            </div>
                        `;
                    });
                    // Show the variety filter
                    varietyFilterDownload.classList.add('show');
                    // varietyChevDownload.classList.add('rotate-chevron');
                })
                .catch(error => console.error('Error:', error));
        });
    }
    // Function to show or hide the variety filter based on the selected categories
    function toggleVarietyFilterVisibilityDownload() {
        let varietyFilterDownload = document.getElementById('variety-divDownload');
        let selectedCategoryCheckboxesDownload = document.querySelectorAll('.crop-filterDownload:checked');

        if (selectedCategoryCheckboxesDownload.length > 0) {
            // Show the variety filter
            varietyFilterDownload.classList.remove('hidden');
        } else {
            // Hide the variety filter
            varietyFilterDownload.classList.add('hidden');
        }
    }

    // Add event listeners to category checkboxes
    document.querySelectorAll('.crop-filterDownload').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                // Remove unchecked category from the array
                selectedCategoriesDownload = selectedCategoriesDownload.filter(id => id !== this.value);
            } else {
                // Add checked category to the array
                selectedCategoriesDownload.push(this.value);
            }
            populateVarietyFilterDownload();
            toggleVarietyFilterVisibilityDownload();
        });
    });

    // Function to show or hide the clear button based on selected filters and search input
    // function toggleClearButtonVisibilityDownload() {
    //     // let clearButton = document.getElementById('clearButton');
    //     let statusCheckboxes = document.querySelectorAll('.status-filterDownload:checked');
    //     let selectedCategoryCheckboxesDownload = document.querySelectorAll('.crop-filterDownload:checked');
    //     let selectedMunicipalityCheckboxesDownload = document.querySelectorAll('.municipality-filterDownload:checked');
    //     let selectedTerrainCheckboxes = document.querySelectorAll('.terrain-filterDownload:checked');

    //     if (statusCheckboxes.length > 0 || selectedCategoryCheckboxesDownload.length > 0 || selectedMunicipalityCheckboxesDownload.length > 0 || selectedTerrainCheckboxes.length > 0 || searchInput !== '') {
    //         // Show the clear button
    //         clearButton.classList.remove('hidden');
    //     } else {
    //         // Hide the clear button
    //         clearButton.classList.add('hidden');
    //     }
    // }

    // // Add event listeners to category, municipality, and terrain checkboxes
    // document.querySelectorAll('.status-filterDownload, .crop-filterDownload, .municipality-filterDownload, .terrain-filterDownload').forEach(checkbox => {
    //     checkbox.addEventListener('change', toggleClearButtonVisibilityDownload);
    // });

    // // Check if any filters or search input are already populated on page load
    // toggleClearButtonVisibilityDownload();

    // chevron toggler
    let statusTogglerDownload = document.querySelector('#status-filterDownload-dropdown-toggler');
    let cropTogglerDownload = document.querySelector('#crop-filterDownload-dropdown-toggler');
    let varietyTogglerDownload = document.querySelector('#variety-filterDownload-dropdown-toggler');
    let terrainTogglerDownload = document.querySelector('#terrain-filterDownload-dropdown-toggler');
    let munTogglerDownload = document.querySelector('#mun-filterDownload-dropdown-toggler');
    let brgyTogglerDownload = document.querySelector('#brgy-filterDownload-dropdown-toggler');

    let statusChevDownload = document.querySelector('#statusChevDownload');
    let cropChevDownload = document.querySelector('#cropChevDownload');
    let varietyChevDownload = document.querySelector('#varietyChevDownload');
    let terrainChevDownload = document.querySelector('#terrainChevDownload');
    let munChevDownload = document.querySelector('#munChevDownload');
    let brgyChevDownload = document.querySelector('#brgyChevDownload');

    function toggleChevronDownload(element) {
        element.classList.toggle('rotate-chevron');
    }

    statusTogglerDownload.onclick = () => toggleChevronDownload(statusChevDownload);
    cropTogglerDownload.onclick = () => toggleChevronDownload(cropChevDownload);
    varietyTogglerDownload.onclick = () => toggleChevronDownload(varietyChevDownload);
    terrainTogglerDownload.onclick = () => toggleChevronDownload(terrainChevDownload);
    munTogglerDownload.onclick = () => toggleChevronDownload(munChevDownload);
    brgyTogglerDownload.onclick = () => toggleChevronDownload(brgyChevDownload);

    // Hide the variety and barangay filters initially  
    document.getElementById('variety-divDownload').classList.add('hidden');
    document.getElementById('barangay-divDownload').classList.add('hidden');

    // Check if all category checkboxes are unchecked
    function checkAllCategoryCheckboxesUncheckedDownload() {
        let selectedCategoryCheckboxesDownload = document.querySelectorAll('.crop-filterDownload:checked');
        return selectedCategoryCheckboxesDownload.length === 0;
    }

    // Check if all municipality checkboxes are unchecked
    function checkAllMunicipalityCheckboxesUncheckedDownload() {
        let selectedMunicipalityCheckboxesDownload = document.querySelectorAll('.municipality-filterDownload:checked');
        return selectedMunicipalityCheckboxesDownload.length === 0;
    }

    // Check if all category checkboxes are unchecked and hide variety filter
    if (checkAllCategoryCheckboxesUncheckedDownload()) {
        document.getElementById('variety-divDownload').classList.add('hidden');
    }

    // Check if all municipality checkboxes are unchecked and hide barangay filter
    if (checkAllMunicipalityCheckboxesUncheckedDownload()) {
        document.getElementById('barangay-divDownload').classList.add('hidden');
    }
</script>