<?php
session_start();
require "../functions/connections.php"; // Ensure this path is correct
define('BASE_URL', 'http://localhost/travisar');

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
            echo "success";
            if (isset($_SESSION['rank']) && $_SESSION['rank'] === 'Contributor') {
                header('Location: ' . BASE_URL . '/contributor/submission-page/submission.php');
            } elseif (isset($_SESSION['rank']) && ($_SESSION['rank'] === 'Admin' || $_SESSION['rank'] === 'Curator')) {
                header('Location: ' . BASE_URL . '/contributor/crop-page/crop.php');
            }
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