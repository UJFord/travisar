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
            <label for="crop_variety" class="form-label small-font">Variety Name <span style="color: red;">*</span></label>
            <input id="crop_variety" type="text" name="crop_variety" class="form-control">
        </div>
        <!-- local name -->
        <!-- <div class="col">
            <label for="Local-Name" class="form-label small-font">Local Name <span style="color: red;">*</span></label>
            <input id="Local-Name" type="text" name="crop_local_name" class="form-control">
        </div> -->
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

    <!-- Scientific Name and Unique Features -->
    <div class="row mb-3">
        <!-- Scientific Name -->
        <div class="col">
            <label for="ScienceName" class="form-label small-font">Scientific Name</label>
            <input id="ScienceName" type="text" name="scientific_name" class="form-control">
        </div>
        <!-- Unique Features -->
        <div class="col">
            <label for="UniqueFeat" class="form-label small-font">Unique Features</label>
            <input id="UniqueFeat" type="text" name="unique_features" class="form-control">
        </div>
    </div>

    <!-- Role in Maintaining Upland Ecosystem -->
    <div class="col">
        <label for="MainEcosystem" class="form-label small-font">Role in Maintaining Upland Ecosystem</label>
        <input id="MainEcosystem" type="text" name="role_in_maintaining_upland_ecosystem" class="form-control">
    </div>

    <!-- DISCRIPTION -->
    <div class="row mb-3">
        <div class="col">
            <label for="description" class="form-label small-font">Description</label>
            <textarea name="crop_description" id="description" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <!-- //*! gi comment out nako ni kay pag human og redirect ma adto ka sa try.php sa form ata ni sya sa action="try.php" -->
    <!-- <div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div> -->
</div>

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