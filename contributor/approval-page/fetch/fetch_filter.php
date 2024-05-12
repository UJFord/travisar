<?php
require "../../../functions/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $categoryId = $_GET['category_id'];

    $query = "SELECT * FROM category_variety WHERE category_id in ($categoryId)";
    $result = pg_query($conn, $query);

    $varieties = [];
    while ($row = pg_fetch_assoc($result)) {
        $varieties[] = $row;
    }

    echo json_encode($varieties);
}
?>
