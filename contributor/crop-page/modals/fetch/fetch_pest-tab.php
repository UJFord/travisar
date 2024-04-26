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
