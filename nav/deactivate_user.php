<?php
require "../functions/connections.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = intval($_GET['notification_user_id']); // Ensure the ID is an integer

    if ($id) {
        $deactive = "UPDATE notification_user SET active=false WHERE notification_user_id=$id";

        $result = pg_query($conn, $deactive);

        if (!$result) {
            echo "Error updating record: " . pg_last_error($conn);
        } else {
            echo "success"; // Return success
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit; // Ensure script execution stops here
        }
    } else {
        echo "Invalid ID"; // Handle the case where ID is not valid
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit; // Ensure script execution stops here
    }

    pg_close($conn);
} else {
    echo "Invalid request method";
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit; // Ensure script execution stops here
}