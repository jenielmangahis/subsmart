<?php include viewPath('v2/includes/header'); ?>
<style>
    @media (max-width: 768px) {
        .activity-log-email {
            display:none !important;
        }
        .table-icon, .collapse, .bx-chevron-down{
            display:none !important;
        }
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/activity_logs_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Track and monitor user activities
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Logs">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by <?php echo $sort_by; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li>
                                    <a class="dropdown-item" href="<?php echo base_url('activity_logs?sort=date_desc'); ?>">Newest First</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo base_url('activity_logs?sort=date_asc'); ?>">Oldest First</a>
                                </li>  
                            </ul>
                        </div>
                        <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">                                
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <?php } ?>
                        <div class="nsm-page-buttons page-button-container">
                            <div class="btn-group nsm-main-buttons">
                                <button type="button" class="btn btn-nsm" id="btn-export-list"><i class='bx bx-fw bx-export' style="position:relative;top:1px;"></i> Export</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                                    
                                    <li><a class="dropdown-item" id="btn-archived" href="javascript:void(0);">Archived</a></li>                               
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">
                <table class="nsm-table" id="activity-logs">
                    <thead>
                        <tr>
                            <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                                <td class="table-icon text-center sorting_disabled">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>
                            <?php } ?>
                            <td class="table-icon"></td>
                            <td class="show" data-name="LogUser" style="width:20%;"></td>                            
                            <td class="show" data-name="LogDetails" style="width:60%;">Activity</td>
                            <td class="show" data-name="LogDate">Date</td>    
                            <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                                <td data-name="Manage" style="width:2%;"></td>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($activityLogs)){ ?>
                            <?php foreach ($activityLogs as $log) { ?>
                              <tr>
                                <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                                    <td>
                                        <input class="form-check-input row-select table-select" name="logs[]" type="checkbox" value="<?= $log->id; ?>">
                                    </td>
                                <?php } ?>
                                <td><div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($log->user_id); ?>');"></div></td>
                                <td class="nsm-text-primary show">
                                    <label class="d-block fw-bold"><?php echo $log->first_name . ' ' . $log->last_name ?></label>
                                    <label class="content-subtitle activity-log-email fst-italic d-block"><i class='bx bx-envelope'></i><?php echo $log->email; ?></label>
                                </td>                                
                                <td  class="nsm-text-primary show"><?= $log->activity_name; ?></td>
                                <td class="show"><?= date("m/d/Y h:i:s A",strtotime($log->created_at)); ?></td>
                                <?php if(checkRoleCanAccessModule('activity-logs', 'delete')){ ?>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item delete-item" data-name="<?php echo ucwords(strtolower($row->FName)) . ' ' . ucwords(strtolower($row->LName)); ?>" name="btn_delete" href="javascript:void(0);" data-id="<?= $row->id; ?>">Delete</a></li>                                    
                                        </ul>
                                    </div>
                                </td>
                                <?php } ?>
                              </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No data found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </form>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-view-archive" tabindex="-1" aria-labelledby="modal-view-archive_label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">        
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">Archived Logs</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body" id="logs-archived-container"></div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    const numRowsPerPage = 10;

    $("#activity-logs").nsmPagination({itemsPerPage:numRowsPerPage});

    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));
    }, 1000));

    $(document).on('change', '#select-all', function(){
        $(`.row-select:checkbox:lt(${numRowsPerPage})`).prop('checked', this.checked);  
        let total= $('#activity-logs input[name="logs[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#activity-logs input[name="logs[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $('#btn-export-list').on('click', function(){
        location.href = base_url + 'activity_logs/export';
    });

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('#activity-logs input[name="logs[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Activity Logs',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'activity_logs/_archive_selected_activity_logs',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Activity Logs',
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }        
    });

    $('#btn-archived, #btn-mobile-archived').on('click', function(){
        $('#modal-view-archive').modal('show');

         $.ajax({
            type: "POST",
            url: base_url + "activity_logs/_archived_list",
            success: function(html) {    
                $('#logs-archived-container').html(html);
            },
            beforeSend: function() {
                $('#logs-archived-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $(document).on('click', '#with-selected-restore', function(){
        let total= $('#archived-logs input[name="logs[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Restore Logs',
                html: `Are you sure you want to restore selected rows?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'activity_logs/_restore_selected_logs',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Restore Logs',
                                    text: "Data restored successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }        
    });

    $(document).on('click', '#with-selected-perma-delete', function(){
        let total = $('#archived-logs input[name="logs[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Logs',
                html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'activity_logs/_permanently_delete_selected_logs',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Delete Logs',
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        //location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }        
    });

    $(document).on('click', '#btn-empty-archives', function(){        
        let total = $('#archived-logs input[name="logs[]"]').length;        
        if( total > 0 ){
            Swal.fire({
                title: 'Empty Archived',
                html: `Are you sure you want to <b>permanently delete</b> <b>${total}</b> archived logs? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'activity_logs/_delete_all_archived_logs',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Empty Archived',
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        //location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }else{
            Swal.fire({                
                icon: 'error',
                title: 'Error',              
                html: 'Archived is empty',
            });
        }        
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>