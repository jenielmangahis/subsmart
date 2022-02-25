<?php include viewPath('includes/header'); ?>
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
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="card p-40">
        <div class="container-fluid">
            <div class="row">
                    <div class="col">
                        <h3 class="m-0">Edit Checklist</h3>
                    </div>
                    <div style="background-color:#fdeac3;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px; width:100%;">
                        Edit job checklist.    
                    </div>
                </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
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
                          <br />
                          <div class="checklist-items">
                            <h5 style="width:50%;">Checklist Items <a href="javascript:void(0);" class="btn-add-checklist-item btn btn-sm btn-primary" style="float:right;"><span class="fa fa-plus-square fa-margin-right"></span> Add Item</a></h5>
                            
                            <ul class="checklist-container">
                              <?php foreach($checklistItems as $ci){ ?>
                                <li>
                                  <input type="hidden" name="checklistItems[]" value="<?php echo $ci->item_name; ?>" /><?php echo $ci->item_name; ?><a class="btn-remove-checklist-item btn btn-danger btn-sm" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
                                </li>
                              <?php } ?>
                            </ul>
                          </div>              
                          <div class="col-md-5" style="padding: 0px;margin-top: 110px;">                            
                            <button type="submit" class="btn btn-primary btn-update-checklist">Save</button>
                            <a class="btn btn-default" href="<?php echo base_url('job_checklists/list'); ?>">Cancel</a>
                          </div>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->

        <!-- Modal Add Checklist Item --> 
        <div class="modal fade bd-example-modal-md" id="modalAddChecklistItem" tabindex="-1" role="dialog" aria-labelledby="modalAddChecklistItemTitle" aria-hidden="true">
          <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-add-checklist-item', 'autocomplete' => 'off' ]); ?>
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="padding: 1px 30px;">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Item Name</label>
                      <input type="text" name="item_name" id="item_name" value="" class="form-control" autocomplete="off" required="">
                    </div>
                  </div>          
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-add-checklist">Add</button>
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>

        </div>
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
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
        console.log($(this).parent('ul').find('li'));
        console.log($(this).closest('li'));
        $(this).closest('li').fadeOut(300, function(){
            $(this).remove();
        });
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