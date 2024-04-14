<div id="riceMorph-Edit">
    <!-- Morphological traits -->
    <h4>Morphological traits</h4>
    <br>
    <label class="form-label"><strong>Vegetative state</strong></label>
    <!-- plant height -->
    <div class="row">
        <!-- Plant Height -->
        <label>Plant Height</label>
        <div class="mb-4">
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="height-tall-Edit">Tall</label>
                <input class="form-check-input" type="radio" name="rice_plant_height" id="height-tall-Edit" value="Tall">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="height-average-Edit">Average</label>
                <input class="form-check-input" type="radio" name="rice_plant_height" id="height-average-Edit" value="Average">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="height-short-Edit">Short</label>
                <input class="form-check-input" type="radio" name="rice_plant_height" id="height-short-Edit" value="Short">
            </div>
        </div>
    </div>
    <!-- Leaf Traits -->
    <div class="row mb-4">
        <!-- leaf width -->
        <div class="col">
            <label for="leafWidth-Edit">Leaf Width</label>
            <select name="rice_leaf_width" id="leafWidth-Edit" class="form-select">
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
                <option value="With Purplish Stripes">With Purplish Stripes</option>
                <option value="Pubescence">Pubescence</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col">
            <label for="leafLength-Edit">Leaf Length</label>
            <select name="rice_leaf_length" id="leafLength-Edit" class="form-select">
                <option value="Short">Short</option>
                <option value="Average">Average</option>
                <option value="Long">Long</option>
            </select>
        </div>
    </div>

    <!-- Tillering ability and maturity time -->
    <div class="row mb-4">
        <!-- Tillering ability -->
        <div class="col">
            <label for="tilleringAbility-Edit">Tillering Ability</label>
            <select name="rice_tillering_ability" id="tilleringAbility-Edit" class="form-select">
                <option value="High Tillering">High Tillering</option>
                <option value="Low-tillering">Low-tillering</option>
            </select>
        </div>

        <!-- Maturity Time -->
        <div class="col">
            <label for="rice-maturityTime-Edit">Maturity Time</label>
            <select name="rice_maturity_time" id="rice-maturityTime-Edit" class="form-select">
                <option value="Early Maturing(3months)">Early Maturing (3months)</option>
                <option value="Late Maturing (4-7months)">Late Maturing (4-7months)</option>
            </select>
        </div>
    </div>

    <label class="form-label"><strong>Reproductive state</strong></label>
    <br>
    <!-- Yield Capacity -->
    <div class="row mb-4">
        <div class="col-12 mb-2">
            <label for="rice-yield-capacity-Edit" class="form-label small-font">Yield Capacity</label>
            <textarea name="rice_yield_capacity" id="rice-yield-capacity-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
    </div>

    <!-- Panicle traits-->
    <div class="row mb-4">
        <label class="form-label"><strong>Panicle traits</strong></label>
        <!-- Length -->
        <div class="col-12 mb-2">
            <label for="pan-length-Edit" class="form-label small-font">Length</label>
            <textarea name="panicle_length" id="pan-length-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- width -->
        <div class="col-12 mb-2">
            <label for="pan-width-Edit" class="form-label small-font">Width</label>
            <textarea name="panicle_width" id="pan-width-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- panicle enclosed by -->
        <div class="col-12 mb-2">
            <label for="pan-enclosed-Edit" class="form-label small-font">Panicle Enclosed By</label>
            <textarea name="panicle_enclosed_by" id="pan-enclosed-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- other_remarkable_feature-->
        <div class="col-12 mb-2">
            <label for="panicle-features-Edit" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="panicle_remarkable_features" id="panicle-features-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- Seed traits-->
    <div class="row mb-4">
        <label class="form-label"><strong>Seed traits</strong></label>
        <!-- Length -->
        <div class="col-12 mb-2">
            <label for="rice-seed-length-Edit" class="form-label small-font">Length</label>
            <textarea name="seed_length" id="rice-seed-length-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- width -->
        <div class="col-12 mb-2">
            <label for="rice-seed-width-Edit" class="form-label small-font">Width</label>
            <textarea name="seed_width" id="rice-seed-width-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- seed Shape -->
        <div class="col-12 mb-2">
            <label for="rice-seed-shape-Edit" class="form-label small-font">Shape</label>
            <textarea name="seed_shape" id="rice-seed-shape-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Color-->
        <div class="col-12 mb-2">
            <label for="rice-seed-color-Edit" class="form-label small-font">Color</label>
            <textarea name="seed_color" id="rice-seed-color-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- Flag Leaf traits-->
    <div class="row mb-4">
        <label class="form-label"><strong>Flag Leaf traits</strong></label>
        <!-- Length -->
        <div class="col-12 mb-2">
            <label for="flag-length-Edit" class="form-label small-font">Length</label>
            <textarea name="flag_length" id="flag-length-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- width -->
        <div class="col-12 mb-2">
            <label for="flag-width-Edit" class="form-label small-font">Width</label>
            <textarea name="flag_width" id="flag-width-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Purplish Stripes -->
        <div class="col-12 mb-2">
            <label for="purplishStripes-Edit" class="form-label small-font">Purplish Stripes</label>
            <textarea name="purplish_stripes" id="purplishStripes-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Pubescence -->
        <div class="col-12 mb-2">
            <label for="Pubescence-Edit" class="form-label small-font">Pubescence</label>
            <textarea name="pubescence" id="Pubescence-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- other_remarkable_feature-->
        <div class="col-12 mb-2">
            <label for="flag-features-Edit" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="flag_remarkable_features" id="flag-features-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>
</div>