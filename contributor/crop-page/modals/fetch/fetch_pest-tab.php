<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    $pest_resistance_id = $_POST["pest_resistance_id"];
    $arrayresult = [];

    // get category name
    $get_name = "SELECT * FROM pest_resistance where pest_resistance_id = $1";
    $query_run = pg_query_params($conn, $get_name, array($pest_resistance_id));

    if (pg_num_rows($query_run) > 0) {
        while ($row = pg_fetch_assoc($query_run)) {
            $arrayresult[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    }
}

if (isset($_GET['check_pest'])) {
    $pest_name = $_GET['check_pest'];
    $arrayresult = [];

    // get pest name
    $get_name = "SELECT * FROM pest_resistance WHERE pest_name = $1";
    $query_run = pg_query_params($conn, $get_name, array($pest_name));

    if ($query_run) {
        if (pg_num_rows($query_run) > 0) {
            // Disease name exists
            $arrayresult['exists'] = true;
        } else {
            // Disease name does not exist
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