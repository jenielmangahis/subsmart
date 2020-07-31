<!--check expenses page-->
<?php if ($this->session->flashdata('checked')){?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('checked');?>
    </div>
<?php }elseif ($this->session->flashdata('check_failed')){?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('check_failed');?>
    </div>
<?php }elseif ($this->session->flashdata('checked_updated')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('checked_updated');?>
    </div>
<?php }elseif ($this->session->flashdata('checked_up_failed')){?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('checked_up_failed');?>
    </div>
<?php }?>