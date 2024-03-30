<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-more-tab-pane" role="tabpanel" aria-labelledby="edit-more-tab" tabindex="0">
    <!-- Cultural and Spiritual Significance-->
    <div class="row mb-4">
        <!-- Cultural-Significance -->
        <div class="col-12 mb-2">
            <label for="Cultural-SignificanceEdit" class="form-label small-font">Cultural-Significance</label>
            <textarea name="cultural_significance" id="Cultural-SignificanceEdit" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>

        <!-- Spiritual-Significance -->
        <div class="col-12 mb-2">
            <label for="Spiritual-SignificanceEdit" class="form-label small-font">Spiritual-Significance</label>
            <textarea name="spiritual_significance" id="Spiritual-SignificanceEdit" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>

        <!-- cultural_importance -->
        <div class="col-12 mb-2">
            <label for="Cultural-ImportanceEdit" class="form-label small-font">Cultural Importance</label>
            <textarea name="cultural_importance" id="Cultural-ImportanceEdit" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>

        <!-- cultural_use-->
        <div class="col-12 mb-2">
            <label for="Cultural-UseEdit" class="form-label small-font">Cultural Use</label>
            <textarea name="cultural_use" id="Cultural-UseEdit" cols="30" rows="2" class="form-control" disabled></textarea>
        </div>
    </div>

    <br>
    <hr>
    <div id="more-help" class="form-text mb-2" style="font-size: 0.6rem;">the data below is based on farmers knowledge.</div>
    <br>

    <!-- Taste and Aroma-->
    <div class="row mb-4">
        <input id="Char_id" type="hidden" name="characteristics_id" class="form-control">
        <input id="cultural_aspect-Edit" type="hidden" name="cultural_aspect_id" class="form-control">

        <!-- Taste -->
        <div class="col-4">
            <label for="TasteEdit" class="form-label small-font">Taste</label>
            <h6 name="taste" id="TasteEdit"></h6>
        </div>

        <!-- Aroma -->
        <div class="col-4">
            <label for="AromaEdit" class="form-label small-font">Aroma</label>
            <h6 name="aroma" id="AromaEdit"></h6>
        </div>

        <!-- Maturation -->
        <div class="col-4">
            <label for="MaturationEdit" class="form-label small-font">Maturation</label>
            <h6 name="maturation" id="MaturationEdit"></h6>
        </div>
    </div>

    <!-- Pest and Disease -->
    <div class="row mb-4">
        <!-- Pest -->
        <div class="col-6">
            <label for="PestEdit" class="form-label small-font">Pest Resistance</label>
            <h6 name="pest" id="PestEdit"></h6>
        </div>

        <!-- Disease -->
        <div class="col-6">
            <label for="DiseaseEdit" class="form-label small-font">Disease Resistance</label>
            <h6 name="diseases" id="DiseaseEdit"></h6>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-start">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-backward"></i></button>
        </div>
    </div>
</div>