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

    <!-- para ma empty lang ang data sa db dili ra sya ma null -->
    <input type="hidden" name="crop_local_name" value="">
    <input type="hidden" name="field_id" value="1">
    <input type="hidden" name="cultural_significance" value="">
    <input type="hidden" name="spiritual_significance" value="">
    <input type="hidden" name="cultural_importance_and_traditional_knowledge" value="">
    <input type="hidden" name="cultural_use">
    <input type="hidden" name="threats" value="">

    <!-- NAME AND TYPE -->
    <div class="row mb-3">
        <!-- variety name -->
        <div class="col-6">
            <label for="Variety-Name" class="form-label small-font">Name<span style="color: red;">*</span></label>
            <input id="Variety-Name" type="text" name="crop_variety" class="form-control">
        </div>

        <!-- Category -->
        <div class="col-6">
            <label for="Category" class="form-label small-font">What type of crop is this? <span style="color: red;">*</span></label>
            <select name="category_id" id="Category" class="form-select">
                <?php
                // get the data of category from DB
                // gi set ra nako na permi last ang other nga category og ascending sya based sa catgory name
                $queryCategory = "SELECT * FROM category ORDER BY
                CASE
                    WHEN category_name = 'Other' THEN 2
                    ELSE 1
                END, category_name ASC";
                $query_run = pg_query($conn, $queryCategory);
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
    </div>

    <!-- IMAGE -->
    <div class="row mb-2">
        <div class="col">
            <div class="d-flex flex-column image-upload-container">
                <!-- label -->
                <label for="imageInput" class="d-flex align-items-center rounded small-font mb-2">
                    <i class="fa-solid fa-image me-2"></i>
                    <span>Image <span style="color: red;">*</span></span>
                </label>
                <!-- image input -->
                <input class="mb-2 form-control form-control-sm" type="file" id="imageInput" accept="image/jpeg,image/png" name="crop_image[]" multiple>
                <!-- image preview -->
                <div class="preview-container custom-scrollbar overflow-scroll rounded border p-1" id="preview"></div>
            </div>
        </div>
    </div>

    <!-- DISCRIPTION -->
    <div class="row mb-3">
        <div class="col">
            <label for="desc" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="desc" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div>
</div>
