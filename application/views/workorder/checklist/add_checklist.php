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
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="card p-40">
        <div class="container-fluid">
            <div class="row">
                    <div class="col">
                        <h3 class="m-0">Add New Checklist</h3>
                    </div>
                    <div style="background-color:#fdeac3;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px; width:100%;">
                        Create workorder checklist.    
                    </div>
                </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('workorder/create_checklist', [ 'class' => 'form-validate checklist-form', 'id' => 'frm-create-checklist', 'autocomplete' => 'off' ]); ?>

                          <div class="form-group">
                              <label>Checklist Name</label> <span class="form-required">*</span>
                              <input type="text" name="checklist_name" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <label>Attach this checklist to all Work Orders for</label> <span class="form-required">*</span><br />                              
                              <small>Select from the options below to which this checklist will be automatically attached when you create a new Work Order.</small>
                              <br />
                              <select class="form-control" id="attach-to-work-order" name="attach_to_work_order" required="">
                                <option value="0">- Select -</option>
                                <?php foreach($checklistAttachType as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                              </select>
                          </div>          
                          <br />
                          <div class="checklist-items">
                            <h5 style="width:50%;">Checklist Items <a href="javascript:void(0);" class="btn-add-checklist-item btn btn-sm btn-primary" style="float:right;"><span class="fa fa-plus-square fa-margin-right"></span> Add Item</a></h5>
                            
                            <ul class="checklist-container"></ul>
                          </div>              
                          <div class="col-md-5" style="padding: 0px;margin-top: 110px;">                            
                            <button type="submit" class="btn btn-primary btn-save-checklist">Save</button>
                            <a class="btn btn-default" href="<?php echo base_url('workorder/checklists'); ?>">Cancel</a>
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

    $("#frm-create-checklist").submit(function(e){
        e.preventDefault();
        var url = base_url + 'workorder/_create_checklist';
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
                            text: 'Workorder checklist was successfully created.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.href = base_url + "/workorder/checklists"; 
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