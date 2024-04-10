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
                <label class="form-check-label" for="rootCrop-height-tall">Tall</label>
                <input class="form-check-input" type="radio" name="rootcrop_plant_height" id="rootCrop-height-tall" value="Tall">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-height-average">Average</label>
                <input class="form-check-input" type="radio" name="rootcrop_plant_height" id="rootCrop-height-average" value="Average">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-height-short">Short</label>
                <input class="form-check-input" type="radio" name="rootcrop_plant_height" id="rootCrop-height-short" value="Short">
            </div>
        </div>
    </div>

    <!-- Leaf Traits -->
    <div class="row mb-4">
        <!-- leaf width -->
        <div class="col">
            <label for="rootCrop-leafWidth">Leaf Width</label>
            <select name="rootcrop_leaf_width" id="rootCrop-leafWidth" class="form-select">
                <option value="Narrow">Narrow</option>
                <option value="Average">Average</option>
                <option value="Wide">Wide</option>
            </select>
        </div>

        <!-- leaf length -->
        <div class="col">
            <label for="rootCrop-leafLength">Leaf Length</label>
            <select name="rootcrop_leaf_length" id="rootCrop-leafLength" class="form-select">
                <option value="Short">Short</option>
                <option value="Average">Average</option>
                <option value="Long">Long</option>
            </select>
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
            <label for="rootCrop-eating-quality" class="form-label small-font">Eating Quality</label>
            <textarea name="eating_quality" id="rootCrop-eating-quality" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-color" class="form-label small-font">Color</label>
            <textarea name="rootCrop_color" id="rootCrop-color" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-sweetness" class="form-label small-font">Sweetness</label>
            <textarea name="sweetness" id="rootCrop-sweetness" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-12 mb-2">
            <label for="rootCrop-remarkableFeatures" class="form-label small-font">Other Remarkable Features</label>
            <textarea name="rootCrop_remarkable_features" id="rootCrop-remarkableFeatures" cols="30" rows="1" class="form-control"></textarea>
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
                <label class="form-check-label" for="rootAphids">Root Aphids</label>
                <input class="form-check-input" type="checkbox" name="root_aphids" id="rootAphids" value="1">
            </div>
            <div class="col-6 form-check form-check-inline">
                <label class="form-check-label" for="root-knot-nematodes">Root-knot Nematodes (Meloidogyne spp.)</label>
                <input class="form-check-input" type="checkbox" name="root_knot_nematodes" id="root-knot-nematodes" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-cutworms">Cutworms</label>
                <input class="form-check-input" type="checkbox" name="rootCrop_cutWorms" id="rootCrop-cutworms" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-whiteGRubs">White Grubs</label>
                <input class="form-check-input" type="checkbox" name="white_grubs" id="rootCrop-whiteGRubs" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="Termites">Termites</label>
                <input class="form-check-input" type="checkbox" name="termites" id="Termites" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="Weevils">Weevils</label>
                <input class="form-check-input" type="checkbox" name="weevils" id="Weevils" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="flea-beetles">Flea Beetles</label>
                <input class="form-check-input" type="checkbox" name="flea_beetles" id="flea-beetles" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-snails">Snails</label>
                <input class="form-check-input" type="checkbox" name="rootCrop_snails" id="rootCrop-snails" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-ants">Ants</label>
                <input class="form-check-input" type="checkbox" name="rootCrop_ants" id="rootCrop-ants" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-rats">Rats</label>
                <input class="form-check-input" type="checkbox" name="rootCrop_rats" id="rootCrop-rats" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2">
                <label for="rootCrop-other" class="form-label small-font">Other</label>
                <textarea name="rootCrop_others" id="rootCrop-other" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>

        <!-- Disease Resistance -->
        <label><strong>Disease Resistance</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Bacterial">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="rootCrop-Bacterial" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Fungus">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="rootCrop-Fungus" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Viral">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="rootCrop-Viral" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <label><strong>Resistance to Abiotic Stress</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Drought">Drought</label>
                <input class="form-check-input" type="checkbox" name="drought" id="rootCrop-Drought" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Salinity">Salinity</label>
                <input class="form-check-input" type="checkbox" name="salinity" id="rootCrop-Salinity" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label" for="rootCrop-Heat">Heat</label>
                <input class="form-check-input" type="checkbox" name="heat" id="rootCrop-Heat" value="1">
            </div>
            <!-- Other -->
            <div class="col-12 mb-2">
                <label for="rootCrop-abiotic-other" class="form-label small-font">Other</label>
                <textarea name="abiotic_other" id="rootCrop-abiotic-other" cols="30" rows="1" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>