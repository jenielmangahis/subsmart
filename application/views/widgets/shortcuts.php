<style>
    .pointer{
        cursor: pointer;
        text-align: center;
    }
    
    .pointer:hover{
        opacity: 0.8;
    }
    
    .pointer p{
        line-height: 15px;
        margin-top: 7px;
        font-size: 11px;
    }
    
    #shotcutsSlide .carousel-indicators{
        border-radius: 50%;
        border-top: 1px solid grey;
        border-bottom: 1px solid grey;
        width: 7px;
        height: 7px;
        background-color: black;
    }
</style>

<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background:#fa5252; color:white;">
            <i class="fa fa-dashboard" aria-hidden="true"></i> Shorcuts
        </div>
        <div class="card-body pt-3">
            <div id="shortcutsSlide" class="carousel slide" style="<?= $height ?> overflow:scroll;" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active text-center">
                        <div class="col-lg-12 no-padding">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/').'01_print_a_check.png' ?>" />
                                <p>Print a Check</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left text-center pointer">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'02_process_payment.png' ?>" />
                                <p>Process Payment</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'04_recieve_payment.png' ?>" />
                                <p>Receive Payments</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'03_add_invoice.png' ?>" />
                                <p>Add Invoice</p>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/').'05_add_receipt.png' ?>" />
                                <p>Add Receipt</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'06_add_bill.png' ?>" />
                                <p>Add Bill</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'07_add_sales_tax.png' ?>" />
                                <p>Add Sales Tax</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'08_pay_bill.png' ?>" />
                                <p>Pay Bill</p>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/accounting/').'09_run_payroll.png' ?>" />
                                <p>Run Payroll</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'10_sync_bank.png' ?>" />
                                <p>Bank Sync</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/accounting/').'11_add_credit_notes.png' ?>" />
                                <p>Add Credit Notes</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/calendar/').'01_add_calendar_event.png' ?>" />
                                <p>Add Calendar Events</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item text-center">
                        <div class="col-lg-12 no-padding">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/calendar/').'02_add_or_assign_task.png' ?>" />
                                <p>Add/Assign a Task</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left text-center pointer">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/calendar/').'03_add_priority_list.png' ?>" />
                                <p>Add Priority List</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/calendar/').'04_assign_color_settings.png' ?>" />
                                <p>Assign Color Listing</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/company/').'01_add_employees.png' ?>" />
                                <p>Add Employees</p>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/company/').'02_change_business_profile.png' ?>" />
                                <p>Change Business Profile</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/file_vault/').'01_add_before_and_after_pictures.png' ?>" />
                                <p>Add Pictures</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/file_vault/').'02_save_to_file_vault.png' ?>" />
                                <p>Save to Vault</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/marketing/').'01_marketing_tools.png' ?>" />
                                <p>Marketing Tools</p>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/sales/').'01_add_a_job.png' ?>" />
                                <p>Add a Job</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/sales/').'02_add_job_type.png' ?>" />
                                <p>Add a Job Type</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/sales/').'03_add_a_job_tag.png' ?>" />
                                <p>Add a Job Tag</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/sales/').'04_add_estimate.png' ?>" />
                                <p>Add an Estimate</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item text-center">
                        <div class="col-lg-12 no-padding">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/sales/').'05_add_workorder.png' ?>" />
                                <p>Add Workorder</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left text-center pointer">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/sales/').'06_add_service_ticket.png' ?>" />
                                <p>Add Service Ticket</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/sales/').'07_add_lead.png' ?>" />
                                <p>Add Lead</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/sales/').'08_add_customer.png' ?>" />
                                <p>Add Customer</p>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/sales/').'09_add_customer_group.png' ?>" />
                                <p>Add Customer Group</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/sales/').'10_add_customer_source.png' ?>" />
                                <p>Add Customer Source</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/sales/').'11_add_customer_type.png' ?>" />
                                <p>Add Customer Type</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/sales/').'12_customer_dashboard.png' ?>" />
                                <p>Customer Dashboard</p>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/sales/').'13_import_customer.png' ?>" />
                                <p>Import Customer</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/support/').'01_enable_disable_settings.png' ?>" />
                                <p>Enable/Disable Settings</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/support/').'02_schedule_demo.png' ?>" />
                                <p>Schedule a Demo</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/tools/').'01_add_items_to_inventory.png' ?>" />
                                <p>Add Item</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item text-center">
                        <div class="col-lg-12 no-padding">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/tools/').'02_import_inventory_list.png' ?>" />
                                <p>Import Inventory</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left text-center pointer">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/tools/').'03_add_new_service.png' ?>" />
                                <p>Add New Service</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/tools/').'04_add_free_schedule.png' ?>" />
                                <p>Add Free Schedule</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/tools/').'05_add_item_group.png' ?>" />
                                <p>Add Item Group</p>
                            </div>
                        </div>
                        <div class="col-lg-12 no-padding float-left">
                            <div class="float-left col-lg-3 no-padding text-center pointer">
                                <img class="col-lg-12 " src="<?= assets_url('img/shortcuts/tools/').'06_add_item_location.png' ?>" />
                                <p>Add Item Location</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/upgrade/').'01_create_online_booking.png' ?>" />
                                <p>Create Booking</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/upgrade/').'02_create_a_wiz.png' ?>" />
                                <p>Create a Wiz</p>
                            </div>
                            <div class="col-lg-3 no-padding float-left pointer text-center ">
                                <img class="col-lg-12" src="<?= assets_url('img/shortcuts/upgrade/').'03_see_plugin_add_ons.png' ?>" />
                                <p>See Plugin/Addons</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            <!-- Indicators -->
            <ul class="carousel-indicators" id="indicator">
                <li data-target="#shortcutsSlide" data-slide-to="0" class="active"></li>
                <li data-target="#shortcutsSlide" data-slide-to="1"></li>
            </ul>
            </div>

        </div>

    </div>
</div>