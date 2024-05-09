<!-- STYLE -->
<style>
    .image-upload-container {
        /* Adjust width and height as needed */
        /* border: 1px solid #ccc;
        border-radius: 5px; */
        cursor: pointer;
    }

    .preview-containerView {
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
    #previewView {
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

    .remove-imageView {
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
<div class="fade show active tab-pane" id="view-gen-tab-pane" role="tabpanel" aria-labelledby="view-gen-tab" tabindex="0">
    <!-- hidden data -->
    <div>
        <!-- common id's -->
        <!-- crop_id -->
        <input id="crop_idView" type="hidden" name="crop_id" class="form-control">
        <!-- categoryID -->
        <input id="categoryIDView" type="hidden" name="categoryID" class="form-control">
        <!-- cultural_aspect_id -->
        <input id="cultural_aspect_idView" type="hidden" name="cultural_aspect_id" class="form-control">
        <!-- current_crop_variety -->
        <input id="current_crop_varietyView" type="hidden" name="current_crop_variety" class="form-control">
        <!-- currentUniqueCode -->
        <input id="currentUniqueCodeView" type="hidden" name="currentUniqueCode" class="form-control">
        <!-- disease_resistanceID -->
        <input id="disease_resistanceIDView" type="hidden" name="disease_resistanceID" class="form-control">
        <!-- seed_traitsID -->
        <input id="seed_traitsIDView" type="hidden" name="seed_traitsID" class="form-control">
        <!-- utilization_culturalID -->
        <input id="utilization_culturalIDView" type="hidden" name="utilization_culturalID" class="form-control">
        <!-- abiotic_resistanceID -->
        <input id="abiotic_resistanceIDView" type="hidden" name="abiotic_resistanceID" class="form-control">

        <!-- corn id's -->
        <!-- vegetative_state_cornID -->
        <input id="vegetative_state_cornIDView" type="hidden" name="vegetative_state_cornID" class="form-control">
        <!-- reproductive_state_cornID -->
        <input id="reproductive_state_cornIDView" type="hidden" name="reproductive_state_cornID" class="form-control">
        <!-- pest_resistance_cornID -->
        <input id="pest_resistance_cornIDView" type="hidden" name="pest_resistance_cornID" class="form-control">

        <!-- rice id's -->
        <!-- abiotic_resistance_riceID -->
        <input id="abiotic_resistance_riceIDView" type="hidden" name="abiotic_resistance_riceID" class="form-control">
        <!-- pest_resistance_riceID -->
        <input id="pest_resistance_riceIDView" type="hidden" name="pest_resistance_riceID" class="form-control">
        <!-- vegetative_state_riceID -->
        <input id="vegetative_state_riceIDView" type="hidden" name="vegetative_state_riceID" class="form-control">
        <!-- reproductive_state_riceID -->
        <input id="reproductive_state_riceIDView" type="hidden" name="reproductive_state_riceID" class="form-control">
        <!-- panicle_traits_riceID -->
        <input id="panicle_traits_riceIDView" type="hidden" name="panicle_traits_riceID" class="form-control">
        <!-- flag_leaf_traits_riceID -->
        <input id="flag_leaf_traits_riceIDView" type="hidden" name="flag_leaf_traits_riceID" class="form-control">
        <!-- sensory_traits_riceID -->
        <input id="sensory_traits_riceIDView" type="hidden" name="sensory_traits_riceID" class="form-control">

        <!-- root crop id's -->
        <!-- vegetative_state_rootcropID -->
        <input id="vegetative_state_rootcropIDView" type="hidden" name="vegetative_state_rootcropView" class="form-control">
        <!-- pest_resistance_rootcropID -->
        <input id="pest_resistance_rootcropIDView" type="hidden" name="pest_resistance_rootcropID" class="form-control">
        <!-- rootcrop_traitsID -->
        <input id="rootcrop_traitsIDView" type="hidden" name="rootcrop_traitsID" class="form-control">
    </div>

    <h6 class="fw-semibold mt-4 mb-3">General Info</h6>
    <!-- Contributed, Unique Code, and Date Created -->
    <dv class="row mb-3">
        <!-- Contributed By -->
        <div class="col-3">
            <label class="form-label">Contributed By:</label>
            <h6 class="small-font" name="first_name" id="firstNameView"></h6>
        </div>

        <!-- Date created -->
        <div class="col-3">
            <label class="form-label">Date Created:</label>
            <h6 class="small-font" name="input_date" id="input_dateView"></h6>
        </div>
    </dv>

    <!-- Categories, Other Category, and Category Variety -->
    <div class="row mb-3">
        <!-- Category -->
        <div class="col">
            <label class="form-label">Category:</label>
            <h6 class="small-font" name="category_id" id="CategoryView"></h6>
        </div>

        <!-- other category name if exist -->
        <div class="col" id="otherCategoryInputView" style="display: none;">
            <label class="form-label">Other Category Name:</label>
            <h6 class="small-font" name="other_category_name" id="otherCategoryView"></h6>
        </div>

        <!-- Category Variety -->
        <div class="col">
            <label class="form-label">Category Variety:</label>
            <h6 class="small-font" name="category_variety_name" id="categoryVarietyView"></h6>
        </div>

        <!-- Terrain -->
        <div class="col">
            <label class="form-label">Terrain:</label>
            <h6 class="small-font" name="terrain_id" id="categoryTerrainView"></h6>
        </div>
    </div>

    <!-- variety name, meaning of name -->
    <div class="row mb-2">
        <!-- variety name -->
        <div class="col mb-2">
            <label for="crop_varietyView" class="form-label">Variety Name:</label>
            <h6 class="small-font" name="crop_variety" id="crop_varietyView"></h6>
        </div>

        <!-- Meaning of Name -->
        <div class="col mb-2">
            <label class="form-label">Meaning of Name(if any):</label>
            <h6 class="small-font" name="meaning_of_name" id="nameMeaningView"></h6>
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="row mb-5">
        <div class="col">
            <label for="descriptionView" class="form-label">Description:</label>
            <h6 class="small-font" name="crop_description" id="descriptionView"></h6>
        </div>
    </div>

    <!-- IMAGES -->
    <h6 class="fw-semibold mt-4 mb-3">Images for Stages</h6>
    <!-- Seed image -->
    <div class="row mb-3">
        <label for="imageInputSeedView" class="d-flex align-items-center rounded mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Seed</span>
        </label>
        <div class="col preview-containerView custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex justify-content-center align-items-center" id="previewSeedView"></div>
    </div>

    <!-- vegetative stage image -->
    <div class="row mb-3">
        <label for="imageInputVegetativeView" class="d-flex align-items-center rounded mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Vegetative Stage</span>
        </label>
        <div class="col preview-containerView custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex justify-content-center align-items-center" id="previewVegView"></div>
    </div>

    <!-- reproductive stage -->
    <div class="row mb-5">
        <label for="imageInputReproductiveView" class="d-flex align-items-center rounded mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Reproductive Stage</span>
        </label>
        <div class="col preview-containerView custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex justify-content-center align-items-center" id="previewReproductiveView"></div>
    </div>

    <h6 class="fw-semibold mt-4 mb-3">Location</h6>
    <!-- location -->
    <div id="locationData" class="row mb-3">
        <!-- form -->
        <div class="col-4 location-Data">
            <input type="hidden" name="crop_location_id" id="crop_location_id">
            <!-- Province dropdown -->
            <label for="ProvinceView" class="form-label">Province: </label>
            <h6 class="small-font" name="province" id="ProvinceView" class="mb-3"></h6>

            <!-- Municipality dropdown -->
            <label for="MunicipalitySelectView" class="form-label">Municipality: </label>
            <h6 class="small-font" name="municipality" id="MunicipalitySelectView" class="mb-3"></h6>

            <!-- barangay -->
            <label for="BarangaySelectView" class="form-label mb-0">Barangay: </label>
            <h6 class="small-font" name="barangay" id="BarangaySelectView" class="mb-3"></h6>

            <!-- Sitio -->
            <label for="SitioView" class="form-label mb-0">Sitio: </label>
            <h6 class="small-font" name="sitio" id="SitioView" class="mb-3"></h6>

            <!-- coordinates -->
            <label for="coordView" class="form-label mb-0">Coordinates: </label>
            <h6 class="small-font" name="coordinates" id="coordView"></h6>
        </div>
        <!-- map -->
        <div id="mapView" class="col rounded">
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open morphological tab" onclick="switchTab('view-more')">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
</div>


<!-- script for limiting the input for the crop variety name -->
<script>
    // Get the input element
    var inputElement = document.getElementById('crop_varietyView');

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
    document.getElementById('coordView').addEventListener('input', function(event) {
        const regex = /^[0-9.,\s]*$/;
        if (!regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(/[^0-9.,\s]/g, '');
        }
    });
</script>