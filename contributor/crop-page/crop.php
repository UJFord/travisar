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
    <link rel="icon" type="image/png" sizes="32x32" href="../../visitor/img/travis-light.svg">

    <!-- STYLESHEETS -->

    <!-- leaflet -->

    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
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
    <!-- script for the window alert -->
    <script src="../../js/window.js"></script>

    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>
</head>

<body>

    <!-- NAV -->
    <?php // require "../nav/nav.php"; 
    ?>
    <?php require "../../nav/nav.php"; ?>

    <?php
    include "../../functions/message.php";
    ?>

    <!-- Display the session message if it exists -->


    <!-- MAIN -->
    <div class="container">
        <div class="row mt-3">
            <!-- confirm-delete -->
            <?php require "confirm-delete.php"; ?>
            <!-- download -->
            <?php require "download.php"; ?>
            <!-- FILTERS -->
            <?php require "filter.php"; ?>

            <!-- LIST -->
            <?php require "list.php"; ?>

            <!-- MODAL -->
            <!-- import -->
            <?php require "modals/import.php"; ?>
            <!-- add -->
            <?php require "modals/add.php"; ?>
            <!-- add -->
            <?php require "modals/draft.php"; ?>
            <!-- edit -->
            <?php require "modals/edit.php"; ?>
            <!-- manage -->
            <?php require "modals/manage.php";
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
    <!-- CUSTOM -->
    <script src="../../visitor/js/nav.js"></script>
    <!-- to Capitalized all first letter in all inputs and textarea -->
    <script>
        $(document).ready(function() {
            // Capitalize the initial values of input fields
            $("input[type='text'], textarea").each(function() {
                var currentValue = $(this).val();
                if (currentValue.length > 0) {
                    var modifiedValue = currentValue.charAt(0).toUpperCase() + currentValue.slice(1);
                    $(this).val(modifiedValue);
                }
            });

            // Update the value as the user types
            $("input[type='text'], textarea").on('input', function() {
                var start = this.selectionStart,
                    end = this.selectionEnd;
                var newValue = $(this).val();
                if (newValue.length > 0) {
                    newValue = newValue.charAt(0).toUpperCase() + newValue.slice(1);
                }
                $(this).val(newValue);
                this.setSelectionRange(start, end);
            });
        });
    </script>
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
            const selectedStatus = Array.from(document.querySelectorAll('.status-filter:checked')).map(checkbox => checkbox.value);
            const selectedCategories = Array.from(document.querySelectorAll('.crop-filter:checked')).map(checkbox => checkbox.value);
            const selectedMunicipalities = Array.from(document.querySelectorAll('.municipality-filter:checked')).map(checkbox => checkbox.value);
            const selectedVarieties = Array.from(document.querySelectorAll('.variety-filter:checked')).map(checkbox => checkbox.value);
            const selectedTerrain = Array.from(document.querySelectorAll('.terrain-filter:checked')).map(checkbox => checkbox.value);
            const selectedBrgy = Array.from(document.querySelectorAll('.brgy-filter:checked')).map(checkbox => checkbox.value);

            // Retain existing filters
            searchParams.forEach((value, key) => {
                if (key !== 'status' && key !== 'categories' && key !== 'municipalities' && key !== 'varieties' && key !== 'terrains' && key !== 'barangay') {
                    searchCondition += `${key}=${value}&`;
                }
            });

            // Build the search condition based on selected categories, municipalities, and the search value
            if (selectedStatus.length > 0) {
                searchCondition += `&status=${selectedStatus.join(',')}&`;
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
            let selectedStatus = searchParams.getAll('status');
            let selectedCategories = searchParams.getAll('categories');
            let selectedMunicipalities = searchParams.getAll('municipalities');
            let selectedVarieties = searchParams.getAll('varieties');
            let selectedTerrain = searchParams.getAll('terrains');
            let selectedBrgy = searchParams.getAll('barangay');

            // Check checkboxes based on selected filters and show all status filters
            selectedStatus.forEach(statusIds => {
                statusIds.split(',').forEach(statusId => {
                    let statusCheckbox = document.getElementById(`status${statusId}`);
                    if (statusCheckbox) {
                        statusCheckbox.checked = true;
                    }
                });
            });

            // Show all status filters
            let statusFilters = document.querySelectorAll('.status-filter');
            if (selectedStatus != null && selectedStatus.length > 0) {
                statusFilters.forEach(filter => {
                    filter.closest('.collapse').classList.add('show');
                });
            }

            // Remove rotation class
            let statusChev = document.getElementById('statusChev');
            if (selectedStatus != null && selectedStatus.length > 0) {
                if (statusChev) {
                    statusChev.classList.remove('rotate-chevron');
                }
            }

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
                    fetch(`modals/fetch/fetch_filter.php?category_id=${categoryIds}`)
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
                    fetch(`modals/fetch/fetch_filter-brgy.php?municipality_id=${municipalityIds}`)
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
                    // Clear existing options ang add default value
                    municipalitiesDropdown.innerHTML = '<option value="" disabled selected hidden class="colorize">Select One</option>';

                    // Add the fetched municipalities as options in the dropdown
                    data.forEach(municipality => {
                        var option = document.createElement('option');
                        option.value = municipality['municipality_id'];
                        option.text = municipality['municipality_name'];
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

        // Call the populateBarangay function initially to populate the municipalities dropdown based on the default selected municipality
        var selectedMunicipality = document.getElementById('Municipality').value;
        populateBarangay(selectedMunicipality);

        // Function to populate barangays dropdown based on selected municipality
        function populateBarangay(selectedMunicipality) {
            // Fetch barangays based on the selected municipality
            fetch('modals/fetch/fetch_location-add.php?municipality=' + selectedMunicipality)
                .then(response => response.json())
                .then(data => {
                    // console.log(data); // Log the response data

                    var barangayDropdown = document.getElementById('Barangay');
                    barangayDropdown.innerHTML = '<option value="" disabled selected hidden class="colorize">Select One</option>'; // Clear existing options

                    // Add the fetched barangays as options in the dropdown
                    data.forEach(barangay => {
                        var option = document.createElement('option');
                        option.value = barangay['barangay_id'];
                        option.text = barangay['barangay_name'];
                        barangayDropdown.appendChild(option);
                    });
                });
        }

        // Call the populateBarangay function when the municipality dropdown value changes
        // to automatically go to the coordinated of the municipality
        document.getElementById('Municipality').addEventListener('change', function() {
            var selectedMunicipality = document.getElementById('Municipality').value;
            populateBarangay(selectedMunicipality);

            // Fetch coordinates for the selected municipality
            fetch('modals/fetch/fetch_location-add.php?pin_municipality=' + selectedMunicipality)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var coordinatesString = data[0]['municipality_coordinates'];
                        var coordinatesArray = coordinatesString.split(',').map(coord => parseFloat(coord.trim()));

                        if (coordinatesArray.length === 2) {
                            var latitude = coordinatesArray[0];
                            var longitude = coordinatesArray[1];

                            // Update the map and pin marker with the selected coordinates
                            updateMapAndPin(latitude, longitude);
                            // Set the map view to the marker's location
                            map.setView([latitude, longitude], 12); // Zoom level 12
                            // Update the coordinates input field with the selected municipality's coordinates
                            coordInput.value = latitude.toFixed(6) + ', ' + longitude.toFixed(6);
                        }
                    }
                });
        });

        // Call the populateBarangay function when the Barangay dropdown value changes
        document.getElementById('Barangay').addEventListener('change', function() {
            var selectedBarangay = document.getElementById('Barangay').value;

            // Fetch coordinates for the selected barangay
            fetch('modals/fetch/fetch_location-add.php?pin_barangay=' + selectedBarangay)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var coordinatesString = data[0]['barangay_coordinates'];
                        var coordinatesArray = coordinatesString.split(',').map(coord => parseFloat(coord.trim()));

                        if (coordinatesArray.length === 2) {
                            var latitude = coordinatesArray[0];
                            var longitude = coordinatesArray[1];

                            // Update the map and pin marker with the selected coordinates
                            updateMapAndPin(latitude, longitude);
                            // Set the map view to the marker's location
                            map.setView([latitude, longitude], 12); // Zoom level 12
                            // Update the coordinates input field with the selected barangay's coordinates
                            coordInput.value = latitude.toFixed(6) + ', ' + longitude.toFixed(6);
                        }
                    }
                });
        });


        // Define the bounds of your map
        const southWest = L.latLng(5, 123.0); // Lower left corner of the bounds
        const northEast = L.latLng(7, 127.0); // Upper right corner of the bounds
        const bounds = L.latLngBounds(southWest, northEast);

        // Initialize the map with the bounds
        const map = L.map('map', {
            maxBounds: bounds, // Restrict map panning to these bounds
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

        // let map = L.map('map').setView([6.403013, 124.725062], 9);

        // Declare marker globally
        let marker = null;

        L.tileLayer(`https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`, { //style URL
            // tilesize
            tileSize: 512,
            // maxzoom
            maxZoom: 18,
            minZoom: 9,
            // i dont what this does but some says before different tile providers handle zoom differently
            zoomOffset: -1,

            edgeBufferTiles: 5,
            // copyright claim, because openstreetmaps require them
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            // i dont know what this does
            crossOrigin: true
        }).addTo(map);

        // input dom
        let coordInput = document.querySelector('#coordInput');

        // managing map click
        // function onMapClick(e) {
        //     // Extract latitude and longitude from the LatLng object
        //     const latitude = e.latlng.lat;
        //     const longitude = e.latlng.lng;

        //     // Join the coordinates as a comma-separated string
        //     const formattedCoords = latitude.toFixed(6) + ", " + longitude.toFixed(6);

        //     // Set the input value to the formatted coordinates
        //     coordInput.value = formattedCoords;

        //     // Update the map and pin marker with the clicked coordinates
        //     updateMapAndPin(latitude, longitude);

        //     // fetch data
        //     console.log(latitude);
        //     console.log(longitude);
        // }

        //map.on('click', onMapClick);

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
                //console.error("Invalid input format. Please enter coordinates in the format 'latitude, longitude'.");
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
            iconUrl: '../img/location-pin-svgrepo-com.svg',
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

        // function to pin location from input by roger bairoy
        document.addEventListener("DOMContentLoaded", function() {
            var typingTimer; // Timer identifier
            var doneTypingInterval = 1000; // Time in milliseconds (5 seconds)

            // Function to update the map marker based on input location
            function updateMap(location) {
                // Parse the location string to extract latitude and longitude
                var coordinates = location.split(',').map(function(coord) {
                    return parseFloat(coord.trim());
                });

                // Check if coordinates are valid
                if (coordinates.length === 2 && !isNaN(coordinates[0]) && !isNaN(coordinates[1])) {
                    var lat = coordinates[0];
                    var lng = coordinates[1];

                    // Remove existing marker if any
                    if (typeof marker !== 'undefined') {
                        map.removeLayer(marker);
                    }

                    // Create a new marker at the specified coordinates and add it to the map
                    marker = L.marker([lat, lng]).addTo(map);

                    // Set the map view to the marker's location
                    map.setView([lat, lng], 20); // Zoom level 12
                } else {
                    // Invalid coordinates
                    console.error('Invalid location format');
                }
            }

            // Event listener for location input field
            document.getElementById('coordInput').addEventListener('input', function() {
                clearTimeout(typingTimer);
                var location = this.value;
                typingTimer = setTimeout(function() {
                    // Update the map marker based on the input location after 5 seconds of inactivity
                    updateMap(location);
                }, doneTypingInterval);
            });
        });
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

    <!-- Script for the map for draft tab -->
    <script>
        // FORMS SIDE
        // Get references to the select elements
        // const neighbourhoodValue = document.getElementById('neighbourhood')
        const municipalitySelectDraft = document.getElementById('MunicipalityDraft');
        const barangaySelectDraft = document.getElementById('BarangayDraft');

        // Function to populate municipalities dropdown based on selected province
        function populateMunicipalitiesDraft(selectedProvince) {
            // Fetch municipalities based on the selected province
            fetch('modals/fetch/fetch_location-add.php?province=' + selectedProvince)
                .then(response => response.json())
                .then(data => {
                    // console.log(data); // Log the response data
                    // Rest of your code
                    var municipalitiesDropdownDraft = document.getElementById('MunicipalityDraft');
                    // Clear existing options ang add default value
                    municipalitiesDropdownDraft.innerHTML = '<option value="" disabled selected hidden class="colorize">Select One</option>';

                    // Add the fetched municipalities as options in the dropdown
                    data.forEach(municipality => {
                        var option = document.createElement('option');
                        option.value = municipality['municipality_id'];
                        option.text = municipality['municipality_name'];
                        municipalitiesDropdownDraft.appendChild(option);
                    });
                });
        }

        // Call the populateMunicipalitiesDraft function when the province dropdown value changes
        document.getElementById('ProvinceDraft').addEventListener('change', function() {
            var selectedProvinceDraft = document.getElementById('ProvinceDraft').value;
            populateMunicipalitiesDraft(selectedProvinceDraft);
        });

        // Call the populateMunicipalitiesDraft function initially to populate the municipalities dropdown based on the default selected province
        var selectedProvinceDraft = document.getElementById('ProvinceDraft').value;
        populateMunicipalitiesDraft(selectedProvinceDraft);

        // Call the populateBarangayDraft function initially to populate the municipalities dropdown based on the default selected municipality
        var selectedMunicipalityDraft = document.getElementById('MunicipalityDraft').value;
        populateBarangayDraft(selectedMunicipalityDraft);

        // Function to populate barangays dropdown based on selected municipality
        function populateBarangayDraft(selectedMunicipalityDraft) {
            // Fetch barangays based on the selected municipality
            fetch('modals/fetch/fetch_location-add.php?municipality=' + selectedMunicipalityDraft)
                .then(response => response.json())
                .then(data => {
                    // console.log(data); // Log the response data

                    var barangayDropdownDraft = document.getElementById('BarangayDraft');
                    barangayDropdownDraft.innerHTML = '<option value="" disabled selected hidden class="colorize">Select One</option>'; // Clear existing options

                    // Add the fetched barangays as options in the dropdown
                    data.forEach(barangay => {
                        var option = document.createElement('option');
                        option.value = barangay['barangay_id'];
                        option.text = barangay['barangay_name'];
                        barangayDropdownDraft.appendChild(option);
                    });
                });
        }

        // Call the populateBarangayDraft function when the municipality dropdown value changes
        // to automatically go to the coordinated of the municipality
        document.getElementById('MunicipalityDraft').addEventListener('change', function() {
            var selectedMunicipalityDraft = document.getElementById('MunicipalityDraft').value;
            populateBarangayDraft(selectedMunicipalityDraft);

            // Fetch coordinates for the selected municipality
            fetch('modals/fetch/fetch_location-add.php?pin_municipality=' + selectedMunicipalityDraft)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var coordinatesString = data[0]['municipality_coordinates'];
                        var coordinatesArray = coordinatesString.split(',').map(coord => parseFloat(coord.trim()));
                        // input dom
                        if (coordinatesArray.length === 2) {
                            var latitude = coordinatesArray[0];
                            var longitude = coordinatesArray[1];

                            // Update the map and pin marker with the selected coordinates
                            updateMapAndPinDraft(latitude, longitude);
                            // Set the map view to the marker's location
                            mapDraft.setView([latitude, longitude], 12); // Zoom level 12
                            // Update the coordinates input field with the selected municipality's coordinates
                            coordInputDraft.value = latitude.toFixed(6) + ', ' + longitude.toFixed(6);
                        }
                    }
                });
        });

        // Call the populateBarangayDraft function when the municipality dropdown value changes
        document.getElementById('MunicipalityDraft').addEventListener('change', function() {
            var selectedMunicipalityDraft = document.getElementById('MunicipalityDraft').value;
            populateBarangayDraft(selectedMunicipalityDraft);
        });

        // Define the bounds of your map
        const southWestDraft = L.latLng(5, 123.0); // Lower left corner of the bounds
        const northEastDraft = L.latLng(7, 127.0); // Upper right corner of the bounds
        const boundsDraft = L.latLngBounds(southWestDraft, northEastDraft);

        const mapDraft = L.map('mapDraft', {
            maxBounds: boundsDraft, // Restrict map panning to these bounds
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
        let markerDraft = null;

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
        }).addTo(mapDraft);

        // input dom
        let coordInputDraft = document.querySelector('#coordInputDraft');

        // managing map click
        // function onMapClickDraft(e) {
        //     // Extract latitude and longitude from the LatLng object
        //     const latitude = e.latlng.lat;
        //     const longitude = e.latlng.lng;

        //     // Join the coordinates as a comma-separated string
        //     const formattedCoords = latitude.toFixed(6) + ", " + longitude.toFixed(6);

        //     // Set the input value to the formatted coordinates
        //     coordInputDraft.value = formattedCoords;

        //     // Update the map and pin marker with the clicked coordinates
        //     updateMapAndPinDraft(latitude, longitude);

        //     // fetch data
        //     console.log(latitude);
        //     console.log(longitude);
        //     let details = fetchDataDraft(latitude, longitude)
        //         .then(details => {
        //             // set neighbourhood
        //             // neighbourhoodValueDraft.value = details.neighbourhood
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

        // mapDraft.on('click', onMapClickDraft);

        function updateMapAndPinDraft(latitude, longitude) {
            // Remove potential existing marker
            if (markerDraft) {
                mapDraft.removeLayer(markerDraft);
            }

            // Convert input coordinates to Leaflet LatLng object
            const latLng = L.latLng(latitude, longitude);

            // Create a new marker if coordinates are valid
            if (isValidLatLng(latLng)) {
                markerDraft = L.marker(latLng, {
                    icon: iconDraft // Use your preferred marker icon (e.g., redIcon)
                });

                // Add marker to the map
                markerDraft.addTo(mapDraft);

                // Center the map on the new marker
                // map.setView(latLng, map.getZoom()+1); // Adjust zoom level as needed
            } else {
                // console.error("Invalid coordinates entered. Please enter valid latitude and longitude values.");
            }
        }

        // Input handling function
        function handleInputChangeDraft() {
            const inputValue = coordInputDraft.value.trim(); // Trim leading/trailing whitespace

            // Ensure comma separation, handle different input formats
            const parts = inputValue.split(/\s*,\s*/);
            if (parts.length !== 2) {
                console.error("Invalid input format. Please enter coordinates in the format 'latitude, longitude'.");
                return;
            }

            const latitude = parseFloat(parts[0]);
            const longitude = parseFloat(parts[1]);

            updateMapAndPinDraft(latitude, longitude);
        }

        // Utility function to validate LatLng object
        function isValidLatLng(latLng) {
            return !isNaN(latLng.lat) && !isNaN(latLng.lng) && -90 <= latLng.lat <= 90 && -180 <= latLng.lng <= 180;
        }

        // Marker initialization (adjust icon as needed)
        const iconDraft = L.icon({
            iconUrl: '../img/location-pin-svgrepo-com.svg',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Event listener for input changes
        coordInputDraft.addEventListener('input', handleInputChangeDraft);

        // fetch data from openstreetmap nominatim
        function fetchDataDraft(lat, lng) {
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
            function updateMapDraft(locationDraft) {
                // Parse the location string to extract latitude and longitude
                var coordinates = locationDraft.split(',').map(function(coord) {
                    return parseFloat(coord.trim());
                });

                // Check if coordinates are valid
                if (coordinates.length === 2 && !isNaN(coordinates[0]) && !isNaN(coordinates[1])) {
                    var lat = coordinates[0];
                    var lng = coordinates[1];

                    // Remove existing marker if any
                    if (typeof marker !== 'undefined') {
                        mapDraft.removeLayer(markerDraft);
                    }

                    // Create a new marker at the specified coordinates and add it to the mapDraft
                    markerDraft = L.marker([lat, lng]).addTo(mapDraft);

                    // Set the mapDraft view to the marker's location
                    mapDraft.setView([lat, lng], 20); // Zoom level 12
                } else {
                    // Invalid coordinates
                    console.error('Invalid location format');
                }
            }

            // Event listener for location input field
            document.getElementById('coordInputDraft').addEventListener('input', function() {
                clearTimeout(typingTimer);
                var locationDraft = this.value;
                typingTimer = setTimeout(function() {
                    // Update the map marker based on the input location after 5 seconds of inactivity
                    updateMapDraft(locationDraft);
                }, doneTypingInterval);
            });
        });
    </script>

    <!-- Script for the map for view tab -->
    <script>
        // Define the bounds of your map
        const southWestView = L.latLng(5, 123.0); // Lower left corner of the bounds
        const northEastView = L.latLng(7, 127.0); // Upper right corner of the bounds
        const boundsView = L.latLngBounds(southWestView, northEastView);

        // Initialize the map with the bounds
        const mapView = L.map('mapView', {
            maxBounds: boundsView, // Restrict map panning to these bounds
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
        let markerView = null;

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
        }).addTo(mapView);

        // input dom
        let coordInputView = document.querySelector('#coordView');

        // managing map click
        // function onMapClickView(e) {
        //     // Extract latitude and longitude from the LatLng object
        //     const latitude = e.latlng.lat;
        //     const longitude = e.latlng.lng;

        //     // Join the coordinates as a comma-separated string
        //     const formattedCoords = latitude.toFixed(6) + ", " + longitude.toFixed(6);

        //     // Set the input value to the formatted coordinates
        //     coordInputView.value = formattedCoords;

        //     // Update the map and pin marker with the clicked coordinates
        //     updateMapAndPinView(latitude, longitude);

        //     // fetch data
        //     console.log(latitude);
        //     console.log(longitude);
        //     let details = fetchDataView(latitude, longitude)
        //         .then(details => {
        //             // set neighbourhood
        //             // neighbourhoodValueView.value = details.neighbourhood
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

        // mapView.on('click', onMapClickView);

        function updateMapAndPinView(latitude, longitude) {
            // Remove potential existing marker
            if (markerView) {
                mapView.removeLayer(markerView);
            }

            // Convert input coordinates to Leaflet LatLng object
            const latLng = L.latLng(latitude, longitude);

            // Create a new marker if coordinates are valid
            if (isValidLatLng(latLng)) {
                markerView = L.marker(latLng, {
                    icon: iconView // Use your preferred marker icon (e.g., redIcon)
                });

                // Add marker to the map
                markerView.addTo(mapView);

                // Center the map on the new marker
                // map.setView(latLng, map.getZoom()+1); // Adjust zoom level as needed
            } else {
                console.error("Invalid coordinates entered. Please enter valid latitude and longitude values.");
            }
        }

        // Input handling function
        function handleInputChangeView() {
            const inputValue = coordInputView.value.trim(); // Trim leading/trailing whitespace

            // Ensure comma separation, handle different input formats
            const parts = inputValue.split(/\s*,\s*/);
            if (parts.length !== 2) {
                console.error("Invalid input format. Please enter coordinates in the format 'latitude, longitude'.");
                return;
            }

            const latitude = parseFloat(parts[0]);
            const longitude = parseFloat(parts[1]);

            updateMapAndPinView(latitude, longitude);
        }

        // Utility function to validate LatLng object
        function isValidLatLng(latLng) {
            return !isNaN(latLng.lat) && !isNaN(latLng.lng) && -90 <= latLng.lat <= 90 && -180 <= latLng.lng <= 180;
        }

        // Marker initialization (adjust icon as needed)
        const iconView = L.icon({
            iconUrl: '../img/location-pin-svgrepo-com.svg',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Event listener for input changes
        coordInputView.addEventListener('input', handleInputChangeView);

        // fetch data from openstreetmap nominatim
        function fetchDataView(lat, lng) {
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
            function updateMapView(locationView) {
                // Parse the location string to extract latitude and longitude
                var coordinates = locationView.split(',').map(function(coord) {
                    return parseFloat(coord.trim());
                });

                // Check if coordinates are valid
                if (coordinates.length === 2 && !isNaN(coordinates[0]) && !isNaN(coordinates[1])) {
                    var lat = coordinates[0];
                    var lng = coordinates[1];

                    // Remove existing marker if any
                    if (typeof marker !== 'undefined') {
                        mapView.removeLayer(markerView);
                    }

                    // Create a new marker at the specified coordinates and add it to the mapView
                    markerView = L.marker([lat, lng]).addTo(mapView);

                    // Set the mapView view to the marker's location
                    mapView.setView([lat, lng], 20); // Zoom level 12
                } else {
                    // Invalid coordinates
                    console.error('Invalid location format');
                }
            }

            // Event listener for location input field
            document.getElementById('coordView').addEventListener('input', function() {
                clearTimeout(typingTimer);
                var locationView = this.value;
                typingTimer = setTimeout(function() {
                    // Update the map marker based on the input location after 5 seconds of inactivity
                    updateMapView(locationView);
                }, doneTypingInterval);
            });
        });
    </script>

    <!-- SCRIPT for the select datas for edit location tab -->
    <script>
        // FORMS SIDE
        // Get references to the select elements
        const neighborhoodValueEdit = document.getElementById('neighborhoodEdit');
        const municipalitySelectEdit = document.getElementById('MunicipalitySelect');
        const barangaySelectEdit = document.getElementById('BarangaySelect');

        let initialMunicipality = '';
        let initialBarangay = '';

        // Function to populate municipalities dropdown based on selected province
        // const populateMunicipalitiesEdit = async (selectedProvince, initialVal) => {
        //     try {
        //         const response = await fetch(`modals/fetch/fetch_location-edit.php?province=${selectedProvince}`);
        //         const data = await response.json();
        //         // console.log(data);

        //         const municipalitiesDropdown = document.getElementById('MunicipalitySelect');
        //         municipalitiesDropdown.innerHTML = '';

        //         data.forEach((municipality) => {
        //             const option = document.createElement('option');
        //             option.value = municipality;
        //             option.text = municipality;
        //             municipalitiesDropdown.appendChild(option);
        //         });

        //         // Set the initial value if available
        //         if (initialVal) {
        //             municipalitiesDropdown.value = initialVal;
        //         }

        //     } catch (error) {
        //         console.error('Error fetching municipalities:', error);
        //     }
        // };

        // Function to populate barangay dropdown based on selected municipality
        const populateBarangayEdit = async (selectedMunicipality, initialVal) => {
            // Check if a municipality is selected
            if (!selectedMunicipality) {
                return;
            }

            try {
                const response = await fetch(`modals/fetch/fetch_location-edit.php?municipality=${selectedMunicipality}`);
                const data = await response.json();
                // console.log(data);

                const barangayDropdown = document.getElementById('BarangaySelect');
                barangayDropdown.innerHTML = '';

                data.forEach((barangay) => {
                    const option = document.createElement('option');
                    option.value = barangay;
                    option.text = barangay;
                    barangayDropdown.appendChild(option);
                });

                // Set the initial value if available
                if (initialVal) {
                    barangayDropdown.value = initialVal;
                }

            } catch (error) {
                console.error('Error fetching barangays:', error);
            }
        };

        // Call the populateMunicipalities function when the province dropdown value changes
        document.getElementById('ProvinceEdit').addEventListener('change', function() {
            var selectedProvince = document.getElementById('ProvinceEdit').value;
            populateMunicipalitiesEdit(selectedProvince, initialMunicipality);
        });

        //! kanang automatic mag populate ang barangay biskang wala paka ni select og municipality
        // Call the populateBarangay function when the municipality dropdown value changes
        document.getElementById('MunicipalitySelect').addEventListener('change', function() {
            var selectedMunicipality = document.getElementById('MunicipalitySelect').value;
            populateBarangayEdit(selectedMunicipality, initialBarangay);
        });

        //Call the populateMunicipalities function initially to populate the municipalities dropdown based on the default selected province
        // var selectedProvince = document.getElementById('ProvinceEdit').value;
        // populateMunicipalitiesEdit(selectedProvince, initialMunicipality);

        // Call the populateBarangay function initially to populate the municipalities dropdown based on the default selected municipality
        var selectedMunicipality = document.getElementById('MunicipalitySelect').value;
        populateBarangayEdit(selectedMunicipality, initialBarangay);

        // Call the populateBarangay function when the municipality dropdown value changes
        // to automatically go to the coordinated of the municipality
        document.getElementById('MunicipalitySelect').addEventListener('change', function() {
            var selectedMunicipality = document.getElementById('MunicipalitySelect').value;
            populateBarangayEdit(selectedMunicipality, "");

            // Fetch coordinates for the selected municipality
            fetch('modals/fetch/fetch_location-edit.php?pin_municipality=' + selectedMunicipality)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var coordinatesString = data[0]['municipality_coordinates'];
                        var coordinatesArray = coordinatesString.split(',').map(coord => parseFloat(coord.trim()));

                        if (coordinatesArray.length === 2) {
                            var latitude = coordinatesArray[0];
                            var longitude = coordinatesArray[1];

                            // Update the map and pin marker with the selected coordinates
                            updateMapAndPinEdit(latitude, longitude);
                            // Set the map view to the marker's location
                            mapEdit.setView([latitude, longitude], 12); // Zoom level 12
                        }
                    }
                });
        });
    </script>
    <!-- allowing scrollspy in the modal -->
    <script>
        $(document).ready(function() {
            $('#edit-item-modal').on('shown.bs.modal', function() {
                $('[data-spy="scroll"]').scrollspy('refresh');
                console.log($('[data-spy="scroll"]').scrollspy());
            });
        });
    </script>
    <!-- MAP -->
    <script>

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