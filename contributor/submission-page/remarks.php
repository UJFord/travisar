<!-- STYLE -->
<style>
    .modal-tab:hover {
        color: grey;
    }
</style>

<!-- EDIT MODAL -->
<div class="modal fade" id="remarks-item-modal" tabindex="-1" aria-labelledby="remarks-item-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="remarks-item-modal-label">Remarks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- body -->
            <form id="form-panel-remarks" name="Form" action="submission-page/code/code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="py-3 px-5">
                <div class="modal-body remarks-modal-body">
                    <!-- Categories, Other Category, and Category Variety -->
                    <div class="row mb-3">
                        <!-- Remarks -->
                        <div class="col">
                            <label class="form-label small-font">Remarks:</label>
                            <h6 name="remarks" id="remarksView"></h6>
                        </div>
                        <!-- Date Approved -->
                        <div class="col" id="remarkDate">
                            <label class="form-label small-font">Date Approved:</label>
                            <h6 name="status_date" id="dateView"></h6>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <!-- <div class="modal-footer d-flex justify-content-between">
                    <div class="">
                        <button type="submit" name="update" class="btn btn-success">Save</button>
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <button type="button" class="btn btn-danger">Delete</i></button>
                </div> -->
            </form>
        </div>
    </div>
</div>
<!-- script for getting the on the remarks -->
<script>
    // remarks SCRIPT
    const tableRowsRemarks = document.querySelectorAll('.remarks_data');
    const statusDate = document.getElementById('.remarkDate');

    tableRowsRemarks.forEach(row => {
        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');

            // Use the crop_id as needed
            // console.log("Crop ID: " + id);

            // Assuming you have jQuery available
            $.ajax({
                url: 'submission-page/fetch/fetch_crop-edit.php',
                type: 'POST',
                data: {
                    'click_remarks_btn': true,
                    'crop_id': id,
                },
                success: function(response) {
                    // Handle the response from the PHP script
                    // console.log('Response:', value['status_date']);

                    // Clear the current preview
                    $('#preview').empty();

                    $.each(response, function(key, value) {
                        // Append options to select element
                        console.log(value['rice_plant_height']);

                        $('#crop_id').val(id);
                        $('#remarksView').text(value['remarks']);
                        // if(value['remarks'] === "approved"){
                        //     statusDate.style.display = "block";
                        //     $('#dateView').text(moment(value['status_date']).format('YYYY-MM-DD HH:mm'));
                        // }
                        $('#dateView').text(moment(value['status_date']).format('YYYY-MM-DD HH:mm'));
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }

            });

            // Show the modal
            const dataModal = new bootstrap.Modal(document.getElementById('remarks-item-modal'), {
                keyboard: false
            });
            dataModal.show();
        });
    });

    $(document).ready(function() {
        // Initialize the modal
        const dataModal = new bootstrap.Modal(document.getElementById('remarks-item-modal'), {
            keyboard: false
        });

        // Reset the form and close the modal when the x button is clicked
        $('.btn-close').on('click', function() {
            // Reset the form
            document.getElementById('form-panel-remarks').reset();

            // Close the modal
            dataModal.hide();
        });

        // Reset the form and close the modal when the modal is hidden
        $('#remarks-item-modal').on('hidden.bs.modal', function() {
            // Reset the form
            document.getElementById('form-panel-remarks').reset();
        });
    });
</script>