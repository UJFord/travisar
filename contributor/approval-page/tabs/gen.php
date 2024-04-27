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

    .remove-imageEdit {
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

        <!-- corn id's -->
        <!-- vegetative_state_cornID -->
        <input id="vegetative_state_cornID" type="hidden" name="vegetative_state_cornID" class="form-control">
        <!-- reproductive_state_cornID -->
        <input id="reproductive_state_cornID" type="hidden" name="reproductive_state_cornID" class="form-control">
        <!-- pest_resistance_cornID -->
        <input id="pest_resistance_cornID" type="hidden" name="pest_resistance_cornID" class="form-control">

        <!-- rice id's -->
        <!-- abiotic_resistance_riceID -->
        <input id="abiotic_resistance_riceID" type="hidden" name="abiotic_resistance_riceID" class="form-control">
        <!-- pest_resistance_riceID -->
        <input id="pest_resistance_riceID" type="hidden" name="pest_resistance_riceID" class="form-control">
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

        <!-- root crop id's -->
        <!-- vegetative_state_rootcropID -->
        <input id="vegetative_state_rootcropID" type="hidden" name="vegetative_state_rootcropID" class="form-control">
        <!-- pest_resistance_rootcropID -->
        <input id="pest_resistance_rootcropID" type="hidden" name="pest_resistance_rootcropID" class="form-control">
        <!-- rootcrop_traitsID -->
        <input id="rootcrop_traitsID" type="hidden" name="rootcrop_traitsID" class="form-control">
    </div>

    <h6 class="fw-semibold mt-4 mb-3">General Info</h6>
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

    <!-- variety name, meaning of name -->
    <div class="row mb-2">
        <!-- variety name -->
        <div class="col mb-2">
            <label for="crop_variety" class="form-label small-font">Variety Name:</label>
            <h6 name="crop_variety" id="crop_variety"></h6>
        </div>

        <!-- Meaning of Name -->
        <div class="col mb-2">
            <label class="form-label small-font">Meaning of Name(if any):</label>
            <h6 name="meaning_of_name" id="nameMeaning"></h6>
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="row mb-5">
        <div class="col">
            <label for="description" class="form-label small-font">Description:</label>
            <h6 name="crop_description" id="description"></h6>
        </div>
    </div>

    <!-- IMAGES -->
    <h6 class="fw-semibold mt-4 mb-3">Images for Stages</h6>
    <!-- Seed image -->
    <div class="row mb-3">
        <label for="imageInputSeedEdit" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Seed</span>
        </label>
        <div class="col preview-containerEdit custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex justify-content-center align-items-center" id="previewSeedEdit"></div>
    </div>

    <!-- vegetative stage image -->
    <!-- <div class="row mb-3">
        <label for="imageInputVegetativeEdit" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Vegetative Stage</span>
        </label>
        <div class="col preview-containerEdit custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex justify-content-center align-items-center" id="previewVegEdit"></div>
    </div> -->

    <!-- reproductive stage -->
    <!-- <div class="row mb-5">
        <label for="imageInputReproductiveEdit" class="d-flex align-items-center rounded small-font mb-2">
            <i class="fa-solid fa-image me-2"></i>
            <span>Reproductive Stage</span>
        </label>
        <div class="col preview-containerEdit custom-scrollbar overflow-x-auto overflow-y-hidden rounded ps-1 py-1 border d-flex justify-content-center align-items-center" id="previewReproductiveEdit"></div>
    </div> -->

    <h6 class="fw-semibold mt-4 mb-3">Location</h6>
    <!-- location -->
    <div id="locationData" class="row mb-3">
        <!-- form -->
        <div class="col-6 location-Data">
            <input type="hidden" name="crop_location_id" id="crop_location_id">
            <!-- Province dropdown -->
            <label for="ProvinceEdit" class="form-label small-font">Province: </label>
            <h6 name="province" id="ProvinceEdit" class="mb-3"></h6>

            <!-- Municipality dropdown -->
            <label for="MunicipalitySelect" class="form-label small-font">Municipality: </label>
            <h6 name="municipality" id="MunicipalitySelect" class="mb-3"></h6>

            <!-- barangay -->
            <label for="BarangaySelect" class="form-label small-font mb-0">Barangay: </label>
            <h6 name="barangay" id="BarangaySelect" class="mb-3"></h6>

            <!-- Sitio -->
            <label for="SitioEdit" class="form-label small-font mb-0">Sitio: </label>
            <h6 name="sitio" id="SitioEdit" class="mb-3"></h6>

            <!-- coordinates -->
            <label for="coordEdit" class="form-label small-font mb-0">Coordinates: </label>
            <h6 name="coordinates" id="coordEdit"></h6>
        </div>
        <!-- map -->
        <div id="mapEdit" class="col border">
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
    // handling to show all image inputs
    const imageInputEdit = document.getElementById('imageInputSeedEdit');
    const previewContainerEdit = document.querySelector('.preview-containerEdit');
    let oldImage = ''; // Variable to store the old image URL or filename

    // Function to fetch the old image when editing an item
    function fetchOldImage(image) {
        oldImage = image; // Store the old image URL or filename
    }

    function addOldImageFile(oldImageFilename) {
        if (oldImageFilename && oldImageFilename.trim() !== '') {
            var dataTransfer = new DataTransfer();
            Array.from(imageInputEdit.files).forEach(function(file) {
                dataTransfer.items.add(file);
            });
            var oldImageFile = new File([null], oldImageFilename, {
                type: 'image/png'
            });
            dataTransfer.items.add(oldImageFile);
            imageInputEdit.files = dataTransfer.files;
        }
    }

    // function to display and remove the image selected
    $(document).ready(function() {
        $('input[type="file"]').on("change", function() {
            var files = $(this)[0].files;
            $('#previewSeedEdit').empty();

            // Loop through the files and append them to the preview container
            $.each(files, function(i, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewSeedEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-imageEdit" data-index="' + i + '"><i class="fa-solid fa-xmark"></i></button></div>');
                }
                reader.readAsDataURL(file);
            });

            // If there's an old image, append it to the preview container and set the value of the hidden input field
            if (oldImage) {
                var oldImageFilenames = oldImage.split(',');
                oldImageFilenames.forEach(function(filename, index) {
                    $('#previewSeedEdit').append('<div class="image-preview border rounded me-1 p-0"><img src="../crop-page/modals/img/' + filename.trim() + '" class="img-thumbnail"/><button class="remove-imageEdit" data-index="' + (files.length + index) + '"><i class="fa-solid fa-xmark"></i></button></div>');

                    // Add the old image file to the files array
                    addOldImageFile(filename.trim());
                });
            }

            console.log("Remaining images after change:", imageInputEdit.files);
            checkForContent();
        });

        //* if you input multiple images and you added a wrong one you can delete it
        //* this code will remove the one you deleted from existing image array
        //* and the remaining images is transferred to another array and is considered as a new input
        $(document).on("click", ".remove-imageEdit", function() {
            var index = $(this).data("index");
            console.log("Removing image at index:", index);

            var newFiles = Array.from(imageInputEdit.files).filter((_, i) => i !== index);
            var dataTransfer = new DataTransfer();
            newFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });

            // Update the input files and reset the indexes
            imageInputEdit.files = dataTransfer.files;
            $('#previewSeedEdit').empty();
            Array.from(imageInputEdit.files).forEach(function(file, index) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewSeedEdit').prepend('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-imageEdit" data-index="' + index + '"><i class="fa-solid fa-xmark"></i></button></div>');
                }
                reader.readAsDataURL(file);
            });

            console.log("New files array after removal:", imageInputEdit.files);
            checkForContent();
        });

        // Add event listener for the hidden.bs.modal event
        $('#add-item-modal, #edit-item-modal').on('hidden.bs.modal', function() {
            imageInputEdit.value = ''; // Reset file input
            $('#previewSeedEdit').empty(); // Clear preview container
            checkForContent();
        });
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

<!-- SCRIPT for location tab -->
<!-- <script>
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
            const response = await fetch(`fetch/fetch_location-edit.php?province=${selectedProvince}`);
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
            if (initialVal) {
                municipalitiesDropdown.value = initialVal;
            }

        } catch (error) {
            console.error('Error fetching municipalities:', error);
        }
    };

    // Function to populate barangay dropdown based on selected municipality
    const populateBarangayEdit = async (selectedMunicipality, initialVal) => {
        try {
            const response = await fetch(`fetch/fetch_location-edit.php?municipality=${selectedMunicipality}`);
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
            if (initialVal) {
                barangayDropdown.value = initialVal;
            }

        } catch (error) {
            console.error('Error fetching barangays:', error);
        }
    };

    // Call the populateMunicipalities function when the province dropdown value changes
    document.getElementById('ProvinceEdit').addEventListener('change', function() {
        var selectedProvince = document.getElementById('ProvinceEdit').value;
        populateMunicipalitiesEdit(selectedProvince, initialMunicipality);
    });

    // Call the populateBarangay function when the municipality dropdown value changes
    document.getElementById('MunicipalitySelect').addEventListener('change', function() {
        var selectedMunicipality = document.getElementById('MunicipalitySelect').value;
        populateBarangayEdit(selectedMunicipality, initialBarangay);
    });

    // Call the populateMunicipalities function initially to populate the municipalities dropdown based on the default selected province
    var selectedProvince = document.getElementById('ProvinceEdit').value;
    populateMunicipalitiesEdit(selectedProvince, initialMunicipality);

    // Call the populateBarangay function initially to populate the municipalities dropdown based on the default selected municipality
    var selectedMunicipality = document.getElementById('MunicipalitySelect').value;
    populateBarangayEdit(selectedMunicipality, initialBarangay);
</script> -->

<!-- script for limiting the input in coordinates just to numbers, commas, periods, and spaces -->
<script>
    document.getElementById('coordEdit').addEventListener('input', function(event) {
        const regex = /^[0-9.,\s]*$/;
        if (!regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(/[^0-9.,\s]/g, '');
        }
    });
</script>