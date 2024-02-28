<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    $crop_id = $_POST["crop_id"];
    $arrayresult = [];

    // Fetch data from the crop table and join with crop_location
    $query = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id WHERE crop.crop_id = $1";
    $query_run = pg_query_params($conn, $query, array($crop_id));

    if (pg_num_rows($query_run) > 0) {
        while ($row = pg_fetch_assoc($query_run)) {
            $location_id = $row['location_id'];
            $user_id = $row['user_id'];

            // Get the data for location
            $query_loc = "SELECT * FROM location WHERE location_id = $1";
            $query_loc_run = pg_query_params($conn, $query_loc, array($location_id));

            if (pg_num_rows($query_loc_run) > 0) {
                $location_data = pg_fetch_assoc($query_loc_run);
                $row['location'] = $location_data;
            }

            // Get the data for users
            $query_users = "SELECT * FROM users WHERE user_id = $1";
            $query_users_run = pg_query_params($conn, $query_users, array($user_id));

            if (pg_num_rows($query_users_run) > 0) {
                $user_data = pg_fetch_assoc($query_users_run);
                $row['user'] = $user_data;
            }

            $arrayresult[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    } else {
        echo '<h4>No record found</h4>';
    }
}
