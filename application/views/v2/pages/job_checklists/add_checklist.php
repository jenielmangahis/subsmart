<?php include viewPath('v2/includes/header'); ?>

<style>
.checklist-items{
    margin-top: 15px;
    margin-bottom: 51px;
}
.checklist-form .form-control{
    width: 50%;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.checklist-container{
    padding: 0px;
    margin: 0px;
}
.checklist-container li{
    width: 50%;
    padding: 10px;
    font-size: 17px;
    margin: 10px 0px;
}
.checklist-container li a{
    float: right;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Create job checklist.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-mb">
        <?php include viewPath('flash'); ?>
        <?php echo form_open_multipart('job_checklists/create_checklist', [ 'id' => 'frm-create-checklist', 'class' => 'form-validate checklist-form', 'autocomplete' => 'off' ]); ?>
        <div class="form-group">
            <label>Checklist Name</label> <span class="form-required">*</span>
            <input type="text" name="checklist_name" value=""  class="form-control" required="" autocomplete="off" />
        </div>
        <div class="form-group">
            <label>Attach this checklist to all Work Orders for</label> <span class="form-required">*</span><br />                              
            <small>Select from the options below to which this checklist will be automatically attached when you create a new Work Order.</small>
            <select class="form-control" id="attach-to-work-order" name="attach_to_job_order" required="">
                <option value="">- Select -</option>
                <?php foreach($checklistAttachType as $key => $value){ ?>
                    <option value="<?= $key; ?>"><?= $value; ?></option>
                <?php } ?>
            </select>
        </div> 
        <div class="row">
            <div class="col-6">
            <div class="checklist-items">
            <h5 >Checklist Items <a href="javascript:void(0);" class="btn-add-checklist-item nsm-button primary" style="float:right;"><i class='bx bx-plus' ></i> Add Item</a></h5>
            <table class="nsm-table">
                <tbody class="checklist-container">
                </tbody>
            </table>
        </div> 
            </div>
        </div> 
        <div class="col-md-5" style="padding: 0px;margin-top: 110px;">                            
            <button type="submit" class="nsm-button primary btn-save-checklist">Save</button>
            <a class="nsm-button" href="<?php echo base_url('job_checklists/list'); ?>">Cancel</a>
        </div>
        <?php echo form_close(); ?>

    </div>
</div>
<!-- Modals -->
<?php include viewPath('v2/pages/job_checklists/modals/add_checklist_modal') ?>
<?php include viewPath('v2/includes/footer'); ?>

<script>
$(function(){
    $(".btn-add-checklist-item").click(function(){
        $("#modalAddChecklistItem").modal("show");
    });

    $("#frm-add-checklist-item").submit(function(e){
        e.preventDefault();
        var item_name = $("#item_name").val();
        var add_row = '<tr><td><input type="hidden" name="checklistItems[]" value="'+item_name+'" />'+item_name+'</td><td class="text-end"><a class="btn-remove-checklist-item nsm-button error small" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td></tr>';

        $(".checklist-container").append(add_row).children(':last').hide().fadeIn(300);

        $("#item_name").val("");
        $("#modalAddChecklistItem").modal("hide");

    });

    $(document).on('click', '.btn-remove-checklist-item', function(){
        // console.log($(this).parent('ul').find('li'));
        // console.log($(this).closest('li'));
        // $(this).closest('li').fadeOut(300, function(){
        //     $(this).remove();
        // });
        $(this).parent().parent().remove();
    });

    $("#frm-create-checklist").submit(function(e){
        e.preventDefault();
        var url = base_url + 'job_checklists/_create_checklist';
        $(".btn-save-checklist").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
                 type: "POST",
                 url: url,
                 data: $("#frm-create-checklist").serialize(),
                 dataType: 'json',
                 success: function(o)
                 {
                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Success',
                            text: 'Job checklist was successfully created.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.href = base_url + "job_checklists/list"; 
                        });
                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Cannot save data.',
                          text: o.msg
                        });
                    }

                    $(".btn-save-checklist").html('Save');
                 }
            });
        }, 300);        
    });
});
</script>