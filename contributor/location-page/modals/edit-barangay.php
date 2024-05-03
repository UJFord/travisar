<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="edit-item-modal-brgy" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit Barangay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" action="code/code-brgy.php" autocomplete="off" method="POST" class=" py-3 px-5" onsubmit="validateAndSubmitForm(event)">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="locationData">
                            <!-- municipality AND barangay -->
                            <div class="row mb-3 location-row">
                                <!-- municipality name -->
                                <div class="col">
                                    <label for="municipality-Name-Edit" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                                    <select name="municipality_id" id="municipality-Name-Edit" class="form-select">
                                        <?php
                                        $queryMuni = "SELECT * from municipality order by municipality_name ASC";
                                        $query_run = pg_query($conn, $queryMuni);

                                        $count = pg_num_rows($query_run);

                                        // if count is greater than 0 there is data
                                        if ($count > 0) {
                                            // loop for displaying all categories
                                            while ($row = pg_fetch_assoc($query_run)) {
                                                $municipality_name = $row['municipality_name'];
                                                $municipality_id = $row['municipality_id'];
                                        ?>
                                                <option value="<?= $municipality_id; ?>"><?= $municipality_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- barangay name -->
                                <div class="col">
                                    <label for="barangay-Name" class="form-label small-font">Barangay Name<span style="color: red;">*</span></label>
                                    <input type="text" id="barangay-Name" name="barangay_name" class="form-control">
                                </div>

                                <!-- Coordinates -->
                                <div class="col">
                                    <label for="CoordinatesEdit" class="form-label small-font">Coordinates<span style="color: red;">*</span></label>
                                    <input type="text" id="CoordinatesEdit" name="coordinates" class="form-control">
                                </div>
                                <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Separate latitude and longitude with a comma (<span class="fw-bold">latitude , longitude - 5.7600, 125.3466</span>)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
                        <input type="hidden" name="barangay_id" id="barangay_id-Edit">
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update" onclick="validateAndSubmitForm()" class="btn btn-success">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- for submission -->
<script>
    // Function to validate input and submit the form
    function validateAndSubmitForm(event) {
        // Validate the form
        if (validateForm()) {
            // If validation succeeds, submit the form
            submitForm();
        }
    }

    // Function to validate input
    function validateForm() {
        // Get the values from the form
        var barangay_name = document.forms["Form"]["barangay_name"].value;

        // Check if the required fields are not empty
        if (barangay_name === "") {
            alert("Please fill out all required fields.");
            return false; // Prevent form submission
        }
        // You can add more validation checks if needed
        return true; // Allow form submission
    }

    // Function to submit the form and refresh notifications
    function submitForm() {
        console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel');
        // Trigger the form submission
        if (form) {
            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "code/code-brgy.php",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // Reset the form
                    form.reset();
                    // Reload unseen notifications
                    load_unseen_notification();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Form submission error:", textStatus, errorThrown);
                    // Handle error if needed
                }
            });
        }
    }

    // tab switching
    // next button

    function switchTab(tabName, event) {
        // prevent submitting the form
        event.preventDefault();

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }
</script>

<!-- script for limiting the input in coordinates just to numbers, commas, periods, and spaces -->
<script>
    document.getElementById('Coordinates').addEventListener('input', function(event) {
        const regex = /^[0-9.,\s-]*$/; // Updated regex to allow "-" sign
        if (!regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(/[^0-9.,\s-]/g, '');
        }
    });
</script>