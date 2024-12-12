<style>
    #getting-started-content .content-title {
        font-size: 20px;
        width: auto !important;
    }

    #getting-started-content .content-subtitle {
        font-size: 15px !important;
        width: auto !important;
    }

    #getting-started-content .table-icon {
    width: 1%;
    }

    .check-purple{
        color:#6a4a86 !important;
    }

    #getting-started-content .bx {
    color: #888888;
    }

    #getting-started-content .bx-chevron-down {
    float: right;
    font-size: 20px;
    color: #888888;
    margin-top: 1px;
    }
    .item-getting-started{
        margin:0px;
        padding:20px 0px;
        border-bottom:1px solid #e8e8e8;
    }
    .getting-started-item-link, .getting-started-item-link:hover{
        color:inherit !important;
        text-decoration:none;
    }
    .item-getting-started .check-icon{
        font-size: 25px;
        position: relative;
        top: -12px;
        left: 54px;
    }

</style>
<div class="row" id="getting-started-content">
    <div class="col-md-12">
        <div class="row item-getting-started">
            <div class="col-md-2">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-building' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx check-icon bxs-check-circle check-purple'></i>
                </div>   
            </div>
            <div class="col-md-10">
                <div class="content">
                    <div class="details news-details" style="">                                                    
                        <span class="content-title">
                            Sign up to nSmarTrac
                        </span>
                        <span class="content-subtitle d-block mt-2">&nbsp;</span>
                    </div>
                    <div class="controls"></div>
                </div>
            </div>
        </div>

        <div class="row item-getting-started">            
            <div class="col-md-2">
                <div class="row">
                    <a class="getting-started-item-link" id="getting-started-schedule-job" href="javascript:void(0);">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-calendar-check' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx check-icon bxs-check-circle <?= count($isWithJobs) > 0 ? 'check-purple' : ''; ?>'></i>
                    </a>
                </div>  
            </div>
            <div class="col-md-10">
                <a class="getting-started-item-link" id="getting-started-schedule-job" href="javascript:void(0);">
                <div class="content">
                    <div class="details news-details" style="">                                                    
                        <span class="content-title">
                            Schedule a job
                        </span>
                        <span class="content-subtitle d-block mt-2">Create a new job and set a time on your calendar.</span>
                    </div>
                </div>
                </a>
            </div>
        </div>

        <div class="row item-getting-started">
            <div class="col-md-2">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-shape-circle' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx check-icon bxs-check-circle <?= count($isWithTaskHub) > 0 ? 'check-purple' : ''; ?>'></i>
                </div>  
            </div>
            <div class="col-md-10">
                <div class="content">
                    <div class="details news-details" style="">                                                    
                        <span class="content-title">
                            Taskhub - Project Management
                        </span>
                        <span class="content-subtitle d-block mt-2">Assign tasks to team members and communicate with your team.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row item-getting-started">
            <div class="col-md-2">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-reset' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx check-icon bxs-check-circle <?= count($totalCustomers) > 0 ? 'check-purple' : ''; ?>'></i>
                </div>  
            </div>
            <div class="col-md-10">
                <div class="content">
                    <div class="details news-details" style="">                                                    
                        <span class="content-title">
                            Connect to Quickbooks or import customer list
                        </span>
                        <span class="content-subtitle d-block mt-2">Sync your Quickbooks account or upload your customer list.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row item-getting-started">
            <div class="col-md-2">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-mobile-alt' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx check-icon bxs-check-circle'></i>
                </div>  
            </div>
            <div class="col-md-10">
                <div class="content">
                    <div class="details news-details" style="">                                                    
                        <span class="content-title">
                        Download the mobile app
                        </span>
                        <span class="content-subtitle d-block mt-2">Sync your Quickbooks account or upload your contact list.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row item-getting-started">
            <div class="col-md-2">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-credit-card-front' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx check-icon bxs-check-circle'></i>
                </div>  
            </div>
            <div class="col-md-10">
                <div class="content">
                    <div class="details news-details" style="">                                                    
                        <span class="content-title">
                        Set up nSmarTrac online booking
                        </span>
                        <span class="content-subtitle d-block mt-2">Sync your Quickbooks account or upload your contact list.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row item-getting-started">
            <div class="col-md-2">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-credit-card' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx check-icon bxs-check-circle'></i>
                </div>  
            </div>
            <div class="col-md-10">
                <div class="content">
                    <div class="details news-details" style="">                                                    
                        <span class="content-title">
                        Set up online payments
                        </span>
                        <span class="content-subtitle d-block mt-2">Sync your Quickbooks account or upload your contact list.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-4">
        <div class="nsm-card primary">
            <div class="nsm-card-header"><b><i class='bx bx-fw bxs-chat' style="position:relative;top:1px;"></i> Talk to a nSmarTrac expert</b></div>
            <div class="nsm-card-content">
                <h6 class="card-subtitle mb-2 text-body-secondary">Get a personal walkthrough from a nSmarTrac product expert.</h6>
                <a class="nsm-button primary mt-2" style="display:inline-block;" target="_blank" href="<?php echo base_url('demo'); ?>" class="card-link">Book a Demo</a>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    function modalSelectJobMethod(){
        
    }
});
</script>

