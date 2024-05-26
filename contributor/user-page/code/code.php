<?php
session_start();
require "../../../functions/connections.php";
require "../../../functions/mail.php";

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
        $contact_num = $_POST['contact_num'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $affiliation = $_POST['affiliation'];
        $account_type_id = $_POST['account_type_id'];
        $affiliated_email = $_POST['affiliated_email'];
        $affiliated_contact_num = $_POST['affiliated_contact_num'];

        $email_verify = $_POST['email'];

        // Perform the insertion query
        $query = "INSERT into users (first_name, last_name, gender, email, username, password, affiliation, account_type_id, email_verified, contact_num, affiliated_email, affiliated_contact_num) 
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12) RETURNING user_id";
        $query_run = pg_query_params($conn, $query, array(
            $first_name, $last_name, $gender, $email, $username, $password, $affiliation, $account_type_id, $email_verify, $contact_num, $affiliated_email, $affiliated_contact_num
        ));

        if ($query_run) {
            $row_user = pg_fetch_row($query_run);
            $user_id = $row_user[0];

            // Prepare notification details
            $notification_name = 'User created.';
            $message = 'User ' . $first_name . ' ' . $last_name . ' is created.';
            $active = '1';

            // Insert notification
            $insert_queryNotif = "
                INSERT INTO notification_user (notification_name, message, active, user_id)
                VALUES ($1, $2, $3, $4)
            ";
            $insert_runNotif = pg_query_params($conn, $insert_queryNotif, array($notification_name, $message, $active, $user_id));

            if ($insert_runNotif) {
                // Commit the transaction if successful
                pg_query($conn, "COMMIT");
                $_SESSION['message'] = "User created successfully";
                //header("location: ../partners.php");
                exit; // Ensure that the script stops executing after the redirect header
            } else {
                // Log the error or display a more user-friendly message
                echo "Error inserting notification: " . pg_last_error($conn);
            }
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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $query = "UPDATE users set email_verified = $1 where user_id = $2";
    $query_run = pg_query_params($conn, $query, array($email, $user_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            // Prepare notification details
            $notification_name = 'User verified.';
            $message = 'User ' . $first_name . ' ' . $last_name . ' is verified.';
            $active = '1';

            // Insert notification
            $insert_queryNotif = "
                INSERT INTO notification_user (notification_name, message, active, user_id)
                VALUES ($1, $2, $3, $4)
            ";
            $insert_runNotif = pg_query_params($conn, $insert_queryNotif, array($notification_name, $message, $active, $user_id));

            if ($insert_runNotif) {
                $message = "Thank you for creating an account. Your account is now verified.";
                $subject = "Email verification";
                $recipient = $email;

                send_mail($recipient, $subject, $message);
            } else {
                // Log the error or display a more user-friendly message
                echo "Error inserting notification: " . pg_last_error($conn);
                die();
            }

            $_SESSION['message'] = "User Approved";
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
    $email = $_POST['email'];

    $query = "DELETE FROM users WHERE user_id = $1";
    $query_run = pg_query_params($conn, $query, array($user_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            $message = "Your account has been rejected.";
            $subject = "Email verification";
            $recipient = $email;

            send_mail($recipient, $subject, $message);
            $_SESSION['message'] = "User rejected";
            header("location: ../verify-user.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            $_SESSION['message'] = "User not found";
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
    echo 'here';
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_nameEdit'];
    $last_name = $_POST['last_nameEdit'];
    $gender = $_POST['genderEdit'];
    $contact_num = $_POST['contact_numEdit'];
    $email = $_POST['emailEdit'];
    $username = $_POST['usernameEdit'];
    $affiliation = $_POST['affiliationEdit'];
    $affiliated_email = $_POST['affiliated_emailEdit'];
    $affiliated_contact_num = $_POST['affiliated_contact_numEdit'];
    $account_type_id = $_POST['account_type_idEdit'];

    $select = "UPDATE users SET first_name = $1, last_name = $2, gender = $3, email = $4, username = $5, affiliation = $6,
    account_type_id = $7, contact_num = $8, affiliated_email = $9, affiliated_contact_num = $10 WHERE user_id = $11 ";
    $result = pg_query_params($conn, $select, array(
        $first_name, $last_name, $gender, $email, $username, $affiliation,
        $account_type_id, $contact_num, $affiliated_email, $affiliated_contact_num, $user_id
    ));
    if ($result) {
        echo $_SESSION['message'] = "User edited.";
        echo 'saved';
        header("location: ../partners.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {

        echo "Error updating record"; // Display an error message if the query fails
    }
}
