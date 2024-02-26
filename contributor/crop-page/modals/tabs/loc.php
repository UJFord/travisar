<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<!-- STYLE -->
<style>
    #map {
        aspect-ratio: 1/1;
    }
</style>

<!-- LOCATION TAB -->
<div class="fade show active tab-pane" id="loc-tab-pane" role="tabpanel" aria-labelledby="loc-tab" tabindex="0">
    <div class="row">
        <!-- form -->
        <div class="col-6">

            <!-- Province dropdown -->
            <label for="Province" class="form-label small-font">Province <span style="color: red;">*</span></label>
            <select id="Province" name="province" class="form-select" readonly disabled >
                <?php
                // Fetch distinct province names from the location table
                $queryProvince = "SELECT DISTINCT province_name FROM location ORDER BY province_name ASC";
                $query_run = pg_query($conn, $queryProvince);

                $count = pg_num_rows($query_run);

                // If there is data, display distinct province names
                if ($count > 0) {
                    while ($row = pg_fetch_assoc($query_run)) {
                        $province_name = $row['province_name'];
                ?>
                        <option value="<?= $province_name; ?>"><?= $province_name; ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <!-- Municipality dropdown -->
            <label for="Municipality" class="form-label small-font">Municipality <span style="color: red;">*</span></label>
            <select id="Municipality" name="municipality" class="form-select">
            </select>

            <!-- barangay -->
            <label for="Barangay" class="form-label small-font mb-0">Barangay <span style="color: red;">*</span></label>
            <select id="Barangay" name="barangay" class="form-select mb-2">
            </select>

            <!-- street -->
            <label for="neighbourhood" class="form-label small-font mb-0">Neighbourhood</label>
            <input id="neighbourhood" type="text" class="form-control mb-2">


            <!-- coordinates -->
            <label for="coordInput" class="form-label small-font mb-0">Coordinates</label>
            <input id="coordInput" name="coordinates" type="text" class="form-control" aria-describedby="coords-help">
            <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Seperate latitude and longitude with a comma (latitude , longitude)</div>

        </div>
        <!-- map -->
        <div id="map" class="col border">
        </div>
    </div>
</div>

<!-- leaflet requirement -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- SCRIPT -->
<script>
    // FORMS SIDE
    // Get references to the select elements
    const neighbourhoodValue = document.getElementById('neighbourhood')
    const municipalitySelect = document.getElementById('municipality');
    const barangaySelect = document.getElementById('barangay');

    // Define barangays for each municipality
    // ! wala pud nako ni nagamit kay gi fetxh nako ang data sa lahi na file tung fetc_barangay.php
    const barangaysByMunicipality = {
        'Alabel': [
            'Alegria',
            'Bagacay',
            'Baluntay',
            'Datal Anggas',
            'Domolok',
            'Kawas',
            'Ladol',
            'Maribulan',
            'New Poblacion',
            'Old Poblacion',
            'Pag-Asa',
            'Pangasahan',
            'Spring',
            'Tokawal'
        ],
        'Glan': [
            'Bitoon',
            'Burias',
            'Calabanit',
            'Calpidong',
            'Congan',
            'Crossing Rubber',
            'Kaltuad',
            'Kapatan',
            'Laperian',
            'Poblacion',
            'Rio Del Pilar',
            'San Vicente',
            'Sangay',
            'Small Margus',
            'Sufatubo',
            'Tampuan'
        ],
        'Kiamba': [
            'Bagutong',
            'Bonglacio',
            'Kalemba',
            'Kalusukan',
            'Katubao',
            'Lun Masla',
            'Lun Padidu',
            'Mongayang',
            'Nalus',
            'Salakit',
            'Saloagan',
            'Sinawal',
            'Sufaat',
            'Tinoto',
            'Tuka',
            'Upo'
        ],
        'Maasim': [
            'Batulaki',
            'Budac',
            'Daliao',
            'Kamanga',
            'Kanalo',
            'Kinam',
            'Lomuyon',
            'Pangi',
            'Poblacion',
            'Nomoh',
            'Nalus',
            'Tuanadatu',
            'Tinoto'
        ],
        'Maitum': [
            'Bati-An',
            'Kalaong',
            'Kiayap',
            'Koronadal Proper',
            'Old Poblacion',
            'Pangi',
            'Poblacion',
            'Baguan',
            'New Poblacion',
            'Kalukbong',
            'New La Union',
            'Old La Union'
        ],
        'Malapatan': [
            'Alkikan',
            'Alsamin',
            'B\'laan ',
            'Crossing Rubber',
            'Datu Danwata',
            'Datu Dullen',
            'Katubao',
            'Lun Masla',
            'Lun Padidu',
            'Malkan',
            'Nomoh',
            'Poblacion',
            'Sapu Masla',
            'Sapu Padidu',
            'Sarapen',
            'Sufatubo',
            'Tuyan',
            'Kihan',
            'Tuban'
        ],
        'Malungon': [
            'Blao',
            'Datalbatong',
            'Kawayan',
            'Kinam',
            'Lun Padidu',
            'Mabini',
            'Malkan',
            'Maloloy-on',
            'Manansang',
            'Poblacion',
            'Patag',
            'San Felipe',
            'Sapu Masla',
            'Sarangani',
            'Tinagacan',
            'Upper Biangan',
            'Kihan'
        ]
    };

    // Function to populate municipalities dropdown based on selected province
    function populateMunicipalities(selectedProvince) {
        // Fetch municipalities based on the selected province
        fetch('http://localhost/travisar/contributor/crop-page/modals/fetch_municipalities.php?province=' + selectedProvince)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the response data
                // Rest of your code
                var municipalitiesDropdown = document.getElementById('Municipality');
                municipalitiesDropdown.innerHTML = ''; // Clear existing options

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
        fetch('http://localhost/travisar/contributor/crop-page/modals/fetch_barangay.php?municipality=' + selectedMunicipality)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the response data

                var barangayDropdown = document.getElementById('Barangay');
                barangayDropdown.innerHTML = ''; // Clear existing options

                // Add the fetched municipalities as options in the dropdown
                data.forEach(barangay => {
                    var option = document.createElement('option');
                    option.value = barangay;
                    option.text = barangay;
                    barangayDropdown.appendChild(option);
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

    // ! mao ni tung code nimo ford pero wala nako nagamit hahaha mb
    // Function to populate barangay dropdown based on selected municipality
    // function populateBarangays() {
    //     const selectedMunicipality = municipalitySelect.value;

    //     // If no municipality is selected, display all barangays
    //     if (selectedMunicipality === '' || selectedMunicipality === null) {
    //         let allBarangays = [];
    //         for (const municipality in barangaysByMunicipality) {
    //             allBarangays = allBarangays.concat(barangaysByMunicipality[municipality]);
    //         }

    //         // Remove duplicate barangay names
    //         const uniqueBarangays = [...new Set(allBarangays)];

    //         // Clear existing options
    //         barangaySelect.innerHTML = '<option id="brgy-blank-option" value="" class="form-select"></option>';
    //         // barangaySelect.value = "";

    //         // Populate with new options
    //         uniqueBarangays.forEach(barangay => {
    //             const option = document.createElement('option');
    //             option.textContent = barangay;
    //             option.value = barangay;
    //             barangaySelect.appendChild(option);
    //         });
    //     } else {
    //         // If a municipality is selected, display barangays for that municipality
    //         const barangays = barangaysByMunicipality[selectedMunicipality] || [];

    //         // Clear existing options
    //         barangaySelect.innerHTML = '<option id="brgy-blank-option" value="" class="form-select"></option>';
    //         // barangaySelect.value = "";

    //         // Populate with new options
    //         barangays.forEach(barangay => {
    //             const option = document.createElement('option');
    //             option.textContent = barangay;
    //             option.value = barangay;
    //             barangaySelect.appendChild(option);
    //         });
    //     }
    // }

    // Initial population of barangay dropdown
    // populateBarangays();

    // Event listener for change in municipality dropdown
    // municipalitySelect.addEventListener('change', populateBarangays);

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
        let details = fetchData(latitude, longitude)
            .then(details => {
                // set neighbourhood
                neighbourhoodValue.value = details.neighbourhood
                // set municipality
                municipalitySelect.value = details.town;
                // set barangay
                barangaySelect.value = details.village;


                console.log('Country:', details.country);
                console.log('State:', details.state);
                console.log('County:', details.county);
                console.log('City:', details.city);
                console.log('Town:', details.town);
                console.log('Borough:', details.borough);
                console.log('Village:', details.village);
                console.log('Suburb:', details.suburb);
                console.log('Neighbourhood:', details.neighbourhood);
                console.log('Settlement:', details.settlement);
                console.log('Major Streets:', details.majorStreets);
                console.log('Major and Minor Streets:', details.majorAndMinorStreets);
                console.log('Building:', details.building);

            });
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