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
                            <h3 class="page-title">Deals & Steals</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                              <div class="text-right">
                                  <a href="<?php echo url('promote/create_deals') ?>" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Create Deal</a><br />
                              </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Listing the deals that are currently running.
                            </span>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <!-- Main content -->
                        <section class="content">
                            <div class="tabs mt-2">
                                <ul class="clearfix ul-mobile" id="myTab" role="tablist">
                                        <li class="nav-item nav-active active">
                                            <a class="nav-link" id="c-active-tab" href="javascript:void(0);">Active Deals <span class="deals-total-active deals-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-scheduled">
                                            <a class="nav-link" id="c-scheduled-tab" href="javascript:void(0);">Scheduled <span class="deals-total-scheduled deals-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-ended">
                                            <a class="nav-link" id="c-ended-tab" href="javascript:void(0);">Ended <span class="deals-total-ended deals-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-draft">
                                            <a class="nav-link" id="c-draft-tab" data-toggle="tab" href="#draft-campaigns" role="tab" aria-controls="Three" aria-selected="false">Draft <span class="deals-total-draft deals-tab-counter"></span></a>
                                        </li>
                                </ul>
                            </div>
                            <div class="deals-list-container"></div>
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
                  <?php echo form_input(array('name' => 'smsid', 'type' => 'hidden', 'value' => '', 'id' => 'smsid'));?>
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

            <!-- Modal Close Deals  -->
            <div class="modal fade bd-example-modal-sm" id="modalCloseDeal" tabindex="-1" role="dialog" aria-labelledby="modalCloseDealTitle" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-info"></i> Close Deal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-close-deal', 'autocomplete' => 'off' ]); ?>
                  <?php echo form_input(array('name' => 'deal_id', 'type' => 'hidden', 'value' => '', 'id' => 'deal-id'));?>
                  <div class="modal-body clone-body-container">
                      <p>Are you sure you want clone the campaign <b><span class="clone-campaign-name"></span></b>?</p>
                  </div>
                  <div class="modal-footer clone-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary btn-close-deal">Yes</button>
                  </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>

            <!-- Modal Delete Deals  -->
            <div class="modal fade bd-example-modal-sm" id="modalDeleteDeal" tabindex="-1" role="dialog" aria-labelledby="modalDeleteDealTitle" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Deal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-delete-deal', 'autocomplete' => 'off' ]); ?>
                  <?php echo form_input(array('name' => 'deal_id', 'type' => 'hidden', 'value' => '', 'id' => 'delete-deal-id'));?>
                  <div class="modal-body clone-body-container">
                      <p>Are you sure you want clone the campaign <b><span class="clone-campaign-name"></span></b>?</p>
                  </div>
                  <div class="modal-footer clone-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger btn-delete-deal">Yes</button>
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
    load_active_list();
    load_status_tab_counter();

    $("#c-active-tab").click(function(){
        active_tab = 'active';
        $(".nav-item").removeClass('active');
        $(".nav-active").addClass('active');
        load_active_list();
    });

    $("#c-scheduled-tab").click(function(){
        active_tab = 'scheduled';
        $(".nav-item").removeClass('active');
        $(".nav-scheduled").addClass('active');
        load_scheduled_list();
    });

    $("#c-ended-tab").click(function(){
        active_tab = 'ended';
        $(".nav-item").removeClass('active');
        $(".nav-ended").addClass('active');
        load_ended_list();
    });

    $("#c-draft-tab").click(function(){
        active_tab = 'draft';
        $(".nav-item").removeClass('active');
        $(".nav-draft").addClass('active');
        load_draft_list();
    });

    function load_active_list(){
        load_deals_steals_list('<?= $status_active; ?>');
    }

    function load_scheduled_list(){
        load_deals_steals_list('<?= $status_scheduled; ?>');
    }

    function load_ended_list(){
        load_deals_steals_list('<?= $status_ended; ?>');
    }

    function load_draft_list(){
        load_deals_steals_list('<?= $status_draft; ?>');
    }

    function load_deals_steals_list(status){
        var url = base_url + 'promote/_load_deals_list/'+status;
        $(".deals-list-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             //data: ,
             success: function(o)
             {
                $(".deals-list-container").html(o);
                //table.destroy();
                var table = $('#dataTableDealsSteals').DataTable({
                    "searching" : false,
                    "pageLength": 10,
                    "order": [],
                     "aoColumnDefs": [
                      { "sWidth": "50%", "aTargets": [ 0 ] },
                      { "sWidth": "10%", "aTargets": [ 1 ] },
                      { "sWidth": "10%", "aTargets": [ 2 ] },
                      { "sWidth": "10%", "aTargets": [ 3 ] },
                      { "sWidth": "10%", "aTargets": [ 4 ] }                      
                    ]
                });                
             }
          });
        }, 1000);

        $(document).on('click', '.close-deal', function(){
          var title   = $(this).attr("data-name");
          var deal_id = $(this).attr("data-id");

          $("#deal-id").val(deal_id);
          $(".clone-body-container").html('<p>You are about to close the deal <b><span class="deal-name"></span></b>?</p><p class="text-ter">Please be aware that no money will be refunded for remaining period.</p>');
          $(".deal-name").html(title);
          $(".btn-close-deal").html('Yes');
          $("#modalCloseDeal").modal('show');
        });

        $(document).on('click', '.delete-deals', function(){
          var title   = $(this).attr("data-name");
          var deal_id = $(this).attr("data-id");

          $("#delete-deal-id").val(deal_id);
          $(".clone-body-container").html('<p>You are about to delete the deal <b>'+title+'</b>?</p>');          
          $(".btn-delete-deal").html('Yes');
          $("#modalDeleteDeal").modal('show');
        });
    }

    function load_status_tab_counter(){
        var url = base_url + 'promote/_load_status_counter';
        $(".deals-tab-counter").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType:"json",
             success: function(o)
             {               
               $(".deals-total-scheduled").html("("+o.total_scheduled+")");
               $(".deals-total-active").html("("+o.total_active+")");
               $(".deals-total-ended").html("("+o.total_ended+")");
               $(".deals-total-draft").html("("+o.total_draft+")");
             }
          });
        }, 800);
    }

    $("#form-close-deal").submit(function(e){
      e.preventDefault();
      var url = base_url + 'promote/_close_deal';
      $(".btn-close-deal").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data : $("#form-close-deal").serialize(),
           dataType:"json",
           success: function(o)
           {
             $("#modalCloseDeal").modal('hide');
             if( o.is_success == 1 ){
              Swal.fire({
                  title: 'Update Successful!',
                  text: 'Deals was successfully closed',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#32243d',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok'
              }).then((result) => {
                  if( active_tab == 'ended' ){
                    load_ended_list();
                  }else if( active_tab == 'active' ){
                    load_active_list();
                  }else if( active_tab == 'draft' ){
                    load_draft_list();
                  }else if( active_tab == 'scheduled' ){
                    load_scheduled_list();
                  }
                  load_status_tab_counter();
              });              
              
             }else{
              Swal.fire({
                icon: 'error',
                title: o.msg,
                text: 'Cannot close deals'
              });
             }

           }
        });                    
      }, 800);
    });

    $("#form-delete-deal").submit(function(e){
      e.preventDefault();
      var url = base_url + 'promote/_delete_deal';
      $(".btn-delete-deal").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data : $("#form-delete-deal").serialize(),
           dataType:"json",
           success: function(o)
           {
             $("#modalDeleteDeal").modal('hide');
             if( o.is_success == 1 ){
              Swal.fire({
                  title: 'Delete Successful!',
                  text: 'Deals was successfully deleted',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#32243d',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok'
              }).then((result) => {
                  if( active_tab == 'ended' ){
                    load_ended_list();
                  }else if( active_tab == 'active' ){
                    load_active_list();
                  }else if( active_tab == 'draft' ){
                    load_draft_list();
                  }else if( active_tab == 'scheduled' ){
                    load_scheduled_list();
                  }
                  load_status_tab_counter();
              });              
              
             }else{
              Swal.fire({
                icon: 'error',
                title: o.msg,
                text: 'Cannot delete deals'
              });
             }

           }
        });                    
      }, 800);
    });
});

</script>
