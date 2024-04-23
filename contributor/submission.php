<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- title -->
    <title>Travisar</title>

    <!-- STYLESHEETS -->

    <!-- leaflet -->

    <!-- bootstrap -->
    <!-- stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- custom -->
    <!-- global declarations -->
    <link rel="stylesheet" href="../css/global-declarations.css">
    <!-- specific for this file -->
    <link rel="stylesheet" href="css/crop-list.css">
    <!-- script for moment js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- script for access control -->
    <script src="../js/access-control.js"></script>

    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>
</head>

<body>

    <!-- NAV -->
    <?php require "nav.php"; ?>

    <?php
    include "../functions/message.php";
    ?>

    <!-- MAIN -->
    <div class="container">
        <div class="row mt-3">

            <!-- FILTERS -->
            <?php require "crop-page/filter.php"; ?>

            <!-- LIST -->
            <div class="col">
                <div class="container">

                    <!-- HEADING -->
                    <div class="d-flex justify-content-between">
                        <!-- title -->
                        <h4 class="fw-semibold" style="font-size: 1.5rem;">My Crops</h4>
                    </div>

                    <?php
                    // Set the number of items to display per page
                    $items_per_page = 10;

                    // Get the current page number
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                    // Calculate the offset based on the current page and items per page
                    $offset = ($current_page - 1) * $items_per_page;

                    // Count the total number of rows for pagination
                    $total_rows_query = "SELECT COUNT(*) FROM crop left join status on status.status_id = crop.status_id";
                    $total_rows_result = pg_query($conn, $total_rows_query);
                    $total_rows = pg_fetch_row($total_rows_result)[0];

                    // Calculate the total number of pages
                    $total_pages = ceil($total_rows / $items_per_page);

                    // Get the search query from the session or URL parameter
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $search_condition = $search ? "AND crop_variety ILIKE '%$search%'" : '';

                    // Get the categories and municipalities filter from the URL
                    $category_filter = !empty($_GET['categories']) ? "AND category_id IN (" . implode(',', explode(',', $_GET['categories'])) . ")" : '';
                    $municipality_filter = !empty($_GET['municipalities']) ? "AND location_id IN (" . implode(',', explode(',', $_GET['municipalities'])) . ")" : '';

                    $user_id = null; // Initialize the variable

                    if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) {
                        $user_id = $_SESSION['USER']['user_id']; // Assign the user ID if the user is logged in
                    }
                    ?>
                    <!-- TABLE -->
                    <table id="dataTable" class="table table-hover">
                        <!-- table head -->
                        <thead>
                            <tr>
                                <th class="col thead-item" scope="col">
                                    <input class="form-check-input small-font" type="checkbox">
                                    <label class="form-check-label text-dark-emphasis small-font">
                                        All
                                    </label>
                                </th>
                                <th class="col text-dark-emphasis small-font" scope="col">Category</th>
                                <th class="col text-dark-emphasis small-font" scope="col">Name</th>
                                <th class="col text-dark-emphasis small-font" scope="col">Date</th>
                                <!-- <th class="col text-dark-emphasis small-font" scope="col">Action</th> -->
                                <th class="col text-dark-emphasis small-font" scope="col">Status</th>
                                <th class="col text-dark-emphasis small-font text-center" scope="col">Remarks</th>
                                <th class="col text-dark-emphasis text-end" scope="col">
                                    <div class="dropdown">
                                        <button class="btn tranparent dropdown-toggle row-btn row-action-btn p-0 action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="row-btn fa-solid fa-ellipsis-vertical px-3 py-2 m-0 rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash text-danger text-center me-1" style="width: 20px;"></i>Delete Selected</a></li>
                                        </ul>
                                    </div>
                                </th>

                            </tr>
                        </thead>

                        <!-- table body -->
                        <tbody class="table-group-divider fw-bold overflow-scroll">
                            <?php
                            // get the data from crops.
                            $query = "SELECT * FROM crop 
                            LEFT JOIN crop_location ON crop_location.crop_id = crop.crop_id 
                            LEFT JOIN status ON status.status_id = crop.status_id 
                            WHERE 1=1 $search_condition $category_filter $municipality_filter AND user_id = $user_id
                            ORDER BY crop.crop_id DESC 
                            LIMIT $items_per_page OFFSET $offset";
                            $query_run = pg_query($conn, $query);

                            if ($query_run) {
                                while ($row = pg_fetch_array($query_run)) {
                                    // Convert the string to a DateTime object
                                    $date = new DateTime($row['input_date']);
                                    // Format the date to display up to the minute
                                    $formatted_date = $date->format('Y-m-d H:i');

                                    // Fetch category name
                                    $query_category = "SELECT * FROM category WHERE category_id = $1";
                                    $query_run_category = pg_query_params($conn, $query_category, array($row['category_id']));

                                    // Fetch contributor name
                                    $query_user = "SELECT * FROM users WHERE user_id = $1";
                                    $query_run_user = pg_query_params($conn, $query_user, array($row['user_id']));
                            ?>
                                    <?php
                                    if ($row['action'] === 'draft') {
                                    ?>
                                        <tr data-id="<?= $row['crop_id']; ?>" class="rowlink edit_data" href="#" data-bs-toggle="modal" data-bs-target="#edit-item-modal">
                                        <?php
                                    } else {
                                        ?>
                                        <tr data-id="<?= $row['crop_id']; ?>" class="rowlink" target=”_blank” data-href="submission-page/view.php?crop_id=<?= $row['crop_id'] ?>">
                                        <?php
                                    }
                                        ?>

                                        <input type="hidden" name="crop_id" value="<?= $row['crop_id']; ?>">
                                        <!-- hidden id for location to be used for filter function for location to be found -->
                                        <input type="hidden" name="location_id" value="<?= $row['location_id']; ?>">

                                        <!-- checkbox -->
                                        <th scope="row">
                                            <input class="row-checkbox form-check-input small-font" type="checkbox">
                                        </th>

                                        <!-- category -->
                                        <td>
                                            <div class="small-font">
                                                <?php
                                                if (pg_num_rows($query_run_category)) {
                                                    $category = pg_fetch_assoc($query_run_category);
                                                    echo '<h6 class="text-secondary small-font m-0">' . $category['category_name'] . '</h6>';
                                                } else {
                                                    echo "No category added.";
                                                }
                                                ?>
                                            </div>
                                        </td>

                                        <!-- Variety name -->
                                        <td>
                                            <!-- Variety name -->
                                            <a href="submission-page/view.php?crop_id=<?= $row['crop_id'] ?>" target=”_blank”><?= $row['crop_variety']; ?></a>
                                        </td>

                                        <!-- date created -->
                                        <td>
                                            <h6 class="text-secondary small-font"><?= $formatted_date; ?></h6>
                                        </td>

                                        <!-- status -->
                                        <td>
                                            <span class=" small-font bg-dark-subtle w-auto py-1 px-2 rounded"><?= $row['action']; ?></span>
                                        </td>

                                        <!-- remarks -->
                                        <td class="text-center">
                                            <div class="dropdown row-btn">
                                                <button class="btn transparent dropdown-toggle row-action-btn remarks-btn p-0 p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="row-btn fa-regular fa-comment p-2 m-0 rounded"></i>
                                                </button>
                                                <div class="dropdown-menu remarks-menu p-2">
                                                    <textarea class="form-control remarks-text" placeholder="No remarks" style="height: 180px;" disabled><?= $row['remarks']; ?></textarea>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- ellipsis menu butn -->
                                        <td class="text-end">
                                            <div class="dropdown row-btn">
                                                <button class="btn tranparent dropdown-toggle row-action-btn p-0 action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="row-btn fa-solid fa-ellipsis-vertical px-3 py-2 m-0 rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-eye text-center" style="width: 20px;"></i> View</a></li>
                                                    <li>
                                                        <a class="dropdown-item edit_data" href="#" data-bs-toggle="modal" data-bs-target="#edit-item-modal" data-id="<?= $row['crop_id']; ?>"><i class="fa-solid fa-pen-to-square text-center me-1" style="width: 20px;"></i>Edit</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash text-danger text-center me-1" style="width: 20px;"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        </tr>
                                <?php
                                }
                            } else {
                                echo "No data found.";
                            }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Add pagination links -->
            <?php generatePaginationLinks($total_pages, $current_page, 'page'); ?>

            <!-- MODAL -->
            <!-- add -->
            <?php require "submission-page/edit.php"; ?>

        </div>
    </div>

    <!-- SCRIPTS -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- to Capitalized all first letter in all inputs and textarea -->
    <script>
        $(document).ready(function() {
            // Capitalize the initial values of input fields
            $("input[type='text']").each(function() {
                $(this).val($(this).val().replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                }));
            });

            // Update the value as the user types
            $("input[type='text']").on('input', function() {
                var start = this.selectionStart,
                    end = this.selectionEnd;
                $(this).val(function(_, val) {
                    return val.replace(/\b\w/g, function(char) {
                        return char.toUpperCase();
                    });
                });
                this.setSelectionRange(start, end);
            });

            // Capitalize the initial values textarea fields
            $("textarea").each(function() {
                $(this).val($(this).val().replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                }));
            });

            // Update the value as the user types
            $("textarea").on('input', function() {
                var start = this.selectionStart,
                    end = this.selectionEnd;
                $(this).val(function(_, val) {
                    return val.replace(/\b\w/g, function(char) {
                        return char.toUpperCase();
                    });
                });
                this.setSelectionRange(start, end);
            });
        });
    </script>
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
            searchInput.value = '';
            window.location.href = window.location.pathname;
        }

        // Function to apply filters and update the table
        function applyFilters() {
            let searchCondition = ''; // Initialize searchCondition here

            const selectedCategories = Array.from(document.querySelectorAll('.crop-filter:checked')).map(checkbox => checkbox.value);
            const selectedMunicipalities = Array.from(document.querySelectorAll('.municipality-filter:checked')).map(checkbox => checkbox.value);

            // Build the search condition based on selected categories, municipalities, and the search value
            if (selectedCategories.length > 0) {
                searchCondition += `&categories=${selectedCategories.join(',')}`;
                console.log(searchCondition);
                console.log('Filter applied');
            }
            if (selectedMunicipalities.length > 0) {
                searchCondition += `&municipalities=${selectedMunicipalities.join(',')}`;
                console.log(searchCondition);
                console.log('Filter applied');
            }

            // Reload the table with the new filters
            window.location.href = window.location.pathname + '?search=' + searchCondition;
        }
    </script>
    <!-- Script nf or the map for edit tab -->
    <script>
        // initializnig map
        const mapEdit = L.map('mapEdit').setView([6.403013, 124.725062], 9); //starting position

        // Declare marker globally
        let markerEdit = null;

        L.tileLayer(`https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`, { //style URL
            // tilesize
            tileSize: 512,
            // maxzoom
            maxZoom: 18,
            // i dont what this does but some says before different tile providers handle zoom differently
            zoomOffset: -1,
            // minzoom
            minZoom: 9,
            // copyright claim, because openstreetmaps require them
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            // i dont know what this does
            crossOrigin: true
        }).addTo(mapEdit);

        // input dom
        let coordInputEdit = document.querySelector('#coordEdit');

        // managing map click
        function onMapClickEdit(e) {
            // Extract latitude and longitude from the LatLng object
            const latitude = e.latlng.lat;
            const longitude = e.latlng.lng;

            // Join the coordinates as a comma-separated string
            const formattedCoords = latitude.toFixed(6) + ", " + longitude.toFixed(6);

            // Set the input value to the formatted coordinates
            coordInputEdit.value = formattedCoords;

            // Update the map and pin marker with the clicked coordinates
            updateMapAndPinEdit(latitude, longitude);

            // fetch data
            console.log(latitude);
            console.log(longitude);
            let details = fetchDataEdit(latitude, longitude)
                .then(details => {
                    // set neighbourhood
                    // neighbourhoodValueEdit.value = details.neighbourhood
                    // set municipality
                    // municipalitySelect.value = details.town;
                    // set barangay
                    // barangaySelect.value = details.village;

                    console.log('Country:', details.country);
                    console.log('State:', details.state);
                    console.log('County:', details.county);
                    console.log('City:', details.city);
                    console.log('Town:', details.town);
                    console.log('Borough:', details.borough);
                    console.log('Village:', details.village);
                    console.log('Suburb:', details.suburb);
                    // console.log('Neighbourhood:', details.neighbourhood);
                    // console.log('Neighbourhood:', details.neighbourhood);
                    console.log('Settlement:', details.settlement);
                    console.log('Major Streets:', details.majorStreets);
                    console.log('Major and Minor Streets:', details.majorAndMinorStreets);
                    console.log('Building:', details.building);
                });
        }

        mapEdit.on('click', onMapClickEdit);

        function updateMapAndPinEdit(latitude, longitude) {
            // Remove potential existing marker
            if (markerEdit) {
                mapEdit.removeLayer(markerEdit);
            }

            // Convert input coordinates to Leaflet LatLng object
            const latLng = L.latLng(latitude, longitude);

            // Create a new marker if coordinates are valid
            if (isValidLatLng(latLng)) {
                markerEdit = L.marker(latLng, {
                    icon: iconEdit // Use your preferred marker icon (e.g., redIcon)
                });

                // Add marker to the map
                markerEdit.addTo(mapEdit);

                // Center the map on the new marker
                // map.setView(latLng, map.getZoom()+1); // Adjust zoom level as needed
            } else {
                console.error("Invalid coordinates entered. Please enter valid latitude and longitude values.");
            }
        }

        // Input handling function
        function handleInputChange() {
            const inputValue = coordInputEdit.value.trim(); // Trim leading/trailing whitespace

            // Ensure comma separation, handle different input formats
            const parts = inputValue.split(/\s*,\s*/);
            if (parts.length !== 2) {
                console.error("Invalid input format. Please enter coordinates in the format 'latitude, longitude'.");
                return;
            }

            const latitude = parseFloat(parts[0]);
            const longitude = parseFloat(parts[1]);

            updateMapAndPinEdit(latitude, longitude);
        }

        // Utility function to validate LatLng object
        function isValidLatLng(latLng) {
            return !isNaN(latLng.lat) && !isNaN(latLng.lng) && -90 <= latLng.lat <= 90 && -180 <= latLng.lng <= 180;
        }

        // Marker initialization (adjust icon as needed)
        const iconEdit = L.icon({
            iconUrl: 'img/location-pin-svgrepo-com.svg',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Event listener for input changes
        coordInputEdit.addEventListener('input', handleInputChange);

        // fetch data from openstreetmap nominatim
        function fetchDataEdit(lat, lng) {
            return fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Fetch response as text
                })
                .then(data => {
                    // Parse the XML string into a DOM structure
                    const parser = new DOMParser();
                    const xmlDoc = parser.parseFromString(data, "text/xml");

                    // Access information in the XML document
                    const resultElement = xmlDoc.querySelector('result');
                    const addressPartsElement = xmlDoc.querySelector('addressparts');

                    // Extract details only if the tag exists
                    const details = {};
                    if (addressPartsElement) {
                        details.country = addressPartsElement.querySelector('country')?.textContent || '';
                        details.state = addressPartsElement.querySelector('state')?.textContent || '';
                        details.county = addressPartsElement.querySelector('county')?.textContent || '';
                        details.city = addressPartsElement.querySelector('city')?.textContent || '';
                        details.town = addressPartsElement.querySelector('town')?.textContent || '';
                        details.borough = addressPartsElement.querySelector('borough')?.textContent || '';
                        details.village = addressPartsElement.querySelector('village')?.textContent || '';
                        details.suburb = addressPartsElement.querySelector('suburb')?.textContent || '';
                        details.neighbourhood = addressPartsElement.querySelector('neighbourhood')?.textContent || '';
                        details.settlement = addressPartsElement.querySelector('settlement')?.textContent || '';
                        details.majorStreets = addressPartsElement.querySelector('major_streets')?.textContent || '';
                        details.majorAndMinorStreets = addressPartsElement.querySelector('major_and_minor_streets')?.textContent || '';
                        details.building = addressPartsElement.querySelector('building')?.textContent || '';
                    }

                    return details;
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    // Return null or handle error as needed
                    return null;
                });
        }
    </script>
    <!-- allowing scrollspy in the modal -->
    <script>
        $(document).ready(function() {
            $('#view-item-modal').on('shown.bs.modal', function() {
                $('[data-spy="scroll"]').scrollspy('refresh');
                console.log($('[data-spy="scroll"]').scrollspy());
            });
        });
    </script>
</body>

</html>