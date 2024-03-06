<!-- MORE TAB -->
<div class="fade tab-pane" id="more-tab-pane" role="tabpanel" aria-labelledby="more-tab" tabindex="0">
    <h3>Characteristics</h3>

    <!-- Taste and Aroma-->
    <div class="row mb-3">
        <!-- Taste -->
        <div class="col-4">
            <label for="Taste" class="form-label small-font">Taste</label>
            <input id="Taste" type="text" name="taste" class="form-control">
        </div>

        <!-- Aroma -->
        <div class="col-4">
            <label for="Aroma" class="form-label small-font">Aroma</label>
            <input id="Aroma" type="text" name="aroma" class="form-control">
        </div>

        <!-- Maturation -->
        <div class="col-4">
            <label for="Maturation" class="form-label small-font">Maturation</label>
            <input id="Maturation" type="text" name="maturation" class="form-control">
        </div>
    </div>

    <!-- Pest and Disease -->
    <div class="row mb-3">
        <!-- Pest -->
        <div class="col-6">
            <label for="Pest" class="form-label small-font">Pest</label>
            <input id="Pest" type="text" name="pest" class="form-control">
        </div>

        <!-- Disease -->
        <div class="col-6">
            <label for="Disease" class="form-label small-font">Disease</label>
            <input id="Disease" type="text" name="disease" class="form-control">
        </div>
    </div>

    <br>

    <h3>Cultural Aspect</h3>
    <!-- Cultural and Spiritual Significance-->
    <div class="row mb-3">
        <!-- Cultural-Significance -->
        <div class="col-6">
            <label for="Cultural-Significance" class="form-label small-font">Cultural-Significance</label>
            <input id="Cultural-Significance" type="text" name="cultural_significance" class="form-control">
        </div>

        <!-- Spiritual-Significance -->
        <div class="col-6">
            <label for="Spiritual-Significance" class="form-label small-font">Spiritual-Significance</label>
            <input id="Spiritual-Significance" type="text" name="spiritual_significance" class="form-control">
        </div>
    </div>

    <!--  -->
    <div class="row mb-3">
        <!-- cultural_importance -->
        <div class="col-6">
            <label for="Cultural-Importance" class="form-label small-font">Cultural Importance</label>
            <input id="Cultural-Importance" type="text" name="cultural_importance" class="form-control">
        </div>
        <!-- cultural_use-->
        <div class="col-6">
            <label for="Cultural-Use" class="form-label small-font">Cultural Use</label>
            <input id="Cultural-Use" type="text" name="cultural_use" class="form-control">
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-start">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-backward"></i></button>
        </div>
    </div>
</div>