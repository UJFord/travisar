<!-- LIST -->
<div class="col">
    <div class="container">

        <!-- HEADING -->
        <div class="d-flex justify-content-between">
            <!-- title -->
            <h4 class="fw-semibold" style="font-size: 1.5rem;">All Crops</h4>
            <!-- add button -->
            <div class="z-1 dropdown">
                <!-- dropdown -->
                <button id="add-crop-btn" class="btn btn-secondary dropdown-toggle encoder-only" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Add New
                </button>
                <!-- list -->
                <ul class="dropdown-menu dropdown-menu-end p-0 overflow-hidden">
                    <!-- add item -->
                    <li class="p-0">
                        <!-- single item -->
                        <button type="button" class="dropdown-item p-2 btn" data-bs-toggle="modal" data-bs-target="#add-item-modal">
                            <i class="fa-solid fa-circle-plus me-2 small-font"></i><span>Crop</span>
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
        $items_per_page = 10;

        // Get the current page number
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the offset based on the current page and items per page
        $offset = ($current_page - 1) * $items_per_page;

        // Count the total number of rows for pagination
        $total_rows_query = "SELECT COUNT(*) FROM crop left join status on status.status_id = crop.status_id";
        $total_rows_result = pg_query($conn, $total_rows_query);
        $total_rows = pg_fetch_row($total_rows_result)[0];

        // Calculate the total number of pages
        $total_pages = ceil($total_rows / $items_per_page);

        // Get the search query from the session or URL parameter
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $search_condition = $search ? "AND crop_variety ILIKE '%$search%'" : '';

        // Get the categories and municipalities filter from the URL
        $category_filter = !empty($_GET['categories']) ? "AND category_id IN (" . implode(',', explode(',', $_GET['categories'])) . ")" : '';
        $municipality_filter = !empty($_GET['municipalities']) ? "AND location_id IN (" . implode(',', explode(',', $_GET['municipalities'])) . ")" : '';

        ?>

        <!-- TABLE -->
        <table id="dataTable" class="table table-hover">
            <!-- table head -->
            <thead>
                <tr>
                    <th class="col thead-item" scope="col">
                        <input class="form-check-input small-font" type="checkbox">
                        <label class="form-check-label text-dark-emphasis small-font">
                            All
                        </label>
                    </th>
                    <th class="col text-dark-emphasis small-font" scope="col">Category</th>
                    <th class="col text-dark-emphasis small-font" scope="col">Name</th>
                    <th class="col text-dark-emphasis small-font" scope="col">Date</th>
                    <!-- <th class="col text-dark-emphasis small-font" scope="col">Action</th> -->
                    <th class="col text-dark-emphasis small-font" scope="col">Status</th>
                    <th class="col text-dark-emphasis small-font text-center" scope="col">Remarks</th>
                    <th class="col text-dark-emphasis text-end" scope="col">
                        <div class="dropdown">
                            <button class="btn tranparent dropdown-toggle row-btn row-action-btn p-0 action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="row-btn fa-solid fa-ellipsis-vertical px-3 py-2 m-0 rounded"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash text-danger text-center me-1" style="width: 20px;"></i>Delete Selected</a></li>
                            </ul>
                        </div>
                    </th>
                </tr>
            </thead>

            <!-- table body -->
            <tbody class="table-group-divider fw-bold overflow-scroll">
                <?php
                // get the data from crops.
                $query = "SELECT * FROM crop 
                LEFT JOIN crop_location ON crop_location.crop_id = crop.crop_id 
                LEFT JOIN status ON status.status_id = crop.status_id 
                WHERE 1=1 $search_condition $category_filter $municipality_filter 
                ORDER BY crop.crop_id DESC 
                LIMIT $items_per_page OFFSET $offset";
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
                        <?php
                        if ($row['action'] === 'draft' && $_SESSION['USER']['user_id'] == $row['user_id']) {
                        ?>
                            <tr data-id="<?= $row['crop_id']; ?>" class="rowlink edit_data" href="#" data-bs-toggle="modal" data-bs-target="#edit-item-modal">
                            <?php
                        } else {
                            ?>
                            <tr data-id="<?= $row['crop_id']; ?>" class="rowlink" target=”_blank” data-href="view.php?crop_id=<?= $row['crop_id'] ?>">
                            <?php
                        }
                            ?>

                            <input type="hidden" name="crop_id" value="<?= $row['crop_id']; ?>">
                            <!-- hidden id for location to be used for filter function for location to be found -->
                            <input type="hidden" name="municipality_id" value="<?= $row['municipality_id']; ?>">

                            <!-- checkbox -->
                            <th scope="row">
                                <input class="row-checkbox form-check-input small-font" type="checkbox">
                            </th>

                            <!-- category -->
                            <td>
                                <div class="small-font">
                                    <?php
                                    if (pg_num_rows($query_run_category)) {
                                        $category = pg_fetch_assoc($query_run_category);
                                        echo '<h6 class="text-secondary small-font m-0">' . $category['category_name'] . '</h6>';
                                    } else {
                                        echo "No category added.";
                                    }
                                    ?>
                                </div>
                            </td>

                            <!-- Variety name -->
                            <td>
                                <!-- Variety name -->
                                <a href="view.php?crop_id=<?= $row['crop_id'] ?>" target=”_blank”><?= $row['crop_variety']; ?></a>
                            </td>

                            <!-- date created -->
                            <td>
                                <h6 class="text-secondary small-font"><?= $formatted_date; ?></h6>
                            </td>

                            <!-- status -->
                            <td>
                                <span class=" small-font bg-dark-subtle w-auto py-1 px-2 rounded"><?= $row['action']; ?></span>
                            </td>

                            <!-- remarks -->
                            <td class="text-center">
                                <div class="dropdown row-btn">
                                    <button class="btn transparent dropdown-toggle row-action-btn remarks-btn p-0 p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="row-btn fa-regular fa-comment p-2 m-0 rounded"></i>
                                    </button>
                                    <div class="dropdown-menu remarks-menu p-2">
                                        <textarea class="form-control remarks-text" placeholder="No remarks" style="height: 180px;" disabled><?= $row['remarks']; ?></textarea>
                                    </div>
                                </div>
                            </td>

                            <!-- ellipsis menu butn -->
                            <td class="text-end">
                                <div class="dropdown row-btn">
                                    <button class="btn tranparent dropdown-toggle row-action-btn p-0 action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="row-btn fa-solid fa-ellipsis-vertical px-3 py-2 m-0 rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-eye text-center" style="width: 20px;"></i> View</a></li>
                                        <li>
                                            <a class="dropdown-item edit_data admin-only" href="#" data-bs-toggle="modal" data-bs-target="#edit-item-modal" data-id="<?= $row['crop_id']; ?>"><i class="fa-solid fa-pen-to-square text-center me-1 admin-only" style="width: 20px;"></i>Edit</a>
                                        </li>
                                        <li><a class="dropdown-item admin-only" href="#"><i class="fa-solid fa-trash text-danger text-center me-1 admin-only" style="width: 20px;"></i>Delete</a></li>
                                    </ul>
                                </div>
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
    </div>
</div>
<!-- Add pagination links -->
<?php generatePaginationLinks($total_pages, $current_page, 'page'); ?>

<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    // Make table rows clickable
    $(document).ready(function() {
        // Add click event to table rows
        $('tbody tr[data-href]').on("click", function(event) {
            // Check if the click target or any of its ancestors is a button or checkbox
            if (
                !$(event.target).is('.row-btn, :checkbox') &&
                !$(event.target).closest('.row-btn, :checkbox').length
            ) {
                // Navigate to the URL specified in the data-href attribute
                window.location.href = $(this).attr('data-href');
            }
        });
    });
</script>