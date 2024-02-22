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

    /* hiding the scrollbar */
    #previewContainer {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }
</style>

<!-- GENERAL TAB -->
<div class="fade show active tab-pane" id="gen-tab-pane" role="tabpanel" aria-labelledby="gen-tab" tabindex="0">

    <!-- NAME AND TYPE -->
    <div class="row mb-3">
        <!-- variety name -->
        <div class="col">
            <label for="Variety-Name" class="form-label small-font">Variety Name <span style="color: red;">*</span></label>
            <input id="Variety-Name" type="text" name="crop_variety" class="form-control" placeholder="Ex. Sinandomeng">
        </div>
        <!-- locall name -->
        <div class="col">
            <label for="Local-Name" class="form-label small-font">Local Name <span style="color: red;">*</span></label>
            <input id="Local-Name" type="text" name="crop_local_name" class="form-control" placeholder="Ex. Bugas">
        </div>
    </div>

    <!-- Category and Crop Field -->
    <div class="row mb-3">
        <!-- Category -->
        <div class="col">
            <label for="Category" class="form-label small-font">What type of crop is this? <span style="color: red;">*</span></label>
            <select name="category_id" id="Category" class="form-select">
                <?php
                // get the data of category from DB
                $queryCategory = "select * from category order by category_id asc";
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
        <!-- crop field -->
        <div class="col">
            <label for="CropField" class="form-label small-font">Where is this crop planted? <span style="color: red;">*</span></label>
            <select name="field_id" id="CropField" class="form-select">
                <?php
                // get the data of category from DB
                $queryCropField = "select * from field order by field_id asc";
                $query_run = pg_query($conn, $queryCropField);

                $count = pg_num_rows($query_run);

                // if count is greater than 0 there is data
                if ($count > 0) {
                    // loop for displaying all fields
                    while ($row = pg_fetch_assoc($query_run)) {
                        $field_id = $row['field_id'];
                        $field_name = $row['field_name'];
                ?>
                        <option value="<?= $field_id; ?>"><?= $field_name; ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <!-- IMAGE -->
    <div class="row mb-3">
        <div class="col">
            <div class="d-flex flex-column image-upload-container">
                <!-- label -->
                <label for="imageInput" class="d-flex align-items-center rounded small-font mb-2">
                    <i class="fa-solid fa-image me-2"></i>
                    <span>Image <span style="color: red;">*</span></span>
                </label>
                <!-- image input -->
                <input class="mb-1 form-control form-control-sm" type="file" id="imageInput" accept="image/jpeg,image/png" name="crop_image[]" multiple>
                <!-- image preview -->
                <div class="preview-container custom-scrollbar overflow-scroll rounded border py-2" id="previewContainer"></div>
            </div>
        </div>
    </div>

    <!-- Role in Maintaining Upland Ecosystem and Unique Features -->
    <div class="row mb-3">
        <!-- Role in Maintaining Upland Ecosystem -->
        <div class="col">
            <label for="ScienceName" class="form-label small-font">Scientific Name</label>
            <input id="ScienceName" type="text" name="scientific_name" class="form-control" placeholder="Scientific Name">
        </div>
        <!-- crop field -->
        <div class="col">
            <label for="UniqueFeat" class="form-label small-font">Unique Features</label>
            <input id="UniqueFeat" type="text" name="unique_features" class="form-control" placeholder="Unique Features">
        </div>
    </div>

    <!-- Role in Maintaining Upland Ecosystem -->
    <div class="col">
            <label for="MainEcosystem" class="form-label small-font">Role in Maintaining Upland Ecosystem</label>
            <input id="MainEcosystem" type="text" name="role_in_maintaining_upland_ecosystem" class="form-control" placeholder="Role in maintaining upland ecosystem">
        </div>

    <!-- DISCRIPTION -->
    <div class="row mb-3">
        <div class="col">
            <label for="desc" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="desc" rows="2" class="form-control" placeholder="Description ..."></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <!-- <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div> -->
</div>

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

    /* hiding the scrollbar */
    #previewContainer {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }
</style>

<!-- SCRIPT -->
<script defer>
    // handling to show all image inputs
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.querySelector('.preview-container');

    imageInput.addEventListener('change', (event) => {
        // Clear existing previews
        previewContainer.innerHTML = '';

        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'mx-2'); // Add Bootstrap styling
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(files[i]);
        }
    });

    // to show the border only when there a picture inside
    // const previewContainer = document.getElementById('previewContainer');

    function checkForContent() {
        if (previewContainer.hasChildNodes()) {
            previewContainer.classList.add('border');
        } else {
            previewContainer.classList.remove('border');
        }
    }

    // Call initially on page load
    checkForContent();

    // Call whenever content might change within the container
    previewContainer.addEventListener('DOMNodeInserted', checkForContent);
    previewContainer.addEventListener('DOMNodeRemoved', checkForContent);


    // next button
    function switchTab(tabName) {
        // Get the tab content elements
        var tabPanes = document.querySelectorAll('.tab-pane');

        // Hide all tab content elements
        tabPanes.forEach(function(tabPane) {
            tabPane.classList.remove('show', 'active');
        });

        // Show the target tab content element
        document.getElementById(tabName + '-tab-pane').classList.add('show', 'active');
    }
</script>