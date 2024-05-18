<?php
require "../../../../functions/connections.php";
require "../../../functions/functions.php";

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
            $rootcrop_plant_height = isset($data[10]) ? pg_escape_string($data[10]) : '';
            $rootcrop_leaf_width = isset($data[11]) ? pg_escape_string($data[11]) : '';
            $rootcrop_leaf_length = isset($data[12]) ? pg_escape_string($data[12]) : '';
            $rootcrop_stem_leaf_desc = isset($data[13]) ? pg_escape_string($data[13]) : '';
            $eating_quality = isset($data[14]) ? pg_escape_string($data[14]) : '';
            $rootcrop_color = isset($data[15]) ? pg_escape_string($data[15]) : '';
            $sweetness = isset($data[16]) ? pg_escape_string($data[16]) : '';
            $rootcrop_remarkable_features = isset($data[17]) ? pg_escape_string($data[17]) : '';
            $significance = isset($data[18]) ? pg_escape_string($data[18]) : '';
            $use = isset($data[19]) ? pg_escape_string($data[19]) : '';
            $indigenous_utilization = isset($data[20]) ? pg_escape_string($data[20]) : '';
            $remarkable_features = isset($data[21]) ? pg_escape_string($data[21]) : '';
            $pest_resistance = isset($data[22]) ? pg_escape_string($data[22]) : '';
            $disease_resistance = isset($data[23]) ? pg_escape_string($data[23]) : '';
            $abiotic_resistance = isset($data[24]) ? pg_escape_string($data[24]) : '';

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

            // rootcrop traits
            $query_rootcropTraits = "INSERT into rootcrop_traits (eating_quality, rootcrop_color, sweetness, rootcrop_remarkable_features) values ($1, $2, $3, $4) returning rootcrop_traits_id";
            $query_run_rootcropTraits = pg_query_params($conn, $query_rootcropTraits, array($eating_quality, $rootcrop_color, $sweetness, $rootcrop_remarkable_features));
            if ($query_run_rootcropTraits) {
                $row_rootcropTraits = pg_fetch_row($query_run_rootcropTraits);
                $rootcrop_traits_id = $row_rootcropTraits[0];
            } else {
                $_SESSION['message'] = "Failed to create crop.";
                header("Location: ../../crop.php");
                exit(0);
            }

            // vegetative state rootcrop
            $query_vegetativeState = "INSERT into vegetative_state_rootcrop (rootcrop_plant_height, rootcrop_leaf_width, rootcrop_leaf_length, rootcrop_stem_leaf_desc, rootcrop_maturity_time) values ($1, $2, $3, $4, $5) returning vegetative_state_rootcrop_id";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rootcrop_plant_height, $rootcrop_leaf_width, $rootcrop_leaf_length, $rootcrop_stem_leaf_desc, $rootcrop_maturity_time));
            if ($query_run_vegetativeState) {
                $row_vegetativeState = pg_fetch_row($query_run_vegetativeState);
                $vegetative_state_rootcrop_id = $row_vegetativeState[0];
            } else {
                $_SESSION['message'] = "Failed to create crop.";
                header("Location: ../../crop.php");
                exit(0);
            }

            // root crop traits
            $query_root_CropTraits = "INSERT into root_crop_traits (crop_id, vegetative_state_rootcrop_id, rootcrop_traits_id) values ($1, $2, $3) returning root_crop_traits_id";
            $query_run_root_CropTraits = pg_query_params($conn, $query_root_CropTraits, array(
                $crop_id, $vegetative_state_rootcrop_id, $rootcrop_traits_id
            ));
            if ($query_run_root_CropTraits) {
                $row_root_CropTraits = pg_fetch_row($query_run_root_CropTraits);
                $root_crop_traits_id = $row_root_CropTraits[0];
            } else {
                $_SESSION['message'] = "Failed to create crop.";
                header("Location: ../../crop.php");
                exit(0);
            }

            // Insert data into the pest_resistance table
            if (!empty($pest_resistance)) {
                $pest_resistances = explode(",", $pest_resistance);
                foreach ($pest_resistances as $resistance) {
                    $resistance = trim($resistance);
                    if (!empty($resistance)) {
                        $pest_query = "SELECT pest_resistance_id FROM pest_resistance WHERE pest_name ILIKE '$resistance'";
                        $pest_result = pg_query($conn, $pest_query);
                        if ($pest_result && pg_num_rows($pest_result) > 0) {
                            $pest_row = pg_fetch_assoc($pest_result);
                            $pest_resistance_id = $pest_row['pest_resistance_id'];
                            $crop_pest_query = "INSERT INTO rootcrop_pest_resistance (root_crop_traits_id, pest_resistance_id) VALUES ($1, $2)";
                            $crop_pest_values = array($root_crop_traits_id, $pest_resistance_id);
                            $crop_pest_result = pg_query_params($conn, $crop_pest_query, $crop_pest_values);
                            if (!$crop_pest_result) {
                                echo "Error inserting pest resistance data for $resistance.<br>";
                                continue;
                            }
                        } else {
                            echo "Pest resistance '$resistance' not found in the database.<br>";
                            continue;
                        }
                    }
                }
            }

            // Insert data into the disease_resistance table
            if (!empty($disease_resistance)) {
                $disease_resistances = explode(",", $disease_resistance);
                foreach ($disease_resistances as $resistance) {
                    $resistance = trim($resistance);
                    if (!empty($resistance)) {
                        $disease_query = "SELECT disease_resistance_id FROM disease_resistance WHERE disease_name ILIKE '$resistance'";
                        $disease_result = pg_query($conn, $disease_query);
                        if ($disease_result && pg_num_rows($disease_result) > 0) {
                            $disease_row = pg_fetch_assoc($disease_result);
                            $disease_resistance_id = $disease_row['disease_resistance_id'];
                            $crop_disease_query = "INSERT INTO rootcrop_disease_resistance (root_crop_traits_id, disease_resistance_id) VALUES ($1, $2)";
                            $crop_disease_values = array($root_crop_traits_id, $disease_resistance_id);
                            $crop_disease_result = pg_query_params($conn, $crop_disease_query, $crop_disease_values);
                            if (!$crop_disease_result) {
                                echo "Error inserting disease resistance data for $resistance.<br>";
                                continue;
                            }
                        } else {
                            echo "Disease resistance '$resistance' not found in the database.<br>";
                            continue;
                        }
                    }
                }
            }

            // Insert data into the abiotic_resistance table
            if (!empty($abiotic_resistance)) {
                $abiotic_resistances = explode(",", $abiotic_resistance);
                foreach ($abiotic_resistances as $resistance) {
                    $resistance = trim($resistance);
                    if (!empty($resistance)) {
                        $abiotic_query = "SELECT abiotic_resistance_id FROM abiotic_resistance WHERE abiotic_name ILIKE '$resistance'";
                        $abiotic_result = pg_query($conn, $abiotic_query);
                        if ($abiotic_result && pg_num_rows($abiotic_result) > 0) {
                            $abiotic_row = pg_fetch_assoc($abiotic_result);
                            $abiotic_resistance_id = $abiotic_row['abiotic_resistance_id'];
                            $crop_abiotic_query = "INSERT INTO rootcrop_abiotic_resistance (root_crop_traits_id, abiotic_resistance_id) VALUES ($1, $2)";
                            $crop_abiotic_values = array($root_crop_traits_id, $abiotic_resistance_id);
                            $crop_abiotic_result = pg_query_params($conn, $crop_abiotic_query, $crop_abiotic_values);
                            if (!$crop_abiotic_result) {
                                echo "Error inserting abiotic resistance data for $resistance.<br>";
                            }
                        } else {
                            echo "Abiotic resistance '$resistance' not found in the database.<br>";
                        }
                    }
                }
            }
        }

        fclose($handle);
        $_SESSION['message'] = "Data imported successfully.";
        header("location: ../../crop.php");
        die();
    } else {
        $_SESSION['message'] = "Error opening the file.";
        header("location: ../../crop.php");
        die();
    }
} else {
    $_SESSION['message'] = "Error uploading file.";
    header("location: ../../crop.php");
    die();
}
