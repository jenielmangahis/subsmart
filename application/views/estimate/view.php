<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
.title-border {
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 19px;
    padding: 10px;
}
.customer-link{
  text-decoration:none;
  color:inherit;
}
</style>
<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('includes/notifications'); ?>
<?php //include viewPath('includes/sidebars/estimate'); ?>    
<?php $total_amount = 0; ?>      
<div class="row page-content g-0">          
  <div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
  </div>
  <div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/estimate_subtabs'); ?>
  </div>  
  <div class="col-12">
    <div class="nsm-page">
      <div class="nsm-page-content">
        <div class="row">
            <div class="col-12">
                <div class="nsm-callout primary">
                    <button><i class='bx bx-x'></i></button>
                    For any business, getting customers is only half the battle; creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                </div>
            </div>
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('message'))): ?>
                    <div class="nsm-callout <?= $this->session->flashdata('alert_class') ?>">
                        <button><i class='bx bx-x'></i></button>
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                <?php endif; ?>
            </div>            
        </div>
        
        <div class="row">
          <?php if($estimate){ ?>
              <div class="d-block">
                <div class="col-md-12" style="text-align: right;margin-bottom: 60px;">                          
                  <div class="dropdown d-inline-block">
                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown" style="width:122px;">
                        <span>Action <i class='bx bx-fw bx-chevron-down'></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end select-filter">
                        <li style="font-size:17px;">
                          <a class="dropdown-item send_to_customer" href="javascript:void(0);" acs-id="<?php echo $estimate->customer_id; ?>" est-id="<?php echo $estimate->id; ?>"><i class='bx bxs-envelope' ></i> Send to Customer</a>
                        </li>
                        <li style="font-size:17px;">
                          <?php if($estimate->estimate_type == 'Standard'){ ?>
                            <a class="dropdown-item" href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>"><i class='bx bx-edit'></i> Edit</a>
                          <?php }elseif($estimate->estimate_type == 'Option'){ ?>
                            <a class="dropdown-item" href="<?php echo base_url('estimate/editOption/' . $estimate->id) ?>"><i class='bx bx-edit'></i> Edit</a>
                          <?php }else{ ?>
                            <a class="dropdown-item" href="<?php echo base_url('estimate/editBundle/' . $estimate->id) ?>"><i class='bx bx-edit'></i> Edit</a>  
                          <?php } ?>                                
                        </li>
                        <li style="font-size:17px;">
                          <a class="dropdown-item" target="_new" href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>"><i class='bx bxs-file-pdf'></i> PDF</a>
                        </li>
                        <li style="font-size:17px;">
                          <a class="dropdown-item print-estimate" href="javascript:void(0);"><i class='bx bxs-printer'></i> Print</a>
                        </li>
                        <li style="font-size:17px;">
                          <a class="dropdown-item approveEstimate" href="javascript:void(0);" data-estimatenumber="<?= $estimate->estimate_number; ?>" estimateID="<?php echo $estimate->id; ?>"><i class='bx bx-check-square' ></i> Approve</a>
                        </li>
                    </ul>
                </div>
                  <a class="nsm-button primary" href="<?php echo base_url('estimate/') ?>">BACK TO ESTIMATE LIST</a>
                  <input type="hidden" value="<?php echo getCompanyBusinessProfileImage(); ?>" id="urlLogo">
                </div>
              </div>

              <div id="printableArea" style="">
                  <div class="row">
                    <div class="col-md-2 col-sm-12">                       
                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 300px;" />
                    </div>
                    <div class="col-md-7 col-sm-12"></div>
                    <div class="col-md-3 col-sm-12">
                      <table class="table">
                        <tr>
                          <td colspan="2" style="text-align:left;font-weight:bold;"><h2><?= $estimate->estimate_number; ?></h2></td>
                        </tr>
                        <tr>
                          <td style="text-align:left ;">Estimate Date:</td>
                          <td style="text-align:right;"><b><?= date("F d, Y",strtotime($estimate->estimate_date)); ?></b></td>
                        </tr>
                        <tr>
                          <td style="text-align:left;">Expiry Date:</td>
                          <td style="text-align: right;"><b><?= date("F d, Y",strtotime($estimate->expiry_date)); ?></b></td>
                        </tr>
                        <tr>
                          <td style="text-align:left;">Status:</td>
                          <td style="text-align: right;"><b><?= $estimate->status; ?></b></td>
                        </tr>
                        <?php if( $estimate->customer_id > 0 ){ ?>
                        <tr>
                          <td style="text-align:left;">Business Name:</td>
                          <td style="text-align: right;"><b><?= $customer->business_name; ?></b></td>
                        </tr>
                        <?php } ?>
                      </table>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-md-4 col-12" style="font-size:16px;">
                        <h4 class="title-border">From</h4>
                        <h4><i class="bx bx-buildings"></i> <?= $client->business_name; ?></h4>
                        <div class="col-xl-5 ml-0 pl-0">
                          <span class="ul-text"><?php echo $client->street .' <br>'.$client->city .', '.$client->state .' '.$client->postal_code; ?></span><br>
                          <span class=""><?= $client->business_email; ?></span><br />
                          <span class=""><?= formatPhoneNumber($client->office_phone); ?></span>
                        </div>
                    </div>                    
                    <div class="col-md-4 col-12" style="font-size:16px;">
                        <h4 class="title-border">To</h4>
                        <?php if( $estimate->customer_id > 0 ){ ?>
                          <a class="customer-link" href="<?= base_url('customer/preview_/'.$estimate->customer_id); ?>">
                            <h4><i class='bx bx-user-pin'></i>  <?= $customer->first_name . ' ' . $customer->last_name; ?></h4>
                          </a>
                          <div class="">
                            <span class=""><?= $customer->mail_add . "<br />" . $customer->city.', '. $customer->state .' '. $customer->zip_code;  ?></span><br />
                            <span class=""><span class=""><?= $customer->email; ?></span><br />
                            <span class=""><span class=""><?= formatPhoneNumber($customer->phone_m); ?></span><br />
                          </div>
                        <?php }elseif( $estimate->lead_id > 0 ){ ?>
                          <a class="customer-link" href="<?= base_url('customer/add_lead/'.$estimate->lead_id); ?>">
                            <h4><i class='bx bx-user-pin'></i>  <?= $lead->firstname . ' ' . $lead->lastname; ?></h4>
                          </a>
                          <div class="">
                            <span class=""><?= $lead->address . "<br />" . $lead->city.', '. $lead->state .' '. $lead->zip;  ?></span><br />
                            <span class=""><span class=""><?= $lead->email_add; ?></span><br />
                            <span class=""><span class=""><?= formatPhoneNumber($lead->phone_cell); ?></span><br />
                          </div>
                        <?php } ?>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-md-12" style="max-width:100%;overflow:auto;">
                        <table class="table table-print table-items table-bordered" style="">
                        <thead>
                          <tr style="background-color:#6a4a86; color:white;">
                              <td data-name="Item Name" style="text-align: center;">Items</td>
                              <td data-name="Item Type" style="text-align: center;">Item Type</td>
                              <td data-name="Price" style="text-align: center;">Price</td>
                              <td data-name="Qty" style="text-align: center;">Qty</td>
                              <td data-name="Discount" style="text-align: center;">Discount</td>
                              <td data-name="Tax" style="text-align: center;">Tax</td>
                              <td data-name="Total" style="text-align: center;">Total</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if($estimate->estimate_type == 'Option'){ $ia = 1; $ib = 1; ?>
                            <tr>
                                <td colspan="7" style="padding:15px;"><b>Option 1</b></td>
                            </tr>
                            <?php foreach($items_dataOP1 as $itemData1){ ?>
                              <tr class="table-items__tr">
                                <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $ia; ?></td> -->
                                <td valign="top" style="width:45%;"><?= $itemData1->title; ?></td>
                                <td valign="top" style="width:20%;"><?= $itemData1->type; ?></td>
                                <td valign="top" style="width: 80px; text-align: right;">$<?= number_format((float)$itemData1->costing,2); ?></td>
                                <td valign="top" style="width: 50px; text-align: right;"><?= $itemData1->qty; ?></td>
                                <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData1->discount,2); ?></td>
                                <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData1->tax,2); ?></td>
                                <td valign="top" style="width: 80px; text-align: right;">$<?= number_format((float)$itemData1->total,2); ?></td>
                              </tr>
                            <?php $ia++; } ?>                        
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;">Subtotal</td>
                              <td colspan="1" style="text-align: right;">$<?= number_format((float)$estimate->sub_total, 2); ?></td>
                            </tr>                            
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;">Deposit Amount</td>
                              <td colspan="1" style="text-align: right;">$<?= number_format((float)$estimate->deposit_amount, 2); ?></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;">Taxes</td>
                              <td colspan="1" style="text-align: right;">$<?= number_format((float)$estimate->tax1_total, 2); ?></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                              <td colspan="1" style="text-align: right;"><b>$ <?= number_format((float)$estimate->option1_total, 2); ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding-top:15px;"><b>Option 1 Message</b></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding-bottom:30px;"><?= $estimate->option_message; ?></td>
                            </tr>

                            <tr>
                                <td colspan="7" style="padding:15px;"><b>Option 2</b></td>
                            </tr>
                            <?php foreach($items_dataOP2 as $itemData2){ ?>
                                <tr class="table-items__tr">
                                  <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $ib; ?></td> -->
                                  <td valign="top" style="width:45%;"><?= $itemData2->title; ?></td>
                                  <td valign="top" style="width:20%;"><?= $itemData2->type; ?></td>
                                  <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemData2->costing,2); ?></td>
                                  <td valign="top" style="width: 50px; text-align: right;"><?= $itemData2->qty; ?></td>
                                  <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData2->discount,2); ?></td>
                                  <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData2->tax,2); ?></td>
                                  <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemData2->total,2); ?></td>
                                </tr>
                            <?php $ib++; } ?>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Subtotal</p></td>
                              <td colspan="1" style="text-align: right;"><p>$<?= number_format((float)$estimate->sub_total2, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Deposit Amount</p></td>
                              <td colspan="1" style="text-align: right;"><p>$ <?= number_format((float)$estimate->deposit_amount, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Taxes</p></td>
                              <td colspan="1" style="text-align: right;"><p>$<?= number_format((float)$estimate->tax2_total, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                              <td colspan="1" style="text-align: right;"><b>$<?= number_format((float)$estimate->option2_total, 2); ?></b></td>
                            </tr>
                            <tr>
                              <td colspan="7" style="padding-top:15px;"><b>Option 2 Message</b></td>
                            </tr>
                            <tr>
                              <td colspan="7" style="padding-bottom:15px;"><?= $estimate->option2_message; ?></td>
                            </tr>
                          <?php }elseif($estimate->estimate_type == 'Bundle'){ $ix =1;  $iy =1; ?>
                            <tr>
                                <td colspan="7" style="padding:15px;"><b>Bundle 1</b></td>
                            </tr>
                            <?php foreach($items_dataBD1 as $itemDatabd1){ ?>
                              <tr class="table-items__tr">
                                <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $ix; ?></td> -->
                                <td valign="top" style="width:45%;"><?= $itemDatabd1->title; ?></td>
                                <td valign="top" style="width:20%;"><?= $itemDatabd1->type; ?></td>
                                <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemDatabd1->costing,2); ?></td>
                                <td valign="top" style="width: 50px; text-align: right;"><?= $itemDatabd1->qty; ?></td>
                                <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemDatabd1->discount,2); ?></td>
                                <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemDatabd1->tax,2); ?></td>
                                <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemDatabd1->total,2); ?></td>
                              </tr>
                            <?php $ix++; } ?>                        
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Subtotal</p></td>
                              <td colspan="1" style="text-align: right;"><p>$<?= number_format($estimate->sub_total, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Deposit Amount</p></td>
                              <td colspan="1" style="text-align: right;"><p>$ <?= number_format((float)$estimate->deposit_amount, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Taxes</p></td>
                              <td colspan="1" style="text-align: right;"><p>$<?= number_format($estimate->tax1_total, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                              <td colspan="1" style="text-align: right;"><b>$<?= number_format($estimate->bundle1_total, 2); ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding-top:15px;"><b>Bundle 1 Message</b></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding-bottom:30px;"><?= $estimate->bundle1_message; ?></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding:15px;"><b>Bundle 2</b></td>
                            </tr>
                            <?php foreach($items_dataBD2 as $itemDatabd2){ ?>
                                <tr class="table-items__tr">
                                  <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $iy; ?></td> -->
                                  <td valign="top" style="width:45%;"><?= $itemDatabd2->title; ?></td>
                                  <td valign="top" style="width:20%;"><?= $itemDatabd2->type; ?></td>
                                  <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemDatabd2->costing,2); ?></td>
                                  <td valign="top" style="width: 50px; text-align: right;"><?= $itemDatabd2->qty; ?></td>
                                  <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemDatabd2->discount,2); ?></td>
                                  <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemDatabd2->tax,2); ?></td>
                                  <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemDatabd2->total,2); ?></td>
                                </tr>
                            <?php $iy++; } ?>                        
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Subtotal</p></td>
                              <td colspan="1" style="text-align: right;"><p>$<?= number_format($estimate->sub_total2, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Deposit Amount</p></td>
                              <td colspan="1" style="text-align: right;"><p>$ <?= number_format((float)$estimate->deposit_amount, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Taxes</p></td>
                              <td colspan="1" style="text-align: right;"><p>$<?= number_format($estimate->tax2_total, 2); ?></p></td>
                            </tr>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                              <td colspan="1" style="text-align: right;"><b>$<?= number_format($estimate->bundle2_total, 2); ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding-top:15px;"><b>Bundle 2 Message</b></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="padding-bottom:15px;"><?= $estimate->bundle2_message; ?></td>
                            </tr>
                          <?php }else{ $i = 1; ?>                      
                            <?php foreach($items_data as $itemData){ ?>
                              <tr class="table-items__tr">
                                <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $i; ?></td> -->
                                <td valign="top" style="width:45%;"><?= $itemData->title; ?></td>
                                <td valign="top" style="width:20%;"><?= $itemData->type; ?></td>
                                <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemData->iCost,2); ?></td>
                                <td valign="top" style="width: 50px; text-align: right;"><?= $itemData->qty; ?></td>
                                <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData->discount,2); ?></td>
                                <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData->tax,2); ?></td>
                                <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemData->iTotal,2); ?></td>
                              </tr>
                            <?php $i++; } ?>                        
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Subtotal</p></td>
                              <td colspan="1" style="text-align: right;"><p>$<?= number_format((float)$estimate->sub_total,2); ?></p></td>
                            </tr>                            
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Taxes</p></td>
                              <td colspan="1" style="text-align: right;">
                                <p>$<?= number_format((float)$estimate->tax1_total, 2); ?></p></td>
                            </tr>  
                            <?php if( $estimate->adjustment_name != '' && $estimate->adjustment_value > 0 ){ ?>
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p><?= $estimate->adjustment_name; ?></p></td>
                              <td colspan="1" style="text-align: right;">
                                <p>$<?= number_format((float)$estimate->adjustment_value, 2); ?></p></td>
                            </tr> 
                            <?php } ?>                           
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                              <?php 
                                $grand_total = $estimate->grand_total;
                                // if( $deposit_amount > 0 ){
                                //   $grand_total = $grand_total - $deposit_amount;
                                // }
                              ?>
                              <td colspan="1" style="text-align: right;"><b>$<?= number_format((float)$grand_total, 2); ?></b></td>
                            </tr>
                            <tr><td colspan="7"></td></tr>                            
                            <tr>
                              <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><p>Deposit Amount Requested</p></td>
                              <td colspan="1" style="text-align: right;">
                                <?php $deposit_amount = $estimate->grand_total * ($estimate->deposit_amount/100); ?>
                                <p>$<?= number_format((float)$deposit_amount, 2); ?></p></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>                  
                  <?php if($estimate->instructions){ ?>
                    <b>Instructions</b><br>
                    <?php echo $estimate->instructions;?>
                  <?php } ?>
                  <?php if($estimate->estimate_type == 'Standard'){ ?>
                    <?php if($estimate->customer_message){ ?>
                    <br><br><b>Message</b><br><?= $estimate->customer_message; ?>
                    <?php } ?>
                  <?php } ?>
                  <?php if($estimate->terms_conditions){ ?>
                    <br><br><b>Terms</b><br><?= $estimate->terms_conditions; ?>                                
                  <?php }else{ ?>
                    <div class="alert alert-primary" role="alert">Invalid record</div>
                  <?php } ?>
              </div>     
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
    <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
              <div class="modal-body"></div>
          </div>
      </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
  $(".btn-approve-estimate").click(function(){
    $("#modalApproveConfirmation").modal('show');
  });
  $(".btn-disapprove-estimate").click(function(){
    $("#modalDisapproveConfirmation").modal('show');
  });
});

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

$(document).on('click touchstart', '.print-estimate', function(){
  printDiv('printableArea');
});

$(document).on('click touchstart', '.approveEstimate', function(){
  var estimatenumber = $(this).attr('data-estimatenumber');
  Swal.fire({            
      html: "Are you sure you want to Estimate# <b>"+estimatenumber+"</b>?",
      icon: 'question',
      confirmButtonText: 'Proceed',
      showCancelButton: true,
      cancelButtonText: "Cancel"
  }).then((result) => {
      if (result.value) {
        var estId = $(this).attr("estimateID");
        $.ajax({
          type: "POST",
          dataType: 'json',
          data:{'estId':estId },
          url : "<?php echo base_url(); ?>estimate/approveEstimate",
          beforeSend: function(data) {
              $('#loading_modal').modal('show');
              $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Updating estimate....');
          },
          success: function (data) {
            $('#loading_modal').modal('hide');       
            Swal.fire({                        
                text: "Data was successfully updated!",
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            }).then((result) => {
                //if (result.value) {
                    location.reload();
                //}
            });  
          },
          error: function (data) {
              console.log('Error:', data);
          }
        });
      }
  });
});

$(document).on('click touchstart', '.send_to_customer', function(){
  Swal.fire({            
      html: "Send this estimate to customer?",
      icon: 'question',
      confirmButtonText: 'Proceed',
      showCancelButton: true,
      cancelButtonText: "Cancel"
  }).then((result) => {
      if (result.value) {
        var id = $(this).attr('acs-id');
        var est_id = $(this).attr('est-id');
        var urlLogo = $('#urlLogo').val();

        $.ajax({
          type : 'POST',
          url : "<?php echo base_url(); ?>estimate/sendEstimateToAcs",
          data : {id: id, est_id: est_id, urlLogo: urlLogo},
          beforeSend: function(data) {
              $('#loading_modal').modal('show');
              $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Sending estimate....');
          },
          success: function(result){    
            $('#loading_modal').modal('hide');       
            Swal.fire({                        
                text: "Successfully sent to Customer!",
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            }).then((result) => {
                //if (result.value) {
                    
                //}
            });                 
          },
          error: function () {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              html: 'Cannot send email'
            });
              
          },
        });
      }
  });
});
</script>