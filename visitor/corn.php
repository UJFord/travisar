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
    <title>Travis | Corn</title>

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
            <?php require "filter/corn-side-filter.php" ?>

            <!-- LIST -->
            <div id="crop-list-container" class="col">

                <!-- table -->
                <?php require "list/table-list.php" ?>

                <!-- grid -->
                <?php require "list/grid-list.php" ?>

                <!-- map -->
                <div id="crop-list-map" class="overflow-y-auto row d-none">
                    <div id="mapList" class="col rounded"></div>
                </div>

            </div>
        </div>

        <!-- pagination -->
        <div class="row mt-2">
            <nav class=" d-flex justify-content-end">
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
        </div>
        <!-- Add pagination links -->
        <?php // generatePaginationLinks($total_pages, $current_page, 'page'); 
        ?>
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
            // Store the search query in a session or URL parameter
            // For example, you can use localStorage to store the search query
            localStorage.setItem('searchQuery', searchInput);
            // Reload the page with the search query as a parameter
            window.location.href = window.location.pathname + "?search=" + searchInput;
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

            // Get the existing search query if it exists
            let searchQuery = searchParams.get('search');

            const selectedCategories = Array.from(document.querySelectorAll('.crop-filter:checked')).map(checkbox => checkbox.value);
            const selectedMunicipalities = Array.from(document.querySelectorAll('.municipality-filter:checked')).map(checkbox => checkbox.value);
            const selectedVarieties = Array.from(document.querySelectorAll('.variety-filter:checked')).map(checkbox => checkbox.value);
            const selectedTerrain = Array.from(document.querySelectorAll('.terrain-filter:checked')).map(checkbox => checkbox.value);
            const selectedBrgy = Array.from(document.querySelectorAll('.brgy-filter:checked')).map(checkbox => checkbox.value);

            // Add existing category_id to searchCondition if it exists
            let categoryId = searchParams.get('category_id');
            if (categoryId) {
                searchCondition += `category_id=${categoryId}&`;
            }

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

            // Add existing search query to searchCondition
            if (searchQuery) {
                searchCondition += `search=${searchQuery}`;
            }

            // Redirect to the page with updated filters
            window.location.href = window.location.pathname + '?' + searchCondition;
        }
    </script>
</body>

</html>