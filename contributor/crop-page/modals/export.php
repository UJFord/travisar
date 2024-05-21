<!-- STYLE -->
<style>
    .btn-selected {
        /* background-color: #000; */
        /* color: white; */
    }

    .modal-tab:hover {
        color: grey;
    }

    .modal-header {
        position: relative;
    }
</style>

<!-- HTML -->
<div class="modal fade" id="export-item-modal" tabindex="-1" aria-labelledby="add-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h6 class="modal-title" id="add-label">Export Crops</h6>
                <div>
                    <button type="button" class="btn-close navbar" aria-label="Close" id="navbar-example2" class="navbar navbar-light bg-light px-3" data-bs-dismiss="modal"></button>
                </div>
            </div>
            <form id="form-panel-export" name="Form" action="modals/crud-code/download.php" autocomplete="off" method="POST">

                <!-- body -->
                <div class="modal-body">
                    <div class="container">
                        <!-- category filter -->
                        <h6 class=" mb-3 fw-bold">Select Category <span class="text-danger ms-1">*</span></h6>
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
                            <div id="message-error" class="error-message" style="color: red;"></div>
                        </div>

                        <!-- status filter -->
                        <h6 class=" mb-3 fw-bold">Select Status</h6>
                        <div class="row mb-3 px-3">
                            <div class="form-check col">
                                <input class="form-check-input" type="checkbox" name="status_name" value="Approved" id="Approved">
                                <label class="form-check-label" for="Approved">
                                    Approved
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="checkbox" name="status_name" value="Pending" id="Pending">
                                <label class="form-check-label" for="Pending">
                                    Pending
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="checkbox" name="status_name" value="Updating" id="Updating">
                                <label class="form-check-label" for="Updating">
                                    Updating
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="checkbox" name="status_name" value="Rejected" id="Rejected">
                                <label class="form-check-label" for="Rejected">
                                    Rejected
                                </label>
                            </div>
                        </div>

                        <!-- variety -->
                        <!-- <h6 id="variety-div-export" class="mb-3 fw-bold">Select Variety</h6>
                        <div id="variety-filters-export" class="row mb-5 px-3">

                        </div> -->

                        <!-- municipality -->
                        <h6 class="mb-3 fw-bold">Select Municipality</h6>
                        <div class="row mb-5 px-3">
                            <?php
                            $query_municipality = "SELECT * FROM municipality order by municipality_name ASC";
                            $query_run_municipality = pg_query($conn, $query_municipality);

                            if ($query_run_municipality) {
                                while ($row = pg_fetch_array($query_run_municipality)) {
                            ?>
                                    <div class="form-check col-4">
                                        <input class="form-check-input municipality-filter-export" type="checkbox" name="municipality_id" value="<?= $row['municipality_id'] ?>" id="municipality_id-<?= $row['municipality_id'] ?>">
                                        <label class="form-check-label" for="municipality_id-<?= $row['municipality_id'] ?>">
                                            <?= $row['municipality_name'] ?>
                                        </label>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "No municipality found";
                            }
                            ?>
                        </div>

                        <!-- barangay -->
                        <div id="barangay-div-export">
                            <h6 class="mb-3 fw-bold">Select Barangay</h6>
                            <div id="brgy-filters-export" class="row mb-5 px-3">

                            </div>
                        </div>

                        <!-- terrain -->
                        <h6 class="mb-3 fw-bold">Select Terrain</h6>
                        <div class="row mb-5 px-3">
                            <?php
                            $query_terrain = "SELECT * FROM terrain order by terrain_name ASC";
                            $query_run_terrain = pg_query($conn, $query_terrain);

                            if ($query_run_terrain) {
                                while ($row = pg_fetch_array($query_run_terrain)) {
                            ?>
                                    <!-- terrains filters -->
                                    <div class="form-check col-4">
                                        <input class="form-check-input" type="checkbox" name="terrain_id" value="<?= $row['terrain_id'] ?>" id="terrain_id-<?= $row['terrain_id'] ?>">
                                        <label class="form-check-label" for="terrain_id-<?= $row['terrain_id'] ?>">
                                            <?= $row['terrain_name'] ?>
                                        </label>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "No terrain found";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- footer -->
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn border btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="export" class="btn border btn-success">Export <i class="fa-solid fa-file-export"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    // keep the modal on
    // window.onload = function() {
    //     const dataModal = new bootstrap.Modal(document.getElementById('export-item-modal'), {
    //         keyboard: false
    //     });
    //     dataModal.show();
    // };
</script>
<!-- script for checking category radio -->
<script>
    // script for form validation
    document.getElementById('form-panel-export').addEventListener('submit', function(event) {
        const categoryInputs = document.querySelectorAll('input[name="category_id"]');
        let categorySelected = false;

        categoryInputs.forEach(input => {
            if (input.checked) {
                categorySelected = true;
            }
        });

        if (!categorySelected) {
            event.preventDefault(); // Prevent form submission
            const errorMessageElement = document.getElementById('message-error');
            errorMessageElement.textContent = 'Please select a category before exporting.';
            errorMessageElement.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
</script>

<!-- script for toggle of barangay -->
<script>
    let selectedMunicipalities_export = [];

    // Function to fetch and populate the barangay filter based on the selected municipalities
    function populateBarangayFilter_export() {
        let barangayFilter_export = document.getElementById('brgy-filters-export');

        // Clear existing options
        barangayFilter_export.innerHTML = '';

        // Fetch and populate barangay options for each selected municipality
        selectedMunicipalities_export.forEach(municipalityid => {
            fetch('modals/fetch/fetch_filter-brgy.php?municipality_id=' + municipalityid)
                .then(response => response.json())
                .then(data => {
                    // Populate options
                    data.forEach(barangay => {
                        barangayFilter_export.innerHTML += `
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" name="barangay_id" value="${barangay.barangay_id}" id="barangay${barangay.barangay_id}">
                            <label class="form-check-label" for="barangay${barangay.barangay_id}">
                                ${barangay.barangay_name}
                            </label>
                        </div>
                    `;
                    });
                    // Show the barangay filter
                    barangayFilter_export.classList.add('show');
                    // barangayChev.classList.add('rotate-chevron');
                })
                .catch(error => console.error('Error:', error));
        });
    }
    // Function to show or hide the barangay filter based on the selected municipalities
    function toggleBarangayFilterVisibility_export() {
        let barangayFilter_export = document.getElementById('barangay-div-export');
        let selectedMunicipalityCheckboxes_export = document.querySelectorAll('.municipality-filter-export:checked');

        if (selectedMunicipalityCheckboxes_export.length > 0) {
            // Show the barangay filter
            barangayFilter_export.classList.remove('hidden');
        } else {
            // Hide the barangay filter
            barangayFilter_export.classList.add('hidden');
        }
    }

    // Add event listeners to municipality checkboxes
    document.querySelectorAll('.municipality-filter-export').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                // Remove unchecked municipality from the array
                selectedMunicipalities_export = selectedMunicipalities_export.filter(id => id !== this.value);
            } else {
                // Add checked municipality to the array
                selectedMunicipalities_export.push(this.value);
            }
            populateBarangayFilter_export();
            toggleBarangayFilterVisibility_export();
        });
    });

    // let selectedCategories_export = [];

    // // Function to fetch and populate the variety filter based on the selected categories
    // function populateVarietyFilter_export() {
    //     let varietyFilter_export = document.getElementById('variety-filters-export');

    //     // Clear existing options
    //     varietyFilter_export.innerHTML = '';

    //     // Fetch and populate variety options for each selected category
    //     selectedCategories_export.forEach(categoryId => {
    //         fetch('modals/fetch/fetch_filter.php?category_id=' + categoryId)
    //             .then(response => response.json())
    //             .then(data => {
    //                 // Populate options
    //                 data.forEach(variety => {
    //                     varietyFilter_export.innerHTML += `
    //                         <div class="form-check col-4">
    //                         <input class="form-check-input" type="checkbox" value="${variety.category_variety_id}" id="variety${variety.category_variety_id}">
    //                         <label class="form-check-label" for="variety${variety.category_variety_id}">
    //                             ${variety.category_variety_name}
    //                         </label>
    //                     </div>
    //                     `;
    //                 });
    //                 // Show the variety filter
    //                 varietyFilter_export.classList.add('show');
    //             })
    //             .catch(error => console.error('Error:', error));
    //     });
    // }
    // // Function to show or hide the variety filter based on the selected categories
    // function toggleVarietyFilterVisibility_export() {
    //     let varietyFilter_export = document.getElementById('variety-div-export');
    //     let selectedCategoryCheckboxes_export = document.querySelectorAll('.crop-filter-export:checked');

    //     if (selectedCategoryCheckboxes_export.length > 0) {
    //         // Show the variety filter
    //         varietyFilter_export.classList.remove('hidden');
    //     } else {
    //         // Hide the variety filter
    //         varietyFilter_export.classList.add('hidden');
    //     }
    // }

    // Add event listeners to category checkboxes
    // document.querySelectorAll('.crop-filter-export').forEach(checkbox => {
    //     checkbox.addEventListener('change', function() {
    //         if (!this.checked) {
    //             // Remove unchecked category from the array
    //             selectedCategories_export = selectedCategories_export.filter(id => id !== this.value);
    //         } else {
    //             // Add checked category to the array
    //             selectedCategories_export.push(this.value);
    //         }
    //         populateVarietyFilter_export();
    //         toggleVarietyFilterVisibility_export();
    //     });
    // });

    //document.getElementById('variety-div-export').classList.add('hidden');
    document.getElementById('barangay-div-export').classList.add('hidden');

    // Check if all category checkboxes are unchecked
    // function checkAllCategoryCheckboxesUncheckedExport() {
    //     let selectedCategoryCheckboxesExport = document.querySelectorAll('.crop-filter-export:checked');
    //     return selectedCategoryCheckboxesExport.length === 0;
    // }

    // Check if all municipality checkboxes are unchecked
    function checkAllMunicipalityCheckboxesUncheckedExport() {
        let selectedMunicipalityCheckboxesExport = document.querySelectorAll('.municipality-filter-export:checked');
        return selectedMunicipalityCheckboxesExport.length === 0;
    }

    // Check if all category checkboxes are unchecked and hide variety filter
    // if (checkAllCategoryCheckboxesUncheckedExport()) {
    //     document.getElementById('variety-div').classList.add('hidden');
    // }

    // Check if all municipality checkboxes are unchecked and hide barangay filter
    if (checkAllMunicipalityCheckboxesUncheckedExport()) {
        document.getElementById('barangay-div-export').classList.add('hidden');
    }
</script>