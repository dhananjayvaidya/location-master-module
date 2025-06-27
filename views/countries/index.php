<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); 
$has_permission_edit   = staff_can('edit', $permission_name);
$has_permission_create = staff_can('create', $permission_name);
?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 tw-mb-3">
                <h4 class="tw-my-0 tw-font-bold tw-text-xl">
                    <?php echo _l($lang_prefix.'countries'); ?>
                </h4>
            </div>
            <div class="col-md-12">
                <div class="_buttons tw-mb-2">
                    <?php if ($has_permission_create) { ?>
                        <a href="<?php echo admin_url($url_path.'add'); ?>" class="btn btn-primary mright5">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            <?php echo _l('add_new', _l($lang_prefix.'country')); ?>
                        </a>
                    <?php } ?>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <table class="table dt-table">
                            <thead>
                                <tr>
                                    <th><?php echo _l($lang_prefix.'id'); ?></th>
                                    <th><?php echo _l($lang_prefix.'short_name'); ?></th>
                                    <th><?php echo _l($lang_prefix.'long_name'); ?></th>
                                    <th><?php echo _l($lang_prefix.'iso2'); ?></th>
                                    <th><?php echo _l($lang_prefix.'iso3'); ?></th>
                                    <th><?php echo _l($lang_prefix.'calling_code'); ?></th>
                                    <th><?php echo _l($lang_prefix.'options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($countries as $country) { ?>
                                    <tr>
                                        <td><?php echo $country['country_id']; ?></td>
                                        <td><?php echo $country['short_name']; ?></td>
                                        <td><?php echo $country['long_name']; ?></td>
                                        <td><?php echo $country['iso2']; ?></td>
                                        <td><?php echo $country['iso3']; ?></td>
                                        <td><?php echo $country['calling_code']; ?></td>
                                        <td>
                                            <a href="<?php echo admin_url($url_path.'edit/' . $country['country_id']); ?>" class="btn btn-default btn-icon">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="<?php echo admin_url($url_path.'delete/' . $country['country_id']); ?>" class="btn btn-danger btn-icon _delete">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>