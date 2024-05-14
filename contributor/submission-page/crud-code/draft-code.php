<?php
session_start();
require "../../../functions/connections.php";

if (isset($_POST['save_draft']) && $_SESSION['rank'] == 'Curator' || $_SESSION['rank'] == 'Admin') {
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
        $crop_description = handleEmpty($_POST['crop_description']);
        $meaning_of_name = handleEmpty($_POST['meaning_of_name']);
        $current_image_seed = handleEmpty($_POST['current_image_seed']);
        $current_image_veg = handleEmpty($_POST['current_image_veg']);
        $current_image_rep = handleEmpty($_POST['current_image_rep']);
        $category_id = handleEmpty($_POST['category_id']);
        $category_variety_id = handleEmpty($_POST['category_variety_id']);
        $terrain_id = handleEmpty($_POST['terrain_id']);

        // status
        $action = "Approved";
        $status_id = $_POST['statusIDdraft'];

        // loc.php
        $province_id = $_POST['province'];
        $municipality_id = $_POST['municipality'];
        $coordinates = handleEmpty($_POST['coordinates']);
        $barangay_id = $_POST['barangay'];
        $sitio_name = $_POST['sitio_name'];

        // id's
        $crop_location_id = handleEmpty($_POST['crop_location_id-Draft']);
        $crop_id = handleEmpty($_POST['crop_idDraft']);
        $seed_traits_id = handleEmpty($_POST['seed_traitsIDdraft']);
        $utilization_cultural_id = handleEmpty($_POST['utilization_culturalIDdraft']);
        $corn_pest_other_id = handleEmpty($_POST['corn_pest_otherIDdraft']);
        $corn_abiotic_other_id = handleEmpty($_POST['corn_abiotic_otherIDdraft']);
        $rice_pest_other_id = handleEmpty($_POST['rice_pest_otherIDdraft']);
        $rice_abiotic_other_id = handleEmpty($_POST['rice_abiotic_otherIDdraft']);
        $rootcrop_pest_other_id = handleEmpty($_POST['rootcrop_pest_otherIDdraft']);
        $rootcrop_abiotic_other_id = handleEmpty($_POST['rootcrop_abiotic_otherIDdraft']);
        $corn_traits_id = handleEmpty($_POST['corn_traitsIDdraft']);
        $rice_traits_id = handleEmpty($_POST['rice_traitsIDdraft']);
        $root_crop_traits_id = handleEmpty($_POST['root_crop_traitsIDdraft']);

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
        $purplish_stripes = isset($_POST['purplish_stripes']) ? handleEmpty($_POST['purplish_stripes']) : null;
        $pubescence = isset($_POST['pubescence']) ? handleEmpty($_POST['pubescence']) : null;
        $flag_remarkable_features = isset($_POST['flag_remarkable_features']) ? handleEmpty($_POST['flag_remarkable_features']) : null;

        // Sensory traits rice
        $aroma = isset($_POST['aroma']) ? handleEmpty($_POST['aroma']) : null;
        $quality_cooked_rice = isset($_POST['quality_cooked_rice']) ? handleEmpty($_POST['quality_cooked_rice']) : null;
        $quality_leftover_rice = isset($_POST['quality_leftover_rice']) ? handleEmpty($_POST['quality_leftover_rice']) : null;
        $volume_expansion = isset($_POST['volume_expansion']) ? handleEmpty($_POST['volume_expansion']) : null;
        $glutinous = isset($_POST['glutinous']) ? handleEmpty($_POST['glutinous']) : null;
        $texture = isset($_POST['texture']) ? handleEmpty($_POST['texture']) : null;

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
        if (empty($crop_variety) || empty($municipality_id) || empty($barangay_id) || empty($category_id) || empty($category_variety_id)) {
            $_SESSION['message'] = "A required field is empty please fill the required fields.";
            header("location: ../submission.php");
            exit();
        }

        // Array to store uploaded image seed names
        $uploadedImagesSeed = [];

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
                        $uploadedImagesSeed[] = $image;
                        continue; // Skip the rest of the loop for this image
                    }

                    $uploadedImagesSeed[] = $image;
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
                    $_SESSION['message'] = "Invalid file format for image";
                    header("location: ../submission.php");
                    die();
                }
            }

            $finalimgSeed = implode(',', $uploadedImagesSeed);

            // Delete images that are not present in the new input
            if ($current_image_seed != '') {
                $currentSeedImages = explode(',', $current_image_seed);

                foreach ($currentSeedImages as $image) {
                    if (!in_array($image, $uploadedImagesSeed)) {
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
            $uploadedImagesSeed = array_merge($uploadedImagesSeed, $currentSeedImages);
            $finalimgSeed = implode(',', $uploadedImagesSeed);
        }

        // Array to store uploaded Vegetative image  names
        $uploadedImagesVeg = [];
        // Function to update crop seed image
        if (isset($_FILES['crop_vegetative_image']['name'][0]) && is_array($_FILES['crop_vegetative_image']['name']) && $_FILES['crop_vegetative_image']['name'][0] != "") {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_vegetative_image']['name'] as $key => $filename) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (in_array($ext, $extension)) {
                    $image = $filename;

                    // Check if the image name already exists in the database
                    // Check if any version of the image name already exists in the database
                    $query = "SELECT crop_vegetative_image FROM crop WHERE crop_vegetative_image LIKE $1";
                    $result = pg_query_params($conn, $query, array('%' . $image . '%'));

                    if ($result === false) {
                        die("Database query failed");
                    }

                    $count = pg_num_rows($result);

                    if ($count == 0) {
                        $image = "Crop_Vegetative_Image_" . rand(000, 999) . '.' . $ext;
                    } else {
                        // If image exists in database, use it as is
                        $uploadedImagesVeg[] = $image;
                        continue; // Skip the rest of the loop for this image
                    }

                    $uploadedImagesVeg[] = $image;
                    $source_path = $_FILES['crop_vegetative_image']['tmp_name'][$key];
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
                    $_SESSION['message'] = "Invalid file format for image";
                    header("location: ../submission.php");
                    die();
                }
            }

            $finalimgVeg = implode(',', $uploadedImagesVeg);

            // Delete images that are not present in the new input
            if ($current_image_veg != '') {
                $currentVegImages = explode(',', $current_image_veg);

                foreach ($currentVegImages as $image) {
                    if (!in_array($image, $uploadedImagesVeg)) {
                        $delete_path = "../../crop-page/modals/img/" . $image;
                        if (file_exists($delete_path)) {
                            unlink($delete_path);
                        }
                    }
                }
            }
        } else {
            // If no new image is selected, use the current image
            $currentVegImages = explode(',', $current_image_veg);
            $uploadedImagesVeg = array_merge($uploadedImagesVeg, $currentVegImages);
            $finalimgVeg = implode(',', $uploadedImagesVeg);
        }

        // Array to store uploaded Vegetative image  names
        $uploadedImagesRepro = [];
        // Function to update crop seed image
        if (isset($_FILES['crop_reproductive_image']['name'][0]) && is_array($_FILES['crop_reproductive_image']['name']) && $_FILES['crop_reproductive_image']['name'][0] != "") {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_reproductive_image']['name'] as $key => $filename) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (in_array($ext, $extension)) {
                    $image = $filename;

                    // Check if the image name already exists in the database
                    // Check if any version of the image name already exists in the database
                    $query = "SELECT crop_reproductive_image FROM crop WHERE crop_reproductive_image LIKE $1";
                    $result = pg_query_params($conn, $query, array('%' . $image . '%'));

                    if ($result === false) {
                        die("Database query failed");
                    }

                    $count = pg_num_rows($result);

                    if ($count == 0) {
                        $image = "Crop_Reproductive_Image_" . rand(000, 999) . '.' . $ext;
                    } else {
                        // If image exists in database, use it as is
                        $uploadedImagesRepro[] = $image;
                        continue; // Skip the rest of the loop for this image
                    }

                    $uploadedImagesRepro[] = $image;
                    $source_path = $_FILES['crop_reproductive_image']['tmp_name'][$key];
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
                    $_SESSION['message'] = "Invalid file format for image";
                    header("location: ../submission.php");
                    die();
                }
            }

            $finalimgRepro = implode(',', $uploadedImagesRepro);

            // Delete images that are not present in the new input
            if ($current_image_veg != '') {
                $currentVegImages = explode(',', $current_image_veg);

                foreach ($currentVegImages as $image) {
                    if (!in_array($image, $uploadedImagesRepro)) {
                        $delete_path = "../../crop-page/modals/img/" . $image;
                        if (file_exists($delete_path)) {
                            unlink($delete_path);
                        }
                    }
                }
            }
        } else {
            // If no new image is selected, use the current image
            $currentReproImages = explode(',', $current_image_rep);
            $uploadedImagesRepro = array_merge($uploadedImagesRepro, $currentReproImages);
            $finalimgRepro = implode(',', $uploadedImagesRepro);
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
            $newUniqueCode = $prefix . 'V' . '-' . str_pad($currentNumber + 1, 4, '0', STR_PAD_LEFT);
        }

        // update utilization cultural table
        $query_utilCultural = "UPDATE utilization_cultural_importance SET significance = $1, \"use\" = $2, indigenous_utilization = $3,
        remarkable_features = $4 WHERE utilization_cultural_id = $5";
        $value_utilCultural = array(
            $significance, $use, $indigenous_utilization, $remarkable_features, $utilization_cultural_id
        );
        $query_run_utilCultural = pg_query_params($conn, $query_utilCultural, $value_utilCultural);

        if ($query_run_utilCultural) {
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // update crop table
        $queryCrop = "UPDATE crop set crop_variety= $1, crop_description =$2, meaning_of_name = $3, crop_seed_image = $4, category_variety_id = $5,
        terrain_id = $6, crop_vegetative_image = $7, crop_reproductive_image = $8, category_id = $9
        where crop_id = $10";

        $valueCrops = array(
            $crop_variety, $crop_description, $meaning_of_name, $finalimgSeed, $category_variety_id, $terrain_id, $finalimgVeg, $finalimgRepro, $category_id, $crop_id
        );
        $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

        if ($query_run_Crop) {
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // update status table
        $queryStatus = "UPDATE status set remarks =$1, status_date = CONCAT(status_date, ',', CURRENT_TIMESTAMP) where status_id = $2";

        $valueStatus = array(
            $action, $status_id
        );
        $query_run_Status = pg_query_params($conn, $queryStatus, $valueStatus);

        if ($query_run_Status) {
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // update Crop Location Table
        $query_CropLoc = "UPDATE crop_location set municipality_id = $1, barangay_id = $2, coordinates = $3, sitio_name = $4 where crop_location_id = $5";
        $query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($municipality_id, $barangay_id, $coordinates, $sitio_name, $crop_location_id));

        if ($query_run_CropLoc) {
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        //* for updating the morphological traits depending on the category selected
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
            // Id's for corn traits
            $vegetative_state_corn_id = handleEmpty($_POST['vegetative_state_cornID']);
            $reproductive_state_corn_id = handleEmpty($_POST['reproductive_state_cornID']);

            // Handle corn category traits
            // seed traits
            $query_seedTraits = "UPDATE seed_traits set seed_length = $1, seed_width = $2, seed_shape = $3, seed_color = $4 where seed_traits_id = $5";
            $query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color, $seed_traits_id));
            if ($query_run_seedTraits) {
                echo "success";
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // reproductive state corn
            $query_reproductiveState = "UPDATE reproductive_state_corn set corn_yield_capacity = $1 where reproductive_state_corn_id = $2";
            $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($corn_yield_capacity, $reproductive_state_corn_id));
            if ($query_run_reproductiveState) {
                echo "success";
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state corn
            $query_vegetativeState = "UPDATE vegetative_state_corn set corn_plant_height = $1, corn_leaf_width = $2, corn_leaf_length = $3, corn_maturity_time = $4 WHERE vegetative_state_corn_id = $5";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($corn_plant_height, $corn_leaf_width, $corn_leaf_length, $corn_maturity_time, $vegetative_state_corn_id));
            if ($query_run_vegetativeState) {
                echo "success";
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // check if the corn pest other resistance is null or not
            $query_getPest = "SELECT corn_pest_other_id FROM crop LEFT JOIN corn_traits ON corn_traits.crop_id = crop.crop_id WHERE crop.crop_id = $1";
            $query_run_getPest = pg_query_params($conn, $query_getPest, array($crop_id));

            // Check if the query returned any rows
            if (pg_num_rows($query_run_getPest) > 0) {
                $row_getPest = pg_fetch_row($query_run_getPest);
                $corn_pest_other_id = $row_getPest[0];

                // if the corn_pest_other_id is null or empty save it
                if ($corn_pest_other_id === null || $corn_pest_other_id === "") {

                    // Insert data into the respective tables
                    if ($pest_other) {

                        // Insert into corn_pest_other table
                        $queryPest_other = "INSERT INTO corn_pest_resistance_other (corn_pest_other, corn_pest_other_desc) VALUES ($1, $2) RETURNING corn_pest_other_id";
                        $query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
                        if ($query_run_Pest_other) {
                            $rowPest_other = pg_fetch_row($query_run_Pest_other);
                            $corn_pest_other_id = $rowPest_other[0];

                            // Insert into crop table
                            $query_cropInsert = "UPDATE corn_traits SET corn_pest_other_id = $1 WHERE corn_traits_id = $2";
                            $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($corn_pest_other_id, $corn_traits_id));
                            if ($query_run_cropInsert) {
                                echo "success";
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                } else {
                    // if it exists just update its data
                    // pest resistance other corn
                    $query_pestOther = "UPDATE corn_pest_resistance_other SET corn_pest_other = $1, corn_pest_other_desc = $2 WHERE corn_pest_other_id = $3";
                    $query_run_pestOther = pg_query_params($conn, $query_pestOther, array($pest_other, $pest_other_desc, $corn_pest_other_id));
                    if ($query_run_pestOther) {
                        echo "success";
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // check if the corn abiotic other resistance is null or not
            $query_getAbiotic = "SELECT corn_abiotic_other_id from crop left join corn_traits on corn_traits.crop_id = crop.crop_id where crop.crop_id = $1";
            $query_run_getAbiotic = pg_query_params($conn, $query_getAbiotic, array($crop_id));

            if ($query_run_getAbiotic) {
                if (pg_num_rows($query_run_getAbiotic) > 0) {
                    $row_getAbiotic = pg_fetch_row($query_run_getAbiotic);
                    $corn_abiotic_other_id = $row_getAbiotic[0];

                    // if the corn_abiotic_other_id is null or empty save it
                    if ($corn_abiotic_other_id === null || $corn_abiotic_other_id === "") {
                        // Insert data into the respective tables
                        if ($abiotic_other) {
                            // Insert into corn_Abiotic_other table
                            $queryAbiotic_other = "INSERT INTO corn_abiotic_resistance_other (corn_abiotic_other, corn_abiotic_other_desc) VALUES ($1, $2) returning corn_abiotic_other_id";
                            $query_run_Abiotic_other = pg_query_params($conn, $queryAbiotic_other, array($abiotic_other, $abiotic_other_desc));
                            if ($query_run_Abiotic_other) {
                                $rowAbiotic_other = pg_fetch_row($query_run_Abiotic_other);
                                $corn_abiotic_other_id = $rowAbiotic_other[0];

                                // Insert into crop table
                                $query_cropInsert = "UPDATE corn_traits set corn_abiotic_other_id = $1 where corn_traits_id = $2";
                                $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($corn_abiotic_other_id, $corn_traits_id));
                                if ($query_run_cropInsert) {
                                    echo "success";
                                } else {
                                    echo "Error: " . pg_last_error($conn);
                                    exit(0);
                                }
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        }
                    } else {
                        // if it exists just update its data
                        // pest resistance other corn
                        $query_abioticOther = "UPDATE corn_abiotic_resistance_other set corn_abiotic_other = $1, corn_abiotic_other_desc = $2 WHERE corn_abiotic_other_id = $3";
                        $query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc, $corn_abiotic_other_id));
                        if ($query_run_abioticOther) {
                            echo "success";
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                }
            }

            // Update the pest resistance
            if (isset($_POST['pest_resistance']) && is_array($_POST['pest_resistance'])) {
                // Delete existing pest resistances for the variety
                $query_delete_pest = "DELETE FROM corn_pest_resistance WHERE corn_traits_id = $1";
                $query_run_delete_pest = pg_query_params($conn, $query_delete_pest, array($corn_traits_id));

                // Loop through the submitted pest resistance IDs
                foreach ($_POST['pest_resistance'] as $pest_id) {
                    // Assuming $corn_id contains the ID of the corn variety
                    $corn_is_checked_pest = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_pest = "INSERT INTO corn_pest_resistance (corn_traits_id, pest_resistance_id, corn_is_checked_pest) VALUES ($1, $2, $3)";
                    $query_run_pest = pg_query_params($conn, $query_pest, array($corn_traits_id, $pest_id, $corn_is_checked_pest));
                    if (!$query_run_pest) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the disease resistance
            if (isset($_POST['disease_resistance']) && is_array($_POST['disease_resistance'])) {
                // Delete existing disease resistances for the variety
                $query_delete_disease = "DELETE FROM corn_disease_resistance WHERE corn_traits_id = $1";
                $query_run_delete_disease = pg_query_params($conn, $query_delete_disease, array($corn_traits_id));

                // Loop through the submitted disease resistance IDs
                foreach ($_POST['disease_resistance'] as $disease_id) {
                    // Assuming $corn_id contains the ID of the corn variety
                    $corn_is_checked_disease = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_disease = "INSERT INTO corn_disease_resistance (corn_traits_id, disease_resistance_id, corn_is_checked_disease) VALUES ($1, $2, $3)";
                    $query_run_disease = pg_query_params($conn, $query_disease, array($corn_traits_id, $disease_id, $corn_is_checked_disease));
                    if (!$query_run_disease) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the abiotic resistance
            if (isset($_POST['abiotic_resistance']) && is_array($_POST['abiotic_resistance'])) {
                // Delete existing abiotic resistances for the variety
                $query_delete_abiotic = "DELETE FROM corn_abiotic_resistance WHERE corn_traits_id = $1";
                $query_run_delete_abiotic = pg_query_params($conn, $query_delete_abiotic, array($corn_traits_id));

                // Loop through the submitted abiotic resistance IDs
                foreach ($_POST['abiotic_resistance'] as $abiotic_id) {
                    // Assuming $corn_id contains the ID of the corn variety
                    $corn_is_checked_abiotic = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_abiotic = "INSERT INTO corn_abiotic_resistance (corn_traits_id, abiotic_resistance_id, corn_is_checked_abiotic) VALUES ($1, $2, $3)";
                    $query_run_abiotic = pg_query_params($conn, $query_abiotic, array($corn_traits_id, $abiotic_id, $corn_is_checked_abiotic));
                    if (!$query_run_abiotic) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }
        } elseif ($get_category_name === 'Rice') {
            // Id's for rice traits
            $vegetative_state_rice_id = handleEmpty($_POST['vegetative_state_riceID']);
            $reproductive_state_rice_id = handleEmpty($_POST['reproductive_state_riceID']);
            $pest_resistance_rice_id = handleEmpty($_POST['pest_resistance_riceID']);
            $abiotic_resistance_rice_id = handleEmpty($_POST['abiotic_resistance_riceID']);
            $panicle_traits_rice_id = handleEmpty($_POST['panicle_traits_riceID']);
            $flag_leaf_traits_rice_id = handleEmpty($_POST['flag_leaf_traits_riceID']);
            $sensory_traits_rice_id = handleEmpty($_POST['sensory_traits_riceID']);

            // Update rice category
            // seed traits
            $query_seedTraits = "UPDATE seed_traits SET seed_length = $1, seed_width = $2, seed_shape = $3, seed_color = $4 where seed_traits_id = $5";
            $query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color, $seed_traits_id));
            if ($query_run_seedTraits) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // panicle traits
            $query_panicleTraits = "UPDATE panicle_traits_rice SET panicle_length = $1, panicle_width = $2, panicle_enclosed_by = $3, panicle_remarkable_features = $4 where panicle_traits_rice_id = $5";
            $query_run_panicleTraits = pg_query_params($conn, $query_panicleTraits, array($panicle_length, $panicle_width, $panicle_enclosed_by, $panicle_remarkable_features, $panicle_traits_rice_id));
            if ($query_run_panicleTraits) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // flag traits
            $query_flagLeaf = "UPDATE flag_leaf_traits_rice set flag_length = $1, flag_width = $2, purplish_stripes = $3, pubescence = $4, flag_remarkable_features = $5 where flag_leaf_traits_rice_id = $6";
            $query_run_flagLeaf = pg_query_params($conn, $query_flagLeaf, array($flag_length, $flag_width, $purplish_stripes, $pubescence, $flag_remarkable_features, $flag_leaf_traits_rice_id));
            if ($query_run_flagLeaf) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // reproductive state rice
            $query_reproductiveState = "UPDATE reproductive_state_rice set rice_yield_capacity = $1, seed_traits_id = $2, panicle_traits_rice_id = $3, flag_leaf_traits_rice_id = $4 where reproductive_state_rice_id = $5";
            $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($rice_yield_capacity, $seed_traits_id, $panicle_traits_rice_id, $flag_leaf_traits_rice_id, $reproductive_state_rice_id));
            if ($query_run_reproductiveState) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state rice
            $query_vegetativeState = "UPDATE vegetative_state_rice set rice_plant_height = $1, rice_leaf_width = $2, rice_leaf_length = $3, rice_tillering_ability = $4, rice_maturity_time = $5 where vegetative_state_rice_id = $6";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rice_plant_height, $rice_leaf_width, $rice_leaf_length, $rice_tillering_ability, $rice_maturity_time, $vegetative_state_rice_id));
            if ($query_run_vegetativeState) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // sensory traits rice
            $query_sensoryTraits = "UPDATE sensory_traits_rice set aroma = $1, quality_cooked_rice = $2, quality_leftover_rice = $3, volume_expansion = $4, glutinous = $5, texture = $6 where sensory_traits_rice_id =$7";
            $query_run_sensoryTraits = pg_query_params($conn, $query_sensoryTraits, array($aroma, $quality_cooked_rice, $quality_leftover_rice, $volume_expansion, $glutinous, $texture, $sensory_traits_rice_id));
            if ($query_run_sensoryTraits) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // check if the rice pest other resistance is null or not
            $query_getPest = "SELECT rice_pest_other_id FROM crop LEFT JOIN rice_traits ON rice_traits.crop_id = crop.crop_id WHERE crop.crop_id = $1";
            $query_run_getPest = pg_query_params($conn, $query_getPest, array($crop_id));

            // Check if the query returned any rows
            if (pg_num_rows($query_run_getPest) > 0) {
                $row_getPest = pg_fetch_row($query_run_getPest);
                $rice_pest_other_id = $row_getPest[0];

                // if the rice_pest_other_id is null or empty save it
                if ($rice_pest_other_id === null || $rice_pest_other_id === "") {

                    // Insert data into the respective tables
                    if ($pest_other) {
                        // Insert into rice_pest_other table
                        $queryPest_other = "INSERT INTO rice_pest_resistance_other (rice_pest_other, rice_pest_other_desc) VALUES ($1, $2) RETURNING rice_pest_other_id";
                        $query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
                        if ($query_run_Pest_other) {
                            $rowPest_other = pg_fetch_row($query_run_Pest_other);
                            $rice_pest_other_id = $rowPest_other[0];

                            // Insert into crop table
                            $query_cropInsert = "UPDATE rice_traits SET rice_pest_other_id = $1 WHERE rice_traits_id = $2";
                            $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rice_pest_other_id, $rice_traits_id));
                            if ($query_run_cropInsert) {
                                echo "success";
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                } else {
                    // if it exists just update its data
                    // pest resistance other rice
                    $query_pestOther = "UPDATE rice_pest_resistance_other SET rice_pest_other = $1, rice_pest_other_desc = $2 WHERE rice_pest_other_id = $3";
                    $query_run_pestOther = pg_query_params($conn, $query_pestOther, array($pest_other, $pest_other_desc, $rice_pest_other_id));
                    if ($query_run_pestOther) {
                        echo "success";
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // check if the rice abiotic other resistance is null or not
            $query_getAbiotic = "SELECT rice_abiotic_other_id from crop left join rice_traits on rice_traits.crop_id = crop.crop_id where crop.crop_id = $1";
            $query_run_getAbiotic = pg_query_params($conn, $query_getAbiotic, array($crop_id));

            if ($query_run_getAbiotic) {
                if (pg_num_rows($query_run_getAbiotic) > 0) {
                    $row_getAbiotic = pg_fetch_row($query_run_getAbiotic);
                    $rice_abiotic_other_id = $row_getAbiotic[0];

                    // if the rice_abiotic_other_id is null or empty save it
                    if ($rice_abiotic_other_id === null || $rice_abiotic_other_id === "") {
                        // Insert data into the respective tables
                        if ($abiotic_other) {
                            // Insert into rice_Abiotic_other table
                            $queryAbiotic_other = "INSERT INTO rice_abiotic_resistance_other (rice_abiotic_other, rice_abiotic_other_desc) VALUES ($1, $2) returning rice_abiotic_other_id";
                            $query_run_Abiotic_other = pg_query_params($conn, $queryAbiotic_other, array($abiotic_other, $abiotic_other_desc));
                            if ($query_run_Abiotic_other) {
                                $rowAbiotic_other = pg_fetch_row($query_run_Abiotic_other);
                                $rice_abiotic_other_id = $rowAbiotic_other[0];

                                // Insert into crop table
                                $query_cropInsert = "UPDATE rice_traits set rice_abiotic_other_id = $1 where rice_traits_id = $2";
                                $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rice_abiotic_other_id, $rice_traits_id));
                                if ($query_run_cropInsert) {
                                    echo "success";
                                } else {
                                    echo "Error: " . pg_last_error($conn);
                                    exit(0);
                                }
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        }
                    } else {
                        // if it exists just update its data
                        // pest resistance other rice
                        $query_abioticOther = "UPDATE rice_abiotic_resistance_other set rice_abiotic_other = $1, rice_abiotic_other_desc = $2 WHERE rice_abiotic_other_id = $3";
                        $query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc, $rice_abiotic_other_id));
                        if ($query_run_abioticOther) {
                            echo "success";
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                }
            }

            // Update the pest resistance
            if (isset($_POST['pest_resistance']) && is_array($_POST['pest_resistance'])) {
                // Delete existing pest resistances for the variety
                $query_delete_pest = "DELETE FROM rice_pest_resistance WHERE rice_traits_id = $1";
                $query_run_delete_pest = pg_query_params($conn, $query_delete_pest, array($rice_traits_id));

                // Loop through the submitted pest resistance IDs
                foreach ($_POST['pest_resistance'] as $pest_id) {
                    // Assuming $rice_id contains the ID of the rice variety
                    $rice_is_checked_pest = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_pest = "INSERT INTO rice_pest_resistance (rice_traits_id, pest_resistance_id, rice_is_checked_pest) VALUES ($1, $2, $3)";
                    $query_run_pest = pg_query_params($conn, $query_pest, array($rice_traits_id, $pest_id, $rice_is_checked_pest));
                    if (!$query_run_pest) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the disease resistance
            if (isset($_POST['disease_resistance']) && is_array($_POST['disease_resistance'])) {
                // Delete existing disease resistances for the variety
                $query_delete_disease = "DELETE FROM rice_disease_resistance WHERE rice_traits_id = $1";
                $query_run_delete_disease = pg_query_params($conn, $query_delete_disease, array($rice_traits_id));

                // Loop through the submitted disease resistance IDs
                foreach ($_POST['disease_resistance'] as $disease_id) {
                    // Assuming $rice_id contains the ID of the rice variety
                    $rice_is_checked_disease = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_disease = "INSERT INTO rice_disease_resistance (rice_traits_id, disease_resistance_id, rice_is_checked_disease) VALUES ($1, $2, $3)";
                    $query_run_disease = pg_query_params($conn, $query_disease, array($rice_traits_id, $disease_id, $rice_is_checked_disease));
                    if (!$query_run_disease) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the abiotic resistance
            if (isset($_POST['abiotic_resistance']) && is_array($_POST['abiotic_resistance'])) {
                // Delete existing abiotic resistances for the variety
                $query_delete_abiotic = "DELETE FROM rice_abiotic_resistance WHERE rice_traits_id = $1";
                $query_run_delete_abiotic = pg_query_params($conn, $query_delete_abiotic, array($rice_traits_id));

                // Loop through the submitted abiotic resistance IDs
                foreach ($_POST['abiotic_resistance'] as $abiotic_id) {
                    // Assuming $rice_id contains the ID of the rice variety
                    $rice_is_checked_abiotic = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_abiotic = "INSERT INTO rice_abiotic_resistance (rice_traits_id, abiotic_resistance_id, rice_is_checked_abiotic) VALUES ($1, $2, $3)";
                    $query_run_abiotic = pg_query_params($conn, $query_abiotic, array($rice_traits_id, $abiotic_id, $rice_is_checked_abiotic));
                    if (!$query_run_abiotic) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }
        } elseif ($get_category_name === 'Root Crop') {
            // Id's for rootcrop traits
            $vegetative_state_rootcrop_id = handleEmpty($_POST['vegetative_state_rootcropID']);
            $pest_resistance_rootcrop_id = handleEmpty($_POST['pest_resistance_rootcropID']);
            $rootcrop_traits_id = handleEmpty($_POST['rootcrop_traitsID']);

            // Handle root crops category
            // rootcrop traits
            $query_rootcropTraits = "UPDATE rootcrop_traits set eating_quality = $1, rootcrop_color = $2, sweetness = $3, rootcrop_remarkable_features = $4 where rootcrop_traits_id = $5";
            $query_run_rootcropTraits = pg_query_params($conn, $query_rootcropTraits, array($eating_quality, $rootcrop_color, $sweetness, $rootcrop_remarkable_features, $rootcrop_traits_id));
            if ($query_run_rootcropTraits) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state rootcrop
            $query_vegetativeState = "UPDATE vegetative_state_rootcrop set rootcrop_plant_height = $1, rootcrop_leaf_width = $2, rootcrop_leaf_length = $3, 
            rootcrop_stem_leaf_desc = $4, rootcrop_maturity_time = $5 where vegetative_state_rootcrop_id = $6";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array(
                $rootcrop_plant_height, $rootcrop_leaf_width, $rootcrop_leaf_length,
                $rootcrop_stem_leaf_desc, $rootcrop_maturity_time, $vegetative_state_rootcrop_id
            ));
            if ($query_run_vegetativeState) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // check if the rootcrop pest other resistance is null or not
            $query_getPest = "SELECT rootcrop_pest_other_id FROM crop LEFT JOIN root_crop_traits ON root_crop_traits.crop_id = crop.crop_id WHERE crop.crop_id = $1";
            $query_run_getPest = pg_query_params($conn, $query_getPest, array($crop_id));

            // Check if the query returned any rows
            if (pg_num_rows($query_run_getPest) > 0) {
                $row_getPest = pg_fetch_row($query_run_getPest);
                $rootcrop_pest_other_id = $row_getPest[0];

                // if the rootcrop_pest_other_id is null or empty save it
                if ($rootcrop_pest_other_id === null || $rootcrop_pest_other_id === "") {

                    // Insert data into the respective tables
                    if ($pest_other) {
                        // Insert into rootcrop_pest_other table
                        $queryPest_other = "INSERT INTO rootcrop_pest_resistance_other (rootcrop_pest_other, rootcrop_pest_other_desc) VALUES ($1, $2) RETURNING rootcrop_pest_other_id";
                        $query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
                        if ($query_run_Pest_other) {
                            $rowPest_other = pg_fetch_row($query_run_Pest_other);
                            $rootcrop_pest_other_id = $rowPest_other[0];

                            // Insert into crop table
                            $query_cropInsert = "UPDATE root_crop_traits SET rootcrop_pest_other_id = $1 WHERE root_crop_traits_id = $2";
                            $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rootcrop_pest_other_id, $root_crop_traits_id));
                            if ($query_run_cropInsert) {
                                echo "success";
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                } else {
                    // if it exists just update its data
                    // pest resistance other rootcrop
                    $query_pestOther = "UPDATE rootcrop_pest_resistance_other SET rootcrop_pest_other = $1, rootcrop_pest_other_desc = $2 WHERE rootcrop_pest_other_id = $3";
                    $query_run_pestOther = pg_query_params($conn, $query_pestOther, array($pest_other, $pest_other_desc, $rootcrop_pest_other_id));
                    if ($query_run_pestOther) {
                        echo "success";
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // check if the rootcrop abiotic other resistance is null or not
            $query_getAbiotic = "SELECT rootcrop_abiotic_other_id from crop left join root_crop_traits on root_crop_traits.crop_id = crop.crop_id where crop.crop_id = $1";
            $query_run_getAbiotic = pg_query_params($conn, $query_getAbiotic, array($crop_id));

            if ($query_run_getAbiotic) {
                if (pg_num_rows($query_run_getAbiotic) > 0) {
                    $row_getAbiotic = pg_fetch_row($query_run_getAbiotic);
                    $rootcrop_abiotic_other_id = $row_getAbiotic[0];

                    // if the rootcrop_abiotic_other_id is null or empty save it
                    if ($rootcrop_abiotic_other_id === null || $rootcrop_abiotic_other_id === "") {
                        // Insert data into the respective tables
                        if ($abiotic_other) {
                            // Insert into rootcrop_Abiotic_other table
                            $queryAbiotic_other = "INSERT INTO rootcrop_abiotic_resistance_other (rootcrop_abiotic_other, rootcrop_abiotic_other_desc) VALUES ($1, $2) returning rootcrop_abiotic_other_id";
                            $query_run_Abiotic_other = pg_query_params($conn, $queryAbiotic_other, array($abiotic_other, $abiotic_other_desc));
                            if ($query_run_Abiotic_other) {
                                $rowAbiotic_other = pg_fetch_row($query_run_Abiotic_other);
                                $rootcrop_abiotic_other_id = $rowAbiotic_other[0];

                                // Insert into crop table
                                $query_cropInsert = "UPDATE root_crop_traits set rootcrop_abiotic_other_id = $1 where root_crop_traits_id = $2";
                                $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rootcrop_abiotic_other_id, $root_crop_traits_id));
                                if ($query_run_cropInsert) {
                                    echo "success";
                                } else {
                                    echo "Error: " . pg_last_error($conn);
                                    exit(0);
                                }
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        }
                    } else {
                        // if it exists just update its data
                        // pest resistance other rootcrop
                        $query_abioticOther = "UPDATE rootcrop_abiotic_resistance_other set rootcrop_abiotic_other = $1, rootcrop_abiotic_other_desc = $2 WHERE rootcrop_abiotic_other_id = $3";
                        $query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc, $rootcrop_abiotic_other_id));
                        if ($query_run_abioticOther) {
                            echo "success";
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                }
            }

            // Update the pest resistance
            if (isset($_POST['pest_resistance']) && is_array($_POST['pest_resistance'])) {
                // Delete existing pest resistances for the variety
                $query_delete_pest = "DELETE FROM rootcrop_pest_resistance WHERE root_crop_traits_id = $1";
                $query_run_delete_pest = pg_query_params($conn, $query_delete_pest, array($root_crop_traits_id));

                // Loop through the submitted pest resistance IDs
                foreach ($_POST['pest_resistance'] as $pest_id) {
                    // Assuming $rootcrop_id contains the ID of the rootcrop variety
                    $rootcrop_is_checked_pest = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_pest = "INSERT INTO rootcrop_pest_resistance (root_crop_traits_id, pest_resistance_id, rootcrop_is_checked_pest) VALUES ($1, $2, $3)";
                    $query_run_pest = pg_query_params($conn, $query_pest, array($root_crop_traits_id, $pest_id, $rootcrop_is_checked_pest));
                    if (!$query_run_pest) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the disease resistance
            if (isset($_POST['disease_resistance']) && is_array($_POST['disease_resistance'])) {
                // Delete existing disease resistances for the variety
                $query_delete_disease = "DELETE FROM rootcrop_disease_resistance WHERE root_crop_traits_id = $1";
                $query_run_delete_disease = pg_query_params($conn, $query_delete_disease, array($root_crop_traits_id));

                // Loop through the submitted disease resistance IDs
                foreach ($_POST['disease_resistance'] as $disease_id) {
                    // Assuming $rootcrop_id contains the ID of the rootcrop variety
                    $rootcrop_is_checked_disease = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_disease = "INSERT INTO rootcrop_disease_resistance (root_crop_traits_id, disease_resistance_id, rootcrop_is_checked_disease) VALUES ($1, $2, $3)";
                    $query_run_disease = pg_query_params($conn, $query_disease, array($root_crop_traits_id, $disease_id, $rootcrop_is_checked_disease));
                    if (!$query_run_disease) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the abiotic resistance
            if (isset($_POST['abiotic_resistance']) && is_array($_POST['abiotic_resistance'])) {
                // Delete existing abiotic resistances for the variety
                $query_delete_abiotic = "DELETE FROM rootcrop_abiotic_resistance WHERE root_crop_traits_id = $1";
                $query_run_delete_abiotic = pg_query_params($conn, $query_delete_abiotic, array($root_crop_traits_id));

                // Loop through the submitted abiotic resistance IDs
                foreach ($_POST['abiotic_resistance'] as $abiotic_id) {
                    // Assuming $rootcrop_id contains the ID of the rootcrop variety
                    $rootcrop_is_checked_abiotic = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_abiotic = "INSERT INTO rootcrop_abiotic_resistance (root_crop_traits_id, abiotic_resistance_id, rootcrop_is_checked_abiotic) VALUES ($1, $2, $3)";
                    $query_run_abiotic = pg_query_params($conn, $query_abiotic, array($root_crop_traits_id, $abiotic_id, $rootcrop_is_checked_abiotic));
                    if (!$query_run_abiotic) {
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
        $_SESSION['message'] = "Crop Edited Successfully";
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
} else if (isset($_POST['save_draft']) && $_SESSION['rank'] == 'Contributor') {
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
        $crop_description = handleEmpty($_POST['crop_description']);
        $meaning_of_name = handleEmpty($_POST['meaning_of_name']);
        $current_image_seed = handleEmpty($_POST['current_image_seed']);
        $current_image_veg = handleEmpty($_POST['current_image_veg']);
        $current_image_rep = handleEmpty($_POST['current_image_rep']);
        echo $category_id = handleEmpty($_POST['category_id']);
        $category_variety_id = handleEmpty($_POST['category_variety_id']);
        $terrain_id = handleEmpty($_POST['terrain_id']);

        // status
        $action = "Pending";
        $status_id = $_POST['statusIDdraft'];

        // loc.php
        $province_id = $_POST['province'];
        $municipality_id = $_POST['municipality'];
        $coordinates = handleEmpty($_POST['coordinates']);
        $barangay_id = $_POST['barangay'];
        $sitio_name = $_POST['sitio_name'];

        // id's
        $crop_location_id = handleEmpty($_POST['crop_location_id-Draft']);
        $crop_id = handleEmpty($_POST['crop_idDraft']);
        $seed_traits_id = handleEmpty($_POST['seed_traitsIDdraft']);
        $utilization_cultural_id = handleEmpty($_POST['utilization_culturalIDdraft']);
        $corn_pest_other_id = handleEmpty($_POST['corn_pest_otherIDdraft']);
        $corn_abiotic_other_id = handleEmpty($_POST['corn_abiotic_otherIDdraft']);
        $rice_pest_other_id = handleEmpty($_POST['rice_pest_otherIDdraft']);
        $rice_abiotic_other_id = handleEmpty($_POST['rice_abiotic_otherIDdraft']);
        $rootcrop_pest_other_id = handleEmpty($_POST['rootcrop_pest_otherIDdraft']);
        $rootcrop_abiotic_other_id = handleEmpty($_POST['rootcrop_abiotic_otherIDdraft']);
        $corn_traits_id = handleEmpty($_POST['corn_traitsIDdraft']);
        $rice_traits_id = handleEmpty($_POST['rice_traitsIDdraft']);
        $root_crop_traits_id = handleEmpty($_POST['root_crop_traitsIDdraft']);

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
        $purplish_stripes = isset($_POST['purplish_stripes']) ? handleEmpty($_POST['purplish_stripes']) : null;
        $pubescence = isset($_POST['pubescence']) ? handleEmpty($_POST['pubescence']) : null;
        $flag_remarkable_features = isset($_POST['flag_remarkable_features']) ? handleEmpty($_POST['flag_remarkable_features']) : null;

        // Sensory traits rice
        $aroma = isset($_POST['aroma']) ? handleEmpty($_POST['aroma']) : null;
        $quality_cooked_rice = isset($_POST['quality_cooked_rice']) ? handleEmpty($_POST['quality_cooked_rice']) : null;
        $quality_leftover_rice = isset($_POST['quality_leftover_rice']) ? handleEmpty($_POST['quality_leftover_rice']) : null;
        $volume_expansion = isset($_POST['volume_expansion']) ? handleEmpty($_POST['volume_expansion']) : null;
        $glutinous = isset($_POST['glutinous']) ? handleEmpty($_POST['glutinous']) : null;
        $texture = isset($_POST['texture']) ? handleEmpty($_POST['texture']) : null;

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
        if (empty($crop_variety) || empty($municipality_id) || empty($barangay_id) || empty($category_id) || empty($category_variety_id)) {
            $_SESSION['message'] = "A required field is empty please fill the required fields.";
            header("location: ../submission.php");
            exit();
        }

        // Array to store uploaded image seed names
        $uploadedImagesSeed = [];

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
                        $uploadedImagesSeed[] = $image;
                        continue; // Skip the rest of the loop for this image
                    }

                    $uploadedImagesSeed[] = $image;
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
                    $_SESSION['message'] = "Invalid file format for image";
                    header("location: ../submission.php");
                    die();
                }
            }

            $finalimgSeed = implode(',', $uploadedImagesSeed);

            // Delete images that are not present in the new input
            if ($current_image_seed != '') {
                $currentSeedImages = explode(',', $current_image_seed);

                foreach ($currentSeedImages as $image) {
                    if (!in_array($image, $uploadedImagesSeed)) {
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
            $uploadedImagesSeed = array_merge($uploadedImagesSeed, $currentSeedImages);
            $finalimgSeed = implode(',', $uploadedImagesSeed);
        }

        // Array to store uploaded Vegetative image  names
        $uploadedImagesVeg = [];
        // Function to update crop seed image
        if (isset($_FILES['crop_vegetative_image']['name'][0]) && is_array($_FILES['crop_vegetative_image']['name']) && $_FILES['crop_vegetative_image']['name'][0] != "") {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_vegetative_image']['name'] as $key => $filename) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (in_array($ext, $extension)) {
                    $image = $filename;

                    // Check if the image name already exists in the database
                    // Check if any version of the image name already exists in the database
                    $query = "SELECT crop_vegetative_image FROM crop WHERE crop_vegetative_image LIKE $1";
                    $result = pg_query_params($conn, $query, array('%' . $image . '%'));

                    if ($result === false) {
                        die("Database query failed");
                    }

                    $count = pg_num_rows($result);

                    if ($count == 0) {
                        $image = "Crop_Vegetative_Image_" . rand(000, 999) . '.' . $ext;
                    } else {
                        // If image exists in database, use it as is
                        $uploadedImagesVeg[] = $image;
                        continue; // Skip the rest of the loop for this image
                    }

                    $uploadedImagesVeg[] = $image;
                    $source_path = $_FILES['crop_vegetative_image']['tmp_name'][$key];
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
                    $_SESSION['message'] = "Invalid file format for image";
                    header("location: ../submission.php");
                    die();
                }
            }

            $finalimgVeg = implode(',', $uploadedImagesVeg);

            // Delete images that are not present in the new input
            if ($current_image_veg != '') {
                $currentVegImages = explode(',', $current_image_veg);

                foreach ($currentVegImages as $image) {
                    if (!in_array($image, $uploadedImagesVeg)) {
                        $delete_path = "../../crop-page/modals/img/" . $image;
                        if (file_exists($delete_path)) {
                            unlink($delete_path);
                        }
                    }
                }
            }
        } else {
            // If no new image is selected, use the current image
            $currentVegImages = explode(',', $current_image_seed);
            $uploadedImagesVeg = array_merge($uploadedImagesVeg, $currentVegImages);
            $finalimgVeg = implode(',', $uploadedImagesVeg);
        }

        // Array to store uploaded Vegetative image  names
        $uploadedImagesRepro = [];
        // Function to update crop seed image
        if (isset($_FILES['crop_reproductive_image']['name'][0]) && is_array($_FILES['crop_reproductive_image']['name']) && $_FILES['crop_reproductive_image']['name'][0] != "") {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_reproductive_image']['name'] as $key => $filename) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (in_array($ext, $extension)) {
                    $image = $filename;

                    // Check if the image name already exists in the database
                    // Check if any version of the image name already exists in the database
                    $query = "SELECT crop_reproductive_image FROM crop WHERE crop_reproductive_image LIKE $1";
                    $result = pg_query_params($conn, $query, array('%' . $image . '%'));

                    if ($result === false) {
                        die("Database query failed");
                    }

                    $count = pg_num_rows($result);

                    if ($count == 0) {
                        $image = "Crop_Reproductive_Image_" . rand(000, 999) . '.' . $ext;
                    } else {
                        // If image exists in database, use it as is
                        $uploadedImagesRepro[] = $image;
                        continue; // Skip the rest of the loop for this image
                    }

                    $uploadedImagesRepro[] = $image;
                    $source_path = $_FILES['crop_reproductive_image']['tmp_name'][$key];
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
                    $_SESSION['message'] = "Invalid file format for image";
                    header("location: ../submission.php");
                    die();
                }
            }

            $finalimgRepro = implode(',', $uploadedImagesRepro);

            // Delete images that are not present in the new input
            if ($current_image_veg != '') {
                $currentVegImages = explode(',', $current_image_veg);

                foreach ($currentVegImages as $image) {
                    if (!in_array($image, $uploadedImagesRepro)) {
                        $delete_path = "../../crop-page/modals/img/" . $image;
                        if (file_exists($delete_path)) {
                            unlink($delete_path);
                        }
                    }
                }
            }
        } else {
            // If no new image is selected, use the current image
            $currentReproImages = explode(',', $current_image_rep);
            $uploadedImagesRepro = array_merge($uploadedImagesRepro, $currentReproImages);
            $finalimgRepro = implode(',', $uploadedImagesRepro);
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
            $newUniqueCode = $prefix . 'V' . '-' . str_pad($currentNumber + 1, 4, '0', STR_PAD_LEFT);
        }

        // update utilization cultural table
        $query_utilCultural = "UPDATE utilization_cultural_importance SET significance = $1, \"use\" = $2, indigenous_utilization = $3,
        remarkable_features = $4 WHERE utilization_cultural_id = $5";
        $value_utilCultural = array(
            $significance, $use, $indigenous_utilization, $remarkable_features, $utilization_cultural_id
        );
        $query_run_utilCultural = pg_query_params($conn, $query_utilCultural, $value_utilCultural);

        if ($query_run_utilCultural) {
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // update crop table
        $queryCrop = "UPDATE crop set crop_variety= $1, crop_description =$2, meaning_of_name = $3, crop_seed_image = $4, category_variety_id = $5,
        terrain_id = $6, crop_vegetative_image = $7, crop_reproductive_image = $8
        where crop_id = $9";

        $valueCrops = array(
            $crop_variety, $crop_description, $meaning_of_name, $finalimgSeed, $category_variety_id, $terrain_id, $finalimgVeg, $finalimgRepro, $crop_id
        );
        $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

        if ($query_run_Crop) {
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // update status table
        $queryStatus = "UPDATE status set remarks =$1, status_date = CONCAT(status_date, ',', CURRENT_TIMESTAMP) where status_id = $2";

        $valueStatus = array(
            $action, $status_id
        );
        $query_run_Status = pg_query_params($conn, $queryStatus, $valueStatus);

        if ($query_run_Status) {
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // update Crop Location Table
        $query_CropLoc = "UPDATE crop_location set municipality_id = $1, barangay_id = $2, coordinates = $3, sitio_name = $4 where crop_location_id = $5";
        $query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($municipality_id, $barangay_id, $coordinates, $sitio_name, $crop_location_id));

        if ($query_run_CropLoc) {
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        //* for updating the morphological traits depending on the category selected
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
            // Id's for corn traits
            $vegetative_state_corn_id = handleEmpty($_POST['vegetative_state_cornID']);
            $reproductive_state_corn_id = handleEmpty($_POST['reproductive_state_cornID']);

            // Handle corn category traits
            // seed traits
            $query_seedTraits = "UPDATE seed_traits set seed_length = $1, seed_width = $2, seed_shape = $3, seed_color = $4 where seed_traits_id = $5";
            $query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color, $seed_traits_id));
            if ($query_run_seedTraits) {
                echo "success";
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // reproductive state corn
            $query_reproductiveState = "UPDATE reproductive_state_corn set corn_yield_capacity = $1 where reproductive_state_corn_id = $2";
            $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($corn_yield_capacity, $reproductive_state_corn_id));
            if ($query_run_reproductiveState) {
                echo "success";
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state corn
            $query_vegetativeState = "UPDATE vegetative_state_corn set corn_plant_height = $1, corn_leaf_width = $2, corn_leaf_length = $3, corn_maturity_time = $4 WHERE vegetative_state_corn_id = $5";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($corn_plant_height, $corn_leaf_width, $corn_leaf_length, $corn_maturity_time, $vegetative_state_corn_id));
            if ($query_run_vegetativeState) {
                echo "success";
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // check if the corn pest other resistance is null or not
            $query_getPest = "SELECT corn_pest_other_id FROM crop LEFT JOIN corn_traits ON corn_traits.crop_id = crop.crop_id WHERE crop.crop_id = $1";
            $query_run_getPest = pg_query_params($conn, $query_getPest, array($crop_id));

            // Check if the query returned any rows
            if (pg_num_rows($query_run_getPest) > 0) {
                $row_getPest = pg_fetch_row($query_run_getPest);
                $corn_pest_other_id = $row_getPest[0];

                // if the corn_pest_other_id is null or empty save it
                if ($corn_pest_other_id === null || $corn_pest_other_id === "") {

                    // Insert data into the respective tables
                    if ($pest_other) {

                        // Insert into corn_pest_other table
                        $queryPest_other = "INSERT INTO corn_pest_resistance_other (corn_pest_other, corn_pest_other_desc) VALUES ($1, $2) RETURNING corn_pest_other_id";
                        $query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
                        if ($query_run_Pest_other) {
                            $rowPest_other = pg_fetch_row($query_run_Pest_other);
                            $corn_pest_other_id = $rowPest_other[0];

                            // Insert into crop table
                            $query_cropInsert = "UPDATE corn_traits SET corn_pest_other_id = $1 WHERE corn_traits_id = $2";
                            $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($corn_pest_other_id, $corn_traits_id));
                            if ($query_run_cropInsert) {
                                echo "success";
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                } else {
                    // if it exists just update its data
                    // pest resistance other corn
                    $query_pestOther = "UPDATE corn_pest_resistance_other SET corn_pest_other = $1, corn_pest_other_desc = $2 WHERE corn_pest_other_id = $3";
                    $query_run_pestOther = pg_query_params($conn, $query_pestOther, array($pest_other, $pest_other_desc, $corn_pest_other_id));
                    if ($query_run_pestOther) {
                        echo "success";
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // check if the corn abiotic other resistance is null or not
            $query_getAbiotic = "SELECT corn_abiotic_other_id from crop left join corn_traits on corn_traits.crop_id = crop.crop_id where crop.crop_id = $1";
            $query_run_getAbiotic = pg_query_params($conn, $query_getAbiotic, array($crop_id));

            if ($query_run_getAbiotic) {
                if (pg_num_rows($query_run_getAbiotic) > 0) {
                    $row_getAbiotic = pg_fetch_row($query_run_getAbiotic);
                    $corn_abiotic_other_id = $row_getAbiotic[0];

                    // if the corn_abiotic_other_id is null or empty save it
                    if ($corn_abiotic_other_id === null || $corn_abiotic_other_id === "") {
                        // Insert data into the respective tables
                        if ($abiotic_other) {
                            // Insert into corn_Abiotic_other table
                            $queryAbiotic_other = "INSERT INTO corn_abiotic_resistance_other (corn_abiotic_other, corn_abiotic_other_desc) VALUES ($1, $2) returning corn_abiotic_other_id";
                            $query_run_Abiotic_other = pg_query_params($conn, $queryAbiotic_other, array($abiotic_other, $abiotic_other_desc));
                            if ($query_run_Abiotic_other) {
                                $rowAbiotic_other = pg_fetch_row($query_run_Abiotic_other);
                                $corn_abiotic_other_id = $rowAbiotic_other[0];

                                // Insert into crop table
                                $query_cropInsert = "UPDATE corn_traits set corn_abiotic_other_id = $1 where corn_traits_id = $2";
                                $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($corn_abiotic_other_id, $corn_traits_id));
                                if ($query_run_cropInsert) {
                                    echo "success";
                                } else {
                                    echo "Error: " . pg_last_error($conn);
                                    exit(0);
                                }
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        }
                    } else {
                        // if it exists just update its data
                        // pest resistance other corn
                        $query_abioticOther = "UPDATE corn_abiotic_resistance_other set corn_abiotic_other = $1, corn_abiotic_other_desc = $2 WHERE corn_abiotic_other_id = $3";
                        $query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc, $corn_abiotic_other_id));
                        if ($query_run_abioticOther) {
                            echo "success";
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                }
            }

            // Update the pest resistance
            if (isset($_POST['pest_resistance']) && is_array($_POST['pest_resistance'])) {
                // Delete existing pest resistances for the variety
                $query_delete_pest = "DELETE FROM corn_pest_resistance WHERE corn_traits_id = $1";
                $query_run_delete_pest = pg_query_params($conn, $query_delete_pest, array($corn_traits_id));

                // Loop through the submitted pest resistance IDs
                foreach ($_POST['pest_resistance'] as $pest_id) {
                    // Assuming $corn_id contains the ID of the corn variety
                    $corn_is_checked_pest = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_pest = "INSERT INTO corn_pest_resistance (corn_traits_id, pest_resistance_id, corn_is_checked_pest) VALUES ($1, $2, $3)";
                    $query_run_pest = pg_query_params($conn, $query_pest, array($corn_traits_id, $pest_id, $corn_is_checked_pest));
                    if (!$query_run_pest) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the disease resistance
            if (isset($_POST['disease_resistance']) && is_array($_POST['disease_resistance'])) {
                // Delete existing disease resistances for the variety
                $query_delete_disease = "DELETE FROM corn_disease_resistance WHERE corn_traits_id = $1";
                $query_run_delete_disease = pg_query_params($conn, $query_delete_disease, array($corn_traits_id));

                // Loop through the submitted disease resistance IDs
                foreach ($_POST['disease_resistance'] as $disease_id) {
                    // Assuming $corn_id contains the ID of the corn variety
                    $corn_is_checked_disease = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_disease = "INSERT INTO corn_disease_resistance (corn_traits_id, disease_resistance_id, corn_is_checked_disease) VALUES ($1, $2, $3)";
                    $query_run_disease = pg_query_params($conn, $query_disease, array($corn_traits_id, $disease_id, $corn_is_checked_disease));
                    if (!$query_run_disease) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the abiotic resistance
            if (isset($_POST['abiotic_resistance']) && is_array($_POST['abiotic_resistance'])) {
                // Delete existing abiotic resistances for the variety
                $query_delete_abiotic = "DELETE FROM corn_abiotic_resistance WHERE corn_traits_id = $1";
                $query_run_delete_abiotic = pg_query_params($conn, $query_delete_abiotic, array($corn_traits_id));

                // Loop through the submitted abiotic resistance IDs
                foreach ($_POST['abiotic_resistance'] as $abiotic_id) {
                    // Assuming $corn_id contains the ID of the corn variety
                    $corn_is_checked_abiotic = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_abiotic = "INSERT INTO corn_abiotic_resistance (corn_traits_id, abiotic_resistance_id, corn_is_checked_abiotic) VALUES ($1, $2, $3)";
                    $query_run_abiotic = pg_query_params($conn, $query_abiotic, array($corn_traits_id, $abiotic_id, $corn_is_checked_abiotic));
                    if (!$query_run_abiotic) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }
        } elseif ($get_category_name === 'Rice') {
            // Id's for rice traits
            $vegetative_state_rice_id = handleEmpty($_POST['vegetative_state_riceID']);
            $reproductive_state_rice_id = handleEmpty($_POST['reproductive_state_riceID']);
            $pest_resistance_rice_id = handleEmpty($_POST['pest_resistance_riceID']);
            $abiotic_resistance_rice_id = handleEmpty($_POST['abiotic_resistance_riceID']);
            $panicle_traits_rice_id = handleEmpty($_POST['panicle_traits_riceID']);
            $flag_leaf_traits_rice_id = handleEmpty($_POST['flag_leaf_traits_riceID']);
            $sensory_traits_rice_id = handleEmpty($_POST['sensory_traits_riceID']);

            // Update rice category
            // seed traits
            $query_seedTraits = "UPDATE seed_traits SET seed_length = $1, seed_width = $2, seed_shape = $3, seed_color = $4 where seed_traits_id = $5";
            $query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color, $seed_traits_id));
            if ($query_run_seedTraits) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // panicle traits
            $query_panicleTraits = "UPDATE panicle_traits_rice SET panicle_length = $1, panicle_width = $2, panicle_enclosed_by = $3, panicle_remarkable_features = $4 where panicle_traits_rice_id = $5";
            $query_run_panicleTraits = pg_query_params($conn, $query_panicleTraits, array($panicle_length, $panicle_width, $panicle_enclosed_by, $panicle_remarkable_features, $panicle_traits_rice_id));
            if ($query_run_panicleTraits) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // flag traits
            $query_flagLeaf = "UPDATE flag_leaf_traits_rice set flag_length = $1, flag_width = $2, purplish_stripes = $3, pubescence = $4, flag_remarkable_features = $5 where flag_leaf_traits_rice_id = $6";
            $query_run_flagLeaf = pg_query_params($conn, $query_flagLeaf, array($flag_length, $flag_width, $purplish_stripes, $pubescence, $flag_remarkable_features, $flag_leaf_traits_rice_id));
            if ($query_run_flagLeaf) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // reproductive state rice
            $query_reproductiveState = "UPDATE reproductive_state_rice set rice_yield_capacity = $1, seed_traits_id = $2, panicle_traits_rice_id = $3, flag_leaf_traits_rice_id = $4 where reproductive_state_rice_id = $5";
            $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($rice_yield_capacity, $seed_traits_id, $panicle_traits_rice_id, $flag_leaf_traits_rice_id, $reproductive_state_rice_id));
            if ($query_run_reproductiveState) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state rice
            $query_vegetativeState = "UPDATE vegetative_state_rice set rice_plant_height = $1, rice_leaf_width = $2, rice_leaf_length = $3, rice_tillering_ability = $4, rice_maturity_time = $5 where vegetative_state_rice_id = $6";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rice_plant_height, $rice_leaf_width, $rice_leaf_length, $rice_tillering_ability, $rice_maturity_time, $vegetative_state_rice_id));
            if ($query_run_vegetativeState) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // sensory traits rice
            $query_sensoryTraits = "UPDATE sensory_traits_rice set aroma = $1, quality_cooked_rice = $2, quality_leftover_rice = $3, volume_expansion = $4, glutinous = $5, texture = $6 where sensory_traits_rice_id =$7";
            $query_run_sensoryTraits = pg_query_params($conn, $query_sensoryTraits, array($aroma, $quality_cooked_rice, $quality_leftover_rice, $volume_expansion, $glutinous, $texture, $sensory_traits_rice_id));
            if ($query_run_sensoryTraits) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // check if the rice pest other resistance is null or not
            $query_getPest = "SELECT rice_pest_other_id FROM crop LEFT JOIN rice_traits ON rice_traits.crop_id = crop.crop_id WHERE crop.crop_id = $1";
            $query_run_getPest = pg_query_params($conn, $query_getPest, array($crop_id));

            // Check if the query returned any rows
            if (pg_num_rows($query_run_getPest) > 0) {
                $row_getPest = pg_fetch_row($query_run_getPest);
                $rice_pest_other_id = $row_getPest[0];

                // if the rice_pest_other_id is null or empty save it
                if ($rice_pest_other_id === null || $rice_pest_other_id === "") {

                    // Insert data into the respective tables
                    if ($pest_other) {
                        // Insert into rice_pest_other table
                        $queryPest_other = "INSERT INTO rice_pest_resistance_other (rice_pest_other, rice_pest_other_desc) VALUES ($1, $2) RETURNING rice_pest_other_id";
                        $query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
                        if ($query_run_Pest_other) {
                            $rowPest_other = pg_fetch_row($query_run_Pest_other);
                            $rice_pest_other_id = $rowPest_other[0];

                            // Insert into crop table
                            $query_cropInsert = "UPDATE rice_traits SET rice_pest_other_id = $1 WHERE rice_traits_id = $2";
                            $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rice_pest_other_id, $rice_traits_id));
                            if ($query_run_cropInsert) {
                                echo "success";
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                } else {
                    // if it exists just update its data
                    // pest resistance other rice
                    $query_pestOther = "UPDATE rice_pest_resistance_other SET rice_pest_other = $1, rice_pest_other_desc = $2 WHERE rice_pest_other_id = $3";
                    $query_run_pestOther = pg_query_params($conn, $query_pestOther, array($pest_other, $pest_other_desc, $rice_pest_other_id));
                    if ($query_run_pestOther) {
                        echo "success";
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // check if the rice abiotic other resistance is null or not
            $query_getAbiotic = "SELECT rice_abiotic_other_id from crop left join rice_traits on rice_traits.crop_id = crop.crop_id where crop.crop_id = $1";
            $query_run_getAbiotic = pg_query_params($conn, $query_getAbiotic, array($crop_id));

            if ($query_run_getAbiotic) {
                if (pg_num_rows($query_run_getAbiotic) > 0) {
                    $row_getAbiotic = pg_fetch_row($query_run_getAbiotic);
                    $rice_abiotic_other_id = $row_getAbiotic[0];

                    // if the rice_abiotic_other_id is null or empty save it
                    if ($rice_abiotic_other_id === null || $rice_abiotic_other_id === "") {
                        // Insert data into the respective tables
                        if ($abiotic_other) {
                            // Insert into rice_Abiotic_other table
                            $queryAbiotic_other = "INSERT INTO rice_abiotic_resistance_other (rice_abiotic_other, rice_abiotic_other_desc) VALUES ($1, $2) returning rice_abiotic_other_id";
                            $query_run_Abiotic_other = pg_query_params($conn, $queryAbiotic_other, array($abiotic_other, $abiotic_other_desc));
                            if ($query_run_Abiotic_other) {
                                $rowAbiotic_other = pg_fetch_row($query_run_Abiotic_other);
                                $rice_abiotic_other_id = $rowAbiotic_other[0];

                                // Insert into crop table
                                $query_cropInsert = "UPDATE rice_traits set rice_abiotic_other_id = $1 where rice_traits_id = $2";
                                $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rice_abiotic_other_id, $rice_traits_id));
                                if ($query_run_cropInsert) {
                                    echo "success";
                                } else {
                                    echo "Error: " . pg_last_error($conn);
                                    exit(0);
                                }
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        }
                    } else {
                        // if it exists just update its data
                        // pest resistance other rice
                        $query_abioticOther = "UPDATE rice_abiotic_resistance_other set rice_abiotic_other = $1, rice_abiotic_other_desc = $2 WHERE rice_abiotic_other_id = $3";
                        $query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc, $rice_abiotic_other_id));
                        if ($query_run_abioticOther) {
                            echo "success";
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                }
            }

            // Update the pest resistance
            if (isset($_POST['pest_resistance']) && is_array($_POST['pest_resistance'])) {
                // Delete existing pest resistances for the variety
                $query_delete_pest = "DELETE FROM rice_pest_resistance WHERE rice_traits_id = $1";
                $query_run_delete_pest = pg_query_params($conn, $query_delete_pest, array($rice_traits_id));

                // Loop through the submitted pest resistance IDs
                foreach ($_POST['pest_resistance'] as $pest_id) {
                    // Assuming $rice_id contains the ID of the rice variety
                    $rice_is_checked_pest = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_pest = "INSERT INTO rice_pest_resistance (rice_traits_id, pest_resistance_id, rice_is_checked_pest) VALUES ($1, $2, $3)";
                    $query_run_pest = pg_query_params($conn, $query_pest, array($rice_traits_id, $pest_id, $rice_is_checked_pest));
                    if (!$query_run_pest) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the disease resistance
            if (isset($_POST['disease_resistance']) && is_array($_POST['disease_resistance'])) {
                // Delete existing disease resistances for the variety
                $query_delete_disease = "DELETE FROM rice_disease_resistance WHERE rice_traits_id = $1";
                $query_run_delete_disease = pg_query_params($conn, $query_delete_disease, array($rice_traits_id));

                // Loop through the submitted disease resistance IDs
                foreach ($_POST['disease_resistance'] as $disease_id) {
                    // Assuming $rice_id contains the ID of the rice variety
                    $rice_is_checked_disease = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_disease = "INSERT INTO rice_disease_resistance (rice_traits_id, disease_resistance_id, rice_is_checked_disease) VALUES ($1, $2, $3)";
                    $query_run_disease = pg_query_params($conn, $query_disease, array($rice_traits_id, $disease_id, $rice_is_checked_disease));
                    if (!$query_run_disease) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the abiotic resistance
            if (isset($_POST['abiotic_resistance']) && is_array($_POST['abiotic_resistance'])) {
                // Delete existing abiotic resistances for the variety
                $query_delete_abiotic = "DELETE FROM rice_abiotic_resistance WHERE rice_traits_id = $1";
                $query_run_delete_abiotic = pg_query_params($conn, $query_delete_abiotic, array($rice_traits_id));

                // Loop through the submitted abiotic resistance IDs
                foreach ($_POST['abiotic_resistance'] as $abiotic_id) {
                    // Assuming $rice_id contains the ID of the rice variety
                    $rice_is_checked_abiotic = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_abiotic = "INSERT INTO rice_abiotic_resistance (rice_traits_id, abiotic_resistance_id, rice_is_checked_abiotic) VALUES ($1, $2, $3)";
                    $query_run_abiotic = pg_query_params($conn, $query_abiotic, array($rice_traits_id, $abiotic_id, $rice_is_checked_abiotic));
                    if (!$query_run_abiotic) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }
        } elseif ($get_category_name === 'Root Crop') {
            // Id's for rootcrop traits
            $vegetative_state_rootcrop_id = handleEmpty($_POST['vegetative_state_rootcropID']);
            $pest_resistance_rootcrop_id = handleEmpty($_POST['pest_resistance_rootcropID']);
            $rootcrop_traits_id = handleEmpty($_POST['rootcrop_traitsID']);

            // Handle root crops category
            // rootcrop traits
            $query_rootcropTraits = "UPDATE rootcrop_traits set eating_quality = $1, rootcrop_color = $2, sweetness = $3, rootcrop_remarkable_features = $4 where rootcrop_traits_id = $5";
            $query_run_rootcropTraits = pg_query_params($conn, $query_rootcropTraits, array($eating_quality, $rootcrop_color, $sweetness, $rootcrop_remarkable_features, $rootcrop_traits_id));
            if ($query_run_rootcropTraits) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state rootcrop
            $query_vegetativeState = "UPDATE vegetative_state_rootcrop set rootcrop_plant_height = $1, rootcrop_leaf_width = $2, rootcrop_leaf_length = $3, 
            rootcrop_stem_leaf_desc = $4, rootcrop_maturity_time = $5 where vegetative_state_rootcrop_id = $6";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array(
                $rootcrop_plant_height, $rootcrop_leaf_width, $rootcrop_leaf_length,
                $rootcrop_stem_leaf_desc, $rootcrop_maturity_time, $vegetative_state_rootcrop_id
            ));
            if ($query_run_vegetativeState) {
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // check if the rootcrop pest other resistance is null or not
            $query_getPest = "SELECT rootcrop_pest_other_id FROM crop LEFT JOIN root_crop_traits ON root_crop_traits.crop_id = crop.crop_id WHERE crop.crop_id = $1";
            $query_run_getPest = pg_query_params($conn, $query_getPest, array($crop_id));

            // Check if the query returned any rows
            if (pg_num_rows($query_run_getPest) > 0) {
                $row_getPest = pg_fetch_row($query_run_getPest);
                $rootcrop_pest_other_id = $row_getPest[0];

                // if the rootcrop_pest_other_id is null or empty save it
                if ($rootcrop_pest_other_id === null || $rootcrop_pest_other_id === "") {

                    // Insert data into the respective tables
                    if ($pest_other) {
                        // Insert into rootcrop_pest_other table
                        $queryPest_other = "INSERT INTO rootcrop_pest_resistance_other (rootcrop_pest_other, rootcrop_pest_other_desc) VALUES ($1, $2) RETURNING rootcrop_pest_other_id";
                        $query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
                        if ($query_run_Pest_other) {
                            $rowPest_other = pg_fetch_row($query_run_Pest_other);
                            $rootcrop_pest_other_id = $rowPest_other[0];

                            // Insert into crop table
                            $query_cropInsert = "UPDATE root_crop_traits SET rootcrop_pest_other_id = $1 WHERE root_crop_traits_id = $2";
                            $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rootcrop_pest_other_id, $root_crop_traits_id));
                            if ($query_run_cropInsert) {
                                echo "success";
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                } else {
                    // if it exists just update its data
                    // pest resistance other rootcrop
                    $query_pestOther = "UPDATE rootcrop_pest_resistance_other SET rootcrop_pest_other = $1, rootcrop_pest_other_desc = $2 WHERE rootcrop_pest_other_id = $3";
                    $query_run_pestOther = pg_query_params($conn, $query_pestOther, array($pest_other, $pest_other_desc, $rootcrop_pest_other_id));
                    if ($query_run_pestOther) {
                        echo "success";
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // check if the rootcrop abiotic other resistance is null or not
            $query_getAbiotic = "SELECT rootcrop_abiotic_other_id from crop left join root_crop_traits on root_crop_traits.crop_id = crop.crop_id where crop.crop_id = $1";
            $query_run_getAbiotic = pg_query_params($conn, $query_getAbiotic, array($crop_id));

            if ($query_run_getAbiotic) {
                if (pg_num_rows($query_run_getAbiotic) > 0) {
                    $row_getAbiotic = pg_fetch_row($query_run_getAbiotic);
                    $rootcrop_abiotic_other_id = $row_getAbiotic[0];

                    // if the rootcrop_abiotic_other_id is null or empty save it
                    if ($rootcrop_abiotic_other_id === null || $rootcrop_abiotic_other_id === "") {
                        // Insert data into the respective tables
                        if ($abiotic_other) {
                            // Insert into rootcrop_Abiotic_other table
                            $queryAbiotic_other = "INSERT INTO rootcrop_abiotic_resistance_other (rootcrop_abiotic_other, rootcrop_abiotic_other_desc) VALUES ($1, $2) returning rootcrop_abiotic_other_id";
                            $query_run_Abiotic_other = pg_query_params($conn, $queryAbiotic_other, array($abiotic_other, $abiotic_other_desc));
                            if ($query_run_Abiotic_other) {
                                $rowAbiotic_other = pg_fetch_row($query_run_Abiotic_other);
                                $rootcrop_abiotic_other_id = $rowAbiotic_other[0];

                                // Insert into crop table
                                $query_cropInsert = "UPDATE root_crop_traits set rootcrop_abiotic_other_id = $1 where root_crop_traits_id = $2";
                                $query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rootcrop_abiotic_other_id, $root_crop_traits_id));
                                if ($query_run_cropInsert) {
                                    echo "success";
                                } else {
                                    echo "Error: " . pg_last_error($conn);
                                    exit(0);
                                }
                            } else {
                                echo "Error: " . pg_last_error($conn);
                                exit(0);
                            }
                        }
                    } else {
                        // if it exists just update its data
                        // pest resistance other rootcrop
                        $query_abioticOther = "UPDATE rootcrop_abiotic_resistance_other set rootcrop_abiotic_other = $1, rootcrop_abiotic_other_desc = $2 WHERE rootcrop_abiotic_other_id = $3";
                        $query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc, $rootcrop_abiotic_other_id));
                        if ($query_run_abioticOther) {
                            echo "success";
                        } else {
                            echo "Error: " . pg_last_error($conn);
                            exit(0);
                        }
                    }
                }
            }

            // Update the pest resistance
            if (isset($_POST['pest_resistance']) && is_array($_POST['pest_resistance'])) {
                // Delete existing pest resistances for the variety
                $query_delete_pest = "DELETE FROM rootcrop_pest_resistance WHERE root_crop_traits_id = $1";
                $query_run_delete_pest = pg_query_params($conn, $query_delete_pest, array($root_crop_traits_id));

                // Loop through the submitted pest resistance IDs
                foreach ($_POST['pest_resistance'] as $pest_id) {
                    // Assuming $rootcrop_id contains the ID of the rootcrop variety
                    $rootcrop_is_checked_pest = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_pest = "INSERT INTO rootcrop_pest_resistance (root_crop_traits_id, pest_resistance_id, rootcrop_is_checked_pest) VALUES ($1, $2, $3)";
                    $query_run_pest = pg_query_params($conn, $query_pest, array($root_crop_traits_id, $pest_id, $rootcrop_is_checked_pest));
                    if (!$query_run_pest) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the disease resistance
            if (isset($_POST['disease_resistance']) && is_array($_POST['disease_resistance'])) {
                // Delete existing disease resistances for the variety
                $query_delete_disease = "DELETE FROM rootcrop_disease_resistance WHERE root_crop_traits_id = $1";
                $query_run_delete_disease = pg_query_params($conn, $query_delete_disease, array($root_crop_traits_id));

                // Loop through the submitted disease resistance IDs
                foreach ($_POST['disease_resistance'] as $disease_id) {
                    // Assuming $rootcrop_id contains the ID of the rootcrop variety
                    $rootcrop_is_checked_disease = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_disease = "INSERT INTO rootcrop_disease_resistance (root_crop_traits_id, disease_resistance_id, rootcrop_is_checked_disease) VALUES ($1, $2, $3)";
                    $query_run_disease = pg_query_params($conn, $query_disease, array($root_crop_traits_id, $disease_id, $rootcrop_is_checked_disease));
                    if (!$query_run_disease) {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }
                }
            }

            // Update the abiotic resistance
            if (isset($_POST['abiotic_resistance']) && is_array($_POST['abiotic_resistance'])) {
                // Delete existing abiotic resistances for the variety
                $query_delete_abiotic = "DELETE FROM rootcrop_abiotic_resistance WHERE root_crop_traits_id = $1";
                $query_run_delete_abiotic = pg_query_params($conn, $query_delete_abiotic, array($root_crop_traits_id));

                // Loop through the submitted abiotic resistance IDs
                foreach ($_POST['abiotic_resistance'] as $abiotic_id) {
                    // Assuming $rootcrop_id contains the ID of the rootcrop variety
                    $rootcrop_is_checked_abiotic = true; // Set to true since it's a boolean value

                    // Insert the record into the database
                    $query_abiotic = "INSERT INTO rootcrop_abiotic_resistance (root_crop_traits_id, abiotic_resistance_id, rootcrop_is_checked_abiotic) VALUES ($1, $2, $3)";
                    $query_run_abiotic = pg_query_params($conn, $query_abiotic, array($root_crop_traits_id, $abiotic_id, $rootcrop_is_checked_abiotic));
                    if (!$query_run_abiotic) {
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
        $_SESSION['message'] = "Draft Sved Successfully";
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

if (isset($_POST['delete']) && $_SESSION['rank'] == 'Curator' || $_SESSION['rank'] == 'Admin') {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        // Function to handle empty values
        function handleEmpty($value)
        {
            return empty($value) ? null : $value;
        }

        // id's
        $crop_location_id = handleEmpty($_POST['crop_location_id']);
        $crop_id = handleEmpty($_POST['crop_idDraft']);
        $seed_traits_id = handleEmpty($_POST['seed_traitsID']);
        $utilization_cultural_id = handleEmpty($_POST['utilization_culturalID']);
        $corn_pest_other_id = handleEmpty($_POST['corn_pest_otherID']);
        $corn_abiotic_other_id = handleEmpty($_POST['corn_abiotic_otherID']);
        $rice_pest_other_id = handleEmpty($_POST['rice_pest_otherID']);
        $rice_abiotic_other_id = handleEmpty($_POST['rice_abiotic_otherID']);
        $rootcrop_pest_other_id = handleEmpty($_POST['rootcrop_pest_otherID']);
        $rootcrop_abiotic_other_id = handleEmpty($_POST['rootcrop_abiotic_otherID']);
        $category_id = handleEmpty($_POST['categoryID']);
        $references_id = $_POST['referencesID'];
        $status_id = $_POST['statusID'];

        // get the old image
        $current_image_seed = handleEmpty($_POST['current_image_seed']);

        $get_name = "SELECT category_name FROM crop left join category on crop.category_id = category.category_id where crop.crop_id = $1";
        $query_run = pg_query_params($conn, $get_name, array($crop_id));

        if ($query_run) {
            $row_categoryName = pg_fetch_assoc(($query_run));
            $get_category_name = $row_categoryName['category_name'];
        } else {
            $_SESSION['message'] = "No category available, incomplete data";
            header("location: ../crop.php");
            exit();
        }

        if ($get_category_name === 'Corn') {
            // Id's for corn traits
            $corn_traits_id = handleEmpty($_POST['corn_traitsID']);
            $vegetative_state_corn_id = handleEmpty($_POST['vegetative_state_cornID']);
            $reproductive_state_corn_id = handleEmpty($_POST['reproductive_state_cornID']);

            // Delete from Crop table
            $query_delete_crop = "DELETE FROM crop WHERE crop_id = $1";
            $query_run_delete_crop = pg_query_params($conn, $query_delete_crop, [$crop_id]);

            if (!$query_run_delete_crop) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete images in ../../crop-page/modals/img/ directory
            $imagesPath = "../../crop-page/modals/img/";
            $currentSeedImages = explode(',', $current_image_seed);

            foreach ($currentSeedImages as $image) {
                $delete_path = $imagesPath . $image;
                if (file_exists($delete_path)) {
                    unlink($delete_path);
                }
            }

            // Delete from Crop Location table
            $query_delete_crop_loc = "DELETE FROM crop_location WHERE crop_location_id = $1";
            $query_run_delete_crop_loc = pg_query_params($conn, $query_delete_crop_loc, [$crop_location_id]);

            if (!$query_run_delete_crop_loc) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Utilization and cultural importance table
            $query_delete_util_cultural = "DELETE FROM utilization_cultural_importance WHERE utilization_cultural_id = $1";
            $query_run_delete_util_cultural = pg_query_params($conn, $query_delete_util_cultural, [$utilization_cultural_id]);

            if (!$query_run_delete_util_cultural) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Status table
            $query_delete_Status = "DELETE FROM status WHERE status_id = $1";
            $query_run_delete_Status = pg_query_params($conn, $query_delete_Status, [$status_id]);

            if (!$query_run_delete_Status) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            if (is_array($references_id)) {
                foreach ($references_id as $ref_id) {
                    if (!($ref_id === '' || $ref_id === null)) {
                        // Delete from references table
                        $query_delete_Reference = "DELETE FROM \"references\" WHERE references_id = $1";
                        $query_run_delete_Reference = pg_query_params($conn, $query_delete_Reference, array($ref_id));

                        if (!$query_run_delete_Reference) {
                            echo "Error: " . pg_last_error($conn);
                            die();
                        }
                    }
                }
            }

            // Delete from Corn Traits table
            $query_delete_corn_Traits = "DELETE FROM corn_traits WHERE corn_traits_id = $1";
            $query_run_delete_corn_Traits = pg_query_params($conn, $query_delete_corn_Traits, [$corn_traits_id]);

            if (!$query_run_delete_corn_Traits) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Disease Resistance table
            $query_delete_disease_res = "DELETE FROM corn_disease_resistance WHERE corn_traits_id = $1";
            $query_run_delete_disease_res = pg_query_params($conn, $query_delete_disease_res, [$corn_traits_id]);

            if (!$query_run_delete_disease_res) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Abiotic Resistance table
            $query_delete_abiotic_res = "DELETE FROM corn_abiotic_resistance WHERE corn_traits_id = $1";
            $query_run_delete_abiotic_res = pg_query_params($conn, $query_delete_abiotic_res, [$corn_traits_id]);

            if (!$query_run_delete_abiotic_res) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Pest Resistance_corn table
            $query_delete_pest_res = "DELETE FROM corn_pest_resistance WHERE corn_traits_id = $1";
            $query_run_delete_pest_res = pg_query_params($conn, $query_delete_pest_res, [$corn_traits_id]);

            if (!$query_run_delete_pest_res) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Vegetative state table
            $query_delete_veg_state = "DELETE FROM vegetative_state_corn WHERE vegetative_state_corn_id = $1";
            $query_run_delete_veg_state = pg_query_params($conn, $query_delete_veg_state, [$vegetative_state_corn_id]);

            if (!$query_run_delete_veg_state) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Reproductive state table
            $query_delete_repro_state = "DELETE FROM reproductive_state_corn WHERE reproductive_state_corn_id = $1";
            $query_run_delete_repro_state = pg_query_params($conn, $query_delete_repro_state, [$reproductive_state_corn_id]);

            if (!$query_run_delete_repro_state) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from seed traits table
            $query_delete_seed_traits = "DELETE FROM seed_traits WHERE seed_traits_id = $1";
            $query_run_delete_seed_traits = pg_query_params($conn, $query_delete_seed_traits, [$seed_traits_id]);

            if (!$query_run_delete_seed_traits) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from pest other resistance table
            $query_delete_pestOther = "DELETE FROM corn_pest_resistance_other WHERE corn_pest_other_id = $1";
            $query_run_delete_pestOther = pg_query_params($conn, $query_delete_pestOther, [$corn_pest_other_id]);

            if (!$query_run_delete_pestOther) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from abiotic other resistance table
            $query_delete_abioticOther = "DELETE FROM corn_abiotic_resistance_other WHERE corn_abiotic_other_id = $1";
            $query_run_delete_abioticOther = pg_query_params($conn, $query_delete_abioticOther, [$corn_abiotic_other_id]);

            if (!$query_run_delete_abioticOther) {
                echo "Error: " . pg_last_error($conn);
                die();
            }
        } else if ($get_category_name === 'Rice') {
            //id's for rice
            $rice_traits_id = handleEmpty($_POST['rice_traitsID']);
            $vegetative_state_rice_id = handleEmpty($_POST['vegetative_state_riceID']);
            $reproductive_state_rice_id = handleEmpty($_POST['reproductive_state_riceID']);
            $pest_resistance_rice_id = handleEmpty($_POST['pest_resistance_riceID']);
            $flag_leaf_traits_rice_id = handleEmpty($_POST['flag_leaf_traits_riceID']);
            $panicle_traits_rice_id = handleEmpty($_POST['panicle_traits_riceID']);
            $sensory_traits_rice_id = handleEmpty($_POST['sensory_traits_riceID']);

            // Delete from Crop table
            $query_delete_crop = "DELETE FROM crop WHERE crop_id = $1";
            $query_run_delete_crop = pg_query_params($conn, $query_delete_crop, [$crop_id]);

            if (!$query_run_delete_crop) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Crop Location table
            $query_delete_crop_loc = "DELETE FROM crop_location WHERE crop_location_id = $1";
            $query_run_delete_crop_loc = pg_query_params($conn, $query_delete_crop_loc, [$crop_location_id]);

            if (!$query_run_delete_crop_loc) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Utilization and cultural importance table
            $query_delete_util_cultural = "DELETE FROM utilization_cultural_importance WHERE utilization_cultural_id = $1";
            $query_run_delete_util_cultural = pg_query_params($conn, $query_delete_util_cultural, [$utilization_cultural_id]);

            if (!$query_run_delete_util_cultural) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Status table
            $query_delete_Status = "DELETE FROM status WHERE status_id = $1";
            $query_run_delete_Status = pg_query_params($conn, $query_delete_Status, [$status_id]);

            if (!$query_run_delete_Status) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // delete from reference table if available
            if (is_array($references_id)) {
                foreach ($references_id as $ref_id) {
                    if (!($ref_id === '' || $ref_id === null)) {
                        // Delete from references table
                        $query_delete_Reference = "DELETE FROM \"references\" WHERE references_id = $1";
                        $query_run_delete_Reference = pg_query_params($conn, $query_delete_Reference, array($ref_id));

                        if (!$query_run_delete_Reference) {
                            echo "Error: " . pg_last_error($conn);
                            die();
                        }
                    }
                }
            }

            // Delete from rice Traits table
            $query_delete_rice_Traits = "DELETE FROM rice_traits WHERE rice_traits_id = $1";
            $query_run_delete_rice_Traits = pg_query_params($conn, $query_delete_rice_Traits, [$rice_traits_id]);

            if (!$query_run_delete_rice_Traits) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Vegetative state table
            $query_delete_veg_state = "DELETE FROM vegetative_state_rice WHERE vegetative_state_rice_id = $1";
            $query_run_delete_veg_state = pg_query_params($conn, $query_delete_veg_state, [$vegetative_state_rice_id]);

            if (!$query_run_delete_veg_state) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Reproductive state table
            $query_delete_repro_state = "DELETE FROM reproductive_state_rice WHERE reproductive_state_rice_id = $1";
            $query_run_delete_repro_state = pg_query_params($conn, $query_delete_repro_state, [$reproductive_state_rice_id]);

            if (!$query_run_delete_repro_state) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from panicle traits table
            $query_delete_panicleTraits = "DELETE FROM panicle_traits_rice WHERE panicle_traits_rice_id = $1";
            $query_run_delete_panicleTraits = pg_query_params($conn, $query_delete_panicleTraits, [$panicle_traits_rice_id]);

            if (!$query_run_delete_panicleTraits) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from flag leaf traits table
            $query_delete_flagLeaf = "DELETE FROM flag_leaf_traits_rice WHERE flag_leaf_traits_rice_id = $1";
            $query_run_delete_flagLeaf = pg_query_params($conn, $query_delete_flagLeaf, [$flag_leaf_traits_rice_id]);

            if (!$query_run_delete_flagLeaf) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from sensory traits table
            $query_delete_sensoryTraits = "DELETE FROM sensory_traits_rice WHERE sensory_traits_rice_id = $1";
            $query_run_delete_sensoryTraits = pg_query_params($conn, $query_delete_sensoryTraits, [$sensory_traits_rice_id]);

            if (!$query_run_delete_sensoryTraits) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from seed traits table
            $query_delete_seed_traits = "DELETE FROM seed_traits WHERE seed_traits_id = $1";
            $query_run_delete_seed_traits = pg_query_params($conn, $query_delete_seed_traits, [$seed_traits_id]);

            if (!$query_run_delete_seed_traits) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Disease Resistance table
            $query_delete_disease_res = "DELETE FROM rice_disease_resistance WHERE rice_traits_id = $1";
            $query_run_delete_disease_res = pg_query_params($conn, $query_delete_disease_res, [$rice_traits_id]);

            if (!$query_run_delete_disease_res) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Abiotic Resistance table
            $query_delete_abiotic_res = "DELETE FROM rice_abiotic_resistance WHERE rice_traits_id = $1";
            $query_run_delete_abiotic_res = pg_query_params($conn, $query_delete_abiotic_res, [$rice_traits_id]);

            if (!$query_run_delete_abiotic_res) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Pest Resistance_rice table
            $query_delete_pest_res = "DELETE FROM rice_pest_resistance WHERE rice_traits_id = $1";
            $query_run_delete_pest_res = pg_query_params($conn, $query_delete_pest_res, [$rice_traits_id]);

            if (!$query_run_delete_pest_res) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from pest other resistance table
            $query_delete_pestOther = "DELETE FROM rice_pest_resistance_other WHERE rice_pest_other_id = $1";
            $query_run_delete_pestOther = pg_query_params($conn, $query_delete_pestOther, [$rice_pest_other_id]);

            if (!$query_run_delete_pestOther) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from abiotic other resistance table
            $query_delete_abioticOther = "DELETE FROM rice_abiotic_resistance_other WHERE rice_abiotic_other_id = $1";
            $query_run_delete_abioticOther = pg_query_params($conn, $query_delete_abioticOther, [$rice_abiotic_other_id]);

            if (!$query_run_delete_abioticOther) {
                echo "Error: " . pg_last_error($conn);
                die();
            }
        } else if ($get_category_name === 'Root Crop') {
            //id's for root crop
            $root_crop_traits_id = handleEmpty($_POST['root_crop_traitsID']);
            $rootcrop_traits_id = handleEmpty($_POST['rootcrop_traitsID']);
            $vegetative_state_rootcrop_id = handleEmpty($_POST['vegetative_state_rootcropID']);
            $reproductive_state_rootcrop_id = handleEmpty($_POST['reproductive_state_rootcropID']);
            $pest_resistance_rootcrop_id = handleEmpty($_POST['pest_resistance_rootcropID']);

            // Delete from Crop table
            $query_delete_crop = "DELETE FROM crop WHERE crop_id = $1";
            $query_run_delete_crop = pg_query_params($conn, $query_delete_crop, [$crop_id]);

            if (!$query_run_delete_crop) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Crop Location table
            $query_delete_crop_loc = "DELETE FROM crop_location WHERE crop_location_id = $1";
            $query_run_delete_crop_loc = pg_query_params($conn, $query_delete_crop_loc, [$crop_location_id]);

            if (!$query_run_delete_crop_loc) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Utilization and cultural importance table
            $query_delete_util_cultural = "DELETE FROM utilization_cultural_importance WHERE utilization_cultural_id = $1";
            $query_run_delete_util_cultural = pg_query_params($conn, $query_delete_util_cultural, [$utilization_cultural_id]);

            if (!$query_run_delete_util_cultural) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Status table
            $query_delete_Status = "DELETE FROM status WHERE status_id = $1";
            $query_run_delete_Status = pg_query_params($conn, $query_delete_Status, [$status_id]);

            if (!$query_run_delete_Status) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // delete from reference table if available
            if (is_array($references_id)) {
                foreach ($references_id as $ref_id) {
                    if (!($ref_id === '' || $ref_id === null)) {
                        // Delete from references table
                        $query_delete_Reference = "DELETE FROM \"references\" WHERE references_id = $1";
                        $query_run_delete_Reference = pg_query_params($conn, $query_delete_Reference, array($ref_id));

                        if (!$query_run_delete_Reference) {
                            echo "Error: " . pg_last_error($conn);
                            die();
                        }
                    }
                }
            }

            // Delete from root_crop Traits table
            $query_delete_root_crop_Traits = "DELETE FROM root_crop_traits WHERE root_crop_traits_id = $1";
            $query_run_delete_root_crop_Traits = pg_query_params($conn, $query_delete_root_crop_Traits, [$root_crop_traits_id]);

            if (!$query_run_delete_root_crop_Traits) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from rootcrop Traits table
            $query_delete_rootcrop_Traits = "DELETE FROM rootcrop_traits WHERE rootcrop_traits_id = $1";
            $query_run_delete_rootcrop_Traits = pg_query_params($conn, $query_delete_rootcrop_Traits, [$rootcrop_traits_id]);

            if (!$query_run_delete_rootcrop_Traits) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Vegetative state table
            $query_delete_veg_state = "DELETE FROM vegetative_state_rootcrop WHERE vegetative_state_rootcrop_id = $1";
            $query_run_delete_veg_state = pg_query_params($conn, $query_delete_veg_state, [$vegetative_state_rootcrop_id]);

            if (!$query_run_delete_veg_state) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Disease Resistance table
            $query_delete_disease_res = "DELETE FROM rootcrop_disease_resistance WHERE root_crop_traits_id = $1";
            $query_run_delete_disease_res = pg_query_params($conn, $query_delete_disease_res, [$root_crop_traits_id]);

            if (!$query_run_delete_disease_res) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Abiotic Resistance table
            $query_delete_abiotic_res = "DELETE FROM rootcrop_abiotic_resistance WHERE root_crop_traits_id = $1";
            $query_run_delete_abiotic_res = pg_query_params($conn, $query_delete_abiotic_res, [$root_crop_traits_id]);

            if (!$query_run_delete_abiotic_res) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Pest Resistance_rootcrop table
            $query_delete_pest_res = "DELETE FROM rootcrop_pest_resistance WHERE root_crop_traits_id = $1";
            $query_run_delete_pest_res = pg_query_params($conn, $query_delete_pest_res, [$root_crop_traits_id]);

            if (!$query_run_delete_pest_res) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from pest other resistance table
            $query_delete_pestOther = "DELETE FROM rootcrop_pest_resistance_other WHERE rootcrop_pest_other_id = $1";
            $query_run_delete_pestOther = pg_query_params($conn, $query_delete_pestOther, [$rootcrop_pest_other_id]);

            if (!$query_run_delete_pestOther) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from abiotic other resistance table
            $query_delete_abioticOther = "DELETE FROM rootcrop_abiotic_resistance_other WHERE rootcrop_abiotic_other_id = $1";
            $query_run_delete_abioticOther = pg_query_params($conn, $query_delete_abioticOther, [$rootcrop_abiotic_other_id]);

            if (!$query_run_delete_abioticOther) {
                echo "Error: " . pg_last_error($conn);
                die();
            }
        } else {
            // Delete from Crop table
            $query_delete_crop = "DELETE FROM crop WHERE crop_id = $1";
            $query_run_delete_crop = pg_query_params($conn, $query_delete_crop, [$crop_id]);

            if (!$query_run_delete_crop) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Crop Location table
            $query_delete_crop_loc = "DELETE FROM crop_location WHERE crop_location_id = $1";
            $query_run_delete_crop_loc = pg_query_params($conn, $query_delete_crop_loc, [$crop_location_id]);

            if (!$query_run_delete_crop_loc) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Utilization and cultural importance table
            $query_delete_util_cultural = "DELETE FROM utilization_cultural_importance WHERE utilization_cultural_id = $1";
            $query_run_delete_util_cultural = pg_query_params($conn, $query_delete_util_cultural, [$utilization_cultural_id]);

            if (!$query_run_delete_util_cultural) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // Delete from Status table
            $query_delete_Status = "DELETE FROM status WHERE status_id = $1";
            $query_run_delete_Status = pg_query_params($conn, $query_delete_Status, [$status_id]);

            if (!$query_run_delete_Status) {
                echo "Error: " . pg_last_error($conn);
                die();
            }

            // delete from reference table if available
            if (is_array($references_id)) {
                foreach ($references_id as $ref_id) {
                    if (!($ref_id === '' || $ref_id === null)) {
                        // Delete from references table
                        $query_delete_Reference = "DELETE FROM \"references\" WHERE references_id = $1";
                        $query_run_delete_Reference = pg_query_params($conn, $query_delete_Reference, array($ref_id));

                        if (!$query_run_delete_Reference) {
                            echo "Error: " . pg_last_error($conn);
                            die();
                        }
                    }
                }
            }
        }

        // Commit the transaction if everything is successful
        $_SESSION['message'] = "Crop Deleted Successfully";
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
