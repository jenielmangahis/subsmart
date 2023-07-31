<?php include viewPath('v2/includes/header'); ?>
<style>
.badge {
    display: inline-block;
    padding: 0.65em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    width: 100%;
}
.badge-warning {
    color: #212529;
    background-color: #ffc107;
}
.badge-danger {
    color: #fff;
    background-color: #dc3545;
}
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
                    <div class="col-5">
                        <h1>Mailchimp Export Logs</h1>                        
                    </div>                    
                </div>
                <div class="row mt-5">
                    <div class="col-12 grid-mb text-end">                        
                        <div class="dropdown d-inline-block">
                                <label>Filter</label>
                                <select id="filter-logs" class="dropdown-toggle nsm-button">
                                    <option selected value="all" <?= $filter == 'all' ? 'selected="selected"' : ''; ?>>All</option>                                    
                                    <option value="exported" <?= $filter == 'exported' ? 'selected="selected"' : ''; ?>>Exported</option>
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
                                    <td class="table-icon" style="width:50%;">List Name</td>
                                    <td data-name="Resource" style="width:20%;">Email</td>                                                                        
                                    <td data-name="Resource" style="width:10%;">Status</td>  
                                    <td data-name="OnDate">Created</td>      
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($mailchimpLogs as $log){ ?>
                                    <tr>
                                        <td><?= $log->mailchimp_list_name; ?></td>
                                        <td><?= $log->customer_email; ?></td>
                                        <td>
                                            <?php if( $log->is_sync == 1 && $log->is_with_error == 0 ){ ?>
                                                <span class="badge badge-primary">Exported</span>
                                            <?php }elseif( $log->is_sync == 0 && $log->is_with_error == 0 ){ ?>
                                                <span class="badge badge-warning">Pending</span>
                                            <?php }else{ ?>
                                                <span class="badge badge-danger">With Error</span>
                                            <?php } ?>
                                        </td>
                                        <Td><?= date("F j, Y g:i A", strtotime($log->date_created)); ?></Td>                                        
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
            location.href = base_url + 'tools/mailchimp_logs';
        }else{
            location.href = base_url + 'tools/mailchimp_logs?filter=' + filter;    
        }
        
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>