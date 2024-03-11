<!-- Approved Tab Unactive -->
<div class="gen_info" id="approvedTabData">
    <!-- TABLE -->
    <table id="approvedTable" class="table table-hover">
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
                <th class="col-2 text-dark-emphasis small-font text-center" scope="col">Date Created</th>
                <th class="col-1 text-dark-emphasis small-font text-center" scope="col">Status</th>
                <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>
            </tr>

        </thead>
        <!-- table body -->
        <tbody class="table-group-divider fw-bold overflow-scroll">
            <?php
            $query_approved = "SELECT * FROM crop WHERE status IN ('approved', 'rejected') ORDER BY crop_id ASC LIMIT $items_per_page OFFSET $offset";
            $query_run_approved = pg_query($conn, $query_approved);

            if ($query_run_approved) {
                while ($row = pg_fetch_array($query_run_approved)) {
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
                    <!-- <tr id="row1" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>" class="class=" <?= ($row['status'] == 'approve') ? 'bg-success-subtle' : 'bg-danger-subtle'; ?>"> -->
                    <tr id="row1" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>" style="background-color: <?= ($row['status'] == 'approved') ? 'green' : 'red'; ?>">

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
                        <td class="small-font text-secondary fw-normal">
                            <?php
                            if (pg_num_rows($query_run_user)) {
                                $user = pg_fetch_assoc($query_run_user);
                                echo $user['first_name'] . " " . $user['last_name'];
                            } else {
                                echo 'No Contributor';
                            }
                            ?>
                        </td>

                        <!-- Date Created -->
                        <td class="text-secondary small-font fw-normal text-center">
                            <?= $formatted_date; ?>
                        </td>

                        <!-- Status -->
                        <td class="text-secondary small-font fw-normal text-center">
                            <?= $row['status']; ?>
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

    <!-- pagination -->
    <div class="pagination-container approved-pagination-container" id="approvedPaginationContainer">
        <?php
        generatePaginationLinksTabs($total_pages_approved, $current_page, 'page_approved', 'approvedTabData', 'approved');
        ?>
    </div>
</div>