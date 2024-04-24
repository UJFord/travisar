<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="add-item-modal-label">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="error-messages">

            </div>
            <!-- body -->
            <form id="form-panel-add" name="Form" action="modals/crud-code/category-variety-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="Add-User">
                            <!-- category name and Last Name -->
                            <div class="row mb-3">
                                <!-- category name -->
                                <div class="col">
                                    <label for="category-Name" class="form-label small-font">
                                        <Caption></Caption>Category<span style="color: red;">*</span>
                                    </label>
                                    <select name="category_id" id="category-Name" class="form-select">
                                        <option value="" selected disabled hidden>Select One</option>
                                        <?php
                                        // get the data of category from DB
                                        $queryCategory = "SELECT * FROM category ORDER BY category_name ASC";
                                        $query_run = pg_query($conn, $queryCategory);
                                        $count = pg_num_rows($query_run);

                                        // if count is greater than 0 there is data
                                        if ($count > 0) {
                                            // loop for displaying all categories
                                            while ($row = pg_fetch_assoc($query_run)) {
                                                $category_id = $row['category_id'];
                                                $category_name = $row['category_name'];
                                        ?>
                                                <option value="<?= $category_id; ?>"><?= $category_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- category variety name -->
                                <div class="col">
                                    <label for="category-Name" class="form-label small-font">
                                        <Caption></Caption>Variety Name<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" id="category_variety_name" name="category_variety_name" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
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
                // If validation succeeds, submit the form
                submitForm();
            }
        });
    });

    // Function to validate input
    function validateForm() {
        var categoryName = document.forms["Form"]["category_id"].value;
        var categoryVarietyName = document.forms["Form"]["category_variety_name"].value;

        var errors = [];

        // Check if the required fields are not empty
        if (categoryName === "" || categoryVarietyName === "") {
            errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
            document.getElementById('category-Name').classList.add('is-invalid'); // Add 'is-invalid' class to select field
            document.getElementById('category_variety_name').classList.add('is-invalid'); // Add 'is-invalid' class to select field
        } else {
            document.getElementById('category-Name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
            document.getElementById('category_variety_name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Check if the required fields are not empty
        if (categoryName === "" || categoryName === null) {
            errors.push("<div class='error text-center' style='color:red;'>Please select category.</div>");
            document.getElementById('category-Name').classList.add('is-invalid'); // Add 'is-invalid' class to select field
        } else {
            document.getElementById('category-Name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Check if the required fields are not empty
        if (categoryVarietyName === "" || categoryVarietyName === null) {
            errors.push("<div class='error text-center' style='color:red;'>Please input category variety name.</div>");
            document.getElementById('category_variety_name').classList.add('is-invalid'); // Add 'is-invalid' class to select field
        } else {
            document.getElementById('category_variety_name').classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
        }

        // Display first error only
        if (errors.length > 0) {
            var errorString = errors[0]; // Get the first error
            document.getElementById("error-messages").innerHTML = errorString;
            // Prevent the default form submission behavior
            event.preventDefault();
            return false;
        }

        // If no errors, clear error messages
        document.getElementById("error-messages").innerHTML = "";
        return true;
    }

    // Function to submit the form and refresh notifications
    function submitForm() {
        var form = document.getElementById('form-panel-add');
        if (form) {
            // Create a new FormData object
            var formData = new FormData(form);

            // Send a POST request using AJAX
            $.ajax({
                url: "modals/crud-code/category-variety-code.php",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
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