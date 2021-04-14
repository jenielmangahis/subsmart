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
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0" style="min-height: 400px !important;">
                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Email Blast</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                              <div class="text-right">
                                  <a href="<?php echo url('email_campaigns/add_email_blast') ?>" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Create Email Blast</a><br />
                              </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Listing the campaigns that are currently running.
                            </span>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <!-- Main content -->
                        <section class="content">
                            <div class="tabs mt-2">
                                <ul class="clearfix ul-mobile" id="myTab" role="tablist">
                                        <li class="nav-item nav-all active">
                                            <a class="nav-link" id="c-all-tab" data-toggle="tab" href="#all-campaigns" role="tab" aria-controls="One" aria-selected="true">All Campaigns <span class="email-total-all email-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-active">
                                            <a class="nav-link" id="c-active-tab" data-toggle="tab" href="#active-campaigns" role="tab" aria-controls="One" aria-selected="true">Active Campaigns <span class="email-total-active email-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-scheduled">
                                            <a class="nav-link" id="c-scheduled-tab" data-toggle="tab" href="#scheduled-campaigns" role="tab" aria-controls="Two" aria-selected="false">Scheduled <span class="email-total-scheduled email-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-closed">
                                            <a class="nav-link" id="c-closed-tab" data-toggle="tab" href="#closed-campaigns" role="tab" aria-controls="Three" aria-selected="false">Closed <span class="email-total-closed email-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-draft">
                                            <a class="nav-link" id="c-draft-tab" data-toggle="tab" href="#draft-campaigns" role="tab" aria-controls="Three" aria-selected="false">Draft <span class="email-total-draft email-tab-counter"></span></a>
                                        </li>
                                </ul>
                            </div>
                            <div class="campaign-list-container"></div>
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

            <!-- Modal Close SMS  -->
            <div class="modal fade bd-example-modal-sm" id="modalCloseCampaign" tabindex="-1" role="dialog" aria-labelledby="modalCloseCampaignTitle" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Close</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-close-campaign', 'autocomplete' => 'off' ]); ?>
                  <?php echo form_input(array('name' => 'emailid', 'type' => 'hidden', 'value' => '', 'id' => 'close-emailid'));?>
                  <div class="modal-body close-body-container">
                      <p>Are you sure you want close the campaign <b><span class="close-campaign-name"></span></b>?</p>
                  </div>
                  <div class="modal-footer close-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger btn-close-campaign">Yes</button>
                  </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>

            <!-- Modal Clone Campaign  -->
            <div class="modal fade bd-example-modal-sm" id="modalCloneCampaign" tabindex="-1" role="dialog" aria-labelledby="modalCloneCampaignTitle" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-files-o icon"></i> Clone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-clone-campaign', 'autocomplete' => 'off' ]); ?>
                  <?php echo form_input(array('name' => 'emailid', 'type' => 'hidden', 'value' => '', 'id' => 'clone-emailid'));?>
                  <div class="modal-body clone-body-container">
                      <p>Are you sure you want clone the campaign <b><span class="clone-campaign-name"></span></b>?</p>
                  </div>
                  <div class="modal-footer clone-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary btn-clone-campaign">Yes</button>
                  </div>
                  <?php echo form_close(); ?>
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
    var active_tab = 'all';

    $("#c-all-tab").click(function(){
        active_tab = 'all';
        $(".nav-item").removeClass('active');
        $(".nav-all").addClass('active');
        load_all_campaigns();
    });

    $("#c-active-tab").click(function(){
        active_tab = 'active';
        $(".nav-item").removeClass('active');
        $(".nav-active").addClass('active');
        load_active_campaigns();
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
    load_campaign_tab_counter();

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

    function load_campaigns(status){
        var url = base_url + 'email_campaigns/_load_campaigns/'+status;
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
             }
          });
        }, 1000);

        $(document).on('click', '.clone-email-campaign', function(){
          var campaign_name = $(this).attr("data-name");
          var campaign_id = $(this).attr("data-id");

          $("#clone-emailid").val(campaign_id);
          $(".clone-modal-footer").show();
          $(".clone-body-container").html('<p>Are you sure you want clone the campaign <b><span class="clone-campaign-name"></span></b>?</p>');
          $(".clone-campaign-name").html(campaign_name);
          $("#modalCloneCampaign").modal('show');
        });

        $(document).on('click', '.close-email-campaign', function(){
          var campaign_name = $(this).attr("data-name");
          var campaign_id = $(this).attr("data-id");
          $("#close-emailid").val(campaign_id);
          $(".close-modal-footer").show();
          $(".close-body-container").html('<p>Are you sure you want close the campaign <b><span class="close-campaign-name"></span></b>?</p>');
          $(".close-campaign-name").html(campaign_name);
          $("#modalCloseCampaign").modal('show');
        });
    }

    function load_campaign_tab_counter(){
        var url = base_url + 'email_campaigns/_load_email_campaign_counter';
        $(".sms-tab-counter").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType:"json",
             success: function(o)
             {
               $(".email-total-all").html("("+o.total_email+")");
               $(".email-total-scheduled").html("("+o.total_scheduled+")");
               $(".email-total-active").html("("+o.total_active+")");
               $(".email-total-closed").html("("+o.total_closed+")");
               $(".email-total-draft").html("("+o.total_draft+")");
             }
          });
        }, 800);
    }

    $("#form-clone-campaign").submit(function(e){
      e.preventDefault();
      var url = base_url + 'email_campaigns/_clone_campaign';
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
             if( o.email_id > 1 ){
              location.href = base_url + "email_campaigns/edit_campaign/" + o.email_id;
             }else{
              $(".clone-body-container").html("<div class='alert alert-danger'>"+o.msg+"</div>");
             }

           }
        });                    
      }, 800);
    });

    $("#form-close-campaign").submit(function(e){
      e.preventDefault();
      var url = base_url + 'email_campaigns/_close_campaign';
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
