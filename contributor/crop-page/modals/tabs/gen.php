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
            <input id="Variety-Name" type="text" name="crop_variety" class="form-control" required>
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
    <div class="row mb-3">
        <div class="col">
            <label for="desc" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="desc" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- image -->
    <div class="row mb-3">
        <!-- Seed image -->
        <div class="col-6">
            <div class="d-flex flex-column image-upload-container">
                <!-- label -->
                <label for="imageInput" class="d-flex align-items-center rounded small-font mb-2">
                    <i class="fa-solid fa-image me-2"></i>
                    <span>Seed</span>
                </label>
                <!-- image input -->
                <input class="mb-2 form-control form-control-sm" type="file" id="imageInput" accept="image/jpeg,image/png" name="crop_seed_image" single>
                <!-- image preview -->
                <div class="preview-container custom-scrollbar overflow-scroll rounded border p-1" id="preview"></div>
            </div>
        </div>

        <!-- vegetative stage image -->
        <div class="col-6">
            <div class="d-flex flex-column image-upload-container">
                <!-- label -->
                <label for="imageInput" class="d-flex align-items-center rounded small-font mb-2">
                    <i class="fa-solid fa-image me-2"></i>
                    <span>Vegetative Stage</span>
                </label>
                <!-- image input -->
                <input class="mb-2 form-control form-control-sm" type="file" id="imageInput" accept="image/jpeg,image/png" name="crop_vegetative_image" single>
                <!-- image preview -->
                <div class="preview-container custom-scrollbar overflow-scroll rounded border p-1" id="preview"></div>
            </div>
        </div>

        <!-- reproductive stage image -->
        <div class="col">
            <div class="d-flex flex-column image-upload-container">
                <!-- label -->
                <label for="imageInput" class="d-flex align-items-center rounded small-font mb-2">
                    <i class="fa-solid fa-image me-2"></i>
                    <span>Reproductive Stage</span>
                </label>
                <!-- image input -->
                <input class="mb-2 form-control form-control-sm" type="file" id="imageInput" accept="image/jpeg,image/png" name="crop_reproductive_image" single>
                <!-- image preview -->
                <div class="preview-container custom-scrollbar overflow-scroll rounded border p-1" id="preview"></div>
            </div>
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
    // handling to show all image inputs
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.querySelector('.preview-container');

    // function to display and remove the image selected
    $(document).ready(function() {
        // preview
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
        //! murag ang remove nalang ata ang useful diri kay isa nalang man ang image input
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
            //* mao ni tung mag transfer sa data to another input pag mag remove ka og data
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