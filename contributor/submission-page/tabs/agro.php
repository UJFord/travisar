<!-- MORE TAB -->
<div class="fade tab-pane" id="agro-tab-pane" role="tabpanel" aria-labelledby="agro-tab" tabindex="0">
    <div>
        <!-- pest resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Pest Resistance</h6>
        <div class="row mb-2">
            <div class="col-4 mb-3">
                <?php
                // get the data of category from DB
                $query = "SELECT * FROM pest_resistance ORDER BY pest_name ASC";
                $query_run = pg_query($conn, $query);

                $count = pg_num_rows($query_run);
                $checkbox_limit = 7; // Set the number of checkboxes per column
                $checkbox_count = 0; // Initialize checkbox count

                // if count is greater than 0 there is data
                if ($count > 0) {
                    // loop for displaying all categories
                    while ($row = pg_fetch_assoc($query_run)) {
                        $pest_resistance_id = $row['pest_resistance_id'];
                        $pest_name = $row['pest_name'];

                        // Check if the checkbox count has reached the limit
                        if ($checkbox_count >= $checkbox_limit) {
                            // Reset the checkbox count and close the current column
                            echo '</div><div class="col-4">';
                            $checkbox_count = 0;
                        }

                        // Display the checkbox and label
                        echo '<div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pest_resistance[]" id="pest_resistance_' . $pest_resistance_id . '" value="' . $pest_resistance_id . '">
                                <label class="form-check-label small-font" for="pest_resistance_' . $pest_resistance_id . '">' . $pest_name . '</label>
                            </div>';

                        // Increment the checkbox count
                        $checkbox_count++;
                    }
                }
                ?>
            </div>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="pest_other" id="pest_other_check" value="1">
            <label class="form-check-label small-font" for="pest_other_check">Other</label>
        </div>

        <!-- Other -->
        <div id="pest-other" class="d-none row mt-3 mb-5">
            <div class="col-12 mb-0">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <div class="form-text small-font" id="cornPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
                <textarea name="pest_other_desc" id="pest" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
            </div>
        </div>

        <!-- Disease Resistance -->
        <h6 class="fw-semibold mt-4 mb-3">Disease Resistance</h6>
        <div class="row mb-2">
            <div class="col-4 mb-3">
                <?php
                // get the data of category from DB
                $query = "SELECT * FROM disease_resistance ORDER BY disease_name ASC";
                $query_run = pg_query($conn, $query);

                $count = pg_num_rows($query_run);
                $checkbox_limit = 7; // Set the number of checkboxes per column
                $checkbox_count = 0; // Initialize checkbox count

                // if count is greater than 0 there is data
                if ($count > 0) {
                    // loop for displaying all categories
                    while ($row = pg_fetch_assoc($query_run)) {
                        $disease_resistance_id = $row['disease_resistance_id'];
                        $disease_name = $row['disease_name'];

                        // Check if the checkbox count has reached the limit
                        if ($checkbox_count >= $checkbox_limit) {
                            // Reset the checkbox count and close the current column
                            echo '</div><div class="col-4 mb-3">';
                            $checkbox_count = 0;
                        }

                        // Display the checkbox and label
                        echo '<div class="form-check">
                                <input class="form-check-input" type="checkbox" name="disease_resistance[]" id="disease_resistance_' . $disease_resistance_id . '" value="' . $disease_resistance_id . '">
                                <label class="form-check-label small-font" for="disease_resistance_' . $disease_resistance_id . '">' . $disease_name . '</label>
                            </div>';

                        // Increment the checkbox count
                        $checkbox_count++;
                    }
                }
                ?>
            </div>
        </div>

        <!-- Resistance to Abiotic Stress -->
        <h6 class="fw-semibold mt-4 mb-3">Resistance to Abiotic Stress</h6>
        <div class="row mb-2">
            <div class="col-4 mb-3">
                <?php
                // get the data of category from DB
                $query = "SELECT * FROM abiotic_resistance ORDER BY abiotic_name ASC";
                $query_run = pg_query($conn, $query);

                $count = pg_num_rows($query_run);
                $checkbox_limit = 7; // Set the number of checkboxes per column
                $checkbox_count = 0; // Initialize checkbox count

                // if count is greater than 0 there is data
                if ($count > 0) {
                    // loop for displaying all categories
                    while ($row = pg_fetch_assoc($query_run)) {
                        $abiotic_resistance_id = $row['abiotic_resistance_id'];
                        $abiotic_name = $row['abiotic_name'];

                        // Check if the checkbox count has reached the limit
                        if ($checkbox_count >= $checkbox_limit) {
                            // Reset the checkbox count and close the current column
                            echo '</div><div class="col-4 mb-3">';
                            $checkbox_count = 0;
                        }

                        // Display the checkbox and label
                        echo '<div class="form-check">
                                <input class="form-check-input" type="checkbox" name="abiotic_resistance[]" id="abiotic_resistance_' . $abiotic_resistance_id . '" value="' . $abiotic_resistance_id . '">
                                <label class="form-check-label small-font" for="abiotic_resistance_' . $abiotic_resistance_id . '">' . $abiotic_name . '</label>
                            </div>';

                        // Increment the checkbox count
                        $checkbox_count++;
                    }
                }
                ?>
            </div>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="abiotic_other" id="abiotic_other_check" value="1">
            <label class="form-check-label small-font" for="abiotic_other_check">Other</label>
        </div>

        <!-- Other -->
        <div id="abiotic_other" class="d-none row mt-3 mb-3">
            <div class="col-12 mb-2">
                <!-- <label for="corn-other" class="form-label small-font">If others, please specify</label> -->
                <div class="form-text small-font" id="cornPestOtherHelpBlock">If others, please specify and separate them by a comma ( <span class="fw-semibold">,</span> )</div>
                <textarea name="abiotic_other_desc" id="abiotic_other" cols="30" rows="1" class="form-control" aria-describedby="cornPestOtherHelpBlock"></textarea>
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
<!--  script for the other checkboxes -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const pest_other_check = document.getElementById('pest_other_check');
        const pest_other = document.getElementById('pest-other');

        const abiotic_other_check = document.getElementById('abiotic_other_check');
        const abiotic_other = document.getElementById('abiotic_other');

        pest_other_check.addEventListener('change', function() {
            pest_other.classList.toggle('d-none', !this.checked);
        });

        abiotic_other_check.addEventListener('change', function() {
            abiotic_other.classList.toggle('d-none', !this.checked);
        });
    });
</script>