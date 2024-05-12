<?php
require "../../functions/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $categoryId = $_GET['category_id'];

    $query = "SELECT * FROM category_variety WHERE category_id IN ($categoryId)";

    $result = pg_query($conn, $query);

    // Check for errors in query execution
    if (!$result) {
        echo "Query failed.";
        exit;
    }

    // Fetch data from the result set
    $category_varieties = array();
    while ($row = pg_fetch_assoc($result)) {
        $category_varieties[] = $row;
    }

    // Return JSON response
    echo json_encode($category_varieties);
}
