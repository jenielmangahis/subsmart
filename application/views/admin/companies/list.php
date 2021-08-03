<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/admin_header'); ?>
<style>
.cell-active{
    background-color: #53b94a;
    color: white;
    padding: 4px 0px;
    width: 90%;
    display: block;
    text-align: center;
    border-radius: 20px;
}
.cell-inactive{
    background-color: #585858;
    color: white;
    padding: 4px 0px;
    width: 90%;
    display: block;
    text-align: center;
    border-radius: 20px;
}
.btn{
    border-radius: 0px !important;
}
label>input {
  visibility: initial !important;
  position: initial !important; 
}
</style>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/admin/company'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;">Companies</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">List companies</span>
                            </div>
                        </div>
                        <br />
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" id="companiesTable">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Contact Name</th>
                                    <th>Industry</th>
                                    <th>Plan</th>
                                    <th>Number of License</th>
                                    <th>Status</th>
                                    <th style="width: 22%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($companies as $c) { ?>
                                    <?php if($c->bp_business_name != ''){ ?>
                                        <?php 
                                            $status = "-";
                                            if( $c->is_plan_active == 1 ){
                                                $cell = 'cell-active';
                                                $status = "Active";
                                            }elseif( $c->is_plan_active == 3 ){
                                                $cell = 'cell-inactive';
                                                $status = "Deactivated";
                                            }else{
                                                $cell = 'cell-inactive';
                                                $status = "Expire";
                                            }
                                        ?>                                    
                                        <tr>
                                            <td><?= $c->bp_business_name; ?></td>
                                            <td>
                                                <?php 
                                                    if( $c->bp_contact_name != '' ){
                                                        echo $c->bp_contact_name;
                                                    }else{
                                                        echo "---";
                                                    }
                                                ?>
                                            </td>
                                            <td><?= $c->industry_type_name; ?></td>
                                            <td>
                                                
                                                <div class="col-sm-8 col-md-8" style="background-color: #909da7;padding:5px">
                                                    <div class="plan-option-box" style="color: #ffffff;">
                                                        <span class="plan-option-box-header">
                                                           <?= $c->plan_name; ?>
                                                        </span>
                                                        <div class="plan-option-box-cnt">
                                                            <span class="plan-option-box-value">$<?= $c->price; ?></span>
                                                            <span class="plan-option-box-name">Subscription</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <span class=""><strong>Next Billing:</strong> Month XX, XXXX</span> -->

                                            </td>
                                            <td><?= $c->number_of_license; ?></td>
                                            <td style="text-align: center;color:#ffffff;">
                                                <span class="<?= $cell; ?>">
                                                    <?= $status; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary btn-view-subscription-details" href="javascript:void(0);" data-id="<?= $c->id; ?>"><i class="fa fa-view"></i> View Details</a>
                                                <a class="btn btn-sm btn-primary btn-view-modules-details" href="javascript:void(0);" data-id="<?= $c->id; ?>"><i class="fa fa-view"></i> View Modules</a>
                                                <?php if( $c->is_plan_active == 1 ){ ?>
                                                    <a class="btn btn-sm btn-primary deactivate-company" href="javascript:void(0);" data-name="<?= $c->bp_business_name; ?>" data-id="<?php echo $c->id ?>"><i class="fa fa-close"></i> Deactivate</a>
                                                <?php }else{ ?>
                                                    <a class="btn btn-sm btn-primary activate-company" href="javascript:void(0);" data-name="<?= $c->bp_business_name; ?>" data-id="<?php echo $c->id ?>"><i class="fa fa-check"></i> Activate</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
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
    <!-- Modal View Subscription Details --> 
    <div class="modal fade" id="modalViewSubscriptionDetails" tabindex="-1" role="dialog" aria-labelledby="modalViewSubscriptionDetailsTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="">Subscription Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body booking-info">
              <div id="modal-view-subscription-details-container" class="modal-view-subscription-details-container"></div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modalViewModuleDetails" tabindex="-1" role="dialog" aria-labelledby="modalViewModuleDetailsTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="">Modules List</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body booking-info">
              <div class="modal-view-module-details-container"></div>
            </div>
          </div>
        </div>
    </div>

    <!-- Modal Deactivate / Activate company --> 
    <div class="modal fade" id="modalUpdateStatus">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash"></i> Update Status</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="updateCompanyStataus">
                <input type="hidden" id="status-company-id" name="status_company_id" value="" />
                <input type="hidden" id="status-company-status" name="status_company_status" value="" />
                <div class="modal-body">Are you sure you want to <span class="status-name"></span> company <span class="status-company-name"></span></div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </form>

        </div>
    </div>
</div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/admin_footer'); ?>
<script>
$(function(){
    $('#companiesTable').DataTable({
        "searching": true,
        "sort": false
    });

    $(document).on('click', '.deactivate-company', function(){
        var company_id = $(this).attr('data-id');
        var company_name = $(this).attr('data-name');
        $("#status-company-id").val(company_id);
        $("#status-company-status").val(3);

        $(".status-name").html("<b>Deactivate</b>");
        $(".status-company-name").html("<b>" + company_name + "</b>");
        $("#modalUpdateStatus").modal('show');
    });

    $(document).on('click', '.btn-view-modules-details', function(){
        $("#modalViewModuleDetails").modal('show');

        var sid = $(this).attr("data-id");
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading...</div>';
        var url = base_url + 'admin/ajax_load_company_module_details';

        $(".modal-view-module-details-container").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {sid:sid},
               success: function(o)
               {
                  $(".modal-view-module-details-container").html(o);
               }
            });
        }, 500);
    });

    $(document).on('click', '.activate-company', function(){
        var company_id = $(this).attr('data-id');
        var company_name = $(this).attr('data-name');
        $("#status-company-id").val(company_id);
        $("#status-company-status").val(1);

        $(".status-name").html("<b>Activate</b>");
        $(".status-company-name").html("<b>" + company_name + "</b>");
        $("#modalUpdateStatus").modal('show');
    });

    $(document).on('submit', '#updateCompanyStataus', function(e){
        e.preventDefault();
        $.ajax({
            url: base_url + 'admin/_update_company_status',
            type: "POST",
            dataType: "json",
            data: $('#updateCompanyStataus').serialize(),
            success: function(data) {
                $("#modalUpdateStatus").modal('hide');
                if (data.is_success == 1) {
                    Swal.fire({
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Success',
                        text: "Company status has been updated",
                        icon: 'success'
                    });
                    location.reload();
                } else {
                    Swal.fire({
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Failed',
                        text: "Something is wrong in the process",
                        icon: 'warning'
                    });
                }
            }
        });
    });

    $(".btn-view-subscription-details").click(function(){
        $("#modalViewSubscriptionDetails").modal('show');

        var sid = $(this).attr("data-id");
        
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading...</div>';
        var url = base_url + 'admin/ajax_load_subscriber_details';

        $(".modal-view-subscription-details-container").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {sid:sid},
               success: function(o)
               {
                  $(".modal-view-subscription-details-container").html(o);                  
               }
            });
        }, 500);

    });
});
</script>