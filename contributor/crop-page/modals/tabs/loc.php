<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<!-- STYLE -->
<style>
    #map {
        aspect-ratio: 1/1;
    }
</style>

<!-- LOCATION TAB -->
<div class="fade tab-pane" id="loc-tab-pane" role="tabpanel" aria-labelledby="loc-tab" tabindex="0">
    <div class="row">
        <!-- form -->
        <div class="col-6 border">
            <!-- Province dropdown -->
            <label for="Province" class="form-label small-font">Province <span style="color: red;">*</span></label>
            <select name="province" id="Province" class="form-select">
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

            <!-- latitude and longitude -->
            <div class="row">
                <!-- Latitude -->
                <div class="col-6">
                    <label for="latitude" class="form-label small-font">Latidue <span style="color: red;">*</span></label>
                    <input id="latitude" type="text" name="latitude" class="form-control" placeholder="Ex. 38.8951">
                </div>
                <!-- longitude -->
                <div class="col-6">
                    <label for="longitude" class="form-label small-font">Longitude <span style="color: red;">*</span></label>
                    <input id="longitude" type="text" name="longitude" class="form-control" placeholder="Ex. -77.0364">
                </div>
            </div>

            <!-- coordinates -->
            <label for="" class="form-label small-font mb-0">Coordinates</label>
            <input id="coordInput" type="text" class="form-control" aria-describedby="coords-help">
            <div id="coords-help" class="form-text" style="font-size: 0.6rem;">Seperate latitude and longitude with a comma ( , )</div>

            <!-- street -->
            <label for="" class="form-label small-font mb-0">Street</label>
            <input type="text" class="form-control">

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
        fetchData(latitude, longitude);
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
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Fetch response as text
            })
            .then(data => {
                console.log('Fetched data:', data);
                // Now you have the response data as text, you can parse it or process it further as needed
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

</script>