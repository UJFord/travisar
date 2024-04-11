<div id="root_cropMorph-Edit">
    <h4>Vegetative Traits</h4>
    <br>
    <!-- Morphological traits -->
    <!-- plant height -->
    <div class="row">
        <!-- Plant Height -->
        <label>Plant Height</label>
        <div class="mb-4">
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-height-tall-edit">Tall</label>
                <input class="form-check-input" type="radio" name="rootcrop_plant_height" id="rootCrop-height-tall-edit" value="Tall">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-height-average-edit">Average</label>
                <input class="form-check-input" type="radio" name="rootcrop_plant_height" id="rootCrop-height-average-edit" value="Average">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-height-short-edit">Short</label>
                <input class="form-check-input" type="radio" name="rootcrop_plant_height" id="rootCrop-height-short-edit" value="Short">
            </div>
        </div>
    </div>

    <!-- Leaf Traits -->
    <div class="row mb-4">
        <!-- leaf width -->
        <div class="col">
            <label for="rootCrop-leafWidth-Edit">Leaf Width</label>
            <select name="rootcrop_leaf_width" id="rootCrop-leafWidth-Edit" class="form-select">
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col">
            <label for="rootCrop-leafLength-Edit">Leaf Length</label>
            <select name="rootcrop_leaf_length" id="rootCrop-leafLength-Edit" class="form-select">
                <option value="Short">Short</option>
                <option value="Average">Average</option>
                <option value="Long">Long</option>
            </select>
        </div>
    </div>

    <!-- stem and leaf desc -->
    <div class="row mb-4">
        <div class="col-12 mb-2">
            <label for="rootCrop-steam-leaf-desc-Edit" class="form-label">Stem and Leaf Description</label>
            <textarea name="rootcrop_stem_leaf_desc" id="rootCrop-steam-leaf-desc-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
    </div>

    <!-- maturity time -->
    <!-- <div class="row mb-4">
        <div class="col">
            <label for="rootCrop-maturityTime">Maturity Time</label>
            <select name="rootcrop_maturity_time" id="rootCrop-maturityTime" class="form-select">
                <option value="Early Maturing(3months)">Early Maturing (3months)</option>
                <option value="Late Maturing (4-7months)">Late Maturing (4-7months)</option>
            </select>
        </div>
    </div> -->

    <h4>Root Crop Traits</h4>
    <br>
    <!-- Root Crop Traits -->
    <div class="row mb-4">
        <div class="col-12 mb-2">
            <label for="rootCrop-eating-quality-Edit" class="form-label small-font">Eating Quality</label>
            <textarea name="eating_quality" id="rootCrop-eating-quality-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-color-Edit" class="form-label small-font">Color</label>
            <textarea name="rootcrop_color" id="rootCrop-color-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-sweetness-Edit" class="form-label small-font">Sweetness</label>
            <textarea name="sweetness" id="rootCrop-sweetness-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-remarkableFeatures-Edit" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="rootcrop_remarkable_features" id="rootCrop-remarkableFeatures-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>
    </div>

    <h4>Growth/Agronomic Traits</h4>
    <br>
    <!-- Pest, Disease, and Abiotic Resistance -->
    <div class="row mb-4">
        <!-- Pest resistance -->
        <label><strong>Pest resistance</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootAphids-Edit">Root Aphids</label>
                <input class="form-check-input" type="checkbox" name="root_aphids" id="rootAphids-Edit" value="1">
            </div>
            <div class="col-6 form-check form-check-inline">
                <label class="form-check-label" for="root-knot-nematodes-Edit">Root-knot Nematodes (Meloidogyne spp.)</label>
                <input class="form-check-input" type="checkbox" name="root_knot_nematodes" id="root-knot-nematodes-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-cutworms-Edit">Cutworms</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_cutworms" id="rootCrop-cutworms-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-whiteGRubs-Edit">White Grubs</label>
                <input class="form-check-input" type="checkbox" name="white_grubs" id="rootCrop-whiteGRubs-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="Termites-Edit">Termites</label>
                <input class="form-check-input" type="checkbox" name="termites" id="Termites-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="Weevils-Edit">Weevils</label>
                <input class="form-check-input" type="checkbox" name="weevils" id="Weevils-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="flea-beetles-Edit">Flea Beetles</label>
                <input class="form-check-input" type="checkbox" name="flea_beetles" id="flea-beetles-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-snails-Edit">Snails</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_snails" id="rootCrop-snails-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-ants-Edit">Ants</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_ants" id="rootCrop-ants-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-rats-Edit">Rats</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_rats" id="rootCrop-rats-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-other-check-Edit">Other</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_others" id="rootCrop-other-check-Edit" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2 rootCrop-other">
                <label for="rootCrop-other-Edit" class="form-label small-font">Other</label>
                <textarea name="rootcrop_others_desc" id="rootCrop-other-Edit" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>

        <!-- Disease Resistance -->
        <label><strong>Disease Resistance</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Bacterial-Edit">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="rootCrop-Bacterial-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Fungus-Edit">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="rootCrop-Fungus-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Viral-Edit">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="rootCrop-Viral-Edit" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <label><strong>Resistance to Abiotic Stress</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Drought-Edit">Drought</label>
                <input class="form-check-input" type="checkbox" name="drought" id="rootCrop-Drought-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Salinity-Edit">Salinity</label>
                <input class="form-check-input" type="checkbox" name="salinity" id="rootCrop-Salinity-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Heat-Edit">Heat</label>
                <input class="form-check-input" type="checkbox" name="heat" id="rootCrop-Heat-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-abiotic-Edit">Other</label>
                <input class="form-check-input" type="checkbox" name="abiotic_other" id="rootCrop-abiotic-Edit" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2 rootCrop-abiotic-other">
                <label for="rootCrop-abiotic-other-Edit" class="form-label small-font">Other</label>
                <textarea name="abiotic_other_desc" id="rootCrop-abiotic-other-Edit" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>