<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['click_edit_btn'])) {
    $crop_id = $_POST["crop_id"];
    $arrayresult = [];

    // get category name
    $get_name = "SELECT category_name FROM crop left join category on crop.category_id = category.category_id where crop.crop_id = $1";
    $query_run = pg_query_params($conn, $get_name, array($crop_id));

    if ($query_run) {
        $row_categoryName = pg_fetch_assoc(($query_run));
        $get_category_name = $row_categoryName['category_name'];
    } else {
        $_SESSION['message'] = "No category available, incomplete data";
        header("location: ../../../crop.php");
        exit();
    }

    if ($get_category_name === 'Corn') {
        // Fetch data from the crop table and join with crop_location
        $query = "SELECT DISTINCT crop.*, crop_location.*, municipality.*, users.*, barangay.*, province.*, category_variety.*, terrain.*, category.*, utilization_cultural_importance.*, rice_traits.*, vegetative_state_rice.*, reproductive_state_rice.*,
        ARRAY(SELECT DISTINCT rice_pest_resistance.pest_resistance_id FROM rice_pest_resistance WHERE rice_pest_resistance.rice_traits_id = rice_traits.rice_traits_id) AS pest_resistances,
        ARRAY(SELECT DISTINCT rice_disease_resistance.disease_resistance_id FROM rice_disease_resistance WHERE rice_disease_resistance.rice_traits_id = rice_traits.rice_traits_id) AS disease_resistances,
        ARRAY(SELECT DISTINCT rice_abiotic_resistance.abiotic_resistance_id FROM rice_abiotic_resistance WHERE rice_abiotic_resistance.rice_traits_id = rice_traits.rice_traits_id) AS abiotic_resistances,
        rice_pest_resistance_other.*, rice_abiotic_resistance_other.*, seed_traits.*, \"references\".*, \"status\".*, panicle_traits_rice.*, flag_leaf_traits_rice.*, sensory_traits_rice.*
        FROM crop 
        LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id 
        left join municipality on crop_location.municipality_id = municipality.municipality_id left join users on crop.user_id = users.user_id left join barangay
        on crop_location.barangay_id = barangay.barangay_id left join province on province.province_id = municipality.province_id
        left join category_variety on crop.category_variety_id = category_variety.category_variety_id left join terrain on terrain.terrain_id = crop.terrain_id
        left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
        left join rice_traits on crop.crop_id = rice_traits.crop_id left join vegetative_state_rice on rice_traits.vegetative_state_rice_id = vegetative_state_rice.vegetative_state_rice_id
        left join reproductive_state_rice on rice_traits.reproductive_state_rice_id = reproductive_state_rice.reproductive_state_rice_id
        left join rice_pest_resistance on rice_traits.rice_traits_id = rice_pest_resistance.rice_traits_id left join pest_resistance on pest_resistance.pest_resistance_id = rice_pest_resistance.pest_resistance_id
        left join rice_disease_resistance on rice_traits.rice_traits_id = rice_disease_resistance.rice_traits_id left join disease_resistance on disease_resistance.disease_resistance_id = rice_disease_resistance.disease_resistance_id
        left join rice_abiotic_resistance on rice_traits.rice_traits_id = rice_abiotic_resistance.rice_traits_id left join abiotic_resistance on abiotic_resistance.abiotic_resistance_id = rice_abiotic_resistance.abiotic_resistance_id
        left join rice_pest_resistance_other on rice_pest_resistance_other.rice_pest_other_id = rice_traits.rice_pest_other_id
        left join rice_abiotic_resistance_other on rice_abiotic_resistance_other.rice_abiotic_other_id = rice_traits.rice_abiotic_other_id
        left join seed_traits on seed_traits.seed_traits_id = reproductive_state_rice.seed_traits_id
        left join panicle_traits_rice on panicle_traits_rice.panicle_traits_rice_id = reproductive_state_rice.panicle_traits_rice_id
        left join flag_leaf_traits_rice on flag_leaf_traits_rice.flag_leaf_traits_rice_id = reproductive_state_rice.flag_leaf_traits_rice_id
        LEFT JOIN sensory_traits_rice ON sensory_traits_rice.sensory_traits_rice_id = rice_traits.sensory_traits_rice_id
        LEFT JOIN \"references\" ON \"references\".crop_id = crop.crop_id
		left join \"status\" on \"status\".status_id = crop.status_id
        WHERE crop.crop_id = $1";

        $query_run = pg_query_params($conn, $query, array($crop_id));

        if (pg_num_rows($query_run) > 0) {
            while ($row = pg_fetch_assoc($query_run)) {
                $arrayresult[] = $row;
            }

            header('Content-Type: application/json');
            echo json_encode($arrayresult);
        }
    } elseif ($get_category_name === 'Rice') {
        // Fetch data from the rice table
        $query = "SELECT DISTINCT crop.*, crop_location.*, municipality.*, users.*, barangay.*, province.*, category_variety.*, terrain.*, category.*, utilization_cultural_importance.*, rice_traits.*, vegetative_state_rice.*, reproductive_state_rice.*,
        ARRAY(SELECT DISTINCT rice_pest_resistance.pest_resistance_id FROM rice_pest_resistance WHERE rice_pest_resistance.rice_traits_id = rice_traits.rice_traits_id) AS pest_resistances,
        ARRAY(SELECT DISTINCT rice_disease_resistance.disease_resistance_id FROM rice_disease_resistance WHERE rice_disease_resistance.rice_traits_id = rice_traits.rice_traits_id) AS disease_resistances,
        ARRAY(SELECT DISTINCT rice_abiotic_resistance.abiotic_resistance_id FROM rice_abiotic_resistance WHERE rice_abiotic_resistance.rice_traits_id = rice_traits.rice_traits_id) AS abiotic_resistances,
        rice_pest_resistance_other.*, rice_abiotic_resistance_other.*, seed_traits.*, \"references\".*, \"status\".*, panicle_traits_rice.*, flag_leaf_traits_rice.*, sensory_traits_rice.*
        FROM crop 
        LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id 
        left join municipality on crop_location.municipality_id = municipality.municipality_id left join users on crop.user_id = users.user_id left join barangay
        on crop_location.barangay_id = barangay.barangay_id left join province on province.province_id = municipality.province_id
        left join category_variety on crop.category_variety_id = category_variety.category_variety_id left join terrain on terrain.terrain_id = crop.terrain_id
        left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
        left join rice_traits on crop.crop_id = rice_traits.crop_id left join vegetative_state_rice on rice_traits.vegetative_state_rice_id = vegetative_state_rice.vegetative_state_rice_id
        left join reproductive_state_rice on rice_traits.reproductive_state_rice_id = reproductive_state_rice.reproductive_state_rice_id
        left join rice_pest_resistance on rice_traits.rice_traits_id = rice_pest_resistance.rice_traits_id left join pest_resistance on pest_resistance.pest_resistance_id = rice_pest_resistance.pest_resistance_id
        left join rice_disease_resistance on rice_traits.rice_traits_id = rice_disease_resistance.rice_traits_id left join disease_resistance on disease_resistance.disease_resistance_id = rice_disease_resistance.disease_resistance_id
        left join rice_abiotic_resistance on rice_traits.rice_traits_id = rice_abiotic_resistance.rice_traits_id left join abiotic_resistance on abiotic_resistance.abiotic_resistance_id = rice_abiotic_resistance.abiotic_resistance_id
        left join rice_pest_resistance_other on rice_pest_resistance_other.rice_pest_other_id = rice_traits.rice_pest_other_id
        left join rice_abiotic_resistance_other on rice_abiotic_resistance_other.rice_abiotic_other_id = rice_traits.rice_abiotic_other_id
        left join seed_traits on seed_traits.seed_traits_id = reproductive_state_rice.seed_traits_id
        left join panicle_traits_rice on panicle_traits_rice.panicle_traits_rice_id = reproductive_state_rice.panicle_traits_rice_id
        left join flag_leaf_traits_rice on flag_leaf_traits_rice.flag_leaf_traits_rice_id = reproductive_state_rice.flag_leaf_traits_rice_id
        LEFT JOIN sensory_traits_rice ON sensory_traits_rice.sensory_traits_rice_id = rice_traits.sensory_traits_rice_id
        LEFT JOIN \"references\" ON \"references\".crop_id = crop.crop_id
        left join \"status\" on \"status\".status_id = crop.status_id
        WHERE crop.crop_id = $1
        ";
        $query_run = pg_query_params($conn, $query, array($crop_id));

        if (pg_num_rows($query_run) > 0) {
            while ($row = pg_fetch_assoc($query_run)) {
                $arrayresult[] = $row;
            }

            header('Content-Type: application/json');
            echo json_encode($arrayresult);
        }
    } elseif ($get_category_name === 'Root Crop') {
        // Fetch data from the crop table and join with crop_location
        $query = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join municipality 
        on crop_location.municipality_id = municipality.municipality_id left join users on crop.user_id = users.user_id left join barangay
        on crop_location.barangay_id = barangay.barangay_id left join category_variety on crop.category_variety_id = category_variety.category_variety_id left join terrain on terrain.terrain_id = crop.terrain_id
        left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
        left join root_crop_traits on crop.crop_id = root_crop_traits.crop_id left join vegetative_state_rootcrop on root_crop_traits.vegetative_state_rootcrop_id = vegetative_state_rootcrop.vegetative_state_rootcrop_id
        left join rootcrop_pest_resistance on root_crop_traits.root_crop_traits_id = rootcrop_pest_resistance.root_crop_traits_id left join pest_resistance on pest_resistance.pest_resistance_id = rootcrop_pest_resistance.pest_resistance_id
        left join rootcrop_disease_resistance on root_crop_traits.root_crop_traits_id = rootcrop_disease_resistance.root_crop_traits_id left join disease_resistance on disease_resistance.disease_resistance_id = rootcrop_disease_resistance.disease_resistance_id
        left join rootcrop_abiotic_resistance on root_crop_traits.root_crop_traits_id = rootcrop_abiotic_resistance.root_crop_traits_id left join abiotic_resistance on abiotic_resistance.abiotic_resistance_id = rootcrop_abiotic_resistance.abiotic_resistance_id
        left join rootcrop_pest_resistance_other on rootcrop_pest_resistance_other.rootcrop_pest_other_id = root_crop_traits.rootcrop_pest_other_id
        left join rootcrop_abiotic_resistance_other on rootcrop_abiotic_resistance_other.rootcrop_abiotic_other_id = root_crop_traits.rootcrop_abiotic_other_id
        left join rootcrop_traits on rootcrop_traits.rootcrop_traits_id = root_crop_traits.rootcrop_traits_id
        left join \"status\" on \"status\".status_id = crop.status_id
        WHERE crop.crop_id = $1";
        $query_run = pg_query_params($conn, $query, array($crop_id));

        if (pg_num_rows($query_run) > 0) {
            while ($row = pg_fetch_assoc($query_run)) {
                $arrayresult[] = $row;
            }

            header('Content-Type: application/json');
            echo json_encode($arrayresult);
        }
    } else {
        // Handle other categories or invalid category names
        // For example, set a default category or display an error message
        echo '<h4>No record found</h4>';
    }
}
