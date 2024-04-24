<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    $category_variety_id = $_POST["category_variety_id"];
    $arrayresult = [];

    // get category name
    $get_name = "SELECT * FROM category_variety left join category on category.category_id = category_variety.category_id 
    where category_variety_id = $1";
    $query_run = pg_query_params($conn, $get_name, array($category_variety_id));

    if (pg_num_rows($query_run) > 0) {
        while ($row = pg_fetch_assoc($query_run)) {
            $arrayresult[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    }
}
