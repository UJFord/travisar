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

            <div id="error-messages"></div>
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
                                    <label for="municipality-Name_1" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                                    <select name="municipality_name_1" id="municipality-Name_1" class="form-select">
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
                                    <label for="barangay-Name_1" class="form-label small-font">Barangay Name<span style="color: red;">*</span></label>
                                    <input id="barangay-Name_1" type="text" name="barangay_name_1" class="form-control">
                                </div>

                                <!-- Coordinates -->
                                <div class="col">
                                    <label for="coordInput_1" class="form-label small-font">Coordinates<span style="color: red;">*</span></label>
                                    <input type="text" id="coordInput_1" name="barangay_coordinates_1" class="form-control">
                                </div>
                                <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Separate latitude and longitude with a comma (<span class="fw-bold">latitude , longitude - 5.7600, 125.3466</span>)</div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
                        <input type="hidden" name="save">
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="save" class="btn btn-success">Save</button>
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
                    <label for="Municipality-Name_${rowCounter}" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                    <select id="Municipality-Name_${rowCounter}" name="municipality_name_${rowCounter}" class="form-select">
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
                    <label for="Barangay-Name_${rowCounter}" class="form-label small-font">Barangay Name<span style="color: red;">*</span></label>
                    <input id="Barangay-Name_${rowCounter}" type="text" name="barangay_name_${rowCounter}" class="form-control">
                </div>
                <!-- Coordinates -->
                <div class="col">
                    <label for="coordInput_${rowCounter}" class="form-label small-font">Coordinates<span style="color: red;">*</span></label>
                    <input id="coordInput_${rowCounter}" type="text" name="barangay_coordinates_${rowCounter}" class="form-control">
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

    document.getElementById('form-panel').addEventListener('submit', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        if (validateForm()) {
            // console.log('Submit add');
            checkBarangayExists();
        }
    });

    // Function to validate input
    function validateForm() {
        var errors = [];
        var municipalityNameInputs = document.querySelectorAll('input[name^="municipality_name_"]');
        var barangayNameInputs = document.querySelectorAll('input[name^="barangay_name_"]');
        var coordinatesInputs = document.querySelectorAll('input[name^="barangay_coordinates_"]');

        municipalityNameInputs.forEach(function(input) {
            var municipalityName = input.value.trim();
            if (municipalityName === "") {
                errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        // If there's already an error, don't check further
        if (errors.length === 0) {
            barangayNameInputs.forEach(function(input) {
                var barangayName = input.value.trim();
                if (barangayName === "") {
                    errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            // If there's already an error, don't check further
            if (errors.length === 0) {
                coordinatesInputs.forEach(function(input) {
                    var coordinateName = input.value.trim();
                    if (coordinateName === "") {
                        errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
            }
        }

        if (errors.length > 0) {
            document.getElementById("error-messages").innerHTML = errors.join("<br>");
            return false;
        } else {
            document.getElementById("error-messages").innerHTML = "";
            return true;
        }
    }

    // Function to check if barangay name already exists
    function checkBarangayExists(event) {
        var inputs = document.querySelectorAll('[id^="barangay-Name_"]');
        var barangayNames = Array.from(inputs).map(input => input.value.trim());
        var hasError = false; // Flag to track if any error occurs

        // Send a GET request to check if the barangay names already exist
        barangayNames.forEach(function(barangayName, index) {
            $.ajax({
                url: "code/code-brgy.php",
                method: "GET",
                data: {
                    'check_barangay': barangayName
                },
                success: function(data) {
                    if (data.exists) {
                        // Municipality name already exists, show error message
                        document.getElementById("error-messages").innerHTML += "<div class='error text-center' style='color:red;'>Municipality name, " + barangayName + " already exists for Row " + (index + 1) + "</div>";
                        hasError = true; // Set flag to true if error occurs
                    } else {
                        // Municipality name doesn't exist
                        if (!hasError && index === barangayNames.length - 1) {
                            // If no error encountered so far and it's the last iteration, submit the form
                            submitForm();
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Municipality name check error:", textStatus, errorThrown);
                    hasError = true; // Set flag to true if error occurs
                }
            });
        });
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
                    location.reload();
                    // Reload unseen notifications
                    //load_unseen_notification();
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
    // Select all elements with IDs starting with 'coordInput_'
    document.querySelectorAll('[id^="coordInput_"]').forEach(function(input) {
        input.addEventListener('input', function(event) {
            const regex = /^[0-9.,\s-]*$/; // Updated regex to allow "-" sign
            if (!regex.test(event.target.value)) {
                event.target.value = event.target.value.replace(/[^0-9.,\s-]/g, '');
            }
        });
    });
</script>