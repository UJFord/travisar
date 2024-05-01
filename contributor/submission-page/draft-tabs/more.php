<!-- MORE TAB -->
<div class="fade tab-pane" id="draft-more-tab-pane" role="tabpanel" aria-labelledby="draft-more-tab" tabindex="0">
    <!-- rice morphological traits -->
    <?php require "draft-tabs/traits/corn-traits.php" ?>
    <!-- rice morphological traits -->
    <?php require "draft-tabs/traits/rice-traits.php" ?>
    <!-- root crop morphological traits -->
    <?php require "draft-tabs/traits/rootCrop-traits.php" ?>

    <!-- STEP NAVIGATION without Sensory -->
    <div class="row" id="withoutSensory-More-Draft">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('draft-gen', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('draft-agro', this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory-More-Draft">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('draft-gen', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('draft-sensory', this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
</div>