<?php include viewPath('v2/includes/header'); ?>
<!-- add css for this page -->
<?php include viewPath('v2/pages/job/css/job_new'); ?>
<!-- Script for autosaving form -->
<?php if(!isset($jobs_data)): ?>
    <!-- autosave only when creating -->
    <!-- disable autosave, because we want to handle form submit - send SMS to employeee -->
    <!-- <script src="<?=base_url("assets/js/jobs/autosave.js")?>"></script> -->
<?php endif; ?>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/new_job1') ?>'">
        <i class='bx bx-briefcase'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            With a few clicks, you will be on your way to storing all information about the job performed for an account. 
                            Stores incident details, resource, expenses, tasks, item audits, communications, billing and more. 
                            Try our quick import form buttons to seamlessly schedule a job.
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart(null, ['class' => 'form-validate require-validation', 'id' => 'frm-job-create', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="tax_percentage" value="<?= $default_tax_percentage; ?>" />
                <input type="hidden" id="redirect-calendar" value="<?= $redirect_calendar; ?>">
                <input type="hidden" name="estimate_id" value="<?= $import_data && $import_data['type'] == 'Estimate' ? $import_data['id'] : 0; ?>">
                <input type="hidden" name="work_order_id" value="<?= $import_data && $import_data['type'] == 'Workorder' ? $import_data['id'] : 0; ?>">
                <input type="hidden" name="invoice_id" value="<?= $import_data && $import_data['type'] == 'Invoice' ? $import_data['id'] : 0; ?>">

                <div class="row g-3 align-items-start">
                    <div class="col-12 ">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Job Configuration Status</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">                                        
                                        <div class="nsm-progressbar my-4">
                                            <div class="progressbar">
                                                <ul class="items-8">
                                                    <li class="active" id="1">
                                                <a href="">Draft</a></li>
                                                    <li class="" id="2">
                                                <a href="">Scheduled</a></li>
                                                    <li class="" id="3">
                                                        <a href="#"> Arrived </a>
                                                    </li>
                                                    <li class="" id="4">
                                                        <a href="#"> Started </a>
                                                    </li>
                                                    <li class="" id="5">
                                                        <a href="#" id="approveThisJob" data-status="<?= isset($jobs_data) ? $jobs_data->status : "" ?>" > Approved </a>
                                                    </li>
                                                    <li class="" id="6">
                                                        <a href="#">Finished</a>
                                                    <li id="7" class="">
                                                        <a href="#">Invoiced</a>
                                                    </li>
                                                    <li id="8" class="">
                                                        <a href="#">Completed</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="nsm-card primary" style="margin-top: 30px;">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title"><span><i class='bx bx-time'></i>&nbsp;Schedule Job</span></div>
                                    </div>
                                    <hr>
                                    <div class="nsm-card-content">
                                        <!-- <h6 class="page-title "><span style="font-size: 20px;"  class="fa fa-calendar"></span>&nbsp; &nbsp;Schedule Job</h6> -->
                                        <?php if(!isset($jobs_data)): ?>
                                        <div id="import_buttons">
                                            <button type="button" class="nsm-button primary btn-import" id="btn-import-estimate">
                                                <i class='bx bx-import'></i> Import Estimate
                                            </button>
                                            <button type="button" class="nsm-button primary btn-import" id="btn-import-workorder">
                                                <i class='bx bx-import'></i> Import Work Order
                                            </button>
                                            <button type="button" class="nsm-button primary btn-import" id="btn-import-invoice">
                                                <i class='bx bx-import'></i> Import Invoice
                                            </button>
                                        </div>
                                        <hr>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <div class="row g-3 align-items-center mb-3">
                                              <div class="col-sm-2">
                                                <label>From:</label>
                                              </div>
                                              <div class="col-sm-5">
                                                <?php 
                                                    if( $import_data && $import_data['start_date'] != '' ){
                                                        $default_start_date = $import_data['start_date'];
                                                    }
                                                ?>
                                                <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $default_start_date;  ?>" required>
                                              </div>
                                              <div class="col-sm-5">
                                                  <?php if( isset($jobs_data) ){ $default_start_time = strtolower($jobs_data->start_time); } ?>
                                                    <select id="start_time" name="start_time" class="nsm-field form-select" required>
                                                        <option value="">Start time</option>
                                                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                            <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                                        <?php } ?>
                                                    </select>
                                              </div>
                                            </div>
                                            <div class="row g-3 align-items-center">
                                              <div class="col-sm-2">
                                                <label>To:</label>
                                              </div>
                                              <div class="col-sm-5">
                                                <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= $default_start_date;  ?>" required>
                                              </div>
                                              <div class="col-sm-5">
                                                  <select id="end_time" name="end_time" class="nsm-field form-select " required>
                                                        <option value="">End time</option>
                                                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                            <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                                        <?php } ?>
                                                </select>
                                              </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <h6>Select Priority</h6>
                                            <?php 
                                                $selected_priority = 'Standard';
                                                if( $import_data && $import_data['priority'] != '' ){
                                                    $selected_priority = $import_data['priority'];
                                                }
                                            ?>
                                            <select id="priority" name="priority" class="form-control">
                                                <option <?= $selected_priority == 'Standard' ? 'selected="selected"' : ''; ?> value="Standard">Standard</option>
                                                <option <?= $selected_priority == 'Low' ? 'selected="selected"' : ''; ?> value="Low">Low</option>
                                                <option <?= $selected_priority == 'Emergency' ? 'selected="selected"' : ''; ?> value="Emergency">Emergency</option>
                                                <option  <?= $selected_priority == 'Urgent' ? 'selected="selected"' : ''; ?> value="Urgent">Urgent</option>
                                            </select>
                                        </div><br>
                                        <h6>Sales Representative</h6>
                                        <select id="sales-rep" name="employee_id" class="form-control"></select>
                                        <div class="color-box-custom">
                                            <h6>Job Color on Calendar</h6>
                                            <?php 
                                                $is_default_color_exists = 0;
                                                $default_color = '#2e9e39'; 
                                            ?>
                                            <ul>
                                                <?php if(isset($color_settings)): ?>
                                                    <?php foreach ($color_settings as $color): ?>
                                                        <?php 
                                                            if( strtolower($color->color_code) == $default_color){
                                                                $is_default_color_exists = 1;
                                                            }
                                                        ?>
                                                        <li>
                                                            <?php if( strtolower($color->color_code) == $default_color ){ ?>
                                                                <a style="background-color: <?= $color->color_code; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                                <i class="bx bx-check calendar_button" aria-hidden="true"></i>
                                                                </a>
                                                            <?php }else{ ?>
                                                                <a style="background-color: <?= $color->color_code; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                                </a>
                                                            <?php } ?>                                                            
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <?php if( $is_default_color_exists == 0 ){ ?>
                                                    <li>
                                                        <a data-color="<?= $default_color; ?>" style="background-color: <?= $default_color; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="default-event-color" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="Default Event Color"><i class="bx bx-check calendar_button event-color-check" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                            <input value="0" id="job_color_id" name="event_color" type="hidden" />
                                        </div>
                                        <div class="mb-3">
                                            <h6>Customer Reminder Notification</h6>
                                            <select id="customer_reminder" name="customer_reminder_notification" class="form-control ">
                                                <option value="0">None</option>
                                                <option value="PT5M">5 minutes before</option>
                                                <option value="PT15M">15 minutes before</option>
                                                <option value="PT30M">30 minutes before</option>
                                                <option value="PT1H">1 hour before</option>
                                                <option value="PT2H">2 hours before</option>
                                                <option value="PT4H">4 hours before</option>
                                                <option value="PT6H">6 hours before</option>
                                                <option value="PT8H">8 hours before</option>
                                                <option value="PT12H">12 hours before</option>
                                                <option value="PT16H">16 hours before</option>
                                                <option value="P1D" selected="selected">1 day before</option>
                                                <option value="P2D">2 days before</option>
                                                <option value="PT0M">On date of event</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <h6>Time Zone</h6>
                                            <select id="inputState" name="timezone" class="form-control ">
                                                <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                                    <option value="<?php echo $key ?>" <?= $jobs_data && $jobs_data->timezone == $key ? 'selected="selected"' : ''; ?>>
                                                        <?php echo $key ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div>
                                            <h6>Assigned To</h6>
                                            <div class="row">
                                                <div class="col-sm-12 mb-2">
                                                    <select id="assigned-tech" name="employee_ids[]" class="form-control" multiple=""></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="nsm-card primary" style="margin-top: 30px;">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">  
                                                    <span><i class='bx bx-wrench' ></i>&nbsp;Job Details</span>                                                                                      
                                                </div>
                                            </div>     
                                            <div class="nsm-card-content">      
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="d-flex justify-content-between">
                                                            <h6>Customer</h6>
                                                            <a class="nsm-link d-flex align-items-center" id="add_another_invoice" data-bs-toggle="modal" data-bs-target="#new_customer" href="javascript:void(0);">
                                                                <span class="bx bx-plus"></span>Create Customer
                                                            </a>
                                                        </div>
                                                        <select id="customer-id" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown">
                                                            <option value="">- Select Customer -</option>
                                                            <?php if( $default_customer_id > 0 ){ ?>
                                                                <option value="<?= $default_customer_id; ?>" selected><?= $default_customer_name; ?></option>
                                                            <?php }elseif( $import_data && $import_data['customer_id'] > 0 ){ ?>                                        
                                                                <option value="<?= $import_data['customer_id']; ?>" selected><?= $import_data['customer_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <div class="card mb-4 customer-info-box">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <p class="mb-0"><i class='bx bxs-store-alt' ></i> Business Name</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p class="text-muted mb-0 info-customer-business-name">---</p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <p class="mb-0"><i class='bx bx-user-pin'></i> Customer Name</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p class="text-muted mb-0 info-customer-name">---</p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <p class="mb-0"><i class='bx bxs-envelope' ></i> Email</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p class="text-muted mb-0 info-customer-email">---</p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <p class="mb-0"><i class='bx bx-phone' ></i> Phone</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p class="text-muted mb-0 info-customer-phone">---</p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <p class="mb-0"><i class='bx bx-mobile' ></i> Mobile</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p class="text-muted mb-0 info-customer-mobile">---</p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <p class="mb-0"><i class='bx bx-map-pin' ></i> Address</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p class="text-muted mb-0 info-customer-address">---</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="col-md-12 MAP_LOADER_CONTAINER">                                        
                                                            <div class="text-center MAP_LOADER">
                                                                <iframe id="TEMPORARY_MAP_VIEW" src="http://maps.google.com/maps?output=embed" height="370" width="100%" style=""></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-6">
                                                        <h6>Job Account Number</h6>
                                                        <input value="" type="text" class="form-control" name="job_account_number" required="">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex justify-content-between">
                                                            <h6>Attachment <span style="margin-left:10px;" class="bx bxs-help-circle" id="help-popover-attachment"></span></h6>     
                                                            
                                                        </div><input data-fileupload="attachment-file" class="form-control" name="attachment_file" type="file"></span>                                                        
                                                    </div>                                                                                                     
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex justify-content-between">
                                                            <h6>Job Tag</h6>
                                                            <a class="nsm-link d-flex align-items-center btn-quick-add-job-tag" href="javascript:void(0);">
                                                                <span class="bx bx-plus"></span>Create Job Tag
                                                            </a>
                                                        </div>  
                                                        <select id="job_tag" name="job_tag" class="form-control">
                                                            <?php if( $import_data && $import_data['tags'] ){ ?>
                                                                <option data-image="<?= $import_data['jobType']->marker_icon; ?>" value="<?= $import_data['tags']->id; ?>" selected><?= $import_data['tags']->name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex justify-content-between">
                                                            <h6>Job Type</h6>
                                                            <a class="nsm-link d-flex align-items-center btn-quick-add-job-type" href="javascript:void(0);">
                                                                <span class="bx bx-plus"></span>Create Job Type
                                                            </a>
                                                        </div>
                                                        <select id="job_type" name="job_type" class="form-control">
                                                            <?php if( $import_data && $import_data['jobType'] ){ ?>
                                                                <option data-image="<?= $import_data['jobType']->icon_marker; ?>" value="<?= $import_data['jobType']->title; ?>" selected><?= $import_data['jobType']->title; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>   
                                                    <div class="col-md-6 mb-3 mt-3">
                                                        <h6>Job Description</h6>
                                                        <textarea style="height:100px;" name="job_description" id="ck-job-description" class="form-control" required=""><?= $import_data && $import_data['job_description'] != '' ? $import_data['job_description'] : ''; ?></textarea>
                                                    </div>
                                                    <div class="col-md-6 mb-3 mt-3">
                                                        <h6>Notes</h6>
                                                        <textarea style="height:100px;" name="message" id="ck-notes" class="form-control customer_message_input"><?= $import_data && $import_data['notes'] != '' ? $import_data['notes'] : ''; ?></textarea>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top:40px;">
                                        <div class="nsm-card primary">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">  
                                                    <span><i class='bx bx-list-ul'></i>&nbsp;Job Items</span>                                                                                      
                                                </div>
                                            </div>     
                                            <div class="nsm-card-content">  
                                                
                                                <input type="hidden"  value="<?= $import_data && $import_data['total_product_items'] > 0 ? $import_data['total_product_items'] : 0; ?>" id="row-product-count">    
                                                <span class="invoice-item-header">
                                                    Products
                                                    <button type="button" class="nsm-button small ms-0 mb-4 btn-add-product custom-table-button"><i class='bx bx-plus' style="position:relative;top:1px;color:#000000 !important;"></i> Add</button>
                                                </span>                        
                                                <table class="nsm-table" id="product-list-table">
                                                    <thead>                                    
                                                        <tr class="row-job-items-header">                                        
                                                            <td class="ProductName" style="width:40% !important;">Name</td>
                                                            <td class="ProductQuantity" style="width:10% !important;">Quantity</td>
                                                            <td class="ProductPrice" style="width:15% !important;">Price</td>
                                                            <td class="ProductDiscount" style="width:10% !important;">Discount</td>
                                                            <td class="ProductTax" style="width:10% !important;">Tax (<?= $default_tax_percentage ?>)</td>
                                                            <td class="ProductTotal" style="width:15% !important;text-align:right;">Total</td>
                                                            <td class="ProductAction" style="width:5% !important;"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if( $import_data && !empty($import_data['product_items']) ){ ?>
                                                            <?php $row = 0; ?>
                                                            <?php foreach($import_data['product_items'] as $product){ ?>
                                                                <tr>
                                                                    <td>
                                                                        <label class='row-item-name'><?= $product['item_name']; ?></label>
                                                                        <input data-row='<?= $row; ?>' class="row-product-id" type='hidden' name='productIds[]' value='<?= $product['item_id']; ?>' />
                                                                        <input data-row='<?= $row; ?>' type='hidden' name='storageLocIds[]' value='<?= $product['storage_id']; ?>' />
                                                                    </td>
                                                                    <td>
                                                                        <input data-row='<?= $row; ?>' type='number' name='productQty[]' step='1' min='0' max='<?= $product['stock']; ?>' value='1' class='form-control row-product-qty row-product-qty-<?= $row; ?>' />
                                                                    </td>
                                                                    <td>
                                                                        <input data-row='<?= $row; ?>' type='number' name='productPrice[]' value='<?= $product['cost']; ?>' step='any' class='form-control row-product-price row-product-price-<?= $row; ?>' />
                                                                    </td>
                                                                    <td>
                                                                        <input data-row='<?= $row; ?>' type='number' name='productDiscount[]' step='any' min='0' value='<?= $product['discount']; ?>' class='form-control row-product-discount row-product-discount-<?= $row; ?>' />
                                                                    </td>
                                                                    <td>
                                                                        <input data-row='<?= $row; ?>' type='number' readonly='' name='productTax[]' value='<?= $product['tax']; ?>' class='form-control row-product-tax row-product-tax-<?= $row; ?>' />
                                                                    </td>
                                                                    <td class='row-item-total'>
                                                                        <span class='row-product-total-label-<?= $row; ?>'><?= $product['total']; ?></span>
                                                                        <input type='hidden' name='productTotal[]' value='<?= $product['total']; ?>' class='form-control row-product-total row-product-total-<?= $row; ?>' />
                                                                    </td>
                                                                    <td>
                                                                        <a data-row='<?= $row; ?>' class='remove nsm-button btn-delete-item-row'><i class='bx bx-fw bx-trash'></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>                                                            
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                                <input type="hidden"  value="<?= $import_data && $import_data['total_service_items'] > 0 ? $import_data['total_service_items'] : 0; ?>" id="row-service-count">    
                                                <span class="invoice-item-header">
                                                    Services
                                                    <button type="button" class="nsm-button small ms-0 mb-4 btn-add-services custom-table-button"><i class='bx bx-plus' style="position:relative;top:1px;color:#000000 !important;"></i> Add</button>
                                                </span>                        
                                                <table class="nsm-table" id="service-list-table">
                                                    <thead>                                    
                                                        <tr class="row-job-items-header">                                        
                                                            <td class="ServiceName" style="width:40% !important;">Name</td>     
                                                            <td class="ServiceQuantity" style="width:10% !important;">Quantity</td>                                   
                                                            <td class="ServicePrice" style="width:15% !important;">Price</td>
                                                            <td class="ServiceDiscount" style="width:10% !important;">Discount</td>
                                                            <td class="ServiceTax" style="width:10% !important;">Tax (<?= $default_tax_percentage ?>)</td>
                                                            <td class="ServiceTotal" style="width:15% !important;text-align:right;">Total</td>
                                                            <td class="ServiceAction" style="width:5% !important;"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if( $import_data && !empty($import_data['service_items']) ){ ?>
                                                            <?php $row = 0; ?>
                                                            <?php foreach($import_data['service_items'] as $service){ ?>
                                                                <tr>
                                                                    <td>
                                                                        <label class='row-item-name'><?= $service['item_name']; ?></label>
                                                                        <input data-row='<?= $row; ?>' type='hidden' class="row-service-id" name='serviceIds[]' value='<?= $service['item_id']; ?>' />
                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <input data-row='<?= $row; ?>' type='number' name='serviceQty[]' step='1' min='0' max='<?= $service['stock']; ?>' value='1' class='form-control row-service-qty row-service-qty-<?= $row; ?>' />
                                                                    </td>
                                                                    <td>
                                                                        <input data-row='<?= $row; ?>' type='number' name='servicePrice[]' value='<?= $product['cost']; ?>' step='any' class='form-control row-service-price row-service-price-<?= $row; ?>' />
                                                                    </td>
                                                                    <td>
                                                                        <input data-row='<?= $row; ?>' type='number' name='serviceDiscount[]' step='any' min='0' value='<?= $service['discount']; ?>' class='form-control row-service-discount row-service-discount-<?= $row; ?>' />
                                                                    </td>
                                                                    <td>
                                                                        <input data-row='<?= $row; ?>' type='number' readonly='' name='serviceTax[]' value='<?= $service['tax']; ?>' class='form-control row-service-tax row-service-tax-<?= $row; ?>' />
                                                                    </td>
                                                                    <td class='row-item-total'>
                                                                        <span class='row-service-total-label-<?= $row; ?>'><?= $service['total']; ?></span>
                                                                        <input type='hidden' name='serviceTotal[]' value='<?= $service['total']; ?>' class='form-control row-product-total row-product-total-<?= $row; ?>' />
                                                                    </td>
                                                                    <td>
                                                                        <a data-row='<?= $row; ?>' class='remove nsm-button btn-delete-item-row'><i class='bx bx-fw bx-trash'></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>                                                            
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                                <div class="row mt-4">
                                                    <div class="col-md-7"></div>                                                    
                                                    <div class="col-12 col-md-5">
                                                        <div class="row g-3" style="margin-top: 0px;">
                                                            <div class="col-12 col-md-6">
                                                                <label class="content-title">Subtotal</label>
                                                            </div>
                                                            <div class="col-12 col-md-6 text-end">
                                                                $ <span id="span_sub_total_invoice">0.00</span>
                                                                <input type="hidden" name="subtotal" id="item_subtotal" value="0" />
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <label class="content-title">Taxes</label>
                                                            </div>
                                                            <div class="col-12 col-md-6 text-end">
                                                                $ <span id="span_total_tax_invoice">0.00</span>
                                                                <input type="hidden" name="taxes" id="item_total_tax" value="0" />
                                                            </div>                                    
                                                            <?php //if( in_array($cid, adi_company_ids()) ){ ?>
                                                            <div class="col-12 col-md-6 d-flex align-items-center">
                                                                <label class="content-title">Installation Cost</label>
                                                            </div>
                                                            <div class="col-12 col-md-3 offset-md-3 text-end">
                                                                <div class="input-group">
                                                                    <?php 
                                                                        $default_adjustment_installation_cost = 0;
                                                                        if( $import_data && $import_data['installation_cost'] > 0 ){
                                                                            $default_adjustment_installation_cost = $import_data['installation_cost'];
                                                                        }
                                                                    ?>
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="number" step="any" value="<?= $default_adjustment_installation_cost; ?>" min=0 name="adjustment_ic" id="adjustment-ic" class="nsm-field form-control text-end" value="0">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6 d-flex align-items-center">
                                                                <label class="content-title">One time (Program and Setup)</label>
                                                            </div>
                                                            <div class="col-12 col-md-3 offset-md-3 text-end">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">$</span>
                                                                    <?php 
                                                                        $default_adjustment_otps = 0;
                                                                        if( $import_data && $import_data['otps'] > 0 ){
                                                                            $default_adjustment_otps = $import_data['otps'];
                                                                        }
                                                                    ?>
                                                                    <input type="number" step="any" value="<?= $default_adjustment_otps; ?>" min=0 name="adjustment_otps" id="adjustment-otps" class="nsm-field form-control text-end" value="0">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6 d-flex align-items-center">
                                                                <label class="content-title">Monthly Monitoring</label>
                                                            </div>
                                                            <div class="col-12 col-md-3 offset-md-3 text-end">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">$</span>
                                                                    <?php 
                                                                        $default_adjustment_monthly_monitoring = 0;
                                                                        if( $import_data && $import_data['monthly_monitoring'] > 0 ){
                                                                            $default_adjustment_monthly_monitoring = $import_data['monthly_monitoring'];
                                                                        }
                                                                    ?>
                                                                    <input type="number" value="<?= $default_adjustment_monthly_monitoring; ?>" step="any" min=0 name="monthly_monitoring" id="adjustment-mm" class="nsm-field form-control text-end" value="0">
                                                                </div>
                                                            </div>
                                                            <?php //} ?>
                                                            <div class="col-12 col-md-6 d-flex align-items-center">
                                                                <?php 
                                                                    $default_adjustment_name = '';
                                                                    if( $import_data && $import_data['adjustment_name'] ){
                                                                        $default_adjustment_name = $import_data['adjustment_name'];
                                                                    }
                                                                ?>
                                                                <input type="text" value="<?= $default_adjustment_name; ?>" class="nsm-field form-control" placeholder="Adjustment Name" name="adjustment_name" id="adjustment_name" style="border: 1px dashed #d1d1d1;">                                                        
                                                                <i id="help-popover-adjustment" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;"></i>
                                                            </div>
                                                            <div class="col-12 col-md-3 offset-md-3 text-end">
                                                                <div class="input-group">
                                                                    <?php 
                                                                        $default_adjustment_amount = 0;
                                                                        if( $import_data && $import_data['adjustment_value'] > 0 ){
                                                                            $default_adjustment_amount = $import_data['adjustment_value'];
                                                                        }
                                                                    ?>
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="number" value="<?= $default_adjustment_amount; ?>" step="any" min=0 name="adjustment_value" id="adjustment-input" class="nsm-field form-control text-end" value="0">
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 d-flex align-items-center">
                                                                <label class="content-title">Is Tax Exempted</label>
                                                            </div>
                                                            <div class="col-12 col-md-3 offset-md-3 text-end">
                                                                <div class="input-group">
                                                                    <?php 
                                                                        $default_no_tax = 0;
                                                                        if( $import_data ){
                                                                            $default_no_tax = $import_data['no_tax'];
                                                                        }
                                                                    ?>
                                                                    <select class="form-control" id="tax-exempted" name="is_tax_exempted" style="text-align:center;">
                                                                        <option <?= $default_no_tax == 1 ? 'selected="selected"' : ''; ?> value="1">Yes</option>
                                                                        <option <?= $default_no_tax == 0 ? 'selected="selected"' : ''; ?> value="0">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-12 col-md-6">
                                                                <label class="content-title">Grand Total ($)</label>
                                                            </div>
                                                            <div class="col-12 col-md-6 text-end fw-bold">
                                                                $ <span id="grand_total">0.00</span>
                                                                <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                                <input type="hidden" name="grand_total" id="grand_total_input" value='0'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mt-5">
                                        <div class="col-sm-12 text-end">
                                            <div class="form-check float-start">
                                                <input class="form-check-input" id="SEND_EMAIL_ON_SCHEDULE" type="checkbox">
                                                <label class="form-check-label" for="SEND_EMAIL_ON_SCHEDULE">
                                                Send an email after scheduling this job.
                                                </label>
                                            </div>
                                            <button type="button" class="nsm-button btn-form-cancel">Cancel</button>
                                            <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-calendar-plus'></i> Schedule</button>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<?php include viewPath('v2/pages/job/modals/new_customer'); ?>
<?php include viewPath('v2/includes/job/quick_add'); ?>
<?php include viewPath('v2/includes/inventory/quick_add_item_modals'); ?>
<?php include viewPath('v2/includes/job/import_modals'); ?>

<?php include viewPath('v2/pages/job/modals/invoice_import'); ?>
<?php include viewPath('v2/includes/footer'); ?>
<?php include viewPath('v2/pages/job/js/job_new_js_v2'); ?>
<script>
$(function(){
    var default_tax_percentage = '<?= $default_tax_percentage; ?>';
    
    <?php if( $import_data && $import_data['customer_id'] > 0 ){ ?>
        load_customer_data('<?= $import_data['customer_id']; ?>');
    <?php } ?>

    <?php if( $import_data && $import_data['id'] > 0 ){ ?>
        recomputeTotalSummary();
    <?php } ?>

    $('#modal-product-list').modal({backdrop: 'static', keyboard: false});
    $('#modal-services-list').modal({backdrop: 'static', keyboard: false});

    CKEDITOR.replace( 'ck-notes', {
        toolbarGroups: [
            { name: 'document',    groups: [ 'mode', 'document' ] },            // Displays document group with its two subgroups.
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },           // Group's name will be used to create voice label.
            '/',                                                                // Line break - next group will be placed in new line.
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'links' }
        ],
        height: '140px',
    });

    CKEDITOR.replace( 'ck-job-description', {
        toolbarGroups: [
            { name: 'document',    groups: [ 'mode', 'document' ] },            // Displays document group with its two subgroups.
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },           // Group's name will be used to create voice label.
            '/',                                                                // Line break - next group will be placed in new line.
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'links' }
        ],
        height: '140px',
    });

    $('.btn-form-cancel').on('click', function(){
        location.href = base_url + 'job';
    });

    $('#help-popover-adjustment').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
        } 
    }); 

    $('#help-popover-attachment').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Attach files to this invoice. Allowed type: pdf, doc, docx, png, jpg, gif.';
        } 
    });
    
    $('.btn-add-product').on('click', function(){
        $('#modal-product-list').modal('show');
        $('#search_product').val('');
        loadAddProductList();
    });

    $('.btn-add-services').on('click', function(){
        $('#modal-services-list').modal('show');
        $('#search_services').val('');
        loadAddServicesList();
    });

    $('#assigned-tech').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Select User',
        maximumSelectionLength: 5,
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $('#sales-rep').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Select User',
        maximumSelectionLength: 5,
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $('#customer-id').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_customer',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Select Customer',        
        minimumInputLength: 0,
        templateResult: formatRepoCustomer,
        templateSelection: formatRepoCustomerSelection
    });

    function formatRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.address + ' / ' + repo.email + '</small></div>'
        );

        return $container;
    }

    function formatRepoCustomerSelection(repo) {
        if (repo.first_name != null) {
            return repo.first_name + ' ' + repo.last_name;
        } else {
            return repo.text;
        }
    }

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }

    $("#customer-id").on('change', function () {
        var customer_selected = $(this).val();
        load_customer_data(customer_selected);
    });

    $(document).on('click', '.edit-product-stock', function(){
        var storageid   = $(this).attr('data-storageid');
        var itemid      = $(this).attr('data-itemid');
        var containerid = 'product-stock-container';

        $('#modal-product-list').modal('hide');
        $('#modal-edit-product-stock').modal('show');
        loadEditProductStock(storageid, itemid, containerid);
    });

    $('#status').on('change', function(){
        var selected = $(this).val();
        if( selected == 'Partially Paid' ){
            $('.grp-amount-paid').show();
        }else{
            $('.grp-amount-paid').hide();
        }
    });

    $('#search_product').on('input', debounce(function() {
        var query = $(this).val();
        productSearch(query);
    }, 500));
    
    $('#search_services').on('input', debounce(function() {
        var query = $(this).val();
        serviceSearch(query);
    }, 500));

    $('#search_import_workorder').on('input', debounce(function() {
        var query = $(this).val();
        searchImportWorkorderList(query);
    }, 500));

    $('#search_import_invoice').on('input', debounce(function() {
        var query = $(this).val();
        searchImportInvoiceList(query);
    }, 500));

    $('#search_import_estimate').on('input', debounce(function() {
        var query = $(this).val();
        searchImportEstimateList(query);
    }, 500));

    $('#tax-exempted').on('change', function(){
        recomputeTotalSummary();
    });

    //Import Estimate
    $('#btn-import-estimate').on('click', function(){
        $('#modal-import-estimate').modal('show');
        load_import_estimate_data();
    });

    //Import Workorder
    $('#btn-import-workorder').on('click', function(){
        $('#modal-import-workorder').modal('show');
        load_import_workorder_data();
    });

    //Import Invoice
    $('#btn-import-invoice').on('click', function(){
        $('#modal-import-invoice').modal('show');
        load_import_invoice_data();
    });

    function recomputeProductRowTotal(row_number){
        var row_product_quantity = $('.row-product-qty-'+row_number).val();
	    var row_product_price    = $('.row-product-price-'+row_number).val();
        var row_product_discount = $('.row-product-discount-'+row_number).val();
        var row_product_total    = computeItemRowTotal(row_product_quantity,row_product_price,row_product_discount);
        var row_product_tax      = computeItemTax(default_tax_percentage, row_product_total);
        var row_with_tax_total   = parseFloat(row_product_total) + parseFloat(row_product_tax);

        $('.row-product-tax-'+row_number).val(row_product_tax);
        $('.row-product-total-'+row_number).val(row_with_tax_total);
        $('.row-product-total-label-'+row_number).text(row_with_tax_total.toFixed(2));

        recomputeTotalSummary();
    }

    function recomputeTotalSummary(){
        var product_sub_total = computeProductSubTotal();
        var product_total_tax = computeProductTotalTax(default_tax_percentage);

        var service_sub_total = computeServicesSubTotal();
        var service_total_tax = computeServicesTotalTax(default_tax_percentage);

        var invoice_sub_total = parseFloat(product_sub_total) + parseFloat(service_sub_total);
        var invoice_tax_total = parseFloat(product_total_tax) + parseFloat(service_total_tax);

        $('#span_sub_total_invoice').html(invoice_sub_total.toFixed(2));
        $('#item_subtotal').val(invoice_sub_total.toFixed(2));

        $('#span_total_tax_invoice').html(invoice_tax_total.toFixed(2))
        $('#item_total_tax').val(invoice_tax_total.toFixed(2));

        var adjustmentIdSelectors = ['adjustment-ic','adjustment-otps','adjustment-mm', 'adjustment-input'];
        var total_adjustment_selectors = 0;
        adjustmentIdSelectors.forEach(selector => {
            var $element = document.getElementById(selector);
            if ($element) {
                total_adjustment_selectors = parseFloat(total_adjustment_selectors) + parseFloat($element.value);                
            }
        });

        var is_tax_exempted = $('#tax-exempted').val();
        if( is_tax_exempted == 1 ){
            var grand_total = parseFloat(invoice_sub_total) + parseFloat(total_adjustment_selectors);
        }else{
            var grand_total = parseFloat(invoice_sub_total) + parseFloat(invoice_tax_total) + parseFloat(total_adjustment_selectors);
        }

        
        $('#grand_total').html(grand_total.toFixed(2));
        $('#grand_total_input').val(grand_total.toFixed(2));
    }

    //Adjustments
    $(document).on('input', '#adjustment-ic, #adjustment-otps, #adjustment-mm, #adjustment-input', function(){
        recomputeTotalSummary();
    });

    //Products
    $(document).on('input', '.row-product-qty, .row-product-discount, .row-product-price', function(){
        var row_number = $(this).attr('data-row');
        recomputeProductRowTotal(row_number)
    });

    $(document).on('click', '.btn-delete-item-row', function(){
        var row_number = $(this).attr('data-row');
        $(this).closest('tr').fadeOut(1200,function(here){ 
            $(this).closest('tr').remove();          
        });    
        recomputeProductRowTotal(row_number);
    });

    $(document).on('click', '.add-product', function(){
        var product_name   = $(this).attr('data-productname');
        var product_id     = $(this).attr('data-itemid');
        var product_price  = $(this).attr('data-itemprice');
        var product_onhand = $(this).attr('data-onhand');
        var storage_id     = $(this).attr('data-storageid');
        var product_tax    = computeItemTax(default_tax_percentage, product_price);
        var product_total  = parseFloat(product_price) + parseFloat(product_tax);
        var is_item_exists = 0;

        $('.row-product-id').each(function(i, obj) {
            if( obj.value == product_id ){
                is_item_exists = 1;
            }
        });

        if( is_item_exists == 1 ){
            Swal.fire({                    
                text: 'Item already added',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
        }else{
            if( product_onhand <= 0 ){
                Swal.fire({
                    title: 'Error',
                    text: 'Cannot add item. Item is currently out of stock.',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });
            }else{
                var rowcount = parseInt($("#row-product-count").val()) + 1;
                $("#row-product-count").val(rowcount);

                var row_html = "<tr><td><label class='row-item-name'>"+product_name+"</label><input data-row='"+rowcount+"' class='row-product-id' type='hidden' name='productIds[]' value='"+product_id+"' /><input data-row='"+rowcount+"' type='hidden' name='storageLocIds[]' value='"+storage_id+"' /></td><td><input data-row='"+rowcount+"' type='number' name='productQty[]' step='1' min='0' max='"+product_onhand+"' value='1' class='form-control row-product-qty row-product-qty-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' name='productPrice[]' value='"+product_price+"' step='any' class='form-control row-product-price row-product-price-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' name='productDiscount[]' step='any' min='0' value='0' class='form-control row-product-discount row-product-discount-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' readonly='' name='productTax[]' value='"+product_tax+"' class='form-control row-product-tax row-product-tax-"+rowcount+"' /></td><td class='row-item-total'><span class='row-product-total-label-"+rowcount+"'>"+product_total.toFixed(2)+"</span><input type='hidden' name='productTotal[]' value='"+product_total+"' class='form-control row-product-total row-product-total-"+rowcount+"' /></td><td><a data-row='"+rowcount+"' class='remove nsm-button btn-delete-item-row'><i class='bx bx-fw bx-trash'></i></a></td></tr>";

                $("#product-list-table tbody").append(row_html);

                recomputeProductRowTotal(rowcount);
            }
        }                
    });
    //End Product

    //Services
    function recomputeServiceRowTotal(row_number){
        var row_service_quantity = $('.row-service-qty-'+row_number).val();
	    var row_service_price    = $('.row-service-price-'+row_number).val();
        var row_service_discount = $('.row-service-discount-'+row_number).val();
        var row_service_total    = computeItemRowTotal(row_service_quantity,row_service_price,row_service_discount);
        var row_service_tax      = computeItemTax(default_tax_percentage, row_service_total);
        var row_with_tax_total   = parseFloat(row_service_total) + parseFloat(row_service_tax);

        $('.row-service-tax-'+row_number).val(row_service_tax);
        $('.row-service-total-'+row_number).val(row_with_tax_total);
        $('.row-service-total-label-'+row_number).text(row_with_tax_total.toFixed(2));

        recomputeTotalSummary();
    }

    $(document).on('input', '.row-service-qty, .row-service-price, .row-service-discount', function(){
        var row_number = $(this).attr('data-row');
        recomputeServiceRowTotal(row_number)
    });

    $(document).on('click', '.add-services', function(){
        var service_name   = $(this).attr('data-servicename');
        var service_id     = $(this).attr('data-itemid');
        var service_price  = $(this).attr('data-itemprice');
        var service_onhand = $(this).attr('data-onhand');
        var service_tax    = computeItemTax(default_tax_percentage, service_price);
        var service_total  = parseFloat(service_price) + parseFloat(service_tax);
        var is_item_exists = 0;

        $('.row-service-id').each(function(i, obj) {
            if( obj.value == service_id ){
                is_item_exists = 1;
            }
        });

        if( is_item_exists == 1 ){
            Swal.fire({                    
                text: 'Item already added',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
        }else{
            var rowcount = parseInt($("#row-service-count").val()) + 1;
            $("#row-service-count").val(rowcount);

            var row_html = "<tr><td><label class='row-item-name'>"+service_name+"</label><input data-row='"+rowcount+"' type='hidden' class='row-service-id' name='serviceIds[]' value='"+service_id+"' /></td><td><input data-row='"+rowcount+"' type='number' name='serviceQty[]' step='1' min='1' max='"+service_onhand+"' value='1' class='form-control row-service-qty row-service-qty-"+rowcount+"' readonly='' /></td><td><input data-row='"+rowcount+"' type='number' name='servicePrice[]' value='"+service_price+"' step='any' class='form-control row-service-price row-service-price-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' name='serviceDiscount[]' min='0' step='any' value='0' class='form-control row-service-discount row-service-discount-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' readonly='' name='serviceTax[]' value='"+service_tax+"' class='form-control row-service-tax row-service-tax-"+rowcount+"' /></td><td class='row-item-total'><span class='row-service-total-label-"+rowcount+"'>"+service_total.toFixed(2)+"</span><input type='hidden' name='serviceTotal[]' value='"+service_total+"' class='form-control row-service-total row-service-total-"+rowcount+"' /></td><td><a data-row='"+rowcount+"' class='remove nsm-button btn-delete-item-row'><i class='bx bx-fw bx-trash'></i></a></td></tr>";

            $("#service-list-table tbody").append(row_html);

            recomputeServiceRowTotal(rowcount); 
        }         
    });
    //End Services

    $('#frm-job-create').on('submit', function(e){
        e.preventDefault();

        var formData = new FormData(this);
        var _this    = $(this);
        _this.find("button[type=submit]").html("Saving");
        //_this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: "POST",
            url: base_url + "job/_create_job",
            data: formData, // serializes the form's elements.
            dataType:'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    Swal.fire({
                        //title: 'Save Successful!',
                        text: "Jobs data has been saved successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.href = base_url + 'job';
                        //}
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }

                _this.find("button[type=submit]").html("<i class='bx bx-fw bx-calendar-plus'></i> Schedule");
                //_this.find("button[type=submit]").prop("disabled", false);
                
            }, beforeSend: function() {
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
</script>
<script src="<?=base_url("assets/js/jobs/manage_v2.js")?>"></script>