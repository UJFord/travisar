<style>
    .tab_box {
        border-bottom: 2px solid rgba(229, 229, 229);
    }
</style>
<!-- LIST -->
<div class="col" style="min-height: 615px; max-height:615px;">
    <div class="container">
        <!-- HEADING -->
        <div class="tab_box d-flex justify-content-between">
            <!-- title -->
            <h4 class="fw-semibold" style="font-size: 1.5rem;">My listings</h4>
            <!-- add button -->
            <div class="z-1 dropdown">
                <!-- dropdown -->
                <button id="add-crop-btn" class="btn btn-secondary contributor-only" type="button" data-bs-toggle="modal" aria-expanded="false" data-bs-target="#add-item-modal">
                    Add New
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>

        <?php
        $user_id = null; // Initialize the variable

        if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) {
            $user_id = $_SESSION['USER']['user_id']; // Assign the user ID if the user is logged in
        }

        // Get the search query from the session or URL parameter
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $search_condition = $search ? "AND crop_variety ILIKE '%$search%'" : '';

        // Get the filter from the URL
        $status_filter = !empty($_GET['status']) ? "AND action IN ('" . implode("','", explode(',', $_GET['status'])) . "')" : '';
        $category_filter = !empty($_GET['categories']) ? "AND category_id IN (" . implode(',', explode(',', $_GET['categories'])) . ")" : '';
        $municipality_filter = !empty($_GET['municipalities']) ? "AND municipality.municipality_id IN (" . implode(',', explode(',', $_GET['municipalities'])) . ")" : '';
        $variety_filter = !empty($_GET['varieties']) ? "AND category_variety_id IN (" . implode(',', explode(',', $_GET['varieties'])) . ")" : '';
        $terrain_filter = !empty($_GET['terrains']) ? "AND terrain_id IN (" . implode(',', explode(',', $_GET['terrains'])) . ")" : '';
        $brgy_filter = !empty($_GET['barangay']) ? "AND barangay_id IN (" . implode(',', explode(',', $_GET['barangay'])) . ")" : '';

        // Set the number of items to display per page
        $items_per_page = 10;

        // Get the current page number
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the offset based on the current page and items per page
        $offset = ($current_page - 1) * $items_per_page;

        // Count the total number of rows for pagination
        $total_rows_query = "SELECT COUNT(*) FROM crop 
        LEFT JOIN crop_location ON crop_location.crop_id = crop.crop_id 
        LEFT JOIN status ON status.status_id = crop.status_id 
        LEFT JOIN municipality on municipality.municipality_id = crop_location.municipality_id
        WHERE 1=1 $search_condition $status_filter $category_filter $municipality_filter $variety_filter $terrain_filter $brgy_filter AND user_id = $user_id";
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
                    <th class="col thead-item" scope="col">
                        <input class="row-checkbox form-check-input small-font" type="checkbox" id="checkAll">
                        <label class="form-check-label text-dark-emphasis small-font">
                            All
                        </label>
                    </th>
                    <th class="col text-dark-emphasis small-font" scope="col" data-sort="category">Category</th>
                    <th class="col text-dark-emphasis small-font" scope="col" data-sort="variety">Variety Name</th>
                    <th class="col text-dark-emphasis small-font" scope="col" data-sort="location">Location</th>
                    <th class="col text-dark-emphasis small-font" scope="col" data-sort="date">Date Created</th>
                    <th class="col text-dark-emphasis small-font" scope="col" data-sort="status">Status</th>
                    <th class="col text-dark-emphasis small-font text-center" scope="col" data-sort="remarks">Remarks</th>
                    <th class="col text-dark-emphasis text-end" scope="col">
                        <div class="dropdown">
                            <button class="btn tranparent dropdown-toggle row-btn row-action-btn p-0 action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="row-btn fa-solid fa-ellipsis-vertical px-3 py-2 m-0 rounded"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <!-- Add a hidden input field to store the selected row IDs -->
                                <input type="hidden" id="selectedRows" name="selectedRows">
                                <button id="deleteSelected" class="btn btn-danger dropdown-item"><i class="fa-solid fa-trash text-danger text-center me-1" style="width: 20px;"></i>Delete Selected</button>
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
                LEFT JOIN municipality on municipality.municipality_id = crop_location.municipality_id
                WHERE 1=1 $search_condition $status_filter $category_filter $municipality_filter $variety_filter $terrain_filter $brgy_filter AND user_id = $user_id
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
                        if ($row['action'] === 'Draft') {
                        ?>
                            <tr data-id="<?= $row['crop_id']; ?>" class="rowlink draft_data" href="../../visitor/view.php?crop_id=<?= $row['crop_id']; ?>" data-bs-toggle="modal" data-bs-target="#draft-item-modal">
                            <?php
                        } else  if ($row['action'] === 'Approved') {
                            ?>
                            <tr data-id="<?= $row['crop_id']; ?>" class="rowlink" target=”_blank” data-href="../../visitor/view.php?crop_id=<?= $row['crop_id'] ?>">
                            <?php
                        } else {
                            ?>
                            <tr data-id="<?= $row['crop_id']; ?>" class="rowlink" target=”_blank” data-href="#">
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
                            <td data-col="category">
                                <div>
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
                            <td data-col="variety">
                                <!-- Variety name -->
                                <a class="small-font" href="#" target=”_blank”><?= $row['crop_variety']; ?></a>
                            </td>

                            <!-- Location -->
                            <td class="" data-col="location">
                                <h6 class="small-font m-0"><?= $row['municipality_name']; ?></h6>
                            </td>

                            <!-- date created -->
                            <td data-col="date">
                                <h6 class="small-font m-0"><?= $formatted_date; ?></h6>
                            </td>

                            <td data-col="status">
                                <?php
                                $statusClass = '';
                                switch ($row['action']) {
                                    case 'Approved':
                                        $statusClass = 'text-success'; // Green text for Approved
                                        break;
                                    case 'Rejected':
                                        $statusClass = 'text-danger'; // Red text for rejected
                                        break;
                                    case 'Draft':
                                        $statusClass = 'text-primary'; // Blue text for Draft
                                        break;
                                    case 'Pending':
                                        $statusClass = 'text-info'; // Cyan text for Pending
                                        break;
                                    case 'Updating':
                                        $statusClass = 'text-warning'; //  text for Updating
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
                            <td class="text-center" data-col="remarks">
                                <h6 class="small-font m-0"><?= $row['remarks']; ?></h6>
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
                                            <a class="dropdown-item edit_data" href="#" data-bs-toggle="modal" data-bs-target="#edit-item-modal" data-id="<?= $row['crop_id']; ?>"><i class="fa-solid fa-pen-to-square text-center me-1" style="width: 20px;"></i>Edit</a>
                                        </li>
                                        <li>
                                            <form action="crud-code/massDelete-code.php" method="post" id="deleteForm">
                                                <input type="hidden" name="crop_id" value="<?= $row['crop_id']; ?>">
                                                <input type="hidden" name="delete_row" value="1">
                                                <button class="dropdown-item admin-only" type="submit" name="delete_row" id="deleteRow">
                                                    <i class="fa-solid fa-trash text-danger text-center me-1 admin-only" style="width: 20px;"></i>Delete
                                                </button>
                                            </form>
                                        </li>
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

<!-- Make table rows clickable -->
<script>
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

<!-- script for checkbox -->
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

<!-- Add a click event listener to the "Delete Selected" button -->
<script>
    $('#deleteSelected').click(function() {
        // Collect IDs of selected rows
        var selectedIDs = [];
        $('.row-checkbox:checked').each(function() {
            selectedIDs.push($(this).closest('tr').data('id'));
        });

        // Store selected IDs in the hidden input field
        $('#selectedRows').val(selectedIDs.join(','));

        // Send AJAX request to delete selected rows
        $.ajax({
            url: 'delete.php', // Specify the URL of your delete script
            method: 'POST',
            data: {
                ids: $('#selectedRows').val()
            }, // Send IDs as a comma-separated string
            success: function(response) {
                // Refresh the page or update the table as needed
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>

<!-- to confirm if a user wants to delete table row data -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Your script here
        var deleteForm = document.getElementById('deleteForm');
        var confirmModalInstanceEdit;

        function deleteModalEdit(event) {
            // Prevent the default behavior of the button (e.g., form submission)
            event.preventDefault();

            // Get the modal element
            var confirmModal = document.getElementById('confirmModalDelete');

            // Create a new Bootstrap modal instance if it doesn't exist
            if (!confirmModalInstanceEdit) {
                confirmModalInstanceEdit = new bootstrap.Modal(confirmModal);
            }

            // Show the modal
            confirmModalInstanceEdit.show();

            // Event listener for the confirm delete button
            document.getElementById('confirmDeleteBtnRow').addEventListener('click', function() {
                // Set the value of delete_row to 1 before submitting the form
                document.querySelector('input[name="delete_row"]').value = "1";
                // Submit the form
                deleteForm.submit();
            });
        }

        // Event listener for when the modal is shown
        document.getElementById('confirmModalDelete').addEventListener('shown.bs.modal', function() {
            // Setup event listeners for delete button in modal
            setupModalEventListenersEdit();
        });

        // Event listener for when the confirmation modal is hidden
        document.getElementById('confirmModalDelete').addEventListener('hidden.bs.modal', function() {
            // Reset the confirmModalInstanceEdit
            confirmModalInstanceEdit = null;
        });

        function setupModalEventListenersEdit() {
            // Event listener for the delete button
            document.getElementById('deleteRow').addEventListener('click', deleteModalEdit);
        }

        // Initialize event listener
        setupModalEventListenersEdit();
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