CREATE TABLE IF NOT EXISTS province (
    province_id SERIAL PRIMARY KEY,
    province_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS municipality (
    municipality_id SERIAL PRIMARY KEY,
    province_id INT REFERENCES province(province_id),
    municipality_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS barangay (
    barangay_id SERIAL PRIMARY KEY,
    municipality_id INT REFERENCES municipality(municipality_id),
    barangay_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS category (
    category_id SERIAL PRIMARY KEY,
    category_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS category_variety (
    category_variety_id SERIAL PRIMARY KEY,
    category_id INT REFERENCES category(category_id),
    category_variety_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS terrain (
    terrain_id SERIAL PRIMARY KEY,
    terrain_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS utilization_cultural_importance (
    utillization_cultural_id SERIAL PRIMARY KEY,
    significance VARCHAR(255),
    use VARCHAR(255),
    indigenous_utilization VARCHAR(255),
    remarkable_features VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS account_type (
    account_type_id SERIAL PRIMARY KEY,
    type_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS "status" (
    status_id SERIAL PRIMARY KEY,
    status_date TIMESTAMP,
    remarks VARCHAR(255),
    action VARCHAR
);

CREATE TABLE IF NOT EXISTS users (
    user_id SERIAL PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    gender VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    affiliation VARCHAR(255),
    username VARCHAR(255),
    email_verified VARCHAR(255),
    account_type_id INT REFERENCES account_type(account_type_id),
    registration_date TIMESTAMP
);

CREATE TABLE IF NOT EXISTS crop (
    crop_id SERIAL PRIMARY KEY,
    crop_variety VARCHAR(255),
    crop_description VARCHAR(255),
    input_date TIMESTAMP,
    unique_code VARCHAR(255),
    meaning_of_name VARCHAR(255),
    category_id INT REFERENCES category(category_id),
    user_id INT REFERENCES users(user_id),
    crop_seed_image VARCHAR(255),
    crop_vegetative_image VARCHAR(255),
    crop_reproductive_image VARCHAR(255),
    category_variety_id INT REFERENCES category_variety(category_variety_id),
    terrain_id INT REFERENCES terrain(terrain_id),
    utillization_cultural_id INT REFERENCES utilization_cultural_importance(utillization_cultural_id),
    status_id INT REFERENCES Status(status_id)
);

CREATE TABLE IF NOT EXISTS abiotic_resistance (
    abiotic_resistance_id SERIAL PRIMARY KEY,
    abiotic_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS disease_resistance (
    disease_resistance_id SERIAL PRIMARY KEY,
    disease_name BOOLEAN
);

CREATE TABLE IF NOT EXISTS pest_resistance (
    pest_resistance_id SERIAL PRIMARY KEY,
    pest_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS rootcrop_pest_resistance_other (
    root_crop_pest_other_id SERIAL PRIMARY KEY,
    rootcrop_pest_other BOOLEAN,
    rootcrop_pest_other_desc VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS rice_pest_resistance_other (
    rice_pest_other_id SERIAL PRIMARY KEY,
    rice_pest_other BOOLEAN,
    rice_pest_other_desc VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS corn_pest_resistance_other (
    corn_pest_other_id SERIAL PRIMARY KEY,
    corn_pest_other BOOLEAN,
    corn_pest_other_desc VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS rootcrop_abiotic_resistance_other(
    root_crop_abiotic_other_id SERIAL PRIMARY KEY,
    rootcrop_abiotic_other BOOLEAN,
    rootcrop_abiotic_other_desc VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS rice_abiotic_resistance_other(
    rice_abiotic_other_id SERIAL PRIMARY KEY,
    rice_abiotic_other BOOLEAN,
    rice_abiotic_other_desc VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS corn_abiotic_resistance_other(
    corn_abiotic_other_id SERIAL PRIMARY KEY,
    corn_abiotic_other BOOLEAN,
    corn_abiotic_other_desc VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS seed_traits (
    seed_traits_id SERIAL PRIMARY KEY,
    seed_length VARCHAR(255),
    seed_width VARCHAR(255),
    seed_shape VARCHAR(255),
    seed_color VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS vegetative_state_rice (
    vegetative_state_rice_id SERIAL PRIMARY KEY,
    rice_plant_height VARCHAR(255),
    rice_leaf_width VARCHAR(255),
    rice_leaf_length VARCHAR(255),
    rice_tillering_ability VARCHAR(255),
    rice_maturity_time VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS panicle_traits_rice (
    panicle_traits_rice_id SERIAL PRIMARY KEY,
    panicle_length VARCHAR(255),
    panicle_width VARCHAR(255),
    panicle_enclosed_by VARCHAR(255),
    panicle_remarkable_features VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS flag_leaf_traits_rice (
    flag_leaf_traits_rice_id SERIAL PRIMARY KEY,
    flag_length VARCHAR(255),
    flag_width VARCHAR(255),
    purplish_stripes VARCHAR(255),
    pubescence VARCHAR(255),
    flag_remarkable_features VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS reproductive_state_rice (
    reproductive_state_rice_id SERIAL PRIMARY KEY,
    rice_yield_capacity VARCHAR(255),
    panicle_traits_rice_id INT REFERENCES panicle_traits_rice(panicle_traits_rice_id),
    seed_traits_id INT REFERENCES seed_traits(seed_traits_id),
    flag_leaf_traits_rice_id INT REFERENCES flag_leaf_traits_rice(flag_leaf_traits_rice_id)
);

CREATE TABLE IF NOT EXISTS sensory_traits_rice (
    sensory_traits_rice_id SERIAL PRIMARY KEY,
    aroma VARCHAR(255),
    quality_cooked_rice VARCHAR(255),
    quality_leftover_rice VARCHAR(255),
    volume_expansion VARCHAR(255),
    glutinous VARCHAR(255),
    hardness VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS rice_traits (
    rice_traits_id SERIAL PRIMARY KEY,
    crop_id INT REFERENCES crop(crop_id),
    vegetative_state_rice_id INT REFERENCES vegetative_state_rice(vegetative_state_rice_id),
    reproductive_state_rice_id INT REFERENCES reproductive_state_rice(reproductive_state_rice_id),
    sensory_traits_rice_id INT REFERENCES sensory_traits_rice(sensory_traits_rice_id),
    rice_pest_other_id INT REFERENCES rice_pest_resistance_other(rice_pest_other_id),
    rice_abiotic_other_id INT REFERENCES rice_abiotic_resistance_other(rice_abiotic_other_id)
);

CREATE TABLE IF NOT EXISTS vegetative_state_corn (
    vegetative_state_corn_id SERIAL PRIMARY KEY,
    corn_plant_height varchar(255),
    corn_leaf_width varchar(255),
    corn_leaf_length varchar(255),
    corn_maturity_time varchar(255)
);

CREATE TABLE IF NOT EXISTS reproductive_state_corn (
    reproductive_state_corn_id SERIAL PRIMARY KEY,
    corn_yield_capacity VARCHAR(255),
    seed_traits_id INT REFERENCES seed_traits(seed_traits_id)
);

CREATE TABLE IF NOT EXISTS corn_traits (
    corn_traits_id SERIAL PRIMARY KEY,
    crop_id INT REFERENCES crop(crop_id),
    vegetative_state_corn_id INT REFERENCES vegetative_state_corn(vegetative_state_corn_id),
    reproductive_state_corn_id INT REFERENCES reproductive_state_corn(reproductive_state_corn_id),
    corn_pest_other_id INT REFERENCES corn_pest_resistance_other(corn_pest_other_id),
    corn_abiotic_other_id INT REFERENCES corn_abiotic_resistance_other(corn_abiotic_other_id)
);

CREATE TABLE IF NOT EXISTS rootcrop_traits (
    rootcrop_traits_id SERIAL PRIMARY KEY,
    eating_quality varchar(255),
    rootcrop_color varchar(255),
    sweetness varchar(255),
    rootcrop_remarkable_features varchar(255)
);

CREATE TABLE IF NOT EXISTS vegetative_state_rootcrop (
    vegetative_state_rootcrop_id SERIAL PRIMARY KEY,
    rootcrop_plant_height VARCHAR(255),
    rootcrop_leaf_width VARCHAR(255),
    rootcrop_leaf_length VARCHAR(255),
    rootcrop_stem_leaf_desc VARCHAR(255),
    rootcrop_maturity_time VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS root_crop_traits (
    root_crop_traits_id SERIAL PRIMARY KEY,
    crop_id INT REFERENCES crop(crop_id),
    vegetative_state_rootcrop_id INT REFERENCES vegetative_state_rootcrop(vegetative_state_rootcrop_id),
    rootcrop_traits_id INT REFERENCES rootcrop_traits(rootcrop_traits_id),
    root_crop_pest_other_id INT REFERENCES rootcrop_pest_resistance_other(root_crop_pest_other_id),
    root_crop_abiotic_other_id INT REFERENCES rootcrop_abiotic_resistance_other(root_crop_abiotic_other_id)
);

CREATE TABLE IF NOT EXISTS rootcrop_pest_resistance (
    root_crop_traits_id INT REFERENCES root_crop_traits(root_crop_traits_id),
    pest_resistance_id INT REFERENCES pest_resistance(pest_resistance_id),
    rootcrop_is_checked_pest BOOLEAN,
    PRIMARY KEY (root_crop_traits_id, pest_resistance_id)
);

CREATE TABLE IF NOT EXISTS rootcrop_abiotic_resistance (
    root_crop_traits_id INT REFERENCES root_crop_traits(root_crop_traits_id),
    abiotic_resistance_id INT REFERENCES abiotic_resistance(abiotic_resistance_id),
    rootcrop_is_checked_abiotic BOOLEAN,
    PRIMARY KEY (root_crop_traits_id, abiotic_resistance_id)
);

CREATE TABLE IF NOT EXISTS rice_pest_resistance (
    rice_traits_id INT REFERENCES rice_traits(rice_traits_id),
    pest_resistance_id INT REFERENCES pest_resistance(pest_resistance_id),
    rice_is_checked_pest BOOLEAN,
    PRIMARY KEY (rice_traits_id, pest_resistance_id)
);

CREATE TABLE IF NOT EXISTS rice_abiotic_resistance (
    rice_traits_id INT REFERENCES rice_traits(rice_traits_id),
    abiotic_resistance_id INT REFERENCES abiotic_resistance(abiotic_resistance_id),
    rice_is_checked_abiotic BOOLEAN,
    PRIMARY KEY (rice_traits_id, abiotic_resistance_id)
);

CREATE TABLE IF NOT EXISTS corn_pest_resistance (
    corn_traits_id INT REFERENCES corn_traits(corn_traits_id),
    pest_resistance_id INT REFERENCES pest_resistance(pest_resistance_id),
    corn_is_checked_pest BOOLEAN,
    PRIMARY KEY (corn_traits_id, pest_resistance_id)
);

CREATE TABLE IF NOT EXISTS corn_abiotic_resistance (
    corn_traits_id INT REFERENCES corn_traits(corn_traits_id),
    abiotic_resistance_id INT REFERENCES abiotic_resistance(abiotic_resistance_id),
    corn_is_checked BOOLEAN,
    PRIMARY KEY (corn_traits_id, abiotic_resistance_id)
);

CREATE TABLE IF NOT EXISTS rice_disease_resistance (
    rice_traits_id INT REFERENCES rice_traits(rice_traits_id),
    disease_resistance_id INT REFERENCES disease_resistance(disease_resistance_id),
    rice_is_checked_disease BOOLEAN,
    PRIMARY KEY (rice_traits_id, disease_resistance_id)
);

CREATE TABLE IF NOT EXISTS corn_disease_resistance (
    corn_traits_id INT REFERENCES corn_traits(corn_traits_id),
    disease_resistance_id INT REFERENCES disease_resistance(disease_resistance_id),
    corn_is_checked BOOLEAN,
    PRIMARY KEY (corn_traits_id, disease_resistance_id)
);

CREATE TABLE IF NOT EXISTS rootcrop_disease_resistance (
    root_crop_traits_id INT REFERENCES root_crop_traits(root_crop_traits_id),
    disease_resistance_id INT REFERENCES disease_resistance(disease_resistance_id),
    rootcrop_is_checked_disease BOOLEAN,
    PRIMARY KEY (root_crop_traits_id, disease_resistance_id)
);

CREATE TABLE IF NOT EXISTS "references" (
    references_id SERIAL PRIMARY KEY,
    crop_id INT REFERENCES crop(crop_id)
);

CREATE TABLE IF NOT EXISTS crop_location (
    crop_location_id SERIAL PRIMARY KEY,
    crop_id INT REFERENCES crop(crop_id),
    municipality_id INT REFERENCES municipality(municipality_id),
    barangay_id INT REFERENCES barangay(barangay_id),
    coordinates VARCHAR(255),
    sitio VARCHAR(255)
);