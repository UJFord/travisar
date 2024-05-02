<?php
session_start();
require "../../../functions/connections.php";

if (isset($_POST['save'])) {
    $province_names = [];
    $municipality_names = [];
    $coordinates = [];

    // Loop through the $_POST data to extract province, municipality names, and coordinates
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'province_name_') !== false) {
            $province_names[] = $value;
        } elseif (strpos($key, 'municipality_name_') !== false) {
            $municipality_names[] = $value;
        } elseif (strpos($key, 'coordinates_') !== false) {
            $coordinates[] = $value;
        }
    }

    // Ensure that the arrays have the same length
    if (count($province_names) === count($municipality_names) && count($province_names) === count($coordinates)) {
        $error_flag = false;

        // Check each pair of province, municipality names, and coordinates individually
        foreach ($province_names as $index => $province_name) {
            $municipality_name = $municipality_names[$index];
            $coordinate = $coordinates[$index];

            // Prepare the query to check if the data already exists
            $check_query = "SELECT COUNT(*) FROM municipality WHERE province_id = $1 AND municipality_name = $2 AND municipality_coordinates = $3";
            $check_params = [$province_name, $municipality_name, $coordinate];

            // Execute the check query
            $check_query_run = pg_query_params($conn, $check_query, $check_params);

            // Fetch the result
            $result = pg_fetch_assoc($check_query_run);

            // Check if the data already exists
            if ($result['count'] > 0) {
                $_SESSION['message'] = "Province, Municipality, and Coordinates '$municipality_name, $coordinate' pair already exists";
                $error_flag = true;
            }
        }

        if ($error_flag) {
            header("location: ../municipality.php");
            exit;
        }

        // Prepare the query for insertion
        $query = "INSERT INTO municipality (province_id, municipality_name, municipality_coordinates) VALUES ";
        $params = [];
        $valueStrings = [];

        // Generate placeholders and parameters for each pair of province, municipality names, and coordinates
        for ($i = 0; $i < count($province_names); $i++) {
            $valueStrings[] = "($" . ($i * 3 + 1) . ", $" . ($i * 3 + 2) . ", $" . ($i * 3 + 3) . ")";
            $params[] = $province_names[$i];
            $params[] = $municipality_names[$i];
            $params[] = $coordinates[$i];
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
        $_SESSION['message'] = "Number of province names, municipality names, and coordinates do not match";
        header("location: ../municipality.php");
        exit; // Ensure that the script stops executing after the redirect header
    }
}

if (isset($_POST['update'])) {
    $municipality_id = $_POST['municipality_id'];
    $province_id = $_POST['province_id'];
    $municipality_name = $_POST['municipality_name'];
    $municipality_coordinates = $_POST['municipality_coordinates'];

    $query = "UPDATE municipality set province_id = $1, municipality_name = $2, municipality_coordinates = $3 where municipality_id = $4";
    $query_run = pg_query_params($conn, $query, array($province_id, $municipality_name, $municipality_coordinates, $municipality_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $_SESSION['message'] = "municipality updated successfully";
            header("location: ../municipality.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            $_SESSION['message'] = "Failed to update municipality";
            header("location: ../municipality.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Municipality not found";
        header("location: ../municipality.php");
        exit;
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
