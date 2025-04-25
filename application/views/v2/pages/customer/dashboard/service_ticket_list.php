<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button name="button"><i class='bx bx-x'></i></button>
                            Don't Let Your Service Desk Tickets Make it Harder to Run Your Business Effectively. Start Achieving Service Desk Excellence by tagging all your tickets and tracking them to the closed.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('service-tickets', 'write')){ ?>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('tickets/addTicketCust/'.$cus_id); ?>'">
                                <i class='bx bx-fw bx-plus'></i> New Service Ticket
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="tab-content mt-4">
                    <table class="nsm-table" id="ticket-list-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="Work Order Number">Service Ticket No.</td>
                                <td data-name="AssignedTech">Assigned Tech</td>                    
                                <td data-name="Date Issued">Date</td>                                
                                <td data-name="Time From">Time</td>                            
                                <td data-name="Status">Status</td>
                                <td data-name="Amount" style="width:8%; !important;text-align:right;">Amount</td>
                                <td data-name="Manage" style="width:3%;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tickets as $ticket){ ?>
                            <tr>
                                <td><div class="table-row-icon"><i class='bx bx-briefcase'></i></div></td>
                                <td class="fw-bold nsm-text-primary" style="width:30%;"><?php echo $ticket->ticket_no; ?></td>
                                <td style="width:20%;">
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
                                <td class="nsm-text-primary"><?php echo $ticket->ticket_status; ?></td>
                                <td style="width:15%; !important;text-align:right;">$<?php echo number_format($ticket->grandtotal,2); ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item row-view-ticket" href="javascript:void(0);" data-id="<?= $ticket->id; ?>">View</a></li>                                            
                                            <?php if(checkRoleCanAccessModule('service-tickets', 'write')){ ?>
                                            <li><a class="dropdown-item" tabindex="-1" href="<?php echo base_url('tickets/editDetails/' . $ticket->id) ?>">Edit</a></li>                                            
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade nsm-modal fade" id="modal-view-ticket" tabindex="-1" aria-labelledby="modal-view-ticket_label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">View Service Ticket</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body" style="max-height:700px;overflow:auto;">
                                <div class="row g-3" id="view_ticket_container"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script>
$(document).ready(function() {
    $(".nsm-table").nsmPagination();
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));

    $(document).on('click', '.row-view-ticket', function(){
        var appointment_id = $(this).attr('data-id');
        var url = base_url + 'ticket/_quick_view_details';

        $('#view-ticket-id').val(appointment_id);
        $('#modal-view-ticket').modal('show');

        $.ajax({
            type: "POST",
            url: url,
            data: {appointment_id: appointment_id},
            success: function(result) {
                $("#view_ticket_container").html(result);
            },
            beforeSend: function() {
                $('#view_ticket_container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
});
</script>