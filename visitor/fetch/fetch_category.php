<?php
require "../../functions/connections.php";

// get the data of category from DB
// gi set ra nako na permi last ang other nga category og ascending sya based sa catgory name
$queryCategory = "SELECT * FROM category ORDER BY
                CASE
                    WHEN category_name = 'Other' THEN 2
                    ELSE 1
                END, category_name ASC";
$query_run = pg_query($conn, $queryCategory);

$categories = array();

while ($row = pg_fetch_assoc($query_run)) {
    $category = array(
        'category_id' => $row['category_id'],
        'category_name' => $row['category_name']
    );
    $categories[] = $category;
}

echo json_encode($categories);
?>