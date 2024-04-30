<div id="riceMorph-draft">
    <!-- vegetative state -->
    <h6 class="fw-semibold mt-4 mb-3">Vegetative State</h6>
    <!-- Plant Height -->
    <div class="row mb-4">
        <div class="col-6">
            <label class="small-font" for="rice_plant_heightDraft">Plant Height</label>
            <select class="form-select" name="rice_plant_heightDraft" id="corn-height">
                <option value="" disabled selected hidden>Select One</option>
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
            <label class="small-font" for="rice_leafWidthDraft">Leaf Width</label>
            <select name="rice_leaf_width" id="rice_leafWidthDraft" class="form-select">
                <option value="" disabled selected hidden>Select One</option>
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
                <option value="With Purplish Stripes">With Purplish Stripes</option>
                <option value="Pubescence">Pubescence</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col-6">
            <label class="small-font" for="rice_leafLengthDraft">Leaf Length</label>
            <select name="rice_leaf_length" id="rice_leafLengthDraft" class="form-select">
                <option value="" disabled selected hidden>Select One</option>
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
            <label for="rice_tilleringAbilityDraft" class="form-label small-font">Tillering Ability</label>
            <select name="rice_tillering_ability" id="rice_tilleringAbilityDraft" class="form-select">
                <option value="" disabled selected hidden>Select One</option>
                <option value="High Tillering">High Tillering</option>
                <option value="Low-tillering">Low-tillering</option>
            </select>
        </div>

        <!-- Maturity Time -->
        <div class="col">
            <label for="rice_maturityTimeDraft" class="form-label small-font">Maturity Time</label>
            <select name="rice_maturity_time" id="rice_maturityTimeDraft" class="form-select">
                <option value="" disabled selected hidden>Select One</option>
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
            <label for="rice-yield-capacityDraft" class="form-label small-font">Yield Capacity</label>
            <select name="rice_yield_capacity" id="rice-yield-capacityDraft" class="form-select">
                <option value="" disabled selected hidden>Select One</option>
                <option value="Low-Yielding">Low-Yielding</option>
                <option value="High-Yielding">High-Yielding</option>
            </select>
        </div>
    </div>

    <!-- Panicle traits-->
    <div class="row mb-5">
        <!-- Length -->
        <div class="col-6 mb-2">
            <label for="pan-lengthDraft" class="form-label small-font">Panicle Length</label>
            <input type="text" name="panicle_length" id="pan-lengthDraft" class="form-control">
        </div>

        <!-- width -->
        <div class="col-6 mb-2">
            <label for="pan-widthDraft" class="form-label small-font">Panicle Width</label>
            <input type="text" name="panicle_width" id="pan-widthDraft" class="form-control">
        </div>

        <!-- panicle enclosed by -->
        <div class="col-6 mb-2">
            <label for="pan-enclosedDraft" class="form-label small-font">Panicle Enclosed By</label>
            <input type="text" name="panicle_enclosed_by" id="pan-enclosedDraft" class="form-control">
        </div>

        <!-- other_remarkable_feature-->
        <div class="col-12 mb-0">
            <label for="panicle-featuresDraft" class="form-label small-font">Other Remarkable Features</label>
            <textarea class="form-control" name="panicle_remarkable_featuresDraft" id="pan-features" rows="3"></textarea>
        </div>
    </div>

    <!-- Seed traits-->
    <div class="row mb-5">
        <!-- Length -->
        <div class="col-6 mb-2">
            <label for="rice-seed-lengthDraft" class="form-label small-font">Seed Length</label>
            <!-- <textarea name="seed_length" id="seed-length" cols="30" rows="1" class="form-control"></textarea> -->
            <input type="text" name="seed_length" id="seed-lengthDraft" class="form-control">
        </div>

        <!-- width -->
        <div class="col-6 mb-2">
            <label for="rice-seed-widthDraft" class="form-label small-font">Seed Width</label>
            <!-- <textarea name="seed_width" id="seed-width" cols="30" rows="1" class="form-control"></textarea> -->
            <input type="text" name="seed_width" id="seed-widthDraft" class="form-control">
        </div>

        <!-- Seed Shape -->
        <div class="col-6 mb-0">
            <label for="rice-seed-shapeDraft" class="form-label small-font">Seed Shape</label>
            <!-- <textarea name="seed_shape" id="seed-shape" cols="30" rows="2" class="form-control"></textarea> -->
            <input type="text" name="seed_shape" id="seed-shapeDraft" class="form-control">
        </div>

        <!-- Color-->
        <div class="col-6 mb-0">
            <label for="rice-seed-colorDraft" class="form-label small-font">Seed Color</label>
            <!-- <textarea name="seed_color" id="seed-color" cols="30" rows="2" class="form-control"></textarea> -->
            <input type="text" name="seed_color" id="seed-colorDraft" class="form-control">
        </div>
    </div>

    <!-- Flag Leaf traits-->
    <div class="row mb-2">
        <!-- Length -->
        <div class="col-6 mb-2">
            <label for="flag-lengthDraft" class="form-label small-font">Flag Leaf Length</label>
            <input type="text" name="flag_length" id="flag-lengthDraft" class="form-control">
        </div>

        <!-- width -->
        <div class="col-6 mb-2">
            <label for="flag-widthDraft" class="form-label small-font">Flag Leaf Width</label>
            <input type="text" name="flag_width" id="flag-widthDraft" class="form-control">
        </div>

        <!-- Pubescence -->
        <div class="col-6 mb-2">
            <label for="PubescenceDraft" class="form-label small-font">Pubescence</label>
            <input type="text" name="pubescence" id="PubescenceDraft" class="form-control">
        </div>

        <!-- Purplish Stripes -->
        <div class="col-6 mb-2 form-check form-switch px-5 py-3">
            <!-- <label for="purplishStripes" class="form-label small-font">Purplish Stripes?</label>
            <textarea name="purplish_stripes" id="purplishStripes" cols="30" rows="2" class="form-control"></textarea> -->
            <input class="form-check-inputDraft" name="purplish_stripes" type="checkbox" role="switch" id="purplishStripesDraft" value="1">
            <label class="form-check-label small-font" for="purplishStripesDraft">With Purplish Stripes?</label>
        </div>

        <!-- other_remarkable_feature-->
        <div class="col-12 mb-3">
            <label for="flag-featuresDraft" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="flag_remarkable_features" id="flag-featuresDraft" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>
</div>