<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-agro-tab-pane" role="tabpanel" aria-labelledby="edit-agro-tab" tabindex="0">
    <div id="cornAgro-Edit">
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
                    <input class="form-check-input" type="checkbox" name="corn_cutworms" id="corn-cutWorms-Edit" value="1">
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

    <div id="riceAgro-Edit">
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
                    <label class="form-check-label" for="rice-rats-Edit">Rats</label>
                    <input class="form-check-input" type="checkbox" name="rice_rats" id="rice-rats-Edit" value="1">
                </div>
                <div class="col-3 form-check form-check-inline">
                    <label class="form-check-label" for="rice-armyWorms-Edit">Army Worms</label>
                    <input class="form-check-input" type="checkbox" name="rice_army_worms" id="rice-armyWorms-Edit" value="1">
                </div>
                <div class="col-3 form-check form-check-inline">
                    <label class="form-check-label" for="rice-other-check-Edit">Other</label>
                    <input class="form-check-input" type="checkbox" name="rice_others" id="rice-other-check-Edit" value="1">
                </div>
                <!-- Other -->
                <div class="col-12 mb-2 rice-pest-other-edit">
                    <label for="rice-other-Edit" class="form-label small-font">Other</label>
                    <textarea name="rice_others_desc" id="rice-other-Edit" cols="30" rows="1" class="form-control"></textarea>
                </div>
            </div>

            <!-- Disease Resistance -->
            <label><strong>Disease Resistance</strong></label>
            <div>
                <div class="col-3 form-check form-check-inline">
                    <label class="form-check-label" for="rice-Bacterial-Edit">Bacterial</label>
                    <input class="form-check-input" type="checkbox" name="bacterial" id="rice-Bacterial-Edit" value="1">
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
                <div class="col-3 form-check form-check-inline">
                    <label class="form-check-label" for="rice-abiotic-other-check-Edit">Other</label>
                    <input class="form-check-input" type="checkbox" name="rice_abiotic_other" id="rice-abiotic-other-check-Edit" value="1">
                </div>
                <!-- Other -->
                <div class="col-12 mb-2 rice-abiotic-other">
                    <label for="rice-abiotic-other-desc-Edit" class="form-label small-font">Other</label>
                    <textarea name="rice_abiotic_other_desc" id="rice-abiotic-other-desc-Edit" cols="30" rows="1" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div id="root_cropAgro-Edit">
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

    <!-- STEP NAVIGATION with out Sensory -->
    <div class="row" id="withoutSensory-Edit">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('edit-more')"><i class="fa-solid fa-backward"></i></button>
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('edit-cultural', this)"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div>
    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory-Edit">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('edit-sensory')"><i class="fa-solid fa-backward"></i></button>
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('edit-cultural', this)"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div>
</div>