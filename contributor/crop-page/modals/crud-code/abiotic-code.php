<?php
session_start();
require "../../../../functions/connections.php";
// var_dump($_POST);
// die();
if (isset($_POST['save']) && ($_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator')) {
    $abiotic_names = [];

    // Loop through the $_POST data to extract abiotic names
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'abiotic_name_') !== false) {
            $abiotic_names[] = $value;
        }
    }

    // Check if abiotic_names array is not empty
    if (!empty($abiotic_names)) {
        $error_flag = false;

        // Check each abiotic name individually
        foreach ($abiotic_names as $abiotic_name) {
            // Prepare the query to check if the data already exists
            $check_query = "SELECT COUNT(*) FROM abiotic_resistance WHERE abiotic_name = $1";
            $check_params = [$abiotic_name];

            // Execute the check query
            $check_query_run = pg_query_params($conn, $check_query, $check_params);

            // Fetch the result
            $result = pg_fetch_assoc($check_query_run);

            // Check if the data already exists
            if ($result['count'] > 0) {
                $_SESSION['message'] = "Abiotic '$abiotic_name' already exists";
                $error_flag = true;
            }
        }

        if ($error_flag) {
            header("location: ../../abiotic-resistance.php");
            exit;
        }

        // Prepare the query for insertion
        $query = "INSERT INTO abiotic_resistance (abiotic_name) VALUES ";
        $params = [];
        $valueStrings = [];

        // Generate placeholders and parameters for each abiotic name
        for ($i = 0; $i < count($abiotic_names); $i++) {
            $valueStrings[] = "($" . ($i + 1) . ")";
            $params[] = $abiotic_names[$i];
        }

        $query .= implode(", ", $valueStrings);

        // Execute the query with parameters
        $query_run = pg_query_params($conn, $query, $params);

        if ($query_run) {
            $_SESSION['message'] = "Abiotic created successfully";
            header("location: ../../abiotic-resistance.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error updating record"; // Display an error message if the query fails
        }
    } else {
        echo "Error: No abiotic names provided";
    }
}


if (isset($_POST['delete']) && $_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator') {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $abiotic_resistance_id = $_POST['abiotic_resistance_id'];

        $query = "DELETE FROM abiotic_resistance WHERE abiotic_resistance_id = $1";
        $query_run = pg_query_params($conn, $query, array($abiotic_resistance_id));

        if ($query_run) {
            $_SESSION['message'] = "Abiotic Deleted Successfully";
            pg_query($conn, "COMMIT");
            header("location: ../../abiotic-resistance.php");
            exit();
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Abiotic not deleted';
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

if (isset($_POST['edit']) && $_SESSION['rank'] == 'Admin' || $_SESSION['rank'] == 'Curator') {
    $abiotic_resistance_id = $_POST['abiotic_idEdit'];
    $abiotic_name = $_POST['abiotic_nameEdit'];
    $query = "UPDATE abiotic_resistance set abiotic_name = $1 where abiotic_resistance_id = $2";
    $query_run = pg_query_params($conn, $query, array($abiotic_name, $abiotic_resistance_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $_SESSION['message'] = "Abiotic Resistance updated successfully";
            header("location: ../../abiotic-resistance.php");
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
