<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.status-box{
    display: block;
    padding: 10px;
    width: 100%;
}
.colorpicker{
    display: block;
    width: 95%;
}
.edit-colorpicker{
    width: 95%;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/admin_taskhub'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing of all taskhub status.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/taskhub_status') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Status" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-task-status" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Status</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Status Name">Name</td>
                            <td data-name="Status Color" style="width: 5%;">Color</td>
                            <td data-name="Manage" style="width: 5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($taskStatus)) :
                        ?>
                            <?php
                            foreach ($taskStatus as $ts) :
                            ?>
                                <tr>
                                    <td><?= $ts->status_text; ?></td>    
                                    <td><span class="status-box" style="background-color: <?= $ts->status_color; ?>;"></span></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-edit-task-status" href="javascript:void(0);" data-id="<?= $ts->status_id; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-task-status" href="javascript:void(0);" data-name="<?= $ts->status_text; ?>" data-id="<?= $ts->status_id; ?>">Delete</a>
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

            <!--Add New Task Status modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewTaskStatus" tabindex="-1" aria-labelledby="modalAddNewTaskStatusLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Taskhub Status</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-task-status">
                        <div class="modal-body">
                            <div class="row">                                
                                <div class="col-md-12 mt-3 company-select">
                                    <label for="">Status Name</label>
                                    <input type="text" name="status_text" id="status-text" class="form-control" required="">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Status Color</label>
                                    <input type="text" name="status_color" class="form-control colorpicker" required="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-task-status">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Industry Module modal-->
            <div class="modal fade nsm-modal fade" id="modalEditTaskhubStatus" tabindex="-1" aria-labelledby="modalEditTaskhubStatusLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Taskhub Status</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-task-status">
                        <div class="modal-body modal-edit-task-status-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-task-status">Save</button>
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

    $('.colorpicker').colorpicker({
        format: "hex",
        horizontal:true
    });

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/taskhub_status';
    });

    $(document).on('click','.btn-add-new-task-status',function(){
        $('#modalAddNewTaskStatus').modal('show');
    });

    $(document).on('submit', '#frm-add-new-task-status', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveTaskhubStatus';
        $(".btn-add-task-status").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-task-status")[0]);   

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
                    $("#modalAddNewTaskStatus").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Taskhub Status was successfully created.",
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

                $(".btn-add-task-status").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-task-status', function(){
        var tsid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_edit_taskhub_status';

        $('#modalEditTaskhubStatus').modal('show');
        $(".modal-edit-task-status-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {tsid:tsid},
             success: function(o)
             {          
                $('.modal-edit-task-status-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-task-status', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateTaskhubStatus';
        $(".btn-update-task-status").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-task-status")[0]);   

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
                    $("#modalEditTaskhubStatus").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Taskhub Status was successfully updated.",
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

                $(".btn-update-task-status").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-task-status", function(e) {
        var tsid = $(this).attr("data-id");
        var status_name = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteTaskhubStatus';

        Swal.fire({
            title: 'Delete Taskhub Status',
            html: "Are you sure you want to delete taskhub status name <b>"+status_name+"</b>?",
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
                    data: {tsid:tsid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Taskhub Status Data Deleted Successfully!",
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