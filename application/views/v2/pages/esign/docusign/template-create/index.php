<?php
$queries = [];
parse_str($_SERVER['QUERY_STRING'], $queries);

$addRecipients = false;
if (array_key_exists('id', $queries) && array_key_exists('action', $queries)) {
    $addRecipients = $queries['action'] === 'add_fields' && is_numeric($queries['id']);
}

$viewPath = viewPath('v2/pages/esign/docusign/template-create/step1');
if ($addRecipients) {    
    $viewPath = viewPath('esign/docusign/template-create/step2');
}
?>

<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('v2/includes/header');?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?=put_header_assets();?>

<div class="page-content g-0" role="wrapper">
    <section class="container-fluid mt-3">
        <div class="card--loading">
            <div class="loader">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="nsm-page-nav mb-3">
                <ul>
                    <li class="active">
                        <a class="nsm-page-link" href="#">
                            <span class="active-header-nav">Create Template</span>
                        </a>
                    </li>

                    <li>
                        <a class="nsm-page-link" href="<?=base_url('esignmain')?>">
                            <span>Home</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="nsm-page-link" href="<?=base_url('eSign_v2/manage?view=inbox')?>">
                            <span>Manage</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="nsm-page-link" href="<?=base_url('vault_v2/mylibrary')?>">
                            <span>Templates</span>
                        </a>
                    </li>
                </ul>
            </div>

            <?php include $viewPath;?>
        </div>
    </section>

    <div class="modal fade nsm-modal fade" id="modalReplaceFile" tabindex="-1" aria-labelledby="modalReplaceFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="new_feed_modal_label"><i class='bx bx-file'></i> Replace File</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <form action="" id="frm-docfile-replace">
                    <input type="hidden" name="docid" id="docfile-id" value="" />
                    <div class="modal-body">
                        <input class="form-control" name="template_doc_file" type="file" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>

<style>
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 4;
        display: grid;
        place-content: center;
        background-color: #fff;
    }
</style>
<script>
$(function(){
    $('#frm-docfile-replace').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var _this    = $(this);
        _this.find("button[type=submit]").html("Saving");        

        $.ajax({
            type: "POST",
            url: base_url + "eSign_v2/_replace_docfile",
            data: formData, 
            dataType:'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    $('#modalReplaceFile').modal('hide');
                    Swal.fire({                        
                        text: "Document was successfully updated",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                          location.reload();  
                        //}
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }

                _this.find("button[type=submit]").html("<i class='bx bx-fw bx-calendar-plus'></i> Save");                
                
            }, beforeSend: function() {
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer');?>