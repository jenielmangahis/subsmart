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


<?php


function getInputHtml($valueQuestions){


  $questionParameterRequire = (isset($valueQuestions->parameter->required) && $valueQuestions->parameter->required == true) ? 'required' : '' ;

  $questionParameterClass = (isset($valueQuestions->parameter->question_styling_class) && $valueQuestions->parameter->question_styling_class != '') ? $valueQuestions->parameter->question_styling_class : '' ;
  $questionParameterMaxLength = (isset($valueQuestions->parameter->question_styling_maxlength) && $valueQuestions->parameter->question_styling_maxlength != '') ? $valueQuestions->parameter->question_styling_maxlength : '' ;
  $questionParameterBackground = (isset($valueQuestions->parameter->question_styling_background_color) && $valueQuestions->parameter->question_styling_background_color != '') ? $valueQuestions->parameter->question_styling_background_color : '' ;
  $questionParameterColor = (isset($valueQuestions->parameter->question_styling_font_color) && $valueQuestions->parameter->question_styling_font_color != '') ? $valueQuestions->parameter->question_styling_font_color : '' ;
  
  $questionId = 'question_'.$valueQuestions->Questions_id;
  $questionName = 'question['.$valueQuestions->Questions_id.']';

  
  switch ($valueQuestions->q_type) {

       case "custom-textbox-input":
        echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

        echo '<input maxlength="'.$questionParameterMaxLength.'" type="date" class="form-control '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

        break;
      case "text":


          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
          echo '<input  maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" autofocus/>';
        
          break;
      
      case "textarea":
       
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
          echo '<textarea maxlength="'.$questionParameterMaxLength.'" name="'.$questionName.'" cols="40" rows="3" class="form-control '.$questionParameterClass.'" style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.';height:unset !important;" autocomplete="off" '.$questionParameterRequire.'></textarea>';
        
          break;
      case "radio":

        echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

        echo '<div style="clear:both;">';
        
        if(isset($valueQuestions->options))
        {
            
            foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                echo '<div class="radio radio-sec margin-right my-0 mr-3 float-left">
                    <input type="radio" name="'.$questionName.'" value="'.$valueOptions->options_id.'" id="'.$questionId.'-option-'.$valueOptions->options_id.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">
                    <label for="'.$questionId.'-option-'.$valueOptions->options_id.'"><span>'.$valueOptions->option_value.'</span></label>
                </div>';
            }
        }
        
        echo '</div>';

          break;
      case "checkbox":

        echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
        echo '<div style="clear:both;">';
        if(isset($valueQuestions->options))
        {
            foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                echo '<div class="checkbox checkbox-sec margin-right my-0 mr-3 float-left">
                        <input type="checkbox" name="'.$questionName.'[]" value="'.$valueOptions->options_id.'" id="'.$questionId.'-option-'.$valueOptions->options_id.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">
                        <label for="'.$questionId.'-option-'.$valueOptions->options_id.'"><span>'.$valueOptions->option_value.'</span></label>
                    </div>';
            }
        }
        echo '</div>';
              break;
      case "dropdown":

        echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
        echo '<select name="'.$questionName.'" id="'.$questionId.'" class="form-control '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
            if(isset($valueQuestions->options))
            {

            foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                echo '<option value="'.$valueOptions->options_id.'" >'.$valueOptions->option_value.'</option>';
            }
            }
        echo '</select>';
              break;
      case "selection":

          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
            
          if($valueQuestions->parameter->selection_type == 'dropdown')
          {
            echo '<select name="'.$questionName.'" id="'.$questionId.'" class="form-control '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
              if(isset($valueQuestions->options))
              {

                foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                  echo '<option value="'.$valueOptions->options_id.'" >'.$valueOptions->option_value.'</option>';
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
                            <input type="radio" name="'.$questionName.'" value="'.$valueOptions->options_id.'" id="'.$questionId.'-option-'.$valueOptions->options_id.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">
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
                            <input type="checkbox" name="'.$questionName.'[]" value="'.$valueOptions->options_id.'" id="'.$questionId.'-option-'.$valueOptions->options_id.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">
                            <label for="'.$questionId.'-option-'.$valueOptions->options_id.'"><span>'.$valueOptions->option_value.'</span></label>
                        </div>';
                }
              }
              echo '</div>';
          }
          
          break;
      
      case "file-upload":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo ' <input type="file" class="form-control '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" placeholder="Upload Image" '.$questionParameterRequire.' accept="image/*" style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" >';

          break;
      case "phone":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo '<input maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.' " '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

          break;
      case "email":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo '<input maxlength="'.$questionParameterMaxLength.'" type="email" class="form-control '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

          break;

      case "address":

        $questionName1 = 'question['.$valueQuestions->Questions_id.']['.'address'.']';
        $questionName2 = 'question['.$valueQuestions->Questions_id.']['.'phone'.']';
        
        echo '<div class="col-md-12 form-group">';

        echo '<div class="col-md-12" style="border:2px solid #98989859;border-radius:5px;float:left;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
            echo '<div class="col-md-2 form-group float-left">';
                echo '<label for="Address">Address</label>';
                echo '<select name="'.$questionName1.'" id="'.$questionId.'" class="form-control '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
                    echo '<option value="" >Select Address</option>';
                    if(isset($basic_details['address'])) {
                        foreach($basic_details['address'] as $keyOptions=>$addressOptions)  {
                            echo '<option value="'.$addressOptions->address_id.'" >'.$addressOptions->address1.' '.$addressOptions->address2.', '.$addressOptions->city.', '.$addressOptions->state.'. '.$addressOptions->zip.' '.$addressOptions->state.'</option>';
                        }
                    }
                echo '</select>';
        echo '</div>';
            // echo '<div class="col-md-12" style="border:2px solid #98989859;border-radius:5px;float:left;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
            //     echo '<div class="col-md-6 form-group float-left">';
            //         echo '<label for="'.$questionName1.'">'.$valueQuestions->question.'</label>';
            //         echo '<select name="'.$questionName1.'" id="'.$questionId.'" class="form-control '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
            //             echo '<option value="" >Select Address</option>';
            //             if(isset($basic_details['address'])) {
            //                 foreach($basic_details['address'] as $keyOptions=>$addressOptions)  {
            //                     echo '<option value="'.$addressOptions->address_id.'" >'.$addressOptions->address1.' '.$addressOptions->address2.', '.$addressOptions->city.', '.$addressOptions->state.'. '.$addressOptions->zip.' '.$addressOptions->state.'</option>';
            //                 }
            //             }
            //         echo '</select>';
            // echo '</div>';

            // echo '<div class="col-md-6 form-group float-left">';
            //     echo '<label for="'.$questionName2.'"> Phone </label>';
            //     echo '<select name="'.$questionName2.'" id="'.$questionId.'" class="form-control '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
            //         echo '<option value="" >Select Phone</option>';
            //         if(isset($basic_details['phones'])) {
            //             foreach($basic_details['phones'] as $keyOptions=>$addressOptions)  {
            //                 echo '<option value="'.$addressOptions->phone_id.'" >'.$addressOptions->number.' - '.$addressOptions->type.'</option>';
            //             }
            //         }
            //     echo '</select>';
            // echo '</div>';
        echo "</div>";
    echo "</div>";
          break;
      case "date-picker":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo '<input maxlength="'.$questionParameterMaxLength.'" type="date" class="form-control '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

          break;
    case "custom-address-input":
        echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

        echo '<input maxlength="'.$questionParameterMaxLength.'" type="date" class="form-control '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

        break;
      
      default:
          echo "";
    }
}

function getInputRepeaterHtml($keySubQuestions, $valueQuestions) {

  $html = '';
  $questionParameterRequire = (isset($valueQuestions->parameter->required) && $valueQuestions->parameter->required == true) ? 'required' : '' ;
  
  $questionParameterClass = (isset($valueQuestions->parameter->question_styling_class) && $valueQuestions->parameter->question_styling_class != '') ? $valueQuestions->parameter->question_styling_class : '' ;
  $questionParameterMaxLength = (isset($valueQuestions->parameter->question_styling_maxlength) && $valueQuestions->parameter->question_styling_maxlength != '') ? $valueQuestions->parameter->question_styling_maxlength : '' ;
  $questionParameterBackground = (isset($valueQuestions->parameter->question_styling_background_color) && $valueQuestions->parameter->question_styling_background_color != '') ? $valueQuestions->parameter->question_styling_background_color : '' ;
  $questionParameterColor = (isset($valueQuestions->parameter->question_styling_font_color) && $valueQuestions->parameter->question_styling_font_color != '') ? $valueQuestions->parameter->question_styling_font_color : '' ;
  
  $questionId = 'question_'.$valueQuestions->Questions_id.'_'.$keySubQuestions;
  $questionName = 'question['.$valueQuestions->Questions_id.'][]';
  switch ($valueQuestions->q_type) {
      case "text":


          $html .= '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
          $html .= '<input maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control reperator-input '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" autofocus/>';
        
          break;
      
      case "textarea":

          $html .= '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
          $html .= '<textarea maxlength="'.$questionParameterMaxLength.'" name="'.$questionName.'" cols="40" rows="3" class="form-control reperator-input '.$questionParameterClass.'" autocomplete="off" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.';height:unset !important;"></textarea>';
        
          break;
      
      case "selection":

          $html .= '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';
          
          if($valueQuestions->parameter->selection_type == 'dropdown')
          {
            $html .= '<select name="'.$questionName.'" id="'.$questionId.'" class="form-control reperator-input '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
              if(isset($valueQuestions->options))
              {
                foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                  $html .= '<option value="'.$valueOptions->options_id.'" >'.$valueOptions->option_value.'</option>';
                }
              }
            $html .= '</select>';
          }

          else if($valueQuestions->parameter->selection_type == 'radio')
          {
              $html .= '<div style="clear:both;">';
              if(isset($valueQuestions->options))
              {
                foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                  $html .= '<div class="radio radio-sec margin-right my-0 mr-3 float-left">
                            <input type="radio" class="reperator-input '.$questionParameterClass.'" name="'.$questionName.'" value="'.$valueOptions->options_id.'" id="'.$questionId.'-option-'.$valueOptions->options_id.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">
                            <label for="'.$questionId.'-option-'.$valueOptions->options_id.'"><span>'.$valueOptions->option_value.'</span></label>
                        </div>';
                }
              }
              $html .= '</div>';
          }

          else if($valueQuestions->parameter->selection_type == 'checkbox')
          {
              $html .= '<div style="clear:both;">';
              if(isset($valueQuestions->options))
              {
                foreach($valueQuestions->options as $keyOptions=>$valueOptions)  {
                  $html .= '<div class="checkbox checkbox-sec margin-right my-0 mr-3 float-left">
                            <input type="checkbox" class="reperator-input '.$questionParameterClass.'" name="'.$questionName.'[]" value="'.$valueOptions->options_id.'" id="'.$questionId.'-option-'.$valueOptions->options_id.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">
                            <label for="'.$questionId.'-option-'.$valueOptions->options_id.'"><span>'.$valueOptions->option_value.'</span></label>
                        </div>';
                }
              }
              $html .= '</div>';
          }
          
          break;
      
      case "file-upload":
          $html .= '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          $html .= ' <input type="file" class="form-control reperator-input '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" placeholder="Upload Image" '.$questionParameterRequire.' accept="image/*" style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" >';

          break;
      case "phone":
          $html .= '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          $html .= '<input maxlength="'.$questionParameterMaxLength.'" type="text" class="contact_phone form-control reperator-input '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.' " '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

          break;
      case "email":
          $html .= '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          $html .= '<input maxlength="'.$questionParameterMaxLength.'" type="email" class="form-control reperator-input '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

          break;

      case "address":
        //   $html .= '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

        //   $html .= '<input maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control reperator-input '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
        $questionName1 = 'question['.$valueQuestions->Questions_id.']['.'address'.']';
        $questionName2 = 'question['.$valueQuestions->Questions_id.']['.'phone'.']';
        
        echo '<div class="col-md-12 form-group">';
        echo '<div class="col-md-12" style="border:2px solid #98989859;border-radius:5px;float:left;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
            echo '<div class="col-md-6 form-group float-left">';
                echo '<label for="'.$questionName1.'">'.$valueQuestions->question.'</label>';
                echo '<select name="'.$questionName1.'" id="'.$questionId.'" class="form-control '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
                    echo '<option value="" >Select Address</option>';
                    if(isset($basic_details['address'])) {
                        foreach($basic_details['address'] as $keyOptions=>$addressOptions)  {
                            echo '<option value="'.$addressOptions->address_id.'" >'.$addressOptions->address1.' '.$addressOptions->address2.', '.$addressOptions->city.', '.$addressOptions->state.'. '.$addressOptions->zip.' '.$addressOptions->state.'</option>';
                        }
                    }
                echo '</select>';
            echo '</div>';

            // echo '<div class="col-md-6 form-group float-left">';
            //     echo '<label for="'.$questionName2.'"> Phone </label>';
            //     echo '<select name="'.$questionName2.'" id="'.$questionId.'" class="form-control '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
            //         echo '<option value="" >Select Phone</option>';
            //         if(isset($basic_details['phones'])) {
            //             foreach($basic_details['phones'] as $keyOptions=>$addressOptions)  {
            //                 echo '<option value="'.$addressOptions->phone_id.'" >'.$addressOptions->number.' - '.$addressOptions->type.'</option>';
            //             }
            //         }
            //     echo '</select>';
            // echo '</div>';
        echo "</div>";
    echo "</div>";
          break;
      case "date-picker":
          $html .= '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          $html .= '<input maxlength="'.$questionParameterMaxLength.'" type="date" class="form-control reperator-input '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

          break;
    case "custom-address-input":
        $html .= '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

        $html .= '<input maxlength="'.$questionParameterMaxLength.'" type="date" class="form-control reperator-input '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

        break;
      default:
          $html .= "";
    }

    return $html;
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

                                        if( $valueQuestions->q_type != 'group' && $valueQuestions->q_type != 'reperator'  && $valueQuestions->q_type != 'address' ) {
                                            echo '<div class="col-md-6 form-group">';
                                            getInputHtml ($valueQuestions);
                                            echo '</div>';
                                        }

                                        if( $valueQuestions->q_type == 'group' ) {
                                            echo '<div class="col-md-12 form-group">';
                                            echo '<div class="col-md-12" style="border:2px solid #98989859;border-radius:5px;float:left;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
                                
                                          foreach($valueQuestions->questions as $keySubQuestions => $valueSubQuestions)
                                          {
                                            echo '<div class="col-md-6 form-group float-left">';
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
                                            $dummyHtml .= '<div class="col-md-12 form-group float-left">';
                                            $dummyHtml .= '<div class="col-md-12 float-left reperator_tab_div_'.$valueQuestions->Questions_id.'" style="border:2px solid #16478a;border-radius:5px;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
                                            $dummyHtml .= "<div class='reperator float-left w-100 mb-3' style='clear:both;'>";
                                          
                                            foreach($valueQuestions->questions as $keySubQuestions => $valueSubQuestions) {
                                                $dummyHtml .= '<div class="col-md-5 float-left" style="width:47%">';
                                                $dummyHtml .= getInputRepeaterHtml($keySubQuestions, $valueSubQuestions);
                                                $dummyHtml .= '</div>';
                                            }
                                          
                                            $dummyHtml .= '<div class="col-sm-1 text-left actions float-left mt-4 pt-2 pb-2 pull-right" style="width:5%"><label style="clear:both;">&nbsp;</label><a class=" col-form-label add_action" onClick="addOptions(this,\'reperator_tab_div_'.$valueQuestions->Questions_id.'\')" ><i class="fa fa-plus"></i></a> <a class=" col-form-label remove_action" onClick="removeOptions(this)"><i class="fa fa-minus"></i></a></div>';
                                            $dummyHtml .= "</div>";

                                            echo $dummyHtml;
                                            echo "</div>";
                                            echo "</div>";
                                        }

                                        if( $valueQuestions->q_type == 'address' ) {


                                            $questionParameterRequire = (isset($valueQuestions->parameter->required) && $valueQuestions->parameter->required == true) ? 'required' : '' ;
  
                                            $questionParameterClass = (isset($valueQuestions->parameter->question_styling_class) && $valueQuestions->parameter->question_styling_class != '') ? $valueQuestions->parameter->question_styling_class : '' ;
                                            $questionParameterMaxLength = (isset($valueQuestions->parameter->question_styling_maxlength) && $valueQuestions->parameter->question_styling_maxlength != '') ? $valueQuestions->parameter->question_styling_maxlength : '' ;
                                            $questionParameterBackground = (isset($valueQuestions->parameter->question_styling_background_color) && $valueQuestions->parameter->question_styling_background_color != '') ? $valueQuestions->parameter->question_styling_background_color : '' ;
                                            $questionParameterColor = (isset($valueQuestions->parameter->question_styling_font_color) && $valueQuestions->parameter->question_styling_font_color != '') ? $valueQuestions->parameter->question_styling_font_color : '' ;
                                            
                                            $questionId = 'question_'.$valueQuestions->Questions_id;
                                            $questionName1 = 'question['.$valueQuestions->Questions_id.']['.'address'.']';
                                            $questionName2 = 'question['.$valueQuestions->Questions_id.']['.'street'.']';
                                            $questionName3 = 'question['.$valueQuestions->Questions_id.']['.'city'.']';
                                            $questionName4 = 'question['.$valueQuestions->Questions_id.']['.'state'.']';
                                            $questionName5 = 'question['.$valueQuestions->Questions_id.']['.'zip'.']';
                                            $questionName6 = 'question['.$valueQuestions->Questions_id.']['.'phone'.']';

                                            echo '<div class="col-md-12 form-group">';
                                                echo '<div class="col-md-12" style="border:2px solid #98989859;border-radius:5px;float:left;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
                                                    echo '<div class="col-md-3 form-group float-left">';
                                                        echo '<label for="'.$questionName1.'">Address</label>';
                                                        echo '<input type="text" class="form-control reperator-input " name="'.$questionName1.'" id="'.$questionId.'" required style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" autofocus/>';
                                                    echo '</div>';

                                                    echo '<div class="col-md-2 form-group float-left">';
                                                        echo '<label for="'.$questionName2.'">Street</label>';
                                                        echo '<input type="text" class="form-control reperator-input " name="'.$questionName2.'" id="'.$questionId.'" required style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" autofocus/>';
                                                    echo '</div>';

                                                    echo '<div class="col-md-2 form-group float-left">';
                                                        echo '<label for="'.$questionName3.'">City</label>';
                                                        echo '<input type="text" class="form-control reperator-input " name="'.$questionName3.'" id="'.$questionId.'" required style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" autofocus/>';
                                                    echo '</div>';

                                                    echo '<div class="col-md-2 form-group float-left">';
                                                        echo '<label for="'.$questionName4.'">State</label>';
                                                        echo '<input type="text" class="form-control reperator-input " name="'.$questionName4.'" id="'.$questionId.'" required style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" autofocus/>';
                                                    echo '</div>';

                                                    echo '<div class="col-md-1 form-group float-left">';
                                                        echo '<label for="'.$questionName5.'">Zip</label>';
                                                        echo '<input type="text" class="form-control reperator-input " name="'.$questionName5.'" id="'.$questionId.'" required style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" autofocus/>';
                                                    echo '</div>';

                                                    echo '<div class="col-md-1 form-group float-left">';
                                                        echo '<label for="'.$questionName6.'">Phone</label>';
                                                        echo '<input type="text" class="form-control reperator-input" name="'.$questionName6.'" id="'.$questionId.'" required style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'" autofocus/>';
                                                    echo '</div>';

                                                    // echo '<div class="col-md-6 form-group float-left">';
                                                    //     echo '<label for="'.$questionName2.'"> Phone </label>';
                                                    //     echo '<select name="'.$questionName2.'" id="'.$questionId.'" class="form-control '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
                                                    //         echo '<option value="" >Select Phone</option>';
                                                    //         if(isset($basic_details['phones'])) {
                                                    //             foreach($basic_details['phones'] as $keyOptions=>$addressOptions)  {
                                                    //                 echo '<option value="'.$addressOptions->phone_id.'" >'.$addressOptions->number.' - '.$addressOptions->type.'</option>';
                                                    //             }
                                                    //         }
                                                    //     echo '</select>';
                                                    // echo '</div>';
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

    function addOptions (e,id)  {
      var dummy_html = $(e).parents('.reperator').html();
      $('.'+id).append("<div class='reperator float-left w-100 mb-3'>"+dummy_html+"</div>");
    }
    
    function removeOptions (e)  {
      $(e).parents('.reperator').remove();
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

function phoneMask(e){
    var s=e.val();
    var s=s.replace(/[_\W]+/g,'');
    var n=s.length;
    if(n<11){var m='(00) 0000-00000';}else{var m='(00) 00000-00000';}
    $(e).mask(m);
}
</script>
<style>
.select2-container--open { z-index: 0; }
span.select2-selection.select2-selection--single { font-size: 16px; }
.form-group { margin-bottom: 20px !important; }
</style>