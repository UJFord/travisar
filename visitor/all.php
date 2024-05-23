<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travis | All Crops</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/travis-light.svg">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- font awesome kit -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Leaflet.markercluster CSS and JS -->
    https://unpkg.com/leaflet.markercluster@1.4.1/dist/

    <!-- CUSTOM CSS -->
    <!-- global -->
    <link rel="stylesheet" href="../css/global-declarations.css">
    <link rel="stylesheet" href="css/crop.css">
    <!-- script for access control -->
    <script src="../js/access-control.js"></script>
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
    </script>
</head>

<body class="bg-light vh-100 pb-5">
    <!-- NAVBAR -->
    <?php require "../nav/nav.php" ?>

    <!-- CATEGORY FILTER -->
    <?php require "filter/categ-filter.php" ?>

    <div class="container my-4">
        <div class="row">

            <!-- FILTER -->
            <?php require "filter/all-side-filter.php" ?>

            <!-- LIST -->
            <div id="crop-list-container" class="col">

                <!-- table -->
                <?php require "list/table-list.php" ?>

                <!-- map -->
                <div id="crop-list-map" class="overflow-y-auto row d-none">
                    <div id="mapList" class="col rounded"></div>
                </div>

            </div>
        </div>

        <!-- pagination -->
        <!-- <div class="row mt-2">
            <nav id="list-pagination" class=" d-flex justify-content-end">
                <ul class="pagination ">
                    <li class="page-item">
                        <a class="page-link bg-light small-font link-dark fw-semibold" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link bg-light small-font link-dark fw-semibold" href="#">1</a></li>
                    <li class="page-item"><a class="page-link bg-light small-font link-dark fw-semibold" href="#">2</a></li>
                    <li class="page-item"><a class="page-link bg-light small-font link-dark fw-semibold" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link bg-light small-font link-dark fw-semibold" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div> -->

        <!-- Pagination -->
        <div class="row mt-2">
            <nav class="d-flex justify-content-end">
                <?php generatePaginationLinksHome($total_pages, $current_page, 'page'); ?>
            </nav>
        </div>
    </div>

    <!-- SCRIPT -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- custom -->
    <script src="../js/access.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/sideFilter.js"></script>
    <script src="js/list.js"></script>
    <!-- search function -->
    <script>
        // Modify the search function to store the search query in a session or URL parameter
        function search() {
            var searchInput = document.getElementById("searchInput").value;

            // Get existing filter parameters
            let searchParams = new URLSearchParams(window.location.search);
            let searchCondition = '';

            const existingFilters = {};
            for (let param of searchParams.entries()) {
                if (param[0] !== 'search') {
                    existingFilters[param[0]] = param[1];
                }
            }

            // Construct search condition with existing filters
            for (let key in existingFilters) {
                searchCondition += `${key}=${existingFilters[key]}&`;
            }

            // Add the search query to the search condition
            searchCondition += `search=${searchInput}`;

            // Redirect to the page with updated filters and search query
            window.location.href = window.location.pathname + '?' + searchCondition;
        }

        const searchInput = document.getElementById('searchInput');
        const clearButton = document.getElementById('clearButton');

        // Add a keyup event listener to the search input field
        searchInput.addEventListener('keyup', function(event) {
            // Check if the Enter key is pressed (key code 13)
            if (event.keyCode === 13) {
                // Call the search function
                search();
            }
        });

        // Function to clear the search and hide the clear button
        function clearSearch() {
            let searchParams = new URLSearchParams(window.location.search);
            let categoryId = searchParams.get('category_id');

            // Clear the search input
            document.getElementById('searchInput').value = '';

            // Redirect to the page with the cleared search and retained category_id
            if (categoryId) {
                window.location.href = window.location.pathname + '?category_id=' + categoryId;
            } else {
                window.location.href = window.location.pathname;
            }
        }

        function applyFilters() {
            let searchParams = new URLSearchParams(window.location.search);
            let searchCondition = '';

            // Get the selected filters
            const selectedCategories = Array.from(document.querySelectorAll('.crop-filter:checked')).map(checkbox => checkbox.value);
            const selectedMunicipalities = Array.from(document.querySelectorAll('.municipality-filter:checked')).map(checkbox => checkbox.value);
            const selectedVarieties = Array.from(document.querySelectorAll('.variety-filter:checked')).map(checkbox => checkbox.value);
            const selectedTerrain = Array.from(document.querySelectorAll('.terrain-filter:checked')).map(checkbox => checkbox.value);
            const selectedBrgy = Array.from(document.querySelectorAll('.brgy-filter:checked')).map(checkbox => checkbox.value);

            // Retain existing filters
            searchParams.forEach((value, key) => {
                if (key !== 'categories' && key !== 'municipalities' && key !== 'varieties' && key !== 'terrains' && key !== 'barangay') {
                    searchCondition += `${key}=${value}&`;
                }
            });

            // Add selected filters to searchCondition
            if (selectedCategories.length > 0) {
                searchCondition += `categories=${selectedCategories.join(',')}&`;
            }
            if (selectedMunicipalities.length > 0) {
                searchCondition += `municipalities=${selectedMunicipalities.join(',')}&`;
            }
            if (selectedVarieties.length > 0) {
                searchCondition += `varieties=${selectedVarieties.join(',')}&`;
            }
            if (selectedTerrain.length > 0) {
                searchCondition += `terrains=${selectedTerrain.join(',')}&`;
            }
            if (selectedBrgy.length > 0) {
                searchCondition += `barangay=${selectedBrgy.join(',')}&`;
            }

            // Remove the existing search query
            searchParams.delete('search');

            // Add the new search query to the search condition
            let newSearchQuery = ''; // Set your new search query here
            if (newSearchQuery) {
                searchCondition += `search=${newSearchQuery}&`;
            }

            // Remove trailing '&' if exists
            searchCondition = searchCondition.replace(/&$/, '');

            // Redirect to the page with updated filters
            window.location.href = window.location.pathname + '?' + searchCondition;
        }

        // Function to retrieve and apply selected filters from URL parameters
        function applySelectedFilters() {
            let searchParams = new URLSearchParams(window.location.search);
            let selectedCategories = searchParams.getAll('categories');
            let selectedMunicipalities = searchParams.getAll('municipalities');
            let selectedVarieties = searchParams.getAll('varieties');
            let selectedTerrain = searchParams.getAll('terrains');
            let selectedBrgy = searchParams.getAll('barangay');

            // Check checkboxes based on selected filters and show all crop filters
            selectedCategories.forEach(categoryIds => {
                categoryIds.split(',').forEach(categoryId => {
                    let categoryCheckbox = document.getElementById(`category${categoryId}`);
                    if (categoryCheckbox) {
                        categoryCheckbox.checked = true;
                    }
                });
            });

            // Show all crop filters
            let cropFilters = document.querySelectorAll('.crop-filter');
            if (selectedCategories != null && selectedCategories.length > 0) {
                cropFilters.forEach(filter => {
                    filter.closest('.collapse').classList.add('show');
                });
            }

            // Remove rotation class
            let cropChev = document.getElementById('cropChev');
            if (selectedCategories != null && selectedCategories.length > 0) {
                if (cropChev) {
                    cropChev.classList.remove('rotate-chevron');
                }
            }

            // Fetch and populate variety options for each selected category
            if (selectedCategories != null && selectedCategories.length > 0) {
                selectedCategories.forEach(categoryIds => {
                    fetch(`fetch/fetch_filter.php?category_id=${categoryIds}`)
                        .then(response => response.json())
                        .then(data => {
                            // Check if the data is not empty
                            if (data.length > 0) {
                                // Accessing the variety-filters div outside the loop to prevent duplication
                                let varietyFilter = document.getElementById('variety-div');
                                varietyFilter.classList.remove('hidden');

                                data.forEach(variety => {
                                    varietyFilter.innerHTML += `
                                        <div class="collapse show ps-4 my-2">
                                            <input class="form-check-input variety-filter" type="checkbox" id="category_variety${variety.category_variety_id}" value="${variety.category_variety_id}">
                                            <label for="category_variety${variety.category_variety_id}">${variety.category_variety_name}</label>
                                        </div>
                                    `;
                                });

                                // Check selected variety checkboxes after populating
                                selectedVarieties.forEach(varietyIds => {
                                    varietyIds.split(',').forEach(varietyId => {
                                        let varietyCheckbox = document.getElementById(`category_variety${varietyId}`);
                                        if (varietyCheckbox) {
                                            varietyCheckbox.checked = true;
                                        }
                                    });
                                });
                            }
                        })
                        .catch(error => console.error('Error fetching variety data:', error));
                });
            }

            selectedMunicipalities.forEach(municipalityIds => {
                municipalityIds.split(',').forEach(municipalityId => {
                    document.getElementById(`municipality${municipalityId}`).checked = true;
                });
            });

            // Show all municipality filters
            let municipalityFilters = document.querySelectorAll('.municipality-filter');
            if (selectedMunicipalities != null && selectedMunicipalities.length > 0) {
                municipalityFilters.forEach(filter => {
                    filter.closest('.collapse').classList.add('show');
                });
            }

            // Remove rotation class
            let municipalityChev = document.getElementById('munChev');
            if (selectedMunicipalities != null && selectedMunicipalities.length > 0) {
                if (municipalityChev) {
                    municipalityChev.classList.remove('rotate-chevron');
                }
            }

            selectedTerrain.forEach(terrainIds => {
                terrainIds.split(',').forEach(terrainId => {
                    let terrainCheckbox = document.getElementById(`terrain${terrainId}`);
                    if (terrainCheckbox) {
                        terrainCheckbox.checked = true;
                    }
                });
            });

            // Show all terrain filters
            let terrainFilters = document.querySelectorAll('.terrain-filter');
            if (selectedTerrain != null && selectedTerrain.length > 0) {
                terrainFilters.forEach(filter => {
                    filter.closest('.collapse').classList.add('show');
                });
            }

            // Remove rotation class
            let terrainChev = document.getElementById('terrainChev');
            if (selectedTerrain != null && selectedTerrain.length > 0) {
                if (terrainChev) {
                    terrainChev.classList.remove('rotate-chevron');
                }
            }

            // Fetch and populate barangay options for each selected category
            if (selectedMunicipalities != null && selectedMunicipalities.length > 0) {
                selectedMunicipalities.forEach(municipalityIds => {
                    fetch(`fetch/fetch_filter-brgy.php?municipality_id=${municipalityIds}`)
                        .then(response => response.json())
                        .then(data => {
                            // Check if the data is not empty
                            if (data.length > 0) {
                                // Accessing the barangay-filters div outside the loop to prevent duplication
                                let barangayFilter = document.getElementById('barangay-div');
                                barangayFilter.classList.remove('hidden');

                                data.forEach(barangay => {
                                    barangayFilter.innerHTML += `
                                        <div class="collapse show ps-4 my-2">
                                            <input class="form-check-input brgy-filter" type="checkbox" id="barangay${barangay.barangay_id}" value="${barangay.barangay_id}">
                                            <label for="barangay${barangay.barangay_id}">${barangay.barangay_name}</label>
                                        </div>
                                    `;
                                });

                                // Check selected barangay checkboxes after populating
                                selectedBrgy.forEach(barangayIds => {
                                    barangayIds.split(',').forEach(barangayId => {
                                        let barangayCheckbox = document.getElementById(`barangay${barangayId}`);
                                        if (barangayCheckbox) {
                                            barangayCheckbox.checked = true;
                                        }
                                    });
                                });
                            }
                        })
                        .catch(error => console.error('Error fetching barangay data:', error));
                });
            }
        }

        // Call applySelectedFilters() when the page is fully loaded
        window.addEventListener('load', applySelectedFilters);
    </script>
</body>

</html>