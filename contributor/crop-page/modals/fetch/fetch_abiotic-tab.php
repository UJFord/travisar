<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    $abiotic_resistance_id = $_POST["abiotic_resistance_id"];
    $arrayresult = [];

    // get category name
    $get_name = "SELECT * FROM abiotic_resistance where abiotic_resistance_id = $1";
    $query_run = pg_query_params($conn, $get_name, array($abiotic_resistance_id));

    if (pg_num_rows($query_run) > 0) {
        while ($row = pg_fetch_assoc($query_run)) {
            $arrayresult[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    }
}

if (isset($_GET['check_abiotic'])) {
    $abiotic_name = $_GET['check_abiotic'];
    $arrayresult = [];

    // get abiotic name
    $get_name = "SELECT * FROM abiotic_resistance WHERE abiotic_name = $1";
    $query_run = pg_query_params($conn, $get_name, array($abiotic_name));

    if ($query_run) {
        if (pg_num_rows($query_run) > 0) {
            // abiotic name exists
            $arrayresult['exists'] = true;
        } else {
            // abiotic name does not exist
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
