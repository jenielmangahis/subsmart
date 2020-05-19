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

                                    <div class="row customer-data">
                                        <div class="col-lg-6">
                                            <div class="customer-inner">
                                                <div class="heading">
                                                    <h6>Address Information</h6>
                                                </div>
                                                <div class="customer-field">
                                                    <div class="customer-wrapper">
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Sales Area</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>Corporate</h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Customer Full Name</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6><?php echo $customer->contact_name ?></h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Customer Date of Birth </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6><?php echo date('m d, Y', strtotime($customer->birthday)) ?></h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Company</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <?php if (!empty($customer->company)) { ?>
                                                                            <h6><?php echo $customer->company->b_name ?></h6>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info spacer">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Address</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6><?php echo $customer->street_address ?></h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--  address info second part-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Cross street</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <?php if (!empty($customer->suite_unit)) { ?>
                                                                            <h6><?php echo $customer->suite_unit; ?></h6>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Subdivison</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>City State Zip</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>
                                                                            <?php if (!empty($customer->city)) { ?>
                                                                                <?php echo $customer->city ?>
                                                                            <?php } ?>
                                                                            <?php if (!empty($customer->state)) { ?>
                                                                                , <?php echo $customer->state ?>
                                                                            <?php } ?>
                                                                            <?php if (!empty($customer->zip)) { ?>
                                                                                , <?php echo $customer->zip ?>
                                                                            <?php } ?>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--                                    <div class="field-info">-->
                                                        <!--                                        <div class="row">-->
                                                        <!--                                            <div class="col-lg-6">-->
                                                        <!--                                                <div class="field-heading"><h6>Country</h6></div>-->
                                                        <!--                                            </div>-->
                                                        <!--                                            <div class="col-lg-6">-->
                                                        <!--                                                <div class="field-text"><h6>Escambia</h6></div>-->
                                                        <!--                                            </div>-->
                                                        <!--                                        </div>-->
                                                        <!--                                    </div>-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Country</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <?php if (!empty($customer->country)) { ?>
                                                                            <h6><?php echo $customer->country ?></h6>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Home/Panel Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <?php if (!empty($customer->phone)) { ?>
                                                                            <h6><?php echo $customer->phone ?></h6>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Cell Phone</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <?php if (!empty($customer->mobile)) { ?>
                                                                            <h6><?php echo $customer->mobile ?></h6>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Alteranate Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>- -</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info customer-border">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Email Address</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <?php if (!empty($customer->contact_email)) { ?>
                                                                            <h6><?php echo $customer->contact_email ?></h6>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  border-  data-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Name</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Bill Dobslaw</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>574-276-9181 CL</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info customer-border">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact
                                                                            Realtioship</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Owner</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  after  data-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Name</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>- -</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact
                                                                            Realtioship</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <!--biling information-->


                                            <div class="customer-inner">
                                                <div class="heading">
                                                    <h6>Biling Information</h6>
                                                </div>
                                                <div class="customer-field">
                                                    <div class="customer-wrapper">
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Sales Area</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>Corporate</h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Customer Full Name</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>william & Collen Dobslaw</h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Customer Date of Birth </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6></h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Company</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6></h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info spacer">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Address</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>1081 Black Walnut Trail</h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--  address info second part-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Cross street</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Subdivison</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>City State Zip</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Pen,Sacola FL 32
                                                                            514</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Country</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Escambia</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Country</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Usa</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Home/Panel Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>574-276-9182</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Cell Phone</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>- -</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Alteranate Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>- -</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info customer-border">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Email Address</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>cdo
                                                                            bslaw@comscast.net</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  border-  data-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Name</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Bill Dobslaw</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>574-276-9181 CL</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info customer-border">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact
                                                                            Realtioship</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Owner</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  after  data-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Name</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>- -</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact
                                                                            Realtioship</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <!--  owner information-->
                                            <div class="customer-inner">
                                                <div class="heading">
                                                    <h6>Owner Information</h6>
                                                </div>
                                                <div class="customer-field">
                                                    <div class="customer-wrapper">
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Sales Area</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>Corporate</h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>


                                                        <div class="field-info spacer">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Address</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>1081 Black Walnut Trail</h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--  address info second part-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Cross street</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                        <!--  right side data-->
                                        <div class="col-lg-6">
                                            <div class="customer-inner">
                                                <div class="heading">
                                                    <h6>Account Information</h6>
                                                </div>
                                                <div class="customer-field">
                                                    <div class="customer-wrapper">
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Sales Area</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>Corporate</h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Customer Full Name</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>william & Collen Dobslaw</h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Customer Date of Birth </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6></h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Company</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6></h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="field-info spacer">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Address</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6>1081 Black Walnut Trail</h6>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--  address info second part-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Cross street</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Subdivison</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>City State Zip</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Pen,Sacola FL 32
                                                                            514</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Country</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Escambia</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Country</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Usa</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Home/Panel Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>574-276-9182</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Cell Phone</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>- -</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Alteranate Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>- -</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info customer-border">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Email Address</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>cdo
                                                                            bslaw@comscast.net</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  border-  data-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Name</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Bill Dobslaw</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>574-276-9181 CL</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info customer-border">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact
                                                                            Realtioship</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>Owner</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  after  data-->
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Name</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6>- -</h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading"><h6>Contact
                                                                            Realtioship</h6></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text"><h6></h6></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <!--  custom fields-->
                                            <div class="customer-inner">
                                                <div class="heading">
                                                    <h6>Custom Field</h6>
                                                </div>
                                                <div class="customer-field">
                                                    <div class="customer-wrapper">
                                                        <div class="field-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="field-heading">
                                                                        <h6>Sales Area</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="field-text">
                                                                        <h6></h6>
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