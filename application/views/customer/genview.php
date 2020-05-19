<?php

defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php include viewPath('includes/header'); ?>

    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/customer'); ?>

        <div wrapper__section>
            <?php if (!empty($customer)) { ?>
                <div class="custom__div">
                    <div class="card">
                        <div class="container-fluid" style="font-size:16px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1><?php echo $customer->contact_name ?></h1>
                                </div>
                                <div class="col-sm-12 text-right">
                                    <div class="h1-spacer">
                                        <a class="a-hunderline"
                                           href="<?php echo base_url('customer') ?>"> <span
                                                    class="fa fa-angle-left fa-size-md"></span> Return to Customers</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tabs">
                                <ul class="clearfix nav nav-tabs" id="myTab" role="tablist">
                                    <li class="active"><a class="nav-link active" id="tab1" data-toggle="tab"
                                                          href="#tab1" role="tab" aria-controls="tab1"
                                                          aria-selected="true">Customer Details</a></li>
                                    <li>
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                           role="tab" aria-controls="profile" aria-selected="false">Files</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                           role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                           role="tab" aria-controls="contact" aria-selected="false">Notes</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#tab5" role="tab"
                                           aria-controls="tab5" aria-selected="false">Activity Log</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                    <div class="row margin-bottom-sec">
                                        <div class="col-auto">
                                            <div style="padding-top: 6px; padding-left: 10px;">View customer info.</div>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <div class="btn-group" role="group" aria-label="...">
                                                <a class="btn btn-default"
                                                   href="<?php echo base_url('customer/edit/' . $customer->id) ?>">
                                                    <span class="fa fa-edit">
                                                    </span> Edit</a>
                                                <a class="btn btn-default"
                                                   href="<?php echo base_url('workorder/add/?customer_id=' . $customer->id) ?>">
                                                    <span class="fa fa-file-text-o"></span> Create Work Order</a>
                                                <a class="btn btn-default" href=""><span class="fa fa-money"></span>
                                                    Create Invoice</a>
                                                <a class="btn btn-default" href="#" data-add-estimate-modal="open"><span
                                                            class="fa fa-file-text-o"></span> Create Estimate</a>
                                                <a class="btn btn-default zestimate" data-zestimate-modal="open"
                                                   data-address="4474 Woodbine Road" data-zip="32571" href="#"><span
                                                            class="fa fa-home"></span> Zestimate</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel-info">
                                                <div class="margin-bottom">
                                                    <div class="customer-avatar">
                                                        <img class="customer-avatar-img"
                                                             src="<?php echo base_url('assets/img/customer_sm.png') ?>">
                                                        <?php echo $customer->contact_name ?> &nbsp;
                                                        <!--                                                        <span class="badge badge-secondary">commercial </span>-->
                                                        <br><?php echo $customer->contact_email ?>
                                                        <br>
                                                        <a href="<?php echo base_url('customer/edit/' . $customer->id) ?>">
                                                            Edit
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="margin-bottom">
                                                    <b>Primary Contact</b><br>
                                                    <?php echo $customer->contact_email ?>
                                                    <br>Greg Scherer
                                                    <br>Mobile: <?php echo (!empty($customer->mobile))
                                                        ? $customer->mobile : '' ?>
                                                    <br>Preferred notification method:
                                                    <?php if (is_array($customer->notification_method)) { ?>
                                                        <?php echo implode(', ', $customer->notification_method) ?>
                                                    <?php } else { ?>
                                                        Email, SMS
                                                    <?php } ?><br>
                                                </div>
                                                <div class="margin-bottom">
                                                    <b>Billing Address</b><br>
                                                    <?php echo $customer->street_address ?>
                                                </div>
                                                <div class="margin-bottom">
                                                    <b>Additional Contacts</b><br>
                                                    <ul class="list-secondary">
                                                        <?php if (!empty($customer->additional_contacts)) { ?>
                                                            <?php foreach ($customer->additional_contacts as $contact) { ?>
                                                                <?php echo $contact['name'] ?><br>
                                                                <?php echo $contact['email'] ?><br>
                                                                <?php if (!empty($contact->phone_secondary)) { ?>
                                                                    <?php echo $contact['phone_secondary'] ?>
                                                                <?php } ?>

                                                                <!-- NOTES -->
                                                                <?php if (!empty($contact->notes)) { ?>
                                                                    <p><?php echo $contact['notes'] ?></p>
                                                                <?php } ?>

                                                            <?php } ?>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <div class="margin-bottom">
                                                    <b>Service Addresses</b><br>
                                                    <ul class="list-secondary"></ul>
                                                </div>
                                                <div class="margin-bottom">
                                                    <b>Additional Details</b><br>
                                                    <?php if (!empty($customer->additional_info)) { ?>
                                                        <?php if (is_array($customer->additional_info)) { ?>

<!--                                                            --><?php //foreach ($customer->additional_info as $key=>$value) { ?>
<!---->
<!--                                                                <div>-->
<!--                                                                    <small>--><?php //echo $key ?><!--</small>-->
<!--                                                                    <strong>--><?php //echo $value ?><!--</strong>-->
<!--                                                                </div>-->
<!--                                                                <br>-->
<!---->
<!--                                                            --><?php //} ?>

                                                        <?php } else { ?>
                                                            <?php echo $customer->additional_info ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                                <div class="margin-bottom"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div style="background: #fff; padding: 0px 0px 0 0px; margin-bottom: 30px;">
                                                <div class="bold" style="margin-bottom: 5px;">Invoices Summary</div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div style="font-size: 14px; color: #888;">TOTAL</div>
                                                                <div style="font-size: 24px;">$389.98</div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div style="font-size: 14px; color: #888;">PENDING</div>
                                                                <div style="font-size: 24px;">$0.00</div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div style="font-size: 14px; color: #888;">PAID</div>
                                                                <div style="font-size: 24px;">$389.98</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="margin-bottom">
                                                <div class="bold">Work Orders</div>
                                                <div class="margin-top-sec margin-bottom-sec">Total: 1 work orders <span
                                                            class="middot">·</span> <a
                                                            href="https://www.markate.com/pro/work_orders/main?bc_id=355775">view
                                                        all</a></div>
                                                <div class="margin-top-sec margin-bottom-sec">Latest Work Orders</div>
                                                <div class="row margin-bottom-sec">
                                                    <div class="col-sm-4">
                                                        <a class="a-default"
                                                           href="<?php echo base_url('workorder/view/') ?>">
                                                            <span class="fa fa-file-text-o"></span> &nbsp;
                                                            WO-00064</a></div>
                                                    <div class="col-sm-4">All About Guns &amp; Ammo</div>
                                                    <div class="col-sm-4">Invoiced</div>
                                                </div>
                                                <a class="btn btn-primary btn-md margin-top-sec"
                                                   href="<?php echo base_url('workorder/add') ?>">Create
                                                    Work Order</a>
                                            </div>

                                            <hr>

                                            <div class="margin-bottom">
                                                <div class="bold">Schedule</div>
                                                <div class="margin-top-sec margin-bottom-sec">
                                                    Total: 2 events &nbsp; | &nbsp;
                                                    Last service date:
                                                    Thursday, 31 Oct 2019, 12:00 pm ·
                                                    <a href="">view</a>
                                                </div>
                                                <div class="margin-top-sec margin-bottom-sec">Upcoming Events</div>
                                            </div>

                                            <hr>

                                            <div class="margin-bottom">
                                                <div class="bold">Invoices &amp; Payments</div>
                                                <div class="margin-top-sec margin-bottom-sec">Total: 1 invoices <span
                                                            class="middot">·</span> <a class="a-ter-v1"
                                                                                       href="https://www.markate.com/pro/track/invoices/index?bc_id=355775">view
                                                        all</a></div>
                                                <div class="margin-top-sec margin-bottom-sec">Latest Invoices</div>
                                                <div class="row margin-bottom-sec">
                                                    <div class="col"><a class="a-default" href=""><span
                                                                    class="fa fa-file-text-o"></span> &nbsp; INV-000053</a>
                                                    </div>
                                                    <div class="col">All About Guns &amp; Ammo</div>
                                                    <div class="col">$389.98</div>
                                                    <div class="col">Paid</div>
                                                </div>
                                                <a class="btn btn-primary btn-md margin-top-sec"
                                                   href="<?php echo base_url('invoice/create/') ?>">Create
                                                    Invoice</a>
                                            </div>

                                            <hr>

                                            <div class="margin-bottom">
                                                <div class="bold">Estimates</div>
                                                <p class="margin-bottom-sec">No estimates for this customer.</p>
                                                <a class="btn btn-primary btn-md margin-top-sec"
                                                   href="<?php echo base_url('estimate/create/') ?>"
                                                   data-add-estimate-modal="open">Create Estimate</a>
                                            </div>

                                            <hr>

                                            <div class="margin-bottom">
                                                <div class="bold">Deal Bookings</div>
                                                <p class="margin-bottom-sec">No deal bookings for this customer.</p>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="card">
                                        <div class="row margin-bottom-sec">
                                            <div class="col-sm-12">
                                                <div class="text-lg">Customer Files Vault</div>
                                            </div>
                                            <div class="col-sm-12 text-right"><a class="btn btn-primary btn-md"
                                                                                 href="https://www.markate.com/pro/customers/files_vault/add/business_customer_id/355775"><span
                                                            class="fa fa-plus"></span> Add File</a></div>
                                        </div>
                                        <div class="page-empty-container">
                                            <p class="text-ter margin-bottom">No files<br>Customer Vault lets you
                                                retain, hold, view, and attach files to a customer.</p>
                                            <a class="btn btn-primary"
                                               href="https://www.markate.com/pro/customers/files_vault/add/business_customer_id/355775"><span
                                                        class="fa fa-plus fa-margin-right"></span> Add file</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact-tab" role="tabpanel" aria-labelledby="tab3">
                                    <div class="card">
                                        <div class="row margin-bottom-sec">
                                            <div class="col-sm-12">Emails sent to customer.</div>
                                            <div class="col-sm-12 text-right">
                                                <a class="btn btn-primary btn-md"
                                                   href="https://www.markate.com/pro/customers/emails/send/business_customer_id/355775"><span
                                                            class="fa fa-plus fa-margin-right"></span> Send Email</a>
                                            </div>
                                        </div>
                                        <p class="text-ter margin-bottom">No emails</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact-tab2" role="tabpanel" aria-labelledby="tab4">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="margin-bottom-sec">
                                                Notes left for this customer.
                                            </div>
                                            <div class="notes-input">
                                                <form name="message-form" data-notes="form" method="post">
                                                    <div class="validation-error hide"></div>
                                                    <div class="notes-input__text">
                                                        <textarea class="form-control" placeholder="Write a message..."
                                                                  required="" maxlength="1500"></textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-primary notes-btn-submit"
                                                                    name="notes-btn-submit" type="submit"
                                                                    data-notes="btn-add"
                                                                    data-on-click-label="Add Note...">Add Note
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-12 text-right"><span class="help help-sm">max 1500 chars per note</span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <ul class="notes-list" data-notes="list"></ul>
                                            <div class="text-center margin-top">
                                                <a class="btn btn-default" data-notes="btn-paginator" href="#"
                                                   data-on-click-label="Loading..." style="display: none;">Load more
                                                    notes</a>
                                            </div>

                                            <script async=""
                                                    src="https://www.google-analytics.com/analytics.js"></script>
                                            <script type="text/template" data-notes="template">
                                                <li class="note__item" data-note-id="{{id}}">
                                                    <div class="note__cnt">
                                                        <span class="note__date">{{datetime_added_text}}</span>
                                                        <div class="note__message__cnt">
                                                            <div class="note__message__line">
                                                                <div class="note__message">{{message}}</div>
                                                            </div>
                                                        </div>
                                                        <a class="note__delete" data-delete-modal="open"
                                                           data-id="{{id}}" href="#"><span
                                                                    class="fa fa-trash"></span></a>
                                                    </div>
                                                </li>
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5">...</div>

                            </div>
                        </div>
                        <div class="margin-top">
                            <a class="a-hunderline" href="https://www.markate.com/pro/track/customers/index/tab/1"><span
                                        class="fa fa-angle-left fa-size-md"></span>Return to Customers</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


<?php include viewPath('includes/footer'); ?>