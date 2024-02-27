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

    .add-loc-btn {
        background: var(--mainBrand);
        border: none;
    }
</style>
<!-- LIST -->
<div class="col border">
    <div class="container">

        <!-- HEADING -->
        <div class="d-flex justify-content-between">
            <div class="tab_box">
                <!-- Button Tabs -->
                <button class="tab_btn active" id="locationTab">Location</button>
                <button class="tab_btn" id="barangayTab">Barangay</button>
                <div class="line"></div>
            </div>
            <!-- filter actions -->
            <div class="d-flex py-3 px-3">
                <!-- search -->
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search Location" aria-label="Search" aria-describedby="filter-search">
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
        $total_rows_query_location = "SELECT COUNT(*) FROM location";
        $total_rows_result_location = pg_query($conn, $total_rows_query_location);
        $total_row_location = pg_fetch_row($total_rows_result_location)[0];

        // Calculate the total number of pages for approved crops
        $total_pages_location = ceil($total_row_location / $items_per_page);

        // Count the total number of rows for pagination for pending crops
        $total_rows_query_barangay = "SELECT COUNT(*) FROM barangay";
        $total_rows_result_barangay = pg_query($conn, $total_rows_query_barangay);
        $total_rows_barangay = pg_fetch_row($total_rows_result_barangay)[0];

        // Calculate the total number of pages for pending crops
        $total_pages_barangay = ceil($total_rows_barangay / $items_per_page);
        ?>

        <!-- dib ni sya para ma set ang mga tabs na data -->
        <div class="general_info">
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
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Province Name</th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Municipality Name</th>
                            <th col-4>
                                <!-- add button -->
                                <button type="button" id="addProvince" class="btn btn-secondary add-loc-btn p-2 btn" name="addProvince" data-bs-toggle="modal" data-bs-target="#add-item-modal">
                                    Add
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
                                        <a href=""><?= $row['province_name']; ?></a>
                                    </td>
                                    <!-- Municipality -->
                                    <td class="small-font">
                                        <h6 class="text-secondary small-font m-0"><?= $row['municipality_name']; ?></h6>
                                    </td>
                                    <!-- Action -->
                                    <form action="">
                                        <td>
                                            <input type="hidden" name="email" value="<?php echo $row['location_id']; ?>" />
                                            <input type="submit" name="edit" value="edit">
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
                <!-- Pagination container for Location -->
                <div class="pagination-container location-pagination-container" id="locationPaginationContainer">
                    <?php
                    generatePaginationLinksTabs($total_pages_location, $current_page, 'page_location', 'locationTabData', 'location');
                    ?>
                </div>
            </div>
            <!-- barangay Tab Unactive -->
            <div class="gen_info" id="barangayTabData">
                <!-- TABLE -->
                <table id="barangayTable" class="table table-hover">
                    <!-- table head -->
                    <thead>
                        <tr>
                            <th class="col-1 thead-item" scope="col">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label text-dark-emphasis small-font">
                                    All
                                </label>
                            </th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Municipality Name</th>
                            <th class="col-4 text-dark-emphasis small-font" scope="col">Barangay Name</th>
                            <th col-4>
                                <!-- add button -->
                                <button type="button" id="addBarangay" class="btn btn-secondary add-loc-btn p-2 btn" name="addBarangay" data-bs-toggle="modal" data-bs-target="#add-item-modal">
                                    Add
                                </button>
                            </th>
                            <th class="col-1 text-dark-emphasis text-end" scope="col"><i class="fa-solid fa-ellipsis-vertical btn"></i></th>
                        </tr>
                    </thead>

                    <!-- table body -->
                    <tbody class="table-group-divider fw-bold overflow-scroll">
                        <?php
                        $query_barangay = "SELECT * FROM barangay ORDER BY barangay_id ASC LIMIT $items_per_page OFFSET $offset";
                        $query_run_barangay = pg_query($conn, $query_barangay);

                        if ($query_run_barangay) {
                            while ($row = pg_fetch_array($query_run_barangay)) {
                        ?>
                                <tr id="row1" data-target="#dataModal" data-id="<?= $row['barangay_id']; ?>">
                                    <!-- checkbox -->
                                    <th scope="row"><input class="form-check-input" type="checkbox"></th>
                                    <input type="hidden" name="barangay_id" value="<?= $row['barangay_id']; ?>">
                                    <td>
                                        <!-- municipality name -->
                                        <a href=""><?= $row['municipality_name']; ?></a>
                                    </td>
                                    <!-- barangay -->
                                    <td class="small-font">
                                        <h6 class="text-secondary small-font m-0"><?= $row['barangay_name']; ?></h6>
                                    </td>
                                    <!-- Action -->
                                    <form action="">
                                        <td>
                                            <input type="hidden" name="email" value="<?php echo $row['barangay_id']; ?>" />
                                            <input type="submit" name="edit" value="edit">
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
                <!-- Pagination container for Barangay -->
                <div class="pagination-container barangay-pagination-container" id="barangayPaginationContainer">
                    <?php
                    generatePaginationLinksTabs($total_pages_barangay, $current_page, 'page_barangay', 'barangayTabData', 'barangay');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- script -->
<!-- tabs script -->
<script>
    // JavaScript for tab switching
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


            // Update URL with tab parameter
            const tabName = tab.getAttribute('id');
            const url = new URL(window.location.href);
            url.searchParams.set('tab', tabName);
            history.replaceState(null, null, url);
        })
    })

    // for preventing the default action of pagination which is refreshing the page
    // this sets it to load the content of the selected page number without the page
    const paginationContainer = document.getElementById('paginationContainer');

    if (paginationContainer) {
        paginationContainer.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default link behavior
            if (e.target.tagName === 'A') {
                const url = e.target.getAttribute('href');
                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        // Assuming each tab has a container with id "tabContent"
                        const tabContent = document.getElementById('tabContent');
                        tabContent.innerHTML = data; // Update tab content with loaded data
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    }
</script>