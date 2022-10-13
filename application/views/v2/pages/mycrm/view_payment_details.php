<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/my_crm_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Payment Details
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary" href="<?php echo url('mycrm/order_pdf/' . $payment->id) ?>" target="_new" style="margin-right: 10px;">PDF Order</a>
                            <a class="nsm-button primary" href="<?php echo url('mycrm/invoice_pdf/' . $payment->id) ?>" target="_new" style="margin-right: 10px;">PDF Invoice</a>
                            <a class="nsm-button primary" href="<?php echo url('mycrm/orders') ?>" style="margin-right: 10px;">Back to list</a>
                        </div>
                    </div>
                </div>
                <table class="table table-no-border table-payment-details">
                  <tr>
                    <td colspan="2"><h4 style="font-size: 31px;margin-bottom: 37px;">Order # <?= $payment->order_number; ?></h4></td>
                  </tr>
                  <tr>
                    <td style="width:200px;">Payment Date:</td>
                    <td style="font-weight: bold;"><?= date("d-M-Y H:i", strtotime($payment->payment_date)); ?></td>
                  </tr>
                  <tr>
                    <td style="width:200px;">Customer:</td>
                    <td style="font-weight: bold;"><?= $company->business_name; ?></td>
                  </tr>
                </table>
                <table class="table table-payment-details">
                  <tr>
                    <td style="width:100px;font-weight: bold;">Item</td>
                    <td style="width:50px;font-weight: bold;">Qty</td>
                    <td style="width:300px;font-weight: bold;">Details</td>
                    <td style="width:50px;font-weight: bold;text-align: right;">Subtotal</td>
                  </tr>
                  <tr>
                    <td>
                      <?php 
                        if( $payment->description == 'Paid Plan License' ){
                          echo "nSmarTrac License";
                        }else{
                          echo "nSmarTrac Subscription";    
                        }
                      ?>
                      
                    </td>
                    <td>1</td>
                    <td>
                      <span><?= $payment->description; ?></span><br />                                  
                    </td>
                    <td style="text-align: right;">
                      $<?= number_format($payment->total_amount, 2); ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align: right;"><b>TOTAL</b></td>
                    <td colspan="3" style="text-align: right;"><b>$<?= number_format($payment->total_amount, 2); ?></b></td>
                  </tr>
                </table>                 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>