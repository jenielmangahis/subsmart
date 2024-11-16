<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>
<style>
.nsm-profile-name{
  margin-top:9px;  
}
.taskhub-list .nsm-badge{
    font-size:14px;

}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li>
            <div class="nsm-fab-icon">
                <i class="bx bx-user-plus"></i>
            </div>
            <span class="nsm-fab-label">Add New</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/taskhub_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/taskhub_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">
                            Manage Taskhub task list options
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary" id="btn-create-task-list" href="javascript:void(0);"><i class='bx bx-fw bx-plus'></i> Add New</a>                            
                        </div>
                    </div>
                </div>
                <div class="nsm-widget-table">
                    <form id="frm-taskhub" method="POST">
                    <table class="nsm-table taskhub-list">
                        <thead>
                            <tr>
                                <td data-name="Name" style="width:90%;">Name</td>     
                                <td data-name="Color" style="width:10%;">Color</td> 
                                <td data-name="Manage" style=""></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($tasksList) > 0) : ?>
                                <?php foreach ($tasksList as $list) : ?>
                                    <tr>
                                        <td class="fw-bold nsm-text-primary nsm-link default"><?= $list->name; ?></td>   
                                        <td><div class="nsm-profile me-3" style="background-color:<?= $list->color; ?>; width: 40px;"></div></td>                                       
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item btn-edit-task-list" name="dropdown_edit" href="javascript:void(0);" data-id="<?= $list->id; ?>" data-color="<?= $list->color; ?>" data-name="<?= $list->name; ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item btn-delete-task-list" href="javascript:void(0);" data-id="<?= $list->id; ?>" data-name="<?= $list->name; ?>">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </form>
                </div>                
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-create-task-list" tabindex="-1" aria-labelledby="modal-quick-add-job-tag-label" aria-hidden="true">
        <div class="modal-dialog modal-md" style="margin-top:13%;">
            <form id="add-task-list-form" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Create Task List</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="task-list-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                                <input type="text" name="task_list_name" id="task-list-name" class="nsm-field form-control" placeholder="" required>
                            </div>
                            <div class="col-6 col-md-6">
                                <label class="content-subtitle fw-bold d-block mb-2">Color</label>
                                <input type="text" name="color_code" id="add-color-code" class="nsm-field form-control" required="" autocomplete="off">
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">                    
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-task-list">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-edit-task-list" tabindex="-1" aria-labelledby="modal-quick-add-job-tag-label" aria-hidden="true">
        <div class="modal-dialog modal-md" style="margin-top:13%;">
            <form id="edit-task-list-form" method="POST">
                <input type="hidden" name="task_list_id" id="task-list-id" />
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Edit Task List</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="task-edit-list-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                                <input type="text" name="task_list_name" id="task-edit-list-name" class="nsm-field form-control" placeholder="" required>
                            </div>
                            <div class="col-6 col-md-6">
                                <label class="content-subtitle fw-bold d-block mb-2">Color</label>
                                <input type="text" name="color_code" id="edit-color-code" class="edit-color-code nsm-field form-control" required="" autocomplete="off">
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">                    
                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-update-task-list">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/bootstrap-colorpicker.min.css") ?>">
<script src="<?= base_url("assets/js/bootstrap-colorpicker.min.js"); ?>"></script>
<script type="text/javascript">
$(function(){
    $(".nsm-table").nsmPagination({itemsPerPage:10});   

    $('#btn-create-task-list').on('click', function(){
        $('#modal-create-task-list').modal('show');
    });

    $('.btn-edit-task-list').on('click', function(){
        let id = $(this).attr('data-id');
        let name = $(this).attr("data-name");
        let color = $(this).attr("data-color");
        $('#task-edit-list-name').val(name);
        $('#task-list-id').val(id);
        $('#edit-color-code').val(color);
        $('#modal-edit-task-list').modal('show');
    });

    $('#add-color-code').colorpicker({
        horizontal: true,
        format: "hex"
    });

    $('#edit-color-code').colorpicker({
        horizontal: true,
        format: "hex"
    });

    $('#add-task-list-form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "taskhub/_create_task_list",
            dataType: 'json',
            data: $('#add-task-list-form').serialize(),
            success: function(data) {    
                $('#btn-save-task-list').html('Save');                   
                if (data.is_success) {
                    $('#modal-create-task-list').modal('hide');
                    Swal.fire({
                        title: 'Create Task List',
                        text: "Data was successfully created.",
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
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-task-list').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    })

    $('#edit-task-list-form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "taskhub/_update_task_list",
            dataType: 'json',
            data: $('#edit-task-list-form').serialize(),
            success: function(data) {    
                $('#btn-update-task-list').html('Save');                   
                if (data.is_success) {
                    $('#modal-edit-task-list').modal('hide');
                    Swal.fire({
                        title: 'Update Task List',
                        text: "Data was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        location.reload();
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-task-list').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    })    
    
    $(document).on("click", ".btn-delete-task-list", function() {
        let id = $(this).attr('data-id');
        let subject = $(this).attr("data-name");

        Swal.fire({
            title: 'Delete Task List',
            text: "Are you sure you want to delete task: " + subject + "?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('taskhub/_delete_task_list'); ?>",
                    dataType: 'json',
                    data: {
                        tsid: id
                    },
                    success: function(result) {
                        console.log(result);
                        if (result.is_success == 1) {
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Taskhub list data is successfully deleted!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'An Error Occured',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    //location.reload();
                                }
                            });
                        }
                    },
                });
            }
        });
    });

});
</script>
<?php include viewPath('v2/includes/footer'); ?>