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
            // Assuming the CSV has columns: category, crop variety, etc.
            // Set default values for missing columns
            $user_id = $_POST['user_id'];
            $action = "Approved";
            $category_name = isset($data[0]) ? pg_escape_string($data[0]) : '';
            $category_variety_name = isset($data[1]) ? pg_escape_string($data[1]) : '';
            $variety_name = isset($data[2]) ? pg_escape_string($data[2]) : '';
            $meaning_of_name = isset($data[3]) ? pg_escape_string($data[3]) : '';
            $terrain = isset($data[4]) ? pg_escape_string($data[4]) : '';
            $description = isset($data[5]) ? pg_escape_string($data[5]) : '';
            $municipality = isset($data[6]) ? pg_escape_string($data[6]) : '';
            $barangay = isset($data[7]) ? pg_escape_string($data[7]) : '';
            $sitio = isset($data[8]) ? pg_escape_string($data[8]) : '';
            $coordinates = isset($data[9]) ? pg_escape_string($data[9]) : '';
            $corn_plant_height = isset($data[10]) ? pg_escape_string($data[10]) : '';
            $corn_leaf_width = isset($data[11]) ? pg_escape_string($data[11]) : '';
            $corn_leaf_length = isset($data[12]) ? pg_escape_string($data[12]) : '';
            $corn_yield_capacity = isset($data[13]) ? pg_escape_string($data[13]) : '';
            $seed_length = isset($data[14]) ? pg_escape_string($data[14]) : '';
            $seed_width = isset($data[15]) ? pg_escape_string($data[15]) : '';
            $seed_shape = isset($data[16]) ? pg_escape_string($data[16]) : '';
            $seed_color = isset($data[17]) ? pg_escape_string($data[17]) : '';
            $significance = isset($data[18]) ? pg_escape_string($data[18]) : '';
            $use = isset($data[19]) ? pg_escape_string($data[19]) : '';
            $indigenous_utilization = isset($data[20]) ? pg_escape_string($data[20]) : '';
            $remarkable_features = isset($data[21]) ? pg_escape_string($data[21]) : '';

            // Find the category_id for the given category name
            $category_query = "SELECT category_id FROM category WHERE category_name ILIKE '$category_name'";
            $category_result = pg_query($conn, $category_query);

            if ($category_result && pg_num_rows($category_result) > 0) {
                $category_row = pg_fetch_assoc($category_result);
                $category_id = $category_row['category_id'];
            } else {
                // Handle the case where the category is not found
                echo "Category '$category_name' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // Find the category_variety_id for the given category_variety name
            $category_variety_query = "SELECT category_variety_id FROM category_variety WHERE category_variety_name ILIKE '$category_variety_name'";
            $category_variety_result = pg_query($conn, $category_variety_query);

            if ($category_variety_result && pg_num_rows($category_variety_result) > 0) {
                $category_variety_row = pg_fetch_assoc($category_variety_result);
                $category_variety_id = $category_variety_row['category_variety_id'];
            } else {
                // Handle the case where the category variety is not found
                echo "Category variety '$category_variety_name' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // Find the terrain_id for the given terrain name
            $terrain_query = "SELECT terrain_id FROM terrain WHERE terrain_name ILIKE '$terrain'";
            $terrain_result = pg_query($conn, $terrain_query);

            if ($terrain_result && pg_num_rows($terrain_result) > 0) {
                $terrain_row = pg_fetch_assoc($terrain_result);
                $terrain_id = $terrain_row['terrain_id'];
            } else {
                // Handle the case where the terrain is not found
                echo "Terrain '$terrain' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // Find the municipality_id for the given municipality name
            $municipality_query = "SELECT municipality_id FROM municipality WHERE municipality_name ILIKE '$municipality'";
            $municipality_result = pg_query($conn, $municipality_query);

            if ($municipality_result && pg_num_rows($municipality_result) > 0) {
                $municipality_row = pg_fetch_assoc($municipality_result);
                $municipality_id = $municipality_row['municipality_id'];
            } else {
                // Handle the case where the municipality is not found
                echo "Municipality '$municipality' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // Find the barangay_id for the given barangay name
            $barangay_query = "SELECT barangay_id FROM barangay WHERE barangay_name ILIKE '$barangay'";
            $barangay_result = pg_query($conn, $barangay_query);

            if ($barangay_result && pg_num_rows($barangay_result) > 0) {
                $barangay_row = pg_fetch_assoc($barangay_result);
                $barangay_id = $barangay_row['barangay_id'];
            } else {
                // Handle the case where the barangay is not found
                echo "Barangay '$barangay' not found in the database.<br>";
                continue; // Skip this row and move to the next
            }

            // for creating a unique code for each crops
            // Get the latest unique_code from the crop table
            $queryLatestCode = "SELECT category_name FROM category WHERE category_id = $1";
            $resultLatestCode = pg_query_params($conn, $queryLatestCode, array($category_id));

            if ($resultLatestCode) {
                $latestCodeRow = pg_fetch_assoc($resultLatestCode);
                $latestCode = $latestCodeRow['category_name'];

                // Extract the first letter of each word in the category name
                $prefix = '';
                $words = explode(' ', $latestCode);
                foreach ($words as $word) {
                    $prefix .= strtoupper(substr($word, 0, 1));
                }

                // Fetch all existing unique codes from the crop table
                $queryUniqueCodes = "SELECT unique_code FROM crop WHERE unique_code LIKE '$prefix%'";
                $resultUniqueCodes = pg_query($conn, $queryUniqueCodes);

                // Extract the highest number from the existing codes
                $existingNumbers = [];
                while ($row = pg_fetch_assoc($resultUniqueCodes)) {
                    preg_match('/(\d+)$/', $row['unique_code'], $matches);
                    if (isset($matches[1])) {
                        $existingNumbers[] = intval($matches[1]);
                    }
                }

                if (empty($existingNumbers)) {
                    // If no existing codes, set the current number to 0
                    $currentNumber = 0;
                } else {
                    $currentNumber = max($existingNumbers);
                }

                // Generate the new unique code
                $newUniqueCode = $prefix . 'V' . '-' . str_pad(
                    $currentNumber + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }

            //insert into utilization cultural table
            $query_utilCultural = "INSERT INTO utilization_cultural_importance (significance, \"use\", indigenous_utilization, remarkable_features)
            VALUES ($1, $2, $3, $4) RETURNING utilization_cultural_id";

            $value_utilCultural = array($significance, $use, $indigenous_utilization, $remarkable_features);
            $query_run_utilCultural = pg_query_params($conn, $query_utilCultural, $value_utilCultural);

            if ($query_run_utilCultural) {
                $row_utilCultural = pg_fetch_row($query_run_utilCultural);
                $utilization_cultural_id = $row_utilCultural[0];
            } else {
                continue;
            }

            //insert into status table
            $query_Status = "INSERT INTO status (action)
                VALUES ($1) RETURNING status_id";
            $value_Status = array($action);
            $query_run_Status = pg_query_params($conn, $query_Status, $value_Status);

            if ($query_run_Status) {
                $row_Status = pg_fetch_row($query_run_Status);
                $status_id = $row_Status[0];
            } else {
                echo "Status not saved in the database.<br>";
                continue;
            }

            // Insert data into the crop table
            $crop_query = "INSERT INTO crop (category_id, category_variety_id, crop_variety, meaning_of_name, terrain_id, crop_description, unique_code, status_id, user_id, utilization_cultural_id) 
            VALUES ($category_id, $category_variety_id, '$variety_name', '$meaning_of_name', $terrain_id, '$description', '$newUniqueCode', $status_id, $user_id, $utilization_cultural_id) RETURNING crop_id";
            $crop_result = pg_query($conn, $crop_query);

            if ($crop_result) {
                $row_crop = pg_fetch_row($crop_result);
                $crop_id = $row_crop[0];
                echo 'crop saved';
            } else {
                echo "Error in query: " . pg_last_error($conn) . "<br>";
                continue;
            }

            // Ensure coordinates are properly quoted or set to NULL if empty
            $coordinates_value = empty($coordinates) ? "NULL" : "'$coordinates'";

            // Insert data into the crop_location table
            $cropLoc_query = "INSERT INTO crop_location (crop_id, municipality_id, barangay_id, coordinates, sitio_name) 
            VALUES ($crop_id, $municipality_id, $barangay_id, $coordinates_value, '$sitio')";
            $cropLoc_result = pg_query($conn, $cropLoc_query);

            if ($cropLoc_result) {
                echo 'location saved';
            } else {
                echo "Error in query: " . pg_last_error($conn) . "<br>";
                continue;
            }

            // Handle corn category traits
            // seed traits
            $query_seedTraits = "INSERT into seed_traits (seed_length, seed_width, seed_shape, seed_color) values ($1, $2, $3, $4) returning seed_traits_id";
            $query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color));
            if ($query_run_seedTraits) {
                $row_seedTraits = pg_fetch_row($query_run_seedTraits);
                $seed_traits_id = $row_seedTraits[0];
            } else {
                echo "seed traits not saved in the database.<br>";
                continue;
            }

            // reproductive state corn
            $query_reproductiveState = "INSERT into reproductive_state_corn (corn_yield_capacity, seed_traits_id) values ($1, $2) returning reproductive_state_corn_id";
            $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($corn_yield_capacity, $seed_traits_id));
            if ($query_run_reproductiveState) {
                $row_reproductiveState = pg_fetch_row($query_run_reproductiveState);
                $reproductive_state_corn_id = $row_reproductiveState[0];
            } else {
                echo "Reproductive state corn not saved in the database.<br>";
                continue;
            }

            // vegetative state corn
            $query_vegetativeState = "INSERT into vegetative_state_corn (corn_plant_height, corn_leaf_width, corn_leaf_length) values ($1, $2, $3) returning vegetative_state_corn_id";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($corn_plant_height, $corn_leaf_width, $corn_leaf_length));
            if ($query_run_vegetativeState) {
                $row_vegetativeState = pg_fetch_row($query_run_vegetativeState);
                $vegetative_state_corn_id = $row_vegetativeState[0];
            } else {
                echo "Vegetative state corn not saved in the database.<br>";
                continue;
            }

            // corn traits
            $query_cornTraits = "INSERT into corn_traits (crop_id, vegetative_state_corn_id, reproductive_state_corn_id) values ($1, $2, $3) returning corn_traits_id";
            $query_run_cornTraits = pg_query_params($conn, $query_cornTraits, array(
                $crop_id, $vegetative_state_corn_id, $reproductive_state_corn_id
            ));
            if ($query_run_cornTraits) {
                $row_cornTraits = pg_fetch_row($query_run_cornTraits);
                $corn_traits_id = $row_cornTraits[0];
            } else {
                echo "Corn traits not saved in the database.<br>";
                continue;
            }
        }

        fclose($handle);
        echo "Data imported successfully.";
    } else {
        echo "Error opening the file.";
        die();
    }
} else {
    echo "Error uploading file.";
}

// Close the database connection
pg_close($conn);
