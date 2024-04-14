<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-more-tab-pane" role="tabpanel" aria-labelledby="edit-more-tab" tabindex="0">
    <!-- corn morphological traits -->
    <?php require "crop-page/modals/edit-tabs/edit-traits/corn-traits-edit.php" ?>
    <!-- rice morphological traits -->
    <?php require "crop-page/modals/edit-tabs/edit-traits/rice-traits-edit.php" ?>
    <!-- rootCrop morphological traits -->
    <?php require "crop-page/modals/edit-tabs/edit-traits/rootCrop-traits-edit.php" ?>

    <!-- STEP NAVIGATION -->
    <div class="row">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open General tab" onclick="switchTab('edit-gen')"><i class="fa-solid fa-backward"></i></button>
            <button class="btn btn-light border" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Agronomic traits tab" onclick="switchTab('edit-agro',this)"><i class="fa-solid fa-forward"></i></button>
        </div>
    </div>
</div>