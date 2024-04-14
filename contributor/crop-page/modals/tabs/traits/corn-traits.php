<div id="cornMorph">


    <!-- Seed traits-->
    <h6 class="fw-semibold mt-4 mb-3">Seed Traits</h6>
    <div class="row mb-4">
        <!-- Length -->
        <div class="col-6 mb-2">
            <label for="corn-seed-length" class="form-label small-font">Length</label>
            <input type="text" id="corn-seed-length" class="form-control">
        </div>

        <!-- width -->
        <div class="col-6 mb-2">
            <label for="corn-seed-width" class="form-label small-font">Width</label>
            <input type="text" id="corn-seed-width" class="form-control">
        </div>

        <!-- seed Shape -->
        <div class="col-6 mb-2">
            <label for="corn-seed-shape" class="form-label small-font">Shape</label>
            <input type="text" id="corn-seed-shape" class="form-control">
        </div>

        <!-- Color-->
        <div class="col-6 mb-2">
            <label for="corn-seed-color" class="form-label small-font">Color</label>
            <input type="text" id="corn-seed-color" class="form-control">
        </div>
    </div>



    <!-- Morphological traits -->
    <h6 class="fw-semibold mb-3">Vegetative State</h6>
    <!-- plant height -->
    <div class="row mb-2">
        <!-- Plant Height -->
        <div class="col-6">
            <label class="small-font" for="corn_plant_height">Plant Height</label>
            <select class="form-select" name="corn_plant_height" id="corn-height">
                <option selected></option>
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
            <label class="small-font" for="corn-leafWidth">Leaf Width</label>
            <select name="corn_leaf_width" id="corn-leafWidth" class="form-select">
                <option selected></option>
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col">
            <label class="small-font" for="corn-leafLength">Leaf Length</label>
            <select name="corn_leaf_length" id="corn-leafLength" class="form-select">
                <option selected></option>
                <option value="Short">Short</option>
                <option value="Average">Average</option>
                <option value="Long">Long</option>
            </select>
        </div>
    </div>



    <!-- reproductive state -->
    <h6 class="fw-semibold mt-4 mb-3">Reproductive State</h6>
    <!-- Yield Capacity -->
    <div class="row mb-4">
        <div class="col-6 mb-2">
            <label for="corn-yield-capacity" class="form-label small-font">Yield Capacity</label>
            <input type="text" id="corn-yield-capacity" class="form-control">
        </div>
    </div>
</div>