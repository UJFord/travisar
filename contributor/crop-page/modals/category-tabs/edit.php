<!-- STYLE -->
<style>
</style>

<!-- HTML -->
<div class="modal fade" id="edit-item-modal" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="error-messages-Edit">

            </div>
            <!-- body -->
            <form id="form-panel-Edit" name="Form" action="modals/crud-code/category-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="Edit-User">
                            <!-- user id hidden -->
                            <input type="text" name="category_idEdit" id="category_idEdit">
                            <!-- category name-->
                            <div class="row mb-3">
                                <!-- category name -->
                                <div class="col">
                                    <label for="category-NameEdit" class="form-label small-font">Category Name:<span style="color: red;">*</span></label>
                                    <input type="text" id="category-NameEdit" name="category_nameEdit" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="edit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- for submission -->
<script>
    // EDIT SCRIPT
    const tableRows = document.querySelectorAll('.edit_data');
    tableRows.forEach(row => {

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Use the crop_id as needed
            // console.log("Crop ID: " + id);

            // Assuming you have jQuery available
            $.ajax({
                url: 'modals/fetch/fetch_category-tab.php',
                type: 'POST',
                data: {
                    'click_edit_btn': true,
                    'category_id': id,
                },
                success: function(response) {
                    // Handle the response from the PHP script
                    // console.log('Response:', response);

                    $.each(response, function(key, value) {
                        // Append options to select element
                        // console.log(value['rice_plant_height']);

                        // crop_id
                        $('#category_idEdit').val(id);
                        $('#category-NameEdit').val(value['category_name']);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }

            });

            // Show the modal
            const dataModal = new bootstrap.Modal(document.getElementById('edit-item-modal'), {
                keyboard: false
            });
            dataModal.show();
        });
    });
    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form element
        var form = document.getElementById('form-panel-Edit');
        // Add an event listener for the form submission
        form.addEventListener("submit", function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();
            if (validateFormEdit()) {
                // If validation succeeds, submit the form
                submitFormEdit();
            }
        });
    });

    // Function to validate input 
    function validateFormEdit() {
        var category_name = document.getElementById('category-NameEdit').value;

        var errors = [];

        // Check if the required fields are not empty
        if (category_name === "" || category_name === null) {
            errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
        }

        // Display first error only
        if (errors.length > 0) {
            var errorString = errors[0]; // Get the first error
            document.getElementById("error-messages-Edit").innerHTML = errorString;
            return false;
        }

        // If no errors, clear error messages
        document.getElementById("error-messages-Edit").innerHTML = "";
        return true;
    }

    // Function to submit the form and refresh notifications
    function submitFormEdit() {
        var form = document.getElementById('form-panel-Edit');
        if (form) {
            // Create a new FormData object
            var formData = new FormData(form);

            // Append additional data
            formData.append('edit', 'true');

            // Send a POST request using AJAX
            $.ajax({
                url: "modals/crud-code/category-code.php",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
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