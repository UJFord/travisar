<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['click_draft_btn'])) {
    $crop_id = $_POST["crop_id"];
    $arrayresult = [];

    // Check if crop_id is not null or empty
    if (!empty($crop_id)) {
        $query = "SELECT * from crop
        LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id
        LEFT JOIN municipality ON crop_location.municipality_id = municipality.municipality_id
        LEFT JOIN users ON crop.user_id = users.user_id
        LEFT JOIN barangay ON crop_location.barangay_id = barangay.barangay_id
        LEFT JOIN province ON province.province_id = municipality.province_id
        LEFT JOIN category_variety ON crop.category_variety_id = category_variety.category_variety_id
        LEFT JOIN terrain ON terrain.terrain_id = crop.terrain_id
        LEFT JOIN category ON category.category_id = crop.category_id
        LEFT JOIN utilization_cultural_importance ON crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
        left join \"status\" ON status.status_id = crop.status_id
        where crop.crop_id = $1";
        $query_run = pg_query_params($conn, $query, array($crop_id));

        if ($rowDraft = pg_fetch_assoc($query_run)) {
            $category_name = $rowDraft['category_name'];
            $arrayresult[] = $rowDraft;

            $additional_query = "";
            switch ($category_name) {
                case 'Corn':
                    $additional_query = "SELECT DIStinct crop.*, corn_traits.*, reproductive_state_corn.*, vegetative_state_corn.*, corn_pest_resistance_other.*, corn_abiotic_resistance_other.*, seed_traits.*,
                    ARRAY(SELECT DISTINCT corn_pest_resistance.pest_resistance_id FROM corn_pest_resistance WHERE corn_pest_resistance.corn_traits_id = corn_traits.corn_traits_id) AS pest_resistances,
                    ARRAY(SELECT DISTINCT corn_disease_resistance.disease_resistance_id FROM corn_disease_resistance WHERE corn_disease_resistance.corn_traits_id = corn_traits.corn_traits_id) AS disease_resistances,
                    ARRAY(SELECT DISTINCT corn_abiotic_resistance.abiotic_resistance_id FROM corn_abiotic_resistance WHERE corn_abiotic_resistance.corn_traits_id = corn_traits.corn_traits_id) AS abiotic_resistances
                    from crop
                    left join corn_traits on crop.crop_id = corn_traits.crop_id left join vegetative_state_corn on corn_traits.vegetative_state_corn_id = vegetative_state_corn.vegetative_state_corn_id
                    left join reproductive_state_corn on corn_traits.reproductive_state_corn_id = reproductive_state_corn.reproductive_state_corn_id
                    left join corn_pest_resistance on corn_pest_resistance.corn_traits_id = corn_traits.corn_traits_id
                    left join corn_disease_resistance on corn_disease_resistance.corn_traits_id = corn_traits.corn_traits_id
                    left join corn_abiotic_resistance on corn_abiotic_resistance.corn_traits_id = corn_traits.corn_traits_id
                    left join corn_pest_resistance_other on corn_pest_resistance_other.corn_pest_other_id = corn_traits.corn_pest_other_id
                    left join corn_abiotic_resistance_other on corn_abiotic_resistance_other.corn_abiotic_other_id = corn_traits.corn_abiotic_other_id
                    left join seed_traits on seed_traits.seed_traits_id = reproductive_state_corn.seed_traits_id
                    WHERE crop.crop_id = $1";
                    break;
                case 'Rice':
                    $additional_query = "SELECT DISTINCT crop.*, rice_traits.*, vegetative_state_rice.*, reproductive_state_rice.*,
                    ARRAY(SELECT DISTINCT rice_pest_resistance.pest_resistance_id FROM rice_pest_resistance WHERE rice_pest_resistance.rice_traits_id = rice_traits.rice_traits_id) AS pest_resistances,
                    ARRAY(SELECT DISTINCT rice_disease_resistance.disease_resistance_id FROM rice_disease_resistance WHERE rice_disease_resistance.rice_traits_id = rice_traits.rice_traits_id) AS disease_resistances,
                    ARRAY(SELECT DISTINCT rice_abiotic_resistance.abiotic_resistance_id FROM rice_abiotic_resistance WHERE rice_abiotic_resistance.rice_traits_id = rice_traits.rice_traits_id) AS abiotic_resistances,
                    rice_pest_resistance_other.*, rice_abiotic_resistance_other.*, seed_traits.*, panicle_traits_rice.*, flag_leaf_traits_rice.*, sensory_traits_rice.*
                    FROM crop 
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
                    WHERE crop.crop_id = $1";
                    break;
                case 'Root Crop':
                    $additional_query = "SELECT DISTINCT crop.*, root_crop_traits.*, vegetative_state_rootcrop.*, rootcrop_traits.*, 
                    ARRAY(SELECT DISTINCT rootcrop_pest_resistance.pest_resistance_id FROM rootcrop_pest_resistance WHERE rootcrop_pest_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS pest_resistances,
                    ARRAY(SELECT DISTINCT rootcrop_disease_resistance.disease_resistance_id FROM rootcrop_disease_resistance WHERE rootcrop_disease_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS disease_resistances,
                    ARRAY(SELECT DISTINCT rootcrop_abiotic_resistance.abiotic_resistance_id FROM rootcrop_abiotic_resistance WHERE rootcrop_abiotic_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS abiotic_resistances,
                    rootcrop_pest_resistance_other.*, rootcrop_abiotic_resistance_other.*
                    from crop
                    left join root_crop_traits on crop.crop_id = root_crop_traits.crop_id left join vegetative_state_rootcrop on root_crop_traits.vegetative_state_rootcrop_id = vegetative_state_rootcrop.vegetative_state_rootcrop_id
                    left join rootcrop_pest_resistance on root_crop_traits.root_crop_traits_id = rootcrop_pest_resistance.root_crop_traits_id left join pest_resistance on pest_resistance.pest_resistance_id = rootcrop_pest_resistance.pest_resistance_id
                    left join rootcrop_disease_resistance on root_crop_traits.root_crop_traits_id = rootcrop_disease_resistance.root_crop_traits_id left join disease_resistance on disease_resistance.disease_resistance_id = rootcrop_disease_resistance.disease_resistance_id
                    left join rootcrop_abiotic_resistance on root_crop_traits.root_crop_traits_id = rootcrop_abiotic_resistance.root_crop_traits_id left join abiotic_resistance on abiotic_resistance.abiotic_resistance_id = rootcrop_abiotic_resistance.abiotic_resistance_id
                    left join rootcrop_pest_resistance_other on rootcrop_pest_resistance_other.rootcrop_pest_other_id = root_crop_traits.rootcrop_pest_other_id
                    left join rootcrop_abiotic_resistance_other on rootcrop_abiotic_resistance_other.rootcrop_abiotic_other_id = root_crop_traits.rootcrop_abiotic_other_id
                    left join rootcrop_traits on rootcrop_traits.rootcrop_traits_id = root_crop_traits.rootcrop_traits_id
                    WHERE crop.crop_id = $1";
                    break;
            }

            if (!empty($additional_query)) {
                $query_run_additional = pg_query_params($conn, $additional_query, array($crop_id));

                while ($row = pg_fetch_assoc($query_run_additional)) {
                    $arrayresult[] = $row;
                }
            }

            // Send the JSON response with the combined result
            header('Content-Type: application/json');
            echo json_encode($arrayresult);
        } else {
            // No data found for the main query, return an empty response
            http_response_code(204); // No Content
            exit();
        }
    } else {
        // Invalid crop_id, return an empty response
        http_response_code(204); // No Content
        exit();
    }
}
