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
        color: #7360ff;
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

    /* the blue line for showing active tab */
    .line {
        position: absolute;
        top: 62px;
        left: 323px;
        width: 100px;
        height: 5px;
        background-color: #7360ff;
        border-radius: 10px;
        transition: all .3s ease-in-out;
    }
</style>
<!-- LIST -->
<div class="col border">
    <div class="container">

        <!-- HEADING -->
        <div class="d-flex justify-content-between">
            <div class="tab_box">
                <!-- Button Tabs -->
                <button class="tab_btn active" id="pendingTab">Pending</button>
                <button class="tab_btn" id="approvedTab">Approved</button>
                <div class="line"></div>
            </div>
            <!-- filter actions -->
            <div class="d-flex py-3 px-3">
                <!-- search -->
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search Crops" aria-label="Search" aria-describedby="filter-search">
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

            // Count the total number of rows for pagination for approved crops
            $total_rows_query_approved = "SELECT COUNT(*) FROM crop WHERE status = 'approved'";
            $total_rows_result_approved = pg_query($conn, $total_rows_query_approved);
            $total_rows_approved = pg_fetch_row($total_rows_result_approved)[0];

            // Calculate the total number of pages for approved crops
            $total_pages_approved = ceil($total_rows_approved / $items_per_page);

            // Count the total number of rows for pagination for pending crops
            $total_rows_query_pending = "SELECT COUNT(*) FROM crop WHERE status = 'pending'";
            $total_rows_result_pending = pg_query($conn, $total_rows_query_pending);
            $total_rows_pending = pg_fetch_row($total_rows_result_pending)[0];

            // Calculate the total number of pages for pending crops
            $total_pages_pending = ceil($total_rows_pending / $items_per_page);
        ?>

        <!-- dib ni sya para ma set ang mga tabs na data -->
        <div class="general_info">
            <!-- Pending tab Active -->
            <div class="gen_info active">
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
                            <th class="col text-dark-emphasis small-font" scope="col">Variety Name</th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Contributor</th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Date Created</th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Status</th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Action</th>
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
                                    <!-- Date Created -->
                                    <td class="small-font">
                                        <span class="py-1 px-2">
                                            <h6 class="text-secondary small-font m-0"><?= $formatted_date; ?></h6>
                                        </span>
                                    </td>
                                    <!-- Status -->
                                    <td class="small-font">
                                        <span class="py-1 px-2">
                                            <h6 class="text-secondary small-font m-0"><?= $row['status']; ?></h6>
                                        </span>
                                    </td>
                                    <!-- Action -->
                                    <form action="">
                                        <td>
                                            <input type="hidden" name="email" value="<?php echo $row['crop_id']; ?>" />
                                            <input type="submit" name="approve" value="approve">
                                            <input type="submit" name="delete" value="delete">
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
            </div>
            <!-- Approved Tab Unactive -->
            <div class="gen_info">
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
                            <th class="col text-dark-emphasis small-font" scope="col">Variety Name</th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Contributor</th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Date Created</th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Status</th>
                            <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>
                        </tr>
                    </thead>

                    <!-- table body -->
                    <tbody class="table-group-divider fw-bold overflow-scroll">
                        <?php
                        $query_approved = "SELECT * FROM crop WHERE status = 'approved' ORDER BY crop_id ASC LIMIT $items_per_page OFFSET $offset";
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
                                    <!-- Date Created -->
                                    <td class="small-font">
                                        <span class="py-1 px-2">
                                            <h6 class="text-secondary small-font m-0"><?= $formatted_date; ?></h6>
                                        </span>
                                    </td>
                                    <!-- Status -->
                                    <td class="small-font">
                                        <span class="py-1 px-2">
                                            <h6 class="text-secondary small-font m-0"><?= $row['status']; ?></h6>
                                        </span>
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

    </div>
</div>
<!-- 
    Add pagination links 
    if else statement para kung unsa na pagination gamitun kung sa pending or approved ba
-->
<?php
    // checking if a tab parameter is present if not it defaults to pending
    // ! guba ang pagination sa page approved
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'pending';
    if ($active_tab === 'pending') {
        generatePaginationLinks($total_pages_pending, $current_page, 'page_pending');
    } else {
        generatePaginationLinks($total_pages_approved, $current_page, 'page_approved');
    }
?>

<!-- script -->
<!-- tabs script -->
<script>
    const tabs = document.querySelectorAll('.tab_btn');
    const all_content = document.querySelectorAll('.gen_info');

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', (e) => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            var line = document.querySelector('.line');
            line.style.width = e.target.offsetWidth + "px";
            line.style.left = e.target.offsetLeft + "px";

            all_content.forEach(content => {
                content.classList.remove('active')
            });
            all_content[index].classList.add('active');
        })
    })
</script>