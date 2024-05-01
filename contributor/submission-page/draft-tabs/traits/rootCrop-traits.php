<div id="root_cropMorph-draft">
    <!-- vegetative state -->
    <h6 class="fw-semibold mt-4 mb-3">Vegetative State</h6>
    <!-- plant height -->
    <div class="row mb-4">
        <div class="col-6">
            <label class="small-font" for="rootcrop-heightDraft">Plant Height</label>
            <select class="form-select" name="rootcrop_plant_height" id="rootcrop-heightDraft">
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
            <label class="small-font" for="rootcrop-leafWidthDraft">Leaf Width</label>
            <select name="rootcrop_leaf_width" id="rootcrop-leafWidthDraft" class="form-select">
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col">
            <label class="small-font" for="rootcrop-leafLengthDraft">Leaf Length</label>
            <select name="rootcrop_leaf_length" id="rootcrop-leafLengthDraft" class="form-select">
                <option value="Short">Short</option>
                <option value="Average">Average</option>
                <option value="Long">Long</option>
            </select>
        </div>
    </div>

    <!-- stem and leaf desc -->
    <div class="row mb-5">
        <div class="col">
            <label for="rootCrop-steam-leaf-descDraft" class="form-label small-font">Stem and Leaf Description</label>
            <textarea name="rootcrop_stem_leaf_desc" id="rootCrop-steam-leaf-descDraft" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- Root Crop Traits -->
    <h6 class="fw-semibold mt-4 mb-3">Crop Traits</h6>
    <div class="row mb-3">
        <div class="col-4 mb-2">
            <label for="rootCrop-eating-qualityDraft" class="form-label small-font">Eating Quality</label>
            <!-- <textarea name="eating_quality" id="rootCrop-eating-quality" cols="30" rows="1" class="form-control"></textarea> -->
            <input type="text" name="eating_quality" id="rootCrop-eating-qualityDraft" class="form-control">
        </div>
        <div class="col-4 mb-2">
            <label for="rootCrop-colorDraft" class="form-label small-font">Color</label>
            <!-- <textarea name="rootcrop_color" id="rootCrop-color" cols="30" rows="1" class="form-control"></textarea> -->
            <input type="text" name="rootcrop_color" id="rootCrop-colorDraft" class="form-control">
        </div>
        <div class="col-4 mb-2">
            <label for="rootCrop-sweetnessDraft" class="form-label small-font">Sweetness</label>
            <!-- <textarea name="sweetness" id="rootCrop-sweetness" cols="30" rows="1" class="form-control"></textarea> -->
            <input type="text" name="sweetness" id="rootCrop-sweetnessDraft" class="form-control">
        </div>
        <div class="col-12 mb-0">
            <label for="rootCrop-remarkableFeaturesDraft" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="rootcrop_remarkable_features" id="rootCrop-remarkableFeaturesDraft" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>
</div>