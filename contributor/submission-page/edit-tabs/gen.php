<!-- STYLE -->
<style>
    .image-upload-container {
        /* Adjust width and height as needed */
        /* border: 1px solid #ccc;
        border-radius: 5px; */
        cursor: pointer;
    }

    .preview-containerEdit {
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

    .img-thumbnail {
        /* Customize styling of preview images */
        max-width: 5rem;
        max-height: 5rem;
        aspect-ratio: 1/1;
    }

    /* step navigation icon colors */
    .lighter-color {
        color: #4e5663;
    }

    /* hiding the scrollbar */
    #previewEdit {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }

    #map {
        aspect-ratio: 1/1;
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

    .remove-imageEdit-seed {
        position: absolute;
        background: none;
        border: none;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }

    .remove-imageEdit-veg {
        position: absolute;
        background: none;
        border: none;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }

    .remove-imageEdit-repro {
        position: absolute;
        background: none;
        border: none;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }
</style>
<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<!-- GENERAL TAB -->
<div class="fade show active tab-pane" id="edit-gen-tab-pane" role="tabpanel" aria-labelledby="edit-gen-tab" tabindex="0">
    <!-- hidden data -->
    <div>
        <!-- common id's -->
        <!-- crop_id -->
        <input id="crop_id" type="hidden" name="crop_id" class="form-control">
        <!-- categoryID -->
        <input id="categoryID" type="hidden" name="categoryID" class="form-control">
        <!-- cultural_aspect_id -->
        <input id="cultural_aspect_id" type="hidden" name="cultural_aspect_id" class="form-control">
        <!-- current_crop_variety -->
        <input id="current_crop_variety" type="hidden" name="current_crop_variety" class="form-control">
        <!-- seed_traitsID -->
        <input id="seed_traitsID" type="hidden" name="seed_traitsID" class="form-control">
        <!-- utilization_culturalID -->
        <input id="utilization_culturalID" type="hidden" name="utilization_culturalID" class="form-control">
        <!-- statusID -->
        <input id="statusID" type="hidden" name="statusID" class="form-control">
        <!-- referencesID -->
        <input id="referencesID" type="hidden" name="referencesID" class="form-control">

        <!-- corn id's -->
        <!-- corn_traitsID -->
        <input id="corn_traitsID" type="hidden" name="corn_traitsID" class="form-control">
        <!-- vegetative_state_cornID -->
        <input id="vegetative_state_cornID" type="hidden" name="vegetative_state_cornID" class="form-control">
        <!-- reproductive_state_cornID -->
        <input id="reproductive_state_cornID" type="hidden" name="reproductive_state_cornID" class="form-control">
        <!-- corn_pest_otherID -->
        <input id="corn_pest_otherID" type="hidden" name="corn_pest_otherID" class="form-control">
        <!-- corn_abiotic_otherID -->
        <input id="corn_abiotic_otherID" type="hidden" name="corn_abiotic_otherID" class="form-control">

        <!-- rice id's -->
        <!-- rice_traitsID -->
        <input id="rice_traitsID" type="hidden" name="rice_traitsID" class="form-control">
        <!-- vegetative_state_riceID -->
        <input id="vegetative_state_riceID" type="hidden" name="vegetative_state_riceID" class="form-control">
        <!-- reproductive_state_riceID -->
        <input id="reproductive_state_riceID" type="hidden" name="reproductive_state_riceID" class="form-control">
        <!-- panicle_traits_riceID -->
        <input id="panicle_traits_riceID" type="hidden" name="panicle_traits_riceID" class="form-control">
        <!-- flag_leaf_traits_riceID -->
        <input id="flag_leaf_traits_riceID" type="hidden" name="flag_leaf_traits_riceID" class="form-control">
        <!-- sensory_traits_riceID -->
        <input id="sensory_traits_riceID" type="hidden" name="sensory_traits_riceID" class="form-control">
        <!-- rice_pest_otherID -->
        <input id="rice_pest_otherID" type="hidden" name="rice_pest_otherID" class="form-control">
        <!-- rice_abiotic_otherID -->
        <input id="rice_abiotic_otherID" type="hidden" name="rice_abiotic_otherID" class="form-control">

        <!-- root crop id's -->
        <!-- root_crop_traitsID -->
        <input id="root_crop_traitsID" type="hidden" name="root_crop_traitsID" class="form-control">
        <!-- vegetative_state_rootcropID -->
        <input id="vegetative_state_rootcropID" type="hidden" name="vegetative_state_rootcropID" class="form-control">
        <!-- rootcrop_traitsID -->
        <input id="rootcrop_traitsID" type="hidden" name="rootcrop_traitsID" class="form-control">
        <!-- rootcrop_pest_otherID -->
        <input id="rootcrop_pest_otherID" type="hidden" name="rootcrop_pest_otherID" class="form-control">
        <!-- rootcrop_abiotic_otherID -->
        <input id="rootcrop_abiotic_otherID" type="hidden" name="rootcrop_abiotic_otherID" class="form-control">
    </div>

    <h6 class="fw-semibold mt-4 mb-3">General Info</h6>
    <!-- variety name, meaning of name -->
    <div class="row mb-2">
        <!-- variety name -->
        <div class="col mb-2">
            <label for="crop_variety" class="form-label small-font">Variety Name<span style="color: red;">*</span></label>
            <input id="crop_variety" type="text" name="crop_variety" class="form-control">
        </div>

        <!-- Meaning of Name -->
        <div class="col mb-2">
            <label class="form-label small-font">Meaning of Name(if any)</label>
            <input type="text" id="nameMeaning" name="meaning_of_name" class="form-control">
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="row mb-5">
        <div class="col">
            <label for="description" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="description" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- IMAGES -->
    <h6 class="fw-semibold mt-4 mb-0">Images for Stages</h6>
    <!-- help -->
    <div id="coords-help" class="form-text mb-3" style="font-size: 0.7rem;">Hold <span class="fw-bold">ctrl</span> or <span class="fw-bold">shift</span> and click the images to upload multiple files</div>
    <!-- Seed image -->
    <div class="row mb-3">
        <label for="imageInputSeedEdit" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Seed</span>
        </label>
        <div class="d-flex flex-column image-upload-container col-6">
            <input type="hidden" name="current_image_seed" id="old_image_seed">
            <input class="mb-0 form-control form-control-sm" type="file" id="imageInputSeedEdit" accept="image/jpeg,image/png" name="crop_seed_image[]" multiple>
        </div>
        <div class="col preview-containerEdit custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex justify-content-center align-items-center" id="previewSeedEdit"></div>
    </div>

    <!-- vegetative stage image -->
    <div class="row mb-3">
        <label for="imageInputVegetativeEdit" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Vegetative Stage</span>
        </label>
        <div class="col-6 d-flex flex-column image-upload-container">
            <input type="hidden" name="current_image_veg" id="old_image_veg">
            <input class="col-6 mb-2 form-control form-control-sm" type="file" id="imageInputVegetativeEdit" accept="image/jpeg,image/png" name="crop_vegetative_image" multiple>
        </div>
        <div class="col preview-containerEdit custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex justify-content-center align-items-center" id="previewVegEdit"></div>
    </div>

    <!-- reproductive stage -->
    <div class="row mb-5">
        <label for="imageInputReproductiveEdit" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Reproductive Stage</span>
        </label>
        <div class="col-6 d-flex flex-column image-upload-container">
            <input type="hidden" name="current_image_rep" id="old_image_rep">
            <input class="mb-2 form-control form-control-sm" type="file" id="imageInputReproductiveEdit" accept="image/jpeg,image/png" name="crop_reproductive_image" multiple>
        </div>
        <div class="col preview-containerEdit custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex justify-content-center align-items-center" id="previewReproductiveEdit"></div>
    </div>

    <h6 class="fw-semibold mt-4 mb-3">Location</h6>
    <!-- location -->
    <div id="locationData" class="row mb-3">
        <!-- form -->
        <div class="col-6 location-Data">
            <input type="hidden" name="crop_location_id" id="crop_location_id">
            <!-- Province dropdown -->
            <label for="ProvinceEdit" class="form-label small-font">Province <span style="color: red;">*</span></label>
            <select id="ProvinceEdit" name="province" class="form-control mb-2">
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

            <!-- Municipality dropdown -->
            <label for="MunicipalitySelect" class="form-label small-font">Municipality <span style="color: red;">*</span></label>
            <select id="MunicipalitySelect" name="municipality" class="form-select mb-2">
                <?php
                // Fetch distinct municipality names from the location table
                $queryMunicipality = "SELECT DISTINCT municipality_name, municipality_id FROM municipality ORDER BY municipality_name ASC";
                $query_runMunicipality = pg_query($conn, $queryMunicipality);

                $count2 = pg_num_rows($query_runMunicipality);

                // If there is data, display distinct municipality names
                if ($count2 > 0) {

                    while ($row = pg_fetch_assoc($query_runMunicipality)) {
                        $municipality_name = $row['municipality_name'];
                        $municipality_id = $row['municipality_id'];
                ?>
                        <option value="<?= $municipality_id; ?>"><?= $municipality_name; ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <!-- barangay -->
            <label for="BarangaySelect" class="form-label small-font mb-0">Barangay <span style="color: red;">*</span></label>
            <select id="BarangaySelect" name="barangay" class="form-select mb-2">
            </select>

            <!-- Sitio -->
            <label for="SitioEdit" class="form-label small-font mb-0">Sitio</label>
            <input id="SitioEdit" name="sitio_name" type="text" class="form-control">
            </select>

            <!-- coordinates -->
            <label for="coordEdit" class="form-label small-font mb-0">Coordinates</label>
            <input id="coordEdit" name="coordinates" type="text" class="form-control" aria-describedby="coords-help">
            <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Separate latitude and longitude with a comma (latitude , longitude)</div>
            <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">The blue Marker is for the old/current location</div>
        </div>
        <!-- map -->
        <div id="mapEdit" class="col border">
        </div>
    </div>

    <!-- Contributed, Unique Code, and Date Created -->
    <dv class="row mb-3">
        <!-- Contributed By -->
        <div class="col">
            <label class="form-label small-font">Contributed By:</label>
            <h6 name="first_name" id="firstName"></h6>
        </div>

        <!-- Date created -->
        <div class="col">
            <label class="form-label small-font">Date Created:</label>
            <h6 name="input_date" id="input_dateEdit"></h6>
        </div>
    </dv>

    <!-- Categories, Other Category, and Category Variety -->
    <div class="row mb-3">
        <!-- Category -->
        <div class="col">
            <label class="form-label small-font">Category:</label>
            <h6 name="category_id" id="CategoryEdit"></h6>
        </div>

        <!-- other category name if exist -->
        <div class="col" id="otherCategoryInputEdit" style="display: none;">
            <label class="form-label small-font">Other Category Name:</label>
            <h6 name="other_category_name" id="otherCategoryEdit"></h6>
        </div>

        <!-- Category Variety -->
        <div class="col">
            <label class="form-label small-font">Category Variety:</label>
            <h6 name="category_variety_name" id="categoryVarietyEdit"></h6>
        </div>

        <!-- Terrain -->
        <div class="col">
            <label class="form-label small-font">Terrain:</label>
            <h6 name="terrain_id" id="categoryTerrainEdit"></h6>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open morphological tab" onclick="switchTab('edit-more')">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
</div>

<!-- SCRIPT for edit tab for the image-->
<script defer>
    const imageInputEditSeed = document.getElementById('imageInputSeedEdit');
    const imageInputEditVeg = document.getElementById('imageInputVegetativeEdit');
    const imageInputEditRepro = document.getElementById('imageInputReproductiveEdit');
    const previewContainerEdit = document.querySelector('.preview-containerEdit');
    let oldImageSeed = ''; // Variable to store the old image URL or filename
    let oldImageVeg = '';
    let oldImageRepro = '';

    // Function to fetch the old image when editing an item
    function fetchOldImageSeed(image) {
        oldImageSeed = image; // Store the old image URL or filename
    }
    // Function to fetch the old image when editing an item
    function fetchOldImageVeg(image) {
        oldImageVeg = image; // Store the old image URL or filename
    }
    // Function to fetch the old image when editing an item
    function fetchOldImageRepro(image) {
        oldImageRepro = image; // Store the old image URL or filename
    }

    function addOldImageFileSeed(oldImageFilename) {
        if (oldImageFilename && oldImageFilename.trim() !== '') {
            var dataTransfer = new DataTransfer();
            Array.from(imageInputEditSeed.files).forEach(function(file) {
                dataTransfer.items.add(file);
            });
            var oldImageFile = new File([null], oldImageFilename, {
                type: 'image/png'
            });
            dataTransfer.items.add(oldImageFile);
            imageInputEditSeed.files = dataTransfer.files;
        }
    }

    function addOldImageFileVeg(oldImageFilename) {
        if (oldImageFilename && oldImageFilename.trim() !== '') {
            var dataTransfer = new DataTransfer();
            Array.from(imageInputEditVeg.files).forEach(function(file) {
                dataTransfer.items.add(file);
            });
            var oldImageFile = new File([null], oldImageFilename, {
                type: 'image/png'
            });
            dataTransfer.items.add(oldImageFile);
            imageInputEditVeg.files = dataTransfer.files;
        }
    }

    function addOldImageFileRepro(oldImageFilename) {
        if (oldImageFilename && oldImageFilename.trim() !== '') {
            var dataTransfer = new DataTransfer();
            Array.from(imageInputEditRepro.files).forEach(function(file) {
                dataTransfer.items.add(file);
            });
            var oldImageFile = new File([null], oldImageFilename, {
                type: 'image/png'
            });
            dataTransfer.items.add(oldImageFile);
            imageInputEditRepro.files = dataTransfer.files;
        }
    }

    // Function to handle seed image input
    function handleSeedImageInput() {
        const imageInputEditSeed = document.getElementById('imageInputSeedEdit');
        const previewContainerEdit = document.getElementById('previewSeedEdit');

        var files = $(this)[0].files;
        $('#previewSeedEdit').empty();

        // Loop through the files and append them to the preview container
        $.each(files, function(i, file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewSeedEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-imageEdit-seed" data-index="' + i + '"><i class="fa-solid fa-xmark"></i></button></div>');
            }
            reader.readAsDataURL(file);
        });

        // If there's an old image, append it to the preview container and set the value of the hidden input field
        if (oldImageSeed) {
            var oldImageFilenames = oldImageSeed.split(',');
            oldImageFilenames.forEach(function(filename, index) {
                $('#previewSeedEdit').append('<div class="image-preview border rounded me-1 p-0"><img src="../crop-page/modals/img/' + filename.trim() + '" class="img-thumbnail"/><button class="remove-imageEdit-seed" data-index="' + (files.length + index) + '"><i class="fa-solid fa-xmark"></i></button></div>');

                // Add the old image file to the files array
                addOldImageFileSeed(filename.trim());
            });
        }

        console.log("Remaining images after change:", imageInputEditSeed.files);
        checkForContent();

        //* if you input multiple images and you added a wrong one you can delete it
        //* this code will remove the one you deleted from existing image array
        //* and the remaining images is transferred to another array and is considered as a new input
        $(document).off("click", ".remove-imageEdit-seed").on("click", ".remove-imageEdit-seed", function() {
            var index = $(this).data("index");
            console.log("Removing image at index:", index);

            var newFiles = Array.from(imageInputEditSeed.files).filter((_, i) => i !== index);
            var dataTransfer = new DataTransfer();
            newFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });

            // Update the input files and reset the indexes
            imageInputEditSeed.files = dataTransfer.files;
            $('#previewSeedEdit').empty();
            Array.from(imageInputEditSeed.files).forEach(function(file, index) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewSeedEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-imageEdit-seed" data-index="' + index + '"><i class="fa-solid fa-xmark"></i></button></div>');
                }
                reader.readAsDataURL(file);
            });

            console.log("New files array after removal:", imageInputEditSeed.files);
            checkForContent();
        });

        // Add event listener for the hidden.bs.modal event
        $('#add-item-modal, #edit-item-modal').on('hidden.bs.modal', function() {
            imageInputEditSeed.value = ''; // Reset file input
            $('#previewSeedEdit').empty(); // Clear preview container
            checkForContent();
        });
    }

    // Function to handle vegetative stage image input
    function handleVegetativeImageInput() {
        const imageInputEdit = document.getElementById('imageInputVegetativeEdit');
        const previewContainerEdit = document.getElementById('previewVegEdit');
        var files = $(this)[0].files;
        $('#previewVegEdit').empty();

        // Loop through the files and append them to the preview container
        $.each(files, function(i, file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewVegEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-imageEdit-veg" data-index="' + i + '"><i class="fa-solid fa-xmark"></i></button></div>');
            }
            reader.readAsDataURL(file);
        });

        // If there's an old image, append it to the preview container and set the value of the hidden input field
        if (oldImageVeg) {
            var oldImageFilenames = oldImageVeg.split(',');
            oldImageFilenames.forEach(function(filename, index) {
                $('#previewVegEdit').append('<div class="image-preview border rounded me-1 p-0"><img src="../crop-page/modals/img/' + filename.trim() + '" class="img-thumbnail"/><button class="remove-imageEdit-veg" data-index="' + (files.length + index) + '"><i class="fa-solid fa-xmark"></i></button></div>');

                // Add the old image file to the files array
                addOldImageFileVeg(filename.trim());
            });
        }

        console.log("Remaining images after change:", imageInputEdit.files);
        checkForContent();

        //* if you input multiple images and you added a wrong one you can delete it
        //* this code will remove the one you deleted from existing image array
        //* and the remaining images is transferred to another array and is considered as a new input
        $(document).off("click", ".remove-imageEdit-veg").on("click", ".remove-imageEdit-veg", function() {
            var index = $(this).data("index");
            console.log("Removing image at index:", index);

            var newFiles = Array.from(imageInputEdit.files).filter((_, i) => i !== index);
            var dataTransfer = new DataTransfer();
            newFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });

            // Update the input files and reset the indexes
            imageInputEdit.files = dataTransfer.files;
            $('#previewVegEdit').empty();
            Array.from(imageInputEdit.files).forEach(function(file, index) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewVegEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-imageEdit-veg" data-index="' + index + '"><i class="fa-solid fa-xmark"></i></button></div>');
                }
                reader.readAsDataURL(file);
            });

            console.log("New files array after removal:", imageInputEdit.files);
            checkForContent();

            // Add event listener for the hidden.bs.modal event
            $('#add-item-modal, #edit-item-modal').on('hidden.bs.modal', function() {
                imageInputEdit.value = ''; // Reset file input
                $('#previewVegEdit').empty(); // Clear preview container
                checkForContent();
            });
        });

    }

    // Function to handle reproductive stage image input
    function handleReproductiveImageInput() {
        const imageInputEdit = document.getElementById('imageInputReproductiveEdit');
        const previewContainerEdit = document.getElementById('previewReproductiveEdit');
        var files = $(this)[0].files;
        $('#previewReproductiveEdit').empty();

        // Loop through the files and append them to the preview container
        $.each(files, function(i, file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewReproductiveEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-imageEdit-repro" data-index="' + i + '"><i class="fa-solid fa-xmark"></i></button></div>');
            }
            reader.readAsDataURL(file);
        });

        // If there's an old image, append it to the preview container and set the value of the hidden input field
        if (oldImageRepro) {
            var oldImageFilenames = oldImageRepro.split(',');
            oldImageFilenames.forEach(function(filename, index) {
                $('#previewReproductiveEdit').append('<div class="image-preview border rounded me-1 p-0"><img src="../crop-page/modals/img/' + filename.trim() + '" class="img-thumbnail"/><button class="remove-imageEdit-repro" data-index="' + (files.length + index) + '"><i class="fa-solid fa-xmark"></i></button></div>');

                // Add the old image file to the files array
                addOldImageFileRepro(filename.trim());
            });
        }

        console.log("Remaining images after change:", imageInputEdit.files);
        checkForContent();

        //* if you input multiple images and you added a wrong one you can delete it
        //* this code will remove the one you deleted from existing image array
        //* and the remaining images is transferred to another array and is considered as a new input
        $(document).off("click", ".remove-imageEdit-repro").on("click", ".remove-imageEdit-repro", function() {
            var index = $(this).data("index");
            console.log("Removing image at index:", index);

            var newFiles = Array.from(imageInputEdit.files).filter((_, i) => i !== index);
            var dataTransfer = new DataTransfer();
            newFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });

            // Update the input files and reset the indexes
            imageInputEdit.files = dataTransfer.files;
            $('#previewReproductiveEdit').empty();
            Array.from(imageInputEdit.files).forEach(function(file, index) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewReproductiveEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-imageEdit-repro" data-index="' + index + '"><i class="fa-solid fa-xmark"></i></button></div>');
                }
                reader.readAsDataURL(file);
            });

            console.log("New files array after removal:", imageInputEdit.files);
            checkForContent();

            // Add event listener for the hidden.bs.modal event
            $('#add-item-modal, #edit-item-modal').on('hidden.bs.modal', function() {
                imageInputEdit.value = ''; // Reset file input
                $('#previewReproductiveEdit').empty(); // Clear preview container
                checkForContent();
            });
        });
    }

    $(document).ready(function() {
        // Call the correct function based on the image input change
        $('#imageInputSeedEdit').on("change", handleSeedImageInput);
        $('#imageInputVegetativeEdit').on("change", handleVegetativeImageInput);
        $('#imageInputReproductiveEdit').on("change", handleReproductiveImageInput);
    });

    // to show the border only when there a picture inside
    // const previewContainer = document.getElementById('previewContainer');
    function checkForContent() {
        if (previewContainerEdit.hasChildNodes()) {
            previewContainerEdit.classList.add('border');
        } else {
            previewContainerEdit.classList.remove('border');
        }
    }

    // Call initially on page load
    checkForContent();

    // Call whenever content might change within the container
    previewContainerEdit.addEventListener('DOMNodeInserted', checkForContent);
    previewContainerEdit.addEventListener('DOMNodeRemoved', checkForContent);
</script>


<!-- script for limiting the input for the crop variety name -->
<script>
    // Get the input element
    var inputElement = document.getElementById('crop_variety');

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
    document.getElementById('coordEdit').addEventListener('input', function(event) {
        const regex = /^[0-9.,\s]*$/;
        if (!regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(/[^0-9.,\s]/g, '');
        }
    });
</script>