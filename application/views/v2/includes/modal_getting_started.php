<style>
    .modal-getting-started-content .content-title {
        font-size: 20px;
        width: auto !important;
    }

    .modal-getting-started-content .content-subtitle {
        font-size: 15px !important;
        width: auto !important;
    }

    .getting-started-table {
    width: 100%;
    font-size: 15px;
    }

    .getting-started-table > thead {
    color: #888888;
    font-weight: bold;
    font-size: 14px;
    }

    .getting-started-table td {
    padding: 0.8rem 0.5rem;
    }

    .getting-started-table .nsm-row-collapse.collapsing {
    transition: unset !important;
    }

    .getting-started-table tr:not(.nsm-row-collapse) td:not(:last-child) {
    text-overflow: ellipsis;
    overflow: hidden;
    /*white-space: nowrap;*/
    word-break: break-word;
    max-width: 200px;
    }

    .getting-started-table > tbody td {
    border-bottom: 1px solid #e8e8e8;
    }

    .getting-started-table > tbody > tr:hover {
    background-color: #f7f7f7;
    }

    .getting-started-table .table-icon {
    width: 1%;
    }

    .getting-started-table > tfoot td {
    padding: 0.8rem 0 0 0;
    }

    .check-purple{
        color:#6a4a86 !important;
    }

    .getting-started-table td .bx {
    color: #888888;
    }

    .getting-started-table td > .bx-chevron-down {
    float: right;
    font-size: 20px;
    color: #888888;
    margin-top: 1px;
    }

    .getting-started-table .nsm-button.btn-sm {
    padding: 0.5rem;
    }        

</style>

<table class="getting-started-table modal-getting-started-content" id="modal-getting-started-content">
    <tbody>
        <tr>
            <td style="width: 15%">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-building' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx bxs-check-circle check-purple' style="font-size: 25px; margin-left: 55px; margin-top: -16px;"></i>
                </div>                                
            </td>
            <td>                    
                <div class=""> <!-- class="widget-item view-newsletter-details" data-id="5" -->
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
            </td>
            <td>&nbsp;</td>
        </tr>

        <tr style="cursor: pointer;" onclick="location.href='<?php echo base_url('job/new_job1'); ?>'">
            <td style="width: 15%">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-calendar-check' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx bxs-check-circle' style="font-size: 25px; margin-left: 55px; margin-top: -16px;"></i>
                </div>                                    
            </td>
            <td>                    
                <div class="">
                    <div class="content">
                        <div class="details news-details" style="">                                                    
                            <span class="content-title">
                                Schedule a job
                            </span>
                            <span class="content-subtitle d-block mt-2">Create a new job and set a time on your calendar.</span>
                        </div>
                    </div>
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="width: 15%">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-shape-circle' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx bxs-check-circle' style="font-size: 25px; margin-left: 55px; margin-top: -16px;"></i>
                </div>                                    
            </td>
            <td>                    
                <div class="">
                    <div class="content">
                        <div class="details news-details" style="">                                                    
                            <span class="content-title">
                                Invite team members
                            </span>
                            <span class="content-subtitle d-block mt-2">Assign jobs and communicate with your team.</span>
                        </div>
                    </div>
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>

        <tr style="cursor: pointer;">
            <td style="width: 15%">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-reset' style="font-size: 55px;"></i>
                    </div>
                </div>                                    
            </td>
            <td>                    
                <div class="">
                    <div class="content">
                        <div class="details news-details" style="">                                                    
                            <span class="content-title">
                                Connect to Quickbooks or import client list
                            </span>
                            <span class="content-subtitle d-block mt-2">Sync your Quickbooks account or upload your contact list.</span>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class="bx bx-chevron-right"></i> 
                    </div>
                </div>                   
            </td>
        </tr>

        <tr>
            <td style="width: 15%">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-mobile-alt' style="font-size: 55px;"></i>
                    </div>
                    <i class='bx bxs-check-circle' style="font-size: 25px; margin-left: 55px; margin-top: -16px;"></i>
                </div>                                    
            </td>
            <td>                    
                <div class="">
                    <div class="content">
                        <div class="details news-details" style="">                                                    
                            <span class="content-title">
                                Download the mobile app
                            </span>
                            <span class="content-subtitle d-block mt-2">Send jobs to your team in the field and collect payments.</span>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    &nbsp;
                </div>                   
            </td>
        </tr>

        <!-- 
        <tr>
            <td style="width: 15%">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-phone-call' style="font-size: 55px;"></i>
                    </div>
                </div>                                    
            </td>
            <td>                    
                <div class="">
                    <div class="content">
                        <div class="details news-details" style="">                                                    
                            <span class="content-title">
                                Get a Workiz number
                            </span>
                            <span class="content-subtitle d-block mt-2">Send appointment reminders to clients and never miss a job.</span>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class="bx bx-chevron-right"></i> 
                    </div>
                </div>                   
            </td>
        </tr>
        -->

        <tr id="nsmart-online-booking" class="nsmart-online-booking" onclick="location.href='<?php echo base_url('more/addon/booking'); ?>'" style="cursor: pointer;">
            <td style="width: 15%">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-credit-card-front' style="font-size: 55px;"></i>
                    </div>
                </div>                                    
            </td>
            <td>                    
                <div class="">
                    <div class="content">
                        <div class="details news-details" style="">                                                    
                            <span class="content-title">
                                Set up nSmarTrac online booking
                            </span>
                            <span class="content-subtitle d-block mt-2">Add online booking to your site, Facebook and Yelp pages to book more work.</span>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class="bx bx-chevron-right"></i> 
                    </div>
                </div>                   
            </td>
        </tr>

        <tr>
            <td style="width: 15%">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class='bx bx-credit-card' style="font-size: 55px;"></i>
                    </div>
                </div>                                    
            </td>
            <td>                    
                <div class="">
                    <div class="content">
                        <div class="details news-details" style="">                                                    
                            <span class="content-title">
                                Set up online payments
                            </span>
                            <span class="content-subtitle d-block mt-2">Enable clients to pay you online with easy credit card processing.</span>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <i class="bx bx-chevron-right"></i> 
                    </div>
                </div>                   
            </td>
        </tr>
        
    </tbody>
</table>  
<br />
<div class="card" style="width: 30rem;">
  <div class="card-body">
    <h4 class="card-title">Talk to a nSmarTrac expert</h4>
    <h6 class="card-subtitle mb-2 text-body-secondary">Get a personal walkthrough from a nSmarTrac product expert.</h6>
    <a target="_blank" href="<?php echo base_url('demo'); ?>" class="card-link">Book a Demo</a>
  </div>
</div>

