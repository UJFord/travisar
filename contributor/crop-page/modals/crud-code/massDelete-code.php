<?php
session_start();
require "../../../../functions/connections.php";


if (isset($_POST['delete_row']) && $_SESSION['rank'] == 'Curator' || $_SESSION['rank'] == 'Admin') {
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
        $crop_id = handleEmpty($_POST['crop_id']);
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

            // Delete images in ../img/ directory
            $imagesPath = "../img/";
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
        }

        // Commit the transaction if everything is successful
        $_SESSION['message'] = "Crop Deleted Successfully";
        pg_query($conn, "COMMIT");
        header("Location: ../../crop.php");
        exit(0);
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Crop not Deleted';
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
