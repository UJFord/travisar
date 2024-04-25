<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['save']) && $_SESSION['rank'] == 'Curator' || $_SESSION['rank'] == 'Admin') {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        // Function to handle empty values
        function handleEmpty($value)
        {
            return empty($value) ? null : $value;
        }
        // get all the data in the form
        // gen.php
        $crop_variety = handleEmpty($_POST['crop_variety']);
        $category_variety_id = $_POST['category_variety_id'];
        $crop_description = handleEmpty($_POST['crop_description']);
        $terrain_id = handleEmpty($_POST['terrain_id']);
        $category_id = $_POST['category_id'];

        // loc.php
        $province_id = $_POST['province'];
        $municipality_id = $_POST['municipality'];
        $meaning_of_name = handleEmpty($_POST['meaning_of_name']);
        $coordinates = handleEmpty($_POST['coordinates']);
        $barangay_id = $_POST['barangay'];
        $sitio_name = $_POST['sitio_name'];

        $user_id = $_POST['user_id'];
        $action = 'approved';
        $remarks = 'Crop Approved';

        // pest resistance other
        $pest_other = isset($_POST['pest_other']) ? true : null;
        $pest_other_desc = isset($_POST['pest_other_desc']) ? handleEmpty($_POST['pest_other_desc']) : null;

        // abiotic resistance other
        $abiotic_other = isset($_POST['abiotic_other']) ? true : null;
        $abiotic_other_desc = isset($_POST['abiotic_other_desc']) ? handleEmpty($_POST['abiotic_other_desc']) : null;

        // Utilization Cultural Importance
        $significance = isset($_POST['significance']) ? handleEmpty($_POST['significance']) : null;
        $use = isset($_POST['use']) ? handleEmpty($_POST['use']) : null;
        $indigenous_utilization = isset($_POST['indigenous_utilization']) ? handleEmpty($_POST['indigenous_utilization']) : null;
        $remarkable_features = isset($_POST['remarkable_features']) ? handleEmpty($_POST['remarkable_features']) : null;

        //* morphological Traits Corn
        // Vegetative state corn
        $corn_plant_height = isset($_POST['corn_plant_height']) ? handleEmpty($_POST['corn_plant_height']) : null;
        $corn_leaf_width = isset($_POST['corn_leaf_width']) ? handleEmpty($_POST['corn_leaf_width']) : null;
        $corn_leaf_length = isset($_POST['corn_leaf_length']) ? handleEmpty($_POST['corn_leaf_length']) : null;
        $corn_maturity_time = isset($_POST['corn_maturity_time']) ? handleEmpty($_POST['corn_maturity_time']) : null;

        // Reproductive state corn
        $corn_yield_capacity = isset($_POST['corn_yield_capacity']) ? handleEmpty($_POST['corn_yield_capacity']) : null;

        // seed traits corn
        $seed_length = isset($_POST['seed_length']) ? handleEmpty($_POST['seed_length']) : null;
        $seed_width = isset($_POST['seed_width']) ? handleEmpty($_POST['seed_width']) : null;
        $seed_shape = isset($_POST['seed_shape']) ? handleEmpty($_POST['seed_shape']) : null;
        $seed_color = isset($_POST['seed_color']) ? handleEmpty($_POST['seed_color']) : null;

        //* morphological Traits rice
        // Vegetative state rice
        $rice_plant_height = isset($_POST['rice_plant_height']) ? handleEmpty($_POST['rice_plant_height']) : null;
        $rice_leaf_width = isset($_POST['rice_leaf_width']) ? handleEmpty($_POST['rice_leaf_width']) : null;
        $rice_leaf_length = isset($_POST['rice_leaf_length']) ? handleEmpty($_POST['rice_leaf_length']) : null;
        $rice_tillering_ability = isset($_POST['rice_tillering_ability']) ? handleEmpty($_POST['rice_tillering_ability']) : null;
        $rice_maturity_time = isset($_POST['rice_maturity_time']) ? handleEmpty($_POST['rice_maturity_time']) : null;

        // Reproductive state rice
        $rice_yield_capacity = isset($_POST['rice_yield_capacity']) ? handleEmpty($_POST['rice_yield_capacity']) : null;
        // Panicle traits
        $panicle_length = isset($_POST['panicle_length']) ? handleEmpty($_POST['panicle_length']) : null;
        $panicle_width = isset($_POST['panicle_width']) ? handleEmpty($_POST['panicle_width']) : null;
        $panicle_enclosed_by = isset($_POST['panicle_enclosed_by']) ? handleEmpty($_POST['panicle_enclosed_by']) : null;
        $panicle_remarkable_features = isset($_POST['panicle_remarkable_features']) ? handleEmpty($_POST['panicle_remarkable_features']) : null;
        // Flag Leaf traits rice
        $flag_length = isset($_POST['flag_length']) ? handleEmpty($_POST['flag_length']) : null;
        $flag_width = isset($_POST['flag_width']) ? handleEmpty($_POST['flag_width']) : null;
        $pubescence = isset($_POST['pubescence']) ? handleEmpty($_POST['pubescence']) : null;
        $flag_remarkable_features = isset($_POST['flag_remarkable_features']) ? handleEmpty($_POST['flag_remarkable_features']) : null;
        $purplish_stripes = isset($_POST['purplish_stripes']) ? true : false;

        // Sensory traits rice
        $aroma = isset($_POST['aroma']) ? handleEmpty($_POST['aroma']) : null;
        $quality_cooked_rice = isset($_POST['quality_cooked_rice']) ? handleEmpty($_POST['quality_cooked_rice']) : null;
        $quality_leftover_rice = isset($_POST['quality_leftover_rice']) ? handleEmpty($_POST['quality_leftover_rice']) : null;
        $hardness = isset($_POST['hardness']) ? handleEmpty($_POST['hardness']) : null;
        $volume_expansion = isset($_POST['volume_expansion']) ? true : false;
        $glutinous = isset($_POST['glutinous']) ? true : false;

        //* morphological Traits rootcrop
        // Vegetative state rootcrop
        $rootcrop_plant_height = isset($_POST['rootcrop_plant_height']) ? handleEmpty($_POST['rootcrop_plant_height']) : null;
        $rootcrop_leaf_width = isset($_POST['rootcrop_leaf_width']) ? handleEmpty($_POST['rootcrop_leaf_width']) : null;
        $rootcrop_leaf_length = isset($_POST['rootcrop_leaf_length']) ? handleEmpty($_POST['rootcrop_leaf_length']) : null;
        $rootcrop_stem_leaf_desc = isset($_POST['rootcrop_stem_leaf_desc']) ? handleEmpty($_POST['rootcrop_stem_leaf_desc']) : null;
        $rootcrop_maturity_time = isset($_POST['rootcrop_maturity_time']) ? handleEmpty($_POST['rootcrop_maturity_time']) : null;

        // rootcrop traits
        $eating_quality = isset($_POST['eating_quality']) ? handleEmpty($_POST['eating_quality']) : null;
        $rootcrop_color = isset($_POST['rootcrop_color']) ? handleEmpty($_POST['rootcrop_color']) : null;
        $sweetness = isset($_POST['sweetness']) ? handleEmpty($_POST['sweetness']) : null;
        $rootcrop_remarkable_features = isset($_POST['rootcrop_remarkable_features']) ? handleEmpty($_POST['rootcrop_remarkable_features']) : null;

        // Validate the form data
        if (empty($crop_variety) || empty($category_variety_id) || empty($category_id) || empty($terrain_id) || empty($province_id) || empty($municipality_id) || empty($barangay_id)) {
            throw new Exception("All fields are required.");
        }

        $crop_seed_imageArray = []; // Initialize the array

        // Check if an image for crop seed image is selected
        if (isset($_FILES['crop_seed_image']['name']) && is_array($_FILES['crop_seed_image']['name'])) {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_seed_image']['name'] as $key => $value) {
                $filename = $_FILES['crop_seed_image']['name'][$key];
                $filename_tmp = $_FILES['crop_seed_image']['tmp_name'][$key];
                $destination_path = "../img/" . $filename;
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $finalimg = '';

                if (in_array($ext, $extension)) {
                    // Auto rename image
                    $image = "Crop_seed_image_" . rand(000, 999) . '.' . $ext;

                    // Check if the image name already exists in the database
                    while (true) {
                        $query = "SELECT crop_seed_image FROM crop WHERE crop_seed_image = $1";
                        $result = pg_query_params($conn, $query, array($image));

                        if ($result === false) {
                            break;
                        }

                        $count = pg_num_rows($result);

                        if ($count == 0) {
                            break;
                        } else {
                            // If the image name exists, generate a new one
                            $image = "Crop_seed_image_" . rand(000, 999) . '.' . $ext;
                        }
                    }

                    $source_path = $_FILES['crop_seed_image']['tmp_name'][$key];
                    $destination_path = "../img/" . $image;

                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if (!$upload) {
                        echo "wala na upload ang image";
                        echo "Error: " . pg_last_error($conn);
                        die();
                    }

                    $finalimg_seed = $image;
                    $crop_seed_imageArray[] = $finalimg_seed; // Add image name to the array
                } else {
                    // Display error message for invalid file format
                    echo "invalid ang file format image";
                    echo "Error: " . pg_last_error($conn);
                }
            }
        }

        $crop_seed_imageString = implode(',', $crop_seed_imageArray);

        // If no image is selected, set it to null
        if (empty($crop_seed_imageArray)) {
            $crop_seed_imageString = null;
        }

        // Check if an image for crop reproductive image is selected
        // if (isset($_FILES['crop_vegetative_image']['name']) && $_FILES['crop_vegetative_image']['name'] != '') {
        //     $extension = array('jpg', 'jpeg', 'png', 'gif');

        //     $filename = $_FILES['crop_vegetative_image']['name'];
        //     $filename_tmp = $_FILES['crop_vegetative_image']['tmp_name'];
        //     $ext = pathinfo($filename, PATHINFO_EXTENSION);

        //     if (in_array($ext, $extension)) {
        //         // Auto rename image
        //         $image = "Crop_Vegetative_Image_" . rand(000, 999) . '.' . $ext;

        //         // Check if the image name already exists in the database
        //         while (true) {
        //             $query = "SELECT crop_vegetative_image FROM crop WHERE crop_vegetative_image = $1";
        //             $result = pg_query_params($conn, $query, array($image));

        //             if ($result === false) {
        //                 break;
        //             }

        //             $count = pg_num_rows($result);

        //             if ($count == 0) {
        //                 break;
        //             } else {
        //                 // If the image name exists, generate a new one
        //                 $image = "Crop_Vegetative_Image_" . rand(000, 999) . '.' . $ext;
        //             }
        //         }

        //         $source_path = $_FILES['crop_vegetative_image']['tmp_name'];
        //         $destination_path = "../img/" . $image;

        //         // Upload the image
        //         $upload = move_uploaded_file($source_path, $destination_path);

        //         // Check whether the image is uploaded or not
        //         if (!$upload) {
        //             echo "wala na upload ang image";
        //             echo "Error: " . pg_last_error($conn);
        //             die();
        //         }

        //         $finalimg_vege = $image;
        //     } else {
        //         // Display error message for invalid file format
        //         echo "invalid ang file format image";
        //         echo "Error: " . pg_last_error($conn);
        //         die();
        //     }
        // } else {
        //     // If no image is selected, set it  
        // }
        // $crop_vegetative_image = $finalimg_vege;

        // Check if an image for crop reproductive image is selected
        // if (isset($_FILES['crop_reproductive_image']['name']) && $_FILES['crop_reproductive_image']['name'] != '') {
        //     $extension = array('jpg', 'jpeg', 'png', 'gif');

        //     $filename = $_FILES['crop_reproductive_image']['name'];
        //     $filename_tmp = $_FILES['crop_reproductive_image']['tmp_name'];
        //     $ext = pathinfo($filename, PATHINFO_EXTENSION);

        //     if (in_array($ext, $extension)) {
        //         // Auto rename image
        //         $image = "Crop_Reproductive_Image_" . rand(000, 999) . '.' . $ext;

        //         // Check if the image name already exists in the database
        //         while (true) {
        //             $query = "SELECT crop_reproductive_image FROM crop WHERE crop_reproductive_image = $1";
        //             $result = pg_query_params($conn, $query, array($image));

        //             if ($result === false) {
        //                 break;
        //             }

        //             $count = pg_num_rows($result);

        //             if ($count == 0) {
        //                 break;
        //             } else {
        //                 // If the image name exists, generate a new one
        //                 $image = "Crop_Reproductive_Image_" . rand(000, 999) . '.' . $ext;
        //             }
        //         }

        //         $source_path = $_FILES['crop_reproductive_image']['tmp_name'];
        //         $destination_path = "../img/" . $image;

        //         // Upload the image
        //         $upload = move_uploaded_file($source_path, $destination_path);

        //         // Check whether the image is uploaded or not
        //         if (!$upload) {
        //             echo "wala na upload ang image";
        //             echo "Error: " . pg_last_error($conn);
        //             die();
        //         }

        //         $finalimg_repro = $image;
        //     } else {
        //         // Display error message for invalid file format
        //         echo "invalid ang file format image";
        //         echo "Error: " . pg_last_error($conn);
        //         die();
        //     }
        // } else {
        //     // If no image is selected, set it  
        // }
        // $crop_reproductive_image = $finalimg_repro;

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
            $newUniqueCode = $prefix . 'V' . ($currentNumber + 1);
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
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        //insert into status table
        $query_Status = "INSERT INTO status (action, remarks)
                VALUES ($1, $2) RETURNING status_id";

        $value_Status = array($action, $remarks);
        $query_run_Status = pg_query_params($conn, $query_Status, $value_Status);

        if ($query_run_Status) {
            $row_Status = pg_fetch_row($query_run_Status);
            $status_id = $row_Status[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        //insert into crop table
        $queryCrop = "INSERT INTO crop (crop_variety, crop_description, unique_code, meaning_of_name, category_id, user_id, 
        category_variety_id, terrain_id, utilization_cultural_id, crop_seed_image, status_id)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11) RETURNING crop_id";

        $valueCrops = array(
            $crop_variety, $crop_description, $newUniqueCode, $meaning_of_name, $category_id, $user_id, $category_variety_id,
            $terrain_id, $utilization_cultural_id, $crop_seed_imageString, $status_id
        );
        $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

        if ($query_run_Crop) {
            $row_crop = pg_fetch_row($query_run_Crop);
            $crop_id = $row_crop[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // save into Crop Location Table
        $query_CropLoc = "INSERT into crop_location (crop_id, municipality_id, barangay_id, coordinates, sitio_name) VALUES ($1, $2, $3, $4, $5) RETURNING crop_location_id";
        $query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($crop_id, $municipality_id, $barangay_id, $coordinates, $sitio_name));

        if ($query_run_CropLoc) {
            // Check if any rows were affected
            if (pg_affected_rows($query_run_CropLoc) > 0) {
                $row_CropLoc = pg_fetch_row($query_run_CropLoc);
                $crop_location_id = $row_CropLoc[0];
            } else {
                echo "Error: No rows affected";
                exit(0);
            }
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        //* for saving the morphological traits depending on the category selected
        // get category_name
        $get_categoryName = "SELECT category_name from category where category_id = $1";
        $query_run_categoryName = pg_query_params($conn, $get_categoryName, array($category_id));

        if ($query_run_categoryName) {
            $row_categoryName = pg_fetch_assoc(($query_run_categoryName));
            $get_category_name = $row_categoryName['category_name'];
        } else {
            $_SESSION['message'] = "No category selected";
            header("location: ../../crop.php");
            exit();
        }

        //references
        // Loop through the $_POST data to extract references
        $references = [];
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'references_') !== false) {
                echo $references[] = $value;
            }
        }

        // Save references into references Table
        foreach ($references as $reference) {
            $query_refer = "INSERT into \"references\" (crop_id, link) VALUES ($1, $2) RETURNING references_id";
            $query_run_refer = pg_query_params($conn, $query_refer, array($crop_id, $reference));

            if ($query_run_refer) {
                // Check if any rows were affected
                if (pg_affected_rows($query_run_refer) > 0) {
                    $row_refer = pg_fetch_row($query_run_refer);
                    $references_id = $row_refer[0];
                } else {
                    echo "Error: No rows affected";
                    exit(0);
                }
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }
        }

        // Check the category name and perform actions accordingly
        if ($get_category_name === 'Corn') {
            // Handle corn category traits
            // seed traits
            $query_seedTraits = "INSERT into seed_traits (seed_length, seed_width, seed_shape, seed_color) values ($1, $2, $3, $4) returning seed_traits_id";
            $query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color));
            if ($query_run_seedTraits) {
                $row_seedTraits = pg_fetch_row($query_run_seedTraits);
                $seed_traits_id = $row_seedTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // reproductive state corn
            $query_reproductiveState = "INSERT into reproductive_state_corn (corn_yield_capacity, seed_traits_id) values ($1, $2) returning reproductive_state_corn_id";
            $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($corn_yield_capacity, $seed_traits_id));
            if ($query_run_reproductiveState) {
                $row_reproductiveState = pg_fetch_row($query_run_reproductiveState);
                $reproductive_state_corn_id = $row_reproductiveState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state corn
            $query_vegetativeState = "INSERT into vegetative_state_corn (corn_plant_height, corn_leaf_width, corn_leaf_length, corn_maturity_time) values ($1, $2, $3, $4) returning vegetative_state_corn_id";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($corn_plant_height, $corn_leaf_width, $corn_leaf_length, $corn_maturity_time));
            if ($query_run_vegetativeState) {
                $row_vegetativeState = pg_fetch_row($query_run_vegetativeState);
                $vegetative_state_corn_id = $row_vegetativeState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // Insert data into the respective tables
            if ($pest_other) {
                // Insert into corn_pest_other table
                $queryPest_other = "INSERT INTO corn_pest_resistance_other (corn_pest_other, corn_pest_other_desc) VALUES ($1, $2)";
                $query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
                if ($query_run_Pest_other) {
                    $rowPest_other = pg_fetch_row($query_run_Pest_other);
                    $corn_pest_other_id = $rowPest_other[0];
                } else {
                    echo "Error: " . pg_last_error($conn);
                    exit(0);
                }
            }

            if ($abiotic_other) {
                // Insert into corn_abiotic_other table
                $query_abioticOther = "INSERT INTO corn_abiotic_resistance_other (corn_abiotic_other, corn_abiotic_other_desc) VALUES ($1, $2)";
                $query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc));
                if ($query_run_abioticOther) {
                    $row_abioticOther = pg_fetch_row($query_run_abioticOther);
                    $corn_abiotic_other_id = $row_abioticOther[0];
                } else {
                    echo "Error: " . pg_last_error($conn);
                    exit(0);
                }
            }

            // corn traits
            $query_cornTraits = "INSERT into corn_traits (crop_id, vegetative_state_corn_id, reproductive_state_corn_id, 
            corn_pest_other_id, corn_abiotic_other_id) values ($1, $2, $3, $4, $5) returning corn_traits_id";
            $query_run_cornTraits = pg_query_params($conn, $query_cornTraits, array(
                $crop_id, $vegetative_state_corn_id, $reproductive_state_corn_id,
                $corn_pest_other_id, $corn_abiotic_other_id
            ));
            if ($query_run_cornTraits) {
                $row_cornTraits = pg_fetch_row($query_run_cornTraits);
                $corn_traits_id = $row_cornTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // abiotic resistance
            if (isset($_POST['abiotic_resistance']) && is_array($_POST['abiotic_resistance'])) {
                // Loop through the submitted pest resistance IDs
                foreach ($_POST['abiotic_resistance'] as $pest_id) {
                    // Assuming $corn_id contains the ID of the corn variety
                    $corn_is_checked_abiotic = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_abiotic = "INSERT INTO corn_abiotic_resistance (corn_traits_id, abiotic_resistance_id, corn_is_checked_abiotic) VALUES ($1, $2, $3)";
                    $query_run_abiotic = pg_query_params($conn, $query_abiotic, array($corn_traits_id, $pest_id, $corn_is_checked_abiotic));
                    if ($query_run_abiotic) {
                        $row_abiotic = pg_fetch_row($query_run_abiotic);
                        $abiotic_resistance_id = $row_abiotic[0];
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // disease resistance
            if (isset($_POST['disease_resistance']) && is_array($_POST['disease_resistance'])) {
                // Loop through the submitted pest resistance IDs
                foreach ($_POST['disease_resistance'] as $disease_id) {
                    // Assuming $corn_id contains the ID of the corn variety
                    $corn_is_checked_disease = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_disease = "INSERT INTO corn_disease_resistance (corn_traits_id, disease_resistance_id, corn_is_checked_disease) VALUES ($1, $2, $3)";
                    $query_run_disease = pg_query_params($conn, $query_disease, array($corn_traits_id, $disease_id, $corn_is_checked_disease));
                    if ($query_run_disease) {
                        $row_disease = pg_fetch_row($query_run_disease);
                        $disease_resistance_id = $row_disease[0];
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // pest resistance corn
            // Check if the pest resistance data is submitted
            if (isset($_POST['pest_resistance']) && is_array($_POST['pest_resistance'])) {
                // Loop through the submitted pest resistance IDs
                foreach ($_POST['pest_resistance'] as $pest_id) {
                    // Assuming $corn_id contains the ID of the corn variety
                    $corn_is_checked_pest = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_pest = "INSERT INTO corn_pest_resistance (corn_traits_id, pest_resistance_id, corn_is_checked_pest) VALUES ($1, $2, $3)";
                    $query_run_pest = pg_query_params($conn, $query_pest, array($corn_traits_id, $pest_id, $corn_is_checked_pest));
                    if ($query_run_pest) {
                        $row_pest = pg_fetch_row($query_run_pest);
                        $pest_resistance_id = $row_pest[0];
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }
        } elseif ($get_category_name === 'Rice') {
            // Handle rice category
            // abiotic resistance rice
            $query_abioticRes = "INSERT into abiotic_resistance_rice (rice_drought, rice_salinity, rice_heat, harmful_radiation, rice_abiotic_other, rice_abiotic_other_desc) values ($1, $2, $3, $4, $5, $6) returning abiotic_resistance_rice_id";
            $query_run_abioticRes = pg_query_params($conn, $query_abioticRes, array($rice_drought, $rice_salinity, $rice_heat, $harmful_radiation, $rice_abiotic_other, $rice_abiotic_other_desc));
            if ($query_run_abioticRes) {
                $row_abioticRes = pg_fetch_row($query_run_abioticRes);
                $abiotic_resistance_rice_id = $row_abioticRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // disease resistance
            $query_diseaseRes = "INSERT into disease_resistance (bacterial, viral, fungus) values ($1, $2, $3) returning disease_resistance_id";
            $query_run_diseaseRes = pg_query_params($conn, $query_diseaseRes, array($bacterial, $viral, $fungus));
            if ($query_run_diseaseRes) {
                $row_diseaseRes = pg_fetch_row($query_run_diseaseRes);
                $disease_resistance_id = $row_diseaseRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // pest resistance rice
            $query_pestRes = "INSERT into pest_resistance_rice (rice_borers, rice_snail, hoppers, rice_black_bug, leptocorisa, leaf_folder, rice_birds, rice_ants, 
                        rice_rats, rice_army_worms, rice_others, rice_others_desc) values ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12) returning pest_resistance_rice_id";
            $query_run_pestRes = pg_query_params($conn, $query_pestRes, array(
                $rice_borers, $rice_snail, $hoppers, $rice_black_bug, $leptocorisa,
                $leaf_folder, $rice_birds, $rice_ants, $rice_rats, $rice_army_worms, $rice_others, $rice_others_desc
            ));
            if ($query_run_pestRes) {
                $row_pestRes = pg_fetch_row($query_run_pestRes);
                $pest_resistance_rice_id = $row_pestRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // seed traits
            $query_seedTraits = "INSERT into seed_traits (seed_length, seed_width, seed_shape, seed_color) values ($1, $2, $3, $4) returning seed_traits_id";
            $query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color));
            if ($query_run_seedTraits) {
                $row_seedTraits = pg_fetch_row($query_run_seedTraits);
                $seed_traits_id = $row_seedTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // panicle traits
            $query_panicleTraits = "INSERT into panicle_traits_rice (panicle_length, panicle_width, panicle_enclosed_by, panicle_remarkable_features) values ($1, $2, $3, $4) returning panicle_traits_rice_id";
            $query_run_panicleTraits = pg_query_params($conn, $query_panicleTraits, array($panicle_length, $panicle_width, $panicle_enclosed_by, $panicle_remarkable_features));
            if ($query_run_panicleTraits) {
                $row_panicleTraits = pg_fetch_row($query_run_panicleTraits);
                $panicle_traits_rice_id = $row_panicleTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // flag traits
            $query_flagLeaf = "INSERT into flag_leaf_traits_rice (flag_length, flag_width, purplish_stripes, pubescence, flag_remarkable_features) values ($1, $2, $3, $4, $5) returning flag_leaf_traits_rice_id";
            $query_run_flagLeaf = pg_query_params($conn, $query_flagLeaf, array($flag_length, $flag_width, $purplish_stripes, $pubescence, $flag_remarkable_features));
            if ($query_run_flagLeaf) {
                $row_flagLeaf = pg_fetch_row($query_run_flagLeaf);
                $flag_leaf_traits_rice_id = $row_flagLeaf[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // reproductive state rice
            $query_reproductiveState = "INSERT into reproductive_state_rice (rice_yield_capacity, seed_traits_id, panicle_traits_rice_id, flag_leaf_traits_rice_id) values ($1, $2, $3, $4) returning reproductive_state_rice_id";
            $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($rice_yield_capacity, $seed_traits_id, $panicle_traits_rice_id, $flag_leaf_traits_rice_id));
            if ($query_run_reproductiveState) {
                $row_reproductiveState = pg_fetch_row($query_run_reproductiveState);
                $reproductive_state_rice_id = $row_reproductiveState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state rice
            $query_vegetativeState = "INSERT into vegetative_state_rice (rice_plant_height, rice_leaf_width, rice_leaf_length, rice_tillering_ability, rice_maturity_time) values ($1, $2, $3, $4, $5) returning vegetative_state_rice_id";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rice_plant_height, $rice_leaf_width, $rice_leaf_length, $rice_tillering_ability, $rice_maturity_time));
            if ($query_run_vegetativeState) {
                $row_vegetativeState = pg_fetch_row($query_run_vegetativeState);
                $vegetative_state_rice_id = $row_vegetativeState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // sensory traits rice
            $query_sensoryTraits = "INSERT into sensory_traits_rice (aroma, quality_cooked_rice, quality_leftover_rice, volume_expansion, glutinous, hardness) values ($1, $2, $3, $4, $5, $6) returning sensory_traits_rice_id";
            $query_run_sensoryTraits = pg_query_params($conn, $query_sensoryTraits, array($aroma, $quality_cooked_rice, $quality_leftover_rice, $volume_expansion, $glutinous, $hardness));
            if ($query_run_sensoryTraits) {
                $row_sensoryTraits = pg_fetch_row($query_run_sensoryTraits);
                $sensory_traits_rice_id = $row_sensoryTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // rice traits
            $query_riceTraits = "INSERT into rice_traits (crop_id, vegetative_state_rice_id, reproductive_state_rice_id, sensory_traits_rice_id, pest_resistance_rice_id, 
            disease_resistance_id, abiotic_resistance_rice_id) values ($1, $2, $3, $4, $5, $6, $7) returning rice_traits_id";
            $query_run_riceTraits = pg_query_params($conn, $query_riceTraits, array(
                $crop_id, $vegetative_state_rice_id, $reproductive_state_rice_id, $sensory_traits_rice_id,
                $pest_resistance_rice_id, $disease_resistance_id, $abiotic_resistance_rice_id
            ));
            if ($query_run_riceTraits) {
                $row_riceTraits = pg_fetch_row($query_run_riceTraits);
                $rice_traits_id = $row_riceTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }
        } elseif ($get_category_name === 'Root Crop') {
            // Handle root crops category
            // abiotic resistance
            $query_abioticRes = "INSERT into abiotic_resistance (drought, salinity, heat, abiotic_other, abiotic_other_desc) values ($1, $2, $3, $4, $5) returning abiotic_resistance_id";
            $query_run_abioticRes = pg_query_params($conn, $query_abioticRes, array($drought, $salinity, $heat, $abiotic_other, $abiotic_other_desc));
            if ($query_run_abioticRes) {
                $row_abioticRes = pg_fetch_row($query_run_abioticRes);
                $abiotic_resistance_id = $row_abioticRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // disease resistance
            $query_diseaseRes = "INSERT into disease_resistance (bacterial, viral, fungus) values ($1, $2, $3) returning disease_resistance_id";
            $query_run_diseaseRes = pg_query_params($conn, $query_diseaseRes, array($bacterial, $viral, $fungus));
            if ($query_run_diseaseRes) {
                $row_diseaseRes = pg_fetch_row($query_run_diseaseRes);
                $disease_resistance_id = $row_diseaseRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // pest resistance rootcrop
            $query_pestRes = "INSERT into pest_resistance_rootcrop (root_aphids, root_knot_nematodes, rootcrop_cutworms, white_grubs, termites, weevils, flea_beetles, rootcrop_snails, 
                        rootcrop_ants, rootcrop_rats, rootcrop_others, rootcrop_others_desc) values ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12) returning pest_resistance_rootcrop_id";
            $query_run_pestRes = pg_query_params($conn, $query_pestRes, array(
                $root_aphids, $root_knot_nematodes, $rootcrop_cutworms, $white_grubs, $termites,
                $weevils, $flea_beetles, $rootcrop_snails, $rootcrop_ants, $rootcrop_rats, $rootcrop_others, $rootcrop_others_desc
            ));
            if ($query_run_pestRes) {
                $row_pestRes = pg_fetch_row($query_run_pestRes);
                $pest_resistance_rootcrop_id = $row_pestRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // rootcrop traits
            $query_rootcropTraits = "INSERT into rootcrop_traits (eating_quality, rootcrop_color, sweetness, rootcrop_remarkable_features) values ($1, $2, $3, $4) returning rootcrop_traits_id";
            $query_run_rootcropTraits = pg_query_params($conn, $query_rootcropTraits, array($eating_quality, $rootcrop_color, $sweetness, $rootcrop_remarkable_features));
            if ($query_run_rootcropTraits) {
                $row_rootcropTraits = pg_fetch_row($query_run_rootcropTraits);
                $rootcrop_traits_id = $row_rootcropTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state rootcrop
            $query_vegetativeState = "INSERT into vegetative_state_rootcrop (rootcrop_plant_height, rootcrop_leaf_width, rootcrop_leaf_length, rootcrop_stem_leaf_desc, rootcrop_maturity_time) values ($1, $2, $3, $4, $5) returning vegetative_state_rootcrop_id";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rootcrop_plant_height, $rootcrop_leaf_width, $rootcrop_leaf_length, $rootcrop_stem_leaf_desc, $rootcrop_maturity_time));
            if ($query_run_vegetativeState) {
                $row_vegetativeState = pg_fetch_row($query_run_vegetativeState);
                $vegetative_state_rootcrop_id = $row_vegetativeState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // root crop traits
            $query_root_CropTraits = "INSERT into root_crop_traits (crop_id, vegetative_state_rootcrop_id, rootcrop_traits_id, pest_resistance_rootcrop_id, disease_resistance_id, abiotic_resistance_id) values ($1, $2, $3, $4, $5, $6) returning root_crop_traits_id";
            $query_run_root_CropTraits = pg_query_params($conn, $query_root_CropTraits, array(
                $crop_id, $vegetative_state_rootcrop_id, $rootcrop_traits_id, $pest_resistance_rootcrop_id, $disease_resistance_id, $abiotic_resistance_id
            ));
            if ($query_run_root_CropTraits) {
                $row_root_CropTraits = pg_fetch_row($query_run_root_CropTraits);
                $root_Crop_traits_id = $row_root_CropTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }
        } else {
            // Handle other categories or invalid category names
            // For example, set a default category or display an error message
        }

        // Commit the transaction if everything is successful
        $_SESSION['message'] = "Crop Created Successfully";
        pg_query($conn, "COMMIT");
        header("Location: ../../crop.php");
        exit(0);
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Crop not Saved';
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
