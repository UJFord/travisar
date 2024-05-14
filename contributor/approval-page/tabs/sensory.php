<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-sensory-tab-pane" role="tabpanel" aria-labelledby="edit-sensory-tab" tabindex="0">
    <h6 class="fw-semibold mt-4 mb-3">Sensory Traits</h6>
    <!-- sensory traits of cooked rice -->
    <div class="row mb-5" id="riceSensory-Edit">
        <!-- Aroma -->
        <div class="col-12 mb-2">
            <label for="sensory-aroma-Edit" class="form-label small-font">Aroma</label>
            <textarea name="aroma" id="sensory-aroma-Edit" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>

        <!-- Quality of Cooked Rice -->
        <div class="col-22 mb-2">
            <label for="cooked-rice-Edit" class="form-label small-font">Quality of Cooked Rice</label>
            <textarea name="quality_cooked_rice" id="cooked-rice-Edit" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>

        <!-- Quality of Leftover Rice -->
        <div class="col-12 mb-2">
            <label for="leftover-rice-Edit" class="form-label small-font">Quality of Leftover Rice</label>
            <textarea name="quality_leftover_rice" id="leftover-rice-Edit" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>
    </div>
    <!-- Volume, Glutinous, and Hardness -->
    <div class="row mb-3">
        <!-- Volume Expansion -->
        <div class="col-6 mb-3">
            <div class="small-font mb-2">Volume Expansion</div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="volume_expansion" type="checkbox" role="switch" id="volExpansionEdit" value="1" disabled>
                <label class="form-check-label small-font" for="volExpansionEdit">Does it rise?</label>
            </div>
        </div>

        <!-- Glutinous -->
        <div class="col-6 mb-3">
            <div class="small-font mb-2">Glutinousity</div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="glutinous" type="checkbox" role="switch" id="glutinousityEdit" value="1" disabled>
                <label class="form-check-label small-font" for="glutinousityEdit">Is it Glutinous?</label>
            </div>
        </div>

        <!-- Texture -->
        <div class="col-6">
            <div class="small-font mb-2">Texture</div>
            <div class="form-check form-check-inline">
                <label class="form-check-label small-font" for="hardness-Soft-Edit">Soft</label>
                <input class="form-check-input" type="radio" name="texture" id="hardness-Soft-Edit" value="Soft" disabled>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label small-font" for="hardness-Hard-Edit">Hard</label>
                <input class="form-check-input" type="radio" name="texture" id="hardness-Hard-Edit" value="Hard" disabled>
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open General tab" onclick="switchTab('edit-more')"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Agronomic traits tab" onclick="switchTab('edit-agro',this)">Next<i class="fa-solid fa-angles-right ms-2"></i></i></button>
        </div>
    </div>
</div>