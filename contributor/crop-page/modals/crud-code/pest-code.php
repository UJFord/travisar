<?php
session_start();
require "../../../../functions/connections.php";

// var_dump($_POST);
// die();
if (isset($_POST['save'])) {
    $pest_names = [];

    // Loop through the $_POST data to extract pest names
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'pest_name_') !== false) {
            $pest_names[] = $value;
        }
    }

    // Check if pest_names array is not empty
    if (!empty($pest_names)) {
        $error_flag = false;

        // Check each pest name individually
        foreach ($pest_names as $pest_name) {
            // Prepare the query to check if the data already exists
            $check_query = "SELECT COUNT(*) FROM pest_resistance WHERE pest_name = $1";
            $check_params = [$pest_name];

            // Execute the check query
            $check_query_run = pg_query_params($conn, $check_query, $check_params);

            // Fetch the result
            $result = pg_fetch_assoc($check_query_run);

            // Check if the data already exists
            if ($result['count'] > 0) {
                $_SESSION['message'] = "Pest '$pest_name' already exists";
                $error_flag = true;
            }
        }

        if ($error_flag) {
            //header("location: ../../pest-resistance.php");
            exit;
        }

        // Prepare the query for insertion
        $query = "INSERT INTO pest_resistance (pest_name) VALUES ";
        $params = [];
        $valueStrings = [];

        // Generate placeholders and parameters for each pest name
        for ($i = 0; $i < count($pest_names); $i++) {
            $valueStrings[] = "($" . ($i + 1) . ")";
            $params[] = $pest_names[$i];
        }

        $query .= implode(", ", $valueStrings);

        // Execute the query with parameters
        $query_run = pg_query_params($conn, $query, $params);

        if ($query_run) {
            $_SESSION['message'] = "Pest created successfully";
            //header("location: ../../pest-resistance.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error updating record"; // Display an error message if the query fails
        }
    } else {
        echo "Error: No pest names provided";
    }
}

if (isset($_POST['edit'])) {
    $pest_resistance_id = $_POST['pest_idEdit'];
    $pest_name = $_POST['pest_nameEdit'];
    $query = "UPDATE pest_resistance set pest_name = $1 where pest_resistance_id = $2";
    $query_run = pg_query_params($conn, $query, array($pest_name, $pest_resistance_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $_SESSION['message'] = "Pest Resistance updated successfully";
            header("location: ../../pest-resistance.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error: Location ID not found";
            exit(0);
        }
    } else {
        echo "Error: " . pg_last_error($conn);
        exit(0);
    }
}

// var_dump($_POST);
// die();
if (isset($_POST['delete']) && ($_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator')) {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $pest_resistance_id = $_POST['pest_idEdit'];

        $query = "DELETE FROM pest_resistance WHERE pest_resistance_id = $1";
        $query_run = pg_query_params($conn, $query, array($pest_resistance_id));

        if ($query_run) {
            $_SESSION['message'] = "Pest Deleted Successfully";
            pg_query($conn, "COMMIT");
            //header("location: ../../pest-resistance.php");
            exit();
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Pest not deleted';
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
