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

if (isset($_GET['check_variety']) && isset($_GET['check_variety_id'])) {
    $category_variety_name = $_GET['check_variety'];
    $category_id = $_GET['check_variety_id'];
    $arrayresult = [];

    // get variety name
    $get_name = "SELECT * FROM category_variety WHERE category_id = $1 AND category_variety_name = $2";
    $query_run = pg_prepare($conn, "get_name_query", $get_name);
    $query_run = pg_execute($conn, "get_name_query", array($category_id, $category_variety_name));

    if ($query_run) {
        if (pg_num_rows($query_run) > 0) {
            // Variety name exists
            $arrayresult['exists'] = true;
        } else {
            // Variety name does not exist
            $arrayresult['exists'] = false;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    } else {
        // Error occurred while executing the query
        http_response_code(500);
        echo json_encode(array('error' => 'Error executing query'));
    }
}