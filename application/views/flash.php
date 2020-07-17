<?php if( $this->session->flashdata('message') != '' ){ ?>
<div class="alert <?php echo $this->session->flashdata('alert_class'); ?> alert-dismissible fade show" style="width: 100%;">
  <p><?php echo $this->session->flashdata('message'); ?></p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
<?php } ?>