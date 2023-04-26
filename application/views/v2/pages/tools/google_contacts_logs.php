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
                    <div class="col-5">
                        <h1>Google Contacts Logs</h1>                        
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
                                    <td class="table-icon" style="width:30%;">Resource Type</td>
                                    <td data-name="Resource" style="width:30%;">Resource</td>
                                    <td data-name="Action">Action</td>
                                    <td data-name="OnDate">On</td>       
                                    <td data-name="Errors">Errors</td>       
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($googleContactsLogs as $log){ ?>
                                    <tr>
                                        <Td><?= ucfirst($log->resource_type); ?></Td>
                                        <Td><?= $log->first_name . ' ' . $log->first_name; ?></Td>
                                        <Td><?= $log->action; ?></Td>
                                        <Td><?= date("F j, Y g:i A", strtotime($log->action_date)); ?></Td>
                                        <Td><?= $log->error_message; ?></Td>
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
            location.href = base_url + 'tools/google_contacts_logs';
        }else{
            location.href = base_url + 'tools/google_contacts_logs?filter=' + filter;    
        }
        
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>