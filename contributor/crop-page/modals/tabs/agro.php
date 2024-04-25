<!-- MORE TAB -->
<div class="fade tab-pane" id="agro-tab-pane" role="tabpanel" aria-labelledby="agro-tab" tabindex="0">
    <div>
        <!-- pest resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Pest Resistance</h6>
        <div class="row mb-0 ps-3">
            <?php
            // get the data of category from DB
            $query = "SELECT * FROM pest_resistance ORDER BY pest_name ASC";
            $query_run = pg_query($conn, $query);

            $count = pg_num_rows($query_run);

            // if count is greater than 0 there is data
            if ($count > 0) {
                // loop for displaying all categories
                while ($row = pg_fetch_assoc($query_run)) {
                    $pest_resistance_id = $row['pest_resistance_id'];
                    $pest_name = $row['pest_name'];
            ?>
                    <div class="col-3 form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="pest_resistance[]" id="pest_resistance_<?= $pest_resistance_id ?>" value="<?= $pest_resistance_id ?>">
                        <label class="form-check-label small-font" for="pest_resistance_<?= $pest_resistance_id ?>"><?= $pest_name ?></label>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <!-- Other -->
        <div id="corn-pest-other" class="d-none row mt-3 mb-5">
            <div class="col-12 mb-0">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <textarea name="corn_others_desc" id="corn-other" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
                <div class="form-text small-font" id="cornPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>

        <!-- Disease Resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Disease Resistance</h6>
        <div class="row mb-5 ps-3">
            <?php
            // get the data of category from DB
            $query = "SELECT * FROM disease_resistance ORDER BY disease_name ASC";
            $query_run = pg_query($conn, $query);

            $count = pg_num_rows($query_run);

            // if count is greater than 0 there is data
            if ($count > 0) {
                // loop for displaying all categories
                while ($row = pg_fetch_assoc($query_run)) {
                    $disease_resistance_id = $row['disease_resistance_id'];
                    $disease_name = $row['disease_name'];
            ?>
                    <div class="col-3 form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="disease_resistance[]" id="disease_resistance_<?= $disease_resistance_id ?>" value="<?= $disease_resistance_id ?>">
                        <label class="form-check-label small-font" for="disease_resistance_<?= $disease_resistance_id ?>"><?= $disease_name ?></label>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <h6 class="fw-semibold mt-4 mb-3">Resistance to Abiotic Stress</h6>
        <div class="row mb-0 ps-3">
            <?php
            // get the data of category from DB
            $query = "SELECT * FROM abiotic_resistance ORDER BY abiotic_name ASC";
            $query_run = pg_query($conn, $query);

            $count = pg_num_rows($query_run);

            // if count is greater than 0 there is data
            if ($count > 0) {
                // loop for displaying all categories
                while ($row = pg_fetch_assoc($query_run)) {
                    $abiotic_resistance_id = $row['abiotic_resistance_id'];
                    $abiotic_name = $row['abiotic_name'];
            ?>
                    <div class="col-3 form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="abiotic_resistance[]" id="abiotic_resistance_<?= $abiotic_resistance_id ?>" value="<?= $abiotic_resistance_id ?>">
                        <label class="form-check-label small-font" for="abiotic_resistance_<?= $abiotic_resistance_id ?>"><?= $abiotic_name ?></label>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <!-- Other -->
        <div class="row mt-3 mb-3">
            <div id="corn-abiotic-other-container" class="col-12 mb-2 d-none">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <textarea name="corn_others_desc" id="corn-abiotic-other" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
                <div class="form-text small-font" id="cornPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION without Sensory -->
    <div class="row" id="withoutSensory">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('more', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('cultural', this)">Next<i class="fa-solid fa-angles-right me-2"></i></button>
        </div>
    </div>
    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('sensory', this)"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('cultural', this)">Next<i class="fa-solid fa-angles-right me-2"></i></button>
        </div>
    </div>
</div>

<!-- <script>
    const cornOtherCheck = document.getElementById('corn-other-check');
    const cornPestOther = document.getElementById('corn-pest-other');

    const cornAbioticCheck = document.getElementById('corn-abiotic-check');
    const cornAbioticOtherContainer = document.getElementById('corn-abiotic-other-container');

    // New for rice checkboxes
    const riceOtherCheck = document.getElementById('rice-other-check');
    const ricePestOther = document.getElementById('rice-pest-other-container'); // Use the correct ID here

    const riceAbioticCheck = document.getElementById('rice-abiotic-other-check');
    const riceAbioticOtherContainer = document.getElementById('rice-abiotic-other-container');

    const rootCropOtherCheck = document.getElementById('rootCrop-other-check');
    const rootPestOtherContainer = document.getElementById('root-pest-other-container'); // Notice the container ID

    const rootCropAbioticCheck = document.getElementById('rootCrop-abiotic-other-check');
    const rootAbioticOtherContainer = document.getElementById('root-abiotic-other-container');


    cornOtherCheck.addEventListener('change', function() {
        cornPestOther.classList.toggle('d-none', !this.checked);
    });

    cornAbioticCheck.addEventListener('change', function() {
        cornAbioticOtherContainer.classList.toggle('d-none', !this.checked);
    });

    // Event listeners for rice checkboxes
    riceOtherCheck.addEventListener('change', function() {
        ricePestOther.classList.toggle('d-none', !this.checked);
    });

    riceAbioticCheck.addEventListener('change', function() {
        riceAbioticOtherContainer.classList.toggle('d-none', !this.checked);
    });

    rootCropOtherCheck.addEventListener('change', function() {
        rootPestOtherContainer.classList.toggle('d-none', !this.checked);
    });

    rootCropAbioticCheck.addEventListener('change', function() {
        rootAbioticOtherContainer.classList.toggle('d-none', !this.checked);
    });
</script> -->