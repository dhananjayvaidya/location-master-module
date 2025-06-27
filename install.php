<?php 
defined('BASEPATH') or exit('No direct script access allowed');
// here first check if the countries table exists
if (!$CI->db->table_exists(db_prefix() . 'countries')) {
    // If not, create the countries table
    $CI->db->query("
        CREATE TABLE `" . db_prefix() . "countries` (
            `country_id` INT(11) NOT NULL AUTO_INCREMENT,
            `short_name` VARCHAR(100) NOT NULL,
            `long_name` VARCHAR(255) NOT NULL,
            `iso2` VARCHAR(2) NOT NULL,
            `iso3` VARCHAR(3) NOT NULL,
            `calling_code` VARCHAR(10) NOT NULL,
            PRIMARY KEY (`country_id`),
            UNIQUE KEY `short_name` (`short_name`),
            UNIQUE KEY `iso2` (`iso2`),
            UNIQUE KEY `iso3` (`iso3`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    "); 
}
// here check if the states table exists
if (!$CI->db->table_exists(db_prefix() . 'states')) {
    // If not, create the states table
    $CI->db->query("
        CREATE TABLE `" . db_prefix() . "states` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `country_id` INT(11) NOT NULL,
            `name` VARCHAR(100) NOT NULL,
            `status` TINYINT(1) NOT NULL DEFAULT 1,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `deleted_at` DATETIME DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `country_id` (`country_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
}

// here check if the districts table exists
if (!$CI->db->table_exists(db_prefix() . 'districts')) {
    // If not, create the districts table
    $CI->db->query("
        CREATE TABLE `" . db_prefix() . "districts` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `country_id` INT(11) NOT NULL,
            `state_id` INT(11) NOT NULL,
            `name` VARCHAR(100) NOT NULL,
            `status` TINYINT(1) NOT NULL DEFAULT 1,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `deleted_at` DATETIME DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `state_id` (`state_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
}
// here check if the cities table exists
if (!$CI->db->table_exists(db_prefix() . 'cities')) {
    // If not, create the cities table
    $CI->db->query("
        CREATE TABLE `" . db_prefix() . "cities` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `country_id` INT(11) NOT NULL,
            `state_id` INT(11) NOT NULL,
            `district_id` INT(11) NOT NULL,
            `name` VARCHAR(100) NOT NULL,
            `status` TINYINT(1) NOT NULL DEFAULT 1,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `deleted_at` DATETIME DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `district_id` (`district_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
}   
// here check if the pincode table exists
if (!$CI->db->table_exists(db_prefix() . 'pincodes')) {
    // If not, create the pincode table
    $CI->db->query("
        CREATE TABLE `" . db_prefix() . "pincodes` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `country_id` INT(11) NOT NULL,
            `state_id` INT(11) NOT NULL,
            `district_id` INT(11) NOT NULL,
            `city_id` INT(11) NOT NULL,
            `name` VARCHAR(10) NOT NULL,
            `status` TINYINT(1) NOT NULL DEFAULT 1,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `deleted_at` DATETIME DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `city_id` (`city_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
}