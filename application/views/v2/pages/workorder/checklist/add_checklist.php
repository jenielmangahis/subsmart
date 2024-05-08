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
                                        <label for="formClient-Name">Attach this checklist to all Work Orders for *</label><br />
                                        <small class="text-muted">Select from the options below to which this checklist will be automatically attached when you create a new Work Order.</small>
                                        <select class="groups-select form-control" id="attach-to-work-order" name="attach_to_work_order" required="">
                                          <option value="0">- Select -</option>
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
                                          <a href="javascript:void(0);" class="btn-add-checklist-item nsm-button primary" style="float:right;"><span class="fa fa-plus-square fa-margin-right"></span> Add Item</a>
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
                    <button type="submit" class="nsm-button" onclick="location.href='<?php echo base_url('workorder/checklists'); ?>'">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        <?php echo form_close(); ?>

        <div class="modal fade nsm-modal fade" id="modalAddChecklistItem" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content modal-md">
              <div class="modal-header">
                <span class="modal-title content-title" id="account-modal-label">Add New Item</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
              </div>
              <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-add-checklist-item', 'autocomplete' => 'off' ]); ?>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Item Name</label>
                      <input type="text" name="item_name" id="item_name" value="" class="form-control" autocomplete="off" required="">
                    </div>
                  </div>          
                </div>
              </div>
              <div class="modal-footer modal-footer-detail">
                  <div class="button-modal-list">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary btn-add-checklist">Add</button>
                  </div>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>

        </div>
    </div>
</div>
<!-- Modal -->
<?php include viewPath('v2/includes/plans/add_modal') ?>
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
        var add_row = '<li><input type="hidden" name="checklistItems[]" value="'+item_name+'" />'+item_name+'<a class="btn-remove-checklist-item nsm-button primary small" href="javascript:void(0);"><i class="bx bx-trash"></i></a></li>';

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
