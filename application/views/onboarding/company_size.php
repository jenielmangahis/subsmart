<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/no_menu_header'); ?>
<div role="wrapper">
   <div wrapper__section>
      <div class="col-md-24 col-lg-24 col-xl-18">
         <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            
         <?php echo form_close(); ?>
   </div>
</div>
<?php include viewPath('includes/footer'); ?> 
