<?php
require "../..functions/connections.php";

// Fetch active notifications
$find_notifications = "SELECT * FROM notification WHERE active = true";
$result = pg_query($conn, $find_notifications);
if (!$result) {
    die("Error in query: " . pg_last_error());
}

$notifications_data = array();
while ($rows = pg_fetch_assoc($result)) {
    $notifications_data[] = array(
        "notification_id" => $rows['notification_id'],
        "notification_name" => $rows['notification_name'],
        "message" => $rows['message']
    );
}

// Fetch notification count
$count_active = pg_num_rows($result);

$response = array(
    'notifications' => $notifications_data,
    'count_active' => $count_active
);

echo json_encode($response);
pg_close($conn);
