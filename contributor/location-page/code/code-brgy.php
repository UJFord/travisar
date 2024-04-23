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
            header("location: ../barangay.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error updating record"; // Display an error message if the query fails
        }
    } else {
        echo "Error: Number of province names and municipality names do not match";
    }
}

if (isset($_POST['update'])) {
    $barangay_id = $_POST['barangay_id'];
    $barangay_name = $_POST['barangay_name'];

    $query = "UPDATE barangay set barangay_name = $1 where barangay_id = $2";
    $query_run = pg_query_params($conn, $query, array($barangay_name, $barangay_id));

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
        $query = "SELECT * FROM barangay WHERE barangay_id = $1";
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