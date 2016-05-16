<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php // display welcome message from admin settings ?>
<?php echo $welcome_message; ?>

<div class="clearfix"></div>
<hr />

<p><?php echo lang('welcome content view_location'); ?></p>
<code>application/views/welcome.php</code>

<div class="clearfix"><br /></div>

<p><?php echo lang('welcome content controller_location'); ?></p>
<code>application/controllers/Welcome.php</code>

<div class="clearfix"><hr /></div>

<p><?php echo lang('welcome content ci_docs'); ?></p>

<div class="clearfix"><hr /></div>

<p><a href="<?php echo base_url('api/users'); ?>"><?php echo lang('welcome content click_here'); ?></a>: <?php echo lang('welcome content sample_api'); ?></p>

<div class="clearfix"><hr /></div>

<p><a href="<?php echo base_url('profile'); ?>"><?php echo lang('welcome content click_here'); ?></a>: <?php echo lang('welcome content sample_profile'); ?></p>
<dl class="dl-horizontal">
    <dt><?php echo lang('welcome content username'); ?>:</dt>
    <dd>johndoe</dd>
    <dt><?php echo lang('welcome content or_email'); ?>:</dt>
    <dd>john@doe.com</dd>
    <dt><?php echo lang('welcome content password'); ?>:</dt>
    <dd>johndoe</dd>
</dl>

<div class="clearfix"><hr /></div>

<p><a href="<?php echo base_url('admin'); ?>"><?php echo lang('welcome content click_here'); ?></a>: <?php echo lang('welcome content sample_editor'); ?></p>
<dl class="dl-horizontal">
    <dt><?php echo lang('welcome content username'); ?>:</dt>
    <dd>editor</dd>
    <dt><?php echo lang('welcome content or_email'); ?>:</dt>
    <dd>editor@editor.com</dd>
    <dt><?php echo lang('welcome content password'); ?>:</dt>
    <dd>editor</dd>
</dl>

<div class="clearfix"><hr /></div>

<p><a href="<?php echo base_url('admin'); ?>"><?php echo lang('welcome content click_here'); ?></a>: <?php echo lang('welcome content sample_admin'); ?></p>
<dl class="dl-horizontal">
    <dt><?php echo lang('welcome content username'); ?>:</dt>
    <dd>admin</dd>
    <dt><?php echo lang('welcome content or_email'); ?>:</dt>
    <dd>admin@admin.com</dd>
    <dt><?php echo lang('welcome content password'); ?>:</dt>
    <dd>admin</dd>
</dl>
