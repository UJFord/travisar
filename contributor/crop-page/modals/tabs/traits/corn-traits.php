<div id="cornMorph">
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
                <label class="form-check-label" for="corn-height-tall">Tall</label>
                <input class="form-check-input" type="radio" name="corn_plant_height" id="corn-height-tall" value="Tall">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="corn-height-average">Average</label>
                <input class="form-check-input" type="radio" name="corn_plant_height" id="corn-height-average" value="Average">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="corn-height-short">Short</label>
                <input class="form-check-input" type="radio" name="corn_plant_height" id="corn-height-short" value="Short">
            </div>
        </div>
    </div>

    <!-- Leaf Traits -->
    <div class="row mb-4">
        <!-- leaf width -->
        <div class="col">
            <label for="corn-leafWidth">Leaf Width</label>
            <select name="corn_leaf_width" id="corn-leafWidth" class="form-select">
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col">
            <label for="corn-leafLength">Leaf Length</label>
            <select name="corn_leaf_length" id="corn-leafLength" class="form-select">
                <option value="Short">Short</option>
                <option value="Average">Average</option>
                <option value="Long">Long</option>
            </select>
        </div>
    </div>

    <!-- maturity time -->
    <!-- <div class="row mb-4">
        <div class="col">
            <label for="corn-maturityTime">Maturity Time</label>
            <select name="corn_maturity_time" id="corn-maturityTime" class="form-select">
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
            <label for="corn-yield-capacity" class="form-label small-font">Yield Capacity</label>
            <textarea name="corn_yield_capacity" id="corn-yield-capacity" cols="30" rows="1" class="form-control"></textarea>
        </div>
    </div>

    <!-- Seed traits-->
    <div class="row mb-4">
        <label class="form-label"><strong>Seed traits</strong></label>
        <!-- Length -->
        <div class="col-12 mb-2">
            <label for="corn-seed-length" class="form-label small-font">Length</label>
            <textarea name="seed_length" id="corn-seed-length" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- width -->
        <div class="col-12 mb-2">
            <label for="corn-seed-width" class="form-label small-font">Width</label>
            <textarea name="seed_width" id="corn-seed-width" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- seed Shape -->
        <div class="col-12 mb-2">
            <label for="corn-seed-shape" class="form-label small-font">Shape</label>
            <textarea name="seed_shape" id="corn-seed-shape" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Color-->
        <div class="col-12 mb-2">
            <label for="corn-seed-color" class="form-label small-font">Color</label>
            <textarea name="seed_color" id="corn-seed-color" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <h4>Growth/Agronomic Traits</h4>
    <br>
    <!-- Pest, Disease, and Abiotic Resistance -->
    <div class="row mb-4">
        <!-- Pest resistance -->
        <label><strong>Pest Resistance</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="cornBorers">Borers</label>
                <input class="form-check-input" type="checkbox" name="corn_borers" id="cornBorers" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="Earworm">Earworm</label>
                <input class="form-check-input" type="checkbox" name="earworms" id="Earworm" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="spider-mites">Spider Mites</label>
                <input class="form-check-input" type="checkbox" name="spider_mites" id="spider-mites" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-blackBug">Black Bug</label>
                <input class="form-check-input" type="checkbox" name="corn_black_bug" id="corn-blackBug" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-army-worms">Army Worms</label>
                <input class="form-check-input" type="checkbox" name="corn_army_worms" id="corn-army-worms" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="leaf-aphid">Leaf Aphid</label>
                <input class="form-check-input" type="checkbox" name="leaf_aphid" id="leaf-aphid" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-cutWorms">Cutworms</label>
                <input class="form-check-input" type="checkbox" name="corn_cutWorms" id="corn-cutWorms" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-Birds">Birds</label>
                <input class="form-check-input" type="checkbox" name="corn_birds" id="rice-Birds" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-ants">Ants</label>
                <input class="form-check-input" type="checkbox" name="corn_ants" id="corn-ants" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-rats">Rats</label>
                <input class="form-check-input" type="checkbox" name="corn_rats" id="corn-rats" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-other-check">other</label>
                <input class="form-check-input" type="checkbox" name="corn_others" id="corn-other-check" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2 corn-pest-other d-none">
                <label for="corn-other" class="form-label small-font">Other</label>
                <textarea name="corn_others_desc" id="corn-other" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>

        <!-- Disease Resistance -->
        <label><strong>Disease Resistance</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Bacterial">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="corn-Bacterial" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Fungus">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="corn-Fungus" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Viral">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="corn-Viral" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <label><strong>Resistance to Abiotic Stress</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Drought">Drought</label>
                <input class="form-check-input" type="checkbox" name="drought" id="corn-Drought" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Salinity">Salinity</label>
                <input class="form-check-input" type="checkbox" name="salinity" id="corn-Salinity" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Heat">Heat</label>
                <input class="form-check-input" type="checkbox" name="heat" id="corn-Heat" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-abiotic-check">other</label>
                <input class="form-check-input" type="checkbox" name="abiotic_other" id="corn-abiotic-check" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2">
                <label for="corn-abiotic-other" class="form-label small-font">Other</label>
                <textarea name="abiotic_other_desc" id="corn-abiotic-other" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>