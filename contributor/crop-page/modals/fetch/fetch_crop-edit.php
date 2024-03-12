<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    $crop_id = $_POST["crop_id"];
    $arrayresult = [];

    // Fetch data from the crop table and join with crop_location
    $query = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join location 
    on crop_location.location_id = location.location_id left join users on crop.user_id = users.user_id left join barangay
    on crop_location.barangay_id = barangay.barangay_id left join crop_field on crop_field.crop_id = crop.crop_id
    left join other_category on other_category.crop_id = crop.crop_id left join category on category.category_id = crop.category_id
    left join cultural_aspect on cultural_aspect.cultural_aspect_id = crop.cultural_aspect_id
    left join characteristics on characteristics.crop_id = crop.crop_id left join field on crop_field.field_id = field.field_id
    WHERE crop.crop_id = $1";
    $query_run = pg_query_params($conn, $query, array($crop_id));

    if (pg_num_rows($query_run) > 0) {
        while ($row = pg_fetch_assoc($query_run)) {

            $arrayresult[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    } else {
        echo '<h4>No record found</h4>';
    }
}
