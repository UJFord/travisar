<?php
require "../../../../functions/connections.php";

if (isset($_POST['save'])) {
    $pest_name = [];

    // Loop through the $_POST data to extract pest names
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'pest_name') !== false) {
            $pest_name[] = $value;
        }
    }

    // Prepare the query
    $query = "INSERT INTO pest_resistance (pest_name) VALUES ";
    $params = [];
    $valueStrings = [];

    // Generate placeholders and parameters for each pest name
    for ($i = 0; $i < count($pest_name); $i++) {
        $valueStrings[] = "($" . ($i + 1) . ")";
        $params[] = $pest_name[$i];
    }

    $query .= implode(", ", $valueStrings);

    // Execute the query with parameters
    $query_run = pg_query_params($conn, $query, $params);

    if ($query_run) {
        $_SESSION['message'] = "Pest created successfully";
        header("location: ../../pest-resistance.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {
        echo "Error updating record"; // Display an error message if the query fails
    }
}

if (isset($_POST['edit'])) {
    $pest_resistance_id = $_POST['pest_idEdit'];
    $pest_name = $_POST['pest_nameEdit'];
    $query = "UPDATE pest_resistance set pest_name = $1 where pest_resistance_id = $2";
    $query_run = pg_query_params($conn, $query, array($pest_name, $pest_resistance_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $_SESSION['message'] = "Pest Resistance updated successfully";
            header("location: ../../pest-resistance.php");
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
