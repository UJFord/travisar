<!-- STYLE -->
<style>
    .image-upload-container {
        /* Adjust width and height as needed */
        /* border: 1px solid #ccc;
        border-radius: 5px; */
        cursor: pointer;
    }

    .preview-container {
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

    .image-preview {
        position: relative;
        display: inline-block;
        aspect-ratio: 1/1;
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
    #preview {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }
</style>

<!-- GENERAL TAB -->
<div class="fade tab-pane" id="gen-tab-pane" role="tabpanel" aria-labelledby="gen-tab" tabindex="0">
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

        <!-- Input box for "other" category -->
        <div class="col" id="otherCategoryInput" style="display: none;">
            <label for="OtherCategory" class="form-label small-font">Please specify:</label>
            <input type="text" name="other_category" id="OtherCategory" class="form-control">
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
            <input id="Variety-Name" type="text" name="crop_variety" class="form-control" required>
        </div>

        <!-- Meaning of Name -->
        <div class="col mb-2">
            <label class="form-label small-font">Meaning of Name(if any)</label>
            <input type="text" name="meaning_of_name" class="form-control">
        </div>

        <!-- local name -->
        <div class="col mb-2">
            <label class="form-label small-font">Local Name</label>
            <input type="text" name="crop_local_name" class="form-control">
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

    <!-- image -->
    <div class="row mb-3">
        <!-- image -->
        <div class="col">
            <div class="d-flex flex-column image-upload-container">
                <!-- label -->
                <label for="imageInput" class="d-flex align-items-center rounded small-font mb-2">
                    <i class="fa-solid fa-image me-2"></i>
                    <span>Crop Image <span style="color: red;">*</span></span>
                </label>
                <!-- image input -->
                <input class="mb-2 form-control form-control-sm" type="file" id="imageInput" accept="image/jpeg,image/png" name="crop_image[]" multiple required>
                <!-- image preview -->
                <div class="preview-container custom-scrollbar overflow-scroll rounded border p-1" id="preview"></div>
            </div>
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="row mb-3">
        <div class="col">
            <label for="desc" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="desc" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <br>
    <h4>Morphological Characteristics</h4>

    <!-- Morphological Characteristics for corn -->
    <div class="row mb-3" id="cornMorph">
        <!-- Plant Structure -->
        <div class="row">
            <div class="col-6">
                <label class="form-label small-font">Plant Structure</label>
                <input type="text" name="plant_structure" class="form-control">
            </div>
            <!-- Root System -->
            <div class="col-6">
                <label class="form-label small-font">Root System</label>
                <input type="text" name="root_system" class="form-control">
            </div>
        </div>
        <!-- leaves and fruit -->
        <div class="row">
            <div class="col-6">
                <label class="form-label small-font">leaves</label>
                <input type="text" name="leaves" class="form-control">
            </div>
            <div class="col">
                <label class="form-label small-font">Fruit</label>
                <input type="text" name="fruits" class="form-control">
            </div>
        </div>
        <!-- Inflorescence -->
        <div class="row">
            <div class="col">
                <label class="form-label small-font">Inflorescence</label>
                <input type="text" name="inflorescence" class="form-control">
            </div>
            <div class="col">
                <label class="form-label small-font">Flower</label>
                <input type="text" name="flower" class="form-control">
            </div>
        </div>
        <!-- Shape -->
        <div class="row">
            <div class="col-6">
                <label class="form-label small-font">Shape</label>
                <input type="text" name="shape" class="form-control">
            </div>
        </div>
    </div>

    <!-- Morphological Characteristics for rice -->
    <div class="row mb-3" id="riceMorph">
        <!-- Plant Height -->
        <div class="row">
            <div class="col">
                <label class="form-label small-font">Plant Height</label>
                <input type="text" name="plant_height" class="form-control">
            </div>
            <!-- leaves -->
            <div class="col">
                <label class="form-label small-font">leaves</label>
                <input type="text" name="leaves" class="form-control">
            </div>
            <!-- Roots -->
            <div class="col">
                <label class="form-label small-font">Roots</label>
                <input type="text" name="roots" class="form-control">
            </div>
        </div>

        <!-- Inflorescence -->
        <div class="row">
            <div class="col">
                <label class="form-label small-font">Inflorescence</label>
                <input type="text" name="inflorescence" class="form-control">
            </div>
            <div class="col">
                <label class="form-label small-font">Flower</label>
                <input type="text" name="flower" class="form-control">
            </div>
        </div>

        <!-- Grain -->
        <div class="row">
            <div class="col">
                <label class="form-label small-font">Grain</label>
                <input type="text" name="grain" class="form-control">
            </div>
            <!-- Husk -->
            <div class="col">
                <label class="form-label small-font">Husk</label>
                <input type="text" name="husk" class="form-control">
            </div>
        </div>
    </div>

    <!-- Morphological Characteristics for root crop -->
    <div class="row mb-3" id="root_cropMorph">
        <!-- Plant Size -->
        <div class="row">
            <div class="col">
                <label class="form-label small-font">Plant Size</label>
                <input type="text" name="plant_size" class="form-control">
            </div>
            <!-- Shape -->
            <div class="col">
                <label class="form-label small-font">Shape</label>
                <input type="text" name="shape" class="form-control">
            </div>
            <!-- Color -->
            <div class="col">
                <label class="form-label small-font">Color</label>
                <input type="text" name="color" class="form-control">
            </div>
        </div>

        <!-- Root and stem and leaf Characteristics -->
        <div class="row">
            <!-- Stem and leaf Characteristics -->
            <div class="col">
                <label class="form-label small-font">Stem and leaf Characteristics</label>
                <input type="text" name="stem_leaf_characteristics" class="form-control">
            </div>
            <!-- root characteristics -->
            <div class="col">
                <label class="form-label small-font">Root Characteristics</label>
                <input type="text" name="root_characteristics" class="form-control">
            </div>
        </div>
        <div class="row">
            <!-- Growth Habit -->
            <div class="col">
                <label class="form-label small-font">Growth Habit</label>
                <input type="text" name="growth_habit" class="form-control">
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')">Next</button>
        </div>
    </div>

</div>

<!-- SCRIPT for add tab-->
<script defer>
    // handling to show all image inputs
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.querySelector('.preview-container');

    // function to display and remove the image selected
    $(document).ready(function() {
        $('input[type="file"]').on("change", function() {
            var files = $(this)[0].files;
            $('#preview').empty();
            $.each(files, function(i, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').append('<div class="image-preview border rounded me-1 p-0"><img src="' + e.target.result + '" class="img-thumbnail"/><button class="remove-image" data-index="' + i + '"><i class="fa-solid fa-xmark"></i></button></div>');
                }
                reader.readAsDataURL(file);
            });
        });

        //* if you input muiltiple images and you added a wrong one you can delete it
        //* this code will remove the one you deleted from existing image array
        //* and the remaining images is transfered to another array and is considered as a new input
        $(document).on("click", ".remove-image", function() {
            var index = $(this).data("index");
            var input = $('input[type="file"]')[0];
            var files = input.files;
            var newFiles = [];
            for (var i = 0; i < files.length; i++) {
                if (i !== index) {
                    newFiles.push(files[i]);
                }
            }
            //* mao ni tung mag transfer sa data to another input
            var dataTransfer = new DataTransfer();
            newFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            input.files = dataTransfer.files;
            $(this).parent().remove();
        });

        // Add event listener for the hidden.bs.modal event
        $('#add-item-modal, #edit-item-modal').on('hidden.bs.modal', function() {
            // Clear the image input field
            $('#imageInput, #imageInputEdit').val('');
            // Clear the image preview container
            $('#preview, #previewEdit').empty();
        });
    });

    // to show the border only when there a picture inside
    // const previewContainer = document.getElementById('previewContainer');
    function checkForContent() {
        var previewContainer = document.querySelector('.preview-container');
        if (previewContainer.hasChildNodes()) {
            previewContainer.style.display = 'block'; // Show the preview container
            previewContainer.classList.add('border'); // Add border to the container
        } else {
            previewContainer.style.display = 'none'; // Hide the preview container
            previewContainer.classList.remove('border'); // Remove border from the container
        }
    }

    // Call initially on page load
    checkForContent();

    // Call whenever content might change within the container
    previewContainer.addEventListener('DOMNodeInserted', checkForContent);
    previewContainer.addEventListener('DOMNodeRemoved', checkForContent);
</script>

<!-- JavaScript to show or hide the input box -->
<script>
    document.getElementById('Category').addEventListener('change', function() {
        var otherCategoryInput = document.getElementById('otherCategoryInput');
        var selectedCategory = document.getElementById('Category').value;
        if (selectedCategory === '3') {
            otherCategoryInput.style.display = 'block';
        } else {
            otherCategoryInput.style.display = 'none';
        }
    });
</script>

<!-- JavaScript for the select for category variety -->
<script>
    // JavaScript for the select for category variety
    // Function to fetch and display initial category variety based on the initial category
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch varieties for the initial selected category
        var initialCategoryId = document.getElementById('Category').value;
        fetchVarieties(initialCategoryId);
    });

    // Function to fetch and display initial morphological characteristics based on the initial category
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch the initial category value
        var initialCategoryId = document.getElementById('Category').value;
        // Call the function to display the corresponding morphological characteristics
        showMorphologicalCharacteristics(initialCategoryId);
    });

    // Event listener for changing the category select element
    document.getElementById('Category').addEventListener('change', function() {
        var selectedCategory = this.value;
        // Call the function to display the corresponding morphological characteristics
        showMorphologicalCharacteristics(selectedCategory);
    });

    function fetchVarieties(categoryId) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    var varieties = JSON.parse(this.responseText);
                    populateVarieties(varieties);
                } else {
                    console.error('Failed to fetch varieties. Status:', this.status);
                }
            }
        };
        xhr.onerror = function() {
            console.error('An error occurred during the request.');
        };
        xhr.open('GET', 'crop-page/modals/fetch/fetch_varieties.php?category_id=' + categoryId, true);
        xhr.send();
    }

    document.getElementById('Category').addEventListener('change', function() {
        var categoryId = this.value;
        var categoryVarietySelect = document.getElementById('categoryVariety');
        var categoryVarietySelectContainer = document.getElementById('category-Variety');
        if (categoryId === '3') {
            categoryVarietySelectContainer.style.display = 'none';
        } else {
            categoryVarietySelectContainer.style.display = 'block';
            fetchVarieties(categoryId);
        }

        // Call the function to display the corresponding morphological characteristics
        showMorphologicalCharacteristics(categoryId);
    });

    function populateVarieties(varieties) {
        var categoryVarietySelect = document.getElementById('categoryVariety');
        categoryVarietySelect.innerHTML = ''; // Clear existing options
        varieties.forEach(function(variety) {
            var option = document.createElement('option');
            option.value = variety.category_variety_id;
            option.text = variety.category_variety_name;
            categoryVarietySelect.appendChild(option);
        });
    }
</script>

<!-- script for the morphological characteristics display -->
<script>
    // Function to display the morphological characteristics based on the selected category
    function showMorphologicalCharacteristics(categoryId) {
        var cornMorph = document.getElementById('cornMorph');
        var riceMorph = document.getElementById('riceMorph');
        var rootCropMorph = document.getElementById('root_cropMorph');

        // Hide all morphological characteristics sections
        cornMorph.style.display = 'none';
        riceMorph.style.display = 'none';
        rootCropMorph.style.display = 'none';

        // Show the relevant morphological characteristics section based on selected category
        if (categoryId === '4') {
            cornMorph.style.display = 'block';
        } else if (categoryId === '1') {
            riceMorph.style.display = 'block';
        } else if (categoryId === '2') {
            rootCropMorph.style.display = 'block';
        }
    }
</script>