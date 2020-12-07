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
/* 
@media screen,print
{
  .test {
            background:#0F0; width:500px; height:200px;
        }
} */
</style>
<div class="wrapper" role="wrapper">
		<div >
		<!-- wrapper__section -->
			<div class="card">
				<div class="container-fluid">
                    <div class="container">
        
                    <br>
                    <br>
                        <?=form_open_multipart('esign/saveCreatedTemplateDefaultTemp', ['id' => 'createTemplate']); ?>
                            <div class="form-group">
                                <label for="letterTitle">Title : </label>
                                <input type="text" class="form-control" value="<?=isset($template) ? $template->title : ""?>" name="letterTitle" id="">
                            </div>
                            
                             
                            <div id="print" class="print form-group">
                                <textarea id="summernote" name="template"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                               
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

                    
                </div>
			</div>
		</div>
		<!-- end container-fluid -->
</div>

<!-- Signature MODAL -->
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
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
      