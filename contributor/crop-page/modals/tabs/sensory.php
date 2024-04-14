<!-- MORE TAB -->
<div class="fade tab-pane" id="sensory-tab-pane" role="tabpanel" aria-labelledby="sensory-tab" tabindex="0">
    <h4>Sensory Traits of Cooked Rice</h4>
    <br>
    <!-- sensory traits-->
    <div class="row mb-4" id="riceSensory">
        <!-- Aroma -->
        <div class="col-12 mb-2">
            <label for="sensory-aroma" class="form-label small-font">Aroma</label>
            <textarea name="aroma" id="sensory-aroma" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Quality of Cooked Rice -->
        <div class="col-12 mb-2">
            <label for="cooked-rice" class="form-label small-font">Quality of Cooked Rice</label>
            <textarea name="quality_cooked_rice" id="cooked-rice" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Quality of Leftover Rice -->
        <div class="col-12 mb-2">
            <label for="leftover-rice" class="form-label small-font">Quality of Leftover Rice</label>
            <textarea name="quality_leftover_rice" id="leftover-rice" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Volume, Glutinous, and Hardness -->
        <div class="row">
            <!-- Volume Expansion -->
            <div class="col-5">
                <div>
                    <label>Volume Expansion (does it rise?)</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="expansion-Yes">Yes</label>
                    <input class="form-check-input" type="radio" name="volume_expansion" id="expansion-Yes" value="Yes">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="expansion-No">No</label>
                    <input class="form-check-input" type="radio" name="volume_expansion" id="expansion-No" value="No">
                </div>
            </div>

            <!-- Glutinous -->
            <div class="col-3">
                <div>
                    <label>Glutinous</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="glutinous-Yes">Yes</label>
                    <input class="form-check-input" type="radio" name="glutinous" id="glutinous-Yes" value="Yes">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="glutinous-No">No</label>
                    <input class="form-check-input" type="radio" name="glutinous" id="glutinous-No" value="No">
                </div>
            </div>

            <!-- Hardness -->
            <div class="col-4">
                <div>
                    <label>Hardness</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hardness-Soft">Soft</label>
                    <input class="form-check-input" type="radio" name="hardness" id="hardness-Soft" value="Soft">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hardness-Hard">Hard</label>
                    <input class="form-check-input" type="radio" name="hardness" id="hardness-Hard" value="Hard">
                </div>
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