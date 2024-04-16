<?php
require "../../functions/connections.php";

if (isset($_POST['approve'])) {
    $crop_id = $_POST['crop_id'];
    $select = "UPDATE status
        SET action = 'approved'
        WHERE status_id IN (SELECT status_id FROM crop WHERE crop_id = '$crop_id')";

    $result = pg_query($conn, $select);
    if ($result) {
        $_SESSION['message'] = "Crop Approved";
        header("location: ../approval.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {
        // Log the error or display a more user-friendly message
        echo "Error updating record: " . pg_last_error($conn);
    }
}

if (isset($_POST['update'])) {
    $crop_idUpdate = $_POST['crop_id'];
    // get category name
    $get_name = "SELECT category_name FROM crop left join category on crop.category_id = category.category_id where crop.crop_id = $1";
    $query_run = pg_query_params($conn, $get_name, array($crop_idUpdate));

    if ($query_run) {
        $row_categoryName = pg_fetch_assoc(($query_run));
        $get_category_name = $row_categoryName['category_name'];
    } else {
        $_SESSION['message'] = "No category available, incomplete data";
        header("location: ../../../crop.php");
        exit();
    }

    // Start a database transaction
    pg_query($conn, "BEGIN");
    try {
        if ($get_category_name === 'Corn') {
            // Fetch data from the crop table and join with crop_location
            $query = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join location 
            on crop_location.location_id = location.location_id left join users on crop.user_id = users.user_id left join barangay
            on crop_location.barangay_id = barangay.barangay_id left join category_variety on crop.category_variety_id = category_variety.category_variety_id
            left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
            left join corn_traits on crop.crop_id = corn_traits.crop_id left join vegetative_state_corn on corn_traits.vegetative_state_corn_id = vegetative_state_corn.vegetative_state_corn_id
            left join reproductive_state_corn on corn_traits.reproductive_state_corn_id = reproductive_state_corn.reproductive_state_corn_id
            left join pest_resistance_corn on corn_traits.pest_resistance_corn_id = pest_resistance_corn.pest_resistance_corn_id
            left join disease_resistance on corn_traits.disease_resistance_id = disease_resistance.disease_resistance_id
            left join abiotic_resistance on corn_traits.abiotic_resistance_id = abiotic_resistance.abiotic_resistance_id
            left join seed_traits on seed_traits.seed_traits_id = reproductive_state_corn.seed_traits_id
            left join status on status.status_id = crop.status_id
            WHERE crop.crop_id = $1";
            $query_run = pg_query_params($conn, $query, array($crop_idUpdate));

            if (pg_num_rows($query_run) > 0) {
                $crops = pg_fetch_assoc($query_run);

                // gen.php data
                $crop_variety = $crops['crop_variety'];
                $crop_description = $crops['crop_description'];
                $meaning_of_name = $crops['meaning_of_name'];
                $crop_seed_image = $crops['crop_seed_image'];
                $crop_vegetative_image = $crops['crop_vegetative_image'];
                $crop_reproductive_image = $crops['crop_reproductive_image'];

                // location
                $province_name = $crops['province_name'];
                $municipality_name = $crops['municipality_name'];
                $coordinates = $crops['coordinates'];
                $barangay_name = $crops['barangay_name'];

                // disease resistance
                $bacterial = $crops['bacterial'];
                $viral = $crops['viral'];
                $fungus = $crops['fungus'];

                // abiotic resistance
                $drought = $crops['drought'];
                $salinity = $crops['salinity'];
                $heat = $crops['heat'];
                $abiotic_other = $crops['abiotic_other'];
                $abiotic_other_desc = $crops['abiotic_other_desc'];

                // Utilization Cultural Importance
                $significance = $crops['significance'];
                $use = $crops['use'];
                $indigenous_utilization = $crops['indigenous_utilization'];
                $remarkable_features = $crops['remarkable_features'];

                //* morphological Traits Corn
                // Vegetative state corn
                $corn_plant_height = $crops['corn_plant_height'];
                $corn_leaf_width = $crops['corn_leaf_width'];
                $corn_leaf_length = $crops['corn_leaf_length'];
                $corn_maturity_time = $crops['corn_maturity_time'];

                // Reproductive state corn
                $corn_yield_capacity = $crops['corn_yield_capacity'];

                // seed traits corn
                $seed_length = $crops['seed_length'];
                $seed_width = $crops['seed_width'];
                $seed_shape = $crops['seed_shape'];
                $seed_color = $crops['seed_color'];

                // pest resistance corn
                $corn_borers = $crops['corn_borers'];
                $earworms = $crops['earworms'];
                $spider_mites = $crops['spider_mites'];
                $corn_black_bug = $crops['corn_black_bug'];
                $corn_army_worms = $crops['corn_army_worms'];
                $leaf_aphid = $crops['leaf_aphid'];
                $corn_cutworms = $crops['corn_cutworms'];
                $corn_birds = $crops['corn_birds'];
                $corn_ants = $crops['corn_ants'];
                $corn_rats = $crops['corn_rats'];
                $corn_others = $crops['corn_others'];
                $corn_others_desc = $crops['corn_others_desc'];

                //id's to be deleted when finished updating
                $update_crop_id = $crops['crop_id'];
                $update_status_id = $crops['status_id'];
                $update_corn_traits_id = $crops['corn_traits_id'];
                $update_disease_resistance_id = $crops['disease_resistance_id'];
                $update_pest_resistance_corn_id = $crops['pest_resistance_corn_id'];
                $update_abiotic_resistance_id = $crops['abiotic_resistance_id'];
                $update_crop_location_id = $crops['crop_location_id'];
                $update_seed_traits_id = $crops['seed_traits_id'];
                $update_utilization_cultural_id = $crops['utilization_cultural_id'];
                $update_vegetative_state_corn_id = $crops['vegetative_state_corn_id'];
                $update_reproductive_state_corn_id = $crops['reproductive_state_corn_id'];

                // get the unique code the remove the updating
                $currentUniqueCode = $crops['unique_code'];
                $updateUniqueCode = str_replace("-UPDATING", "", $currentUniqueCode);

                // get the crop that should be updated
                $query_Crop = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join location 
                on crop_location.location_id = location.location_id left join barangay on crop_location.barangay_id = barangay.barangay_id
                left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id left join category on crop.category_id = category.category_id
                left join corn_traits on crop.crop_id = corn_traits.crop_id left join reproductive_state_corn on corn_traits.reproductive_state_corn_id = reproductive_state_corn.reproductive_state_corn_id
                left join status on status.status_id = crop.status_id
                WHERE crop.unique_code = $1";

                $query_runCrop = pg_query_params($conn, $query_Crop, array($updateUniqueCode));
                if (pg_num_rows($query_runCrop) > 0) {
                    $cropsUpdate = pg_fetch_assoc($query_runCrop);

                    //id's of the crop that needs to be updated
                    $crop_id = $cropsUpdate['crop_id'];
                    $category_id = $cropsUpdate['category_id'];
                    $crop_location_id = $cropsUpdate['crop_location_id'];
                    $disease_resistance_id = $cropsUpdate['disease_resistance_id'];
                    $abiotic_resistance_id = $cropsUpdate['abiotic_resistance_id'];
                    $seed_traits_id = $cropsUpdate['seed_traits_id'];
                    $utilization_cultural_id = $cropsUpdate['utilization_cultural_id'];
                    $vegetative_state_corn_id = $cropsUpdate['vegetative_state_corn_id'];
                    $reproductive_state_corn_id = $cropsUpdate['reproductive_state_corn_id'];
                    $pest_resistance_corn_id = $cropsUpdate['pest_resistance_corn_id'];
                    $status_id = $cropsUpdate['status_id'];
                    $action = "approved";
                    $remarks = "Updating of crop data is approved.";

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
                    $queryCrop = "UPDATE crop set crop_variety= $1, crop_description =$2, meaning_of_name = $3,
                    crop_seed_image = $4 where crop_id = $5";

                    $valueCrops = array(
                        $crop_variety, $crop_description, $meaning_of_name, $crop_seed_image, $crop_id
                    );
                    $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

                    if ($query_run_Crop) {
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }

                    // update Status table
                    $queryStatus = "UPDATE status set remarks= $1, action =$2 where status_id = $3";

                    $valueStatus = array(
                        $remarks, $action, $status_id
                    );
                    $query_run_Status = pg_query_params($conn, $queryStatus, $valueStatus);

                    if ($query_run_Status) {
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

                    // update Crop Location Table
                    $query_CropLoc = "UPDATE crop_location set location_id = $1, barangay_id = $2, coordinates = $3 where crop_location_id = $4";
                    $query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($location_id, $barangay_id, $coordinates, $crop_location_id));

                    if ($query_run_CropLoc) {
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }

                    // Handle corn category traits
                    // abiotic resistance
                    $query_abioticRes = "UPDATE abiotic_resistance set drought = $1, salinity = $2, heat = $3, abiotic_other = $4, abiotic_other_desc = $5 WHERE abiotic_resistance_id = $6";
                    $query_run_abioticRes = pg_query_params($conn, $query_abioticRes, array($drought, $salinity, $heat, $abiotic_other, $abiotic_other_desc, $abiotic_resistance_id));
                    if ($query_run_abioticRes) {
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }

                    // disease resistance
                    $query_diseaseRes = "UPDATE disease_resistance set bacterial = $1, viral = $2, fungus = $3 WHERE disease_resistance_id = $4";
                    $query_run_diseaseRes = pg_query_params($conn, $query_diseaseRes, array($bacterial, $viral, $fungus, $disease_resistance_id));
                    if ($query_run_diseaseRes) {
                        echo "success";
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }

                    // pest resistance corn
                    $query_pestRes = "UPDATE pest_resistance_corn set corn_borers = $1, earworms = $2, spider_mites = $3, corn_black_bug = $4, corn_army_worms = $5, leaf_aphid = $6, corn_cutworms = $7, corn_birds = $8, 
                    corn_ants = $9, corn_rats = $10, corn_others = $11, corn_others_desc = $12 where pest_resistance_corn_id = $13";
                    $query_run_pestRes = pg_query_params($conn, $query_pestRes, array(
                        $corn_borers, $earworms, $spider_mites, $corn_black_bug, $corn_army_worms, $leaf_aphid, $corn_cutworms, $corn_birds,
                        $corn_ants, $corn_rats, $corn_others, $corn_others_desc, $pest_resistance_corn_id
                    ));
                    if ($query_run_pestRes) {
                        echo "success";
                    } else {
                        echo "Error: " . pg_last_error($conn);
                        exit(0);
                    }

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
                }

                // Delete from Crop table
                $query_delete_crop = "DELETE FROM crop WHERE crop_id = $1";
                $query_run_delete_crop = pg_query_params($conn, $query_delete_crop, [$update_crop_id]);

                if (!$query_run_delete_crop) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from Crop Location table
                $query_delete_crop_loc = "DELETE FROM crop_location WHERE crop_location_id = $1";
                $query_run_delete_crop_loc = pg_query_params($conn, $query_delete_crop_loc, [$update_crop_location_id]);

                if (!$query_run_delete_crop_loc) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from Utilization and cultural importance table
                $query_delete_util_cultural = "DELETE FROM utilization_cultural_importance WHERE utilization_cultural_id = $1";
                $query_run_delete_util_cultural = pg_query_params($conn, $query_delete_util_cultural, [$update_utilization_cultural_id]);

                if (!$query_run_delete_util_cultural) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from Status table
                $query_delete_Status = "DELETE FROM status WHERE status_id = $1";
                $query_run_delete_Status = pg_query_params($conn, $query_delete_Status, [$update_status_id]);

                if (!$query_run_delete_Status) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from Corn Traits table
                $query_delete_corn_Traits = "DELETE FROM corn_traits WHERE corn_traits_id = $1";
                $query_run_delete_corn_Traits = pg_query_params($conn, $query_delete_corn_Traits, [$update_corn_traits_id]);

                if (!$query_run_delete_corn_Traits) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from Disease Resistance table
                $query_delete_disease_res = "DELETE FROM disease_resistance WHERE disease_resistance_id = $1";
                $query_run_delete_disease_res = pg_query_params($conn, $query_delete_disease_res, [$update_disease_resistance_id]);

                if (!$query_run_delete_disease_res) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from Abiotic Resistance table
                $query_delete_abiotic_res = "DELETE FROM abiotic_resistance WHERE abiotic_resistance_id = $1";
                $query_run_delete_abiotic_res = pg_query_params($conn, $query_delete_abiotic_res, [$update_abiotic_resistance_id]);

                if (!$query_run_delete_abiotic_res) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from Pest Resistance_corn table
                $query_delete_pest_res = "DELETE FROM pest_resistance_corn WHERE pest_resistance_corn_id = $1";
                $query_run_delete_pest_res = pg_query_params($conn, $query_delete_pest_res, [$update_pest_resistance_corn_id]);

                if (!$query_run_delete_pest_res) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from Vegetative state table
                $query_delete_veg_state = "DELETE FROM vegetative_state_corn WHERE vegetative_state_corn_id = $1";
                $query_run_delete_veg_state = pg_query_params($conn, $query_delete_veg_state, [$update_vegetative_state_corn_id]);

                if (!$query_run_delete_veg_state) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from Reproductive state table
                $query_delete_repro_state = "DELETE FROM reproductive_state_corn WHERE reproductive_state_corn_id = $1";
                $query_run_delete_repro_state = pg_query_params($conn, $query_delete_repro_state, [$update_reproductive_state_corn_id]);

                if (!$query_run_delete_repro_state) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }

                // Delete from seed traits table
                $query_delete_seed_traits = "DELETE FROM seed_traits WHERE seed_traits_id = $1";
                $query_run_delete_seed_traits = pg_query_params($conn, $query_delete_seed_traits, [$update_seed_traits_id]);

                if (!$query_run_delete_seed_traits) {
                    echo "Error: " . pg_last_error($conn);
                    die();
                }
            }
        }
        // Commit the transaction if everything is successful
        $_SESSION['message'] = "Crop Update Approved";
        pg_query($conn, "COMMIT");
        header("Location: ../approval.php");
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

if (isset($_POST['rejected'])) {
    $crop_id = $_POST['crop_id'];
    $select = "UPDATE crop SET status = 'rejected' WHERE crop_id = '$crop_id' ";
    $result = pg_query($conn, $select);
    if ($result) {

        header("location: ../approval.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {
        echo "Error updating record"; // Display an error message if the query fails
    }
}
