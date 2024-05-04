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
            // Set the number of items to display per page
            $items_per_page = 10;

            // Get the current page number
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calculate the offset based on the current page and items per page
            $offset = ($current_page - 1) * $items_per_page;

            // Count the total number of rows for pagination
            $total_rows_query = "SELECT COUNT(*) FROM crop left join status on status.status_id = crop.status_id left join category on category.category_id = crop.category_id where status.action = 'Approved' and category.category_name = 'Corn'";
            $total_rows_result = pg_query($conn, $total_rows_query);
            $total_rows = pg_fetch_row($total_rows_result)[0];

            // Calculate the total number of pages
            $total_pages = ceil($total_rows / $items_per_page);

            // Get the search query from the session or URL parameter
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            // Get the categories and municipalities filter from the URL
            $category_filter = !empty($_GET['categories']) ? "AND category.category_id IN (" . implode(',', explode(',', $_GET['categories'])) . ")" : '';
            $municipality_filter = !empty($_GET['municipalities']) ? "AND municipality_id IN (" . implode(',', explode(',', $_GET['municipalities'])) . ")" : '';
            $variety_filter = !empty($_GET['varieties']) ? "AND category_variety_id IN (" . implode(',', explode(',', $_GET['varieties'])) . ")" : '';
            $terrain_filter = !empty($_GET['terrains']) ? "AND terrain_id IN (" . implode(',', explode(',', $_GET['terrains'])) . ")" : '';
            $brgy_filter = !empty($_GET['barangay']) ? "AND barangay_id IN (" . implode(',', explode(',', $_GET['barangay'])) . ")" : '';
            $pest_filter = !empty($_GET['pest']) ? "AND pest_resistance_id IN (" . implode(',', explode(',', $_GET['pest'])) . ")" : '';
            $disease_filter = !empty($_GET['disease']) ? "AND disease_resistance_id IN (" . implode(',', explode(',', $_GET['disease'])) . ")" : '';
            $abiotic_filter = !empty($_GET['abiotic']) ? "AND abiotic_resistance_id IN (" . implode(',', explode(',', $_GET['abiotic'])) . ")" : '';

            $where_clause = '';
            // Build the WHERE clause if any filters are selected
            $search_condition = $search ? "AND crop_variety ILIKE '%$search%'" : '';

            // Build the WHERE clause if any filters or search condition are selected
            if (!empty($category_filter) || !empty($municipality_filter) || !empty($variety_filter) || !empty($terrain_filter) || !empty($brgy_filter) || !empty($pest_filter) || !empty($disease_filter) || !empty($abiotic_filter) || !empty($search) || !empty($search_condition)) {
                $where_clause = "WHERE status.action = 'Approved' AND category.category_name = 'Corn' $category_filter $municipality_filter $variety_filter $terrain_filter $brgy_filter $pest_filter $disease_filter $abiotic_filter $search_condition";
            }

            $query = "SELECT * from crop 
                LEFT JOIN crop_location ON crop_location.crop_id = crop.crop_id 
                LEFT JOIN status ON status.status_id = crop.status_id 
                LEFT JOIN category ON category.category_id = crop.category_id
                LEFT JOIN municipality on municipality.municipality_id = crop_location.municipality_id
                LEFT JOIN barangay on barangay.barangay_id = crop_location.barangay_id
                LEFT JOIN province on province.province_id = municipality.province_id
                LEFT JOIN terrain on terrain.terrain_id = crop.terrain_id
                $where_clause
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
                    // Replace "Corn" with "Corn"
                    if ($category_name === "Corn") {
                        $category_name = "Corn";

            ?>
                        <tr latlng="<?= $row['barangay_coordinates'] ?>" data-href="#">
                            <td class="category"><?= $row['category_name'] ?></td>
                            <td class="fw-bolder variety"><?= $row['crop_variety'] ?></td>
                            <td class="addr">
                                <span class="d-block text-truncate" style="max-width: 300px;">
                                    <?php
                                    $row['province_name'] . ", " . $row['municipality_name'] . ", " . $row['barangay_name']
                                    ?>
                                </span>
                            </td>
                            <td class="terrain"><span class="d-block text-truncate" style="max-width: 300px;"><?= $row['terrain_name'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
            <?php
                }
            }
            ?>

        </tbody>
    </table>
</div>