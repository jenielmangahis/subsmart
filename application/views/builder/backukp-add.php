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
  .col-form-label { line-height: 26px; font-weight: normal;    font-size: 15px;}
  #main-drag-and-drop-area { font-size: 1.1em !important; }
</style>
<style>
  .column {
    width: 100%;
    float: left;
    padding-bottom: 30px;
  }
  .portlet {
    margin: 1em 0em 1em 0;
    padding: 0.3em 0em 0.3em 0em; 
  }
  .portlet-header {
    padding: 0.2em 0.3em;
    /* margin-bottom: 0.5em; */
    position: relative;
  }
  .portlet-toggle {
    position: absolute;
    top: 20%;
    right: 10px;
    margin-top: -8px;
  }
  .portlet-content {
    padding: 0.4em;
    /* border: 1px solid #cccccc; */
  }
  .portlet-placeholder {
    border: 1px dotted black;
    margin: 0 1em 1em 0;
    height: 50px;
  }.form-control {
    height: 34px !important;
  }

  .input-main-box {
    width:100%;
    border: 1px solid #cccccc;
    padding:3px;
    background:white;
  }

  .input-main-box:not(:first-child) { 
      margin-top:5px;
  }  
  .option_div .option .actions .add_action{
    padding: 3px 6px;
    background: green;
    border-radius: 50px;
  }
  .option_div .option .actions .remove_action{
    padding: 3px 6px;
    background: red;
    border-radius: 50px;
  }
</style>


<style>
.input-draggable-parent-div {
  padding-top: 20px;
    padding-bottom: 20px;
}
</style>
<!-- page wrapper start -->
<div class="wrapper">

  <div class="col-sm-12">
    <div class="row">
      <label class="col-sm-1 col-form-label text-right">Form Edit</label>
      <div class="col-sm-5">
        <select class="form-control">
          <?php foreach($jobs as $job) { ?>
            <option value="<?php echo $job->jobs_id; ?>"><?php echo $job->job_name; ?></option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">  Go </button>
    </div>
  </div>
  <div class="col-sm-12">
    <div class="form-group row">
      <label class="col-sm-1 col-form-label text-right">Form Title</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control">
      </div>
      <label class="col-sm-1 col-form-label text-right">Add to</label>
      <div class="col-sm-2">
        <select class="form-control">
          <?php foreach($jobs as $job) { ?>
            <option value="<?php echo $job->jobs_id; ?>"><?php echo $job->job_name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>

  <div class="form_builder">
    <div class="col-sm-12">
      <div class="col-sm-2">
        <nav class="nav-sidebar border border-dark">
          <ul class="nav pt-2">
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
              <li class="form_bal_fileupload">
                  <a href="javascript:;">File Upload <i class="fa fa-plus-circle pull-right"></i></a>
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
      <div class="col-sm-10 border border-dark p-0">
            
          <div id="main-drag-and-drop-area" class="portlet-content input-draggable-parent-div connectedSortable p-3 pb-5" style="height:auto;">

          












          </div>
          <!-- <div class="column" id="group-column">
           
            <div class="portlet">
              <div class="portlet-header">
                  <div class="row">
                    <label class="col-sm-2 col-form-label text-right">Group Label</label>
                    <div class="col-sm-5">
                      <input class="form-control" type="text">
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label text-right">Field Description</label>
                    <div class="col-sm-5">
                      <input class="form-control" type="text">
                    </div>
                  </div>
              </div>
              <div class="portlet-content input-draggable-parent-div connectedSortable" style="height:auto;">

                  <div class="input-main-box">
                    <div class="row">
                      <label class="col-sm-2 col-form-label text-right">Question / Label</label>
                      <div class="col-sm-5">
                        <input class="form-control" type="text">
                      </div>
                      <div class="col-sm-5 text-right">Text Field</div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label text-right">Field Description</label>
                      <div class="col-sm-5">
                        <input class="form-control" type="text">
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label text-right"></label>
                      <div class="col-sm-2 text-left">
                        <input class="" type="checkbox" value="true"> Required 
                      </div>
                      <div class="col-sm-2 text-left">
                        <input class="" type="checkbox" value="true"> Encrypt Data
                      </div>
                    </div>
                  </div>
                  <div class="input-main-box">
                    <div class="row">
                      <label class="col-sm-2 col-form-label text-right">Question / Label</label>
                      <div class="col-sm-5">
                        <input class="form-control" type="text">
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label text-right">Field Description</label>
                      <div class="col-sm-5">
                        <input class="form-control" type="text">
                      </div>
                    </div>
                  </div>


                  
              </div>
            </div>
          </div> -->
          <button onclick="addGroup()" class="pull-left">Add Group</button>
      </div>
    </div>
  </div>  
</div>
<!-- page wrapper end -->

<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/js/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>builder/js/template.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/js/app.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/html5sortable.js"></script>
<script type="text/javascript" src="<?php echo $url->assets ?>formbuilder/js/jquery.simulate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/draggable/1.0.0-beta.9/draggable.bundle.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <!-- <script src="<?php echo $url->assets ?>formbuilder/seconds-part/js/form_builder.js"></script> -->
<script>


  function addOptions(e) {
    $(e).parents('.option_div').append('<div class="col-sm-12 option"><label class="col-sm-2 col-form-label text-right option_text_label">Option 2</label> <input class="col-sm-4" type="text"><div class="col-sm-1 text-left actions"><a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> <a class=" col-form-label remove_action" onClick="removeOptions(this)"><i class="fa fa-minus"></i></a></div></div>');
    $(e).parents('.option_div').children('.option').each((key,value) => {
      $(e).parents('.option_div').children('.option').eq(key).find('.option_text_label').html('Option '+(key+1));
    });
  }

  function removeOptions(e) {
    $(e).parents('.option').remove();
  }

    $( function() {
        // $( ".column" ).sortable({
        //   connectWith: ".column",
        //   handle: ".portlet-header",
        //   cancel: ".portlet-toggle",
        //   placeholder: "portlet-placeholder ui-corner-all"
        // });
  
        $( ".portlet" )
          .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
          .find( ".portlet-header" )
            .addClass( "ui-widget-header ui-corner-all" )
            .prepend( "<!--<span class='ui-icon-minusthick portlet-toggle mr-5'><i class='fa fa-minus'></i></span><span class='ui-icon-minusthick portlet-toggle mr-1'><i class='fa fa-trash'></i></span>-->");
    
        // $( ".portlet-toggle" ).on( "click", function() {
        //   var icon = $( this );
        //   icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
        //   icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
        // });

        $( ".input-draggable-parent-div" ).sortable({
          connectWith: ".connectedSortable"
        }).disableSelection();


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
                return getSelectionFieldHTML();
            },
            connectToSortable: ".connectedSortable"
        });
        
        $(".form_bal_radio").draggable({
            helper: function () {
                return getSelectionFieldHTML();
            },
            connectToSortable: ".connectedSortable"
        });
        
        $(".form_bal_checkbox").draggable({
            helper: function () {
                return getSelectionFieldHTML();
            },
            connectToSortable: ".connectedSortable"
        });

        $(".form_bal_fileupload").draggable({
            helper: function () {
                return getSelectionFieldHTML();
            },
            connectToSortable: ".connectedSortable"
        });


        getFileUploadFieldHTML

    });


    function getTextFieldHTML(label = '', placeholder = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var placeholder = (placeholder == '') ? '' : placeholder;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;

        var html = '<div class="input-main-box input-main-box-'+field+' h-auto w-auto"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Text Field</div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" value="true"> Required </div> <div class="col-sm-2 text-left"> <input class="" type="checkbox" value="true"> Encrypt Data </div> </div> </div>';
        return html;
    }

    function getTextAreaFieldHTML(label = '', placeholder = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var placeholder = (placeholder == '') ? '' : placeholder;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;

        var html = '<div class="input-main-box input-main-box-'+field+' h-auto w-auto"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Text Area</div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox"> Required </div> <div class="col-sm-2 text-left"> <input class="" type="checkbox"> Encrypt Data </div> <div class="col-sm-2 text-left"> <input class="" type="checkbox"> Limit Text<input class="form-control" type="text"></div> <div class="col-sm-3 text-left"> <input class="" type="checkbox"> Use Rich Text Formatting</div> </div> </div>';
        return html;
    }

      function getSelectionFieldHTML(label = '', placeholder = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var placeholder = (placeholder == '') ? '' : placeholder;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;
        
        var html = '<div class="input-main-box input-main-box-'+field+' h-auto w-auto"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Selection</div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox"> Required </div> <div class="col-sm-2 text-left"> <input class="" type="checkbox"> Allow Other</div>';

        html = html + '<label class="text-right mb-0 pt-1">Selection Type</label> <div class="col-sm-4 text-left"> <input class="" type="radio"> Radio Button &nbsp;<input class="" type="radio"> Checkbox &nbsp;<input class="" type="radio"> Drop Down </div> </div> <br><div class="row option_div"> <div class="col-sm-12 option"> <label class="col-sm-2 col-form-label text-right option_text_label">Option 1</label> <input class="col-sm-4" type="text"> <div class="col-sm-1 text-left actions"> <a class=" col-form-label add_action" onClick="addOptions(this)" ><i class="fa fa-plus"></i></a> </div> </div></div></div>';
        
        return html;
    }

    function getFileUploadFieldHTML(label = '', placeholder = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var placeholder = (placeholder == '') ? '' : placeholder;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;

        var html = '<div class="input-main-box input-main-box-'+field+' h-auto w-auto"> <div class="row"> <label class="col-sm-2 col-form-label text-right">Question / Label</label> <div class="col-sm-5"> <input class="form-control" type="text"> </div> <div class="col-sm-4 text-right">Text Field</div></div> <div class="row"> <label class="col-sm-2 col-form-label text-right">Field Description</label> <div class="col-sm-5"> <input class="form-control" type="text"> </div> </div><div class="row"> <label class="col-sm-2 col-form-label text-right"></label> <div class="col-sm-2 text-left"> <input class="" type="checkbox" value="true"> Required </div> </div> </div>';
        return html;
    }

    function randomKey() {
      return Math.floor(Math.random() * (100000 - 1 + 1) + 57);
    }


    function addGroup() {

      var generateField = randomKey();

      $('#main-drag-and-drop-area').append('<div class=" input-main-box portlet" id="portlet-'+generateField+'"><div class="portlet-header"><div class="row"><label class="col-sm-2 col-form-label text-right">Group Label</label><div class="col-sm-5"><input class="form-control" type="text"></div></div><div class="row"><label class="col-sm-2 col-form-label text-right">Field Description</label><div class="col-sm-5"><input class="form-control" type="text"></div></div></div><div class="portlet-content input-draggable-parent-div connectedSortable"></div></div>');

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
          .prepend( "<!--<span class='ui-icon-minusthick portlet-toggle mr-5'><i class='fa fa-minus'></i></span><span class='ui-icon-minusthick portlet-toggle mr-1'><i class='fa fa-trash'></i></span>-->");
  
      // $( "#portlet-"+generateField+" .portlet-toggle" ).on( "click", function() {
      //   var icon = $( this );
      //   icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
      //   icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
      // });

      $( "#portlet-"+generateField+" .input-draggable-parent-div" ).sortable({
        connectWith: ".connectedSortable"
      }).disableSelection();

    }

  </script>
  <script>
  $( function() {
    
  } );
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
  .form_builder .nav-sidebar {
    border:0px
  } .form_builder ul li { padding: 0px; }
  .nav-sidebar ul i{ margin-top: 0.3rem; }
</style>