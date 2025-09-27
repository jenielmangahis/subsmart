<?php include viewPath('v2/includes/header'); ?>

<style>
.checklist-container{
    padding: 0px;
    margin: 0px;
}
.checklist-container li{
    width: 100%;
    padding: 10px;
    font-size: 17px;
    background-color: #6a4a86;
    color: #ffff;
    margin: 10px 0px;
}
.checklist-container li a{
    float: right;
}
.btn-remove-checklist-item{
  height:29px;

}
.btn-remove-checklist-item .bx{
  top: -4px;
  position: relative;
}
.btn-remove-checklist-item {
    background-color: #ffffff !important;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
      <?php include viewPath('v2/includes/page_navigations/workorder_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="nsm-page">
                <div class="nsm-page-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="nsm-callout primary">
                                <button><i class='bx bx-x'></i></button>
                                Add New Checklist.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <?php echo form_open_multipart('workorder/create_checklist', [ 'class' => 'form-validate checklist-form', 'id' => 'frm-create-checklist', 'autocomplete' => 'off' ]); ?>
                <div class="nsm-card">
                  <div class="nsm-card-content">
                        <div class="col-md-12">
                            <div class="col-sm-12">
                              <div class="row">
                                  <div class="col-5 col">
                                    <div class="nsm-card primary h-auto">
                                      <div class="form-group">
                                        <label for="formClient-Name">Checklist Name *</label>
                                        <input type="text" name="checklist_name" value=""  class="form-control" required="" autocomplete="off" />
                                      </div>
                                      <div class="form-group mt-3">
                                        <label for="formClient-Name">Attach this checklist to all Work Orders for * <i id="help-popover-attach" class='bx bx-fw bx-info-circle ms-2 text-muted'></i></label><br />
                                        <select class="groups-select form-select" id="attach-to-work-order" name="attach_to_work_order" required="">
                                          <option value="">- Select -</option>
                                          <?php foreach($checklistAttachType as $key => $value){ ?>
                                              <option value="<?= $key; ?>"><?= $value; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-7 col">
                                    <div class="nsm-card primary h-auto">
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <h5>Checklist Items</h5>
                                        </div>        
                                        <div class="col-sm-6">
                                          <a href="javascript:void(0);" class="btn-add-checklist-item nsm-button primary" style="float:right;">Add Item</a>
                                        </div> 
                                      </div>
                                      <div class="row" style="margin-top: 20px;">
                                        <div class="col-sm-12">
                                          <ul class="checklist-container"></ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3 text-end">                  
                    <button type="button" class="nsm-button btn-cancel">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-save-checklist">Save</button>
                </div>
            </div>
        <?php echo form_close(); ?>

        <div class="modal fade" id="modalAddChecklistItem" data-bs-backdrop="static" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;">Add Checklist Item</span>
                        <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-add-checklist-item', 'autocomplete' => 'off' ]); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="mb-2">Name</label>
                                    <div class="input-group mb-3">
                                      <input type="text" name="item_name" id="item_name" value="" class="form-control" autocomplete="off" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">                        
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="nsm-button primary btn-add-checklist">Save</button>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
    $(".btn-add-checklist-item").click(function(){
        $("#modalAddChecklistItem").modal("show");
    });

    $('.btn-cancel').on('click', function(){
      location.href = base_url + 'workorder/checklists';
    });

    $('#help-popover-attach').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Checklist that will be automatically attached when you create a new work order.';
        } 
    }); 

    $("#frm-add-checklist-item").submit(function(e){
        e.preventDefault();

        //Check if item exists
        var sSearch = $('#item_name').val();
        var is_exists = 0;
        var results = $('.checklist-container').find('*').filter(function () {
            if ($(this).text() === sSearch) {
              is_exists = 1;
            }
        });

        if (is_exists == 1) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Checklist item name already in the list',
          });
        }else{
          var item_name = $("#item_name").val();
          var add_row = '<li><input type="hidden" name="checklistItems[]" value="'+item_name+'" />'+item_name+'<a class="btn-remove-checklist-item nsm-button default small" href="javascript:void(0);"><i class="bx bx-trash"></i></a></li>';

          $(".checklist-container").append(add_row).children(':last').hide().fadeIn(300);

          $("#item_name").val("");
          $("#modalAddChecklistItem").modal("hide");
        }
    });

    $(document).on('click', '.btn-remove-checklist-item', function(){
        $(this).closest('li').fadeOut(300, function(){
            $(this).remove();
        });
    });

    $("#frm-create-checklist").submit(function(e){
        e.preventDefault();
        var url = base_url + 'workorder/_create_checklist';
        $("#btn-save-checklist").html('<span class="spinner-border spinner-border-sm m-0"></span>');
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
                            title: 'Workorder Checklist',
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
                          title: 'Error',
                          text: o.msg
                        });
                    }

                    $("#btn-save-checklist").html('Save');
                 }
            });
        }, 300);        
    });
});
</script>
