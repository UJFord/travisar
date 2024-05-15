<?php
require "../../../../functions/connections.php";

if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get the file path
    $file_tmp = $_FILES['file']['tmp_name'];

    // Read the file and import the data into PostgreSQL
    $handle = fopen($file_tmp, 'r');
    if ($handle !== FALSE) {
        // Skip the header row
        fgetcsv($handle, 1000, ",");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Assuming the CSV has columns: category, crop variety,
            //$age = (int)$data[1];
            $category_name = pg_escape_string($data[0]);
            $category_variety_name = pg_escape_string($data[1]);
            $variety_name = pg_escape_string($data[2]);
            $meaning_of_name = pg_escape_string($data[3]);
            $terrain = pg_escape_string($data[4]);
            $description = pg_escape_string($data[5]);
            $province = pg_escape_string($data[6]);
            $municipality = pg_escape_string($data[7]);
            $barangay = pg_escape_string($data[8]);
            $sitio = pg_escape_string($data[9]);
            $coordinates = pg_escape_string($data[10]);

            // Find the category_id for the given category name
            $category_query = "SELECT category_id FROM category WHERE category_name = '$category_name'";
            $category_result = pg_query($conn, $category_query);

            if ($category_result && pg_num_rows($category_result) > 0) {
                $category_row = pg_fetch_assoc($category_result);
                $category_id = $category_row['category_id'];
            } else {
                // Handle the case where the country is not found
                echo "category '$category_name' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // Find the category_variety_id for the given category_variety name
            $category_variety_query = "SELECT category_variety_id FROM category_variety WHERE category_variety_name = '$category_variety_name'";
            $category_variety_result = pg_query($conn, $category_variety_query);

            if ($category_variety_result && pg_num_rows($category_variety_result) > 0) {
                $category_variety_row = pg_fetch_assoc($category_variety_result);
                $category_variety_id = $category_variety_row['category_variety_id'];
            } else {
                // Handle the case where the country is not found
                echo "crop variety '$category_variety_name' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // Find the terrain_id for the given terrain name
            $terrain_query = "SELECT terrain_id FROM terrain WHERE terrain_name = '$terrain'";
            $terrain_result = pg_query($conn, $terrain_query);

            if ($terrain_result && pg_num_rows($terrain_result) > 0) {
                $terrain_row = pg_fetch_assoc($terrain_result);
                $terrain_id = $terrain_row['terrain_id'];
            } else {
                // Handle the case where the country is not found
                echo "terrain '$terrain' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // Find the municipality_id for the given municipality name
            $municipality_query = "SELECT municipality_id FROM municipality WHERE municipality_name = '$municipality'";
            $municipality_result = pg_query($conn, $municipality_query);

            if ($municipality_result && pg_num_rows($municipality_result) > 0) {
                $municipality_row = pg_fetch_assoc($municipality_result);
                $municipality_id = $municipality_row['municipality_id'];
            } else {
                // Handle the case where the country is not found
                echo "municipality '$municipality' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // Find the barangay_id for the given barangay name
            $barangay_query = "SELECT barangay_id FROM barangay WHERE barangay_name = '$barangay'";
            $barangay_result = pg_query($conn, $barangay_query);

            if ($barangay_result && pg_num_rows($barangay_result) > 0) {
                $barangay_row = pg_fetch_assoc($barangay_result);
                $barangay_id = $barangay_row['barangay_id'];
            } else {
                // Handle the case where the country is not found
                echo "barangay '$barangay' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // Insert data into the users table
            $crop_query = "INSERT INTO crop (category_id, category_varirty_id, variety_name, meaning_of_name, terrain_id, crop_description) 
            VALUES ($category_id, $category_varirty_id, $variety_name, $meaning_of_name, $terrain_id, $crop_description) returning crop_id";
            $crop_result = pg_query($conn, $crop_query);

            if ($crop_result) {
                $row_crop = pg_fetch_row($crop_result);
                $crop_id = $row_crop[0];
            }else{
                echo "Error in query: " . pg_last_error($conn) . "<br>";
                die();
            }

            // Insert data into the users table
            $cropLoc_query = "INSERT INTO crop_location (crop_id, municipality_id, barangay_id, coordinates, sitio_name) 
            VALUES ($crop_id, $municipality_id, $barangay_id, $coordinates, $sitio)";
            $cropLoc_result = pg_query($conn, $cropLoc_query);

            if ($cropLoc_result) {
                $row_crop = pg_fetch_row($crop_result);
                $crop_id = $row_crop[0];
            } else {
                echo "Error in query: " . pg_last_error($conn) . "<br>";
                die();
            }
        }

        fclose($handle);
        echo "Data imported successfully.";
        die();
    } else {
        echo "Error opening the file.";
        die();
    }
} else {
    echo "Error uploading file.";
}

// Close the database connection
pg_close($conn);
