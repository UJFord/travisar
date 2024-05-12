<?php
session_start();
require "../../../../functions/connections.php";

// Query data
$query = "SELECT * FROM crop";
$result = pg_query($conn, $query);

if (!$result) {
    die("Query failed: " . pg_last_error($conn));
}

// Convert to CSV format
$csv_data = '';
while ($row = pg_fetch_assoc($result)) {
    // Escape special characters and enclose fields in double quotes
    $csv_data .= '"' . implode('","', array_map('pg_escape_string', $row)) . '"' . "\n";
}

// Set headers for file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="exported_data.csv"');

// Output CSV data
echo $csv_data;

// Close connection
pg_close($conn);
?>
