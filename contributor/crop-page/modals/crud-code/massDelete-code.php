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
        $crop_id = handleEmpty($_POST['crop_id']);

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
            // Fetch data from the crop table and join with crop_location
            $query = "SELECT *
            FROM crop
            LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id
            LEFT JOIN municipality ON crop_location.municipality_id = municipality.municipality_id
            LEFT JOIN users ON crop.user_id = users.user_id
            LEFT JOIN barangay ON crop_location.barangay_id = barangay.barangay_id
            LEFT JOIN province ON province.province_id = municipality.province_id
            LEFT JOIN category_variety ON crop.category_variety_id = category_variety.category_variety_id
            LEFT JOIN terrain ON terrain.terrain_id = crop.terrain_id
            LEFT JOIN category ON category.category_id = crop.category_id
            LEFT JOIN utilization_cultural_importance ON crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
            LEFT JOIN corn_traits ON crop.crop_id = corn_traits.crop_id
            LEFT JOIN reproductive_state_corn ON corn_traits.reproductive_state_corn_id = reproductive_state_corn.reproductive_state_corn_id
            LEFT JOIN seed_traits ON seed_traits.seed_traits_id = reproductive_state_corn.seed_traits_id
            LEFT JOIN \"references\" ON \"references\".crop_id = crop.crop_id
            left join \"status\" on \"status\".status_id = crop.status_id
            WHERE crop.crop_id = $1";

            $query_run = pg_query_params($conn, $query, array($crop_id));
            if (pg_num_rows($query_run) > 0) {
                $corn_row = pg_fetch_assoc($query_run);
                // Id's for corn traits
                $crop_location_id = $corn_row['crop_location_id'];
                $seed_traits_id = $corn_row['seed_traits_id'];
                $utilization_cultural_id = $corn_row['utilization_cultural_id'];
                $references_id = $corn_row['references_id'];
                $status_id = $corn_row['status_id'];

                // corn traits
                $corn_traits_id = $corn_row['corn_traits_id'];
                $vegetative_state_corn_id = $corn_row['vegetative_state_corn_id'];
                $reproductive_state_corn_id = $corn_row['reproductive_state_corn_id'];
                $corn_pest_other_id = $corn_row['corn_pest_other_id'];
                $corn_abiotic_other_id = $corn_row['corn_abiotic_other_id'];

                // get the old image
                $current_image_seed = $corn_row['crop_seed_image'];
                $current_image_veg = $corn_row['crop_vegetative_image'];
                $current_image_repro = $corn_row['crop_reproductive_image'];

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

                // Delete images in ../img/ directory
                $imagesPath = "../img/";
                $currentVegImages = explode(',', $current_image_veg);

                foreach ($currentVegImages as $image) {
                    $delete_path = $imagesPath . $image;
                    if (file_exists($delete_path)) {
                        unlink($delete_path);
                    }
                }

                // Delete images in ../img/ directory
                $imagesPath = "../img/";
                $currentReproImages = explode(',', $current_image_repro);

                foreach ($currentReproImages as $image) {
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
            }
        } else if ($get_category_name === 'Rice') {
            // Fetch data from the rice table
            $query = "SELECT *
            FROM crop 
            LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id 
            left join municipality on crop_location.municipality_id = municipality.municipality_id left join users on crop.user_id = users.user_id left join barangay
            on crop_location.barangay_id = barangay.barangay_id left join province on province.province_id = municipality.province_id
            left join category_variety on crop.category_variety_id = category_variety.category_variety_id left join terrain on terrain.terrain_id = crop.terrain_id
            left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
            left join rice_traits on crop.crop_id = rice_traits.crop_id left join vegetative_state_rice on rice_traits.vegetative_state_rice_id = vegetative_state_rice.vegetative_state_rice_id
            left join reproductive_state_rice on rice_traits.reproductive_state_rice_id = reproductive_state_rice.reproductive_state_rice_id
            left join seed_traits on seed_traits.seed_traits_id = reproductive_state_rice.seed_traits_id
            left join panicle_traits_rice on panicle_traits_rice.panicle_traits_rice_id = reproductive_state_rice.panicle_traits_rice_id
            left join flag_leaf_traits_rice on flag_leaf_traits_rice.flag_leaf_traits_rice_id = reproductive_state_rice.flag_leaf_traits_rice_id
            LEFT JOIN sensory_traits_rice ON sensory_traits_rice.sensory_traits_rice_id = rice_traits.sensory_traits_rice_id
            LEFT JOIN \"references\" ON \"references\".crop_id = crop.crop_id
            left join \"status\" on \"status\".status_id = crop.status_id
            WHERE crop.crop_id = $1";
            $query_run = pg_query_params($conn, $query, array($crop_id));

            if (pg_num_rows($query_run) > 0) {
                $rice_row = pg_fetch_assoc($query_run);
                // Id's for corn traits
                $crop_location_id = $rice_row['crop_location_id'];
                $seed_traits_id = $rice_row['seed_traits_id'];
                $utilization_cultural_id = $rice_row['utilization_cultural_id'];
                $references_id = $rice_row['references_id'];
                $status_id = $rice_row['status_id'];

                // get the old image
                $current_image_seed = $rice_row['crop_seed_image'];
                $current_image_veg = $rice_row['crop_vegetative_image'];
                $current_image_repro = $rice_row['crop_reproductive_image'];

                //id's for rice
                $rice_traits_id = $rice_row['rice_traits_id'];
                $vegetative_state_rice_id = $rice_row['vegetative_state_rice_id'];
                $reproductive_state_rice_id = $rice_row['reproductive_state_rice_id'];
                $pest_resistance_rice_id = $rice_row['pest_resistance_rice_id'];
                $flag_leaf_traits_rice_id = $rice_row['flag_leaf_traits_rice_id'];
                $panicle_traits_rice_id = $rice_row['panicle_traits_rice_id'];
                $sensory_traits_rice_id = $rice_row['sensory_traits_rice_id'];
                $rice_pest_other_id = $rice_row['rice_pest_other_id'];
                $rice_abiotic_other_id = $rice_row['rice_abiotic_other_id'];

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

                // Delete images in ../img/ directory
                $imagesPath = "../img/";
                $currentVegImages = explode(',', $current_image_veg);

                foreach ($currentVegImages as $image) {
                    $delete_path = $imagesPath . $image;
                    if (file_exists($delete_path)) {
                        unlink($delete_path);
                    }
                }

                // Delete images in ../img/ directory
                $imagesPath = "../img/";
                $currentReproImages = explode(',', $current_image_repro);

                foreach ($currentReproImages as $image) {
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
            }
        } else if ($get_category_name === 'Root Crop') {
            // Fetch data from the crop table and join with crop_location
            $query = "SELECT DISTINCT crop.*, crop_location.*, municipality.*, users.*, barangay.*, province.*, category_variety.*, terrain.*, category.*, utilization_cultural_importance.*, root_crop_traits.*, vegetative_state_rootcrop.*, rootcrop_traits.*, 
            ARRAY(SELECT DISTINCT rootcrop_pest_resistance.pest_resistance_id FROM rootcrop_pest_resistance WHERE rootcrop_pest_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS pest_resistances,
            ARRAY(SELECT DISTINCT rootcrop_disease_resistance.disease_resistance_id FROM rootcrop_disease_resistance WHERE rootcrop_disease_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS disease_resistances,
            ARRAY(SELECT DISTINCT rootcrop_abiotic_resistance.abiotic_resistance_id FROM rootcrop_abiotic_resistance WHERE rootcrop_abiotic_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS abiotic_resistances,
            rootcrop_pest_resistance_other.*, rootcrop_abiotic_resistance_other.*, \"references\".*, \"status\".*
            FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join municipality on crop_location.municipality_id = municipality.municipality_id left join users on crop.user_id = users.user_id 
            left join barangay on crop_location.barangay_id = barangay.barangay_id left join category_variety on crop.category_variety_id = category_variety.category_variety_id left join terrain on terrain.terrain_id = crop.terrain_id
            LEFT JOIN province ON province.province_id = municipality.province_id
            left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
            left join root_crop_traits on crop.crop_id = root_crop_traits.crop_id left join vegetative_state_rootcrop on root_crop_traits.vegetative_state_rootcrop_id = vegetative_state_rootcrop.vegetative_state_rootcrop_id
            left join rootcrop_pest_resistance on root_crop_traits.root_crop_traits_id = rootcrop_pest_resistance.root_crop_traits_id left join pest_resistance on pest_resistance.pest_resistance_id = rootcrop_pest_resistance.pest_resistance_id
            left join rootcrop_disease_resistance on root_crop_traits.root_crop_traits_id = rootcrop_disease_resistance.root_crop_traits_id left join disease_resistance on disease_resistance.disease_resistance_id = rootcrop_disease_resistance.disease_resistance_id
            left join rootcrop_abiotic_resistance on root_crop_traits.root_crop_traits_id = rootcrop_abiotic_resistance.root_crop_traits_id left join abiotic_resistance on abiotic_resistance.abiotic_resistance_id = rootcrop_abiotic_resistance.abiotic_resistance_id
            left join rootcrop_pest_resistance_other on rootcrop_pest_resistance_other.rootcrop_pest_other_id = root_crop_traits.rootcrop_pest_other_id
            left join rootcrop_abiotic_resistance_other on rootcrop_abiotic_resistance_other.rootcrop_abiotic_other_id = root_crop_traits.rootcrop_abiotic_other_id
            left join rootcrop_traits on rootcrop_traits.rootcrop_traits_id = root_crop_traits.rootcrop_traits_id
            LEFT JOIN \"references\" ON \"references\".crop_id = crop.crop_id
            left join \"status\" on \"status\".status_id = crop.status_id
            WHERE crop.crop_id = $1";
            $query_run = pg_query_params($conn, $query, array($crop_id));

            if (pg_num_rows($query_run) > 0) {
                $rootcrop_row = pg_fetch_assoc($query_run);
                // Id's for corn traits
                $crop_location_id = $rootcrop_row['crop_location_id'];
                $seed_traits_id = $rootcrop_row['seed_traits_id'];
                $utilization_cultural_id = $rootcrop_row['utilization_cultural_id'];
                $references_id = $rootcrop_row['references_id'];
                $status_id = $rootcrop_row['status_id'];

                // get the old image
                $current_image_seed = $rootcrop_row['crop_seed_image'];
                $current_image_veg = $rootcrop_row['crop_vegetative_image'];
                $current_image_repro = $rootcrop_row['crop_reproductive_image'];

                //id's for root crop
                $root_crop_traits_id = $rootcrop_row['root_crop_traits_id'];
                $rootcrop_traits_id = $rootcrop_row['rootcrop_traits_id'];
                $vegetative_state_rootcrop_id = $rootcrop_row['vegetative_state_rootcrop_id'];
                $reproductive_state_rootcrop_id = $rootcrop_row['reproductive_state_rootcrop_id'];
                $pest_resistance_rootcrop_id = $rootcrop_row['pest_resistance_rootcrop_id'];
                $rootcrop_pest_other_id = $rootcrop_row['rootcrop_pest_other_id'];
                $rootcrop_abiotic_other_id = $rootcrop_row['rootcrop_abiotic_other_id'];

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

                // Delete images in ../img/ directory
                $imagesPath = "../img/";
                $currentVegImages = explode(',', $current_image_veg);

                foreach ($currentVegImages as $image) {
                    $delete_path = $imagesPath . $image;
                    if (file_exists($delete_path)) {
                        unlink($delete_path);
                    }
                }

                // Delete images in ../img/ directory
                $imagesPath = "../img/";
                $currentReproImages = explode(',', $current_image_repro);

                foreach ($currentReproImages as $image) {
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
