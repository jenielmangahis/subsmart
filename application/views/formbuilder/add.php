<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/css/jquery.ui.css">
<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/css/app.css">
<!-- <link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/basscss.css"> -->
<link rel="stylesheet" href="<?php echo $url->assets ?>formbuilder/seconds-part/css/form_builder.css"/>

<div style="display: none;">
  <div id="form-autocomplete-field-clone" >
    <div class="row" style="margin:0px 0px;margin-top: 15px;">
      <div class="col-sm-12" id="form-field-container" style="border-radius: 15px;
    border: 2px solid #ddd; padding: 15px;">
        <div class="col-sm-3">
          <label class="field-label" style="padding: 3.8px;">Autocomplete</label>
        </div>
        <div class="col-sm-9">
          <div class="field-actions" style="text-align: right;">
          <a type="remove" class="btn icon-cancel " onClick="removeInputContainer(this)" title="Remove Element">
            <i class="fa fa-close"></i>
          </a>
          <!-- <a type="edit" class="btn icon-pencil" title="Edit">
            <i class="fa fa-pencil"></i>
          </a>
          <a type="copy" class="btn icon-copy" title="Copy">
            <i class="fa fa-clone"></i>
          </a> -->
        </div>
        </div>
        <!-- 
        <div class="row">
          
          
        </div> -->
      </div>
    </div>
  </div>
</div>

<style>
  .form-field {
    /*background: red;*/
  }
  .custom-div .form-field .field-actions { text-align: right; }
</style>

<!-- page wrapper start -->
<div class="wrapper">
    

  
    











    <div class="form_builder" style="margin-top: 25px">
                <div class="row">
                
                <textarea style="display: none;" id="json_data_current" type="hidden"><?php echo (isset($selected_data[0]) && $selected_data[0]->form_data != '')?$selected_data[0]->form_data:''; ?></textarea>
                  <div class="col-sm-2">
                      <nav class="nav-sidebar">
                          <ul class="nav">
                              <li class="form_bal_textfield">
                                  <a href="javascript:;">Text Field <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                              <li class="form_bal_textarea">
                                  <a href="javascript:;">Text Area <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                              <li class="form_bal_select">
                                  <a href="javascript:;">Select <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                              <li class="form_bal_radio">
                                  <a href="javascript:;">Radio Button <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                              <li class="form_bal_checkbox">
                                  <a href="javascript:;">Checkbox <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                              <li class="form_bal_email">
                                  <a href="javascript:;">Email <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                              <li class="form_bal_number">
                                  <a href="javascript:;">Number <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                              <li class="form_bal_password">
                                  <a href="javascript:;">Password <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                              <li class="form_bal_date">
                                  <a href="javascript:;">Date <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                              <li class="form_bal_button">
                                  <a href="javascript:;">Button <i class="fa fa-plus-circle pull-right"></i></a>
                              </li>
                          </ul>
                      </nav>
                  </div>

                    <div class="col-md-10 bal_builder">
                      
                      <div class="col-sm-12 mb-1 pl-0">
                        <select name="main_form_name" class="col-sm-6 form-control">
                          <option value="0">New Form</option>
                          <?php foreach($forms as $key => $value) { ?>
                            <option value="<?php echo $value->id; ?>" <?php echo (isset($selected_id) && $selected_id!=0 && $selected_id == $value->id)?'selected="selected"':''; ?>><?php echo $value->form_type; ?></option>
                          <?php } ?>
                        </select>
                        <input type="button" class="pull-left ml-4 p-3" id="setformname" value="   Go   ">
                    </div >
                      <div class="environment col-md-12">
                        
                        <div class="main_row_append_box ml4 js-sortable sortable list flex flex-column list-reset"></div>

                            <div class="form_generated_box">
                              
                            </div>
                            <textarea class="code_box form-control"></textarea>
                            <!-- adder Button -->

                            <div style="margin-top: 20px">
                              <a href="#" class="btn btn-primary btn_round main_row_btn pull-left">
                                <i class="fa fa-plus"></i> Add Group
                              </a>
                              <span class="pull-right">
                                <!-- <span class="btn_round html_btn btn btn-default" data-code-btn="code">
                                  View HTML <i class="fa fa-code"></i>
                                </span>
                                <span class="btn_round generate_btn btn btn-success">
                                  Preview
                                </span> -->
                                <span class="btn_round save_btn html_btn btn btn-success" onClick="getCall()">Save</span>
                              </span>
                            </div>
                            <div class="clearfix"></div>
                            <!-- end adder Button -->
                          <!-- <button class="ml4 js-serialize-button button navy bg-yellow">Serialize</button>   -->

                          <!-- <div style="background: red;">
                            
                                <div class="dragger">1</div>
                                <div class="dragger">2</div>
                                <div class="dragger">3</div>
                                <div class="dragger">4</div>
                                <div class="dragger">5</div>
                                <div class="dropper">
                                    <p>Drop</p>
                                </div>
                          </div>   -->
                    </div>                      
                    </div>
                    <!-- <div class="col-md-5 bal_builder">
                        <div class="form_builder_area"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="col-md-12">
                            <form class="form-horizontal">
                                <div class="preview"></div>
                                <div style="display: none" class="form-group plain_html"><textarea rows="50" class="form-control"></textarea></div>
                            </form>
                        </div>
                    </div> -->
                </div>
            </div>






   
</div>
   <!-- end container-fluid -->
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

<script type="text/javascript">
  sortable('.js-sortable', {
    forcePlaceholderSize: true,
    placeholderClass: 'mb1 bg-navy border border-yellow',
    hoverClass: 'bg-maroon yellow',
    itemSerializer: function (item, container) {
      item.parent = '[parentNode]'
      item.node = '[Node]'
      item.html = item.html.replace('<','&lt;')
      return item
    },
    containerSerializer: function (container) {
      container.node = '[Node]'
      return container
    }
  })
  document.querySelector('.js-serialize-button').addEventListener('click', function () {
    let serialized = sortable('.js-sortable', 'serialize')
    document.querySelector('.serialized-content').innerHTML = JSON.stringify(serialized, null, ' ')
  })
</script>
<script>
// function allowDrop(ev) {
//     ev.preventDefault();
// }

// function drag(ev) {
//     ev.dataTransfer.setData("text", ev.target.id);
// }

// function drop(ev) {
//     ev.preventDefault();
//     var data = ev.dataTransfer.getData("text");
//     ev.target.appendChild(document.getElementById(data));
// }

function removeInputContainer(e) {
      $(e).closest( "#form-field-container" ).remove();
}
$(document).ready(function () {
    $('.dragger').draggable({
        revert: "invalid",
        helper: function () {
            return $("<div class='dragger'></div>").append('raviraj');
        }
    });
});
</script>
<style type="text/css">
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
</style>


<script type="text/javascript">
  function getCall() {

      var c = __mr_box.clone(true, true);
      var mainbox = c.find('.cb_display_box');
      var removables = c.find('.removable');
      
      var btn = __html_btn;
      var btn_txt = btn.attr('data-code-btn');

      // Remove handlers
      c.find('.removable, .delete, .remove_btn').remove();
      c.removeClass('cb_display_box, no-drag');

      var __generate_html = [];
      mainbox.each(function(i, v) {
        
        var __generate_html_temp = {
          "group_name":"",
          "group_description":"",
          "fields":[]
        };

        __generate_html_temp.group_name = $(v).find('.group-description input[name="group-label"]').val();
        __generate_html_temp.group_description = $(v).find('.group-field-description input[name="group-field-description"]').val();

        var fbox = $(v).find('.form_builder_area .form_output');
        // fbox.each(function (i1, v1) {
          
        //   var inputType = $(v1).find('.form_output').attr('data-type');

        //   if(inputType = '')

          
        // });

        fbox.each(function (i1, v1) {
          
            var temp_inputs = {};

            var data_type = $(v1).attr('data-type');

            temp_inputs.input_type = data_type;
            temp_inputs.required = false;
            //var field = $(v1).attr('data-field');
            temp_inputs.label = $(v1).find('.form_input_label').val();
            temp_inputs.name = $(v1).find('.form_input_name').val();

            if (data_type === 'text') {
                temp_inputs.placeholder = $(v1).find('.form_input_placeholder').val();
                var checkbox = $(v1).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    temp_inputs.required = true;
                }

            }
            if (data_type === 'number') {
                temp_inputs.placeholder = $(v1).find('.form_input_placeholder').val();
                var checkbox = $(v1).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    temp_inputs.required = true;
                }
            }
            if (data_type === 'email') {
                temp_inputs.placeholder = $(v1).find('.form_input_placeholder').val();
                var checkbox = $(v1).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    temp_inputs.required = true;
                }
            }
            if (data_type === 'password') {
                temp_inputs.placeholder = $(v1).find('.form_input_placeholder').val();
                var checkbox = $(v1).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    temp_inputs.required = true;
                }
            }
            if (data_type === 'textarea') {
                temp_inputs.placeholder = $(v1).find('.form_input_placeholder').val();
                var checkbox = $(v1).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    temp_inputs.required = true;
                }
            }
            if (data_type === 'date') {
                var checkbox = $(v1).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    temp_inputs.required = true;
                }
            }
            if (data_type === 'button') {
                temp_inputs.btn_class = $(v1).find('.form_input_button_class').val();
                temp_inputs.btn_value = $(v1).find('.form_input_button_value').val();

                delete temp_inputs.label;
                // delete temp_inputs.name;
                delete temp_inputs.required;
            }
            if (data_type === 'select') {
                var option_html = ''; temp_inputs.options = [];
                $(v1).find('select option').each(function (iOption, vOption) {
                    var option = $(vOption).html();
                    var value = $(vOption).val();
                    temp_inputs.options.push({ "value" : value , "option" : option });
                });
            }
            if (data_type === 'radio') {
                var option_html = ''; temp_inputs.options = [];
                $(v1).find('.mt-radio').each(function (iOption, vOption) {
                    var option = $(vOption).find('p').html();
                    var value = $(vOption).find('input[type=radio]').val();
                    temp_inputs.options.push({ "value" : value , "option" : option });
                });
            }
            if (data_type === 'checkbox') {
                var option_html = ''; temp_inputs.options = [];
                $(v1).find('.mt-checkbox').each(function (iOption, vOption) {
                    var option = $(vOption).find('p').html();
                    var value = $(vOption).find('input[type=checkbox]').val();
                    temp_inputs.options.push({ "value" : value , "option" : option });
                });
            }
            __generate_html_temp.fields.push(temp_inputs);
        });
        __generate_html.push(__generate_html_temp);
        
      });
      
      var saveButton = $(".save_btn");
      jQuery.ajax({
        url: "<?php echo base_url(); ?>formbuilder/save",
        type: "POST",
        data: { id:1,data:JSON.stringify(__generate_html)},
        beforeSend: function () {
          $(saveButton).attr("disabled", true);
          $(saveButton).text("saving...");
        },
        success: function (response) {
          //console.log(response);
          $(saveButton).attr("disabled", false);
          $(saveButton).text("Save");
          $("#modalAddNewCustomerTypes").modal("hide");
        }
      });
      console.log(JSON.stringify(__generate_html));
  }

  $(document).ready( function () {

    if($('input[name="json_data_current"]').val() != '')
    {
      
      var __old_json_data = $('#json_data_current').val();
      __old_json_data = JSON.parse(__old_json_data);
      
      $.each( __old_json_data, function( key, value ) {
          $('.main_row_btn').click();
          $( '.main_row_append_box .dropper:eq('+key+') .group-description input[name="group-label"]' ).val(value.group_name);
          $( '.main_row_append_box .dropper:eq('+key+') .group-field-description input[name="group-field-description"]' ).val(value.group_description);

          $( '.main_row_append_box .dropper:eq('+key+')').html();
          
          $( '.main_row_append_box .dropper:eq('+key+') .form_builder_area').addClass('form_builder_area_droppable_'+key);

          $.each( value.fields, function( keyFields, valueFields ) {

            var field_data = valueFields;
            //label = '', placeholder = '', name = '', required = false
            var data_type = valueFields.input_type;
            if (data_type === 'text') {
              $('.form_builder_area_droppable_'+key).append(getTextFieldHTML(field_data.label, field_data.placeholder, field_data.name, field_data.required));
            }
            if (data_type === 'number') {
              $('.form_builder_area_droppable_'+key).append(getNumberFieldHTML(field_data.label, field_data.placeholder, field_data.name, field_data.required));
            }
            if (data_type === 'email') {
              $('.form_builder_area_droppable_'+key).append(getEmailFieldHTML(field_data.label, field_data.placeholder, field_data.name, field_data.required));
            }
            if (data_type === 'password') {
              $('.form_builder_area_droppable_'+key).append(getPasswordFieldHTML(field_data.label, field_data.placeholder, field_data.name, field_data.required));
            }
            if (data_type === 'textarea') {
              $('.form_builder_area_droppable_'+key).append(getTextAreaFieldHTML(field_data.label, field_data.placeholder, field_data.name, field_data.required));
            }
            if (data_type === 'date') {
              $('.form_builder_area_droppable_'+key).append(getDateFieldHTML(field_data.label, field_data.name, field_data.required));
            }
            if (data_type === 'button') {
              $('.form_builder_area_droppable_'+key).append(getButtonFieldHTML(field_data.btn_class,field_data.btn_value,field_data.name));
            }
            if (data_type === 'select') {
              $('.form_builder_area_droppable_'+key).append(getSelectFieldHTML(field_data.label, field_data.name, field_data.options,field_data.required));
            }
            if (data_type === 'radio') {
              $('.form_builder_area_droppable_'+key).append(getRadioFieldHTML(field_data.label, field_data.name, field_data.options, field_data.required));
            }
            if (data_type === 'checkbox') {
              $('.form_builder_area_droppable_'+key).append(getCheckboxFieldHTML(field_data.label, field_data.name, field_data.options, field_data.required));
            }

          });

      });

    }
  });

  $('#setformname').click(function(){
    window.open("<?php echo base_url('formbuilder/forms') ?>"+'/'+$('select[name="main_form_name"]').val(), '_self'); 
  });

</script>

<style>
  .form_builder_area .form_builder_field:first-child {
    margin-top: 0px;
  }
</style>