<!-- STYLE -->
<style>
    .modal-tab:hover {
        color: grey;
    }

    .modal-header {
        position: relative;
    }

    /* #close-modal-btn {
        position: fixed;
        right: 23%;
    } */
</style>

<!-- HTML -->
<div class="modal fade" id="import-item-modal" tabindex="-1" aria-labelledby="add-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h5 class="modal-title" id="add-label">Import Crops</h5>
                <div>
                    <button type="button" class="btn-close navbar" aria-label="Close" id="navbar-example2" class="navbar navbar-light bg-light px-3" data-bs-dismiss="modal"></button>
                </div>
            </div>

            <div id="message-error">
            </div>

            <!-- body -->
            <div class="modal-body">
                <!-- TAB LIST NAVIGATION -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active small-font modal-tab text-dark" id="corn-tab" data-bs-toggle="tab" data-bs-target="#corn-tab-pane" type="button" role="tab" aria-controls="corn-tab-pane" aria-selected="false"><i class="fa-solid fa-lightbulb me-1"></i>Corn</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link small-font modal-tab text-dark" id="rice-tab" data-bs-toggle="tab" data-bs-target="#rice-tab-pane" type="button" role="tab" aria-controls="rice-tab-pane" aria-selected="true"><i class="fa-solid fa-leaf me-1"></i>Rice</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link small-font modal-tab text-dark" id="rootCrop-tab" data-bs-toggle="tab" data-bs-target="#rootCrop-tab-pane" type="button" role="tab" aria-controls="rootCrop-tab-pane" aria-selected="true"><i class="fa-solid fa-utensils me-1"></i>Root Crop</button>
                    </li>
                </ul>
                <div class="container">
                    <div class="tab-content mt-2">
                        <input type="hidden" name="user_id" value="<?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) {
                                                                        echo $_SESSION['USER']['user_id'];
                                                                    } ?>">
                        <!-- corn TAB -->
                        <div class="fade show active tab-pane" id="corn-tab-pane" role="tabpanel" aria-labelledby="corn-tab" tabindex="0">
                            <form action="crud-code/import-corn.php" method="post" enctype="multipart/form-data">
                                <h6 class="fw-semibold mt-4 mb-3">Import Corn data</h6>
                                <label class="upload-button">
                                    <?php
                                    if (isset($_SESSION['USER']['user_id'])) {
                                        $user_id = $_SESSION['USER']['user_id'];
                                    }
                                    ?>
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                    Choose CSV file
                                    <input type="file" name="file" accept=".csv">
                                </label>
                                <input type="submit" value="Upload CSV" class="upload-button">
                            </form>
                        </div>

                        <!-- rice TAB -->
                        <div class="fade tab-pane" id="rice-tab-pane" role="tabpanel" aria-labelledby="rice-tab" tabindex="0">
                            <form action="crud-code/import-rice.php" method="post" enctype="multipart/form-data">
                                <h6 class="fw-semibold mt-4 mb-3">Import Rice Data</h6>
                                <label class="upload-button">
                                    <?php
                                    if (isset($_SESSION['USER']['user_id'])) {
                                        $user_id = $_SESSION['USER']['user_id'];
                                    }
                                    ?>
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                    Choose CSV file
                                    <input type="file" name="file" accept=".csv">
                                </label>
                                <input type="submit" value="Upload CSV" class="upload-button">
                            </form>
                        </div>

                        <!-- rootCrop TAB -->
                        <div class="fade tab-pane" id="rootCrop-tab-pane" role="tabpanel" aria-labelledby="rootCrop-tab" tabindex="0">
                            <form action="crud-code/import-rootCrop.php" method="post" enctype="multipart/form-data">
                                <h6 class="fw-semibold mt-4 mb-3">Import Root Crop Data</h6>
                                <label class="upload-button">
                                    <?php
                                    if (isset($_SESSION['USER']['user_id'])) {
                                        $user_id = $_SESSION['USER']['user_id'];
                                    }
                                    ?>
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                    Choose CSV file
                                    <input type="file" name="file" accept=".csv">
                                </label>
                                <input type="submit" value="Upload CSV" class="upload-button">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer -->
            <div class="modal-footer d-flex justify-content-end">
                <div class="">
                    <button type="button" class="btn border bg-light" data-bs-dismiss="modal">Cancel</button>
                    <!-- <button type="submit" id="saveButton" name="save" class="btn btn-success">Save</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<!-- <script>
    // keep the modal on
    window.onload = function() {
        const dataModal = new bootstrap.Modal(document.getElementById('import-item-modal'), {
            keyboard: false
        });
        dataModal.show();
    };
</script> -->