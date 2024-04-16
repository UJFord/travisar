<div id="root_cropMorph-Edit">
    <h6 class="fw-semibold mt-4 mb-3">Vegetative State</h6>
    <!-- plant height -->
    <div class="row mb-4">
        <div class="col-6">
            <label class="small-font" for="rootCrop-height-Edit">Plant Height</label>
            <select class="form-select" name="rootcrop_plant_height" id="rootCrop-height-Edit">
                <option value="Short">Short</option>
                <option value="Typical">Typical</option>
                <option value="Tall">Tall</option>
            </select>
        </div>
    </div>

    <!-- Leaf Traits -->
    <div class="row mb-4">
        <!-- leaf width -->
        <div class="col">
            <label for="rootCrop-leafWidth-Edit">Leaf Width</label>
            <select name="rootcrop_leaf_width" id="rootCrop-leafWidth-Edit" class="form-select">
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col">
            <label for="rootCrop-leafLength-Edit">Leaf Length</label>
            <select name="rootcrop_leaf_length" id="rootCrop-leafLength-Edit" class="form-select">
                <option value="Short">Short</option>
                <option value="Average">Average</option>
                <option value="Long">Long</option>
            </select>
        </div>
    </div>

    <!-- stem and leaf desc -->
    <div class="row mb-5">
        <div class="col">
            <label for="rootCrop-steam-leaf-desc-Edit" class="form-label small-font">Stem and Leaf Description</label>
            <textarea name="rootcrop_stem_leaf_desc" id="rootCrop-steam-leaf-desc-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- maturity time -->
    <!-- <div class="row mb-4">
        <div class="col">
            <label for="rootCrop-maturityTime">Maturity Time</label>
            <select name="rootcrop_maturity_time" id="rootCrop-maturityTime" class="form-select">
                <option value="Early Maturing(3months)">Early Maturing (3months)</option>
                <option value="Late Maturing (4-7months)">Late Maturing (4-7months)</option>
            </select>
        </div>
    </div> -->

    <!-- Root Crop Traits -->
    <h6 class="fw-semibold mt-4 mb-3">Crop Traits</h6>
    <!-- Root Crop Traits -->
    <div class="row mb-3">
        <div class="col-4 mb-2">
            <label for="rootCrop-eating-quality-Edit" class="form-label small-font">Eating Quality</label>
            <input type="text" name="eating_quality" id="rootCrop-eating-quality-Edit" class="form-control">
        </div>
        <div class="col-4 mb-2">
            <label for="rootCrop-color-Edit" class="form-label small-font">Color</label>
            <input type="text" name="rootcrop_color" id="rootCrop-color-Edit" class="form-control">
        </div>
        <div class="col-4 mb-2">
            <label for="rootCrop-sweetness-Edit" class="form-label small-font">Sweetness</label>
            <input type="text" name="sweetness" id="rootCrop-sweetness-Edit" class="form-control">
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-remarkableFeatures-Edit" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="rootcrop_remarkable_features" id="rootCrop-remarkableFeatures-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
    </div>
</div>