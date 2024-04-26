<!-- MORE TAB -->
<div class="fade tab-pane" id="sensory-tab-pane" role="tabpanel" aria-labelledby="sensory-tab" tabindex="0">

    <h6 class="fw-semibold mt-4 mb-3">Sensory Traits</h6>
    <!-- sensory traits-->
    <div class="row mb-5" id="riceSensory">
        <!-- Aroma -->
        <div class="col-12 mb-2">
            <label for="sensory-aroma" class="form-label small-font">Aroma</label>
            <textarea name="aroma" id="sensory-aroma" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Quality of Cooked Rice -->
        <div class="col-12 mb-2">
            <label for="cooked-rice" class="form-label small-font">Quality of Cooked Rice</label>
            <textarea name="quality_cooked_rice" id="cooked-rice" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Quality of Leftover Rice -->
        <div class="col-12 mb-2">
            <label for="leftover-rice" class="form-label small-font">Quality of Leftover Rice</label>
            <textarea name="quality_leftover_rice" id="leftover-rice" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- Volume, Glutinous, and Hardness -->
    <div class="row mb-3">
        <!-- Volume Expansion -->
        <div class="col-6 mb-3">
            <div class="small-font mb-2">Volume Expansion</div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="volume_expansion" type="checkbox" role="switch" id="volExpansion" value="1">
                <label class="form-check-label small-font" for="volExpansion">Does it rise?</label>
            </div>
        </div>

        <!-- Glutinous -->
        <div class="col-6 mb-3">
            <div class="small-font mb-2">Glutinousity</div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="glutinous" type="checkbox" role="switch" id="glutinousity" value="1">
                <label class="form-check-label small-font" for="glutinousity">Is it Glutinous?</label>
            </div>
        </div>

        <!-- Hardness -->
        <div class="col-6">
            <div class="small-font mb-2">Hardness</div>
            <div class="form-check form-check-inline">
                <label class="form-check-label small-font" for="hardness-Soft">Soft</label>
                <input class="form-check-input" type="radio" name="hardness" id="hardness-Soft" value="Soft">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label small-font" for="hardness-Hard">Hard</label>
                <input class="form-check-input" type="radio" name="hardness" id="hardness-Hard" value="Hard">
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('more', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('agro', this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
</div>