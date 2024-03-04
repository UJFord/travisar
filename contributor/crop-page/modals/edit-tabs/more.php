<!-- MORE TAB -->
<div class="fade show active tab-pane" id="more-tab-pane" role="tabpanel" aria-labelledby="more-tab" tabindex="0">
    <h3>Characteristics</h3>

    <!-- Taste and Aroma-->
    <div class="row mb-3">
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
    <div class="row mb-3">
        <!-- Pest -->
        <div class="col-6">
            <label for="PestEdit" class="form-label small-font">Pest</label>
            <input id="PestEdit" type="text" name="pest" class="form-control">
        </div>

        <!-- Disease -->
        <div class="col-6">
            <label for="DiseaseEdit" class="form-label small-font">Disease</label>
            <input id="DiseaseEdit" type="text" name="diseases" class="form-control">
        </div>
    </div>

    <br>

    <h3>Cultural Aspect</h3>
    <!-- Cultural and Spiritual Significance-->
    <div class="row mb-3">
        <!-- Cultural-Significance -->
        <div class="col-6">
            <label for="Cultural-SignificanceEdit" class="form-label small-font">Cultural-Significance</label>
            <input id="Cultural-SignificanceEdit" type="text" name="cultural_significance" class="form-control">
        </div>

        <!-- Spiritual-Significance -->
        <div class="col-6">
            <label for="Spiritual-SignificanceEdit" class="form-label small-font">Spiritual-Significance</label>
            <input id="Spiritual-SignificanceEdit" type="text" name="spiritual_significance" class="form-control">
        </div>
    </div>

    <!--  -->
    <div class="row mb-3">
        <!-- cultural_importance -->
        <div class="col-6">
            <label for="Cultural-ImportanceEdit" class="form-label small-font">Cultural Importance</label>
            <input id="Cultural-ImportanceEdit" type="text" name="cultural_importance" class="form-control">
        </div>
        <!-- cultural_use-->
        <div class="col-6">
            <label for="Cultural-UseEdit" class="form-label small-font">Cultural Use</label>
            <input id="Cultural-UseEdit" type="text" name="cultural_use" class="form-control">
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-start">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-backward"></i></button>
        </div>
    </div>
</div>