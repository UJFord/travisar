<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="add-item-modal-label">Add Terrain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="error-messages">

            </div>
            <!-- body -->
            <form id="form-panel-add" name="Form" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="Add-User">
                            <!-- terrain name and Last Name -->
                            <div class="row mb-3">
                                <!-- terrain name -->
                                <div class="col">
                                    <label for="terrain-Name" class="form-label small-font">
                                        <Caption></Caption>Terrain Name<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" id="terrain-Name" name="terrain_name" class="form-control">
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
    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form element
        var form = document.getElementById('form-panel-add');
        // Add an event listener for the form submission
        form.addEventListener("submit", function(event) {
            // Validate the form
            if (validateForm()) {
                // If validation succeeds, check if terrain name already exists
                checkTerrainExists();
            }
            // Prevent the default form submission behavior
            event.preventDefault();
        });
    });

    // Function to validate input
    function validateForm() {
        var terrainName = document.forms["Form"]["terrain_name"].value;

        var errors = [];

        // Check if the required fields are not empty
        if (terrainName === "" || terrainName === null) {
            errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
            document.getElementById('terrain-Name').classList.add('is-invalid'); // Add 'is-invalid' class to terrain name field
        } else {
            document.getElementById('terrain-Name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Display first error only
        if (errors.length > 0) {
            var errorString = errors[0]; // Get the first error
            document.getElementById("error-messages").innerHTML = errorString;
            return false;
        }

        // If no errors, clear error messages
        document.getElementById("error-messages").innerHTML = "";
        return true;
    }

    // Function to check if terrain name already exists
    function checkTerrainExists() {
        var terrainName = document.forms["Form"]["terrain_name"].value;

        // Send a GET request to check if the terrain name already exists
        $.ajax({
            url: "modals/fetch/fetch_terrain-tab.php",
            method: "GET",
            data: {
                'check_terrain': terrainName
            },
            success: function(data) {
                if (data.exists) {
                    // Terrain name already exists, show error message
                    document.getElementById("error-messages").innerHTML = "<div class='error text-center' style='color:red;'>Terrain name already exists.</div>";
                } else {
                    // Terrain name doesn't exist, submit the form
                    submitForm();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Terrain name check error:", textStatus, errorThrown);
                // Handle error if needed
            }
        });
    }

    // Function to submit the form and refresh notifications
    function submitForm() {
        var form = document.getElementById('form-panel-add');
        if (form) {
            // Set the value of the hidden input field
            var saveInput = document.createElement('input');
            saveInput.type = 'hidden';
            saveInput.name = 'action';
            saveInput.value = 'save';
            form.appendChild(saveInput);

            // Create a new FormData object
            var formData = new FormData(form);

            // Send a POST request using AJAX
            $.ajax({
                url: "modals/crud-code/terrain-code.php",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    //console.log(data);
                    // Reset the form
                    form.reset();
                    // Reload the page or do other actions if needed
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Form submission error:", textStatus, errorThrown);
                    // Handle error if needed
                }
            });
        }
    }
</script>