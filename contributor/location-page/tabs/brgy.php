<!-- barangay Tab Unactive -->
<div class="gen_info" id="barangayTabData">
    <!-- TABLE -->
    <table id="barangayTable" class="table table-hover">
        <!-- table head -->
        <thead>
            <tr>
                <th class="col-1 thead-item" scope="col">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label text-dark-emphasis small-font">
                        All
                    </label>
                </th>
                <th class="col text-dark-emphasis small-font" scope="col">Barangay</th>
                <th class="col-3 text-dark-emphasis text-center small-font" scope="col">Date Added</th>
                <th col-4 class="col-1 text-center">
                    <!-- add button -->
                    <button type=" button" id="addBarangay" class="btn btn-secondary add-loc-btn p-2 btn small-font" name="addBarangay" data-bs-toggle="modal" data-bs-target="#add-item-modal">
                        New
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </th>
                <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>
            </tr>
        </thead>

        <!-- table body -->
        <tbody class="table-group-divider fw-bold overflow-scroll">
            <?php
            $query_barangay = "SELECT * FROM barangay ORDER BY barangay_id ASC LIMIT $items_per_page OFFSET $offset";
            $query_run_barangay = pg_query($conn, $query_barangay);

            if ($query_run_barangay) {
                while ($row = pg_fetch_array($query_run_barangay)) {
            ?>
                    <tr id="row1" data-target="#dataModal" data-id="<?= $row['barangay_id']; ?>">
                        <!-- checkbox -->
                        <th scope="row"><input class="form-check-input" type="checkbox"></th>
                        <input type="hidden" name="barangay_id" value="<?= $row['barangay_id']; ?>">
                        <td>
                            <!-- municipality name -->
                            <a href=""><?= $row['municipality_name']; ?></a>
                            <div class="text-secondary small-font fw-normal"><?= $row['barangay_name']; ?></div>
                        </td>
                        <!-- date added -->
                        <td class="small-font text-center text-secondary fw-normal">
                            12-123-51
                        </td>
                        <!-- Action -->
                        <form action="">
                            <td>
                                <input type="hidden" name="email" value="<?php echo $row['barangay_id']; ?>" />
                                <!-- edit -->
                                <button type="submit" name="edit" class="btn btn-primary me-1"><i class="fa-regular fa-pen-to-square"></i></button>
                                <!-- delete -->
                                <button type="submit" name="delete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </form>
                        <!-- ellipsis menu butn -->
                        <td class="text-end"><i class="fa-solid fa-ellipsis-vertical btn"></i></td>
                    </tr>
            <?php
                }
            } else {
                echo "No data found.";
            }
            ?>
        </tbody>
    </table>
    <!-- Pagination container for Barangay -->
    <div class="pagination-container barangay-pagination-container" id="barangayPaginationContainer">
        <?php
        generatePaginationLinksTabs($total_pages_barangay, $current_page, 'page_barangay', 'barangayTabData', 'barangay');
        ?>
    </div>
</div>