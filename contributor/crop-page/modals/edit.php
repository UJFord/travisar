<!-- EDIT MODAL -->
<div class="modal fade" id="edit-item-modal" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <div class="modal-body">

            </div>

            <!-- footer -->
            <div class="modal-footer d-flex justify-content-between">
                <div class="">
                    <button type="button" class="btn btn-primary">Save</button>
                    <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                </div>
                <button type="button" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
            </div>
        </div>
    </div>
</div>

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
            const name = row.getAttribute('data-name');
            const type = row.getAttribute('data-type');
            const contributor = row.getAttribute('data-contributor');

            // Populate the modal content
            const modalBody = document.querySelector('.modal-body');
            modalBody.textContent = `
                                Name: ${name}<br>
                                Type: ${type}<br>
                                Contributor: ${contributor}
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