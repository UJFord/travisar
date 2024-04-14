<div id="root_cropMorph-Edit">
    <h4>Vegetative Traits</h4>
    <br>
    <!-- Morphological traits -->
    <!-- plant height -->
    <div class="row">
        <!-- Plant Height -->
        <label>Plant Height</label>
        <div class="mb-4">
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-height-tall-edit">Tall</label>
                <input class="form-check-input" type="radio" name="rootcrop_plant_height" id="rootCrop-height-tall-edit" value="Tall">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-height-average-edit">Average</label>
                <input class="form-check-input" type="radio" name="rootcrop_plant_height" id="rootCrop-height-average-edit" value="Average">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-height-short-edit">Short</label>
                <input class="form-check-input" type="radio" name="rootcrop_plant_height" id="rootCrop-height-short-edit" value="Short">
            </div>
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
    <div class="row mb-4">
        <div class="col-12 mb-2">
            <label for="rootCrop-steam-leaf-desc-Edit" class="form-label">Stem and Leaf Description</label>
            <textarea name="rootcrop_stem_leaf_desc" id="rootCrop-steam-leaf-desc-Edit" cols="30" rows="1" class="form-control"></textarea>
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

    <h4>Root Crop Traits</h4>
    <br>
    <!-- Root Crop Traits -->
    <div class="row mb-4">
        <div class="col-12 mb-2">
            <label for="rootCrop-eating-quality-Edit" class="form-label small-font">Eating Quality</label>
            <textarea name="eating_quality" id="rootCrop-eating-quality-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-color-Edit" class="form-label small-font">Color</label>
            <textarea name="rootcrop_color" id="rootCrop-color-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-sweetness-Edit" class="form-label small-font">Sweetness</label>
            <textarea name="sweetness" id="rootCrop-sweetness-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-remarkableFeatures-Edit" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="rootcrop_remarkable_features" id="rootCrop-remarkableFeatures-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
    </div>
</div>