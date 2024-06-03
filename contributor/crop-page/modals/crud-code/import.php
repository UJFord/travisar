<?php
session_start();
require "../../../../functions/connections.php";

if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get the file path
    $file_tmp = $_FILES['file']['tmp_name'];
    $category_name = $_POST['category_name'];

    // get category_name
    $get_categoryName = "SELECT category_name from category where category_name ILIKE $1";
    $query_run_categoryName = pg_query_params($conn, $get_categoryName, array($category_name));

    if ($query_run_categoryName) {
        $row_categoryName = pg_fetch_assoc(($query_run_categoryName));
        $get_category_name = $row_categoryName['category_name'];
    } else {
        $_SESSION['message'] = "No category selected";
        header("location: ../../crop.php");
        exit();
    }
    // Read the file and import the data into PostgreSQL
    $handle = fopen($file_tmp, 'r');

    if($get_category_name === "Corn"){
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
                    echo "Category '$category_name' not found in the database.<br>";
                    continue;
                }

                // Find the category_variety_id for the given category_variety name
                $category_variety_query = "SELECT category_variety_id FROM category_variety WHERE category_variety_name ILIKE '$category_variety_name'";
                $category_variety_result = pg_query($conn, $category_variety_query);

                if ($category_variety_result && pg_num_rows($category_variety_result) > 0) {
                    $category_variety_row = pg_fetch_assoc($category_variety_result);
                    $category_variety_id = $category_variety_row['category_variety_id'];
                } else {
                    echo "Category variety '$category_variety_name' not found in the database.<br>";
                    continue;
                }

                // Find the terrain_id for the given terrain name
                $terrain_query = "SELECT terrain_id FROM terrain WHERE terrain_name ILIKE '$terrain'";
                $terrain_result = pg_query($conn, $terrain_query);

                if ($terrain_result && pg_num_rows($terrain_result) > 0) {
                    $terrain_row = pg_fetch_assoc($terrain_result);
                    $terrain_id = $terrain_row['terrain_id'];
                } else {
                    echo "Terrain '$terrain' not found in the database.<br>";
                    continue;
                }

                // Find the municipality_id for the given municipality name
                $municipality_query = "SELECT municipality_id FROM municipality WHERE municipality_name ILIKE '$municipality'";
                $municipality_result = pg_query($conn, $municipality_query);

                if ($municipality_result && pg_num_rows($municipality_result) > 0) {
                    $municipality_row = pg_fetch_assoc($municipality_result);
                    $municipality_id = $municipality_row['municipality_id'];
                } else {
                    echo "Municipality '$municipality' not found in the database.<br>";
                    continue;
                }

                // Find the barangay_id for the given barangay name
                $barangay_query = "SELECT barangay_id FROM barangay WHERE barangay_name ILIKE '$barangay'";
                $barangay_result = pg_query($conn, $barangay_query);

                if ($barangay_result && pg_num_rows($barangay_result) > 0) {
                    $barangay_row = pg_fetch_assoc($barangay_result);
                    $barangay_id = $barangay_row['barangay_id'];
                } else {
                    echo "Barangay '$barangay' not found in the database.<br>";
                    continue;
                }

                // Generate a unique code for the crop
                $queryLatestCode = "SELECT category_name FROM category WHERE category_id = $1";
                $resultLatestCode = pg_query_params($conn, $queryLatestCode, array($category_id));

                if ($resultLatestCode) {
                    $latestCodeRow = pg_fetch_assoc($resultLatestCode);
                    $latestCode = $latestCodeRow['category_name'];
                    $prefix = '';
                    $words = explode(' ', $latestCode);
                    foreach ($words as $word) {
                        $prefix .= strtoupper(substr($word, 0, 1));
                    }
                    $queryUniqueCodes = "SELECT unique_code FROM crop WHERE unique_code LIKE '$prefix%'";
                    $resultUniqueCodes = pg_query($conn, $queryUniqueCodes);
                    $existingNumbers = [];
                    while ($row = pg_fetch_assoc($resultUniqueCodes)) {
                        preg_match('/(\d+)$/', $row['unique_code'], $matches);
                        if (isset($matches[1])) {
                            $existingNumbers[] = intval($matches[1]);
                        }
                    }
                    $currentNumber = empty($existingNumbers) ? 0 : max($existingNumbers);
                    $newUniqueCode = $prefix . 'V' . '-' . str_pad($currentNumber + 1, 4, '0', STR_PAD_LEFT);
                }

                // Insert into utilization_cultural_importance table
                $query_utilCultural = "INSERT INTO utilization_cultural_importance (significance, \"use\", indigenous_utilization, remarkable_features) VALUES ($1, $2, $3, $4) RETURNING utilization_cultural_id";
                $value_utilCultural = array($significance, $use, $indigenous_utilization, $remarkable_features);
                $query_run_utilCultural = pg_query_params($conn, $query_utilCultural, $value_utilCultural);
                if ($query_run_utilCultural) {
                    $row_utilCultural = pg_fetch_row($query_run_utilCultural);
                    $utilization_cultural_id = $row_utilCultural[0];
                } else {
                    continue;
                }

                // Insert into status table
                $query_Status = "INSERT INTO status (action) VALUES ($1) RETURNING status_id";
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
                $crop_query = "INSERT INTO crop (category_id, category_variety_id, crop_variety, meaning_of_name, terrain_id, crop_description, unique_code, status_id, user_id, utilization_cultural_id) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10) RETURNING crop_id";
                $crop_values = array($category_id, $category_variety_id, $variety_name, $meaning_of_name, $terrain_id, $description, $newUniqueCode, $status_id, $user_id, $utilization_cultural_id);
                $crop_result = pg_query_params($conn, $crop_query, $crop_values);
                if ($crop_result) {
                    $crop_row = pg_fetch_row($crop_result);
                    $crop_id = $crop_row[0];
                } else {
                    echo "Error inserting crop data.<br>";
                    continue;
                }

                // Insert data into the crop_location table
                $crop_location_query = "INSERT INTO crop_location (crop_id, municipality_id, barangay_id, sitio_name, coordinates) VALUES ($1, $2, $3, $4, $5)";
                $crop_location_values = array($crop_id, $municipality_id, $barangay_id, $sitio, $coordinates);
                $crop_location_result = pg_query_params($conn, $crop_location_query, $crop_location_values);
                if (!$crop_location_result) {
                    echo "Error inserting crop location data.<br>";
                    continue;
                }
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
                                $crop_pest_query = "INSERT INTO corn_pest_resistance (corn_traits_id, pest_resistance_id) VALUES ($1, $2)";
                                $crop_pest_values = array($corn_traits_id, $pest_resistance_id);
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
                                $crop_disease_query = "INSERT INTO corn_disease_resistance (corn_traits_id, disease_resistance_id) VALUES ($1, $2)";
                                $crop_disease_values = array($corn_traits_id, $disease_resistance_id);
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
                                $crop_abiotic_query = "INSERT INTO corn_abiotic_resistance (corn_traits_id, abiotic_resistance_id) VALUES ($1, $2)";
                                $crop_abiotic_values = array($corn_traits_id, $abiotic_resistance_id);
                                $crop_abiotic_result = pg_query_params($conn, $crop_abiotic_query, $crop_abiotic_values);
                                if (!$crop_abiotic_result) {
                                    echo "Error inserting abiotic resistance data for $resistance.<br>";
                                    continue;
                                }
                            } else {
                                echo "Abiotic resistance '$resistance' not found in the database.<br>";
                                continue;
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
    }else if($get_category_name === "Rice") {
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
                $rice_plant_height = isset($data[10]) ? pg_escape_string($data[10]) : '';
                $rice_leaf_width = isset($data[11]) ? pg_escape_string($data[11]) : '';
                $rice_leaf_length = isset($data[12]) ? pg_escape_string($data[12]) : '';
                $rice_tillering_ability = isset($data[13]) ? pg_escape_string($data[13]) : '';
                $rice_maturity_time = isset($data[14]) ? pg_escape_string($data[14]) : '';
                $panicle_length = isset($data[15]) ? pg_escape_string($data[15]) : '';
                $panicle_width = isset($data[16]) ? pg_escape_string($data[16]) : '';
                $panicle_enclosed_by = isset($data[17]) ? pg_escape_string($data[17]) : '';
                $panicle_remarkable_features = isset($data[18]) ? pg_escape_string($data[18]) : '';
                $flag_length = isset($data[19]) ? pg_escape_string($data[19]) : '';
                $flag_width = isset($data[20]) ? pg_escape_string($data[20]) : '';
                $pubescence = isset($data[21]) ? pg_escape_string($data[21]) : '';
                $purplish_stripes = isset($data[22]) ? (strtolower($data[22]) === 'yes' ? 1 : 0) : '';
                $flag_remarkable_features = isset($data[23]) ? pg_escape_string($data[23]) : '';
                $rice_yield_capacity = isset($data[24]) ? pg_escape_string($data[24]) : '';
                $seed_length = isset($data[25]) ? pg_escape_string($data[25]) : '';
                $seed_width = isset($data[26]) ? pg_escape_string($data[26]) : '';
                $seed_shape = isset($data[27]) ? pg_escape_string($data[27]) : '';
                $seed_color = isset($data[28]) ? pg_escape_string($data[28]) : '';
                $significance = isset($data[29]) ? pg_escape_string($data[29]) : '';
                $use = isset($data[30]) ? pg_escape_string($data[30]) : '';
                $indigenous_utilization = isset($data[31]) ? pg_escape_string($data[31]) : '';
                $remarkable_features = isset($data[32]) ? pg_escape_string($data[32]) : '';
                $aroma = isset($data[33]) ? pg_escape_string($data[33]) : '';
                $quality_cooked_rice = isset($data[34]) ? pg_escape_string($data[34]) : '';
                $quality_leftover_rice = isset($data[35]) ? pg_escape_string($data[35]) : '';
                $volume_expansion = isset($data[36]) ? (strtolower($data[36]) === 'yes' ? 1 : 0) : '';
                $glutinous = isset($data[37]) ? (strtolower($data[37]) === 'yes' ? 1 : 0) : '';
                $texture = isset($data[38]) ? pg_escape_string($data[38]) : '';
                $pest_resistance = isset($data[39]) ? pg_escape_string($data[39]) : '';
                $disease_resistance = isset($data[40]) ? pg_escape_string($data[40]) : '';
                $abiotic_resistance = isset($data[41]) ? pg_escape_string($data[41]) : '';

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

                // Handle rice category traits
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

                // panicle traits
                $query_panicleTraits = "INSERT into panicle_traits_rice (panicle_length, panicle_width, panicle_enclosed_by, panicle_remarkable_features) values ($1, $2, $3, $4) returning panicle_traits_rice_id";
                $query_run_panicleTraits = pg_query_params($conn, $query_panicleTraits, array($panicle_length, $panicle_width, $panicle_enclosed_by, $panicle_remarkable_features));
                if ($query_run_panicleTraits) {
                    $row_panicleTraits = pg_fetch_row($query_run_panicleTraits);
                    $panicle_traits_rice_id = $row_panicleTraits[0];
                } else {
                    echo "panicle traits not saved in the database.<br>";
                    continue;
                }

                // flag traits
                $query_flagLeaf = "INSERT into flag_leaf_traits_rice (flag_length, flag_width, purplish_stripes, pubescence, flag_remarkable_features) values ($1, $2, $3, $4, $5) returning flag_leaf_traits_rice_id";
                $query_run_flagLeaf = pg_query_params($conn, $query_flagLeaf, array($flag_length, $flag_width, $purplish_stripes, $pubescence, $flag_remarkable_features));
                if ($query_run_flagLeaf) {
                    $row_flagLeaf = pg_fetch_row($query_run_flagLeaf);
                    $flag_leaf_traits_rice_id = $row_flagLeaf[0];
                } else {
                    echo "flag leaf traits not saved in the database.<br>";
                    continue;
                }

                // reproductive state rice
                $query_reproductiveState = "INSERT into reproductive_state_rice (rice_yield_capacity, seed_traits_id, panicle_traits_rice_id, flag_leaf_traits_rice_id) values ($1, $2, $3, $4) returning reproductive_state_rice_id";
                $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($rice_yield_capacity, $seed_traits_id, $panicle_traits_rice_id, $flag_leaf_traits_rice_id));
                if ($query_run_reproductiveState) {
                    $row_reproductiveState = pg_fetch_row($query_run_reproductiveState);
                    $reproductive_state_rice_id = $row_reproductiveState[0];
                } else {
                    echo "seed reproductive state saved in the database.<br>";
                    continue;
                }

                // vegetative state rice
                $query_vegetativeState = "INSERT into vegetative_state_rice (rice_plant_height, rice_leaf_width, rice_leaf_length, rice_tillering_ability, rice_maturity_time) values ($1, $2, $3, $4, $5) returning vegetative_state_rice_id";
                $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rice_plant_height, $rice_leaf_width, $rice_leaf_length, $rice_tillering_ability, $rice_maturity_time));
                if ($query_run_vegetativeState) {
                    $row_vegetativeState = pg_fetch_row($query_run_vegetativeState);
                    $vegetative_state_rice_id = $row_vegetativeState[0];
                } else {
                    echo "vegetative state not saved in the database.<br>";
                    continue;
                }

                // sensory traits rice
                $query_sensoryTraits = "INSERT into sensory_traits_rice (aroma, quality_cooked_rice, quality_leftover_rice, volume_expansion, glutinous, texture) values ($1, $2, $3, $4, $5, $6) returning sensory_traits_rice_id";
                $query_run_sensoryTraits = pg_query_params($conn, $query_sensoryTraits, array(
                    $aroma, $quality_cooked_rice, $quality_leftover_rice, $volume_expansion, $glutinous, $texture
                ));
                if ($query_run_sensoryTraits) {
                    $row_sensoryTraits = pg_fetch_row($query_run_sensoryTraits);
                    $sensory_traits_rice_id = $row_sensoryTraits[0];
                } else {
                    echo "sensory traits not saved in the database.<br>";
                    continue;
                }

                // rice traits
                $query_riceTraits = "INSERT into rice_traits (crop_id, vegetative_state_rice_id, reproductive_state_rice_id, sensory_traits_rice_id) values ($1, $2, $3, $4) returning rice_traits_id";
                $query_run_riceTraits = pg_query_params($conn, $query_riceTraits, array(
                    $crop_id, $vegetative_state_rice_id, $reproductive_state_rice_id, $sensory_traits_rice_id
                ));
                if ($query_run_riceTraits) {
                    $row_riceTraits = pg_fetch_row($query_run_riceTraits);
                    $rice_traits_id = $row_riceTraits[0];
                } else {
                    echo "rice traits not saved in the database.<br>";
                    continue;
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
                                $crop_pest_query = "INSERT INTO rice_pest_resistance (rice_traits_id, pest_resistance_id) VALUES ($1, $2)";
                                $crop_pest_values = array($rice_traits_id, $pest_resistance_id);
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
                                $crop_disease_query = "INSERT INTO rice_disease_resistance (rice_traits_id, disease_resistance_id) VALUES ($1, $2)";
                                $crop_disease_values = array($rice_traits_id, $disease_resistance_id);
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
                                $crop_abiotic_query = "INSERT INTO rice_abiotic_resistance (rice_traits_id, abiotic_resistance_id) VALUES ($1, $2)";
                                $crop_abiotic_values = array($rice_traits_id, $abiotic_resistance_id);
                                $crop_abiotic_result = pg_query_params($conn, $crop_abiotic_query, $crop_abiotic_values);
                                if (!$crop_abiotic_result) {
                                    echo "Error inserting abiotic resistance data for $resistance.<br>";
                                    continue;
                                }
                            } else {
                                echo "Abiotic resistance '$resistance' not found in the database.<br>";
                                continue;
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
    } else if ($get_category_name === "Root Crop") {
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
    }
} else {
    $_SESSION['message'] = "Error uploading file.";
    header("location: ../../crop.php");
    die();
}
