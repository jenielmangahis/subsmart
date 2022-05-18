<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.select2-container--open {
    z-index: 9999999
}
.select2-container{
    width: 100% !important; 
}
.badge{
    display: block;
    width: 100%;
    padding: 5px;
}
.badge-danger {
    color: #fff;
    background-color: #dc3545;
}
.badge-primary {
    color: #fff;
    background-color: #007bff;
}
.badge-secondary {
    color: #fff;
    background-color: #6c757d;
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
                            Listing of all tasks.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/taskhub') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Tasks" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
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
                                <?php foreach($taskStatus as $ts){ ?>
                                    <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/taskhub?status='.$ts->status_id); ?>">Status <?= $ts->status_text; ?></a></li>
                                <?php } ?>
                                <?php foreach($optionPriority as $key => $value){ ?>
                                    <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/taskhub?priority='.$key); ?>">Priority <?= $value; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_taskhub') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>
                            <a class="nsm-button primary btn-add-new-task" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Task</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Company Name">Company</td>
                            <td class="Subject">Subject</td>
                            <td data-name="Customer">Customer</td>                            
                            <td data-name="Customer">Assigned User</td>              
                            <td data-name="Status" style="width:8%;">Priority</td>
                            <td data-name="Status" style="width:8%;">Status</td>
                            <td data-name="Date Completion" style="width:8%;">Date Completion</td>
                            <td data-name="Date Created" style="width:8%;">Date Created</td>
                            <td data-name="Manage" style="width: 5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($tasksHub)) :
                        ?>
                            <?php
                            foreach ($tasksHub as $th) :
                            ?>
                                <tr>
                                    <td><?= $th->business_name; ?></td>
                                    <td><?= $th->subject; ?></td>                                    
                                    <td><?= $th->customer_name; ?></td>
                                    <td><?= getTaskAssignedUser($th->task_id); ?></td>
                                    <td>
                                        <?php 
                                            switch ($th->priority):
                                                case 'High':
                                                    $class_priority = "badge-danger";
                                                    break;
                                                case 'Medium':
                                                    $class_priority = "badge-primary";
                                                    break;
                                                case 'Low':
                                                    $class_priority = "badge-secondary";
                                                    break;
                                            endswitch;
                                        ?>
                                        <span class="badge <?= $class_priority; ?>"><?php echo ucwords($th->priority); ?></span>
                                    </td>  
                                    <td><span class="badge badge-info" style="background-color: <?= $th->status_color; ?>"><?= $th->status_text; ?></span></td>
                                    <td><?= date("F d, Y",strtotime($th->estimated_date_complete)); ?></td>
                                    <td><?= date("F d, Y",strtotime($th->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-edit-task" data-id="<?= $th->task_id; ?>" href="javascript:void(0);">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-view-task" data-id="<?= $th->task_id; ?>" href="javascript:void(0);">View Comments</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-mark-completed" data-id="<?= $th->task_id; ?>" data-company="<?= $th->business_name; ?>" data-name="<?= $th->subject; ?>" href="javascript:void(0);">Mark Completed</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-task" href="javascript:void(0);" data-name="<?= $th->subject; ?>" data-company="<?= $th->business_name; ?>" data-id="<?= $th->task_id; ?>">Delete</a>
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

            <!--Add New Task modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewTask" tabindex="-1" aria-labelledby="modalAddNewTaskLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Task</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-task">
                        <div class="modal-body">
                            <div class="row">                                
                                <div class="col-md-12 mt-3">
                                    <label for="">Company</label>
                                    <select name="company_id" id="companyList" class="nsm-field mb-2 form-control d-select2-company" required="">     
                                        <option value="">Select Company</option>           
                                        <?php foreach($companies as $c){ ?>
                                            <option value="<?= $c->company_id; ?>"><?= $c->business_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="company-fields">
                                    <div class="row">
                                        <div class="col-6 mt-3">
                                            <label for="">Customer</label>
                                            <select name="customer_id" id="" class="nsm-field mb-2 form-control d-select2-customer" required="">     
                                                <option value="">Please Select Company</option>
                                            </select>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <label for="">Assigned to</label>
                                            <select name="user_id" id="" class="nsm-field mb-2 form-control d-select2-user" required="">     
                                                <option value="">Please Select Company</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mt-3">
                                        <label for="">Priority</label>
                                        <select class="form-control" name="priority" id="priority">
                                            <?php foreach($optionPriority as $key => $value){ ?>
                                                <option value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label for="">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <?php foreach($taskStatus as $ts){ ?>
                                                <option value="<?= $ts->status_id; ?>"><?= $ts->status_text; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label for="">Subject</label>
                                        <input type="text" name="subject" id="event-name" class="form-control" required="">
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label for="">Estimated Date of Completion</label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control dt-default" name="estimated_date_complete">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-3">
                                    <label for="">Description</label>
                                    <textarea class="form-control" name="description" id="task-editor" style="height:100px;"></textarea>
                                </div>                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-task">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Taskhub modal-->
            <div class="modal fade nsm-modal fade" id="modalEditTask" tabindex="-1" aria-labelledby="modalEditTaskLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Task</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-task">
                        <div class="modal-body modal-edit-task-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-task">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--View Taskhub modal-->
            <div class="modal fade nsm-modal fade" id="modalViewTask" tabindex="-1" aria-labelledby="modalViewTaskLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">View Comments</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body modal-view-task-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        </div>               
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    CKEDITOR.replace('task-editor',{
        height: '100px',
    });

    $('.d-select2-company').select2({
        placeholder: 'Select Company',
        allowClear: true,
        width: 'resolve'            
    });

    $('.dt-default').datepicker({
        format: 'mm/dd/yyyy',
    });

    $('.d-select2-customer').select2({
        placeholder: 'Select Customer',
        allowClear: true,
        width: 'resolve'            
    });

    $('.d-select2-user').select2({
        placeholder: 'Select User',
        allowClear: true,
        width: 'resolve'            
    });

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/taskhub';
    });

    $(document).on('click','.btn-add-new-task',function(){
        $('#modalAddNewTask').modal('show');
    });

    $(document).on('change', '#companyList', function(){
        var cid = $(this).val();
        var url = base_url + 'admin/ajax_load_taskhub_company_fields';
        $.ajax({
            type: "POST",
            url: url,
            data: {cid:cid},
            success: function(o)
            {          
                $('.company-fields').html(o);
            }
        });
    });

    $(document).on('click', '.btn-view-task', function(e){
        var thid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_view_task';

        $('#modalViewTask').modal('show');
        $(".modal-view-task-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {thid:thid},
             success: function(o)
             {          
                $(".modal-view-task-container").html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit', '#frm-add-new-task', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveTaskHub';
        $(".btn-add-task").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-task")[0]);   

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
                    $("#modalAddNewTask").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Taskhub was successfully created.",
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

                $(".btn-add-task").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-task', function(){
        var thid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_edit_taskhub';

        $('#modalEditTask').modal('show');
        $(".modal-edit-task-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {thid:thid},
             success: function(o)
             {          
                $('.modal-edit-task-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-task', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateTaskHub';
        $(".btn-update-task").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-task")[0]);   

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
                    $("#modalEditTask").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Taskhub was successfully updated.",
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

                $(".btn-update-task").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-task", function(e) {
        var thid = $(this).attr("data-id");
        var task_subject = $(this).attr('data-name');
        var company_name = $(this).attr('data-company');
        var url = base_url + 'admin/ajaxDeleteTaskHub';

        Swal.fire({
            title: 'Delete Task',
            html: "Are you sure you want to delete task <b>"+task_subject+"</b> from company <b>"+company_name+"</b>?",
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
                    data: {thid:thid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Taskhub Data Deleted Successfully!",
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

    $(document).on("click", ".btn-mark-completed", function(e) {
        var thid = $(this).attr("data-id");
        var task_subject = $(this).attr('data-name');
        var company_name = $(this).attr('data-company');
        var url = base_url + 'admin/ajaxTaskhubCompleteTask';

        Swal.fire({
            title: 'Complete Task',
            html: "Are you sure you want to complete task <b>"+task_subject+"</b> from company <b>"+company_name+"</b>?",
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
                    data: {thid:thid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Update Successful!',
                                text: "Taskhub Data Successfully Updated!",
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