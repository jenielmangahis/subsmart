<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>

<style>
    .module_ac {
        background: #f2f2f2;
        border-radius: 1px;
        display: grid;
        grid-gap: 15px;

        flex-flow: wrap;
        flex: 0 0 41.666667%;
        max-width: 30%;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 10px;
        margin-bottom: 20px;
        height:auto;
        min-height: 100px;
    }
    .module_header{
        /** background-color: #5f0a87;
      background-image: linear-gradient(326deg, #862987 0%, #5f0a87 74%); */

        background-color: #32243d;
        color : #fff;
        text-align: center;
        max-height: 40px;
        max-width: 100%;
    }
    .module_ac2 {
        background: #f2f2f2;
        border-radius: 1px;
        display: flex;
        flex-flow: wrap;
        flex: 0 0 41.666667%;
        max-width: 100%;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 10px;
        margin-bottom: 20px;
    }
    .module_ac3 {
        background: #f2f2f2;
        border-radius: 1px;
        border-left : #0b2e13 20px;
        height : 130px;
    }

    .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 3px !important;
    }
    .banking-tab-container {
        border-bottom: 1px solid grey;
        padding-left: 0;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>


    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">New Advance Customer</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add your new customer.</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                <a href="<?php echo base_url('customer') ?>" class="btn btn-primary"
                                   aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Go Back to Customer
                                </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('customer/save', ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>
            <style>

            </style>
            <div class="row custom__border">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                        <div class=" module_ac">
                                            <div class="row">
                                                        <div class="col-md-12 module_header">
                                                            <h6>Address Information</h6>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Sales Area</label><br/>
                                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                    <option value="0">- none -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Name Prefix</label><br/>
                                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                    <option value="0">- none -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">First Name</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Middle Initial</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Last Name</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Date of Birth</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Name Suffix</label><br/>
                                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                    <option value="0">- none -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Company</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Address *</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Cross Street</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Subdivision</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">City State ZIP</label><br/>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Country</label><br/>
                                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                    <option value="0">- none -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Home/Panel Phone *</label><br/>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Cell Phone </label><br/>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Alternate Phone </label><br/>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Email</label><br/>
                                                                <input type="email" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Contact First Name</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Contact Last Name</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Contact Phone </label><br/>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                            <option value="0">- none -</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Contact Relationship</label><br/>
                                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                    <option value="0">- none -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Contact First Name</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Contact Last Name</label><br/>
                                                                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Contact Phone </label><br/>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                            <option value="0">- none -</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="customer_type_group">
                                                                <label for="">Contact Relationship</label><br/>
                                                                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                    <option value="0">- none -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </div>
                                         <div class=" module_ac">
                                                <div class="row">
                                                    <div class="col-md-12 module_header">
                                                        <h6>Account Information</h6>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Entered By</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Time Entered</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Sales Date</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Credit Score *</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Monitoring Company *</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Account Type *</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Monitoring ID</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Language</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Signal Confirmation Number</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Monitoring Confirmation </label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Abort Code</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Sales Rep</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Technician</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Save Date</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Save By</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Cancellation Date</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Cancellation Reason</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                            <label for="notify_by_email"><span>Check for Schedule Conflict</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Install Date</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Tech Arrival Time</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Tech Departure Time</label><br/>
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Panel Type *</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Pre-Install Survey</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Post-Install Survey</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Monitoring Waived</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                            <label for="notify_by_email"><span>Rebate Offered</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Rebate Check # 1</label><br/>
                                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Amount $</label><br/>
                                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Rebate Check # 2</label><br/>
                                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Amount $</label><br/>
                                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <label for="">Activation Fee</label><br/>
                                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                        <option value="0">- none -</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group" id="customer_type_group">
                                                                    <br>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                                        <label for="notify_by_email"><span>None</span></label>
                                                                    </div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                                        <label for="notify_by_email"><span>Check</span></label>
                                                                    </div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                                        <label for="notify_by_email"><span>Credit</span></label>
                                                                    </div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                                                        <label for="notify_by_email"><span>Paid</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for="">Lead Source</label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="0">- none -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                         </div>

                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Profile Module</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Sales Area</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">First Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Last Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Middle Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Name Prefix</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Surffix</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Business Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Email</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                 </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">SSN</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">DOB</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Phone (H)</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Phone (W)</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Phone (M)</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Fax</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Mailing Address</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Image/Logo File</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">City</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">State</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Country</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Zip Code</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Cross Street</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Subdivision</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="notify_by" value="Email" checked id="prev_add">
                                                    <label for="prev_add"><span>Check for Schedule Conflict</span></label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Admin Module</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Entered by</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Time Entered</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Assign To</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Pre-install Survey</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 1</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Language</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Date Enter</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Sales Rep</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Post-install Survey</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Alarm Industry Module</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Monitoring Company</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Monitoring ID</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Install Date</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Credit Score</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Account Type</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Account Information</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Abort/Password Code</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Installer Code</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Monitoring confirmation number</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Signal confirmation number</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contact Name #3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Panel Type</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">System Type</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Monitoring Waived</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rebate Offered:</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rebate Check 1</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rebate Check 2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Warranty Type</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 1</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Tech Module</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Tech Arrive Time</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Tech Complete Time</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Time Given</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Date Given</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">TECH Assign</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 1</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 4</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">URL</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Account Access Module</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Portal Status (on/off)</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Reset Password (Button)</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Login</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Password</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 1</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Cancellation Date</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Collection Date</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Cancellation Reason</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Collection Amount</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Customizable Industry Module</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 1</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 4</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 5</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 6</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 7</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 8</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 9</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 10</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 11</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 12</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 13</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 14</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 15</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 16</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 17</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 18</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 19</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 20</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 21</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 22</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 23</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Custom Field 24</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>




                                        </div>
                                    </div>

                                    <div class="module_ac" >
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Billing Information</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Card Holder First Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Card Holder Last Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Card Holder Address </label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">City State ZIP</label><br/>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Monthly Monitoring Rate* $</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Billing Frequency</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Billing Day of Month</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contract Term* (months)</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Billing Method</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Billing Start Date</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Billing End Date</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Check Number</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Routing Number</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Account Number</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Credit Card Number</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Credit Card Expiration</label><br/>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>/
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div> (MM/YYYY)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Social Security Number</label><br/>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div> -
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div> -
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Collections Date</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Collections Amount $</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contract Extension Date</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Office Use</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                    <label for="notify_by_sms"><span>Welcome kit Sent</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                            <label for="notify_by_sms"><span>Rebate Received</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                            <label for="notify_by_sms"><span>Rebate Paid</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Commision Scheme Override</label><br/>
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                    <label for="notify_by_sms"><span>On</span></label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                    <label for="notify_by_sms"><span>Off</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rep Commission $</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rep Upfront Pay</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rep Tiered Upfront Bonus</label><br/>
                                                    <i>$0.00</i>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rep Tiered Holdfund Bonus</label><br/>
                                                    <i>$0.00</i>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rep Deductions Total</label><br/>
                                                    <i>$0.00</i>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Tech Commission $</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Tech Upfront Pay $</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Tech Deductions Total</label><br/>
                                                    <i>$0.00</i>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rep Hold Fund Charge Back $</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Rep Payroll Charge Back $</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Points Scheme Override</label><br/>
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                    <label for="notify_by_sms"><span>On</span></label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                                                    <label for="notify_by_sms"><span>Off</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Points Included</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Price Per Point $</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Purchase Price $</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Purchase Multiple</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Purchase Discount $</label><br/>
                                                    <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Owner Information</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Social Security Number</label><br/>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div> -
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div> -
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">First Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Last Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Address 1</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Address 2</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Address 3</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">City State ZIP</label><br/>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="module_ac3 module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Custom Fields</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Contract Extension Date</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="module_ac2">
                                        <div class="col-md-12 module_header">
                                            <h6>New Notes</h6>
                                        </div>

                                        <div class="col-md-12">  <br>
                                            <textarea class="form-control"> </textarea>

                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <div class="form-group right">
                                                <button type="submit" class="btn btn-flat btn-primary">Cancel</button>
                                                <button type="submit" class="btn btn-flat btn-primary">Delete </button>
                                                <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                                <!-- <a href="<?php echo url('customer') ?>" class="btn btn-danger">Cancel this</a>-->
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-12 module_header module_ac2">
                                        <div class="col-md-12 module_header">
                                            <h6>Existing Notes</h6>
                                        </div>
                                        <div class="col-md-12">

                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 module_header module_ac2">
                                        <div class="col-md-6">
                                            <h6>Devices</h6>
                                        </div>
                                        <div class="col-md-12">

                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <style>

            </style>
            <?php echo form_close(); ?>

            <!-- Modal Service Address -->
            <div class="modal fade" id="modalServiceAddress" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
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

            <!-- Modal Service Address -->
            <div class="modal fade" id="modalServiceGroup" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Group</h5>
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
            <div class="modal fade" id="modalAdditionalContacts" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
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

            <div class="modal fade" id="modalAddNewSource" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Source</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_source" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Source Name</label> <span class="form-required">*</span>
                                    <input type="text" name="title" value="" class="form-control"
                                           autocomplete="off">
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
            <div class="modal fade" id="modalAddNewCustomerTypes" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Customer Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_customer_types" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Type</label> <span class="form-required">*</span>
                                    <input type="text" name="title" value="" class="form-control"
                                           autocomplete="off">
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
            <div class="modal fade" id="modalAddNewGroup" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <b class="modal-title" id="exampleModalLabel">Add New Group</b>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding:30px 30px 10px 30px;">
                            <form id="frm_add_new_group" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Group Name</label> <span class="form-required">*</span>
                                    <input type="text" name="title" value="" class="form-control" required
                                           autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Description</label> <span class="form-required">*</span>
                                    <textarea class="form-control" required name="description" autocomplete="off"></textarea>
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
</div>
<?php include viewPath('includes/footer'); ?>

<script>

    document.getElementById('contact_mobile').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
    document.getElementById('contact_phone').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

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
        $("input[name=birthday]").keydown(function(event) {
            // Allow only backspace and delete
            if ( event.keyCode == 46 || event.keyCode == 8 ) {
                // let it happen, don't do anything
            }
            else {
                // Ensure that it is a number and stop the keypress
                if (event.keyCode < 48 || event.keyCode > 57 ) {
                    event.preventDefault();
                }
            }
        });

        $("input[name=birthday]").keyup(function(event){
            console.log($(this).val());
            if ($(this).val().length == 2){
                $(this).val($(this).val() + "/");
            }else if ($(this).val().length == 5){
                $(this).val($(this).val() + "/");
            }
        });

    });
</script>
<style>
    .select2-container--open{       z-index: 0;}
    span.select2-selection.select2-selection--single {
        font-size: 16px;
    }
</style>