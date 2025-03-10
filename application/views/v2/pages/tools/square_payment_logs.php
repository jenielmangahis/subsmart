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
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class="bx bx-x"></i></button>
                            Track received payments using your Square payment account                            
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
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
                                    <li><a class="dropdown-item filter-logs" data-value="Card" href="javascript:void(0);">Card</a></li>                          
                                    <li><a class="dropdown-item filter-logs" data-value="Google Pay" href="javascript:void(0);">Google Pay</a></li>                          
                                    <li><a class="dropdown-item filter-logs" data-value="Apple Pay" href="javascript:void(0);">Apple Pay</a></li>                          
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <table class="nsm-table">                        
                            <thead>
                                <tr>
                                    <td class="table-icon"></td>
                                    <td class="Date" style="width:70%;">Date</td>
                                    <td data-name="Resource" style="width:20%;">Source Type</td>                                                                        
                                    <td data-name="Resource" style="width:10%;text-align:right;">Amount</td>  
                                    <td data-name="OnDate"></td>      
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($squarePaymentLogs as $log){ ?>
                                    <tr>
                                        <td class="fw-bold nsm-text-primary"><div class="table-row-icon"><i class='bx bx-dollar-circle'></i></div></td>
                                        <td class="nsm-text-primary"><?= date("m/d/Y g:i A", strtotime($log->payment_date)); ?></td>
                                        <td class="nsm-text-primary"><?= $log->source_type; ?></td>
                                        <td style="text-align:right;">$<?= number_format($log->amount,2,'.',''); ?></td>
                                        <td></td>
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
            location.href = base_url + 'tools/square_payment_logs';
        }else{
            location.href = base_url + 'tools/square_payment_logs?filter=' + filter;    
        }
        
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>