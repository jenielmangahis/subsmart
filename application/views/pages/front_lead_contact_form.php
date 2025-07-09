<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>nSmarTrac</title>
    <meta content="nSmarTrac" name="description">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="<?= assets_url('plugins/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/main.css'); ?>">
    <!-- Boxicons CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/boxicons.min.css'); ?>">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/bootstrap.min.css'); ?>" crossorigin="anonymous">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/sweetalert2.min.css'); ?>">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo base_url('assets/css/v2/google-font.css'); ?>" rel="stylesheet">
    <style>
    .lead-contact-form-field label{
        font-size : <?= $leadForm && $leadForm->text_size > 0 ? $leadForm->text_size : 12; ?>px;
        font-family : <?= $leadForm && $leadForm->text_font != '' ? $leadForm->text_font : 'Arial, Helvetica, sans-serif'; ?>;
        color : <?= $leadForm && $leadForm->text_color != '' ? $leadForm->text_color : '#000000'; ?>;
    }
    #widget-contact button{
        background-color: <?= $leadForm && $leadForm->button_color != '' ? $leadForm->button_color : '#6a4a86'; ?>;
        color: <?= $leadForm && $leadForm->button_text_color != '' ? $leadForm->button_text_color : '#ffffff'; ?>;
    }
    </style>

    <?php echo put_header_assets(); ?>

    <script type="text/javascript">
      var base_url = '<?php echo base_url(); ?>';
    </script>
</head>

<body>
<div class="container">
  <div class="mt-5" id="widget-container">  
    <form id="widget-contact" method="post">
        <?php foreach($customizeLeadFormsDefault as $form) : ?>
            <?php $field_key = strtolower(str_replace(' ', '_', $form->field)); ?>
            <div id="<?php echo 'pf_'.$field_key; ?>" class="form-group lead-contact-form-field">
                <label><?php echo $form->field; ?></label>
                <span id="<?php echo 'pf_req_'.$field_key; ?>" class="form-required">*</span>
                <input type="<?= $field_key == 'email' ? 'email' : 'text'; ?>" name="<?= $field_key; ?>" class="form-control" required="">
            </div>
        <?php endforeach; ?>
        <?php foreach($customizeLeadForms as $form) : ?>
            <?php $field_key = strtolower(str_replace(' ', '_', $form->field)); ?>
            <?php if( $form->visible == 1 ){ ?>
                <div id="<?php echo 'pf_' . $field_key ?>" class="form-group lead-contact-form-field">
                    <label><?php echo $form->field; ?></label>
                    <?php if( $form->required == 1 ){ ?>
                        <span id="<?php echo 'pf_req_' . $field_key; ?>" class="form-required">*</span>
                    <?php } ?>
                    <input type="text" name="customFields[<?= $field_key; ?>]" class="form-control" <?= $form->required == 1 ? 'required=""' : ''; ?>>
                </div>
            <?php }else{ ?>
                <input type="hidden" name="<?= $field_key; ?>" class="form-control" <?= $form->required == 1 ? 'required=""' : ''; ?>>
            <?php } ?>
            
        <?php endforeach; ?>
        <hr class="card-hr">
        <div class="widget-contact-submit">
            <button type="submit" class="nsm-button primary margin-right" id="btn-widget-contact-save">Send</button>
        </div>
    </form>
  </div>
</div>
<script src="<?php echo base_url('assets/js/v2/jquery-3.6.0.min.js'); ?>"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="<?php echo base_url('assets/js/v2/sweetalert2.min.js'); ?>"></script>     
<script src="<?php echo base_url('assets/js/v2/bootstrap.bundle.min.js'); ?>" crossorigin="anonymous"></script>
<?php echo put_footer_assets(); ?>
<script>
$(function(){
  $('#widget-contact').on('submit', function(e){
      e.preventDefault();

      $.ajax({
          type: "POST",
          url: base_url + "online-leads/<?= $slug; ?>/_save",
          dataType: 'json',
          data: $('#widget-contact').serialize(),
          success: function(data) {    
              $('#btn-widget-contact-save').html('Save');                   
              if (data.is_success) {
                  Swal.fire({
                      text: "Your inquiry was successfully sent",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonText: 'Okay'
                  }).then((result) => {
                      //if (result.value) {
                          $('#widget-contact')[0].reset();
                      //}
                  });                    
              }else{
                  Swal.fire({
                      title: 'Error',
                      text: data.msg,
                      icon: 'error',
                      showCancelButton: false,
                      confirmButtonText: 'Okay'
                  }).then((result) => {
                      
                  });
              }
          },
          beforeSend: function() {
              $('#btn-widget-contact-save').html('<span class="bx bx-loader bx-spin"></span>');
          }
      });
  });
});
</script>
</body>

</html>