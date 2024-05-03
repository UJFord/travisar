<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal-brgy" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Add Barangay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" action="code/code-brgy.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div>
                        <button type="button" id="add-row-brgy" class="btn btn-secondary mb-3" style="margin-left: 10px; background-color: var(--mainBrand);">Add</button>
                    </div>
                    <div class="container">
                        <div id="locationDataBrgy">
                            <!-- Municipality AND Barangay -->
                            <div class="row mb-3 location-brgy">
                                <!-- municipality name -->
                                <div class="col">
                                    <label for="municipality-Name" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                                    <select name="municipality_name_1" id="municipality-Name" class="form-select">
                                        <?php
                                        $queryMuni = "SELECT * from municipality order by municipality_name ASC";
                                        $query_run = pg_query($conn, $queryMuni);

                                        $count = pg_num_rows($query_run);

                                        // if count is greater than 0 there is data
                                        if ($count > 0) {
                                            // loop for displaying all categories
                                            while ($row = pg_fetch_assoc($query_run)) {
                                                $municipality_id = $row['municipality_id'];
                                                $municipality_name = $row['municipality_name'];
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
                                    <input type="text" name="barangay_name_1" class="form-control">
                                </div>

                                <!-- Coordinates -->
                                <div class="col">
                                    <label for="coordInput" class="form-label small-font">Coordinates<span style="color: red;">*</span></label>
                                    <input type="text" id="coordInput" name="barangay_coordinates_1" class="form-control">
                                </div>
                                <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Separate latitude and longitude with a comma (<span class="fw-bold">latitude , longitude - 5.7600, 125.3466</span>)</div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="save" onclick="validateAndSubmitForm()" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- for submission -->
<script>
    // for adding and removing rows dynamically
    // i set the names for each input field to be unique name attribute 
    // (province_name_1, municipality_name_1, province_name_2, municipality_name_2, and so on)
    // for when the form is submitted hiwalay ang pag save
    document.addEventListener('DOMContentLoaded', function() {
        const addRowButton = document.getElementById('add-row-brgy');
        const locationDataBrgy = document.getElementById('locationDataBrgy');
        let rowCounter = 1;

        addRowButton.addEventListener('click', function() {
            rowCounter++;
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-3', 'location-brgy');
            newRow.innerHTML = `
                <div class="col">
                    <label for="Municipality-Name" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                    <select name="municipality_name_${rowCounter}" class="form-select">
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
                <div class="col">
                    <label for="Barangay-Name" class="form-label small-font">Barangay Name<span style="color: red;">*</span></label>
                    <input type="text" name="barangay_name_${rowCounter}" class="form-control">
                </div>
                <!-- Coordinates -->
                <div class="col">
                    <label for="barangay-coordinates" class="form-label small-font">Coordinates<span style="color: red;">*</span></label>
                    <input type="text" name="barangay_coordinates_${rowCounter}" class="form-control">
                </div>
                <div class="col-2" style="padding-top: 25px;">
                    <button type="button" class="btn btn-secondary remove-row" style="background-color: #dc3545;">Remove</button>
                </div>
            `;
            locationDataBrgy.appendChild(newRow);
        });

        locationDataBrgy.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.location-brgy').remove();
            }
        });

        window.addEventListener('beforeunload', function(e) {
            // Reset the form data here
            locationDataBrgy.innerHTML = '';
            rowCounter = 1; // Reset the row counter
        });
    });

    // Function to validate input and submit the form
    function validateAndSubmitForm() {
        // Validate the form
        if (validateForm()) {
            // If validation succeeds, submit the form
            submitForm();
        }
    }

    // Function to validate input
    function validateForm() {
        // Get the values from the form
        var cropName = document.forms["Form"]["crop_variety"].value;

        // Check if the required fields are not empty
        if (cropName === "") {
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
    function switchTab(tabName) {
        // prevent submitting the form
        event.preventDefault();

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }
</script>

<!-- script for limiting the input in coordinates just to numbers, commas, periods, and spaces -->
<script>
    document.getElementById('coordInput').addEventListener('input', function(event) {
        const regex = /^[0-9.,\s-]*$/; // Updated regex to allow "-" sign
        if (!regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(/[^0-9.,\s-]/g, '');
        }
    });
</script>