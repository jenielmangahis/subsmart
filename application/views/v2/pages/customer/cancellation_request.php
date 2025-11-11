<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_customer_status_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Customers cancel request.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 mb-2">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="nsm-card-title">
                                            <span><i class='bx bx-fw bx-file'></i> Customer Cancellation Request Details</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <?php if($cancel_request_data->status_request == 'Cancelled' || $cancel_request_data->status_request == 'Cancel') { ?>
                                        <div class="col-12">
                                            <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Status Request</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo $cancel_request_data->status_request ? $cancel_request_data->status_request : '---'; ?></label>
                                            </div>
                                        </div>
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Date Request Received</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo date('m/d/Y', strtotime($cancel_request_data->request_date)); ?></label>
                                            </div>
                                        </div>
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Reason</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo $cancel_request_data->reason ? $cancel_request_data->reason : '---'; ?></label>
                                            </div>
                                        </div>                       
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Next Step</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo $cancel_request_data->next_action ? $cancel_request_data->next_action : '---'; ?></label>
                                            </div>
                                        </div>
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">BOC Amount</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle">$<?php echo number_format($cancel_request_data->boc_amount,2); ?></label>
                                            </div>
                                        </div>
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">BOC Received Date</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo $cancel_request_data->boc_received_date ? date('m/d/Y', strtotime($cancel_request_data->boc_received_date)) : '---'; ?></label>
                                            </div>
                                        </div>
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">CS Closed Date</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo $cancel_request_data->cs_close_date ? date('m/d/Y', strtotime($cancel_request_data->cs_close_date)) : '---'; ?></label>
                                            </div>
                                        </div>
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Equipment Return Date</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo $cancel_request_data->equipment_return_date ? date('m/d/Y', strtotime($cancel_request_data->equipment_return_date)) : '---'; ?></label>
                                            </div>
                                        </div>
                                    <?php }elseif($cancel_request_data->status_request == 'Collection') { ?>
                                        <div class="col-12">
                                            <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Status Request</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo $cancel_request_data->status_request ? $cancel_request_data->status_request : '---'; ?></label>
                                            </div>
                                        </div> 
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Audit Date</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo date('m/d/Y', strtotime($cancel_request_data->audit_date)); ?></label>
                                            </div>
                                        </div>    
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Collection Status</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo $cancel_request_data->collection_status ? $cancel_request_data->collection_status : '---'; ?></label>
                                            </div>
                                        </div> 
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Statement of Claim</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo $cancel_request_data->statement_of_claim ? $cancel_request_data->statement_of_claim : '---'; ?></label>
                                            </div>
                                        </div> 
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Court Date</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle"><?php echo date('m/d/Y', strtotime($cancel_request_data->court_date)); ?></label>
                                            </div>
                                        </div> 
                                        <div class="row g-1 mb-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold">Judgement Amount</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label class="content-subtitle">$<?php echo $cancel_request_data->judgement_amount ? number_format($cancel_request_data->judgement_amount,2) : '---'; ?></label>
                                            </div>
                                        </div>                      
                                    <?php }elseif($cancel_request_data->status_request == 'Non Compliance Audit Needed') { ?>
                                            <div class="col-12">
                                                <div class="row g-1 mb-3">
                                                <div class="col-12 col-md-4">
                                                    <label class="content-subtitle fw-bold">Audit Date</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <label class="content-subtitle"><?php echo date('m/d/Y', strtotime($cancel_request_data->audit_date)); ?></label>
                                                </div>
                                            </div>                                        
                                    <?php } ?>

                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Status</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <?php $badge_color = $cancel_request_data->status == 'approved' ? 'bg-primary' : 'bg-danger'; ?>
                                            <label class="content-subtitle"><span class="badge <?php echo $badge_color; ?>"><?php echo $cancel_request_data->status ? ucfirst($cancel_request_data->status) : '---'; ?></span></label>
                                        </div>
                                    </div> 

                                    <div class="row mt-4">
                                        <div class="col-12 col-md-12">
                                        <button class="nsm-button primary" id="btn-approve-request">Approve Request</button>    
                                        <button class="nsm-button primary nsm-danger" id="btn-disapprove-request">Disapprove Request</button>    
                                        </div>
                                    </div>
                                    </div>
                                </div>   
                                
                                
                                <div class="row mb-3" id="cust-collection-req-container" class="cust-collection-req-container">
                                    <div class="col-12">
                                            <hr />
                                            <div class="nsm-card-title">
                                                <span><i class='bx bx-fw bx-file'></i> Collections</span>  
                                            </div>
                                            <div class="form-check" style="float:right;">
                                                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-edit-customer-collection"><span class="fa fa-edit"></span> Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Send to Collection</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->send_to_collection != null ? $cancel_request_data->send_to_collection : '--'; ?></label>
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Statement of Claim</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->statement_of_claim != null ? $cancel_request_data->statement_of_claim : '--'; ?></label>
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Court Date</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->court_date != null ? date('m/d/Y', strtotime($cancel_request_data->court_date)) : '--'; ?></label>
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Claim $</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->claim_amount > 0 ? $cancel_request_data->claim_amount : '--'; ?></label>
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Award Amount</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->award_amount > 0 ? $cancel_request_data->award_amount : '--'; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mb-2">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span><i class='bx bx-fw bx-file'></i> Customer Profile</span>   
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-1">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Customer Type</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= !empty($profile_info->customer_type) ? $profile_info->customer_type : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Sales Area</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">
                                            <?php $salesArea = '---';
                                            foreach ($sales_area as $sa) : ?>
                                                <?php if (isset($profile_info) && $profile_info->fk_sa_id != 0) {
                                                    if ($profile_info->fk_sa_id == $sa->sa_id) {
                                                        $salesArea = $sa->sa_name;
                                                    }
                                                } ?>
                                            <?php endforeach ?>
                                            <?= $salesArea ?>
                                        </label>
                                    </div>
                                    <?php if( $profile_info->customer_type == 'Commercial' ){ ?>
                                        <div class="col-12 col-md-6">
                                            <label class="content-subtitle fw-bold">Business Name</label>
                                        </div>            
                                        <div class="col-12 col-md-6">
                                            <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->business_name) ? $profile_info->business_name : '---'; ?></label>
                                        </div>
                                    <?php } ?>
                                    <?php if($companyId == 1): ?>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Industry Type</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= $industryType ? $industryType->name : 'Not Specified'; ?></label>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">First Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->first_name) ? $profile_info->first_name : 'n/a'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Middle Initial</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->middle_name) ? strtoupper($profile_info->middle_name) : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Last Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->last_name) ? $profile_info->last_name : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Name Prefix</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->prefix) ? $profile_info->prefix : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Suffix</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->suffix) ? $profile_info->suffix : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Address</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->mail_add) ? $profile_info->mail_add : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">County</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->county) ? $profile_info->county : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">City</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->city) ? $profile_info->city : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">State</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->state) ? $profile_info->state : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Zip Code</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->zip_code) ? $profile_info->zip_code : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Cross Street</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->cross_street) ? $profile_info->cross_street : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">County</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->county) ? $profile_info->county : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Subdivision</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->subdivision) ? $profile_info->subdivision : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Social Security No.</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">
                                            <?php 
                                                if (logged("user_type") == 1){
                                                    $ssn = $profile_info->ssn;
                                                }else{
                                                    $ssn = maskString($profile_info->ssn);
                                                }

                                                echo $ssn;
                                            ?>
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Date Of Birth</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?php echo ($profile_info->date_of_birth) ? date_format(date_create($profile_info->date_of_birth), "M d, Y") : "&mdash;"; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Email</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->email) ? $profile_info->email : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Phone (H)</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->phone_h) ? formatPhoneNumber($profile_info->phone_h) : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Phone (M)</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->phone_m) ? formatPhoneNumber($profile_info->phone_m) : '---'; ?></label>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mb-2">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span><i class='bx bx-fw bx-file'></i> Alarm Details</span>      
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-1 mb-5">
                                    <div class="col-12 col-md-6">
                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <label class="content-title purple-label">Account Type</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle purple-label">
                                                    <?= $alarm_info && $alarm_info->acct_type != '' ? $alarm_info->acct_type : '---'; ?>                                   
                                                </span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Dealer Number</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?php 
                                                        $dealer_number = $default_dealer_number;
                                                        if( $alarm_info && $alarm_info->dealer_number != '' ){
                                                            $dealer_number = $alarm_info->dealer_number;
                                                        }
                                                    ?>
                                                <?= $dealer_number; ?>
                                                </span>
                                            </div> 
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Site Type</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?php 
                                                        $site_type = '---';
                                                        if( $defaultAlarmSiteType ){
                                                            $site_type = $defaultAlarmSiteType->name;
                                                        }

                                                        if( $alarm_info && $alarm_info->site_type != '' ){
                                                            $site_type = $alarm_info->site_type;
                                                        }
                                                    ?>
                                                <?= $site_type; ?>  
                                                </span>
                                            </div>      
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Monitoring Company</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_customer_info && $alarm_customer_info['dealer']['data'] ? $alarm_customer_info['dealer']['data']->dealerName : '---'; ?> 
                                                </span>
                                            </div>     
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Monitoring ID</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->monitor_id != '' ? $alarm_info->monitor_id : '---'; ?>                                                                
                                                </span>
                                            </div>  
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Site Customer Type</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $profile_info->customer_type; ?>
                                                </span>
                                            </div>                                                                      
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Online</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->online != '' ? $alarm_info->online : 'No'; ?>      
                                                </span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">In Service</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->in_service != '' ? $alarm_info->in_service : 'No'; ?>      
                                                </span>
                                            </div>  
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Warranty Type</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?php 
                                                        if ($alarm_info->warranty_type) {
                                                            echo $alarm_info->warranty_type; 
                                                        } else {
                                                            echo "---";
                                                        }
                                                    ?>
                                                </span>
                                            </div>                       
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Abort Code / Password</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?php 
                                                        $passcode = '---';
                                                        if( $woLatest ){
                                                            $passcode = $woLatest->password;
                                                        }

                                                        if( $alarm_info && $alarm_info->passcode != '' ){
                                                            $passcode = $alarm_info->passcode;
                                                        }

                                                        echo $passcode;
                                                    ?>
                                                </span>
                                            </div>  
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Installer Code</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?php 
                                                        $installer_code = '---';

                                                        if( $defaultInstallerCode ){
                                                            $installer_code = $defaultInstallerCode->installer_code;
                                                        }

                                                        if( $alarm_info && $alarm_info->install_code != '' ){
                                                            $installer_code = $alarm_info->install_code;
                                                        }
                                                        
                                                    ?>
                                                    <?= $installer_code; ?>      
                                                </span>
                                            </div>   
                                            <div class="col-12 col-md-12">
                                                <label class="content-title"></label>
                                            </div>                      
                                            <div class="col-12 col-md-12">
                                                <label class="content-title"></label>
                                            </div>                      
                                            <div class="col-12 col-md-6">
                                                <label class="content-title purple-label">Service Package</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle purple-label">
                                                    <?= $alarm_info && $alarm_info->comm_type != '' ? $alarm_info->comm_type : '---'; ?>      
                                                </span>
                                            </div>   
                                            
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Account Cost</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?php 
                                                        if ($alarm_info->account_cost) {
                                                            echo "$".$alarm_info->account_cost; 
                                                        } else {
                                                            echo "---";
                                                        }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Pass Thru Cost</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->pass_thru_cost > 0 ? $alarm_info->pass_thru_cost : '0'; ?>   
                                                </span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Program and Setup</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->otps > 0 ? $alarm_info->otps : '0'; ?>   
                                                </span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Equipment Cost</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->equipment_cost > 0 ? $alarm_info->equipment_cost : '0'; ?>   
                                                </span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Gross Monitoring Rate</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->monthly_monitoring > 0 ? $alarm_info->monthly_monitoring : '0'; ?>   
                                                </span>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <label class="content-title purple-label">Panel Type</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle purple-label">
                                                    <?= $alarm_info && $alarm_info->panel_type != '' ? $alarm_info->panel_type : '---'; ?>      
                                                </span>
                                            </div>                                     
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Secondary System Type</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?php 
                                                        $secondary_system_type = 'GSM';
                                                        if( $alarm_info && $alarm_info->secondary_system_type != '' ){
                                                            $secondary_system_type = $alarm_info->secondary_system_type;
                                                        }
                                                    ?>
                                                    <?= $secondary_system_type; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Radio Serial Number</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->radio_serial_number != '' ? $alarm_info->radio_serial_number : '---'; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Panel Location</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->panel_location != '' ? $alarm_info->panel_location : '---'; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Transformer Location</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->transformer_location != '' ? $alarm_info->transformer_location : '---'; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Dealer Number</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->dealer_number != '' ? $alarm_info->dealer_number : '---'; ?>    
                                                </span>
                                            </div> 
                                            <div class="col-12 col-md-12"></div>                                                                     

                                            <div class="col-12 col-md-6">
                                                <label class="content-title purple-label">Install Type</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle purple-label">
                                                    <?= $alarm_info && $alarm_info->install_type != '' ? $alarm_info->install_type : '---'; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">DSL Voip</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->dsl_voip != '' ? $alarm_info->dsl_voip : '---'; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Contract Status</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->contract_status != '' ? $alarm_info->contract_status : '---'; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">CSID Number</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->csid_number != '' ? $alarm_info->csid_number : '---'; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Panel Phone Number</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->panel_phone_number != '' ? $alarm_info->panel_phone_number : '---'; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Connection Type</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?php 
                                                    $connection_type = '---';
                                                    if( $alarm_info ){
                                                        $connection_type = 'Wireless';
                                                        if( $alarm_info->connection_type != ''){
                                                            $connection_type = $alarm_info->connection_type;
                                                        } 
                                                    }

                                                    ?>
                                                    <?= $connection_type; ?>    
                                                </span>
                                            </div> 

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Report Format</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->report_format != '' ? $alarm_info->report_format : '---'; ?>    
                                                </span>
                                            </div>
                                            
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Receiver Phone Number</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->receiver_phone_number != '' ? $alarm_info->receiver_phone_number : '---'; ?>    
                                                </span>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Master Code</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->master_code != '' ? $alarm_info->master_code : '---'; ?>    
                                                </span>
                                            </div>

                                            <?php if( $alarm_customer_info ){ ?>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-title">ID</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <span class="content-subtitle">
                                                        <?= $alarm_customer_info && $alarm_customer_info['customer'] ? $alarm_customer_info['customer']->customerId : '---'; ?>
                                                    </span>
                                                </div>   
                                            <?php } ?>            
                                            <div class="col-12 col-md-12"></div>                                             
                                            <div class="col-12 col-md-12"></div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title purple-label">Service Provider</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle purple-label">
                                                    <?= $alarm_info && $alarm_info->dealer != '' ? trim($alarm_info->dealer) : '---'; ?>   
                                                </span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Customer ID</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->alarm_customer_id != '' ? $alarm_info->alarm_customer_id : '---'; ?>   
                                                </span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Login</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span class="content-subtitle">
                                                    <?= $alarm_info && $alarm_info->alarm_login != '' ? $alarm_info->alarm_login : '---'; ?>   
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#chk-collection').change(function() {
            $('#cust-collection-req-container').toggle(this.checked);
        });       
        
        $("#btn-quick-edit-customer-collection").click(function() {
            let cancellation_id = "<?= $cancel_request_data->id ? $cancel_request_data->id : 0; ?>";
            if( cancellation_id > 0 ){
                $('#request-cancellation-id').val(cancellation_id);
                $('#modal_customer_cancel_request_collection_update_modal').modal('show');
            }             
        });    
        
        $("#frm-customer-cancellation-collection-update").on("submit", function(e) { 
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "customer/_update_customer_collection_request";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:'json',
                beforeSend: function(data) {
                    $("#btn-customer-update-collection-request").html('<span class="bx bx-loader bx-spin"></span>');
                },                
                success: function(result) {
                    if (result.is_success === 1) {
                        $('#modal_customer_cancel_request_collection_update_modal').modal('hide');
                        _this.trigger("reset");
                        
                        Swal.fire({
                            title: 'Customer Collection',
                            text: "Customer collection has been updated successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });
                    }

                    $("#btn-customer-update-collection-request").html("Update");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $('#btn-approve-request').on('click', function(e){
            var status_request = "<?php echo $cancel_request_data->status_request; ?>";
            var customer_id    = "<?php echo $cancel_request_data->customer_id; ?>";
            var acs_ccr_id     = "<?php echo $cancel_request_data->id; ?>";
            e.preventDefault();
            Swal.fire({
                title: 'Customer Approved Request',
                html: "Are you sure you want to approved customer status request?<br/><br/>This will change customer status to " + status_request + ".",
                icon: 'question',
                confirmButtonText: 'Yes',
                showCancelButton: true,
                cancelButtonText: "No"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'customer/_update_customer_status_request',
                        dataType: 'json',
                        data: {
                            status_request:status_request,
                            customer_id: customer_id,
                            acs_ccr_id: acs_ccr_id
                        },
                        success: function(data) {    
                            $('#btn-approve-request').html('Approve Request');                   
                            if (data.is_success) {
                                Swal.fire({
                                    title: 'Customer Approved Request',
                                    text: "Customer status successfully updated to " + status_request + ".",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    title: 'Error',
                                    text: data.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    
                                });
                            }
                        },
                        beforeSend: function() {
                            $('#btn-approve-request').html('<span class="bx bx-loader bx-spin"></span>');
                        }
                    });
                }
            });
        });  
        
        $('#btn-disapprove-request').on('click', function(e){
            var status_request = "<?php echo $cancel_request_data->status_request; ?>";
            var customer_id    = "<?php echo $cancel_request_data->customer_id; ?>";
            var acs_ccr_id     = "<?php echo $cancel_request_data->id; ?>";
            e.preventDefault();
            Swal.fire({
                title: 'Customer Disapproved Request',
                html: "Are you sure you want to disapproved customer status request?",
                icon: 'question',
                confirmButtonText: 'Yes',
                showCancelButton: true,
                cancelButtonText: "No"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'customer/_customer_status_request_disapproved',
                        dataType: 'json',
                        data: {
                            status_request:status_request,
                            customer_id: customer_id,
                            acs_ccr_id: acs_ccr_id
                        },
                        success: function(data) {    
                            $('#btn-disapprove-request').html('Disapprove Request');                   
                            if (data.is_success) {
                                Swal.fire({
                                    title: 'Customer Disapproved Request',
                                    text: "Successfully disapproved request",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    title: 'Error',
                                    text: data.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    
                                });
                            }
                        },
                        beforeSend: function() {
                            $('#btn-approve-request').html('<span class="bx bx-loader bx-spin"></span>');
                        }
                    });
                }
            });
        });   
        
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>