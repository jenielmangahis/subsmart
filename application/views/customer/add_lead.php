<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>

<style>
    .module_ac {
        background: #f2f2f2;
        border-radius: 1px;
        display: grid;
        flex-flow: wrap;
        flex: 0 0 41.666667%;
        max-width: 35%;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        border: 2px solid #32243d !important;
        margin-left: 60px;
        margin-bottom: 20px;
        height:100%;
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
        border-left : #0b2e13 20px;
    }
    .module_ac3 {
        background: #f2f2f2;
        border-radius: 1px;
        border-left : #0b2e13 20px;
        height : 130px;
    }

    .form-control {
        font-size: 12px;
        height: 35px !important;
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
    .add_data{
        color : #55b94c;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>


    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="float-right">
                            <div class="dropdown">
                                <a href="<?php echo base_url('customer') ?>" class="btn btn-primary"
                                   aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Go Back to Customer
                                </a>
                            </div>
                        </div>
                        <h3 >New Lead</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add new lead.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('customer/save', ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>
            <div class="row custom__border">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>General Information</h6>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Lead Type </label> <a href="<?php echo url('customer/index/1') ?>" class="add_data"><span class="fa fa-plus"></span></a><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                        <?php foreach ($lead_types as $lt): ?>
                                                            <option value="<?= $lt->lead_id; ?>"><?= $lt->lead_name; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Sales Area</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                        <?php foreach ($sales_area as $sa): ?>
                                                            <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Sales Rep</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">- none -</option>
                                                        <?php foreach ($users as $user): ?>
                                                            <option value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>New Credit Report</h6>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for=""></label><br/>
                                                            <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                                <option value="TrunsUnion">TrunsUnion</option>
                                                                <option value="Experian">Experian </option>
                                                                <option value="Equifax ">Equifax  </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12"><br>
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for=""></label>
                                                            <button type="submit" class="btn btn-flat btn-primary">Run Credit</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" module_ac">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Contact 1 Information</h6>
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
                                                    <label for="">Secondary (Maternal) Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Name Suffix</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">Select</option>
                                                        <option value="0">DS</option>
                                                        <option value="0">Esq.</option>
                                                        <option value="0">II</option>
                                                        <option value="0">III</option>
                                                        <option value="0">IV</option>
                                                        <option value="0">Jr.</option>
                                                        <option value="0">MA</option>
                                                        <option value="0">MBA</option>
                                                        <option value="0">MD</option>
                                                        <option value="0">MS</option>
                                                        <option value="0">PhD</option>
                                                        <option value="0">RN</option>
                                                        <option value="0">Sr.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Street Number</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Street Direction</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="0">Select</option>
                                                        <option value="0">North</option>
                                                        <option value="0">East</option>
                                                        <option value="0">South</option>
                                                        <option value="0">West</option>
                                                        <option value="0">North East</option>
                                                        <option value="0">South East</option>
                                                        <option value="0">North West</option>
                                                        <option value="0">South West</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Street Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Street Type</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value=""></option>
                                                        <option value="ALLEY">ALLEY</option>
                                                        <option value="ARCH">ARCH</option>
                                                        <option value="BOULEVARD">BOULEVARD</option>
                                                        <option value="BUILDING">BUILDING</option>
                                                        <option value="CENTER">CENTER</option>
                                                        <option value="CIRCLE">CIRCLE</option>
                                                        <option value="CLOSE">CLOSE</option>
                                                        <option value="COURT">COURT</option>
                                                        <option value="COVE">COVE</option>
                                                        <option value="CRESCENT">CRESCENT</option>
                                                        <option value="DALE">DALE</option>
                                                        <option value="DRIVE">DRIVE</option>
                                                        <option value="DRIVE">DRIVE</option>
                                                        <option value="EXPRESSWAY">EXPRESSWAY</option>
                                                        <option value="FREEWAY">FREEWAY</option>
                                                        <option value="GARDEN">GARDEN</option>
                                                        <option value="GROVE">GROVE</option>
                                                        <option value="HEIGHTS">HEIGHTS</option>
                                                        <option value="HIGHWAY">HIGHWAY</option>
                                                        <option value="HILL">HILL</option>
                                                        <option value="KNOLL">KNOLL</option>
                                                        <option value="LANE">LANE</option>
                                                        <option value="LOOP">LOOP</option>
                                                        <option value="MALL">MALL</option>
                                                        <option value="OVAL">OVAL</option>
                                                        <option value="PARK">PARK</option>
                                                        <option value="PARKWAY">PARKWAY</option>
                                                        <option value="PATH">PATH</option>
                                                        <option value="PIKE">PIKE</option>
                                                        <option value="PLACE">PLACE</option>
                                                        <option value="PLAZA">PLAZA</option>
                                                        <option value="POINT">POINT</option>
                                                        <option value="RISE">RISE</option>
                                                        <option value="ROAD">ROAD</option>
                                                        <option value="ROUTE">ROUTE</option>
                                                        <option value="ROW">ROW</option>
                                                        <option value="RUN">RUN</option>
                                                        <option value="RURAL ROUTE">RURAL ROUTE</option>
                                                        <option value="SQUARE">SQUARE</option>
                                                        <option value="STREET">STREET</option>
                                                        <option value="TERRACE">TERRACE</option>
                                                        <option value="THRUWAY">THRUWAY</option>
                                                        <option value="TRAIL">TRAIL</option>
                                                        <option value="TURNPIKE">TURNPIKE</option>
                                                        <option value="VIADUCT">VIADUCT</option>
                                                        <option value="VIEW">VIEW</option>
                                                        <option value="WALK">WALK</option>
                                                        <option value="WAY">WAY</option>
                                                        <option value="WYND">WYND</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Apt/Ste/Space#</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Condo Name</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">ZIP State City</label><br/>
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
                                                    <label for="">County</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Country</label><br/>
                                                    <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                        <option value="USA">USA</option>
                                                        <option value="CANADA">CANADA</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Home/Panel Phone</label><br/>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>-
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>-
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Cell Phone</label><br/>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>-
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>-
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Email Address</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Social Security Number</label><br/>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>-
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>-
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Date of Birth</label><br/>
                                                    <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group right">
                                                    <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="module_ac" style="bottom:40px;">
                                        <div class="row">
                                            <div class="col-md-12 module_header">
                                                <h6>Report History</h6>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for=""></label><br/>
                                                            <input value="No History" type="text" class="form-control" name="contact_name" id="contact_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12"><br>
                                                        <div class="form-group" id="customer_type_group">
                                                            <label for=""></label>
                                                            <button type="submit" class="btn btn-flat btn-primary">Convert to Customer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>
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
    </div>
    <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
