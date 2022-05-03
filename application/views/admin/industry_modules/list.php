<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.badge{
    padding: 10px;
    font-size: 14px;
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
                            Listing of all industry modules.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/industry_modules') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Industry Modules" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
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
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/industry_modules'); ?>">All Industry Modules</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/industry_modules?status=active'); ?>">Status Active</a></li>
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/industry_modules?status=deactivated'); ?>">Status Inactive</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-module" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Industry Module</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Module Name">Module Name</td>
                            <td data-name="Description">Description</td>
                            <td data-name="Status" style="width:10%;">Status</td>
                            <td data-name="Manage" style="width: 10%;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $industryModules as $industryModule){ ?>
                            <?php 
                                if( $industryModule->status == 1 ){
                                    $cell = 'cell-active';
                                    $status = "Active";
                                }else{
                                    $cell = 'cell-inactive';
                                    $status = "Inactive";
                                }
                            ?>
                            <tr>
                                <td class="center"><?= $industryModule->name; ?></td>
                                <td class="center"><?= $industryModule->description; ?></td>
                                <td class="center">
                                    <?php if($industryModule->status == 1) { ?>
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
                                                <a class="dropdown-item btn-edit-module" href="javascript:void(0)" data-id="<?php echo $industryModule->id ?>"><i class='bx bx-fw bxs-edit'></i> Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-module" href="javascript:void(0);" data-name="<?= $industryModule->name; ?>" data-id="<?= $industryModule->id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!--Add New Industry Module modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewIndustryModule" tabindex="-1" aria-labelledby="modalAddNewIndustryModuleLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Industry Module</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-industry-module">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Name</label>
                                    <input type="text" name="module_name" id="module-name" class="form-control" required="">
                                </div>
                                <div class="col-md-12">
                                    <label for="">Description</label>
                                    <textarea class="form-control" name="module_description" id="module-description" style="height: 150px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-module">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Industry Module modal-->
            <div class="modal fade nsm-modal fade" id="modalEditIndustryModule" tabindex="-1" aria-labelledby="modalEditIndustryModuleLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Industry Module</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-industry-module">
                        <div class="modal-body modal-edit-module-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-module">Save</button>
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
        location.href = base_url + 'admin/industry_modules';
    });

    $(document).on('click','.btn-add-new-module',function(){
        $('#modalAddNewIndustryModule').modal('show');
    });

    $(document).on('submit', '#frm-add-new-industry-module', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveIndustryModule';
        $(".btn-add-module").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-industry-module")[0]);   

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
                    $("#modalAddNewIndustryModule").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Industry Module was successfully created.",
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

                $(".btn-add-module").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-module', function(){
        var mid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_edit_industry_module';

        $('#modalEditIndustryModule').modal('show');
        $(".modal-edit-module-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {mid:mid},
             success: function(o)
             {          
                $('.modal-edit-module-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-industry-module', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateIndustryModule';
        $(".btn-update-module").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-industry-module")[0]);   

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
                    $("#modalEditIndustryModule").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Industry Module was successfully updated.",
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

                $(".btn-update-module").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-module", function(e) {
        var mid = $(this).attr("data-id");
        var module_name = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteIndustryModule';

        Swal.fire({
            title: 'Delete Industry Module',
            html: "Are you sure you want to delete industry module <b>"+module_name+"</b>?",
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
                    data: {mid:mid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Industry Module Data Deleted Successfully!",
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