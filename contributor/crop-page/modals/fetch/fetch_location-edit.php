<?php
require "../../../../functions/connections.php";

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
    $queryBarangay = "SELECT DISTINCT barangay_name FROM barangay WHERE municipality_id = $1 ORDER BY barangay_name ASC";
    $resultBarangay = pg_query_params($conn, $queryBarangay, array($municipality_id));

    if ($resultBarangay) {
        $barangay = array();
        while ($row = pg_fetch_array($resultBarangay, null, PGSQL_ASSOC)) {
            $barangay[] = $row['barangay_name'];
        }

        // Return barangay as JSON
        echo json_encode($barangay);
    } else {
        // Handle database query error
        error_log("Error fetching barangay: " . pg_last_error());
        echo json_encode(array()); // Return an empty array as JSON
    }
} else {
    // If neither province nor municipality parameter is set or empty, return an empty array
    echo json_encode(array());
}
?>
