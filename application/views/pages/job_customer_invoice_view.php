<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header_front'); ?>
<?php include viewPath('job/css/job_new'); ?>
<style>
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117) !important;
    }
    .card-body {
        padding: 0 !important;
    }
    .right-text{
        position: relative;
        float:right;
        right: 0;
        bottom: 10px;
    }
    #map{
        height: 190px;
    }
    .title-border{
        border-bottom: 2px solid rgba(0,0,0,.1);
        padding-bottom: 5px;
    }
    .icon_preview{
        font-size: 16px;
        color : #45a73c;
    }
</style>
<script src="https://api.convergepay.com/hosted-payments/PayWithConverge.js"></script>
<div>
    <!-- page wrapper start -->
    <div>
        <div class="container-fluid">
            <br class="clear"/>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="right-text">
                                <p class="page-title " style="font-weight: 700;font-size: 16px;"><?=  $jobs_data->job_number;  ?> </p>
                            </div>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <?php if($company_info->business_image != "" ): ?>
                                        <img style="width: 100px" id="attachment-image" alt="Attachment" src="<?=  '/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image; ?> ">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <table class="right-text">
                                        <tbody>
                                        <tr>
                                            <td align="right" width="45%">Job Type :</td>
                                        </tr>
                                        <tr>
                                            <td align="right" >Job Tags:</td>
                                        </tr>
                                        <tr>
                                            <td align="right" >Date :</td>
                                        </tr>
                                        <tr>
                                            <td align="right" >Priority :</td>
                                        </tr>
                                        <tr>
                                            <td align="right" >Status :</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="right-text">
                                        <tbody>
                                        <tr>
                                            <td align="right" width="65%"><?= $jobs_data->job_type;  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right" ><?= $jobs_data->name;  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right" style="color: darkred;"><?=  $jobs_data->priority;  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right" style="font-weight: 600;"><?=  $jobs_data->status;  ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                    <div class="col-md-6">
                                        <br>
                                        <h6 class="title-border">FROM :</h6>
                                        <b><?= $company_info->business_name; ?></b><br>
                                        <span><?= $company_info->street; ?></span><br>
                                        <span><?= $company_info->city.', '.$company_info->state.' '.$company_info->postal_code ; ?></span><br>
                                        <span> Phone: <?= $company_info->business_phone ; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <h6 class="title-border">TO :</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <b><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></b><br>
                                                <span><?= $jobs_data->mail_add; ?></span><br>
                                                <span><?= $jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span> <span class="fa fa-copy icon_preview"></span><br>
                                                <span>Email: <?= $jobs_data->cust_email ; ?></span> <a href="mailto:<?= $jobs_data->cust_email ; ?>"><span class="fa fa-envelope icon_preview"></span></a><br>
                                                <span>Phone:  </span>
                                                <?php if($jobs_data->phone_h!="" || $jobs_data->phone_h!=NULL): ?>
                                                    <?= $jobs_data->phone_h;  ?>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                <?php else : echo 'N/A';?>
                                                <?php endif; ?>
                                                <br>
                                                <span>Mobile: </span>
                                                <?php if($jobs_data->phone_m!="" || $jobs_data->phone_m!=NULL): ?>
                                                    <?= $jobs_data->phone_h;  ?>
                                                    <?= $jobs_data->phone_m;  ?>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                <?php else : echo 'N/A';?>
                                                <?php endif; ?>
                                                <br>
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-md-12">
                                    <h6 class="title-border">JOB DETAILS :</h6>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td>Items</td>
                                            <td>Qty</td>
                                            <td>Price</td>
                                            <td>Total</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $subtotal = 0.00;
                                        foreach ($jobs_data_items as $item):
                                            $total = $item->price * $item->qty;
                                            ?>
                                            <tr>
                                                <td><?= $item->title; ?></td>
                                                <td><?= $item->qty; ?></td>
                                                <td>$<?= $item->price; ?></td>
                                                <td>$<?= number_format((float)$total,2,'.',','); ?></td>
                                            </tr>
                                            <?php
                                            $subtotal = $subtotal + $total;
                                        endforeach;
                                        ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <b>Sub Total</b>
                                    <b class="right-text">$<?= number_format((float)$subtotal,2,'.',','); ?></b>
                                    <br><hr>

                                    <?php if($jobs_data->tax != NULL): ?>
                                        <b>Tax </b>
                                        <i class="right-text">$0.00</i>
                                        <br><hr>
                                    <?php endif; ?>

                                    <?php if($jobs_data->discount != NULL): ?>
                                        <b>Discount </b>
                                        <i class="right-text">$0.00</i>
                                        <br><hr>
                                    <?php endif; ?>

                                    <b>Grand Total</b>
                                    <b class="right-text">$<?= number_format((float)$subtotal,2,'.',','); ?></b>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <h6 class="title-border">NOTES :</h6>
                                    <span><?=  $jobs_data->message; ?></span>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <h6 class="title-border">ASSIGNED TO :</h6>
                                    <?php
                                    $employee_date = get_employee_name($jobs_data->employee_id);
                                    $shared1 = get_employee_name($jobs_data->employee2_id);
                                    $shared2 = get_employee_name($jobs_data->employee3_id);
                                    $shared3 = get_employee_name($jobs_data->employee4_id);
                                    ?>
                                    <span><?= $employee_date->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                    <?php if(isset($shared1) && !empty($shared1) && $shared1!=NULL ): ?>
                                        <span><?= $shared1->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                    <?php endif; ?>
                                    <?php if(isset($shared2) && !empty($shared2) && $shared2!=NULL ): ?>
                                        <span><?= $shared2->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                    <?php endif; ?>
                                    <?php if(isset($shared3) && !empty($shared3) && $shared3!=NULL ): ?>
                                        <span><?= $shared3->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <h6 class="title-border">URL LINK :</h6>
                                    <span><a style="color: darkred;" target="_blank" href="<?= $jobs_data->link; ?>"><?= $jobs_data->link; ?></a></span>
                                </div>

                                <div class="col-md-12">
                                    <h6 class="title-border"></h6>
                                    <span style="font-weight: 700;font-size: 20px;color: darkred;">Total : $<?= number_format((float)$subtotal,2,'.',','); ?></span>
                                    <input type="hidden" id="jobid" value="<?= $jobs_data->job_unique_id; ?>">
                                    <input type="hidden" id="total_amount" value="<?= $subtotal; ?>">
                                    <br /><br />
                                    <a class="btn btn-primary btn-pay-converge" href="javascript:void(0);"> PAY</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <?php //include viewPath('flash'); ?>
                </div>
            </div>
      </div>
    </div>
        <!-- end container-fluid -->
  </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_pages'); ?>
<script>
$(function(){
  $(".btn-pay-converge").click(function(){
    initiateLightbox();
  });

  function initiateLightbox () {
      var job_id = $("#jobid").val();
      var total_amount = $("#total_amount").val();

      var url = base_url + '_converge_request_token';
      $(".btn-pay-converge").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: {job_id:job_id, total_amount:total_amount},
           success: function(o)
           {
              if( o.is_success ){
                  openLightbox(o.token)
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot Process Payment',
                  text: o.msg
                });
                $(".btn-pay-converge").html('Pay');
              }
           }
        });
      }, 1000);
  }

  function openLightbox (token) {
      var paymentFields = {
              ssl_txn_auth_token: token
      };
      var callback = {
          onError: function (error) {
              showResult("error", error);
          },
          onCancelled: function () {
                  showResult("cancelled", "");
          },
          onDeclined: function (response) {
              showResult("declined", JSON.stringify(response, null, '\t'));
          },
          onApproval: function (response) {
              showResult("approval", JSON.stringify(response, null, '\t'));
          }
      };
      PayWithConverge.open(paymentFields, callback);
      return false;
  }
});
</script>
