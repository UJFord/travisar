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
            return empty($value) ? 'Empty' : $value;
        }
        // get all the data in the form
        $crop_variety = handleEmpty($_POST['crop_variety']);
        $crop_local_name = handleEmpty($_POST['crop_local_name']);
        $category_id = $_POST['category_id'];
        $category_variety_id = handleEmpty($_POST['category_variety_id']);
        $crop_description = handleEmpty($_POST['crop_description']);
        $province_name = $_POST['province'];
        $municipality_name = $_POST['municipality'];
        $meaning_of_name = handleEmpty($_POST['meaning_of_name']);
        $coordinates = handleEmpty($_POST['coordinates']);
        $terrain_id = handleEmpty($_POST['terrain_id']);

        $barangay_name = $_POST['barangay'];
        $user_id = $_POST['user_id'];
        $status = 'approved';

        // Check if the array keys are set before accessing them
        $other_category_name = isset($_POST['other_category_name']) ? handleEmpty($_POST['other_category_name']) : "Empty";

        // morphological characteristics
        $plant_structure = isset($_POST['plant_structure']) ? handleEmpty($_POST['plant_structure']) : "Empty";
        $leaves = isset($_POST['leaves']) ? handleEmpty($_POST['leaves']) : "Empty";
        $shape = isset($_POST['shape']) ? handleEmpty($_POST['shape']) : "Empty";
        $root_system = isset($_POST['root_system']) ? handleEmpty($_POST['root_system']) : "Empty";
        $inflorescence = isset($_POST['inflorescence']) ? handleEmpty($_POST['inflorescence']) : "Empty";
        $flower = isset($_POST['flower']) ? handleEmpty($_POST['flower']) : "Empty";
        $fruits = isset($_POST['fruits']) ? handleEmpty($_POST['fruits']) : "Empty";
        $plant_height = isset($_POST['plant_height']) ? handleEmpty($_POST['plant_height']) : "Empty";
        $roots = isset($_POST['roots']) ? handleEmpty($_POST['roots']) : "Empty";
        $grain = isset($_POST['grain']) ? handleEmpty($_POST['grain']) : "Empty";
        $husk = isset($_POST['husk']) ? handleEmpty($_POST['husk']) : "Empty";
        $plant_size = isset($_POST['plant_size']) ? handleEmpty($_POST['plant_size']) : "Empty";
        $color = isset($_POST['color']) ? handleEmpty($_POST['color']) : "Empty";
        $root_characteristics = isset($_POST['root_characteristics']) ? handleEmpty($_POST['root_characteristics']) : "Empty";
        $stem_leaf_characteristics = isset($_POST['stem_leaf_characteristics']) ? handleEmpty($_POST['stem_leaf_characteristics']) : "Empty";
        $growth_habit = isset($_POST['growth_habit']) ? handleEmpty($_POST['growth_habit']) : "Empty";

        // Cultural Aspect
        $cultural_significance = handleEmpty($_POST['cultural_significance']);
        $spiritual_significance = handleEmpty($_POST['spiritual_significance']);
        $cultural_importance = handleEmpty($_POST['cultural_importance']);
        $cultural_use = handleEmpty($_POST['cultural_use']);

        // Characteristics
        $taste = handleEmpty($_POST['taste']);
        $aroma = handleEmpty($_POST['aroma']);
        $maturation = handleEmpty($_POST['maturation']);
        $pest = handleEmpty($_POST['pest']);
        $diseases = handleEmpty($_POST['diseases']);

        // Validate the form data
        if (empty($crop_variety) || empty($category_variety_id) || empty($category_id)) {
            throw new Exception("All fields are required.");
        }

        // Check if the image is selected
        if (!isset($_FILES['crop_image']['name']) || !is_array($_FILES['crop_image']['name'])) {
            throw new Exception("Please select an image.");
        }

        // Check for upload errors
        foreach ($_FILES['crop_image']['error'] as $key => $error) {
            if ($error !== UPLOAD_ERR_OK) {
                throw new Exception("Image upload error: " . $error);
            }
        }

        // query to save the cultural aspect
        $query_CulturalAspect = "INSERT into cultural_aspect (cultural_significance, spiritual_significance, cultural_importance, cultural_use) VALUES ($1, $2, $3, $4) returning cultural_aspect_id";
        $query_run_CulturalAspect = pg_query_params($conn, $query_CulturalAspect, array($cultural_significance, $spiritual_significance, $cultural_importance, $cultural_use));

        if ($query_run_CulturalAspect !== false) {
            $affected_rows = pg_fetch_row($query_run_CulturalAspect);
            if ($affected_rows > 0) {
                $cultural_aspect_id = $affected_rows[0];
            } else {
                echo "Error: Cultural aspect ID not found";
                exit(0);
            }
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // query to save the Morphological Characteristics
        $query_morphCharac = "INSERT into morphological_characteristics (plant_structure, leaves, shape, root_system, inflorescence, flower, fruits, plant_height, 
            roots, grain, husk, plant_size, color, root_characteristics, stem_leaf_characteristics, growth_habit) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13,
            $14, $15, $16) returning morphological_characteristics_id";
        $query_run_morphCharac = pg_query_params($conn, $query_morphCharac, array(
            $plant_structure, $leaves, $shape, $root_system, $inflorescence, $flower, $fruits,
            $plant_height, $roots, $grain, $husk, $plant_size, $color, $root_characteristics, $stem_leaf_characteristics, $growth_habit
        ));

        if ($query_run_morphCharac !== false) {
            $affected_rows = pg_fetch_row($query_run_morphCharac);
            if ($affected_rows > 0) {
                $morphological_characteristics_id = $affected_rows[0];
            } else {
                echo "Error: Morphological Characteristics ID not found";
                exit(0);
            }
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Array to store uploaded image names
        $imageNamesArray = [];

        // Check if the image is selected
        if (isset($_FILES['crop_image']['name']) && is_array($_FILES['crop_image']['name'])) {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_image']['name'] as $key => $value) {
                $filename = $_FILES['crop_image']['name'][$key];
                $filename_tmp = $_FILES['crop_image']['tmp_name'][$key];
                $destination_path = "../img/" . $filename;
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $finalimg = '';

                if (in_array($ext, $extension)) {
                    // Auto rename image
                    $image = "Crop_image_" . rand(000, 999) . '.' . $ext;

                    // Check if the image name already exists in the database
                    while (true) {
                        $query = "SELECT crop_image FROM crop WHERE crop_image = $1";
                        $result = pg_query_params($conn, $query, array($image));

                        if ($result === false) {
                            break;
                        }

                        $count = pg_num_rows($result);

                        if ($count == 0) {
                            break;
                        } else {
                            // If the image name exists, generate a new one
                            $image = "Crop_image_" . rand(000, 999) . '.' . $ext;
                        }
                    }

                    $source_path = $_FILES['crop_image']['tmp_name'][$key];
                    $destination_path = "../img/" . $image;

                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if (!$upload) {
                        echo "wala na upload ang image";
                        echo "Error: " . pg_last_error($conn);
                        die();
                    }

                    $finalimg = $image;
                    $imageNamesArray[] = $finalimg; // Add image name to the array
                } else {
                    // Display error message for invalid file format
                    echo "invalid ang file format image";
                    echo "Error: " . pg_last_error($conn);
                    die();
                }
            }
        } else {
            // Don't upload image and set the image value as blank
            echo "wala image na select";
            echo "Error: " . pg_last_error($conn);
            die();
        }

        $imageNamesString = implode(',', $imageNamesArray);

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

        //insert into crop table
        $queryCrop = "INSERT INTO crop (crop_variety, crop_local_name, category_id, unique_code,
                crop_description, status, cultural_aspect_id, meaning_of_name, user_id, crop_image, category_variety_id, terrain_id, morphological_characteristics_id)
                VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13) RETURNING crop_id";

        $valueCrops = array(
            $crop_variety, $crop_local_name, $category_id, $newUniqueCode,
            $crop_description, $status, $cultural_aspect_id, $meaning_of_name, $user_id, $imageNamesString, $category_variety_id,
            $terrain_id, $morphological_characteristics_id
        );
        $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

        if ($query_run_Crop) {
            $row_crop = pg_fetch_row($query_run_Crop);
            $crop_id = $row_crop[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // characteristics table
        $query_charac = "INSERT into characteristics (crop_id, taste, aroma, maturation, pest, diseases) VALUES ($1, $2, $3, $4, $5, $6) RETURNING characteristics_id";
        $query_run_charac = pg_query_params($conn, $query_charac, array($crop_id, $taste, $aroma, $maturation, $pest, $diseases));

        if ($query_run_charac) {
            // Check if any rows were affected
            if (pg_affected_rows($query_run_charac) > 0) {
                $row_charac = pg_fetch_row($query_run_charac);
                $characteristics_id = $row_charac[0];
            } else {
                echo "Error: No rows affected";
                exit(0);
            }
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
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Barangay Tab
        // get the barangay id
        $querybrgy = "SELECT barangay_id from barangay where barangay_name = $1";
        $query_run_brgy = pg_query_params($conn, $querybrgy, array($barangay_name));

        if ($query_run_brgy) {
            $row_brgy = pg_fetch_row(($query_run_brgy));
            $barangay_id = $row_brgy[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // save into Crop Location Table
        $query_CropLoc = "INSERT into crop_location (crop_id, location_id, barangay_id, coordinates) VALUES ($1, $2, $3, $4) RETURNING crop_location_id";
        $query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($crop_id, $location_id, $barangay_id, $coordinates));

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

        // other category
        // if nag select og other category ang user ma save ang name sa db if wala empty lang
        $query_OtherCategory = "INSERT INTO other_category (crop_id, other_category_name) VALUES ($1, $2)";
        $query_run_OtherCategory = pg_query_params($conn, $query_OtherCategory, array($crop_id, $other_category_name));

        if ($query_run_OtherCategory) {
            $row_OtherCategory = pg_fetch_row($query_run_OtherCategory);
            $other_category_id = $row_OtherCategory[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Commit the transaction if everything is successful
        $_SESSION['message'] = "Crop Created Successfully";
        pg_query($conn, "COMMIT");
        header("Location: ../../../crop.php");
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
