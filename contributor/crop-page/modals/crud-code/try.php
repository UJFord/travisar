<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['edit'])) {
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
        $field_id = $_POST['field_id'];
        // $crop_image = $_POST['crop_image[]'];
        $crop_description = handleEmpty($_POST['crop_description']);
        $province_name = $_POST['province'];
        $municipality_name = $_POST['municipality'];
        $barangay_name = $_POST['barangay'];
        $threats = handleEmpty($_POST['threats']);
        $neighborhood = handleEmpty($_POST['neighborhood']);
        $coordinates = handleEmpty($_POST['coordinates']);
        $current_crop_image = handleEmpty($_POST['old_image']);

        $status = 'pending';

        // Id's
        $crop_id = handleEmpty($_POST['crop_id']);
        $cultural_aspect_id = handleEmpty($_POST['cultural_aspect_id']);
        $crop_location_id = handleEmpty($_POST['crop_location_id']);
        $crop_field_id = handleEmpty($_POST['crop_field_id']);
        $other_category_id = handleEmpty($_POST['other_category_id']);

        // Check if the array keys are set before accessing them
        $role_in_maintaining_upland_ecosystem = isset($_POST['role_in_maintaining_upland_ecosystem']) ? handleEmpty($_POST['role_in_maintaining_upland_ecosystem']) : "Empty";
        $scientific_name = isset($_POST['scientific_name']) ? handleEmpty($_POST['scientific_name']) : "Empty";
        $unique_features = isset($_POST['unique_features']) ? handleEmpty($_POST['unique_features']) : "Empty";
        $other_category_name = isset($_POST['other_category_name']) ? handleEmpty($_POST['other_category_name']) : "Empty";

        // Cultural Aspect
        $cultural_significance = handleEmpty($_POST['cultural_significance']);
        $spiritual_significance = handleEmpty($_POST['spiritual_significance']);
        $cultural_importance_and_traditional_knowledge = handleEmpty($_POST['cultural_importance_and_traditional_knowledge']);
        $cultural_use = handleEmpty($_POST['cultural_use']);

        // Update Cultural Aspect
        $query_CulturalAspect = "UPDATE cultural_aspect 
        SET cultural_significance = $1, 
            spiritual_significance = $2, 
            cultural_importance_and_traditional_knowledge = $3, 
            cultural_use = $4
        WHERE cultural_aspect_id = $5";
        $query_run_CulturalAspect = pg_query_params($conn, $query_CulturalAspect, array(
            $cultural_significance,
            $spiritual_significance, $cultural_importance_and_traditional_knowledge, $cultural_use, $cultural_aspect_id
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

        // function to update images
        if (isset($_FILES['crop_image']['name'][0]) && is_array($_FILES['crop_image']['name']) && $_FILES['crop_image']['name'][0] != "") {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_image']['name'] as $key => $value) {
                $filename = $_FILES['crop_image']['name'][$key];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (in_array($ext, $extension)) {
                    // Auto rename image
                    $image = generate_unique_image_name($ext);

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
                            $image = generate_unique_image_name($ext);
                        }
                    }

                    $source_path = $_FILES['crop_image']['tmp_name'][$key];
                    $destination_path = "../img/" . $image;

                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if (!$upload) {
                        echo "Image upload failed";
                        die();
                    }

                    $uploadedImages[] = $image; // Add image name to the array

                } else {
                    // Display error message for invalid file format
                }
            }

            $finalimg = implode(',', $uploadedImages);
        } else {
            // No new images selected, use the current ones
            $finalimg = $current_crop_image;
        }

        // update crop table
        $queryCrop = "UPDATE crop SET crop_variety = $1, crop_local_name = $2, category_id = $3, role_in_maintaining_upland_ecosystem = $4,
        scientific_name = $5, unique_features = $6, crop_description = $7, status = $8, cultural_aspect_id = $9, threats = $10, crop_image = $11
        WHERE crop_id = $12";    

        $valueCrops = array(
            $crop_variety, $crop_local_name, $category_id, $role_in_maintaining_upland_ecosystem,
            $scientific_name, $unique_features, $crop_description, $status, $cultural_aspect_id, $threats, $finalimg, $crop_id
        );
        $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

        if ($query_run_Crop) {
            echo 'success crop id';
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

        // update Crop Location Table
        $query_CropLoc = "UPDATE crop_location set crop_id = $1, location_id = $2 where crop_location_id = $3";
        $query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($crop_id, $location_id, $crop_location_id));

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

        // save into Crop Field Table
        $query_CropField = "UPDATE crop_field set crop_id = $1, field_id = $2 where crop_field_id = $3";
        $query_run_CropField = pg_query_params($conn, $query_CropField, array($crop_id, $field_id, $crop_field_id));

        if ($query_run_CropField) {
            // Check if any rows were affected
            if (pg_affected_rows($query_run_CropField) > 0) {
                echo "success crop field";
            } else {
                echo "Error: No rows affected";
                exit(0);
            }
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // other category
        // if nag select og other categoy ang user ma save ang name sa db if wala empty lang
        $query_OtherCategory = "UPDATE other_category set crop_id = $1, other_category_name = $2 where other_category_id = $3";
        $query_run_OtherCategory = pg_query_params($conn, $query_OtherCategory, array($crop_id, $other_category_name, $other_category_id));

        if ($query_run_OtherCategory) {
            $row_OtherCategory = pg_fetch_row($query_run_OtherCategory);
            $other_category_id = $row_OtherCategory[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Commit the transaction if everything is successful
        pg_query($conn, "COMMIT");
        $_SESSION['message'] = "Crop Created Successfully";
        header("Location: ../../../crop.php");
        exit(0);
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        pg_query($conn, "ROLLBACK");
        // Handle the error
        echo "Error: " . $e->getMessage();
        exit(0);
    }
}
