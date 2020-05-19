<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">
<!-- page wrapper start -->
<div class="wrapper">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="page-title">New Customer</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Add your new customer.</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                <a href="<?php echo base_url('customer') ?>" class="btn btn-primary" aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Go Back to Customer
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <?php echo form_open_multipart('customer/update/' . $customer->id, ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>
        <style>

        </style>
        <div class="row custom__border">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Basic Customer Info</h3>
                            </div>
                            <div class="col-md-12 margin-bottom-ter no-padding">
                                <div class="form-group" id="customer_type_group">
                                    <label for="">Customer Type</label><br />
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                        <input type="radio" name="customer_type" value="Residential" id="customer_type" <?php echo (!empty($customer->customer_type) && $customer->customer_type == 'Residential') ? 'checked' : ''; ?> onchange="toggle_advance_options()">
                                        <label for="customer_type"><span>Residential</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-3">
                                        <input type="radio" name="customer_type" value="Commercial" id="Commercial" <?php echo (!empty($customer->customer_type) && $customer->customer_type == 'Commercial') ? 'checked' : ''; ?> onchange="toggle_advance_options()">
                                        <label for="Commercial"><span>Commercial</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right my-0">
                                        <input type="radio" name="customer_type" value="Advance" id="advance" <?php echo (!empty($customer->customer_type) && $customer->customer_type == 'Advance') ? 'checked' : ''; ?> onchange="toggle_advance_options()">
                                        <label for="advance"><span>Advance</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="contact_name">Contact Name</label>
                                <input type="text" class="form-control" value="<?php echo $customer->contact_name ?>" name="contact_name" id="contact_name" required placeholder="Enter Name" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="contact_email">Contact Email</label>
                                <input type="email" class="form-control" value="<?php echo $customer->contact_email ?>" name="contact_email" id="contact_email" placeholder="Enter Email" required />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="contact_mobile">Mobile</label>
                                <input type="text" class="form-control" value="<?php echo $customer->mobile ?>" name="contact_mobile" id="contact_mobile" placeholder="Enter Mobile" required />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="contact_phone">Phone</label>
                                <input type="text" class="form-control" value="<?php echo $customer->phone ?>" name="contact_phone" id="contact_phone" placeholder="Enter Phone" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-auto form-group">
                                <label for="">Preferred notification method</label><br />
                                <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                    <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email" <?php echo (!empty($customer->notification_method) && $customer->notification_method == 'Email') ? 'checked' : ''; ?>>
                                    <label for="notify_by_email"><span>Notify By Email</span></label>
                                </div>
                                <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                    <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms" <?php echo (!empty($customer->notification_method) && $customer->notification_method == 'SMS') ? 'checked' : ''; ?>>
                                    <label for="notify_by_sms"><span>Notify By SMS/Text</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Additional Contacts</h3>
                                <p>Add other contacts for this customer.</p>
                                <div id="additional_contacts_container">
                                    <ul class="customer-contact-list" data-customer-contact="list">
                                        <?php if (!empty($customer->additional_contacts)) { ?>
                                            <?php foreach ($customer->additional_contacts as $key => $additionalContact) { ?>
                                                <li class="customer-contact-list__item">
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-6">
                                                            <div class="customer-contact-list__item-name">
                                                                <?php echo $additionalContact['name'] ?></div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-6">
                                                            <?php echo $additionalContact['email'] ?> </div>
                                                        <div class="col-md-4 col-sm-8">
                                                            <?php echo $additionalContact['phone'] ?> </div>
                                                        <div class="col-md-2 col-sm-4 text-right">
                                                            <a class="customer-contact-list__edit" data-toggle="modal" data-target="#modalAdditionalContacts" data-customer-id="<?php echo $customer->id ?>" data-id="<?php echo $key ?>" href="javascript:void(0)"><span class="fa fa-edit"></span> edit</a>
                                                            <a class="customer-contact-list__delete" data-customer-contact-delete-modal="open" data-customer-id="<?php echo $customer->id ?>" data-id="<?php echo $key ?>" href="javascript:void(0)"><span class="fa fa-trash"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <a class="link-modal-open" data-customer-id="<?php echo $customer->id; ?>" data-id="-1" href="javascript:void(0)" data-toggle="modal" data-target="#modalAdditionalContacts"><span class="fa fa-plus-square fa-margin-right"></span> Add New Contact</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Billing Address </h3>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="street_address">Street Address</label>
                                <input type="text" class="form-control" value="<?php echo $customer->street_address ?>" name="street_address" id="street_address" required placeholder="Enter Name" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="suite_unit">Suite/Unit</label>
                                <input type="text" class="form-control" value="<?php echo $customer->suite_unit ?>" name="suite_unit" id="suite_unit" required placeholder="Enter Name" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" value="<?php echo $customer->city ?>" name="city" id="city" required placeholder="Enter Name" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="zip">Zip/Postal Code</label>
                                <input type="text" class="form-control" value="<?php echo $customer->postal_code ?>" name="zip" id="zip" required placeholder="Enter Name" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="state">State/Province</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="" selected="selected">- select -</option>
                                    <?php foreach (get_config_item('states') as $key => $state) { ?>
                                        <?php if ($customer->state == $key) { ?>
                                            <option value="<?php echo $key ?>" selected><?php echo $state; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $state; ?></option>
                                        <?php } ?>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Service Addresses</h3>
                                <p>Optional, create a list of service addresses, only if different than billing addresses.</p>
                                <div id="service_address_container">
                                    <ul class="customer-address-list">
                                        <?php if (!empty($customer->service_address)) { ?>
                                            <?php foreach ($customer->service_address as $key => $serviceAddress) { ?>
                                                <li class=" customer-address-list__item">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <span class="customer-address-list__item-name">
                                                                <?php echo $serviceAddress['address'] ?>, <?php echo $serviceAddress['address_secondary'] ?> <br>
                                                                <?php echo $serviceAddress['city'] ?>, <?php echo $serviceAddress['zip'] ?>, <?php echo $serviceAddress['state'] ?> </span>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <?php echo $serviceAddress['name'] ?><br> <?php echo $serviceAddress['email'] ?>, <?php echo $serviceAddress['phone'] ?> </div>
                                                        <div class="col-md-2 text-right">
                                                            <a class="customer-address-list__edit" data-toggle="modal" data-target="#modalServiceAddress" data-customer-id="<?php echo $customer->id ?>" data-id="<?php echo $key ?>" href="javascript:void(0)"><span class="fa fa-edit"></span> edit</a>
                                                            <a class="customer-address-list__delete" data-customer-id="<?php echo $customer->id ?>" data-id="<?php echo $key ?>" href="javascript:void(0)"><span class="fa fa-trash"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <a class="link-modal-open" data-customer-id="<?php echo $customer->id; ?>" data-id="-1" href="javascript:void(0)" data-toggle="modal" data-target="#modalServiceAddress"><span class="fa fa-plus-square fa-margin-right"></span> Add New Address</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Additional Details</h3>
                            </div>
                            <div class="col-md-5 form-group">
                                <label for="birthday">Birthday</label>
                                <!-- <input type="text" class="form-control" value="<?php echo $customer->birthday ?>" name="birthday" id="birthday" required placeholder="Enter Name" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->

                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" class="form-control" name="birthday" id="birthday" value="<?php echo date('m/d/Y', strtotime($customer->birthday)) ?>">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 form-group">
                                <label for="customer_source">Customer Source</label>
                                <select id="customer_source" name="customer_source_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                    <option value="0">- none -</option>
                                </select>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="notes">Comments <small>(some remarks for internal use)</small></label>
                                <textarea name="notes" cols="40" rows="3" class="form-control" autocomplete="off"><?php echo $customer->comments ?></textarea>
                            </div>
                        </div>




                        <div class="row" id="advance_customer_view" style="display: <?php echo ( (!empty($customer->customer_type) && $customer->customer_type !== 'Advance') )  ? 'none' : 'block' ?>">

                            <div class="row p-3">
                                <div class="col-md-12">
                                    <h3>Account Information</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="monitoring_id">Monitoring ID</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['monitoring_id'] : '' ?>" class="form-control" name="additional[monitoring_id]" id="monitoring_id" placeholder="Monitoring ID" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="signal_confirmation_number">Signals Confirmation Number</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['signal_confirmation_number'] : '' ?>" class="form-control" name="additional[signal_confirmation_number]" id="signal_confirmation_number" placeholder="Enter Signals Confirmation Number" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="monitoring_confirmation">Monitoring Confirmation</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['monitoring_confirmation'] : '' ?>" class="form-control" name="additional[monitoring_confirmation]" id="monitoring_confirmation" placeholder="Enter Monitoring Confirmation" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="customer_language">Language</label>
                                    <select id="customer_language" name="additional[customer_language]" class="form-control" placeholder="Select Language" disabled>
                                        <option value="1">English</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="abort_code">Abort Code</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['abort_code'] : '' ?>" class="form-control" name="additional[abort_code]" id="abort_code" placeholder="Enter Abort Code" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-md-6 form-group">
                                    <label for="sales_rep">Sales Representative</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['sales_rep'] : '' ?>" class="form-control" name="additional[sales_rep]" id="sales_rep" placeholder="Enter Sales Representative" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="sales_rep_phone">Representative Phone Number</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['sales_rep_phone'] : '' ?>" class="form-control" name="additional[sales_rep_phone]" id="sales_rep_phone" placeholder="Enter Phone Number" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="technician">Technician</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['technician'] : '' ?>" class="form-control" name="additional[technician]" id="technician" placeholder="Enter Technician" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="technician_phone">Technician Phone Number</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['technician_phone'] : '' ?>" class="form-control" name="additional[technician_phone]" id="technician_phone" placeholder="Enter Technician Phone Number" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-md-4 form-group">
                                    <label for="install_date">Install Date</label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" value="<?php echo (!empty($customer->additional_info['install_date'])) ? date('m/d/Y', strtotime($customer->additional_info['install_date'])) : '' ?>" class="form-control" name="additional[install_date]" id="install_date" disabled>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div data-calendar="time-end-container">
                                        <label for="technician_arrival_time">Technician Arrival Time</label>
                                        <div class="form-group">
                                            <div class='input-group date timepicker'>
                                                <input type='text' value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['technician_arrival_time'] : '' ?>" name="additional[technician_arrival_time]" class="form-control" id="technician_arrival_time" disabled />
                                            </div>
                                        </div>
                                        <span class="validation-error-field" data-formerrors-for-name="time_end" data-formerrors-message="true" style="display: none;"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div data-calendar="time-end-container">
                                        <label for="technician_departure_time">Technician Departure Time</label>
                                        <div class="form-group">
                                            <div class='input-group date timepicker'>
                                                <input type='text' value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['technician_departure_time'] : '' ?>" name="additional[technician_departure_time]" class="form-control" id="technician_departure_time" disabled />
                                            </div>
                                        </div>
                                        <span class="validation-error-field" data-formerrors-for-name="time_end" data-formerrors-message="true" style="display: none;"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="panel_type">Panel Type</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['panel_type'] : '' ?>" class="form-control" name="additional[panel_type]" id="panel_type" placeholder="Enter Panel Type" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="system_type">System Type</label>
                                    <input type="text" value="<?php echo (!empty($customer->additional_info)) ? $customer->additional_info['system_type'] : '' ?>" class="form-control" name="additional[system_type]" id="system_type" placeholder="Enter System Type" onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled />
                                </div>
                            </div>


                            <div class="row p-3">
                                <div class="col-md-12">
                                    <h3>Credit Card Information</h3>
                                </div>
                                <div class=" col-md-12">
                                    Credit Card Type:
                                    <div class="checkbox checkbox-sec card-types margin-right mr-4">
                                        <input type="radio" name="card[radio_credit_card]" value="Visa" <?php echo ((!empty($customer->card_info)) && $customer->card_info['radio_credit_card']=='Visa') ? 'checked' : '' ?> id="radio_credit_card" disabled>
                                        <label for="radio_credit_card"><span>Visa</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="card[radio_credit_card]" value="Amex" <?php echo ((!empty($customer->card_info)) && $customer->card_info['radio_credit_card']=='Amex') ? 'checked' : '' ?> id="radio_credit_cardAmex" disabled>
                                        <label for="radio_credit_cardAmex"><span>Amex</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="card[radio_credit_card]" value="Mastercard" <?php echo ((!empty($customer->card_info)) && $customer->card_info['radio_credit_card']=='Mastercard') ? 'checked' : '' ?> id="radio_credit_cardMastercard" disabled>
                                        <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                        <input type="radio" name="card[radio_credit_card]" value="Discover" <?php echo ((!empty($customer->card_info)) && $customer->card_info['radio_credit_card']=='Visa') ? 'Discover' : '' ?> id="radio_credit_cardMasterDiscover" disabled>
                                        <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                                    </div>

                                </div>
                                <div class=" col-md-12">
                                    <div class="row" style="border:none; margin-bottom:20px; padding-bottom:0px;">
                                        <div class=" col-md-6">
                                            <label for="card_no">Card Number</label>
                                            <input type="text" value="<?php echo (!empty($customer->card_info)) ? $customer->card_info['card_no'] : '' ?>" class="form-control card-number required" name="card[card_no]" id="card_no" placeholder="" required disabled />
                                        </div>
                                        <div class="col-md-2">
                                            <label class='form-label'>Expiration Month</label>
                                            <input value="<?php echo (!empty($customer->card_info)) ? $customer->card_info['exp_month'] : '' ?>" class='form-control card-expiry-month required' name="card[exp_month]" maxlength="256" placeholder='MM' size='2' min="1" max="12" value="" type='number' required disabled />
                                        </div>
                                        <div class=" col-md-2">
                                            <label for="exp_date">Expiration year</label>
                                            <input type="text" value="<?php echo (!empty($customer->card_info)) ? $customer->card_info['exp_date'] : '' ?>" class="form-control card-expiry-year required" name="card[exp_date]" id="exp_date" min="<?php echo date('Y') ?>" max="<?php echo date('Y') + 50 ?>" placeholder="" required disabled />
                                        </div>
                                        <div class=" col-md-2">
                                            <label for="cvv">CVV#</label>
                                            <input type="text" value="<?php echo (!empty($customer->card_info)) ? $customer->card_info['cvv'] : '' ?>" class="form-control card-cvc required" name="card[cvv]" id="cvv" placeholder="" required disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-4 form-group">
                                <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                <a href="<?php echo url('customer') ?>" class="btn btn-danger">Cancel this</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>

        <?php echo form_close(); ?>

        <!-- Modal Service Address -->
        <div class="modal fade" id="modalServiceAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Additional Contact -->
        <div class="modal fade" id="modalAdditionalContacts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalAddNewSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_add_new_source" name="modal-form" method="post">
                            <div class="validation-error" style="display: none;"></div>
                            <div class="form-group">
                                <label>Source Name</label> <span class="form-required">*</span>
                                <input type="text" name="source_name" value="" class="form-control" autocomplete="off">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
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

    $(document).ready(function() {

        // $("#customer_source").select2().select2('val', 1);
        $('#customer_source')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val("<?php echo $customer->source_id ?>") //set value for option to post it
                .text("<?php echo $customer->source->source_name ?>")) //set a text for show in select
            .val("<?php echo $customer->source_id ?>") //select option of select2
            .trigger("change"); //apply to select2
    });
</script>