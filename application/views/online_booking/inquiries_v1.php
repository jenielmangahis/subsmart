<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.row-header{
    background-color: #32243d;
    color: #ffffff;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 39px !important;
  margin-top: 55px !important;
}
.hide{
    display: none;
}
.badge-info{
    background-color: #38a4f8;
}
.badge{
    padding: 6px;
    display: block;
    font-size: 13px;
}
.badge-warning {
    background-color: #f8b425;
}
.badge-success {
    color: #fff;
    background-color: #28a745;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-20">
            <div class="row">
                <div class="col">
                  <h3 class="page-title mt-0">Online Booking</h3>
                </div>
            </div>
            <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage inquiries from your online booking form.</span>
              </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>                           
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width:10%;">Date</th>
                                    <th style="width:40%;">Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $inquiries as $i ){ ?>
                                    <?php 
                                        $status = "";
                                        if($i->status == 1) {
                                            $status = "<span class='badge badge-info'>New</span>";
                                        }elseif($i->status == 2) {
                                            $status = "<span class='badge badge-success'>Contacted</span>";
                                        }elseif($i->status == 3) {
                                            $status = "<span class='badge badge-success'>Follow Up</span>";
                                        }elseif($i->status == 4) {
                                            $status = "<span class='badge badge-success'>Assigned</span>";
                                        }elseif($i->status == 5) {
                                            $status = "<span class='badge badge-warning'>Closed</span>";
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo date("F d, Y", strtotime($i->date_created)); ?></td>
                                        <td><?php echo $i->name; ?></td>
                                        <td><?php echo $i->phone; ?></td>
                                        <td><?php echo $i->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-btn">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">  
                                                    <li role="presentation">
                                                        <a role="menuitem" class="margin-right-sec btn-view-inquiry" data-id="<?php echo $i->id; ?>" href="javascript:void(0);"><span class="fa fa-list icon"></span> View</a>
                                                    </li> 
                                                    <li role="presentation">
                                                        <a role="menuitem" class="margin-right-sec btn-edit-info-inquiry" data-id="<?php echo $i->id; ?>" href="javascript:void(0);"><span class="fa fa-pencil icon"></span> Edit</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="btn-delete-inquiry" data-id="<?php echo $i->id; ?>" href="javascript:void(0);"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
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

    $(".btn-delete-inquiry").click(function(){
        var iid = $(this).attr("data-id");
        $("#iid").val(iid);
        $("#modalDeleteInquiry").modal('show');
    });

    $(".btn-view-inquiry").click(function(){
        var iid = $(this).attr("data-id");
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading...</div>';
        var url = base_url + '/booking/_view_inquiry_details';

        $("#modalViewInquiry").modal('show');

        $(".view-inquiry-body").html(msg);
        
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {iid:iid},
               success: function(o)
               {
                  $(".view-inquiry-body").html(o);
               }
            });
        }, 1000);
    });

});
</script>