<!-- MORE TAB -->
<div class="fade tab-pane" id="agro-tab-pane" role="tabpanel" aria-labelledby="agro-tab" tabindex="0">

    <!-- Corn Agronomic Traits -->
    <div id="cornAgro">

        <!-- pest resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Pest Resistance</h6>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="cornBorers">Borers</label>
                <input class="form-check-input" type="checkbox" name="corn_borers" id="cornBorers" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Earworm">Earworms</label>
                <input class="form-check-input" type="checkbox" name="earworms" id="Earworm" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="spider-mites">Spider Mites</label>
                <input class="form-check-input" type="checkbox" name="spider_mites" id="spider-mites" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-blackBug">Black Bugs</label>
                <input class="form-check-input" type="checkbox" name="corn_black_bug" id="corn-blackBug" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-army-worms">Army Worms</label>
                <input class="form-check-input" type="checkbox" name="corn_army_worms" id="corn-army-worms" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="leaf-aphid">Leaf Aphids</label>
                <input class="form-check-input" type="checkbox" name="leaf_aphid" id="leaf-aphid" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-cutWorms">Cutworms</label>
                <input class="form-check-input" type="checkbox" name="corn_cutWorms" id="corn-cutWorms" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-Birds">Birds</label>
                <input class="form-check-input" type="checkbox" name="corn_birds" id="rice-Birds" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-ants">Ants</label>
                <input class="form-check-input" type="checkbox" name="corn_ants" id="corn-ants" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-rats">Rats</label>
                <input class="form-check-input" type="checkbox" name="corn_rats" id="corn-rats" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-other-check">Others</label>
                <input class="form-check-input" type="checkbox" name="corn_others" id="corn-other-check" value="1">
            </div>

        </div>

        <!-- Other -->
        <div class="row mt-3 mb-5">
            <div id="corn-pest-other" class="col-12 mb-0 d-none">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <textarea name="corn_others_desc" id="corn-other" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
                <div class="form-text small-font" id="cornPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>

        <!-- Disease Resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Disease Resistance</h6>
        <div class="row mb-5 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Bacterial">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="corn-Bacterial" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Fungus">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="corn-Fungus" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Viral">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="corn-Viral" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <h6 class="fw-semibold mt-4 mb-3">Resistance to Abiotic Stress</h6>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Drought">Drought</label>
                <input class="form-check-input" type="checkbox" name="drought" id="corn-Drought" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Salinity">Salinity</label>
                <input class="form-check-input" type="checkbox" name="salinity" id="corn-Salinity" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Heat">Heat</label>
                <input class="form-check-input" type="checkbox" name="heat" id="corn-Heat" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-abiotic-check">Others</label>
                <input class="form-check-input" type="checkbox" name="abiotic_other" id="corn-abiotic-check" value="1">
            </div>
        </div>

        <!-- Other -->
        <div class="row mt-3 mb-3">
            <div id="corn-abiotic-other-container" class="col-12 mb-2 d-none">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <textarea name="corn_others_desc" id="corn-abiotic-other" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
                <div class="form-text small-font" id="cornPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>
    </div>


    <!-- script for others -->
    <!-- <script>
        const cornOtherCheck = document.getElementById('corn-other-check');
        const cornPestOther = document.getElementById('corn-pest-other');

        const cornAbioticCheck = document.getElementById('corn-abiotic-check');
        const cornAbioticOtherContainer = document.getElementById('corn-abiotic-other-container');

        cornOtherCheck.addEventListener('change', function() {
            cornPestOther.classList.toggle('d-none', !this.checked);
        });

        cornAbioticCheck.addEventListener('change', function() {
            cornAbioticOtherContainer.classList.toggle('d-none', !this.checked);
        });
    </script> -->



    <!-- Rice Agronomic Traits -->
    <div id="riceAgro">
        <!-- Pest resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Pest Resistance</h6>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceBorers">Borers</label>
                <input class="form-check-input" type="checkbox" name="rice_borers" id="riceBorers" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceSnail">Snail</label>
                <input class="form-check-input" type="checkbox" name="rice_snail" id="riceSnail" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Hoppers">Hoppers</label>
                <input class="form-check-input" type="checkbox" name="hoppers" id="Hoppers" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-blackBug">Rice Black Bug</label>
                <input class="form-check-input" type="checkbox" name="rice_black_bug" id="rice-blackBug" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Leptocorisa">Leptocorisa</label>
                <input class="form-check-input" type="checkbox" name="leptocorisa" id="Leptocorisa" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="leaf-folder">Leaf Folder</label>
                <input class="form-check-input" type="checkbox" name="leaf_folder" id="leaf-folder" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-birds">Birds</label>
                <input class="form-check-input" type="checkbox" name="rice_birds" id="rice-birds" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-ants">Ants</label>
                <input class="form-check-input" type="checkbox" name="rice_ants" id="rice-ants" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-Rats">Rats</label>
                <input class="form-check-input" type="checkbox" name="rice_rats" id="rice-Rats" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-armyWorms">Army Worms</label>
                <input class="form-check-input" type="checkbox" name="rice_army_worms" id="rice-armyWorms" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-other-check">Others</label>
                <input class="form-check-input" type="checkbox" name="rice_others" id="rice-other-check" value="1">
            </div>
        </div>

        <!-- Other -->
        <div id="rice-pest-other-container" class="row mt-3 mb-5 d-none">
            <div class="col-12 mb-0 ">
                <textarea name="rice_others_desc" id="rice-other" cols="30" rows="1" class="form-control"></textarea>
                <div class="form-text small-font" id="ricePestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>

        <!-- Disease Resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Disease Resistance</h6>
        <div class="row mb-5 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-Bacterial">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="rice-Bacterial" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-Fungus">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="rice-Fungus" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-Viral">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="rice-Viral" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <h6 class="fw-semibold mt-4 mb-3">Resistance to Abiotic Stress</h6>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceDrought">Drought</label>
                <input class="form-check-input" type="checkbox" name="rice_drought" id="riceDrought" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceSalinity">Salinity</label>
                <input class="form-check-input" type="checkbox" name="rice_salinity" id="riceSalinity" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceHeat">Heat</label>
                <input class="form-check-input" type="checkbox" name="rice_heat" id="riceHeat" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="harmful-radiation">Harmful Radiation</label>
                <input class="form-check-input" type="checkbox" name="harmful_radiation" id="harmful-radiation" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-abiotic-other-check">Others</label>
                <input class="form-check-input" type="checkbox" name="rice_abiotic_other" id="rice-abiotic-other-check" value="1">
            </div>
        </div>

        <!-- Other -->
        <div class="row mt-3 mb-3">
            <div id="rice-abiotic-other-container" class="col-12 mb-2 d-none">
                <textarea name="rice_abiotic_other_desc" id="rice-abiotic-other-desc" cols="30" rows="1" class="form-control"></textarea>
                <div class="form-text small-font" id="ricePestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>
    </div>
    <!-- script for others -->
    <!-- <script>
    const riceOtherCheck = document.getElementById('rice-other-check');
    const ricePestOther = document.getElementById('rice-pest-other');

    const riceAbioticCheck = document.getElementById('rice-abiotic-check');
    const riceAbioticOtherContainer = document.getElementById('rice-abiotic-other-container');

    riceOtherCheck.addEventListener('change', function() {
        ricePestOther.classList.toggle('d-none', !this.checked);
    });

    riceAbioticCheck.addEventListener('change', function() {
        riceAbioticOtherContainer.classList.toggle('d-none', !this.checked);
    });
</script> -->



    <!-- Root Crop Agronomic Traits -->
    <div id="root_cropAgro">

        <!-- Pest resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Pest Resistance</h6>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootAphids">Root Aphids</label>
                <input class="form-check-input" type="checkbox" name="root_aphids" id="rootAphids" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-cutworms">Cutworms</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_cutworms" id="rootCrop-cutworms" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-whiteGRubs">White Grubs</label>
                <input class="form-check-input" type="checkbox" name="white_grubs" id="rootCrop-whiteGRubs" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Termites">Termites</label>
                <input class="form-check-input" type="checkbox" name="termites" id="Termites" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Weevils">Weevils</label>
                <input class="form-check-input" type="checkbox" name="weevils" id="Weevils" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="flea-beetles">Flea Beetles</label>
                <input class="form-check-input" type="checkbox" name="flea_beetles" id="flea-beetles" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-snails">Snails</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_snails" id="rootCrop-snails" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-ants">Ants</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_ants" id="rootCrop-ants" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-rats">Rats</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_rats" id="rootCrop-rats" value="1">
            </div>
            <div class="col-6 form-check form-check-inline">
                <label class="form-check-label small-font" for="root-knot-nematodes">Root-knot Nematodes (Meloidogyne spp.)</label>
                <input class="form-check-input" type="checkbox" name="root_knot_nematodes" id="root-knot-nematodes" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-other-check">Other</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_others" id="rootCrop-other-check" value="1">
            </div>
        </div>

        <!-- Other -->
        <div id="root-pest-other-container" class="row mt-3 mb-5 d-none">
            <div class="col-12 mb-0">
                <!-- <label for="rootCrop-other" class="form-label small-font">Other</label> -->
                <textarea name="rootcrop_others_desc" id="rootCrop-other" cols="30" rows="1" class="form-control"></textarea>
                <div class="form-text small-font" id="rootPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>

        <!-- Disease Resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Disease Resistance</h6>
        <div class="row mb-5 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Bacterial">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="rootCrop-Bacterial" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Fungus">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="rootCrop-Fungus" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Viral">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="rootCrop-Viral" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <h6 class="fw-semibold mt-4 mb-3">Resistance to Abiotic Stress</h6>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Drought">Drought</label>
                <input class="form-check-input" type="checkbox" name="drought" id="rootCrop-Drought" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Salinity">Salinity</label>
                <input class="form-check-input" type="checkbox" name="salinity" id="rootCrop-Salinity" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Heat">Heat</label>
                <input class="form-check-input" type="checkbox" name="heat" id="rootCrop-Heat" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-abiotic-other-check">Others</label>
                <input class="form-check-input" type="checkbox" name="abiotic_other" id="rootCrop-abiotic-other-check" value="1">
            </div>
        </div>

        <!-- Other -->
        <div class="row mt-3 mb-3">
            <div id="root-abiotic-other-container" class="col-12 mb-2 d-none">
                <!-- <label for="rootCrop-abiotic-other" class="form-label small-font">Other</label> -->
                <textarea name="abiotic_other_desc" id="rootCrop-abiotic-other" cols="30" rows="1" class="form-control"></textarea>

                <div class="form-text small-font" id="rootPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>
    </div>


    <!-- STEP NAVIGATION without Sensory -->
    <div class="row" id="withoutSensory">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('more', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('cultural', this)">Next<i class="fa-solid fa-angles-right me-2"></i></button>
        </div>
    </div>
    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('sensory', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('cultural', this)">Next<i class="fa-solid fa-angles-right me-2"></i></button>
        </div>
    </div>
</div>

<script>
    const cornOtherCheck = document.getElementById('corn-other-check');
    const cornPestOther = document.getElementById('corn-pest-other');

    const cornAbioticCheck = document.getElementById('corn-abiotic-check');
    const cornAbioticOtherContainer = document.getElementById('corn-abiotic-other-container');

    // New for rice checkboxes
    const riceOtherCheck = document.getElementById('rice-other-check');
    const ricePestOther = document.getElementById('rice-pest-other-container'); // Use the correct ID here

    const riceAbioticCheck = document.getElementById('rice-abiotic-other-check');
    const riceAbioticOtherContainer = document.getElementById('rice-abiotic-other-container');

    const rootCropOtherCheck = document.getElementById('rootCrop-other-check');
    const rootPestOtherContainer = document.getElementById('root-pest-other-container'); // Notice the container ID

    const rootCropAbioticCheck = document.getElementById('rootCrop-abiotic-other-check');
    const rootAbioticOtherContainer = document.getElementById('root-abiotic-other-container');


    cornOtherCheck.addEventListener('change', function() {
        cornPestOther.classList.toggle('d-none', !this.checked);
    });

    cornAbioticCheck.addEventListener('change', function() {
        cornAbioticOtherContainer.classList.toggle('d-none', !this.checked);
    });

    // Event listeners for rice checkboxes
    riceOtherCheck.addEventListener('change', function() {
        ricePestOther.classList.toggle('d-none', !this.checked);
    });

    riceAbioticCheck.addEventListener('change', function() {
        riceAbioticOtherContainer.classList.toggle('d-none', !this.checked);
    });

    rootCropOtherCheck.addEventListener('change', function() {
        rootPestOtherContainer.classList.toggle('d-none', !this.checked);
    });

    rootCropAbioticCheck.addEventListener('change', function() {
        rootAbioticOtherContainer.classList.toggle('d-none', !this.checked);
    });
</script>