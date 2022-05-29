<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.select2-container--open {
    z-index: 9999999
}
.select2-container{
    width: 100% !important; 
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/admin_leads_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing of all lead types.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/lead_types') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Lead Types" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-type" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Lead Type</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Event Type Name">Name</td>                            
                            <td data-name="Manage" style="width: 5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($leadTypes)) :
                        ?>
                            <?php
                            foreach ($leadTypes as $type) :
                            ?>
                                <tr>
                                    <td><?= $type->lead_name; ?></td>                                                                        
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-edit-type" data-id="<?= $type->lead_id; ?>" data-name="<?= $type->lead_name; ?>" href="javascript:void(0);">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-delete-type" href="javascript:void(0);" data-name="<?= $type->lead_name; ?>" data-id="<?= $type->lead_id; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="3">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <nav class="nsm-table-pagination">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link disabled" href="#">Prev</a></li>
                                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link disabled" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!--Add New Lead Type modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewType" tabindex="-1" aria-labelledby="modalAddNewTypeLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Lead Type</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-lead-type">
                        <div class="modal-body">
                            <div class="row">  
                                <div class="col-md-12 mt-3">
                                    <label for="">Name</label>
                                    <input type="text" name="lead_type_name" id="lead-type-name" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-type">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Add Edit Lead Type modal-->
            <div class="modal fade nsm-modal fade" id="modalEditType" tabindex="-1" aria-labelledby="modalEditTypeLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Lead Type</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-lead-type">
                        <input type="hidden" name="ltid" id="edit-ltid" value="">
                        <div class="modal-body">
                            <div class="row">  
                                <div class="col-md-12 mt-3">
                                    <label for="">Name</label>
                                    <input type="text" name="lead_type_name" id="edit-lead-type-name" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-type">Save</button>
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
        location.href = base_url + 'admin/lead_types';
    });

    $(document).on('click','.btn-add-new-type',function(){
        $('#modalAddNewType').modal('show');
    });

    $(document).on('submit', '#frm-add-new-lead-type', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveLeadType';
        $(".btn-add-type").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-lead-type")[0]);   

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
                    $("#modalAddNewType").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Lead Type was successfully created.",
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

    $(document).on('click','.btn-edit-type', function(){
        var ltid = $(this).attr('data-id');
        var lead_type_name = $(this).attr('data-name');
        
        $('#edit-ltid').val(ltid);
        $('#edit-lead-type-name').val(lead_type_name);
        $('#modalEditType').modal('show');
    });

    $(document).on('submit','#frm-edit-lead-type', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateLeadType';
        $(".btn-update-type").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-lead-type")[0]);   

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
                    $("#modalEditType").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Lead Type was successfully updated.",
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

                $(".btn-update-type").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".btn-delete-type", function(e) {
        var ltid = $(this).attr("data-id");
        var lead_type = $(this).attr('data-name');        
        var url = base_url + 'admin/ajaxDeleteLeadType';

        Swal.fire({
            title: 'Delete Lead Type',
            html: "Are you sure you want to delete lead type <b>"+lead_type+"</b>?",
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
                    data: {ltid:ltid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Lead Type Data Deleted Successfully!",
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