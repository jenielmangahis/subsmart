<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
));
?>

<?php include viewPath('includes/header'); ?>
<?php include viewPath('customer/css/add_advance_css'); ?>
<style>
    .header_link{
        color:#1E5DA9;
    }
    .card-header {
        padding: 0 !important;
    }
    .table_head_customer{
        border-color: #999999;
        border-style: Solid;
        border-width: 1px;
        width: 200px;
    }
    .table_body_customer{
        border-color: #999999;
        border-style: Solid;
        border-width: 1px;
        background-color: #E5EBF2;
        height: 20px;
    }
    .form_line{
        line-height: 23px !important;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="row ">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="row ">
                            <div class="col-md-12">
                                <div style="margin-top: 5px;">
                                    <b>Account No: </b><span>  <?= !empty($alarm_info->monitor_id) ? $alarm_info->monitor_id : '---';?></span>&nbsp;&nbsp;&nbsp;
                                    <b>Online: </b><span> <?= !empty($alarm_info->online) ? $alarm_info->online : '---';?></span>&nbsp;&nbsp;&nbsp;
                                    <b>In Service: </b><span> <?= !empty($alarm_info->in_service) ? $alarm_info->in_service : '---';?></span> &nbsp;&nbsp;
                                    <b>Status: </b><span> <?= !empty($profile_info->status) ? $profile_info->status : '---';?> </span>&nbsp;&nbsp;&nbsp;
                                    <b>Equipment: </b><span> <?= !empty($alarm_info->equipment) ? $alarm_info->equipment : '---';?> </span>&nbsp;&nbsp;&nbsp;
                                    <b>Collections: </b><span><?= !empty($alarm_info->collections) ? $alarm_info->collections : '---';?> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row ">
                            <div class="col-md-12">
                                <table cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <td  class="table_head_customer">
                                            <b>Rep Paper</b>
                                        </td>
                                        <td class="table_head_customer">
                                            <b>Tech Paper</b>
                                        </td>
                                        <td class="table_head_customer" >
                                            <b>Scanned</b>
                                        </td>
                                        <td class="table_head_customer">
                                            <b>Paperwork</b>
                                        </td>
                                        <td class="table_head_customer" >
                                            <b>Submitted</b>
                                        </td>
                                        <td class="table_head_customer" >
                                            <b>Rep Paid</b>
                                        </td>
                                        <td class="table_head_customer">
                                            <b>Tech Paid</b>
                                        </td>
                                        <td class="table_head_customer" >
                                            <b>Funded</b>
                                        </td>
                                        <td class="table_head_customer" >
                                            <b>Charged Back</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="table_body_customer">

                                        </td>
                                        <td align="center" class="table_body_customer">

                                        </td>
                                        <td align="center" class="table_body_customer">

                                        </td>
                                        <td align="center" class="table_body_customer">

                                        </td>
                                        <td align="center" class="table_body_customer">

                                        </td>
                                        <td align="center" class="table_body_customer">

                                        </td>
                                        <td align="center" class="table_body_customer">

                                        </td>
                                        <td align="center" class="table_body_customer">

                                        </td>
                                        <td align="center" class="table_body_customer">

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 0 0 10px 5px;">
                        <a href="#" id="" class="header_link">Print</a> |
                        <a href="<?= base_url('customer/billing/'.$this->uri->segment(3)); ?>" id="more_detail_furnisher" class="header_link">Bill Customer</a> |
                        <a href="#" id="more_detail_furnisher" class="header_link">Inventory Details</a> |
                        <a href="#" id="more_detail_furnisher" class="header_link">Scanned Documents</a> |
                        <a href="#" id="more_detail_furnisher" class="header_link">Credit Report</a> |
                        <a href="<?php echo base_url('customer/add_advance/'.$this->uri->segment(3)); ?>" id="more_detail_furnisher" class="header_link">Edit Customer</a> |
                        <a href="<?php echo base_url('customer/module/'.$this->uri->segment(3)); ?>" id="more_detail_furnisher" class="header_link">Customer Dashboard</a>
                    </div>
                </div>
            </div>
            <div class="col-md-"></div>
            <div class="row mt-2">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row ">
                        <div class="col-md-4">
                            <?php include viewPath('customer/advance_customer_forms/preview_customer_info'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php include viewPath('customer/advance_customer_forms/preview_office_info'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php include viewPath('customer/advance_customer_forms/preview_alarm_info'); ?>
                        </div>
                        <div class="col-md-12">
                            <?php include viewPath('customer/advance_customer_forms/preview_notes_info'); ?>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" value="<?php if(isset($profile_info)){ echo $profile_info->prof_id; } ?>" class="form-control" name="prof_id" id="prof_id" />
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>
        <!-- end container-fluid -->

        <?php
        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        ));
        ?>
        <?php include viewPath('includes/footer'); ?>
        <?php include viewPath('customer/js/preview_js'); ?>
