<?php

//views>estimate   --> not sure why this file exist or has a DB connection

defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/estimate'); ?>
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">My Estimates</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Listing your estimates.</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <!-- <a href="<?php echo url('customer/add') ?>" class="btn btn-primary" aria-expanded="false">
                            <i class="mdi mdi-settings mr-2"></i> New Customer
                        </a>    -->
                                    <a class="btn btn-primary btn-md" href="<?php echo url('estimate/add') ?>"><span
                                                class="fa fa-plus"></span> New Estimate</a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="d-block d-none  hid-deskx">
                            <?php
                            $id = logged('id');

                            $servername = "gator4155.hostgator.com";
                            $username = "admintom_admin";
                            $password = "SmarTrac1$!";
                            $dbname = "admintom_nsmart";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT  * from estimates WHERE `user_id`=$id";
                            $result = $conn->query($sql);


                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $ss = $row['id'];
                                    ?>
                                    <div card__columns>
                                        <div class="c__header">
                                            <h4> <?php echo 'WO-00' . $row['id']; ?></h4>
                                            <div class="card__columns_dec">
                                                <div><i class="fa fa-user"
                                                        aria-hidden="true"></i> <?php echo $row['contact_name']; ?>
                                                </div>
                                                <div><i class="fa fa-users"
                                                        aria-hidden="true"></i> <?php echo $row['contact_mobile']; ?>
                                                </div>
                                                <div><i class="fa fa-calendar"
                                                        aria-hidden="true"></i><?php echo date('M d, Y', strtotime($row->workorder_date)); ?>
                                                </div>
                                                <h4>
                                                    <span><a href="http://nsmartrac.com/workorder/edit/<?php echo $ss; ?>">View estimate</a></span>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "No Estimates";
                            } ?>
                        </div>
                        <div class="card-body hid-desk">
                            <h4 class="mt-0 header-title mb-5"> Listing your estimates.</h4>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="dataTable1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Estimate ID#</th>
                                            <th>Date</th>
                                            <th>Job & Customer</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($estimates as $estimate) { ?>
                                            <tr>
                                                <td><?php echo 'EST-0000' . $estimate->id ?></td>
                                                <td><?php echo date('M d, Y', strtotime($estimate->estimate_date)) ?></td>
                                                <td>
                                                    <?php echo $estimate->job_name; ?>
                                                    <p><?php echo get_customer_by_id($estimate->customer_id)->contact_name ?></p>
                                                </td>
                                                <td>
                                                    <?php if ($estimate->status == 1) { ?>
                                                        <span>Submitted</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button"
                                                                data-toggle="dropdown">Manage
                                                            <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li ><a  href="#"><span class="fa fa-envelope-o icon"></span> Submit Estimate</a></li><li ><a href="<?php echo url('estimate/edit/' . $estimate->id) ?>"><span class="fa fa-pencil-square-o icon"></span> <b>  Edit</b></a></li><li ><a  href="#"><span class="fa fa-file-text-o icon"></span> View Estimate</a></li><li role="separator" class="divider"></li><li ><a  href="#" ><span class="fa fa-check-circle-o icon"></span> Mark as Accepted</a></li><li ><a  href="#" ><span class="fa fa-money icon"></span> Convert to Invoice</a></li><li ><a  href="javascript:void(0)" data-estimate-id="<?php echo 'EST-0000' . $estimate->id ?>" data-toggle="modal"data-target="#modalConvertEstimate" ><span class="fa fa-file-text-o icon"></span><b> Convert to Work Order </b></a></li><li ><a  href="#" ><span class="fa fa-files-o icon"></span> Clone Estimate</a></li><li ><a  href="#" ><span class="fa fa-trash-o icon"></span> Delete Estimate</a></li><li ><a  href="#" ><span class="fa fa-ban icon"></span> Mark as Lost</a></li><li role="separator" class="divider"></li><li ><a  href="#"><span class="fa fa-file-pdf-o icon"></span> Estimate PDF</a></li><li ><a  href="#"><span class="fa fa-print icon"></span> Print Estimate</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end container-fluid -->
</div>

<!-- CONVERT ESTIMATE MODAL -->
<div class="modal fade" id="modalConvertEstimate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Convert Estimate To Work Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="convert-to-work-order-modal-form">
                    <p>
                        You are going create a new work order based on <b>Estimate# <span
                                    id="estimateCustomNumber"></span></b>.<br>
                        The estimate items (e.g. materials, labour) will be copied to this work order.<br>
                        You can always edit/delete work order items as you need.
                    </p>
                    <!-- <div class="checkbox checkbox-sec">
                      <input type="checkbox" name="copy_attachment" value="1" checked="checked" id="ctwo_copy_attachment">
                      <label for="ctwo_copy_attachment"><span>Copy estimate attachments to work order</span></label>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" data-link="<?php echo base_url('workorder/add/?estimate_id=' . $estimate->id) ?>"
                        class="btn btn-primary" id="button_convert_estimate">Convert To Work Order
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable({

        "ordering": false
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });

    window.updateUserStatus = (id, status) => {
        $.get('<?php echo url('company/change_status') ?>/' + id, {
            status: status
        }, (data, status) => {
            if (data == 'done') {
                // code
            } else {
                alert('Unable to change Status ! Try Again');
            }
        })
    }

    $(document).ready(function () {

        // open service address form
        $('#modalConvertEstimate').on('shown.bs.modal', function (e) {

            var element = $(this);

            var estimate_id = $(e.relatedTarget).attr('data-estimate-id');

            $(this).find('#estimateCustomNumber').html(estimate_id);

        });

        $(document).on('click', '#button_convert_estimate', function (e) {

            e.preventDefault();

            location.href = $(this).attr('data-link');
        });
    });
</script>