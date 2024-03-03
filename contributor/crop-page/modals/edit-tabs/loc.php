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
    <div class="row mb-3">
        <!-- form -->
        <div class="col-6">
            <input type="hidden" name="crop_location_id" id="crop_location_id">
            <!-- Province dropdown -->
            <label for="Province" class="form-label small-font">Province <span style="color: red;">*</span></label>
            <select id="ProvinceEdit" name="province" class="form-select mb-2">
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
            <label for="MunicipalitySelect" class="form-label small-font">Municipality <span style="color: red;">*</span></label>
            <select id="MunicipalitySelect" name="municipality" class="form-select mb-2">
            </select>

            <!-- barangay -->
            <label for="Barangay" class="form-label small-font mb-0">Barangay <span style="color: red;">*</span></label>
            <select id="BarangaySelect" name="barangay" class="form-select mb-2">
            </select>

            <!-- street -->
            <label for="neighborhoodEdit" class="form-label small-font mb-0">Neighborhood</label>
            <input id="neighborhoodEdit" name="neighborhood" type="text" class="form-control mb-2">

            <!-- coordinates -->
            <label for="coordInput" class="form-label small-font mb-0">Coordinates</label>
            <input id="coordInput" name="coordinates" type="text" class="form-control" aria-describedby="coords-help">
            <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Separate latitude and longitude with a comma (latitude , longitude)</div>
        </div>
        <!-- map -->
        <div id="map" class="col border">
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <!-- <div class="row">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open General Info tab" onclick="switchTab('gen',this)"><i class="fa-solid fa-backward"></i></button>
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Additional Info tab" onclick="switchTab('more',this)"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div> -->
</div>

<!-- leaflet requirement -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<!-- SCRIPT for location tab -->
<script>
    // FORMS SIDE
    // Get references to the select elements
    const neighborhoodValueEdit = document.getElementById('neighborhoodEdit');
    const municipalitySelectEdit = document.getElementById('MunicipalitySelect');
    const barangaySelectEdit = document.getElementById('BarangaySelect');

    let initialMunicipality = '';
    let initialBarangay = '';

    // Function to populate municipalities dropdown based on selected province
    const populateMunicipalitiesEdit = async (selectedProvince, initialVal) => {
        try {
            initialMunicipality = initialVal;
            const response = await fetch(`crop-page/modals/fetch/fetch_location-edit.php?province=${selectedProvince}`);
            const data = await response.json();
            // console.log(data);

            const municipalitiesDropdown = document.getElementById('MunicipalitySelect');
            municipalitiesDropdown.innerHTML = '';

            data.forEach((municipality) => {
                const option = document.createElement('option');
                option.value = municipality;
                option.text = municipality;
                municipalitiesDropdown.appendChild(option);
            });

            // Set the initial value if available
            if (initialMunicipality) {
                municipalitiesDropdown.value = initialMunicipality;
            }

        } catch (error) {
            console.error('Error fetching municipalities:', error);
        }
    };

    // Call the populateMunicipalities function when the province dropdown value changes
    document.getElementById('ProvinceEdit').addEventListener('change', function() {
        var selectedProvince = document.getElementById('ProvinceEdit').value;
        populateMunicipalitiesEdit(selectedProvince, initialMunicipality);
    });

    // Call the populateMunicipalities function initially to populate the municipalities dropdown based on the default selected province
    var selectedProvince = document.getElementById('ProvinceEdit').value;
    populateMunicipalitiesEdit(selectedProvince, initialMunicipality);

    // Function to populate barangay dropdown based on selected municipality
    const populateBarangayEdit = async (selectedMunicipality, initialVal) => {
        try {
            initialBarangay = initialVal;
            const response = await fetch(`crop-page/modals/fetch/fetch_location-edit.php?municipality=${selectedMunicipality}`);
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
            if (initialBarangay) {
                barangayDropdown.value = initialBarangay;
            }

        } catch (error) {
            console.error('Error fetching municipalities:', error);
        }

    };

    // Call the populateBarangay function when the municipality dropdown value changes
    document.getElementById('MunicipalitySelect').addEventListener('change', function() {
        var selectedMunicipality = document.getElementById('MunicipalitySelect').value;
        populateBarangayEdit(selectedMunicipality, initialBarangay);
    });

    // Call the populateBarangay function initially to populate the municipalities dropdown based on the default selected municipality
    var selectedMunicipality = document.getElementById('MunicipalitySelect').value;
    populateBarangayEdit(selectedMunicipality, initialBarangay);
</script>