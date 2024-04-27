<?php
session_start();
require "../../../functions/connections.php";

if (isset($_POST['update']) && $_SESSION['rank'] == 'Encoder') {
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
        $category_variety_id = $_POST['category_varietyID'];
        $crop_description = handleEmpty($_POST['crop_description']);
        $terrain_id = handleEmpty($_POST['terrainID']);
        $category_id = $_POST['categoryID'];
        $unique_code = $_POST['unique_codeID'];
        $current_image_seed = handleEmpty($_POST['current_image_seed']);
        $meaning_of_name = handleEmpty($_POST['meaning_of_name']);

        // loc.php
        $province_id = $_POST['province'];
        $municipality_id = $_POST['municipality'];
        $coordinates = handleEmpty($_POST['coordinates']);
        $barangay_id = $_POST['barangay'];
        $sitio_name = $_POST['sitio_name'];

        // set status and get user id
        $user_id = $_POST['userID'];
        $action = 'updating';
        $remarks = 'Updating, waiting for approval.';

        // pest resistance other
        $pest_other = isset($_POST['pest_other']) ? true : null;
        $pest_other_desc = isset($_POST['pest_other_desc']) ? handleEmpty($_POST['pest_other_desc']) : null;

        // abiotic resistance other
        $abiotic_other = isset($_POST['abiotic_other']) ? true : null;
        $abiotic_other_desc = isset($_POST['abiotic_other_desc']) ? handleEmpty($_POST['abiotic_other_desc']) : null;

        // Utilization Cultural Importance
        $significance = $_POST['significance'];
        $use = $_POST['use'];
        $indigenous_utilization = $_POST['indigenous_utilization'];
        $remarkable_features = $_POST['remarkable_features'];

        // get the unique code of the crop then add updating
        $newUniqueCode = $unique_code . '-' . 'UPDATING';

        // Array to store uploaded image names
        $uploadedImages = [];

        // Function to update crop seed image
        if (isset($_FILES['crop_seed_image']['name'][0]) && is_array($_FILES['crop_seed_image']['name']) && $_FILES['crop_seed_image']['name'][0] != "") {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_seed_image']['name'] as $key => $filename) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (in_array($ext, $extension)) {
                    $image = $filename;

                    // Check if the image name already exists in the database
                    // Check if any version of the image name already exists in the database
                    $query = "SELECT crop_seed_image FROM crop WHERE crop_seed_image LIKE $1";
                    $result = pg_query_params($conn, $query, array('%' . $image . '%'));


                    if ($result === false) {
                        die("Database query failed");
                    }

                    $count = pg_num_rows($result);

                    if ($count == 0) {
                        $image = "Crop_Seed_Image_" . rand(000, 999) . '.' . $ext;
                    } else {
                        // If image exists in database, use it as is
                        $uploadedImages[] = $image;
                        continue; // Skip the rest of the loop for this image
                    }

                    $uploadedImages[] = $image;
                    $source_path = $_FILES['crop_seed_image']['tmp_name'][$key];
                    $destination_path = "../../crop-page/modals/img/" . $image;

                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if (!$upload) {
                        echo "Image upload failed";
                        die();
                    }
                } else {
                    // Display error message for invalid file format
                    echo "Error: " . pg_last_error($conn);
                    die();
                }
            }

            $finalimgSeed = implode(',', $uploadedImages);

            // Delete images that are not present in the new input
            if ($current_image_seed != '') {
                $currentSeedImages = explode(',', $current_image_seed);

                foreach ($currentSeedImages as $image) {
                    if (!in_array($image, $uploadedImages)) {
                        $delete_path = "../../crop-page/modals/img/" . $image;
                        if (file_exists($delete_path)) {
                            unlink($delete_path);
                        }
                    }
                }
            }
        } else {
            // If no new image is selected, use the current image
            $currentSeedImages = explode(',', $current_image_seed);
            $uploadedImages = array_merge($uploadedImages, $currentSeedImages);
            $finalimgSeed = implode(',', $uploadedImages);
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
        //         $destination_path = "../../crop-page/modals/img/" . $image;

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
        //         $destination_path = "../../crop-page/modals/img/" . $image;

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

        // for creating a unique code for the updated submission

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
        $query_status = "INSERT INTO status (action, remarks)
                VALUES ($1, $2) RETURNING status_id";

        $value_status = array($action, $remarks);
        $query_run_status = pg_query_params($conn, $query_status, $value_status);

        if ($query_run_status) {
            $row_status = pg_fetch_row($query_run_status);
            $status_id = $row_status[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        //insert into crop table
        $queryCrop = "INSERT INTO crop (crop_variety, crop_description, unique_code,
        meaning_of_name, category_id, user_id, category_variety_id, terrain_id, utilization_cultural_id, crop_seed_image,
        status_id)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11) RETURNING crop_id";

        $valueCrops = array(
            $crop_variety, $crop_description, $newUniqueCode,
            $meaning_of_name, $category_id, $user_id, $category_variety_id, $terrain_id, $utilization_cultural_id, $finalimgSeed,
            $status_id
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
        $query_CropLoc = "INSERT into crop_location (crop_id, municipality_id, barangay_id, coordinates, sitio_name) VALUES ($1, $2, $3, $4) RETURNING crop_location_id";
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
            header("location: ../submission.php");
            exit();
        }

        // Check the category name and perform actions accordingly
        if ($get_category_name === 'Corn') {
            //* morphological Traits Corn
            // Vegetative state corn
            $corn_plant_height = $_POST['corn_plant_height'];
            $corn_leaf_width = $_POST['corn_leaf_width'];
            $corn_leaf_length = $_POST['corn_leaf_length'];
            $corn_maturity_time = $_POST['corn_maturity_time'];

            // Reproductive state corn
            $corn_yield_capacity = $_POST['corn_yield_capacity'];

            // seed traits corn
            $seed_length = $_POST['seed_length'];
            $seed_width = $_POST['seed_width'];
            $seed_shape = $_POST['seed_shape'];
            $seed_color = $_POST['seed_color'];

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
                $queryPest_other = "INSERT INTO corn_pest_resistance_other (corn_pest_other, corn_pest_other_desc) VALUES ($1, $2) returning corn_pest_other_id";
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
                $query_abioticOther = "INSERT INTO corn_abiotic_resistance_other (corn_abiotic_other, corn_abiotic_other_desc) VALUES ($1, $2) returning corn_abiotic_other_id";
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
            //* morphological Traits rice
            // Vegetative state rice
            $rice_plant_height = $_POST['rice_plant_height'];
            $rice_leaf_width = $_POST['rice_leaf_width'];
            $rice_leaf_length = $_POST['rice_leaf_length'];
            $rice_tillering_ability = $_POST['rice_tillering_ability'];
            $rice_maturity_time = $_POST['rice_maturity_time'];

            // Reproductive state rice
            $rice_yield_capacity = $_POST['rice_yield_capacity'];

            // Panicle traits
            $panicle_length = $_POST['panicle_length'];
            $panicle_width = $_POST['panicle_width'];
            $panicle_enclosed_by = $_POST['panicle_enclosed_by'];
            $panicle_remarkable_features = $_POST['panicle_remarkable_features'];

            // Flag Leaf traits rice
            $flag_length = $_POST['flag_length'];
            $flag_width = $_POST['flag_width'];
            $purplish_stripes = $_POST['purplish_stripes'];
            $pubescence = $_POST['pubescence'];
            $flag_remarkable_features = $_POST['flag_remarkable_features'];

            // Sensory traits rice
            $aroma = $_POST['aroma'];
            $quality_cooked_rice = $_POST['quality_cooked_rice'];
            $quality_leftover_rice = $_POST['quality_leftover_rice'];
            $hardness = $_POST['hardness'];
            $glutinous = isset($_POST['glutinous']) ? true : false;
            $volume_expansion = isset($_POST['volume_expansion']) ? true : false;

            // Handle rice category
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

            // Insert data into the respective tables
            // Insert into rice_pest_other table
            if ($pest_other) {
                $queryPest_other = "INSERT INTO rice_pest_resistance_other (rice_pest_other, rice_pest_other_desc) VALUES ($1, $2) returning rice_pest_other_id";
                $query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
                if ($query_run_Pest_other) {
                    $rowPest_other = pg_fetch_row($query_run_Pest_other);
                    $rice_pest_other_id = $rowPest_other[0];
                } else {
                    echo "Error: " . pg_last_error($conn);
                    exit(0);
                }
            }
            // Insert into rice_abiotic_other table
            if ($abiotic_other) {
                $query_abioticOther = "INSERT INTO rice_abiotic_resistance_other (rice_abiotic_other, rice_abiotic_other_desc) VALUES ($1, $2) returning rice_abiotic_other_id";
                $query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc));
                if ($query_run_abioticOther) {
                    $row_abioticOther = pg_fetch_row($query_run_abioticOther);
                    $rice_abiotic_other_id = $row_abioticOther[0];
                } else {
                    echo "Error: " . pg_last_error($conn);
                    exit(0);
                }
            }

            // rice traits
            $query_riceTraits = "INSERT into rice_traits (crop_id, vegetative_state_rice_id, reproductive_state_rice_id, sensory_traits_rice_id, rice_pest_other_id, 
            rice_abiotic_other_id) values ($1, $2, $3, $4, $5, $6) returning rice_traits_id";
            $query_run_riceTraits = pg_query_params($conn, $query_riceTraits, array(
                $crop_id, $vegetative_state_rice_id, $reproductive_state_rice_id, $sensory_traits_rice_id,
                $rice_pest_other_id, $rice_abiotic_other_id
            ));
            if ($query_run_riceTraits) {
                $row_riceTraits = pg_fetch_row($query_run_riceTraits);
                $rice_traits_id = $row_riceTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // abiotic resistance
            if (isset($_POST['abiotic_resistance']) && is_array($_POST['abiotic_resistance'])) {
                // Loop through the submitted pest resistance IDs
                foreach ($_POST['abiotic_resistance'] as $pest_id) {
                    // Assuming $rice_id contains the ID of the rice variety
                    $rice_is_checked_abiotic = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_abiotic = "INSERT INTO rice_abiotic_resistance (rice_traits_id, abiotic_resistance_id, rice_is_checked_abiotic) VALUES ($1, $2, $3)";
                    $query_run_abiotic = pg_query_params($conn, $query_abiotic, array($rice_traits_id, $pest_id, $rice_is_checked_abiotic));
                    if ($query_run_abiotic) {
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
                    // Assuming $rice_id contains the ID of the rice variety
                    $rice_is_checked_disease = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_disease = "INSERT INTO rice_disease_resistance (rice_traits_id, disease_resistance_id, rice_is_checked_disease) VALUES ($1, $2, $3)";
                    $query_run_disease = pg_query_params($conn, $query_disease, array($rice_traits_id, $disease_id, $rice_is_checked_disease));
                    if ($query_run_disease) {
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // pest resistance rice
            // Check if the pest resistance data is submitted
            if (isset($_POST['pest_resistance']) && is_array($_POST['pest_resistance'])) {
                // Loop through the submitted pest resistance IDs
                foreach ($_POST['pest_resistance'] as $pest_id) {
                    // Assuming $rice_id contains the ID of the rice variety
                    $rice_is_checked_pest = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_pest = "INSERT INTO rice_pest_resistance (rice_traits_id, pest_resistance_id, rice_is_checked_pest) VALUES ($1, $2, $3)";
                    $query_run_pest = pg_query_params($conn, $query_pest, array($rice_traits_id, $pest_id, $rice_is_checked_pest));
                    if ($query_run_pest) {
                        $row_pest = pg_fetch_row($query_run_pest);
                        $pest_resistance_id = $row_pest[0];
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }
        } elseif ($get_category_name === 'Root Crop') {
            //* morphological Traits rootcrop
            // Vegetative state rootcrop
            $rootcrop_plant_height = $_POST['rootcrop_plant_height'];
            $rootcrop_leaf_width = $_POST['rootcrop_leaf_width'];
            $rootcrop_leaf_length = $_POST['rootcrop_leaf_length'];
            $rootcrop_stem_leaf_desc = $_POST['rootcrop_stem_leaf_desc'];
            $rootcrop_maturity_time = $_POST['rootcrop_maturity_time'];

            // rootcrop traits
            $eating_quality = $_POST['eating_quality'];
            $rootcrop_color = $_POST['rootcrop_color'];
            $sweetness = $_POST['sweetness'];
            $rootcrop_remarkable_features = $_POST['rootcrop_remarkable_features'];

            // Handle root crops category
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

            // Insert data into the respective tables
            if ($pest_other) {
                // Insert into rootcrop_pest_other table
                $queryPest_other = "INSERT INTO rootcrop_pest_resistance_other (rootcrop_pest_other, rootcrop_pest_other_desc) VALUES ($1, $2) returning rootcrop_pest_other_id";
                $query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
                if ($query_run_Pest_other) {
                    $rowPest_other = pg_fetch_row($query_run_Pest_other);
                    $rootcrop_pest_other_id = $rowPest_other[0];
                } else {
                    echo "Error: " . pg_last_error($conn);
                    exit(0);
                }
            }

            if ($abiotic_other) {
                // Insert into rootcrop_abiotic_other table
                $query_abioticOther = "INSERT INTO rootcrop_abiotic_resistance_other (rootcrop_abiotic_other, rootcrop_abiotic_other_desc) VALUES ($1, $2) returning rootcrop_abiotic_other_id";
                $query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc));
                if ($query_run_abioticOther) {
                    $row_abioticOther = pg_fetch_row($query_run_abioticOther);
                    $rootcrop_abiotic_other_id = $row_abioticOther[0];
                } else {
                    echo "Error: " . pg_last_error($conn);
                    exit(0);
                }
            }

            // root crop traits
            $query_root_CropTraits = "INSERT into root_crop_traits (crop_id, vegetative_state_rootcrop_id, rootcrop_traits_id, rootcrop_pest_other_id, 
            rootcrop_abiotic_other_id) values ($1, $2, $3, $4, $5) returning root_crop_traits_id";
            $query_run_root_CropTraits = pg_query_params($conn, $query_root_CropTraits, array(
                $crop_id, $vegetative_state_rootcrop_id, $rootcrop_traits_id, $rootcrop_pest_other_id, $rootcrop_abiotic_other_id
            ));
            if ($query_run_root_CropTraits) {
                $row_root_CropTraits = pg_fetch_row($query_run_root_CropTraits);
                $root_crop_traits_id = $row_root_CropTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // abiotic resistance
            if (isset($_POST['abiotic_resistance']) && is_array($_POST['abiotic_resistance'])) {
                // Loop through the submitted pest resistance IDs
                foreach ($_POST['abiotic_resistance'] as $pest_id) {
                    // Assuming $rootcrop_id contains the ID of the rootcrop variety
                    $rootcrop_is_checked_abiotic = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_abiotic = "INSERT INTO rootcrop_abiotic_resistance (root_crop_traits_id, abiotic_resistance_id, rootcrop_is_checked_abiotic) VALUES ($1, $2, $3)";
                    $query_run_abiotic = pg_query_params($conn, $query_abiotic, array($root_crop_traits_id, $pest_id, $rootcrop_is_checked_abiotic));
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
                    // Assuming $rootcrop_id contains the ID of the rootcrop variety
                    $rootcrop_is_checked_disease = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_disease = "INSERT INTO rootcrop_disease_resistance (root_crop_traits_id, disease_resistance_id, rootcrop_is_checked_disease) VALUES ($1, $2, $3)";
                    $query_run_disease = pg_query_params($conn, $query_disease, array($root_crop_traits_id, $disease_id, $rootcrop_is_checked_disease));
                    if ($query_run_disease) {
                        $row_disease = pg_fetch_row($query_run_disease);
                        $disease_resistance_id = $row_disease[0];
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // pest resistance rootcrop
            // Check if the pest resistance data is submitted
            if (isset($_POST['pest_resistance']) && is_array($_POST['pest_resistance'])) {
                // Loop through the submitted pest resistance IDs
                foreach ($_POST['pest_resistance'] as $pest_id) {
                    // Assuming $rootcrop_id contains the ID of the rootcrop variety
                    $rootcrop_is_checked_pest = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_pest = "INSERT INTO rootcrop_pest_resistance (root_crop_traits_id, pest_resistance_id, rootcrop_is_checked_pest) VALUES ($1, $2, $3)";
                    $query_run_pest = pg_query_params($conn, $query_pest, array($root_crop_traits_id, $pest_id, $rootcrop_is_checked_pest));
                    if ($query_run_pest) {
                        $row_pest = pg_fetch_row($query_run_pest);
                        $pest_resistance_id = $row_pest[0];
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }
        } else {
            // Handle other categories or invalid category names
            // For example, set a default category or display an error message
        }

        // Commit the transaction if everything is successful
        $_SESSION['message'] = "Crop Updated Successfully Wait for Approval";
        pg_query($conn, "COMMIT");
        header("Location: ../submission.php");
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
