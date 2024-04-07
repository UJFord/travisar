<!-- MORE TAB -->
<div class="fade show active tab-pane" id="more-tab-pane" role="tabpanel" aria-labelledby="more-tab" tabindex="0">
    <!-- rice morphological traits -->
    <?php require "crop-page/modals/tabs/traits/corn-traits.php" ?>
    <!-- rice morphological traits -->
    <?php require "crop-page/modals/tabs/traits/rice-traits.php" ?>
    <!-- root crop morphological traits -->
    <?php require "crop-page/modals/tabs/traits/rootCrop-traits.php" ?>
    <!-- Utilization ang Cultural Importance-->
    <div class="row mb-4">
        <label class="form-label"><strong>Utilization ang Cultural Importance</strong></label>
        <!-- Significance -->
        <div class="col-12 mb-2">
            <label for="Significance" class="form-label small-font">Significance</label>
            <textarea name="significance" id="Significance" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Use -->
        <div class="col-12 mb-2">
            <label for="Use" class="form-label small-font">Use</label>
            <textarea name="use" id="Use" cols="30" rows="1" class="form-control"></textarea>
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

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-start">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc', this)">Previous</button>
        </div>
    </div>
</div>