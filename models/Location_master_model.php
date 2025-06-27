<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Location_master_model extends App_Model
{
    public $table_prefix;
    public function __construct()
    {
        parent::__construct();
        $this->table_prefix = db_prefix();
        $this->load->database();
    }
    public function get_all_countries()
    {
        return $this->db->get($this->table_prefix . 'countries')->result_array();
    }
    public function get_country($id)
    {
        return $this->db->where('country_id', $id)->get($this->table_prefix . 'countries')->row();
    }
    public function add_country($data)
    {
        $this->db->insert($this->table_prefix . 'countries', $data);
        return $this->db->insert_id();
    }
    public function update_country($id, $data)
    {
        $this->db->where('country_id', $id)->update($this->table_prefix . 'countries', $data);
        return $this->db->affected_rows();
    }
    public function delete_country($id)
    {
        $this->db->where('country_id', $id)->delete($this->table_prefix . 'countries');
        return $this->db->affected_rows();
    }

    // states
    public function get_all_states()
    {
        return $this->db->get($this->table_prefix . 'states')->result_array();
    }
    public function get_state($id)
    {
        return $this->db->where('id', $id)->get($this->table_prefix . 'states')->row();
    }
    public function get_states_by_country($country_id)
    {
        return $this->db->where('country_id', $country_id)
                        ->get($this->table_prefix . 'states')
                        ->result_array();
    }
    public function add_state($data)
    {
        $this->db->insert($this->table_prefix . 'states', $data);
        return $this->db->insert_id();
    }
    public function update_state($id, $data)
    {
        $this->db->where('id', $id)->update($this->table_prefix . 'states', $data);
        return $this->db->affected_rows();
    }
    public function delete_state($id)
    {
        $this->db->where('id', $id)->delete($this->table_prefix . 'states');
        return $this->db->affected_rows();
    }
    // districts
    public function get_all_districts()
    {
        return $this->db->get($this->table_prefix . 'districts')->result_array();
    }
    public function get_districts_by_state($state_id)
    {
        return $this->db->where('state_id', $state_id)
                        ->get($this->table_prefix . 'districts')
                        ->result_array();
    }

    public function get_district($id)
    {
        return $this->db->where('id', $id)->get($this->table_prefix . 'districts')->row();
    }
    public function add_district($data)
    {
        $this->db->insert($this->table_prefix . 'districts', $data);
        return $this->db->insert_id();
    }
    public function update_district($id, $data)
    {
        $this->db->where('id', $id)->update($this->table_prefix . 'districts', $data);
        return $this->db->affected_rows();
    }
    public function delete_district($id)
    {
        $this->db->where('id', $id)->delete($this->table_prefix . 'districts');
        return $this->db->affected_rows();
    }
    // cities
    public function get_all_cities()
    {
        return $this->db->get($this->table_prefix . 'cities')->result_array();
    }
    public function get_city($id)
    {
        return $this->db->where('id', $id)->get($this->table_prefix . 'cities')->row();
    }
    public function get_cities_by_district($district_id)
    {
        return $this->db->where('district_id', $district_id)
                        ->get($this->table_prefix . 'cities')
                        ->result_array();
    }
    public function add_city($data)
    {
        $this->db->insert($this->table_prefix . 'cities', $data);
        return $this->db->insert_id();
    }
    public function update_city($id, $data)
    {
        $this->db->where('id', $id)->update($this->table_prefix . 'cities', $data);
        return $this->db->affected_rows();
    }
    public function delete_city($id)
    {
        $this->db->where('id', $id)->delete($this->table_prefix . 'cities');
        return $this->db->affected_rows();
    }

    // pincodes
    public function get_all_pincodes()
    {
        return $this->db->get($this->table_prefix . 'pincodes')->result_array();
    }
    public function get_pincode($id)
    {
        return $this->db->where('id', $id)->get($this->table_prefix . 'pincodes')->row();
    }
    public function get_pincodes_by_city($city_id)
    {
        return $this->db->where('city_id', $city_id)
                        ->get($this->table_prefix . 'pincodes')
                        ->result_array();
    }
    public function add_pincode($data)
    {
        $this->db->insert($this->table_prefix . 'pincodes', $data);
        return $this->db->insert_id();
    }
    public function update_pincode($id, $data)
    {
        $this->db->where('id', $id)->update($this->table_prefix . 'pincodes', $data);
        return $this->db->affected_rows();
    }
    public function delete_pincode($id)
    {
        $this->db->where('id', $id)->delete($this->table_prefix . 'pincodes');
        return $this->db->affected_rows();
    }   
}