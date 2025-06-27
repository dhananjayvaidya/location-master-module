<?php 

defined('BASEPATH') or exit('No direct script access allowed');

function ls_get_country_name($country_id) {
    $CI =& get_instance();
    $CI->db->select('short_name');
    $CI->db->from(db_prefix() . 'countries');
    $CI->db->where('country_id', $country_id);
    $query = $CI->db->get();
    if ($query->num_rows() > 0) {
        return $query->row()->short_name;
    }
    return null;
}
function ls_get_state_name($state_id) {
    $CI =& get_instance();
    $CI->db->select('name');
    $CI->db->from(db_prefix() . 'states');
    $CI->db->where('id', $state_id);
    $query = $CI->db->get();
    if ($query->num_rows() > 0) {
        return $query->row()->name;
    }
    return null;
}

function ls_get_district_name($district_id) {
    $CI =& get_instance();
    $CI->db->select('name');
    $CI->db->from(db_prefix() . 'districts');
    $CI->db->where('id', $district_id);
    $query = $CI->db->get();
    if ($query->num_rows() > 0) {
        return $query->row()->name;
    }
    return null;
}

function ls_get_city_name($city_id) {
    $CI =& get_instance();
    $CI->db->select('name');
    $CI->db->from(db_prefix() . 'cities');
    $CI->db->where('id', $city_id);
    $query = $CI->db->get();
    if ($query->num_rows() > 0) {
        return $query->row()->name;
    }
    return null;
}   
