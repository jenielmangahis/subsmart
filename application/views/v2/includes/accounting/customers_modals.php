<style>
 .customer-modal-scroll {
    overflow: scroll !important;
    height: 800px !important;
 }
</style>

<div class="modal fade nsm-modal" id="print_customers_modal" tabindex="-1" aria-labelledby="print_customers_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_customers_modal_label">Print Customers List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body customer-modal-scroll" id="customer-modal-scroll">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Customer/Company">CUSTOMER/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td data-name="Customer Type">CUSTOMER TYPE</td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($customers) > 0) : ?>
						<?php foreach($customers as $customer) : ?>
                        <tr>
                            <td><?=$customer->last_name.', '.$customer->first_name?></td>
                            <td>
                                <?php
                                    $address = '';
                                    $address .= $customer->mail_add !== null ? $customer->mail_add : "";
                                    $address .= $customer->city !== null ? '<br />' . $customer->city : "";
                                    $address .= $customer->state !== null ? ', ' . $customer->state : "";
                                    $address .= $customer->zip_code !== null ? ' ' . $customer->zip_code : "";

                                    echo !empty($address) ? $address : 'Not Specified';
                                ?>
                            </td>
                            <td><?= !empty($customer->phone_h) ? $customer->phone_h : 'Not Specified';?></td>
                            <td><?= !empty($customer->email) ? $customer->email : 'Not Specified'; ?></td>
                            <td><?= !empty($customer->customer_type) ? $customer->customer_type : 'Not Specified'; ?></td>
                            <td></td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="19">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_customers">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_customers_modal" tabindex="-1" aria-labelledby="print_preview_customers_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_customers_modal_label">Print Customers List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body customer-modal-scroll" id="customer-modal-scroll">
                <table class="w-100" id="customers_table_print">
                    <thead>
                        <tr>
                            <td data-name="Customer/Company">CUSTOMER/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td data-name="Customer Type">CUSTOMER TYPE</td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($customers) > 0) : ?>
						<?php foreach($customers as $customer) : ?>
                        <tr>
                            <td><?=$customer->last_name.', '.$customer->first_name?></td>
                            <td>
                                <?php
                                    $address = '';
                                    $address .= $customer->mail_add !== "" ? $customer->mail_add : "";
                                    $address .= $customer->city !== "" ? '<br />' . $customer->city : "";
                                    $address .= $customer->state !== "" ? ', ' . $customer->state : "";
                                    $address .= $customer->zip_code !== "" ? ' ' . $customer->zip_code : "";

                                    echo $address;
                                ?>
                            </td>
                            <td><?=$customer->phone_h?></td>
                            <td><?=$customer->email?></td>
                            <td><?=$customer->customer_type?></td>
                            <td></td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="19">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="select-customer-type-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select Customer Type</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <select name="customer_type" id="customer-type" class="form-select nsm-field">
                            <option value="Residential">Residential</option>
                            <option value="Business">Business</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="apply-customer-type">Apply</button>
            </div>
        </div>
    </div>
</div>

<div class="full-screen-modal">
    <form id="add-customer-form">
        <div class="modal fade nsm-modal" id="add-customer-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Add Customer</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span><i class="bx bx-fw bx-user"></i>New Advance Customer</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <hr>
                                        <div class="row g-3">
                                            <div class="col-12 col-md">
                                                <label class="content-subtitle fw-bold mb-2">
                                                    <field-custom-name readonly default="Rep Paper" form="papers"></field-custom-name>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox" value="rep_paper_date" id="rep_paper" >
                                                    </div>
                                                    <input value="" type="text" class="form-control nsm-field" name="rep_paper_date" id="rep_paper_date" >
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <label class="content-subtitle fw-bold mb-2">
                                                    <field-custom-name readonly default="Tech Paper" form="papers"></field-custom-name>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox" value="tech_paper_date" >
                                                    </div>
                                                    <input value="" type="text" class="form-control nsm-field" name="tech_paper_date" id="tech_paper_date" >
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <label class="content-subtitle fw-bold mb-2">
                                                    <field-custom-name readonly default="Scanned" form="papers"></field-custom-name>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox" value="scanned_date" >
                                                    </div>
                                                    <input value="" type="text" class="form-control nsm-field" name="scanned_date" id="scanned_date" >
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <label class="content-subtitle fw-bold mb-2">
                                                    <field-custom-name readonly default="Paperwork" form="papers"></field-custom-name>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox" value="scanned_date">
                                                    </div>
                                                    <select class="nsm-field form-select" name="paperwork" id="paperwork">
                                                        <option value="" selected="selected">Select</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Rejected">Rejected</option>
                                                        <option value="Pending Kept">Pending Kept</option>
                                                        <option value="Pending Sent">Pending Sent</option>
                                                        <option value="None">None</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <label class="content-subtitle fw-bold mb-2">
                                                    <field-custom-name readonly default="Submitted" form="papers"></field-custom-name>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox" value="submitted" >
                                                    </div>
                                                    <input value="" type="text" class="form-control nsm-field" name="submitted" id="submitted" >
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <label class="content-subtitle fw-bold mb-2">
                                                    <field-custom-name readonly default="Rep Paid" form="papers"></field-custom-name>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control nsm-field" name="rep_paid" id="rep_paid"  min="0" step="0.01">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <label class="content-subtitle fw-bold mb-2">
                                                    <field-custom-name readonly default="Tech Paid" form="papers"></field-custom-name>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control nsm-field" name="tech_paid" id="tech_paid"  min="0">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <label class="content-subtitle fw-bold mb-2">
                                                    <field-custom-name readonly default="Funded" form="papers"></field-custom-name>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox" value="funded" >
                                                    </div>
                                                    <input value="" type="text" class="form-control nsm-field" name="funded" id="funded" >
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <label class="content-subtitle fw-bold mb-2">
                                                    <field-custom-name readonly default="Charged Back" form="papers"></field-custom-name>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox" value="charged_back" >
                                                    </div>
                                                    <input value="" type="text" class="form-control nsm-field" name="charged_back" id="charged_back" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-user"></i>Customer Profile</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content">
                                                <hr>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Status
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select data-type="customer_status" id="status" name="status" data-customer-source="dropdown" class="input_select" >
                                                            <option value="" disabled selected disabled selected>&nbsp;</option>
                                                            <?php foreach ($customer_status as $status): ?>
                                                                <option value="<?= $status->name ?>"><?= $status->name ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <a href="javascript:void(0);" onclick="window.open('<?= base_url('customer/settings/customerStatus') ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');" style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Status</a>&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Customer Type
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select  id="customer_type"  name="customer_type"  data-customer-source="dropdown"  class="form-control input_select">
                                                            <option value="Residential">Residential</option>
                                                            <option value="Business">Business</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Customer Group
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select id="customer_group" name="customer_group" data-customer-source="dropdown" class="form-control input_select">
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
                                                        <select id="industry_type" name="industry_type" data-customer-source="dropdown" class="form-controls input_select">
                                                            <option disabled selected>Select your Industry</option>
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
                                                                    <option value="<?php echo $industryType->id; ?>"><?php echo $industryType->name; ?></option>
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
                                                        <select name="fk_sa_id" data-type="customer_sales_area" class="form-control" >
                                                            <option value="<?=$profile_info->fk_sa_id?>"><?=$profile_info->fk_sa_text?></option>
                                                        </select>
                                                        <a href="<?= base_url() ?>customer/settings/salesArea" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Sales Area</a>&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                                <div class="row form_line" id="businessName">
                                                    <div class="col-md-4" id="businessNameLabel">
                                                        <label for="" >Business Name
                                                    </div>
                                                    <div class="col-md-8" id="businessNameInput">
                                                        <input type="text" class="form-control nsm-field" name="business_name" id="business_name" value="<?php if(isset($profile_info)){ echo $profile_info->business_name; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        First Name <span class="required"> *</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Middle Initial
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field" maxlength="1" name="middle_name" id="middle_name" value="<?php if(isset($profile_info)){ echo $profile_info->middle_name; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Last Name <span class="required"> *</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Name Prefix
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select id="prefix" name="prefix" data-customer-source="dropdown" class="form-control input_select searchable-dropdown">
                                                            <?php
                                                            for ($prefix=0;$prefix<28;$prefix++){
                                                                ?>
                                                                <option <?php if(isset($profile_info)){ if($profile_info->prefix == prefix_name($prefix)){ echo 'selected'; } } ?> value="<?= prefix_name($prefix); ?>">
                                                                    <?= prefix_name($prefix) ? prefix_name($prefix) : '&nbsp;'; ?>
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
                                                        <select id="suffix" name="suffix" data-customer-source="dropdown" class="form-control input_select searchable-dropdown" >
                                                            <?php
                                                            for ($suffix=0;$suffix<14;$suffix++){
                                                                ?>
                                                                <option <?php if(isset($profile_info)){ if($profile_info->suffix == suffix_name($suffix)){ echo 'selected'; } } ?> value="<?= suffix_name($suffix); ?>"><?= suffix_name($suffix) ? suffix_name($suffix) : '&nbsp;'; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Address <span class="required"> *</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input data-type="customer_address" type="text" class="form-control nsm-field" name="mail_add" id="mail_address" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        City <span class="required"> *</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input data-type="customer_address_city" type="text" class="form-control nsm-field" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        State <span class="required"> *</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input data-type="customer_address_state" type="text" class="form-control nsm-field" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->state; } ?>" required/>
                                                    </div>
                                                </div>

                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Zip Code <span class="required"> *</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input required data-type="customer_address_zip" type="text" class="form-control nsm-field" name="zip_code" id="zip_code" value="<?php if(isset($profile_info->zip_code)){ echo $profile_info->zip_code; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Cross Street
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input data-type="customer_address_street" type="text" class="form-control nsm-field" name="cross_street" id="cross_street" value="<?php if(isset($profile_info->cross_street)){ echo $profile_info->cross_street; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        County
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input data-type="customer_address_country" type="text" class="form-control nsm-field" name="country" id="country" value="<?php if(isset($profile_info->country)){ echo $profile_info->country; } ?> " />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Subdivision
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input data-type="customer_address_subdivision" type="text" class="form-control nsm-field" name="subdivision" id="subdivision" value="<?php if(isset($profile_info->subdivision)){ echo $profile_info->subdivision; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Social Security No.
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" placeholder="xxx-xx-xxxx" maxlength="11" class="form-control nsm-field" name="ssn" id="ssn" value="<?php if(isset($profile_info)){ echo $profile_info->ssn; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Date Of Birth 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div data-type="customer_birthday" data-value="<?php if(isset($profile_info)){ echo date("Y-m-d", strtotime($profile_info->date_of_birth)); } ?>"></div>
                                                    </div>
                                                </div>

                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Email 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input data-type="customer_email" type="email" class="form-control nsm-field" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" />
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
                                                        <input type="text" class="form-control nsm-field phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_h" id="phone_h" value="<?php if(isset($profile_info)){ echo $phone_h == null ? $phone : $phone_h; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Phone (M) <span class="required"> *</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_m" id="phone_m" value="<?php if(isset($profile_info->phone_h) || isset($profile_info->phone_m)){ echo $profile_info->phone_m != null ? $profile_info->phone_m : $phone_m; } ?>" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-user"></i>Billing Information</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content"><hr>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Card First Name
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control nsm-field" name="card_fname" id="card_fname" value="<?= isset($billing_info) && !empty($billing_info->card_fname) ? $billing_info->card_fname : $profile_info->first_name;  ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Card Last Name
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control nsm-field" name="card_lname" id="card_lname" value="<?= isset($billing_info) && !empty($billing_info->card_lname) ? $billing_info->card_lname : $profile_info->last_name ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        <label for="use_customer_address"><span>Use Customer Address</span>
                                                    </label></div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" name="use_customer_address" class="form-check-input" id="use_customer_address">
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Card Address 
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input data-type="billing_address" type="text" class="form-control nsm-field" name="card_address" id="card_address" value="<?php if(isset($billing_info)){ echo $billing_info->card_address; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        City
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input data-type="billing_address_city" type="text" class="form-control nsm-field" name="billing_city" id="billing_city" value="<?php if(isset($billing_info)){ echo $billing_info->city != null ? $billing_info->city : $profile_info->city; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        State
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input data-type="billing_address_state" type="text" class="form-control nsm-field" name="billing_state" id="billing_state" value="<?php if(isset($billing_info)){ echo $billing_info->state != null ? $billing_info->state : $profile_info->state; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        ZIP
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input data-type="billing_address_zip" type="text" class="form-control nsm-field" name="billing_zip" id="billing_zip" value="<?php if(isset($billing_info)){ echo $billing_info->zip != null ? $billing_info->zip : $profile_info->zip_code; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Equipment
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="equipment" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Initial Dep
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="initial_dep"  >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Rate Plan
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <select data-value="<?=$billing_info->mmr?>" name="mmr" data-type="billing_rate_plan" class="form-control nsm-field">
                                                                    <option value=""><?=isset($billing_info) ? $billing_info->mmr : ""?></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <a href="<?= base_url() ?>customer/settings/ratePlan" target="_blank"  style="color:#58bc4f;margin-top:5px;font-size: 12px;position: absolute;">
                                                                    <span class="fa fa-plus"></span> Manage Rate Plan </a>&nbsp;&nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Billing Frequency
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select data-type="billing_frequency" id="bill_freq" name="bill_freq" data-customer-source="dropdown" class="input_select nsm-field searchable-dropdown">
                                                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == ""){echo "selected";} } ?> value="" disabled selected>- Select -</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "One Time Only"){echo "selected";} } ?> value="One Time Only">One Time Only</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 1 Month"){echo "selected";} } ?> value="Every 1 Month">Every 1 Month</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 3 Months"){echo "selected";} } ?> value="Every 3 Months">Every 3 Months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 6 Months"){echo "selected";} } ?> value="Every 6 Months">Every 6 Months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 1 Year"){echo "selected";} } ?> value="Every 1 Year">Every 1 Year</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Contract Term
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select data-type="billing_contract_term" id="contract_term" name="contract_term" data-customer-source="dropdown" class="input_select nsm-field searchable-dropdown" >
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 0){echo "selected";} } ?> value="0"></option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 1){echo "selected";} } ?> value="1">1 month</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 6){echo "selected";} } ?> value="6">6 months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 12){echo "selected";} } ?> value="12">12 months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 18){echo "selected";} } ?> value="18">18 months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 24){echo "selected";} } ?> value="24">24 months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 36){echo "selected";} } ?> value="36">36 months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 42){echo "selected";} } ?> value="42">42 months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 48){echo "selected";} } ?> value="48">48 months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 60){echo "selected";} } ?> value="60">60 months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 72){echo "selected";} } ?> value="72">72 months</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Billing Start Date
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="nsm-field-group calendar">
                                                            <input data-type="billing_start_date" type="text" class="form-control nsm-field date" name="bill_start_date" id="bill_start_date" value="<?php if(isset($billing_info)){ echo $billing_info->bill_start_date != null ? $billing_info->bill_start_date : $office_info->install_date; } ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Billing End Date
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="nsm-field-group calendar">
                                                            <input data-type="billing_end_date" type="text" class="form-control nsm-field date" name="bill_end_date" id="bill_end_date" value="<?php if(isset($billing_info)){ echo $billing_info->bill_end_date != null ? $billing_info->bill_end_date : date("m/d/Y", strtotime("$office_info->install_date +$billing_info->contract_term months"));; } ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Billing Day of Month
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select data-type="billing_month_day" id="bill_day" name="bill_day" data-customer-source="dropdown" class="input_select nsm-field searchable-dropdown">
                                                            <option selected value="0">Select Day</option>
                                                            <?php
                                                            if($billing_info->bill_day == null){
                                                                if($billing_info->billing_start_date == null){
                                                                    $insdate = strtotime($office_info->install_date);
                                                                    $day = date("d", $insdate);
                                                                }else{
                                                                    $insdate = strtotime($billing_info->billing_start_date);
                                                                    $day = date("d", $insdate);
                                                                }
                                                            }else{
                                                                $day = $billing_info->bill_day;
                                                            }
                                                            for ($days=0;$days<32;$days++){
                                                                ?>
                                                                    <option <?php if(isset($billing_info)){ if($day == days_of_month($days)){ echo 'selected'; } } ?> value="<?= days_of_month($days); ?>"><?= days_of_month($days) < 1 ? '' : days_of_month($days) ; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-credit-card"></i>Payment Details</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content">
                                                <hr>     
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Billing Method
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="bill_method" name="bill_method" data-customer-source="dropdown" class="input_select nsm-field searchable-dropdown">
                                                            <option  value="" disabled selected>Select Billing Method</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'CC' ?  'selected' : '';?> value="CC">Credit Card</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'DC' ?  'selected' : '';?> value="DC">Debit Card</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'CHECK' ?  'selected' : '';?> value="CHECK">Check</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'CASH' ?  'selected' : '';?> value="CASH">Cash</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'ACH' ?  'selected' : '';?> value="ACH">ACH</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'VENMO' ?  'selected' : '';?> value="VENMO">Venmo</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'PP' ?  'selected' : '';?> value="PP">Paypal</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'SQ' ?  'selected' : '';?> value="SQ">Square</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'WW' ?  'selected' : '';?> value="WW">Warranty Work</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'HOF' ?  'selected' : '';?> value="HOF">Home Owner Financing</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'eT' ?  'selected' : '';?> value="eT">e-Transfer</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'Invoicing' ?  'selected' : '';?> value="Invoicing">Invoicing</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'OCCP' ?  'selected' : '';?> value="OCCP">Other Credit Card Processor</option>
                                                            <option <?= isset($billing_info) && $billing_info->bill_method == 'OPT' ?  'selected' : '';?> value="OPT">Other Payment Type</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form_line invoicing_field">
                                                    <div class="col-md-6">
                                                        Term
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="invoice_term" name="invoice_term" data-customer-source="dropdown" class="input_select nsm-field" >
                                                            <option  value="Due On Receipt">Due On Receipt</option>
                                                            <option  value="Net 5">Net 5</option>
                                                            <option  value="Net 10">Net 10</option>
                                                            <option  value="Net 15">Net 15</option>
                                                            <option  value="Net 30">Net 30</option>
                                                            <option  value="Net 60">Net 60</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form_line invoicing_field">
                                                    <div class="col-md-6">
                                                        Invoice Date
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control nsm-field" name="invoice_date" id="invoice_date" />
                                                    </div>
                                                </div>

                                                <div class="row form_line invoicing_field">
                                                    <div class="col-md-6">
                                                    Due Date
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control nsm-field" name="invoice_due_date" id="invoice_due_date" />
                                                    </div>
                                                </div>

                                                <div class="row form_line" id="checkNumber">
                                                    <div class="col-md-6">
                                                        Check Number
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control nsm-field" name="check_num" id="check_num" value="<?php if(isset($billing_info)){ echo $billing_info->check_num; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line" id="routingNumber">
                                                    <div class="col-md-6">
                                                        Routing Number
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control nsm-field" name="routing_num" id="routing_num" value="<?php if(isset($billing_info)){ echo $billing_info->routing_num; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line" id="accountNumber">
                                                    <div class="col-md-6">
                                                        Account Number
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control nsm-field" name="acct_num" id="acct_num" value="<?php if(isset($billing_info)){ echo $billing_info->acct_num; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line" id="CCN">
                                                    <div class="col-md-6">
                                                        Credit Card Number
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" placeholder="0000 0000 0000 0000" class="form-control nsm-field" name="credit_card_num" id="credit_card_num" value="<?= isset($billing_info) &&  $billing_info->credit_card_num == 0 ? '' :  $billing_info->credit_card_num; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line" id="CCE">
                                                    <div class="col-md-6">
                                                        Credit Card Expiration
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" placeholder="MM/YYYY" class="form-control nsm-field" name="credit_card_exp" id="credit_card_exp" value="<?php if(isset($billing_info)){ echo $billing_info->credit_card_exp; } ?>"/>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" placeholder="CVC" class="form-control nsm-field" name="credit_card_exp_mm_yyyy" id="credit_card_exp_mm_yyyy" value="<?php if(isset($billing_info)){ echo $billing_info->credit_card_exp_mm_yyyy; } ?>"/>
                                                            </div> <small></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row form_line account_cred" >
                                                    <div class="col-md-6">
                                                        Account Credential
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control nsm-field" name="account_credential" id="account_credential" value="<?= isset($billing_info) ? $billing_info->account_credential : ''; ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line account_cred" >
                                                    <div class="col-md-6">
                                                        Account Note
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control nsm-field" name="account_note" id="account_note" value="<?= isset($billing_info) ? $billing_info->account_note : ''; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line account_cred" id="confirmationPD">
                                                    <div class="col-md-6">
                                                        Confirmation
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control nsm-field" name="confirmation" id="confirmation" value="<?= isset($billing_info) ? $billing_info->confirmation : ''; ?>"/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-credit-card"></i>Subscription Pay Plan</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content">
                                                <hr>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Finance Amount
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="finance_amount"  value="<?= isset($billing_info) ? $billing_info->finance_amount : ''; ?> ">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Recurring Start Date
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="nsm-field-group calendar">
                                                            <input data-type="subscription_start_date" type="text" class="form-control nsm-field date" name="recurring_start_date" id="recurring_start_date" value="<?= isset($billing_info) ? $billing_info->recurring_start_date : ''; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Recurring End Date
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="nsm-field-group calendar">
                                                            <input data-type="subscription_end_date" type="text" class="form-control nsm-field date" name="recurring_end_date" id="recurring_end_date" value="<?= isset($billing_info) ? $billing_info->recurring_end_date : ''; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Amount
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input data-type="subscription_amount" type="number" step="0.01" class="form-control nsm-field input_select" name="mmr" value="<?= isset($billing_info) ? $billing_info->mmr : ''; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Category
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="transaction_category" name="transaction_category" data-customer-source="dropdown" class="input_select nsm-field" >
                                                            <option  value="" disabled selected></option>
                                                            <option <?= isset($billing_info) && $billing_info->transaction_category == 'E' ?  'selected' : '';?> value="E">Equipment</option>
                                                            <option <?= isset($billing_info) && $billing_info->transaction_category == 'MMR' ?  'selected' : '';?> value="MMR">MMR</option>
                                                            <option <?= isset($billing_info) && $billing_info->transaction_category == 'RMR' ?  'selected' : '';?> value="RMR">RMR</option>
                                                            <option <?= isset($billing_info) && $billing_info->transaction_category == 'MS' ?  'selected' : '';?> value="MS">Monthly Subscription</option>
                                                            <option <?= isset($billing_info) && $billing_info->transaction_category == 'AF' ?  'selected' : '';?> value="AF">Activation Fee</option>
                                                            <option <?= isset($billing_info) && $billing_info->transaction_category == 'FM' ?  'selected' : '';?> value="FM">First Month</option>
                                                            <option <?= isset($billing_info) && $billing_info->transaction_category == 'AFM' ?  'selected' : '';?> value="AFM">Activation + First Month</option>
                                                            <option <?= isset($billing_info) && $billing_info->transaction_category == 'D' ?  'selected' : '';?> value="D">Deposit</option>
                                                            <option <?= isset($billing_info) && $billing_info->transaction_category == 'O' ?  'selected' : '';?> value="O">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Billing Frequency
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select data-type="subscription_frequency" id="frequency" name="frequency" data-customer-source="dropdown" class="input_select nsm-field" >
                                                            <option  value="" disabled selected>Select</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->frequency == ""){echo "selected";} } ?> value="" disabled selected>- Select -</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->frequency == "0"){echo "selected";} } ?> value="0">One Time Only</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->frequency == "1"){echo "selected";} } ?> value="1">Every 1 Month</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->frequency == "3"){echo "selected";} } ?> value="3">Every 3 Months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->frequency == "6"){echo "selected";} } ?> value="6">Every 6 Months</option>
                                                            <option <?php if(isset($billing_info)){ if($billing_info->frequency == "12"){echo "selected";} } ?> value="12">Every 1 Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php if(isset($billing_info)): ?>
                                                    <a href="<?= base_url('customer/subscription_new/'.$this->uri->segment(3)) ?>">
                                                        <button type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Add Subscription</button>
                                                    </a>
                                                    <a href="<?= base_url('customer/subscription/'.$this->uri->segment(3)) ?>">
                                                        <button type="button" class="btn btn-primary"><span class="fa fa-list"></span> View Subscription</button>
                                                    </a>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-user"></i>Office Use Information</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content"><hr>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Entered By
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control nsm-field" name="entered_by" id="entered_by" value="<?php if(isset($office_info) && $office_info->entered_by){ echo  $office_info->entered_by; } else { echo $logged_in_user->FName.' '. $logged_in_user->LName;} ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Time Entered
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control nsm-field timepicker" name="time_entered" id="time_entered" value="<?php if(isset($office_info)){ echo  $office_info->time_entered; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Sales Date
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="nsm-field-group calendar">
                                                            <input data-type="office_info_sales_date" type="text" class="form-control nsm-field date" name="sales_date" id="" value="<?php if(isset($office_info)){ echo  $office_info->sales_date; } ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Credit Score 
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="credit_score" name="credit_score" data-customer-source="dropdown" class="input_select nsm-field" >
                                                            <option <?= isset($office_info) && $office_info->credit_score == 'A' ?  'selected' : '';?> value="A">A</option>
                                                            <option <?= isset($office_info) && $office_info->credit_score == 'B' ?  'selected' : '';?> value="B">B</option>
                                                            <option <?= isset($office_info) && $office_info->credit_score == 'C' ?  'selected' : '';?> value="C">C</option>
                                                            <option <?= isset($office_info) && $office_info->credit_score == 'D' ?  'selected' : '';?> value="D">D</option>
                                                            <option <?= isset($office_info) && $office_info->credit_score == 'F' ?  'selected' : '';?> value="F">F</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        <label class="alarm_label"> <span >Pay History </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="pay_history" name="pay_history" class="input_select nsm-field searchable-dropdown">
                                                            <option <?php if(isset($office_info)){ if($office_info->pay_history == 1){ echo 'selected'; } } ?> value="1">1 - Excellent</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->pay_history == 2){ echo 'selected'; } } ?> value="2">2 - Good</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->pay_history == 3){ echo 'selected'; } } ?> value="3">3 - Fair</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->pay_history == 4){ echo 'selected'; } } ?> value="4">4 - Poor</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->pay_history == 5){ echo 'selected'; } } ?> value="5">5 - Very Poor</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Sales Rep
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="fk_sales_rep_office" name="fk_sales_rep_office" data-customer-source="dropdown" class="input_select nsm-field" >
                                                            <option value="" disabled selected>Select</option>
                                                            <?php foreach ($users as $user): ?>
                                                                <option <?php if(isset($office_info)){ echo $office_info->fk_sales_rep_office ==  $user->id ? 'selected' : ''; } ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                                                                <?= $user->id ?>    
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Technician
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="technician" name="technician"  class="input_select nsm-field" data-value="<?= isset($office_info->technician) ? $office_info->technician : "" ?>">
                                                            <option value="" disabled selected>Select</option>
                                                            <?php foreach ($technicians as $user): ?>
                                                                <option value="<?= $user->id ?>"><?= $user->FName.' '.$user->LName; ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Install Date
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="nsm-field-group calendar">
                                                            <input data-type="office_info_install_date" type="text" class="form-control nsm-field date" name="install_date" id="install-date" value="<?php if(isset($office_info)){ echo  $office_info->install_date; } ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Tech Arrival Time
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group bootstrap-timepicker timepicker">
                                                            <input id="tech_arrive_time" class="form-control nsm-field timepicker" value="<?php if(isset($office_info)){ echo  $office_info->tech_arrive_time; } ?>" name="tech_arrive_time" data-provide="timepicker" data-template="modal" data-minute-step="1" data-modal-backdrop="true" type="text"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Tech Depart Time
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group bootstrap-timepicker timepicker">
                                                            <input id="tech_depart_time" class="form-control nsm-field timepicker" value="<?php if(isset($office_info)){ echo  $office_info->tech_depart_time; } ?>" name="tech_depart_time" data-provide="timepicker" data-template="modal" data-minute-step="1" data-modal-backdrop="true" type="text"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Lead Source
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="lead_source" name="lead_source" data-customer-source="dropdown" class="input_select nsm-field"> 
                                                            <option value selected hidden disabled>Select Lead Source</option>

                                                            <?php foreach ($LEAD_SOURCE_OPTION AS $LEAD_SOURCE) { if ($office_info->lead_source == $LEAD_SOURCE->ls_name) { ?>
                                                                <option selected value="<?php echo $LEAD_SOURCE->ls_name ?>"><?php echo $LEAD_SOURCE->ls_name ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $LEAD_SOURCE->ls_name ?>"><?php echo $LEAD_SOURCE->ls_name ?></option>
                                                            <?php } } ?>

                                                            <!-- <option <?php if(isset($office_info)){ if($office_info->lead_source == ""){ echo 'selected'; } } ?> value="" disabled selected>Select</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Customer Referral"){ echo 'selected'; } } ?> value="Customer Referral">Customer Referral</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Door"){ echo 'selected'; } } ?> value="Door">Door</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Door Hanger"){ echo 'selected'; } } ?> value="Door Hanger">Door Hanger</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Flyer Mail Outs"){ echo 'selected'; } } ?> value="Flyer Mail Outs">Flyer Mail Outs</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Outbound Calls"){ echo 'selected'; } } ?> value="Outbound Calls">Outbound Calls</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Phone"){ echo 'selected'; } } ?> value="Phone">Phone</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Radio Ad"){ echo 'selected'; } } ?> value="Radio Ad">Radio Ad</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Social Media"){ echo 'selected'; } } ?> value="Social Media">Social Media</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "TV Ad"){ echo 'selected'; } } ?> value="TV Ad">TV Ad</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Unknown"){ echo 'selected'; } } ?>value="Unknown">Unknown</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Website"){ echo 'selected'; } } ?> value="Website">Website</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Yard Sign"){ echo 'selected'; } } ?> value="Yard Sign">Yard Sign</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Affiliates"){ echo 'selected'; } } ?> value="Affiliates">Affiliates</option>
                                                            <?php if($company_id == 58): ?>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Lender Loan"){ echo 'selected'; } } ?> value="Lender Loan">Lender Loan</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->lead_source == "Security Client"){ echo 'selected'; } } ?> value="Security Client">Security Client</option>
                                                            <?php endif; ?> -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Verification:
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="verification" name="verification" data-customer-source="dropdown" class="input_select nsm-field" >
                                                            <option <?php if(isset($office_info)){ if($office_info->verification == "TrunsUnion"){ echo 'selected'; } } ?> value="TransUnion">TransUnion</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->verification == "Experian"){ echo 'selected'; } } ?>  value="Experian">Experian </option>
                                                            <option <?php if(isset($office_info)){ if($office_info->verification == "Equifax"){ echo 'selected'; } } ?>  value="Equifax">Equifax  </option>
                                                            <option <?php if(isset($office_info)){ if($office_info->verification == "Others"){ echo 'selected'; } } ?>  value="Others">Others  </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="office_info-optional">
                                                    <div class="row form_line">
                                                        <div class="col-md-6">
                                                            Cancel Date
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="nsm-field-group calendar">
                                                                <input data-type="office_info_cancel_date" type="text" class="form-control nsm-field date" name="cancel_date" id="" value="<?php if(isset($office_info)){ echo  $office_info->cancel_date; } ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-6">
                                                            Cancel Reason
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select id="cancel_reason" name="cancel_reason" data-customer-source="dropdown" class="input_select nsm-field" >
                                                                <option <?php if(isset($office_info)){ if($office_info->cancel_reason == ""){ echo 'selected'; } } ?> value="" disabled selected>Select</option>
                                                                <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'DS'){ echo 'selected'; } } ?> value="DS">Dissatisfied with Service</option>
                                                                <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'FH'){ echo 'selected'; } } ?> value="FH">Financial Hardship</option>
                                                                <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'FC'){ echo 'selected'; } } ?> value="FC">Fulfilled Contract</option>
                                                                <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'Moving'){ echo 'selected'; } } ?> value="Moving">Moving</option>
                                                                <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'NP'){ echo 'selected'; } } ?> value="NP">Non-Payment</option>
                                                                <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'Paid BOC'){ echo 'selected'; } } ?> value="Paid BOC">Paid BOC</option>
                                                                <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'PA'){ echo 'selected'; } } ?> value="PA">Passed Away</option>
                                                                <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'SUC'){ echo 'selected'; } } ?> value="SUC">Still Under Contruct</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form_line">
                                                        <div class="col-md-6">
                                                            <label>Collections
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select id="collections" name="collections" data-customer-source="dropdown" class="form-control nsm-field input_select">
                                                                <option value="" disabled selected>&nbsp;</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->collections == 'In Process' ?  'selected' : '';?> value="In Process">In Process</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->collections == 'Sent' ?  'selected' : '';?> value="Sent">Sent</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->collections == 'None Collectable' ?  'selected' : '';?> value="None Collectable">None Collectable</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->collections == 'In Collections' ?  'selected' : '';?> value="In Collections">In Collection</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->collections == 'Civil Suit' ?  'selected' : '';?> value="Civil Suit">Civil Suit</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->collections == 'Taken Action' ?  'selected' : '';?> value="Taken Action">Taken Action</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form_line">
                                                        <div class="col-md-6">
                                                            Collection Date
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="nsm-field-group calendar">
                                                                <input data-type="office_info_collection_date" type="text" class="form-control nsm-field date" name="collect_date" id="" value="<?php if(isset($office_info)){ echo $office_info->collect_date; } ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-6">
                                                            Collection Amount
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                                </div>
                                                                <input type="number" class="form-control nsm-field input_select" name="collect_amount" value="<?php if(isset($office_info)){ echo $office_info->collect_amount; } ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--<div class="row">
                                                    <div class="col-md-6">
                                                        Rep Tiered Upfront Bonus
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>$0.00
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Rep Tiered Holdfund Bonus
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>$0.00
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Rep Deductions Total
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>$0.00
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Tech Deductions Total
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>$0.00
                                                    </div>
                                                </div>-->

                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Language
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="language" name="language" data-customer-source="dropdown" class="input_select nsm-field">
                                                            <option <?php if(isset($office_info)){ if($office_info->language == "English"){ echo 'selected'; } } ?> value="English">English</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->language == "Spanish"){ echo 'selected'; } } ?> value="Spanish">Spanish</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->language == "Mandarin Chinese"){ echo 'selected'; } } ?> value="Mandarin Chinese">Mandarin Chinese</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->language == "French"){ echo 'selected'; } } ?> value="French">French</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        System Package Type
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select data-value="<?= isset($alarm_info) ? $alarm_info->system_type : "" ?>" name="system_type" data-type="alarm_info_system_type" class="form-control nsm-field" >
                                                            <option><?= isset($alarm_info) ? $alarm_info->system_type : "" ?></option>
                                                        </select>
                                                        <a href="<?= base_url() ?>customer/settings_system_package" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage System Type</a>&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-user"></i>Funding Information</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content"><hr>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Pre-Install Survey" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select id="pre_install_survey" name="pre_install_survey" data-customer-source="dropdown" class="input_select nsm-field" >
                                                            <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == ""){ echo 'selected'; } } ?> value="" disabled selected></option>
                                                            <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Pass"){ echo 'selected'; } } ?> value="Pass">Pass</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Fail"){ echo 'selected'; } } ?>value="Fail">Fail</option>
                                                            <option  <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Pending"){ echo 'selected'; } } ?> value="Pending">Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Post-Install Survey" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select id="post_install_survey" name="post_install_survey" data-customer-source="dropdown" class="input_select nsm-field" >
                                                            <option <?php if(isset($office_info)){ if($office_info->post_install_survey == ""){ echo 'selected'; } } ?> value="" disabled selected>Select</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Pass"){ echo 'selected'; } } ?> value="Pass">Pass</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Fail"){ echo 'selected'; } } ?> value="Fail">Fail</option>
                                                            <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Pending"){ echo 'selected'; } } ?> value="Pending">Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Monitoring Waived" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select id="monitoring_waived" name="monitoring_waived" data-customer-source="dropdown" class="input_select nsm-field" >
                                                            <option  value="" disabled selected></option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 1 ?  'selected' : '';?> value="1">1 month</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 2 ?  'selected' : '';?> value="2">2 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 3 ?  'selected' : '';?> value="3">3 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 4 ?  'selected' : '';?> value="4">4 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 5 ?  'selected' : '';?> value="5">5 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 6 ?  'selected' : '';?> value="6">6 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 7 ?  'selected' : '';?> value="7">7 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 8 ?  'selected' : '';?> value="8">8 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 9 ?  'selected' : '';?> value="8">9 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 10 ?  'selected' : '';?> value="10">10 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 11 ?  'selected' : '';?> value="11">11 months</option>
                                                            <option <?= isset($office_info) && $office_info->monitoring_waived == 12 ?  'selected' : '';?> value="12">12 months</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <label for="rebate_offer">
                                                            <field-custom-name default="Rebate Offered" form="funding_info"></field-custom-name>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="checkbox" name="rebate_offer" class="form-controls" value="1"  id="rebate_offer" <?php if(isset($office_info)){ echo $office_info->rebate_offer == 1 ? 'checked': ''; } ?> >
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rebate Check # 1" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="number" class="form-control nsm-field" name="rebate_check1" id="rebate_check1" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check1; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rebate Check # 1 Amount $" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="number" step="0.01" class="form-control nsm-field" name="rebate_check1_amt" id="rebate_check1_amt" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check1_amt; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rebate Check # 2" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="number" class="form-control nsm-field" name="rebate_check2" id="rebate_check2" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check2; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rebate Check # 2 Amount $" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="number" step="0.01" class="form-control nsm-field" name="rebate_check2_amt" id="rebate_check2_amt" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check2_amt; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Activation Fee" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select data-value="<?= isset($office_info) ? $office_info->activation_fee : "" ?>" name="activation_fee" data-type="funding_info_activation_fee" class="form-control nsm-field">
                                                            <option><?= isset($office_info) ? $office_info->activation_fee : "" ?></option>
                                                        </select>
                                                        <a href="<?= base_url() ?>customer/settings/activationFee" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Fee</a>&nbsp;&nbsp;
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="radio" class="form-controls" name="way_of_pay" value="None" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'None' || $office_info->way_of_pay == '' || $office_info->way_of_pay == 'Email' ? 'checked': ''; }else {echo 'checked'; } ?>  id="way_of_pay_none">
                                                        <span>None</span>

                                                        <input type="radio" class="form-controls" name="way_of_pay" value="Check" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Check'? 'checked': ''; } ?>  id="way_of_pay_check">
                                                        <span>Check</span>

                                                        <input type="radio" class="form-controls" name="way_of_pay" value="Credit" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Credit'? 'checked': ''; } ?>  id="way_of_pay_credit">
                                                        <span>Credit</span>

                                                        <input type="radio" class="form-controls" name="way_of_pay" value="Paid" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Paid'? 'checked': ''; } ?> id="way_of_pay_paid">
                                                        <span>Paid</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Commision Scheme Override" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                                                        <span >On</span> &nbsp;&nbsp;
                                                        <input type="radio" name="commision_scheme[]" class="form-controls" value="0" id="commision_scheme" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 0 ? 'checked': ''; } ?>>
                                                        <span>Off</span>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rep Commission" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" id="rep_comm" name="rep_comm" value="<?php if(isset($office_info)){ echo $office_info->rep_comm; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rep Upfront Pay" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="rep_upfront_pay" value="<?php if(isset($office_info)){ echo $office_info->rep_upfront_pay; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rep Tiered Upront Bonus" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="rep_tiered_bonus" value="<?php if(isset($office_info)){ echo $office_info->rep_tiered_bonus; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rep Tiered Holdfund Bonus" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="rep_holdfund_bonus" value="<?php if(isset($office_info)){ echo $office_info->rep_holdfund_bonus; } ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rep Deduction Total" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="rep_deduction" value="<?php if(isset($office_info)){ echo $office_info->rep_deduction; } ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Tech Commission" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" id="tech_comm" name="tech_comm" value="<?php if(isset($office_info)){ echo $office_info->tech_comm; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <label for="tech_upfront_pay">
                                                            <field-custom-name default="Tech Upfront Pay" form="funding_info"></field-custom-name>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="tech_upfront_pay" value="<?php if(isset($office_info)){ echo $office_info->tech_upfront_pay; } ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Tech Deduction Total" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="tech_deduction" value="<?php if(isset($office_info)){ echo $office_info->tech_deduction; } ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rep Hold Fund Charge Back" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="rep_charge_back" value="<?php if(isset($office_info)){ echo $office_info->rep_charge_back; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Rep Payroll Charge Back" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="rep_payroll_charge_back" value="<?php if(isset($office_info)){ echo $office_info->rep_payroll_charge_back; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Points Scheme Override" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="radio" name="pso[]" class="form-controls" value="1" id="pso1" <?php if(isset($office_info)){ echo $office_info->pso == 1 ? 'checked': ''; } ?> >
                                                        <span>On</span>
                                                        &nbsp;&nbsp;
                                                        <input type="radio" name="pso[]" class="form-controls" value="0" id="pso" <?php if(isset($office_info)){ echo $office_info->pso == 0 ? 'checked': ''; } ?> >
                                                        <span>Off</span>
                                                        </div>
                                                </div>

                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Points Included" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="number" step="0.01" class="form-control nsm-field" name="points_include" id="points_include" value="<?php if(isset($office_info)){ echo $office_info->points_include !=0 ? $office_info->points_include : '';  } ?>"  />
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Price Per Point" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="price_per_point" value="<?php if(isset($office_info)){ echo $office_info->price_per_point; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Purchase Price" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="purchase_price" value="<?php if(isset($office_info)){ echo $office_info->purchase_price; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Purchase Multiple" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select id="purchase_multiple" name="purchase_multiple" data-customer-source="dropdown" class="input_select nsm-field">
                                                            <option <?php if(isset($office_info)){ if($office_info->purchase_multiple == ""){ echo 'selected'; } } ?> value="" disabled selected>Select</option>
                                                            <?php
                                                            for($pm=12;$pm<76;$pm++){
                                                                ?>
                                                                    <option <?php if(isset($office_info)){ if($office_info->purchase_multiple == $pm.'x'){ echo 'selected'; } } ?> value="<?= $pm.'x'; ?>"><?= $pm.'x'; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Purchase Discount" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="purchase_discount" value="<?php if(isset($office_info)){ echo $office_info->purchase_discount; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Equipment Cost" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="equipment_cost" value="<?php if(isset($office_info)){ echo $office_info->equipment_cost; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Labor Cost" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" id="labor_cost" name="labor_cost" value="<?php if(isset($office_info)){ echo $office_info->labor_cost; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-7">
                                                        <field-custom-name default="Job Profit" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="number" step="0.01" class="form-control nsm-field input_select" name="job_profit" value="<?php if(isset($office_info)){ echo $office_info->job_profit; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line field-custom-name-container">
                                                    <div class="col-md-12">
                                                        <field-custom-name default="Customer Shareable Link" form="funding_info"></field-custom-name>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="url" placeholder="https://sample.com" class="form-control nsm-field" name="url" id="url" value="<?php if(isset($office_info)){ echo  $office_info->url; } ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                            .badge-primary{
                                background-color: #007bff;
                            }
                            .badge{
                                display: inline-block;
                                padding: 0.25em 0.4em;
                                font-size: 75%;
                                font-weight: 700;
                                line-height: 1;
                                text-align: center;
                                white-space: nowrap;
                                vertical-align: baseline;
                                border-radius: 0.25rem;
                                margin-top: 9px;
                            }
                            </style>
                            <div class="col-12 col-md-4">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <?php if($company_id == 58): ?>
                                                <div class="nsm-card-header">
                                                    <div class="nsm-card-title">
                                                        <span><i class="bx bx-fw bx-user"></i>Solar Information</span>
                                                        <?php if( $profile_info->adt_sales_project_id > 0 ){ ?>
                                                            <span class="badge badge-primary" style="font-size:13px; float: right;">ADT Sales Portal Project Data</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="nsm-card-content">
                                                    <hr>            
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Project ID" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="project_id" id="project_id"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Lender Type" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php $lenderTypes = json_decode($solar_info_settings[0]->field_value); ?>
                                                            <select name="lender_type" id="lender_type" class="input_select nsm-field solar_infos">
                                                                <option  value="" disabled selected></option>
                                                                <?php foreach ($lenderTypes  as $lender): ?>
                                                                    <option  value="<?= $lender->name ?>"><?= $lender->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select><br>
                                                            <a href="<?= base_url('customer/settings_solar_lender_type') ?>"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Type</a>&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Proposed System Size" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <?php $proposed_system_sizes = json_decode($solar_info_settings[1]->field_value); ?>
                                                            <select name="proposed_system_size" id="proposed_system_size" class="input_select nsm-field solar_infos">
                                                                <option  value="" disabled selected></option>
                                                                <?php foreach ($proposed_system_sizes  as $size): ?>
                                                                    <option  value="<?= $size->name ?>"><?= $size->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select><br>
                                                            <a href="<?= base_url('customer/settings_solar_system_size') ?>" style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Size</a>&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Proposed Modules" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php $proposed_modules = json_decode($solar_info_settings[2]->field_value); ?>
                                                            <select name="proposed_modules" id="proposed_modules" class="input_select nsm-field solar_infos">
                                                                <option  value="" disabled selected></option>
                                                                <?php foreach ($proposed_modules  as $module): ?>
                                                                    <option  value="<?= $module->name ?>"><?= $module->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select><br>
                                                            <a href="<?= base_url('customer/settings_solar_modules') ?>" style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Modules</a>&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Proposed Inverter" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php $proposed_inverters = json_decode($solar_info_settings[3]->field_value); ?>
                                                            <select name="proposed_inverter" id="proposed_inverter" class="input_select nsm-field solar_infos">
                                                                <option  value="" disabled selected></option>
                                                                <?php foreach ($proposed_inverters  as $inverter): ?>
                                                                    <option  value="<?= $inverter->name ?>"><?= $inverter->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select><br>
                                                            <a href="<?= base_url('customer/settings_solar_inverter') ?>"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Inverter</a>&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Proposed Offset" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="proposed_offset" id="proposed_offset" class="input_select nsm-field">
                                                                <option  value="" disabled selected></option>
                                                                <option  value="1">Less than 30%</option>
                                                                <?php for($x=31;$x<=120;$x++): ?>
                                                                    <option  value="<?= $x ?>"><?= $x ?>%</option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Proposed Solar $" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                                </div>
                                                                <input type="number" class="form-control nsm-field input_select" name="proposed_solar" value="" disabled selected>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Proposed Utility $" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                                </div>
                                                                <input type="number" class="form-control nsm-field input_select" name="proposed_utility" value="" disabled selected>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Proposed Payment" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                                </div>
                                                                <input type="number" class="form-control nsm-field input_select" name="proposed_payment" value="" disabled selected>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Annual Income" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                                </div>
                                                                <input type="number" class="form-control nsm-field input_select" name="annual_income" value="" disabled selected>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Tree Estimate" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                                </div>
                                                                <input type="number" class="form-control nsm-field input_select" name="tree_estimate" value="" disabled selected>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Roof Estimate" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                                </div>
                                                                <input type="number" class="form-control nsm-field input_select" name="roof_estimate" value="" disabled selected>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Utility Account #" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="utility_account" id="utility_account"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Utility Login #" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="utility_login" id="utility_login"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Utility Password" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="utility_pass" id="utility_pass"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Meter Number" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="meter_number" id="meter_number"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Insurance Name" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="insurance_name" id="insurance_name"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Insurance Number" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="insurance_number" id="insurance_number"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Policy Number" form="solar_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="policy_number" id="policy_number"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="nsm-card-header">
                                                    <div class="nsm-card-title">
                                                        <span><i class="bx bx-fw bx-user"></i>Alarm Information</span>
                                                    </div>
                                                </div>
                                                <div class="nsm-card-content">
                                                    <hr>    
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Monitoring Company" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select id="monitor_comp" name="monitor_comp" data-customer-source="dropdown" class="input_select nsm-field" >
                                                                <option value="" disabled selected>&nbsp;</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'ADT' ?  'selected' : '';?> value="ABT">ADT</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'CMS' ?  'selected' : '';?> value="CMS">CMS</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'COPS' ?  'selected' : '';?> value="COPS">COPS</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'FrontPoint' ?  'selected' : '';?> value="FrontPoint">FrontPoint</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'ProtectionOne' ?  'selected' : '';?> value="ProtectionOne">ProtectionOne</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Stanley' ?  'selected' : '';?> value="Stanley">Stanley</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Guardian' ?  'selected' : '';?> value="Guardian">Guardian</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Vector' ?  'selected' : '';?> value="Vector">Vector</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Central' ?  'selected' : '';?> value="Central">Central</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Brinks' ?  'selected' : '';?> value="Brinks">Brinks</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Equipment Funding' ?  'selected' : '';?> value="Equipment Funding">Equipment Funding</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Other' ?  'selected' : '';?> value="Other">Other</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Monitoring ID" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="monitor_id" id="monitor_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->monitor_id != '0' ? $alarm_info->monitor_id : '' ; } ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Account Type" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="acct_type" id="acct_type" class="input_select nsm-field">
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == ''){echo "selected";} } ?> value="" disabled selected></option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'In-House'){echo "selected";} } ?> value="In-House">In-House</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Purchase'){echo "selected";} } ?> value="Purchase">Purchase</option>
                                                            </select>
                                                            <a href="<?= base_url() ?>customer/settings" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Type</a>&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <label>
                                                                <field-custom-name default="Online" form="alarm_info"></field-custom-name>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select id="online" name="online" data-customer-source="dropdown" class="form-control nsm-field input_select">
                                                                <option <?= isset($alarm_info) && $alarm_info->online == 'Yes' ?  'selected' : '';?> value="Yes">Yes</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->online == 'No' ?  'selected' : '';?> value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <label>
                                                                <field-custom-name default="In Service" form="alarm_info"></field-custom-name>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select id="in_service" name="in_service" data-customer-source="dropdown" class="form-control nsm-field input_select">
                                                                <option <?= isset($alarm_info) && $alarm_info->in_service == 'Yes' ?  'selected' : '';?> value="Yes">Yes</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->in_service == 'No' ?  'selected' : '';?> value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <label>
                                                                <field-custom-name default="Equipment" form="alarm_info"></field-custom-name>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select id="equipment" name="equipment" data-customer-source="dropdown" class="form-control nsm-field input_select">
                                                                <option value="" disabled selected>&nbsp;</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->equipment == 'Not Installed' ?  'selected' : '';?> value="Not Installed">Not Installed</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->equipment == 'Installed' ?  'selected' : '';?> value="Installed">Installed</option>
                                                                <option <?= isset($alarm_info) && $alarm_info->equipment == 'System Pulled' ?  'selected' : '';?> value="System Pulled">System Pulled</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Abort Code" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="passcode" id="passcode" value="<?php if(isset($alarm_info)){ echo $alarm_info->passcode; } ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Installer Code" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="install_code" id="install_code" value="<?php if(isset($alarm_info)){ echo $alarm_info->install_code!=0 ?  $alarm_info->install_code : ''; } ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Monitoring Confirm#" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="mcn" id="mcn" value="<?php if(isset($alarm_info)){ echo $alarm_info->mcn !=0 ? $alarm_info->mcn : ''; } ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Signal Confirm#" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="scn" id="scn" value="<?php if(isset($alarm_info)){ echo $alarm_info->scn !=0 ? $alarm_info->scn : ''; } ?>"/>
                                                        </div>
                                                    </div>

                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Panel Type" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="panel_type" id="panel_type" class="input_select nsm-field" data-value="<?= isset($alarm_info) ? $alarm_info->panel_type : "" ?>">
                                                                <?php foreach($panel_type as $panels) : ?>
                                                                    <option <?php if(isset($alarm_info)){if($alarm_info->panel_type == $panels->panel_type){echo "selected";}} ?>><?= $panels->panel_type ?></option>
                                                                <?php endforeach; ?>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == ''){echo "selected";} } ?> value="" disabled selected></option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AERIONICS'){echo "selected";} } ?> value="AERIONICS">AERIONICS</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AlarmNet'){echo "selected";} } ?> value="AlarmNet">AlarmNet</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alarm.com'){echo "selected";} } ?> value="Alarm.com">Alarm.com</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alula'){echo "selected";} } ?> value="Alula">Alula</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Bosch'){echo "selected";} } ?> value="Bosch">Bosch</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DSC'){echo "selected";} } ?> value="DSC">DSC</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'ELK'){echo "selected";} } ?> value="ELK">ELK</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'FBI'){echo "selected";} } ?> value="FBI">FBI</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GRI'){echo "selected";} } ?> value="GRI">GRI</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GE'){echo "selected";} } ?> value="GE">GE</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell">Honeywell</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell Touch'){echo "selected";} } ?> value="Honeywell Touch">Honeywell Touch</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell 3000'){echo "selected";} } ?> value="Honeywell 3000">Honeywell 3000</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista">Honeywell Vista</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell Vista with Sem'){echo "selected";} } ?> value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell Lyric'){echo "selected";} } ?> value="Honeywell Lyric">Honeywell Lyric</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'IEI'){echo "selected";} } ?> value="IEI">IEI</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'MIER'){echo "selected";} } ?> value="MIER">MIER</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG">2 GIG</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG Go Panel 2'){echo "selected";} } ?> value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG Go Panel 3'){echo "selected";} } ?> value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys IQ Panel 2'){echo "selected";} } ?> value="Qolsys IQ Panel 2">Qolsys IQ Panel 2</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys IQ Panel 2 Plus'){echo "selected";} } ?> value="Qolsys IQ Panel 2 Plus">Qolsys IQ Panel 2 Plus</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys IQ Panel 3'){echo "selected";} } ?> value="Qolsys IQ Panel 3">Qolsys IQ Panel 3</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Custom'){echo "selected";} } ?> value="Custom">Custom</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Other'){echo "selected";} } ?> value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Warranty Type" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select id="warranty_type" name="warranty_type" data-customer-source="dropdown" class="input_select nsm-field" >
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == ""){ echo 'selected'; } } ?> value="" disabled selected>Select</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Limited. 90 Days"){ echo 'selected'; } } ?> value="Limited. 90 Days">Limited 90 Days</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "1 Year"){ echo 'selected'; } } ?>  value="1 Year">1 Year</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$25 Trip"){ echo 'selected'; } } ?>  value="$25 Trip">$25 Trip</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$50 Trip and $65 Deductible"){ echo 'selected'; } } ?>  value="$50 Trip and $65 Deductible">$50 Trip and $65 Deductible</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Extended"){ echo 'selected'; } } ?>  value="Extended">Extended</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "None"){ echo 'selected'; } } ?>  value="None">None</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form_line">
                                                        <div class="col-md-6">
                                                            Communication Type
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select id='communication_type' name="comm_type"  class="form-control nsm-field" >
                                                                <option value="" disabled selected>&nbsp;</option>
                                                                <?php foreach($system_package_type as $cType): ?>
                                                                    <option <?= isset($alarm_info) && $alarm_info->comm_type == $cType->name ?  'selected' : '';  ?> value="<?= $cType->name ?>"><?= $cType->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <a href="<?= base_url() ?>customer/settings_system_package" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Type</a>&nbsp;&nbsp;
                                                        </div>
                                                    </div>

                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Account Cost" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="account_cost" id="account_cost" value="<?= $alarm_info ? ($alarm_info->account_cost !=0 ? $alarm_info->account_cost : '') : '';  ?>"/>
                                                        </div>
                                                    </div>

                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Pass Thru Cost" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="pass_thru_cost" id="pass_thru_cost" value="<?= $alarm_info ? ($alarm_info->pass_thru_cost !=0 ? $alarm_info->pass_thru_cost : '') : '';  ?>"/>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Dealer" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select id="dealer" name="dealer" data-customer-source="dropdown" class="input_select nsm-field" >
                                                                <option value="" disabled selected>&nbsp;</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->dealer == "Alarm.com"){ echo 'selected'; } } ?> value="Alarm.com">Alarm.com</option>
                                                                <option <?php if(isset($alarm_info)){ if($alarm_info->dealer == "AlarmNet"){ echo 'selected'; } } ?> value="AlarmNet">AlarmNet</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Login" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="alarm_login" id="alarm_login" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_login; } ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="Customer ID" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="alarm_customer_id" id="alarm_customer_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_customer_id; } ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line field-custom-name-container">
                                                        <div class="col-md-6">
                                                            <field-custom-name default="CS Account" form="alarm_info"></field-custom-name>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control nsm-field" name="alarm_cs_account" id="alarm_cs_account" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_cs_account; } ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-user"></i>Access Information</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content">
                                                <hr>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Portal Status (on/off)
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="radio" name="portal_status" value="1" id="portal_status1" <?php if(isset($access_info)){ echo $access_info->portal_status == 1 ? 'checked': ''; } ?> >
                                                        <span>On</span>
                                                        &nbsp;&nbsp;
                                                        <input type="radio" name="portal_status" value="0"  id="portal_status" <?php if(isset($access_info)){ echo $access_info->portal_status == 0 ? 'checked': ''; } ?>>
                                                        <span>Off</span>
                                                    </div>
                                                </div>        
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Login
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input data-type="access_info_user" type="text" class="form-control nsm-field" name="access_login" id="login" value="<?php if(isset($access_info)){ echo $access_info->access_login; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-6">
                                                        Password
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <input data-type="access_info_pass" type="text" class="form-control nsm-field" name="access_password" id="password" data-value="<?php if(isset($access_info)){ echo $access_info->access_password; } ?>"/>
                                                            <div class="input-group-append">
                                                                <button data-action="access_info_generate_pass" class="btn btn-primary" type="button" style="padding: 0;width: 35px;">
                                                                    <i class="fa fa-refresh"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if(isset($access_info)): ?>
                                                <div class="row form_line mt-2">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-primary btn-md" name="reset_password" data-id="<?= $access_info->fk_prof_id; ?>" id="btn-notify-customer-new-pw" >Send Email Reset </button>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-user"></i>Custom Field</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content" id="custom_field" data-section="custom_field"><hr>
                                                <a href="javascript:void;" id="add_field" style="color:#58bc4f;font-size: 12px;"><span class="fa fa-plus"></span> Add Field</a>
                                                <?php if(isset($profile_info)):  ?>
                                                    <?php $custom_fields = json_decode($profile_info->custom_fields); ?>
                                                    <?php if(!empty($custom_fields)): ?>
                                                    <?php foreach ($custom_fields as $field): ?>
                                                        <div class="row form_line">
                                                            <div class="col-md-5">
                                                                Name
                                                                <input type="text" class="form-control nsm-field" name="custom_name[]" value="<?= $field->name; ?>" />
                                                            </div>
                                                            <div class="col-md-5">
                                                                Value
                                                                <input type="text" class="form-control nsm-field" name="custom_value[]" value="<?= $field->value; ?>" />
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button style="margin-top: 30px;" type="button" class="btn btn-primary btn-sm items_remove_btn remove_item_row"><i class='bx bx-trash'></i></button>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <div class="row form_line">
                                                        <div class="col-md-5">
                                                            Name
                                                            <input type="text" class="form-control nsm-field" name="custom_name[]" value="" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            Value
                                                            <input type="text" class="form-control nsm-field" name="custom_value[]" value="" />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button style="margin-top: 30px;" type="button" class="btn btn-primary btn-sm items_remove_btn remove_item_row"><i class='bx bx-trash'></i></button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-user"></i>Notes</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content"><hr>
                                                <div class="row form-line">
                                                    <textarea type="text" class="form-control nsm-field" name="notes" id="notes" cols="100%" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(isset($customer_notes)) :?>
                                    <div class="col-12">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-user"></i>Existing Notes</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content">
                                                    <div class="row">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                            <?php foreach ($customer_notes as $note) : ?>
                                                                <tr>
                                                                    <td style="width: 880px; text-align: left; vertical-align: top; font-size: 11px; color: #336699">
                                                                        <?= $note->datetime; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left; border: 1px; border-style: solid; border-color: #999999; background-color: #FFFF71; font-size: 11px">
                                                                        <?= $note->note; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-12">
                                        <?php 
                                            $contact1 = null;
                                            $contact2 = null;
                                            $contact3 = null;

                                            if (isset($contacts)) {
                                                if (isset($contacts[0])) {
                                                    $contact1 = $contacts[0];
                                                }

                                                if (isset($contacts[1])) {
                                                    $contact2 = $contacts[1];
                                                }

                                                if (isset($contacts[2])) {
                                                    $contact3 = $contacts[2];
                                                }
                                            }
                                        ?>
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span><i class="bx bx-fw bx-user"></i>Emergency Contacts</span>
                                                </div>
                                            </div>
                                            <div class="nsm-card-content"><hr>
                                                <div class="row form_line">
                                                    <div class="col-md-4 ">
                                                        Contact Name 1
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field" name="contact_name1" id="contact_name1" value="<?= isset($contact1) ? $contact1->name : "" ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4 ">
                                                        Relationship
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select data-type="emergency_contact_relationship" class="form-control nsm-field" name="contact_relationship1">
                                                            <option><?= isset($contact1) ? $contact1->relation : "" ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Phone Number
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone1" id="contact_phone1" value="<?= isset($contact1) ? $contact1->phone : "" ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Contact Name 2
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field" name="contact_name2" id="contact_name2" value="<?= isset($contact2) ? $contact2->name : "" ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4 ">
                                                        Relationship
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select data-type="emergency_contact_relationship" class="form-control nsm-field" name="contact_relationship2">
                                                            <option><?= isset($contact2) ? $contact2->relation : "" ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Phone Number
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone2" id="contact_phone2" value="<?= isset($contact2) ? $contact2->phone : "" ?>"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Contact Name 3
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field" name="contact_name3" id="contact_name3" value="<?= isset($contact3) ? $contact3->name : "" ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4 ">
                                                        Relationship
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select data-type="emergency_contact_relationship" class="form-control nsm-field" name="contact_relationship2">
                                                            <option><?= isset($contact3) ? $contact3->relation : "" ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Phone Number
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control nsm-field phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone3" id="contact_phone3" value="<?= isset($contact3) ? $contact3->phone : "" ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade nsm-modal" id="customer-types-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Customer Types</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#customer-type-modal">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($customerTypes) > 0) : ?>
						<?php foreach($customerTypes as $type) : ?>
                        <tr data-id="<?=$type->id?>">
                            <td><?=$type->title?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item edit-customer-type" href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-customer-type" href="#">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="19">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="customer-type-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">New Customer Type</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="add-customer-type-form">
                    <input type="text" class="form-control nsm-field" name="customer_type_name" id="customer-type-name">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="save-customer-type">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="import-customers-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Import Customers</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process to import all your customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="progress-wrapper" style="padding-bottom: 100px;">
                            <div id="progress-bar-container">
                                <ul>
                                    <li class="step step01 pointers-none active">
                                        <div class="step-inner">Step 1</div>
                                    </li>
                                    <li class="step step02 pointers-none">
                                        <div class="step-inner">Step 2</div>
                                    </li>
                                    <li class="step step03 pointers-none">
                                        <div class="step-inner">Step 3</div>
                                    </li>
                                </ul>

                                <div id="line">
                                    <div id="line-progress"></div>
                                </div>

                                <div id="progress-content-section">
                                    <div class="section-content step1 active">
                                        <h2>Step 1</h2>
                                        <p>Industry Type Select and CSV Upload</p>

                                        <form id="import_customer" enctype="multipart/form-data" style="text-align: center;">
                                            <input id="file-upload" name="file" type="file" accept=".csv"/>
                                            <input  name="file2" value="1" type="hidden"/>
                                            <br><br>
                                            <!-- <button type="button" id="nextBtn1" class="btn btn-primary btn-sm step step02" disabled ><span class="fa fa-arrow-right"></span> Next</button> -->
                                        </form>
                                    </div>

                                    <div class="section-content step2">
                                        <h2>Step 2</h2>
                                        <p>Map Headings</p>
                                        <?php $fieldsValue = $import_settings->value ? explode(',', $import_settings->value) : array() ; ?>
                                        <?php $headers = $importFieldsList;?>
                                        <?php $i = 0; ?>
                                        <?php foreach($headers as $header) : ?>
                                            <?php if(in_array($header->id, $fieldsValue)) : ?>
                                                <div class="row grid-mb">
                                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                                        <b ><?= $header->field_description; ?></b> <span class='mapping-line'>-----------------</span>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector<?= $i ?>" onclick="test()">
                                                            <option value="">Select Heading</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php $i++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <div class="result"></div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-primary btn-sm step step01" ><span class="fa fa-arrow-left"></span> Back</button>
                                        <button type="button" class="btn btn-primary btn-sm step step03" ><span class="fa fa-arrow-right"></span> Next</button> -->
                                    </div>
                                    <div class="section-content step3">
                                        <h2>Step 3</h2>
                                        <p>Customer Preview </p>

                                        <?php $headers = $importFieldsList;?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table tbl" style="height: 100px;overflow-y: auto; overflow-x: hidden;border-collapse: collapse; ">
                                                    <thead>
                                                        <tr id='tableHeader'></tr>
                                                    </thead>
                                                    <tbody id="imported_customer"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-primary btn-sm step step02" ><span class="fa fa-arrow-left"></span> Back</button>
                                        <button type="button" class="btn btn-primary btn-sm" id="importCustomer"><span class="fa fa-upload"></span> Import</button> -->
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="button" class="nsm-button primary step02" id="nextBtn1" disabled>Next</button>
            </div>
        </div>
    </div>
</div>

<div id="overlay">
    <div>
        <img src="<?=base_url()?>/assets/img/uploading.gif" class="" style="width: 80px;" alt="" />
        <center><p>Processing...</p></center>
    </div>
</div>

<style>
    .pointers-none {
        pointer-events: none;
    }    
</style>