<?php include viewPath('v2/includes/header'); ?>
<style>
.nsm-badge{
    display: block;
    width: 100%;
    text-align: center;
}
.badge-danger{
    background-color:#f5c6cb !important;
    color:#721c24;
}
.modal {
    z-index: 1051 !important;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('email_campaigns/add_email_blast') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage Employee Overtime Requests
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search List">
                        </div>
                    </div>  
                    <div class="col-8 grid-mb text-end">                        
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">                          
                                <?php if(checkRoleCanAccessModule('user-settings-overtime-requests', 'delete')){ ?>  
                                <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="delete">Delete</a></li>    
                                <?php } ?>
                                 <?php if( logged('role') == 7 ){ ?>          
                                    <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="approve">Approve</a></li>                                
                                    <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="disapprove">Disapprove</a></li>                                
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">                            
                            <?php if(checkRoleCanAccessModule('user-settings-overtime-requests', 'write')){ ?>
                            <div class="btn-group nsm-main-buttons">
                                <button type="button" class="btn btn-nsm" id="btn-create-overtime-request"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Overtime</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down'></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                                    
                                    <li><a class="dropdown-item" id="btn-archived" href="javascript:void(0);">Archived</a></li>                               
                                    <li><a class="dropdown-item" id="btn-export-list" href="javascript:void(0);">Export</a></li>                               
                                </ul>
                            </div>
                            <?php } ?>
                        </div> 
                    </div>
                </div>
                <form id="frm-with-selected">   
                <input type="hidden" name="disapprove_reason" id="dpr" value="" />        
                <table class="nsm-table" id="tbl-overtime-list">
                    <thead>
                        <tr>
                            <td class="table-icon text-center sorting_disabled">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <td class="table-icon show"></td>
                            <td data-name="Name" style="width:40%;">Employee Name</td>
                            <td data-name="Date From">From</td>
                            <td data-name="Date To">To</td>                            
                            <td data-name="Total Hrs" style="width:10%;">Total hrs</td>    
                            <td data-name="Status" style="width:5%;">Status</td>
                            <td data-name="Manage" style="width:5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $overtimeRequests ){ ?>
                            <?php foreach($overtimeRequests as $or){ ?>
                                <tr>
                                    <td>
                                        <input class="form-check-input row-select table-select" name="requests[]" type="checkbox" value="<?= $or->id; ?>">
                                    </td>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-calendar-event'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary"><?= $or->employee; ?></td>
                                    <td class="nsm-text-primary"><?= date("m/d/Y",strtotime($or->date_from)) . ' ' . date("g:i A", strtotime($or->time_from)); ?></td>
                                    <td class="nsm-text-primary"><?= date("m/d/Y",strtotime($or->date_to)) . ' ' . date("g:i A", strtotime($or->time_to)); ?></td>
                                    <td class="nsm-text-primary"><?= $or->total_hrs; ?></td>
                                    <td class="nsm-text-primary">
                                            <?php if( $or->status == 1 ){ ?>
                                                <span class="nsm-badge default">Pending</span>
                                            <?php } ?>

                                            <?php if( $or->status == 2 ){ ?>
                                                <span class="nsm-badge success">Approved</span>
                                            <?php } ?>

                                            <?php if( $or->status == 3 ){ ?>
                                                <span class="nsm-badge badge-danger">Disapproved</span>
                                            <?php } ?>
                                    </td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('user-settings-overtime-requests', 'write') && $or->status == 1){ ?>                                                
                                                <li><a class="dropdown-item btn-edit-overtime-request" href="javascript:void(0);" data-id="<?= $or->id; ?>">Edit</a></li>
                                                <?php } ?>
                                                <li><a class="dropdown-item btn-view-leave-request" href="javascript:void(0);" data-id="<?= $or->id; ?>">View</a></li>
                                                <?php if( logged('role') == 7 ){ ?>    
                                                    <li><a class="dropdown-item btn-approve-overtime-request" href="javascript:void(0);" data-status="<?= $or->status; ?>" data-id="<?= $or->id; ?>">Approve</a></li>
                                                    <li><a class="dropdown-item btn-disapprove-overtime-request" href="javascript:void(0);" data-status="<?= $or->status; ?>" data-id="<?= $or->id; ?>">Disapprove</a></li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('user-settings-overtime-requests', 'delete')){ ?>    
                                                <li><a class="dropdown-item btn-delete-overtime-request" href="javascript:void(0);" data-id="<?= $or->id; ?>">Delete</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-with-selected-disapprove-overtime-request" tabindex="-1" aria-labelledby="modal-with-selected-disapprove-overtime-request_label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">            
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Disapprove Overtime Request</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <form id="frm-with-selected-disapprove" method="post">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="content-subtitle fw-bold d-block mb-2">Reason</label>
                            <textarea class="form-control" id="with-selected-disapprove-reason" name="disapprove_reason" style="height:200px;" required></textarea>
                        </div>                   
                    </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-with-selected-disapprove-overtime-request" form="frm-with-selected-disapprove">Save</button>
                </div>
            </div>            
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-create-overtime-request" tabindex="-1" aria-labelledby="modal-create-overtime-request_label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">            
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Overtime Request</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <form id="frm-create-overtime-request" method="post">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="content-subtitle fw-bold d-block mb-2">Date From</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="date" name="request_date_from" id="" class="form-control" value="<?= date("Y-m-d"); ?>" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="time" name="request_time_from" value="<?= date("g:i A"); ?>" id="" class="nsm-field form-control" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="content-subtitle fw-bold d-block mb-2">Date To</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="date" name="request_date_to" id="" class="form-control" value="<?= date("Y-m-d"); ?>" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="time" name="request_time_to" value="<?= date("g:i A"); ?>" id="" class="nsm-field form-control" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="content-subtitle fw-bold d-block mb-2">Reason</label>
                            <textarea name="request_reason" id="request-reason" class="nsm-field form-control" style="height:200px;" required></textarea>
                        </div>                            
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-save-overtime-request" form="frm-create-overtime-request">Save</button>
                </div>
            </div>            
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-edit-overtime-request" tabindex="-1" aria-labelledby="modal-edit-overtime-request_label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">            
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Edit Overtime Request</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm-update-overtime-request" method="post">
                            <div id="edit-overtime-request-container"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-update-overtime-request" form="frm-update-overtime-request">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-view-leave-request" tabindex="-1" aria-labelledby="modal-view-leave-request_label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">            
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">View Overtime Request</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="view-leave-request-container"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-disapprove-overtime-request" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <form id="frm-disapprove-overtime-request" method="post">
                    <input type="hidden" name="rid" id="disapprove-rid" value="0" />
                    <div class="modal-header">
                        <span class="modal-title content-title"><span id="modal-header-label">Disapprove Overtime Request</span></span>
                        <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Reason</label>
                                <textarea class="form-control" id="disapprove-reason" name="disapprove_reason" style="height:200px;" required></textarea>
                            </div>                   
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>                        
                        <button type="submit" class="nsm-button primary" id="btn-disapprove-overtime-request">Save</button>
                    </div>                                       
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-view-archive" tabindex="-1" aria-labelledby="modal-view-archive_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">        
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Archived Overtime Requests</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="overtime-requests-archived-container"></div>  
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
$(function(){    
    $(".nsm-table").nsmPagination();
    
    $(".timepicker").datetimepicker({
        format: 'hh:mm A'
    });

    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('#tbl-overtime-list input[name="requests[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#tbl-overtime-list input[name="requests[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));
    }, 1000));

    $('#btn-archived, #btn-mobile-archived').on('click', function(){
        $('#modal-view-archive').modal('show');

         $.ajax({
            type: "POST",
            url: base_url + "timesheet/_archived_overtime_request_list",
            success: function(html) {    
                $('#overtime-requests-archived-container').html(html);
            },
            beforeSend: function() {
                $('#overtime-requests-archived-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $('#btn-create-overtime-request').on('click', function(){
        $('#modal-create-overtime-request').modal('show');
    });

    $('.btn-edit-overtime-request').on('click', function(){
        var rid = $(this).attr('data-id');
        $('#rid').val(rid);
        $('#modal-edit-overtime-request').modal('show');
        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_edit_overtime_request",
            data: {rid:rid},
            success: function(html) {  
                $('#edit-overtime-request-container').html(html);
            },
            beforeSend: function() {
                $('#edit-overtime-request-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
        
    });

    $('.btn-view-leave-request').on('click', function(){
        var rid = $(this).attr('data-id');
        $('#rid').val(rid);
        $('#modal-view-leave-request').modal('show');
        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_view_overtime_request",
            data: {rid:rid},
            success: function(html) {  
                $('#view-leave-request-container').html(html);
            },
            beforeSend: function() {
                $('#view-leave-request-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('.btn-delete-overtime-request').on('click', function(){
        var rid = $(this).attr('data-id');
        var url = base_url + 'timesheet/_delete_overtime_request';

        Swal.fire({
            title: 'Delete Overtime Request',
            html: 'Proceeed with <b>deleting</b> selected overtime request?<br /><br /><small>Deleted data can be restored via archived list.</small>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {rid:rid},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Delete Overtime Request',
                            text: 'Overtime request was successfully deleted',
                            }).then((result) => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    }
                });
            }
        });
    });

    $('.btn-approve-overtime-request').on('click', function(){
        var rid = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var url = base_url + 'timesheet/_approve_overtime_request';

        if( status == 1 || status == 3 ){
            Swal.fire({
                title: 'Approve Request',
                html: 'Are you sure you want to <b>approve</b> selected overtime request?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {rid:rid},
                        dataType:'json',
                        success: function(result) {
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                icon: 'success',
                                title: 'Approve Request',
                                text: 'Overtime request was successfully updated',
                                }).then((result) => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        }else{
            // if( status == 2 ){
            //     var status_text = 'approved';
            // }else{
            //     var status_text = 'disapproved';
            // }
            var status_text = 'approved';
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: `Cannot update leave request status. Leave request is already <b>${status_text}</b>`,
            });
        }        
    });

    $('.btn-disapprove-overtime-request').on('click', function(){
        var rid = $(this).attr('data-id');
        var status = $(this).attr('data-status');

        if( status == 1 || status == 2 ){
            $('#disapprove-rid').val(rid);
            $('#disapprove-reason').val('');
            $('#modal-disapprove-overtime-request').modal('show');
        }else{           
            var status_text = 'disapproved';

            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: `Cannot update overtime request status. Overtime request is already <b>${status_text}</b>`,
            });
        }
        
    });

    $('.btn-with-selected').on('click', function(){
        var action = $(this).attr('data-action');

        var total_selected = $('input[name="requests[]"]:checked').length;
        if( total_selected > 0 ){
            if( action == 'delete' ){
                var title = 'Delete Overtime Requests';
                var msg = 'Proceed with <b>deleting</b> selected overtime requests?<br /><br /><small>Deleted data can be restored via archived list.</small>';
                var url = base_url + 'timesheet/_delete_selected_overtime_request';                
            }else if( action == 'approve' ){
                var title = 'Approve Overtime Requests';
                var msg = 'Proceed with <b>approving</b> selected overtime requests?';
                var url = base_url + 'timesheet/_approve_selected_overtime_request';
            }else if( action == 'disapprove' ){
                $('#modal-with-selected-disapprove-overtime-request').modal('show');
                return false;
            }

            Swal.fire({
                title: title,
                html: msg,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $('#frm-with-selected').serialize(),
                        dataType:'json',
                        success: function(result) {
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                icon: 'success',
                                title: title,
                                text: result.msg,
                                }).then((result) => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select row',
            });
        }        
    });

    $('#frm-disapprove-overtime-request').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_disapprove_overtime_request",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {                    
                $('#btn-disapprove-overtime-request').html('Save');                   
                if (data.is_success) {
                    $('#modal-disapprove-overtime-request').modal('hide');
                    Swal.fire({
                        text: "Overtime request was successfully updated",
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
                $('#btn-disapprove-overtime-request').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-with-selected-disapprove').on('submit', function(e){
        e.preventDefault();

        var reason = $('#with-selected-disapprove-reason').val();
        $('#dpr').val(reason);

        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_disapprove_selected_overtime_request",
            dataType: 'json',
            data: $('#frm-with-selected').serialize(),
            success: function(data) {                    
                $('#btn-with-selected-disapprove-overtime-request').html('Save');                   
                if (data.is_success) {
                    $('#modal-with-selected-disapprove-overtime-request').modal('hide');
                    Swal.fire({
                        text: "Overtime requests was successfully updated",
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
                $('#btn-with-selected-disapprove-leave-request').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-create-overtime-request').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_create_overtime_request",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {                    
                $('#btn-save-overtime-request').html('Save');                   
                if (data.is_success) {
                    $('#modal-create-overtime-request').modal('hide');
                    Swal.fire({
                        title: 'Create Overtime Request',
                        text: "Overtime request was successfully created",
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
                $('#btn-save-overtime-request').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-update-overtime-request').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_update_overtime_request",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {    
                $('#btn-update-overtime-request').html('Save');                   
                if (data.is_success) {
                    $('#modal-edit-overtime-request').modal('hide');
                    Swal.fire({
                        title: 'Update Overtime Request',
                        text: "Overtime request was successfully updated",
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
                $('#btn-update-overtime-request').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '#with-selected-restore', function(){
        let total= $('#archived-overtime-requests input[name="requests[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Restore Overtime Requests',
                html: `Are you sure you want to restore selected rows?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'timesheet/_restore_selected_overtime_requests',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Restore Overtime Requests',
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
        let total = $('#archived-overtime-requests input[name="requests[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Overtime Requests',
                html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'timesheet/_permanently_delete_selected_overtime_requests',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Delete Overtime Requests',
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
        let total = $('#archived-overtime-requests input[name="requests[]"]').length;        
        if( total > 0 ){
            Swal.fire({
                title: 'Empty Archived',
                html: `Are you sure you want to <b>permanently delete</b> <b>${total}</b> archived overtime requests? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'timesheet/_delete_all_archived_overtime_requests',
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

    $(document).on('click', '.btn-restore-overtime-request', function(){
        let rid   = $(this).attr('data-id');

        Swal.fire({
            title: 'Restore Overtime Request',
            html: `Are you sure you want to restore selected overtime request?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'timesheet/_restore_overtime_request',
                    data: {
                        rid: rid
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Restore Overtime Request',
                                html: "Data updated successfully!",
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
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            }
        });
    });

    $(document).on('click', '.btn-permanently-delete-overtime-request', function(){
        let rid = $(this).attr('data-id');

        Swal.fire({
            title: 'Delete Overtime Request',
            html: `Are you sure you want to <b>permanently delete</b> selected overtime request? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'timesheet/_delete_archived_overtime_request',
                    data: {
                        rid: rid
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Overtime Request',
                                html: "Data deleted successfully!",
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
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
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