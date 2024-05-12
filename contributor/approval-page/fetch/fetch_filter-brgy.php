<?php
require "../../../functions/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $municipality_id = $_GET['municipality_id'];

    $query = "SELECT * FROM barangay WHERE municipality_id in ($municipality_id)";
    $result = pg_query($conn, $query);

    $varieties = [];
    while ($row = pg_fetch_assoc($result)) {
        $varieties[] = $row;
    }

    echo json_encode($varieties);
}
?>
