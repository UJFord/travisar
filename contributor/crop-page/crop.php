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
    <?php require "../nav/nav.php"; ?>

    <?php
    include "../../functions/message.php";
    ?>

    <!-- MAIN -->
    <div class="container">
        <div class="row mt-3">

            <!-- FILTERS -->
            <?php require "filter.php"; ?>

            <!-- LIST -->
            <?php require "list.php"; ?>

            <!-- MODAL -->
            <!-- add -->
            <?php require "modals/add.php"; ?>
            <!-- edit -->
            <?php require "modals/edit.php"; ?>
            <!-- view -->
            <?php // require "modals/view.php"; 
            ?>
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
    <!-- SCRIPT for add location tab -->
    <script>
        // FORMS SIDE
        // Get references to the select elements
        // const neighbourhoodValue = document.getElementById('neighbourhood')
        const municipalitySelect = document.getElementById('Municipality');
        const barangaySelect = document.getElementById('Barangay');

        // Function to populate municipalities dropdown based on selected province
        function populateMunicipalities(selectedProvince) {
            // Fetch municipalities based on the selected province
            fetch('modals/fetch/fetch_location-add.php?province=' + selectedProvince)
                .then(response => response.json())
                .then(data => {
                    // console.log(data); // Log the response data
                    // Rest of your code
                    var municipalitiesDropdown = document.getElementById('Municipality');
                    municipalitiesDropdown.innerHTML = '<option value="" disabled selected hidden class="colorize">Select One</option>'; // Clear existing options

                    // Add the default "Select an option" option
                    // var defaultOption = document.createElement('option');
                    // defaultOption.value = 'null';
                    // defaultOption.text = 'Select a Municipality';
                    // defaultOption.disabled = true;
                    // defaultOption.selected = true;
                    // municipalitiesDropdown.appendChild(defaultOption);

                    // Add the fetched municipalities as options in the dropdown
                    data.forEach(municipality => {
                        var option = document.createElement('option');
                        option.value = municipality;
                        option.text = municipality;
                        municipalitiesDropdown.appendChild(option);
                    });
                });
        }

        // Call the populateMunicipalities function when the province dropdown value changes
        document.getElementById('Province').addEventListener('change', function() {
            var selectedProvince = document.getElementById('Province').value;
            populateMunicipalities(selectedProvince);
        });

        // Call the populateMunicipalities function initially to populate the municipalities dropdown based on the default selected province
        var selectedProvince = document.getElementById('Province').value;
        populateMunicipalities(selectedProvince);

        // Function to populate municipalities dropdown based on selected province
        function populateBarangay(selectedMunicipality) {
            // Fetch municipalities based on the selected province
            fetch('modals/fetch/fetch_location-add.php?municipality=' + selectedMunicipality)
                .then(response => response.json())
                .then(data => {
                    // console.log(data); // Log the response data

                    var barangayDropdown = document.getElementById('Barangay');
                    barangayDropdown.innerHTML = '<option value="" disabled selected hidden class="colorize">Select One</option>'; // Clear existing options


                    // Add the default "Select an option" option
                    // var defaultOption = document.createElement('option');
                    // defaultOption.value = 'null';
                    // defaultOption.text = 'Select a Barangay';
                    // defaultOption.disabled = true;
                    // defaultOption.selected = true;
                    // barangayDropdown.appendChild(defaultOption);

                    // Add the fetched municipalities as options in the dropdown
                    data.forEach(barangay => {
                        var option = document.createElement('option');
                        option.value = barangay;
                        option.text = barangay;
                        barangayDropdown.appendChild(option);
                        // console.log('option');
                    });
                });
        }

        // Call the populateBarangay function when the municipality dropdown value changes
        document.getElementById('Municipality').addEventListener('change', function() {
            var selectedMunicipality = document.getElementById('Municipality').value;
            populateBarangay(selectedMunicipality);
        });

        // Call the populateBarangay function initially to populate the municipalities dropdown based on the default selected municipality
        var selectedMunicipality = document.getElementById('Municipality').value;
        populateBarangay(selectedMunicipality);

        // initializnig map
        const map = L.map('map').setView([6.403013, 124.725062], 9); //starting position

        // Declare marker globally
        let marker = null;

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
        }).addTo(map);

        // input dom
        let coordInput = document.querySelector('#coordInput');

        // managing map click
        function onMapClick(e) {
            // Extract latitude and longitude from the LatLng object
            const latitude = e.latlng.lat;
            const longitude = e.latlng.lng;

            // Join the coordinates as a comma-separated string
            const formattedCoords = latitude.toFixed(6) + ", " + longitude.toFixed(6);

            // Set the input value to the formatted coordinates
            coordInput.value = formattedCoords;

            // Update the map and pin marker with the clicked coordinates
            updateMapAndPin(latitude, longitude);

            // fetch data
            console.log(latitude);
            console.log(longitude);
        }

        map.on('click', onMapClick);

        function updateMapAndPin(latitude, longitude) {
            // Remove potential existing marker
            if (marker) {
                map.removeLayer(marker);
            }

            // Convert input coordinates to Leaflet LatLng object
            const latLng = L.latLng(latitude, longitude);

            // Create a new marker if coordinates are valid
            if (isValidLatLng(latLng)) {
                marker = L.marker(latLng, {
                    icon: icon // Use your preferred marker icon (e.g., redIcon)
                });

                // Add marker to the map
                marker.addTo(map);

                // Center the map on the new marker
                // map.setView(latLng, map.getZoom()+1); // Adjust zoom level as needed
            } else {
                console.error("Invalid coordinates entered. Please enter valid latitude and longitude values.");
            }
        }

        // Input handling function
        function handleInputChange() {
            const inputValue = coordInput.value.trim(); // Trim leading/trailing whitespace

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
        const icon = L.icon({
            iconUrl: 'img/location-pin-svgrepo-com.svg',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Event listener for input changes
        coordInput.addEventListener('input', handleInputChange);

        // fetch data from openstreetmap nominatim
        function fetchData(lat, lng) {
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