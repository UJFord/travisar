<?php
session_start();
require "../../../functions/connections.php";

if (isset($_POST['save'])) {
    $municipality_names = [];
    $barangay_names = [];

    // Loop through the $_POST data to extract municipality and barangay names
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'municipality_name_') !== false) {
            $municipality_names[] = $value;
        } elseif (strpos($key, 'barangay_name_') !== false) {
            $barangay_names[] = $value;
        }
    }

    // Ensure that the arrays have the same length
    if (count($municipality_names) === count($barangay_names)) {
        $error_flag = false;

        // Check each pair of municipality and barangay names individually
        foreach ($municipality_names as $index => $municipality_name) {
            $barangay_name = $barangay_names[$index];

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
            header("location: ../barangay.php");
            exit;
        }

        // Prepare the query for insertion
        $query = "INSERT INTO barangay (municipality_id, barangay_name) VALUES ";
        $params = [];
        $valueStrings = [];

        // Generate placeholders and parameters for each pair of municipality and barangay names
        for ($i = 0; $i < count($municipality_names); $i++) {
            $valueStrings[] = "($" . ($i * 2 + 1) . ", $" . ($i * 2 + 2) . ")";
            $params[] = $municipality_names[$i];
            $params[] = $barangay_names[$i];
        }

        $query .= implode(", ", $valueStrings);

        // Execute the query with parameters
        $query_run = pg_query_params($conn, $query, $params);

        if ($query_run) {
            header("location: ../barangay.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error updating record"; // Display an error message if the query fails
        }
    } else {
        echo "Error: Number of municipality names and barangay names do not match";
    }
}

if (isset($_POST['update'])) {
    $barangay_id = $_POST['barangay_id'];
    $municipality_id = $_POST['municipality_id'];
    $barangay_name = $_POST['barangay_name'];

    $query = "UPDATE barangay set municipality_id = $1, barangay_name = $2 where barangay_id = $3";
    $query_run = pg_query_params($conn, $query, array($municipality_id, $barangay_name, $barangay_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            echo "Barangay updated successfully";
            header("location: ../barangay.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error: Barangay ID not found";
            exit(0);
        }
    } else {
        echo "Error: " . pg_last_error($conn);
        exit(0);
    }
}

if (isset($_POST['click_edit_btn'])) {
    if (isset($_POST["barangay_id"])) {
        $barangay_id = $_POST["barangay_id"];
        $arrayresult = [];

        // Fetch data from the barangay table
        $query = "SELECT * FROM barangay left join municipality on municipality.municipality_id = barangay.municipality_id WHERE barangay_id = $1";
        $query_run = pg_query_params($conn, $query, array($barangay_id));

        if (pg_num_rows($query_run) > 0) {
            while ($row = pg_fetch_assoc($query_run)) {

                $arrayresult[] = $row;
            }

            header('Content-Type: application/json');
            echo json_encode($arrayresult);
        } else {
            echo '<h4>No record found</h4>';
        }
    } else {
        echo "barangay ID not set";
    }
}
