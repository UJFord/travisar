<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="edit-item-modal" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel-edit" name="Form" autocomplete="off" method="POST" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="locationData">
                            <!-- Province AND Municipality -->
                            <div class="row mb-3 location-row">
                                <input type="hidden" name="municipality_id" id="municipality_id-Edit">
                                <!-- province name -->
                                <div class="col">
                                    <label for="prov-Name" class="form-label small-font">Province Name<span style="color: red;">*</span></label>
                                    <select name="province_id" id="prov-Name" class="form-select">
                                        <?php
                                        // get the data of category from DB
                                        $queryCategory = "SELECT * FROM province ORDER BY province_name ASC";
                                        $query_run = pg_query($conn, $queryCategory);
                                        $count = pg_num_rows($query_run);

                                        // if count is greater than 0 there is data
                                        if ($count > 0) {
                                            // loop for displaying all categories
                                            while ($row = pg_fetch_assoc($query_run)) {
                                                $province_id = $row['province_id'];
                                                $province_name = $row['province_name'];
                                        ?>
                                                <option value="<?= $province_id; ?>"><?= $province_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div id="error-messages-prov"></div>
                                </div>

                                <!-- municipality name -->
                                <div class="col">
                                    <label for="municipality-NameEdit" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                                    <input type="text" id="municipality-NameEdit" name="municipality_name" class="form-control">
                                    <div id="error-messages-muni"></div>
                                </div>
                                <!-- coordinates -->
                                <div class="col">
                                    <label for="CoordinatesEdit" class="form-label small-font">Coordinates<span style="color: red;">*</span></label>
                                    <input type="text" id="CoordinatesEdit" name="municipality_coordinates" class="form-control">
                                    <div id="error-messages-coord"></div>
                                </div>
                                <div id="coords-help" class="form-text mb-2" style="font-size: 0.6rem;">Separate latitude and longitude with a comma (<span class="fw-bold">latitude , longitude - 5.7600, 125.3466</span>)</div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
                        <input type="hidden" name="update">
                        <input type="hidden" name="location_id" id="location_id-Edit">
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="editButton" name="update" class="btn btn-success">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- for submission -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the "province Name" input field
        var provinceInputEdit = document.getElementById("prov-Name");
        var municipalityInputEdit = document.getElementById("municipality-NameEdit");
        var coordInputEdit = document.getElementById("CoordinatesEdit");

        // Add a blur event listener to the "province Name" input field
        provinceInputEdit.addEventListener("blur", function() {
            // Get the value of the "province Name" input field
            var provinceEdit = provinceInputEdit.value.trim();

            // Check if the "province Name" input field is empty
            if (provinceEdit === "") {
                // If empty, add the 'is-invalid' class to indicate an error
                document.getElementById("error-messages-prov").innerHTML = "<div class='error text-center' style='color:red;'>Please fill up required fields.</div>";
                provinceInputEdit.classList.add("is-invalid");
            } else {
                // If not empty, remove the 'is-invalid' class
                provinceInputEdit.classList.remove("is-invalid");
                document.getElementById("error-messages-prov").innerHTML = "";
            }
        });

        // Add a blur event listener to the "municipality Name" input field
        municipalityInputEdit.addEventListener("blur", function() {
            // Get the value of the "municipality Name" input field
            var municipalityEdit = municipalityInputEdit.value.trim();

            // Check if the "municipality Name" input field is empty
            if (municipalityEdit === "") {
                // If empty, add the 'is-invalid' class to indicate an error
                document.getElementById("error-messages-muni").innerHTML = "<div class='error text-center' style='color:red;'>Please fill up required fields.</div>";
                municipalityInputEdit.classList.add("is-invalid");
            } else {
                // If not empty, remove the 'is-invalid' class
                municipalityInputEdit.classList.remove("is-invalid");
                document.getElementById("error-messages-muni").innerHTML = "";
            }
        });

        // Add a blur event listener to the "coordinates Name" input field
        coordInputEdit.addEventListener("blur", function() {
            // Get the value of the "coordinates Name" input field
            var coordinatesEdit = coordInputEdit.value.trim();

            // Check if the "coordinates Name" input field is empty
            if (coordinatesEdit === "") {
                // If empty, add the 'is-invalid' class to indicate an error
                document.getElementById("error-messages-coord").innerHTML = "<div class='error text-center' style='color:red;'>Please fill up required fields.</div>";
                coordInputEdit.classList.add("is-invalid");
            } else {
                // If not empty, remove the 'is-invalid' class
                coordInputEdit.classList.remove("is-invalid");
                document.getElementById("error-messages-coord").innerHTML = "";
            }
        });
    });

    document.getElementById('editButton').addEventListener('click', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        if (validateFormEdit()) {
            // console.log('Submit add');
            submitFormEdit();
        }
    });

    function validateFormEdit() {
        // Get the values from the form
        var province_name = document.getElementById("prov-Name").value;
        var municipality_name = document.getElementById("municipality-NameEdit").value;

        // Check if the required fields are not empty
        if (province_name === "" || municipality_name === "") {
            alert("Please fill out all required fields.");
            return false; // Prevent form submission
        }
        // You can add more validation checks if needed
        return true; // Allow form submission
    }

    // Function to submit the form and refresh notifications
    function submitFormEdit() {
        console.log('submitForm function called');
        // Get the form reference
        var form = document.getElementById('form-panel-edit');
        // Trigger the form submission
        if (form) {
            // Perform AJAX submission or other necessary actions
            $.ajax({
                url: "code/code-muni.php",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
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

    function switchTab(tabName, event) {
        // prevent submitting the form
        event.preventDefault();

        // Click the tab with id 'gen-tab'
        document.getElementById(tabName + '-tab').click();
    }
</script>

<!-- script for limiting the input in coordinates just to numbers, commas, periods, and spaces -->
<script>
    document.getElementById('CoordinatesEdit').addEventListener('input', function(event) {
        const regex = /^[0-9.,\s-]*$/; // Updated regex to allow "-" sign
        if (!regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(/[^0-9.,\s-]/g, '');
        }
    });
</script>