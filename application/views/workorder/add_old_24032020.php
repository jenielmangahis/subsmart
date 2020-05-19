<?php include viewPath('includes/header'); ?>
<link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Workorders</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add workorder</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo url('workorder') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Workorder
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('workorder/save', ['class' => 'form-validate require-validation', 'id' => 'workorder_form', 'autocomplete' => 'off']); ?>
            <style>

            </style>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="workorder_status">WordOrder Type</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <?php if (count($workstatus) > 0) { ?>
                                        <?php foreach ($workstatus as $ws) { ?>
                                            <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                                <input type="radio" name="workorder_status" value="<?= $ws->id; ?>"
                                                       id="ws<?= $ws->id; ?>">
                                                <label for="ws<?= $ws->id; ?>">
                                                    <div style="width:25px;height:25px;background:<?php echo $ws->color ?>"></div>
                                                    <span><?= $ws->title; ?></span>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="contact_name">Client Name</label>
                                    <input type="text" class="form-control" name="contact_name" id="contact_name"
                                           required placeholder="Enter Name"
                                           value="<?php echo (!empty($estimate->customer)) ? $estimate->customer->contact_name : '' ?>"
                                           autofocus
                                           onChange="jQuery('#customer_name').text(jQuery(this).val());" <?php echo (!empty($estimate->customer->contact_name)) ? 'disabled' : '' ?> />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="contact_pwd">Password</label>
                                    <input type="text" class="form-control" name="contact_pwd" id="contact_pwd"
                                           required/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="contact_ssn">SSN</label>
                                    <input type="text" class="form-control" name="contact_ssn" id="contact_ssn" required
                                           placeholder="Enter SSN"/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="contact_dob">DOB</label>
                                    <input type="text" class="form-control" name="contact_dob" id="contact_dob"
                                           value="<?php echo (!empty($estimate->customer)) ? date('m/d/Y', $estimate->customer->birthday) : date('m/d/Y') ?>"
                                           placeholder="Enter DOB" <?php echo (!empty($estimate->customer->birthday)) ? 'disabled' : '' ?> />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="contact_mobile">Mobile</label>
                                    <input type="text" class="form-control" name="contact_mobile" id="contact_mobile"
                                           placeholder="Enter Mobile"
                                           value="<?php echo (!empty($estimate->customer)) ? $estimate->customer->mobile : '' ?>"
                                           required <?php echo (!empty($estimate->customer->mobile)) ? 'disabled' : '' ?> />

                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="contact_phone">Phone</label>
                                    <!-- <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="Enter Phone" value="<?php echo (!empty($estimate->customer)) ? $estimate->customer->phone : '' ?>" <?php echo (!empty($estimate->customer->phone)) ? 'disabled' : '' ?> /> -->
                                    <div class="input-group phone-input">
									<span class="input-group-btn">
										<button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false"><span class="type-text">Type</span> <span
                                                    class="caret"></span></button>
										<ul class="dropdown-menu" role="menu">
											<li><a class="changePhoneType" href="javascript:;" data-type-value="mobile">Mobile</a></li>
											<li><a class="changePhoneType" href="javascript:;" data-type-value="home">Home</a></li>
											<li><a class="changePhoneType" href="javascript:;" data-type-value="work">Work</a></li>
										</ul>
									</span>
                                        <input type="hidden" name="contact_phone[type]" class="type-input"
                                               value="mobile"/>
                                        <input type="text" name="contact_phone[number]" class="form-control"
                                               placeholder="Enter Phone"
                                               value="<?php echo (!empty($estimate->customer)) ? $estimate->customer->phone : '' ?>" <?php echo (!empty($estimate->customer->phone)) ? 'disabled' : '' ?> />
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="contact_email">Contact Email</label>
                                    <input type="email" class="form-control" name="contact_email" id="contact_email"
                                           placeholder="Enter Email"
                                           value="<?php echo (!empty($estimate->customer)) ? $estimate->customer->contact_email : '' ?>"
                                           required <?php echo (!empty($estimate->customer->contact_email)) ? 'disabled' : '' ?> />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="workorder_date">Workorder Date</label>
                                    <input type="text" class="form-control" name="workorder_date" id="workorder_date"
                                           value="<?php echo date('m/d/Y'); ?>" required/>
                                </div>

                            </div>


                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                    <label for="street_address">Location</label>
                                    <input type="text" class="form-control" name="street_address" id="street_address"
                                           placeholder="Enter Address"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="suit">Address 2</label>
                                    <input type="text" class="form-control" name="suit" id="suit"
                                           placeholder="Enter Suite/Unit"
                                           onChange="jQuery('#suit_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" id="city"
                                           placeholder="Enter City"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="zip">Zip/Postal Code</label>
                                    <input type="text" class="form-control" name="zip" id="zip"
                                           placeholder="Enter Zip/Postal Code"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="state">State/Province</label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach (get_config_item('states') as $key => $state) { ?>
                                            <option value="<?php echo $key ?>"><?php echo $state; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-auto form-group">
                                    <label for="">Customer Type</label><br/>
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                        <input type="radio" name="customer_type" value="Residential" checked="checked"
                                               id="customer_type">
                                        <label for="customer_type"><span>Residential</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right my-0">
                                        <input type="radio" name="customer_type" value="Commercial" id="Commercial">
                                        <label for="Commercial"><span>Commercial</span></label>
                                    </div>
                                </div>

                                <div class="col-auto form-group">
                                    <label for="">Notification Type</label><br/>
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                        <input type="checkbox" name="notify_by[]"
                                               value="Email" <?php echo (!empty($estimate->customer) && $estimate->customer->notification_method == 'Email') ? 'checked' : 'checked' ?>
                                               id="notify_by_email">
                                        <label for="notify_by_email"><span>Notify By Email</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                        <input type="checkbox" name="notify_by[]" value="SMS"
                                               id="notify_by_sms" <?php echo (!empty($estimate->customer) && $estimate->customer->notification_method == 'SMS') ? 'checked' : '' ?>>
                                        <label for="notify_by_sms"><span>Notify By SMS/Text</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group mt-3">
                                    <label for="street_address"> Plan Type:</label>
                                    <div class="c__custom c__custom_width  ">
                                        <?php if (count($plans) > 0) { ?>
                                            <?php foreach ($plans as $pn) { ?>
                                                <div class="checkbox checkbox-sec margin-right mr-4">
                                                    <?php if (!empty($estimate)) { ?>
                                                        <?php if ($estimate->plan_id == $pn->id) { ?>
                                                            <input onClick="getplanItems(<?= $pn->id; ?>)" type="radio"
                                                                   name="plan_type" value="<?= $pn->id; ?>"
                                                                   id="radio_credit_card<?= $pn->id; ?>" checked>
                                                        <?php } else { ?>
                                                            <input onClick="getplanItems(<?= $pn->id; ?>)" type="radio"
                                                                   name="plan_type" value="<?= $pn->id; ?>"
                                                                   id="radio_credit_card<?= $pn->id; ?>">
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <input onClick="getplanItems(<?= $pn->id; ?>)" type="radio"
                                                               name="plan_type" value="<?= $pn->id; ?>"
                                                               id="radio_credit_card<?= $pn->id; ?>">
                                                    <?php } ?>
                                                    <label for="radio_credit_card<?= $pn->id; ?>"><span><?= $pn->plan_name; ?></span></label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="box row">

                                <div class="box-body col-12">
                                    <h5 class="box-title">Assign 2 (optional)</h5>
                                    <select id="employee_assign_to" name="assign_to[]" data-customer-source="dropdown"
                                            class="form-control searchable-dropdown" placeholder="Select">
                                        <option value="0">- none -</option>
                                    </select>

                                    <!--									--><?php //foreach ($users as $row) { ?>
                                    <!---->
                                    <!--										<div class="checkbox checkbox-sec margin-right my-0 mr-3">-->
                                    <!--											<input type="checkbox" value="-->
                                    <?php //echo $row->id; ?><!--" name="assign_to[]" id="-->
                                    <?php //echo $row->id; ?><!--">-->
                                    <!--											<label for="-->
                                    <?php //echo $row->id; ?><!--"><span>-->
                                    <?php //echo ucfirst($row->name); ?><!--</span></label>-->
                                    <!--										</div>-->
                                    <!--									--><?php //} ?>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4 style="width:100%">Emergency Contact Info</h4>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="emrg_contact_1">Emergency Contact Name 1</label>
                                    <input type="text" class="form-control" name="emrg_contact_1" id="emrg_contact_1"
                                           placeholder="Enter Emergency Contact Name 1"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="emrg_contact_2">Emergency Contact Name 2:</label>
                                    <input type="text" class="form-control" name="emrg_contact_2" id="emrg_contact_2"
                                           placeholder="Enter Emergency Contact Name 2"/>
                                </div>
                                <div class="col-md-12">
                                    <label for="notes_to_tech"> Notes:</label>
                                    <textarea name="notes_to_emergency" id="notes_to_emergency" rows="3"
                                              class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <!--  -->
                                <div class="col-md-6 form-group">
                                    <label for="emerg_contact_location"> Panel Location:</label>
                                    <input type="text" class="form-control" name="emerg_contact_location"
                                           id="emerg_contact_location" placeholder=""/><br>
                                    <label for="emerg_contact_location"> Panel Type:</label>
                                    <div class="c__custom c__custom_width mt-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_emerg_location[]" value="L3000">L3000
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_emerg_location[]" value="L5100">L5100
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_emerg_location[]" value="LTOUCH">LTOUCH
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_emerg_location[]" value="GO Panel v2">GO
                                            Panel v2
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_emerg_location[]" value="GO Panel v3">GO
                                            Panel v3
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_emerg_location[]" value="Vista/SEM">Vista/SEM
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_emerg_location[]" value="Vista/GSMX">Vista/GSMX
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_emerg_location[]" value="Other">Other
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_emerg_location[]" value="DSC">DSC
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
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
                                                                   name="ip_cam[honeywell][wo]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="ip_cam[honeywell][wi]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="ip_cam[honeywell][doorbell_cam]"
                                                                   placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>AVYCON</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="ip_cam[avycon][wo]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="ip_cam[avycon][wi]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="ip_cam[avycon][doorbell_cam]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="ip_cam[other][wo]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="ip_cam[other][wi]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="ip_cam[other][doorbell_cam]" placeholder=""/>
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
                                                                       name="doorlocks[handle][brass]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="doorlocks[handle][nickal]" placeholder=""/>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                       name="doorlocks[handle][bronze]" placeholder=""/>
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
                                                                   name="chk_dvr[honeywell][4_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_dvr[honeywell][8_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_dvr[honeywell][16_channel]"
                                                                   placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>AVYCON</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_dvr[avycon][4_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_dvr[avycon][8_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_dvr[avycon][16_channel]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_dvr[other][4_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_dvr[other][8_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_dvr[other][16_channel]" placeholder=""/>
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
                                                    <a data-toggle="collapse" href="#collapse4">ENHANCED SERVICES <i
                                                                class="fa fa-angle-down"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
                                            </div>
                                            <div id="collapse4" class="panel-collapse collapse">
                                                <table class="table">
                                                    <tr>
                                                        <th></th>
                                                        <th>PERS</th>
                                                        <th>PERS w/ Fall Detect</th>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_enhance_dvr[pers][]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_enhance_dvr[persw][]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_enhance_dvr[pers][]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_enhance_dvr[persw][]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_enhance_dvr[pers][]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="chk_enhance_dvr[persw][]" placeholder=""/>
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
                                                    <a data-toggle="collapse" href="#collapse5">Thermostat <i
                                                                class="fa fa-angle-down"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
                                            </div>
                                            <div id="collapse5" class="panel-collapse collapse">
                                                <table class="table">
                                                    <tr>
                                                        <td>Honeywell</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="thermostat[honeywell][]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="thermostat[honeywell][]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alarm.com</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="thermostat[alarm][]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="thermostat[alarm][]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="thermostat[other][]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="thermostat[other][]" placeholder=""/>
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
                                                    <a data-toggle="collapse" href="#collapse6">Lighting <i
                                                                class="fa fa-angle-down"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
                                            </div>
                                            <div id="collapse6" class="panel-collapse collapse">
                                                <table class="table">
                                                    <tr>
                                                        <th></th>
                                                        <th>Switch</th>
                                                        <th>Plug</th>
                                                        <th>Light Bulb</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Honeywell</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="lighting[honeywell][switch]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="lighting[honeywell][plug]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="lighting[honeywell][light_bulb]"
                                                                   placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alarm.com</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="lighting[alarm][switch]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="lighting[alarm][plug]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   Signature name="lighting[alarm][light_bulb]"
                                                                   placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other</td>
                                                        <td><input type="text" class="form-control"
                                                                   name="lighting[other][switch]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="lighting[other][plug]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   name="lighting[other][light_bulb]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class=" col-md-12">
                                    <label for="inst_date"> Installation Date:</label>
                                    <input type="text" class="form-control" name="inst_date" id="inst_date"
                                           value="<?php echo date('m/d/Y'); ?>" placeholder=""/>
                                    <br/>
                                    <div class="row">
                                        <div class="c__custom col-md-12">
                                            <label>Install Time:</label>
                                            <label class="checkbox-inline"><input type="radio" name="inst_time[]"
                                                                                  value="8-10">8-10</label>
                                            <label class="checkbox-inline"><input type="radio" name="inst_time[]"
                                                                                  value="10-12">10-12</label>
                                            <label class="checkbox-inline"><input type="radio" name="inst_time[]"
                                                                                  value="12-2">12-2</label>
                                            <label class="checkbox-inline"><input type="radio" name="inst_time[]"
                                                                                  value="2-4">2-4</label>
                                            <label class="checkbox-inline"><input type="radio" name="inst_time[]"
                                                                                  value="4-6">4-6</label>
                                            <label class="checkbox-inline data-calendar=" time-start-container"> <input
                                                    style="width: 100px" type='text' name="manual_installation_time"
                                                    class="form-control"/>Firm Time</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="notes_to_tech"> Notes to Tech:</label>
                                    <textarea name="notes_to_tech" id="notes_to_tech" rows="3"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-md-9">
                                    <div class="work_nore">
                                        <h6>Work Order Items</h6>
                                        <p> You can set up the products or services for this work order. </p>
                                        <p><strong class="red">Note: prices will not be shown to the assigned employees
                                                but
                                                only to you. </strong></p>
                                        <!-- <a href="" class="add_itemms_button">Add Items</a> -->
                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
            <label>Show qty as:</label>
            <select class="custom-select form-control">
            <option>Quanity</option>
            </select>
            </div> -->
                            </div>
                            <br/>

                            <?php if (!empty($estimate)) { ?>

                                <div class="row" id="plansItemDiv">
                                    <?php if ($estimate->estimate_items != '') {

                                        $estimate_items = unserialize($estimate->estimate_items);
                                    } else {

                                        $estimate_items = [];
                                    } ?>
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
                                                                   name="quantity[]" data-counter="<?php echo $i; ?>"
                                                                   id="quantity_<?php echo $i; ?>"
                                                                   value="<?php echo $row['quantity'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="location[]"
                                                                   value="<?php echo $row['location'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control price"
                                                                   name="price[]" data-counter="<?php echo $i; ?>"
                                                                   id="price_<?php echo $i; ?>" min="0"
                                                                   value="<?php echo $row['price'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" value="<?php echo $row['discount'] ?>"
                                                                   class="form-control discount" name="discount[]"
                                                                   data-counter="<?php echo $i; ?>"
                                                                   id="discount_<?php echo $i; ?>" min="0" value="0"
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
                                                               name="quantity[]" data-counter="0" id="quantity_0"
                                                               value="1"></td>
                                                    <td><input type="text" class="form-control" name="location[]"></td>
                                                    <td><input type="number" class="form-control price" name="price[]"
                                                               data-counter="0" id="price_0" min="0" value="0"></td>
                                                    <td><input type="number" class="form-control discount"
                                                               name="discount[]" data-counter="0" id="discount_0"
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
                                <div class="row">
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
                                            <!--                                            <tr>-->
                                            <!--                                                <td>Installation Cost</td>-->
                                            <!--                                                <td class="d-flex align-items-center">$ <input type="text"-->
                                            <!--                                                                                               value="-->
                                            <?php //echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['inst_cost'] : 0.00; ?><!--"-->
                                            <!--                                                                                               name="inst_cost"-->
                                            <!--                                                                                               id="inst_cost"-->
                                            <!--                                                                                               onfocusout="cal_total_due()"-->
                                            <!--                                                                                               class="form-control">-->
                                            <!--                                                </td>-->
                                            <!--                                            </tr>-->
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
                                </div>


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
                                                <td><input type="text" class="form-control quantity" name="quantity[]"
                                                           data-counter="0" id="quantity_0" value="1"></td>
                                                <td><input type="text" class="form-control" name="location[]"></td>
                                                <td><input type="number" class="form-control price" name="price[]"
                                                           data-counter="0" id="price_0" min="0" value="0"></td>
                                                <td><input type="number" class="form-control discount" name="discount[]"
                                                           data-counter="0" id="discount_0" min="0" value="0" readonly>
                                                </td>
                                                <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                <td><span id="span_total_0">0.00</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <a href="#" class="btn btn-primary" id="add_another">Add Items</a>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Equipment Cost</td>
                                                <td class="d-flex align-items-center">$ &nbsp;&nbsp;<input type="text"
                                                                                                           value="0.00"
                                                                                                           name="eqpt_cost"
                                                                                                           id="eqpt_cost"
                                                                                                           readonly
                                                                                                           class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sales Tax</td>
                                                <td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text"
                                                                                                            value="0.00"
                                                                                                            name="sales_tax"
                                                                                                            id="sales_tax"
                                                                                                            readonly
                                                                                                            class="form-control">
                                                </td>
                                            </tr>
                                            <!--                                            <tr>-->
                                            <!--                                                <td>Installation Cost</td>-->
                                            <!--                                                <td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text"-->
                                            <!--                                                                                                            value="0.00"-->
                                            <!--                                                                                                            name="inst_cost"-->
                                            <!--                                                                                                            id="inst_cost"-->
                                            <!--                                                                                                            onfocusout="cal_total_due()"-->
                                            <!--                                                                                                            class="form-control">-->
                                            <!--                                                </td>-->
                                            <!--                                            </tr>-->
                                            <tr>
                                                <input type="hidden"
                                                       value="0.00"
                                                       name="inst_cost"
                                                       id="inst_cost"
                                                       onfocusout="cal_total_due()"
                                                       class="form-control">
                                                <td>One Time Program and Setup</td>
                                                <td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text"
                                                                                                            value="0.00"
                                                                                                            name="one_time"
                                                                                                            id="one_time"
                                                                                                            onfocusout="cal_total_due()"
                                                                                                            class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Monitoring</td>
                                                <td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text"
                                                                                                            value="0.00"
                                                                                                            name="m_monitoring"
                                                                                                            id="m_monitoring"
                                                                                                            onfocusout="cal_total_due()"
                                                                                                            class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Due</td>
                                                <td class="d-flex align-items-center">$ &nbsp;&nbsp; <span
                                                            id="total_due">0.00</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            <?php } ?>

                            <div class="row">
                                <div class="col-md-12" data-toggle="collapse" data-target="#demo"
                                     style="cursor: pointer;">
                                    <p>2. Install of the system. Company agrees to schedule and install an alarm system
                                        and/or devices in connection with a Monitoring Agreement which customer will
                                        receive at the time of installation. <i class="fa fa-angle-down"
                                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i>
                                    </p>
                                </div>
                                <div class="col-md-12 collapse" id="demo">
                                    <p>
                                        Customer hereby agrees to buy the system/devices described below and
                                        incorporated herein for all purposes by this reference (the “System /Services”),
                                        in accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO
                                        FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee,
                                        the cost of the system and recovering fees.
                                    </p>
                                    <p>3. Customer agrees to have system maintained for an initial term of 60
                                        months at the above monthly rate in exchange for a reduced cost of the system.
                                        Upon the execution of this agreement shall automatically start the billing
                                        process.
                                        Customer understands that the monthly payments must be paid through “Direct
                                        Billing” through their banking institution or credit card. Customers acknowledge
                                        that they
                                        authorize Company to obtain a Security System. Residential Clients: CUSTOMER HAS
                                        THE RIGHT TO CANCEL THIS TRANSACTION at any time prior to midnight on the 3rd
                                        business day after the above date of this work order in writing. Customer agrees
                                        that no
                                        verbal method is valid, and must be submitted only in writing. The date on this
                                        agreement
                                        is the agreed upon date for both the Company and the Customer
                                    </p>
                                    <p> 4. Client verifies that they are owners of the property listed above. In the
                                        event
                                        the
                                        system has to be removed, Client agrees and understands that there will be an
                                        additional $299.00 restocking/removal fee and early termination fees will apply.
                                    </p>
                                    <p> 5. Client understands that this is a new Monitoring Agreement through our
                                        central
                                        station. Alarm.com or .net is not affiliated nor has any bearing on the current
                                        monitoring services currently or previously initiated by Client with other alarm
                                        companies. By signing this work order, Client agrees and understands that they
                                        have read the above requirements and would like to take advantage of our
                                        services. Client understand that is a binding agreement for both party.
                                    </p>
                                    <p> 6. Customer agrees that the system is preprogramed for each specific location.
                                        accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL
                                        THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the
                                        cost of the system and recovering fees.
                                        Customer agrees that this is a customized order. By signing this workorder,
                                        customer
                                        agrees that customized order can not be cancelled after three day of this signed
                                        document.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-md-12">
                                    <div class="work_nore">
                                        <h6>Payment Information:-</h6>
                                    </div>
                                </div>
                                <div class=" col-md-12">
                                    Credit Card Type:
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="radio_credit_card" value="Visa" checked="checked"
                                               id="radio_credit_card">
                                        <label for="radio_credit_card"><span>Visa</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="radio_credit_card" value="Amex"
                                               id="radio_credit_cardAmex">
                                        <label for="radio_credit_cardAmex"><span>Amex</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="radio_credit_card" value="Mastercard"
                                               id="radio_credit_cardMastercard">
                                        <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="radio_credit_card" value="Discover"
                                               id="radio_credit_cardMasterDiscover">
                                        <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                                    </div>

                                </div>
                                <div class=" col-md-12">
                                    <div class="row" style="border:none; margin-bottom:20px; padding-bottom:0px;">
                                        <div class=" col-md-6">
                                            <label for="card_no">Card Number</label>
                                            <input type="text" class="form-control card-number required" name="card_no"
                                                   id="card_no" placeholder="" required/>
                                        </div>
                                        <div class="col-md-2">
                                            <label class='form-label'>Expiration Month</label>
                                            <input class='form-control card-expiry-month required' maxlength="256"
                                                   placeholder='MM' size='2' value="" type='text' required/>
                                        </div>
                                        <div class=" col-md-2">
                                            <label for="exp_date">Expiration year</label>
                                            <input type="text" class="form-control card-expiry-year required"
                                                   name="exp_date" id="exp_date" placeholder="" required/>
                                        </div>
                                        <div class=" col-md-2">
                                            <label for="cvv">CVV#</label>
                                            <input type="text" class="form-control card-cvc required" name="cvv"
                                                   id="cvv" placeholder="" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="card_no">Bank Account #</label>
                                        <input type="text" class="form-control required"
                                               name="bank_details[account_number]"
                                               id="card_no" placeholder="" required/>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="card_no">Routing #</label>
                                        <input type="text" class="form-control card-number required"
                                               name="bank_details[routing_number]"
                                               id="card_no" placeholder="" required/>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="card_no">Bank Account Billing Date</label>
                                        <select class="form-control" name="bank_details[billing_date]">
                                            <?php foreach (range(1, 31) as $n) { ?>
                                                <?php $day = date('S', mktime(1, 1, 1, 1, ((($n >= 10) + ($n >= 20) + ($n == 0)) * 10 + $n % 10))); ?>
                                                <option value="<?php echo $n . $day ?>"><?php echo $n . $day ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <b>Billing Dates:</b>
                                    <div class="c__custom">
                                        <select name="chk_billing_dates[]" class="form-control col-sm-12 col-md-4">
                                            <?php foreach (range(1, 31) as $n) { ?>
                                                <?php $day = date('S', mktime(1, 1, 1, 1, ((($n >= 10) + ($n >= 20) + ($n == 0)) * 10 + $n % 10))); ?>
                                                <option value="<?php echo $n . $day ?>"><?php echo $n . $day ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="c__custom">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="5th" checked>5th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="7th">7th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="8th">8th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="10th">10th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="14th">14th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="15th">15th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="18th">18th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="21th">21th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="22th">22th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="26th">26th
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="chk_billing_dates[]" value="28th">28th
                                        </label>
                                    </div> -->
                                </div>
                            </div>

                            <div clas="row">
                                <div class="col-md-12">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse1">Other Information:- <i
                                                                class="fa fa-angle-down"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
                                            </div>
                                            <div id="collapse1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class=" col-md-4 form-group">
                                                            <label for="checking_account">Premises Location</label>
                                                            <input type="text" class="form-control"
                                                                   name="other_information[premises_location]"
                                                                   id="checking_account" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="routing">Premises Verification Name</label>
                                                            <input type="text" class="form-control"
                                                                   name="other_information[premises_verification_name]"
                                                                   id="routing"
                                                                   placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="sales_rep_name">2nd Call Verification
                                                                Name</label>
                                                            <input type="text" class="form-control"
                                                                   name="other_information[2nd_call_verification_name]"
                                                                   id="sales_rep_name" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <!--                                                    <input type="text" class="form-control" name="other_information[premises_phone_number]"-->
                                                            <!--                                                           id="cell_phone" placeholder=""/>-->

                                                            <div class="form-group">
                                                                <label for="cell_phone">Premises Phone Number</label>
                                                                <div class="input-group phone-input">
                                               <span class="input-group-btn">
                                                  <button type="button" class="btn btn-default dropdown-toggle"
                                                          data-toggle="dropdown"
                                                          aria-expanded="false"><span
                                                              class="type-text">Type</span> <span
                                                              class="caret"></span></button>
                                                  <ul class="dropdown-menu" role="menu">
                                                     <li><a class="changePhoneType" href="javascript:;"
                                                            data-type-value="mobile">Mobile</a></li>
                                                     <li><a class="changePhoneType" href="javascript:;"
                                                            data-type-value="home">Home</a></li>
                                                     <li><a class="changePhoneType" href="javascript:;"
                                                            data-type-value="work">Work</a></li>
                                                  </ul>
                                               </span>
                                                                    <input type="hidden"
                                                                           name="other_information[premises_phone_number][type]"
                                                                           class="type-input"/>
                                                                    <input type="text"
                                                                           name="other_information[premises_phone_number][number]"
                                                                           class="form-control"
                                                                           placeholder="Enter Phone"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class=" col-md-4 form-group">
                                                            <label for="notes_to_lauren">Sales Rep's Name:</label>
                                                            <input type="text" class="form-control"
                                                                   name="other_information[sales_rep_name]"
                                                                   id="notes_to_lauren" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="notes_to_lauren">Notes to Lauren:</label>
                                                            <input type="text" class="form-control"
                                                                   name="other_information[notes_to_lauren]"
                                                                   id="notes_to_lauren" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="prev_prod_name">If takeover, name of previous
                                                                products:</label>
                                                            <input type="text" class="form-control"
                                                                   name="other_information[prev_prod_name]"
                                                                   id="prev_prod_name" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-12">
                                                            <label for="chk_inactive mr-5">
                                                                <input type="checkbox" name="other_information[status]"
                                                                       value="ACTIVE">ACTIVE
                                                            </label>

                                                            <label for="chk_inactive">
                                                                <input type="checkbox" name="other_information[status]"
                                                                       value="INACTIVE">INACTIVE
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_uid">USERID</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_uid"
                                                                   id="post_service_uid" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_pwd">PASSWORD</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_pwd"
                                                                   id="post_service_pwd" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_pre_install">Pre-Install Conf.
                                                                #</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_pre_install"
                                                                   id="post_service_pre_install"
                                                                   placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_wifi_pwd">WiFi Password</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_wifi_pwd"
                                                                   id="post_service_wifi_pwd" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_panel_location">Panel
                                                                Location</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_panel_location"
                                                                   id="post_service_panel_location" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_trans_location">Transformer
                                                                Location</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_trans_location"
                                                                   id="post_service_trans_location" placeholder=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-md-12">
                                    <h6>Agreement</h6>
                                    <div style="height:400px; overflow:auto; background:#FFFFFF; padding-left:10px;">
                                        <p style="text-align: center;"><strong>nSmartTrack<br></strong>6866 Pine Forest
                                            Road Ste C&nbsp;<br>Pensacola, Florida 32526<strong>&nbsp;<br></strong></p>
                                        Prepared for: <span id="customer_name">Customer Name</span><br><span
                                                id="suit_name">Address</span><br>Pensacola, Florida 32526<br>02/10/2020
                                        02/10/2020<br><br>
                                        <p><strong>CONGRATULATIONS!<br></strong><br>You are about to take the first step
                                            towards working to repair your credit reports and thank you for allowing
                                            Fico Heroes, LLC. to provide you with the expertise, experience, and
                                            knowledge to help you work towards repairing your credit. We understand that
                                            the process of working to repair your credit can be confusing and difficult
                                            at times. To ensure that you completely understand the process, please take
                                            the time to read the following pages carefully, and then fully complete the
                                            agreement.<br>We look forward to assisting you in working towards your goals
                                            of a better, stronger, more accurate credit report.<br><br><strong>Best
                                                Regards,</strong></p>
                                        <p>The following pages contain:</p>
                                        1. Credit Repair Service Agreement<br>2. Authorization for Credit Repair
                                        Action<br>3. Consumer Credit File Rights (CROA Disclosure)<br>4. Right Of
                                        Cancellation Notice<br>5. State-Specific Disclosures (add if applicable) &nbsp;
                                        <strong>&nbsp;</strong> <strong>Credit Repair Service Agreement for Lawrence
                                            Jernigan<br></strong> <strong>&nbsp;</strong> I, Lawrence Jernigan, hereby
                                        enter into the following agreement with FICO HEROES.<br><br>FICO HEROES hereby
                                        agrees to perform the following:<br>
                                        <ol>
                                            <li>To evaluate Customer' current credit reports as listed with applicable
                                                credit reporting agencies and to identify inaccurate, erroneous, false,
                                                or obsolete information. To advise Customer as to the necessary steps to
                                                be taken on the part of Customer in conjunction with Our Company, to
                                                dispute any inaccurate, erroneous, false or obsolete information
                                                contained in the customer's credit reports.
                                            </li>
                                            <li>To prepare all necessary correspondence in dispute of inaccurate,
                                                erroneous, false, or obsolete information in customer's credit reports.
                                            </li>
                                            <li>To review credit profile status from the credit reporting agencies such
                                                as Experian, Equifax and Transunion.&nbsp; Consulting, coaching, and
                                                monitoring services are conducted by personal meetings, webinars, video
                                                conferencing, telephone, email, or by any other form of communication
                                                during normal business hours.
                                            </li>
                                        </ol>
                                        In exchange, I, Lawrence Jernigan, agree to pay the following fees as outlined
                                        in the following fee schedule:<br>
                                        <ol>
                                            <li>$139.00 after the trial period.</li>
                                            <li>$99.00 At the start of each new month of service.</li>
                                        </ol>
                                        <ul>
                                            <li>&nbsp;REMEMBER – You are NOT billed now when you complete this
                                                Enrollment Form
                                            </li>
                                            <li>&nbsp;Your credit card is NOT being charged when you complete this
                                                form
                                            </li>
                                            <li>&nbsp;You will not be billed for a minimum of 14 days after you enroll
                                            </li>
                                            <li>&nbsp;NO ADVANCE FEES - We only bill you AFTER services are completed
                                            </li>
                                        </ul>
                                        <strong>Don't have the $139 to start?&nbsp; Don't worry, we have a&nbsp;<span
                                                    style="color: #ff0000;">PAYMENT PLAN!!</span>&nbsp; Call
                                            our&nbsp;<span style="color: #ff0000;">FICO HEROES DEDICATED STAFF</span> at
                                            844-406-9364. <br></strong><br><br><strong>Authorization for Credit Repair
                                            Action</strong> &nbsp; 1<strong>. &nbsp;</strong>I, Lawrence Jernigan,
                                        hereafter known as "client" hereby authorize, FICO HEROES, 6866 Pine Forest Road
                                        Ste C, Pensacola, Florida 32526, to make, receive, sign, endorse, execute,
                                        acknowledge, deliver, and possess such applications, correspondence, contracts,
                                        or agreements, as necessary to improve my credit. Such instruments in writing of
                                        whatever and nature shall only be effective for any or all of the three credit
                                        reporting agencies which are TransUnion, Experian, Equifax, and any other
                                        reporting agencies or creditor’s listed, as may be necessary or proper in the
                                        exercise of the rights and powers herein granted.&nbsp; &nbsp; 2. This
                                        authorization may be revoked by the undersigned at any time by giving written
                                        notice to the party authorized herein. Any activity made prior to revocation in
                                        reliance upon this authorization shall not constitute a breach of rights of the
                                        client. If not earlier revoked, this authorization will automatically expire
                                        twelve months from the date of signature. &nbsp; 3. The party named above to
                                        receive the information is not authorized to make any further release or
                                        disclosure of the information received. This authorization does not authorize
                                        the release or disclosure of any information except as provided herein. &nbsp;
                                        4. I grant to FICO HEROES, 6866 Pine Forest Road Ste C, Pensacola, Florida
                                        32526, authority to do, take and perform, all acts and things whatsoever
                                        requisite, proper, or necessary to be done, in the exercise of repairing my
                                        credit with the three credit reporting agencies, which are TransUnion, Experian,
                                        Equifax, and any other reporting agencies or creditor’s listed, as fully for all
                                        intents and purposes as I might or could do if personally present. &nbsp; 5. I
                                        hereby release&nbsp;FICO HEROES, 6866 Pine Forest Road Ste C, Pensacola, Florida
                                        32526, from all and all matters of actions, causes of action, suits,
                                        proceedings, debts, dues, contracts, judgments, damages, claims, and demands
                                        whatsoever in law or equity, for or by reason of any matter, cause, or thing
                                        whatsoever as based on the circumstances of this contract. <br><strong>Consumer
                                            Credit File Rights Under State and Federal Law</strong>
                                        <strong>&nbsp;</strong> You have a right to dispute inaccurate information in
                                        your credit report by contacting the credit bureau directly. However, neither
                                        you nor a credit repair company or credit repair organization has the right to
                                        have accurate, current and verifiable information removed from your credit
                                        report. The credit bureau must remove accurate, negative information from your
                                        report only if it is over 7 years old. Bankruptcy information can be reported
                                        for up to 10 years. &nbsp; You have a right to obtain a copy of your credit
                                        report from a credit bureau. You may be charged a reasonable fee. There is no
                                        fee, however, if you have been turned down for credit, employment, insurance, or
                                        a rental dwelling because of information in your credit report within the
                                        preceding 60 days. The credit bureau must provide someone to help you interpret
                                        the information in your credit file. You are entitled to receive a free copy of
                                        your credit report if you are unemployed and intend to apply for employment in
                                        the next 60 days, if you are a recipient of public welfare assistance, or if you
                                        have reason to believe that there is inaccurate information in your credit
                                        report due to fraud. &nbsp; You have a right to sue a credit repair organization
                                        that violated the Credit Repair Organization Act. This law prohibits deceptive
                                        practices by credit repair organizations. &nbsp; You have the right to cancel
                                        your contract with any credit repair organization for any reason within 5
                                        business days from the date you signed it. &nbsp; Credit bureaus are required to
                                        follow reasonable procedures to ensure that the information they report is
                                        accurate. However, mistakes may occur. &nbsp; You may, on your own, notify a
                                        credit bureau in writing that you dispute the accuracy of the information in
                                        your credit file. The credit bureau must then reinvestigate and modify or remove
                                        inaccurate or incomplete information. The credit bureau may not charge any fee
                                        for this service. Any pertinent information and copies of all documents you have
                                        concerning an error should be given to the credit bureau. &nbsp; If the credit
                                        bureau's reinvestigation does not resolve the dispute to your satisfaction, you
                                        may send a brief statement to the credit bureau to be kept in your file,
                                        explaining why you think the record is inaccurate. The credit bureau must
                                        include a summary of your statement about disputed information with any report
                                        it issues about you. &nbsp; The Federal Trade Commission regulates credit
                                        bureaus and credit repair organizations. For more information contact: The
                                        Public Reference Branch Federal Trade Commission Washington, D.C. 20580.<strong>&nbsp;&nbsp;</strong>
                                        <br>
                                        <p><strong>DISCLOSURE STATEMENT<br></strong><br>You may review your consumer
                                            reporting agency file at no charge if a request thereof is made to such<br>an
                                            agency within 30 days after receipt by you of notice that credit has been
                                            denied and if such a request is not made within the allotted time, you may
                                            be charged a fee to review your file.<br>You have the right to dispute the
                                            completeness or accuracy of any item contained in your file maintained by a
                                            consumer reporting agency.<br>FH services will include the following: the
                                            review, setup, and analysis of the Client’s credit report and the set-up of
                                            all inaccuracies identified by you in our system, allowing you access
                                            through our 24/7 web-based interface, create and mail dispute letters to
                                            challenge the inaccuracies you have identified to us. The First Work will be
                                            completed no later than 14 days after the date you enroll and you will not
                                            be billed until services&nbsp;are fully performed. The charge for the First
                                            Work Services will be no more than $139.00 for an individual&nbsp;Agreement
                                            and $249.00 for a Joint Agreement. Any Monthly Services will be billed after
                                            fully performed&nbsp;at a charge of $99.00 for an Individual Agreement and
                                            $149.00 for a Joint Agreement. Our past clients on average, elect to
                                            purchase five to six months of separate services.<br>See the Agreement for
                                            your pricing. Credit reporting agencies have no obligation to remove
                                            information from credit reports unless the information is erroneous, cannot
                                            be verified or is more than 7 years old. Credit reporting agencies have no
                                            obligation to remove information concerning bankruptcies unless such
                                            information is more than 10 years old. Accurate information cannot be
                                            permanently removed from the files of a consumer reporting agency. There may
                                            be the availability of nonprofit credit counseling services. You are hereby
                                            notified of your right to proceed against the Fico Heroes Surety Bond
                                            #H5280997 which has been purchased by Fico Hereos, LLC, Pensacola, Florida.
                                            The<br>name and address of the Surety Company which issued the bond is as
                                            follows: SureTec Insurance Company, Houston, Harrison County, Texas Total
                                            Payment Examples: Clients who choose to continue the Monthly Services for
                                            the following example number(s) will pay FH the following total amounts: (a)
                                            First Work - $139.00; (b) 1 Monthly Services - $238.00; (c) 2 Monthly
                                            Services - $337.00 (d) 4 Monthly Services - $535.00; (e) 6 Monthly Services
                                            - $733.00; (f) 8 Monthly Services - $931.00; (g) 10 Monthly Services -
                                            $1,129.00; (h) 12 Monthly Services - $1,327.00.<br><br></p>
                                        <p><strong>Individual Client Services Agreement</strong><br>No advance fees –
                                            Cancel Anytime</p>
                                        <ul>
                                            <li>$139.00 after the First Work is completed (you will be billed no sooner
                                                than 14 days after you enroll)
                                            </li>
                                            <li>$99.00 Monthly Fee billed after each month to month service is performed
                                                for the previous month
                                            </li>
                                        </ul>
                                        <p>You will only be billed by FH for the First Work and Monthly Services after
                                            they are fully completed as described below.&nbsp; No advance fees – Cancel
                                            Anytime<br><br><strong>A.</strong>&nbsp;This Credit Repair Service Contract
                                            (“Agreement”) is entered into, by and between Fico Hereos,<br>the
                                            undersigned "Client" (“you”) (refers to both Clients in case of a Joint<br>Agreement)
                                            and is for the purpose of purchasing credit report repair ("Services"). The
                                            Services will include the&nbsp;preparation of correspondence to credit
                                            bureaus to request the removal of errors, misrepresentations, or
                                            unverifiable information, which the Client states appear on the Client’s
                                            credit report(s). Federal law requires that any unverifiable, obsolete or
                                            erroneous information must be removed from consumer credit reports by the
                                            credit reporting agencies. FH agrees to use its best efforts to provide the
                                            Services, and will only perform them in accordance with federal and state
                                            laws.<br>This is not a debt consolidation or bill payment
                                            program.<br><br><strong>B.</strong>&nbsp;When FH receives a copy of your
                                            credit report from you, FH will draft and mail letter(s) as appropriate to
                                            the credit bureaus, creditors, or debt collectors in Client’s name and on
                                            Client’s behalf for any information the Client has directed FH to dispute to
                                            ensure the accuracy and compliance of the credit information. FH will not
                                            dispute accurate information within your credit reports.<br>Furthermore, FH
                                            is not attorneys and are not representing you in any legal capacity and
                                            is<br>otherwise not engaged in the practice of law. You will be charged only
                                            after the First Work Services<br>is fully completed and then after the
                                            Monthly Services is fully completed for each
                                            month.<br><br><strong>C.</strong>&nbsp;Our Services: There will be a “First
                                            Work Fee” of $139.00 for the First Work Services which will not be billed
                                            until all the services as described in Sec. D has been fully performed.
                                            After the First Work Services have been completed, FHI will perform the
                                            Monthly Services as described in Sec. E<br>After each Monthly Service has
                                            been fully performed, you will be billed a fee of $99.00 and this fee is for
                                            all services performed in the previous month. This process will continue
                                            until the Client cancels this contract.&nbsp;<br><br><strong>D.</strong>&nbsp;First
                                            Work Services: Will be completed no later than 14 days from the date this
                                            Agreement is executed and will include:</p>
                                        <ul>
                                            <li>The review, setup, and analysis of your credit report as provided by
                                                you
                                            </li>
                                            <li>The review of the items which you have identified to FH to be inaccurate
                                                and which you direct FH to attempt to correct on your credit report(s).
                                            </li>
                                            <li>Setup to receive all correspondence which may include emails, phone
                                                calls, and texts
                                            </li>
                                            <li>FH will create an online login for you with a client-specific user name
                                                and password for access to the&nbsp;<strong>Client Login through the
                                                    website www.ficoheroes.com.</strong></li>
                                            <li>Provide advice and information to you to build and maintain good credit
                                                as needed and when appropriate at the discretion of FH.
                                            </li>
                                            <li>Create and mail letters to challenge the information on your credit
                                                report which you have directed FH to work to correct which you believe
                                                is either inaccurate, unverifiable, questionable, or obsolete.
                                            </li>
                                        </ul>
                                        <p><br><strong>E</strong>. Monthly Services: When you elect to continue
                                            additional Monthly Services, the Monthly Services will<br>begin immediately
                                            after the First Work Services have been completed and will continue for a
                                            one month period and will include some or all the following:</p>
                                        <ul>
                                            <li>The analysis of 1 or more credit reports (as necessary and as provided
                                                by you)
                                            </li>
                                            <li>Updating Client’s secure interactive web portal and the continuous
                                                online access to the Client Login the area through&nbsp;www.ficoheroes.com.
                                            </li>
                                            <li>The review and analysis of any correspondence (responses) from the CRA’s
                                                (Credit Reporting
                                            </li>
                                            <li>Agencies) or creditors as provided by you.</li>
                                            <li>Creation of any additional documents (as needed) for the purpose of
                                                correcting inaccurate items on your credit reports
                                            </li>
                                            <li>Respond to, receive, and/or initiate correspondence via telephone,
                                                email, facsimile (as needed) regarding case status and strategy
                                            </li>
                                            <li>Sending you periodic emails regarding various topics such as credit
                                                education, status file updates, credit tips/hints
                                            </li>
                                            <li>Availability of an FH representative for phone consultation regarding
                                                file status and credit questions during normal business hours
                                            </li>
                                        </ul>
                                        <p><br>You will be billed after the Monthly Service is fully performed.&nbsp;
                                            FH’s services will continue for<br>additional monthly periods unless you
                                            elect to terminate this Agreement. Since the goals which the<br>Client
                                            desires may be reached in a single month, or after several months, it is
                                            determined by you to<br>elect to continue the services at the end of each
                                            month. FH can not accurately predict how long it may<br>take for the Client
                                            to reach their credit goals. However, most Clients on average elect to
                                            purchase five<br>to six months of separate Monthly Service, not to be billed
                                            in advance, with the Client having the<br>option to cancel this Agreement at
                                            any time.<br><br><strong>F.</strong>&nbsp; Fees, Billing, and Payment: FH
                                            never charges before services are fully performed. Fees are collected on a
                                            periodic basis but only for services previously provided. The First Work fee
                                            of $139.00 will be due and payable after completion of the First Work
                                            Services (Sec. D) and you will be billed no sooner than 14 calendar days
                                            from the date this Agreement is executed. The Monthly Service fee of $99.00
                                            will be due and payable at the end of each month’s services following the
                                            completion of the Monthly Services (Sec. E) for the preceding month.<br><br><strong>G.</strong>&nbsp;Non-Payment:
                                            If any form of payment you provide is uncollectible for any reason, FH may
                                            charge you a dishonored payment fee of $35.00. Should you be required to
                                            change the payment method, you must notify FH immediately, before the 3rd
                                            day in which you are scheduled to be billed. Any request to change a billing
                                            date is subject to the approval of FH. If any charge is not processed
                                            successfully on the date which it has been agreed to be paid, you agree that
                                            it can be charged each consecutive day until it has been successfully
                                            processed.</p>
                                        <p><strong>H.</strong>&nbsp;Term of Agreement and Cancellation: This contract
                                            continues month to month. You may cancel this<br>Agreement by giving us a
                                            thirty (30) day notice in writing. A cancellation request form can be
                                            requested at (support@ficoheroes.com). FH has the right to terminate this
                                            Agreement at any time.<br><br><strong>I.</strong>&nbsp; Guarantee: FH will
                                            perform the services described in this Agreement and to the extent in which
                                            FH fails to perform the services described herein; you shall be entitled to
                                            a refund of the preceding monthly service fee paid. FH cannot guarantee any
                                            specific outcome for the services provided and FH cannot guarantee that
                                            disputed items will be repaired or deleted. FH cannot predict, promise, or
                                            guarantee any specific credit score improvement or that you will be approved
                                            for new credit or loans based on the services by
                                            FH.<br><br><strong>J</strong>. Send FH the Responses: You agree to send all
                                            credit reports and/or correspondence received from any credit bureau and/or
                                            creditor to FH within five (5) days after the date received to ensure the
                                            success of this program or provide login credentials from one of our
                                            approved credit report affiliates. If you have not received any credit
                                            reports or correspondence from the credit bureaus within 60 days you must
                                            notify FH so appropriate actions can be taken. Non-compliance can result in
                                            termination of<br>this Agreement. After the review and analysis of any
                                            documentation sent to FH by you, FH may shred the documents and therefore,
                                            it is recommended that you do not send us the originals of any documents and
                                            always retain a copy for your own records.<br><br><strong>K.</strong>&nbsp;Remain
                                            Current on Your Financial Obligations: To maintain good credit you must pay
                                            your financial<br>obligations on time. You agree that you will pay any
                                            legally owed financial obligations on time and as<br>agreed and do not incur
                                            new debt which you cannot afford to pay back on time. If an inaccurate
                                            account is removed from your credit report, it does eliminate your
                                            obligation to pay a debt that is legally<br>owned by
                                            you.<br><br><strong>L.</strong>&nbsp;Limited Power of Attorney: By executing
                                            this Contract to obtain FICO Heroes' Services, Client grants during the term
                                            of this Contract, a limited power of attorney, by and through its authorized
                                            representatives, to 1) use the Customer Information that the Client provides
                                            in order to obtain from credit bureaus, creditors, collection agencies and
                                            other holders of records of Client's credit reports, Client's credit history
                                            or other creditor information for the Services; 2) sign correspondence to
                                            the record holders; 3) obtain credit information over the telephone, fax,
                                            and or through the internet from record-holders; 4) to discuss information&nbsp;with
                                            any record-holders to help resolve a debt, as such debt is reflected on
                                            Client’s credit report if mediation of a debt is necessary. FH acknowledges
                                            that its Authorized Representatives have been alerted to the sensitivity of
                                            the Customer Information. As such, FH will use its best efforts to ensure
                                            that Customer Information will be handled in a responsible and professional
                                            manner. The Customer shall have the right to revoke or terminate the limited
                                            power of attorney provided under this Contract at any time upon written
                                            notice to FH. Otherwise, the limited power of attorney shall terminate upon
                                            termination of this Contract. All questions pertaining to validity,
                                            interpretation, and administration of this Contract shall be determined in
                                            accordance with the laws of Florida. The client agrees that the Client's
                                            limited power of attorney is valid throughout the United States for all
                                            Customer Information to be obtained by FH pursuant to this Contract by the
                                            binding and enforceable signatures set forth below. This Agreement contains
                                            the entire agreement of the parties and there are no other promises or
                                            conditions in any other agreement whether oral or written. This Agreement
                                            supersedes any prior written or oral agreements between the parties.</p>
                                        <p><strong>M.</strong>&nbsp;The State of Florida registered agent for FICO
                                            HEROES LLC. is NSMART LLC.,<br>Pensacola, Florida
                                            32504.<br><br><strong>N.</strong>&nbsp;Sharing Information with Referral
                                            Partners: Client agrees that if they were referred to us by a mortgage
                                            broker, realtor, auto dealer or any other entity prior to Client hiring us,
                                            that Client gives us permission to send Client’s referring entity updates on
                                            Client’s account with FH and their credit file unless Client specifically
                                            says not to in writing.<br><br><strong>O.</strong>&nbsp;Repairing Your Own
                                            Credit: You understand that with the proper information you could undertake
                                            the same or similar techniques to repair your own credit and you are
                                            choosing to hire and utilize FH services to undertake the services outlined
                                            in this Agreement without duress or provocation.<br><strong><br>P.</strong>&nbsp;
                                            Hold Harmless: Client agrees to hold FH and its employees, officers,
                                            directors, agents and representatives harmless from any claim, suit action
                                            or demand made by any of Client’s creditors or any other person which may
                                            arise from the action(s) taken by any creditors in connection with any
                                            services rendered by FH on Client’s behalf. In the event FH engages in
                                            collection efforts, Client will be required to reimburse FH for
                                            out-of-pocket&nbsp;expenses as the result of such
                                            efforts.<br><br><strong>Q.</strong>&nbsp;Consent to Electronic and Voice
                                            Communication: Client consents to do business electronically with<br>electronic
                                            transactions, not limited to emails, are inherently un-secure and that<br>both
                                            Client and FH will take all reasonable steps to maintain the privacy of the
                                            information shared between the parties. Therefore, Client agrees that FH has
                                            no liability to Client whatsoever for any loss, claim, or damages arising or
                                            in any way related to responses to any electronic communication, upon which
                                            has in good faith relied. Client consents to receive any and all
                                            information, documents and<br>correspondence relating to this Agreement
                                            including disclosures, notices, updates, and amendments via electronic mail,
                                            text message, facsimile, voicemail, and any other common electronic means.
                                            The client has a right to receive a paper copy of any of these electronic
                                            records, if requested in writing, and if applicable law specifically
                                            requires us to provide such documentation. The client understands that all
                                            costs associated with the receipt, review, and use of such electronic
                                            communications shall be those of Client, such as maintaining access to the
                                            Internet or paying for text messages. Client consents to receive updates and
                                            documents relating to this Agreement and the services and programs offered b
                                            via prerecorded voice messages, text/SMS messages, and/or through the use of
                                            an automated dialing system to the cellular or other telephone numbers
                                            provided by Client. The client may contact FH at any time to opt-out of
                                            receiving updates, new programs or offers through prerecorded or auto-dialed
                                            messages. Consent to this section does not bind the Client to any future
                                            purchases of new services or offers.<br><br><strong>R.</strong>&nbsp;Surety
                                            Bond: You are hereby notified of your right to proceed against the FH Surety
                                            Bond<br>#5280997. The name and address of the Surety Company which issued
                                            the bond is as follows:<br>SureTec Insurance Company, Houston, Harris
                                            County, Texas.<br><br><strong>S.</strong>&nbsp; Arbitration Clause: In the
                                            event of any controversy, claim or dispute between the parties arising out
                                            of or relating to this Agreement or the breach, termination, enforcement,
                                            interpretation, conscionably or validity thereof, including any
                                            determination of the scope or applicability of this agreement to arbitrate,
                                            shall be determined by mandatory, binding arbitration in, State of Florida
                                            or in the county in which the<br>The client resides, in accordance with the
                                            laws of the local county for agreements to be made in and to be performed in
                                            the Client’s State. The parties agree that the arbitration shall be
                                            administered by the American Arbitration Association ("AAA") pursuant to its
                                            rules and procedures and an arbitrator shall be selected by the AAA. The
                                            arbitrator shall be neutral and independent and shall comply with the AAA
                                            code of ethics. The award rendered by the arbitrator shall be final and
                                            shall not be subject to vacation or modification. Judgment on the award made
                                            by the arbitrator may be entered in any court having jurisdiction over the
                                            parties. If either party fails to comply with the arbitrator's award, the
                                            injured party may petition the circuit court for enforcement. The parties
                                            agree that either party may bring claims against the other only in his/her
                                            or its individual capacity and not as a plaintiff or class member in any
                                            purported class or representative proceeding.</p>
                                        <p>Further, the parties agree that the arbitrator may not consolidate
                                            proceedings of more than one person's claims, and may not otherwise preside
                                            over any form of representative or class proceeding. The parties shall share
                                            the cost of arbitration equally. FH and the Client will each be responsible
                                            for paying their own attorneys’ fees regarding any disputes that may arise
                                            between the parties. In the event a party fails to proceed with arbitration,
                                            unsuccessfully challenges the arbitrator's award, or fails to comply with
                                            the arbitrator's award, the other party is entitled to costs of suit,
                                            including a reasonable attorney's fee for having to compel arbitration or
                                            defend or enforce the award. Binding Arbitration means that both parties
                                            give up the right to a trial by a jury or to use the court system except to
                                            enforce this section. It also means that both parties give up the right to
                                            appeal from the arbitrator’s ruling except for a narrow range of issues that
                                            can or may be appealed. It also means that discovery may be severely limited
                                            by the arbitrator. This section and the arbitration requirement shall
                                            survive any termination.<br><br><strong>T.</strong>&nbsp;This Agreement
                                            shall be governed by and construed according to the laws of the State of
                                            Florida.<br><br><strong>U.</strong>&nbsp;Privacy Policy: For an explanation
                                            of FH’ privacy policy see the enclosed document entitled “Privacy<br>Policy.”<br><br>
                                        </p>
                                        <p><strong>PRIVACY POLICY</strong><br>Your privacy is important to us. We DO NOT
                                            disclose any information about you to anyone, except as permitted by&nbsp;law.
                                            Access to your information is restricted to those employees who need to know
                                            that information to provide service to you. We maintain physical, electronic
                                            and procedural safeguards to protect this information. By law, your
                                            information is properly disposed of after the statute of limitations has
                                            expired.&nbsp;<br><br>WHY WE COLLECT PERSONAL INFORMATION:<br>We collect
                                            your personal information for several reasons, which all relate to providing
                                            you with the highest level of service possible and communication with you
                                            regarding our services. We also use your personal information to keep you
                                            updated about our latest service announcements, feature updates, special
                                            offers, and other information we think you might be interested in hearing
                                            about. And, as we continually strive to improve our services, we gather
                                            information to help us assess your needs and preferences.<br><br>WHAT
                                            PERSONAL INFORMATION WE COLLECT:<br>The information we collect directly from
                                            you includes your personal identification information required to perform
                                            our services and communication with you, including but not limited to, your
                                            name, birth date, social security number, drivers license number, mailing
                                            address, contact telephone numbers, fax number, e-mail address, employer
                                            name, and address, financial and account numbers, credit reports,
                                            credit-related score and reporting information, and debt
                                            information.<br><br>HOW WE COLLECT PERSONAL INFORMATION:<br>We directly
                                            collect information from you during the sign-up process, the information you
                                            provide, information that vendors and credit reporting agencies and
                                            creditors provide, and when we obtain and enter information from your credit
                                            reports into our database when corresponding with you via mail, email, phone
                                            or fax.<br><br>WHEN WE DISCLOSE PERSONAL INFORMATION:<br>We may share your
                                            personal information with our partners and affiliates if the information is
                                            required in order to provide our services.<br><br>HOW WE PROTECT YOUR
                                            PERSONAL INFORMATION:<br><br>Just as we encourage all of our clients to take
                                            every precaution possible to protect their own personal information while on
                                            the internet, we also employ numerous physical, electronic and operational
                                            procedures to ensure the security of our clients’ personal information. Our
                                            Privacy Policy is subject to change at any time.</p>
                                        <strong>Notice of Right to Cancel</strong>
                                        <strong>&nbsp;</strong><strong>&nbsp;</strong> <strong>You may cancel this
                                            contract, without any penalty or obligation, at any time before midnight of
                                            the 5th day which begins after the date the contract is signed by
                                            you.</strong> To cancel this contract, mail or deliver a signed, dated copy
                                        of this cancellation notice, or any other written notice to&nbsp;FICO HEROES,
                                        6866 Pine Forest Road Ste C, Pensacola, Florida 32526, before midnight on the
                                        5th day which begins after the date you have signed this contract stating ''I
                                        hereby cancel this transaction, (date) (purchaser’s signature)." &nbsp;<br>You,
                                        the buyer, may cancel this contract at any time before midnight of the fifth day
                                        after the date of the transaction. See the attached notice of cancellation form
                                        for an explanation of this right. You may cancel this contract without penalty
                                        or obligation at any time before midnight of the 5th business day after the date
                                        on which you signed the contract. See the attached notice of cancellation form
                                        for an explanation of this right.
                                        <p><strong>Notice of Cancellation Form<br></strong><br>You may cancel this
                                            contract, without any penalty or obligation, at any time before midnight<br>of
                                            the 5th day which begins after the date, the contract is signed by you.<br>If
                                            you cancel, any payment made by you under this contract will be returned
                                            within 10 days<br>after the date of receipt by the seller of your
                                            cancellation notice.<br>To cancel this contract, mail or deliver a signed,
                                            dated copy of this cancellation notice, or<br>any other written notice to
                                            Fico Heroes, 6866 Pine Forest Road, Pensacola, FL 32526.<br>before midnight
                                            on 05/02/2020 -<br><br>I hereby cancel this transaction, because of:<br><br><br><br>Date
                                            ______________<br><br>Client’s signature ________________________<br><br>Client’s
                                            printed name ________________________<br><br><strong>DO NOT sign this Notice
                                                of Cancellation unless you are canceling the contract.<br><br></strong>********************************************************************************************************************
                                        </p>
                                        <p><strong>Notice of Cancellation</strong><br><br>You may cancel this contract,
                                            without any penalty or obligation, at any time before midnight<br>of the 5th
                                            day which begins after the date, the contract is signed by you.<br>If you
                                            cancel, any payment made by you under this contract will be returned within
                                            10 days<br>after the date of receipt by the seller of your cancellation
                                            notice.<br>To cancel this contract, mail or deliver a signed, dated copy of
                                            this cancellation notice, or<br>any other written notice to Fico Heroes,
                                            6866 Pine Forest Road, Pensacola, FL 32526.<br>before midnight on
                                            ____________.<br><br>I hereby cancel this transaction, because
                                            of:<br><br><br><br>Date ______________<br><br>Client’s signature
                                            ________________________<br><br>Client’s printed name
                                            ________________________<br><br><strong>DO NOT sign this Notice of
                                                Cancellation unless you are canceling the contract</strong>.</p>
                                        &nbsp; <strong>Acknowledgment of Receipt of Notice</strong>
                                        <strong>&nbsp;</strong><strong>&nbsp;</strong>I, Lawrence Jernigan,&nbsp; hereby
                                        acknowledge with my digital signature, receipt of two sets of Notice of Right to
                                        Cancel. I confirm the fact that I agree and understand what I am signing, and
                                        acknowledge that I have received a copy of my Consumer Credit File Rights.
                                        <p><strong>*Digital Signatures:</strong>&nbsp;In 2000, the U.S. Electronic
                                            Signatures in Global and National Commerce (ESIGN) Act established
                                            electronic records and signatures as legally binding, having the same legal
                                            effects as traditional paper documents and handwritten signatures. Read more
                                            at the FTC web site:&nbsp;<a href="http://www.ftc.gov/os/2001/06/esign7.htm"
                                                                         target="_blank">http://www.ftc.gov/os/2001/06/esign7.htm</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-md-12">
                                    <div class="work_nore">
                                        <h6>Signature</h6>
                                        <p> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p>
                                    </div>
                                </div>
                                <div class=" col-md-6">
                                    <label for="comp_rep_approval">Customer Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="comp_rep_approval"
                                           id="comp_rep_approval" placeholder=""/>

                                    <div class="sigPad" id="smoothed" style="width:404px;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="CustomerSign" width="400" height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveSignatureDB" name="customer_sign">
                                    <label>CUSTOMER SIGNATURE </label>

                                </div>
                                <div class=" col-md-6">
                                    <label for="technician_printed_name">Technician Printed Name</label>
                                    <input type="text" class="form-control mb-3" name="technician_printed_name"
                                           id="technician_printed_name" placeholder=""/>

                                    <div class="sigPad" id="smoothed2" style="width:404px;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="TechnicianSign" width="400" height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveTechnicianSignatureDB" name="technician_sign">
                                    <label>TECHNICIAN SIGNATURE </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-12">
                                    <label for="note_to_admin">Note to Admin</label>
                                    <textarea name="note_to_admin" id="note_to_admin" class="form-control" col="2"
                                              row="1"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="button" onClick="validatecard();" class="btn btn-flat btn-primary">
                                        Submit
                                    </button>
                                    <a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancel this</a>
                                </div>
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
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Add Selected</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<?php include viewPath('includes/footer'); ?>

<script>
    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }

    $(document).ready(function () {

        // phone type change, add the value to hiddend field and show the text
        $(document.body).on('click', '.changePhoneType', function () {
            $(this).closest('.phone-input').find('.type-text').text($(this).text());
            $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
        });
    });
</script>