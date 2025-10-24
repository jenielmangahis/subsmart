<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>

<style>
.cell-active{
    background-color: #5bc0de;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 30px !important;
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
.card-help {
    padding-left: 45px;
    padding-top: 10px;
}
.text-ter {
    color: #888888;
}
.card-type.visa {
    background-position: 0 0;
}
.card-type {
    display: inline-block;
    width: 30px;
    height: 20px;
    background: url(<?= base_url("/assets/img/credit_cards.png"); ?>) no-repeat 0 0;
    background-size: cover;
    vertical-align: middle;
    margin-right: 10px;
}
.card-type.americanexpress {
    background-position: -83px 0;
}
.expired{
  color:red;
}
.card-type.discover {
    background-position: -125px 0;
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
                            Create great check list for employees or subcontractor to follow a series of item listings to meet all of your company’s requirements, expectations or reminders. This can be attached to estimate, workorder, invoices. A powerful addition to your forms.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-12 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('job-settings', 'write')){ ?>
                        <div class="nsm-page-buttons page-button-container">
                            <!-- <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('job_checklists/add_new');?>'">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button> -->
                            <button type="button" class="nsm-button primary" id="btn-add-new-job-checklist"><i class='bx bx-fw bx-plus'></i> Add New</button>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <table class="nsm-table">
                            <thead>
                                <tr>
                                    <td data-name="Name" style="width: 80%;">Name</td>
                                    <td data-name="Created" style="width: 15%;" data-name="Created">Date Created</td>
                                    <td data-name="Manage" style="width: 5%;" data-name="Manage"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($jobChecklists as $j){ ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?= $j->checklist_name; ?></td>
                                    <td><?= date("m/d/Y H:i:s", strtotime($j->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('job-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item edit-item" href="<?php echo base_url('job_checklists/edit_checklist/' . $j->id) ?>">Edit</a>
                                                    <!-- <a class="dropdown-item btn-edit-checklist-item" id="btn-edit-checklist-item" data-checklist-name="<?php echo $j->checklist_name; ?>" data-id="<?php echo $j->id; ?>" data-attach-to-job-id="<?php echo $j->attach_to_job_id; ?>" href="javascript:void(0);">Edit</a> -->
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('job-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item delete-job-checklist" href="javascript:void(0);" data-id="<?= $j->id; ?>" data-name="<?= $j->checklist_name; ?>">Delete</a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modalAddChecklistItem" tabindex="-1" role="dialog" style="z-index: 9999 !important;" aria-labelledby="modalAddChecklistItemTitle" aria-hidden="true">
    <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-add-checklist-item', 'autocomplete' => 'off' ]); ?>
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title content-title" id="exampleModalLongTitle">Add New Item</span>
            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
        </div>
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
        <div class="modal-footer">
        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="nsm-button primary btn-add-checklist">Add</button>
        </div>
    </div>
    </div>
    <?php echo form_close(); ?>
</div>

<div class="modal fade nsm-modal fade" id="modal-create-job-checklist" tabindex="-1" aria-labelledby="modal-create-job-checklist_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="job-checklist-create-form" class="job-checklist-create-form">
        <?php //echo form_open_multipart('job_checklists/create_checklist', [ 'id' => 'frm-create-checklist', 'class' => 'form-validate checklist-form', 'autocomplete' => 'off' ]); ?>
            <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Job Checklist</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 grid-mb">
                        <div class="form-group">
                            <label>Checklist Name</label> <span class="form-required">*</span>
                            <input type="text" name="checklist_name" value=""  class="form-control" required="" autocomplete="off" />
                        </div>
                        <div class="form-group mt-2">                              
                            <label>Customer Type <span style="margin-left:0px;" class="bx bxs-help-circle" id="help-popover-checklist"></span></label>
                            <select class="form-control" id="attach-to-work-order" name="attach_to_job_order" required="">
                                <?php foreach($checklistAttachType as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>  
                        <hr />
                        <div class="form-group mt-2"> 
                            <div class="row">
                                <div class="col-12">
                                <div class="checklist-items">
                                <h5 >Checklist Items <a href="javascript:void(0);" class="btn-add-checklist-item nsm-button primary" style="float:right;"><i class='bx bx-plus' ></i> Add Item</a></h5>
                                <table class="nsm-table mt-4" style="width: 90% !important; margin: 0 auto !important;">
                                    <tbody class="checklist-container">
                                    </tbody>
                                </table>
                            </div>                                 
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-4">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="job-checklist-create-button" class="nsm-button primary job-checklist-create-button">Save</button>
                </div>
            </div>
        <?php //echo form_close(); ?>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-edit-job-checklist" tabindex="-1" aria-labelledby="modal-edit-job-checklist_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="job-checklist-edit-form" class="job-checklist-edit-form">
            <input type="hidden" name="cid" value="" id="checklist-id" class="checklist-id">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Job Checklist</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 grid-mb">
                        <div class="form-group">
                            <label>Checklist Name</label> <span class="form-required">*</span>
                            <input type="text" name="checklist_name" value=""  class="form-control checklist-name" id="checklist-name" required="" autocomplete="off" />
                        </div>
                        <div class="form-group mt-2">                              
                            <label>Customer Type <span style="margin-left:0px;" class="bx bxs-help-circle" id="help-popover-checklist"></span></label>
                            <select class="form-control" id="attach-to-work-order" name="attach_to_job_order" required="">
                                <?php foreach($checklistAttachType as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>  
                        <hr />
                        <div class="form-group mt-2"> 
                            <div class="row">
                                <div class="col-12">
                                <div class="checklist-items">
                                <h5 >Checklist Items <a href="javascript:void(0);" class="btn-add-checklist-item nsm-button primary" style="float:right;"><i class='bx bx-plus' ></i> Add Item</a></h5>
                                <table class="nsm-table mt-4" style="width: 90% !important; margin: 0 auto !important;">
                                    <tbody class="checklist-container">
                                    </tbody>
                                </table>
                            </div>                                 
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-4">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="job-checklist-edit-button" class="nsm-button primary job-checklist-edit-button">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    function loadJobChecklistDataForm(jc_id) {
        alert(jc_id);
    }

    $(function(){
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on("click", ".delete-job-checklist", function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');

            Swal.fire({
                title: 'Delete Checklist',
                html: `Are you sure you want to delete this system package type <b>${name}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "job_checklists/_delete_checklist",
                        data: {id: id},
                        dataType:"json",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Checklist',
                                    text: "Data deleted successfully!",
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
                        },
                    });
                }
            });
        });

        $('#btn-add-new-job-checklist').on('click', function(){
            $("#modal-edit-job-checklist").modal("hide");
            $('#modal-create-job-checklist').modal('show');
        });    
        
        $(".btn-edit-checklist-item").click(function(){
            
            var data_id   = $(this).attr('data-id');
            var data_atji = $(this).attr('data-attach-to-job-id');
            var data_name = $(this).attr('data-checklist-name');

            $("#checklist-id").val(data_id);
            $("#checklist-name").val(data_name);

            $('#modal-create-job-checklist').modal('hide');
            $("#modal-edit-job-checklist").modal("show");
        });        
    });

    $(function(){
        $(".btn-add-checklist-item").click(function(){
            $("#modalAddChecklistItem").modal("show");
        });

        $('#help-popover-checklist').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return 'Customer type in which checklist will be automatically attached when you create a new work order.';
            } 
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
            $(this).parent().parent().remove();
        });

        $("#job-checklist-create-form").submit(function(e){
            e.preventDefault();
            var url = base_url + 'job_checklists/_create_checklist';
            $(".job-checklist-create-button").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#job-checklist-create-form").serialize(),
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

                        $(".job-checklist-create-button").html('Save');
                    }
                });
            }, 300);        
        });

        $("#job-checklist-edit-form").submit(function(e){
            e.preventDefault();
            var url = base_url + 'job_checklists/_update_checklist';
            $(".job-checklist-edit-button").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#job-checklist-edit-form").serialize(),
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

                        $(".job-checklist-edit-button").html('Save');
                    }
                });
            }, 300);        
        });        
    });    

</script>
<?php include viewPath('v2/includes/footer'); ?>

