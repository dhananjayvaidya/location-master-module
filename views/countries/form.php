<div class="form-group">
    <label for="short_name"> <?php echo _l($lang_prefix.'short_name'); ?>* </label>
    <input type="text" id="short_name" name="short_name" class="form-control" required maxlength="100" value="<?php echo isset($country) ? html_escape($country->short_name) : set_value('short_name'); ?>">
    <?php echo form_error('short_name', '<small class="text-danger">', '</small>'); ?>
</div>
<div class="form-group">
    <label for="long_name"> <?php echo _l($lang_prefix.'long_name'); ?>* </label>
    <input type="text" id="long_name" name="long_name" class="form-control" required maxlength="255" value="<?php echo isset($country) ? html_escape($country->long_name) : set_value('long_name'); ?>">
    <?php echo form_error('long_name', '<small class="text-danger">', '</small>'); ?>
</div>
<div class="form-group">
    <label for="iso2"> <?php echo _l($lang_prefix.'iso2'); ?> </label>
    <input type="text" id="iso2" name="iso2" class="form-control" maxlength="2" minlength="2" value="<?php echo isset($country) ? html_escape($country->iso2) : set_value('iso2'); ?>">
    <?php echo form_error('iso2', '<small class="text-danger">', '</small>'); ?>
</div>
<div class="form-group">
    <label for="iso3"> <?php echo _l($lang_prefix.'iso3'); ?> </label>
    <input type="text" id="iso3" name="iso3" class="form-control" maxlength="3" minlength="3" value="<?php echo isset($country) ? html_escape($country->iso3) : set_value('iso3'); ?>">
    <?php echo form_error('iso3', '<small class="text-danger">', '</small>'); ?>
</div>
<div class="form-group">
    <label for="calling_code"> <?php echo _l($lang_prefix.'calling_code'); ?> </label>
    <input type="text" id="calling_code" name="calling_code" class="form-control" maxlength="10" value="<?php echo isset($country) ? html_escape($country->calling_code) : set_value('calling_code'); ?>">
    <?php echo form_error('calling_code', '<small class="text-danger">', '</small>'); ?>
</div>