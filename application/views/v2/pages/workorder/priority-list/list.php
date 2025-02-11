<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('workorder/priority/add') ?>'">
        <i class='bx bx-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Priority scheduling is a method of scheduling processes based on priority. In this method, the scheduler chooses the tasks to work as per the list of priority. Priority scheduling involves priority assignment to every process in events or jobs.
                        </div>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('work-order-settings', 'write')){ ?>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary btn-create-workorder-priority">
                                <i class='bx bx-fw bx-plus'></i> New Priority
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>                
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Title">Title</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($priorityList) > 0) : ?>
                            <?php foreach ($priorityList as $priority) : ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-list-check'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $priority->title; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('work-order-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item btn-edit-workorder-priority" href="javascript:void(0);" data-id="<?= $priority->id; ?>" data-name="<?= $priority->title;  ?>">Edit</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('work-order-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $priority->id; ?>" data-name="<?php echo $priority->title;  ?>">Delete</a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));
    });

    $(document).on('click', '.btn-create-workorder-priority', function(){
        $('#create_priority_modal').modal('show');
    });

    $(document).on('submit','#create-workorder-priority', function(e){
        e.preventDefault();

        var url = base_url + 'workorder/_create_workorder_priority';
        $(".btn-save-workorder-priority").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#create-workorder-priority")[0]);   

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
                    $("#create_priority_modal").modal("hide");         
                    Swal.fire({
                        title: 'Workorder Priority',
                        text: "Workorder priority has been added successfully.",
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

                $(".btn-save-workorder-priority").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click', '.btn-edit-workorder-priority', function(){
        var pid = $(this).attr('data-id');
        var priority_name = $(this).attr('data-name');
        
        $('#edit_priority_name').val(priority_name);
        $('#priority_id').val(pid);

        $('#edit_priority_modal').modal('show');
    });

    $(document).on('submit','#update-workorder-priority', function(e){
        e.preventDefault();

        var url = base_url + 'workorder/_update_workorder_priority';
        $(".btn-update-workorder-priority").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#update-workorder-priority")[0]);   

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
                    $("#edit_priority_modal").modal("hide");         
                    Swal.fire({
                        title: 'Workorder Priority',
                        text: "Workorder priority has been updated successfully.",
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

                $(".btn-update-workorder-priority").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-item", function() {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Workorder Priority',
            html: `Are you sure you want to delete this workorder priority <b>${name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "workorder/_delete_workorder_priority",
                    data: {id: id},
                    dataType:"json",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Workorder Priority',
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
</script>
<?php include viewPath('v2/includes/footer'); ?>