<?php
session_start();
require "../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    if (isset($_POST["barangay_id"])) {
        $barangay_id = $_POST["barangay_id"];
        $arrayresult = [];

        // Fetch data from the barangay table
        $query = "SELECT * FROM barangay left join municipality on municipality.municipality_id = barangay.municipality_id WHERE barangay_id = $1";
        $query_run = pg_query_params($conn, $query, array($barangay_id));

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
        echo "barangay ID not set";
    }
}
