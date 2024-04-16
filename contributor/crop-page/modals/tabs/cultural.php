<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<!-- LOCATION TAB -->
<div class="fade tab-pane" id="cultural-tab-pane" role="tabpanel" aria-labelledby="cultural-tab" tabindex="0">
    <!-- Utilization ang Cultural Importance-->
    <h6 class="fw-semibold mt-4 mb-3">Utilization and Cultural Importance</h6>
    <div class="row mb-4">
        <!-- Significance -->
        <div class="col-12 mb-2">
            <label for="Significance" class="form-label small-font">Significance</label>
            <textarea name="significance" id="Significance" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Use -->
        <div class="col-12 mb-2">
            <label for="Use" class="form-label small-font">Use</label>
            <textarea name="use" id="Use" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Indigenous Utilization -->
        <div class="col-12 mb-2">
            <label for="indigenous-utilization" class="form-label small-font">Indigenous Utilization</label>
            <textarea name="indigenous_utilization" id="indigenous-utilization" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Remarkable Features-->
        <div class="col-12 mb-2">
            <label for="remarkable-features" class="form-label small-font">Remarkable Features</label>
            <textarea name="remarkable_features" id="remarkable-features" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory-More">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('agro', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('references', this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
</div>