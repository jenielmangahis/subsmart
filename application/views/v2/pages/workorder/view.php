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
  background-color:#a6a6a6;
  padding:10px;
  display:block;
  margin-bottom:10px;
}
@media only screen and (max-width: 767px) {
  .label-details{
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
                    <ul class="dropdown-menu dropdown-menu-end select-filter">
						<li style="font-size:17px;">
							<?php if($workorder->work_order_type_id == '4'){ ?>
								<a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#sharePreviewAgree"><i class='bx bxs-envelope'></i> Share</a>
							<?php }elseif($workorder->work_order_type_id == '3'){ ?>
								<a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#sharePreviewSolar"><i class='bx bxs-envelope'></i> Share</a>
							<?php }else{ ?>
								<a class="dropdown-item" id="share-preview" href="javascript:void(0);"><i class='bx bxs-envelope'></i> Share</a>
							<?php } ?>
						</li>
                        <li style="font-size:17px;">
							<?php if($workorder->work_order_type_id == '2'){ ?>
								<a class="dropdown-item" href="<?php echo base_url('workorder/editAlarm/' . $workorder->id) ?>"><i class='bx bx-edit'></i> Edit</a>        
							<?php }elseif($workorder->work_order_type_id == '3'){ ?>
								<a class="dropdown-item" href="<?php echo base_url('workorder/editSolar/' . $workorder->id) ?>"><i class='bx bx-edit'></i> Edit</a>       
							<?php }else{ ?>
								<a class="dropdown-item" href="<?php echo base_url('workorder/edit/' . $workorder->id) ?>"><i class='bx bx-edit'></i> Edit</a> 
							<?php } ?>
                        </li>
                        <li style="font-size:17px;">
							<?php if($workorder->work_order_type_id == 1){ ?>                           
								<a class="dropdown-item" target="_new" href="<?php echo base_url('share_Link/work_order_pdf/' . $workorder->id) ?>"><i class='bx bxs-file-pdf'></i> PDF</a>
							<?php }else if($workorder->work_order_type_id == 4){ ?>
								<a class="dropdown-item" target="_new" href="<?php echo base_url('share_Link/work_order_pdf_agreement/' . $workorder->id) ?>"><i class='bx bxs-file-pdf'></i> PDF</a>
							<?php } else{ ?>
								<a class="dropdown-item" target="_new" href="<?php echo base_url('share_Link/work_order_pdf_alarm/' . $workorder->id) ?>"><i class='bx bxs-file-pdf'></i> PDF</a>
							<?php } ?>
                        </li>
                        <li style="font-size:17px;">
							<?php if($workorder->work_order_type_id == 1){ ?>
								<a class="dropdown-item" href="javascript:void(0);" onclick="printDiv('printableArea')"><i class='bx bxs-printer'></i> Print</a>
							<?php }else if($workorder->work_order_type_id == 3){ ?>
								<a class="dropdown-item" href="<?php echo base_url('workorder/printSolar/' . $workorder->id) ?>"><i class='bx bxs-printer'></i> Print</a>
							<?php } else{ ?>
								<a class="dropdown-item" data-print-modal="open" href="javascript:void(0);" onclick="printDiv('printableArea')"><i class='bx bxs-printer'></i> Print</a>
							<?php } ?>
                        </li>                        
                    </ul>
                </div>
                  <a class="nsm-button primary" href="<?php echo base_url('workorder') ?>">BACK TO WORKORDER LIST</a>
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
                          <td colspan="2" style="text-align:left;font-weight:bold;"><h2><?= $workorder->work_order_number; ?></h2></td>
                        </tr>
                        <tr>
                          <td style="text-align:left ;">Date:</td>
                          <td style="text-align:right;"><b><?php $wDate = $workorder->date_created; echo date("m-d-Y", strtotime($wDate) ); ?></b></td>
                        </tr>
                        <tr>
                          <td style="text-align:left;">Type:</td>
                          <td style="text-align: right;"><b><?php echo $workorder->job_type ?></b></td>
                        </tr>
                        <?php if($workorder->account_type == 'Business' || $workorder->account_type == 'Commercial'){ ?>
                          <tr>
                            <td style="text-align:left;">Business Name:</td>
                            <td style="text-align: right;"><b><?php echo $customer->business_name; ?></b></td>
                          </tr>
                        <?php } ?>
                        <?php if($workorder->work_order_type_id == '3'){ ?> 
                          <tr>
                            <td style="text-align:left;">System  Type:</td>
                            <td style="text-align: right;"><b><?php echo $workorder->panel_communication ?></b></td>
                          </tr>
                        <?php } ?>
                        <?php if($workorder->work_order_type_id == '4'){ ?>
                          <tr>
                            <td style="text-align:left;">Account Type:</td>
                            <td style="text-align: right;"><b><?php echo $workorder->account_type; ?></b></td>
                          </tr>
                          <tr>
                            <td style="text-align:left;">Communication Type:</td>
                            <td style="text-align: right;"><b><?php echo $workorder->panel_communication; ?></b></td>
                          </tr>
                          <tr>
                            <td style="text-align:left;">Panel  Type:</td>
                            <td style="text-align: right;"><b><?php echo $workorder->panel_type ?? ""; ?></b></td>
                          </tr>
                          <tr>
                            <td style="text-align:left;">Source:</td>
                            <td style="text-align: right;"><b><?php echo $lead->ls_name; ?></b></td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td style="text-align:left;">Password:</td>
                          <td style="text-align: right;"><b><?php echo $workorder->password; ?></b></td>
                        </tr>
                        <tr>
                          <td style="text-align:left;">Security Number:</td>
                          <td style="text-align: right;"><b><?php echo $customer->ssn ?></b></td>
                        </tr>
						            <tr>
                          <td style="text-align:left;">Status:</td>
                          <td style="text-align: right;"><b><?php echo $workorder->status ?></b></td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <div class="row mt-4">
                    <div class="col-md-4 col-12" style="font-size:16px;">
                        <h4 class="title-border">FROM :</h4>
                        <h4><i class="bx bx-buildings"></i> <?= $company->business_name; ?></h4>
                        <div class="col-xl-5 ml-0 pl-0">
                          <span class="ul-text"><?php echo $company->street .' <br>'.$company->city .', '.$company->state .' '.$company->postal_code; ?></span><br>
                          <span class=""><?= $company->business_email; ?></span><br />
                          <span class=""><?= formatPhoneNumber($company->office_phone); ?></span>
                        </div>
                    </div>                    
                    <div class="col-md-4 col-12" style="font-size:16px;">
                        <h4 class="title-border">TO :</h4>
                        <h4><i class="bx bx-buildings"></i>  <?= $customer->first_name . ' ' . $customer->last_name; ?></h4>
                        <div class="">
                          <span class=""><?= $customer->mail_add . " " . $customer->city.', '. $customer->state .' '. $customer->zip_code;  ?></span><br />
                          <span class=""><span class=""><?= $customer->email; ?></span><br />
                          <span class=""><span class=""><?= formatPhoneNumber($customer->phone_m); ?></span><br />
                        </div>
                    </div>
                  </div>

                  <div class="row mt-4">
				  	        <div class="col-md-12" style="max-width:100%;overflow:auto;">
					            <h6 class="title-border">WORKORDER DETAILS :</h6>
						          <div class="row">
                        <div class="col-12 col-md-7">
                         <div class="row">
                          <div class="col-12 col-md-6"> 
                            <ul class="workorder-details w-100">
                            <li>
                              <span class="label-details">Job Name</span>
                              <span class="value-details"><?= $workorder->job_name; ?></span>
                            </li> 
                            <li>
                              <span class="label-details">Job Description</span>
                              <span class="value-details"><?= $workorder->job_description; ?></span>
                            </li>                            
                   
                          </ul></div>
                          <div class="col-12 col-md-6">
                          <ul class="workorder-details">
                          <li>
                              <span class="label-details">Installtion Date</span>
                              <span class="value-details">
                                <?php $installation_date = date("m-d-Y", strtotime($workorder->date_issued)); ?>
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
					          </div>
                    <div class="col-md-12" style="max-width:100%;overflow:auto;">
                    <h6 class="title-border">ITEMS :</h6>
                      <table class=" table table-print table-items" style="width: 100%; border-collapse: collapse;">
                        <thead>
                          <tr>
                            <th style="background: #f4f4f4; text-align: center; padding: 5px 0;font-weight:bold;">#</th>
                            <th style="background: #f4f4f4; text-align: left; padding: 5px 0;font-weight:bold;">Item Name</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Qty</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Price</th>
                            <th class="hidden_mobile_view" style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Discount</th>
                            <th class="hidden_mobile_view" style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Tax (%)</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;font-weight:bold;" class="text-right">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $row = 1; ?>
                          <?php foreach($workorder_items as $item){ ?>
                            <?php if($item->items_id != 0){ ?>
                              <tr class="table-items__tr">
                                <td style="width: 30px; text-align: center;" valign="top"><?= $row; ?></td>
                                <td valign="top"> <?php echo $item->title; ?>   </td>
                                <td style="width: 50px; text-align: right;" valign="top"> <?php echo $item->qty ?>  </td>
                                <td style="width: 80px; text-align: right;" valign="top">$<?php echo number_format($item->costing,2) ?></td>
                                <td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
                                  $ 0<?php //echo $item->discount ?>
                                  </td>
                                <td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
                                  $<?php echo number_format($item->tax,2) ?>
                                  </td>
                                <td style="width: 90px; text-align: right;" valign="top">$<?php $a = $item->qty * $item->costing; $b = $a + $item->tax; echo number_format($b,2); ?></td>
                              </tr>
                            <?php }else{ ?>
                              <tr class="table-items__tr">
                                <td style="width: 30px; text-align: center;" valign="top"><?= $row; ?></td>
                                <td valign="top" colspan="5"> <div id="PaName_<?php echo $item->package_id; ?>"></div> <br>
                                <div id="packageItemsTitle<?php echo  $item->package_id; ?>" style="padding-left:5%;">
                                <div id="packageItems<?php echo  $item->package_id; ?>" style="padding-left:5%;"></div>
                                </td>
                                <td style="width: 90px; text-align: right;" valign="top">$<?php $a = $item->qty * $item->costing; $b = $a + $item->tax; echo number_format($b,2); ?></td>
                              </tr>
                            <?php } ?>
                            <?php $row++; ?>
                          <?php } ?>

                          <tr>
                            <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                            <td colspan="2" style="text-align: ;">Subtotal</td>
                            <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$workorder->subtotal,2); ?></td>
                          </tr>

                          <tr>
                            <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                            <td colspan="2" style="text-align: ;">Taxes</td>
                            <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$workorder->taxes,2); ?></td>
                          </tr>

                          <?php if( $workorder->adjustment_name != '' && $workorder->adjustment_value > 0 ){ ?>
                          <tr>
                            <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                            <td colspan="2" style="text-align: ;"><?php echo $workorder->adjustment_name; ?></td>
                            <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$workorder->adjustment_value,2); ?></td>
                          </tr>
                          <?php } ?>

                          <?php if( $workorder->voucher_value != '' ){ ?>
                          <tr>
                            <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                            <td colspan="2" style="text-align: ;">Voucher</td>
                            <td colspan="1" style="text-align: right;">$<?php echo $workorder->voucher_value ?></td>
                          </tr>
                          <?php } ?>

                          <?php if( $workorder->otp_setup > 0 ){ ?>
                          <tr>
                            <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                            <td colspan="2" style="text-align: ;">One Time Program and Setup</td>
                            <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$workorder->otp_setup,2); ?></td>
                          </tr>
                          <?php } ?>

                          <?php if( $workorder->monthly_monitoring > 0 ){ ?>
                          <tr>
                            <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                            <td colspan="2" style="text-align: ;">Monthly Monitoring</td>
                            <td colspan="1" style="text-align: right;">$<?php echo number_format((Float)$workorder->monthly_monitoring,2); ?></td>
                          </tr>
                          <?php } ?>

                          <tr>
                            <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                            <td colspan="2" style="text-align: ;"><b>Grand Total ($)</b></td>
                            <td colspan="1" style="text-align: right;"><b>$<?php echo number_format((Float)$workorder->grand_total,2) ?></b></td>
                          </tr>

                        </tbody>
                      </table>
                    </div>

                    <div class="col-md-12"">
                      <h6 class="title-border">INSTRUCTIONS :</h6>
                      <span class="workorder-box"><?= $workorder->instructions; ?></span>
                    </div>

                    <div class="col-md-12"">
                      <h6 class="title-border">HEADER :</h6>
                      <span class="workorder-box"><?= $workorder->header; ?></span>
                    </div>

                    <div class="col-md-12"">
                      <h6 class="title-border">TERMS AND CONDITIONS :</h6>
                      <span class="workorder-box"><?= $workorder->terms_and_conditions; ?></span>
                    </div>

                    <div class="col-md-12"">
                      <h6 class="title-border">TERMS OF USE :</h6>
                      <span class="workorder-box"><?= $workorder->terms_of_use; ?></span>
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
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="job_settings_modal_label">Share Link</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">                        
                      <input type="text" class="nsm-field form-control mb-2 share-link-url" value="<?php echo base_url('share_Link/public_view/'.$workorder->id) ?>" readonly>                          
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button primary copy-link">Copy link to clipboard</button>
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