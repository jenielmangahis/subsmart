<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include viewPath('v2/includes/header'); ?>
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

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_subtabs'); ?>
    </div>

    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage inquiries from your online booking form.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-9 tbl">
                    <?php include viewPath('flash'); ?>
                        <table class="nsm-table" data-id="coupons">
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('includes/booking_modals'); ?> 
<?php //include viewPath('includes/footer_booking'); ?>
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
<?php include viewPath('v2/includes/footer'); ?>