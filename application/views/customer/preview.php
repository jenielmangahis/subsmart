<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    div[wrapper__section] {
        padding: 60px 10px !important;
    }
    .card_plus_sign{
        float: right;
        padding-right: 40px;
        font-size: 20px;
        display: block;
        margin-top: -38px;
    }
    .box_footer_icon{
        font-size: 20px;
    }
    .box_right{
        border-color: #e0e0e0 !important;
        border: 1px solid;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
        overflow: hidden;
    }
    .card-body {
        padding: 0 !important;
    }
    .left_label{
        font-weight: 600;
        padding-left: 20px;
        width: 250px;
    }
    .right_label{
        text-align: left;
        float: left;
    }
    .preview_box{
        border: 2px solid rgba(0,0,0,.1);
        max-width: 400px;
        border-radius: 5px;
        overflow: hidden;
        margin-left: 10px;

    }
    .preview_box_full{
        border: 2px solid rgba(0,0,0,.1);
        max-width: 810px;
        border-radius: 5px;
        margin-left: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
        overflow: hidden;
    }
    .preview_table{
        margin-top: 30px;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .preview_box_title{
        margin-top: 5px !important;
        text-align: center;
        background-color: #ededed;
        height: 25px;
        width: 100%;
        border-radius: 5px;
    }
    .header_button{
        margin-left: 10px;
    }
    .header_link{
        color:#1E5DA9;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-headers">
                                    <div class="col-md-12">
                                        <?php if($company_info->business_logo != ""): ?>
                                        <center>
                                            <img style="width: 70px" id="attachment-image" alt="Attachment" src="<?=  base_url().$company_info->business_logo; ?> ">
                                        </center>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 header_button">
                                            <a href="#" id="more_detail_furnisher" class="header_link">Print</a> |
                                            <a href="#" id="more_detail_furnisher" class="header_link">Bill Customer</a> |
                                            <a href="#" id="more_detail_furnisher" class="header_link">Alarm System</a> |
                                            <a href="#" id="more_detail_furnisher" class="header_link">Scanned Documents</a> |
                                            <a href="#" id="more_detail_furnisher" class="header_link">Credit Report</a> |
                                            <a href="#" id="more_detail_furnisher" class="header_link">Edit Customer</a>
                                        </div>
                                        <div class="col-md-12 preview_box_full" style="height: 40px;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div style="margin-top: 5px;">
                                                        <b>Account: </b><span> 6436456</span>&nbsp;&nbsp;&nbsp;<b>Online: </b><span> Yes</span>&nbsp;&nbsp;&nbsp;<b>In Service: </b><span> Yes</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div style="margin-top: 5px;" class="pull-right">
                                                        <b>Status: </b><span> Installed </span>&nbsp;&nbsp;&nbsp;<b>Equipment: </b><span> Installed </span>&nbsp;&nbsp;&nbsp;<b>Collections: </b><span> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 preview_box">
                                            <h6 class="preview_box_title">
                                                Address Information
                                            </h6>
                                            <div class="preview_table">
                                                <table >
                                                <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Sales Area</td>
                                                        <td align="right" class="right_label">Elberta Alabama</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Customer Full Name</td>
                                                        <td align="right"  class="right_label">Angela Hopper</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Customer Date of Birth</td>
                                                        <td align="right" class="right_label">Angela </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Company  </td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Address</td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Cross Street  </td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Subdivision  </td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">City State Zip</td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">County  </td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Country  </td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Home/Panel Phon</td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Cell Phone</td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Alternate Phone</td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Email Address</td>
                                                        <td align="right" class="right_label">Angela</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Contact Name</td>
                                                        <td align="right" class="right_label">Angela Hopper</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Contact Phone </td>
                                                        <td align="right"  class="right_label">850-228-1328 CL</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Contact Relationship </td>
                                                        <td align="right" class="right_label">Owner </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Contact Name</td>
                                                        <td align="right" class="right_label">Marty Harwood</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Contact Phone </td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Contact Relationship </td>
                                                        <td align="right" class="right_label">Owner </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <h6 class="preview_box_title">
                                                Billing Information
                                            </h6>
                                            <div class="preview_table">
                                                <table >
                                                    <tbody>
                                                        <tr>
                                                            <td align="left" class="left_label">Card Holder Full Name</td>
                                                            <td align="right" class="right_label">Elberta Alabama</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Card Holder Address</td>
                                                            <td align="right"  class="right_label">Angela Hopper</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">City State Zip</td>
                                                            <td align="right" class="right_label">Angela </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                        <tr>
                                                            <td align="left" class="left_label">Billing Method</td>
                                                            <td align="right" class="right_label">Elberta Alabama</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                        <tr>
                                                            <td align="left" class="left_label">Monthly Monitoring Rate</td>
                                                            <td align="right" class="right_label">Elberta Alabama</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Billing Frequency</td>
                                                            <td align="right"  class="right_label">Angela Hopper</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Billing Day of Month</td>
                                                            <td align="right" class="right_label">Angela </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Contract Term </td>
                                                            <td align="right" class="right_label">Angela </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Billing Start Date</td>
                                                            <td align="right" class="right_label">Angela </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Billing End Date</td>
                                                            <td align="right" class="right_label">Angela </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Remaining Months</td>
                                                            <td align="right" class="right_label">Angela </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Check Number</td>
                                                        <td align="right" class="right_label">Elberta Alabama</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Routing Number</td>
                                                        <td align="right"  class="right_label">Angela Hopper</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Account Number</td>
                                                        <td align="right" class="right_label">Angela </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Credit Card Number</td>
                                                        <td align="right" class="right_label">Angela </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Credit Card Expiration</td>
                                                        <td align="right" class="right_label">Angela </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Social Security Number</td>
                                                        <td align="right" class="right_label">Angela </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                        <tr>
                                                            <td align="left" class="left_label">Collections Date</td>
                                                            <td align="right" class="right_label">Elberta Alabama</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Collections Amount</td>
                                                            <td align="right" class="right_label">Elberta Alabama</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Contract Extension Date</td>
                                                        <td align="right" class="right_label">Elberta Alabama</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 preview_box">
                                            <h6 class="preview_box_title">
                                                Account Information
                                            </h6>
                                            <div class="preview_table">
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Entered by</td>
                                                        <td align="right" class="right_label">Elberta Alabama</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Time Entered</td>
                                                        <td align="right"  class="right_label">Angela Hopper</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Sale Date</td>
                                                        <td align="right" class="right_label">Angela </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                        <tr>
                                                            <td align="left" class="left_label">Credit Score  </td>
                                                            <td align="right" class="right_label">Monitoring Company </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Account Type </td>
                                                            <td align="right"  class="right_label">850-228-1328 CL</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Monitoring ID </td>
                                                            <td align="right" class="right_label">Owner </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Signals Confirmation </td>
                                                            <td align="right" class="right_label">Owner </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Monitoring Confirmation </td>
                                                            <td align="right" class="right_label">Owner </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Language</td>
                                                            <td align="right" class="right_label">Owner </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Abort Code</td>
                                                            <td align="right" class="right_label">Owner </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                        <tr>
                                                            <td align="left" class="left_label">Sales Rep </td>
                                                            <td align="right" class="right_label">Marty Harwood</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Technician</td>
                                                            <td align="right"  class="right_label">850-332-6759 CL</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Saved Date</td>
                                                        <td align="right" class="right_label">Marty Harwood</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Saved By</td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Cancellation Date </td>
                                                        <td align="right" class="right_label">Marty Harwood</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Cancellation Reason</td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                        <tr>
                                                            <td align="left" class="left_label">Install Date</td>
                                                            <td align="right" class="right_label">Marty Harwood</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Tech Arrival Time</td>
                                                            <td align="right"  class="right_label">850-332-6759 CL</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Tech Departure Time</td>
                                                            <td align="right"  class="right_label">850-332-6759 CL</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">Panel Type</td>
                                                            <td align="right"  class="right_label">850-332-6759 CL</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="left_label">System Type</td>
                                                            <td align="right"  class="right_label">850-332-6759 CL</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Pre-Install Survey  </td>
                                                        <td align="right" class="right_label">Marty Harwood</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Post-Install Survey</td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Monitoring Waived</td>
                                                        <td align="right" class="right_label">Marty Harwood</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Rebate Offered:</td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Rebate Check 1 </td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Rebate Check 2</td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Activation Fee</td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Activation Pay Type</td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <h6 class="preview_box_title">
                                                Owner Information
                                            </h6>
                                            <div class="preview_table">
                                                <table >
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" class="left_label">Full Name </td>
                                                        <td align="right" class="right_label">Marty Harwood</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Social Security Number</td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">Address  </td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" class="left_label">City State Zip</td>
                                                        <td align="right"  class="right_label">850-332-6759 CL</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <h6 class="preview_box_title">
                                                Custom Fields
                                            </h6>
                                            <table >
                                                <tbody>
                                                <tr>
                                                    <td align="left" class="left_label"> CustomField1</td>
                                                    <td align="right" class="right_label"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12 preview_box_full">
                                            <h6 class="preview_box_title">
                                                Notes
                                            </h6>
                                            <table >
                                                <tbody>
                                                    <tr>
                                                        <td align="left" >Jul 10 2015 1:06PM CDT - Lauren Williams</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="text-align: left;border: 1px;border-style: solid;border-color: #999999;background-color: #FFFF71;">
                                                            Billing Subscription: Monthly Monitoring $41.99 $0.00 $41.99
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12 preview_box_full">
                                            <h6 class="preview_box_title">
                                                Devices
                                            </h6>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>Sold by</td>
                                                        <td>Points</td>
                                                        <td>Retail Cost</td>
                                                        <td>Purchase Price</td>
                                                        <td>Qty</td>
                                                        <td>Total Points</td>
                                                        <td>Total Cost</td>
                                                        <td>Total Purcahse Price</td>
                                                        <td>Net</td>
                                                    </tr>

                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include viewPath('includes/footer');
?>

