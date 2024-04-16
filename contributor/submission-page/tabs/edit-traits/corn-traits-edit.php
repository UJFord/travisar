<div id="cornMorph-Edit">
    <label class="form-label"><strong>Vegetative state</strong></label>
    <!-- plant height -->
    <div class="row mb-4">
        <div class="col-6">
            <label class="small-font" for="corn-heightEdit">Plant Height</label>
            <select class="form-select" name="corn_plant_height" id="corn-heightEdit">
                <option value="Short">Short</option>
                <option value="Typical">Typical</option>
                <option value="Tall">Tall</option>
            </select>
        </div>
    </div>

    <!-- Leaf Traits -->
    <div class="row mb-5">
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

    <!-- reproductive state -->
    <h6 class="fw-semibold mt-4 mb-3">Reproductive State</h6>
    <!-- Yield Capacity -->
    <div class="row mb-3">
        <div class="col-6 mb-2">
            <label for="corn-yield-capacity-Edit" class="form-label small-font">Yield Capacity</label>
            <select type="text" name="corn_yield_capacity" id="corn-yield-capacity-Edit" class="form-select">
                <option value="Low-Yielding">Low-Yielding</option>
                <option value="High-Yielding">High-Yielding</option>
            </select>
        </div>
    </div>

    <!-- Seed traits-->
    <div class="row mb-3">
        <label class="form-label"><strong>Seed traits</strong></label>
        <!-- Length -->
        <div class="col-6 mb-2">
            <label for="corn-seed-length-Edit" class="form-label small-font">Length</label>
            <input type="text" name="seed_length" id="corn-seed-length-Edit" class="form-control"></input>
        </div>

        <!-- width -->
        <div class="col-6 mb-2">
            <label for="corn-seed-width-Edit" class="form-label small-font">Width</label>
            <input type="text" name="seed_width" id="corn-seed-width-Edit" class="form-control"></input>
        </div>

        <!-- seed Shape -->
        <div class="col-6 mb-2">
            <label for="corn-seed-shape-Edit" class="form-label small-font">Shape</label>
            <input type="text" name="seed_shape" id="corn-seed-shape-Edit" class="form-control"></input>
        </div>

        <!-- Color-->
        <div class="col-6 mb-2">
            <label for="corn-seed-color-Edit" class="form-label small-font">Color</label>
            <input type="text" name="seed_color" id="corn-seed-color-Edit" class="form-control"></input>
        </div>
    </div>
</div>