<h4>Vegetative Traits</h4>
<br>
<!-- Morphological traits -->
<!-- plant height -->
<div class="row">
    <!-- Plant Height -->
    <label>Plant Height</label>
    <div class="mb-4">
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="height-tall">Tall</label>
            <input class="form-check-input" type="radio" name="plant_height" id="height-tall" value="Tall" required>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="height-average">Average</label>
            <input class="form-check-input" type="radio" name="plant_height" id="height-average" value="Average" required>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="height-short">Short</label>
            <input class="form-check-input" type="radio" name="plant_height" id="height-short" value="Short" required>
        </div>
    </div>
</div>
<!-- Leaf Traits -->
<div class="row mb-4">
    <!-- leaf width -->
    <div class="col">
        <label for="leafWidth">Leaf Width</label>
        <select name="leaf_width" id="leafWidth" class="form-select">
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
        <select name="leaf_length" id="leafLength" class="form-select">
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
        <select name="tillering_ability" id="tilleringAbility" class="form-select">
            <option value="High Tillering">High Tillering</option>
            <option value="Low-tillering">Low-tillering</option>
        </select>
    </div>

    <!-- Maturity Time -->
    <div class="col">
        <label for="maturityTime">Maturity Time</label>
        <select name="maturity_time" id="maturityTime" class="form-select">
            <option value="Early Maturing(3months)">Early Maturing (3months)</option>
            <option value="Late Maturing (4-7months)">Late Maturing (4-7months)</option>
        </select>
    </div>
</div>

<h4>Reproductive Traits</h4>
<br>
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
        <label for="pan_enclosed" class="form-label small-font">Panicle Enclosed By</label>
        <textarea name="panicle_enclosed_by" id="pan_enclosed" cols="30" rows="2" class="form-control"></textarea>
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

    <!-- other_remarkable_feature-->
    <div class="col-12 mb-2">
        <label for="flag-features" class="form-label small-font">Other Remarkable Features</label>
        <textarea name="flag_remarkable_features" id="flag-features" cols="30" rows="2" class="form-control"></textarea>
    </div>
</div>

<h4>Sensory Traits</h4>
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
                <label class="form-check-label" for="Yes">Yes</label>
                <input class="form-check-input" type="radio" name="volume_expansion" id="Yes" value="Yes" required>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="No">No</label>
                <input class="form-check-input" type="radio" name="volume_expansion" id="No" value="No" required>
            </div>
        </div>

        <!-- Glutinous -->
        <div class="col-3">
            <div>
                <label>Glutinous</label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="Yes">Yes</label>
                <input class="form-check-input" type="radio" name="glutinous" id="Yes" value="Yes" required>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="No">No</label>
                <input class="form-check-input" type="radio" name="glutinous" id="No" value="No" required>
            </div>
        </div>

        <!-- Hardness -->
        <div class="col-4">
            <div>
                <label>Hardness</label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="Yes">Yes</label>
                <input class="form-check-input" type="radio" name="hardness" id="Yes" value="Yes" required>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="No">No</label>
                <input class="form-check-input" type="radio" name="hardness" id="No" value="No" required>
            </div>
        </div>
    </div>
</div>

<h4>Growth/Agronomic Traits</h4>
<br>
<!-- Pest, Disease, and Abiotic Resistance -->
<div class="row mb-4">
    <!-- Pest resistance -->
    <label>Pest Resistance</label>
    <div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Yes">Borers</label>
            <input class="form-check-input" type="checkbox" name="rice_borers" id="Yes" value="Borers" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Snail">Snail</label>
            <input class="form-check-input" type="checkbox" name="rice_snail" id="Snail" value="Snail" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Hoppers">Hoppers</label>
            <input class="form-check-input" type="checkbox" name="hoppers" id="Hoppers" value="Hoppers" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="rice-blackBug">Rice Black Bug</label>
            <input class="form-check-input" type="checkbox" name="rice_black_bug" id="rice-blackBug" value="Rice Black Bug" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Leptocorisa">Leptocorisa</label>
            <input class="form-check-input" type="checkbox" name="leptocorisa" id="Leptocorisa" value="Leptocorisa" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="leaf-folder">Leaf Folder</label>
            <input class="form-check-input" type="checkbox" name="leaf_folder" id="leaf-folder" value="Leaf Folder" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="rice-birds">Birds</label>
            <input class="form-check-input" type="checkbox" name="rice_birds" id="rice-birds" value="Birds" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="rice-ants">Ants</label>
            <input class="form-check-input" type="checkbox" name="rice_ants" id="rice-ants" value="Ants" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="rice-armyWorms">Army Worms</label>
            <input class="form-check-input" type="checkbox" name="rice_army_worms" id="rice-armyWorms" value="Army Worms" required>
        </div>
    </div>

    <!-- Disease Resistance -->
    <label>Disease Resistance</label>
    <div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Bacterial">Bacterial</label>
            <input class="form-check-input" type="checkbox" name="bacterial" id="Bacterial" value="Bacterial" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Fungus">Fungus</label>
            <input class="form-check-input" type="checkbox" name="fungus" id="Fungus" value="Fungus" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Viral">Viral</label>
            <input class="form-check-input" type="checkbox" name="viral" id="Viral" value="Viral" required>
        </div>
    </div>

    <!-- Resistance to Abiotic Stress -->
    <label>Resistance to Abiotic Stress</label>
    <div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Drought">Drought</label>
            <input class="form-check-input" type="checkbox" name="rice_drought" id="Drought" value="Drought" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Salinity">Salinity</label>
            <input class="form-check-input" type="checkbox" name="rice_salinity" id="Salinity" value="Salinity" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="Heat">Heat</label>
            <input class="form-check-input" type="checkbox" name="rice_heat" id="Heat" value="Heat" required>
        </div>
        <div class="col-3 form-check form-check-inline">
            <label class="form-check-label" for="harmful-radiation">Harmful Radiation</label>
            <input class="form-check-input" type="checkbox" name="harmful_radiation" id="harmful-radiation" value="Harmful Radiation" required>
        </div>
        <!-- Other -->
        <div class="col-12 mb-2">
            <label for="rice-abiotic-other" class="form-label small-font">Other</label>
            <textarea name="rice_abiotic_other" id="rice-abiotic-other" cols="30" rows="1" class="form-control"></textarea>
        </div>
    </div>
</div>