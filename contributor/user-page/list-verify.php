<!-- CSS -->
<style>
    /* CSS for tabs */
    .tab_box {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 2px solid rgba(229, 229, 229);
        position: relative;
    }

    .tab_box .tab_btn {
        font-size: 18px;
        font-weight: 600;
        color: #919191;
        background: none;
        border: none;
        padding: 18px;
        cursor: pointer;
    }

    .tab_box .tab_btn.active {
        color: #555555;
    }

    /* for hiding data that is not active */
    .general_info .gen_info {
        display: none;
        animation: moving .5s ease;
    }

    @keyframes moving {
        from {
            transform: translateX(50px);
            opacity: 0;
        }

        to {
            transform: translateX(0px);
            opacity: 1;
        }
    }

    .general_info .gen_info.active {
        display: block;
    }

    .add-loc-btn {
        background: var(--mainBrand);
        border: none;
    }
</style>
<!-- LIST -->
<div class="container">
    <!-- HEADING -->
    <div class="tab_box d-flex justify-content-between">
        <!-- Button Tabs -->
        <div>
            <button class="tab_btn active" id="locationTab">Verify Users</button>
        </div>
        <!-- filter actions -->
        <div class="d-flex py-3 px-3">
            <!-- search -->
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Search User" aria-label="Search" aria-describedby="filter-search">
                <span class="input-group-text" id="filter-search"><i class="bi bi-search"></i></span>
            </div>
        </div>
    </div>

    <?php
    // Set the number of items to display per page
    $items_per_page = 10;

    // Get the current page number
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the offset based on the current page and items per page
    $offset = ($current_page - 1) * $items_per_page;

    // Count the total number of rows for pagination for contributor crops
    $total_rows_query_contributor = "SELECT COUNT(*) FROM users WHERE email_verified is NULL";
    $total_rows_result_contributor = pg_query($conn, $total_rows_query_contributor);
    $total_rows_contributor = pg_fetch_row($total_rows_result_contributor)[0];

    // Calculate the total number of pages for contributor crops
    $total_pages_contributor = ceil($total_rows_contributor / $items_per_page);
    ?>

    <!-- diri ang data sa list -->
    <div class="general_info">
        <!-- TABLE -->
        <table id="contributorTable" class="table table-hover">
            <!-- table head -->
            <thead>
                <tr>
                    <th class="col-1 thead-item" scope="col">
                        <input class="row-checkbox form-check-input small-font" type="checkbox" id="checkAll">
                        <label class="form-check-label text-dark-emphasis small-font">
                            All
                        </label>
                    </th>
                    <th class="col-2 text-dark-emphasis small-font" scope="col">First Name</th>
                    <th class="col-2 text-dark-emphasis small-font" scope="col">Last Name</th>
                    <th class="col-2 text-dark-emphasis text-center small-font" scope="col">Date Created</th>
                    <th class="col-2 text-dark-emphasis text-center small-font" scope="col">Action</th>
                </tr>
            </thead>

            <!-- table body -->
            <tbody class="table-group-divider fw-bold overflow-scroll">
                <?php
                $query_pending = "SELECT
                        u.user_id,
                        u.first_name,
                        u.last_name,
                        u.email_verified,
                        u.registration_date,
                        COUNT(c.crop_id) AS contributed_crops
                    FROM
                        users u
                        LEFT JOIN crop c ON u.user_id = c.user_id
                    WHERE
                        u.email_verified IS NULL
                    GROUP BY
                        u.user_id,
                        u.first_name,
                        u.last_name,
                        u.email_verified
                    ORDER BY
                        u.user_id ASC
                    LIMIT $items_per_page
                    OFFSET $offset;
                    ";
                $query_run_pending = pg_query($conn, $query_pending);

                if ($query_run_pending) {
                    while ($row = pg_fetch_array($query_run_pending)) {
                        // Convert the string to a DateTime object
                        $date = new DateTime($row['registration_date']);
                        // Format the date to display up to the minute
                        $formatted_date = $date->format('Y-m-d H:i');

                ?>
                        <tr id="row1" data-target="#dataModal" data-id="<?= $row['user_id']; ?>">
                            <!-- checkbox -->
                            <th scope="row"><input class="form-check-input" type="checkbox"></th>
                            <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                            <td>
                                <!-- first Name -->
                                <h6 class="small-font m-0"><?= $row['first_name']; ?></h6>
                            </td>

                            <td>
                                <!-- last Name -->
                                <h6 class="small-font m-0"><?= $row['last_name']; ?></h6>
                            </td>

                            <!-- Date Created -->
                            <td class="small-font text-center fw-normal">
                                <?= $formatted_date; ?>
                            </td>

                            <!-- Action -->
                            <td class="text-center">
                                <!-- View -->
                                <a href="#" class="btn btn-primary me-1 view-item-modal-partners" data-toggle="modal" data-target="#dataModalView" data-id="<?= $row['user_id']; ?>">view</a>
                                <!-- delete -->
                                <!-- <button type="submit" name="delete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button> -->
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
            generatePaginationLinks($total_pages_contributor, $current_page, 'page');
            ?>
        </div>
    </div>
</div>

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