<div id="riceMorph-Edit">
    <h6 class="fw-semibold mt-4 mb-3">Vegetative State</h6>
    <!-- Plant Height -->
    <div class="row mb-4">
        <div class="col-6">
            <label class="small-font" for="rice-height-Edit">Plant Height</label>
            <select class="form-select" name="rice_plant_height" id="rice-height-Edit">
                <option value="Short">Short</option>
                <option value="Typical">Typical</option>
                <option value="Tall">Tall</option>
            </select>
        </div>
    </div>
    <!-- Leaf Traits -->
    <div class="row mb-4">
        <!-- leaf width -->
        <div class="col-6">
            <label class="small-font" for="leafWidth-Edit">Leaf Width</label>
            <select name="rice_leaf_width" id="leafWidth-Edit" class="form-select">
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
                <option value="With Purplish Stripes">With Purplish Stripes</option>
                <option value="Pubescence">Pubescence</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col-6">
            <label class="small-font" for="leafLength-Edit">Leaf Length</label>
            <select name="rice_leaf_length" id="leafLength-Edit" class="form-select">
                <option value="Short">Short</option>
                <option value="Average">Average</option>
                <option value="Long">Long</option>
            </select>
        </div>
    </div>

    <!-- Tillering ability and maturity time -->
    <div class="row mb-5">
        <!-- Tillering ability -->
        <div class="col">
            <label for="tilleringAbility-Edit" class="form-label small-font">Tillering Ability</label>
            <select name="rice_tillering_ability" id="tilleringAbility-Edit" class="form-select">
                <option value="High Tillering">High Tillering</option>
                <option value="Low-tillering">Low-tillering</option>
            </select>
        </div>

        <!-- Maturity Time -->
        <div class="col">
            <label for="rice-maturityTime-Edit" class="form-label small-font">Maturity Time</label>
            <select name="rice_maturity_time" id="rice-maturityTime-Edit" class="form-select">
                <option value="Early Maturing(3months)">Early Maturing (3months)</option>
                <option value="Late Maturing (4-7months)">Late Maturing (4-7months)</option>
            </select>
        </div>
    </div>

    <!-- reproductive traits -->
    <h6 class="fw-semibold mt-4 mb-3">Reproductive State</h6>
    <!-- Yield Capacity -->
    <div class="row mb-5">
        <div class="col-6">
            <label for="rice-yield-capacity-Edit" class="form-label small-font">Yield Capacity</label>
            <select name="rice_yield_capacity" id="rice-yield-capacity-Edit" class="form-select">
                <option value="Low-Yielding">Low-Yielding</option>
                <option value="High-Yielding">High-Yielding</option>
            </select>
        </div>
    </div>

    <!-- Panicle traits-->
    <div class="row mb-5">
        <!-- Length -->
        <div class="col-6 mb-2">
            <label for="pan-length-Edit" class="form-label small-font">Panicle Length</label>
            <input type="text" name="panicle_length" id="pan-length-Edit" class="form-control"></input>
        </div>

        <!-- width -->
        <div class="col-6 mb-2">
            <label for="pan-width-Edit" class="form-label small-font">Panicle Width</label>
            <input type="text" name="panicle_width" id="pan-width-Edit" class="form-control"></input>
        </div>

        <!-- panicle enclosed by -->
        <div class="col-6 mb-2">
            <label for="pan-enclosed-Edit" class="form-label small-font">Panicle Enclosed By</label>
            <input type="text" name="panicle_enclosed_by" id="pan-enclosed-Edit" class="form-control"></input>
        </div>

        <!-- other_remarkable_feature-->
        <div class="col-12 mb-0">
            <label for="panicle-features-Edit" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="panicle_remarkable_features" id="panicle-features-Edit" rows="3" class="form-control"></textarea>
        </div>
    </div>

    <!-- Seed traits-->
    <div class="row mb-5">
        <!-- Length -->
        <div class="col-6 mb-2">
            <label for="rice-seed-length-Edit" class="form-label small-font">Seed Length</label>
            <input type="text" name="seed_length" id="rice-seed-length-Edit" class="form-control">
        </div>

        <!-- width -->
        <div class="col-6 mb-2">
            <label for="rice-seed-width-Edit" class="form-label small-font">Seed Width</label>
            <input type="text" name="seed_width" id="rice-seed-width-Edit" class="form-control">
        </div>

        <!-- seed Shape -->
        <div class="col-6 mb-2">
            <label for="rice-seed-shape-Edit" class="form-label small-font">Seed Shape</label>
            <input type="text" name="seed_shape" id="rice-seed-shape-Edit" class="form-control">
        </div>

        <!-- Color-->
        <div class="col-6 mb-2">
            <label for="rice-seed-color-Edit" class="form-label small-font">Seed Color</label>
            <input type="text" name="seed_color" id="rice-seed-color-Edit" class="form-control">
        </div>
    </div>

    <!-- Flag Leaf traits-->
    <div class="row mb-2">
        <!-- Length -->
        <div class="col-6 mb-2">
            <label for="flag-length-Edit" class="form-label small-font">Flag Leaf Length</label>
            <input name="flag_length" id="flag-length-Edit" class="form-control">
        </div>

        <!-- width -->
        <div class="col-6 mb-2">
            <label for="flag-width-Edit" class="form-label small-font">Flag Leaf Width</label>
            <input name="flag_width" id="flag-width-Edit" class="form-control">
        </div>

        <!-- Pubescence -->
        <div class="col-6 mb-2">
            <label for="Pubescence-Edit" class="form-label small-font">Pubescence</label>
            <input name="pubescence" id="Pubescence-Edit" class="form-control">
        </div>

        <!-- Purplish Stripes -->
        <div class="col-6 mb-2 form-check form-switch px-5 py-3">
            <input class="form-check-input" name="purplish_stripes" type="checkbox" role="switch" id="purplishStripes-Edit" value="1">
            <label class="form-check-label small-font" for="purplishStripes-Edit">With Purplish Stripes?</label>
        </div>

        <!-- other_remarkable_feature-->
        <div class="col-12 mb-3">
            <label for="flag-features-Edit" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="flag_remarkable_features" id="flag-features-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>
</div>