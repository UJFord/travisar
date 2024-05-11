<?php
session_start();
require "../../../functions/connections.php";

if (isset($_POST['delete_muni']) && $_SESSION['rank'] == 'Curator' || $_SESSION['rank'] == 'Admin') {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $municipality_id = $_POST['municipality_id'];

        // Delete from Crop table
        $query = "DELETE from municipality where municipality_id = $1";
        $query_run = pg_query_params($conn, $query, [$municipality_id]);
        if (!$query_run) {
            echo "Error: " . pg_last_error($conn);
            die();
        }

        // Commit the transaction if everything is successful
        $_SESSION['message'] = "Municipality Deleted Successfully";
        pg_query($conn, "COMMIT");
        header("Location: ../municipality.php");
        exit(0);
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'municipality not deleted';
        // Rollback the transaction if an error occurs
        pg_query($conn, "ROLLBACK");
        // Log the error message
        error_log("Error: " . $e->getMessage());
        // Handle the error
        echo "Error: " . $e->getMessage();
        // Display the error message
        echo "<script>document.getElementById('error-container').innerHTML = '" . $e->getMessage() . "';</script>";
        exit(0);
    }
}

if (isset($_POST['delete_brgy']) && $_SESSION['rank'] == 'Curator' || $_SESSION['rank'] == 'Admin') {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $barangay_id = $_POST['barangay_id'];

        // Delete from Crop table
        $query = "DELETE from barangay where barangay_id = $1";
        $query_run = pg_query_params($conn, $query, [$barangay_id]);
        if (!$query_run) {
            echo "Error: " . pg_last_error($conn);
            die();
        }

        // Commit the transaction if everything is successful
        $_SESSION['message'] = "Barangay Deleted Successfully";
        pg_query($conn, "COMMIT");
        header("Location: ../barangay.php");
        exit(0);
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Barangay not deleted';
        // Rollback the transaction if an error occurs
        pg_query($conn, "ROLLBACK");
        // Log the error message
        error_log("Error: " . $e->getMessage());
        // Handle the error
        echo "Error: " . $e->getMessage();
        // Display the error message
        echo "<script>document.getElementById('error-container').innerHTML = '" . $e->getMessage() . "';</script>";
        exit(0);
    }
}
