<div class="form-group">
    <label for="country_id"><?php echo _l($lang_prefix.'country'); ?>*</label>
    <select id="country_id" name="country_id" class="form-control" required>
        <option value=""><?php echo _l($lang_prefix.'select_country'); ?></option>
        <?php if(isset($countries) && is_array($countries)): ?>
            <?php foreach($countries as $country_item): ?>
                <option value="<?php echo $country_item['country_id']; ?>" <?php echo (isset($district) && $district->country_id == $country_item['country_id']) ? 'selected' : set_select('country_id', $country_item['country_id']); ?>>
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
                <option value="<?php echo $state_item['id']; ?>" <?php echo (isset($district) && $district->state_id == $state_item['state_id']) ? 'selected' : set_select('state_id', $state_item['state_id']); ?>>
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
    var selectedStateId = "<?php echo isset($district) ? html_escape($district->state_id) : ''; ?>";
    var selectedCountryId = "<?php echo isset($district) ? html_escape($district->country_id) : ''; ?>";

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
                        if(selectedStateId && state.state_id == selectedStateId) {
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
    <label for="name"> <?php echo _l($lang_prefix.'name'); ?>* </label>
    <input type="text" id="name" name="name" class="form-control" required maxlength="100" value="<?php echo isset($district) ? html_escape($district->name) : set_value('name'); ?>">
    <?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
</div>
