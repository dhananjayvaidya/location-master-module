<?php 
/**
 * Ensures that the module init file can't be accessed directly, only within the application.
 */
defined('BASEPATH') or exit('No direct script access allowed');
/*
Module Name: Location master
Description: This module allow you to create, update, delete & view countries, states, cities, districts in perfex CRM
Version: 1.0.0
Author: VDigitalize
Author URI: https://vdigitalize.com
Requires at least: 2.3.*
*/
define('location_master_MODULE_NAME', 'location_master');
hooks()->add_action('admin_init', 'location_master_module_init_menu_items');
hooks()->add_action('admin_init', 'location_master_permissions');
register_language_files('location_master', ['location_master']);


/**
 * Initialize the module menu items.
 */
function location_master_module_init_menu_items()
{
    if (has_permission('location_master', '', 'view')) {
        $CI = &get_instance();

        // Check if 'masters' menu exists, if not, create it
        if (!$CI->app_menu->get('masters')) {
            $CI->app_menu->add_sidebar_menu_item('masters', [
                'name'     => _l('location_master_masters'),
                'icon'     => 'fa fa-database',
                'position' => 40,
            ]);
        }

        // Add 'countries_master' as a child under 'masters'
        $CI->app_menu->add_sidebar_children_item('masters', [
            'slug'     => 'countries_master',
            'name'     => _l('location_master_countries'),
            'href'     => admin_url('location_master/countries_master'),
            
            'position' => 1,
        ]);
        // Add 'states_master' as a child under 'masters'
        $CI->app_menu->add_sidebar_children_item('masters', [
            'slug'     => 'states_master',
            'name'     => _l('location_master_states'),
            'href'     => admin_url('location_master/states_master'),
            
            'position' => 2,
        ]);
        // Add 'cities_master' as a child under 'masters'
        $CI->app_menu->add_sidebar_children_item('masters', [
            'slug'     => 'cities_master',
            'name'     => _l('location_master_cities'),
            'href'     => admin_url('location_master/cities_master'),
            
            'position' => 3,
        ]);
        // Add 'districts_master' as a child under 'masters'
        $CI->app_menu->add_sidebar_children_item('masters', [
            'slug'     => 'districts_master',
            'name'     => _l('location_master_districts'),
            'href'     => admin_url('location_master/districts_master'),
            
            'position' => 4,
        ]);
        // Add 'pincode_master' as a child under 'masters'
        $CI->app_menu->add_sidebar_children_item('masters', [
            'slug'     => 'pincode_master',
            'name'     => _l('location_master_pincode'),
            'href'     => admin_url('location_master/pincodes_master'),
           
            'position' => 5,
        ]);
    }
}
/**
 * Define permissions for the country master module.
 */
function location_master_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
        'view'   => _l('view', _l('countries')),
        'create' => _l('create', _l('country')),
        'edit'   => _l('edit', _l('country')),
        'delete' => _l('delete', _l('country')),
    ];
    register_staff_capabilities('country_master', $capabilities,_l('location_master_countries'));
    register_staff_capabilities('states_master', $capabilities,_l('location_master_states'));
    register_staff_capabilities('cities_master', $capabilities,_l('location_master_cities'));
    register_staff_capabilities('districts_master', $capabilities,_l('location_master_districts'));
    register_staff_capabilities('pincode_master', $capabilities,_l('location_master_pincode'));
}

function _location_master_lang($key)
{
    return _l('location_master_' . $key);
}


/**
 * Register activation module hook
 */
register_activation_hook(location_master_MODULE_NAME, 'location_master_module_activation_hook');

function location_master_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

// load helper
require_once(__DIR__ . '/helpers/location_master_helper.php');
