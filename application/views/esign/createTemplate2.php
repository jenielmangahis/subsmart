<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div id="summernote">Hello Summernote</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ko-KR.min.js"></script>
<script>
    
$(document).ready(function() {
  $('#summernote').summernote({
    height: 300
  });
});
</script>
</body>
</html> -->

<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); 
ini_set('max_input_vars', 30000);
?>
    <!-- <script src="https://app.creditrepaircloud.com/application/js/jQuery/jqprint.js" language="javascript" type="text/javascript"></script> -->
<style>
    fieldset {
    background-color: #eeeeee;
    }

    legend {
    background-color: gray;
    color: white;
    padding: 5px 10px;
    }

    input {
    margin: 5px;
    }
    
    [data-tiny-editor] {
      height: 400px;
    }
/* 
@media screen,print
{
  .test {
            background:#0F0; width:500px; height:200px;
        }
} */
</style>
<div class="wrapper" role="wrapper">
		<?php  /* include viewPath('includes/sidebars/signature'); */ ?>
		<?php /* include viewPath('includes/notifications'); */ ?>
		<div >
		<!-- wrapper__section -->
			<?php /* include viewPath('includes/notifications'); */?>
			<div class="card">
				<div class="container-fluid">
                    <!-- Main Selection -->
                        <!-- Main Selection -->
                    <div class="container">
                    <a href="<?=base_url('esign/templateLibrary')?>"> Go Back To Library </a>
                    <a style="float:right" href="categoryList">Manage template category</a>

                    <br>
                    <br>
                        <?=form_open_multipart('esign/saveCreatedTemplate', ['id' => 'createTemplate']); ?>
                            <div class="form-group">
                                <label for="letterTitle">Title : </label>
                                <input type="text" class="form-control" value="<?=isset($template) ? $template->title : ""?>" name="letterTitle" id="">
                            </div>
                            <?php
                                if(isset($template)){
                                    ?>
                                    <input type="hidden" value="<?=$template->esignLibraryTemplateId?>" name="esignLibraryTemplateId" id="">
                                    <?php
                                }
                            ?>
                            <div class="form-group">
                                <label for="library">Library : </label>
                                <select name="libraryId" id="library" class="select2LibrarySelection dropdown form-control">
                                    <option></option>
                                    <?php foreach($libraries as $library){ ?>
                                        <option <?=isset($template) && $template->fk_esignLibraryMaster == $library['pk_esignLibraryMaster'] ? "selected" : "" ?>  value="<?=$library['pk_esignLibraryMaster']?>"><?=$library['libraryName']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Category : </label>
                                <select required name="category_id" id="category" class="select2CategoorySelection dropdown form-control"> 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Status : </label>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="radio1">
                                        <input <?=isset($template) && $template->status ? "checked" : "" ?> type="radio" class="form-check-input" id="radio1" name="status" value="1" checked>Active
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="radio2">
                                        <input <?=isset($template) && !$template->status ? "checked" : "" ?> type="radio" class="form-check-input" id="radio2" name="status" value="0">In Active
                                    </label>
                                </div>
                            </div>
                                <div id="print" class="print form-group">
                                <!-- <textarea id="summernote" name="template"></textarea> -->
                                <div id="tinyEditor" data-tiny-editor>
     
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <input type="button" class="btn btn-info" onclick="printHtml()" value="Print">
                                <input type="button" class="btn btn-warning" value="Upload">
                            </div>
                        <?=form_close(); ?>
                        <?php if(isset($_GET['isSuccess']) && $_GET['isSuccess'] == 1){ ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Saved Successfully  
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="container">
                        <fieldset>
                            <legend><h3>Placeholder Information</h3></legend>
                            <div style="padding-left:0px; padding-right:20px; float:left;"> 
                                {company_logo} - <b>Company logo</b><br>
                                {client_suffix} - <b>Suffix of client</b><br>
                                {client_first_name} - <b>First name of client</b><br>
                                {client_middle_name} - <b>Middle name of client</b><br>
                                {client_last_name} - <b>Last name of client</b><br>
                                {client_address} - <b>Address of client</b><br>
                                {client_previous_address} - <b>Previous address of client</b><br>
                                {bdate} - <b>Birth date of client</b><br>
                                {ss_number} - <b>Last 4 of SSN of client</b><br>
                                {t_no} - <b>Telephone number of client</b><br>
                                {curr_date} - <b>Current date</b><br>
                                {client_signature} - <b>Client's signature</b><br>
                    {t_no} - <b>Telephone number of client</b></br>
                    {curr_date} - <b>Current date</b></br>
                    {client_signature} - <b>Client's signature</b></br>
                            </div>	
                            <div style="padding-left:10px; float:left"> 	
                                {bureau_name} - <b>Credit bureau name</b><br>
                                {bureau_address} - <b>Credit bureau name and address</b><br>
                                {account_number} - <b>Account number</b><br>	
                                {dispute_item_and_explanation} - <b>Dispute items and explanation</b><br>
                                {creditor_name} - <b>Creditor/Furnisher name</b><br>
                                {creditor_address} - <b>Creditor/Furnisher address</b><br>
                                {creditor_phone} - <b>Creditor/Furnisher phone number</b><br>
                                {creditor_city} - <b>Creditor/Furnisher city</b><br>
                                {creditor_state} - <b>Creditor/Furnisher state</b><br>
                                {creditor_zip} - <b>Creditor/Furnisher zip</b><br>
                                {report_number} - <b>Report number</b><br>
                    {business_name} - <b>Clients Business name</b></br>
                            </div>
                        </fieldset>
                    </div>
                </div>
			</div>
		</div>
		<!-- end container-fluid -->
</div>

<!-- Signature MODAL -->
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>

<script src="<?php echo $url->assets ?>esign/js/tinyEditor.js"></script>

<script>
        let defaultText = `<p>{client_first_name}&nbsp;{client_last_name}<br />{client_address}<br />{client_previous_address}<br />{bdate}<br />{ss_number}&nbsp;<br /><br />{bureau_address}</p>
<p>Attn.: Consumer Relations&nbsp;</p>
<p>{curr_date}&nbsp;</p>
<p>To Whom It May Concern,&nbsp;</p>
<p>On (DATE), I wrote to you requesting an investigation into items that I believed were (CHOOSE:&nbsp; INNACCURATE, OUTDATED OR OBSOLETE). To date, I have not received a reply from you or any acknowledgment that an investigation has begun. In my previous request, I listed my reasons for disputing the information. I have enclosed it again and request that you reply within a reasonable amount of time.</p>
<p>Since this is my (SECOND, THIRD,FOURTH, ETC) ) request, I will also be sending a copy of this letter to the Federal Trade Commission notifying them that I have signed receipts for letters sent to you and you have not complied with my request. I regret that I am being forced to take such action.&nbsp;<br /><br />Please see my reasons for dispute below:&nbsp;<br /><br />{dispute_item_and_explanation}<br /><br />I also understand that you are required to notify me of your investigation results within 30 days and provide me with an updated copy of my credit report. My contact information is provided below.&nbsp;</p>
<p><br />Sincerely,&nbsp;<br /><br />{client_signature}<br />_____________________________</p>
<p>{client_first_name}&nbsp;{client_last_name}</p>`;
        $(document).ready(function() {
            // $('.select2CategoorySelection').select2();
            function selectCategory(id){
                $('.select2CategoorySelection').select2({
                    placeholder: 'Please Select',
                    ajax: {
                        url: "<?=base_url('esign/getCategories/')?>"+id,
                        dataType: 'json',
                        delay: 0,
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    }
                });
            }
            selectCategory(<?=isset($template) && $template->fk_esignLibraryMaster ? $template->fk_esignLibraryMaster : -1 ?>)
            $('.select2LibrarySelection').select2({
                placeholder: 'Please Select',
                allowClear: true
            });
            $('.select2LibrarySelection').change(function(){
                let id = $(this).val();
                $('.select2CategoorySelection').val('');
                selectCategory(id);
            });
            $('#summernote').summernote({
                placeholder: 'Type Here ... ',
                tabsize: 2,
                height: 450,
            });
            <?php
            if(!isset($template)){
            ?>
                // $('#summernote').summernote('code', defaultText);
                $('#tinyEditor').html(defaultText);
            <?php
            }else {
            ?>
                // $('#summernote').summernote('code', `<?=isset($template) ? $template->content : ""?>`);
                $('#tinyEditor').html(`<?=isset($template) ? $template->content : ""?>`);
            <?php
            }
            ?>
        });

        function printHtml(){
            let currentHtml = $('#summernote').summernote('code');
            var a = window.open('', '_selfs', ''); 
            a.document.write('<html>'); 
            a.document.write('<body>'); 
            a.document.write(currentHtml); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        }
    </script>
      