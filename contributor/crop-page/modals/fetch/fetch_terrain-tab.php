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
