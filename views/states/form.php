<div class="form-group">
    <label for="country_id"><?php echo _l($lang_prefix.'country'); ?>*</label>
    <select id="country_id" name="country_id" class="form-control" required>
        <option value=""><?php echo _l($lang_prefix.'select_country'); ?></option>
        <?php if(isset($countries) && is_array($countries)): ?>
            <?php foreach($countries as $country_item): ?>
                <option value="<?php echo $country_item['country_id']; ?>" <?php echo (isset($state) && $state->country_id == $country_item['country_id']) ? 'selected' : set_select('country_id', $country_item['country_id']); ?>>
                    <?php echo html_escape($country_item['short_name']); ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <?php echo form_error('country_id', '<small class="text-danger">', '</small>'); ?>
</div>
<div class="form-group">
    <label for="name"> <?php echo _l($lang_prefix.'name'); ?>* </label>
    <input type="text" id="name" name="name" class="form-control" required maxlength="100" value="<?php echo isset($state) ? html_escape($state->name) : set_value('name'); ?>">
    <?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
</div>
