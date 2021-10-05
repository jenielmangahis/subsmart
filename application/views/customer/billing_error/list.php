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
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 30px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
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
                    <div class="card p-20" style="min-height: 400px !important;">
                      <div class="row">
                        <div class="col-sm-6 left">
                          <h3 class="page-title mt-0">Billing Errors</h3>
                        </div>
                      </div>
                      <div class="alert alert-warning mt-1 mb-4" role="alert">
                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Listing of recurring billing errors that needs to be fix.
                          </span>
                      </div>
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" id="dt-billing-errors">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>                                                                        
                                    <th>Error</th>
                                    <th>Error Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($billingErrors as $b){ ?>
                                    <?php if( $b->error_date != '' ){ ?>
                                    <tr>
                                        <td><?= $b->error_date != '' ? date("m/d/Y", strtotime($b->error_date)) : '---'; ?></td>
                                        <td><?= $b->first_name . ' ' . $b->last_name; ?></td>
                                        <td><?= $b->error_message; ?></td>
                                        <td><?= $b->error_type; ?></td>
                                        <td>
                                          <a class="btn btn-sm btn-primary btn-fix-cc-error" data-id="<?= $b->bill_id; ?>" href="javascript:void(0);"><i class="fa fa-pencil"></i> Fix</a>
                                          <a class="btn btn-sm btn-primary" href="<?= base_url("customer/subscription/" . $b->fk_prof_id); ?>"><i class="fa fa-eye"></i> View Subscription</a>
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

    </div>
    <!-- page wrapper end -->
</div>


<script type="text/javascript">
$(function(){
    var table = $('#dt-billing-errors').DataTable({
        "searching" : false,
        "pageLength": 10,
        "autoWidth": false,
        "order": [],
         "aoColumnDefs": [
          { "sWidth": "10%", "aTargets": [ 0 ] },
          { "sWidth": "20%", "aTargets": [ 1 ] },
          { "sWidth": "45%", "aTargets": [ 2 ] },
          { "sWidth": "10%", "aTargets": [ 3 ] },
          { "sWidth": "15%", "aTargets": [ 3 ] },
        ]
    });

    $(".btn-fix-cc-error").click(function(){
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
                              location.reload();
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
});
</script>
<?php include viewPath('includes/footer'); ?>
