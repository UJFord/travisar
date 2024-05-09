<?php
session_start();
require "../../functions/connections.php";
require "../../functions/functions.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="../../visitor/img/travis-light.svg">

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
    <link rel="stylesheet" href="../../css/global-declarations.css">
    <!-- specific for this file -->
    <link rel="stylesheet" href="../css/crop-list.css">
    <!-- script for moment js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- script for the window alert -->
    <script src="../../js/window.js"></script>
    <!-- script for access control -->
    <script src="../../js/access-control.js"></script>

    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>
</head>

<body>

    <!-- NAV -->
    <?php require "../../nav/nav.php"; ?>

    <?php
    include "../../functions/message.php";
    ?>

    <!-- MAIN -->
    <div class="container">
        <div class="row mt-3">
            <!-- FILTERS -->
            <?php require "filter.php"; ?>
            <!-- List -->
            <?php require "approved-list.php"; ?>
            <!-- view -->
            <?php require "view.php"; ?>
        </div>
    </div>

    <!-- SCRIPTS -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../../visitor/js/nav.js"></script>
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
            const selectedVarieties = Array.from(document.querySelectorAll('.variety-filter:checked')).map(checkbox => checkbox.value);
            const selectedTerrain = Array.from(document.querySelectorAll('.terrain-filter:checked')).map(checkbox => checkbox.value);
            const selectedBrgy = Array.from(document.querySelectorAll('.brgy-filter:checked')).map(checkbox => checkbox.value);

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
            if (selectedVarieties.length > 0) {
                searchCondition += `&varieties=${selectedVarieties.join(',')}`;
                console.log(searchCondition);
                console.log('Filter applied');
            }
            if (selectedTerrain.length > 0) {
                searchCondition += `&terrains=${selectedTerrain.join(',')}`;
                console.log(searchCondition);
                console.log('Filter applied');
            }
            if (selectedBrgy.length > 0) {
                searchCondition += `&barangay=${selectedBrgy.join(',')}`;
                console.log(searchCondition);
                console.log('Filter applied');
            }

            // Reload the table with the new filters
            window.location.href = window.location.pathname + '?search=' + searchCondition;
        }
    </script>

    <!-- Script for the map for edit tab -->
    <script>
        // Define the bounds of your map
        const southWestEdit = L.latLng(5, 123.0); // Lower left corner of the bounds
        const northEastEdit = L.latLng(7, 127.0); // Upper right corner of the bounds
        const boundsEdit = L.latLngBounds(southWestEdit, northEastEdit);

        // Initialize the map with the bounds
        const mapEdit = L.map('mapEdit', {
            maxBounds: boundsEdit, // Restrict map panning to these bounds
            maxBoundsViscosity: 0.75, // Elastic bounce-back when panning outside bounds
            // Set the initial view within the bounds
            center: [6.403013, 124.725062],
            zoom: 9
        });

        // send resize event to browser to load map tiles
        $(document).ready(function() {
            setInterval(function() {
                window.dispatchEvent(new Event("resize"));
            }, 2000);
        });

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
            edgeBufferTiles: 5,
            // copyright claim, because openstreetmaps require them
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            // i dont know what this does
            crossOrigin: true
        }).addTo(mapEdit);

        // input dom
        let coordInputEdit = document.querySelector('#coordEdit');

        // managing map click
        // function onMapClickEdit(e) {
        //     // Extract latitude and longitude from the LatLng object
        //     const latitude = e.latlng.lat;
        //     const longitude = e.latlng.lng;

        //     // Join the coordinates as a comma-separated string
        //     const formattedCoords = latitude.toFixed(6) + ", " + longitude.toFixed(6);

        //     // Set the input value to the formatted coordinates
        //     coordInputEdit.value = formattedCoords;

        //     // Update the map and pin marker with the clicked coordinates
        //     updateMapAndPinEdit(latitude, longitude);

        //     // fetch data
        //     console.log(latitude);
        //     console.log(longitude);
        //     let details = fetchDataEdit(latitude, longitude)
        //         .then(details => {
        //             // set neighbourhood
        //             // neighbourhoodValueEdit.value = details.neighbourhood
        //             // set municipality
        //             // municipalitySelect.value = details.town;
        //             // set barangay
        //             // barangaySelect.value = details.village;

        //             console.log('Country:', details.country);
        //             console.log('State:', details.state);
        //             console.log('County:', details.county);
        //             console.log('City:', details.city);
        //             console.log('Town:', details.town);
        //             console.log('Borough:', details.borough);
        //             console.log('Village:', details.village);
        //             console.log('Suburb:', details.suburb);
        //             // console.log('Neighbourhood:', details.neighbourhood);
        //             // console.log('Neighbourhood:', details.neighbourhood);
        //             console.log('Settlement:', details.settlement);
        //             console.log('Major Streets:', details.majorStreets);
        //             console.log('Major and Minor Streets:', details.majorAndMinorStreets);
        //             console.log('Building:', details.building);
        //         });
        // }

        // mapEdit.on('click', onMapClickEdit);

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
        function handleInputChangeEdit() {
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
            iconUrl: '../img/location-pin-svgrepo-com.svg',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Event listener for input changes
        coordInputEdit.addEventListener('input', handleInputChangeEdit);

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

        // function to pin location from input by roger bairoy
        document.addEventListener("DOMContentLoaded", function() {
            var typingTimer; // Timer identifier
            var doneTypingInterval = 1000; // Time in milliseconds (5 seconds)

            // Function to update the map marker based on input location
            function updateMapEdit(locationEdit) {
                // Parse the location string to extract latitude and longitude
                var coordinates = locationEdit.split(',').map(function(coord) {
                    return parseFloat(coord.trim());
                });

                // Check if coordinates are valid
                if (coordinates.length === 2 && !isNaN(coordinates[0]) && !isNaN(coordinates[1])) {
                    var lat = coordinates[0];
                    var lng = coordinates[1];

                    // Remove existing marker if any
                    if (typeof marker !== 'undefined') {
                        mapEdit.removeLayer(markerEdit);
                    }

                    // Create a new marker at the specified coordinates and add it to the mapEdit
                    markerEdit = L.marker([lat, lng]).addTo(mapEdit);

                    // Set the mapEdit view to the marker's location
                    mapEdit.setView([lat, lng], 20); // Zoom level 12
                } else {
                    // Invalid coordinates
                    console.error('Invalid location format');
                }
            }

            // Event listener for location input field
            document.getElementById('coordEdit').addEventListener('input', function() {
                clearTimeout(typingTimer);
                var locationEdit = this.value;
                typingTimer = setTimeout(function() {
                    // Update the map marker based on the input location after 5 seconds of inactivity
                    updateMapEdit(locationEdit);
                }, doneTypingInterval);
            });
        });
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