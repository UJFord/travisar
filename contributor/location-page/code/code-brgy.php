<?php
require "../../../functions/connections.php";

if (isset($_POST['save'])) {
    $municipality_name = [];
    $barangay_name = [];

    // Loop through the $_POST data to extract province and municipality names
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'municipality_name_') !== false) {
            $municipality_name[] = $value;
        } elseif (strpos($key, 'barangay_name_') !== false) {
            $barangay_name[] = $value;
        }
    }

    // Ensure that the arrays have the same length
    if (count($municipality_name) === count($barangay_name)) {
        // Prepare the query
        $query = "INSERT INTO barangay (municipality_name, barangay_name) VALUES ";
        $params = [];
        $valueStrings = [];

        // Generate placeholders and parameters for each location
        for ($i = 0; $i < count($municipality_name); $i++) {
            $valueStrings[] = "($" . ($i * 2 + 1) . ", $" . ($i * 2 + 2) . ")";
            $params[] = $municipality_name[$i];
            $params[] = $barangay_name[$i];
        }

        $query .= implode(", ", $valueStrings);

        // Execute the query with parameters
        $query_run = pg_query_params($conn, $query, $params);

        if ($query_run) {
            header("location: ../../location.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error updating record"; // Display an error message if the query fails
        }
    } else {
        echo "Error: Number of province names and municipality names do not match";
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
