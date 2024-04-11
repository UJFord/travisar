<!-- STYLE -->
<style>
    .image-upload-container {
        /* Adjust width and height as needed */
        /* border: 1px solid #ccc;
        border-radius: 5px; */
        cursor: pointer;
    }

    .preview-containerEdit {
        /* Adjust style of preview container */
        display: flex;
        /* flex-wrap: wrap; */
    }

    .img-thumbnail {
        /* Customize styling of preview images */
        max-width: 5rem;
        max-height: 5rem;
        aspect-ratio: 1/1;
    }

    /* hiding the scrollbar */
    #previewEdit {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }
</style>

<!-- GENERAL TAB -->
<div class="fade show active tab-pane" id="edit-gen-tab-pane" role="tabpanel" aria-labelledby="edit-gen-tab" tabindex="0">
    <!-- hidden data -->
    <!-- crop_id -->
    <input id="crop_id" type="hidden" name="crop_id" class="form-control">
    <!-- categoryID -->
    <input id="categoryID" type="hidden" name="categoryID" class="form-control">
    <!-- cultural_aspect_id -->
    <input id="cultural_aspect_id" type="hidden" name="cultural_aspect_id" class="form-control">
    <!-- current_crop_variety -->
    <input id="current_crop_variety" type="hidden" name="current_crop_variety" class="form-control">
    <!-- currentUniqueCode -->
    <input id="currentUniqueCode" type="hidden" name="currentUniqueCode" class="form-control">
    <!-- disease_resistanceID -->
    <input id="disease_resistanceID" type="hidden" name="disease_resistanceID" class="form-control">
    <!-- seed_traitsID -->
    <input id="seed_traitsID" type="hidden" name="seed_traitsID" class="form-control">
    <!-- utilization_culturalID -->
    <input id="utilization_culturalID" type="hidden" name="utilization_culturalID" class="form-control">
    <!-- abiotic_resistanceID -->
    <input id="abiotic_resistanceID" type="hidden" name="abiotic_resistanceID" class="form-control">
    <!-- abiotic_resistance_riceID -->
    <input id="abiotic_resistance_riceID" type="hidden" name="abiotic_resistance_riceID" class="form-control">
    <!-- vegetative_state_cornID -->
    <input id="vegetative_state_cornID" type="hidden" name="vegetative_state_cornID" class="form-control">
    <!-- abiotic_resistance_riceID -->
    <input id="abiotic_resistance_riceID" type="hidden" name="abiotic_resistance_riceID" class="form-control">
    <!-- reproductive_state_cornID -->
    <input id="reproductive_state_cornID" type="hidden" name="reproductive_state_cornID" class="form-control">
    <!-- pest_resistance_cornID -->
    <input id="pest_resistance_cornID" type="hidden" name="pest_resistance_cornID" class="form-control">

    <!-- Contributed, Unique Code, and Date Created -->
    <dv class="row mb-3">
        <!-- Contributed By -->
        <div class="col">
            <label class="form-label small-font">Contributed By:</label>
            <h6 name="first_name" id="firstName"></h6>
        </div>

        <!-- Unique Code -->
        <div class="col">
            <label class="form-label small-font">Unique Code:</label>
            <h6 name="unique_code" id="uniqueCode"></h6>
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

    <!-- variety name, meaning of name -->
    <div class="row mb-3">
        <!-- variety name -->
        <div class="col">
            <label for="crop_variety" class="form-label small-font">Variety Name<span style="color: red;">*</span></label>
            <input id="crop_variety" type="text" name="crop_variety" class="form-control" required>
        </div>

        <!-- Meaning of Name -->
        <div class="col">
            <label class="form-label small-font">Meaning of Name(if any)</label>
            <input type="text" id="nameMeaning" name="meaning_of_name" class="form-control">
        </div>
    </div>

    <!-- Seed image -->
    <div class="row mb-3">
        <label for="imageInputSeedEdit" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Seed</span>
        </label>
        <div class="d-flex flex-column image-upload-container col-6">
            <input type="hidden" name="current_image_seed" id="old_image_seed">
            <input class="mb-2 form-control form-control-sm" type="file" id="imageInputSeedEdit" accept="image/jpeg,image/png" name="crop_seed_image" single onchange="previewSeedImage()">
        </div>
        <div class="col preview-container custom-scrollbar overflow-scroll rounded  p-3 border d-flex justify-content-center align-items-center" id="previewSeedEdit"></div>
    </div>

    <!-- vegetative stage image -->
    <div class="row mb-3">
        <label for="imageInputVegetativeEdit" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Vegetative Stage</span>
        </label>
        <div class="col-6 d-flex flex-column image-upload-container">
            <input type="hidden" name="current_image_veg" id="old_image_veg">
            <input class="col-6 mb-2 form-control form-control-sm" type="file" id="imageInputVegetativeEdit" accept="image/jpeg,image/png" name="crop_vegetative_image" single onchange="previewVegetativeImageEdit()">
        </div>
        <div class="col preview-container custom-scrollbar overflow-scroll rounded p-3 border d-flex justify-content-center align-items-center" id="previewVegEdit"></div>
    </div>

    <!-- reproductive stage -->
    <div class="row mb-3">
        <label for="imageInputReproductiveEdit" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Reproductive Stage</span>
        </label>
        <div class="col-6 d-flex flex-column image-upload-container">
            <input type="hidden" name="current_image_rep" id="old_image_rep">
            <input class="mb-2 form-control form-control-sm" type="file" id="imageInputReproductiveEdit" accept="image/jpeg,image/png" name="crop_reproductive_image" single onchange="previewReproductiveImageEdit()">
        </div>
        <div class="col preview-container custom-scrollbar overflow-scroll rounded p-3 border d-flex justify-content-center align-items-center" id="previewReproductiveEdit"></div>
    </div>

    <!-- DESCRIPTION -->
    <div class="row mb-3">
        <div class="col">
            <label for="description" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="description" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div>
</div>

<!-- SCRIPT for add tab-->
<script defer>
    function previewSeedImageEdit() {
        const imageInputEdit = document.getElementById("imageInputSeedEdit");
        const previewContainerEdit = document.getElementById("previewSeedEdit");

        // Check if a file is selected
        if (imageInputEdit.files && imageInputEdit.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewImage = new Image();
                previewImage.src = e.target.result;
                previewImage.onload = function() {
                    previewContainerEdit.innerHTML = ""; // Clear previous content
                    previewContainerEdit.appendChild(previewImage);
                };
            };

            reader.readAsDataURL(imageInputEdit.files[0]);

            // show preview
            previewContainerEdit.classList.remove("d-none");
        } else {
            // Clear the preview container if no file is selected
            previewContainerEdit.innerHTML = "";
            // hide preview
            previewContainerEdit.classList.add("d-none");
        }
    }

    function previewVegetativeImageEdit() {
        const imageInputEdit = document.getElementById("imageInputVegetativeEdit");
        const previewContainerEdit = document.getElementById("previewVegEdit");

        // Check if a file is selected
        if (imageInputEdit.files && imageInputEdit.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewImage = new Image();
                previewImage.src = e.target.result;
                previewImage.onload = function() {
                    previewContainerEdit.innerHTML = ""; // Clear previous content
                    previewContainerEdit.appendChild(previewImage);
                };
            };

            reader.readAsDataURL(imageInputEdit.files[0]);

            // show preview
            previewContainerEdit.classList.remove("d-none");
        } else {
            // Clear the preview container if no file is selected
            previewContainerEdit.innerHTML = "";
            // hide preview
            previewContainerEdit.classList.add("d-none");
        }
    }

    function previewReproductiveImageEdit() {
        const imageInputEdit = document.getElementById("imageInputReproductiveEdit");
        const previewContainerEdit = document.getElementById("previewReproductiveEdit");

        // Check if a file is selected
        if (imageInputEdit.files && imageInputEdit.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewImage = new Image();
                previewImage.src = e.target.result;
                previewImage.onload = function() {
                    previewContainerEdit.innerHTML = ""; // Clear previous content
                    previewContainerEdit.appendChild(previewImage);
                };
            };

            reader.readAsDataURL(imageInputEdit.files[0]);

            // show preview
            previewContainerEdit.classList.remove("d-none");
        } else {
            // Clear the preview container if no file is selected
            previewContainerEdit.innerHTML = "";
            // hide preview
            previewContainerEdit.classList.add("d-none");
        }
    }
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