<!-- MORE TAB -->
<div class="fade tab-pane" id="view-sensory-tab-pane" role="tabpanel" aria-labelledby="view-sensory-tab" tabindex="0">
    <h6 class="fw-semibold mt-4 mb-3">Sensory Traits</h6>
    <!-- sensory traits of cooked rice -->
    <div class="row mb-5" id="riceSensory-View">
        <!-- Aroma -->
        <div class="col-12 mb-2">
            <label for="sensory-aroma-View" class="form-label small-font">Aroma</label>
            <textarea name="aroma" id="sensory-aroma-View" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>

        <!-- Quality of Cooked Rice -->
        <div class="col-22 mb-2">
            <label for="cooked-rice-View" class="form-label small-font">Quality of Cooked Rice</label>
            <textarea name="quality_cooked_rice" id="cooked-rice-View" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>

        <!-- Quality of Leftover Rice -->
        <div class="col-12 mb-2">
            <label for="leftover-rice-View" class="form-label small-font">Quality of Leftover Rice</label>
            <textarea name="quality_leftover_rice" id="leftover-rice-View" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>
    </div>
    <!-- Volume, Glutinous, and Hardness -->
    <div class="row mb-3">
        <!-- Volume Expansion -->
        <div class="col-6 mb-3">
            <div class="small-font mb-2">Volume Expansion</div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="volume_expansion" type="checkbox" role="switch" id="volExpansionView" value="1" disabled>
                <label class="form-check-label small-font" for="volExpansionView">Does it rise?</label>
            </div>
        </div>

        <!-- Glutinous -->
        <div class="col-6 mb-3">
            <div class="small-font mb-2">Glutinousity</div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="glutinous" type="checkbox" role="switch" id="glutinousityView" value="1" disabled>
                <label class="form-check-label small-font" for="glutinousityView">Is it Glutinous?</label>
            </div>
        </div>

        <!-- Hardness -->
        <div class="col-6">
            <div class="small-font mb-2">Hardness</div>
            <div class="form-check form-check-inline">
                <label class="form-check-label small-font" for="hardness-Soft-View">Soft</label>
                <input class="form-check-input" type="radio" name="hardness" id="hardness-Soft-View" value="Soft" disabled>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label small-font" for="hardness-Hard-View">Hard</label>
                <input class="form-check-input" type="radio" name="hardness" id="hardness-Hard-View" value="Hard" disabled>
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open General tab" onclick="switchTab('view-more')"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Agronomic traits tab" onclick="switchTab('view-agro',this)">Next<i class="fa-solid fa-angles-right ms-2"></i></i></button>
        </div>
    </div>
</div>