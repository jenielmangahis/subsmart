<head>
  <title><?= $form->forms_title?> | nSmarTrac Form</title>
  <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  
  <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />

  <div class="container">
    <div class="card">
      <div class="card-body">
        
        
          <?= form_open_multipart('form/submit/'.$form->forms_id, array("id" => "formMain"));?>
            <div id="windowPreviewcontent" class="row">
            </div>

            
          <button type="submit" id="btnFormSubmit" class="btn btn-success btn-block"><i class="fa fa-arrow-circle-up"></i> Submit</button>
          <button class="btn btn-link btn-block text-muted">I want to answer this form from scratch again</button>
        <?= form_close();?>
      </div>

    </div>
  </div>


  <script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="<?= base_url()?>/assets/js/formbuilder.js"></script>
  <script>
    window.onload = () => {
      loadFormElements(<?= $form->forms_id?>);
    }

    

  </script>
</body>
