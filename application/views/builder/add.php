<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/css/jquery.ui.css">
<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/css/app.css">
<!-- <link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/basscss.css"> -->
<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/seconds-part/css/form_builder.css"/>
<style>
    .form-control { height: 34px !important; }
    .input-main-box:not(:first-child) {  margin-top:9px; }  
    #main-drag-and-drop-area { font-size: 1.1em !important; }
    .column { width: 100%; float: left; padding-bottom: 30px; }
    .portlet { margin: 1em 0em 1em 0; padding: 0.3em 0em 0.3em 0em; }
    .portlet-content { padding: 0.4em; /* border: 1px solid #cccccc; */ }
    .input-draggable-parent-div { padding-top: 20px; padding-bottom: 20px; }
    .col-form-label { line-height: 26px; font-weight: 0px !important; font-size: 15px;  }
    .portlet-toggle {position: absolute; top: 20%; right: 10px; margin-top: -8px; }
    .portlet-header { padding: 0.2em 0.3em; /* margin-bottom: 0.5em; */ position: relative; }
    .input-main-box { width:100%; border: 1px solid #cccccc; padding:15px 5px 15px 3px; background:#cccccc85; }
    .input-draggable-parent-child-div { padding-top:25px; min-height: 50px; padding-bottom:25px; }
    .portlet-placeholder { border: 1px dotted black; margin: 1em 1em 1em 0; height: 90px; width:100%; background: #cccccc; }
    .option_div .option .actions .add_action{ padding: 3px 6px; background: green; border-radius: 50px; }
    .option_div .option .actions .remove_action{ padding: 3px 6px; background: red; border-radius: 50px; }
    .wrapper {
    padding: 0px;
    padding-top: 68px;
} .form_builder_field {
    width: 100% !important;
    border-radius: 15px;
    border: 2px solid #ddd;
  }
  .form_builder_area .form_builder_field .form_output .form-group {
        margin-bottom: 10px !important;
  }
</style>
<!-- page wrapper start -->
<div class="wrapper">

  <!--<div class="col-sm-12">
    <div class="row">
      <label class="col-sm-1 col-form-label text-right">Form Edit</label>
      <div class="col-sm-5">
        <select class="form-control" name="custome_forms">
          <option value="new">New Form</option>
          <?php foreach($forms as $job) { ?>
            <option value="<?php echo $job->forms_id; ?>" <?php echo (isset($selected_form_id) && $selected_form_id > 0 && $selected_form_id == $job->forms_id)?'selected="selected"':''; ?>><?php echo $job->form_title; ?></option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" onClick="getFormData()">  Go </button>
      <a class="ml-3 mt-3 d-none" id="preview_url_formbuilder" href="<?php echo base_url('builder/demo/13'); ?>">Click to preview</a>
    </div>
  </div>
  <div class="col-sm-12 ">
    <div class="form-group row ">
      <label class="col-sm-1 col-form-label text-right">Form Title</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="custom_forms_title">
      </div>
      <label class="col-sm-1 col-form-label text-right">Add to</label>
      <div class="col-sm-2">
        <select class="form-control" >
          <?php foreach($jobs as $job) { ?>
            <option value="<?php echo $job->jobs_id; ?>"><?php echo $job->job_name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>-->
  <input type="hidden" id="deletedQuestions" value="">
  <div class="form_builder">
    <div class="col-sm-12 mb-5 pl-0 pr-0">
      <div class="col-sm-2" style="background:#32243d;height: 735px;position:fixed;">
        <nav class="nav-sidebar border border-dark mt-2">
          <ul class="nav pt-2">
              <li class="form_bal_textfield">
                  <a href="javascript:;">Text Field <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
              <li class="form_bal_textarea">
                  <a href="javascript:;">Text Area <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
              <li class="form_bal_radio">
                  <a href="javascript:;">Radio Button <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
              <li class="form_bal_checkbox">
                  <a href="javascript:;">Checkbox <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
              <li class="form_bal_select">
                  <a href="javascript:;">Dropdown <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
              <li class="form_bal_fileupload">
                  <a href="javascript:;">File Upload <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
              <li class="form_bal_phone">
                  <a href="javascript:;">Phone <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
              <li class="form_bal_email">
                  <a href="javascript:;">Email <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
              <li class="form_bal_address">
                  <a href="javascript:;">Address <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
              <!-- <li class="form_bal_password">
                  <a href="javascript:;">Password <i class="fa fa-plus-circle pull-right"></i></a>
              </li> -->
              <li class="form_bal_date">
                  <a href="javascript:;">Date <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
          </ul>
      </nav>
      </div>
      <div class="col-sm-10 border border-dark p-0" style="min-height: 735px;background:white;float:right;">

            
          <div class="p-1 pt-4 mt-0" style="border:1px solid #80808057;">
            <div class="row">
              <label class="col-sm-1 col-form-label text-right">Form Edit</label>
              <div class="col-sm-5">
                <select class="form-control" name="custome_forms">
                  <option value="new">New Form</option>
                  <?php foreach($forms as $job) { ?>
                    <option value="<?php echo $job->forms_id; ?>" <?php echo (isset($selected_form_id) && $selected_form_id > 0 && $selected_form_id == $job->forms_id)?'selected="selected"':''; ?>><?php echo $job->form_title; ?></option>
                  <?php } ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary" onClick="getFormData()">  Go </button>
              <a class="ml-3 mt-3 d-none" id="preview_url_formbuilder" href="<?php echo base_url('builder/demo/13'); ?>">Click to preview</a>
            </div>
            <div class="form-group row mt-3" style="margin-bottom: 10px !important;">
              <label class="col-sm-1 col-form-label text-right">Form Title</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="custom_forms_title">
              </div>
              <label class="col-sm-1 col-form-label text-right">Add to</label>
              <div class="col-sm-2">
                <select class="form-control" >
                  <?php foreach($jobs as $job) { ?>
                    <option value="<?php echo $job->jobs_id; ?>"><?php echo $job->job_name; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-sm-1">
                <button onclick="saveForm()" class="pull-right ml-2 btn btn-success">Save Form</button>
              </div>
            </div>
          </div>
          <button onclick="addGroup()" class="pull-left btn btn-default">Add Group</button>
          <button onclick="addGroupRepeater()" class="pull-left ml-2 btn btn-default">Add Repeater</button>
          
          <div id="main-drag-and-drop-area" class="portlet-content input-draggable-parent-div connectedSortable p-3 pb-5" style="height:auto;min-height: 580px;padding: 24px !important;margin-top:33px;">

           
          </div>
         
      </div>
    </div>
  </div>  
</div>

<!-- page wrapper end -->

<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/js/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/js/template.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/js/app.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/html5sortable.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/js/jquery.simulate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/draggable/1.0.0-beta.9/draggable.bundle.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- <script src="<?php echo $url->assets ?>formbuilder/seconds-part/js/form_builder.js"></script> -->


<script>

var styling_var = '<div class="col-sm-2 text-right"> style="padding-right:32px !important;" <a href="#" onclick="showHide(this)">Styling</a> </div><div class="col-sm-12 styling pt-5 d-none"><label class="col-sm-1 col-form-label text-right"></label><label class="col-sm-11 col-form-label text-left" style="font-size: 19px;font-weight: bold;">Styling</label><label class="col-sm-2 col-form-label text-right">Class</label><div class="col-sm-3 text-left"><input class="w-100" type="text" value="" name="question_styling_class"></div></div>';

  function showHide(e) {
    
    if($(e).parents('.input-main-box').find('.styling').hasClass('d-none') == false) {
      $(e).parents('.input-main-box').find('.styling').addClass('d-none');
    } else {
      $(e).parents('.input-main-box').find('.styling').removeClass('d-none');
    }
    // if($(e).parent('div').parent('div').find('.styling').hasClass('d-none') == false) {
    //   $(e).parent('div').parent('div').find('.styling').addClass('d-none');
    // } else {
    //   $(e).parent('div').parent('div').find('.styling').removeClass('d-none');
    // }
    // if($(e).parent('div').parent('div').find('.styling').css('display') == 'none')
    //   $(e).parent('div').parent('div').find('.styling').show();
    // else 
    //   $(e).parent('div').parent('div').find('.styling').hide();
  }
    if("<?php echo (isset($selected_form_id) && $selected_form_id > 0)? true : false ; ?>" ==true)
    {
      getFormData(); 
    }
    function getFormData() {
      
      $('#main-drag-and-drop-area').html('');
      var form_id = $( "select[name='custome_forms'] option:selected" ).val();
      //alert($('select[name="custome_forms"] option:selected').val());
      if( form_id == 'new')
      {
        $('#preview_url_formbuilder').addClass('d-none');
        $('input[name="custom_forms_title"]').val(''); 
      } else {
       
        $('#preview_url_formbuilder').removeClass('d-none');
        $('#preview_url_formbuilder').attr('href','<?php echo base_url('builder/demo/'); ?>'+form_id);
        $.ajax({
          type: "GET",
          url: "<?php echo base_url() ?>" + "builder/formdetail/"+form_id,
          data: {},
          success: function(data) {

            var result = jQuery.parseJSON(data);
            console.log(result);
            if(data != '') {
              console.log();
              $('input[name="custom_forms_title"]').val(result.form_title); 

              $.each(result.questions, function( index, value ) {
                
                //
                var question_sub = "";
                if(value.parent_question > 0)
                { 
                  question_sub = ' .question-box-'+value.parent_question + ' .input-draggable-parent-child-div';
                }

                if(value.q_type == 'text') {
                  var question_styling_background_color = value.parameter['question_styling_background_color'];
                  var question_styling_font_color = value.parameter['question_styling_font_color'];
                  $('#main-drag-and-drop-area ' + question_sub).append(getTextFieldHTML(value.Questions_id,value.question,value.description,value.parameter['required'],value.parameter['encrypt'],value.parameter['question_styling_class'],value.parameter['question_styling_maxlength'],question_styling_background_color,question_styling_font_color));
                } else if(value.q_type == 'textarea') {
                  var question_styling_background_color = value.parameter['question_styling_background_color'];
                  var question_styling_font_color = value.parameter['question_styling_font_color'];
                  $('#main-drag-and-drop-area ' + question_sub).append(getTextAreaFieldHTML(value.Questions_id,value.question,value.description,value.parameter['required'],value.parameter['encrypt'],value.parameter['limit'],value.parameter['limit_range'],value.parameter['reachtextboxformatting'],value.parameter['question_styling_class'],value.parameter['question_styling_maxlength'],question_styling_background_color,question_styling_font_color));
                } else if(value.q_type == 'radio' || value.q_type == 'checkbox' || value.q_type == 'dropdown') {

                  // question_id = '0', question_label = '', question_description = '', question_required = false, allow_other = false, selection_type = 'dropdown', options = [], question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000'
                  
                  var question_styling_background_color = value.parameter['question_styling_background_color'];
                  var question_styling_font_color = value.parameter['question_styling_font_color'];
                  $('#main-drag-and-drop-area ' + question_sub).append(getSelectionFieldHTML(value.Questions_id,value.question,value.description,value.parameter['required'],value.parameter['allow_other'],value.q_type,value.options,value.parameter['question_styling_class'],value.parameter['question_styling_maxlength'],question_styling_background_color,question_styling_font_color));
                } else if(value.q_type == 'file-upload') {
                  var question_styling_background_color = value.parameter['question_styling_background_color'];
                  var question_styling_font_color = value.parameter['question_styling_font_color'];
                  $('#main-drag-and-drop-area ' + question_sub).append(getFileUploadFieldHTML(value.Questions_id,value.question,value.description,value.parameter['required'],value.parameter['question_styling_class'],value.parameter['question_styling_maxlength'],question_styling_background_color,question_styling_font_color));
                } else if(value.q_type == 'phone') {
                  var question_styling_background_color = value.parameter['question_styling_background_color'];
                  var question_styling_font_color = value.parameter['question_styling_font_color'];
                  $('#main-drag-and-drop-area ' + question_sub).append(getPhoneFieldHTML(value.Questions_id,value.question,value.description,value.parameter['required'],value.parameter['extension'],value.parameter['phone_type_selector'],value.parameter['question_styling_class'],value.parameter['question_styling_maxlength'],question_styling_background_color,question_styling_font_color));
                } else if(value.q_type == 'email') {
                  var question_styling_background_color = value.parameter['question_styling_background_color'];
                  var question_styling_font_color = value.parameter['question_styling_font_color'];
                  $('#main-drag-and-drop-area ' + question_sub).append(getEmailFieldHTML(value.Questions_id,value.question,value.description,value.parameter['required'],value.parameter['question_styling_class'],value.parameter['question_styling_maxlength'],question_styling_background_color,question_styling_font_color));
                } else if(value.q_type == 'address') {
                  var question_styling_background_color = value.parameter['question_styling_background_color'];
                  var question_styling_font_color = value.parameter['question_styling_font_color'];
                  $('#main-drag-and-drop-area ' + question_sub).append(getAddressFieldHTML(value.Questions_id,value.question,value.description,value.parameter['required'],value.parameter['country_input'],value.parameter['question_styling_class'],value.parameter['question_styling_maxlength'],question_styling_background_color,question_styling_font_color));
                } else if(value.q_type == 'date-picker') {
                  var question_styling_background_color = value.parameter['question_styling_background_color'];
                  var question_styling_font_color = value.parameter['question_styling_font_color'];
                  $('#main-drag-and-drop-area ' + question_sub).append(getDatePickerFieldHTML(value.Questions_id,value.question,value.description,value.parameter['required'],value.parameter['question_styling_class'],value.parameter['question_styling_maxlength'],question_styling_background_color,question_styling_font_color));
                } else if(value.q_type == 'group') {
                  addGroup(value.Questions_id,value.question,value.description);
                } else if(value.q_type == 'reperator') {
                  addGroupRepeater(value.Questions_id,value.question,value.description);
                }
                
              });
            }
          }
        });

      }
      
    }

    function convertValue (value) { 
      return (value == undefined) ? '' : value ;
    }

    function setValiationError(value) {
      $(value).addClass('validation-error-input');
    }

    function removeUndefiendParameter(parameter) {
      
      let temp = {};
      $.each(parameter, function( indexParameter, valueParameter ) {
        if(valueParameter != undefined)
        {
          temp[indexParameter] = valueParameter;
        }
      });

      return temp;

    }

    function saveForm() {
      var formSubmitted = true;
      var form_id = convertValue($( "select[name='custome_forms'] option:selected" ).val());
      var form_title = convertValue($( "input[name='custom_forms_title']" ).val());
      var formData = {
        form_id : form_id,
        form_title : form_title,
        questions : [],
        deletedQuestions : $('#deletedQuestions').val()
      };


      var priority = 1;
      // if(form_id > 0) {
      //   setValiationError($( "select[name='custome_forms'] option:selected" ));
      //   formSubmitted = false;
      // }
      if(form_title == "") {
        $( "input[name='custom_forms_title']" ).addClass('validation-error-input');
        formSubmitted = false;
      }

      $('#main-drag-and-drop-area').children('div').each(function(key,value) {
     
        $(value).find('input[name="question_label"]').removeClass('validation-error-input');

        var question_type = $(value).attr('data-input-box-type');
        
        if ( question_type == 'single-input' ) {
          

          var question_id = convertValue($(value).attr('data-question-id'));
          var question_label = convertValue($(value).find('input[name="question_label"]').val());
          var question_description = convertValue($(value).find('input[name="question_description"]').val());
          var question_input_type = $(value).attr('data-input-type');
          if(question_label == '') {
            setValiationError($(value).find('input[name="question_label"]'));
            formSubmitted = false;
          }

          var parameter = {};
          parameter['required'] = $(value).find('input[name="question_required"]').prop("checked");
          parameter['encrypt'] = $(value).find('input[name="question_encrypt"]').prop("checked");
          parameter['country_input'] = $(value).find('input[name="country_input"]').prop("checked");
          parameter['extension'] = $(value).find('input[name="extension_input"]').prop("checked");
          parameter['allow_other'] = $(value).find('input[name="allow_other"]').prop("checked");
          parameter['reachtextboxformatting'] = $(value).find('input[name="reachtextboxformatting"]').prop("checked");
          
          parameter['question_styling_class'] = $(value).find('input[name="question_styling_class"]').val();
          parameter['question_styling_maxlength'] = $(value).find('input[name="question_styling_maxlength"]').val();
          parameter['question_styling_background_color'] = $(value).find('input[name="question_styling_background_color"]').val();
          parameter['question_styling_font_color'] = $(value).find('input[name="question_styling_font_color"]').val();

          if(question_input_type == 'selection')
          {
            parameter['selection_type'] = $(value).find('input[name="'+$(value).attr('data-field-id')+'"]:checked').val();
          }

          parameter['phone_type_selector'] = $(value).find('input[name="phone_type_selector"]').prop("checked");
          
          parameter['limit'] = $(value).find('input[name="limit_text"]').prop("checked");
          parameter['limit_range'] = $(value).find('input[name="limit_range"]').val();
          
          
          
          parameter = removeUndefiendParameter(parameter);

          var options = [];
          $(value).find('.option_div').children('.option').each(function(keyOption,valueOption) {

            if($(valueOption).find('input[name="option_text"]').val() == '') {
              setValiationError($(valueOption).find('input[name="option_text"]'));
              formSubmitted = false;
            } else {
              $(valueOption).find('input[name="option_text"]').removeClass('validation-error-input');
            }
            options.push({
              "options_id": $(valueOption).attr('data-option-id'),
              "question_id": question_id,
              "options": "Option " + (keyOption + 1),
              "option_value": $(valueOption).find('input[name="option_text"]').val(),
              "option_order": keyOption+1
            });
          });

          var tempFormData = {
            'Questions_id':question_id,
            'question':question_label,
            'q_type':question_input_type,
            'description':question_description,
            'question_order':priority,
            //'parent_question':priority,
            'parameter':parameter,
            'conditions':'',
            'style':'',
            'options':options
          };

          if( question_input_type == 'selection' ) {
            var removed_options_ids = $(value).find('.option_div').attr('data-removed-options');
            tempFormData['deletedOptions'] = removed_options_ids;
          }

          formData.questions.push(tempFormData);

          priority = priority + 1;

        } else if ( question_type == 'group' ) {
          
          $(value).find('input[name="group_label"]').removeClass('validation-error-input');

          var parameter = {};

          var question_id = convertValue($(value).attr('data-question-id'));
          var group_label = convertValue($(value).find('input[name="group_label"]').val());
          var group_description = convertValue($(value).find('input[name="group_description"]').val());
          var group_order = priority;

          if(group_label == '') {
            setValiationError($(value).find('input[name="group_label"]'));
            formSubmitted = false;
          }
          
          var temp_questions = {
            'Questions_id':question_id,
            'question':group_label,
            'q_type':'group',
            'description':group_description,
            'question_order':priority,
            //'parent_question':priority,
            'parameter':parameter,
            'conditions':'',
            'style':'',
            'questions':[]
          };

          priority = priority + 1;

          $(value).find('.input-draggable-parent-child-div').children('.question-box').each(function(childrenKey,childrenValue){
              var sub_question_type = $(childrenValue).attr('data-input-box-type');

              var sub_question_id = convertValue($(childrenValue).attr('data-question-id'));
              var question_label = convertValue($(childrenValue).find('input[name="question_label"]').val());
              var question_description = convertValue($(childrenValue).find('input[name="question_description"]').val());
              var question_input_type = $(childrenValue).attr('data-input-type');
              if(question_label == '') {
                setValiationError($(childrenValue).find('input[name="question_label"]'));
                formSubmitted = false;
              }


              var parameter = {};
              parameter['required'] = $(childrenValue).find('input[name="question_required"]').prop("checked");
              parameter['encrypt'] = $(childrenValue).find('input[name="question_encrypt"]').prop("checked");
              parameter['country_input'] = $(childrenValue).find('input[name="country_input"]').prop("checked");
              parameter['extension'] = $(childrenValue).find('input[name="extension_input"]').prop("checked");
              parameter['limit'] = $(childrenValue).find('input[name="limit_text"]').prop("checked");
              parameter['limit_range'] = $(childrenValue).find('input[name="limit_range"]').val();
              parameter['phone_type_selector'] = $(childrenValue).find('input[name="phone_type_selector"]').prop("checked");
              parameter['allow_other'] = $(childrenValue).find('input[name="allow_other"]').prop("checked");
              parameter['reachtextboxformatting'] = $(childrenValue).find('input[name="reachtextboxformatting"]').prop("checked");
              parameter['selection_type'] = $(childrenValue).find('input[name="selection_type"]:checked').val();
              parameter['selection_type'] = $(childrenValue).find('input[name="selection_type"]:checked').val();
              
              parameter['question_styling_class'] = $(childrenValue).find('input[name="question_styling_class"]').val();
              parameter['question_styling_maxlength'] = $(childrenValue).find('input[name="question_styling_maxlength"]').val();
              parameter['question_styling_background_color'] = $(childrenValue).find('input[name="question_styling_background_color"]').val();
              parameter['question_styling_font_color'] = $(childrenValue).find('input[name="question_styling_font_color"]').val();

              parameter = removeUndefiendParameter(parameter);

              if(question_input_type == 'selection')
              {
                parameter['selection_type'] = $(childrenValue).find('input[name="'+$(childrenValue).attr('data-field-id')+'"]:checked').val();
              }
              
              var options = [];
                $(childrenValue).find('.option_div').children('.option').each(function(keyOption,valueOption) {

                  if($(valueOption).find('input[name="option_text"]').val() == '') {
                    setValiationError($(valueOption).find('input[name="option_text"]'));
                    formSubmitted = false;
                  } else {
                    $(valueOption).find('input[name="option_text"]').removeClass('validation-error-input');
                  }
                  options.push({
                    "options_id": $(valueOption).attr('data-option-id'),
                    "question_id": sub_question_id,
                    "options": "Option " + (keyOption + 1),
                    "option_value": $(valueOption).find('input[name="option_text"]').val(),
                    "option_order": keyOption + 1
                  });
              });

              var temp_questions_temp = {
                'Questions_id':sub_question_id,
                'question':question_label,
                'q_type':question_input_type,
                'description':question_description,
                'question_order':priority,
                'parent_question':group_order,
                'parameter':parameter,
                'conditions':'',
                'style':'',
                'options':options
              };

              if( question_input_type == 'selection' ) {
                var removed_options_ids = $(childrenValue).find('.option_div').attr('data-removed-options');
                temp_questions_temp['deletedOptions'] = removed_options_ids;
              }
              temp_questions.questions.push(temp_questions_temp);

              priority = priority + 1;
          });

          formData.questions.push(temp_questions);
        } else if ( question_type == 'reperator' ) {
          
          $(value).find('input[name="group_label"]').removeClass('validation-error-input');

          var parameter = {};

          var question_id = convertValue($(value).attr('data-question-id'));
          var group_label = convertValue($(value).find('input[name="group_label"]').val());
          var group_description = convertValue($(value).find('input[name="group_description"]').val());
          var group_order = priority;

          if(group_label == '') {
            setValiationError($(value).find('input[name="group_label"]'));
            formSubmitted = false;
          }
          
          var temp_questions = {
            'Questions_id':question_id,
            'question':group_label,
            'q_type':'reperator',
            'description':group_description,
            'question_order':priority,
            //'parent_question':priority,
            'parameter':parameter,
            'conditions':'',
            'style':'',
            'questions':[]
          };

          priority = priority + 1;

          $(value).find('.input-draggable-parent-child-div').children('.question-box').each(function(childrenKey,childrenValue){
              var sub_question_type = $(childrenValue).attr('data-input-box-type');

              var sub_question_id = convertValue($(childrenValue).attr('data-question-id'));
              var question_label = convertValue($(childrenValue).find('input[name="question_label"]').val());
              var question_description = convertValue($(childrenValue).find('input[name="question_description"]').val());
              var question_input_type = $(childrenValue).attr('data-input-type');
              if(question_label == '') {
                setValiationError($(childrenValue).find('input[name="question_label"]'));
                formSubmitted = false;
              }


              var parameter = {};

              parameter['required'] = $(childrenValue).find('input[name="question_required"]').prop("checked");
              parameter['encrypt'] = $(childrenValue).find('input[name="question_encrypt"]').prop("checked");
              parameter['country_input'] = $(childrenValue).find('input[name="country_input"]').prop("checked");
              parameter['extension'] = $(childrenValue).find('input[name="extension_input"]').prop("checked");
              parameter['limit'] = $(childrenValue).find('input[name="limit_text"]').prop("checked");
              parameter['limit_range'] = $(childrenValue).find('input[name="limit_range"]').val();
              parameter['phone_type_selector'] = $(childrenValue).find('input[name="phone_type_selector"]').prop("checked");
              parameter['allow_other'] = $(childrenValue).find('input[name="allow_other"]').prop("checked");
              parameter['reachtextboxformatting'] = $(childrenValue).find('input[name="reachtextboxformatting"]').prop("checked");
              parameter['selection_type'] = $(childrenValue).find('input[name="selection_type"]:checked').val();
              parameter['selection_type'] = $(childrenValue).find('input[name="selection_type"]:checked').val();
              
              parameter['question_styling_class'] = $(value).find('input[name="question_styling_class"]').val();
              parameter['question_styling_maxlength'] = $(value).find('input[name="question_styling_maxlength"]').val();
              parameter['question_styling_background_color'] = $(value).find('input[name="question_styling_background_color"]').val();
              parameter['question_styling_font_color'] = $(value).find('input[name="question_styling_font_color"]').val();

              parameter = removeUndefiendParameter(parameter);

              if(question_input_type == 'selection')
              {
                parameter['selection_type'] = $(childrenValue).find('input[name="'+$(childrenValue).attr('data-field-id')+'"]:checked').val();
              }
              
              var options = [];
                $(childrenValue).find('.option_div').children('.option').each(function(keyOption,valueOption) {

                  if($(valueOption).find('input[name="option_text"]').val() == '') {
                    setValiationError($(valueOption).find('input[name="option_text"]'));
                    formSubmitted = false;
                  } else {
                    $(valueOption).find('input[name="option_text"]').removeClass('validation-error-input');
                  }
                  options.push({
                    "options_id": $(valueOption).attr('data-option-id'),
                    "question_id": sub_question_id,
                    "options": "Option " + (keyOption + 1),
                    "option_value": $(valueOption).find('input[name="option_text"]').val(),
                    "option_order": keyOption + 1
                  });
              });

              var temp_questions_temp = {
                'Questions_id':sub_question_id,
                'question':question_label,
                'q_type':question_input_type,
                'description':question_description,
                'question_order':priority,
                'parent_question':group_order,
                'parameter':parameter,
                'conditions':'',
                'style':'',
                'options':options
              };

              if( question_input_type == 'selection' ) {
                var removed_options_ids = $(childrenValue).find('.option_div').attr('data-removed-options');
                temp_questions_temp['deletedOptions'] = removed_options_ids;
              }
              temp_questions.questions.push(temp_questions_temp);

              priority = priority + 1;
          });

          formData.questions.push(temp_questions);
        }
      });
      // console.log(formData); return false;
      if(formSubmitted == true) {
          
          $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + "builder/saveform",
            data: formData,
            success: function(data) {
              var result = jQuery.parseJSON(data);
              //setFoldersTreeview(result);
              if(data != '') {
                  $('input[name="custom_forms_title"]').val(result.form_title);
                  window.open("<?php echo base_url('builder') ?>" + '?form_id=' + result.form_id, '_self'); 
              }
            }
          });

      }
    }

</script>















<script>
  // form builder configuration
  function addOptions(e) {
    $(e).parents('.option_div').append('<div class="col-sm-12 option" data-option-id="0"><label class="col-sm-2 col-form-label text-right option_text_label">Option 2</label> <input class="col-sm-4 form-control" style="margin-left: 6px;" type="text" name="option_text"><div class="col-sm-1 text-left actions"><a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> <a class=" col-form-label remove_action" onClick="removeOptions(this)"><i class="fa fa-minus"></i></a></div></div>');
    $(e).parents('.option_div').children('.option').each((key,value) => {
      $(e).parents('.option_div').children('.option').eq(key).find('.option_text_label').html('Option '+(key+1));
    });
  }

  function removeOptions(e) {

    var option_id = parseInt($(e).parents('.option').attr('data-option-id'));
    if(option_id > 0) {
      var removed_options_ids = $(e).parents('.option_div').attr('data-removed-options');
      if(removed_options_ids == '')
      {
        removed_options_ids = option_id;
      } else {
        removed_options_ids = removed_options_ids + ',' + option_id;
      }
      $(e).parents('.option_div').attr('data-removed-options',removed_options_ids);
      $(e).parents('.option').remove();
    } else {
      $(e).parents('.option').remove();
    }
  }

    $( function() {
  
        // $( ".input-draggable-parent-div" ).sortable({
        //   connectWith: ".connectedSortable",
        //   placeholder: "portlet-placeholder"
        // }).disableSelection();

        $(".form_bal_textfield").draggable({
            helper: function () {
                return getTextFieldHTML();
            },
            connectToSortable: ".connectedSortable"
        });

        $(".form_bal_textarea").draggable({
            helper: function () {
                return getTextAreaFieldHTML();
            },
            connectToSortable: ".connectedSortable"
        });
        
        $(".form_bal_select").draggable({
            helper: function () {
              return getSelectionFieldHTML(question_id = '0', question_label = '', question_description = '', question_required = false, allow_other = false, selection_type = 'dropdown', options = [], question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000');
            },
            connectToSortable: ".connectedSortable"
        });
        
        $(".form_bal_radio").draggable({
            helper: function () {
              return getSelectionFieldHTML(question_id = '0', question_label = '', question_description = '', question_required = false, allow_other = false, selection_type = 'radio', options = [], question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000');
            },
            connectToSortable: ".connectedSortable"
        });
        
        $(".form_bal_checkbox").draggable({
            helper: function () {
                return getSelectionFieldHTML(question_id = '0', question_label = '', question_description = '', question_required = false, allow_other = false, selection_type = 'checkbox', options = [], question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000');
            },
            connectToSortable: ".connectedSortable"
        });

        $(".form_bal_fileupload").draggable({
            helper: function () {
                return getFileUploadFieldHTML();
            },
            connectToSortable: ".connectedSortable"
        });

        $(".form_bal_date").draggable({
            helper: function () {
                return getDatePickerFieldHTML();
            },
            connectToSortable: ".connectedSortable"
        });

        $(".form_bal_email").draggable({
          helper: function () {
              return getEmailFieldHTML();
          },
          connectToSortable: ".connectedSortable"
        });

        $(".form_bal_phone").draggable({
          helper: function () {
              return getPhoneFieldHTML();
          },
          connectToSortable: ".connectedSortable"
        });

        $(".form_bal_address").draggable({
          helper: function () {
              return getAddressFieldHTML();
          },
          connectToSortable: ".connectedSortable"
        });
        
    });


    function getTextFieldHTML(question_id = '0',question_label = '',question_description = '',question_required = false,question_encrypt = false, question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000') {

        var required = question_required == 'true' ? 'checked' : '';
        var encryptData = question_encrypt == 'true' ? 'checked' : '';

        var field = generateField();
        var html = '<div data-question-id="'+question_id+'" data-input-type="text" class="input-main-box input-main-box-'+field+' h-auto w-auto question-box" data-input-box-type="single-input"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input value="'+question_label+'" name="question_label" class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Text Field</div><div class="col-sm-1" style="text-align:right;padding-right:30px;"><i class="fa fa-times" style="font-size: 18px;" onClick=removeInput('+question_id+',this) ></i></div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input value="'+question_description+'" name="question_description" class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" value="true" name="question_required" '+required+' > Required </div> <div class="col-sm-2 text-left"> <input class="" type="checkbox" name="question_encrypt" '+encryptData+'> Encrypt Data </div><div class="col-sm-6 text-right" style="padding-right:32px !important;"><a href="#" onclick="showHide(this)">Styling</a></div><div class="col-sm-12 styling pt-5 d-none"><label class="col-sm-1 col-form-label text-right"></label><label class="col-sm-11 col-form-label text-left" style="font-size: 19px;font-weight: bold;">Styling</label><div class="col-sm-12"><label class="col-sm-2 col-form-label text-right">Class</label><div class="col-sm-3 text-left"><input class="w-100" type="text" value="'+question_styling_class+'" name="question_styling_class"></div><label class="col-sm-2 col-form-label text-right">Max Length</label><div class="col-sm-3 text-left"><input class="w-100" type="number" value="'+question_styling_maxlength+'" name="question_styling_maxlength"></div></div><div class="col-sm-12 pt-1"><label class="col-sm-2 col-form-label text-right">Background</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_background_color+'" name="question_styling_background_color"></div><label class="col-sm-2 col-form-label text-right">Color</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_font_color+'" name="question_styling_font_color"></div></div></div></div> </div>';
        return html;
    }

    function getEmailFieldHTML(question_id = '0',question_label = '',question_description = '',question_required = false, question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000') {
        var field = generateField();
        var required = question_required == 'true' ? 'checked' : '';
        var html = '<div data-question-id="'+question_id+'" data-input-type="email" class="input-main-box input-main-box-'+field+' h-auto w-auto question-box" data-input-box-type="single-input"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input value="'+question_label+'" name="question_label" class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Email Field</div><div class="col-sm-1" style="text-align:right;padding-right:30px;"><i class="fa fa-times" style="font-size: 18px;" onClick=removeInput('+question_id+',this) ></i></div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input value="'+question_description+'" name="question_description" class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" value="true" name="question_required" '+required+' > Required </div><div class="col-sm-8 text-right" style="padding-right:32px !important;"><a href="#" onclick="showHide(this)">Styling</a></div><div class="col-sm-12 styling pt-5 d-none"><label class="col-sm-1 col-form-label text-right"></label><label class="col-sm-11 col-form-label text-left" style="font-size: 19px;font-weight: bold;">Styling</label><div class="col-sm-12"><label class="col-sm-2 col-form-label text-right">Class</label><div class="col-sm-3 text-left"><input class="w-100" type="text" value="'+question_styling_class+'" name="question_styling_class"></div><label class="col-sm-2 col-form-label text-right">Max Length</label><div class="col-sm-3 text-left"><input class="w-100" type="number" value="'+question_styling_maxlength+'" name="question_styling_maxlength"></div></div><div class="col-sm-12 pt-1"><label class="col-sm-2 col-form-label text-right">Background</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_background_color+'" name="question_styling_background_color"></div><label class="col-sm-2 col-form-label text-right">Color</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_font_color+'" name="question_styling_font_color"></div></div></div>  </div> </div>';
        return html;
    }

    function getPhoneFieldHTML(question_id = '0',question_label = '',question_description = '',question_required = false,extension = false,phone_type_selector = false, question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000') {
        var field = generateField();
        var required = question_required == 'true' ? 'checked' : '';
        var extension = extension == 'true' ? 'checked' : '';
        var phone_type_selector = phone_type_selector == 'true' ? 'checked' : '';

        var html = '<div data-question-id="'+question_id+'" data-input-type="phone" ';
        html = html + 'class="input-main-box input-main-box-'+field+' h-auto w-auto question-box" data-input-box-type="single-input"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input value="'+question_label+'" name="question_label" class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Phone</div><div class="col-sm-1" style="text-align:right;padding-right:30px;"><i class="fa fa-times" style="font-size: 18px;" onClick=removeInput('+question_id+',this) ></i></div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input class="form-control" value="'+question_description+'" name="question_description" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" value="true" name="question_required" '+required+' > Required </div> <div class="col-sm-3 text-left"> <input class="" type="checkbox" name="extension_input" '+extension+'> Include Extension Field</div> <div class="col-sm-3 text-left"> <input class="" type="checkbox" name="phone_type_selector" '+phone_type_selector+'> Include Phone Type Selector</div><div class="col-sm-2 text-right" style="padding-right:32px !important;"><a href="#" onclick="showHide(this)">Styling</a></div><div class="col-sm-12 styling pt-5 d-none"><label class="col-sm-1 col-form-label text-right"></label><label class="col-sm-11 col-form-label text-left" style="font-size: 19px;font-weight: bold;">Styling</label><div class="col-sm-12"><label class="col-sm-2 col-form-label text-right">Class</label><div class="col-sm-3 text-left"><input class="w-100" type="text" value="'+question_styling_class+'" name="question_styling_class"></div><label class="col-sm-2 col-form-label text-right">Max Length</label><div class="col-sm-3 text-left"><input class="w-100" type="number" value="'+question_styling_maxlength+'" name="question_styling_maxlength"></div></div><div class="col-sm-12 pt-1"><label class="col-sm-2 col-form-label text-right">Background</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_background_color+'" name="question_styling_background_color"></div><label class="col-sm-2 col-form-label text-right">Color</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_font_color+'" name="question_styling_font_color"></div></div></div> </div> </div>';
        return html;
    }

    function getAddressFieldHTML(question_id = '0',question_label = '',question_description = '',question_required = false,country_input = false, question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000') {
        var field = generateField();
        var required = question_required == 'true' ? 'checked' : '';
        var country_input = country_input == 'true' ? 'checked' : '';

        var html = '<div data-question-id="'+question_id+'" data-input-type="address" class="input-main-box input-main-box-'+field+' h-auto w-auto question-box" data-input-box-type="single-input"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input value="'+question_label+'" name="question_label" class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Address</div><div class="col-sm-1" style="text-align:right;padding-right:30px;"><i class="fa fa-times" style="font-size: 18px;" onClick=removeInput('+question_id+',this) ></i></div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input value="'+question_description+'" name="question_description" class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" value="true" name="question_required" '+required+' > Required </div> <div class="col-sm-3 text-left"> <input class="" type="checkbox" name="country_input" '+country_input+' value="true"> Include Country Input</div><div class="col-sm-5 text-right" style="padding-right:32px !important;"><a href="#" onclick="showHide(this)">Styling</a></div><div class="col-sm-12 styling pt-5 d-none"><label class="col-sm-1 col-form-label text-right"></label><label class="col-sm-11 col-form-label text-left" style="font-size: 19px;font-weight: bold;">Styling</label><div class="col-sm-12"><label class="col-sm-2 col-form-label text-right">Class</label><div class="col-sm-3 text-left"><input class="w-100" type="text" value="'+question_styling_class+'" name="question_styling_class"></div><label class="col-sm-2 col-form-label text-right">Max Length</label><div class="col-sm-3 text-left"><input class="w-100" type="number" value="'+question_styling_maxlength+'" name="question_styling_maxlength"></div></div><div class="col-sm-12 pt-1"><label class="col-sm-2 col-form-label text-right">Background</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_background_color+'" name="question_styling_background_color"></div><label class="col-sm-2 col-form-label text-right">Color</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_font_color+'" name="question_styling_font_color"></div></div></div> </div> </div>';
        return html;
    }
    

    function getTextAreaFieldHTML(question_id = '0',question_label = '',question_description = '',question_required = false, question_encrypt = false,limit = false,limit_range = '',reachTextBoxFormatting = false, question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000') {
        var field = generateField();
        var required = question_required == 'true' ? 'checked' : '';
        var encryptData = question_encrypt == 'true' ? 'checked' : '';
        var limit = limit == 'true' ? 'checked' : '';
        var reachTextBoxFormatting = reachTextBoxFormatting == 'true' ? 'checked' : '';

        var html = '<div  data-question-id="'+question_id+'" data-input-type="textarea" class="input-main-box input-main-box-'+field+' h-auto w-auto question-box" data-input-box-type="single-input" > ';
        html = html + ' <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input value="'+question_label+'" name="question_label" class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Text Area</div><div class="col-sm-1" style="text-align:right;padding-right:30px;"><i class="fa fa-times" style="font-size: 18px;" onClick=removeInput('+question_id+',this) ></i></div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input value="'+question_description+'" name="question_description" class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" name="question_required" '+required+' > Required </div> <div class="col-sm-2 text-left"> <input class="" type="checkbox" '+encryptData+' name="question_encrypt"> Encrypt Data </div> <div class="col-sm-2 text-left"> <input class="" type="checkbox" '+limit+' name="limit_text"> Limit Text<input class="form-control" name="limit_range" value="'+limit_range+'" type="text"></div> <div class="col-sm-3 text-left"> <input class="" type="checkbox" name="reachtextboxformatting" '+reachTextBoxFormatting+'> Use Rich Text Formatting</div> <div class="col-sm-1 text-right" style="padding-top: 33px;padding-right:32px !important;" ><a href="#" onclick="showHide(this)">Styling</a></div><div class="col-sm-12 styling pt-5 d-none"><label class="col-sm-1 col-form-label text-right"></label><label class="col-sm-11 col-form-label text-left" style="font-size: 19px;font-weight: bold;">Styling</label><div class="col-sm-12"><label class="col-sm-2 col-form-label text-right">Class</label><div class="col-sm-3 text-left"><input class="w-100" type="text" value="'+question_styling_class+'" name="question_styling_class"></div><label class="col-sm-2 col-form-label text-right">Max Length</label><div class="col-sm-3 text-left"><input class="w-100" type="number" value="'+question_styling_maxlength+'" name="question_styling_maxlength"></div></div><div class="col-sm-12 pt-1"><label class="col-sm-2 col-form-label text-right">Background</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_background_color+'" name="question_styling_background_color"></div><label class="col-sm-2 col-form-label text-right">Color</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_font_color+'" name="question_styling_font_color"></div></div></div></div> </div>';
        return html;
    }


    function getSelectionFieldHTML(question_id = '0', question_label = '', question_description = '', question_required = false, allow_other = false, selection_type = 'radio', options = [], question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000') {
      
      var field = generateField();
      var required = question_required == 'true' ? 'checked' : '';
      var allow_other = allow_other == 'true' ? 'checked' : '';
      

      var option_text = '';
      if(options.length > 0)
      {
        $.each(options, function( index, value ) {
          option_text = option_text + '<div class="col-sm-12 option" data-option-id="' + value.options_id + '"><label class="col-sm-2 col-form-label text-right option_text_label">'+value.options+'</label> <input class="col-sm-4" type="text" name="option_text" value="'+value.option_value+'"><div class="col-sm-1 text-left actions"><a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> '+((index > 0)?'<a class=" col-form-label remove_action" onClick="removeOptions(this)"><i class="fa fa-minus"></i></a>':'')+'</div></div>';
        });
      } else {
          option_text = '<div class="col-sm-12 option" data-option-id="0"> <label class="col-sm-2 col-form-label text-right option_text_label">Option 1</label> <input class="col-sm-4 form-control" style="margin-left: 6px;" type="text" name="option_text"> <div class="col-sm-1 text-left actions"> <a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> </div> </div>';
      }

      var html = '<div data-field-id="selection_type-'+field+'" data-question-id="'+question_id+'" data-input-type="'+selection_type+'" class="input-main-box input-main-box-'+field+' h-auto w-auto question-box" data-input-box-type="single-input"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input value="'+question_label+'" name="question_label" class="form-control" type="text"> </div> <div class="col-sm-4 text-right">'+((selection_type == 'radio') ? 'Radio Input' : (selection_type == 'checkbox') ? 'Checkbox Input' : (selection_type == 'dropdown') ? 'Selection Input' : '') +'</div><div class="col-sm-1" style="text-align:right;padding-right:30px;"><i class="fa fa-times" style="font-size: 18px;" onClick=removeInput('+question_id+',this) ></i></div> </div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input value="'+question_description+'" name="question_description" class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" name="question_required" '+required+' > Required </div> <div class="col-sm-2 text-left"> <input class="" type="checkbox" name="allow_other" '+allow_other+'> Allow Other</div>';

      html = html + '<div class="col-sm-6  text-right pr-8" style="position: absolute; right: 0px; margin-top: 56px;padding-right:33px;" style="padding-right:32px !important;"><a href="#" onclick="showHide(this)">Styling</a></div> </div> <br><div class="row option_div "  data-removed-options="">'+option_text+'</div><div class="col-sm-12 styling pt-5 d-none"><label class="col-sm-1 col-form-label text-right"></label><label class="col-sm-11 col-form-label text-left" style="font-size: 19px;font-weight: bold;">Styling</label><div class="col-sm-12"><label class="col-sm-2 col-form-label text-right">Class</label><div class="col-sm-3 text-left"><input class="w-100" type="text" value="'+question_styling_class+'" name="question_styling_class"></div><label class="col-sm-2 col-form-label text-right">Max Length</label><div class="col-sm-3 text-left"><input class="w-100" type="number" value="'+question_styling_maxlength+'" name="question_styling_maxlength"></div></div><div class="col-sm-12 pt-1"><label class="col-sm-2 col-form-label text-right">Background</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_background_color+'" name="question_styling_background_color"></div><label class="col-sm-2 col-form-label text-right">Color</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_font_color+'" name="question_styling_font_color"></div></div></div></div>';
      // <div class="col-sm-12 option"> <label class="col-sm-2 col-form-label text-right option_text_label">Option 1</label> <input class="col-sm-4 form-control" style="margin-left: 6px;" type="text" name="option_text"> <div class="col-sm-1 text-left actions"> <a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> </div> </div>
      return html;
    }

    function getFileUploadFieldHTML(question_id = '0',question_label = '',question_description = '',question_required = false, question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000') {
        var field = generateField();
        var required = question_required == 'true' ? 'checked' : '';


        var html = '<div data-question-id="'+question_id+'" data-input-type="file-upload" class="input-main-box input-main-box-'+field+' h-auto w-auto question-box" data-input-box-type="single-input"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input value="'+question_label+'" name="question_label" class="form-control" type="text"> </div> <div class="col-sm-4 text-right">File Upload </div><div class="col-sm-1" style="text-align:right;padding-right:30px;"><i class="fa fa-times" style="font-size: 18px;" onClick=removeInput('+question_id+',this) ></i></div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input value="'+question_description+'" name="question_description" class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" value="true" name="question_required" '+required+' > Required </div><div class="col-sm-8 text-right" style="padding-right:32px !important;"><a href="#" onclick="showHide(this)">Styling</a></div><div class="col-sm-12 styling pt-5 d-none"><label class="col-sm-1 col-form-label text-right"></label><label class="col-sm-11 col-form-label text-left" style="font-size: 19px;font-weight: bold;padding-right:33px;">Styling</label><div class="col-sm-12"><label class="col-sm-2 col-form-label text-right">Class</label><div class="col-sm-3 text-left"><input class="w-100" type="text" value="'+question_styling_class+'" name="question_styling_class"></div><label class="col-sm-2 col-form-label text-right">Max Length</label><div class="col-sm-3 text-left"><input class="w-100" type="number" value="'+question_styling_maxlength+'" name="question_styling_maxlength"></div></div><div class="col-sm-12 pt-1"><label class="col-sm-2 col-form-label text-right">Background</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_background_color+'" name="question_styling_background_color"></div><label class="col-sm-2 col-form-label text-right">Color</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_font_color+'" name="question_styling_font_color"></div></div></div> </div> </div>';
        return html;
    }

    function getDatePickerFieldHTML(question_id = '0',question_label = '',question_description = '',question_required = false, question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000') {
      var field = generateField();
      var required = question_required == 'true' ? 'checked' : '';


      var html = '<div data-question-id="'+question_id+'" data-input-type="date-picker" class="input-main-box input-main-box-'+field+' h-auto w-auto question-box" data-input-box-type="single-input"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input value="'+question_label+'" name="question_label" class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Date Picker</div><div class="col-sm-1" style="text-align:right;padding-right:30px;"><i class="fa fa-times" style="font-size: 18px;" onClick=removeInput('+question_id+',this) ></i></div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input value="'+question_description+'" name="question_description" class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" value="true" name="question_required" '+required+' > Required </div> <div class="col-sm-8 text-right" style="padding-right:32px !important;"><a href="#" onclick="showHide(this)">Styling</a></div><div class="col-sm-12 styling pt-5 d-none"><label class="col-sm-1 col-form-label text-right"></label><label class="col-sm-11 col-form-label text-left" style="font-size: 19px;font-weight: bold;">Styling</label><div class="col-sm-12"><label class="col-sm-2 col-form-label text-right">Class</label><div class="col-sm-3 text-left"><input class="w-100" type="text" value="'+question_styling_class+'" name="question_styling_class"></div><label class="col-sm-2 col-form-label text-right">Max Length</label><div class="col-sm-3 text-left"><input class="w-100" type="number" value="'+question_styling_maxlength+'" name="question_styling_maxlength"></div></div><div class="col-sm-12 pt-1"><label class="col-sm-2 col-form-label text-right">Background</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_background_color+'" name="question_styling_background_color"></div><label class="col-sm-2 col-form-label text-right">Color</label><div class="col-sm-3 text-left"><input class="w-100" type="color" value="'+question_styling_font_color+'" name="question_styling_font_color"></div></div></div></div> </div>';
      return html;
    }

    function randomKey() {

      return Math.floor(Math.random() * (100000 - 1 + 1) + 57);
    }

    function removeInput(id,e) {
      if(id == 0 || id == '0')
      {
        $(e).closest('.question-box').remove();
      } else {

        if($('#deletedQuestions').val() == '')
        {
          $('#deletedQuestions').val($(e).closest('.question-box').attr('data-question-id'))
        } else {
          $('#deletedQuestions').val($('#deletedQuestions').val() + ',' +$(e).closest('.question-box').attr('data-question-id'))
        }

        $(e).closest('.question-box').remove();
      }

    }
    function addGroup(question_id = '0',question_label = '',question_description = '') {

      var generateField = randomKey();

      $('#main-drag-and-drop-area').append('<div data-question-id="'+question_id+'" data-input-type="group" class=" pt-0 input-main-box portlet question-box question-box-'+question_id+'" data-input-box-type="group" id="portlet-'+generateField+'"><div class="portlet-header"><div class="row"><label class="col-sm-2 col-form-label text-right">Group Label</label><div class="col-sm-5"><input class="form-control" name="group_label" type="text" value="'+question_label+'"></div></div><div class="row"><label class="col-sm-2 col-form-label text-right">Field Description</label><div class="col-sm-5"><input class="form-control" name="group_description" value="'+question_description+'" type="text"></div></div></div><div class="portlet-content input-draggable-parent-child-div connectedSortable"></div></div>');

      // $( ".column" ).sortable({
      //   connectWith: ".column",
      //   handle: ".portlet-header",
      //   cancel: ".portlet-toggle",
      //   placeholder: "portlet-placeholder ui-corner-all"
      // });
  
      $( "#portlet-"+generateField )
        .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
        .find( ".portlet-header" )
          .addClass( "ui-widget-header ui-corner-all" )
          .prepend( "<span class='ui-icon-minusthick portlet-toggle mr-5'><i class='fa fa-minus'></i></span><span class='ui-icon-minusthick portlet-toggle mr-1'><i class='fa fa-times'></i></span>");
  
      $( "#portlet-"+generateField+" .portlet-toggle" ).on( "click", function() {
        var icon = $( this );
        icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
        icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
      });

      $( "#portlet-"+generateField+" .input-draggable-parent-child-div" ).sortable({
        connectWith: ".connectedSortable",
        placeholder: "portlet-placeholder"
      }).disableSelection();

    }

    function addGroupRepeater ( question_id = '0', question_label = '', question_description = '' ) {

      var generateField = randomKey();

      $('#main-drag-and-drop-area').append('<div data-question-id="'+question_id+'" data-input-type="reperator" class=" pt-0 input-main-box portlet question-box question-box-'+question_id+'" data-input-box-type="reperator" id="portlet-'+generateField+'"><div class="portlet-header"><div class="row"><label class="col-sm-2 col-form-label text-right">Group Label</label><div class="col-sm-5"><input class="form-control" name="group_label" type="text" value="'+question_label+'"></div><label class="col-sm-4 col-form-label text-right">Repeater</label></div><div class="row"><label class="col-sm-2 col-form-label text-right">Field Description</label><div class="col-sm-5"><input class="form-control" name="group_description" value="'+question_description+'" type="text"></div></div></div><div class="portlet-content input-draggable-parent-child-div connectedSortable"></div></div>');

      // $( ".column" ).sortable({
      //   connectWith: ".column",
      //   handle: ".portlet-header",
      //   cancel: ".portlet-toggle",
      //   placeholder: "portlet-placeholder ui-corner-all"
      // });
  
      $( "#portlet-"+generateField )
        .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
        .find( ".portlet-header" )
          .addClass( "ui-widget-header ui-corner-all" )
          .prepend( "<span class='ui-icon-minusthick portlet-toggle mr-5'><i class='fa fa-minus'></i></span><span class='ui-icon-minusthick portlet-toggle mr-1'><i class='fa fa-times'></i></span>");
  
      $( "#portlet-"+generateField+" .portlet-toggle" ).on( "click", function() {
        var icon = $( this );
        icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
        icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
      });

      $( "#portlet-"+generateField+" .input-draggable-parent-child-div" ).sortable({
        connectWith: ".connectedSortable",
        placeholder: "portlet-placeholder"
      }).disableSelection();
    }
  </script>
  <!--<div class="col-sm-12">
    <div class="row">
      <label class="col-sm-1 col-form-label text-right">Form Edit</label>
      <div class="col-sm-5">
        <select class="form-control" name="custome_forms">
          <option value="new">New Form</option>
          <?php foreach($forms as $job) { ?>
            <option value="<?php echo $job->forms_id; ?>" <?php echo (isset($selected_form_id) && $selected_form_id > 0 && $selected_form_id == $job->forms_id)?'selected="selected"':''; ?>><?php echo $job->form_title; ?></option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" onClick="getFormData()">  Go </button>
      <a class="ml-3 mt-3 d-none" id="preview_url_formbuilder" href="<?php echo base_url('builder/demo/13'); ?>">Click to preview</a>
    </div>
  </div>
  <div class="col-sm-12 ">
    <div class="form-group row ">
      <label class="col-sm-1 col-form-label text-right">Form Title</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="custom_forms_title">
      </div>
      <label class="col-sm-1 col-form-label text-right">Add to</label>
      <div class="col-sm-2">
        <select class="form-control" >
          <?php foreach($jobs as $job) { ?>
            <option value="<?php echo $job->jobs_id; ?>"><?php echo $job->job_name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>-->
<style type="text/css">
  .validation-error-input {
      border: red 1px solid !important;
      background: #ff00000d !important;
  }
  .form_builder_field {
    width: 100% !important;
    border-radius: 15px;
    border: 2px solid #ddd;
  }
  .form_builder_area .form_builder_field .form_output .form-group {
        margin-bottom: 10px !important;
  }
  .form_builder_area .form_builder_field {
    margin-left: 0px !important;
  }
  .form-check .form-check-label .checkbox-text-span {
    margin-left: 15px !important;
  }
  .form-check {
    text-align: left;
  }
  .form_builder_area .form_builder_field .form_output .form-group {
    margin-bottom: 10px !important;
    text-align: left;
  }
  .form_builder .nav-sidebar {
    border:0px
  } .form_builder ul li { padding: 0px; }
  .nav-sidebar ul i{ margin-top: 0.3rem; }
  .form-control { font-size: 16px !important; }
  .ui-widget { font-family: Verdana,Arial,sans-serif; font-size: 1.0em !important; }
  .form_builder .nav-sidebar a {
    color: white !important;
  }
  .form_builder .nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
    background-color: #8e8e8e;
  }
  .ui-widget.ui-widget-content {
    border: 1px solid #d3d3d3;
}
</style>