<div id="riceMorph">
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
                <label class="form-check-label" for="height-tall">Tall</label>
                <input class="form-check-input" type="radio" name="rice_plant_height" id="height-tall" value="Tall">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="height-average">Average</label>
                <input class="form-check-input" type="radio" name="rice_plant_height" id="height-average" value="Average">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="height-short">Short</label>
                <input class="form-check-input" type="radio" name="rice_plant_height" id="height-short" value="Short">
            </div>
        </div>
    </div>
    <!-- Leaf Traits -->
    <div class="row mb-4">
        <!-- leaf width -->
        <div class="col">
            <label for="leafWidth">Leaf Width</label>
            <select name="rice_leaf_width" id="leafWidth" class="form-select">
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
                <option value="With Purplish Stripes">With Purplish Stripes</option>
                <option value="Pubescence">Pubescence</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col">
            <label for="leafLength">Leaf Length</label>
            <select name="rice_leaf_length" id="leafLength" class="form-select">
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
            <label for="tilleringAbility">Tillering Ability</label>
            <select name="rice_tillering_ability" id="tilleringAbility" class="form-select">
                <option value="High Tillering">High Tillering</option>
                <option value="Low-tillering">Low-tillering</option>
            </select>
        </div>

        <!-- Maturity Time -->
        <div class="col">
            <label for="maturityTime">Maturity Time</label>
            <select name="rice_maturity_time" id="maturityTime" class="form-select">
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
            <label for="rice-yield-capacity" class="form-label small-font">Yield Capacity</label>
            <textarea name="rice_yield_capacity" id="rice-yield-capacity" cols="30" rows="1" class="form-control"></textarea>
        </div>
    </div>

    <!-- Panicle traits-->
    <div class="row mb-4">
        <label class="form-label"><strong>Panicle traits</strong></label>
        <!-- Length -->
        <div class="col-12 mb-2">
            <label for="pan-length" class="form-label small-font">Length</label>
            <textarea name="panicle_length" id="pan-length" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- width -->
        <div class="col-12 mb-2">
            <label for="pan-width" class="form-label small-font">Width</label>
            <textarea name="panicle_width" id="pan-width" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- panicle enclosed by -->
        <div class="col-12 mb-2">
            <label for="pan-enclosed" class="form-label small-font">Panicle Enclosed By</label>
            <textarea name="panicle_enclosed_by" id="pan-enclosed" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- other_remarkable_feature-->
        <div class="col-12 mb-2">
            <label for="panicle-features" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="panicle_remarkable_features" id="panicle-features" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- Seed traits-->
    <div class="row mb-4">
        <label class="form-label"><strong>Seed traits</strong></label>
        <!-- Length -->
        <div class="col-12 mb-2">
            <label for="seed-length" class="form-label small-font">Length</label>
            <textarea name="seed_length" id="seed-length" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- width -->
        <div class="col-12 mb-2">
            <label for="seed-width" class="form-label small-font">Width</label>
            <textarea name="seed_width" id="seed-width" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- seed Shape -->
        <div class="col-12 mb-2">
            <label for="seed-shape" class="form-label small-font">Shape</label>
            <textarea name="seed_shape" id="seed-shape" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Color-->
        <div class="col-12 mb-2">
            <label for="seed-color" class="form-label small-font">Color</label>
            <textarea name="seed_color" id="seed-color" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- Flag Leaf traits-->
    <div class="row mb-4">
        <label class="form-label"><strong>Flag Leaf traits</strong></label>
        <!-- Length -->
        <div class="col-12 mb-2">
            <label for="flag-length" class="form-label small-font">Length</label>
            <textarea name="flag_length" id="flag-length" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- width -->
        <div class="col-12 mb-2">
            <label for="flag-width" class="form-label small-font">Width</label>
            <textarea name="flag_width" id="flag-width" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Purplish Stripes -->
        <div class="col-12 mb-2">
            <label for="purplishStripes" class="form-label small-font">Purplish Stripes</label>
            <textarea name="purplish_stripes" id="purplishStripes" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Pubescence -->
        <div class="col-12 mb-2">
            <label for="Pubescence" class="form-label small-font">Pubescence</label>
            <textarea name="pubescence" id="Pubescence" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- other_remarkable_feature-->
        <div class="col-12 mb-2">
            <label for="flag-features" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="flag_remarkable_features" id="flag-features" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <h4>Sensory Traits of Cooked Rice</h4>
    <br>
    <!-- sensory traits-->
    <div class="row mb-4">
        <!-- Aroma -->
        <div class="col-12 mb-2">
            <label for="sensory-aroma" class="form-label small-font">Aroma</label>
            <textarea name="aroma" id="sensory-aroma" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Quality of Cooked Rice -->
        <div class="col-12 mb-2">
            <label for="cooked-rice" class="form-label small-font">Quality of Cooked Rice</label>
            <textarea name="quality_cooked_rice" id="cooked-rice" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Quality of Leftover Rice -->
        <div class="col-12 mb-2">
            <label for="leftover-rice" class="form-label small-font">Quality of Leftover Rice</label>
            <textarea name="quality_leftover_rice" id="leftover-rice" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Volume, Glutinous, and Hardness -->
        <div class="row">
            <!-- Volume Expansion -->
            <div class="col-5">
                <div>
                    <label>Volume Expansion (does it rise?)</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="expansion-Yes">Yes</label>
                    <input class="form-check-input" type="radio" name="volume_expansion" id="expansion-Yes" value="Yes">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="expansion-No">No</label>
                    <input class="form-check-input" type="radio" name="volume_expansion" id="expansion-No" value="No">
                </div>
            </div>

            <!-- Glutinous -->
            <div class="col-3">
                <div>
                    <label>Glutinous</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="glutinous-Yes">Yes</label>
                    <input class="form-check-input" type="radio" name="glutinous" id="glutinous-Yes" value="Yes">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="glutinous-No">No</label>
                    <input class="form-check-input" type="radio" name="glutinous" id="glutinous-No" value="No">
                </div>
            </div>

            <!-- Hardness -->
            <div class="col-4">
                <div>
                    <label>Hardness</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hardness-Soft">Soft</label>
                    <input class="form-check-input" type="radio" name="hardness" id="hardness-Soft" value="Soft">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hardness-Hard">Hard</label>
                    <input class="form-check-input" type="radio" name="hardness" id="hardness-Hard" value="Hard">
                </div>
            </div>
        </div>
    </div>
</div>