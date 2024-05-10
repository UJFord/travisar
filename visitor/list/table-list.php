<div id="crop-list-table" class="rounded border overflow-y-auto">
    <table class="table table-hover table-borderless bg-transparent m-0">
        <thead>
            <tr class="border-bottom">
                <th scope="col" class="col-1 small-font text-secondary">Category</th>
                <th scope="col" class="col-2 small-font text-secondary">Name</th>
                <th scope="col" class="col-2 small-font text-secondary">Sitio</th>
                <th scope="col" class="col-2 small-font text-secondary">Barangay</th>
                <th scope="col" class="col-2 small-font text-secondary">Municipality</th>
                <th scope="col" class="col-1 small-font text-secondary">Terrain</th>
            </tr>
        </thead>
        <tbody id="crop-list-tbody" class="table-light">

            <?php
            // Get the category_id from the URL parameter
            $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

            // Check if the category_id is valid
            // Set the number of items to display per page
            $items_per_page = 10;

            // Get the current page number
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calculate the offset based on the current page and items per page
            $offset = ($current_page - 1) * $items_per_page;

            // Count the total number of rows for pagination
            $total_rows_query = "SELECT COUNT(*) FROM crop LEFT JOIN status ON status.status_id = crop.status_id WHERE status.action = 'Approved'";
            $total_rows_result = pg_query($conn, $total_rows_query);
            $total_rows = pg_fetch_row($total_rows_result)[0];

            // Calculate the total number of pages
            $total_pages = ceil($total_rows / $items_per_page);
    
            // Build the WHERE clause for the SQL query
            $where_clause = '';

            // If category_id is not empty, add it to the WHERE clause
            if (!empty($category_id)) {
                $where_clause .= " AND crop.category_id = $category_id";
            } else { // If category_id is empty or null, select all crops
                $where_clause .= " AND status.action = 'Approved'";
            }

            // Get the search query from the session or URL parameter
            $search = isset($_GET['search']) ? $_GET['search'] : '';

            // Build the search condition
            $search_condition = $search ? " AND crop_variety ILIKE '%$search%'" : '';

            // Add the search condition to the WHERE clause
            $where_clause .= $search_condition;

            // Get the categories and municipalities filter from the URL
            $category_filter = !empty($_GET['categories']) ? "AND category.category_id IN (" . implode(',', explode(',', $_GET['categories'])) . ")" : '';
            $municipality_filter = !empty($_GET['municipalities']) ? "AND municipality.municipality_id IN (" . implode(',', explode(',', $_GET['municipalities'])) . ")" : '';
            $variety_filter = !empty($_GET['varieties']) ? "AND category_variety_id IN (" . implode(',', explode(',', $_GET['varieties'])) . ")" : '';
            $terrain_filter = !empty($_GET['terrains']) ? "AND crop.terrain_id IN (" . implode(',', explode(',', $_GET['terrains'])) . ")" : '';
            $brgy_filter = !empty($_GET['barangay']) ? "AND barangay.barangay_id IN (" . implode(',', explode(',', $_GET['barangay'])) . ")" : '';

            // Add all filters to the WHERE clause
            $where_clause .= " $category_filter $municipality_filter $variety_filter $terrain_filter $brgy_filter";

            // Build the SQL query
            $query = "SELECT * FROM crop 
            LEFT JOIN crop_location ON crop_location.crop_id = crop.crop_id 
            LEFT JOIN status ON status.status_id = crop.status_id 
            LEFT JOIN category ON category.category_id = crop.category_id
            LEFT JOIN municipality ON municipality.municipality_id = crop_location.municipality_id
            LEFT JOIN barangay ON barangay.barangay_id = crop_location.barangay_id
            LEFT JOIN province ON province.province_id = municipality.province_id
            LEFT JOIN terrain ON terrain.terrain_id = crop.terrain_id
            WHERE 1=1 $where_clause
            ORDER BY crop.crop_id DESC 
            LIMIT $items_per_page OFFSET $offset";

            // Execute the SQL query
            $query_run = pg_query($conn, $query);

            if ($query_run) {
                while ($row = pg_fetch_assoc($query_run)) {
                    // Convert the string to a DateTime object
                    $date = new DateTime($row['input_date']);
                    // Format the date to display up to the minute
                    $formatted_date = $date->format('Y-m-d H:i');

                    // Display the data
            ?>
                    <tr class="crop-li" latlng="<?= $row['barangay_coordinates'] ?>" data-href="view.php?crop_id=<?= $row['crop_id'] ?>">
                        <td class="category text-truncate" style="max-width:5rem;"><?= $row['category_name'] ?></td>
                        <td class="fw-bolder variety text-truncate" style="max-width 10rem;"><?= $row['crop_variety'] ?></td>
                        <td class="text-truncate" style="max-width: 10rem;"><?= $row['sitio_name'] ?></td>
                        <td class="text-truncate" style="max-width: 5rem;"><?= $row['barangay_name'] ?></td>
                        <td class="addr text-truncate" style="max-width: 5rem;"><?= $row['municipality_name'] ?></td>
                        <td class="terrain text-truncate" style="max-width: 5rem;"><span class="text-truncate" style="max-width: 300px;"><?= $row['terrain_name'] ?></td>
                    </tr>
            <?php
                }
            }

            ?>
        </tbody>
    </table>
</div>