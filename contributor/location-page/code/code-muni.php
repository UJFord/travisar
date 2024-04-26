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
        $query = "INSERT INTO municipality (province_id, municipality_name) VALUES ";
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
            $_SESSION['message'] = "Municipality created successfully";
            header("location: ../municipality.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error updating record"; // Display an error message if the query fails
        }
    } else {
        echo "Error: Number of province names and municipality names do not match";
    }
}

if (isset($_POST['update'])) {
    $municipality_id = $_POST['municipality_id'];
    $province_id = $_POST['province_id'];
    $municipality_name = $_POST['municipality_name'];

    $query = "UPDATE municipality set province_id = $1, municipality_name = $2 where municipality_id = $3";
    $query_run = pg_query_params($conn, $query, array($province_id, $municipality_name, $municipality_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $_SESSION['message'] = "municipality updated successfully";
            header("location: ../municipality.php");
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

if (isset($_POST['click_edit_btn'])) {
    if (isset($_POST["municipality_id"])) {
        $municipality_id = $_POST["municipality_id"];
        $arrayresult = [];

        // Fetch data from the location table
        $query = "SELECT * FROM municipality left join province on province.province_id = municipality.province_id WHERE municipality.municipality_id = $1";
        $query_run = pg_query_params($conn, $query, array($municipality_id));

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
        echo "Location ID not set";
    }
}
