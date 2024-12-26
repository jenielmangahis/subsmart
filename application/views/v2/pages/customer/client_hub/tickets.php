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
                            Tickets..
                        </div>
                    </div>
                </div>
                <div class="row">
                <table class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="Job Number">Ticket Number</td>
                                <td data-name="Date">Date</td>                                
                                <td data-name="Status">Status</td>
                                <td data-name="Amount">Job Amount</td>
                                <td data-name="Priority">Priority</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($jobs as $job) { ?>
                            <?php 
                                switch($job->status):
                                    case "New":
                                        $badgeCount = 1;
                                        break;
                                    case "Scheduled":
                                        $badgeCount = 2;
                                        break;
                                    case "Arrival":
                                        $badgeCount = 3;
                                        break;          
                                    case "Started":
                                        $badgeCount = 4;
                                        break;
                                    case "Approved":
                                        $badgeCount = 5;
                                        break;
                                    case "Closed":
                                        $badgeCount = 6;
                                        break;
                                    case "Invoiced":
                                        $badgeCount = 7;
                                        break;
                                    case "Completed":
                                    case "Finished":
                                        $badgeCount = 8;
                                        break;
                                endswitch;                                
                            ?>                            
                            <tr>
                                <td>
                                    <div class="table-row-icon">
                                        <i class='bx bx-bar-chart-square'></i>
                                    </div>
                                </td>
                                <td class="fw-bold nsm-text-primary">                       
                                    <?= $job->job_number; ?>
                                </td>
                                <td><?php echo date_format(date_create($job->start_date), "m/d/Y"); ?></td>
                                <td><?php echo $job->first_name . ' ' . $job->last_name; ?></td>
                                <td>
                                    <div>
                                        <?php for($x=1;$x<=$badgeCount;$x++){ ?> 
                                            <span class="nsm-badge primary-enhanced"></span>
                                        <?php } for($y=1;$y < 9 - $badgeCount;$y++){ ?> 
                                            <span class="nsm-badge primary"></span>
                                        <?php } ?>
                                    </div>
                                    <small class="content-subtitle d-block mt-1"><?= $job->status; ?></small>                                    
                                </td>
                                <td>$<?php echo number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                <td><?php echo $job->priority; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>  
                </div>

            </div>
        </div>
    </div>
</div>

<?php include viewPath('customer/adv_cust/js_list'); ?>
<script type="text/javascript">
    $(document).ready(function() {
       
    });
</script>

<?php include viewPath('v2/includes/footer_clienthub'); ?>