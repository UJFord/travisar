<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    $disease_resistance_id = $_POST["disease_resistance_id"];
    $arrayresult = [];

    // get category name
    $get_name = "SELECT * FROM disease_resistance where disease_resistance_id = $1";
    $query_run = pg_query_params($conn, $get_name, array($disease_resistance_id));

    if (pg_num_rows($query_run) > 0) {
        while ($row = pg_fetch_assoc($query_run)) {
            $arrayresult[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    }
}
