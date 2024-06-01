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

            <form action="crud-code/import.php" method="post" enctype="multipart/form-data">
                <!-- body -->
                <div class="modal-body">

                    <!-- category filter -->
                    <div class="row">
                        <div class="mb-3">
                            <h4 class="mb-3 fw-bold">Step 1</h4>
                            <h6 class="fw-bold">Download the template</h6>
                            <ul>
                                <li><a href="../../visitor/help/corn.csv">Corn Template</a></li>
                                <li><a href="../../visitor/help/rice.csv">Rice Template</a></li>
                                <li><a href="../../visitor/help/rootCrop.csv">Root Crop Template</a></li>
                            </ul>
                        </div>

                        <h4 class=" mb-3 fw-bold">Step 2</h4>
                        <!-- category filter -->
                        <h6 class=" mb-3 fw-bold">Select Category</h6>
                        <div class="row mb-3 px-3">
                            <?php
                            $query = "SELECT * FROM category order by category_name ASC";
                            $query_run = pg_query($conn, $query);

                            if ($query_run) {
                                while ($row = pg_fetch_array($query_run)) {
                            ?>
                                    <!-- crops filters -->
                                    <div class="form-check col-4">
                                        <input class="form-check-input" type="radio" name="category_id" value="<?= $row['category_id'] ?>" id="category_id<?= $row['category_id'] ?>">
                                        <label class="form-check-label" for="category_id<?= $row['category_id'] ?>">
                                            <?= $row['category_name'] ?>
                                        </label>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "No category found";
                            }
                            ?>
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
        function updateButtonStylesImport() {
            $('.btn-check.btn-import').each(function() {
                var label = $('label[for="' + $(this).attr('id') + '"]');
                if ($(this).is(':checked')) {
                    label.addClass('btn-success');
                } else {
                    label.removeClass('btn-success');
                }
            });
        }

        // Initial check to apply the class to the default checked button
        // updateButtonStylesImport();

        // Change event to update styles
        $('.btn-check btn-import').change(updateButtonStylesImport);
    });
</script>