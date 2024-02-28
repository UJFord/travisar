<!-- location tab Active -->
<div class="gen_info active" id="locationTabData">
    <!-- TABLE -->
    <table id="locationTable" class="table table-hover">
        <!-- table head -->
        <thead>
            <tr>
                <th class="col-1 thead-item" scope="col">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label text-dark-emphasis small-font">
                        All
                    </label>
                </th>
                <th class="col text-dark-emphasis small-font" scope="col">Municipality</th>
                <th class="col-3 small-font text-dark-emphasis text-center">Date Added</th>
                <th class="col-1 text-center">
                    <!-- add button -->
                    <button type="button" id="addProvince" class="btn btn-secondary add-loc-btn p-2 btn small-font" name="addProvince" data-bs-toggle="modal" data-bs-target="#add-item-modal">
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
            $query_pending = "SELECT * FROM location ORDER BY location_id ASC LIMIT $items_per_page OFFSET $offset";
            $query_run_location = pg_query($conn, $query_pending);

            if ($query_run_location) {
                while ($row = pg_fetch_array($query_run_location)) {

            ?>
                    <tr id="row1" data-target="#dataModal" data-id="<?= $row['location_id']; ?>">
                        <!-- checkbox -->
                        <th scope="row"><input class="form-check-input" type="checkbox"></th>

                        <input type="hidden" name="location_id" value="<?= $row['location_id']; ?>">

                        <td>
                            <!-- Province name -->
                            <a href=""><?= $row['municipality_name']; ?></a>
                            <!-- municipality -->
                            <div class="small-font text-secondary fw-normal"><?= $row['province_name']; ?></div>
                        </td>

                        <!-- date added -->
                        <td class="small-font text-center text-secondary fw-normal">
                            12-123-51
                        </td>

                        <!-- Action -->
                        <td class="text-center">
                            <form action="">
                                <input type="hidden" name="email" value="<?php echo $row['location_id']; ?>" />

                                <!-- edit -->
                                <button type="submit" name="edit" class="btn btn-primary me-1"><i class="fa-regular fa-pen-to-square"></i></button>
                                <!-- delete -->
                                <button type="submit" name="delete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>

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
    <!-- Pagination container for Location -->
    <div class="pagination-container location-pagination-container" id="locationPaginationContainer">
        <?php
        generatePaginationLinksTabs($total_pages_location, $current_page, 'page_location', 'locationTabData', 'location');
        ?>
    </div>
</div>