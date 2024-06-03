<?php
session_start();
require "../../functions/connections.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the hashed password from the database
    $query = "SELECT password FROM users WHERE email = $1";
    $result = pg_query_params($conn, $query, array($email));

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        $hashedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            $response = array('exists' => true);
        } else {
            $response = array('exists' => false);
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode(array('exists' => false));
    }
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'Invalid request'));
}