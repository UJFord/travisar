<?php
session_start();
// require "../mail.php";
require "../../../functions/connections.php";

// if (isset($_POST['save']) && $_SESSION['rank'] == 'curator') {
if (isset($_POST['save'])) {
    // Begin the database transaction
    pg_query($con, "BEGIN");
    try {
        // Function to handle empty values
        function handleEmpty($value)
        {
            return empty($value) ? 'Empty' : $value;
        }

        // Get user inputs for data in crop Location table
        $province_name = handleEmpty($_POST['province_name']);
        $municipality_name = handleEmpty($_POST['municipality_name']);
        $longtitude = handleEmpty($_POST['longtitude']);
        $latitude = handleEmpty($_POST['latitude']);

        // Inserting into location table using parameterized query
        $query_location = "INSERT INTO location (province_name, municipality_name, longtitude,
            latitude) 
            VALUES ($1, $2, $3, $4) RETURNING location_id";

        $query_run_location = pg_query_params($con, $query_location, array(
            $province_name, $municipality_name, $longtitude,
            $latitude
        ));

        if ($query_run_location) {
            $row_location = pg_fetch_row($query_run_location);
            $location_id = $row_location[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Get user inputs for data in crop characteristics table
        $taste = handleEmpty($_POST['taste']);
        $aroma = handleEmpty($_POST['aroma']);
        $maturation = handleEmpty($_POST['maturation']);
        $pest_and_disease_resistance = handleEmpty($_POST['pest_and_disease_resistance']);

        // Inserting into characteristics table using parameterized query
        $query_characteristics = "INSERT INTO characteristics (taste, aroma, maturation,
            pest_and_disease_resistance) 
            VALUES ($1, $2, $3, $4) RETURNING characteristics_id";

        $query_run_characteristics = pg_query_params($con, $query_characteristics, array(
            $taste, $aroma, $maturation,
            $pest_and_disease_resistance
        ));

        if ($query_run_characteristics) {
            $row_characteristics = pg_fetch_row($query_run_characteristics);
            $characteristics_id = $row_characteristics[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Get user inputs for data in crop Location table
        $farming_practice_type = handleEmpty($_POST['farming_practice_type']);
        $farming_practice_name = handleEmpty($_POST['farming_practice_name']);
        $farming_practice_description = handleEmpty($_POST['farming_practice_description']);

        // Inserting into location table using parameterized query
        $query_farming_practice = "INSERT INTO farming_practice (farming_practice_type, farming_practice_name, farming_practice_description) 
            VALUES ($1, $2, $3) RETURNING farming_practice_id";

        $query_run_farming_practice = pg_query_params($con, $query_farming_practice, array(
            $farming_practice_type, $farming_practice_name, $farming_practice_description
        ));

        if ($query_run_farming_practice) {
            $row_farming_practice = pg_fetch_row($query_run_farming_practice);
            $farming_practice_id = $row_farming_practice[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Get user inputs for data in crop Location table
        $other_info_type = handleEmpty($_POST['other_info_type']);
        $other_info_name = handleEmpty($_POST['other_info_name']);
        $other_info_description = handleEmpty($_POST['other_info_description']);
        $other_info_url = handleEmpty($_POST['other_info_url']);

        // Inserting into location table using parameterized query
        $query_other_info = "INSERT INTO other_info (other_info_type, other_info_name, other_info_description,
            other_info_url) 
            VALUES ($1, $2, $3, $4) RETURNING other_info_id";

        $query_run_other_info = pg_query_params($con, $query_other_info, array(
            $other_info_type, $other_info_name, $other_info_description,
            $other_info_url
        ));

        if ($query_run_other_info) {
            $row_other_info = pg_fetch_row($query_run_other_info);
            $other_info_id = $row_other_info[0];
        } else {
            echo "Error: " . pg_last_error($con);
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
                $destination_path = "../img/crop/" . $filename;
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $finalimg = '';

                if (in_array($ext, $extension)) {
                    // Auto rename image
                    $image = "Crop_image_" . rand(000, 999) . '.' . $ext;

                    // Check if the image name already exists in the database
                    while (true) {
                        $query = "SELECT crop_image FROM crop WHERE crop_image = $1";
                        $result = pg_query_params($con, $query, array($image));

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
                    $destination_path = "../img/crop/" . $image;

                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if (!$upload) {
                        echo "wala na upload ang image";
                        echo "Error: " . pg_last_error($con);
                        die();
                    }

                    $finalimg = $image;
                    $imageNamesArray[] = $finalimg; // Add image name to the array
                } else {
                    // Display error message for invalid file format
                    echo "invalid ang file format image";
                    echo "Error: " . pg_last_error($con);
                    die();
                }
            }
        } else {
            // Don't upload image and set the image value as blank
            echo "wala image na select";
            echo "Error: " . pg_last_error($con);
            die();
        }

        $imageNamesString = implode(',', $imageNamesArray);
        $user_id = $_POST['user_id'];
        $status = 'approved';

        // Inserting into Crop table using parameterized query
        $query_crop = "INSERT INTO crop (
            crop_image, crop_name, crop_description, upland_or_lowland, category, crop_local_name,
            planting_techniques, cultural_and_spiritual_significance, role_in_maintaining_upland_ecosystem,
            cultural_importance_and_traditional_knowledge, unique_features, cultural_use, associated_vegetation,
            threats, user_id, status
            ) VALUES (
                $1, $2, $3, $4, $5, $6, $7, $8, $9, $10,
                $11, $12, $13, $14, $15, $16
            ) RETURNING crop_id";

        $stmt_crop = pg_prepare($con, "insert_crop", $query_crop);
        $query_run_crop = pg_execute($con, "insert_crop", array(
            $imageNamesString,
            handleEmpty($_POST['crop_name']),
            handleEmpty($_POST['crop_description']),
            handleEmpty($_POST['upland_or_lowland']),
            handleEmpty($_POST['category']),
            handleEmpty($_POST['crop_local_name']),
            handleEmpty($_POST['planting_techniques']),
            handleEmpty($_POST['cultural_and_spiritual_significance']),
            handleEmpty($_POST['role_in_maintaining_upland_ecosystem']),
            handleEmpty($_POST['cultural_importance_and_traditional_knowledge']),
            handleEmpty($_POST['unique_features']),
            handleEmpty($_POST['cultural_use']),
            handleEmpty($_POST['associated_vegetation']),
            handleEmpty($_POST['threats']),
            $user_id, $status
        ));

        if ($query_run_crop) {
            $row_crop = pg_fetch_row($query_run_crop);
            $crop_id = $row_crop[0];
            // $_SESSION['message'] = "Crop Created Successfully";
            // header("Location: list.php");
            // exit(0);
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Inserting into crop_location table using parameterized query
        $query_crop_loc = "INSERT INTO crop_location (crop_id, location_id) VALUES ($1, $2) RETURNING crop_location_id";
        $stmt_crop_loc = pg_prepare($con, "insert_crop_loc", $query_crop_loc);
        $query_run_crop_loc = pg_execute($con, "insert_crop_loc", array(
            $crop_id, $location_id
        ));

        if ($query_run_crop_loc) {
            $row_crop_loc = pg_fetch_row($query_run_crop_loc);
            $crop_location_id = $row_crop_loc[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Inserting into crop_farming_practice table using parameterized query
        $query_farm_prac = "INSERT INTO crop_farming_practice (crop_id, farming_practice_id) VALUES ($1, $2) RETURNING crop_farming_practice_id";
        $stmt_farm_prac = pg_prepare($con, "insert_farm_prac", $query_farm_prac);
        $query_run_farm_prac = pg_execute($con, "insert_farm_prac", array(
            $crop_id, $farming_practice_id
        ));

        if ($query_run_farm_prac) {
            $row_farm_prac = pg_fetch_row($query_run_farm_prac);
            $crop_farming_practice_id = $row_farm_prac[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Inserting into crop_characteristics table using parameterized query
        $query_crop_characteristics = "INSERT INTO crop_characteristics (crop_id, characteristics_id) VALUES ($1, $2) RETURNING crop_characteristics_id";
        $stmt_crop_characteristics = pg_prepare($con, "insert_crop_characteristics", $query_crop_characteristics);
        $query_run_crop_characteristics = pg_execute($con, "insert_crop_characteristics", array(
            $crop_id, $characteristics_id
        ));

        if ($query_run_crop_characteristics) {
            $row_crop_characteristics = pg_fetch_row($query_run_crop_characteristics);
            $crop_characteristics_id = $row_crop_characteristics[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Inserting into crop_other_info table using parameterized query
        $query_crop_other_info = "INSERT INTO crop_other_info (crop_id, other_info_id) VALUES ($1, $2) RETURNING crop_other_info_id";
        $stmt_crop_other_info = pg_prepare($con, "insert_crop_other_info", $query_crop_other_info);
        $query_run_crop_other_info = pg_execute($con, "insert_crop_other_info", array(
            $crop_id, $other_info_id
        ));

        if ($query_run_crop_other_info) {
            $row_crop_other_info = pg_fetch_row($query_run_crop_other_info);
            $crop_other_info_id = $row_crop_other_info[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Updating Crop table using parameterized query
        $query_combine_crop = "UPDATE crop SET crop_location_id = $1, crop_farming_practice_id = $2, crop_other_info_id = $3, crop_characteristics_id = $4 WHERE crop_id = $5 RETURNING crop_id";

        $stmt_combine_crop = pg_prepare($con, "update_combine_crop", $query_combine_crop);
        $query_run_combine_crop = pg_execute($con, "update_combine_crop", array(
            $crop_location_id, $crop_farming_practice_id, $crop_other_info_id, $crop_characteristics_id, $crop_id
        ));

        if ($query_run_combine_crop) {
            $row_crop = pg_fetch_row($query_run_combine_crop);
            $crop_id = $row_crop[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Commit the transaction if everything is successful
        pg_query($con, "COMMIT");
        $_SESSION['message'] = "Crop Created Successfully";
        header("Location: list.php");
        exit(0);
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        pg_query($con, "ROLLBACK");
        // Handle the error
        echo "Error: " . $e->getMessage();
        exit(0);
    }
}
