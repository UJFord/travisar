<?php
require "../../../functions/connections.php";

if (isset($_POST['save'])) {
    $province_names = [];
    $municipality_names = [];

    // Loop through the $_POST data to extract province and municipality names
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'province_name_') !== false) {
            $province_names[] = $value;
        } elseif (strpos($key, 'municipality_name_') !== false) {
            $municipality_names[] = $value;
        }
    }

    // Ensure that the arrays have the same length
    if (count($province_names) === count($municipality_names)) {
        // Prepare the query
        $query = "INSERT INTO location (province_name, municipality_name) VALUES ";
        $params = [];
        $valueStrings = [];

        // Generate placeholders and parameters for each location
        for ($i = 0; $i < count($province_names); $i++) {
            $valueStrings[] = "($" . ($i * 2 + 1) . ", $" . ($i * 2 + 2) . ")";
            $params[] = $province_names[$i];
            $params[] = $municipality_names[$i];
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
