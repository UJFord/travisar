<!-- Pending tab Active -->
<div class="gen_info active" id="pendingTabData">

    <!-- TABLE -->
    <table id="pendingTable" class="table table-hover">
        <!-- table head -->
        <thead>
            <tr>
                <th class="col-1 thead-item" scope="col">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label text-dark-emphasis small-font">
                        All
                    </label>
                </th>
                <th class="col text-dark-emphasis small-font" scope="col">Name</th>
                <th class="col-3 text-dark-emphasis small-font" scope="col">Contributor</th>
                <th class="col-2 text-dark-emphasis text-center small-font" scope="col">Date</th>
                <th class="col-1 text-dark-emphasis text-center small-font" scope="col">Status</th>
                <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>
            </tr>
        </thead>

        <!-- table body -->
        <tbody class="table-group-divider fw-bold overflow-scroll">
            <?php
            $query_pending = "SELECT * FROM crop WHERE status = 'pending' ORDER BY crop_id ASC LIMIT $items_per_page OFFSET $offset";
            $query_run_pending = pg_query($conn, $query_pending);

            if ($query_run_pending) {
                while ($row = pg_fetch_array($query_run_pending)) {
                    // Convert the string to a DateTime object
                    $date = new DateTime($row['input_date']);
                    // Format the date to display up to the minute
                    $formatted_date = $date->format('Y-m-d H:i');

                    // Fetch category name
                    $query_category = "SELECT * FROM category WHERE category_id = $1";
                    $query_run_category = pg_query_params($conn, $query_category, array($row['category_id']));

                    // Fetch contributor name
                    $query_user = "SELECT * FROM users WHERE user_id = $1";
                    $query_run_user = pg_query_params($conn, $query_user, array($row['user_id']));

            ?>
                    <tr id="row1" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>">
                        <!-- checkbox -->
                        <th scope="row"><input class="form-check-input" type="checkbox"></th>
                        <input type="hidden" name="crop_id" value="<?= $row['crop_id']; ?>">
                        <td>
                            <!-- scientific name -->
                            <a href=""><?= $row['crop_variety']; ?></a>
                            <!-- category -->
                            <?php
                            if (pg_num_rows($query_run_category)) {
                                $category = pg_fetch_assoc($query_run_category);
                                echo '<h6 class="text-secondary small-font m-0">' . $category['category_name'] . '</h6>';
                            } else {
                                echo "No category added.";
                            }
                            ?>
                        </td>
                        <!-- contributor -->
                        <td class="text-secondary small-font fw-normal">
                            <?php
                            if (pg_num_rows($query_run_user)) {
                                $user = pg_fetch_assoc($query_run_user);
                                echo $user['first_name'] . " " . $user['last_name'];
                            } else {
                                echo "No contributor";
                            }
                            ?>
                        </td>

                        <!-- Date Created -->
                        <td class=" text-secondary small-font text-center fw-normal">
                            <?= $formatted_date; ?>
                        </td>

                        <!-- Status -->
                        <td class="text-secondary small-font text-center fw-normal">
                            <?= $row['status']; ?>
                        </td>

                        <!-- Action -->
                        <td>
                            <form class="d-flex justify-content-center" action="approval-page/code/code.php" method="post">
                                <input type="hidden" name="crop_id" value="<?php echo $row['crop_id']; ?>" />
                                <button type="submit" name="approve" class="btn btn-success me-2"><i class="fa-solid fa-check"></i></button>
                                <button type="submit" name="rejected" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "No data found.";
            }
            ?>
        </tbody>
    </table>
    <div class="pagination-container pending-pagination-container" id="pendingPaginationContainer">
        <?php
        generatePaginationLinksTabs($total_pages_pending, $current_page, 'page_pending', 'pendingTabData', 'pending');
        ?>
    </div>
</div>