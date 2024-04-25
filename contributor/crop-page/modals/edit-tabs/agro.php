<!-- MORE TAB -->
<div class="fade tab-pane" id="edit-agro-tab-pane" role="tabpanel" aria-labelledby="edit-agro-tab" tabindex="0">
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
                        <input class="form-check-input" type="checkbox" name="pest_resistance[]" id="pest_resistance_Edit<?= $pest_resistance_id ?>" value="<?= $pest_resistance_id ?>">
                        <label class="form-check-label small-font" for="pest_resistance_Edit<?= $pest_resistance_id ?>"><?= $pest_name ?></label>
                    </div>
            <?php
                }
            }
            ?>
            <div class="col-3 form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="pest_other" id="pest_other_checkEdit" value="1">
                <label class="form-check-label small-font" for="pest_other_checkEdit">Other</label>
            </div>
        </div>

        <!-- Other -->
        <div id="pest-otherEdit" class="d-none row mt-3 mb-5">
            <div class="col-12 mb-0">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <textarea name="pest_other_desc" id="pestEdit" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
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
                        <input class="form-check-input" type="checkbox" name="disease_resistance[]" id="disease_resistance_Edit<?= $disease_resistance_id ?>" value="<?= $disease_resistance_id ?>">
                        <label class="form-check-label small-font" for="disease_resistance_Edit<?= $disease_resistance_id ?>"><?= $disease_name ?></label>
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
                        <input class="form-check-input" type="checkbox" name="abiotic_resistance[]" id="abiotic_resistance_Edit<?= $abiotic_resistance_id ?>" value="<?= $abiotic_resistance_id ?>">
                        <label class="form-check-label small-font" for="abiotic_resistance_Edit<?= $abiotic_resistance_id ?>"><?= $abiotic_name ?></label>
                    </div>
            <?php
                }
            }
            ?>
            <div class="col-3 form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="abiotic_other" id="abiotic_other_checkEdit" value="1">
                <label class="form-check-label small-font" for="abiotic_other_checkEdit">Other</label>
            </div>
        </div>

        <!-- Other -->
        <div id="abiotic_otherEdit" class="d-none row mt-3 mb-3">
            <div class="col-12 mb-2">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <textarea name="abiotic_other_desc" id="abiotic_other-descEdit" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
                <div class="form-text small-font" id="cornPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
            </div>
        </div>
    </div>

    <!-- STEP NAVIGATION with out Sensory -->
    <div class="row" id="withoutSensory-Edit">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('edit-more')"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('edit-cultural', this)">Next<i class="fa-solid fa-angles-right me-2"></i></button>
        </div>
    </div>
    <!-- STEP NAVIGATION with Sensory -->
    <div class="row" id="withSensory-Edit">
        <div class="col d-flex justify-content-between">
            <button class="btn btn-light border small-font fw-bold text-dark-emphasis" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to open Location tab" onclick="switchTab('edit-sensory')"><i class="fa-solid fa-angles-left me-2"></i>Previous</button>
            <button class="btn btn-light border small-font fw-bold text-info-emphasis" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to open Location tab" onclick="switchTab('edit-cultural', this)">Next<i class="fa-solid fa-angles-right me-2"></i></button>
        </div>
    </div>
</div>
<!--  script for the other checkboxes -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const pest_other_checkEdit = document.getElementById('pest_other_checkEdit');
        const pest_otherEdit = document.getElementById('pest-otherEdit');

        const abiotic_other_checkEdit = document.getElementById('abiotic_other_checkEdit');
        const abiotic_otherEdit = document.getElementById('abiotic_otherEdit');

        pest_other_checkEdit.addEventListener('change', function() {
            pest_otherEdit.classList.toggle('d-none', !this.checked);
        });

        abiotic_other_checkEdit.addEventListener('change', function() {
            abiotic_otherEdit.classList.toggle('d-none', !this.checked);
        });
    });
</script>