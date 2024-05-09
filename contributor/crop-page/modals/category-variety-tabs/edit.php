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

            <!-- body -->
            <form id="form-panel-Edit" name="Form" action="modals/crud-code/category-variety-code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body" id="modal-body">
                    <div class="container">
                        <div id="Edit-User">
                            <!-- user id hidden -->
                            <input type="hidden" name="variety_idEdit" id="variety_idEdit">
                            <!-- category name-->
                            <div class="row mb-3">
                                <!-- category name -->
                                <div class="col">
                                    <label for="category-NameEdit" class="form-label small-font">Category:<span style="color: red;">*</span></label>
                                    <select name="category_idEdit" id="category-NameEdit" class="form-select">
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
                                    <label for="variety-NameEdit" class="form-label small-font">Variety Name:<span style="color: red;">*</span></label>
                                    <input type="text" id="variety-NameEdit" name="variety_nameEdit" class="form-control">
                                    <div id="error-messages-Edit"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- confirm -->
                <?php require "modals/category-variety-tabs/confirm.php"; ?>

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
    const tableRows = document.querySelectorAll('.edit_data');
    tableRows.forEach(row => {

        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Use the crop_id as needed
            // console.log("Crop ID: " + id);

            // Assuming you have jQuery available
            $.ajax({
                url: 'modals/fetch/fetch_variety-tab.php',
                type: 'POST',
                data: {
                    'click_edit_btn': true,
                    'category_variety_id': id,
                },
                success: function(response) {
                    // Handle the response from the PHP script
                    // console.log('Response:', response);

                    $.each(response, function(key, value) {
                        // Append options to select element
                        console.log(value['category_variety_name']);

                        // crop_id
                        $('#variety_idEdit').val(id);
                        $('#variety-NameEdit').val(value['category_variety_name']);
                        $('#category-NameEdit').append($('<option>', {
                            value: value['category_id'],
                            text: value['category_name'],
                            selected: true, // Make the option selected
                            style: 'display: none;' // Hide the option
                        }));

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
        var variety_name = document.getElementById('variety-NameEdit').value;

        var errors = [];

        // Check if the required fields are not empty
        if (category_name === "" || variety_name === "") {
            errors.push("<div class='error text-center' style='color:red;'>Please fill up required fields.</div>");
            document.getElementById('category-NameEdit').classList.add('is-invalid'); // Add 'is-invalid' class to select field
            document.getElementById('variety-NameEdit').classList.add('is-invalid');
        } else {
            document.getElementById('category-NameEdit').classList.remove('is-invalid'); // remove 'is-invalid' class to select field
            document.getElementById('variety-NameEdit').classList.remove('is-invalid');
        }

        // Check if the required fields are not empty
        if (category_name === "" || category_name === null) {
            errors.push("<div class='error text-center' style='color:red;'>Please select category.</div>");
            document.getElementById('category-NameEdit').classList.add('is-invalid'); // Add 'is-invalid' class to select field
        } else {
            document.getElementById('category-NameEdit').classList.remove('is-invalid'); // remove 'is-invalid' class to select field
        }

        // Check if the required fields are not empty
        if (variety_name === "" || variety_name === null) {
            errors.push("<div class='error text-center' style='color:red;'>Please input variety name.</div>");
            document.getElementById('variety-NameEdit').classList.add('is-invalid');

        } else {
            document.getElementById('variety-NameEdit').classList.remove('is-invalid');

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
                url: "modals/crud-code/category-variety-code.php",
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

    document.addEventListener("DOMContentLoaded", function() {
        // Get the "Variety Name" input field
        var varietyNameInput = document.getElementById("variety-NameEdit");

        // Add a blur event listener to the "Variety Name" input field
        varietyNameInput.addEventListener("blur", function() {
            // Get the value of the "Variety Name" input field
            var varietyName = varietyNameInput.value.trim();

            // Check if the "Variety Name" input field is empty
            if (varietyName === "") {
                document.getElementById("error-messages-Edit").innerHTML = "<div class='error text-center' style='color:red;'>Please input variety name.</div>";
                // If empty, add the 'is-invalid' class to indicate an error
                varietyNameInput.classList.add("is-invalid");
            } else {
                // If not empty, remove the 'is-invalid' class
                varietyNameInput.classList.remove("is-invalid");
                document.getElementById("error-messages-Edit").innerHTML = "";
            }
        });
    });
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
            url: 'modals/crud-code/category-variety-code.php',
            type: 'POST',
            data: {
                'delete': 'delete',
                'category_variety_id': document.getElementById('variety_idEdit').value
            },
            success: function(response) {
                // Handle the response from the server
                console.log('Category deleted:', response);

                // Close the confirmation modal
                //confirmModalInstanceEdit.hide();

                // Optionally, you can reload the page or update the UI
                //location.reload();
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error deleting category:', error);
            }
        });
    });
</script>