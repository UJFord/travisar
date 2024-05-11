<?php
session_start();
require "../../../functions/connections.php";

// var_dump($_POST);
// die();
if (isset($_POST['save'])) {
    $municipality_names = [];
    $barangay_names = [];
    $barangay_coordinates = [];

    // Loop through the $_POST data to extract municipality, barangay names, and coordinates
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'municipality_name_') !== false) {
            $municipality_names[] = $value;
        } elseif (strpos($key, 'barangay_name_') !== false) {
            $barangay_names[] = $value;
        } elseif (strpos($key, 'barangay_coordinates_') !== false) {
            $barangay_coordinates[] = $value;
        }
    }

    // Ensure that the arrays have the same length
    if (count($municipality_names) === count($barangay_names) && count($municipality_names) === count($barangay_coordinates)) {
        $error_flag = false;

        // Check each pair of municipality, barangay names, and coordinates individually
        foreach ($municipality_names as $index => $municipality_name) {
            $barangay_name = $barangay_names[$index];
            $barangay_coordinate = $barangay_coordinates[$index];

            // Prepare the query to check if the data already exists
            $check_query = "SELECT COUNT(*) FROM barangay WHERE municipality_id = $1 AND barangay_name = $2";
            $check_params = [$municipality_name, $barangay_name];

            // Execute the check query
            $check_query_run = pg_query_params($conn, $check_query, $check_params);

            // Fetch the result
            $result = pg_fetch_assoc($check_query_run);

            // Check if the data already exists
            if ($result['count'] > 0) {
                $_SESSION['message'] = "Municipality and Barangay '$barangay_name' pair already exists";
                $error_flag = true;
            }
        }

        if ($error_flag) {
            //header("location: ../barangay.php");
            exit;
        }

        // Prepare the query for insertion
        $query = "INSERT INTO barangay (municipality_id, barangay_name, barangay_coordinates) VALUES ";
        $params = [];
        $valueStrings = [];

        // Generate placeholders and parameters for each pair of municipality, barangay names, and coordinates
        for ($i = 0; $i < count($municipality_names); $i++) {
            $valueStrings[] = "($" . ($i * 3 + 1) . ", $" . ($i * 3 + 2) . ", $" . ($i * 3 + 3) . ")";
            $params[] = $municipality_names[$i];
            $params[] = $barangay_names[$i];
            $params[] = $barangay_coordinates[$i];
        }

        $query .= implode(", ", $valueStrings);

        // Execute the query with parameters
        $query_run = pg_query_params($conn, $query, $params);

        if ($query_run) {
            $_SESSION['message'] = "Barangay created successfully.";
            //header("location: ../barangay.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error updating record"; // Display an error message if the query fails
        }
    } else {
        echo "Error: Number of municipality names, barangay names, and coordinates do not match";
    }
}

if (isset($_POST['update'])) {
    // var_dump($_POST);
    // die();
    $barangay_id = $_POST['barangay_id'];
    $municipality_id = $_POST['municipality_id'];
    $barangay_name = $_POST['barangay_name'];
    $barangay_coordinates = $_POST['coordinates'];

    $query = "UPDATE barangay set municipality_id = $1, barangay_name = $2, barangay_coordinates = $3 where barangay_id = $4";
    $query_run = pg_query_params($conn, $query, array($municipality_id, $barangay_name, $barangay_coordinates, $barangay_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $_SESSION['message'] = "Barangay updated successfully.";
            //header("location: ../barangay.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            $_SESSION['message'] = "Failed to update Barangay.";
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Barangay not found.";
        echo "Error: " . pg_last_error($conn);
        exit(0);
    }
}


if (isset($_GET['check_barangay'])) {
    $barangay_name = $_GET['check_barangay'];
    $arrayresult = [];

    // get variety name
    $get_name = "SELECT * FROM barangay WHERE barangay_name = $1";
    $query_run = pg_prepare($conn, "get_name_query", $get_name);
    $query_run = pg_execute($conn, "get_name_query", array($barangay_name));

    if ($query_run) {
        if (pg_num_rows($query_run) > 0) {
            // Variety name exists
            $arrayresult['exists'] = true;
        } else {
            // Variety name does not exist
            $arrayresult['exists'] = false;
        }

        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    } else {
        // Error occurred while executing the query
        http_response_code(500);
        echo json_encode(array('error' => 'Error executing query'));
    }
}
