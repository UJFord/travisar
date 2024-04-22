<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-more-tab-pane" role="tabpanel" aria-labelledby="edit-more-tab" tabindex="0">
    <!-- corn morphological traits -->
    <?php require "approval-page/tabs/edit-traits/corn-traits-edit.php" ?>
    <!-- rice morphological traits -->
    <?php require "approval-page/tabs/edit-traits/rice-traits-edit.php" ?>
    <!-- rootCrop morphological traits -->
    <?php require "approval-page/tabs/edit-traits/rootCrop-traits-edit.php" ?>

    <!-- STEP NAVIGATION without Sensory -->
    <div class="row" id="withoutSensory-Edit-More">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open General tab" onclick="switchTab('edit-gen')"><i class="fa-solid fa-angles-left me-2"></i>Previous</i></button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Agronomic traits tab" onclick="switchTab('edit-agro',this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
    
    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory-Edit-More">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open General tab" onclick="switchTab('edit-gen')"><i class="fa-solid fa-angles-left me-2"></i>Previous</i></button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Agronomic traits tab" onclick="switchTab('edit-sensory',this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
</div>