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
function ls_ui_fields($params){
    $CI =& get_instance();
    $CI->load->model('location_master/location_master_model','location_master_model');
    $fields = isset($params['fields']) ? $params['fields'] : [];
    $values = isset($params['value']) ? $params['value'] : [];
    $names = isset($params['names']) ? $params['names'] : [];
    $html = '';

    // Assign unique IDs for each select for JS targeting
    $field_ids = [
        'country' => 'ls_country',
        'state' => 'ls_state',
        'district' => 'ls_district',
        'city' => 'ls_city',
        'pincode' => 'ls_pincode'
    ];

    foreach ($fields as $field) {
        switch ($field) {
            case 'country':
                
                $countries = $CI->location_master_model->get_all_countries();
                $selected = isset($values['country']) ? $values['country'] : '';
                $html .= "<div class='col-md-4'>";
                $html .= '<div class="form-group">';
                $html .= '<label for="' . $field_ids['country'] . '">' . _l('location_master_country') . '</label>';
                $html .= '<select id="' . $field_ids['country'] . '" name="' . $names['country'] . '" class="form-control">';
                $html .= '<option value="">Select Country</option>';
                foreach ($countries as $country) {
                    $is_selected = ($country['country_id'] == $selected) ? 'selected' : '';
                    $html .= '<option value="' . htmlspecialchars($country['country_id']) . '" ' . $is_selected . '>' . htmlspecialchars($country['short_name']) . '</option>';
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '</div>';
                break;
            case 'state':
                $selected = isset($values['state']) ? $values['state'] : '';
                $html .= '<div class="col-md-4">';
                $html .= '<div class="form-group">';
                $html .= '<label for="' . $field_ids['state'] . '">' . _l('location_master_state') . '</label>';

                $html .= '<select id="' . $field_ids['state'] . '" name="' . $names['state'] . '" class="form-control">';
                $html .= '<option value="">Select State</option>';
                // If value is set, populate options, else leave empty for AJAX
                if (!empty($values['country'])) {
                    $states = $CI->location_master_model->get_states_by_country($values['country']);
                    foreach ($states as $state) {
                        $is_selected = ($state['id'] == $selected) ? 'selected' : '';
                        $html .= '<option value="' . htmlspecialchars($state['id']) . '" ' . $is_selected . '>' . htmlspecialchars($state['name']) . '</option>';
                    }
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '</div>';
                break;
            case 'district':
                $selected = isset($values['district']) ? $values['district'] : '';
                $html .= '<div class="col-md-4">';
                $html .= '<div class="form-group">';
                $html .= '<label for="' . $field_ids['district'] . '">' . _l('location_master_district') . '</label>';
                $html .= '<select id="' . $field_ids['district'] . '" name="' . $names['district'] . '" class="form-control">';
                $html .= '<option value="">Select District</option>';
                if (!empty($values['state'])) {
                    $districts = $CI->location_master_model->get_districts_by_state($values['state']);
                    foreach ($districts as $district) {
                        $is_selected = ($district['id'] == $selected) ? 'selected' : '';
                        $html .= '<option value="' . htmlspecialchars($district['id']) . '" ' . $is_selected . '>' . htmlspecialchars($district['name']) . '</option>';
                    }
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '</div>';
                break;
            case 'city':
                $selected = isset($values['city']) ? $values['city'] : '';
                $html .= '<div class="col-md-4">';
                $html .= '<div class="form-group">';
                $html .= '<label for="' . $field_ids['city'] . '">' . _l('location_master_city') . '</label>';
                $html .= '<select id="' . $field_ids['city'] . '" name="' . $names['city'] . '" class="form-control">';
                $html .= '<option value="">Select City</option>';
                if (!empty($values['district'])) {
                    $cities = $CI->location_master_model->get_cities_by_district($values['district']);
                    foreach ($cities as $city) {
                        $is_selected = ($city['id'] == $selected) ? 'selected' : '';
                        $html .= '<option value="' . htmlspecialchars($city['id']) . '" ' . $is_selected . '>' . htmlspecialchars($city['name']) . '</option>';
                    }
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '</div>';
                break;
            case 'pincode':
                $selected = isset($values['pincode']) ? $values['pincode'] : '';
                $html .= '<div class="col-md-4">';
                $html .= '<div class="form-group">';
                $html .= '<label for="' . $field_ids['pincode'] . '">' . _l('location_master_pincode') . '</label>';
                $html .= '<select id="' . $field_ids['pincode'] . '" name="' . $names['pincode'] . '" class="form-control">';
                $html .= '<option value="">Select Pincode</option>';
                if (!empty($values['city'])) {
                    $pincodes = $CI->location_master_model->get_pincodes_by_city($values['city']);
                    foreach ($pincodes as $pincode) {
                        $is_selected = ($pincode['id'] == $selected) ? 'selected' : '';
                        $html .= '<option value="' . htmlspecialchars($pincode['id']) . '" ' . $is_selected . '>' . htmlspecialchars($pincode['name']) . '</option>';
                    }
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '</div>';
                break;
        }
    }

    // Add AJAX script for cascading dropdowns
    // Move the cascading dropdown script to the app_admin_footer hook
    hooks()->add_action('app_admin_footer', function() {
        ?>
        <script>
        var admin_url = window.admin_url || "<?php echo isset($GLOBALS['admin_url']) ? $GLOBALS['admin_url'] : base_url(); ?>";
        $(function() {
            // Preset values from PHP (if available)
            var preset = {
                country: "<?php echo isset($params['value']['country']) ? htmlspecialchars($params['value']['country'], ENT_QUOTES, 'UTF-8') : ''; ?>",
                state: "<?php echo isset($params['value']['state']) ? htmlspecialchars($params['value']['state'], ENT_QUOTES, 'UTF-8') : ''; ?>",
                district: "<?php echo isset($params['value']['district']) ? htmlspecialchars($params['value']['district'], ENT_QUOTES, 'UTF-8') : ''; ?>",
                city: "<?php echo isset($params['value']['city']) ? htmlspecialchars($params['value']['city'], ENT_QUOTES, 'UTF-8') : ''; ?>",
                pincode: "<?php echo isset($params['value']['pincode']) ? htmlspecialchars($params['value']['pincode'], ENT_QUOTES, 'UTF-8') : ''; ?>"
            };

            function updateDropdown(url, data, target, placeholder, selectedVal, callback) {
                $(target).html('<option value="">Loading...</option>');
                $.get(url, data, function(res){
                    var options = '<option value="">' + placeholder + '</option>';
                    if(res && Array.isArray(res)) {
                        res.forEach(function(item){
                            var val = item.id;
                            var text = item.name || item.short_name || item.pincode;
                            var selected = (selectedVal && val == selectedVal) ? ' selected' : '';
                            options += '<option value="'+val+'"'+selected+'>'+text+'</option>';
                        });
                    }
                    $(target).html(options).trigger('change');
                    if (typeof callback === 'function') callback();
                }, 'json');
            }

            // On page load, if preset values exist, cascade and set them
            function presetCascade() {
                if (preset.country) {
                    $('#ls_country').val(preset.country).trigger('change');
                    // Load states
                    updateDropdown(
                        admin_url+'location_master/states_master/get_states_by_country/'+preset.country,
                        {},
                        '#ls_state',
                        'Select State',
                        preset.state,
                        function() {
                            if (preset.state) {
                                // Load districts
                                updateDropdown(
                                    admin_url+'location_master/districts_master/get_districts_by_state/'+preset.state,
                                    {},
                                    '#ls_district',
                                    'Select District',
                                    preset.district,
                                    function() {
                                        if (preset.district) {
                                            // Load cities
                                            updateDropdown(
                                                admin_url+'location_master/cities_master/get_cities_by_district/'+preset.district,
                                                {},
                                                '#ls_city',
                                                'Select City',
                                                preset.city,
                                                function() {
                                                    if (preset.city) {
                                                        // Load pincodes
                                                        updateDropdown(
                                                            admin_url+'location_master/pincodes_master/get_pincodes_by_city/'+preset.city,
                                                            {},
                                                            '#ls_pincode',
                                                            'Select Pincode',
                                                            preset.pincode
                                                        );
                                                    }
                                                }
                                            );
                                        }
                                    }
                                );
                            }
                        }
                    );
                }
            }

            // Normal cascading on change
            $('#ls_country').on('change', function(){
                var country_id = $(this).val();
                updateDropdown(admin_url+'location_master/states_master/get_states_by_country/'+country_id, {}, '#ls_state', 'Select State');
                $('#ls_district').html('<option value="">Select District</option>');
                $('#ls_city').html('<option value="">Select City</option>');
                $('#ls_pincode').html('<option value="">Select Pincode</option>');
            });

            $('#ls_state').on('change', function(){
                var state_id = $(this).val();
                if (state_id) {
                    updateDropdown(admin_url+'location_master/districts_master/get_districts_by_state/'+state_id, {}, '#ls_district', 'Select District');
                    $('#ls_city').html('<option value="">Select City</option>');
                    $('#ls_pincode').html('<option value="">Select Pincode</option>');
                }
            });

            $('#ls_district').on('change', function(){
                var district_id = $(this).val();
                if (district_id) {
                    updateDropdown(admin_url+'location_master/cities_master/get_cities_by_district/'+district_id, {}, '#ls_city', 'Select City');
                    $('#ls_pincode').html('<option value="">Select Pincode</option>');
                }
            });

            $('#ls_city').on('change', function(){
                var city_id = $(this).val();
                if (city_id) {
                    updateDropdown(admin_url+'location_master/pincodes_master/get_pincodes_by_city/'+city_id, {}, '#ls_pincode', 'Select Pincode');
                }
            });

            // Run preset cascade on page load if preset values exist
            presetCascade();
        });
        </script>
        <?php
    });

    return $html;
}