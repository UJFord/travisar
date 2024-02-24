<!-- EDIT MODAL -->
<script>
    // EDIT SCRIPT
    const tableRows = document.querySelectorAll('.table tbody tr');

    tableRows.forEach(row => {
        // Prevent default click behavior on checkbox and ellipsis
        row.querySelector('.form-check-input').addEventListener('click', (event) => {
            event.stopPropagation();
        });

        row.querySelector('.fa-solid.fa-ellipsis-vertical.btn').addEventListener('click', (event) => {
            event.stopPropagation();
        });

        row.addEventListener('click', () => {
            const cropID = row.getAttribute('data-id');

            // Populate the modal content
            const modalBody = document.querySelector('.edit-modal-body.modal-body');
            modalBody.innerHTML = `
                                <input type="hidden" name="crop_id" value"${cropID}">
                            `;
            // Show the modal
            const dataModal = new bootstrap.Modal(document.getElementById('edit-item-modal'), {
                keyboard: false
            });
            dataModal.show();
        });
    });

    // keep the modal on
    // window.onload = function() {
    //     const dataModal = new bootstrap.Modal(document.getElementById('edit-item-modal'), {
    //         keyboard: false
    //     });
    //     dataModal.show();
    // };
</script>

<div class="modal fade" id="edit-item-modal" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <div class="modal-body edit-modal-body">
                <?php
                // Check if the crop_id is set and not empty
                if (isset($_POST['crop_id']) && !empty($_POST['crop_id'])) {
                    $cropID = $_POST['crop_id'];
                    // Use the $cropID variable in your SQL query
                    $query = "SELECT * FROM crop WHERE crop_id = $1";
                    $query_run = pg_query_params($conn, $query, array($cropID));

                    // Display the crop details
                    if ($query_run) {
                        $crop = pg_fetch_assoc($query_run);
                        // Display crop details here
                        echo "Crop ID: " . $crop['crop_id'] . "<br>";
                        echo "Crop Name: " . $crop['crop_name'] . "<br>";
                        // Add other crop details as needed
                    } else {
                        echo "Error fetching crop details.";
                    }
                }
                ?>
            </div>

            <!-- footer -->
            <div class="modal-footer d-flex justify-content-between">
                <div class="">
                    <button type="button" class="btn btn-success">Save</button>
                    <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                </div>
                <button type="button" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
            </div>
        </div>
    </div>
</div>