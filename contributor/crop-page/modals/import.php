<!-- STYLE -->
<!-- STYLE -->
<style>
    /* .btn-selected-import {
        background-color: #000;
        color: white;
    } */
</style>

<!-- HTML -->
<div class="modal fade" id="import-item-modal" tabindex="-1" aria-labelledby="add-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog ">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h6 class="modal-title" id="add-label">Import Crops</h6>
                <div>
                    <button type="button" class="btn-close navbar" aria-label="Close" id="navbar-example2" class="navbar navbar-light bg-light px-3" data-bs-dismiss="modal"></button>
                </div>
            </div>

            <div id="message-error">
            </div>

            <form action="modals/crud-code/import.php" method="post" enctype="multipart/form-data">
                <!-- body -->
                <div class="modal-body">

                    <!-- category filter -->
                    <div class="row">
                        <!-- category filter -->
                        <div class="row">
                            <h6 class="mb-3 fw-bold">Select Category</h6>
                            <div class="row mb-3 px-4">
                                <?php
                                $query = "SELECT * FROM category ORDER BY category_name ASC";
                                $query_run = pg_query($conn, $query);

                                if ($query_run) {
                                    while ($row = pg_fetch_array($query_run)) {
                                ?>
                                        <div class="form-check col-4">
                                            <input class="form-check-input radio-input" type="radio" name="category_name" value="<?= htmlspecialchars($row['category_name'], ENT_QUOTES, 'UTF-8') ?>" id="category_id<?= $row['category_id'] ?>">
                                            <label class="form-check-label radio-label" for="category_id<?= $row['category_id'] ?>">
                                                <?= htmlspecialchars($row['category_name'], ENT_QUOTES, 'UTF-8') ?>
                                            </label>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "No category found";
                                }
                                ?>
                            </div>
                            <div id="template-info" class="row ms-1 mb-3" style="display: none;">
                                <p class="small-font col-12 m-0 mb-1 p-0"><span class="crop-chosen">Corn</span> template downloadable below</p>
                                <a id="dl-link" href="" class="col-6 btn btn-primary">
                                    <span class="crop-chosen">Corn</span> template<i class="ms-1 fa-solid fa-download"></i>
                                </a>
                            </div>
                        </div>

                        <!-- file input -->
                        <h6 class="mb-3 fw-bold">Upload Files</h6>
                        <div class="mb-3">
                            <?php
                            if (isset($_SESSION['USER']['user_id'])) {
                                $user_id = $_SESSION['USER']['user_id'];
                            }
                            ?>
                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                            <!-- <label for="formFile" class="form-label">Default file input example</label> -->
                            <input class="form-control" type="file" name="file" id="formFile" accept=".csv">
                        </div>
                    </div>

                </div>

                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <div class="">
                        <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="" name="" value="Upload CSV" class="btn btn-success upload-button">Import<i class="ms-2 fa-solid fa-file-import"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    // keep the modal on
    // window.onload = function() {
    //     const dataModal = new bootstrap.Modal(document.getElementById('import-item-modal'), {
    //         keyboard: false
    //     });
    //     dataModal.show();
    // };

    $(document).ready(function() {
        // Set initial crop-chosen text
        $('.crop-chosen').text('Select a category');

        // Handle radio button change to update crop
        $('.radio-input').change(function(event) {
            // Get category name from the label text
            var categoryName = $(this).closest('.radio-label').text();
            $('.crop-chosen').text(categoryName);
            $('#template-info').show(); // Always show template after update
            // console.log(categoryName)
        });

        // Prevent label click from triggering change
        $('.radio-label').click(function(event) {
            event.preventDefault();
        });

        // Hide #template-info initially
        $('#template-info').hide();

        // Ensure #template-info visibility on page load based on checked radio button
        if ($('.radio-input:checked').length > 0) {
            var selectedCrop = $('.radio-input:checked').val();
            $('.crop-chosen').text(selectedCrop);
            $('#template-info').show();
            changeLink(selectedCrop);
        }

        // Handle the radio button change event
        $('.radio-input').change(function() {
            if ($('.radio-input:checked').length) {
                var selectedCrop = $('.radio-input:checked').val();
                $('.crop-chosen').text(selectedCrop);
                $('#template-info').show();
                changeLink(selectedCrop);
            } else {
                $('#template-info').hide();
            }
        });

        function changeLink(categ) {

            var link = ''
            switch (categ) {
                case 'Corn':
                    link = '../../visitor/help/corn.csv'
                    break;
                case 'Rice':
                    link = '../../visitor/help/rice.csv'
                    break;
                case 'Root Crop':
                    link = '../../visitor/help/rootCrop.csv'
            }

            $('#dl-link').attr('href', link);
            console.log($('#dl-link').attr)
        }
    });
</script>