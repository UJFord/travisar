<?php
require "../../../functions/connections.php";

// Check if the province parameter is set and not empty
if (isset($_GET['province']) && !empty($_GET['province'])) {
    $province_name = $_GET['province'];

    // Use prepared statements to prevent SQL injection
    $queryMunicipality = "SELECT DISTINCT municipality_name FROM location WHERE province_name = $1 ORDER BY municipality_name ASC";
    $result = pg_query_params($conn, $queryMunicipality, array($province_name));

    if ($result) {
        $municipalities = array();
        while ($row = pg_fetch_assoc($result)) {
            $municipalities[] = $row['municipality_name'];
        }

        // Return municipalities as JSON
        echo json_encode($municipalities);
    } else {
        // Handle database query error
        error_log("Error fetching municipalities: " . pg_last_error());
        echo json_encode(array());
    }
} else {
    // If province parameter is not set or empty, return an empty array
    echo json_encode(array());
}
?>
