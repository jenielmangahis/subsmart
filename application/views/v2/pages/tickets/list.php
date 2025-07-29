<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<style>
.dataTables_filter, .dataTables_length{
    display: none;
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
.swal2-html-container{
    overflow:hidden;
}
.ticket-change-status{
    text-align:left;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('customer/addTicket') ?>'">
        <i class="bx bx-note"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_tickets_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_ticket_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Don't Let Your Service Desk Tickets Make it Harder to Run Your Business Effectively. Start Achieving Service Desk Excellence by tagging all your tickets and tracking them to the closed.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-dollar'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="">$<?= number_format($ticketTotalAmount->total_amount, 2, '.', ''); ?></h2>
                                    <span>Income</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter secondary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($tickets); ?></h2>
                                    <span>Total Service Tickets</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($openTickets); ?></h2>
                                    <span>Total Open Service Tickets</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12 col-md-4">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="custom-ticket-searchbar" name="search" placeholder="Search Service Ticket..." value="">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">                        
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by Newest First</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=added-desc">Newest first</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=added-asc">Oldest first</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=date-accepted-desc">Accepted: newest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=date-accepted-asc">Accepted: oldest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=number-asc">Number: Asc</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=number-desc">Number: Desc</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=amount-asc">Amount: Lowest</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('estimate') ?>?order=amount-desc">Amount: Highest</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-change-status" href="javascript:void(0);" data-action="pause">Change Status</a></li>                          
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">                            
                            <?php if(checkRoleCanAccessModule('service-tickets', 'write')){ ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-nsm" id="btn-add-service-ticket"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Service Ticket</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                                    
                                    <li><a class="dropdown-item" id="archived-ticket-list" href="javascript:void(0);">Archived</a></li>                               
                                    <li><a class="dropdown-item" id="btn-export-list" href="javascript:void(0);">Export</a></li>                               
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">
                    <input type="hidden" value="" id="change-status" name="change_status" />
                    <table class="nsm-table w-100" id="ticket-list-table">
                        <thead>
                            <tr>
                                <td class="table-icon text-center">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>
                                <td class="table-icon"></td>
                                <td data-name="Work Order Number">Service Ticket Number</td>
                                <td data-name="AssignedTech">Assigned Tech</td>
                                <td data-name="Customer">Customer</td>                                
                                <td data-name="Date Issued">
                                    Date</td>                                
                                <td data-name="Time From">Time</td>                            
                                <td data-name="Status">Status</td>
                                <td data-name="Amount" style="width:8%; !important;text-align:right;">Amount</td>
                                <td data-name="Manage" style="width:3%;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tickets as $ticket){ ?>
                            <tr>
                                <td style="text-align:center;"><input class="form-check-input row-select table-select" name="tickets[]" type="checkbox" name="id_selector" value="<?= $ticket->id; ?>"></td>
                                <td><div class="table-row-icon"><i class='bx bx-briefcase'></i></div></td>
                                <td class="show fw-bold nsm-text-primary"><?php echo $ticket->ticket_no; ?></td>
                                <td style="width:15%;">
                                    <?php if( $ticket->assigned_tech ){ ?>
                                        <div class="techs">   
                                        <?php foreach($ticket->assigned_tech as $user){ ?>
                                            <?php 
                                                $name     = $user['first_name'] . ' ' . $user['last_name']; 
                                                $initials = $user['first_name'][0] . '' . $user['last_name'][0];
                                            ?>
                                            <?php if( $user['image'] != 'default.png' && $user['image'] != '' ){ ?>
                                                <div title="<?= $name; ?>" class="nsm-profile" style="background-image: url('<?= userProfileImage($user['id']); ?>');"></div>
                                            <?php }else{ ?>
                                                <div title="<?= $name; ?>" class="nsm-profile"><span><?= $initials; ?></span></div>
                                            <?php } ?>
                                        <?php } ?>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td style="width:20%;"><?php echo $ticket->first_name.' '.$ticket->last_name; ?></td>                                
                                <td>
                                    <?php 
                                        $date = '---';
                                        if( strtotime($ticket->ticket_date) > 0 ){
                                            $date =  date("m/d/Y", strtotime($ticket->ticket_date)); 
                                        }

                                        echo $date;
                                    ?>
                                </td>                                
                                <td>
                                    <?php 
                                        $ticket_time = '---';
                                        if( $ticket->scheduled_time != '' && $ticket->scheduled_time_to != '' ){
                                            $time_from =  date("G:i A", strtotime($ticket->scheduled_time)); 
                                            $time_to =  date("G:i A", strtotime($ticket->scheduled_time_to)); 
                                            $ticket_time = $time_from . ' to ' . $time_to;
                                        }

                                        echo $ticket_time;
                                    ?>
                                </td>                            
                                <td><?php echo $ticket->ticket_status; ?></td>
                                <td style="width:15%; !important;text-align:right;">$<?php echo number_format($ticket->grandtotal,2); ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item row-view-ticket" href="javascript:void(0);" data-id="<?= $ticket->id; ?>" data-ticket-number="<?= $ticket->ticket_no; ?>">View</a></li>
                                            <li><a class="dropdown-item row-download-pdf" tabindex="-1" href="javascript:void(0);" data-id="<?= $ticket->id; ?>">Download PDF</a></li>
                                            <?php if(checkRoleCanAccessModule('service-tickets', 'write')){ ?>
                                            <li><a class="dropdown-item" tabindex="-1" href="<?php echo base_url('tickets/editDetails/' . $ticket->id) ?>">Edit</a></li>
                                            <?php } ?>
                                            <?php if(checkRoleCanAccessModule('service-tickets', 'delete')){ ?>
                                            <li><a class="dropdown-item delete-ticket" href="javascript:void(0);" data-tk-number="<?= $ticket->ticket_no; ?>" data-tk-id="<?php echo $ticket->id; ?>">Delete</a></li>
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
    
    <div class="modal fade nsm-modal fade" id="modal-with-change-status" tabindex="-1" aria-labelledby="modal-with-change-status-label" aria-hidden="true">
        <div class="modal-dialog modal-md" style="margin-top:13%;">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title"> Change Status</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="plan-type-name" class="content-subtitle fw-bold d-block mb-2">Change status to </label>
                            <select id="ticket-status" class="form-control">
                                <option value="New">New</option>
                                <option value="Draft">Draft</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Arrived">Arrived</option>
                                <option value="Started">Started</option>
                                <option value="Approved">Approved</option>
                                <option value="Finished">Finished</option>
                                <option value="Invoiced">Invoiced</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="nsm-button primary" id="btn-change-status-submit">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-view-ticket" tabindex="-1" aria-labelledby="modal-view-ticket_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">View Service Ticket : <span id="view-service-ticket-number"></span></span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" style="max-height:700px;overflow:auto;">
                    <input type="hidden" id="view-ticket-id" value="" />
                    <div class="g-3 view-schedule-container"></div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-archived-tickets" aria-labelledby="modal-archived-tickets-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Archived Service Tickets</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="tickets-archived-list-container" style="max-height: 800px; overflow: auto;"></div>
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
    $(document).ready(function() {
        var ticketListTable = $("#ticket-list-table").DataTable({
            "ordering": false,
            language: {
                processing: '<span>Fetching data...</span>'
            }     
        });

        $("#custom-ticket-searchbar").keyup(function() {
            ticketListTable.search($(this).val()).draw()
        });
    });
</script>
<?php //include viewPath('includes/footer'); ?>
<script>
    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('#ticket-list-table input[name="tickets[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#ticket-list-table input[name="tickets[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    <?php if(checkRoleCanAccessModule('service-tickets', 'write')){ ?>
    $('#archived-ticket-list').on('click', function(){
        $('#modal-archived-tickets').modal('show');
        $.ajax({
            type: "POST",
            url: base_url + "ticket/_archived_list",  
            success: function(html) {    
                $('#tickets-archived-list-container').html(html);                          
            },
            beforeSend: function() {
                $('#tickets-archived-list-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#btn-add-service-ticket').on('click', function(){
        location.href = base_url + 'ticket/add';
    });

    $("#btn-export-list").on("click", function() {
        location.href = "<?php echo base_url('tickets/export'); ?>";
    });

    $(document).on('click', '.btn-restore-ticket', function(){
        var ticket_id = $(this).attr('data-id');
        var ticket_number = $(this).attr('data-name');

        Swal.fire({
            title: 'Restore Service Ticket',
            html: `Proceed with restoring service ticket <b>${ticket_number}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {                    
                $.ajax({
                    type: "POST",
                    url: base_url + "ticket/_restore_archived",
                    data: {ticket_id:ticket_id},
                    dataType:'json',
                    success: function(result) {                            
                        if( result.is_success == 1 ) {
                            $('#modal-archived-tickets').modal('hide');
                            Swal.fire({
                            icon: 'success',
                            title: 'Restore Service Ticket',
                            text: 'Service ticket data was successfully restored.',
                            }).then((result) => {
                                location.reload();
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

    $(document).on('click', '.btn-permanently-delete-ticket', function(){
        var ticket_id = $(this).attr('data-id');
        var ticket_number = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Service Ticket',
            html: `Are you sure you want to <b>permanently delete</b> service ticket <b>${ticket_number}</b>? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'ticket/_delete_archived_ticket',
                    data: {
                        ticket_id: ticket_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-archived-tickets').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Service Ticket',
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
    <?php } ?>

    $(document).on('click', '#with-selected-restore', function(){
        let total= $('#archived-tickets input[name="tickets[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Restore Service Tickets',
                html: `Are you sure you want to restore selected rows?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'ticket/_restore_selected_tickets',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-archived-tickets').modal('hide');
                                Swal.fire({
                                    title: 'Restore Service Tickets',
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
        let total= $('#archived-tickets input[name="tickets[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Service Tickets',
                html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'ticket/_permanently_delete_selected_tickets',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-archived-tickets').modal('hide');
                                Swal.fire({
                                    title: 'Delete Service Tickets',
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
        let total_records = $('#archived-tickets input[name="tickets[]"]').length;        
        if( total_records > 0 ){
            Swal.fire({
                title: 'Empty Archived',
                html: `Are you sure you want to <b>permanently delete</b> <b>${total_records}</b> archived tickets? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'ticket/_delete_all_archived_tickets',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-archived-tickets').modal('hide');
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

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('#ticket-list-table input[name="tickets[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Service Tickets',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'tickets/_delete_selected_tickets',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Service Tickets',
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
    
    $(document).on('click', '.delete-ticket', function(){
        var tkID = $(this).attr('data-tk-id');
        var tkNum = $(this).attr('data-tk-number');

        Swal.fire({
            title: 'Delete Service Ticket',
            html: `Are you sure you want to delete ticket number <b>${tkNum}?</b><br /><br /><small>Deleted data can be restored via archived list.</small>`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'POST',
                    url: base_url + 'tickets/deleteTicket',
                    dataType: 'json',
                    data: {tkID: tkID},
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                                title: 'Delete Service Ticket',
                                text: "Data deleted successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
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
    });

    $(document).on('click', '#with-selected-change-status', function(){
        let total= $('#ticket-list-table input[name="tickets[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            let html_content = `
                <div class="row ticket-change-status">
                    <div class="col-sm-12">
                        <label class="mb-2">Status</label>
                        <div class="input-group mb-3">
                            <select class="form-select" id="with-selected-status">
                                <option value="New">New</option>
                                <option value="Draft">Draft</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Arrived">Arrived</option>
                                <option value="Started">Started</option>
                                <option value="Approved">Approved</option>
                                <option value="Finished">Finished</option>
                                <option value="Invoiced">Invoiced</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
            `; 

            Swal.fire({
                title: 'Change Status',
                html: html_content,
                icon: false,
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                confirmButtonText: 'Save',                    
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    let status  = $('#with-selected-status').val();

                    const form = document.getElementById('frm-with-selected');
                    const formData = new FormData(form);
                    formData.append('change_status', status); 

                    $.ajax({
                        type: "POST",
                        url: base_url + 'tickets/_update_status_selected_tickets',
                        data:formData,
                        processData: false,
                        contentType: false,
                        dataType:'json',
                        success: function(result) {                            
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                icon: 'success',
                                title: 'Change Status',
                                text: 'Data was updated successfully.',
                                }).then((result) => {
                                    location.reload();
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
        }  
    });

    $(document).on('click', '#btn-change-status-submit', function(e){
        e.preventDefault();
        var status = $('#ticket-status').val();
        $('#change-status').val(status);

        $.ajax({
            url: base_url + 'tickets/_update_status_selected_tickets',
            method: 'post', 
            data: $('#frm-with-selected').serialize(),           
            dataType:'json',
            success: function (response) {
                $('#modal-with-change-status').modal('hide');
                $('#btn-change-status-submit').html('Save');
                if( response.is_success == 1 ){
                    Swal.fire({
                        title: 'Change Status',
                        text: "Data updated successfully!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Cannot find data',
                    });
                }
            },
            beforeSend: function() {
                $('#btn-change-status-submit').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });   
    });

    $(document).on('click', '.row-view-ticket', function(){
        var appointment_id = $(this).attr('data-id');
        var url = base_url + 'ticket/_quick_view_details';
        var service_ticket_number = $(this).attr('data-ticket-number');

        $('#view-ticket-id').val(appointment_id);
        $('#modal-view-ticket').modal('show');
        $('#view-service-ticket-number').text(service_ticket_number);

        $.ajax({
            type: "POST",
            url: url,
            data: {appointment_id: appointment_id},
            success: function(result) {
                $(".view-schedule-container").html(result);
            },
            beforeSend: function() {
                $('.view-schedule-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '#btn-download-pdf', function(){
        var tid = $('#view-ticket-id').val();
        location.href = base_url + 'share_Link/ticketsPDF/' + tid;
    });

    $(document).on('click', '.row-download-pdf', function(){
        var tid = $(this).attr('data-id');
        location.href = base_url + 'share_Link/ticketsPDF/' + tid;
    });

        
    function sucess(information,$id){
        Swal.fire({
            title: 'OK!',
            text: information,
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>