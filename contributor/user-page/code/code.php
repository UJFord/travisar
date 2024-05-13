<?php
session_start();
require "../../../functions/connections.php";
// var_dump($_POST);
// die();
if (isset($_POST['save'])) {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $affiliation = $_POST['affiliation'];
        $account_type_id = $_POST['account_type_id'];
        $email_verify = $_POST['email'];

        // Perform the insertion query
        $query = "INSERT into users (first_name, last_name, gender, email, username, password, affiliation, account_type_id, email_verified) 
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)";
        $query_run = pg_query_params($conn, $query, array(
            $first_name, $last_name, $gender, $email, $username, $password, $affiliation, $account_type_id, $email_verify
        ));

        if ($query_run) {
            // Commit the transaction if successful
            pg_query($conn, "COMMIT");
            $_SESSION['message'] = "User created successfully";
            //header("location: ../partners.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            // Rollback the transaction if an error occurs
            pg_query($conn, "ROLLBACK");
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        pg_query($conn, "ROLLBACK");
        // Log the error message
        error_log("Error: " . $e->getMessage());
        // Handle the error
        echo "Error: " . $e->getMessage();
        // Display the error message
        echo "<script>document.getElementById('error-container').innerHTML = '" . $e->getMessage() . "';</script>";
        exit(0);
    }
}

if (isset($_POST['approve'])) {
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];

    $query = "UPDATE users set email_verified = $1 where user_id = $2";
    $query_run = pg_query_params($conn, $query, array($email, $user_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $_SESSION['messsage'] = "User Approved";
            header("location: ../verify-user.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            echo "Error: Location ID not found";
            exit(0);
        }
    } else {
        echo "Error: " . pg_last_error($conn);
        exit(0);
    }
}

// for verify delete
if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];

    $query = "DELETE FROM users WHERE user_id = $1";
    $query_run = pg_query_params($conn, $query, array($user_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $_SESSION['message'] = "User rejected";
            header("location: ../verify-user.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            $_SESSION['error'] = "User not found";
            header("location: ../verify-user.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Error deleting user: " . pg_last_error($conn);
        header("location: ../verify-user.php");
        exit;
    }
}

// for edit user delete
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    $query = "DELETE FROM users WHERE user_id = $1";
    $query_run = pg_query_params($conn, $query, array($user_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $_SESSION['message'] = "User deleted";
            //header("location: ../verify-user.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            $_SESSION['error'] = "User not found";
            //header("location: ../verify-user.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Error deleting user: " . pg_last_error($conn);
        //header("location: ../verify-user.php");
        exit;
    }
}

if (isset($_POST['click_edit_btn'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_nameEdit'];
    $last_name = $_POST['last_nameEdit'];
    $gender = $_POST['genderEdit'];
    $email = $_POST['emailEdit'];
    $username = $_POST['usernameEdit'];
    $affiliation = $_POST['affiliationEdit'];
    $account_type_id = $_POST['account_type_idEdit'];

    $select = "UPDATE users SET first_name = $1, last_name = $2, gender = $3, email = $4, username = $5, affiliation = $6,
    account_type_id = $7 WHERE user_id = $8 ";
    $result = pg_query_params($conn, $select, array(
        $first_name, $last_name, $gender, $email, $username, $affiliation,
        $account_type_id, $user_id
    ));
    if ($result) {
        header("location: ../partners.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {
        echo "Error updating record"; // Display an error message if the query fails
    }
}
