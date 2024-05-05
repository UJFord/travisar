<?php
session_start();
require "../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    if (isset($_POST["municipality_id"])) {
        $municipality_id = $_POST["municipality_id"];
        $arrayresult = [];

        // Fetch data from the location table
        $query = "SELECT * FROM municipality left join province on province.province_id = municipality.province_id WHERE municipality.municipality_id = $1";
        $query_run = pg_query_params($conn, $query, array($municipality_id));

        if (pg_num_rows($query_run) > 0) {
            while ($row = pg_fetch_assoc($query_run)) {

                $arrayresult[] = $row;
            }

            header('Content-Type: application/json');
            echo json_encode($arrayresult);
        } else {
            echo '<h4>No record found</h4>';
        }
    } else {
        echo "Location ID not set";
    }
}
