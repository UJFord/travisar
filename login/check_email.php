<?php
session_start();
require "../functions/connections.php";

// Check if email key is set in the POST data
if (isset($_POST['email'])) {
    // Get the email from the POST data
    $email = $_POST['email'];

    // Prepare the query
    $get_name = "SELECT * FROM users WHERE email = $1";

    // Execute the query with parameters
    $query_run = pg_query_params($conn, $get_name, array($email));

    // Check if the query was executed successfully
    if ($query_run) {
        // Check if any rows were returned
        if (pg_num_rows($query_run) > 0) {
            // Email exists
            $response['exists'] = true;
        } else {
            // Email doesn't exist
            $response['exists'] = false;
        }

        // Set the content type and output the response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Error occurred while executing the query
        http_response_code(500);
        echo json_encode(array('error' => 'Error executing query'));
    }
} else {
    // Email key is not set in POST data
    http_response_code(400);
    echo json_encode(array('error' => 'Email is required'));
}
?>
