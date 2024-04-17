<?php
session_start();
require "../../../functions/connections.php";

if (isset($_POST['click_view_btn'])) {
    $user_id = $_POST["user_id"];
    $arrayresult = [];

    // Fetch data from the crop table and join with crop_location
    $query = "SELECT u.*, c.* FROM users u left join crop c on u.user_id = c.user_id where u.user_id = $1";
    $query_run = pg_query_params($conn, $query, array($user_id));

    if (pg_num_rows($query_run) > 0) {
        while ($row = pg_fetch_assoc($query_run)) {
            $arrayresult[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    } else {
        http_response_code(404); // Set HTTP response code to indicate not found
        echo json_encode(array('message' => 'No records found'));
    }
}
