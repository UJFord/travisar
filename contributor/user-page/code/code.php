<?php
require "../../../functions/connections.php";


if (isset($_POST['click_add_btn'])) {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $affiliation = $_POST['affiliation'];
        $account_type_id = $_POST['account_type_id'];
        $email_verify = $_POST['email'];

        // Perform the insertion query
        $query = "INSERT into users (first_name, last_name, gender, email, username, password, affiliation, account_type_id, email_verified) 
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
        $query_run = pg_query_params($conn, $query, array(
            $first_name, $last_name, $gender, $email, $username, $password, $affiliation, $account_type_id, $email_verify
        ));

        if ($query_run) {
            // Commit the transaction if successful
            pg_query($conn, "COMMIT");
            $_SESSION['message'] = "User created successfully";
            header("location: ../../partners.php");
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

if (isset($_POST['update'])) {
    $location_id = $_POST['location_id'];
    $province_name = $_POST['province_name'];
    $municipality_name = $_POST['municipality_name'];

    $query = "UPDATE location set province_name = $1, municipality_name = $2 where location_id = $3";
    $query_run = pg_query_params($conn, $query, array($province_name, $municipality_name, $location_id));

    if ($query_run !== false) {
        $affected_rows = pg_affected_rows($query_run);
        if ($affected_rows > 0) {
            echo "Location updated successfully";
            header("location: ../../municipality.php");
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

if (isset($_POST['rejected'])) {
    $crop_id = $_POST['crop_id'];
    $select = "UPDATE crop SET status = 'rejected' WHERE crop_id = '$crop_id' ";
    $result = pg_query($conn, $select);
    if ($result) {

        header("location: ../../municipality.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {
        echo "Error updating record"; // Display an error message if the query fails
    }
}
