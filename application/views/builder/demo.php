<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
   
<?php


function getInputHtml($valueQuestions){


  $questionParameterRequire = (isset($valueQuestions->parameter->required) && $valueQuestions->parameter->required == true) ? 'required' : '' ;

  $questionParameterClass = (isset($valueQuestions->parameter->question_styling_class) && $valueQuestions->parameter->question_styling_class != '') ? $valueQuestions->parameter->question_styling_class : '' ;
  $questionParameterMaxLength = (isset($valueQuestions->parameter->question_styling_maxlength) && $valueQuestions->parameter->question_styling_maxlength != '') ? $valueQuestions->parameter->question_styling_maxlength : '' ;
  $questionParameterBackground = (isset($valueQuestions->parameter->question_styling_background_color) && $valueQuestions->parameter->question_styling_background_color != '') ? $valueQuestions->parameter->question_styling_background_color : '' ;
  $questionParameterColor = (isset($valueQuestions->parameter->question_styling_font_color) && $valueQuestions->parameter->question_styling_font_color != '') ? $valueQuestions->parameter->question_styling_font_color : '' ;
  
  $questionId = 'question_'.$valueQuestions->Questions_id;
  $questionName = 'question['.$valueQuestions->Questions_id.']';


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
        //   echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

        //   echo '<input maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.' " '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';


            echo '<div class="col-sm-4 address-box no-padding">';
                echo '<div class="form-group" id="customer_type_group">';
                    echo '<div class="col-md-12 mt-3" >';
                        echo '<input placeholder="555-555-5555" maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'phone\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="col-sm-2 address-box no-padding">';
                echo '<div class="form-group" id="customer_type_group">';
                    echo '<div class="col-md-12 mt-3" >';
                        echo '<input placeholder="Ext" maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'ext\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="col-sm-2 address-box no-padding">';
                echo '<div class="form-group" id="customer_type_group">';
                    echo '<div class="col-md-12 mt-3 text-right" >';
                        echo '<label for="'.$questionName.'"  style="padding-top: 8px;">Type </label>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="col-sm-4 address-box no-padding">';
                echo '<div class="form-group" id="customer_type_group">';
                    echo '<div class="col-md-12 mt-3" >';
                        echo '<select maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'ext\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"> <option value="-">Select Phone Type</option> <option value="cell">Cell</option> </select>';
                        // echo '<input placeholder="Country" maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'ext\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

          break;
      case "email":
          echo '<label for="'.$questionName.'">'.$valueQuestions->question.' '.(($valueQuestions->description != '')?'<small>('.$valueQuestions->description.')</small>':'').'</label>';

          echo '<input maxlength="'.$questionParameterMaxLength.'" type="email" class="form-control '.$questionParameterClass.'" name="'.$questionName.'" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';

          break;

      case "address":

        $questionName1 = 'question['.$valueQuestions->Questions_id.']['.'address'.']';
        $questionName2 = 'question['.$valueQuestions->Questions_id.']['.'phone'.']';
        
//      


        echo '<div class="col-sm-6 no-padding">';
            echo '<div class="form-group" id="customer_type_group">';
                echo '<div class="col-md-12" >';
                    echo '<input placeholder="Street (Address 1)" maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'address1\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div class="col-sm-6 address-box no-padding">';
            echo '<div class="form-group" id="customer_type_group">';
                echo '<div class="col-md-12" >';
                    echo '<input placeholder="Address 2" maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'address2\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div class="col-sm-4 address-box no-padding">';
            echo '<div class="form-group" id="customer_type_group">';
                echo '<div class="col-md-12 mt-3" >';
                    echo '<input placeholder="City" maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'city\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div class="col-sm-2 address-box no-padding">';
            echo '<div class="form-group" id="customer_type_group">';
                echo '<div class="col-md-12 mt-3" >';
                    echo '<input placeholder="State" maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'state\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div class="col-sm-2 address-box no-padding">';
            echo '<div class="form-group" id="customer_type_group">';
                echo '<div class="col-md-12 mt-3" >';
                    echo '<input placeholder="Zip Code" maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'zipcode\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div class="col-sm-4 address-box no-padding">';
            echo '<div class="form-group" id="customer_type_group">';
                echo '<div class="col-md-12 mt-3" >';
                    echo '<input placeholder="Country" maxlength="'.$questionParameterMaxLength.'" type="text" class="form-control '.$questionParameterClass.'" name="'.$questionName.'[\'country\']" id="'.$questionId.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'"/>';
                echo '</div>';
            echo '</div>';
        echo '</div>';


        //enmding
        
        
        // echo '<div class="col-md-12 form-group">';

        // echo '<div class="col-md-12" style="border:2px solid #98989859;border-radius:5px;float:left;"><h5 class="text-left">'.$valueQuestions->question.'</h5>';
        //     echo '<div class="col-md-2 form-group float-left">';
        //         echo '<label for="Address">Address</label>';
        //         echo '<select name="'.$questionName1.'" id="'.$questionId.'" class="form-control '.$questionParameterClass.'" '.$questionParameterRequire.' style="background:'.$questionParameterBackground.';color:'.$questionParameterColor.'">';
        //             echo '<option value="" >Select Address</option>';
        //             if(isset($basic_details['address'])) {
        //                 foreach($basic_details['address'] as $keyOptions=>$addressOptions)  {
        //                     echo '<option value="'.$addressOptions->address_id.'" >'.$addressOptions->address1.' '.$addressOptions->address2.', '.$addressOptions->city.', '.$addressOptions->state.'. '.$addressOptions->zip.' '.$addressOptions->state.'</option>';
        //                 }
        //             }
        //         echo '</select>';
        // echo '</div>';



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
    //     echo "</div>";
    // echo "</div>";
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
        //     echo '</div>';

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
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to <?php echo $formdetail->form_title; ?>
                                    </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('customer/save', ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>
            <style>

            </style>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            
                        <?php

                            if(isset($formdetail->questions)) {
                                foreach($formdetail->questions as $keyQuestions => $valueQuestions)
                                {  ?>

                                    <?php if( $valueQuestions->q_type == 'group' ) { ?>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3><?php echo $valueQuestions->question; ?></h3>
                                            </div>
                                            

                                            <?php foreach($valueQuestions->questions as $keySubQuestions => $valueSubQuestions) { 
                                                
                                                if($valueSubQuestions->q_type == 'address') { ?>
                                                    
                                                     <!-- <div class="col-sm-12 margin-bottom-ter no-padding"> -->
                                                        <!-- <div class="form-group" id="customer_type_group"> -->
                                                            <!-- <div class="col-md-12"> -->
                                                            <?php getInputHtml($valueSubQuestions); ?>         
                                                            <!-- </div> -->
                                                        <!-- </div> -->
                                                    <!-- </div> -->
                                                    


                                                <?php } else if($valueSubQuestions->q_type == 'phone') { 
                                                    
                                                    getInputHtml($valueSubQuestions);
                                                
                                                } else { ?>

                                                    <div class="<?php echo (isset($valueSubQuestions->parameter->column_width) && $valueSubQuestions->parameter->column_width !='') ? $valueSubQuestions->parameter->column_width : '' ; ?> margin-bottom-ter no-padding">
                                                        <div class="form-group" id="customer_type_group">
                                                            <div class="col-md-12">
                                                                <?php getInputHtml($valueSubQuestions); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                            <?php } ?>
                                        </div>

                                    <?php } ?>

                                    <?php if( $valueQuestions->q_type == 'reperator' ) { ?>



                                    <?php } ?>
                        <?php } } ?>

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

.card-body .margin-bottom-ter {
    margin-bottom:0px !important;
}

.card-body .margin-bottom-ter .form-group {
    margin-bottom:10px !important;
}

.card-body .address-box .form-group {
    margin-bottom:0px !important;
}

</style>