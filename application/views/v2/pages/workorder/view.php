<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>
<style>
  .title-border {
      background-color: #6a4a86;
      color: #ffffff;
      font-size: 19px;
      padding: 10px;
  }
  .workorder-details{
    list-style:none;
    margin:0px;
    padding:0px;
  }
  .workorder-details li{
    display:inline-block;
    width:100%;
    margin:3px;
  }
  .label-details{
    display:inline-block;
    width:110px;
    white-space: nowrap;
  }
  .value-details{
    width: calc(100% - 126px);
    vertical-align: top;
    display:inline-block;
    font-weight:bold;
  }
  .value-details::before{
    content: " : ";
    font-weight: normal;
  }
  .workorder-box{
    /*background-color:#a6a6a6;*/
    padding:10px;
    display:block;
    margin-bottom:10px;
  }
  @media only screen and (max-width: 767px) {
    .label-details {
      display:inline-block;
      width:120px;
    }
  }
</style>
<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('includes/notifications'); ?>
<?php //include viewPath('includes/sidebars/estimate'); ?>    
<?php $total_amount = 0; ?>      
<div class="row page-content g-0">          
  <div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/workorder_tabs_v2'); ?>
  </div>
  <div class="col-12 mb-3">
  	<?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
  </div>  
  <div class="col-12">
    <div class="nsm-page">
      <div class="nsm-page-content">
        <div class="row">
            <div class="col-12">
                <div class="nsm-callout primary">
                    <button><i class='bx bx-x'></i></button>
                    View Workorder Details.
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
          <?php if($workorder){ ?>
              <div class="d-block">
                <div class="col-md-12" style="text-align: right;margin-bottom: 60px;">                          
                  <div class="dropdown d-inline-block">
                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown" style="width:122px;">
                        <span>Action <i class='bx bx-fw bx-chevron-down'></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <?php if($workorder->work_order_type_id == '4'){ ?>
                          <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#sharePreviewAgree">Share</a>
                        <?php }elseif($workorder->work_order_type_id == '3'){ ?>
                          <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#sharePreviewSolar">Share</a>
                        <?php }else{ ?>
                          <a class="dropdown-item" id="share-preview" href="javascript:void(0);"> Share</a>
                        <?php } ?>
                      </li>
                      <li>


                        <?php if( in_array(logged('company_id'), adi_company_ids()) ){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('workorder/editInstallation/' . $workorder->id) ?>">Edit</a> 
                        <?php }else{ ?>
                                <?php if($workorder->work_order_type_id == '2'){ ?>
                                  <a class="dropdown-item" href="<?php echo base_url('workorder/editAlarm/' . $workorder->id) ?>">Edit</a>        
                                <?php }elseif($workorder->work_order_type_id == '3'){ ?>
                                  <a class="dropdown-item" href="<?php echo base_url('workorder/editSolar/' . $workorder->id) ?>">Edit</a>       
                                <?php }else{ ?>
                                  <a class="dropdown-item" href="<?php echo base_url('workorder/edit/' . $workorder->id) ?>">Edit</a> 
                                <?php } ?>
                        <?php } ?>                         

                        </li>
                        <li>
                        <?php if($workorder->work_order_type_id == 1){ ?>                           
                          <a class="dropdown-item" target="_new" href="<?php echo base_url('share_Link/work_order_pdf/' . $workorder->id) ?>">PDF</a>
                        <?php }else if($workorder->work_order_type_id == 4){ ?>
                          <a class="dropdown-item" target="_new" href="<?php echo base_url('share_Link/work_order_pdf_agreement/' . $workorder->id) ?>">PDF</a>
                        <?php } else{ ?>
                          <a class="dropdown-item" target="_new" href="<?php echo base_url('share_Link/work_order_pdf_alarm/' . $workorder->id) ?>">PDF</a>
                        <?php } ?>
                        </li>
                        <li>
                        <?php if($workorder->work_order_type_id == 1){ ?>
                          <a class="dropdown-item" href="javascript:void(0);" onclick="printDiv('printableArea')">Print</a>
                        <?php }else if($workorder->work_order_type_id == 3){ ?>
                          <a class="dropdown-item" href="<?php echo base_url('workorder/printSolar/' . $workorder->id) ?>">Print</a>
                        <?php } else{ ?>
                          <a class="dropdown-item" data-print-modal="open" href="javascript:void(0);" onclick="printDiv('printableArea')">Print</a>
                        <?php } ?>
                      </li>                        
                    </ul>
                </div>
                  <a class="nsm-button primary" href="<?php echo base_url('workorder') ?>">BACK TO WORK ORDER LIST</a>
                  <input type="hidden" value="<?php echo getCompanyBusinessProfileImage(); ?>" id="urlLogo">
                </div>
              </div>

              <div id="printableArea" style="background-color:#ffffff;padding:1%;border:solid #F4F2F6 3px;box-shadow: 5px 5px 5px #DEDEDE;width:80%;margin:0 auto;">
                <div class="row mb-4">
                  <h4 class="title-border" style="text-transform:uppercase;"><?= $workorder->status; ?></h4>
                  <div class="col-md-12 col-12"><span style="font-size:16px;"><?= $workorder->header; ?></span></div>
                </div>
                
                <div class="row">
                  <div class="col-md-6 col-sm-12" style="text-align:center;">                       
                      <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 200px;" />
                  </div>
                  <!-- <div class="col-md-7 col-sm-12"></div> -->
                  <div class="col-md-6 col-sm-12">
                    <table class="table table-borderless" style="width:50%;float:right;">
                      <tr>
                        <td colspan="2" style="text-align:right;font-weight:bold;">
                          <h2><strong>WORK ORDER</strong></h2>
                          <h5>#<?= $workorder->work_order_number; ?></h5>
                        </td>
                      </tr>
                      <tr>
                        <td style="text-align:right ;">Date:</td>
                        <td style="text-align:right;"><b><?php $wDate = $workorder->date_created; echo date("m/d/Y", strtotime($wDate) ); ?></b></td>
                      </tr>
                      <tr>
                        <td style="text-align:right;">Priority:</td>
                        <td style="text-align: right;"><b><?php echo $workorder->priority ?></b></td>
                      </tr>
                      <tr>
                        <td style="text-align:right;">Password:</td>
                        <td style="text-align: right;"><b><?php echo $workorder->password; ?></b></td>
                      </tr>
                      <tr>
                        <td style="text-align:right;">Security Number:</td>
                        <td style="text-align: right;">
                          <?php 
                              if (logged("user_type") == 1){
                                  $ssn = $customer->ssn ?? "---";
                              }else{
                                  if( $customer->ssn != 'Not Specified' ){
                                    $ssn = strMask($customer->ssn);
                                  }else{
                                    $ssn = '---';
                                  }
                              } 
                          ?>
                          <b><?php echo $ssn; ?></b>
                        </td>
                      </tr>
                      <?php if($workorder->work_order_type_id == '4'){ ?>
                        <tr>
                          <td style="text-align:right;">Account Type:</td>
                          <td style="text-align: right;"><b><?php echo $workorder->account_type; ?></b></td>
                        </tr>
                        <tr>
                          <td style="text-align:right;">Comms. Type:</td>
                          <td style="text-align: right;"><b><?php echo $workorder->panel_communication; ?></b></td>
                        </tr>
                        <?php if($workorder->plan_type) { ?>
                        <tr>
                          <td style="text-align:right;">Plan Type:</td>
                          <td style="text-align: right;"><b><?php echo $workorder->plan_type ?? "---"; ?></b></td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td style="text-align:right;">Panel Type:</td>
                          <td style="text-align: right;"><b><?php echo $workorder->panel_type ?? "---"; ?></b></td>
                        </tr>
                        <tr>
                          <td style="text-align:right;">Source:</td>
                          <td style="text-align: right;"><b><?php echo $lead->ls_name; ?></b></td>
                        </tr>
                      <?php } ?>
                      <?php if($workorder->account_type == 'Business' || $workorder->account_type == 'Commercial'){ ?>
                        <tr>
                          <td style="text-align:right;">Business Name:</td>
                          <td style="text-align: right;"><b><?php echo $customer->business_name; ?></b></td>
                        </tr>
                      <?php } ?>
                      <?php if($workorder->work_order_type_id == '3'){ ?> 
                        <tr>
                          <td style="text-align:right;">System  Type:</td>
                          <td style="text-align: right;"><b><?php echo $workorder->panel_communication ?></b></td>
                        </tr>
                      <?php } ?>
                      <!-- <tr>
                        <td style="text-align:left;">Type:</td>
                        <td style="text-align: right;"><b><?php //echo $workorder->job_type ?></b></td>
                      </tr> -->
                      <!-- <tr>
                        <td style="text-align:left;">Status:</td>
                        <td style="text-align: right;"><b><?php //echo $workorder->status ?></b></td>
                      </tr> -->
                    </table>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-6 col-12" style="font-size:16px;">
                      <h4 class="title-border">FROM :</h4>
                      <h4><i class="bx bx-buildings"></i> <?= $company->business_name; ?></h4>
                      <div>
                        <span class="ul-text"><?php echo $company->street .'<br />'.$company->city .', '.$company->state .' '.$company->zip; ?></span><br>                        
                        <span class=""><i class='bx bx-envelope'></i> Email: <?= $company->business_email; ?><br />
                        <span class=""><i class='bx bx-phone'></i> Phone: <?= formatPhoneNumber($company->office_phone); ?></span>
                      </div>
                  </div>                    
                  <div class="col-md-6 col-12" style="font-size:16px;">
                      <h4 class="title-border">TO :</h4>
                      <h4><i class="bx bx-buildings"></i>  <?= $customer->first_name . ' ' . $customer->last_name; ?></h4>
                      <div>
                        <span class=""><?= $customer->mail_add . '<br />' . $customer->city.', '. $customer->state .' '. $customer->zip_code;  ?></span><br />
                        <span class=""><i class='bx bx-envelope'></i> Email: <?= $customer->email; ?><br />
                        <span class=""><i class='bx bx-phone'></i> Phone:<?= formatPhoneNumber($customer->phone_m); ?><br />
                      </div>
                  </div>
                </div>                
                <div class="row mt-4">
                  <?php if($contacts) { ?>
                  <div class="col-12 col-md-6">
                    <h6 class="title-border">ADDITIONAL CONTACTS:</h6>
                    <div class="">
                      
                      <?php foreach($contacts as $cont){ ?>
                        <?php 
                          $contact_name = "---";
                          if($cont->first_name != null && $cont->last_name != null) {
                            $contact_name = $cont->first_name . " " . $cont->last_name;
                          } else {
                            $contact_name = $cont->name != null ? $cont->name : $cont->first_name;
                          }
                        ?>
                        <h4 style="font-size:18px;"><i class='bx bx-user-circle'></i> <?= $contact_name; ?></h4>
                        <span class=""><i class="bx bx-phone"></i> <?= formatPhoneNumber($cont->phone); ?></span><br /><br />
                      <?php } ?>
                  </div>
                  <?php } ?>
                  <div class="col-12 col-md-12">
                    <h6 class="title-border">TERMS AND CONDITIONS :</h6>
                    <span class="workorder-box"><?= $workorder->terms_and_conditions ?? "None"; ?></span>
                  </div>
                </div> 
                
                <div class="row mt-4">
                  
                </div>                

                <div class="row mt-4">

                  <!-- <div class="col-md-12" style="max-width:100%;overflow:auto;">
                    <h6 class="title-border">WORKORDER DETAILS :</h6>
                    <div class="row">
                      <div class="col-12 col-md-7">
                        <div class="row">
                        <div class="col-12 col-md-6"> 
                          <ul class="workorder-details w-100">
                          <li>
                            <span class="label-details">Job Name</span>
                            <span class="value-details"><?= $workorder->job_name != '' ? $workorder->job_name : '---'; ?></span>
                          </li> 
                          <li>
                            <span class="label-details">Job Description</span>
                            <span class="value-details"><?= $workorder->job_description != '' ? $workorder->job_description : '---'; ?></span>
                          </li>                            
                  
                        </ul></div>
                        <div class="col-12 col-md-6">
                        <ul class="workorder-details">
                        <li>
                            <span class="label-details">Installtion Date</span>
                            <span class="value-details">
                              <?php 
                                $installation_date = '---'; 
                                if( strtotime($workorder->date_issued) > 0 ){
                                  $installation_date = date("m/d/Y", strtotime($workorder->date_issued)); 
                                }
                              ?>
                              <?= $installation_date; ?>
                            </span>
                          </li>
                          <li>
                            <span class="label-details">Job Location</span>
                            <span class="value-details"><?= $workorder->job_location .' , '. $workorder->city .', '. $workorder->state .' '. $workorder->zip_code; ?></span>
                          </li>                            
                        </ul>
                        </div>
                        </div>
                        <hr />
                        <div class="row">
                        <div class="col-12 col-md-6"> <ul class="workorder-details">
                          <li>
                            <span class="label-details">Pay Method</span>
                            <span class="value-details"><?= $workorder->payment_method; ?></span>
                          </li>   
                          <li>
                            <span class="label-details">Agent Name</span>
                            <span class="value-details"><?= $agreements->sales_re_name; ?></span>
                          </li>                         
                          
                          
                        </ul> </div>
                        <div class="col-12 col-md-6"> <ul class="workorder-details">
                          
                        <li>
                            <span class="label-details">Amount</span>
                            <span class="value-details">$<?= number_format((float)$workorder->payment_amount,2); ?></span>
                          </li>
                          <li>
                            <span class="label-details">Job Tags</span>
                            <span class="value-details"><?= $workorder->tags; ?></span>
                          </li>
                        </ul> </div>
                        </div>                         
                      </div>
                      <div class="col-12 col-md-5">
                        <table class="table">
                          <tr><td colspan="2" style="background-color:#6a4a86;color:#ffffff;"><b>CUSTOM FIELDS</b></td></tr>
                          <tr>
                            <td style="text-align:left;background-color:#6a4a86;color:#ffffff;"><b>Field Name</b></td>
                            <td style="text-align:left;background-color:#6a4a86;color:#ffffff;"><b>Value</b></td>								
                          </tr>
                          <?php foreach($custom_fields as $custom){ ?>
                            <tr>
                              <td><?= $custom->name; ?></td>
                              <td><?= $custom->value != '' ? $custom->value : '---'; ?></td>
                            </tr>
                          <?php } ?>
                        </table>

                        <?php if($workorder->work_order_type_id == 2){ ?>
                          <table class="table">
                            <tr><td colspan="2" style="background-color:#6a4a86;color:#ffffff;"><b>CONTACTS</b></td></tr>
                            <tr>
                              <td style="text-align:left;background-color:#6a4a86;color:#ffffff;"><b>Name</b></td>
                              <td style="text-align:left;background-color:#6a4a86;color:#ffffff;"><b>Relation</b></td>								
                            </tr>
                            <?php foreach($contacts as $cont){ ?>
                              <tr>
                                <td><?= $cont->first_name . ' ' . $cont->last_name; ?></td>
                                <td><?= $cont->relation; ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        <?php } ?>
                      </div>
                    </div>
                  </div> -->

                  <div class="col-md-12" style="max-width:100%;overflow:auto;">
                  <h6 class="title-border">ITEMS :</h6>
                    <table class=" table table-print table-items" style="width: 100%; border-collapse: collapse;">
                      <thead>
                        <tr>
                          <th style="background: #f4f4f4; text-align: center; padding: 5px 0; font-weight:bold;">#</th>
                          <th style="background: #f4f4f4; text-align: left; padding: 5px 0; font-weight:bold;">Item Name</th>
                          <th style="background: #f4f4f4; text-align: right; padding: 5px 0; font-weight:bold;">Qty</th>
                          <th style="background: #f4f4f4; text-align: right; padding: 5px 5px; font-weight:bold;">Price</th>
                          <th style="background: #f4f4f4; text-align: right; padding: 5px 5px; font-weight:bold;">Tax</th>
                          <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0; font-weight:bold;" class="text-right">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $row = 1; ?>
                        <?php if( $invoiceItems ){ ?>
                          <?php foreach($invoiceItems as $item){ ?>
                            <tr class="table-items__tr">
                              <td style="width: 30px; text-align: center;" valign="top"><?= $row; ?>.</td>
                              <td valign="top"> <?php echo $item->product_name; ?></td>
                              <td style="width: 50px; text-align: right;" valign="top"> <?php echo $item->qty; ?>  </td>
                              <td style="width: 80px; text-align: right;" valign="top">$<?php echo number_format($item->cost,2) ?></td>
                              <td style="width: 80px; text-align: right;" valign="top">$<?php echo number_format($item->tax,2) ?></td>
                              <td style="width: 90px; text-align: right;" valign="top">$<?php echo number_format($item->total,2) ?></td>
                            </tr>
                          <?php $row++; ?>
                          <?php } ?>
                        <?php }elseif( $workorder_agreement_items ){ ?>
                          <?php foreach($workorder_agreement_items as $item){ ?>
                              <?php 
                                $qty = $item->qty > 0 ? $item->qty : 0;
                                $total_cost = $item->price > 0 ? $item->price : 0;
                                $total_item_cost = 0;
                                $item_tax = 0;
                                if( $total_cost > 0 ){
                                  if($qty != 0) {
                                    $unit_cost = $total_cost;
                                    $total_item_cost = $unit_cost * $qty;
                                    $item_tax = $total_item_cost * (7.5 / 100);
                                  } else {
                                    $unit_cost = 0;
                                  }
                                }else{
                                  $unit_cost = 0;
                                }
                              ?>
                              <tr class="table-items__tr">
                                <td style="width: 30px; text-align: center;" valign="top"><?= $row; ?>.</td>
                                <td valign="top"> <?php echo $item->item; ?></td>
                                <td style="width: 50px; text-align: right;" valign="top"><?php echo intval($qty); ?></td>
                                <td style="width: 80px; text-align: right;" valign="top">$<?php echo number_format($unit_cost,2); ?></td>
                                <td style="width: 80px; text-align: right;" valign="top">$<?php echo number_format($item_tax,2); ?></td>
                                <td style="width: 90px; text-align: right;" valign="top">$<?php echo number_format($total_item_cost,2); ?></td>
                              </tr>
                              <?php $row++; ?>
                          <?php } ?>
                        <?php }else{ ?>
                          <?php foreach($workorder_items as $item){ ?>
                            <?php if($item->items_id != 0){ ?>
                              <tr class="table-items__tr">
                                <td style="width: 30px; text-align: center;" valign="top"><?= $row; ?></td>
                                <td valign="top"> <?php echo $item->title; ?>   </td>
                                <td style="width: 50px; text-align: right;" valign="top"> <?php echo $item->qty ?>  </td>
                                <td style="width: 80px; text-align: right;" valign="top">$<?php echo number_format($item->costing,2) ?></td>
                                <td style="width: 80px; text-align: right;" valign="top">$<?php echo number_format($item->tax,2) ?></td>
                                <td style="width: 90px; text-align: right;" valign="top">$<?php $a = $item->qty * $item->costing; $b = $a + $item->tax; echo number_format($b,2); ?></td>
                              </tr>
                            <?php }else{ ?>
                              <tr class="table-items__tr">
                                <td style="width: 30px; text-align: center;" valign="top"><?= $row; ?></td>
                                <td valign="top" colspan="5"> <div id="PaName_<?php echo $item->package_id; ?>"></div> <br>
                                <div id="packageItemsTitle<?php echo $item->package_id; ?>" style="padding-left:5%;">
                                <div id="packageItems<?php echo $item->package_id; ?>" style="padding-left:5%;"></div>
                                </td>
                                <td style="width: 90px; text-align: right;" valign="top">$<?php $a = $item->qty * $item->costing; $b = $a + $item->tax; echo number_format($b,2); ?></td>
                              </tr>
                            <?php } ?>
                            <?php $row++; ?>
                          <?php } ?>
                        <?php } ?>
                        <tr>
                          <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                          <td colspan="2" style="text-align: ;">Subtotal</td>
                          <td colspan="1" style="text-align: right;">
                            <?php 
                              $subtotal = $workorder->subtotal;
                              if( $invoice ){
                                $subtotal = $invoice->sub_total;
                              }
                            ?>
                            $<?php echo number_format((Float)$subtotal,2); ?>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                          <td colspan="2" style="text-align: ;">Taxes</td>
                          <td colspan="1" style="text-align: right;">
                            <?php 
                              $taxes = $workorder->taxes;
                              if( $invoice ){
                                $taxes = $invoice->taxes;
                              }
                            ?>
                            $<?php echo number_format((Float)$taxes,2); ?>
                          </td>
                        </tr>
                        
                        <?php if( $invoice ){ ?>
                            <?php if( $invoice->adjustment_name != '' && $invoice->adjustment_value > 0 ){ ?>
                            <tr>
                              <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><?php echo $invoice->adjustment_name; ?></td>
                              <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$invoice->adjustment_value,2); ?></td>
                            </tr>
                            <?php } ?>

                            <?php if( $invoice->program_setup > 0 ){ ?>
                            <tr>
                              <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;">One Time Program and Setup</td>
                              <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$invoice->program_setup,2); ?></td>
                            </tr>
                            <?php } ?>

                            <?php if( $invoice->monthly_monitoring > 0 ){ ?>
                            <tr>
                              <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;">Monthly Monitoring</td>
                              <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$invoice->monthly_monitoring,2); ?></td>
                            </tr>
                            <?php } ?>

                            <tr>
                              <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><b>Grand Total</b></td>
                              <td colspan="1" style="text-align: right;"><b>$<?php echo number_format((Float)$invoice->grand_total,2) ?></b></td>
                            </tr>                            
                        <?php }else{ ?>
                            <?php if( $workorder->adjustment_name != '' && $workorder->adjustment_value > 0 ){ ?>
                            <tr>
                              <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;">test<?php echo $workorder->adjustment_name; ?></td>
                              <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$workorder->adjustment_value,2); ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if( $workorder->otp_setup > 0 ){ ?>
                            <tr>
                              <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;">One Time Program and Setup</td>
                              <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$workorder->otp_setup,2); ?></td>
                            </tr>
                            <?php } ?>

                            <?php if( $workorder->monthly_monitoring > 0 ){ ?>
                            <tr>
                              <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;">Monthly Monitoring</td>
                              <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$workorder->monthly_monitoring,2); ?></td>
                            </tr>
                            <?php } ?> 
                            
                            <?php if( $workorder->installation_cost > 0 ){ ?>
                            <tr>
                              <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;">Installation Cost</td>
                              <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$workorder->installation_cost,2); ?></td>
                            </tr>
                            <?php } ?> 

                            <tr>
                              <td colspan="3" style="border-left: 1px solid Transparent!important;"></td>
                              <td colspan="2" style="text-align: ;"><b>Grand Total</b></td>
                              <td colspan="1" style="text-align: right;"><b>$<?php echo number_format((Float)$workorder->grand_total,2) ?></b></td>
                            </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-md-12">
                    <h6 class="title-border">TERMS OF USE :</h6>
                    <span class="workorder-box"><?= $workorder->terms_of_use ?? "None"; ?></span>
                  </div>  
                  
                  <div class="col-md-12">
                    <h6 class="title-border">JOB DESCRIPTIONS :</h6>
                    <span class="workorder-box"><?= $workorder->job_description ?? "None"; ?></span>
                  </div>

                  <div class="col-md-12">
                    <h6 class="title-border">INSTRUCTIONS :</h6>
                    <span class="workorder-box"><?= $workorder->instructions ?? "None"; ?></span>
                  </div>

                  <div class="col-md-12">
                    <h6 class="title-border">ACCEPTED PAYMENT METHOD :</h6>
                    <span class="workorder-box">Credit Card, Check, Cash, Direct Deposit <br />Accepting Mobile Payments</span>
                  </div>

                  <div class="col-md-12">
                    <h6 class="title-border">PAYMENT DETAILS :</h6>
                    <?php if($payment) { ?>
                      <span class="workorder-box">
                        Payment Method: <?php echo $payment->payment_method; ?><br />
                        Amount: $<?php echo $payment->amount; ?><br />
                        <?php if($payment->payment_method == 'Credit Card' || $payment->payment_method == 'Debit Card') { ?>
                          Card No.: <?php echo $payment->credit_number; ?><br />
                          Expiry Date: <?php echo $payment->credit_expiry; ?><br />
                          CVC: <?php echo $payment->credit_cvc; ?><br />
                        <?php }elseif($payment->payment_method == 'ACH') { ?>
                          Routing No.: <?php echo $payment->routing_number; ?><br />
                          Account No.: <?php echo $payment->account_number; ?><br />
                        <?php }else{ ?>
                        <?php } ?>
                      </span>
                    <?php }else{ ?>
                      <span class="workorder-box">None</span>
                    <?php } ?>
                  </div>

                    <div class="col-md-12">
                      <h6 class="title-border">ATTACHMENTS :</h6>                  
                      <?php if($total_existing_attachments) { ?>
                          <span class="workorder-box">
                              <?php foreach($workorder_attachments as $workorder_attachment) { ?>
                                <a href="javascript:loadAttachImg('<?php echo $workorder->company_id; ?>', '<?php echo $workorder_attachment->filename; ?>');" id="preview-attached-file" data-company-id="<?php echo $workorder->company_id; ?>" data-attach-filename="<?php echo $workorder_attachment->filename; ?>" class="preview-attached-file"><?php echo $workorder_attachment->filename; ?></a><br />
                              <?php } ?>                            
                          </div>
                      <?php } else { ?>
                          <span class="workorder-box">None</span>
                      <?php } ?>
                    </div>

                  <div class="col-md-12">
                    <h6 class="title-border">AGREEMENT :</h6>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mt-5" style="text-align: center; min-height: 150px;">
                        <?php if($workorder->company_representative_signature != "") { ?>
                          <img src="<?php echo base_url('uploads/workorders/signatures/'.$workorder->company_id.'/'.$workorder->company_representative_signature); ?>" />
                          <br />
                          <?php } ?>
                        <div><?= $agreements->sales_re_name ? $agreements->sales_re_name : $company->company_representative_name; ?></div>
                    </div>
                    <div class="col-md-4 mt-5" style="text-align: center; min-height: 150px;">
                      <?php if($workorder->primary_account_holder_signature != "") { ?>
                        <img src="<?php echo base_url('uploads/workorders/signatures/'.$workorder->company_id.'/'.$workorder->primary_account_holder_signature); ?>" />
                        <br />
                      <?php } ?>
                      <div><?= $customer->first_name . ' ' . $customer->last_name; ?></div>
                    </div>
                    <div class="col-md-4 mt-5" style="text-align: center; min-height: 150px;">
                        <?php if($workorder->secondary_account_holder_signature != "") { ?>
                          <img src="<?php echo base_url('uploads/workorders/signatures/'.$workorder->company_id.'/'.$workorder->secondary_account_holder_signature); ?>" />
                          <br />
                          <?php } ?>
                        <div><?= $company->first_name . ' ' . $company->last_name; ?></div>
                    </div>
                  </div>
                </div>                                    
              </div>     
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade nsm-modal fade" id="share_preview_modal" tabindex="-1" aria-labelledby="share_preview_modal_label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="job_settings_modal_label">Share Link</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">                        
                      <input type="text" class="nsm-field form-control mb-2 share-link-url" value="<?= $public_view_url; ?>" readonly>                          
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button primary copy-link">Copy to Clipboard</button>
                <button type="button" class="nsm-button primary email-link">Email Link</button>
            </div>
        </div>
      </div>
  </div>

  <div class="modal fade nsm-modal fade" id="email_link_modal" tabindex="-1" aria-labelledby="email_link_modal_label" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <form id="frm-email-workorder">
          <input type="hidden" name="wid" value="<?= $workorder->id; ?>" />
          <div class="modal-content">
              <div class="modal-header">
                  <span class="modal-title content-title" id="job_settings_modal_label">Email Link</span>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-12">                      
                        <input type="text" placeholder="To" class="nsm-field form-control mb-2" readonly="" disabled="" name="recipient" value="<?= $customer->email; ?>" />
                      </div>
                      <div class="col-12">
                        <textarea name="email_content" id="email_content_share" style="height:1000px;">                          
                          <p>Dear <?php echo $customer->first_name ?>,<br /><br />
                          Thank you for choosing <b><?php echo $company->business_name ?></b>!<br />                          
                          Your workorder # <b><?php echo $workorder->work_order_number ?></b> is now available online. To view your workorder online, click the button below. <br><br />
                          <a style="padding: 8px 12px;border: 1px solid #6a4a86;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px;color: #ffffff; text-decoration: none;font-weight: bold;display: inline-block;  border-radius: 2px;background-color:#6a4a86;" href="<?php echo base_url('share_Link/public_view_solar/'.$workorder->id) ?>">View <?php echo $workorder->work_order_number ?></a><br /><br />
                          Regards,<br /><br />
                          <?php echo $company->business_name ?><br /><br /><br /><br />
                          <p style="text-align:center">Powered by nSmarTrac</p>
                        </textarea>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="nsm-button primary">Send</button>
              </div>
          </div>
          </form>
      </div>
  </div>

  <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:15%;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
  </div>

</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

function loadAttachImg(cid, image_file) {
  $("#modal-workorder-attachment").modal("show");
  $('#work-order-attach-img').attr('src', base_url + 'uploads/customerdocuments/'+cid+'/'+image_file);
}   

$(function(){  
  CKEDITOR.replace('email_content_share');

  $('.email-link').click(function(){
    $('#share_preview_modal').modal('hide');
    $('#email_link_modal').modal('show');
  });

  $('#share-preview').click(function(){        
    $('#share_preview_modal').modal('show');
  });

  $('#frm-email-workorder').on('submit', function(e){
    e.preventDefault();

    CKEDITOR.instances['email_content_share'].updateElement();

    $.ajax({
      type : 'POST',
      url : base_url + "workorder/_shareable_email",
      data : $('#frm-email-workorder').serialize(),
      dataType: 'json',
      beforeSend: function() {
          $('#email_link_modal').modal('hide');
          $('#loading_modal').modal('show');
          $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Sending email....');
      },
      success: function(result){            
        $('#loading_modal').modal('hide');       
        if( result.is_success == 1 ){
          Swal.fire({                        
              text: "Successfully sent to customer",
              icon: 'success',
              showCancelButton: false,
              confirmButtonText: 'Okay'
          }).then((result) => {
              //if (result.value) {
                  
              //}
          });                 
        }else{
          $('#email_link_modal').modal('show');
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            html: result.msg
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          html: 'Cannot send email'
        });
          
      },
    });
  });

  $('.copy-link').click(function(e){
    var copyTextarea = document.querySelector('.share-link-url');
    copyTextarea.focus();
    copyTextarea.select();

    try {
      var successful = document.execCommand('copy');
      var msg = successful ? 'successful' : 'unsuccessful';
      Swal.fire({                        
          text: "URL was successfully copied to clipboard",
          icon: 'success',
          showCancelButton: false,
          confirmButtonText: 'Okay'
      }).then((result) => {
          
      });     
    } catch (err) {
      Swal.fire({                        
          text: "Unable to copy link",
          icon: 'error',
          showCancelButton: false,
          confirmButtonText: 'Okay'
      }).then((result) => {
          
      });   
    }
  });

  $('.email-link').click(function(e){
    $('#shareLinkToEmail').modal('show');
  });
});
</script>