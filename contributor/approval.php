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
            <!-- CSS -->
            <style>
                /* CSS for tabs */
                .tab_box {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-bottom: 2px solid rgba(229, 229, 229);
                    position: relative;
                }

                .tab_box .tab_btn {
                    font-size: 18px;
                    font-weight: 600;
                    color: #919191;
                    background: none;
                    border: none;
                    padding: 18px;
                }

                @keyframes moving {
                    from {
                        transform: translateX(50px);
                        opacity: 0;
                    }

                    to {
                        transform: translateX(0px);
                        opacity: 1;
                    }
                }
            </style>
            <!-- LIST -->
            <div class="container">
                <div class="row">

                    <!-- HEADING -->
                    <div class="tab_box d-flex justify-content-between">
                        <!-- Button Tabs -->
                        <div>
                            <button class="tab_btn active" id="pendingTab" disabled>Pending</button>
                        </div>
                        <!-- filter actions -->
                        <div class="d-flex py-3 px-3">
                            <!-- search -->
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search Crops" aria-label="Search" aria-describedby="filter-search">
                                <span class="input-group-text" id="filter-search"><i class="bi bi-search"></i></span>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Set the number of items to display per page
                    $items_per_page = 10;

                    // Get the current page number
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                    // Calculate the offset based on the current page and items per page
                    $offset = ($current_page - 1) * $items_per_page;

                    // Count the total number of rows for pagination for pending crops
                    $total_rows_query_pending = "SELECT COUNT(*) FROM crop WHERE status = 'pending'";
                    $total_rows_result_pending = pg_query($conn, $total_rows_query_pending);
                    $total_rows_pending = pg_fetch_row($total_rows_result_pending)[0];

                    // Calculate the total number of pages for pending crops
                    $total_pages_pending = ceil($total_rows_pending / $items_per_page);
                    ?>

                    <!-- dib ni sya para ma set ang mga tabs na data -->
                    <div class="general_info">
                        <!-- Pending tab Active -->
                        <div class="gen_info" id="pendingTabData" style="max-height: 500px; overflow-y: auto;">

                            <!-- TABLE -->
                            <table id="pendingTable" class="table table-hover">
                                <!-- table head -->
                                <thead>
                                    <tr>
                                        <th class="col-1 thead-item" scope="col">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label text-dark-emphasis small-font">
                                                All
                                            </label>
                                        </th>
                                        <th class="col text-dark-emphasis small-font" scope="col">Name</th>
                                        <th class="col-3 text-dark-emphasis small-font" scope="col">Contributor</th>
                                        <th class="col-2 text-dark-emphasis text-center small-font" scope="col">Date</th>
                                        <th class="col-1 text-dark-emphasis text-center small-font" scope="col">Status</th>
                                        <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>
                                    </tr>
                                </thead>

                                <!-- table body -->
                                <tbody class="table-group-divider fw-bold overflow-scroll">
                                    <?php
                                    $query_pending = "SELECT * FROM crop WHERE status = 'pending' ORDER BY crop_id ASC LIMIT $items_per_page OFFSET $offset";
                                    $query_run_pending = pg_query($conn, $query_pending);

                                    if ($query_run_pending) {
                                        while ($row = pg_fetch_array($query_run_pending)) {
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
                                            <tr id="row1" data-toggle="modal" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>">
                                                <!-- checkbox -->
                                                <th scope="row"><input class="form-check-input" type="checkbox"></th>
                                                <input type="hidden" name="crop_id" value="<?= $row['crop_id']; ?>">
                                                <td>
                                                    <!-- scientific name -->
                                                    <a href=""><?= $row['crop_variety']; ?></a>
                                                    <!-- category -->
                                                    <?php
                                                    if (pg_num_rows($query_run_category)) {
                                                        $category = pg_fetch_assoc($query_run_category);
                                                        echo '<h6 class="text-secondary small-font m-0">' . $category['category_name'] . '</h6>';
                                                    } else {
                                                        echo "No category added.";
                                                    }
                                                    ?>
                                                </td>
                                                <!-- contributor -->
                                                <td class="text-secondary small-font fw-normal">
                                                    <?php
                                                    if (pg_num_rows($query_run_user)) {
                                                        $user = pg_fetch_assoc($query_run_user);
                                                        echo $user['first_name'] . " " . $user['last_name'];
                                                    } else {
                                                        echo "No contributor";
                                                    }
                                                    ?>
                                                </td>

                                                <!-- Date Created -->
                                                <td class=" text-secondary small-font text-center fw-normal">
                                                    <?= $formatted_date; ?>
                                                </td>

                                                <!-- Status -->
                                                <td class="text-secondary small-font text-center fw-normal">
                                                    <?= $row['status']; ?>
                                                </td>

                                                <!-- view -->
                                                <td>
                                                    <a href="#" class="btn btn-success btn-sm view_data admin-only" data-toggle="modal" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>">View</a>
                                                </td>
                                                <!-- Action -->
                                                <!-- <td>
                                                    <form class="d-flex justify-content-center" action="approval-page/code.php" method="post">
                                                        <input type="hidden" name="crop_id" value="<?php echo $row['crop_id']; ?>" />
                                                        <button type="submit" name="approve" class="btn btn-success me-2"><i class="fa-solid fa-check"></i></button>
                                                        <button type="submit" name="rejected" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </td> -->
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
                        <!-- Add pagination links -->
                        <?php generatePaginationLinks($total_pages_pending, $current_page, 'page'); ?>
                    </div>
                </div>
            </div>

            <!-- view -->
            <?php require "approval-page/view.php"; ?>
        </div>
    </div>
    <!-- SCRIPTS -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- search function -->
    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();

            // Determine which table is currently active
            var activeTable = document.querySelector('.gen_info.active table');
            tr = activeTable.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                var found = false;
                if (i === 0) {
                    tr[i].style.display = "";
                    continue; // Skip the header row
                }
                for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = found ? "" : "none";
            }
        }

        // Add event listener to search input
        document.getElementById('searchInput').addEventListener('keyup', filterTable);

        // Reset search input when tab is switched
        function resetSearchInput() {
            document.getElementById("searchInput").value = "";
            filterTable(); // Trigger filtering to show all rows
        }

        // Add event listener to tab buttons to reset search input
        document.querySelectorAll('.tab_btn').forEach(tab => {
            tab.addEventListener('click', resetSearchInput);
        });
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
            updateMapAndPin(latitude, longitude);

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

        function updateMapAndPin(latitude, longitude) {
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

            updateMapAndPin(latitude, longitude);
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
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        // make clicking table rows open edit ui
        $(document).ready(function() {
            $('#dataTable tr').click(function() {
                // console.log('clicked')
                // Get the crop ID from the clicked row or anchor tag
                var cropId = $(this).data('id') || $(this).find('a').data('id');

                // Open the modal
                $('#dataModal').modal('show');
            });
        });
    </script>
</body>
<!-- 
    to check if the user is logged in and has a rank of Encoder
    if Encoder ang rank i redirect sya pabalik kung asa sya gaina before niya ni gi try access
-->
<?php
if (!isset($_SESSION['LOGGED_IN']) || trim($_SESSION['rank']) == 'Encoder') {
    // Output JavaScript code to redirect back to the original page
    echo '<script>window.history.go(-1);</script>';
    $_SESSION['message'] = 'Access Not Granted Not Enough Authority.';
    // stop the code
    exit();
}
?>

</html>