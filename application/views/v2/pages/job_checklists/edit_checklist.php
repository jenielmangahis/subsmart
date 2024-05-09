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
    background-color: #32243d;
    color: #ffff;
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
                            Edit job checklist. 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-mb">
        <?php echo form_open_multipart('job_checklist/update_checklist', [ 'class' => 'form-validate checklist-form', 'id' => 'frm-update-checklist', 'autocomplete' => 'off' ]); ?>
        <input type="hidden" name="cid" value="<?php echo $checklist->id; ?>" id="checklist-id">

        <div class="form-group">
            <label>Checklist Name</label> <span class="form-required">*</span>
            <input type="text" name="checklist_name" value="<?= $checklist->checklist_name; ?>"  class="form-control" required="" autocomplete="off" />
        </div>
        <div class="form-group">
            <label>Attach this checklist to all Work Orders for</label> <span class="form-required">*</span><br />                              
            <small>Select from the options below to which this checklist will be automatically attached when you create a new Work Order.</small>
            <br />
            <select class="form-control" id="attach-to-job-id" name="attach_to_job_id" required="">
            <option value="">- Select -</option>
            <?php foreach($checklistAttachType as $key => $value){ ?>
                <option <?= $checklist->attach_to_job_id == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
            <?php } ?>
            </select>
        </div>   
    </div>
    <div class="row">
        <div class="col-6">
            <div class="checklist-items">
                <h5>Checklist Items <a href="javascript:void(0);" class="btn-add-checklist-item nsm-button primary" style="float:right;"><i class='bx bx-plus' ></i> Add Item</a></h5>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td>Item Name</td>
                            <td class="text-end">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($checklistItems as $ci){ ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="checklistItems[]" value="<?php echo $ci->item_name; ?>" />
                                    <?php echo $ci->item_name; ?>
                                </td>
                                <td class="text-end">
                                    <a class="btn-remove-checklist-item nsm-button error" href="javascript:void(0);"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>       
        <br />
                      
        <div class="col-md-5">                            
        <button type="submit" class="nsm-button primary btn-update-checklist">Save</button>
        <a class="btn btn-default" href="<?php echo base_url('job_checklists/list'); ?>">Cancel</a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<!-- Modal -->
<?php include viewPath('v2/pages/job_checklists/modals/edit_checklist_modal'); ?>

<?php include viewPath('v2/includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/custom.js"></script>

<script>
$(function(){
    $(".btn-add-checklist-item").click(function(){
        $("#modalAddChecklistItem").modal("show");
    });

    $("#frm-add-checklist-item").submit(function(e){
        e.preventDefault();
        var item_name = $("#item_name").val();
        var add_row = '<li><input type="hidden" name="checklistItems[]" value="'+item_name+'" />'+item_name+'<a class="btn-remove-checklist-item btn btn-danger btn-sm" href="javascript:void(0);"><i class="fa fa-trash"></i></a></li>';

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

    $("#frm-update-checklist").submit(function(e){
        e.preventDefault();
        var url = base_url + 'job_checklists/_update_checklist';
        $(".btn-update-checklist").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
                 type: "POST",
                 url: url,
                 data: $("#frm-update-checklist").serialize(),
                 dataType: 'json',
                 success: function(o)
                 {
                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Success',
                            text: 'Job checklist was successfully updated.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.href = base_url + "/job_checklists/list"; 
                        });
                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Cannot find data.',
                          text: o.msg
                        });
                    }

                    $(".btn-update-checklist").html('Save');
                 }
            });
        }, 300);        
    });
});
</script>