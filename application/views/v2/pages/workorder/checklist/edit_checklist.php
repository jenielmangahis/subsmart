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
                                Edit Checklist.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <?php echo form_open_multipart('workorder/update_checklist', [ 'class' => 'form-validate checklist-form', 'id' => 'frm-update-checklist', 'autocomplete' => 'off' ]); ?>
                <input type="hidden" name="cid" value="<?= $checklist->id; ?>" id="checklist-id">
                <div class="nsm-card">
                  <div class="nsm-card-content">
                        <div class="col-md-12">
                            <div class="col-sm-12">
                              <div class="row">
                                  <div class="col-5 col">
                                    <div class="nsm-card primary h-auto">
                                      <div class="form-group">
                                        <label for="formClient-Name">Checklist Name *</label>
                                        <input type="text" name="checklist_name" value="<?= $checklist->checklist_name; ?>"  class="form-control" required="" autocomplete="off" />
                                      </div>
                                      <div class="form-group mt-3">
                                        <label for="formClient-Name">Attach this checklist to all Work Orders for *</label><br />
                                        <small class="text-muted">Select from the options below to which this checklist will be automatically attached when you create a new Work Order.</small>
                                        <select class="groups-select form-control" id="attach-to-work-order" name="attach_to_work_order" required="">
                                          <option value="0">- Select -</option>
                                          <?php foreach($checklistAttachType as $key => $value){ ?>
                                              <option <?= $checklist->attach_to_work_order == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
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
                                          <ul class="checklist-container">
                                            <?php foreach( $checkListItems as $item ){ ?>
                                              <li>
                                                <input type="hidden" name="checklistItems[]" class="checklist_item" value="<?php echo $item->item_name; ?>" />
                                                <?php echo trim($item->item_name); ?><a class="btn-remove-checklist-item nsm-button primary small" href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                                              </li>
                                            <?php } ?>
                                          </ul>
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
                    <button type="submit" class="nsm-button primary" id="btn-update-checklist">Save</button>
                </div>
            </div>
        <?php echo form_close(); ?>

        <div class="modal fade" id="modalAddChecklistItem" data-bs-backdrop="static" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;">Add Checklist Item</span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
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
                                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
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

    $("#frm-add-checklist-item").submit(function(e){
        e.preventDefault();

        //Check if item exists
        var sSearch = $('#item_name').val();
        var is_exists = 0;
        var results = $('.checklist-container').find('.checklist_item').filter(function () {
            if ($(this).val() === sSearch) {
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
          var add_row = '<li><input type="hidden" name="checklistItems[]" class="checklist_item" value="'+item_name+'" />'+item_name+'<a class="btn-remove-checklist-item nsm-button primary small" href="javascript:void(0);"><i class="bx bx-trash"></i></a></li>';

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

    $("#frm-update-checklist").submit(function(e){
        e.preventDefault();
        var url = base_url + 'workorder/_update_checklist';
        $("#btn-update-checklist").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
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
                          title: 'Workorder Checklist',
                            text: 'Workorder checklist was successfully updated.',
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
                          title: 'Cannot find data.',
                          text: o.msg
                        });
                    }

                    $("#btn-update-checklist").html('Save');
                 }
            });
        }, 300);        
    });
});
</script>
