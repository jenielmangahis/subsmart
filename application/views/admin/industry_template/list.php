<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.badge{
    padding: 10px;
    font-size: 14px;
}
.section-title {
    background-color: #666666;
    color: #ffffff !important;
    padding: 10px;
    margin-bottom: 10px;
}
.list-modules{
    list-style: none;
    padding: 0px;
}
.list-modules li{
    display: inline-block;
    width: 30%;
}
</style>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing of all industry templates.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/industry_templates') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Industry Templates" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by : <?= $cid_search; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/industry_templates'); ?>">All Industry Templates</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/industry_templates?status=active'); ?>">Status Active</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/industry_templates?status=deactivated'); ?>">Status Inactive</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-template" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Industry Template</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Template Name">Template Name</td>
                            <td data-name="Status" style="width:10%;">Status</td>
                            <td data-name="Manage" style="width: 10%;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $industryTemplate as $indTemplate){ ?>                       
                            <tr>
                                <td class="center"><?= $indTemplate->name; ?></td>
                                <td class="center">
                                    <?php if($indTemplate->status == 1) { ?>
                                        <span class="badge" style="background-color: #6a4a86; color: #ffffff;display: block; margin: 5px;">Active</span>
                                    <?php }else{ ?>
                                        <span class="badge" style="background-color: #dc3545; color: #ffffff;display: block; margin: 5px;">Inactive</span>
                                    <?php } ?>
                                </td>
                                <td class="center actions-col">
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item btn-edit-template" href="javascript:void(0)" data-id="<?php echo $indTemplate->id ?>"><i class='bx bx-fw bxs-edit'></i> Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-template" href="javascript:void(0);" data-name="<?= $indTemplate->name; ?>" data-id="<?= $indTemplate->id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!--Add New Industry Template modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewIndustryTemplate" tabindex="-1" aria-labelledby="modalAddNewIndustryTemplateLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content" style="width:620px;">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Industry Template</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-industry-template">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Name</label>
                                    <input type="text" name="template_name" id="template-name" class="form-control" required="">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" autocomplete="off">
                                        <option value="1" selected="">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title mt-5">Assign Modules</div>
                                    <ul class="list-modules" style="max-height: 200px; overflow-y: scroll;">                                    
                                        <?php foreach ($industryModules as $key => $industryModule) { ?>
                                            <li>
                                              <div class="checkbox">
                                                <input type="checkbox" class="form-check-input" name="modules[]" id="module-<?= $industryModule->id; ?>" value="<?php echo $industryModule->id; ?>" >
                                               <label class="" for="module-<?= $industryModule->id; ?>"><?php echo $industryModule->name; ?></label>
                                              </div>
                                            </li>
                                        <?php } ?>
                                  </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-template">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Industry Template modal-->
            <div class="modal fade nsm-modal fade" id="modalEditIndustryTemplate" tabindex="-1" aria-labelledby="modalEditIndustryTemplateabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content" style="width:620px;">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Industry Template</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-industry-template">
                        <div class="modal-body modal-edit-template-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-template">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/industry_templates';
    });

    $(document).on('click','.btn-add-new-template',function(){
        $('#modalAddNewIndustryTemplate').modal('show');
    });

    $(document).on('submit', '#frm-add-new-industry-template', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveIndustryTemplate';
        $(".btn-add-template").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-industry-template")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalAddNewIndustryTemplate").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Industry Template was successfully created.",
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
                    html: o.msg
                  });
                } 

                $(".btn-add-template").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-template', function(){
        var tid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_edit_industry_template';

        $('#modalEditIndustryTemplate').modal('show');
        $(".modal-edit-template-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {tid:tid},
             success: function(o)
             {          
                $('.modal-edit-template-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-industry-template', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateIndustryTemplate';
        $(".btn-update-template").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-industry-template")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalEditIndustryTemplate").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Industry Template was successfully updated.",
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
                    html: o.msg
                  });
                } 

                $(".btn-update-template").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-template", function(e) {
        var tid = $(this).attr("data-id");
        var template_name = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteIndustryTemplate';

        Swal.fire({
            title: 'Delete Industry Template',
            html: "Are you sure you want to delete industry template <b>"+template_name+"</b>?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {tid:tid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Industry Template Data Deleted Successfully!",
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
                            html: o.msg
                          });
                        }
                    },
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer_admin'); ?>