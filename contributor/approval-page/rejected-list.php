<!-- LIST -->
<div class="col">
    <div class="container">

        <!-- HEADING -->
        <div class="d-flex justify-content-between">
            <!-- title -->
            <h4 class="fw-semibold" style="font-size: 1.5rem;">Rejected</h4>
        </div>

        <?php
        // Set the number of items to display per page
        $items_per_page = 10;

        // Get the current page number
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the offset based on the current page and items per page
        $offset = ($current_page - 1) * $items_per_page;

        // Count the total number of rows for pagination
        $total_rows_query = "SELECT COUNT(*) FROM crop left join status on status.status_id = crop.status_id WHERE status.action IN ('rejected')";
        $total_rows_result = pg_query($conn, $total_rows_query);
        $total_rows = pg_fetch_row($total_rows_result)[0];

        // Calculate the total number of pages
        $total_pages = ceil($total_rows / $items_per_page);

        // Get the search query from the session or URL parameter
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $search_condition = $search ? "AND crop_variety ILIKE '%$search%'" : '';

        // Get the categories and municipalities filter from the URL
        $category_filter = !empty($_GET['categories']) ? "AND category_id IN (" . implode(',', explode(',', $_GET['categories'])) . ")" : '';
        $municipality_filter = !empty($_GET['municipalities']) ? "AND municipality_id IN (" . implode(',', explode(',', $_GET['municipalities'])) . ")" : '';
        $variety_filter = !empty($_GET['varieties']) ? "AND category_variety_id IN (" . implode(',', explode(',', $_GET['varieties'])) . ")" : '';
        $terrain_filter = !empty($_GET['terrains']) ? "AND terrain_id IN (" . implode(',', explode(',', $_GET['terrains'])) . ")" : '';
        $brgy_filter = !empty($_GET['barangay']) ? "AND barangay_id IN (" . implode(',', explode(',', $_GET['barangay'])) . ")" : '';
        ?>

        <!-- TABLE -->
        <table id="dataTable" class="table table-hover">
            <!-- table head -->
            <thead>
                <tr>
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
                WHERE 1=1 $search_condition $category_filter $municipality_filter $variety_filter $terrain_filter $brgy_filter AND status.action IN ('rejected') 
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
                        <tr data-id="<?= $row['crop_id']; ?>" class="rowlink view_data admin-only" href="#" data-bs-toggle="modal" data-bs-target="#view-item-modal">
                            <input type="hidden" name="crop_id" value="<?= $row['crop_id']; ?>">
                            <!-- hidden id for location to be used for filter function for location to be found -->
                            <input type="hidden" name="municipality_id" value="<?= $row['municipality_id']; ?>">

                            <!-- category -->
                            <td>
                                <div class="">
                                    <?php
                                    if (pg_num_rows($query_run_category)) {
                                        $category = pg_fetch_assoc($query_run_category);
                                        echo '<h6 class="small-font m-0">' . $category['category_name'] . '</h6>';
                                    } else {
                                        echo "No category added.";
                                    }
                                    ?>
                                </div>
                            </td>

                            <!-- Variety name -->
                            <td>
                                <!-- Variety name -->
                                <a class="small-font" href="../crop-page/view.php?crop_id=<?= $row['crop_id'] ?>" target=”_blank”><?= $row['crop_variety']; ?></a>
                            </td>

                            <!-- date created -->
                            <td>
                                <h6 class="small-font"><?= $formatted_date; ?></h6>
                            </td>

                            <td>
                                <?php
                                $statusClass = '';
                                switch ($row['action']) {
                                    case 'approved':
                                        $statusClass = 'text-success'; // Green text for approved
                                        break;
                                    case 'rejected':
                                        $statusClass = 'text-danger'; // Red text for rejected
                                        break;
                                    case 'draft':
                                        $statusClass = 'text-primary'; // Blue text for draft
                                        break;
                                    default:
                                        $statusClass = 'text-dark'; // Default text color
                                        break;
                                }
                                ?>
                                <span class="w-auto py-1 px-2 rounded small-font <?= $statusClass; ?>">
                                    <?= $row['action']; ?>
                                </span>
                            </td>

                            <!-- remarks -->
                            <td class="text-center">
                                <h6 class="small-font"><?= $row['remarks']; ?></h6>
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