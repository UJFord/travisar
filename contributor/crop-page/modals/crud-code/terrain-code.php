<?php
session_start();
require "../../../../functions/connections.php";

// var_dump($_POST);
// die();
if (isset($_POST['save']) && ($_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator')) {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $terrain_name = $_POST['terrain_name'];

        $query_getName = "SELECT terrain_name from terrain where terrain_name = $1";
        $query_getName_run = pg_query_params($conn, $query_getName, array($terrain_name));

        // Check if the query was successful
        if ($query_getName_run) {
            // Fetch the result set
            $existing_terrain = pg_fetch_assoc($query_getName_run);

            // Check if a terrain was fetched
            if ($existing_terrain) {
                // terrain exists
                $_SESSION['message'] = "terrain already exists.";
                pg_query($conn, "COMMIT");
                //header("location: ../../terrain.php");
                exit();
            } else {
                // terrain does not exist, proceed with insertion
                $query = "INSERT into terrain (terrain_name) values($1) returning terrain_id";
                $query_run = pg_query_params($conn, $query, array($terrain_name));

                if ($query_run) {
                    $_SESSION['message'] = "terrain created successfully.";
                    pg_query($conn, "COMMIT");
                    //var_dump($_SESSION);
                    //header("location: ../../terrain.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Failed to terrain.";
                    exit(0);
                }
            }
        } else {
            // Error executing the query
            $_SESSION['message'] = "Failed to find terrain.";
            exit(0);
        }
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Category not Created';
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

if (isset($_POST['edit']) && ($_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator')) {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $terrain_name = $_POST['terrain_nameEdit'];
        $terrain_id = $_POST['terrain_idEdit'];

        $query = "UPDATE terrain set terrain_name = $1 where terrain_id = $2";
        $query_run = pg_query_params($conn, $query, array($terrain_name, $terrain_id));

        if ($query_run) {
            $row_terrain = pg_fetch_row($query_run);
            $terrain_id = $row_terrain[0];
        } else {
            $_SESSION['message'] = "Failed to update terrain.";
            exit(0);
        }

        $_SESSION['message'] = "Terrain Updated Successfully";
        pg_query($conn, "COMMIT");
        // header("location: ../../terrain.php");
        exit();
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Terrain not Updated';
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

if (isset($_POST['delete']) && ($_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator')) {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $terrain_id = $_POST['terrain_id'];

        $query = "DELETE from terrain where terrain_id = $1";
        $query_run = pg_query_params($conn, $query, array($terrain_id));

        if ($query_run) {
            $_SESSION['message'] = "Terrain Deleted Successfully";
            pg_query($conn, "COMMIT");
            // header("location: ../../terrain.php");
            exit();
        } else {
            $_SESSION['message'] = "Failed to delete terrain.";
            exit(0);
        }
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Terrain not delete terrain';
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
