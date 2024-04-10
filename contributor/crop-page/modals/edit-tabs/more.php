<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-more-tab-pane" role="tabpanel" aria-labelledby="edit-more-tab" tabindex="0">
    <!-- corn morphological traits -->
    <?php require "crop-page/modals/edit-tabs/edit-traits/corn-traits-edit.php" ?>
    <!-- rice morphological traits -->
    <?php require "crop-page/modals/edit-tabs/edit-traits/rice-traits-edit.php" ?>
    
    <!-- Utilization ang Cultural Importance-->
    <div class="row mb-4">
        <label class="form-label"><strong>Utilization ang Cultural Importance</strong></label>
        <!-- Significance -->
        <div class="col-12 mb-2">
            <label for="SignificanceEdit" class="form-label small-font">Significance</label>
            <textarea name="significance" id="SignificanceEdit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Use -->
        <div class="col-12 mb-2">
            <label for="UseEdit" class="form-label small-font">Use</label>
            <textarea name="use" id="UseEdit" cols="30" rows="1" class="form-control"></textarea>
        </div>

        <!-- Indigenous Utilization -->
        <div class="col-12 mb-2">
            <label for="indigenous-utilization-Edit" class="form-label small-font">Indigenous Utilization</label>
            <textarea name="indigenous_utilization" id="indigenous-utilization-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>

        <!-- Remarkable Features-->
        <div class="col-12 mb-2">
            <label for="remarkable-features-Edit" class="form-label small-font">Remarkable Features</label>
            <textarea name="remarkable_features" id="remarkable-features-Edit" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-start">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('loc')"><i class="fa-solid fa-backward"></i></button>
        </div>
    </div>
</div>