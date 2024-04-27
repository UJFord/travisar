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
                $query = "SELECT * from crop left join crop_location on crop_location.crop_id = crop.crop_id 
                left join status on status.status_id = crop.status_id left join category on category.category_id = crop.category_id
                where status.action = 'approved'";
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