<div id="cornMorph-Edit">
    <!-- hidden id's -->
    <input type="hidden" name="crop_traits_id" id="cropTraits_id">
    <input type="hidden" name="crop_traits_id" id="cropTraits_id">
    <input type="hidden" name="crop_traits_id" id="cropTraits_id">
    <input type="hidden" name="crop_traits_id" id="cropTraits_id">
    <input type="hidden" name="crop_traits_id" id="cropTraits_id">


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

    <h4>Growth/Agronomic Traits</h4>
    <br>
    <!-- Pest, Disease, and Abiotic Resistance -->
    <div class="row mb-4">
        <!-- Pest resistance -->
        <label><strong>Pest Resistance</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="cornBorers-Edit">Borers</label>
                <input class="form-check-input" type="checkbox" name="corn_borers" id="cornBorers-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="Earworm-Edit">Earworm</label>
                <input class="form-check-input" type="checkbox" name="earworms" id="Earworm-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="spider-mites-Edit">Spider Mites</label>
                <input class="form-check-input" type="checkbox" name="spider_mites" id="spider-mites-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-blackBug-Edit">Black Bug</label>
                <input class="form-check-input" type="checkbox" name="corn_black_bug" id="corn-blackBug-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-army-worms-Edit">Army Worms</label>
                <input class="form-check-input" type="checkbox" name="corn_army_worms" id="corn-army-worms-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="leaf-aphid-Edit">Leaf Aphid</label>
                <input class="form-check-input" type="checkbox" name="leaf_aphid" id="leaf-aphid-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-cutWorms-Edit">Cutworms</label>
                <input class="form-check-input" type="checkbox" name="corn_cutWorms" id="corn-cutWorms-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rice-Birds-Edit">Birds</label>
                <input class="form-check-input" type="checkbox" name="corn_birds" id="rice-Birds-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-ants-Edit">Ants</label>
                <input class="form-check-input" type="checkbox" name="corn_ants" id="corn-ants-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-rats-Edit">Rats</label>
                <input class="form-check-input" type="checkbox" name="corn_rats" id="corn-rats-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-other-check-Edit">other</label>
                <input class="form-check-input" type="checkbox" name="corn_others" id="corn-other-check-Edit" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2 corn-pest-other-edit">
                <label for="corn-other-Edit" class="form-label small-font">Other</label>
                <textarea name="corn_others_desc" id="corn-other-Edit" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>

        <!-- Disease Resistance -->
        <label><strong>Disease Resistance</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Bacterial-Edit">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="corn-Bacterial-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Fungus-Edit">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="corn-Fungus-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Viral-Edit">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="corn-Viral-Edit" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <label><strong>Resistance to Abiotic Stress</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Drought-Edit">Drought</label>
                <input class="form-check-input" type="checkbox" name="drought" id="corn-Drought-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Salinity-Edit">Salinity</label>
                <input class="form-check-input" type="checkbox" name="salinity" id="corn-Salinity-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-Heat-Edit">Heat</label>
                <input class="form-check-input" type="checkbox" name="heat" id="corn-Heat-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="corn-abiotic-other-check-Edit">abiotic-other</label>
                <input class="form-check-input" type="checkbox" name="abiotic_other" id="corn-abiotic-other-check-Edit" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2 corn-abiotic-other">
                <label for="corn-abiotic-other-Edit" class="form-label small-font">Other</label>
                <textarea name="abiotic_other_desc" id="corn-abiotic-other-Edit" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>