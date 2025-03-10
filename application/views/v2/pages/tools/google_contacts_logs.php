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
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class="bx bx-x"></i></button>
                            Monitor your Google export logs  
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 col-md-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <div class="dropdown d-inline-block">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    Filter : <?= $filter; ?>  <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end select-filter">
                                    <li><a class="dropdown-item filter-logs" data-value="All" href="javascript:void(0);">All</a></li>                          
                                    <li><a class="dropdown-item filter-logs" data-value="Exported" href="javascript:void(0);">Exported</a></li>                          
                                    <li><a class="dropdown-item filter-logs" data-value="Errors" href="javascript:void(0);">Errors</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <table class="nsm-table mt-5">                        
                            <thead>
                                <tr>
                                    <td class="table-icon"></td>
                                    <td class="Resource Type" style="width:30%;">Resource Type</td>
                                    <td data-name="Resource" style="width:30%;">Resource</td>
                                    <td data-name="Action">Action</td>
                                    <td data-name="OnDate">On</td>       
                                    <td data-name="Errors">Errors</td>       
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($googleContactsLogs as $log){ ?>
                                    <tr>
                                        <td><div class="table-row-icon"><i class='bx bx-export'></i></div></td>
                                        <td class="fw-bold nsm-text-primary"><?= ucfirst($log->resource_type); ?></td>
                                        <td class="nsm-text-primary">                                            
                                            <?php 
                                                if( $log->first_name == '' && $log->last_name == '' ){
                                                    echo '---';
                                                }else{
                                                    echo $log->first_name . ' ' . $log->last_name;
                                                }
                                            ?>        
                                        </td>
                                        <td class="nsm-text-primary"><?= $log->action; ?></td>
                                        <td class="nsm-text-primary"><?= date("F j, Y g:i A", strtotime($log->action_date)); ?></td>
                                        <td><?= $log->error_message != '' ? $log->error_message : '---'; ?></td>
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
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000)); 

    $('.filter-logs').on('click', function(){
        var filter = $(this).attr('data-value');
        if( filter == 'all' ){
            location.href = base_url + 'tools/google_contacts_logs';
        }else{
            location.href = base_url + 'tools/google_contacts_logs?filter=' + filter;    
        }
        
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>