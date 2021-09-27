<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
img.event-marker {
    display: block;
    margin: 0 auto;
}
tr.odd {
    background: #f1f1f1 !important;
}
table.table tbody tr td {
    width: 15%;
    text-align: right;
}
table.table tbody tr td:first-child {
    width: 85%;
    text-align: left;
}
table.dataTable {
    border-collapse: collapse;
    margin-top: 5px;
}
table.dataTable thead tr th {
    border: 1px solid black !important;
}
table.dataTable tbody tr td {
    border: 1px solid black !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.event-marker{
  height: 50px;
  width: 50px;
  border: 1px solid #dee2e6;
}
#modal-view-payment-history .modal-dialog {
    max-width: 1002px; 
}
.modal-backdrop {
    width: 103vw;
    height: 103vh;
}

</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0" style="min-height: 400px !important;">
                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Customer Subscriptions</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1"></div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Listing of customer subscriptions.
                            </span>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <!-- Main content -->
                        <section class="content">
                            <div class="tabs mt-2">
                                <ul class="clearfix ul-mobile" id="myTab" role="tablist">
                                        <li class="nav-item active">
                                            <a class="nav-link" id="c-active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="One" aria-selected="true">Active <span class="total-active tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="c-completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="One" aria-selected="true">Completed <span class="total-completed tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="c-error-tab" data-toggle="tab" href="#errors" role="tab" aria-controls="Two" aria-selected="false">Billing Errors <span class="total-billing-errors tab-counter"></span></a>
                                        </li>
                                </ul>
                            </div>
                            <div class="subscriptions-list-container"></div>
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

            <div class="modal fade" id="modal-edit-cc-details" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="">Update Credit Card Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="frm-update-credit-card-details" method="post">
                  <input type="hidden" name="bid" id="bid" value="">
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-12">                          
                              <div class="card-body body-card-details" style="padding: 10px;"></div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                      <button class="btn btn-primary btn-update-cc-details" type="submit">Update</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="modal-view-payment-history" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Payment History</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body payment-history-container"></div>
                        <div class="modal-footer">
                              <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        </div>  
                    </div>
                </div>
            </div>  
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    var active_tab = 'active';

    $(document).on('click', '.btn-view-payment-history', function(){
        var customer_id = $(this).attr("data-customer-id");
        var billing_id  = $(this).attr("data-billing-id");
        var url = base_url + 'customer/_load_subscription_payment_history';

        $(".payment-history-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {customer_id:customer_id, billing_id:billing_id},
               success: function(o)
               {
                  $(".payment-history-container").html(o);
                  var table = $('#dt-payment-history').DataTable({
                        "searching" : false,
                        "pageLength": 10,
                        "autoWidth" : false,
                        "order": [],
                         "aoColumnDefs": [
                          { "sWidth": "30%", "aTargets": [ 0 ] },
                          { "sWidth": "20%", "aTargets": [ 1 ] },
                          { "sWidth": "20%", "aTargets": [ 2 ] },
                          { "sWidth": "20%", "aTargets": [ 3 ] },
                        ]
                    });
               }
            });
        }, 1000);
        
        $("#modal-view-payment-history").modal('show');
    });

    $("#c-active-tab").click(function(){
        active_tab = 'active';
        $(".nav-item").removeClass('active');
        $(this).closest(".nav-item").addClass('active');
        load_active_subscriptions();
    });

    $("#c-completed-tab").click(function(){
        active_tab = 'completed';
        $(".nav-item").removeClass('active');
        $(this).closest(".nav-item").addClass('active');        
        load_completed_subscriptions();
    });

    $("#c-error-tab").click(function(){
        active_tab = 'error';
        $(".nav-item").removeClass('active');
        $(this).closest(".nav-item").addClass('active');        
        load_billing_errors();
    });

    $(document).on('click', '.btn-fix-cc-error', function(){
        var billing_id = $(this).attr("data-id");
        var url = base_url + 'customer/_load_billing_credit_card_details';

        $("#bid").val(billing_id);
        $(".body-card-details").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {billing_id:billing_id},
               success: function(o)
               {
                  $(".body-card-details").html(o);
               }
            });
        }, 1000);

        $("#modal-edit-cc-details").modal('show');
    });

    $("#frm-update-credit-card-details").submit(function(e){
        e.preventDefault();
        var url = base_url + 'customer/_update_billing_credit_card_details';
        $(".btn-update-cc-details").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-update-credit-card-details").serialize(),
               success: function(o)
               {                    
                    if( o.is_success == 1 ){
                      $("#modal-edit-cc-details").modal('hide'); 
                      
                      Swal.fire({
                          title: 'Update Successful!',
                          text: "Your billing credit card info was successfully updated.",
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {
                              load_billing_errors();
                          }
                      });

                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot update billing',
                        text: o.msg
                      });
                    }

                    $(".btn-update-cc-details").html('Update');
                }
            });
        }, 1000);
    });

    load_active_subscriptions();
    load_subscription_list_counter();

    function load_active_subscriptions(){
        var url = base_url + 'customer/_load_active_subscriptions';
        $(".subscriptions-list-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             //data: ,
             success: function(o)
             {
                $(".subscriptions-list-container").html(o);
                //table.destroy();
                var table = $('#dt-active-subscriptions').DataTable({
                    "searching" : false,
                    "pageLength": 10,
                    "autoWidth" : false,
                    "order": [],
                     "aoColumnDefs": [
                      { "sWidth": "45%", "aTargets": [ 0 ] },
                      { "sWidth": "10%", "aTargets": [ 1 ] },
                      { "sWidth": "10%", "aTargets": [ 2 ] },
                      { "sWidth": "20%", "aTargets": [ 3 ] },
                    ]
                });
             }
          });
        }, 1000);
    }

    function load_completed_subscriptions(){
        var url = base_url + 'customer/_load_completed_subscriptions';
        $(".subscriptions-list-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             //data: ,
             success: function(o)
             {
                $(".subscriptions-list-container").html(o);
                //table.destroy();
                var table = $('#dt-completed-subscriptions').DataTable({
                    "searching" : false,
                    "pageLength": 10,
                    "autoWidth" : false,
                    "order": [],
                     "aoColumnDefs": [
                      { "sWidth": "45%", "aTargets": [ 0 ] },
                      { "sWidth": "20%", "aTargets": [ 1 ] },
                      { "sWidth": "20%", "aTargets": [ 2 ] },
                      { "sWidth": "10%", "aTargets": [ 3 ] },
                    ]
                });
             }
          });
        }, 1000);
    }

    function load_billing_errors(){
        var url = base_url + 'customer/_load_billing_error_subscriptions';
        $(".subscriptions-list-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             //data: ,
             success: function(o)
             {
                $(".subscriptions-list-container").html(o);
                //table.destroy();
                var table = $('#dt-error-subscriptions').DataTable({
                    "searching" : false,
                    "pageLength": 10,
                    "autoWidth": false,
                    "order": [],
                     "aoColumnDefs": [
                      { "sWidth": "30%", "aTargets": [ 0 ] },
                      { "sWidth": "20%", "aTargets": [ 1 ] },
                      { "sWidth": "30%", "aTargets": [ 2 ] },
                      { "sWidth": "15%", "aTargets": [ 3 ] },
                    ]
                });
             }
          });
        }, 1000);
    }

    function load_subscription_list_counter(){
        var url = base_url + 'customer/_load_subscription_list_counter';
        $(".tab-counter").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType:"json",
             success: function(o)
             {
               $(".total-active").html("("+o.total_active+")");
               $(".total-completed").html("("+o.total_completed+")");
               $(".total-billing-errors").html("("+o.total_billing_errors+")");
             }
          });
        }, 800);
    }
});

</script>
