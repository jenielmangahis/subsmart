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
                        <div class="nsm-callout primary">Edit Email Template</div>
                    </div>
                </div>
                <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-update-email-template', 'autocomplete' => 'off' ]); ?> 
                <input type="hidden" name="etemplateid" value="<?php echo $template->id; ?>">
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
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Template Type</label>
                                        <select class="form-control nsm-field" data-style="btn-white" name="type_id" required>
                                            <option <?php echo $template->type_id == 1 ? 'selected="selected"' : ''; ?> value="1">Invoice</option>
                                            <option <?php echo $template->type_id == 2 ? 'selected="selected"' : ''; ?> value="2">Estimate</option>
                                            <option <?php echo $template->type_id == 3 ? 'selected="selected"' : ''; ?> value="3">Schedule</option>
                                            <!-- <option <?php echo $template->type_id == 4 ? 'selected="selected"' : ''; ?> value="4">Review</option>
                                            <option <?php echo $template->type_id == 5 ? 'selected="selected"' : ''; ?> value="5">Notes</option> -->
                                        </select>
                                    </div>    
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Template Name</label>
                                        <input type="text" name="title" value="<?= $template->title; ?>"  class="nsm-field form-control" required="" autocomplete="off" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Subject</label>
                                        <input type="text" name="subject" value="<?= $template->subject; ?>"  class="nsm-field form-control" required="" autocomplete="off" />
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Body</label>
                                        <textarea id="summernote" name="email_body" class="nsm-field form-control" required=""><?= $template->email_body; ?></textarea>
                                    </div>                                        
                                    <!-- <div class="col-12 col-md-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Details</label>
                                        <select class="form-control nsm-field" data-style="btn-white" name="details" required>
                                            <option <?php echo $template->details == 1 ? 'selected="selected"' : ''; ?> value="1">Default Template</option>
                                            <option <?php echo $template->details == 2 ? 'selected="selected"' : ''; ?> value="2">Custom Template</option>
                                        </select>
                                    </div>                                     -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('settings/email_templates') ?>'">Go Back to Email Template List</button>
                        <button type="submit" name="btn_save" class="nsm-button primary btn-update-email-template">Save</button>
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

    $("#frm-update-email-template").submit(function(e){
        e.preventDefault();
        var url = base_url + 'settings/_update_email_template';
        $.ajax({
                type: "POST",
                url: url,
                data: $("#frm-update-email-template").serialize(),
                dataType: 'json',
                success: function(o)
                {
                    $(".btn-update-email-template").html('Save');

                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Email Template',
                            text: 'Email template was successfully updated.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.href = base_url + "settings/email_templates"; 
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: o.msg
                        });
                    }
                },
                beforeSend: function(){
                    $(".btn-update-email-template").html('<span class="bx bx-loader bx-spin"></span>');
                }
        });      
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>