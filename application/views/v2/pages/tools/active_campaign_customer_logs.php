<?php include viewPath('v2/includes/header'); ?>
<style>

</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tools_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-8">
                        <h1>Active Campaign : Export Customer Logs</h1>                        
                    </div>                    
                </div>
                <div class="row mt-5">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-subnav">
                            <ul>                                
                                <li class="" onclick="location.href='<?= base_url('tools/active_campaign_list_automation_logs') ?>'">
                                    <a class="nsm-page-link" href="javascript:void(0);">
                                        <span>List / Automation</span>
                                    </a>
                                </li>
                                <li class="active" onclick="location.href='<?= base_url('tools/active_campaign_customer_logs') ?>'">
                                    <a class="nsm-page-link" href="javascript:void(0);">
                                        <span>Customer</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                                <label>Filter</label>
                                <select id="filter-logs" class="dropdown-toggle nsm-button">
                                    <option selected value="all" <?= $filter == 'all' ? 'selected="selected"' : ''; ?>>All</option>                                    
                                    <option value="errors" <?= $filter == 'errors' ? 'selected="selected"' : ''; ?>>Errors</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <table class="nsm-table mt-5">                        
                            <thead>
                                <tr>
                                    <td class="table-icon" data-name="CustomerName" style="width:30%;">Name</td>
                                    <td data-name="Email" style="width:20%;">Email</td>                                    
                                    <td data-name="Phone">Phone</td>       
                                    <td data-name="ActionDate">Action</td>    
                                    <td data-name="Errors">Errors</td>       
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($activeCampaignExportCustomerLogs as $log){ ?>
                                    <tr>
                                        <td><?= $log->customer_firstname . ' ' . $log->customer_lastname; ?></td>
                                        <td><?= $log->customer_email; ?></td>
                                        <td><?= $log->customer_phone; ?></td>                                                                                   
                                        <Td><?= date("Y-m-d g:i A", strtotime($log->action_date)); ?></Td>
                                        <td><?= $log->error_message; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>             
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $(".nsm-table").nsmPagination();

    $('#filter-logs').on('change', function(){
        var filter = $(this).val();
        if( filter == 'all' ){
            location.href = base_url + 'tools/active_campaign_customer_logs';
        }else{
            location.href = base_url + 'tools/active_campaign_customer_logs?filter=' + filter;    
        }
        
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>