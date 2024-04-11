<?php

if (isset($_POST['edit']) && $_SESSION['rank'] == 'Curator' || $_SESSION['rank'] == 'Admin') {
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
        // $crop_image = $_POST['crop_image[]'];
        $crop_description = handleEmpty($_POST['crop_description']);
        $province_name = $_POST['province'];
        $municipality_name = $_POST['municipality'];
        $barangay_name = $_POST['barangay'];
        $meaning_of_name = handleEmpty($_POST['meaning_of_name']);
        $coordinates = handleEmpty($_POST['coordinates']);
        $current_crop_image = handleEmpty($_POST['old_image']);
        $status = 'approved';

        // Id's
        $crop_id = handleEmpty($_POST['crop_id']);
        $cultural_aspect_id = handleEmpty($_POST['cultural_aspect_id']);
        $crop_location_id = handleEmpty($_POST['crop_location_id']);
        $characteristics_id = handleEmpty($_POST['characteristics_id']);

        // Check if the array keys are set before accessing them
        $role_in_maintaining_upland_ecosystem = isset($_POST['role_in_maintaining_upland_ecosystem']) ? handleEmpty($_POST['role_in_maintaining_upland_ecosystem']) : "Empty";
        $unique_features = isset($_POST['unique_features']) ? handleEmpty($_POST['unique_features']) : "Empty";
        $other_category_name = isset($_POST['other_category_name']) ? handleEmpty($_POST['other_category_name']) : "Empty";

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

        // Update Cultural Aspect
        $query_CulturalAspect = "UPDATE cultural_aspect 
        SET cultural_significance = $1, 
            spiritual_significance = $2, 
            cultural_importance = $3, 
            cultural_use = $4
        WHERE cultural_aspect_id = $5";
        $query_run_CulturalAspect = pg_query_params($conn, $query_CulturalAspect, array(
            $cultural_significance,
            $spiritual_significance, $cultural_importance, $cultural_use, $cultural_aspect_id
        ));

        if ($query_run_CulturalAspect !== false) {
            $affected_rows = pg_affected_rows($query_run_CulturalAspect);
            if ($affected_rows > 0) {
                echo "Cultural aspect updated successfully";
            } else {
                echo "Error: Cultural aspect ID not found";
                exit(0);
            }
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Array to store uploaded image names
        $uploadedImages = [];

        // Function to generate a unique image name
        function generate_unique_image_name($ext)
        {
            return "Crop_Image_" . rand(000, 999) . '.' . $ext;
        }

        // Function to check if an image name already exists in the database
        function image_name_exists($conn, $image)
        {
            $query = "SELECT crop_image FROM crop WHERE crop_image LIKE $1";
            $result = pg_query_params($conn, $query, array('%' . $image . '%'));

            if ($result === false) {
                return false;
            }

            $count = pg_num_rows($result);
            return $count > 0;
        }

        // function to update images
        if (isset($_FILES['crop_image']['name'][0]) && is_array($_FILES['crop_image']['name']) && $_FILES['crop_image']['name'][0] != "") {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_image']['name'] as $key => $value) {
                $filename = $_FILES['crop_image']['name'][$key];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (in_array($ext, $extension)) {
                    // Check if the image name already exists in the database
                    $image = $filename;
                    if (image_name_exists($conn, $image)) {
                        // If the image name exists, use the original name
                        $uploadedImages[] = $image;
                    } else {
                        // Auto rename image if it doesn't exist in the database
                        $new_image = generate_unique_image_name($ext);
                        $source_path = $_FILES['crop_image']['tmp_name'][$key];
                        $destination_path = "../img/" . $new_image;

                        // Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the image is uploaded or not
                        if (!$upload) {
                            echo "Image upload failed";
                            die();
                        }

                        $uploadedImages[] = $new_image; // Add image name to the array
                    }
                } else {
                    // Display error message for invalid file format
                }
            }

            $finalimg = implode(',', $uploadedImages);
        } else {
            // No new images selected, use the current ones
            $currentImages = explode(',', $current_crop_image);
            $uploadedImages = array_merge($uploadedImages, $currentImages);
            $finalimg = implode(',', $uploadedImages);
        }

        // update crop table
        $queryCrop = "UPDATE crop SET crop_variety = $1, crop_local_name = $2, crop_description = $3,
        cultural_aspect_id = $4, meaning_of_name = $5, crop_image = $6
        WHERE crop_id = $7";

        $valueCrops = array(
            $crop_variety, $crop_local_name, $crop_description,
            $cultural_aspect_id, $meaning_of_name, $finalimg, $crop_id
        );
        $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

        if ($query_run_Crop) {
            echo 'success crop id';
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // characteristics table
        $query_charac = "UPDATE characteristics SET taste = $2, aroma = $3, maturation = $4, pest = $5, diseases = 
                        $6 WHERE characteristics_id = $1 RETURNING characteristics_id";
        $query_run_charac = pg_query_params($conn, $query_charac, array(
            $characteristics_id, $taste, $aroma,
            $maturation, $pest, $diseases
        ));

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

        // Barangay table
        //get the barangay id
        $querybrgy = "SELECT barangay_id from barangay where barangay_name = $1";
        $query_run_brgy = pg_query_params($conn, $querybrgy, array($barangay_name));

        if ($query_run_brgy) {
            $row_brgy = pg_fetch_row(($query_run_brgy));
            $barangay_id = $row_brgy[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // update Crop Location Table
        $query_CropLoc = "UPDATE crop_location set crop_id = $1, location_id = $2, barangay_id = $3 where crop_location_id = $4";
        $query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($crop_id, $location_id, $barangay_id, $crop_location_id));

        if ($query_run_CropLoc) {
            // Check if any rows were affected
            if (pg_affected_rows($query_run_CropLoc) > 0) {
                echo 'sucessfully crop loc';
            } else {
                echo "Error: No rows affected";
                exit(0);
            }
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Commit the transaction if everything is successful
        pg_query($conn, "COMMIT");
        $_SESSION['message'] = "Crop Updated Successfully";
        header("Location: ../../../crop.php");
        exit(0);
    } catch (Exception $e) {
        $_SESSION['message'] = "Crop not edited";
        // Rollback the transaction if an error occurs
        pg_query($conn, "ROLLBACK");
        // Handle the error
        echo "Error: " . $e->getMessage();
        $_SESSION['message'] = "Crop not updated";
        header("Location: ../../../crop.php");
        exit(0);
    }
}
