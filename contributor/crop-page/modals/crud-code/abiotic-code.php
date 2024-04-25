<?php
require "../../../../functions/connections.php";

if (isset($_POST['save'])) {
    $abiotic_name = [];

    // Loop through the $_POST data to extract pest names
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'abiotic_name_') !== false) {
            $abiotic_name[] = $value;
        }
    }

    // Prepare the query
    $query = "INSERT INTO abiotic_resistance (abiotic_name) VALUES ";
    $params = [];
    $valueStrings = [];

    // Generate placeholders and parameters for each pest name
    for ($i = 0; $i < count($abiotic_name); $i++) {
        $valueStrings[] = "($" . ($i + 1) . ")";
        $params[] = $abiotic_name[$i];
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
}

if (isset($_POST['edit'])) {
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

// var_dump($_POST);
// die();
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
