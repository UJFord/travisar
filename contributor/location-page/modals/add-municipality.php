<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Add Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <!-- <div>
                        <button type="button" id="add-row" class="btn btn-secondary" style="margin-left: 10px; background-color: var(--mainBrand);">Add</button>
                    </div> -->
                    <div class="container">
                        <div id="locationData">
                            <!-- Province AND Municipality -->
                            <div class="row mb-3 location-row">
                                <!-- province name -->
                                <div class="col">
                                    <label for="province-Name" class="form-label small-font">Province Name<span style="color: red;">*</span></label>
                                    <select name="province_name_1" id="province-Name" class="form-control">
                                        <?php
                                        $queryProv = "SELECT DISTINCT province_name, province_id from province where province_name = 'Sarangani'";
                                        $query_run = pg_query($conn, $queryProv);

                                        $count = pg_num_rows($query_run);

                                        // if count is greater than 0 there is data
                                        if ($count > 0) {
                                            // loop for displaying all categories
                                            while ($row = pg_fetch_assoc($query_run)) {
                                                $province_name = $row['province_name'];
                                                $province_id = $row['province_id'];
                                        ?>
                                                <option value="<?= $province_id; ?>"><?= $province_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- municipality name -->
                                <div class="col">
                                    <label for="municipality-Name" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
                                    <input type="text" name="municipality_name_1" id="municipality-Name" class="form-control">
                                    <div id="error-messages-name" class="error-message" style="color: red;"></div>
                                </div>
                                <!-- Coordinates -->
                                <div class="col">
                                    <label for="coordInput" class="form-label small-font">Coordinates<span style="color: red;">*</span></label>
                                    <input type="text" id="coordInput" name="coordinates_1" class="form-control">
                                    <div id="error-messages-coord" class="error-message" style="color: red;"></div>
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
    // document.addEventListener('DOMContentLoaded', function() {
    //     const addRowButton = document.getElementById('add-row');
    //     const locationData = document.getElementById('locationData');
    //     let rowCounter = 1;

    //     addRowButton.addEventListener('click', function() {
    //         rowCounter++;
    //         const newRow = document.createElement('div');
    //         newRow.classList.add('row', 'mb-3', 'location-row');
    //         newRow.innerHTML = `
    //             <div class="col">
    //                 <label for="province-Name" class="form-label small-font">Province Name<span style="color: red;">*</span></label>
    //                 <select name="province_name_${rowCounter}" id="province-Name" class="form-select">
    //                     <?php
                            //                     $queryProv = "SELECT DISTINCT province_name, province_id from province order by province_name ASC";
                            //                     $query_run = pg_query($conn, $queryProv);

                            //                     $count = pg_num_rows($query_run);

                            //                     // if count is greater than 0 there is data
                            //                     if ($count > 0) {
                            //                         // loop for displaying all categories
                            //                         while ($row = pg_fetch_assoc($query_run)) {
                            //                             $province_name = $row['province_name'];
                            //                             $province_id = $row['province_id'];

                            //                     
                            ?>
    //                             <option value="<?= $province_id; ?>"><?= $province_name; ?></option>
    //                         <?php
                                //                         }

                                //                         
                                ?>
    //                     <?php
                            //                     }

                            //                     
                            ?>
    //                 </select>
    //             </div>
    //             <div class="col">
    //                 <label for="municipality-Name" class="form-label small-font">Municipality Name<span style="color: red;">*</span></label>
    //                 <input type="text" name="municipality_name_${rowCounter}" class="form-control">
    //             </div>
    //             <!-- Coordinates -->
    //             <div class="col">
    //                 <label for="Coordinates" class="form-label small-font">Coordinates<span style="color: red;">*</span></label>
    //                 <input type="text" name="coordinates_${rowCounter}" class="form-control">
    //             </div>
    //             <div class="col-2" style="padding-top: 25px;">
    //                 <button type="button" class="btn btn-secondary remove-row" style="background-color: #dc3545;">Remove</button>
    //             </div>
    //         `;
    //         locationData.appendChild(newRow);
    //     });


    //     locationData.addEventListener('click', function(e) {
    //         if (e.target.classList.contains('remove-row')) {
    //             e.target.closest('.location-row').remove();
    //         }
    //     });

    //     window.addEventListener('beforeunload', function(e) {
    //         // Reset the form data here
    //         locationData.innerHTML = '';
    //         rowCounter = 1; // Reset the row counter
    //     });
    // });

    document.getElementById('form-panel').addEventListener('submit', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        if (validateForm()) {
            // console.log('Submit add');
            checkMunicipalityExists(event);
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Select all municipality name inputs
        var municipalityNameInputs = document.querySelectorAll('input[name^="municipality_name_"]');

        // Add blur event listener to each municipality name input
        municipalityNameInputs.forEach(function(input) {
            input.addEventListener('blur', function(event) {
                validateMunicipalityName(event.target);
            });
        });

        // Select all coordinates inputs
        var coordinatesInputs = document.querySelectorAll('input[name^="coordinates_"]');

        // Add blur event listener to each coordinates input
        coordinatesInputs.forEach(function(input) {
            input.addEventListener('blur', function(event) {
                validateCoordinates(event.target);
            });
        });
    });

    // Function to validate municipality name input
    function validateMunicipalityName(input) {
        var municipalityName = input.value.trim();
        var errorMessage = input.parentElement.querySelector('.error-message');
        if (municipalityName === "") {
            errorMessage.textContent = "Please fill up municipality name.";
            input.classList.add('is-invalid');
        } else {
            errorMessage.textContent = "";
            input.classList.remove('is-invalid');
        }
    }

    // Function to validate coordinates input
    function validateCoordinates(input) {
        var coordinateName = input.value.trim();
        var errorMessage = input.parentElement.querySelector('.error-message');
        if (coordinateName === "") {
            errorMessage.textContent = "Please fill up coordinates.";
            input.classList.add('is-invalid');
        } else {
            errorMessage.textContent = "";
            input.classList.remove('is-invalid');
        }
    }

    function validateForm() {
        var errors = [];
        var municipalityNameInputs = document.querySelectorAll('input[name^="municipality_name_"]');
        var coordinatesInputs = document.querySelectorAll('input[name^="coordinates_"]');

        municipalityNameInputs.forEach(function(input) {
            var municipalityName = input.value.trim();
            var errorMessage = input.parentElement.querySelector('.error-message');
            if (municipalityName === "") {
                errorMessage.textContent = "Please fill up municipality name.";
                input.classList.add('is-invalid');
                errors.push('municipality');
            } else {
                errorMessage.textContent = "";
                input.classList.remove('is-invalid');
            }
        });

        coordinatesInputs.forEach(function(input) {
            var coordinateName = input.value.trim();
            var errorMessage = input.parentElement.querySelector('.error-message');
            if (coordinateName === "") {
                errorMessage.textContent = "Please fill up coordinates.";
                input.classList.add('is-invalid');
                errors.push('coordinates');
            } else {
                errorMessage.textContent = "";
                input.classList.remove('is-invalid');
            }
        });

        // Return false if any field is empty
        return errors.length === 0;
    }


    // Function to check if municipality name already exists
    function checkMunicipalityExists(event) {
        var inputs = document.querySelectorAll('[id^="municipality-Name"]');
        var municipalityNames = Array.from(inputs).map(input => input.value.trim());
        var hasError = false; // Flag to track if any error occurs

        // Send a GET request to check if the municipality names already exist
        municipalityNames.forEach(function(municipalityName, index) {
            $.ajax({
                url: "code/code-muni.php",
                method: "GET",
                data: {
                    'check_municipality': municipalityName
                },
                success: function(data) {
                    if (data.exists) {
                        // Municipality name already exists, show error message
                        document.getElementById("error-messages").innerHTML += "<div class='error text-center' style='color:red;'>Municipality name, " + municipalityName + " already exists for Row " + (index + 1) + "</div>";
                        hasError = true; // Set flag to true if error occurs
                        event.preventDefault();
                    } else {
                        // Municipality name doesn't exist
                        if (!hasError && index === municipalityNames.length - 1) {
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
                url: "code/code-muni.php",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
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
    document.getElementById('coordInput').addEventListener('input', function(event) {
        const regex = /^[0-9.,\s-]*$/; // Updated regex to allow "-" sign
        if (!regex.test(event.target.value)) {
            event.target.value = event.target.value.replace(/[^0-9.,\s-]/g, '');
        }
    });
</script>