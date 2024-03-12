<?php
session_start();
require "../../../../functions/connections.php";

// if (isset($_POST['save']) && $_SESSION['rank'] == 'curator') {
// working nani sya pero kay naah may changes sa loc need ni sya i update
if (isset($_POST['save']) && $_SESSION['rank'] == 'Encoder') {
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
        $crop_description = handleEmpty($_POST['crop_description']);
        $province_name = $_POST['province'];
        $municipality_name = $_POST['municipality'];
        $name_origin = handleEmpty($_POST['name_origin']);
        $threats = handleEmpty($_POST['threats']);
        $coordinates = handleEmpty($_POST['coordinates']);

        $barangay_name = $_POST['barangay'];
        $user_id = $_POST['user_id'];
        $status = 'pending';

        // Check if the array keys are set before accessing them
        $scientific_name = isset($_POST['scientific_name']) ? handleEmpty($_POST['scientific_name']) : "Empty";
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

        // Validate the form data
        if (empty($crop_variety) || empty($scientific_name) || empty($category_id) || empty($_FILES['crop_image']['name'])) {
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

        // for creating a unique code for each crop
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
            scientific_name, name_origin, crop_description, status, cultural_aspect_id, threats, user_id, crop_image)
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12) RETURNING crop_id";

        $valueCrops = array(
            $crop_variety, $crop_local_name, $category_id, $newUniqueCode,
            $scientific_name, $name_origin, $crop_description, $status, $cultural_aspect_id, $threats, $user_id, $imageNamesString
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

        // save into Crop Field Table
        $query_CropField = "INSERT into crop_field (crop_id, field_id) VALUES ($1, $2) returning crop_field_id";
        $query_run_CropField = pg_query_params($conn, $query_CropField, array($crop_id, $field_id));

        if ($query_run_CropField) {
            // Check if any rows were affected
            if (pg_affected_rows($query_run_CropField) > 0) {
                $row_CropField = pg_fetch_row($query_run_CropField);
                $crop_field_id = $row_CropField[0];
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
        pg_query($conn, "COMMIT");
        $_SESSION['message'] = "Crop Created Successfully";
        header("Location: ../../../crop.php");
        exit(0);
    } catch (Exception $e) {
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
} else {
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
            $field_id = $_POST['field_id'];
            $crop_description = handleEmpty($_POST['crop_description']);
            $province_name = $_POST['province'];
            $municipality_name = $_POST['municipality'];
            $name_origin = handleEmpty($_POST['name_origin']);
            $threats = handleEmpty($_POST['threats']);
            $coordinates = handleEmpty($_POST['coordinates']);

            $barangay_name = $_POST['barangay'];
            $user_id = $_POST['user_id'];
            $status = 'approved';

            // Check if the array keys are set before accessing them
            $scientific_name = isset($_POST['scientific_name']) ? handleEmpty($_POST['scientific_name']) : "Empty";
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

            // Validate the form data
            if (empty($crop_variety) || empty($scientific_name) || empty($category_id) || empty($_FILES['crop_image']['name'])) {
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
                    scientific_name, name_origin, crop_description, status, cultural_aspect_id, threats, user_id, crop_image)
                        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12) RETURNING crop_id";

            $valueCrops = array(
                $crop_variety, $crop_local_name, $category_id, $newUniqueCode,
                $scientific_name, $name_origin, $crop_description, $status, $cultural_aspect_id, $threats, $user_id, $imageNamesString
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

            // save into Crop Field Table
            $query_CropField = "INSERT into crop_field (crop_id, field_id) VALUES ($1, $2) returning crop_field_id";
            $query_run_CropField = pg_query_params($conn, $query_CropField, array($crop_id, $field_id));

            if ($query_run_CropField) {
                // Check if any rows were affected
                if (pg_affected_rows($query_run_CropField) > 0) {
                    $row_CropField = pg_fetch_row($query_run_CropField);
                    $crop_field_id = $row_CropField[0];
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
            pg_query($conn, "COMMIT");
            $_SESSION['message'] = "Crop Created Successfully";
            header("Location: ../../../crop.php");
            exit(0);
        } catch (Exception $e) {
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
    } else {
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
                $field_id = $_POST['field_id'];
                // $crop_image = $_POST['crop_image[]'];
                $crop_description = handleEmpty($_POST['crop_description']);
                $province_name = $_POST['province'];
                $municipality_name = $_POST['municipality'];
                $barangay_name = $_POST['barangay'];
                $threats = handleEmpty($_POST['threats']);
                $coordinates = handleEmpty($_POST['coordinates']);
                $current_crop_image = handleEmpty($_POST['old_image']);

                $status = 'approved';

                // Id's
                $crop_id = handleEmpty($_POST['crop_id']);
                $cultural_aspect_id = handleEmpty($_POST['cultural_aspect_id']);
                $crop_location_id = handleEmpty($_POST['crop_location_id']);
                $crop_field_id = handleEmpty($_POST['crop_field_id']);
                $characteristics_id = handleEmpty($_POST['characteristics_id']);

                // Check if the array keys are set before accessing them
                $role_in_maintaining_upland_ecosystem = isset($_POST['role_in_maintaining_upland_ecosystem']) ? handleEmpty($_POST['role_in_maintaining_upland_ecosystem']) : "Empty";
                $scientific_name = isset($_POST['scientific_name']) ? handleEmpty($_POST['scientific_name']) : "Empty";
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
                    $image = "Crop_Image_" . rand(000, 999) . '.' . $ext;

                    // Check if the image with the same name already exists in the directory
                    while (file_exists("../img/" . $image)) {
                        $image = "Crop_Image_" . rand(000, 999) . '.' . $ext;
                    }

                    return $image;
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

                            // Delete the old image if it exists
                            if (!empty($current_crop_image)) {
                                // Split the old image filenames by comma
                                $old_image_filenames = explode(',', $current_crop_image);

                                // Iterate over each filename and delete the file
                                foreach ($old_image_filenames as $filename) {
                                    $old_image_path = "../img/" . trim($filename);
                                    if (file_exists($old_image_path)) {
                                        unlink($old_image_path);
                                    }
                                }
                            }

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
                $queryCrop = "UPDATE crop SET crop_variety = $1, crop_local_name = $2, name_origin = $3,
                scientific_name = $4, crop_description = $5, cultural_aspect_id = $6, threats = $7, crop_image = $8
                WHERE crop_id = $9";

                $valueCrops = array(
                    $crop_variety, $crop_local_name, $name_origin,
                    $scientific_name, $crop_description, $cultural_aspect_id, $threats, $finalimg, $crop_id
                );
                $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

                if ($query_run_Crop) {
                    echo 'success crop id';
                } else {
                    echo "Error: " . pg_last_error($conn);
                    exit(0);
                }

                // characteristics table
                $query_charac = "UPDATE characteristics SET taste = $2, aroma = $3, maturation = $4, pest = $5, diseases = $6 WHERE characteristics_id = $1 RETURNING characteristics_id";
                $query_run_charac = pg_query_params($conn, $query_charac, array($characteristics_id, $taste, $aroma, $maturation, $pest, $diseases));

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
                // Rollback the transaction if an error occurs
                pg_query($conn, "ROLLBACK");
                // Handle the error
                echo "Error: " . $e->getMessage();
                $_SESSION['message'] = "Crop not updated";
                header("Location: ../../../crop.php");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Not Enough Authority";
            header("Location: ../../../crop.php");
            exit(0);
        }
    }
}
