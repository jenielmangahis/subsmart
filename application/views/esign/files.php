<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link
	rel="stylesheet"
	href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
	integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
	crossorigin="anonymous"
/>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<style>
    .form-control { height: 34px !important; }
    .input-main-box:not(:first-child) {  margin-top:9px; }  
    #main-drag-and-drop-area { font-size: 1.1em !important; }
    .column { width: 100%; float: left; padding-bottom: 30px; }
    .portlet { margin: 1em 0em 1em 0; padding: 0.3em 0em 0.3em 0em; }
    .portlet-content { padding: 0.4em; /* border: 1px solid #cccccc; */ }
    .input-draggable-parent-div { padding-top: 20px; padding-bottom: 20px; }
    .col-form-label { line-height: 26px; font-weight: normal; font-size: 15px; }
    .portlet-toggle {position: absolute; top: 20%; right: 10px; margin-top: -8px; }
    .portlet-header { padding: 0.2em 0.3em; /* margin-bottom: 0.5em; */ position: relative; }
    .input-main-box { width:100%; border: 1px solid #cccccc; padding:3px; background:white; }
    .input-draggable-parent-child-div { padding-top:25px; min-height: 50px; padding-bottom:25px; }
    .portlet-placeholder { border: 1px dotted black; margin: 1em 1em 1em 0; height: 90px; width:100%; background: #cccccc; }
    .option_div .option .actions .add_action{ padding: 3px 6px; background: green; border-radius: 50px; }
    .option_div .option .actions .remove_action{ padding: 3px 6px; background: red; border-radius: 50px; }
</style>
<div class="wrapper">
	<br/>
	
	<div class="container-fluid <?php echo isset($next_step) && $next_step == 0 ? '' : 'd-none' ?>">
		<?php echo form_open_multipart('esign/fileSave', [ 'id' => 'upload_file', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
			<input type="hidden" value="0" name="next_step" />
			<input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
			<div class="card">
				<div class="form-group">
					<label for="docFile">Upload File</label>
					<input type="file" class="form-control" id="docFile" name="docFile" accept="application/pdf,application/vnd.ms-excel">
				</div>
				<div class="form-group">
					<button type="button" onClick="uploadOrNext(false)" id="click" class="btn btn-primary save-signature">Upload File</button>
					<button type="button" onClick="uploadOrNext(true)" id="click" class="btn btn-primary" >Next</button>
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>

	
	<div class="container-fluid <?php echo (isset($next_step) && $next_step == 2) ? '' : 'd-none' ?>">
		<?php echo form_open_multipart('esign/recipients', [ 'id' => 'upload_file', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
			<input type="hidden" value="3" name="next_step" />
			<input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
			<div class="card">
				<div class="form-group">
					<label for="title">RECIPIENTS</label>
					<ul id="sortable">
						<li class="ui-state-default ">
						<div class="col-md-1">
							<span class=""><i class="fa fa-bars" aria-hidden="true"></i></span>
						</div>
						
						<div class="col-md-6">						
							<button class="btn btn-danger" type="button" style="position: absolute;float: right;right: -366px;top: -40px;height: max-content !important;padding: 6px 20px;" onclick="removeRecp()" ><i class="fa fa-trash"></i></button>
							<div class="form-group" style="margin-bottom:15px !important;margin-top:15px !important;">
								<label>Name</label>
								<input required type="recipients" class="form-control" id="recipients" name="recipients[]" accept="application/pdf,application/vnd.ms-excel">
							</div>
							<div class="form-group" style="margin-bottom:15px !important;margin-top:15px !important;">
								<label>Email</label>
								<input required type="email" class="form-control" id="email" name="email[]">
							</div>
						</div>
						
						</li>
					</ul>
					<div class="col-md-6" style="padding-right:0px !important;">
						<input class="btn btn-success pull-right" type="button" onclick="addrecp()" value="Add Recipients">
					</div>
				</div>
				<div class="form-group">
					<button type="button" click='onbackclick("<?php echo url('esign/Files?id='.$file_id.'&next_step=0') ?>")'  class="btn btn-primary " >Back</button>
					<button type="submit" id="click" class="btn btn-primary " >Next</button>
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>

	<div class="container-fluid <?php echo (isset($next_step) && $next_step == 4) ? '' : 'd-none' ?>">
		<?php echo form_open_multipart('esign/recipients', [ 'id' => 'upload_file', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
			<input type="hidden" value="3" name="next_step" />
			<input type="hidden" value="<?php echo isset($file_id) && $file_id > 0 ? $file_id : 0 ?>" name="file_id" />
			<div class="card">
			<div class="form_builder">
    <div class="col-sm-12 mb-5 " >
      <div class="col-sm-2" style="float:left;">
        <nav class="nav-sidebar border border-dark">
          <ul class="nav">
              <li class="form_bal_textfield">
                  <a href="javascript:;">Add Tag <i class="fa fa-plus-circle pull-right"></i></a>
              </li>
          </ul>
      </nav>
      </div>
      <div class="col-sm-10 border border-dark p-0" style="min-height: 445px;float:left;">
            
          <div id="main-drag-and-drop-area" class="portlet-content input-draggable-parent-div connectedSortable p-3 pb-5" style="height:auto;min-height: 445px;">

           
          </div>
      </div>
    </div>
  </div>  
	</div>
		<?php echo form_close(); ?>
	</div>
</div><!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>
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
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="<?php echo $url->assets ?>/esign/js/main.js"></script>
<script>

function onbackclick(backlink) {
	// alert(backlink);
	// window.location.redirect = backlink;
}

function uploadOrNext(next = false) {
	if(next == true) { $('input[name="next_step"]').val(1); }
	$("#upload_file").submit();
}

$(document).ready( function () {
    $( "#sortable" ).sortable({handle: 'span'}).disableSelection();
});

function addrecp() {
	$('#sortable').append('<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class="col-md-1"><span class=""><i class="fa fa-bars" aria-hidden="true"></i></span></div><div class="col-md-6"><button class="btn btn-danger" type="button" style="position: absolute;float: right;right: -366px;top: -40px;height: max-content !important;padding: 6px 20px;" onclick="removeRecp()" ><i class="fa fa-trash"></i></button><div class="form-group" style="margin-bottom:15px !important;margin-top:15px !important;"><label>Name</label><input type="recipients" class="form-control" id="recipients" name="recipients[]" accept="application/pdf,application/vnd.ms-excel" required></div><div class="form-group" style="margin-bottom:15px !important;margin-top:15px !important;"><label>Email</label><input type="email" class="form-control" id="email" name="email[]" required></div></div></li>');
}

function removeRecp(e) {
	$(e).parents('.ui-state-default').remove();
}
</script>
<style>
#sortable li {
	padding: 5px;
    margin: 14px;
    width: 50%;
	border-left: 4px solid;
    padding-left: 12px;
    flex-wrap: wrap;
    padding: 4px 16px;
    position: relative;
    border-color: #ffd65b;
	border: 1px solid gray;
    border-left-width: 5px;
	list-style: none
}

#sortable {
	padding-left:0px;
}

</style>
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
  .form_bal_textfield  { width:100% !important;padding:5px 10px !important;background-color:yellow; }
</style>
<script>
	$( function() {
        $( ".input-draggable-parent-div" ).sortable({
          connectWith: ".connectedSortable",
          placeholder: "portlet-placeholder"
        }).disableSelection();
		$(".form_bal_textfield").draggable({
            helper: function () {
                return getTextFieldHTML();
            },
            connectToSortable: ".connectedSortable"
        });
	});

	function getTextFieldHTML(question_id = '0',question_label = '',question_description = '',question_required = false,question_encrypt = false, question_styling_class = '' , question_styling_maxlength = '' , question_styling_background_color = '#ffffff' , question_styling_font_color = '#000000') {
		var required = question_required == 'true' ? 'checked' : '';
		var encryptData = question_encrypt == 'true' ? 'checked' : '';

		var field = generateField();
		var html = '<div> Signature </div>';
		return html;
	}
</script>