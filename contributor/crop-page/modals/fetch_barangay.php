<?php
require "../../../functions/connections.php";

// Check if the municipality parameter is set and not empty
if (isset($_GET['municipality']) && !empty($_GET['municipality'])) {
    $municipality_name = $_GET['municipality'];

    // Use prepared statements to prevent SQL injection
    $queryBarangay = "SELECT DISTINCT barangay_name FROM barangay WHERE municipality_name = $1 ORDER BY barangay_name ASC";
    $result = pg_query_params($conn, $queryBarangay, array($municipality_name));

    if ($result) {
        $barangay = array();
        while ($row = pg_fetch_assoc($result)) {
            $barangay[] = $row['barangay_name'];
        }

        // Return barangay as JSON
        echo json_encode($barangay); 
    } else {
        // Handle database query error
        error_log("Error fetching barangay: " . pg_last_error());
        echo json_encode(array());
    }
} else {
    // If municipality parameter is not set or empty, return an empty array
    echo json_encode(array());
    error_log("Error fetching barangay: " . pg_last_error());
}
?>
