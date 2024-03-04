<?php
require "../../../functions/connections.php";

if (isset($_POST['approve'])) {
    $crop_id = $_POST['crop_id'];
    $select = "UPDATE crop SET status = 'approved' WHERE crop_id = '$crop_id' ";
    $result = pg_query($conn, $select);
    if ($result) {

        header("location: ../../approval.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {
        echo "Error updating record"; // Display an error message if the query fails
    }
}

if (isset($_POST['rejected'])) {
    $crop_id = $_POST['crop_id'];
    $select = "UPDATE crop SET status = 'rejected' WHERE crop_id = '$crop_id' ";
    $result = pg_query($conn, $select);
    if ($result) {

        header("location: ../../approval.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {
        echo "Error updating record"; // Display an error message if the query fails
    }
}