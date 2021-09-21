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
                                        <li class="nav-item nav-all active">
                                            <a class="nav-link" id="c-active-tab" data-toggle="tab" href="#all-campaigns" role="tab" aria-controls="One" aria-selected="true">Active <span class="sms-total-all sms-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-active">
                                            <a class="nav-link" id="c-completed-tab" data-toggle="tab" href="#active-campaigns" role="tab" aria-controls="One" aria-selected="true">Completed <span class="sms-total-active sms-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-scheduled">
                                            <a class="nav-link" id="c-scheduled-tab" data-toggle="tab" href="#scheduled-campaigns" role="tab" aria-controls="Two" aria-selected="false">With Billing Errors <span class="sms-total-scheduled sms-tab-counter"></span></a>
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

        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    var active_tab = 'active';

    $("#c-active-tab").click(function(){
        active_tab = 'active';
        $(".nav-item").removeClass('active');
        $(this).closest(".nav-item").addClass('active');
        load_active_subscriptions();
    });

    $("#c-scheduled-tab").click(function(){
        active_tab = 'scheduled';
        $(".nav-item").removeClass('active');
        $(".nav-scheduled").addClass('active');
        load_scheduled_campaigns();
    });

    $("#c-closed-tab").click(function(){
        active_tab = 'closed';
        $(".nav-item").removeClass('active');
        $(".nav-closed").addClass('active');
        load_closed_campaigns();
    });

    $("#c-draft-tab").click(function(){
        active_tab = 'draft';
        $(".nav-item").removeClass('active');
        $(".nav-draft").addClass('active');
        load_draft_campaigns();
    });

    load_all_campaigns();
    //load_campaign_tab_counter();

    function load_all_campaigns(){
        load_campaigns('all', 'all-campaigns');
    }

    function load_active_campaigns(){
        load_campaigns('<?= $status_active; ?>');
    }

    function load_scheduled_campaigns(){
        load_campaigns('<?= $status_scheduled; ?>');
    }

    function load_closed_campaigns(){
        load_campaigns('<?= $status_closed; ?>');
    }

    function load_draft_campaigns(){
        load_campaigns('<?= $status_draft; ?>');
    }

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
                    "order": [],
                     "aoColumnDefs": [
                      { "sWidth": "40%", "aTargets": [ 0 ] },
                      { "sWidth": "20%", "aTargets": [ 1 ] },
                      { "sWidth": "20%", "aTargets": [ 2 ] },
                      { "sWidth": "20%", "aTargets": [ 3 ] },
                    ]
                });
             }
          });
        }, 1000);
    }

    function load_campaigns(status){
        var url = base_url + 'sms_campaigns/_load_campaigns/'+status;
        $(".campaign-list-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             //data: ,
             success: function(o)
             {
                $(".campaign-list-container").html(o);
                //table.destroy();
                var table = $('#dataTableCampaign').DataTable({
                    "searching" : false,
                    "pageLength": 10,
                    "order": [],
                     "aoColumnDefs": [
                      { "sWidth": "40%", "aTargets": [ 0 ] },
                      { "sWidth": "20%", "aTargets": [ 1 ] },
                      { "sWidth": "20%", "aTargets": [ 2 ] },
                      { "sWidth": "20%", "aTargets": [ 3 ] },
                      { "sWidth": "10%", "aTargets": [ 4 ] }
                    ]
                });

                $(".clone-sms-campaign").click(function(){                  
                  var campaign_name = $(this).attr("data-name");
                  var campaign_id = $(this).attr("data-id");

                  $("#clone-smsid").val(campaign_id);
                  $(".clone-modal-footer").show();
                  $(".clone-body-container").html('<p>Are you sure you want clone the campaign <b><span class="clone-campaign-name"></span></b>?</p>');
                  $(".clone-campaign-name").html(campaign_name);
                  $("#modalCloneCampaign").modal('show');
                });

                $(".close-sms-campaign").click(function(){
                  var campaign_name = $(this).attr("data-name");
                  var campaign_id = $(this).attr("data-id");
                  $("#smsid").val(campaign_id);
                  $(".close-modal-footer").show();
                  $(".close-body-container").html('<p>Are you sure you want close the campaign <b><span class="close-campaign-name"></span></b>?</p>');
                  $(".close-campaign-name").html(campaign_name);
                  $("#modalCloseCampaign").modal('show');
                });
             }
          });
        }, 1000);
    }

    function load_campaign_tab_counter(){
        var url = base_url + 'sms_campaigns/_load_sms_campaign_counter';
        $(".sms-tab-counter").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType:"json",
             success: function(o)
             {
               $(".sms-total-all").html("("+o.total_sms+")");
               $(".sms-total-scheduled").html("("+o.total_scheduled+")");
               $(".sms-total-active").html("("+o.total_active+")");
               $(".sms-total-closed").html("("+o.total_closed+")");
               $(".sms-total-draft").html("("+o.total_draft+")");
             }
          });
        }, 800);
    }

    $("#form-clone-campaign").submit(function(e){
      e.preventDefault();
      var url = base_url + 'sms_campaigns/_clone_campaign';
      $(".btn-clone-campaign").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data : $("#form-clone-campaign").serialize(),
           dataType:"json",
           success: function(o)
           {
             $(".btn-clone-campaign").html('Yes');
             $(".clone-modal-footer").hide();
             if( o.sms_id > 1 ){
              location.href = base_url + "sms_campaigns/edit_campaign/" + o.sms_id;
             }else{
              $(".clone-body-container").html("<div class='alert alert-danger'>"+o.msg+"</div>");
             }

           }
        });                    
      }, 800);
    });

    $("#form-close-campaign").submit(function(e){
      e.preventDefault();
      var url = base_url + 'sms_campaigns/_close_campaign';
      $(".btn-close-campaign").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data : $("#form-close-campaign").serialize(),
           dataType:"json",
           success: function(o)
           {
             $(".btn-close-campaign").html('Yes');
             $(".close-modal-footer").hide();
             if( o.is_success == 1 ){
              $(".close-body-container").html("<div class='alert alert-info'>"+o.msg+"</div>");
              if( active_tab == 'all' ){
                load_all_campaigns();
              }else if( active_tab == 'closed' ){
                load_closed_campaigns();
              }else if( active_tab == 'active' ){
                load_active_campaigns();
              }else if( active_tab == 'draft' ){
                load_draft_campaigns();
              }else if( active_tab == 'scheduled' ){
                load_scheduled_campaigns();
              }
              load_campaign_tab_counter();
             }else{
              $(".close-body-container").html("<div class='alert alert-danger'>"+o.msg+"</div>");
             }

           }
        });                    
      }, 800);
    });


});

</script>
