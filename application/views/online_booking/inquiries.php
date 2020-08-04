<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_booking'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>   

                        <div class="row dashboard-container-1">
                            <div class="col-md-8"><strong>Manage inquiries.</strong></div>
                        </div>       
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $inquiries as $i ){ ?>
                                    <?php 
                                        $status = "";
                                        if($i->status == 1) {
                                            $status = "New";
                                        }elseif($i->status == 2) {
                                            $status = "Contacted";
                                        }elseif($i->status == 3) {
                                            $status = "Follow Up";
                                        }elseif($i->status == 4) {
                                            $status = "Assigned";
                                        }elseif($i->status == 5) {
                                            $status = "Closed";
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $i->id; ?></td>
                                        <td><?php echo $i->name; ?></td>
                                        <td><?php echo $i->phone; ?></td>
                                        <td><?php echo $i->email; ?></td>
                                        <td><?php echo $i->message; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td class="text-right">
                                            <a class="btn-view-inquiry margin-right-sec" data-id="<?php echo $i->id; ?>" href="javascript:void(0);"><span class="fa fa-list"></span> View</a>
                                            <a class="btn-edit-info-inquiry margin-right-sec" data-id="<?php echo $i->id; ?>" href="javascript:void(0);"><span class="fa fa-pencil-square-o"></span> Edit</a>
                                            <a class="btn-change-status-inquiry margin-right-sec" data-id="<?php echo $i->id; ?>" href="javascript:void(0);"><span class="fa fa-flag-o"></span> Change Status</a>
                                            
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/booking_modals'); ?> 
<?php include viewPath('includes/footer_booking'); ?>
<script>
$(function(){
    var base_url = "<?php echo base_url(); ?>";

    $(".btn-view-inquiry").click(function(){
        var iid = $(this).attr("data-id");
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading...</div>';
        var url = base_url + '/booking/_inquiry_details';

        $("#modalViewInquiry").modal('show');

        $(".inquiry-body").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {iid:iid},
               success: function(o)
               {
                  $(".inquiry-body").html(o);
               }
            });
        }, 1000);
    });

    $(".btn-change-status-inquiry").click(function(){
        var iid = $(this).attr("data-id");
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading...</div>';
        var url = base_url + '/booking/_inquiry_change_status';

        $("#modalViewChangeStatus").modal('show');

        $(".inquiry-change-status-body").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {iid:iid},
               success: function(o)
               {
                  $(".inquiry-change-status-body").html(o);
               }
            });
        }, 1000);
    });

    
    $(".btn-edit-info-inquiry").click(function(){
        var iid = $(this).attr("data-id");
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading...</div>';
        var url = base_url + '/booking/_inquiry_edit_details';

        $("#modalViewEditInquiryInfo").modal('show');

        $(".inquiry-edit-info-body").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {iid:iid},
               success: function(o)
               {
                  $(".inquiry-edit-info-body").html(o);
               }
            });
        }, 1000);
    });

});
</script>