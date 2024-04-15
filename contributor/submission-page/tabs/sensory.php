<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-sensory-tab-pane" role="tabpanel" aria-labelledby="edit-sensory-tab" tabindex="0">
    <h4>Sensory Traits of Cooked Rice</h4>
    <br>
    <!-- sensory traits of cooked rice -->
    <div class="row mb-4" id="riceSensory-Edit">
        <!-- Aroma -->
        <div class="col-12 mb-2">
            <label for="sensory-aroma-Edit" class="form-label small-font">Aroma</label>
            <textarea name="aroma" id="sensory-aroma-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Quality of Cooked Rice -->
        <div class="col-12 mb-2">
            <label for="cooked-rice-Edit" class="form-label small-font">Quality of Cooked Rice</label>
            <textarea name="quality_cooked_rice" id="cooked-rice-Edit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Quality of Leftover Rice -->
        <div class="col-12 mb-2">
            <label for="leftover-rice-Edit" class="form-label small-font">Quality of Leftover Rice</label>
            <textarea name="quality_leftover_rice" id="leftover-rice-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Volume, Glutinous, and Hardness -->
        <div class="row">
            <!-- Volume Expansion -->
            <div class="col-5">
                <div>
                    <label>Volume Expansion (does it rise?)</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="expansion-Yes-Edit">Yes</label>
                    <input class="form-check-input" type="radio" name="volume_expansion" id="expansion-Yes-Edit" value="Yes">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="expansion-No-Edit">No</label>
                    <input class="form-check-input" type="radio" name="volume_expansion" id="expansion-No-Edit" value="No">
                </div>
            </div>

            <!-- Glutinous -->
            <div class="col-3">
                <div>
                    <label>Glutinous</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="glutinous-Yes-Edit">Yes</label>
                    <input class="form-check-input" type="radio" name="glutinous" id="glutinous-Yes-Edit" value="Yes">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="glutinous-No-Edit">No</label>
                    <input class="form-check-input" type="radio" name="glutinous" id="glutinous-No-Edit" value="No">
                </div>
            </div>

            <!-- Hardness -->
            <div class="col-4">
                <div>
                    <label>Hardness</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hardness-Soft-Edit">Soft</label>
                    <input class="form-check-input" type="radio" name="hardness" id="hardness-Soft-Edit" value="Soft">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hardness-Hard-Edit">Hard</label>
                    <input class="form-check-input" type="radio" name="hardness" id="hardness-Hard-Edit" value="Hard">
                </div>
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open General tab" onclick="switchTab('edit-more')"><i class="fa-solid fa-backward"></i></button>
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Agronomic traits tab" onclick="switchTab('edit-agro',this)"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div>
</div>