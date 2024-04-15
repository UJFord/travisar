<div id="cornMorph-Edit">
    <!-- Morphological traits -->
    <h4>Morphological Traits</h4>
    <br>
    <label class="form-label"><strong>Vegetative state</strong></label>
    <!-- plant height -->
    <div class="row">
        <!-- Plant Height -->
        <label>Plant Height</label>
        <div class="mb-4">
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="corn-height-tall-edit">Tall</label>
                <input class="form-check-input" type="radio" name="corn_plant_height" id="corn-height-tall-edit" value="Tall">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="corn-height-average-edit">Average</label>
                <input class="form-check-input" type="radio" name="corn_plant_height" id="corn-height-average-edit" value="Average">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="corn-height-short-edit">Short</label>
                <input class="form-check-input" type="radio" name="corn_plant_height" id="corn-height-short-edit" value="Short">
            </div>
        </div>
    </div>

    <!-- Leaf Traits -->
    <div class="row mb-4">
        <!-- leaf width -->
        <div class="col">
            <label for="corn-leafWidth-Edit">Leaf Width</label>
            <select name="corn_leaf_width" id="corn-leafWidth-Edit" class="form-select">
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col">
            <label for="corn-leafLength-Edit">Leaf Length</label>
            <select name="corn_leaf_length" id="corn-leafLength-Edit" class="form-select">
                <option value="Short">Short</option>
                <option value="Average">Average</option>
                <option value="Long">Long</option>
            </select>
        </div>
    </div>

    <!-- maturity time -->
    <!-- <div class="row mb-4">
        <div class="col">
            <label for="corn-maturityTime-Edit">Maturity Time</label>
            <select name="corn_maturity_time" id="corn-maturityTime-Edit" class="form-select">
                <option value="Early Maturing(3months)">Early Maturing (3months)</option>
                <option value="Late Maturing (4-7months)">Late Maturing (4-7months)</option>
            </select>
        </div>
    </div> -->

    <label class="form-label"><strong>Reproductive state</strong></label>
    <br>
    <!-- Yield Capacity -->
    <div class="row mb-4">
        <div class="col-12 mb-2">
            <label for="corn-yield-capacity-Edit" class="form-label small-font">Yield Capacity</label>
            <textarea name="corn_yield_capacity" id="corn-yield-capacity-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
    </div>

    <!-- Seed traits-->
    <div class="row mb-4">
        <label class="form-label"><strong>Seed traits</strong></label>
        <!-- Length -->
        <div class="col-12 mb-2">
            <label for="corn-seed-length-Edit" class="form-label small-font">Length</label>
            <textarea name="seed_length" id="corn-seed-length-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- width -->
        <div class="col-12 mb-2">
            <label for="corn-seed-width-Edit" class="form-label small-font">Width</label>
            <textarea name="seed_width" id="corn-seed-width-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- seed Shape -->
        <div class="col-12 mb-2">
            <label for="corn-seed-shape-Edit" class="form-label small-font">Shape</label>
            <textarea name="seed_shape" id="corn-seed-shape-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Color-->
        <div class="col-12 mb-2">
            <label for="corn-seed-color-Edit" class="form-label small-font">Color</label>
            <textarea name="seed_color" id="corn-seed-color-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>
</div>