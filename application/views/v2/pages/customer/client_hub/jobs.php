<?php include viewPath('v2/includes/header_clienthub'); ?>

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
        <?php include viewPath('v2/includes/page_navigations/customer_portal_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Track each scheduled job from draft to receiving payment.
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
                                <td data-name="Job Number" style="width:50%;">Job Number</td>
                                <td data-name="Date">Date</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Amount" style="width:15%;text-align:right;">Job Amount</td>
                                <td data-name="Action"></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($jobs as $job) { ?>
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
                                <td><?= $job->status; ?></td>
                                <td style="width:15%;text-align:right;">$<?php echo number_format((float)$job->amount, 2, '.', ',');  ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item view-job-row" href="javascript:void(0);" data-id="<?= hashids_encrypt($job->id, '', '45'); ?>">View</a>
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

    <div class="modal fade nsm-modal fade" id="modal-quick-view-job" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">        
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">View Job</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" style="max-height:700px; overflow: auto;">
                    <div class="view-schedule-container row"></div>
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
            var jobid = $(this).attr('data-id');
            var url   = base_url + "client_hub/_job_view";  

            $('#modal-quick-view-job').modal('show');
            showLoader($(".view-schedule-container")); 

            setTimeout(function () {
            $.ajax({
                type: "POST",
                url: url,
                data: {jobid:jobid},
                success: function(o)
                {          
                    $(".view-schedule-container").html(o);
                }
            });
            }, 500);
        });
    });
</script>

<?php include viewPath('v2/includes/footer_clienthub'); ?>
