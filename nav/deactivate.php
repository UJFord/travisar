<?php
require "../functions/connections.php"; // Ensure this path is correct

// var_dump($_GET);
// exit();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = intval($_GET['notification_id']); // Ensure the ID is an integer
    // var_dump($_GET);
    // exit();
    if ($id) {
        $deactive = "UPDATE notification SET active=false WHERE notification_id=$id";

        $result = pg_query($conn, $deactive);
        echo "here";
        if (!$result) {
            echo "Error updating record: " . pg_last_error($conn);
            error_log("Error updating record: " . pg_last_error($conn));
        } else {
            echo "succeess";
            // Operation was successful, redirect to previous page
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit; // Ensure script execution stops here
        }
    } else {
        echo "Invalid ID"; // Handle the case where ID is not valid
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    pg_close($conn);
} else {
    echo "Invalid request method";
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
