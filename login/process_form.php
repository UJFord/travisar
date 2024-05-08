<?php
session_start();
require "../functions/connections.php";

if (isset($_POST['edit']) && isset($_SESSION['USER']['user_id']) && isset($_POST['user_id']) && $_SESSION['USER']['user_id'] == $_POST['user_id']) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $affiliation = $_POST['affiliation'];
    $username = $_POST['username'];

    // Prepare and execute the SQL query
    $query = "UPDATE users SET first_name = $1, last_name = $2, gender = $3, affiliation = $4, username = $5 WHERE user_id = $6";
    $query_run = pg_query_params($conn, $query, array($first_name, $last_name, $gender, $affiliation, $username, $user_id));

    // Check if the query was successful
    if ($query_run) {
        $_SESSION['message'] = "User updated successfully";
        header("location: profile.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating user";
        // Optionally, you might want to log the error for debugging purposes
        error_log(pg_last_error($conn));
    }
}

if (isset($_POST['edit_mail']) && isset($_SESSION['USER']['user_id']) && isset($_POST['user_id']) && $_SESSION['USER']['user_id'] == $_POST['user_id']) {
    $user_id = $_POST['user_id'];
    $mail = $_POST['new_email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $affiliation = $_POST['affiliation'];
    $username = $_POST['username'];

    // Prepare and execute the SQL query
    $query = "UPDATE users SET email_verified = '' WHERE user_id = $1";
    $query_run = pg_query_params($conn, $query, array($user_id));
    // Check if the query was successful
    if ($query_run) {
        $_SESSION['message'] = "Email updated successfully. Account access restricted for verification. Please wait 1-2 days.";
        header("location: login.php");
        // Destroy session
        session_destroy(); //  unsets $_SESSION['user']
        exit();
    } else {
        $_SESSION['message'] = "Error updating email";
        // Optionally, you might want to log the error for debugging purposes
        error_log(pg_last_error($conn));
    }

    $query_add = "INSERT into users (username, email, password, password, first_name, last_name, affiliation, gender)";
}
