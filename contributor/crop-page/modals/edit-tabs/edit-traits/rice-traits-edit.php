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
                <input class="form-check-input" type="radio" name="plant_height" id="height-tall-Edit" value="Tall">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="height-average-Edit">Average</label>
                <input class="form-check-input" type="radio" name="plant_height" id="height-average-Edit" value="Average">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="height-short-Edit">Short</label>
                <input class="form-check-input" type="radio" name="plant_height" id="height-short-Edit" value="Short">
            </div>
        </div>
    </div>
    <!-- Leaf Traits -->
    <div class="row mb-4">
        <!-- leaf width -->
        <div class="col">
            <label for="leafWidth-Edit">Leaf Width</label>
            <select name="leaf_width" id="leafWidth-Edit" class="form-select">
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
            <select name="leaf_length" id="leafLength-Edit" class="form-select">
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
            <select name="tillering_ability" id="tilleringAbility-Edit" class="form-select">
                <option value="High Tillering">High Tillering</option>
                <option value="Low-tillering">Low-tillering</option>
            </select>
        </div>

        <!-- Maturity Time -->
        <div class="col">
            <label for="maturityTime-Edit">Maturity Time</label>
            <select name="maturity_time" id="maturityTime-Edit" class="form-select">
                <option value="Early Maturing(3months)">Early Maturing (3months)</option>
                <option value="Late Maturing (4-7months)">Late Maturing (4-7months)</option>
            </select>
        </div>
    </div>

    <label class="form-label"><strong>Reproductive state</strong></label>
    <br>
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
            <label for="pan_enclosed-Edit" class="form-label small-font">Panicle Enclosed By</label>
            <textarea name="panicle_enclosed_by" id="pan_enclosed-Edit" cols="30" rows="2" class="form-control"></textarea>
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
            <label for="seed-length-Edit" class="form-label small-font">Length</label>
            <textarea name="seed_length" id="seed-length-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- width -->
        <div class="col-12 mb-2">
            <label for="seed-width-Edit" class="form-label small-font">Width</label>
            <textarea name="seed_width" id="seed-width-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- seed Shape -->
        <div class="col-12 mb-2">
            <label for="seed-shape-Edit" class="form-label small-font">Shape</label>
            <textarea name="seed_shape" id="seed-shape-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Color-->
        <div class="col-12 mb-2">
            <label for="seed-color-Edit" class="form-label small-font">Color</label>
            <textarea name="seed_color" id="seed-color-Edit" cols="30" rows="2" class="form-control"></textarea>
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

        <!-- other_remarkable_feature-->
        <div class="col-12 mb-2">
            <label for="flag-features-Edit" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="flag_remarkable_features" id="flag-features-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <h4>Sensory Traits of Cooked Rice</h4>
    <br>
    <!-- sensory traits-->
    <div class="row mb-4">
        <!-- Aroma -->
        <div class="col-12 mb-2">
            <label for="sensory-aroma-Edit" class="form-label small-font">Aroma</label>
            <textarea name="aroma" id="sensory-aroma-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Quality of Cooked Rice -->
        <div class="col-12 mb-2">
            <label for="cooked-rice-Edit" class="form-label small-font">Quality of Cooked Rice</label>
            <textarea name="quality_cooked_rice" id="cooked-rice-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Quality of Leftover Rice -->
        <div class="col-12 mb-2">
            <label for="leftover-rice-Edit" class="form-label small-font">Quality of Leftover Rice</label>
            <textarea name="quality_leftover_rice" id="leftover-rice-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Volume, Glutinous, and Hardness -->
        <div class="row">
            <!-- Volume Expansion -->
            <div class="col-5">
                <div>
                    <label>Volume Expansion (does it rise?)</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="expansion-Yes-Edit">Yes</label>
                    <input class="form-check-input" type="radio" name="volume_expansion" id="expansion-Yes-Edit" value="Yes">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="expansion-No-Edit">No</label>
                    <input class="form-check-input" type="radio" name="volume_expansion" id="expansion-No-Edit" value="No">
                </div>
            </div>

            <!-- Glutinous -->
            <div class="col-3">
                <div>
                    <label>Glutinous</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="glutinous-Yes-Edit">Yes</label>
                    <input class="form-check-input" type="radio" name="glutinous" id="glutinous-Yes-Edit" value="Yes">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="glutinous-No-Edit">No</label>
                    <input class="form-check-input" type="radio" name="glutinous" id="glutinous-No-Edit" value="No">
                </div>
            </div>

            <!-- Hardness -->
            <div class="col-4">
                <div>
                    <label>Hardness</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hardness-Soft-Edit">Soft</label>
                    <input class="form-check-input" type="radio" name="hardness" id="hardness-Soft-Edit" value="Soft">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hardness-Hard-Edit">Hard</label>
                    <input class="form-check-input" type="radio" name="hardness" id="hardness-Hard-Edit" value="Hard">
                </div>
            </div>
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
                <label class="form-check-label" for="riceBorers-Edit">Borers</label>
                <input class="form-check-input" type="checkbox" name="rice_borers" id="riceBorers-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="riceSnail-Edit">Snail</label>
                <input class="form-check-input" type="checkbox" name="rice_snail" id="riceSnail-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="Hoppers-Edit">Hoppers</label>
                <input class="form-check-input" type="checkbox" name="hoppers" id="Hoppers-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-blackBug-Edit">Rice Black Bug</label>
                <input class="form-check-input" type="checkbox" name="rice_black_bug" id="rice-blackBug-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="Leptocorisa-Edit">Leptocorisa</label>
                <input class="form-check-input" type="checkbox" name="leptocorisa" id="Leptocorisa-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="leaf-folder-Edit">Leaf Folder</label>
                <input class="form-check-input" type="checkbox" name="leaf_folder" id="leaf-folder-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-birds-Edit">Birds</label>
                <input class="form-check-input" type="checkbox" name="rice_birds" id="rice-birds-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-ants-Edit">Ants</label>
                <input class="form-check-input" type="checkbox" name="rice_ants" id="rice-ants-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-Rats-Edit">Rats</label>
                <input class="form-check-input" type="checkbox" name="rice_rats" id="rice-Rats-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-armyWorms-Edit">Army Worms</label>
                <input class="form-check-input" type="checkbox" name="rice_army_worms" id="rice-armyWorms-Edit" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2">
                <label for="rice-other-Edit" class="form-label small-font">Other</label>
                <textarea name="rice_others" id="rice-other-Edit" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>

        <!-- Disease Resistance -->
        <label><strong>Disease Resistance</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-Bacterial-Edit">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="rice-bacterial" id="rice-Bacterial-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-Fungus-Edit">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="rice-Fungus-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-Viral-Edit">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="rice-Viral-Edit" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <label><strong>Resistance to Abiotic Stress</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="riceDrought-Edit">Drought</label>
                <input class="form-check-input" type="checkbox" name="rice_drought" id="riceDrought-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="riceSalinity-Edit">Salinity</label>
                <input class="form-check-input" type="checkbox" name="rice_salinity" id="riceSalinity-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="riceHeat-Edit">Heat</label>
                <input class="form-check-input" type="checkbox" name="rice_heat" id="riceHeat-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="harmful-radiation-Edit">Harmful Radiation</label>
                <input class="form-check-input" type="checkbox" name="harmful_radiation" id="harmful-radiation-Edit" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2">
                <label for="rice-abiotic-other-Edit" class="form-label small-font">Other</label>
                <textarea name="rice_abiotic_other" id="rice-abiotic-other-Edit" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>