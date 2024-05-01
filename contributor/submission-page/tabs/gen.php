<!-- STYLE -->
<style>
    .image-upload-container {
        cursor: pointer;
    }

    .remove-image-seed {
        width: 1rem;
        aspect-ratio: 1/1;
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        border: none;
        border-bottom-left-radius: 0.3rem;
        -webkit-border-bottom-left-radius: 0.3rem;
        -moz-border-radius-bottomleft: 0.3rem;
        color: red;
        font-weight: bold;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.43);
        font-size: 0.8rem;
    }

    .remove-image-veg {
        width: 1rem;
        aspect-ratio: 1/1;
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        border: none;
        border-bottom-left-radius: 0.3rem;
        -webkit-border-bottom-left-radius: 0.3rem;
        -moz-border-radius-bottomleft: 0.3rem;
        color: red;
        font-weight: bold;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.43);
        font-size: 0.8rem;
    }

    .remove-image-repro {
        width: 1rem;
        aspect-ratio: 1/1;
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        border: none;
        border-bottom-left-radius: 0.3rem;
        -webkit-border-bottom-left-radius: 0.3rem;
        -moz-border-radius-bottomleft: 0.3rem;
        color: red;
        font-weight: bold;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.43);
        font-size: 0.8rem;
    }

    .remove-image-seed:hover {
        /* background: rgba(255, 255, 255, 0.79); */
        background: white;
    }

    .remove-image-veg:hover {
        /* background: rgba(255, 255, 255, 0.79); */
        background: white;
    }

    .remove-image-repro:hover {
        /* background: rgba(255, 255, 255, 0.79); */
        background: white;
    }

    .preview-container {
        max-height: 10rem;
    }

    /* hiding the scrollbar */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 0, 0, 0.5) rgba(0, 0, 0, 0);
        /* Firefox */
        -ms-overflow-style: none;
    }

    .preview-image-container {
        position: relative;
    }

    /* preview image */
    .preview-image {
        position: relative;
        /* Needed for absolute positioning of button */
        margin: 5px;
        /* Adjust spacing between images as needed */
    }

    .preview-image button {
        position: absolute;
        top: 0;
        right: 0;
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
        /* Adjust padding around button */
    }

    .preview-image button:hover {
        background-color: rgba(255, 0, 0, 0.2);
        /* Red hover effect */
    }

    .preview-image button:after {
        content: "\00d7";
        /* X character for close button */
        font-size: 18px;
        color: red;
    }

    /* step navigation icon colors */
    .lighter-color {
        color: #4e5663;
    }

    /* map */
    #map {
        aspect-ratio: 1/1;
    }
</style>
<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<!-- GENERAL TAB -->
<div class="fade show active tab-pane" id="gen-tab-pane" role="tabpanel" aria-labelledby="gen-tab" tabindex="0">
    <!-- Category and Crop Field -->
    <h6 class="fw-semibold mt-4 mb-3">General Information</h6>
    <div class="row mb-2">
        <!-- Category Name -->
        <div class="col-6">
            <label for="Category" class="form-label small-font">Crop Category<span class="text-danger ms-1">*</span></label>
            <select name="category_id" id="Category" class="form-select">
                <?php
                // get the data of category from DB
                $queryCategory = "SELECT * FROM category ORDER BY category_name ASC";
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
            <div id="category-error" class="invalid-feedback"></div>
        </div>

        <!-- Category Variety -->
        <div class="col" id="category-Variety">
            <label for="categoryVariety" class="form-label small-font">Variety<span class="text-danger ms-1">*</span></label>
            <select name="category_variety_id" id="categoryVariety" class="form-select color-default-child">
            </select>
            <div id="categoryVariety-error" class="invalid-feedback"></div>
        </div>
    </div>

    <!-- variety name,  -->
    <div class="row mb-2">
        <!-- variety name -->
        <div class="col mb-2">
            <label for="Variety-Name" class="form-label small-font">Local/Variety Name<span class="text-danger ms-1">*</span></label>
            <input id="Variety-Name" type="text" name="crop_variety" class="form-control">
            <div id="varietyName-error" class="invalid-feedback"></div>
        </div>

        <!-- Meaning of Name -->
        <div class="col mb-2">
            <label for="nameMean" class="form-label small-font">Meaning of Name (if any)</label>
            <input id="nameMean" type="text" name="meaning_of_name" class="form-control">
        </div>
    </div>

    <!-- terrain -->
    <div class="row mb-2">
        <!-- terrain -->
        <div class="col-6">
            <label for="terrain" class="form-label small-font">Terrain<span style="color: red;">*</span></label>
            <select name="terrain_id" id="terrain" class="form-select">
                <option value="" disabled selected hidden>Select One</option>
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
            <div id="terrain-error" class="invalid-feedback"></div>
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="row mb-5">
        <div class="col">
            <label for="desc" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="desc" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- IMAGES -->
    <h6 class="fw-semibold mt-4 mb-0">Images for Stages</h6>
    <!-- help -->
    <div id="coords-help" class="form-text mb-3" style="font-size: 0.7rem;">Hold <span class="fw-bold">ctrl</span> or <span class="fw-bold">shift</span> and click the images to upload multiple files</div>
    <!-- Seed image -->
    <div class="row mb-3">
        <label for="imageInputSeed" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Seed</span>
        </label>
        <div class="d-flex flex-column image-upload-container col-6">
            <input class="mb-0 form-control form-control-sm" name="crop_seed_image[]" type="file" id="imageInputSeed" accept="image/jpeg,image/png" onchange="previewImageSeed(this, 'previewSeed')" multiple>
        </div>
        <div class="col preview-container custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex d-none" id="previewSeed"></div>
    </div>

    <!-- Vegetative image -->
    <div class="row mb-3">
        <label for="imageInputVegetative" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Vegetative Stage</span>
        </label>
        <div class="col-6 d-flex flex-column image-upload-container">
            <input class="col-6 mb-0 form-control form-control-sm" name="crop_vegetative_image[]" type="file" id="imageInputVegetative" accept="image/jpeg,image/png" onchange="previewImageVeg(this, 'previewVeg')" multiple>
        </div>
        <div class="col preview-container custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex d-none" id="previewVeg"></div>
    </div>

    <!-- Reproductive image -->
    <div class="row mb-5">
        <label for="imageInputReproductive" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Reproductive Stage</span>
        </label>
        <div class="col-6 d-flex flex-column image-upload-container">
            <input class="mb-0 form-control form-control-sm" type="file" name="crop_reproductive_image[]" id="imageInputReproductive" accept="image/jpeg,image/png" onchange="previewImageRepro(this, 'previewReproductive')" multiple>
        </div>
        <div class="col preview-container custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex d-none" id="previewReproductive"></div>
    </div>

    <!-- MAP -->
    <h6 class="fw-semibold mt-4 mb-3">Location</h6>
    <div id="locationData" class="row mb-3">
        <!-- form -->
        <div class="col-6 location-Data">
            <!-- Province dropdown -->
            <label for="Province" class="form-label small-font">Province <span style="color: red;">*</span></label>
            <select id="Province" name="province" class="form-select mb-2" readonly>
                <?php
                // Fetch distinct province names from the location table
                $queryProvince = "SELECT DISTINCT province_name, province_id FROM province ORDER BY province_name ASC";
                $query_run = pg_query($conn, $queryProvince);

                $count = pg_num_rows($query_run);

                // If there is data, display distinct province names
                if ($count > 0) {
                    while ($row = pg_fetch_assoc($query_run)) {
                        $province_name = $row['province_name'];
                        $province_id = $row['province_id'];
                ?>
                        <option value="<?= $province_id; ?>"><?= $province_name; ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <div id="province-error" class="invalid-feedback"></div>

            <!-- Municipality dropdown -->
            <label for="Municipality" class="form-label small-font">Municipality <span style="color: red;">*</span></label>
            <select id="Municipality" name="municipality" class="form-select mb-2">
                <!-- option is automatically shown through js depending on the province -->
            </select>
            <div id="municipality-error" class="invalid-feedback"></div>

            <!-- barangay -->
            <label for="Barangay" class="form-label small-font mb-0">Barangay <span style="color: red;">*</span></label>
            <select id="Barangay" name="barangay" class="form-select mb-2">
                <option value="" disabled selected hidden>Select One</option>
                <!-- option is automatically shown through js depending on the municipality selected -->
            </select>
            <div id="barangay-error" class="invalid-feedback"></div>

            <!-- sitio -->
            <label for="Sitio" class="form-label small-font mb-0">Sitio</label>
            <input id="Sitio" name="sitio_name" type="text" class="form-control mb-2">

            <!-- coordinates -->
            <label for="coordInput" class="form-label small-font mb-0">Coordinates(if any)</label>
            <input id="coordInput" name="coordinates" type="text" class="form-control" aria-describedby="coords-help">
            <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Separate latitude and longitude with a comma (<span class="fw-bold">latitude , longitude - 5.7600, 125.3466</span>)</div>

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

<!-- map input -->
<!-- SCRIPT for add tab-->

<!-- IMAGE PREVIEW HANDLING -->
<script defer>
    function previewImageSeed(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = ""; // Clear previous previews

        const files = input.files;
        const selectedFiles = []; // Array to store selected files

        if (files.length > 0) {
            previewContainer.classList.remove("d-none"); // Show preview container
            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("preview-image-container");
                    previewContainer.appendChild(imgContainer);

                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail", "mb-2", "preview-image");
                    imgContainer.appendChild(img);

                    const deleteButton = document.createElement("button");
                    deleteButton.innerHTML = "<i class='fa-solid fa-xmark'></i>";
                    deleteButton.classList.add("remove-image-seed");
                    imgContainer.appendChild(deleteButton);

                    // Add selected file to the array
                    selectedFiles.push(files[i]);
                };
                reader.readAsDataURL(files[i]);
            }

            $(document).off("click", ".remove-image-seed").on("click", ".remove-image-seed", function() {
                var index = $(this).index(".remove-image-seed");
                var input = $('#imageInputSeed')[0];
                var newFiles = Array.from(input.files);
                newFiles.splice(index, 1);

                // Clear the preview container
                previewContainer.innerHTML = "";

                //* mao ni tung mag transfer sa data to another input
                var dataTransfer = new DataTransfer();
                // Preview the remaining images
                newFiles.forEach(function(file) {
                    dataTransfer.items.add(file);
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("preview-image-container");
                    previewContainer.appendChild(imgContainer);

                    const img = document.createElement("img");
                    img.src = URL.createObjectURL(file);
                    img.classList.add("img-thumbnail", "mb-2", "preview-image");
                    imgContainer.appendChild(img);

                    const deleteButton = document.createElement("button");
                    deleteButton.innerHTML = "<i class='fa-solid fa-xmark'></i>";
                    deleteButton.classList.add("remove-image-seed");
                    imgContainer.appendChild(deleteButton);
                });
                input.files = dataTransfer.files;

                // Remove only the clicked image and delete button
                $(this).prev("img").remove();
                $(this).remove();
            });
        } else {
            previewContainer.classList.add("d-none"); // Hide preview container if no files selected
        }
    }

    function previewImageVeg(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = ""; // Clear previous previews

        const files = input.files;
        const selectedFiles = []; // Array to store selected files

        if (files.length > 0) {
            previewContainer.classList.remove("d-none"); // Show preview container
            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("preview-image-container");
                    previewContainer.appendChild(imgContainer);

                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail", "mb-2", "preview-image");
                    imgContainer.appendChild(img);

                    const deleteButton = document.createElement("button");
                    deleteButton.innerHTML = "<i class='fa-solid fa-xmark'></i>";
                    deleteButton.classList.add("remove-image-veg");
                    imgContainer.appendChild(deleteButton);

                    // Add selected file to the array
                    selectedFiles.push(files[i]);
                };
                reader.readAsDataURL(files[i]);
            }

            $(document).off("click", ".remove-image-veg").on("click", ".remove-image-veg", function() {
                var index = $(this).index(".remove-image-veg");
                var input = $('#imageInputVegetative')[0];
                var newFiles = Array.from(input.files);
                newFiles.splice(index, 1);

                // Clear the preview container
                previewContainer.innerHTML = "";

                //* mao ni tung mag transfer sa data to another input
                var dataTransfer = new DataTransfer();
                // Preview the remaining images
                newFiles.forEach(function(file) {
                    dataTransfer.items.add(file);
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("preview-image-container");
                    previewContainer.appendChild(imgContainer);

                    const img = document.createElement("img");
                    img.src = URL.createObjectURL(file);
                    img.classList.add("img-thumbnail", "mb-2", "preview-image");
                    imgContainer.appendChild(img);

                    const deleteButton = document.createElement("button");
                    deleteButton.innerHTML = "<i class='fa-solid fa-xmark'></i>";
                    deleteButton.classList.add("remove-image-veg");
                    imgContainer.appendChild(deleteButton);
                });
                input.files = dataTransfer.files;

                // Remove only the clicked image and delete button
                $(this).prev("img").remove();
                $(this).remove();
            });
        } else {
            previewContainer.classList.add("d-none"); // Hide preview container if no files selected
        }
    }

    function previewImageRepro(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = ""; // Clear previous previews

        const files = input.files;
        const selectedFiles = []; // Array to store selected files

        if (files.length > 0) {
            previewContainer.classList.remove("d-none"); // Show preview container
            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("preview-image-container");
                    previewContainer.appendChild(imgContainer);

                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail", "mb-2", "preview-image");
                    imgContainer.appendChild(img);

                    const deleteButton = document.createElement("button");
                    deleteButton.innerHTML = "<i class='fa-solid fa-xmark'></i>";
                    deleteButton.classList.add("remove-image-repro");
                    imgContainer.appendChild(deleteButton);

                    // Add selected file to the array
                    selectedFiles.push(files[i]);
                };
                reader.readAsDataURL(files[i]);
            }

            $(document).off("click", ".remove-image-repro").on("click", ".remove-image-repro", function() {
                var index = $(this).index(".remove-image-repro");
                var input = $('#imageInputReproductive')[0];
                var newFiles = Array.from(input.files);
                newFiles.splice(index, 1);

                // Clear the preview container
                previewContainer.innerHTML = "";

                //* mao ni tung mag transfer sa data to another input
                var dataTransfer = new DataTransfer();
                // Preview the remaining images
                newFiles.forEach(function(file) {
                    dataTransfer.items.add(file);
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("preview-image-container");
                    previewContainer.appendChild(imgContainer);

                    const img = document.createElement("img");
                    img.src = URL.createObjectURL(file);
                    img.classList.add("img-thumbnail", "mb-2", "preview-image");
                    imgContainer.appendChild(img);

                    const deleteButton = document.createElement("button");
                    deleteButton.innerHTML = "<i class='fa-solid fa-xmark'></i>";
                    deleteButton.classList.add("remove-image-repro");
                    imgContainer.appendChild(deleteButton);
                });
                input.files = dataTransfer.files;

                // Remove only the clicked image and delete button
                $(this).prev("img").remove();
                $(this).remove();
            });
        } else {
            previewContainer.classList.add("d-none"); // Hide preview container if no files selected
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

<!-- MAP -->
<script>

</script>