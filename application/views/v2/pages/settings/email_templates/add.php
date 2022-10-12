<?php include viewPath('v2/includes/header'); ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
.list-icon{
  list-style: none;
  height: 400px;
  overflow: auto;
  padding: 6px;
}
.list-icon li{
  display: inline-block;
  width: auto;
  text-align: center;
  height:100px;
  margin: 3px;
}
.icon-image{
  height: 50px;
  width: 50px;
}
.list-icon a img {
    transition: all 0.3s linear;
}
.list-icon a:hover img {
    transform: scale(1.5);
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/email_templates_tabs'); ?>
    </div>    
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Create Email Template</div>
                    </div>
                </div>
                <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-add-email-template', 'autocomplete' => 'off' ]); ?>  
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span></span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Template Name</label>
                                        <input type="text" name="title" value=""  class="nsm-field form-control" required="" autocomplete="off" />
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Subject</label>
                                        <input type="text" name="subject" value=""  class="nsm-field form-control" required="" autocomplete="off" />
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Body</label>
                                        <textarea id="summernote" name="email_body" class="nsm-field form-control" required=""></textarea>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Template Type</label>
                                        <select class="form-control nsm-field" data-style="btn-white" name="type_id" required>
                                            <option  value="1">Invoice</option>
                                            <option  value="2">Estimate</option>
                                            <option  value="3">Schedule</option>
                                            <option  value="4">Review</option>
                                            <option  value="5">Notes</option>
                                        </select>
                                    </div>        
                                    <div class="col-12 col-md-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Details</label>
                                        <select class="form-control nsm-field" data-style="btn-white" name="details" required>
                                            <option  value="1">Default Template</option>
                                            <option  value="2">Custom Template</option>
                                        </select>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('settings/email_templates') ?>'">Go Back to Email Template List</button>
                        <button type="submit" name="btn_save" class="nsm-button primary btn-create-email-template">Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
$(function(){
    $('#summernote').summernote({height: 300,focus: false});

    $("#frm-add-email-template").submit(function(e){
        e.preventDefault();
        var url = base_url + 'settings/_create_email_template';
        $(".btn-create-email-template").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
                 type: "POST",
                 url: url,
                 data: $("#frm-add-email-template").serialize(),
                 dataType: 'json',
                 success: function(o)
                 {
                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Success',
                            text: 'Email template was successfully created.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.href = base_url + "/settings/email_templates"; 
                        });
                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Cannot save data.',
                          text: o.msg
                        });
                    }

                    $(".btn-create-email-template").html('Save');
                 }
            });
        }, 300);        
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>