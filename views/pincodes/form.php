<div class="form-group">
    <label for="country_id"><?php echo _l($lang_prefix.'country'); ?>*</label>
    <select id="country_id" name="country_id" class="form-control" required>
        <option value=""><?php echo _l($lang_prefix.'select_country'); ?></option>
        <?php if(isset($countries) && is_array($countries)): ?>
            <?php foreach($countries as $country_item): ?>
                <option value="<?php echo $country_item['country_id']; ?>" <?php echo (isset($pincode) && $pincode->country_id == $country_item['country_id']) ? 'selected' : set_select('country_id', $country_item['country_id']); ?>>
                    <?php echo html_escape($country_item['short_name']); ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <?php echo form_error('country_id', '<small class="text-danger">', '</small>'); ?>
</div>
<div class="form-group">
    <label for="state_id"><?php echo _l($lang_prefix.'state'); ?>*</label>
    <select id="state_id" name="state_id" class="form-control" required>
        <option value=""><?php echo _l($lang_prefix.'select_state'); ?></option>
        <?php if(isset($states) && is_array($states)): ?>
            <?php foreach($states as $state_item): ?>
                <option value="<?php echo $state_item['id']; ?>" <?php echo (isset($pincode) && $pincode->state_id == $state_item['id']) ? 'selected' : set_select('state_id', $state_item['id']); ?>>
                    <?php echo html_escape($state_item['name']); ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <?php echo form_error('state_id', '<small class="text-danger">', '</small>'); ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var countrySelect = document.getElementById('country_id');
    var stateSelect = document.getElementById('state_id');
    var selectedStateId = "<?php echo isset($pincode) ? html_escape($pincode->state_id) : ''; ?>";
    var selectedCountryId = "<?php echo isset($pincode) ? html_escape($pincode->country_id) : ''; ?>";

    function loadStates(countryId, selectedStateId = '') {
        stateSelect.innerHTML = '<option value=""><?php echo _l($lang_prefix.'select_state'); ?></option>';
        if(countryId) {
            fetch('<?php echo base_url('location_master/states_master/get_states_by_country/'); ?>' + countryId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(function(state) {
                        var option = document.createElement('option');
                        option.value = state.id;
                        option.text = state.name;
                        if(selectedStateId && state.id == selectedStateId) {
                            option.selected = true;
                        }
                        stateSelect.appendChild(option);
                    });
                });
        }
    }

    countrySelect.addEventListener('change', function() {
        loadStates(this.value);
    });

    // Auto-select state on edit
    if(selectedCountryId && selectedStateId) {
        loadStates(selectedCountryId, selectedStateId);
    }
});
</script>
<div class="form-group">
    <label for="district_id"><?php echo _l($lang_prefix.'district'); ?>*</label>
    <select id="district_id" name="district_id" class="form-control" required>
        <option value=""><?php echo _l($lang_prefix.'select_district'); ?></option>
        <?php if(isset($districts) && is_array($districts)): ?>
            <?php foreach($districts as $district_item): ?>
                <option value="<?php echo $district_item['id']; ?>" <?php echo (isset($pincode) && $pincode->district_id == $district_item['id']) ? 'selected' : set_select('district_id', $district_item['id']); ?>>
                    <?php echo html_escape($district_item['name']); ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <?php echo form_error('district_id', '<small class="text-danger">', '</small>'); ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var stateSelect = document.getElementById('state_id');
    var districtSelect = document.getElementById('district_id');
    var selectedDistrictId = "<?php echo isset($pincode) ? html_escape($pincode->district_id) : ''; ?>";
    var selectedStateId = "<?php echo isset($pincode) ? html_escape($pincode->state_id) : ''; ?>";

    function loadDistricts(stateId, selectedDistrictId = '') {
        districtSelect.innerHTML = '<option value=""><?php echo _l($lang_prefix.'select_district'); ?></option>';
        if(stateId) {
            fetch('<?php echo base_url('location_master/districts_master/get_districts_by_state/'); ?>' + stateId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(function(district) {
                        var option = document.createElement('option');
                        option.value = district.id;
                        option.text = district.name;
                        if(selectedDistrictId && district.id == selectedDistrictId) {
                            option.selected = true;
                        }
                        districtSelect.appendChild(option);
                    });
                });
        }
    }

    stateSelect.addEventListener('change', function() {
        loadDistricts(this.value);
    });

    // Auto-select district on edit
    if(selectedStateId && selectedDistrictId) {
        loadDistricts(selectedStateId, selectedDistrictId);
    }
});
</script>
<div class="form-group">
    <label for="city_id"><?php echo _l($lang_prefix.'city'); ?>*</label>
    <select id="city_id" name="city_id" class="form-control" required>
        <option value=""><?php echo _l($lang_prefix.'select_city'); ?></option>
        <?php if(isset($cities) && is_array($cities)): ?>
            <?php foreach($cities as $city_item): ?>
                <option value="<?php echo $city_item['id']; ?>" <?php echo (isset($pincode) && $pincode->city_id == $city_item['id']) ? 'selected' : set_select('city_id', $city_item['id']); ?>>
                    <?php echo html_escape($city_item['name']); ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <?php echo form_error('city_id', '<small class="text-danger">', '</small>'); ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var districtSelect = document.getElementById('district_id');
    var citySelect = document.getElementById('city_id');
    var selectedCityId = "<?php echo isset($pincode) ? html_escape($pincode->city_id) : ''; ?>";
    var selectedDistrictId = "<?php echo isset($pincode) ? html_escape($pincode->district_id) : ''; ?>";

    function loadCities(districtId, selectedCityId = '') {
        citySelect.innerHTML = '<option value=""><?php echo _l($lang_prefix.'select_city'); ?></option>';
        if(districtId) {
            fetch('<?php echo base_url('location_master/cities_master/get_cities_by_district/'); ?>' + districtId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(function(city) {
                        var option = document.createElement('option');
                        option.value = city.id;
                        option.text = city.name;
                        if(selectedCityId && city.id == selectedCityId) {
                            option.selected = true;
                        }
                        citySelect.appendChild(option);
                    });
                });
        }
    }

    districtSelect.addEventListener('change', function() {
        loadCities(this.value);
    });

    // Auto-select city on edit
    if(selectedDistrictId && selectedCityId) {
        loadCities(selectedDistrictId, selectedCityId);
    }
});
</script>
<div class="form-group">
    <label for="name"> <?php echo _l($lang_prefix.'name'); ?>* </label>
    <input type="text" id="name" name="name" class="form-control" required maxlength="100" value="<?php echo isset($pincode) ? html_escape($pincode->name) : set_value('name'); ?>">
    <?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
</div>
