<?php
session_start();
require "../../functions/connections.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $get_name = "SELECT * FROM users WHERE email = $1 AND password = $2";
    $query_run = pg_query_params($conn, $get_name, array($email, $password));

    if ($query_run) {
        if (pg_num_rows($query_run) > 0) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(500);
        echo json_encode(array('error' => 'Error executing query'));
    }
}
?>
