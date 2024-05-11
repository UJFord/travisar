<!-- MORE TAB -->
<div class="fade tab-pane" id="view-more-tab-pane" role="tabpanel" aria-labelledby="view-more-tab" tabindex="0">
    <!-- corn morphological traits -->
    <?php require "modals/manage-tabs/view-traits/corn-traits-view.php" ?>
    <!-- rice morphological traits -->
    <?php require "modals/manage-tabs/view-traits/rice-traits-view.php" ?>
    <!-- rootCrop morphological traits -->
    <?php require "modals/manage-tabs/view-traits/rootCrop-traits-view.php" ?>

    <!-- STEP NAVIGATION without Sensory -->
    <div class="row" id="withoutSensory-View-More">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open General tab" onclick="switchTab('view-gen')"><i class="fa-solid fa-angles-left me-2"></i>Previous</i></button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Agronomic traits tab" onclick="switchTab('view-agro',this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
    
    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory-View-More">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open General tab" onclick="switchTab('view-gen')"><i class="fa-solid fa-angles-left me-2"></i>Previous</i></button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Agronomic traits tab" onclick="switchTab('view-sensory',this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
</div>