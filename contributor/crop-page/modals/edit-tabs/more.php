<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-more-tab-pane" role="tabpanel" aria-labelledby="edit-more-tab" tabindex="0">
    <!-- Cultural and Spiritual Significance-->
    <div class="row mb-4">
        <!-- Cultural-Significance -->
        <div class="col-12 mb-2">
            <label for="Cultural-SignificanceEdit" class="form-label small-font">Cultural-Significance</label>
            <textarea name="cultural_significance" id="Cultural-SignificanceEdit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Spiritual-Significance -->
        <div class="col-12 mb-2">
            <label for="Spiritual-SignificanceEdit" class="form-label small-font">Spiritual-Significance</label>
            <textarea name="spiritual_significance" id="Spiritual-SignificanceEdit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- cultural_importance -->
        <div class="col-12 mb-2">
            <label for="Cultural-ImportanceEdit" class="form-label small-font">Cultural Importance</label>
            <textarea name="cultural_importance" id="Cultural-ImportanceEdit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- cultural_use-->
        <div class="col-12 mb-2">
            <label for="Cultural-UseEdit" class="form-label small-font">Cultural Use</label>
            <textarea name="cultural_use" id="Cultural-UseEdit" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <br>
    <hr>
    <div id="more-help-edit" class="form-text mb-2" style="font-size: 0.6rem;">the data below is based on farmers knowledge.</div>
    <br>

    <!-- Taste and Aroma-->
    <div class="row mb-4">
        <input id="Char_id" type="hidden" name="characteristics_id" class="form-control">
        <input id="cultural_aspect-Edit" type="hidden" name="cultural_aspect_id" class="form-control">

        <!-- Taste -->
        <div class="col-4">
            <label for="TasteEdit" class="form-label small-font">Taste</label>
            <input id="TasteEdit" type="text" name="taste" class="form-control">
        </div>

        <!-- Aroma -->
        <div class="col-4">
            <label for="AromaEdit" class="form-label small-font">Aroma</label>
            <input id="AromaEdit" type="text" name="aroma" class="form-control">
        </div>

        <!-- Maturation -->
        <div class="col-4">
            <label for="MaturationEdit" class="form-label small-font">Maturation</label>
            <input id="MaturationEdit" type="text" name="maturation" class="form-control">
        </div>
    </div>

    <!-- Pest and Disease -->
    <div class="row mb-4">
        <!-- Pest -->
        <div class="col-6">
            <label for="PestEdit" class="form-label small-font">Pest Resistance</label>
            <input id="PestEdit" type="text" name="pest" class="form-control">
        </div>

        <!-- Disease -->
        <div class="col-6">
            <label for="DiseaseEdit" class="form-label small-font">Disease Resistance</label>
            <input id="DiseaseEdit" type="text" name="diseases" class="form-control">
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-start">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-backward"></i></button>
        </div>
    </div>
</div>