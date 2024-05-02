<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['save']) && ($_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator')) {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {

        $category_id = $_POST['category_id'];
        $category_variety_name = $_POST['category_variety_name'];

        $query_getName = "SELECT category_variety_name from category_variety where category_variety_name = $1";
        $query_getName_run = pg_query_params($conn, $query_getName, array($category_variety_name));
        if ($query_getName_run) {
            // Fetch the result set
            $existing_category_variety = pg_fetch_assoc($query_getName_run);

            // Check if a category variety was fetched
            if ($existing_category_variety) {
                // Category variety exists
                $_SESSION['message'] = "Category Variety already exists.";
                pg_query($conn, "COMMIT");
                header("location: ../../category-variety.php");
                exit();
            } else {
                // Category variety does not exist, proceed with insertion
                $query = "INSERT into category_variety (category_id, category_variety_name) values($1, $2) returning category_variety_id";
                $query_run = pg_query_params($conn, $query, array($category_id, $category_variety_name));

                if ($query_run) {
                    $row_category = pg_fetch_row($query_run);
                    $category_variety_id = $row_category[0];
                } else {
                    echo "Error: " . pg_last_error($conn);
                    exit(0);
                }

                $_SESSION['message'] = "Category Variety created Successfully";
                pg_query($conn, "COMMIT");
                header("location: ../../category-variety.php");
                exit();
            }
        } else {
            // Error executing the query
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Category Variety not Created';
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
        $variety_name = $_POST['variety_nameEdit'];
        $category_id = $_POST['category_idEdit'];
        $variety_id = $_POST['variety_idEdit'];

        $query = "UPDATE category_variety set category_id = $1, category_variety_name = $2 where category_variety_id = $3";
        $query_run = pg_query_params($conn, $query, array($category_id, $variety_name, $variety_id));

        if ($query_run) {
            $row_category = pg_fetch_row($query_run);
            $category_id = $row_category[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        $_SESSION['message'] = "Category variety Updated Successfully";
        pg_query($conn, "COMMIT");
        header("location: ../../category-variety.php");
        exit();
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Category variety not Updated';
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
        $category_variety_id = $_POST['category_variety_id'];

        $query = "DELETE from category_variety where category_variety_id = $1";
        $query_run = pg_query_params($conn, $query, array($category_variety_id));

        if ($query_run) {
            $row_category = pg_fetch_row($query_run);
            $category_variety_id = $row_category[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        $_SESSION['message'] = "Category variety Deleted Successfully";
        pg_query($conn, "COMMIT");
        header("location: ../../category-variety.php");
        exit();
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Category variety not delete category';
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
