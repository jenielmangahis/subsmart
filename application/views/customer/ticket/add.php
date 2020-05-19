<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/customer'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Add Ticket</h1>
                    </div>
                </div>
                <!-- end row -->
                <?php echo form_open_multipart('customer/tickets/save', ['class' => 'form-validate require-validation', 'id' => 'ticket_form', 'autocomplete' => 'off']); ?>
                <?php if (!empty($customer)) { ?>
                    <input type="hidden" name="customer_id" value="<?php echo $customer->id ?>">
                <?php } ?>

                <?php if (!empty($ticket_number)) { ?>
                    <input type="hidden" name="ticket_number" value="<?php echo $ticket_number ?>">
                <?php } ?>
                <div class="row custom__border">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row" style="background-color: transparent">
                                    <div class="col-md-6">
                                        <?php if (!empty($company_name)) { ?>
                                            <h2><?php echo $company_name ?></h2>
                                        <?php } ?>
                                        <p>SCHEDULE OF EQUIPMENT AND SERVICES</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Office Use Only</label>
                                        <input class="form-control"
                                               type="text"
                                               name="office_use_only[]">
                                        <input class="form-control"
                                               type="text"
                                               name="office_use_only">
                                        <input class="form-control"
                                               type="text"
                                               name="office_use_only[]">
                                    </div>
                                </div>

                                <?php if (!empty($customer)) { ?>

                                    <!-- ====== TICKET ====== -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="">Ticket#</label><br/>
                                                    <input class="form-control"
                                                           type="text"
                                                           name="ticket_number"
                                                           value="<?php echo $ticket_number ?>"
                                                           disabled>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Customer Type</label><br/>
                                                    <select name="customer[customer_type]"
                                                            class="form-control"
                                                            disabled
                                                            id="customer_type">
                                                        <?php foreach (get_config_item('customer_types') as $key => $customer_type) { ?>
                                                            <option value="<?php echo $customer_type ?>"
                                                                <?php echo (!empty($customer)
                                                                    && $customer->customer_type === $customer_type)
                                                                    ? "selected" : "" ?>>
                                                                <?php echo $customer_type ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ====== CUSTOMER ====== -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="box-title">Customer</h5>
                                                </div>
                                                <div class="row p-3">
                                                    <div class="col-md-3 form-group">
                                                        <label for="customer_name">Customer Name</label>
                                                        <input type="text" class="form-control"
                                                               id="customer_name"
                                                               value="<?php echo (!empty($customer)) ? $customer->contact_name : '' ?>"
                                                               disabled/>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <label for="contact_mobile">Phone Number</label>
                                                        <input type="text" class="form-control"
                                                               disabled
                                                               value="<?php echo (!empty($customer)) ? $customer->mobile : '' ?>"
                                                               id="contact_mobile"/>
                                                    </div>

                                                    <div class="col-md-3 form-group">
                                                        <label for="contact_dob">Acct#</label>
                                                        <input type="text" class="form-control"
                                                               disabled
                                                               value="<?php echo (!empty($customer)) ? $customer->contact_name : '' ?>"
                                                               id="customer_contact_dob"/>
                                                    </div>

                                                    <div class="col-md-3 form-group">
                                                        <label for="contact_ssn">Panel Type/DVR Type</label>
                                                        <input type="text" class="form-control"
                                                               id="contact_ssn"
                                                               disabled
                                                               value="<?php echo (!empty($customer)
                                                                   && ($customer->additional_info['panel_type'])) ? $customer->additional_info['panel_type'] : '' ?>"
                                                               placeholder="Panel Type/DVR Type"/>
                                                    </div>
                                                </div>

                                                <div class="row p-3">
                                                    <div class="col-md-3 form-group">
                                                        <label for="monitored_location">Monitored Location</label>
                                                        <input type="text"
                                                               value="<?php echo (!empty($customer)
                                                                   && ($customer->street_address)) ? $customer->street_address : '' ?>"
                                                               class="form-control"
                                                               disabled
                                                               id="monitored_location"/>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" class="form-control"
                                                               disabled
                                                               value="<?php echo (!empty($customer)
                                                                   && ($customer->city)) ? $customer->city : '' ?>"
                                                               id="city"/>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <label for="state">State</label>
                                                        <input type="text" class="form-control"
                                                               disabled
                                                               value="<?php echo (!empty($customer)
                                                                   && ($customer->state)) ? $customer->state : '' ?>"
                                                               id="state"/>

                                                    </div>

                                                    <div class="col-md-3 form-group">
                                                        <label for="zip">ZIP</label>
                                                        <input type="text" class="form-control"
                                                               id="zip"
                                                               disabled
                                                               value="<?php echo (!empty($customer)
                                                                   && ($customer->postal_code)) ? $customer->postal_code : '' ?>"/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php } else { ?>

                                    <!-- ====== TICKET ====== -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="">Ticket#</label><br/>
                                                    <input class="form-control"
                                                           type="text"
                                                           name="ticket_number"
                                                           value="<?php echo $ticket_number ?>"
                                                           disabled>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="customer_id">Customer</label><br/>
                                                    <select name="customer_id"
                                                            class="form-control"
                                                            id="customer_id">
                                                        <?php foreach (get_all_customers() as $key => $customer) { ?>
                                                            <option value="<?php echo $customer->id ?>">
                                                                <?php echo $customer->contact_name ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>

                                <!-- ====== Service Description ====== -->
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h5 class="box-title">Service Description</h5>
                                    </div>
                                </div>

                                <!-- ====== Notes to Tech ====== -->
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h5 class="box-title">Notes to Tech</h5>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="tech_info_tech">Tech</label>
                                        <select class="form-control"
                                                name="tech_info[tech]"
                                                id="tech_info_tech">
                                            <option>Select Tech</option>
                                            <?php foreach (all_users() as $user) { ?>
                                                <option value="<?php echo $user->id ?>">
                                                    <?php echo $user->name ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="tech_info_2tech">2nd Tech</label>
                                        <select class="form-control"
                                                name="tech_info[tech]"
                                                id="tech_info_2tech">
                                            <option>Select Tech 2</option>
                                            <?php foreach (all_users() as $user) { ?>
                                                <option value="<?php echo $user->id ?>">
                                                    <?php echo $user->name ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="tech_info_3tech">3rd Tech</label>
                                        <select class="form-control"
                                                name="tech_info[3tech]"
                                                id="tech_info_3tech">
                                            <option>Select Tech 3</option>
                                            <?php foreach (all_users() as $user) { ?>
                                                <option value="<?php echo $user->id ?>">
                                                    <?php echo $user->name ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12"></div>

                                    <div class="col-md-4 form-group">
                                        <label for="ticket_date">Date</label>
                                        <input type="text" class="form-control" name="ticket_date"
                                               id="ticket_date"
                                               placeholder="Enter Date"/>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="time_scheduled">Time Scheduled</label>
                                        <input type="text" class="form-control"
                                               name="time_scheduled"
                                               id="time_scheduled"
                                               placeholder="Enter Time Scheduled"/>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="arrival_time">Arrival Time</label>
                                        <input type="text" class="form-control"
                                               name="arrival_time"
                                               id="arrival_time"
                                               placeholder="Enter Arrival Time"/>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="created_by">Service Ticket Created By</label>
                                        <select class="form-control"
                                                name="created_by"
                                                id="created_by"
                                                disabled>
                                            <?php foreach (all_users() as $user) { ?>
                                                <option value="<?php echo $user->id ?>"
                                                    <?php echo ($user->id === logged('id')) ? "selected" : "" ?>>
                                                    <?php echo $user->name ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <!--                                        <input type="text" class="form-control"-->
                                        <!--                                               name="created_by"-->
                                        <!--                                               id="created_by"-->
                                        <!--                                               value="-->
                                        <?php //echo logged('name') ?><!--"-->
                                        <!--                                               disabled-->
                                        <!--                                               placeholder="Enter Service Ticket Created By"/>-->
                                    </div>
                                </div>

                                <!-- ====== WARRANTY AND SERVICES ====== -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>WARRANTY</strong><br>

                                        <?php foreach (get_config_item('ticket_warranties') as $key => $warranty) { ?>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio"
                                                       name="warranty"
                                                       value="<?php echo $warranty ?>"
                                                       id="warranty_<?php echo $key ?>">
                                                <label for="warranty_<?php echo $key ?>">
                                                    <span><?php echo $warranty ?></span>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="street_address"> <strong>Services</strong></label>
                                        <select
                                                name="plan_type"
                                                id="plan_type"
                                                class="form-control">
                                            <option>Select Service</option>
                                            <?php if (!empty(get_services())) { ?>
                                                <?php foreach (get_services() as $service) { ?>
                                                    <option value="<?= $service->id; ?>">
                                                        <?php echo $service->title ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- ====== ENHANCED SERVICES ====== -->
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h5 class="box-title">Enhanced Services</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" href="#collapse1">Cameras <i
                                                                    class="fa fa-angle-down"
                                                                    style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                    </h4>
                                                </div>
                                                <div id="collapse1" class="panel-collapse collapse">
                                                    <table class="table">
                                                        <tr>
                                                            <th></th>
                                                            <th>WO</th>
                                                            <th>WI</th>
                                                            <th>Doorbell Cam</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Honeywell</td>
                                                            <td><input type="text" class="form-control"
                                                                       name="ip_cameras[honeywell][wo]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="ip_cameras[honeywell][wi]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="ip_cameras[honeywell][doorbell_cam]"
                                                                       placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>AVYCON</td>
                                                            <td><input type="text" class="form-control"
                                                                       name="ip_cameras[avycon][wo]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="ip_cameras[avycon][wi]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="ip_cameras[avycon][doorbell_cam]"
                                                                       placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Other</td>
                                                            <td><input type="text" class="form-control"
                                                                       name="ip_cameras[other][wo]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="ip_cameras[other][wi]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="ip_cameras[other][doorbell_cam]"
                                                                       placeholder=""/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" href="#collapse2">Doorlocks: <i
                                                                    class="fa fa-angle-down"
                                                                    style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                    </h4>
                                                </div>
                                                <div id="collapse2" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <table class="table">
                                                            <tr>
                                                                <th></th>
                                                                <th>Brass</th>
                                                                <th>Nickel</th>
                                                                <th>Bronze</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Deadbolt</td>
                                                                <td><input type="text" class="form-control"
                                                                           name="doorlocks[deadbolt][brass]"
                                                                           placeholder=""/>
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                           name="doorlocks[deadbolt][nickal]"
                                                                           placeholder=""/>
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                           name="doorlocks[deadbolt][bronze]"
                                                                           placeholder=""/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Handle</td>
                                                                <td><input type="text" class="form-control"
                                                                           name="doorlocks[handle][brass]"
                                                                           placeholder=""/>
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                           name="doorlocks[handle][nickal]"
                                                                           placeholder=""/>
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                           name="doorlocks[handle][bronze]"
                                                                           placeholder=""/>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" href="#collapse3">DVR <i
                                                                    class="fa fa-angle-down"
                                                                    style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                    </h4>
                                                </div>
                                                <div id="collapse3" class="panel-collapse collapse">
                                                    <table class="table">
                                                        <tr>
                                                            <th></th>
                                                            <th>4 Channel</th>
                                                            <th>8 Channel</th>
                                                            <th>16 Channel</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Honeywell</td>
                                                            <td><input type="text" class="form-control"
                                                                       name="dvr_nvr[honeywell][4_channel]"
                                                                       placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="dvr_nvr[honeywell][8_channel]"
                                                                       placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="dvr_nvr[honeywell][16_channel]"
                                                                       placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>AVYCON</td>
                                                            <td><input type="text" class="form-control"
                                                                       name="dvr_nvr[avycon][4_channel]"
                                                                       placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="dvr_nvr[avycon][8_channel]"
                                                                       placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="dvr_nvr[avycon][16_channel]"
                                                                       placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Other</td>
                                                            <td><input type="text" class="form-control"
                                                                       name="dvr_nvr[other][4_channel]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="dvr_nvr[other][8_channel]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="dvr_nvr[other][16_channel]"
                                                                       placeholder=""/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" href="#collapse4">AUTOMATION <i
                                                                    class="fa fa-angle-down"
                                                                    style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                    </h4>
                                                </div>
                                                <div id="collapse4" class="panel-collapse collapse">
                                                    <table class="table">
                                                        <tr>
                                                            <th></th>
                                                            <th>Thermostats</th>
                                                            <th>Lights & Bulbs</th>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="automation[thermostats][]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="automation[light_bulbs][]" placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="automation[thermostats][]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="automation[light_bulbs][]" placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="automation[thermostats][]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="automation[light_bulbs][]" placeholder=""/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" href="#collapse5">PERS <i
                                                                    class="fa fa-angle-down"
                                                                    style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                    </h4>
                                                </div>
                                                <div id="collapse5" class="panel-collapse collapse">
                                                    <table class="table">
                                                        <tr>
                                                            <th></th>
                                                            <th>Fall Detection</th>
                                                            <th>W/O Fall Protection</th>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="pers[fall_detection][]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="pers[wo_fall_detection][]" placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="pers[fall_detection][]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="pers[wo_fall_detection][]" placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="pers[fall_detection][]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="pers[wo_fall_detection][]" placeholder=""/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ====== ZONE INFORMATION ====== -->
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h5 class="box-title">Zone</h5>
                                    </div>

                                    <div class="col-md-12 repeater-content-block">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <input type="hidden" name="count" value="0" id="count">
                                                <thead>
                                                <tr>
                                                    <th>Existing</th>
                                                    <th>Zn#</th>
                                                    <th>Repeat Issue</th>
                                                    <th>Location</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody class="repeater-wrap">
                                                <tr>
                                                    <td><label class="mr-4"><input type="checkbox" name="zone_info[0][existing]" value="existing" id="zone_info_existing_0"></label></td>
                                                    <td>1</td>
                                                    <td><label class="mr-4"><input type="checkbox" name="zone_info[0][repeat_issue]" value="repeat_issue" id="zone_info_repeat_issue_0"></label></td>
                                                    <td><input type="text" name="zone_info[0][repeat_issue]" class="form-control"></td>
                                                    <td><button type="button" class="btn btn-danger btn-close"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn btn-primary repeat-action">Add Items
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-5">
                                        <strong>Keypad Zones:</strong>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="checkbox" name="zone_info[duress]"
                                                   value="duress"
                                                   checked
                                                   id="zone_info_duress">
                                            <label for="zone_info_duress">
                                                <span>Duress(92)</span>
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="checkbox" name="zone_info[fire]"
                                                   value="fire"
                                                   id="zone_info_fire">
                                            <label for="zone_info_fire">
                                                <span>Fire(95)</span>
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="checkbox" name="zone_info[medical]"
                                                   value="medical"
                                                   id="zone_info_medical">
                                            <label for="zone_info_medical">
                                                <span>Medical(96)</span>
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="checkbox" name="zone_info[police]"
                                                   value="police"
                                                   id="zone_info_police">
                                            <label for="zone_info_police">
                                                <span>Police(96)</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <!-- ====== Notes/Comments ====== -->
                                <div class="row">
                                    <div class="col-md-12">
                                    <textarea class="form-control"
                                              name="notes"
                                              rows="7"
                                              placeholder="Installation Notes/Comments:
																				"></textarea>
                                    </div>
                                </div>

                                <!-- ====== Additional Equipment/Services ====== -->
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h5 class="box-title">Additional Equipment/Services</h5>
                                    </div>
                                    <div class=" col-md-12">
                                        <?php if (!empty($estimate)) { ?>

                                            <div class="row" id="plansItemDiv">

                                                <div class="col-md-12 table-responsive">
                                                    <table class="table table-hover">
                                                        <input type="hidden" name="count" value="0" id="count">
                                                        <thead>
                                                        <tr>
                                                            <th>DESCRIPTION</th>
                                                            <th>Type</th>
                                                            <th width="100px">Quantity</th>
                                                            <th>LOCATION</th>
                                                            <th width="100px">COST</th>
                                                            <th width="100px">Discount</th>
                                                            <th>Tax(%)</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="table_body">
                                                        <?php if (count($estimate_items) > 0) { ?>
                                                            <input type="hidden" name="count"
                                                                   value="<?php echo count($estimate_items) > 0 ? count($estimate_items) - 1 : 0; ?>"
                                                                   id="count">
                                                            <?php $i = 0;
                                                            foreach ($estimate_items as $row) { ?>

                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="form-control getItems"
                                                                               onKeyup="getItems(this)" name="item[]"
                                                                               value="<?php echo $row['item']; ?>">
                                                                        <ul class="suggestions"></ul>
                                                                    </td>
                                                                    <td><select name="item_type[]" class="form-control">

                                                                            <option value="material" <?php if ($row['item_type'] == 'material') echo 'selected'; ?>>
                                                                                Material
                                                                            </option>
                                                                            <option value="product" <?php if ($row['item_type'] == 'product') echo 'selected'; ?>>
                                                                                Product
                                                                            </option>
                                                                            <option value="service" <?php if ($row['item_type'] == 'service') echo 'selected'; ?>>
                                                                                Service
                                                                            </option>
                                                                        </select></td>
                                                                    <td>
                                                                        <input type="text" class="form-control quantity"
                                                                               name="quantity[]"
                                                                               data-counter="<?php echo $i; ?>"
                                                                               id="quantity_<?php echo $i; ?>"
                                                                               value="<?php echo $row['quantity'] ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                               name="location[]"
                                                                               value="<?php echo $row['location'] ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control price"
                                                                               name="price[]"
                                                                               data-counter="<?php echo $i; ?>"
                                                                               id="price_<?php echo $i; ?>" min="0"
                                                                               value="<?php echo $row['price'] ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number"
                                                                               value="<?php echo $row['discount'] ?>"
                                                                               class="form-control discount"
                                                                               name="discount[]"
                                                                               data-counter="<?php echo $i; ?>"
                                                                               id="discount_<?php echo $i; ?>" min="0"
                                                                               value="0"
                                                                               readonly>
                                                                    </td>
                                                                    <td>
															<span id="span_tax_<?php echo $i; ?>"><?php $tax = ($row['price'] * 7.5 / 100) * $row['quantity'];
                                                                echo number_format($tax, 2) ?></span>
                                                                    </td>
                                                                    <td>
															<span id="span_total_<?php echo $i; ?>"><?php $price = ($row['price'] + $tax) * $row['quantity'];
                                                                echo number_format($price, 2); ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="remove">X</a>
                                                                    </td>
                                                                </tr>
                                                                <?php $i++;
                                                            } ?>

                                                        <?php } else { ?>
                                                            <input type="hidden" name="count" value="0" id="count">
                                                            <tr>
                                                                <td><input type="text" class="form-control getItems"
                                                                           onKeyup="getItems(this)" name="item[]">
                                                                    <ul class="suggestions"></ul>
                                                                </td>
                                                                <td><select name="item_type[]" class="form-control">
                                                                        <option value="service">Service</option>
                                                                        <option value="material">Material</option>
                                                                        <option value="product">Product</option>
                                                                    </select></td>
                                                                <td><input type="text" class="form-control quantity"
                                                                           name="quantity[]" data-counter="0"
                                                                           id="quantity_0"
                                                                           value="1"></td>
                                                                <td><input type="text" class="form-control"
                                                                           name="location[]"></td>
                                                                <td><input type="number" class="form-control price"
                                                                           name="price[]"
                                                                           data-counter="0" id="price_0" min="0"
                                                                           value="0">
                                                                </td>
                                                                <td><input type="number" class="form-control discount"
                                                                           name="discount[]" data-counter="0"
                                                                           id="discount_0"
                                                                           min="0" value="0" readonly></td>
                                                                <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                                <td><span id="span_total_0">0.00</span></td>
                                                            </tr>

                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                    <a href="#" class="btn btn-primary" id="add_another">Add Items</a>
                                                </div>
                                            </div><br/>

                                            <?php
                                            if ($estimate->estimate_eqpt_cost != '') {

                                                $estimate_eqpt_cost = unserialize($estimate->estimate_eqpt_cost);
                                            } else {

                                                $estimate_eqpt_cost = [];
                                            }
                                            ?>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Equipment Cost</td>
                                                    <td class="d-flex align-items-center">$ <input type="text"
                                                                                                   value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['eqpt_cost'] : 0.00; ?>"
                                                                                                   name="eqpt_cost"
                                                                                                   id="eqpt_cost"
                                                                                                   onfocusout="cal_total_due()"
                                                                                                   class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sales Tax</td>
                                                    <td class="d-flex align-items-center">$ <input type="text"
                                                                                                   value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['sales_tax'] : 0.00; ?>"
                                                                                                   name="sales_tax"
                                                                                                   id="sales_tax"
                                                                                                   onfocusout="cal_total_due()"
                                                                                                   class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <input type="hidden"
                                                           value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['inst_cost'] : 0.00; ?>"
                                                           name="inst_cost"
                                                           id="inst_cost"
                                                           onfocusout="cal_total_due()"
                                                           class="form-control">
                                                    <td>One Time Program and Setup</td>
                                                    <td class="d-flex align-items-center">$ <input type="text"
                                                                                                   value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['one_time'] : 0.00; ?>"
                                                                                                   name="one_time"
                                                                                                   id="one_time"
                                                                                                   onfocusout="cal_total_due()"
                                                                                                   class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Monthly Monitoring</td>
                                                    <td class="d-flex align-items-center">$ <input type="text"
                                                                                                   value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['m_monitoring'] : 0.00; ?>"
                                                                                                   name="m_monitoring"
                                                                                                   id="m_monitoring"
                                                                                                   onfocusout="cal_total_due()"
                                                                                                   class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Total Due</td>
                                                    <td class="d-flex align-items-center">$ <span
                                                                id="total_due"><?php echo !empty($estimate_eqpt_cost) ? number_format($estimate_eqpt_cost['eqpt_cost'] + $estimate_eqpt_cost['sales_tax'] + $estimate_eqpt_cost['inst_cost'] + $estimate_eqpt_cost['one_time'] + $estimate_eqpt_cost['m_monitoring'], 2) : '0.00'; ?></span>
                                                    </td>
                                                </tr>
                                            </table>


                                        <?php } else { ?>

                                            <div class="row" id="plansItemDiv">

                                                <div class="col-md-12 table-responsive">
                                                    <table class="table table-hover">
                                                        <input type="hidden" name="count" value="0" id="count">
                                                        <thead>
                                                        <tr>
                                                            <th>DESCRIPTION</th>
                                                            <th>Type</th>
                                                            <th width="100px">Quantity</th>
                                                            <th>LOCATION</th>
                                                            <th width="100px">COST</th>
                                                            <th width="100px">Discount</th>
                                                            <th>Tax(%)</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="table_body">
                                                        <tr>
                                                            <td><input type="text" class="form-control getItems"
                                                                       onKeyup="getItems(this)" name="item[]">
                                                                <ul class="suggestions"></ul>
                                                            </td>
                                                            <td><select name="item_type[]" class="form-control">
                                                                    <option value="product">Product</option>
                                                                    <option value="material">Material</option>
                                                                    <option value="service">Service</option>
                                                                </select></td>
                                                            <td><input type="text" class="form-control quantity"
                                                                       name="quantity[]"
                                                                       data-counter="0" id="quantity_0" value="1"></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="location[]">
                                                            </td>
                                                            <td><input type="number" class="form-control price"
                                                                       name="price[]"
                                                                       data-counter="0" id="price_0" min="0" value="0">
                                                            </td>
                                                            <td><input type="number" class="form-control discount"
                                                                       name="discount[]"
                                                                       data-counter="0" id="discount_0" min="0"
                                                                       value="0"
                                                                       readonly>
                                                            </td>
                                                            <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                            <td><span id="span_total_0">0.00</span></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <a href="#" class="btn btn-primary" id="add_another">Add Items</a>
                                                </div>
                                            </div><br/>

                                        <?php } ?>
                                    </div>
                                </div>

                                <!-- ====== TOTAL ====== -->
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group col-md-12">
                                            <h5 class="box-title">Total</h5>
                                        </div>
                                        <div class="col-md-12">

                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Equipment Cost</td>
                                                    <td class="d-flex align-items-center">$ <input type="text"
                                                                                                   value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['eqpt_cost'] : 0.00; ?>"
                                                                                                   name="eqpt_cost"
                                                                                                   id="eqpt_cost"
                                                                                                   onfocusout="cal_total_due()"
                                                                                                   class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sales Tax</td>
                                                    <td class="d-flex align-items-center">$ <input type="text"
                                                                                                   value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['sales_tax'] : 0.00; ?>"
                                                                                                   name="sales_tax"
                                                                                                   id="sales_tax"
                                                                                                   onfocusout="cal_total_due()"
                                                                                                   class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <input type="hidden"
                                                           value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['inst_cost'] : 0.00; ?>"
                                                           name="inst_cost"
                                                           id="inst_cost"
                                                           onfocusout="cal_total_due()"
                                                           class="form-control">
                                                    <td>One Time Program and Setup</td>
                                                    <td class="d-flex align-items-center">$ <input type="text"
                                                                                                   value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['one_time'] : 0.00; ?>"
                                                                                                   name="one_time"
                                                                                                   id="one_time"
                                                                                                   onfocusout="cal_total_due()"
                                                                                                   class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Monthly Monitoring</td>
                                                    <td class="d-flex align-items-center">$ <input type="text"
                                                                                                   value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['m_monitoring'] : 0.00; ?>"
                                                                                                   name="m_monitoring"
                                                                                                   id="m_monitoring"
                                                                                                   onfocusout="cal_total_due()"
                                                                                                   class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Total Due</td>
                                                    <td class="d-flex align-items-center">$ <span
                                                                id="total_due"><?php echo !empty($estimate_eqpt_cost) ? number_format($estimate_eqpt_cost['eqpt_cost'] + $estimate_eqpt_cost['sales_tax'] + $estimate_eqpt_cost['inst_cost'] + $estimate_eqpt_cost['one_time'] + $estimate_eqpt_cost['m_monitoring'], 2) : '0.00'; ?></span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <!-- <button class="btn btn-block btn-lg btn-primary">Import</button>-->
                                    </div>
                                </div>

                                <!-- ====== PAYMENT OPTION ====== -->
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group col-md-12">
                                            <h5 class="box-title">Payment Option</h5>
                                            <p>YOU EXPRESSLY AUTHORIZE ADI AND ITS AFFILIATES TO RECIEVE PAYMENT FOR THE
                                                LISTED SERVICES ABOVE. BY SIGNING BELOW BUYER AGREES TO THE TERMS OF
                                                YOUR SERVICE AGREEMENT AND ACKOWLEDGES RECEIPT OF A COPY OF THIS SERVICE
                                                AGREEMENT. </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php foreach (get_config_item('card_options') as $key => $option) { ?>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="card[option]"
                                                               value="<?php echo $key ?>"
                                                               id="card_option_<?php echo $key ?>">
                                                        <label for="card_option_<?php echo $key ?>">
                                                            <span><?php echo $option ?></span>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                Credit Card Type:<br>
                                                <div class="checkbox checkbox-sec margin-right mr-4">
                                                    <input type="radio" name="card[radio_credit_card]" value="Visa"
                                                           checked="checked"
                                                           id="radio_credit_card">
                                                    <label for="radio_credit_card"><span>Visa</span></label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right mr-4">
                                                    <input type="radio" name="card[radio_credit_card]" value="Amex"
                                                           id="radio_credit_cardAmex">
                                                    <label for="radio_credit_cardAmex"><span>Amex</span></label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right mr-4">
                                                    <input type="radio" name="card[radio_credit_card]"
                                                           value="Mastercard"
                                                           id="radio_credit_cardMastercard">
                                                    <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right mr-4">
                                                    <input type="radio" name="card[radio_credit_card]" value="Discover"
                                                           id="radio_credit_cardMasterDiscover">
                                                    <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                                                </div>

                                            </div>
                                            <div class=" col-md-12 mt-5">
                                                <div class="row"
                                                     style="border:none; margin-bottom:20px; padding-bottom:0px;">
                                                    <div class=" col-md-6">
                                                        <label for="card_no">Card Number</label>
                                                        <input type="text" class="form-control card-number required"
                                                               name="card[card_no]"
                                                               id="card_no" placeholder="" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="datepicker_exp_date">Exp. Date</label>
                                                        <div class="form-group">
                                                            <div class='input-group date datepicker'>
                                                                <input type='text' name="card[exp_date]"
                                                                       class="form-control"
                                                                       id="card_exp_date"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-md-2">
                                                        <label for="cvv">CVV#</label>
                                                        <input type="text" class="form-control card-cvc required"
                                                               name="card[cvv]"
                                                               id="cvv" placeholder="" required/>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ====== AGREEMENT ====== -->
                                <div class="row">
                                    <div class=" col-md-12">
                                        <h6>Agreement</h6>
                                        <div style="height:400px; overflow:auto; background:#FFFFFF; padding-left:10px;"
                                             id="showuploadagreement">
                                            <p>2. Install of the system. Company agrees to schedule and install an alarm
                                                system and/or devices in connection with a Monitoring Agreement which
                                                customer will receive at the time of installation. Customer hereby
                                                agrees to
                                                buy the system/devices described below and incorporated herein for all
                                                purposes by this reference (the “System /Services”), in accordance with
                                                the
                                                terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE
                                                MONITORING
                                                AGREEMENT, Customer agrees to pay the consultation fee, the cost of the
                                                system and recovering fees.</p>
                                            <p>3. Customer agrees to have system maintained for an initial term of 60
                                                months
                                                at the above monthly rate in exchange for a reduced cost of the system.
                                                Upon
                                                the execution of this agreement shall automatically start the billing
                                                process. Customer understands that the monthly payments must be paid
                                                through
                                                “Direct Billing” through their banking institution or credit card.
                                                Customers
                                                acknowledge that they authorize Company to obtain a Security System.
                                                Residential Clients: CUSTOMER HAS THE RIGHT TO CANCEL THIS TRANSACTION
                                                at
                                                any time prior to midnight on the 3rd business day after the above date
                                                of
                                                this work order in writing. Customer agrees that no verbal method is
                                                valid,
                                                and must be submitted only in writing. The date on this agreement is the
                                                agreed upon date for both the Company and the Customer</p>
                                            <p>4. Client verifies that they are owners of the property listed above. In
                                                the
                                                event the system has to be removed, Client agrees and understands that
                                                there
                                                will be an additional $299.00 restocking/removal fee and early
                                                termination
                                                fees will apply.</p>
                                            <p>5. Client understands that this is a new Monitoring Agreement through our
                                                central station. Alarm.com or .net is not affiliated nor has any bearing
                                                on
                                                the current monitoring services currently or previously initiated by
                                                Client
                                                with other alarm companies. By signing this work order, Client agrees
                                                and
                                                understands that they have read the above requirements and would like to
                                                take advantage of our services. Client understand that is a binding
                                                agreement for both party.</p>
                                            <p>6. Customer agrees that the system is preprogramed for each specific
                                                location. accordance with the terms and conditions set forth. IF
                                                CUSTOMER
                                                FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the
                                                consultation fee, the cost of the system and recovering fees. Customer
                                                agrees that this is a customized order. By signing this workorder,
                                                customer
                                                agrees that customized order can not be cancelled after three day of
                                                this
                                                signed document.</p>
                                        </div>
                                    </div>
                                    <!--                                <div class=" col-md-12">-->
                                    <!--                                    <div class="col-md-4">-->
                                    <!--                                        <label for="billing_date">Upload user agreemnet</label>-->
                                    <!--                                        <input type="file" name="user_agreementupload" id="user_agreementupload"-->
                                    <!--                                               class="form-control"/>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                </div>

                                <!-- ====== SIGNATURE ====== -->
                                <div class="row">
                                    <div class=" col-md-12">
                                        <div class="work_nore">
                                            <h6>Signature</h6>
                                            <p> By Signing below you verify that the above information is true and
                                                complete,
                                                and you authorize payment and confirmation with nSmarTrac. </p>
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <h5>Company Representative Approval</h5>
                                        <div class="sigPad" id="smoothed" style="width:404px;">
                                            <ul class="sigNav">
                                                <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                <li class="clearButton"><a href="#clear">Clear</a></li>
                                            </ul>
                                            <div class="sig sigWrapper" style="height:auto;">
                                                <div class="typed"></div>
                                                <canvas class="pad" id="company_representative_approval_signature"
                                                        width="400" height="250"></canvas>
                                                <input type="hidden" name="output-2" class="output">
                                            </div>
                                        </div>
                                        <input type="hidden" id="saveCompanySignatureDB"
                                               name="company_representative_approval_signature">
                                        <br>

                                        <label for="comp_rep_approval">Printed Name</label>
                                        <input type="text6" class="form-control mb-3"
                                               name="company_representative_printed_name"
                                               id="comp_rep_approval" placeholder=""/>

                                    </div>
                                    <div class=" col-md-6">
                                        <h5>Primary Account Holder</h5>
                                        <div class="sigPad" id="smoothed2" style="width:404px;">
                                            <ul class="sigNav">
                                                <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                <li class="clearButton"><a href="#clear">Clear</a></li>
                                            </ul>
                                            <div class="sig sigWrapper" style="height:auto;">
                                                <div class="typed"></div>
                                                <canvas class="pad" id="primary_account_holder_signature" width="400"
                                                        height="250"></canvas>
                                                <input type="hidden" name="output-2" class="output">
                                            </div>
                                        </div>
                                        <input type="hidden" id="savePrimaryAccountSignatureDB"
                                               name="primary_account_holder_signature">
                                        <br>

                                        <label for="comp_rep_approval">Printed Name</label>
                                        <input type="text6" class="form-control mb-3" name="primary_account_holder_name"
                                               id="comp_rep_approval" placeholder=""/>

                                    </div>
                                    <div class=" col-md-6">
                                        <h5>Secondary Account Holder</h5>
                                        <div class="sigPad" id="smoothed3" style="width:404px;">
                                            <ul class="sigNav">
                                                <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                <li class="clearButton"><a href="#clear">Clear</a></li>
                                            </ul>
                                            <div class="sig sigWrapper" style="height:auto;">
                                                <div class="typed"></div>
                                                <canvas class="pad" id="secondary_account_holder_signature" width="400"
                                                        height="250"></canvas>
                                                <input type="hidden" name="output-2" class="output">
                                            </div>
                                        </div>
                                        <input type="hidden" id="saveSecondaryAccountSignatureDB"
                                               name="secondery_account_holder_signature">
                                        <br>

                                        <label for="comp_rep_approval">Printed Name</label>
                                        <input type="text6" class="form-control mb-3"
                                               name="secondery_account_holder_name"
                                               id="comp_rep_approval" placeholder=""/>

                                    </div>
                                </div>

                                <!-- ====== Additional Services Inquires and Quotes ====== -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Additional Services Inquires and Quotes</label>
                                        <textarea class="form-control"
                                                  name="additional_inquires"
                                                  rows="7"
                                                  placeholder="Additional Services Inquires and Quotes"></textarea>
                                    </div>
                                </div>

                                <!-- ====== OFFICE USE ONLY ====== -->
                                <!--                                <div class="row">-->
                                <!--                                    <div class="col-md-12">-->
                                <!--                                        <label for="office_use_only">Office Use Only</label>-->
                                <!--                                        <textarea class="form-control"-->
                                <!--                                                  name="office_use_only"-->
                                <!--                                                  id="office_use_only"-->
                                <!--                                                  rows="7"-->
                                <!--                                                  placeholder="Office Use Only"></textarea>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->


                                <!-- ====== POST SERVICE SUMMARY ====== -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" href="#POST-SERVICEcollapse1">POST-SERVICE
                                                            SUMMARY
                                                            <i class="fa fa-angle-down"
                                                               style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                    </h4>
                                                </div>
                                                <div id="POST-SERVICEcollapse1" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mt-5">
                                                                <div id="POST-SERVICEcollapse1">
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <div class=" col-md-4 form-group">
                                                                                <label for="post_service_uid">USERID</label>
                                                                                <input type="text" class="form-control"
                                                                                       name="post_service_summary[userid]"
                                                                                       id="post_service_uid"
                                                                                       placeholder=""/>
                                                                            </div>
                                                                            <div class=" col-md-4 form-group">
                                                                                <label for="post_service_pwd">PASSWORD</label>
                                                                                <input type="text" class="form-control"
                                                                                       name="post_service_summary[password]"
                                                                                       id="post_service_pwd"
                                                                                       placeholder=""/>
                                                                            </div>
                                                                            <div class=" col-md-4 form-group">
                                                                                <label for="post_service_pre_install">Pre-Install
                                                                                    Conf.
                                                                                    #</label>
                                                                                <input type="text" class="form-control"
                                                                                       name="post_service_summary[pre_install_conf]"
                                                                                       id="post_service_pre_install"
                                                                                       placeholder=""/>
                                                                            </div>
                                                                            <div class=" col-md-4 form-group">
                                                                                <label for="post_service_wifi_pwd">WiFi
                                                                                    Password</label>
                                                                                <input type="text" class="form-control"
                                                                                       name="post_service_summary[wifi_password]"
                                                                                       id="post_service_wifi_pwd"
                                                                                       placeholder=""/>
                                                                            </div>
                                                                            <div class=" col-md-4 form-group">
                                                                                <label for="post_service_panel_location">Panel
                                                                                    Location</label>
                                                                                <input type="text" class="form-control"
                                                                                       name="post_service_summary[panel_location]"
                                                                                       id="post_service_panel_location"
                                                                                       placeholder=""/>
                                                                            </div>
                                                                            <div class=" col-md-4 form-group">
                                                                                <label for="post_service_trans_location">Transformer
                                                                                    Location</label>
                                                                                <input type="text" class="form-control"
                                                                                       name="post_service_summary[transformer_location]"
                                                                                       id="post_service_trans_location"
                                                                                       placeholder=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <button type="submit"
                                                class="btn btn-flat btn-primary">
                                            Submit
                                        </button>
                                        <a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancel this</a>
                                    </div>
                                </div>

                            </div>
                            <!-- end card -->
                        </div>
                    </div>


                    <div class="modal fade" id="checklistModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Select Checklists</h4>
                                </div>
                                <div class="modal-body">
                                    <p></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Add Selected
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <!-- end row -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end container-fluid -->
        </div>
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/timepicker/"></script>
<script>
    $(document).ready(function () {
        $('.form-validate').validate();

        //repeater content
        $(document).on('click', '.repeater-content-block .repeat-action', function (e) {

            const index = $(this).prev().find('.repeater-wrap > tr').length;

            const zn = (index <= 0) ? 1 : index + 1;

            let row = '<tr>';
            row += '<td><label class="mr-4"><input type="checkbox" name="zone_info[' + index + '][existing]" value="' + eval(index + 1) + '" id="zone_info_existing_' + index + '"></label></td>';
            row += '<td>' + zn + '</td>';
            row += '<td><label class="mr-4"><input type="checkbox" name="zone_info[' + index + '][repeat_issue]" value="' + eval(index + 1) + '" id="zone_info_repeat_issue_' + index + '"></label></td>';
            row += '<td><input type="text" name="zone_info[' + index + '][repeat_issue]" class="form-control"></td>';
            row += '<td><button type="button" class="btn btn-danger btn-close"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            row += '</tr>';

            $(this).prev().find('.repeater-wrap').append(row);
        });

        $(document).on('click', '.repeater-content-block .repeater-wrap tr .btn-close', function (e) {

            console.log("x");
            $(this).parent().parent().remove();
        });

        // plan type change
        $(document).on('change', '#plan_type', function (e) {

            // alert($(this).val());
            getplanItems($(this).val());
        });


        // signature for Technician
        $('#smoothed').signaturePad({drawOnly: true, drawBezierCurves: true, lineTop: 200});
        $("#company_representative_approval_signature").on("click touchstart", function () {
            var canvas = document.getElementById("company_representative_approval_signature");
            var dataURL = canvas.toDataURL("image/png");
            $("#saveCompanySignatureDB").val(dataURL);
        });

        // signature for Technician
        $('#smoothed2').signaturePad({drawOnly: true, drawBezierCurves: true, lineTop: 200});
        $("#primary_account_holder_signature").on("click touchstart", function () {
            var canvas = document.getElementById("primary_account_holder_signature");
            var dataURL = canvas.toDataURL("image/png");
            $("#savePrimaryAccountSignatureDB").val(dataURL);
        });

        // signature for Technician
        $('#smoothed3').signaturePad({drawOnly: true, drawBezierCurves: true, lineTop: 200});
        $("#secondary_account_holder_signature").on("click touchstart", function () {
            var canvas = document.getElementById("secondary_account_holder_signature");
            var dataURL = canvas.toDataURL("image/png");
            $("#saveSecondaryAccountSignatureDB").val(dataURL);
        });


        // $('#time_scheduled, #arrival_time').datetimepicker({
        //     format: 'LT'
        // });

        $('#time_scheduled, #arrival_time').timepicker({'scrollDefault': 'now'});


        $('#ticket_date, #card_exp_date').datetimepicker({
            format: 'L'
        });
    });
</script>