<?php include viewPath('v2/includes/header_clienthub'); ?>

<style>

</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_portal_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Track each tickets.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 grid-mb">
                        <form action="<?php echo base_url('/') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>   
                    </div>                      
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container"></div>
                    </div>
                </div>                 

                <div class="row">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="Ticket Number" style="width:50%;">Ticket Number</td>
                                <td data-name="Date">Date</td>    
                                <td data-name="Time">Time</td>                               
                                <td data-name="Status">Status</td>
                                <td data-name="Amount" style="text-align: right;">Amount</td>
                                <td data-name="Action"></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tickets as $ticket) { ?>                         
                            <tr>
                                <td>
                                    <div class="table-row-icon">
                                        <i class='bx bx-briefcase'></i>
                                    </div>
                                </td>
                                <td class="fw-bold nsm-text-primary">                       
                                    <?= $ticket->ticket_no; ?>
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
                                <td><?php echo $ticket->ticket_status; ?></td>
                                <td style="width:8%; !important;text-align:right;">$<?php echo number_format($ticket->grandtotal,2); ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item view-job-row" href="javascript:void(0);" data-id="<?= $ticket->id; ?>">View</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>                                
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>  
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-quick-view-ticket" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-ticket-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">        
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">View Service Ticket</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" style="max-height:700px; overflow: auto;">
                    <input type="hidden" id="view-ticket-id" value="" />
                    <div id="view-ticket-container" class="view-ticket-container"></div>
                </div>                                    
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
        
        $('.view-job-row').on('click', function(){
            var appointment_id = $(this).attr('data-id');
            //var url = base_url + 'ticket/_quick_view_details';
            var url = base_url + 'client_hub/_quick_view_ticket_details/public';

            $('#view-ticket-id').val(appointment_id);

            $('#modal-quick-view-ticket').modal('show');

            setTimeout(function () {

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {appointment_id: appointment_id},
                    success: function(result) {
                        $("#view-ticket-container").html(result);
                    },
                    beforeSend: function() {
                        $('#view-ticket-container').html('<span class="bx bx-loader bx-spin"></span>');
                    }
                });  

            }, 500);


        });     
          
    });
</script>

<?php include viewPath('v2/includes/footer_clienthub'); ?>