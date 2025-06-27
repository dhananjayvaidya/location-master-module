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
                    <?php echo _l($lang_prefix.'districts'); ?>
                </h4>
            </div>
            <div class="col-md-12">
                <div class="_buttons tw-mb-2">
                    <?php if ($has_permission_create) { ?>
                        <a href="<?php echo admin_url($url_path.'add'); ?>" class="btn btn-primary mright5">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            <?php echo _l('add_new', _l($lang_prefix.'district')); ?>
                        </a>
                    <?php } ?>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <table class="table dt-table">
                            <thead>
                                <tr>
                                    <th><?php echo _l($lang_prefix.'id'); ?></th>
                                    <th><?php echo _l($lang_prefix.'country'); ?></th>
                                    <th><?php echo _l($lang_prefix.'state'); ?></th>
                                    <th><?php echo _l($lang_prefix.'name'); ?></th>
                                    <th><?php echo _l($lang_prefix.'options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($districts as $district) { ?>
                                    <tr>
                                        <td><?php echo $district['id']; ?></td>
                                        <td><?php echo ls_get_country_name($district['country_id']); ?></td>
                                        <td><?php echo ls_get_state_name($district['state_id']); ?></td>
                                        <td><?php echo $district['name']; ?></td>
                                        <td>
                                            <a href="<?php echo admin_url($url_path.'edit/' . $district['id']); ?>" class="btn btn-default btn-icon">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="<?php echo admin_url($url_path.'delete/' . $district['id']); ?>" class="btn btn-danger btn-icon _delete">
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