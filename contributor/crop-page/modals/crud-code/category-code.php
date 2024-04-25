<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['edit']) && ($_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator')) {

    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $category_name = $_POST['category_nameEdit'];
        $category_id = $_POST['category_idEdit'];

        $query = "UPDATE category set category_name = $1 where category_id = $2";
        $query_run = pg_query_params($conn, $query, array($category_name, $category_id));

        if ($query_run) {
            $row_category = pg_fetch_row($query_run);
            $category_id = $row_category[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        $_SESSION['message'] = "Category Updated Successfully";
        pg_query($conn, "COMMIT");
        header("location: ../../crop-category.php");
        exit();
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Category not Updated';
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

if (isset($_POST['save']) && ($_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator')) {

    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {

        $category_name = $_POST['category_name'];

        $query = "INSERT into category (category_name) values($1) returning category_id";
        $query_run = pg_query_params($conn, $query, array($category_name));

        if ($query_run) {
            $row_category = pg_fetch_row($query_run);
            $category_id = $row_category[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        $_SESSION['message'] = "Category created Successfully";
        pg_query($conn, "COMMIT");
        header("location: ../../crop-category.php");
        exit();
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

if (isset($_POST['delete']) && ($_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator')) {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $category_id = $_POST['category_id'];

        $query = "DELETE from category where category_id = $1";
        $query_run = pg_query_params($conn, $query, array($category_id));

        if ($query_run) {
            $_SESSION['message'] = "Category Deleted Successfully";
            pg_query($conn, "COMMIT");
            header("location: ../../crop-category.php");
            exit();
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Category not delete category';
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
