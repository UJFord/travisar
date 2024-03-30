<!-- MORE TAB -->
<div class="fade tab-pane" id="more-tab-pane" role="tabpanel" aria-labelledby="more-tab" tabindex="0">
    <!-- Cultural and Spiritual Significance-->
    <div class="row mb-4">
        <!-- Cultural-Significance -->
        <div class="col-12 mb-2">
            <label for="Cultural-Significance" class="form-label small-font">Cultural-Significance</label>
            <textarea name="cultural_significance" id="Cultural-Significance" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Spiritual-Significance -->
        <div class="col-12 mb-2">
            <label for="Spiritual-Significance" class="form-label small-font">Spiritual-Significance</label>
            <textarea name="spiritual_significance" id="Spiritual-Significance" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- cultural_importance -->
        <div class="col-12 mb-2">
            <label for="Cultural-Importance" class="form-label small-font">Cultural Importance</label>
            <textarea name="cultural_importance" id="Cultural-Importance" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- cultural_use-->
        <div class="col-12 mb-2">
            <label for="Cultural-Use" class="form-label small-font">Cultural Use</label>
            <textarea name="cultural_use" id="Cultural-Use" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <br>
    <hr>
    <div id="more-help" class="form-text mb-2" style="font-size: 0.6rem;">the data below is based on farmers knowledge.</div>
    <br>

    <!-- Taste and Aroma-->
    <div class="row mb-4">
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
    <div class="row mb-4">
        <!-- Pest -->
        <div class="col-6">
            <label for="Pest" class="form-label small-font">Pest Resistance</label>
            <input id="Pest" type="text" name="pest" class="form-control">
        </div>

        <!-- Disease -->
        <div class="col-6">
            <label for="Disease" class="form-label small-font">Disease Resistance</label>
            <input id="Disease" type="text" name="diseases" class="form-control">
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc', this)">Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('other_info', this)">Next</button>
        </div>
    </div>
</div>