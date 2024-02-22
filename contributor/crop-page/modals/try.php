<?php
session_start();
// require "../mail.php";
require "../../../functions/connections.php";

// if (isset($_POST['save']) && $_SESSION['rank'] == 'curator') {
if (isset($_POST['save'])) {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        // Function to handle empty values
        function handleEmpty($value)
        {
            return empty($value) ? 'Empty' : $value;
        }
        // get all the data in the form
        $crop_variety = handleEmpty($_POST['crop_variety']);
        $crop_local_name = handleEmpty($_POST['crop_local_name']);
        $category_id = $_POST['category_id'];
        $field_id = $_POST['field_id'];
        // $crop_image = $_POST['crop_image[]'];
        $role_in_maintaining_upland_ecosystem = $_POST['role_in_maintaining_upland_ecosystem'];
        $scientific_name = $_POST['scientific_name'];
        $unique_features = $_POST['unique_features'];
        $crop_description = handleEmpty($_POST['crop_description']);
        $province_name = $_POST['province'];
        $municipality_name = $_POST['municipality'];
        $status = 'pending';

        //insert into crop table
        $queryCrop = "INSERT INTO crop (crop_variety, crop_local_name, category_id, role_in_maintaining_upland_ecosystem, scientific_name, unique_features, crop_description, status) 
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8) RETURNING crop_id";

        $valueCrops = array($crop_variety, $crop_local_name, $category_id, $role_in_maintaining_upland_ecosystem, $scientific_name, $unique_features, $crop_description, $status);
        $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

        if ($query_run_Crop) {
            $row_crop = pg_fetch_row($query_run_Crop);
            $crop_id = $row_crop[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Location Table
        // Get the location id
        $queryLoc = "SELECT location_id from location where province_name = $1 and municipality_name = $2";
        $query_run_loc = pg_query_params($conn, $queryLoc, array($province_name, $municipality_name));

        if ($query_run_loc) {
            $row_loc = pg_fetch_row(($query_run_loc));
            $location_id = $row_loc[0];
        } else{
            echo "Error: ". pg_last_error($conn);
            exit(0);
        }

        // save into Crop Location Table
        $query_CropLoc = "INSERT into crop_location (crop_id, location_id) VALUES ($1, $2)";
        $query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($crop_id, $location_id));

        if ($query_run_CropLoc){
            $row_CropLoc = pg_fetch_row($query_run_CropLoc);
            $crop_location_id = $row_CropLoc[0];
        }else{
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // save into Crop Field Table
        $query_CropField = "INSERT into crop_field (crop_id, field_id) VALUES ($1, $2)";
        $query_run_CropField = pg_query_params($conn, $query_CropField, array($crop_id, $field_id));

        if ($query_run_CropField){
            $row_CropField = pg_fetch_row($query_run_CropField);
            $crop_field_id = $row_CropField[0];
        }else{
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Characteristics
        $query_char = "INSERT into characteristics (taste, aroma, maturation, pest, disease) VALUES ($1, $2, $3, $4, $5)";
        $query_run_char = pg_query_params($conn, $query_char, array($taste, $aroma, $maturation, $pest, $disease));

        // Cultural Aspect

        // Crop Farming Practice

        // other category

        // Commit the transaction if everything is successful
        pg_query($conn, "COMMIT");
        $_SESSION['message'] = "Crop Created Successfully";
        header("Location: ../../crop.php");
        exit(0);
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        pg_query($conn, "ROLLBACK");
        // Handle the error
        echo "Error: " . $e->getMessage();
        exit(0);
    }
}
