<div class="col-3">
    <div class="border rounded">
        <table id="crop-list-box" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
            <!-- header -->
            <thead>
                <tr class="">
                    <th scope="col" class="list-head col-4 small-font fw-semibold text-secondary">Category</th>
                    <th scope="col" class="list-head col-auto small-font fw-semibold text-secondary">Variety</th>
                </tr>
            </thead>
            <!-- crops -->
            <tbody id="crop-list-tbody">
                <?php
                // Get the search query from the session or URL parameter
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                // Get the categories and municipalities filter from the URL
                $category_filter = !empty($_GET['categories']) ? "AND category_id IN (" . implode(',', explode(',', $_GET['categories'])) . ")" : '';
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
                    $where_clause = "WHERE status.action = 'approved' $category_filter $municipality_filter $variety_filter $terrain_filter $brgy_filter $pest_filter $disease_filter $abiotic_filter $search_condition";
                }

                $query = "SELECT * from crop 
                LEFT JOIN crop_location ON crop_location.crop_id = crop.crop_id 
                LEFT JOIN status ON status.status_id = crop.status_id 
                LEFT JOIN category ON category.category_id = crop.category_id
                $where_clause";
                $query_run = pg_query($conn, $query);

                if ($query_run) {
                    while ($row = pg_fetch_assoc($query_run)) {
                        $category_name = $row['category_name'];
                        // Replace "Root Crop" with "Root"
                        if ($category_name === "Root Crop") {
                            $category_name = "Root";
                        }
                ?>
                        <tr class="" latlng="<?= $row['coordinates'] ?>" data-href="view-crop.php?<?= $row['crop_id'] ?>">
                            <td class="text-secondary category"><?= $category_name ?></td>
                            <td class="fw-bold overflow-x-auto variety"><?= $row['crop_variety'] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <!-- pagination -->
    <nav class="d-flex justify-content-end py-2" aria-label="">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link small-font text-dark fw-semibold btn-light" href="#" aria-label="Previous">
                    <span aria-hidden="true"><i class="fa-solid fa-arrow-left-long"></i></span>
                </a>
            </li>
            <li class="page-item"><a class="page-link small-font text-dark fw-semibold" href="#">1</a></li>
            <li class="page-item"><a class="page-link small-font text-dark fw-semibold" href="#">2</a></li>
            <li class="page-item"><a class="page-link small-font text-dark fw-semibold" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link small-font text-dark fw-semibold btn-light" href="#" aria-label="Next">
                    <span aria-hidden="true"><i class="fa-solid fa-arrow-right-long"></i></span>
                </a>
            </li>
        </ul>
    </nav>
</div>