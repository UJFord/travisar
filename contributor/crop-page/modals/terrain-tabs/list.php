<!-- LIST -->
<div class="col" style="min-height: 615px; max-height:615px;">
    <div class="container">

        <!-- HEADING -->
        <div class="d-flex justify-content-between">
            <!-- title -->
            <h4 class="fw-semibold" style="font-size: 1.5rem;">Terrains</h4>
            <th col-4 class="col-1 text-center">
                <!-- add button -->
                <button id="add-crop-btn" class="btn btn-secondary encoder-only" type="button" data-bs-toggle="modal" aria-expanded="false" data-bs-target="#add-item-modal">
                    Add New
                    <i class="fa-solid fa-plus"></i>
                </button>
            </th>
        </div>

        <?php
        // Set the number of items to display per page
        $items_per_page = 10;

        // Get the current page number
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the offset based on the current page and items per page
        $offset = ($current_page - 1) * $items_per_page;

        // Count the total number of rows for pagination
        $total_rows_query = "SELECT COUNT(*) FROM terrain";
        $total_rows_result = pg_query($conn, $total_rows_query);
        $total_rows = pg_fetch_row($total_rows_result)[0];

        // Calculate the total number of pages
        $total_pages = ceil($total_rows / $items_per_page);

        // Get the search query from the session or URL parameter
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $search_condition = $search ? "AND terrain_name ILIKE '%$search%'" : '';

        // Get the categories and municipalities filter from the URL
        $terrain_filter = !empty($_GET['categories']) ? "AND terrain_id IN (" . implode(',', explode(',', $_GET['categories'])) . ")" : '';
        ?>

        <!-- TABLE -->
        <table id="dataTable" class="table table-hover">
            <!-- table head -->
            <thead>
                <tr>
                    <th class="col thead-item" scope="col">
                        <input class="row-checkbox form-check-input small-font" type="checkbox" id="checkAll">
                        <label class="form-check-label text-dark-emphasis small-font">
                            All
                        </label>
                    </th>
                    <th class="col text-dark-emphasis small-font" scope="col" data-sort="terrain">Terrain Name</th>
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
                $query = "SELECT * FROM terrain
                WHERE 1=1 $search_condition
                ORDER BY terrain_id DESC 
                LIMIT $items_per_page OFFSET $offset";
                $query_run = pg_query($conn, $query);

                if ($query_run) {
                    while ($row = pg_fetch_array($query_run)) {
                ?>
                        <tr>
                            <input type="hidden" name="terrain_id" value="<?= $row['terrain_id']; ?>">

                            <!-- checkbox -->
                            <th scope="row">
                                <input class="row-checkbox form-check-input small-font" type="checkbox">
                            </th>

                            <!-- terrain -->
                            <td data-col="terrain">
                                <div class="small-font">
                                    <h6 class="small-font m-0"><?= $row['terrain_name'] ?></h6>
                                </div>
                            </td>

                            <!-- ellipsis menu butn -->
                            <td class="text-end">
                                <div class="dropdown row-btn">
                                    <button class="btn tranparent dropdown-toggle row-action-btn p-0 action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="row-btn fa-solid fa-ellipsis-vertical px-3 py-2 m-0 rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <!-- <li><a class="dropdown-item" href="#"><i class="fa-solid fa-eye text-center" style="width: 20px;"></i> View</a></li> -->
                                        <li>
                                            <a class="dropdown-item edit_data admin-only" href="#" data-bs-toggle="modal" data-bs-target="#edit-item-modal" data-id="<?= $row['terrain_id']; ?>"><i class="fa-solid fa-pen-to-square text-center me-1 admin-only" style="width: 20px;"></i>Edit</a>
                                        </li>
                                        <!-- <li><a class="dropdown-item admin-only" href="#"><i class="fa-solid fa-trash text-danger text-center me-1 admin-only" style="width: 20px;"></i>Delete</a></li> -->
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

<script>
    // Add event listener to the "All" checkbox
    $('#checkAll').change(function() {
        // Check or uncheck all checkboxes based on the state of the "All" checkbox
        $('.row-checkbox').prop('checked', $(this).prop('checked'));
    });

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


<!-- Add a click event listener to each table header for sorting -->
<script>
    $(document).ready(function() {
        $('th[data-sort]').on('click', function() {
            var $th = $(this);
            var column = $th.data('sort');
            var direction = $th.hasClass('asc') ? 'desc' : 'asc';

            // Remove asc/desc classes from all headers
            $('th[data-sort]').removeClass('asc desc');

            // Add asc/desc class to clicked header
            $th.addClass(direction);

            // Sort the table
            sortTable(column, direction);
        });
    });

    function sortTable(column, direction) {
        var $tbody = $('tbody');
        var $rows = $tbody.find('tr').toArray();

        $rows.sort(function(a, b) {
            var valA = $(a).find('td[data-col="' + column + '"]').text().toUpperCase();
            var valB = $(b).find('td[data-col="' + column + '"]').text().toUpperCase();

            if (direction === 'asc') {
                return valA.localeCompare(valB);
            } else {
                return valB.localeCompare(valA);
            }
        });

        $tbody.empty().append($rows);
    }
</script>