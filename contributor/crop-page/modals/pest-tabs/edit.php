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
                <button type="button" id="close-modal-btn-edit" class="btn-close" aria-label="Close"></button>
            </div>

            <div id="error-messages-Edit">

            </div>
            <!-- body -->
            <form id="form-panel-Edit" name="Form" action="modals/crud-code/pest-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="Edit-User">
                            <!-- user id hidden -->
                            <input type="hidden" name="pest_idEdit" id="pest_idEdit">
                            <!-- pest name-->
                            <div class="row mb-3">
                                <!-- pest name -->
                                <div class="col">
                                    <label for="pest-NameEdit" class="form-label small-font">Pest Name:<span style="color: red;">*</span></label>
                                    <input type="text" id="pest-NameEdit" name="pest_nameEdit" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- confirm -->
                <?php require "modals/pest-tabs/confirm.php"; ?>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" id="deleteButton" class="btn btn-danger" data-id="delete">Delete</i></button>
                    <div class="">
                        <button type="button" id="cancel-modal-btn-edit" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
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
    const tableRowsEdit = document.querySelectorAll('.edit_data');
    tableRowsEdit.forEach(row => {

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Use the crop_id as needed
            // console.log("Crop ID: " + id);

            // Assuming you have jQuery available
            $.ajax({
                url: 'modals/fetch/fetch_pest-tab.php',
                type: 'POST',
                data: {
                    'click_edit_btn': true,
                    'pest_resistance_id': id,
                },
                success: function(response) {
                    // Handle the response from the PHP script
                    // console.log('Response:', response);

                    // Clear the current preview
                    $('#preview').empty();

                    $.each(response, function(key, value) {
                        // Append options to select element
                        // console.log(value['category_variety_name']);

                        // crop_id
                        $('#pest_idEdit').val(id);
                        // statusIDdraft
                        $('#pest-NameEdit').val(value['pest_name']);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        });
    });

    // Function to validate input 
    function validateFormEdit() {
        var pest_name = document.getElementById('pest-NameEdit').value;

        var errors = [];

        // Check if the required fields are not empty
        if (pest_name === "" || pest_name === null) {
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
                url: "modals/crud-code/pest-code.php",
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

<!-- SCRIPT for closing the modal -->
<script>
    // Function to set up event listeners for the modal
    function setupModalEventListenersEdit() {
        // Remove event listeners to prevent duplication
        document.getElementById('close-modal-btn-edit').removeEventListener('click', closeModalEdit);
        document.getElementById('cancel-modal-btn-edit').removeEventListener('click', closeModalEdit);
        document.getElementById('deleteButton').removeEventListener('click', deleteModalEdit);

        // Event listener for the close button
        document.getElementById('close-modal-btn-edit').addEventListener('click', closeModalEdit);

        // Event listener for the cancel button
        document.getElementById('cancel-modal-btn-edit').addEventListener('click', closeModalEdit);
        document.getElementById('deleteButton').addEventListener('click', deleteModalEdit);
    }

    // Global variable to store the modal instance
    var confirmModalInstanceEdit;

    // Custom function to close the modal
    function closeModalEdit() {
        var editModal = document.getElementById('edit-item-modal');
        var editModalInstance = bootstrap.Modal.getInstance(editModal);
        editModalInstance.hide();

        // Remove the modal backdrop
        $('.modal-backdrop').remove();
    }

    function deleteModalEdit(event) {
        // Prevent the default behavior of the button (e.g., form submission)
        event.preventDefault();

        // Get the id of the button clicked
        var buttonId = event.target.getAttribute('data-id');

        // Get the modal element
        var confirmModal = document.getElementById('confirmModalEdit');

        // Create a new Bootstrap modal instance if it doesn't exist
        if (!confirmModalInstanceEdit) {
            confirmModalInstanceEdit = new bootstrap.Modal(confirmModal);
        }

        // Show the confirmation modal
        confirmModalInstanceEdit.show();
    }
    // Event listener for when the modal is shown
    document.getElementById('edit-item-modal').addEventListener('shown.bs.modal', function() {
        setupModalEventListenersEdit();
    });

    // Event listener for when the confirmation modal is hidden
    document.getElementById('confirmModalEdit').addEventListener('hidden.bs.modal', function() {
        // Reset the confirmModalInstanceEdit
        confirmModalInstanceEdit = null;
    });
    document.getElementById('confirmDeleteBtnEdit').addEventListener('click', function() {
        // Send a request to delete the category
        $.ajax({
            url: 'modals/crud-code/pest-code.php',
            type: 'POST',
            data: {
                'delete': 'delete',
                'pest_resistance_id': document.getElementById('pest_idEdit').value
            },
            success: function(response) {
                // Handle the response from the server
                console.log('Pest deleted:', response);

                // Close the confirmation modal
                //confirmModalInstanceEdit.hide();

                // Optionally, you can reload the page or update the UI
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error deleting category:', error);
            }
        });
    });
</script>