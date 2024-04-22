<?php
require "../../../functions/connections.php";

if (isset($_POST['save'])) {
    $province_names = [];

    // Loop through the $_POST data to extract province and municipality names
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'province_name_') !== false) {
            $province_names[] = $value;
        }
    }

    // Ensure that the arrays have the same length
    if (count($province_names) > 0) {
        // Prepare the query
        $query = "INSERT INTO province (province_name) VALUES ";
        $params = [];

        // Generate placeholders for each location
        $placeholders = [];
        for ($i = 0; $i < count($province_names); $i++) {
            $placeholders[] = "($" . ($i + 1) . ")";
            $params[] = $province_names[$i];
        }

        $query .= implode(",", $placeholders);

        // Execute the query with parameters
        $query_run = pg_query_params($conn, $query, $params);

        if ($query_run) {
            header("location: ../../province.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error updating record"; // Display an error message if the query fails
        }
    }
}

if (isset($_POST['update'])) {
    $location_id = $_POST['location_id'];
    $province_name = $_POST['province_name'];
    $municipality_name = $_POST['municipality_name'];

    $query = "UPDATE location set province_name = $1, municipality_name = $2 where location_id = $3";
    $query_run = pg_query_params($conn, $query, array($province_name, $municipality_name, $location_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            echo "Location updated successfully";
            header("location: ../../municipality.php");
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
    if (isset($_POST["province_id"])) {
        $province_id = $_POST["province_id"];
        $arrayresult = [];

        // Fetch data from the province table
        $query = "SELECT * FROM province WHERE province_id = $1";
        $query_run = pg_query_params($conn, $query, array($province_id));

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
        echo "province ID not set";
    }
}
