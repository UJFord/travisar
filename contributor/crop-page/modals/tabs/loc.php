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
                    <input id="latitude" type="text" name="latitude" class="form-control">
                </div>
                <!-- longitude -->
                <div class="col-6">
                    <label for="longitude" class="form-label small-font">Longitude <span style="color: red;">*</span></label>
                    <input id="longitude" type="text" name="longitude" class="form-control">
                </div>
            </div>

            <!-- coordinates -->
            <label for="" class="form-label small-font mb-0">Coordinates</label>
            <input type="text" class="form-control" aria-describedby="coords-help">
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
    const map = L.map('map').setView([6.1536, 124.953086], 9); //starting position
    L.tileLayer(`https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`, { //style URL
        tileSize: 512,
        maxZoom: 16,
        zoomOffset: -1,
        minZoom: 9,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        crossOrigin: true
    }).addTo(map);
</script>

<!-- JavaScript for populating municipalities -->
<script>
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
</script>