<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pincodes_master extends AdminController
{   

    private $permission_name = 'pincodes_master';
    private $lang_prefix = 'location_master_';
    private $view_path = 'location_master/pincodes/';
    private $url_path = 'location_master/pincodes_master/';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('location_master_model');
    }

    public function index()
    {
        if (!has_permission($this->permission_name, '', 'view')) {
            access_denied($this->permission_name);
        }

        $data['title'] = _l($this->lang_prefix.'pincodes');
        $data['pincodes'] = $this->location_master_model->get_all_pincodes();
        $this->load->view($this->view_path.'index', $this->_prepare_view_data($data));
    }

    public function add()
    {
        if (!has_permission($this->permission_name, '', 'create')) {
            access_denied($this->permission_name);
        }

        if ($this->input->post()) {
            $data = $this->input->post();
            $this->location_master_model->add_pincode($data);
            set_alert('success', _l('added_successfully', _l($this->lang_prefix.'pincode')));
            log_activity('Added new pincode', 'Pincode Name: ' . $data['name']);
            redirect(admin_url($this->url_path));
        }

        $data['title'] = _l('add_new', _l($this->lang_prefix.'pincode'));
        $data['countries'] = $this->location_master_model->get_all_countries();

        $data = $this->_prepare_view_data($data);
        
        $data['form'] = $this->load->view($this->view_path . 'form', $data, true);
        
        $this->load->view($this->view_path.'create', $data);
    }

    public function edit($id)
    {
        if (!has_permission($this->permission_name, '', 'edit')) {
            access_denied($this->permission_name);
        }

        if ($this->input->post()) {
            $data = $this->input->post();
            $this->location_master_model->update_pincode($id, $data);
            set_alert('success', _l('updated_successfully', _l($this->lang_prefix.'pincode')));
            log_activity('Updated pincode', 'Pincode ID: ' . $id . ', Name: ' . $data['name']);
            redirect(admin_url($this->url_path));
        }

        $data['pincode'] = $this->location_master_model->get_pincode($id);
        $data['title'] = _l('edit', _l($this->lang_prefix.'pincode'));
        $data['countries'] = $this->location_master_model->get_all_countries();
        $data = $this->_prepare_view_data($data);
        
        $data['form'] = $this->load->view($this->view_path . 'form', $data, true);
        
        $this->load->view($this->view_path.'edit', $data);
    }

    public function delete($id)
    {
        if (!has_permission($this->permission_name, '', 'delete')) {
            access_denied($this->permission_name);
        }

        $this->location_master_model->delete_pincode($id);
        set_alert('success', _l('deleted', _l($this->lang_prefix.'pincode')));
        log_activity('Deleted pincode', 'Pincode ID: ' . $id);
        redirect(admin_url($this->url_path));
    }
    public function get_pincodes_by_city($city_id)
    {
        if (!has_permission($this->permission_name, '', 'view')) {
            access_denied($this->permission_name);
        }

        $pincodes = $this->location_master_model->get_pincodes_by_city($city_id);
        echo json_encode($pincodes);
    }
    private function _prepare_view_data($data){
        //add default variables and constants to the data array
        $data['lang_prefix'] = $this->lang_prefix;
        $data['permission_name'] = $this->permission_name;
        $data['view_path'] = $this->view_path;
        $data['url_path'] = $this->url_path;
        return $data;
    }
}