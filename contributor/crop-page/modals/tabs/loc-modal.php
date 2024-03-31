<div class="modal fade" id="locEditModal" tabindex="-1" role="dialog" aria-labelledby="locEditModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Location</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row container">
                    <!-- form -->
                    <div class="col-6">

                        <!-- Province dropdown -->
                        <label for="Province" class="form-label small-font">Province <span style="color: red;">*</span></label>
                        <select id="Province" name="province" class="form-select mb-2" readonly>
                            <?php
                            // Fetch distinct province names from the location table
                            $queryProvince = "SELECT DISTINCT province_name FROM location ORDER BY province_name ASC";
                            $query_run = pg_query($conn, $queryProvince);

                            $count = pg_num_rows($query_run);

                            // If there is data, display distinct province names
                            if ($count > 0) {
                                while ($row = pg_fetch_assoc($query_run)) {
                                    $province_name = $row['province_name'];
                            ?>
                                    <option value="<?= $province_name; ?>"><?= $province_name; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <!-- Municipality dropdown -->
                        <label for="Municipality" class="form-label small-font mb-0">Municipality <span style="color: red;">*</span></label>
                        <select id="Municipality" name="municipality" class="form-select mb-2" required>
                        </select>

                        <!-- barangay -->
                        <label for="Barangay" class="form-label small-font mb-0">Barangay <span style="color: red;">*</span></label>
                        <select id="Barangay" name="barangay" class="form-select mb-2" required>
                        </select>

                        <!-- coordinates -->
                        <label for="coordInput" class="form-label small-font mb-0">Coordinates <span style="color: red;">*</span></label>
                        <input id="coordInput" name="coordinates" type="text" class="form-control" aria-describedby="coords-help" required>
                        <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Separate latitude and longitude with a comma (latitude , longitude)</div>

                    </div>

                    <!-- map -->
                    <div id="map" class="col border rounded">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button data-bs-toggle="modal" data-bs-target="#add-item-modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script>
    //script for limiting the input in coordinates just to numbers, commas, periods, and spaces
    document.getElementById('coordInput').addEventListener('input', function(event) {
        const regex = /^[0-9.,\s-]*$/; // Updated regex to allow "-" sign
        if (!regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(/[^0-9.,\s-]/g, '');
        }
    });
</script>