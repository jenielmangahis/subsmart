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
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <?php if(checkRoleCanAccessModule('user-settings-overtime-requests', 'write')){ ?>
    <ul class="nsm-fab-options">        
        <li data-bs-toggle="modal" data-bs-target="#modal-create-overtime-request">
            <div class="nsm-fab-icon">
                <i class='bx bx-calendar'></i>
            </div>
            <span class="nsm-fab-label">Add Leave Request</span>
        </li>
        <li class="btn-export-list">
            <div class="nsm-fab-icon">
                <i class="bx bx-export"></i>
            </div>
            <span class="nsm-fab-label">Export List</span>
        </li>
        <li id="btn-mobile-archived">
            <div class="nsm-fab-icon">
                <i class='bx bx-archive'></i>
            </div>
            <span class="nsm-fab-label">Archived</span>
        </li>          
    </ul>
    <?php } ?>
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
                            Manage Employee Leave Requests
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <?php foreach( $employeeLeaveCredits as $value ){ ?>
                        <div class="col-6 col-md-3 col-lg-2">
                            <div class="nsm-counter success h-100 mb-2 ">
                                <div class="row h-100 w-auto">
                                    <div class=" w-100 col-md-8 text-start d-flex align-items-center  justify-content-between">
                                        <span><i class='bx bx-cog'></i> <?= $value['leave_type']; ?></span>
                                        <h2><?= $value['leave_credits']; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
                                <?php if(checkRoleCanAccessModule('user-settings-leave-requests', 'delete')){ ?>  
                                <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="delete">Delete</a></li>    
                                <?php } ?>
                                 <?php if( logged('role') == 7 ){ ?>          
                                    <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="approve">Approve</a></li>                                
                                    <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="disapprove">Disapprove</a></li>                                
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">                            
                            <?php if(checkRoleCanAccessModule('user-settings-leave-requests', 'write')){ ?>
                            <div class="btn-group nsm-main-buttons">
                                <button type="button" class="btn btn-nsm" id="btn-create-leave-request"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Leave Request</button>
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
                <table class="nsm-table" id="tbl-leave-list">
                    <thead>
                        <tr>
                            <td class="table-icon text-center sorting_disabled">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <td class="table-icon show"></td>
                            <td data-name="Name" style="width:30%;">Employee Name</td>
                            <td data-name="Leave Type">Leave Type</td>
                            <td data-name="Date From">Date From</td>
                            <td data-name="Date To">Date To</td>                            
                            <td data-name="Status" style="width:5%;">Status</td>
                            <td data-name="Manage" style="width:5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($leaveRequests as $lr){ ?>
                            <tr>
                                <td>
                                    <input class="form-check-input row-select table-select" name="requests[]" type="checkbox" value="<?= $lr->id; ?>">
                                </td>
                                <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-calendar-event'></i>
                                        </div>
                                    </td>
                                <td class="nsm-text-primary"><?= $lr->employee; ?></td>
                                <td class="nsm-text-primary"><?= $lr->leave_type; ?></td>
                                <td class="nsm-text-primary"><?= date("m/d/Y",strtotime($lr->date_from)); ?></td>
                                <td class="nsm-text-primary"><?= date("m/d/Y",strtotime($lr->date_to)); ?></td>
                                <td class="nsm-text-primary">
                                        <?php if( $lr->status == 1 ){ ?>
                                            <span class="nsm-badge default">Pending</span>
                                        <?php } ?>

                                        <?php if( $lr->status == 2 ){ ?>
                                            <span class="nsm-badge success">Approved</span>
                                        <?php } ?>

                                        <?php if( $lr->status == 3 ){ ?>
                                            <span class="nsm-badge badge-danger">Disapproved</span>
                                        <?php } ?>
                                </td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <?php if(checkRoleCanAccessModule('user-settings-leave-requests', 'write') && $lr->status == 1){ ?>          
                                                <li><a class="dropdown-item btn-edit-leave-request" href="javascript:void(0);" data-id="<?= $lr->id; ?>">Edit</a></li>
                                            <?php } ?>
                                            <li><a class="dropdown-item btn-view-leave-request" href="javascript:void(0);" data-id="<?= $lr->id; ?>">View</a></li>
                                            <?php if(checkRoleCanAccessModule('user-settings-leave-requests', 'write')){ ?>          
                                                <li><a class="dropdown-item btn-approve-leave-request" href="javascript:void(0);" data-status="<?= $lr->status; ?>" data-id="<?= $lr->id; ?>">Approve</a></li>
                                                <li><a class="dropdown-item btn-disapprove-leave-request" href="javascript:void(0);" data-status="<?= $lr->status; ?>" data-id="<?= $lr->id; ?>">Disapprove</a></li>
                                            <?php } ?>
                                            <?php if(checkRoleCanAccessModule('user-settings-leave-requests', 'delete')){ ?>          
                                            <li><a class="dropdown-item btn-delete-leave-request" href="javascript:void(0);" data-id="<?= $lr->id; ?>">Delete</a></li>
                                            <?php } ?>
                                        </ul>
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

    <div class="modal fade" id="modal-with-selected-disapprove-leave-request" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <form id="frm-with-selected-disapprove" method="post">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-x-circle'></i> <span id="modal-header-label">Disapprove Leave Request</span></span>
                    <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="content-subtitle fw-bold d-block mb-2">Reason</label>
                            <textarea class="form-control" id="with-selected-disapprove-reason" name="disapprove_reason" style="height:200px;" required></textarea>
                        </div>                   
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>                        
                    <button type="submit" class="nsm-button primary" id="btn-with-selected-disapprove-leave-request">Save</button>
                </div> 
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-create-leave-request" tabindex="-1" aria-labelledby="modal-create-leave-request_label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">        
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Leave Request</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <form id="frm-create-leave-request" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Leave Type</label>
                                <select class="form-control" name="leave_type" id="leave-type" required>
                                    <?php foreach( $leaveTypes as $lt ){ ?>
                                        <option value="<?= $lt->id; ?>"><?= $lt->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Date From</label>
                                <input type="date" name="request_date_from" value="<?= date("Y-m-d"); ?>" id="request-date-from" class="nsm-field form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Date To</label>
                                <input type="date" name="request_date_to" value="<?= date("Y-m-d"); ?>" id="request-date-to" class="nsm-field form-control" placeholder="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Reason</label>
                                <textarea name="request_reason" id="request-reason" class="nsm-field form-control" required></textarea>
                            </div>                            
                        </div> 
                    </form>
                </div>  
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="btn-save-leave-request" form="frm-create-leave-request">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-edit-leave-request" tabindex="-1" aria-labelledby="modal-edit-leave-request_label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">            
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Edit Leave Request</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm-update-leave-request" method="post">
                            <div id="edit-leave-request-container"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-update-leave-request" form="frm-update-leave-request">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-view-leave-request" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-search-alt-2'></i> <span id="modal-header-label">View Leave Request</span></span>
                    <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                </div>
                <div class="modal-body" id="view-leave-request-container"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-disapprove-leave-request" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="frm-disapprove-leave-request" method="post">
                    <input type="hidden" name="rid" id="disapprove-rid" value="0" />
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-x-circle'></i> <span id="modal-header-label">Disapprove Leave Request</span></span>
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
                        <button type="submit" class="nsm-button primary" id="btn-disapprove-leave-request">Save</button>
                    </div>                                       
                </form>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
$(function(){    
    $(".nsm-table").nsmPagination();
    
    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('#tbl-leave-list input[name="requests[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#tbl-leave-list input[name="requests[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));
    }, 1000));

    $('#btn-create-leave-request').on('click', function(){
        $('#modal-create-leave-request').modal('show');
    });

    $('.btn-edit-leave-request').on('click', function(){
        var rid = $(this).attr('data-id');
        $('#rid').val(rid);
        $('#modal-edit-leave-request').modal('show');
        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_edit_leave_request",
            data: {rid:rid},
            success: function(html) {  
                $('#edit-leave-request-container').html(html);
            }
        });
        
    });

    $('.btn-view-leave-request').on('click', function(){
        var rid = $(this).attr('data-id');
        $('#rid').val(rid);
        $('#modal-view-leave-request').modal('show');
        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_view_leave_request",
            data: {rid:rid},
            success: function(html) {  
                $('#view-leave-request-container').html(html);
            }
        });
    });

    $('.btn-delete-leave-request').on('click', function(){
        var rid = $(this).attr('data-id');
        var url = base_url + 'timesheet/_delete_leave_request';

        Swal.fire({
            title: 'Delete',
            html: 'Proceeed with <b>deleting</b> selected leave request?',
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
                            title: 'Success',
                            text: 'Data was successfully deleted',
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

    $('.btn-approve-leave-request').on('click', function(){
        var rid = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var url = base_url + 'timesheet/_approve_leave_request';

        if( status == 1 || status == 3 ){
            Swal.fire({
                title: 'Update Status',
                html: 'Are you sure you want to <b>approve</b> selected leave request?',
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
                                title: 'Success',
                                text: 'Data was successfully updated',
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

    $('.btn-disapprove-leave-request').on('click', function(){
        var rid = $(this).attr('data-id');
        var status = $(this).attr('data-status');

        if( status == 1 || status == 2 ){
            $('#disapprove-rid').val(rid);
            $('#disapprove-reason').val('');
            $('#modal-disapprove-leave-request').modal('show');
        }else{
            // if( status == 2 ){
            //     var status_text = 'approved';
            // }else{
            //     var status_text = 'disapproved';
            // }
            var status_text = 'disapproved';

            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: `Cannot update leave request status. Leave request is already <b>${status_text}</b>`,
            });
        }
        
    });

    $('.btn-with-selected').on('click', function(){
        var action = $(this).attr('data-action');

        var total_selected = $('input[name="row_selected[]"]:checked').length;
        if( total_selected > 0 ){
            if( action == 'delete' ){
                var msg = 'Proceed with <b>deleting</b> selected leave requests?';
                var url = base_url + 'timesheet/_delete_selected_leave_request';
            }else if( action == 'approve' ){
                var msg = 'Proceed with <b>approve</b> selected leave requests?';
                var url = base_url + 'timesheet/_approve_selected_leave_request';
            }else if( action == 'disapprove' ){
                $('#modal-with-selected-disapprove-leave-request').modal('show');
                return false;
            }

            Swal.fire({
                title: 'With Selected Action',
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
                                title: 'Success',
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

    $('.btn-delete-leave-type').on('click', function(){
        var leave_type = $(this).attr('data-name');
        var lid = $(this).attr('data-id');

        Swal.fire({
            title: 'Delete',
            html: `Proceed with deleting leave type <b>${leave_type}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "leave_type/_delete_leave_type",
                    data: {lid:lid},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data was successfully deleted.',
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

    $('#frm-disapprove-leave-request').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_disapprove_leave_request",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {                    
                $('#btn-disapprove-leave-request').html('Save');                   
                if (data.is_success) {
                    $('#modal-disapprove-leave-request').modal('hide');
                    Swal.fire({
                        text: "Leave request was successfully updated",
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
                $('#btn-disapprove-leave-request').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-with-selected-disapprove').on('submit', function(e){
        e.preventDefault();

        var reason = $('#with-selected-disapprove-reason').val();
        $('#dpr').val(reason);

        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_disapprove_selected_leave_request",
            dataType: 'json',
            data: $('#frm-with-selected').serialize(),
            success: function(data) {                    
                $('#btn-with-selected-disapprove-leave-request').html('Save');                   
                if (data.is_success) {
                    $('#modal-with-selected-disapprove-leave-request').modal('hide');
                    Swal.fire({
                        text: "Leave request was successfully updated",
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

    $('#frm-create-leave-request').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_create_leave_request",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {                    
                $('#btn-save-leave-request').html('Save');                   
                if (data.is_success) {
                    $('#modal-create-leave-request').modal('hide');
                    Swal.fire({
                        title: 'Create Leave Request',
                        text: "Leave request was successfully created",
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
                $('#btn-save-leave-request').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-update-leave-request').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "timesheet/_update_leave_request",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {    
                $('#btn-update-leave-request').html('Save');                   
                if (data.is_success) {
                    $('#modal-edit-leave-request').modal('hide');
                    Swal.fire({
                        text: "Leave request was successfully updated",
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
                $('#btn-update-leave-request').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>