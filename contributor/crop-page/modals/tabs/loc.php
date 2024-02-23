<!-- leaflet required -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- STYLE -->
<style>
    #map {
        aspect-ratio: 1/1;
    }
</style>

<!-- HTML -->
<div class="fade show active tab-pane" id="loc-tab-pane" role="tabpanel" aria-labelledby="loc-tab" tabindex="0">

    <div class="row">

        <!-- form -->
        <div class="col-6">

            <!-- coordinates -->
            <label for="" class="form-label small-font mb-0">Coordinates</label>
            <input id="coordInput" type="text" class="form-control" aria-describedby="coords-help">
            <div id="coords-help" class="form-text" style="font-size: 0.6rem;">Seperate latitude and longitude with a comma ( , )</div>

            <!-- street -->
            <label for="" class="form-label small-font mb-0">Street</label>
            <input type="text" class="form-control">

            <!-- barangay -->
            <label for="" class="form-label small-font mb-0">Barangay</label>
            <select name="" id="" class="form-select">
                <option value=""></option>
                <option value="">Alegria</option>
                <option value="">Baluntay</option>
                <option value="">Bagacay</option>
                <option value="">Concepcion</option>
                <option value="">Datal Anggas</option>
                <option value="">Domolok</option>
                <option value="">Glanville</option>
                <option value="">Kawas</option>
                <option value="">Ladol</option>
                <option value="">Mabini</option>
                <option value="">Maribulan</option>
                <option value="">New Glamorgan</option>
                <option value="">Pag-asa</option>
                <option value="">Paraiso</option>
                <option value="">Poblacion</option>
                <option value="">Spring</option>
                <option value="">Tokawal</option>
            </select>

            <!-- Municipality -->
            <label for="" class="form-label small-font mb-0">Municipality</label>
            <select name="" id="" class="form-select">
                <option value=""></option>
                <option value="">Alabel</option>
                <option value="">Glan</option>
                <option value="">Kiamba</option>
                <option value="">Maasim</option>
                <option value="">Maitum</option>
                <option value="">Malapatan</option>
                <option value="">Malungon</option>
            </select>

            <!-- Province -->
            <label for="" class="form-label small-font mb-0">Province</label>
            <input type="text" class="form-control" value="Sarangani" readonly>
        </div>

        <!-- map -->
        <div id="map" class="col rounded">
        </div>
    </div>
</div>

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