<?php
session_start();
require "../../../functions/connections.php";

if (isset($_POST['export'])) {
    $category_id = $_POST['category_id'];
    $municipality_filter = !empty($_POST['municipality_id']) ? "AND municipality.municipality_id IN (" . implode(',', explode(',', $_POST['municipality_id'])) . ")" : '';
    $terrain_filter = !empty($_POST['terrain_id']) ? "AND terrain.terrain_id IN (" . implode(',', explode(',', $_POST['terrain_id'])) . ")" : '';
    $brgy_filter = !empty($_POST['barangay_id']) ? "AND barangay_id.barangay_id IN (" . implode(',', explode(',', $_POST['barangay_id'])) . ")" : '';
    $status_filter = !empty($_POST['status_name']) ? "AND action IN ('" . implode("','", explode(',', $_POST['status_name'])) . "')" : '';

    // Get category_name
    $get_categoryName = "SELECT category_name FROM category WHERE category_id = $1";
    $query_run_categoryName = pg_query_params($conn, $get_categoryName, array($category_id));

    if ($query_run_categoryName) {
        $row_categoryName = pg_fetch_assoc($query_run_categoryName);
        $get_category_name = $row_categoryName['category_name'];
    } else {
        $_SESSION['message'] = "No category selected";
        header("location: ../../crop.php");
        exit();
    }

    // Build the query based on the category
    if ($get_category_name === 'Corn') {
        $query = "SELECT DISTINCT crop.*, crop_location.*, municipality.*, users.*, barangay.*, province.*, category_variety.*, terrain.*, category.*, utilization_cultural_importance.*, corn_traits.*, vegetative_state_corn.*, reproductive_state_corn.*, 
        ARRAY(SELECT DISTINCT corn_pest_resistance.pest_resistance_id FROM corn_pest_resistance WHERE corn_pest_resistance.corn_traits_id = corn_traits.corn_traits_id) AS pest_resistances,
        ARRAY(SELECT DISTINCT corn_disease_resistance.disease_resistance_id FROM corn_disease_resistance WHERE corn_disease_resistance.corn_traits_id = corn_traits.corn_traits_id) AS disease_resistances,
        ARRAY(SELECT DISTINCT corn_abiotic_resistance.abiotic_resistance_id FROM corn_abiotic_resistance WHERE corn_abiotic_resistance.corn_traits_id = corn_traits.corn_traits_id) AS abiotic_resistances,
        corn_pest_resistance_other.*, corn_abiotic_resistance_other.*, seed_traits.*, \"references\".*, \"status\".*
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
        LEFT JOIN vegetative_state_corn ON corn_traits.vegetative_state_corn_id = vegetative_state_corn.vegetative_state_corn_id
        LEFT JOIN reproductive_state_corn ON corn_traits.reproductive_state_corn_id = reproductive_state_corn.reproductive_state_corn_id
        LEFT JOIN corn_pest_resistance ON corn_traits.corn_traits_id = corn_pest_resistance.corn_traits_id
        LEFT JOIN corn_disease_resistance ON corn_traits.corn_traits_id = corn_disease_resistance.corn_traits_id
        LEFT JOIN corn_abiotic_resistance ON corn_traits.corn_traits_id = corn_abiotic_resistance.corn_traits_id
        LEFT JOIN corn_pest_resistance_other ON corn_pest_resistance_other.corn_pest_other_id = corn_traits.corn_pest_other_id
        LEFT JOIN corn_abiotic_resistance_other ON corn_abiotic_resistance_other.corn_abiotic_other_id = corn_traits.corn_abiotic_other_id
        LEFT JOIN seed_traits ON seed_traits.seed_traits_id = reproductive_state_corn.seed_traits_id
        LEFT JOIN \"references\" ON \"references\".crop_id = crop.crop_id
        LEFT JOIN \"status\" ON \"status\".status_id = crop.status_id
        WHERE 1=1 AND category.category_id = $1 $status_filter $municipality_filter $terrain_filter $brgy_filter";

        $query_run = pg_query_params($conn, $query, array($category_id));
    } else if ($get_category_name === 'Rice') {
        $query = "SELECT DISTINCT crop.*, crop_location.*, municipality.*, users.*, barangay.*, province.*, category_variety.*, terrain.*, category.*, utilization_cultural_importance.*, rice_traits.*, vegetative_state_rice.*, reproductive_state_rice.*,
        ARRAY(SELECT DISTINCT rice_pest_resistance.pest_resistance_id FROM rice_pest_resistance WHERE rice_pest_resistance.rice_traits_id = rice_traits.rice_traits_id) AS pest_resistances,
        ARRAY(SELECT DISTINCT rice_disease_resistance.disease_resistance_id FROM rice_disease_resistance WHERE rice_disease_resistance.rice_traits_id = rice_traits.rice_traits_id) AS disease_resistances,
        ARRAY(SELECT DISTINCT rice_abiotic_resistance.abiotic_resistance_id FROM rice_abiotic_resistance WHERE rice_abiotic_resistance.rice_traits_id = rice_traits.rice_traits_id) AS abiotic_resistances,
        rice_pest_resistance_other.*, rice_abiotic_resistance_other.*, seed_traits.*, \"references\".*, \"status\".*, panicle_traits_rice.*, flag_leaf_traits_rice.*, sensory_traits_rice.*
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
        LEFT JOIN rice_traits ON crop.crop_id = rice_traits.crop_id
        LEFT JOIN vegetative_state_rice ON rice_traits.vegetative_state_rice_id = vegetative_state_rice.vegetative_state_rice_id
        LEFT JOIN reproductive_state_rice ON rice_traits.reproductive_state_rice_id = reproductive_state_rice.reproductive_state_rice_id
        LEFT JOIN rice_pest_resistance ON rice_traits.rice_traits_id = rice_pest_resistance.rice_traits_id
        LEFT JOIN rice_disease_resistance ON rice_traits.rice_traits_id = rice_disease_resistance.rice_traits_id
        LEFT JOIN rice_abiotic_resistance ON rice_traits.rice_traits_id = rice_abiotic_resistance.rice_traits_id
        LEFT JOIN rice_pest_resistance_other ON rice_pest_resistance_other.rice_pest_other_id = rice_traits.rice_pest_other_id
        LEFT JOIN rice_abiotic_resistance_other ON rice_abiotic_resistance_other.rice_abiotic_other_id = rice_traits.rice_abiotic_other_id
        LEFT JOIN seed_traits ON seed_traits.seed_traits_id = reproductive_state_rice.seed_traits_id
        LEFT JOIN panicle_traits_rice ON panicle_traits_rice.panicle_traits_rice_id = reproductive_state_rice.panicle_traits_rice_id
        LEFT JOIN flag_leaf_traits_rice ON flag_leaf_traits_rice.flag_leaf_traits_rice_id = reproductive_state_rice.flag_leaf_traits_rice_id
        LEFT JOIN sensory_traits_rice ON sensory_traits_rice.sensory_traits_rice_id = rice_traits.sensory_traits_rice_id
        LEFT JOIN \"references\" ON \"references\".crop_id = crop.crop_id
        LEFT JOIN \"status\" ON \"status\".status_id = crop.status_id
        WHERE 1=1 AND category.category_id = $1 $status_filter $municipality_filter $terrain_filter $brgy_filter";

        $query_run = pg_query_params($conn, $query, array($category_id));
    } else if ($get_category_name === 'Root Crop') {
        $query = "SELECT DISTINCT crop.*, crop_location.*, municipality.*, users.*, barangay.*, province.*, category_variety.*, terrain.*, category.*, utilization_cultural_importance.*, root_crop_traits.*, vegetative_state_rootcrop.*, rootcrop_traits.*, 
        ARRAY(SELECT DISTINCT rootcrop_pest_resistance.pest_resistance_id FROM rootcrop_pest_resistance WHERE rootcrop_pest_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS pest_resistances,
        ARRAY(SELECT DISTINCT rootcrop_disease_resistance.disease_resistance_id FROM rootcrop_disease_resistance WHERE rootcrop_disease_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS disease_resistances,
        ARRAY(SELECT DISTINCT rootcrop_abiotic_resistance.abiotic_resistance_id FROM rootcrop_abiotic_resistance WHERE rootcrop_abiotic_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS abiotic_resistances,
        rootcrop_pest_resistance_other.*, rootcrop_abiotic_resistance_other.*, \"references\".*, \"status\".*
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
        LEFT JOIN root_crop_traits ON crop.crop_id = root_crop_traits.crop_id
        LEFT JOIN vegetative_state_rootcrop ON root_crop_traits.vegetative_state_rootcrop_id = vegetative_state_rootcrop.vegetative_state_rootcrop_id
        LEFT JOIN rootcrop_pest_resistance ON root_crop_traits.root_crop_traits_id = rootcrop_pest_resistance.root_crop_traits_id
        LEFT JOIN rootcrop_disease_resistance ON root_crop_traits.root_crop_traits_id = rootcrop_disease_resistance.root_crop_traits_id
        LEFT JOIN rootcrop_abiotic_resistance ON root_crop_traits.root_crop_traits_id = rootcrop_abiotic_resistance.root_crop_traits_id
        LEFT JOIN rootcrop_pest_resistance_other ON rootcrop_pest_resistance_other.rootcrop_pest_other_id = root_crop_traits.rootcrop_pest_other_id
        LEFT JOIN rootcrop_abiotic_resistance_other ON rootcrop_abiotic_resistance_other.rootcrop_abiotic_other_id = root_crop_traits.rootcrop_abiotic_other_id
        LEFT JOIN rootcrop_traits ON rootcrop_traits.rootcrop_traits_id = root_crop_traits.rootcrop_traits_id
        LEFT JOIN \"references\" ON \"references\".crop_id = crop.crop_id
        LEFT JOIN \"status\" ON \"status\".status_id = crop.status_id
        WHERE 1=1 AND category.category_id = $1 $status_filter $municipality_filter $terrain_filter $brgy_filter";

        $query_run = pg_query_params($conn, $query, array($category_id));
    }

    if (!$query_run) {
        die("Query failed: " . pg_last_error($conn));
    }

    // Convert to CSV format with headers
    $csv_data = '';
    $header_written = false;
    while ($row = pg_fetch_assoc($query_run)) {
        if (!$header_written) {
            $csv_data .= '"' . implode('","', array_keys($row)) . '"' . "\n";
            $header_written = true;
        }
        $csv_data .= '"' . implode('","', array_map('pg_escape_string', $row)) . '"' . "\n";
    }

    // Set headers for file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="exported_data.csv"');

    // Output CSV data
    echo $csv_data;

    // Close connection
    pg_close($conn);
}
