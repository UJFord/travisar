<!-- EDIT MODAL -->
<div class="modal fade" id="edit-item-modal" tabindex="-1" aria-labelledby="edit-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="edit-item-modal-label">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel" name="Form" action="http://localhost/travisar/contributor/crop-page/modals/try.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <div class="modal-body edit-modal-body">

                </div>
            </form>

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
            const modalBody = document.querySelector('.edit-modal-body.modal-body');
            modalBody.textContent = `
                                Name: ${name}
                                Type: ${type}
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