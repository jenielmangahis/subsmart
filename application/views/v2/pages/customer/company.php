<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
    .select2-dropdown{
        z-index: 999999;
    }
    .nsm-card {
        padding: 1.5em;
        border-radius: 0;
    }
    .close-btn{
        border: none;
        background-color: transparent;
    }
 
    #company-list_filter{
        display: none;
    }
    #company-list_length{
        display: none;
    }
    .form_line{
        margin-bottom: 10px;
    }
    .nsm-counter .bx{
        font-size: 1em;
        padding: 2px;
        display: none;

    }
    .nsm-counter h2{
        font-size: 16px;
    }
    .nsm-counter {
    padding: 0.8rem 1rem;
    }
    #company-list .table-icon {
	    width: 1% !important;
    }   
    .dropdown-toggle a{
        text-decoration:none;
    }
    #company-list td .bx {
        color: #888888;
    }
</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
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
                            Listing of all 	Commercial Customers.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <?php 
                      $colorClasses = ['primary', 'success', 'error', 'secondary'];
                      $index = 0;
                    foreach($statusCounts as $status => $count){?>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="nsm-counter <?php echo $colorClasses[$index % 4]; ?> h-100 mb-2 " id="estimates">
                            <div class="row h-100 w-auto">
                                
                                <div class=" w-100 col-md-8 text-start d-flex align-items-center  justify-content-between">
                                <span><i class="bx bx-receipt"></i> <?php 
                                if($status == 'Design Team/Engineering Stamps')
                                {
                                  echo 'Design/Eng Stamps';
                                }
                                elseif($status == 'Loan Documents to be Executed')
                                {
                                    echo 'Loan Docs to be Executed';
                                }else{
                                   echo $status; 
                                }
                                ?></span>
                                <h2 id="total_this_year"><?php echo $count ?></h2>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $index++;}; ?>
                </div>
                <div class="row mt-5">
                    <div class="col-12 col-md-4">
                        <form >
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="COMMERCIAL_SEARCHBAR" name="search" placeholder="Search Commercials" >                                
                            </div>
     
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by : <span id="filter-selected">All Status</span></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                 <li><a class="dropdown-item"data-value="" href="#">All Status</a></li>
                                 <?php  foreach($statusCounts as $status => $count){?>
                                <li><a class="dropdown-item" data-value="<?= $status ?>" href="#"><?= $status ?></a></li>
                              
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary" id="openModalBtn"  style="margin-left: 10px; cursor:pointer"><i class="bx bx-building"></i> New Customer</a>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" id="btn-commercial-export-list">
                                <i class='bx bx-fw bx-file'></i> Export
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="page_type" value="company">
                
                <?php if (!empty($enabled_table_headers)) : ?>
                    <div class="cont">
                        <table id="company-list" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="table-icon"></th>
                                    <?php if (in_array('name', $enabled_table_headers)) : ?><th data-name="Name">Name</th><?php endif; ?>
                                    <?php if (in_array('email', $enabled_table_headers)) : ?><th data-name="Name">Email</th><?php endif; ?>
                                    <?php if (in_array('industry', $enabled_table_headers)) : ?><th data-name="Name">Industry</th><?php endif; ?>
                                    <?php if (in_array('city', $enabled_table_headers)) : ?><th data-name="City">City</th><?php endif; ?>
                                    <?php if (in_array('state', $enabled_table_headers)) : ?><th data-name="State">State</th><?php endif; ?>
                                    <?php if (in_array('source', $enabled_table_headers)) : ?><th data-name="Source">Source</th><?php endif; ?>
                                    <?php if (in_array('added', $enabled_table_headers)) : ?><th data-name="Added">Added</th><?php endif; ?>
                                    <?php if (in_array('sales_rep', $enabled_table_headers)) : ?><th data-name="Sales Rep">Sales Rep</th><?php endif; ?>
                                    <?php if (in_array('tech', $enabled_table_headers)) : ?><th data-name="Tech">Tech</th><?php endif; ?>
                                    <?php if (in_array('plan_type', $enabled_table_headers)) : ?><th data-name="Plan Type">Plan Type</th><?php endif; ?>
                                    <?php if (in_array('rate_plan', $enabled_table_headers)) : ?><th data-name="Rate Plan">Rate Plan</th><?php endif; ?>
                                    <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?><th data-name="<?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'   ?> "><?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'   ?> </th><?php endif; ?>
                                    <?php if (in_array('job_amount', $enabled_table_headers)) : ?><th data-name="<?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount' ?>"><?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?></th><?php endif; ?>
                                    <?php if (in_array('phone', $enabled_table_headers)) : ?><th data-name="Phone">Phone</th><?php endif; ?>
                                    <?php if (in_array('status', $enabled_table_headers)) : ?><th data-name="Status">Status</th><?php endif; ?>
                                    <th data-name="Manage"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($profiles)) :
                                ?>
                                    <?php
                                    foreach ($profiles as $customer) :
                                        switch (strtoupper($customer->status)):
                                            case "INSTALLED":
                                                $badge = "success";
                                                break;
                                            case "CANCELLED":
                                                $badge = "error";
                                                break;
                                            case "COLLECTIONS":
                                                $badge = "secondary";
                                                break;
                                            case "CHARGED BACK":
                                                $badge = "primary";
                                                break;
                                            default:
                                                $badge = "";
                                                break;
                                        endswitch;
                                    ?>
                                        <?php if (in_array('name', $enabled_table_headers)) : ?>
                                            <td>
                                                <div class="nsm-profile">
                                                    <?php if ($customer->customer_type === 'Business'): ?>
                                                        <span>
                                                        <?php 
                                                            $parts = explode(' ', strtoupper(trim($customer->business_name)));
                                                            echo count($parts) > 1 ? $parts[0][0] . end($parts)[0] : $parts[0][0];
                                                        ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span><?= ucwords($customer->first_name[0]) . ucwords($customer->last_name[0]) ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="nsm-text-primary">
                                                <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('/customer/module/' . $customer->prof_id); ?>'">
                                                    <?php if ($customer->customer_type === 'Business'): ?>
                                                        <?= $customer->business_name ?>
                                                    <?php else: ?>
                                                        <?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?>
                                                    <?php endif; ?>
                                                </label>
                                                <label class="nsm-link default content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                                            </td>
                                        <?php endif; ?>
                                        <?php if (in_array('industry', $enabled_table_headers)) : ?>
                                            <td>
                                                <?php 
                                                    if( $customer->industry_type_id > 0 ){
                                                        echo $customer->industry_type;
                                                    }else{
                                                        echo 'Not Specified';                                                    
                                                    }
                                                ?>
                                            </td>
                                        <?php endif; ?>
                                        <?php if (in_array('city', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->city; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('state', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->state; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('source', $enabled_table_headers)) : ?>
                                            <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('added', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->entered_by; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('sales_rep', $enabled_table_headers)) : ?>
                                            <td><?php print_r( get_sales_rep_name($customer->fk_sales_rep_office)); ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('tech', $enabled_table_headers)) : ?>
                                            <?php $techician = !empty($customer->technician) ?  get_employee_name($customer->technician)->FName : 'Not Assigned'; ?>
                                            <td><?= $techician; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('plan_type', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->system_type; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('rate_plan', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->rate_plan; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?>
                                            <td>$<?= $companyId == 58 ? number_format(floatval($customer->proposed_payment), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',') ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?>
                                            <td>$<?= $companyId == 58 ? number_format(floatval($customer->proposed_solar), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',') ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('phone', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->phone_m; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('status', $enabled_table_headers)) : ?>
                                            <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                                        <?php endif; ?>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo base_url('customer/preview_/' . $customer->prof_id); ?>">Preview</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo base_url('customer/add_advance/' . $customer->prof_id); ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="mailto:<?= $customer->email; ?>">Email</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item call-item" href="javascript:void(0);" data-id="<?= $customer->phone_m; ?>">Call</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?= base_url('invoice/add/'); ?>">Invoice</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?= base_url('customer/module/' . $customer->prof_id); ?>">Dashboard</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?= base_url('job/new_job1/'); ?>">Schedule</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item btn-messages" href="javascript:void(0);" data-id="<?= $customer->prof_id; ?>">Message</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                <?php
                                else :
                                ?>
                                    <tr>
                                        <td colspan="14">
                                            <div class="nsm-empty">
                                                <span>No results found.</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="cont">
                        <table id="person-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-icon"></th>
                                    <th data-name="Name">Name   </th>
                                    <?php if($companyId == 1): ?>
                                    <th data-name="Name">Industry</th>
                                    <?php endif; ?>
                                    <th data-name="City">City</th>
                                    <th data-name="State">State</th>
                                    <th data-name="Source">Source</th>
                                    <th data-name="Added">Added</th>
                                    <th data-name="Sales Rep">Sales Rep</th>
                                    <th data-name="<?= $companyId == 58 ? 'Mentor' : 'Tech'   ?>"><?= $companyId == 58 ? 'Mentor' : 'Tech'   ?></th>
                                    <th data-name="Plan Type">Plan Type</th>
                                    <th data-name="<?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?>"><?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?></th>
                                    <th data-name="<?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?>"><?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?></th>
                                    <th data-name="Phone">Phone</th>
                                    <th data-name="Status">Status</th>
                                    <th data-name="Manage"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

            </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade nsm-modal fade" id="company_modal" tabindex="-1" aria-labelledby="company_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="person_and_company_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id=""><i class="bx bx-building"></i> Add Commercial Customer</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" style="overflow-y:auto;overflow-x:hidden;max-height:700px;">

                <div class="row form_line">
                    <div class="col-md-4">
                        Status
                    </div>
                    <input type="hidden" name="prof_id" id="prof_id">
                    <div class="col-md-8">
                        <select data-type="customer_status" id="status" name="status" data-customer-source="dropdown" class="input_select" >
                            <option  value=""></option>
                            <?php foreach ($customer_status as $status): ?>
                                <option <?= isset($profile_info) ? ($profile_info->status == $status->name ? 'selected' : '') : '' ?> value="<?= $status->name ?>"><?= $status->name ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Customer Type
                    </div>
                    <div class="col-md-8">
                    <input data-type="customer_type" type="text" class="form-control email-input-element" name="customer_type" id="person_type" value="Commercial" readonly/>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Customer Group
                    </div>
                    <div class="col-md-8">
                        <select id="customer_group" name="customer_group" data-customer-source="dropdown" class="form-controls input_select">
                            <?php foreach($customerGroups as $cg){ ?>
                                <option value="<?= $cg->id; ?>"><?= $cg->title; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <?php if($company_id == 1): ?>
                <div class="row form_line">
                    <div class="col-md-4">
                        Industry Type
                    </div>
                    <div class="col-md-8">
                        <select 
                            id="industry_type" 
                            name="industry_type" 
                            data-customer-source="dropdown" 
                            class="form-controls input_select"
                        >
                            <option>Select your Industry</option>
                            <?php $businessTypeName  = "";
                                foreach($industryTypes  as $industryType ){ ?>
                                <?php if ($businessTypeName!== $industryType->business_type_name ) { ?> 
                                            <optgroup label="<?php echo $industryType->business_type_name; ?>">
                                <?php  $businessTypeName =  $industryType->business_type_name; }      ?>  
                                <?php 
                                    $selected_industry_type = 0;
                                    if( isset($profile_info) ){
                                        $selected_industry_type = $profile_info->industry_type_id;
                                    }
                                ?>
                                    <option <?= $selected_industry_type == $industryType->id ? 'selected="selected"' : ''; ?> value="<?php echo $industryType->id; ?>"><?php echo $industryType->name; ?></option>
                                <?php  }   ?>
                        </select>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row form_line">
                    <div class="col-md-4">
                        Sales Area
                    </div>
                    <div class="col-md-8">
                        <select name="fk_sa_id" id="fk_sa_id" data-type="customer_sales_area" class="form-control">
                        <?php foreach( $salesAreaSelected as $salesArea){

                            ?>
                            <option value="<?= $salesArea->sa_id; ?>"><?=  $salesArea->sa_name; ?></option>
                            <?php } ?>
                        </select>
                        
                    </div>
                </div>
            
                <div class="row form_line" id="businessName">
                    <div class="col-md-4 " id="businessNameLabel">
                        <label for="" >Business Name
                    </div>
                    <div class="col-md-8" id="businessNameInput">
                        <input type="text" class="form-control" name="business_name" id="business_name" value="<?php if(isset($profile_info)){ echo $profile_info->business_name; } ?>"/>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        First Name <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Middle Initial
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" maxlength="1" name="middle_name" id="middle_name" value="<?php if(isset($profile_info)){ echo $profile_info->middle_name; } ?>" />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Last Name <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Name Prefix
                    </div>
                    <div class="col-md-8">
                        <select id="prefix" name="prefix" data-customer-source="dropdown" class="form-controls input_select searchable-dropdown">
                            <?php
                            for ($prefix=0;$prefix<28;$prefix++){
                                ?>
                                <option <?php if(isset($profile_info)){ if($profile_info->prefix == prefix_name($prefix)){ echo 'selected'; } } ?> value="<?= prefix_name($prefix); ?>">
                                    <?= prefix_name($prefix); ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Suffix
                    </div>
                    <div class="col-md-8">
                        <select id="suffix" name="suffix" data-customer-source="dropdown" class="input_select searchable-dropdown" >
                            <?php
                            for ($suffix=0;$suffix<14;$suffix++){
                                ?>
                                <option <?php if(isset($profile_info)){ if($profile_info->suffix == suffix_name($suffix)){ echo 'selected'; } } ?> value="<?= suffix_name($suffix); ?>"><?= suffix_name($suffix); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Country
                    </div>
                    <div class="col-md-8">
                        <input data-type="customer_address_country" type="text" class="form-control" name="country" id="country" value="<?php if(isset($profile_info->country)){ echo $profile_info->country; } ?> " />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Address <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input data-type="customer_address" type="text" class="form-control" name="mail_add" id="mail_address" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" required/>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        City <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input data-type="customer_address_city" type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" required/>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        County <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input data-type="customer_address_county" type="text" class="form-control" name="county" id="county" value="<?php if(isset($profile_info->county)){ echo $profile_info->county; } ?>" required/>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        State <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input data-type="customer_address_state" type="text" class="form-control" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->state; } ?>" required/>
                    </div>
                </div>

                <div class="row form_line">
                    <div class="col-md-4">
                        Zip Code <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input required data-type="customer_address_zip" type="text" class="form-control" name="zip_code" id="zip_code" value="<?php if(isset($profile_info->zip_code)){ echo $profile_info->zip_code; } ?>"/>
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Cross Street
                    </div>
                    <div class="col-md-8">
                        <input data-type="customer_address_street" type="text" class="form-control" name="cross_street" id="cross_street" value="<?php if(isset($profile_info->cross_street)){ echo $profile_info->cross_street; } ?>"/>
                    </div>
                </div>                
                <div class="row form_line">
                    <div class="col-md-4">
                        Subdivision
                    </div>
                    <div class="col-md-8">
                        <input data-type="customer_address_subdivision" type="text" class="form-control" name="subdivision" id="subdivision" value="<?php if(isset($profile_info->subdivision)){ echo $profile_info->subdivision; } ?>" />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Social Security No.
                    </div>
                    <div class="col-md-8">
                        <input type="text" placeholder="xxx-xx-xxxx" maxlength="11" class="form-control" name="ssn" id="ssn" value="<?php if(isset($profile_info)){ echo $profile_info->ssn; } ?>" />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Date Of Birth 
                    </div>
                    <div class="col-md-8">
                        <input type="text" placeholder="" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php if(isset($profile_info)){ echo date("m/d/Y", strtotime($profile_info->date_of_birth)); } ?>" />
                    </div>
                </div>

                <div class="row form_line">
                    <div class="col-md-4">
                        Email 
                    </div>
                    <div class="col-md-8">
                        <input data-type="customer_email" type="email" class="form-control email-input-element" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" />
                    </div>
                </div>

                <div class="row form_line">
                    <?php 
                    $phone_h;
                    $phone_m;

                    if(strpos($profile_info->phone_h, "Mobile:") !== false){
                        $str = $profile_info->phone_h;
                        $exp = explode("Mobile:",$str);
                        $phone_h = preg_replace('/\s+/', '-', ltrim($exp[0]));
                        $phone_m = preg_replace('/\s+/', '-', ltrim($exp[1]));
                    }else{
                        $phone = preg_replace('/\s+/', '-', ltrim($profile_info->phone_h));
                    } ?>
                    <div class="col-md-4">
                        Phone (H)
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_h" id="phone_h" value="<?php if(isset($profile_info)){ echo $phone_h == null ? $phone : $phone_h; } ?>" />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Phone (M) <span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_m" id="phone_m" value="<?php if(isset($profile_info->phone_h) || isset($profile_info->phone_m)){ echo $profile_info->phone_m != null ? $profile_info->phone_m : $phone_m; } ?>" required />
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script>
$(document).ready(function() {
    var csv_data;
    var COMPANY_LIST_TABLE = $('#company-list').DataTable({
        "ordering": false,
        "processing": true,
        "serverSide": true,
        //"lengthMenu": [10, 25, 50, 75, 100], // Display options for the length menu
        "pageLength": 10,
        "ajax": {
            "url": "<?= base_url('customer/getCompanyList'); ?>",
            "type": "POST",
            "data": function (d) {
            // Include custom parameters for filtering
            d.filter_status = $('#filter-selected').text().trim(); // Get filter value from UI element
            },
            "dataSrc": function (json) {
                // Handle the response here
                //console.log(json);
                // Return the data portion of the response
                csv_data = json.data;
                //console.log(csv_data);
                return json.data;
            }
        },
    });

    $('#btn-commercial-export-list').on('click', function(){
        location.href = base_url + 'customer/export_commercial_list';
    });

    $("#COMMERCIAL_SEARCHBAR").keyup(function() {
        COMPANY_LIST_TABLE.search($(this).val()).draw();

    });
    $('.select-filter .dropdown-item').on('click', function(e) {
        e.preventDefault();

        // Get data-value and text of the clicked item
        var filterValue = $(this).attr('data-value');
        var filterText = $(this).text();

        // Update the text inside #filter-selected span
        $('#filter-selected').text(filterText);

        COMPANY_LIST_TABLE.ajax.reload();

    });

    $("#openModalBtn").click(function(){
        // Show the modal
        $("#company_modal").modal('show');
    });

    function deleteItem(itemId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this item!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            // Send an AJAX request to delete the item
            $.ajax({
                url: `${base_url}customer/delete/${itemId}`, // Replace with your server-side script to handle the deletion
                type: 'POST',
                data: { id: itemId },
                success: function(response) {
                Swal.fire(
                    'Deleted!',
                    'The item has been deleted.',
                    'success'
                ).then(() => {
                    location.reload();
                });
                },
                error: function(xhr, status, error) {
                Swal.fire(
                    'Error!',
                    'An error occurred while deleting the item.',
                    'error'
                );
                }
            });
            }
        });
    }
    function cleanPhoneNumber(phoneHtml) {
        const regex = /(?:<p>Phone \(\w\) : )([\d\+\-\(\) ]+)(?:<\/p>)/g;
        const matches = phoneHtml.matchAll(regex);
        const phoneNumbers = Array.from(matches, match => match[1]);
        return phoneNumbers.join(', '); // Concatenate multiple phone numbers with commas
    }

    // Function to convert data to CSV format using Papa Parse
    function convertDataToCSV(data, headers) {
        // Prepare Papa Parse config for CSV conversion
        var csvConfig = {
            quotes: false, // Disable quotes for each field
            delimiter: ",", // Set delimiter as comma
            header: true, // Include headers in CSV output
        };

        // Map and transform each row of data
        var csvData = data.map(row => {
            // Exclude the last column (assuming it's the 5th column based on your provided data)
            var rowSubset = row.slice(0, -1); // Exclude the last element in the row

            return {
                [headers[0]]: rowSubset[0], // Contact Name
                [headers[1]]: rowSubset[1], // Email
                [headers[2]]: rowSubset[2], 
                [headers[3]]: cleanPhoneNumber(rowSubset[3]), 
                [headers[4]]: rowSubset[4],// Customer Type
                [headers[5]]: rowSubset[5],//Status
            };
        });

        // Convert data to CSV format using Papa Parse
        var csv = Papa.unparse(csvData, csvConfig);
        return csv; // Return the generated CSV string
    }

    $(document).on("click", ".call-item", function() {
        let phone = $(this).attr("data-id");

        window.open('tel:' + phone);
    }); 

    $(document).on('click', '.delete-customer', function(){
        var cid = $(this).attr('data-id');
        Swal.fire({            
            html: "Delete selected customer?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                var url = base_url + "customer/_delete_customer";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {cid:cid},
                    dataType: 'json',
                    beforeSend: function(result) {
                        
                    },
                    success: function(result) {                                                                        
                        if(result.is_success  == 1){
                            Swal.fire({
                                html: 'Customer record was deleted successfully',                        
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                PERSON_LIST_TABLE.ajax.reload();  
                            });                                  
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: result.msg
                            });
                        }                               
                    },
                    complete : function(){
                        
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        });
    });

    $(document).on('click', '.sms-messages', function(){
        var profid = $(this).attr('data-id');
        //var url = base_url + 'customer/_get_messages';
        var url = base_url + 'customer/_load_customer_sms_messages';

        $('#messages_modal').modal('show');
        $(".modal-messages-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
        $.ajax({
            type: "POST",
            url: url,             
            data: {profid:profid},
            success: function(o)
            {          
                $(".modal-messages-container").html(o);                
            }
        });
        }, 800);
    });

    $(document).on('click', '.send-email', function(){
        var customer_email = $(this).attr('data-email');
        var customer_eid   = $(this).attr('data-id');
        
        $('#send_email_modal').modal('show');
        $('#customer-email').val(customer_email);
        $('#customer-send-email-eid').val(customer_eid);
        $('#email-message').val('');
        $('#email-subject').val('');
    });    

    $(document).on('submit', '#frm-send-email', function(e){
        e.preventDefault();
        
        var url = base_url + 'customer/_send_email';
        $.ajax({
            type: "POST",
            url: url,   
            dataType: "json",          
            data: $('#frm-send-email').serialize(),
            beforeSend: function(data) {
                $("#btn_send_email").html('<span class="bx bx-loader bx-spin"></span>');
            },
            success: function(o)
            {          
                $("#btn_send_email").html('Send');
                if(o.is_success  == 1){
                    Swal.fire({
                        html: 'Email sent',                        
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                    $("#send_email_modal").modal('hide');                
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: o.msg
                    });
                }                
            },
            complete : function(){
                            
            },
            error: function(e) {
                console.log(e);
            }
        });

        $("#btn_send_email").html('<span class="bx bx-loader bx-spin"></span>');
    });
});
</script>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<?php include viewPath('v2/pages/customer/js/add_advance_js'); ?> 
