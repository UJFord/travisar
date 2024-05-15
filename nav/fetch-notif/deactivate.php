<?php
require "../../functions/connections.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); // Ensure the ID is an integer

    if ($id) {
        $deactive = "UPDATE notification SET active=false WHERE notification_id=$id";

        $result = pg_query($conn, $deactive);

        if (!$result) {
            echo "Error updating record: " . pg_last_error($conn);
        } else {
            echo "success"; // Return success
        }
    } else {
        echo "Invalid ID"; // Handle the case where ID is not valid
    }

    pg_close($conn);
} else {
    echo "Invalid request method";
}