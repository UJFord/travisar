<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    $terrain_id = $_POST["terrain_id"];
    $arrayresult = [];

    // get terrain name
    $get_name = "SELECT * FROM terrain where terrain_id = $1";
    $query_run = pg_query_params($conn, $get_name, array($terrain_id));

    if (pg_num_rows($query_run) > 0) {
        while ($row = pg_fetch_assoc($query_run)) {
            $arrayresult[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    }
}

if (isset($_GET['check_terrain'])) {
    $terrain_name = $_GET['check_terrain'];
    $arrayresult = [];

    // get terrain name
    $get_name = "SELECT * FROM terrain WHERE terrain_name = $1";
    $query_run = pg_query_params($conn, $get_name, array($terrain_name));

    if ($query_run) {
        if (pg_num_rows($query_run) > 0) {
            // Terrain name exists
            $arrayresult['exists'] = true;
        } else {
            // Terrain name does not exist
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
