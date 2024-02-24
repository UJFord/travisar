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

        // Send the cropID value to a PHP script using AJAX
        row.addEventListener('click', () => {
            const cropID = row.getAttribute('data-id');
            fetch(`http://localhost/travisar/contributor/crop-page/modals/edit.php?cropID=${cropID}`)
                .then(response => response.text())
                .then(data => {
                    // Populate the modal body with the response from the PHP script
                    const modalBody = document.querySelector('.edit-modal-body.modal-body');
                    modalBody.innerHTML = data;

                    // Show the modal
                    const dataModal = new bootstrap.Modal(document.getElementById('edit-item-modal'), {
                        keyboard: false
                    });
                    dataModal.show();
                });
        });

    });
    // Keep the modal on
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
                // Get the cropID value from the query parameters
                // ! makita sya sa console pero wala sya ga output sa page
                $cropID = $_GET['cropID'];
                ?>
                <input type='text' name='crop_id' value='<?= $cropID ?>'>
                <?php
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