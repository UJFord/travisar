<?php
session_start();
require "../../functions/connections.php";

// Ensure POST request contains the expected action
if (isset($_POST['action']) && $_POST['action'] == 'approve') {
    $crop_id = $_POST['crop_id'];
    $crop_variety = $_POST['crop_variety'];

    // Update the status
    $update_query = "
        UPDATE status
        SET action = 'Approved', status_date = CURRENT_TIMESTAMP
        WHERE status_id IN (SELECT status_id FROM crop WHERE crop_id = $1)
    ";
    $result = pg_query_params($conn, $update_query, array($crop_id));

    if ($result) {
        // Prepare notification details
        $notification_name = 'Submission approved.';
        $message = 'Your submission ' . $crop_variety . ' is approved.';
        $active = '1';

        // Insert notification
        $insert_query = "
            INSERT INTO notification (notification_name, message, active, crop_id)
            VALUES ($1, $2, $3, $4)
        ";
        $insert_run = pg_query_params($conn, $insert_query, array($notification_name, $message, $active, $crop_id));

        if ($insert_run) {
            $_SESSION['message'] = "Submission Approved";
            //header("Location: pending.php");
            exit; // Ensure that the script stops executing after the redirect header
        } else {
            // Log the error or display a more user-friendly message
            echo "Error inserting notification: " . pg_last_error($conn);
        }
    } else {
        // Log the error or display a more user-friendly message
        echo "Error updating status: " . pg_last_error($conn);
    }
}

// var_dump($_POST);
// die();
if (isset($_POST['action']) && $_POST['action'] == 'update') {
$crop_idUpdate = $_POST['crop_id'];

// get category name
$get_name = "SELECT category_name FROM crop left join category on crop.category_id = category.category_id where crop.crop_id = $1";
$query_run = pg_query_params($conn, $get_name, array($crop_idUpdate));

if ($query_run) {
$row_categoryName = pg_fetch_assoc(($query_run));
$get_category_name = $row_categoryName['category_name'];
} else {
$_SESSION['message'] = "No category available, incomplete data";
//header("location: pending.php");
exit();
}

// Start a database transaction
pg_query($conn, "BEGIN");
try {
if ($get_category_name === 'Corn') {
// Fetch data from the crop table and join with crop_location
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
left join \"status\" on \"status\".status_id = crop.status_id
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
$province_id = $crops['province_id'];
$municipality_id = $crops['municipality_id'];
$coordinates = $crops['coordinates'];
$barangay_id = $crops['barangay_id'];
$sitio_name = $crops['sitio_name'];

// resistances
$pest_resistances = $crops['pest_resistances'];
$disease_resistances = $crops['disease_resistances'];
$abiotic_resistances = $crops['abiotic_resistances'];

// pest resistance other
$pest_other = $crops['corn_pest_other'];
$pest_other_desc = $crops['corn_pest_other_desc'];

// abiotic resistance other
$abiotic_other = $crops['corn_abiotic_other'];
$abiotic_other_desc = $crops['corn_abiotic_other_desc'];

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

//id's to be deleted when finished updating
$update_crop_id = $crops['crop_id'];
$update_status_id = $crops['status_id'];
$update_corn_traits_id = $crops['corn_traits_id'];
$update_crop_location_id = $crops['crop_location_id'];
$update_seed_traits_id = $crops['seed_traits_id'];
$update_utilization_cultural_id = $crops['utilization_cultural_id'];
$update_vegetative_state_corn_id = $crops['vegetative_state_corn_id'];
$update_reproductive_state_corn_id = $crops['reproductive_state_corn_id'];
$update_corn_pest_other_id = $crops['corn_pest_other_id'];
$update_corn_abiotic_other_id = $crops['corn_abiotic_other_id'];

// get the unique code the remove the updating
$currentUniqueCode = $crops['unique_code'];
$updateUniqueCode = str_replace("-UPDATING", "", $currentUniqueCode);

// get the crop that should be updated
$query_Crop = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join municipality
on crop_location.municipality_id = municipality.municipality_id left join barangay on crop_location.barangay_id = barangay.barangay_id
left join utilization_cultural_importance on crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id left join category on crop.category_id = category.category_id
left join corn_traits on crop.crop_id = corn_traits.crop_id left join reproductive_state_corn on corn_traits.reproductive_state_corn_id = reproductive_state_corn.reproductive_state_corn_id
left join corn_pest_resistance_other on corn_pest_resistance_other.corn_pest_other_id = corn_traits.corn_pest_other_id
left join corn_abiotic_resistance_other on corn_abiotic_resistance_other.corn_abiotic_other_id = corn_traits.corn_abiotic_other_id
left join status on status.status_id = crop.status_id
WHERE crop.unique_code = $1";

$query_runCrop = pg_query_params($conn, $query_Crop, array($updateUniqueCode));
if (pg_num_rows($query_runCrop) > 0) {
$cropsUpdate = pg_fetch_assoc($query_runCrop);

//id's of the crop that needs to be updated
$crop_id = $cropsUpdate['crop_id'];
$corn_traits_id = $cropsUpdate['corn_traits_id'];
$category_id = $cropsUpdate['category_id'];
$crop_location_id = $cropsUpdate['crop_location_id'];
$seed_traits_id = $cropsUpdate['seed_traits_id'];
$utilization_cultural_id = $cropsUpdate['utilization_cultural_id'];
$vegetative_state_corn_id = $cropsUpdate['vegetative_state_corn_id'];
$reproductive_state_corn_id = $cropsUpdate['reproductive_state_corn_id'];
$corn_abiotic_other_id = $cropsUpdate['corn_abiotic_other_id'];
$corn_pest_other_id = $cropsUpdate['corn_pest_other_id'];
$status_id = $cropsUpdate['status_id'];
$action = "Approved";

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
crop_seed_image = $4, crop_vegetative_image =$5, crop_reproductive_image = $6 where crop_id = $7";

$valueCrops = array(
$crop_variety, $crop_description, $meaning_of_name, $crop_seed_image, $crop_vegetative_image, $crop_reproductive_image, $crop_id
);
$query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

if ($query_run_Crop) {
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// update Status table
$queryStatus = "UPDATE status set action =$1, status_date = CURRENT_TIMESTAMP where status_id = $2";

$valueStatus = array(
$action, $status_id
);
$query_run_Status = pg_query_params($conn, $queryStatus, $valueStatus);

if ($query_run_Status) {
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// update Crop Location Table
$query_CropLoc = "UPDATE crop_location set municipality_id = $1, barangay_id = $2, coordinates = $3, sitio_name = $4 where crop_location_id = $5";
$query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($municipality_id, $barangay_id, $coordinates, $sitio_name, $crop_location_id));

if ($query_run_CropLoc) {
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// Handle corn category traits
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

// check if the corn pest other resistance is null or not
$query_getPest = "SELECT corn_pest_other_id FROM crop LEFT JOIN corn_traits ON corn_traits.crop_id = crop.crop_id WHERE crop.crop_id = $1";
$query_run_getPest = pg_query_params($conn, $query_getPest, array($crop_id));

// Check if the query returned any rows
if (pg_num_rows($query_run_getPest) > 0) {
$row_getPest = pg_fetch_row($query_run_getPest);
$corn_pest_other_id = $row_getPest[0];

// if the corn_pest_other_id is null or empty save it
if ($corn_pest_other_id === null || $corn_pest_other_id === "") {

// Insert data into the respective tables
if ($pest_other) {

// Insert into corn_pest_other table
$queryPest_other = "INSERT INTO corn_pest_resistance_other (corn_pest_other, corn_pest_other_desc) VALUES ($1, $2) RETURNING corn_pest_other_id";
$query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
if ($query_run_Pest_other) {
$rowPest_other = pg_fetch_row($query_run_Pest_other);
$corn_pest_other_id = $rowPest_other[0];

// Insert into crop table
$query_cropInsert = "UPDATE corn_traits SET corn_pest_other_id = $1 WHERE corn_traits_id = $2";
$query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($corn_pest_other_id, $corn_traits_id));
if ($query_run_cropInsert) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
} else {
// if it exists just update its data
// pest resistance other corn
$query_pestOther = "UPDATE corn_pest_resistance_other SET corn_pest_other = $1, corn_pest_other_desc = $2 WHERE corn_pest_other_id = $3";
$query_run_pestOther = pg_query_params($conn, $query_pestOther, array($pest_other, $pest_other_desc, $corn_pest_other_id));
if ($query_run_pestOther) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}

// check if the corn abiotic other resistance is null or not
$query_getAbiotic = "SELECT corn_abiotic_other_id from crop left join corn_traits on corn_traits.crop_id = crop.crop_id where crop.crop_id = $1";
$query_run_getAbiotic = pg_query_params($conn, $query_getAbiotic, array($crop_id));

if ($query_run_getAbiotic) {
if (pg_num_rows($query_run_getAbiotic) > 0) {
$row_getAbiotic = pg_fetch_row($query_run_getAbiotic);
$corn_abiotic_other_id = $row_getAbiotic[0];

// if the corn_abiotic_other_id is null or empty save it
if ($corn_abiotic_other_id === null || $corn_abiotic_other_id === "") {
// Insert data into the respective tables
if ($abiotic_other) {
// Insert into corn_Abiotic_other table
$queryAbiotic_other = "INSERT INTO corn_abiotic_resistance_other (corn_abiotic_other, corn_abiotic_other_desc) VALUES ($1, $2) returning corn_abiotic_other_id";
$query_run_Abiotic_other = pg_query_params($conn, $queryAbiotic_other, array($abiotic_other, $abiotic_other_desc));
if ($query_run_Abiotic_other) {
$rowAbiotic_other = pg_fetch_row($query_run_Abiotic_other);
$corn_abiotic_other_id = $rowAbiotic_other[0];

// Insert into crop table
$query_cropInsert = "UPDATE corn_traits set corn_abiotic_other_id = $1 where corn_traits_id = $2";
$query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($corn_abiotic_other_id, $corn_traits_id));
if ($query_run_cropInsert) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
} else {
// if it exists just update its data
// pest resistance other corn
$query_abioticOther = "UPDATE corn_abiotic_resistance_other set corn_abiotic_other = $1, corn_abiotic_other_desc = $2 WHERE corn_abiotic_other_id = $3";
$query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc, $corn_abiotic_other_id));
if ($query_run_abioticOther) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
}

// Update the pest resistance
if (isset($pest_resistances)) {
// Delete existing pest resistances for the variety
$query_delete_pest = "DELETE FROM corn_pest_resistance WHERE corn_traits_id = $1";
$query_run_delete_pest = pg_query_params($conn, $query_delete_pest, array($corn_traits_id));

// Split the string into an array of integers
$pest_resistances_arr = explode(',', substr($pest_resistances, 1, -1));

// Loop through the submitted pest resistance IDs
foreach ($pest_resistances_arr as $pest_id) {
if (!empty($pest_id) && ctype_digit($pest_id)) {
$corn_is_checked_pest = true; // Set to true since it's a boolean value

// Insert the record into the database
$query_pest = "INSERT INTO corn_pest_resistance (corn_traits_id, pest_resistance_id, corn_is_checked_pest) VALUES ($1, $2, $3)";
$query_run_pest = pg_query_params($conn, $query_pest, array($corn_traits_id, $pest_id, $corn_is_checked_pest));
if (!$query_run_pest) {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
}

// Update the disease resistance
if (isset($disease_resistances)) {
// Delete existing disease resistances for the variety
$query_delete_disease = "DELETE FROM corn_disease_resistance WHERE corn_traits_id = $1";
$query_run_delete_disease = pg_query_params($conn, $query_delete_disease, array($corn_traits_id));

// Split the string into an array of integers
$disease_resistances_arr = explode(',', substr($disease_resistances, 1, -1));

// Loop through the submitted disease resistance IDs
foreach ($disease_resistances_arr as $disease_id) {
if (!empty($disease_id) && ctype_digit($disease_id)) {
$corn_is_checked_disease = true; // Set to true since it's a boolean value

// Insert the record into the database
$query_disease = "INSERT INTO corn_disease_resistance (corn_traits_id, disease_resistance_id, corn_is_checked_disease) VALUES ($1, $2, $3)";
$query_run_disease = pg_query_params($conn, $query_disease, array($corn_traits_id, $disease_id, $corn_is_checked_disease));
if (!$query_run_disease) {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
}

// Update the abiotic resistance
if (isset($abiotic_resistances)) {
// Delete existing abiotic resistances for the variety
$query_delete_abiotic = "DELETE FROM corn_abiotic_resistance WHERE corn_traits_id = $1";
$query_run_delete_abiotic = pg_query_params($conn, $query_delete_abiotic, array($corn_traits_id));

// Split the string into an array of integers
$abiotic_resistances_arr = explode(',', substr($abiotic_resistances, 1, -1));

// Loop through the submitted abiotic resistance IDs
foreach ($abiotic_resistances_arr as $abiotic_id) {
if (!empty($abiotic_id) && ctype_digit($abiotic_id)) {
$corn_is_checked_abiotic = true; // Set to true since it's a boolean value

// Insert the record into the database
$query_abiotic = "INSERT INTO corn_abiotic_resistance (corn_traits_id, abiotic_resistance_id, corn_is_checked_abiotic) VALUES ($1, $2, $3)";
$query_run_abiotic = pg_query_params($conn, $query_abiotic, array($corn_traits_id, $abiotic_id, $corn_is_checked_abiotic));
if (!$query_run_abiotic) {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
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

// Delete from Disease Resistance table
$query_delete_disease_res = "DELETE FROM corn_disease_resistance WHERE corn_traits_id = $1";
$query_run_delete_disease_res = pg_query_params($conn, $query_delete_disease_res, [$update_corn_traits_id]);

if (!$query_run_delete_disease_res) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from Abiotic Resistance table
$query_delete_abiotic_res = "DELETE FROM corn_abiotic_resistance WHERE corn_traits_id = $1";
$query_run_delete_abiotic_res = pg_query_params($conn, $query_delete_abiotic_res, [$update_corn_traits_id]);

if (!$query_run_delete_abiotic_res) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from Pest Resistance_corn table
$query_delete_pest_res = "DELETE FROM corn_pest_resistance WHERE corn_traits_id = $1";
$query_run_delete_pest_res = pg_query_params($conn, $query_delete_pest_res, [$update_corn_traits_id]);

if (!$query_run_delete_pest_res) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from pest other resistance table
$query_delete_pestOther = "DELETE FROM corn_pest_resistance_other WHERE corn_pest_other_id = $1";
$query_run_delete_pestOther = pg_query_params($conn, $query_delete_pestOther, [$update_corn_pest_other_id]);

if (!$query_run_delete_pestOther) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from abiotic other resistance table
$query_delete_abioticOther = "DELETE FROM corn_abiotic_resistance_other WHERE corn_abiotic_other_id = $1";
$query_run_delete_abioticOther = pg_query_params($conn, $query_delete_abioticOther, [$update_corn_abiotic_other_id]);

if (!$query_run_delete_abioticOther) {
echo "Error: " . pg_last_error($conn);
die();
}
}
} else if ($get_category_name === 'Rice') {
// Fetch the updated data of the crop
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
left join category on category.category_id = crop.category_id left join utilization_cultural_importance on crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
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
$province_id = $crops['province_id'];
$municipality_id = $crops['municipality_id'];
$coordinates = $crops['coordinates'];
$barangay_id = $crops['barangay_id'];
$sitio_name = $crops['sitio_name'];

// resistances
$pest_resistances = $crops['pest_resistances'];
$disease_resistances = $crops['disease_resistances'];
$abiotic_resistances = $crops['abiotic_resistances'];

// abiotic other
$abiotic_other = $crops['rice_abiotic_other'];
$abiotic_other_desc = $crops['rice_abiotic_other_desc'];

//pest other
$pest_other = $crops['rice_pest_other'];
$pest_other_desc = $crops['rice_pest_other_desc'];

// Utilization Cultural Importance
$significance = $crops['significance'];
$use = $crops['use'];
$indigenous_utilization = $crops['indigenous_utilization'];
$remarkable_features = $crops['remarkable_features'];

// seed traits rice
$seed_length = $crops['seed_length'];
$seed_width = $crops['seed_width'];
$seed_shape = $crops['seed_shape'];
$seed_color = $crops['seed_color'];

//* morphological Traits rice
// Vegetative state rice
$rice_plant_height = $crops['rice_plant_height'];
$rice_leaf_width = $crops['rice_leaf_width'];
$rice_leaf_length = $crops['rice_leaf_length'];
$rice_tillering_ability = $crops['rice_tillering_ability'];
$rice_maturity_time = $crops['rice_maturity_time'];

// Reproductive state rice
$rice_yield_capacity = $crops['rice_yield_capacity'];

// panicle traits rice
$panicle_length = $crops['panicle_length'];
$panicle_width = $crops['panicle_width'];
$panicle_enclosed_by = $crops['panicle_enclosed_by'];
$panicle_remarkable_features = $crops['panicle_remarkable_features'];

// flag leaf traits rice
$flag_length = $crops['flag_length'];
$flag_width = $crops['flag_width'];
$pubescence = $crops['pubescence'];
$purplish_stripes = $crops['purplish_stripes'];
$flag_remarkable_features = $crops['flag_remarkable_features'];

// sensory traits rice
$aroma = $crops['aroma'];
$quality_cooked_rice = $crops['quality_cooked_rice'];
$quality_leftover_rice = $crops['quality_leftover_rice'];
$volume_expansion = $crops['volume_expansion'];
$glutinous = $crops['glutinous'];
$texture = $crops['texture'];

//id's to be deleted when finished updating
$update_crop_id = $crops['crop_id'];
$update_status_id = $crops['status_id'];
$update_rice_traits_id = $crops['rice_traits_id'];
$update_crop_location_id = $crops['crop_location_id'];
$update_seed_traits_id = $crops['seed_traits_id'];
$update_panicle_traits_rice_id = $crops['panicle_traits_rice_id'];
$update_flag_leaf_traits_rice_id = $crops['flag_leaf_traits_rice_id'];
$update_utilization_cultural_id = $crops['utilization_cultural_id'];
$update_vegetative_state_rice_id = $crops['vegetative_state_rice_id'];
$update_reproductive_state_rice_id = $crops['reproductive_state_rice_id'];
$update_sensory_traits_rice_id = $crops['sensory_traits_rice_id'];
$update_rice_pest_other_id = $crops['rice_pest_other_id'];
$update_rice_abiotic_other_id = $crops['rice_abiotic_other_id'];

// get the unique code the remove the updating
$currentUniqueCode = $crops['unique_code'];
$updateUniqueCode = str_replace("-UPDATING", "", $currentUniqueCode);

// get the crop that should be updated
$query_Crop = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join municipality
on crop_location.municipality_id = municipality.municipality_id left join barangay on crop_location.barangay_id = barangay.barangay_id
left join utilization_cultural_importance on crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id left join category on crop.category_id = category.category_id
left join rice_traits on crop.crop_id = rice_traits.crop_id left join reproductive_state_rice on rice_traits.reproductive_state_rice_id = reproductive_state_rice.reproductive_state_rice_id
left join rice_pest_resistance_other on rice_pest_resistance_other.rice_pest_other_id = rice_traits.rice_pest_other_id
left join rice_abiotic_resistance_other on rice_abiotic_resistance_other.rice_abiotic_other_id = rice_traits.rice_abiotic_other_id
left join status on status.status_id = crop.status_id
WHERE crop.unique_code = $1";

$query_runCrop = pg_query_params($conn, $query_Crop, array($updateUniqueCode));
if (pg_num_rows($query_runCrop) > 0) {
$cropsUpdate = pg_fetch_assoc($query_runCrop);

//id's of the crop that needs to be updated
$crop_id = $cropsUpdate['crop_id'];
$rice_traits_id = $cropsUpdate['rice_traits_id'];
$category_id = $cropsUpdate['category_id'];
$crop_location_id = $cropsUpdate['crop_location_id'];
$seed_traits_id = $cropsUpdate['seed_traits_id'];
$utilization_cultural_id = $cropsUpdate['utilization_cultural_id'];
$vegetative_state_rice_id = $cropsUpdate['vegetative_state_rice_id'];
$reproductive_state_rice_id = $cropsUpdate['reproductive_state_rice_id'];
$panicle_traits_rice_id = $cropsUpdate['panicle_traits_rice_id'];
$flag_leaf_traits_rice_id = $cropsUpdate['flag_leaf_traits_rice_id'];
$sensory_traits_rice_id = $cropsUpdate['sensory_traits_rice_id'];
$rice_abiotic_other_id = $cropsUpdate['rice_abiotic_other_id'];
$rice_pest_other_id = $cropsUpdate['rice_pest_other_id'];

$status_id = $cropsUpdate['status_id'];
$action = "Approved";

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
crop_seed_image = $4, crop_vegetative_image =$5, crop_reproductive_image = $6 where crop_id = $7";

$valueCrops = array(
$crop_variety, $crop_description, $meaning_of_name, $crop_seed_image, $crop_vegetative_image, $crop_reproductive_image, $crop_id
);
$query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

if ($query_run_Crop) {
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// update Status table
$queryStatus = "UPDATE status set action =$1, status_date = CURRENT_TIMESTAMP where status_id = $2";

$valueStatus = array(
$action, $status_id
);
$query_run_Status = pg_query_params($conn, $queryStatus, $valueStatus);

if ($query_run_Status) {
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// update Crop Location Table
$query_CropLoc = "UPDATE crop_location set municipality_id = $1, barangay_id = $2, coordinates = $3, sitio_name = $4 where crop_location_id = $5";
$query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($municipality_id, $barangay_id, $coordinates, $sitio_name, $crop_location_id));

if ($query_run_CropLoc) {
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// Handle rice category traits
// seed traits
$query_seedTraits = "UPDATE seed_traits set seed_length = $1, seed_width = $2, seed_shape = $3, seed_color = $4 where seed_traits_id = $5";
$query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color, $seed_traits_id));
if ($query_run_seedTraits) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// reproductive state rice
$query_reproductiveState = "UPDATE reproductive_state_rice set rice_yield_capacity = $1 where reproductive_state_rice_id = $2";
$query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($rice_yield_capacity, $reproductive_state_rice_id));
if ($query_run_reproductiveState) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// panicle_traits rice
$query_panicleTraits = "UPDATE panicle_traits_rice set panicle_length = $1, panicle_width = $2, panicle_enclosed_by = $3, panicle_remarkable_features = $4 where panicle_traits_rice_id = $5";
$query_run_panicleTraits = pg_query_params($conn, $query_panicleTraits, array($panicle_length, $panicle_width, $panicle_enclosed_by, $panicle_remarkable_features, $panicle_traits_rice_id));
if ($query_run_panicleTraits) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// flag_leaf_traits rice
$query_flagLeaf = "UPDATE flag_leaf_traits_rice set flag_length = $1, flag_width = $2, purplish_stripes = $3, pubescence = $4, flag_remarkable_features = $5 where flag_leaf_traits_rice_id = $6";
$query_run_flagLeaf = pg_query_params($conn, $query_flagLeaf, array($flag_length, $flag_width, $purplish_stripes, $pubescence, $flag_remarkable_features, $flag_leaf_traits_rice_id));
if ($query_run_flagLeaf) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// sensory_traits rice
$query_sensoryTraits = "UPDATE sensory_traits_rice set aroma = $1, quality_cooked_rice = $2, quality_leftover_rice = $3, volume_expansion = $4, glutinous = $5, texture = $6 where sensory_traits_rice_id = $7";
$query_run_sensoryTraits = pg_query_params($conn, $query_sensoryTraits, array($aroma, $quality_cooked_rice, $quality_leftover_rice, $volume_expansion, $glutinous, $texture, $sensory_traits_rice_id));
if ($query_run_sensoryTraits) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// vegetative state rice
$query_vegetativeState = "UPDATE vegetative_state_rice set rice_plant_height = $1, rice_leaf_width = $2, rice_leaf_length = $3, rice_tillering_ability = $4, rice_maturity_time = $5 WHERE vegetative_state_rice_id = $6";
$query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rice_plant_height, $rice_leaf_width, $rice_leaf_length, $rice_tillering_ability, $rice_maturity_time, $vegetative_state_rice_id));
if ($query_run_vegetativeState) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
// check if the rice pest other resistance is null or not
$query_getPest = "SELECT rice_pest_other_id FROM crop LEFT JOIN rice_traits ON rice_traits.crop_id = crop.crop_id WHERE crop.crop_id = $1";
$query_run_getPest = pg_query_params($conn, $query_getPest, array($crop_id));

// Check if the query returned any rows
if (pg_num_rows($query_run_getPest) > 0) {
$row_getPest = pg_fetch_row($query_run_getPest);
$rice_pest_other_id = $row_getPest[0];

// if the rice_pest_other_id is null or empty save it
if ($rice_pest_other_id === null || $rice_pest_other_id === "") {

// Insert data into the respective tables
if ($pest_other) {
// Insert into rice_pest_other table
$queryPest_other = "INSERT INTO rice_pest_resistance_other (rice_pest_other, rice_pest_other_desc) VALUES ($1, $2) RETURNING rice_pest_other_id";
$query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
if ($query_run_Pest_other) {
$rowPest_other = pg_fetch_row($query_run_Pest_other);
$rice_pest_other_id = $rowPest_other[0];

// Insert into crop table
$query_cropInsert = "UPDATE rice_traits SET rice_pest_other_id = $1 WHERE rice_traits_id = $2";
$query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rice_pest_other_id, $rice_traits_id));
if ($query_run_cropInsert) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
} else {
// if it exists just update its data
// pest resistance other rice
$query_pestOther = "UPDATE rice_pest_resistance_other SET rice_pest_other = $1, rice_pest_other_desc = $2 WHERE rice_pest_other_id = $3";
$query_run_pestOther = pg_query_params($conn, $query_pestOther, array($pest_other, $pest_other_desc, $rice_pest_other_id));
if ($query_run_pestOther) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}

// check if the rice abiotic other resistance is null or not
$query_getAbiotic = "SELECT rice_abiotic_other_id from crop left join rice_traits on rice_traits.crop_id = crop.crop_id where crop.crop_id = $1";
$query_run_getAbiotic = pg_query_params($conn, $query_getAbiotic, array($crop_id));

if ($query_run_getAbiotic) {
if (pg_num_rows($query_run_getAbiotic) > 0) {
$row_getAbiotic = pg_fetch_row($query_run_getAbiotic);
$rice_abiotic_other_id = $row_getAbiotic[0];

// if the rice_abiotic_other_id is null or empty save it
if ($rice_abiotic_other_id === null || $rice_abiotic_other_id === "") {
// Insert data into the respective tables
if ($abiotic_other) {
// Insert into rice_Abiotic_other table
$queryAbiotic_other = "INSERT INTO rice_abiotic_resistance_other (rice_abiotic_other, rice_abiotic_other_desc) VALUES ($1, $2) returning rice_abiotic_other_id";
$query_run_Abiotic_other = pg_query_params($conn, $queryAbiotic_other, array($abiotic_other, $abiotic_other_desc));
if ($query_run_Abiotic_other) {
$rowAbiotic_other = pg_fetch_row($query_run_Abiotic_other);
$rice_abiotic_other_id = $rowAbiotic_other[0];

// Insert into crop table
$query_cropInsert = "UPDATE rice_traits set rice_abiotic_other_id = $1 where rice_traits_id = $2";
$query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rice_abiotic_other_id, $rice_traits_id));
if ($query_run_cropInsert) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
} else {
// if it exists just update its data
// pest resistance other rice
$query_abioticOther = "UPDATE rice_abiotic_resistance_other set rice_abiotic_other = $1, rice_abiotic_other_desc = $2 WHERE rice_abiotic_other_id = $3";
$query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc, $rice_abiotic_other_id));
if ($query_run_abioticOther) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
}

// Update the pest resistance
if (isset($pest_resistances)) {
// Delete existing pest resistances for the variety
$query_delete_pest = "DELETE FROM rice_pest_resistance WHERE rice_traits_id = $1";
$query_run_delete_pest = pg_query_params($conn, $query_delete_pest, array($rice_traits_id));

// Split the string into an array of integers
$pest_resistances_arr = explode(',', substr($pest_resistances, 1, -1));

// Loop through the submitted pest resistance IDs
foreach ($pest_resistances_arr as $pest_id) {
if (!empty($pest_id) && ctype_digit($pest_id)) {
$rice_is_checked_pest = true; // Set to true since it's a boolean value

// Insert the record into the database
$query_pest = "INSERT INTO rice_pest_resistance (rice_traits_id, pest_resistance_id, rice_is_checked_pest) VALUES ($1, $2, $3)";
$query_run_pest = pg_query_params($conn, $query_pest, array($rice_traits_id, $pest_id, $rice_is_checked_pest));
if (!$query_run_pest) {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
}

// Update the disease resistance
if (isset($disease_resistances)) {
// Delete existing disease resistances for the variety
$query_delete_disease = "DELETE FROM rice_disease_resistance WHERE rice_traits_id = $1";
$query_run_delete_disease = pg_query_params($conn, $query_delete_disease, array($rice_traits_id));

// Split the string into an array of integers
$disease_resistances_arr = explode(',', substr($disease_resistances, 1, -1));

// Loop through the submitted disease resistance IDs
foreach ($disease_resistances_arr as $disease_id) {
if (!empty($disease_id) && ctype_digit($disease_id)) {
$rice_is_checked_disease = true; // Set to true since it's a boolean value

// Insert the record into the database
$query_disease = "INSERT INTO rice_disease_resistance (rice_traits_id, disease_resistance_id, rice_is_checked_disease) VALUES ($1, $2, $3)";
$query_run_disease = pg_query_params($conn, $query_disease, array($rice_traits_id, $disease_id, $rice_is_checked_disease));
if (!$query_run_disease) {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
}

// Update the abiotic resistance
if (isset($abiotic_resistances)) {
// Delete existing abiotic resistances for the variety
$query_delete_abiotic = "DELETE FROM rice_abiotic_resistance WHERE rice_traits_id = $1";
$query_run_delete_abiotic = pg_query_params($conn, $query_delete_abiotic, array($rice_traits_id));

// Split the string into an array of integers
$abiotic_resistances_arr = explode(',', substr($abiotic_resistances, 1, -1));

// Loop through the submitted abiotic resistance IDs
foreach ($abiotic_resistances_arr as $abiotic_id) {
if (!empty($abiotic_id) && ctype_digit($abiotic_id)) {
$rice_is_checked_abiotic = true; // Set to true since it's a boolean value

// Insert the record into the database
$query_abiotic = "INSERT INTO rice_abiotic_resistance (rice_traits_id, abiotic_resistance_id, rice_is_checked_abiotic) VALUES ($1, $2, $3)";
$query_run_abiotic = pg_query_params($conn, $query_abiotic, array($rice_traits_id, $abiotic_id, $rice_is_checked_abiotic));
if (!$query_run_abiotic) {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
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

// Delete from rice Traits table
$query_delete_rice_Traits = "DELETE FROM rice_traits WHERE rice_traits_id = $1";
$query_run_delete_rice_Traits = pg_query_params($conn, $query_delete_rice_Traits, [$update_rice_traits_id]);

if (!$query_run_delete_rice_Traits) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from Vegetative state table
$query_delete_veg_state = "DELETE FROM vegetative_state_rice WHERE vegetative_state_rice_id = $1";
$query_run_delete_veg_state = pg_query_params($conn, $query_delete_veg_state, [$update_vegetative_state_rice_id]);

if (!$query_run_delete_veg_state) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from Reproductive state table
$query_delete_repro_state = "DELETE FROM reproductive_state_rice WHERE reproductive_state_rice_id = $1";
$query_run_delete_repro_state = pg_query_params($conn, $query_delete_repro_state, [$update_reproductive_state_rice_id]);

if (!$query_run_delete_repro_state) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from panicle traits table
$query_delete_panicleTraits = "DELETE FROM panicle_traits_rice WHERE panicle_traits_rice_id = $1";
$query_run_delete_panicleTraits = pg_query_params($conn, $query_delete_panicleTraits, [$update_panicle_traits_rice_id]);

if (!$query_run_delete_panicleTraits) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from flag leaf traits table
$query_delete_flagLeaf = "DELETE FROM flag_leaf_traits_rice WHERE flag_leaf_traits_rice_id = $1";
$query_run_delete_flagLeaf = pg_query_params($conn, $query_delete_flagLeaf, [$update_flag_leaf_traits_rice_id]);

if (!$query_run_delete_flagLeaf) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from sensory traits table
$query_delete_sensoryTraits = "DELETE FROM sensory_traits_rice WHERE sensory_traits_rice_id = $1";
$query_run_delete_sensoryTraits = pg_query_params($conn, $query_delete_sensoryTraits, [$update_sensory_traits_rice_id]);

if (!$query_run_delete_sensoryTraits) {
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


// Delete from Disease Resistance table
$query_delete_disease_res = "DELETE FROM rice_disease_resistance WHERE rice_traits_id = $1";
$query_run_delete_disease_res = pg_query_params($conn, $query_delete_disease_res, [$update_rice_traits_id]);

if (!$query_run_delete_disease_res) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from Abiotic Resistance table
$query_delete_abiotic_res = "DELETE FROM rice_abiotic_resistance WHERE rice_traits_id = $1";
$query_run_delete_abiotic_res = pg_query_params($conn, $query_delete_abiotic_res, [$update_rice_traits_id]);

if (!$query_run_delete_abiotic_res) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from Pest Resistance_rice table
$query_delete_pest_res = "DELETE FROM rice_pest_resistance WHERE rice_traits_id = $1";
$query_run_delete_pest_res = pg_query_params($conn, $query_delete_pest_res, [$update_rice_traits_id]);

if (!$query_run_delete_pest_res) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from pest other resistance table
$query_delete_pestOther = "DELETE FROM rice_pest_resistance_other WHERE rice_pest_other_id = $1";
$query_run_delete_pestOther = pg_query_params($conn, $query_delete_pestOther, [$update_rice_pest_other_id]);

if (!$query_run_delete_pestOther) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from abiotic other resistance table
$query_delete_abioticOther = "DELETE FROM rice_abiotic_resistance_other WHERE rice_abiotic_other_id = $1";
$query_run_delete_abioticOther = pg_query_params($conn, $query_delete_abioticOther, [$update_rice_abiotic_other_id]);

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
left join category on category.category_id = crop.category_id left join utilization_cultural_importance on crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
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

echo 'fuck';
//die();

// location
$province_id = $crops['province_id'];
$municipality_id = $crops['municipality_id'];
$coordinates = $crops['coordinates'];
$barangay_id = $crops['barangay_id'];
$sitio_name = $crops['sitio_name'];

// resistances
$pest_resistances = $crops['pest_resistances'];
$disease_resistances = $crops['disease_resistances'];
$abiotic_resistances = $crops['abiotic_resistances'];

// pest resistance other
$pest_other = $crops['rootcrop_pest_other'];
$pest_other_desc = $crops['rootcrop_pest_other_desc'];

// abiotic resistance other
$abiotic_other = $crops['rootcrop_abiotic_other'];
$abiotic_other_desc = $crops['rootcrop_abiotic_other_desc'];

// Utilization Cultural Importance
$significance = $crops['significance'];
$use = $crops['use'];
$indigenous_utilization = $crops['indigenous_utilization'];
$remarkable_features = $crops['remarkable_features'];

//* morphological Traits rootcrop
// Vegetative state rootcrop
$rootcrop_plant_height = $crops['rootcrop_plant_height'];
$rootcrop_leaf_width = $crops['rootcrop_leaf_width'];
$rootcrop_leaf_length = $crops['rootcrop_leaf_length'];
$rootcrop_stem_leaf_desc = $crops['rootcrop_stem_leaf_desc'];
$rootcrop_maturity_time = $crops['rootcrop_maturity_time'];

// rootcrop traits
$eating_quality = $crops['eating_quality'];
$rootcrop_color = $crops['rootcrop_color'];
$sweetness = $crops['sweetness'];
$rootcrop_remarkable_features = $crops['rootcrop_remarkable_features'];

//id's to be deleted when finished updating
$update_crop_id = $crops['crop_id'];
$update_status_id = $crops['status_id'];
$update_root_crop_traits_id = $crops['root_crop_traits_id'];
$update_rootcrop_traits_id = $crops['rootcrop_traits_id'];
$update_crop_location_id = $crops['crop_location_id'];
$update_utilization_cultural_id = $crops['utilization_cultural_id'];
$update_vegetative_state_rootcrop_id = $crops['vegetative_state_rootcrop_id'];
$update_rootcrop_pest_other_id = $crops['rootcrop_pest_other_id'];
$update_rootcrop_abiotic_other_id = $crops['rootcrop_abiotic_other_id'];

// get the unique code the remove the updating
$currentUniqueCode = $crops['unique_code'];
$updateUniqueCode = str_replace("-UPDATING", "", $currentUniqueCode);

// get the crop that should be updated
$query_Crop = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join municipality
on crop_location.municipality_id = municipality.municipality_id left join barangay on crop_location.barangay_id = barangay.barangay_id
left join utilization_cultural_importance on crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id left join category on crop.category_id = category.category_id
left join root_crop_traits on crop.crop_id = root_crop_traits.crop_id left join rootcrop_traits on rootcrop_traits.rootcrop_traits_id = root_crop_traits.rootcrop_traits_id
left join rootcrop_pest_resistance_other on rootcrop_pest_resistance_other.rootcrop_pest_other_id = root_crop_traits.rootcrop_pest_other_id
left join rootcrop_abiotic_resistance_other on rootcrop_abiotic_resistance_other.rootcrop_abiotic_other_id = root_crop_traits.rootcrop_abiotic_other_id
left join status on status.status_id = crop.status_id
WHERE crop.unique_code = $1";

$query_runCrop = pg_query_params($conn, $query_Crop, array($updateUniqueCode));
if (pg_num_rows($query_runCrop) > 0) {
$cropsUpdate = pg_fetch_assoc($query_runCrop);

//id's of the crop that needs to be updated
$crop_id = $cropsUpdate['crop_id'];
$root_crop_traits_id = $cropsUpdate['root_crop_traits_id'];
$category_id = $cropsUpdate['category_id'];
$crop_location_id = $cropsUpdate['crop_location_id'];
$rootcrop_traits_id = $cropsUpdate['rootcrop_traits_id'];
$utilization_cultural_id = $cropsUpdate['utilization_cultural_id'];
$vegetative_state_rootcrop_id = $cropsUpdate['vegetative_state_rootcrop_id'];
$status_id = $cropsUpdate['status_id'];
$rootcrop_abiotic_other_id = $cropsUpdate['rootcrop_abiotic_other_id'];
$rootcrop_pest_other_id = $cropsUpdate['rootcrop_pest_other_id'];
$action = "Approved";

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
crop_seed_image = $4, crop_vegetative_image =$5, crop_reproductive_image = $6 where crop_id = $7";

$valueCrops = array(
$crop_variety, $crop_description, $meaning_of_name, $crop_seed_image, $crop_vegetative_image, $crop_reproductive_image, $crop_id
);
$query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

if ($query_run_Crop) {
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// update Status table
$queryStatus = "UPDATE status set action =$1, status_date = CURRENT_TIMESTAMP where status_id = $2";

$valueStatus = array(
$action, $status_id
);
$query_run_Status = pg_query_params($conn, $queryStatus, $valueStatus);

if ($query_run_Status) {
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// update Crop Location Table
$query_CropLoc = "UPDATE crop_location set municipality_id = $1, barangay_id = $2, coordinates = $3, sitio_name = $4 where crop_location_id = $5";
$query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($municipality_id, $barangay_id, $coordinates, $sitio_name, $crop_location_id));

if ($query_run_CropLoc) {
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// Handle rootcrop category traits
// rootcrop traits
$query_rootcropTraits = "UPDATE rootcrop_traits set eating_quality = $1, rootcrop_color = $2, sweetness = $3, rootcrop_remarkable_features = $4 where rootcrop_traits_id = $5";
$query_run_rootcropTraits = pg_query_params($conn, $query_rootcropTraits, array($eating_quality, $rootcrop_color, $sweetness, $rootcrop_remarkable_features, $rootcrop_traits_id));
if ($query_run_rootcropTraits) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}

// vegetative state rootcrop
$query_vegetativeState = "UPDATE vegetative_state_rootcrop set rootcrop_plant_height = $1, rootcrop_leaf_width = $2, rootcrop_leaf_length = $3, rootcrop_stem_leaf_desc = $4, rootcrop_maturity_time = $5 WHERE vegetative_state_rootcrop_id = $6";
$query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rootcrop_plant_height, $rootcrop_leaf_width, $rootcrop_leaf_length, $rootcrop_stem_leaf_desc, $rootcrop_maturity_time, $vegetative_state_rootcrop_id));
if ($query_run_vegetativeState) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}


// check if the rootcrop pest other resistance is null or not
$query_getPest = "SELECT rootcrop_pest_other_id FROM crop LEFT JOIN root_crop_traits ON root_crop_traits.crop_id = crop.crop_id WHERE crop.crop_id = $1";
$query_run_getPest = pg_query_params($conn, $query_getPest, array($crop_id));

// Check if the query returned any rows
if (pg_num_rows($query_run_getPest) > 0) {
$row_getPest = pg_fetch_row($query_run_getPest);
$rootcrop_pest_other_id = $row_getPest[0];

// if the rootcrop_pest_other_id is null or empty save it
if ($rootcrop_pest_other_id === null || $rootcrop_pest_other_id === "") {

// Insert data into the respective tables
if ($pest_other) {
// Insert into rootcrop_pest_other table
$queryPest_other = "INSERT INTO rootcrop_pest_resistance_other (rootcrop_pest_other, rootcrop_pest_other_desc) VALUES ($1, $2) RETURNING rootcrop_pest_other_id";
$query_run_Pest_other = pg_query_params($conn, $queryPest_other, array($pest_other, $pest_other_desc));
if ($query_run_Pest_other) {
$rowPest_other = pg_fetch_row($query_run_Pest_other);
$rootcrop_pest_other_id = $rowPest_other[0];

// Insert into crop table
$query_cropInsert = "UPDATE root_crop_traits SET rootcrop_pest_other_id = $1 WHERE root_crop_traits_id = $2";
$query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rootcrop_pest_other_id, $root_crop_traits_id));
if ($query_run_cropInsert) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
} else {
// if it exists just update its data
// pest resistance other rootcrop
$query_pestOther = "UPDATE rootcrop_pest_resistance_other SET rootcrop_pest_other = $1, rootcrop_pest_other_desc = $2 WHERE rootcrop_pest_other_id = $3";
$query_run_pestOther = pg_query_params($conn, $query_pestOther, array($pest_other, $pest_other_desc, $rootcrop_pest_other_id));
if ($query_run_pestOther) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}

// check if the rootcrop abiotic other resistance is null or not
$query_getAbiotic = "SELECT rootcrop_abiotic_other_id from crop left join root_crop_traits on root_crop_traits.crop_id = crop.crop_id where crop.crop_id = $1";
$query_run_getAbiotic = pg_query_params($conn, $query_getAbiotic, array($crop_id));

if ($query_run_getAbiotic) {
if (pg_num_rows($query_run_getAbiotic) > 0) {
$row_getAbiotic = pg_fetch_row($query_run_getAbiotic);
$rootcrop_abiotic_other_id = $row_getAbiotic[0];

// if the rootcrop_abiotic_other_id is null or empty save it
if ($rootcrop_abiotic_other_id === null || $rootcrop_abiotic_other_id === "") {
// Insert data into the respective tables
if ($abiotic_other) {
// Insert into rootcrop_Abiotic_other table
$queryAbiotic_other = "INSERT INTO rootcrop_abiotic_resistance_other (rootcrop_abiotic_other, rootcrop_abiotic_other_desc) VALUES ($1, $2) returning rootcrop_abiotic_other_id";
$query_run_Abiotic_other = pg_query_params($conn, $queryAbiotic_other, array($abiotic_other, $abiotic_other_desc));
if ($query_run_Abiotic_other) {
$rowAbiotic_other = pg_fetch_row($query_run_Abiotic_other);
$rootcrop_abiotic_other_id = $rowAbiotic_other[0];

// Insert into crop table
$query_cropInsert = "UPDATE root_crop_traits set rootcrop_abiotic_other_id = $1 where root_crop_traits_id = $2";
$query_run_cropInsert = pg_query_params($conn, $query_cropInsert, array($rootcrop_abiotic_other_id, $root_crop_traits_id));
if ($query_run_cropInsert) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
} else {
// if it exists just update its data
// pest resistance other rootcrop
$query_abioticOther = "UPDATE rootcrop_abiotic_resistance_other set rootcrop_abiotic_other = $1, rootcrop_abiotic_other_desc = $2 WHERE rootcrop_abiotic_other_id = $3";
$query_run_abioticOther = pg_query_params($conn, $query_abioticOther, array($abiotic_other, $abiotic_other_desc, $rootcrop_abiotic_other_id));
if ($query_run_abioticOther) {
echo "success";
} else {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
}

// Update the pest resistance
if (isset($pest_resistances)) {
// Delete existing pest resistances for the variety
$query_delete_pest = "DELETE FROM rootcrop_pest_resistance WHERE root_crop_traits_id = $1";
$query_run_delete_pest = pg_query_params($conn, $query_delete_pest, array($root_crop_traits_id));

// Split the string into an array of integers
$pest_resistances_arr = explode(',', substr($pest_resistances, 1, -1));

// Loop through the submitted pest resistance IDs
foreach ($pest_resistances_arr as $pest_id) {
if (!empty($pest_id) && ctype_digit($pest_id)) {
$rootcrop_is_checked_pest = true; // Set to true since it's a boolean value

// Insert the record into the database
$query_pest = "INSERT INTO rootcrop_pest_resistance (root_crop_traits_id, pest_resistance_id, rootcrop_is_checked_pest) VALUES ($1, $2, $3)";
$query_run_pest = pg_query_params($conn, $query_pest, array($root_crop_traits_id, $pest_id, $rootcrop_is_checked_pest));
if (!$query_run_pest) {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
}

// Update the disease resistance
if (isset($disease_resistances)) {
// Delete existing disease resistances for the variety
$query_delete_disease = "DELETE FROM rootcrop_disease_resistance WHERE root_crop_traits_id = $1";
$query_run_delete_disease = pg_query_params($conn, $query_delete_disease, array($root_crop_traits_id));

// Split the string into an array of integers
$disease_resistances_arr = explode(',', substr($disease_resistances, 1, -1));

// Loop through the submitted disease resistance IDs
foreach ($disease_resistances_arr as $disease_id) {
if (!empty($disease_id) && ctype_digit($disease_id)) {
$rootcrop_is_checked_disease = true; // Set to true since it's a boolean value

// Insert the record into the database
$query_disease = "INSERT INTO rootcrop_disease_resistance (root_crop_traits_id, disease_resistance_id, rootcrop_is_checked_disease) VALUES ($1, $2, $3)";
$query_run_disease = pg_query_params($conn, $query_disease, array($root_crop_traits_id, $disease_id, $rootcrop_is_checked_disease));
if (!$query_run_disease) {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
}

// Update the abiotic resistance
if (isset($abiotic_resistances)) {
// Delete existing abiotic resistances for the variety
$query_delete_abiotic = "DELETE FROM rootcrop_abiotic_resistance WHERE root_crop_traits_id = $1";
$query_run_delete_abiotic = pg_query_params($conn, $query_delete_abiotic, array($root_crop_traits_id));

// Split the string into an array of integers
$abiotic_resistances_arr = explode(',', substr($abiotic_resistances, 1, -1));

// Loop through the submitted abiotic resistance IDs
foreach ($abiotic_resistances_arr as $abiotic_id) {
if (!empty($abiotic_id) && ctype_digit($abiotic_id)) {
$rootcrop_is_checked_abiotic = true; // Set to true since it's a boolean value

// Insert the record into the database
$query_abiotic = "INSERT INTO rootcrop_abiotic_resistance (root_crop_traits_id, abiotic_resistance_id, rootcrop_is_checked_abiotic) VALUES ($1, $2, $3)";
$query_run_abiotic = pg_query_params($conn, $query_abiotic, array($root_crop_traits_id, $abiotic_id, $rootcrop_is_checked_abiotic));
if (!$query_run_abiotic) {
echo "Error: " . pg_last_error($conn);
exit(0);
}
}
}
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

// Delete from root_crop Traits table
$query_delete_root_crop_Traits = "DELETE FROM root_crop_traits WHERE root_crop_traits_id = $1";
$query_run_delete_root_crop_Traits = pg_query_params($conn, $query_delete_root_crop_Traits, [$update_root_crop_traits_id]);

if (!$query_run_delete_root_crop_Traits) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from rootcrop Traits table
$query_delete_rootcrop_Traits = "DELETE FROM rootcrop_traits WHERE rootcrop_traits_id = $1";
$query_run_delete_rootcrop_Traits = pg_query_params($conn, $query_delete_rootcrop_Traits, [$update_rootcrop_traits_id]);

if (!$query_run_delete_rootcrop_Traits) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from Vegetative state table
$query_delete_veg_state = "DELETE FROM vegetative_state_rootcrop WHERE vegetative_state_rootcrop_id = $1";
$query_run_delete_veg_state = pg_query_params($conn, $query_delete_veg_state, [$update_vegetative_state_rootcrop_id]);

if (!$query_run_delete_veg_state) {
echo "Error: " . pg_last_error($conn);
die();
}


// Delete from Disease Resistance table
$query_delete_disease_res = "DELETE FROM rootcrop_disease_resistance WHERE root_crop_traits_id = $1";
$query_run_delete_disease_res = pg_query_params($conn, $query_delete_disease_res, [$update_root_crop_traits_id]);

if (!$query_run_delete_disease_res) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from Abiotic Resistance table
$query_delete_abiotic_res = "DELETE FROM rootcrop_abiotic_resistance WHERE root_crop_traits_id = $1";
$query_run_delete_abiotic_res = pg_query_params($conn, $query_delete_abiotic_res, [$update_root_crop_traits_id]);

if (!$query_run_delete_abiotic_res) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from Pest Resistance_rootcrop table
$query_delete_pest_res = "DELETE FROM rootcrop_pest_resistance WHERE root_crop_traits_id = $1";
$query_run_delete_pest_res = pg_query_params($conn, $query_delete_pest_res, [$update_root_crop_traits_id]);

if (!$query_run_delete_pest_res) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from pest other resistance table
$query_delete_pestOther = "DELETE FROM rootcrop_pest_resistance_other WHERE rootcrop_pest_other_id = $1";
$query_run_delete_pestOther = pg_query_params($conn, $query_delete_pestOther, [$update_rootcrop_pest_other_id]);

if (!$query_run_delete_pestOther) {
echo "Error: " . pg_last_error($conn);
die();
}

// Delete from abiotic other resistance table
$query_delete_abioticOther = "DELETE FROM rootcrop_abiotic_resistance_other WHERE rootcrop_abiotic_other_id = $1";
$query_run_delete_abioticOther = pg_query_params($conn, $query_delete_abioticOther, [$update_rootcrop_abiotic_other_id]);

if (!$query_run_delete_abioticOther) {
echo "Error: " . pg_last_error($conn);
die();
}
}
}
// Commit the transaction if everything is successful
$_SESSION['message'] = "Update Approved";
pg_query($conn, "COMMIT");
// header("Location: pending.php");
exit(0);
} catch (Exception $e) {
// message for error
$_SESSION['message'] = 'Crop not Saved';
echo "Error: " . pg_last_error($conn);
// Rollback the transaction if an error occurs
pg_query($conn, "ROLLBACK");
// Log the error message
error_log("Error: " . $e->getMessage());
// Handle the error
echo "Error: " . $e->getMessage();
// Display the error message
echo "<script>
    document.getElementById('error-container').innerHTML = '" . $e->getMessage() . "';
</script>";
exit(0);
}
}

if (isset($_POST['action']) && $_POST['action'] == 'reject') {
$crop_id = $_POST['crop_id'];
$remarks = $_POST['remarks'];
$select = "UPDATE status
SET action = 'Rejected', remarks = '$remarks', status_date = CURRENT_TIMESTAMP
WHERE status_id IN (SELECT status_id FROM crop WHERE crop_id = '$crop_id')";

$result = pg_query($conn, $select);
if ($result) {
$_SESSION['message'] = "The submission is rejected.";
//header("location: pending.php");
exit; // Ensure that the script stops executing after the redirect header
} else {
// Log the error or display a more user-friendly message
echo "Error updating record: " . pg_last_error($conn);
}
}