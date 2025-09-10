<?php include viewPath('v2/includes/header'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<style>
.nsm-table {
    /*display: none;*/
}
.nsm-badge.primary-enhanced {
    background-color: #6a4a86;
}
    table {
    width: 100% !important;
}
.dataTables_filter, .dataTables_length{
    display: none;
}
table.dataTable thead th, table.dataTable thead td {
padding: 10px 18px;
border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
     border-bottom: 0px solid #111; 
     margin-bottom: 10px;
}
#CUSTOM_FILTER_DROPDOWN:hover {
     border-color: gray !important; 
     background-color: white !important; 
     color: black !important;
     cursor: pointer; 
}
.btn-view-event{
    text-decoration:none;
    color:unset;
}
.techs {
    display: flex;
    padding-left: 12px;
}
.techs > .nsm-profile {
    border: 2px solid #fff;
    box-sizing: content-box;
    margin-left: -12px;
}
.nsm-profile {
    --size: 35px;
    max-width: var(--size);
    height: var(--size);
    min-width: var(--size);
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">        
        <li onclick="location.href='<?php echo base_url('events/event_add') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-task"></i>
            </div>
            <span class="nsm-fab-label">New Event</span>
        </li>
        <li class="btn-export-list">
            <div class="nsm-fab-icon">
                <i class='bx bxs-file-export'></i>
            </div>
            <span class="nsm-fab-label">Export</span>
        </li>
        <li id="btn-mobile-archived">
            <div class="nsm-fab-icon">
                <i class='bx bx-archive'></i>
            </div>
            <span class="nsm-fab-label">Archived</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/events_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/event_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            This is where you will create, view, and edit your events and all event-related records, go to the Events work area where you can create a new event and—working from this single event record—add most of the other types of records and information that you need to plan, publish, promote, and analyze it. Like many of our sales items the event record provides a customizable business process workflow that helps guide you through each step of the process.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-calendar'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($events); ?></h2>
                                    <span>Total Events</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Event" value="">
                        </div>
                    </div> 
                    <?php if(checkRoleCanAccessModule('events', 'write')){ ?>
                    <div class="col-12 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <div class="btn-group nsm-main-buttons">
                            <button type="button" class="btn btn-nsm" id="btn-new-event"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Event</button>
                            <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class=""><i class='bx bx-chevron-down' ></i></span>
                            </button>
                            <ul class="dropdown-menu">                          
                                <li><a class="dropdown-item" id="btn-export-list" href="javascript:void(0);">Export</a></li>                               
                                <li><a class="dropdown-item" id="btn-archived" href="javascript:void(0);">Archived</a></li>                               
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <form id="frm-with-selected">
                <table id="events-table" class="nsm-table w-100">
                    <thead>
                        <tr>
                            <td class="table-icon text-center show">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <td class="table-icon show"></td>
                            <td class="show" data-name="Event Number" style="width:35%;">Event Number</td>
                            <td data-name="Date">Date</td>                            
                            <td data-name="Employee">Attendees</td>                            
                            <td data-name="Event Color" style="width:8%;">Event Color</td>
                            <td data-name="Event Type">Event Type</td>
                            <td data-name="Event Tag">Event Tag</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($events)) { ?>
                            <?php foreach ($events as $event) { ?>
                            <tr>
                                <td style="text-align:center;"><input class="form-check-input row-select table-select" name="events[]" type="checkbox" name="id_selector" value="<?= $event->id; ?>"></td>
                                <td>
                                    <div class="table-row-icon">
                                        <i class='bx bx-calendar-event'></i>
                                    </div>
                                </td>
                                <td class="fw-bold nsm-text-primary show">
                                    <?php echo $event->event_number; ?>
                                </td>
                                <td><?= date("m/d/Y", strtotime($event->start_date)); ?></td>                            
                                <td>
                                    <div class="techs">                   
                                        <?php $attendees = json_decode($event->employee_id); ?>
                                        <?php foreach($attendees as $eid){ ?>
                                            <div class="nsm-profile" style="background-image: url('<?= userProfileImage($eid); ?>');"></div>
                                        <?php } ?>            
                                    </div>
                                </td>                            
                                <td>
                                    <div class="nsm-profile" style="background-color:<?= $event->event_color; ?>; width: 40px;"></div>
                                </td>
                                <td class="nsm-text-primary"><?php echo $event->event_type; ?></td>
                                <td class="nsm-text-primary"><?php echo $event->event_tag; ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item btn-view-event" href="javascript:void(0);" data-id="<?= $event->id; ?>" data-event-number="<?= $event->event_number; ?>">View</a></li>
                                            <?php if(checkRoleCanAccessModule('events', 'write')){ ?>
                                            <li><a class="dropdown-item" href="<?php echo base_url('events/event_edit/') . $event->id; ?>">Edit</a></li>
                                            <?php } ?>
                                            <?php if(checkRoleCanAccessModule('events', 'delete')){ ?>
                                            <li><a class="dropdown-item delete-item" href="javascript:void(0);" data-event-number="<?= $event->event_number; ?>" data-id="<?php echo $event->id; ?>">Delete</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="9">
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
            
            <div class="modal fade nsm-modal fade" id="modal-view-event" tabindex="-1" aria-labelledby="modal-view-event-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">        
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">View Event</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="view-schedule-container" id="view-event-container"></div>
                        </div>
                    </div>        
                </div>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-view-archive" tabindex="-1" aria-labelledby="modal-view-archive_label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">        
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">Archived Events</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body" id="events-archived-container"></div>      
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Map files -->
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script type="text/javascript" src="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css" rel="stylesheet" />
<script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>
<!-- End Map files -->
 
<script type="text/javascript">
$(document).ready(function () {
    $(".nsm-table").nsmPagination();
    $("#search_field").on("input", debounce(function() {
        let search = $(this).val();
        if( search == '' ){
            $(".nsm-table").nsmPagination();
            $("#events-table").find("tbody .nsm-noresult").remove();
        }else{
            tableSearch($(this));        
        }
    }, 1000));

    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('#events-table input[name="events[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#events-table input[name="events[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $('#btn-archived, #btn-mobile-archived').on('click', function(){
        $('#modal-view-archive').modal('show');

         $.ajax({
            type: "POST",
            url: base_url + "events/_archived_list",
            success: function(html) {    
                $('#events-archived-container').html(html);
            },
            beforeSend: function() {
                $('#events-archived-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $('#btn-new-event').on('click', function(){
        location.href = base_url + 'events/event_add';
    });

    $("#btn-export-list, .btn-export-list").on("click", function() {
        location.href = base_url + 'events/export_list';
    });

    $(document).on('click', '.btn-view-event', function(){
        var event_id = $(this).attr('data-id');
        var event_number = $(this).attr('data-event-number');
        $('#modal-view-event').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + 'event/_quick_view_event',
            data: {appointment_id:event_id},
            success: function(html) {    
               $('#view-event-container').html(html);               
            },
            beforeSend: function() {
                $('#view-event-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('#events-table input[name="events[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Events',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'events/_archive_selected_events',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Events',
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
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });

                }
            });
        }        
    });

    $(document).on("click", ".delete-item", function (event) {
        var eid = $(this).data("id");
        var event_number = $(this).data('event-number');

        Swal.fire({
            title: 'Delete Event',
            html: `Are you sure you want to delete event number <b>${event_number}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "event/_delete_event",
                    data: {schedule_id: eid},
                    dataType:"json",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Event',
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
                    beforeSend: function(){
                        Swal.fire({
                            icon: "info",
                            title: "Processing",
                            html: "Please wait while the process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '#with-selected-restore', function(){
        let total= $('#archived-events input[name="events[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Restore Events',
                html: `Are you sure you want to restore selected rows?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'events/_restore_selected_events',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Restore Events',
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
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });

                }
            });
        }        
    });

    $(document).on('click', '#with-selected-perma-delete', function(){
        let total = $('#archived-events input[name="events[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Events',
                html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'events/_permanently_delete_selected_events',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Delete Events',
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
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });

                }
            });
        }        
    });

    $(document).on('click', '#btn-empty-archives', function(){        
        let total_records = $('#archived-events input[name="events[]"]').length;        
        if( total_records > 0 ){
            Swal.fire({
                title: 'Empty Archived',
                html: `Are you sure you want to <b>permanently delete</b> <b>${total_records}</b> archived events? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'events/_delete_all_archived_events',
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
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
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

    $(document).on('click', '.btn-restore-event', function(){
        let event_id   = $(this).attr('data-id');
        let event_number = $(this).attr('data-number');

        Swal.fire({
            title: 'Restore Event',
            html: `Are you sure you want to restore event number <b>${event_number}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'events/_restore_event',
                    data: {
                        event_id: event_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Restore Event',
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
                    beforeSend: function(){
                        Swal.fire({
                            icon: "info",
                            title: "Processing",
                            html: "Please wait while the process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '.btn-permanently-delete-event', function(){
        let event_id   = $(this).attr('data-id');
        let event_number = $(this).attr('data-number');

        Swal.fire({
            title: 'Delete Event',
            html: `Are you sure you want to <b>permanently delete</b> event number <b>${event_number}</b>? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'events/_delete_archived_event',
                    data: {
                        event_id: event_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Event',
                                html: "Data deleted successfully!",
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
                    beforeSend: function(){
                        Swal.fire({
                            icon: "info",
                            title: "Processing",
                            html: "Please wait while the process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    }
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>