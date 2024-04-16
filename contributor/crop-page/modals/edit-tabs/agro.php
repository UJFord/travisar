<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-agro-tab-pane" role="tabpanel" aria-labelledby="edit-agro-tab" tabindex="0">
    <div id="cornAgro-Edit">
        <!-- Pest resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Pest Resistance</h6>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="cornBorers-Edit">Borers</label>
                <input class="form-check-input" type="checkbox" name="corn_borers" id="cornBorers-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Earworm-Edit">Earworm</label>
                <input class="form-check-input" type="checkbox" name="earworms" id="Earworm-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="spider-mites-Edit">Spider Mites</label>
                <input class="form-check-input" type="checkbox" name="spider_mites" id="spider-mites-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-blackBug-Edit">Black Bug</label>
                <input class="form-check-input" type="checkbox" name="corn_black_bug" id="corn-blackBug-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-army-worms-Edit">Army Worms</label>
                <input class="form-check-input" type="checkbox" name="corn_army_worms" id="corn-army-worms-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="leaf-aphid-Edit">Leaf Aphid</label>
                <input class="form-check-input" type="checkbox" name="leaf_aphid" id="leaf-aphid-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-cutWorms-Edit">Cutworms</label>
                <input class="form-check-input" type="checkbox" name="corn_cutworms" id="corn-cutWorms-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-Birds-Edit">Birds</label>
                <input class="form-check-input" type="checkbox" name="corn_birds" id="rice-Birds-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-ants-Edit">Ants</label>
                <input class="form-check-input" type="checkbox" name="corn_ants" id="corn-ants-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-rats-Edit">Rats</label>
                <input class="form-check-input" type="checkbox" name="corn_rats" id="corn-rats-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-other-check-Edit">other</label>
                <input class="form-check-input" type="checkbox" name="corn_others" id="corn-other-check-Edit" value="1">
            </div>
        </div>

        <!-- Other -->
        <div class="row mt-3 mb-5 d-none">
            <div id="corn-pest-other-Edit" class="col-12 mb-0 d-none">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <textarea name="corn_others_desc" id="corn-other-Edit" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
                <div class="form-text small-font" id="cornPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>

        <!-- Disease Resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Disease Resistance</h6>
        <div class="row mb-5 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Bacterial-Edit">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="corn-Bacterial-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Fungus-Edit">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="corn-Fungus-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Viral-Edit">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="corn-Viral-Edit" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <label><strong>Resistance to Abiotic Stress</strong></label>
        <div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Drought-Edit">Drought</label>
                <input class="form-check-input" type="checkbox" name="drought" id="corn-Drought-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Salinity-Edit">Salinity</label>
                <input class="form-check-input" type="checkbox" name="salinity" id="corn-Salinity-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-Heat-Edit">Heat</label>
                <input class="form-check-input" type="checkbox" name="heat" id="corn-Heat-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="corn-abiotic-other-check-Edit">abiotic-other</label>
                <input class="form-check-input" type="checkbox" name="abiotic_other" id="corn-abiotic-other-check-Edit" value="1">
            </div>
        </div>
        <!-- Other -->
        <div class="row mt-3 mb-3">
            <div id="corn-abiotic-other-container-Edit" class="col-12 mb-2 d-none">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <textarea name="corn_others_desc" id="corn-abiotic-other-Edit" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
                <div class="form-text small-font" id="cornPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>
    </div>

    <div id="riceAgro-Edit">
        <!-- Pest resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Pest Resistance</h6>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceBorers-Edit">Borers</label>
                <input class="form-check-input" type="checkbox" name="rice_borers" id="riceBorers-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceSnail-Edit">Snail</label>
                <input class="form-check-input" type="checkbox" name="rice_snail" id="riceSnail-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Hoppers-Edit">Hoppers</label>
                <input class="form-check-input" type="checkbox" name="hoppers" id="Hoppers-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-blackBug-Edit">Rice Black Bug</label>
                <input class="form-check-input" type="checkbox" name="rice_black_bug" id="rice-blackBug-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Leptocorisa-Edit">Leptocorisa</label>
                <input class="form-check-input" type="checkbox" name="leptocorisa" id="Leptocorisa-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="leaf-folder-Edit">Leaf Folder</label>
                <input class="form-check-input" type="checkbox" name="leaf_folder" id="leaf-folder-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-birds-Edit">Birds</label>
                <input class="form-check-input" type="checkbox" name="rice_birds" id="rice-birds-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-ants-Edit">Ants</label>
                <input class="form-check-input" type="checkbox" name="rice_ants" id="rice-ants-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-rats-Edit">Rats</label>
                <input class="form-check-input" type="checkbox" name="rice_rats" id="rice-rats-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-armyWorms-Edit">Army Worms</label>
                <input class="form-check-input" type="checkbox" name="rice_army_worms" id="rice-armyWorms-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-other-check-Edit">Other</label>
                <input class="form-check-input" type="checkbox" name="rice_others" id="rice-other-check-Edit" value="1">
            </div>
        </div>

        <!-- Other -->
        <div id="rice-pest-other-container-Edit" class="row mt-3 mb-5 d-none">
            <div class="col-12 mb-0 d-none">
                <textarea name="rice_others_desc" id="rice-other-Edit" cols="30" rows="1" class="form-control"></textarea>
                <div class="form-text small-font" id="ricePestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>

        <!-- Disease Resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Disease Resistance</h6>
        <div class="row mb-5 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-Bacterial-Edit">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="rice-Bacterial-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-Fungus-Edit">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="rice-Fungus-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-Viral-Edit">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="rice-Viral-Edit" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <label><strong>Resistance to Abiotic Stress</strong></label>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceDrought-Edit">Drought</label>
                <input class="form-check-input" type="checkbox" name="rice_drought" id="riceDrought-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceSalinity-Edit">Salinity</label>
                <input class="form-check-input" type="checkbox" name="rice_salinity" id="riceSalinity-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="riceHeat-Edit">Heat</label>
                <input class="form-check-input" type="checkbox" name="rice_heat" id="riceHeat-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="harmful-radiation-Edit">Harmful Radiation</label>
                <input class="form-check-input" type="checkbox" name="harmful_radiation" id="harmful-radiation-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rice-abiotic-other-check-Edit">Other</label>
                <input class="form-check-input" type="checkbox" name="rice_abiotic_other" id="rice-abiotic-other-check-Edit" value="1">
            </div>
        </div>

        <!-- Other -->
        <div class="row mt-3 mb-3">
            <div id="rice-abiotic-other-container-Edit" class="col-12 mb-2 d-none">
                <textarea name="rice_abiotic_other_desc" id="rice-abiotic-other-desc-Edit" cols="30" rows="1" class="form-control"></textarea>
                <div class="form-text small-font" id="ricePestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>
    </div>

    <div id="root_cropAgro-Edit">
        <!-- Pest resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Pest Resistance</h6>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootAphids-Edit">Root Aphids</label>
                <input class="form-check-input" type="checkbox" name="root_aphids" id="rootAphids-Edit" value="1">
            </div>
            <div class="col-6 form-check form-check-inline">
                <label class="form-check-label small-font" for="root-knot-nematodes-Edit">Root-knot Nematodes (Meloidogyne spp.)</label>
                <input class="form-check-input" type="checkbox" name="root_knot_nematodes" id="root-knot-nematodes-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-cutworms-Edit">Cutworms</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_cutworms" id="rootCrop-cutworms-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-whiteGRubs-Edit">White Grubs</label>
                <input class="form-check-input" type="checkbox" name="white_grubs" id="rootCrop-whiteGRubs-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Termites-Edit">Termites</label>
                <input class="form-check-input" type="checkbox" name="termites" id="Termites-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="Weevils-Edit">Weevils</label>
                <input class="form-check-input" type="checkbox" name="weevils" id="Weevils-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="flea-beetles-Edit">Flea Beetles</label>
                <input class="form-check-input" type="checkbox" name="flea_beetles" id="flea-beetles-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-snails-Edit">Snails</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_snails" id="rootCrop-snails-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-ants-Edit">Ants</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_ants" id="rootCrop-ants-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-rats-Edit">Rats</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_rats" id="rootCrop-rats-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-other-check-Edit">Other</label>
                <input class="form-check-input" type="checkbox" name="rootcrop_others" id="rootCrop-other-check-Edit" value="1">
            </div>
        </div>

        <!-- Other -->
        <div id="root-pest-other-container-Edit" class="row mt-3 mb-5 d-none">
            <div class="col-12 mb-0">
                <!-- <label for="rootCrop-other" class="form-label small-font">Other</label> -->
                <textarea name="rootcrop_others_desc" id="rootCrop-other-Edit" cols="30" rows="1" class="form-control"></textarea>
                <div class="form-text small-font" id="rootPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>

        <!-- Disease Resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Disease Resistance</h6>
        <div class="row mb-5 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Bacterial-Edit">Bacterial</label>
                <input class="form-check-input" type="checkbox" name="bacterial" id="rootCrop-Bacterial-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Fungus-Edit">Fungus</label>
                <input class="form-check-input" type="checkbox" name="fungus" id="rootCrop-Fungus-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Viral-Edit">Viral</label>
                <input class="form-check-input" type="checkbox" name="viral" id="rootCrop-Viral-Edit" value="1">
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <label><strong>Resistance to Abiotic Stress</strong></label>
        <div class="row mb-0 ps-3">
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Drought-Edit">Drought</label>
                <input class="form-check-input" type="checkbox" name="drought" id="rootCrop-Drought-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Salinity-Edit">Salinity</label>
                <input class="form-check-input" type="checkbox" name="salinity" id="rootCrop-Salinity-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-Heat-Edit">Heat</label>
                <input class="form-check-input" type="checkbox" name="heat" id="rootCrop-Heat-Edit" value="1">
            </div>
            <div class="col-3 form-check form-check-inline">
                <label class="form-check-label small-font" for="rootCrop-abiotic-Edit">Other</label>
                <input class="form-check-input" type="checkbox" name="abiotic_other" id="rootCrop-abiotic-Edit" value="1">
            </div>
        </div>

        <!-- Other -->
        <div class="row mt-3 mb-3">
            <div id="root-abiotic-other-container-Edit" class="col-12 mb-2 d-none">
                <!-- <label for="rootCrop-abiotic-other" class="form-label small-font">Other</label> -->
                <textarea name="abiotic_other_desc" id="rootCrop-abiotic-other-Edit" cols="30" rows="1" class="form-control"></textarea>
                <div class="form-text small-font" id="rootPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION with out Sensory -->
    <div class="row" id="withoutSensory-Edit">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('edit-more')"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('edit-cultural', this)">Next<i class="fa-solid fa-angles-right me-2"></i></button>
        </div>
    </div>
    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory-Edit">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('edit-sensory')"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('edit-cultural', this)">Next<i class="fa-solid fa-angles-right me-2"></i></button>
        </div>
    </div>
</div>

<script>
    const cornOtherCheckEdit = document.getElementById('corn-other-check-Edit');
    const cornPestOtherEdit = document.getElementById('corn-pest-other-Edit');

    const cornAbioticCheckEdit = document.getElementById('corn-abiotic-other-check-Edit');
    const cornAbioticOtherContainerEdit = document.getElementById('corn-abiotic-other-container-Edit');

    // New for rice checkboxes
    const riceOtherCheckEdit = document.getElementById('rice-other-check-Edit');
    const ricePestOtherEdit = document.getElementById('rice-pest-other-container-Edit'); // Use the correct ID here

    const riceAbioticCheckEdit = document.getElementById('rice-abiotic-other-check-Edit');
    const riceAbioticOtherContainerEdit = document.getElementById('rice-abiotic-other-container-Edit');

    const rootCropOtherCheckEdit = document.getElementById('rootCrop-other-check-Edit');
    const rootPestOtherContainerEdit = document.getElementById('root-pest-other-container-Edit'); // Notice the container ID

    const rootCropAbioticCheckEdit = document.getElementById('rootCrop-abiotic-Edit');
    const rootAbioticOtherContainerEdit = document.getElementById('root-abiotic-other-container-Edit');


    cornOtherCheckEdit.addEventListener('change', function() {
        cornPestOtherEdit.classList.toggle('d-none', !this.checked);
    });

    cornAbioticCheckEdit.addEventListener('change', function() {
        cornAbioticOtherContainerEdit.classList.toggle('d-none', !this.checked);
    });

    // Event listeners for rice checkboxes
    riceOtherCheckEdit.addEventListener('change', function() {
        ricePestOtherEdit.classList.toggle('d-none', !this.checked);
    });

    riceAbioticCheckEdit.addEventListener('change', function() {
        riceAbioticOtherContainerEdit.classList.toggle('d-none', !this.checked);
    });

    rootCropOtherCheckEdit.addEventListener('change', function() {
        rootPestOtherContainerEdit.classList.toggle('d-none', !this.checked);
    });

    rootCropAbioticCheckEdit.addEventListener('change', function() {
        rootAbioticOtherContainerEdit.classList.toggle('d-none', !this.checked);
    });
</script>