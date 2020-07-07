<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style> .form-group label { float: left; } </style>

<?php include viewPath('includes/header'); ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
   

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
                                <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('customer') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Customer
                                    </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

                                      
                                        if( $valueQuestions->q_type != 'group' && $valueQuestions->q_type != 'reperator' ) {
                                
                                        echo '<div class="col-md-6 form-group">';
                                
                                        
                                          getInputHtml ($valueQuestions);
                                
                                        echo '</div>';
                                  
                                        }

                                        if( $valueQuestions->q_type == 'group' ) {
                                          echo '<div class="col-md-12 form-group">';
                                            echo '<div class="col-md-12" style="border:2px solid #16478a;border-radius:5px;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';


                                                                                
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

                                        if( $valueQuestions->q_type == 'reperator' ) {
                                        
                                          $dummyHtml = '';
                                        
                                          echo '<div class="col-md-12 form-group">';
                                            $dummyHtml .= '<div class="col-md-12 reperator_tab" style="border:2px solid #16478a;border-radius:5px;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
                                              echo "<div class='reperator'>";
                                          foreach($valueQuestions->questions as $keySubQuestions => $valueSubQuestions) {
                                            $dummyHtml .= '<div class="col-md-6">';
                                              $dummyHtml .= getInputRepeaterHtml($keySubQuestions, $valueSubQuestions);
                                            $dummyHtml .= '</div>';
                                          }
                                          
                                          $dummyHtml .= '<div class="col-sm-1 text-left actions"><a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> <a class=" col-form-label remove_action" onClick="removeOptions(this)"><i class="fa fa-minus"></i></a></div>';
                                              echo "</div>";

                                          echo $dummyHtml;

                                            echo "</div>";
                                          echo "</div>";

                                        } 
                                        if( $valueQuestions->q_type == 'custom-reperator' ) {
                                        
                                          $dummyHtml = '';
                                        
                                          echo '<div class="col-md-12 form-group">';
                                            $dummyHtml .= '<div class="col-md-12 reperator_tab" style="border:2px solid #16478a;border-radius:5px;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
                                              echo "<div class='reperator'>";
                                          foreach($valueQuestions->questions as $keySubQuestions => $valueSubQuestions) {
                                            $dummyHtml .= '<div class="col-md-6">';
                                              $dummyHtml .= getInputRepeaterHtml($keySubQuestions, $valueSubQuestions);
                                            $dummyHtml .= '</div>';
                                          }
                                          
                                          $dummyHtml .= '<div class="col-sm-1 text-left actions"><a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> <a class=" col-form-label remove_action" onClick="removeOptions(this)"><i class="fa fa-minus"></i></a></div>';
                                              echo "</div>";

                                          echo $dummyHtml;

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

                                      
                                        if( $valueQuestions->q_type != 'group' && $valueQuestions->q_type != 'reperator' ) {
                                
                                        echo '<div class="col-md-6 form-group">';
                                
                                        
                                          getInputHtml ($valueQuestions);
                                
                                        echo '</div>';
                                  
                                        }

                                        if( $valueQuestions->q_type == 'group' ) {
                                          echo '<div class="col-md-12 form-group">';
                                            echo '<div class="col-md-12" style="border:2px solid #16478a;border-radius:5px;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';


                                                                                
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

                                        if( $valueQuestions->q_type == 'reperator' ) {
                                        
                                          $dummyHtml = '';
                                        
                                          echo '<div class="col-md-12 form-group">';
                                            $dummyHtml .= '<div class="col-md-12 reperator_tab" style="border:2px solid #16478a;border-radius:5px;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
                                              echo "<div class='reperator'>";
                                          foreach($valueQuestions->questions as $keySubQuestions => $valueSubQuestions) {
                                            $dummyHtml .= '<div class="col-md-6">';
                                              $dummyHtml .= getInputRepeaterHtml($keySubQuestions, $valueSubQuestions);
                                            $dummyHtml .= '</div>';
                                          }
                                          
                                          $dummyHtml .= '<div class="col-sm-1 text-left actions"><a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> <a class=" col-form-label remove_action" onClick="removeOptions(this)"><i class="fa fa-minus"></i></a></div>';
                                              echo "</div>";

                                          echo $dummyHtml;

                                            echo "</div>";
                                          echo "</div>";

                                        } 
                                        if( $valueQuestions->q_type == 'custom-reperator' ) {
                                        
                                          $dummyHtml = '';
                                        
                                          echo '<div class="col-md-12 form-group">';
                                            $dummyHtml .= '<div class="col-md-12 reperator_tab" style="border:2px solid #16478a;border-radius:5px;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
                                              echo "<div class='reperator'>";
                                          foreach($valueQuestions->questions as $keySubQuestions => $valueSubQuestions) {
                                            $dummyHtml .= '<div class="col-md-6">';
                                              $dummyHtml .= getInputRepeaterHtml($keySubQuestions, $valueSubQuestions);
                                            $dummyHtml .= '</div>';
                                          }
                                          
                                          $dummyHtml .= '<div class="col-sm-1 text-left actions"><a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> <a class=" col-form-label remove_action" onClick="removeOptions(this)"><i class="fa fa-minus"></i></a></div>';
                                              echo "</div>";

                                          echo $dummyHtml;

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
<div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label>Start Date</label>
                        <div class="form-group">
                            <div class='input-group date datepicker'>
                                <input type='text'
                                       value="<?php echo (!empty($event)) ? date('m/d/Y', strtotime($event->start_date)) : '' ?>"
                                       name="start_date" class="form-control" id="datepicker_startdate"/>
                            </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="date_start"
                              data-formerrors-message="true" style="display: none;"></span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div data-calendar="time-start-container">
                            <label>Start Time</label>
                            <div class="form-group">
                                <div class='input-group date timepicker'>
                                    <input type='text' value="<?php echo (!empty($event)) ? $event->start_time : '' ?>"
                                           name="start_time" class="form-control" id="datepicker_starttime"/>
                                </div>
                            </div>
                            <span class="validation-error-field" data-formerrors-for-name="time_start"
                                  data-formerrors-message="true" style="display: none;"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label>End Date</label>
                        <div class="form-group">
                            <div class='input-group date timepicker'>
                                <input type='text'
                                       value="<?php echo (!empty($event)) ? date('m/d/Y', strtotime($event->end_date)) : '' ?>"
                                       name="end_date" class="form-control" id="datepicker_enddate"/>
                            </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="date_end"
                              data-formerrors-message="true" style="display: none;"></span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div data-calendar="time-end-container">
                            <label>End Time</label>
                            <div class="form-group">
                                <div class='input-group date timepicker'>
                                    <input type='text' value="<?php echo (!empty($event)) ? $event->end_time : '' ?>"
                                           name="end_time" class="form-control" id="datepicker_endtime"/>
                                </div>
                            </div>
                            <span class="validation-error-field" data-formerrors-for-name="time_end"
                                  data-formerrors-message="true" style="display: none;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">

            <div class="calendar-modal-datetime-bracket"></div>

          
        </div>
    </div>
            <?php echo form_close(); ?>
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>

<script>

    function addOptions(e)  {
      console.log($(e).parents('.reperator_tab').html());
    }
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