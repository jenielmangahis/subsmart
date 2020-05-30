<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style> .form-group label { float: left; } </style>

<?php include viewPath('includes/header'); ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><?php echo $formdetail->form_title; ?></h1>
                        <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add your new customer.</li>
                        </ol> -->
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('customer') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Customer
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<?php


function getInputHtml($valueQuestions){


  $questionParameterRequire = (isset($valueQuestions->parameter->required) && $valueQuestions->parameter->required == true) ? 'required' : '' ;
  
  $questionId = 'question_'.$valueQuestions->Questions_id;
  $questionName = 'question['.$valueQuestions->Questions_id.']';
  switch ($valueQuestions->q_type) {
      case "text":


          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
          echo '<input type="text" class="form-control" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' autofocus/>';
        
          break;
      
      case "textarea":
       
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
          echo '<textarea name="'.$questionName.'" cols="40" rows="3" class="form-control" autocomplete="off" '.$questionParameterRequire.'></textarea>';
        
          break;
      
      case "selection":

          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
          
          if($valueQuestions->parameter->selection_type == 'dropdown')
          {
            echo '<select name="'.$questionName.'" id="'.$questionId.'" class="form-control" '.$questionParameterRequire.'>';
              if(isset($valueQuestions->options))
              {
                foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                  echo '<option value="'.$valueOptions->options_id.'" >'.$valueOptions->options.'</option>';
                }
              }
            echo '</select>';
          }

          else if($valueQuestions->parameter->selection_type == 'radio')
          {
              echo '<div style="clear:both;">';
              if(isset($valueQuestions->options))
              {
                foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                  echo '<div class="radio radio-sec margin-right my-0 mr-3 float-left">
                            <input type="radio" name="'.$questionName.'" value="'.$valueOptions->options_id.'" id="'.$questionId.'-option-'.$valueOptions->options_id.'" '.$questionParameterRequire.'>
                            <label for="'.$questionId.'-option-'.$valueOptions->options_id.'"><span>'.$valueOptions->option_value.'</span></label>
                        </div>';
                }
              }
              echo '</div>';
          }

          else if($valueQuestions->parameter->selection_type == 'checkbox')
          {
              echo '<div style="clear:both;">';
              if(isset($valueQuestions->options))
              {
                foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                  echo '<div class="checkbox checkbox-sec margin-right my-0 mr-3 float-left">
                            <input type="checkbox" name="'.$questionName.'[]" value="'.$valueOptions->options_id.'" id="'.$questionId.'-option-'.$valueOptions->options_id.'" '.$questionParameterRequire.'>
                            <label for="'.$questionId.'-option-'.$valueOptions->options_id.'"><span>'.$valueOptions->option_value.'</span></label>
                        </div>';
                }
              }
              echo '</div>';
          }
          
          break;
      
      case "file-upload":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo ' <input type="file" class="form-control" name="'.$questionName.'" id="'.$questionId.'" placeholder="Upload Image" '.$questionParameterRequire.' accept="image/*" >';

          break;
      case "phone":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo '<input type="text" class="form-control" name="'.$questionName.'" id="'.$questionId.' " '.$questionParameterRequire.'/>';

          break;
      case "email":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo '<input type="email" class="form-control" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.'/>';

          break;

      case "address":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo '<input type="text" class="form-control" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.'/>';

          break;
      case "date-picker":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo '<input type="date" class="form-control" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.'/>';

          break;
      default:
          echo "Your favorite color is neither red, blue, nor green!";
    }
}
?>
            <!-- end row -->

            <?php echo form_open_multipart('builder/saveFormResponse', ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>

            <input type="hidden" name="form_id" value="<?php echo $formdetail->forms_id; ?>">
            <input type="hidden" name="job_id" value="0">

            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-md-12">
                                    <h3>sfsdf</h3>
                                </div> -->
                                <?php

                                if(isset($formdetail->questions)) {


                                    foreach($formdetail->questions as $keyQuestions => $valueQuestions)
                                    {

                                      
                                        if( $valueQuestions->q_type != 'group' ) {
                                
                                        echo '<div class="col-md-6 form-group">';
                                
                                        
                                          getInputHtml ($valueQuestions);
                                
                                        echo '</div>';
                                  
                                        }

                                        if( $valueQuestions->q_type == 'group' ) {
                                          echo '<div class="col-md-12 form-group">';
                                            echo '<div class="col-md-12" style="border:2px solid #16478a;border-radius:5px;"><h5 class="text-left">sfsd</h5>';


                                                                                
                                          foreach($valueQuestions->questions as $keySubQuestions => $valueSubQuestions)
                                          {
                                            echo '<div class="col-md-6 form-group">';
                                            // echo "<pre>";
                                            // print_r($valueSubQuestions);
                                           // echo "</pre>";
                                            getInputHtml ($valueSubQuestions);
                                          
                                            echo '</div>';
                                          }
                                            echo "</div>";
                                          echo "</div>";
                                        }

                                    }
                                }
                                ?>
                                  
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                    <a href="<?php echo url('customer') ?>" class="btn btn-danger">Cancel this</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <?php echo form_close(); ?>
           
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>

<script>

    document.getElementById('contact_mobile').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
    document.getElementById('contact_phone').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }


     $(document).ready(function() {
             $("input[name=birthday]").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });
    
    $("input[name=birthday]").keyup(function(event){
        console.log($(this).val());
        if ($(this).val().length == 2){
            $(this).val($(this).val() + "/");
        }else if ($(this).val().length == 5){
            $(this).val($(this).val() + "/");
        }
    });
    
});
</script>
<style>
 .select2-container--open{       z-index: 0;}
 span.select2-selection.select2-selection--single {
    font-size: 16px;
}
</style>