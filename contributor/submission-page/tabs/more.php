<!-- MORE TAB -->
<div class="fade tab-pane" id="more-tab-pane" role="tabpanel" aria-labelledby="more-tab" tabindex="0">
    <!-- rice morphological traits -->
    <?php require "tabs/traits/corn-traits.php" ?>
    <!-- rice morphological traits -->
    <?php require "tabs/traits/rice-traits.php" ?>
    <!-- root crop morphological traits -->
    <?php require "tabs/traits/rootCrop-traits.php" ?>

    <div id="selectMorph">
        <h6 class="fw-semibold mt-4 mb-0">Please select a category to show morphological characteristics</h6>

    </div>

    <!-- STEP NAVIGATION without Sensory -->
    <div class="row" id="withoutSensory-More">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('gen', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('agro', this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory-More">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('gen', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('sensory', this)">Next<i class="fa-solid fa-angles-right ms-2"></i></button>
        </div>
    </div>
</div>