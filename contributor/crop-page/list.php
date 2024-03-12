<!-- LIST -->
<div class="col border">
    <div class="container">

        <!-- HEADING -->
        <div class="d-flex justify-content-between">
            <!-- title -->
            <h4 class="fw-semibold" style="font-size: 1.5rem;">All Crops</h4>
            <!-- add button -->
            <div class="z-1 dropdown">
                <!-- dropdown -->
                <button id="add-crop-btn" class="btn btn-secondary dropdown-toggle encoder-only" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    New
                </button>
                <!-- list -->
                <ul class="dropdown-menu dropdown-menu-end p-0 overflow-hidden">
                    <!-- add item -->
                    <li class="p-0">
                        <!-- single item -->
                        <button type="button" class="dropdown-item p-2 btn" data-bs-toggle="modal" data-bs-target="#add-item-modal">
                            <i class="fa-solid fa-circle-plus me-2 small-font"></i><span>Item</span>
                        </button>
                        <!-- import csv -->
                        <button type="button" class="dropdown-item p-2 btn" data-bs-toggle="modal" data-bs-target="">
                            <i class="fa-solid fa-file-circle-plus me-2 small-font"></i><span>Sheet</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <?php
        // Set the number of items to display per page
        $items_per_page = 7;

        // Get the current page number
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the offset based on the current page and items per page
        $offset = ($current_page - 1) * $items_per_page;

        // Count the total number of rows for pagination
        $total_rows_query = "SELECT COUNT(*) FROM crop WHERE status = 'approved'";
        $total_rows_result = pg_query($conn, $total_rows_query);
        $total_rows = pg_fetch_row($total_rows_result)[0];

        // Calculate the total number of pages
        $total_pages = ceil($total_rows / $items_per_page);
        ?>

        <!-- TABLE -->
        <table id="dataTable" class="table table-hover">
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
                    <th class="col-4 text-dark-emphasis small-font" scope="col">Contributor</th>
                    <th class="col-4 text-dark-emphasis small-font" scope="col">Action</th>
                    <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>

                </tr>
            </thead>
            <!-- table body -->
            <tbody class="table-group-divider fw-bold overflow-scroll">

                <?php
                // get the data from crops. only approved data are shown and is limited per items per page
                $query = "SELECT * FROM crop WHERE status = 'approved' ORDER BY crop_id ASC LIMIT $items_per_page OFFSET $offset";
                $query_run = pg_query($conn, $query);

                if ($query_run) {
                    while ($row = pg_fetch_array($query_run)) {
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
                        <tr id="row1" data-toggle="modal" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>">

                            <!-- checkbox -->
                            <th scope="row"><input class="form-check-input" type="checkbox"></th>

                            <input type="hidden" name="crop_id" value="<?= $row['crop_id']; ?>">

                            <!-- Variety name -->
                            <td>
                                <!-- Variety name -->
                                <a href="#" class="modal-trigger" data-toggle="modal" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>"><?= $row['crop_variety']; ?></a>
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
                            <td class="small-font">
                                <span class="py-1 px-2">
                                    <?php
                                    if (pg_num_rows($query_run_user)) {
                                        $user = pg_fetch_assoc($query_run_user);
                                        echo '<h6 class="text-secondary small-font m-0">' . $user['first_name'] . " " . $user['last_name'] . '</h6>';
                                    } else {
                                        echo "No contributor.";
                                    }
                                    ?>
                                </span>
                            </td>

                            <!-- edit -->
                            <td>
                                <a href="#" class="btn btn-success btn-sm edit_data admin-only" data-toggle="modal" data-target="#dataModal" data-id="<?= $row['crop_id']; ?>">Edit</a>
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
    </div>
</div>
<!-- Add pagination links -->
<?php generatePaginationLinks($total_pages, $current_page, 'page'); ?>

<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    // make clicking table rows open edit ui
    $(document).ready(function() {
        $('#dataTable tr').click(function() {
            // console.log('clicked')
            // Get the crop ID from the clicked row or anchor tag
            var cropId = $(this).data('id') || $(this).find('a').data('id');

            // Optionally, use the crop ID to fetch additional data and populate the modal
            // ...

            // Open the modal
            $('#dataModal').modal('show');
        });
    });
</script>