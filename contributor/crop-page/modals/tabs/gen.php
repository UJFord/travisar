<!-- STYLE -->
<style>
    .image-upload-container {
        /* Adjust width and height as needed */
        /* border: 1px solid #ccc;
        border-radius: 5px; */
        cursor: pointer;
    }

    .preview-container {
        max-height: 10rem;
    }

    .remove-image {
        position: absolute;
        top: 0.3;
        right: 0.3rem;
        background: none;
        border: none;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }

    /* step navigation icon colors */
    .lighter-color {
        color: #4e5663;
    }

    /* hiding the scrollbar */
    .custom-scrollbar {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }
</style>

<!-- GENERAL TAB -->
<div class="fade show active tab-pane" id="gen-tab-pane" role="tabpanel" aria-labelledby="gen-tab" tabindex="0">
    <!-- Category and Crop Field -->
    <div class="row mb-4">
        <!-- Category Name -->
        <div class="col-6">
            <label for="Category" class="form-label small-font">Crop Category<span style="color: red;">*</span></label>
            <select name="category_id" id="Category" class="form-select" required>
                <?php
                // get the data of category from DB
                // gi set ra nako na permi last ang other nga category og ascending sya based sa catgory name
                $queryCategory = "SELECT * FROM category ORDER BY
                CASE
                    WHEN category_name = 'Other' THEN 2
                    ELSE 1
                END, category_name ASC";
                $query_run = pg_query($conn, $queryCategory);

                $count = pg_num_rows($query_run);

                // if count is greater than 0 there is data
                if ($count > 0) {
                    // loop for displaying all categories
                    while ($row = pg_fetch_assoc($query_run)) {
                        $category_id = $row['category_id'];
                        $category_name = $row['category_name'];
                ?>
                        <option value="<?= $category_id; ?>"><?= $category_name; ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </select>
        </div>

        <!-- Category Variety -->
        <div class="col" id="category-Variety">
            <label for="categoryVariety" class="form-label small-font">Variety<span style="color: red;">*</span></label>
            <select name="category_variety_id" id="categoryVariety" class="form-select" required>
                <!-- Options will be dynamically added here based on the category selected -->
            </select>
        </div>
    </div>

    <!-- variety name,  -->
    <div class="row mb-3">
        <!-- variety name -->
        <div class="col mb-2">
            <label for="Variety-Name" class="form-label small-font">Variety Name<span style="color: red;">*</span></label>
            <input id="Variety-Name" type="text" name="crop_variety" class="form-control" required pattern="[A-Za-z _-]+">
        </div>

        <!-- Meaning of Name -->
        <div class="col mb-2">
            <label class="form-label small-font">Meaning of Name(if any)</label>
            <input type="text" name="meaning_of_name" class="form-control">
        </div>
    </div>

    <!-- terrain -->
    <div class="row mb-3">
        <!-- terrain -->
        <div class="col-6">
            <label for="terrain" class="form-label small-font">Terrain<span style="color: red;">*</span></label>
            <select name="terrain_id" id="terrain" class="form-select" required>
                <?php
                // get the data of terrain from DB
                // gi set ra nako na permi last ang other nga terrain og ascending sya based sa catgory name
                $queryterrain = "SELECT * FROM terrain ORDER BY terrain_name ASC";
                $query_run = pg_query($conn, $queryterrain);

                $count = pg_num_rows($query_run);

                // if count is greater than 0 there is data
                if ($count > 0) {
                    // loop for displaying all categories
                    while ($row = pg_fetch_assoc($query_run)) {
                        $terrain_id = $row['terrain_id'];
                        $terrain_name = $row['terrain_name'];
                ?>
                        <option value="<?= $terrain_id; ?>"><?= $terrain_name; ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="row mb-4">
        <div class="col">
            <label for="desc" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="desc" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- Seed image -->
    <div class="row mb-3">
        <label for="imageInputSeed" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Seed</span>
        </label>
        <div class="d-flex flex-column image-upload-container col-6">
            <input class="mb-2 form-control form-control-sm" type="file" id="imageInputSeed" accept="image/jpeg,image/png" name="crop_seed_image" single onchange="previewSeedImage()">
        </div>
        <div class="col preview-container custom-scrollbar overflow-scroll rounded  p-3 border d-flex justify-content-center align-items-center d-none" id="previewSeed"></div>
    </div>

    <!-- vegetative stage image -->
    <div class="row mb-3">
        <label for="imageInputVegetative" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Vegetative Stage</span>
        </label>
        <div class="col-6 d-flex flex-column image-upload-container">
            <input class="col-6 mb-2 form-control form-control-sm" type="file" id="imageInputVegetative" accept="image/jpeg,image/png" name="crop_vegetative_image" single onchange="previewVegetativeImage()">
        </div>
        <div class="col preview-container custom-scrollbar overflow-scroll rounded p-3 border d-flex justify-content-center align-items-center d-none" id="previewVeg"></div>
    </div>

    <!-- reproductive stage -->
    <div class="row mb-3">
        <label for="imageInputReproductive" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Reproductive Stage</span>
        </label>
        <div class="col-6 d-flex flex-column image-upload-container">
            <input class="mb-2 form-control form-control-sm" type="file" id="imageInputReproductive" accept="image/jpeg,image/png" name="crop_reproductive_image" single onchange="previewReproductiveImage()">
        </div>
        <div class="col preview-container custom-scrollbar overflow-scroll rounded p-3 border d-flex justify-content-center align-items-center d-none" id="previewReproductive"></div>
    </div>

    <div id="locationData" class="row mb-3">
        <!-- form -->
        <div class="col-6 location-Data">
            <!-- Province dropdown -->
            <label for="Province" class="form-label small-font">Province <span style="color: red;">*</span></label>
            <select id="Province" name="province" class="form-select mb-2" readonly>
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
            <select id="Municipality" name="municipality" class="form-select mb-2" required>
            </select>

            <!-- barangay -->
            <label for="Barangay" class="form-label small-font mb-0">Sitio <span style="color: red;">*</span></label>
            <select id="Barangay" name="barangay" class="form-select mb-2" required>
            </select>

            <!-- coordinates -->
            <label for="coordInput" class="form-label small-font mb-0">Coordinates(if any)</label>
            <input id="coordInput" name="coordinates" type="text" class="form-control" aria-describedby="coords-help">
            <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Separate latitude and longitude with a comma (latitude , longitude)</div>

        </div>
        <!-- map -->
        <div id="map" class="col border">
        </div>
    </div>


    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('more')">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
</div>

<!-- SCRIPT for add tab-->
<script defer>
    function previewSeedImage() {
        const imageInput = document.getElementById("imageInputSeed");
        const previewContainer = document.getElementById("previewSeed");

        // Check if a file is selected
        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewImage = new Image();
                previewImage.src = e.target.result;
                previewImage.onload = function() {
                    previewContainer.innerHTML = ""; // Clear previous content
                    previewContainer.appendChild(previewImage);
                };
            };

            reader.readAsDataURL(imageInput.files[0]);

            // show preview
            previewContainer.classList.remove("d-none");
        } else {
            // Clear the preview container if no file is selected
            previewContainer.innerHTML = "";
            // hide preview
            previewContainer.classList.add("d-none");
        }
    }

    function previewVegetativeImage() {
        const imageInput = document.getElementById("imageInputVegetative");
        const previewContainer = document.getElementById("previewVeg");

        // Check if a file is selected
        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewImage = new Image();
                previewImage.src = e.target.result;
                previewImage.onload = function() {
                    previewContainer.innerHTML = ""; // Clear previous content
                    previewContainer.appendChild(previewImage);
                };
            };

            reader.readAsDataURL(imageInput.files[0]);

            // show preview
            previewContainer.classList.remove("d-none");
        } else {
            // Clear the preview container if no file is selected
            previewContainer.innerHTML = "";
            // hide preview
            previewContainer.classList.add("d-none");
        }
    }

    function previewReproductiveImage() {
        const imageInput = document.getElementById("imageInputReproductive");
        const previewContainer = document.getElementById("previewReproductive");

        // Check if a file is selected
        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewImage = new Image();
                previewImage.src = e.target.result;
                previewImage.onload = function() {
                    previewContainer.innerHTML = ""; // Clear previous content
                    previewContainer.appendChild(previewImage);
                };
            };

            reader.readAsDataURL(imageInput.files[0]);

            // show preview
            previewContainer.classList.remove("d-none");
        } else {
            // Clear the preview container if no file is selected
            previewContainer.innerHTML = "";
            // hide preview
            previewContainer.classList.add("d-none");
        }
    }
</script>

<!-- script for limiting the input for the crop variety name -->
<script>
    // Get the input element
    var inputElement = document.getElementById('Variety-Name');

    // Add an event listener for keypress event
    inputElement.addEventListener('keypress', function(e) {
        // Get the key code of the pressed key
        var keyCode = e.keyCode || e.which;

        // Allow letters (A-Z and a-z), spaces (32), underscores (95), and dashes (45)
        if (!(keyCode >= 65 && keyCode <= 90) && // A-Z
            !(keyCode >= 97 && keyCode <= 122) && // a-z
            keyCode !== 32 && // space
            keyCode !== 95 && // underscore
            keyCode !== 45 // dash
        ) {
            // Prevent default behavior if the key is not allowed
            e.preventDefault();
        }
    });
</script>

<!-- leaflet requirement -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<!-- script for limiting the input in coordinates just to numbers, commas, periods, and spaces -->
<script>
    document.getElementById('coordInput').addEventListener('input', function(event) {
        const regex = /^[0-9.,\s-]*$/; // Updated regex to allow "-" sign
        if (!regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(/[^0-9.,\s-]/g, '');
        }
    });
</script>