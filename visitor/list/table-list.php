<div id="crop-list-table" class="rounded border overflow-y-auto">
    <table class="table table-hover table-borderless bg-transparent m-0">
        <thead>
            <tr class="border-bottom">
                <th scope="col" class="col-1 small-font text-secondary">Category</th>
                <th scope="col" class="col-4 small-font text-secondary">Name</th>
                <th scope="col" class="col small-font text-secondary">Location</th>
                <th scope="col" class="col-1 small-font text-secondary">Terrain</th>
            </tr>
        </thead>
        <tbody id="crop-list-tbody" class="table-light">

            <?php
            // Get the category_id from the URL parameter
            $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

            // Check if the category_id is valid
            if ($category_id !== null && is_numeric($category_id)) {
                // Set the number of items to display per page
                $items_per_page = 10;

                // Get the current page number
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the offset based on the current page and items per page
                $offset = ($current_page - 1) * $items_per_page;

                // Count the total number of rows for pagination
                $total_rows_query = "SELECT COUNT(*) FROM crop 
                        LEFT JOIN status ON status.status_id = crop.status_id 
                        LEFT JOIN category on category.category_id = crop.category_id
                        WHERE status.action = 'Approved' AND crop.category_id = $category_id";
                $total_rows_result = pg_query($conn, $total_rows_query);
                $total_rows = pg_fetch_row($total_rows_result)[0];

                // Calculate the total number of pages
                $total_pages = ceil($total_rows / $items_per_page);

                // Get the search query from the session or URL parameter
                $search = isset($_GET['search']) ? $_GET['search'] : '';

                // Build the WHERE clause if any filters are selected
                $search_condition = $search ? "AND crop_variety ILIKE '%$search%'" : '';

                $where_clause = '';
                // Build the WHERE clause if any filters or search condition are selected
                if (!empty($search_condition)) {
                    $where_clause = "AND status.action = 'Approved' $search_condition";
                }

                $query = "SELECT * FROM crop 
                LEFT JOIN crop_location ON crop_location.crop_id = crop.crop_id 
                LEFT JOIN status ON status.status_id = crop.status_id 
                LEFT JOIN category ON category.category_id = crop.category_id
                LEFT JOIN municipality ON municipality.municipality_id = crop_location.municipality_id
                LEFT JOIN barangay ON barangay.barangay_id = crop_location.barangay_id
                LEFT JOIN province ON province.province_id = municipality.province_id
                LEFT JOIN terrain ON terrain.terrain_id = crop.terrain_id
                WHERE crop.category_id = $category_id $where_clause
                ORDER BY crop.crop_id DESC 
                LIMIT $items_per_page OFFSET $offset";
                $query_run = pg_query($conn, $query);

                if ($query_run) {
                    while ($row = pg_fetch_assoc($query_run)) {
                        // Convert the string to a DateTime object
                        $date = new DateTime($row['input_date']);
                        // Format the date to display up to the minute
                        $formatted_date = $date->format('Y-m-d H:i');

                        $category_name = $row['category_name'];
                        // Display different rows based on the category_id
                        if ($category_name == 'Corn') { // Example condition for category_id 1
            ?>
                            <tr latlng="<?= $row['barangay_coordinates'] ?>" data-href="view-crop.php?crop_id=<?= $row['crop_id'] ?>">
                                <td class="category"><?= $category_name ?></td>
                                <td class="fw-bolder variety"><?= $row['crop_variety'] ?></td>
                                <td class="addr">
                                    <span class="d-block text-truncate" style="max-width: 300px;">
                                        <?= $row['province_name'] . ", " . $row['municipality_name'] . ", " . $row['barangay_name'] ?>
                                    </span>
                                </td>
                                <td class="terrain"><span class="d-block text-truncate" style="max-width: 300px;"><?= $row['terrain_name'] ?></td>
                            </tr>
                        <?php
                        } elseif ($category_name == 'Rice') { // Example condition for category_id 2
                        ?>
                            <tr latlng="<?= $row['barangay_coordinates'] ?>" data-href="view-crop.php?crop_id=<?= $row['crop_id'] ?>">
                                <td class="category"><?= $category_name ?></td>
                                <td class="fw-bolder variety"><?= $row['crop_variety'] ?></td>
                                <td class="addr">
                                    <span class="d-block text-truncate" style="max-width: 300px;">
                                        <?= $row['province_name'] . ", " . $row['municipality_name'] . ", " . $row['barangay_name'] ?>
                                    </span>
                                </td>
                                <td class="terrain"><span class="d-block text-truncate" style="max-width: 300px;"><?= $row['terrain_name'] ?></td>
                            </tr>
                        <?php
                        } elseif ($category_name == 'Root Crop') { // Example condition for category_id 2
                        ?>
                            <tr latlng="<?= $row['barangay_coordinates'] ?>" data-href="view-crop.php?crop_id=<?= $row['crop_id'] ?>">
                                <td class="category"><?= $category_name ?></td>
                                <td class="fw-bolder variety"><?= $row['crop_variety'] ?></td>
                                <td class="addr">
                                    <span class="d-block text-truncate" style="max-width: 300px;">
                                        <?= $row['province_name'] . ", " . $row['municipality_name'] . ", " . $row['barangay_name'] ?>
                                    </span>
                                </td>
                                <td class="terrain"><span class="d-block text-truncate" style="max-width: 300px;"><?= $row['terrain_name'] ?></td>
                            </tr>
            <?php
                        } // Add more conditions for other category_ids if needed
                    }
                }
            }
            ?>


        </tbody>
    </table>
</div>