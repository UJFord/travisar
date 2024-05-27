<?php
header('Content-Type: application/json'); // Set content type before any output

require "../../../functions/connections.php";

// Check if the province parameter is set and not empty
if (isset($_GET['province']) && !empty($_GET['province'])) {
    $province_id = $_GET['province'];

    // Use prepared statements to prevent SQL injection
    $queryMunicipality = "SELECT DISTINCT municipality_name FROM location WHERE province_id = $1 ORDER BY municipality_name ASC";
    $resultMunicipality = pg_query_params($conn, $queryMunicipality, array($province_id));

    if ($resultMunicipality) {
        $municipalities = array();
        while ($row = pg_fetch_array($resultMunicipality, null, PGSQL_ASSOC)) {
            $municipalities[] = $row['municipality_name'];
        }

        // Return municipalities as JSON
        echo json_encode($municipalities);
    } else {
        // Handle database query error
        error_log("Error fetching municipalities: " . pg_last_error());
        echo json_encode(array()); // Return an empty array as JSON
    }
} elseif (isset($_GET['municipality']) && !empty($_GET['municipality'])) {
    $municipality_id = $_GET['municipality'];

    // Use prepared statements to prevent SQL injection
    $queryBarangay = "SELECT DISTINCT barangay_name, barangay_id FROM barangay WHERE municipality_id = $1 ORDER BY barangay_name ASC";
    $resultBarangay = pg_query_params($conn, $queryBarangay, array($municipality_id));

    if ($resultBarangay) {
        $barangay = array();
        while ($row = pg_fetch_assoc($resultBarangay)) {
            $barangay[] = $row;
        }

        // Return barangay as JSON
        echo json_encode($barangay);
    } else {
        // Handle database query error
        error_log("Error fetching barangay: " . pg_last_error());
        echo json_encode(array()); // Return an empty array as JSON
    }
} elseif (isset($_GET['pin_municipality']) && !empty($_GET['pin_municipality'])) {
    $municipality_id = $_GET['pin_municipality'];

    // Fetch municipality coordinates from the database
    $queryCoordinates = "SELECT municipality_coordinates FROM municipality WHERE municipality_id = $1";
    $resultCoordinates = pg_query_params($conn, $queryCoordinates, array($municipality_id));

    if ($resultCoordinates) {
        $rowCoordinates = pg_fetch_assoc($resultCoordinates);
        $municipalityCoordinates = isset($rowCoordinates['municipality_coordinates']) ? $rowCoordinates['municipality_coordinates'] : '';

        // Return the municipality coordinates as JSON
        echo json_encode(array(array('municipality_coordinates' => $municipalityCoordinates)));
    } else {
        // Handle database query error
        error_log("Error fetching municipality coordinates: " . pg_last_error());
        echo json_encode(array()); // Return an empty array as JSON
    }
} else if (isset($_GET['pin_barangay']) && !empty($_GET['pin_barangay'])) {
    $barangay_id = $_GET['pin_barangay'];

    // Fetch barangay coordinates from the database
    $queryCoordinates = "SELECT barangay_coordinates FROM barangay WHERE barangay_id = $1";
    $resultCoordinates = pg_query_params($conn, $queryCoordinates, array($barangay_id));

    if ($resultCoordinates) {
        $rowCoordinates = pg_fetch_assoc($resultCoordinates);
        $barangayCoordinates = isset($rowCoordinates['barangay_coordinates']) ? $rowCoordinates['barangay_coordinates'] : '';

        // Return the barangay coordinates as JSON
        echo json_encode(array(array('barangay_coordinates' => $barangayCoordinates)));
    } else {
        // Handle database query error
        error_log("Error fetching barangay coordinates: " . pg_last_error());
        echo json_encode(array()); // Return an empty array as JSON
    }
}else {
    // If neither province nor municipality parameter is set or empty, return an empty array
    echo json_encode(array());
}
?>
