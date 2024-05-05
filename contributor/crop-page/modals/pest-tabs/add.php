<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Add Pests</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="error-messages"></div>
            <!-- body -->
            <form id="form-panel" name="Form" action="modals/crud-code/pest-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div>
                        <button type="button" id="add-row" class="btn btn-secondary" style="margin-left: 10px; background-color: var(--mainBrand);">Add</button>
                    </div>
                    <div class="container">
                        <div id="locationData">
                            <!-- Province -->
                            <div class="row mb-3 pest-row">
                                <!-- province name -->
                                <div class="col-5">
                                    <label for="pest-Name_1" class="form-label small-font">Pest Name<span style="color: red;">*</span></label>
                                    <input type="text" name="pest_name_1" id="pest-Name_1" class="form-control">
                                </div>
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
    // (province_name_1, province_name_2 and so on)
    // for when the form is submitted hiwalay ang pag save
    document.addEventListener('DOMContentLoaded', function() {
        const addRowButton = document.getElementById('add-row');
        const locationData = document.getElementById('locationData');
        let rowCounter = 1;

        addRowButton.addEventListener('click', function() {
            rowCounter++;
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-3', 'pest-row');
            newRow.innerHTML = `
                <div class="col-5">
                    <label for="pest-Name_${rowCounter}" class="form-label small-font">Pest Name<span style="color: red;">*</span></label>
                    <input id="pest-Name_${rowCounter}" type="text" name="pest_name_${rowCounter}" class="form-control">

                </div>
                <div class="col-2" style="padding-top: 25px;">
                    <button type="button" class="btn btn-secondary remove-row" style="background-color: #dc3545;">Remove</button>
                </div>
            `;
            locationData.appendChild(newRow);
        });

        locationData.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.pest-row').remove();
            }
        });

        window.addEventListener('beforeunload', function(e) {
            // Reset the form data here
            locationData.innerHTML = '';
            rowCounter = 1; // Reset the row counter
        });
    });

    document.getElementById('form-panel').addEventListener('submit', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        if (validateForm()) {
            // console.log('Submit add');
            checkPestExists();
        }
    });

    // Function to validate input
    function validateForm() {
        var errors = [];
        var pestNameInputs = document.querySelectorAll('input[name^="pest_name_"]');

        pestNameInputs.forEach(function(input) {
            var pestName = input.value.trim();
            if (pestName === "") {
                errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (errors.length > 0) {
            document.getElementById("error-messages").innerHTML = errors.join("<br>");
            return false;
        } else {
            document.getElementById("error-messages").innerHTML = "";
            return true;
        }
    }

    // Function to check if pest name already exists
    function checkPestExists() {
        var inputs = document.querySelectorAll('[id^="pest-Name_"]');
        var pestNames = Array.from(inputs).map(input => input.value.trim());
        var hasError = false; // Flag to track if any error occurs

        // Send a GET request to check if the pest names already exist
        pestNames.forEach(function(pestName, index) {
            $.ajax({
                url: "modals/fetch/fetch_pest-tab.php",
                method: "GET",
                data: {
                    'check_pest': pestName
                },
                success: function(data) {
                    if (data.exists) {
                        // Disease name already exists, show error message
                        document.getElementById("error-messages").innerHTML += "<div class='error text-center' style='color:red;'>Pest name " + pestName + " already exists for Row " + (index + 1) + "</div>";
                        hasError = true; // Set flag to true if error occurs
                        event.preventDefault();
                    } else {
                        // Disease name doesn't exist
                        if (!hasError && index === pestNames.length - 1) {
                            // If no error encountered so far and it's the last iteration, submit the form
                            submitForm();
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Pest name check error:", textStatus, errorThrown);
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
                url: "modals/crud-code/pest-code.php",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    //console.log(data);
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