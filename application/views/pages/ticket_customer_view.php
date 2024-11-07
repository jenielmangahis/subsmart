<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header_front'); ?>
<style>
.nsm-card.primary {
    border-top: 4px solid #6a4a86;
}
.nsm-card {
    border: 1px solid #d3d3d3;
    border-radius: 5px;
    padding: 1em;
    height: 100%;
    overflow: hidden;
}
.list-assigned-tech{
  list-style:none;  
}
.list-assigned-tech li{
  display:inline-block;
  padding:10px;
}
.list-assigned-tech li img{
  height:45px;
  border-radius: 100%;
  margin: 0 auto;
}
.list-assigned-tech li span{
  display: block;
    height: 30px;
    margin-top: 10px;
}
</style>
<div class="row page-content g-0" style="background-color:#F7F8F9 !important;">
  <div class="col-12">                
        <div class="nsm-page" style="padding-left:10%;padding-right:10%;padding-top:1%;">
            <div class="" style="padding:2%;">
                <!-- <div class="row">
                    <div class="col-md-3">
                        <br>
                        <?php //echo $tickets->id; ?>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <div class="">
                            <div style="text-align: center;border:solid gray 1px;">
                                <h5>Ticket no</h5><hr>
                                <h5><?php //echo $tickets->ticket_no; ?></h5>
                            </div>
                            <div style="font-size:16px;">
                            
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md-8 col-sm-12" style="text-align:center;">
                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 130px; max-height: 130px;margin:10px 0px;" class="compLogo"/> 
                    </div>
                    <!-- <div class="col-md-4 spaceDiv"></div> -->
                    <div class="col-md-4 col-sm-12">
                        <table class="nsm-table">
                            <tbody>
                                <tr>
                                    <td style="width: 50%;">TICKET NUMBER</td>
                                    <td style="width: 50%;">: <b><?php echo $tickets->ticket_no ? $tickets->ticket_no : '-'; ?></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">SCHEDULED DATE</td>
                                    <td style="width: 50%;">: 
                                        <b><?php 
                                            $date = '---';
                                            if( strtotime($tickets->ticket_date) > 0 ){
                                                $date =  date("m/d/Y", strtotime($tickets->ticket_date)); 
                                            }
                                        ?>
                                        <?php echo $date ? $date : '-'; ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">SCHEDULED TIME</td>
                                    <td style="width: 50%;">: <b><?php echo $tickets->scheduled_time.' to '.$tickets->scheduled_time_to; ?></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">STATUS</td>
                                    <td style="width: 50%;">: <b><?php echo $tickets->ticket_status ? $tickets->ticket_status : '-'; ?></b></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <br><br>

                <?php if(!empty($clients)) { ?>

                    <div class="row">
                        <div class="col-md-6 nsm-callout primary">
                            <div style="font-size:16px;">
                                <b><?php echo $clients->business_name; ?></span></b> <br>
                                <span><?php echo $clients->street; ?></span><br>
                                <span><?php echo $clients->city .', '. $clients->state .' '. $clients->postal_code; ?></span><br />
                                <?php echo $clients->business_email; ?><br>
                                <?php echo formatPhoneNumber($clients->business_phone); ?>
                            </div>
                        </div>
                        <div class="col-md-6 nsm-callout primary">
                            <div style="font-size:16px;">
                                <b><span><?php echo $tickets->first_name .' '. $tickets->middle_name .' '. $tickets->last_name; ?></span></b><br>
                                <span><?php echo $tickets->mail_add; ?></span><br>
                                <span><?php echo $tickets->city .', '. $tickets->state .' '. $tickets->zip_code; ?></span><br />
                                <span><?php echo $tickets->email; ?></span><br>
                                <span><?php echo formatPhoneNumber($tickets->phone_m); ?></span>
                            </div>
                        </div>
                    </div>
                    <br>                    

                <?php } ?>
                <div class="nsm-card primary">
                        <div class="row">
                            <div class="col-md-2" style="margin-left:16px;text-align:center;border:solid #6a4a86 1px;">
                                <b>Sales Representative</b> <br>
                                <?php echo $reps->FName.' '.$reps->LName; ?><br>
                                <?php echo $tickets->sales_rep_no; ?><br>
                                <b>Team Lead/Mentor</b><br/>
                                <?php echo $tickets->tl_mentor !=  '' ? $tickets->tl_mentor : '---'; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="font-size:16px;overflow:auto;">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead style="background-color: #F3F3F3;">
                                        <th style="text-align:center;">Job Tag</th>
                                        <th style="text-align:center;">Panel Type</th>
                                        <th style="text-align:center;">Service Type</th>
                                        <th style="text-align:center;">Warranty Type</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align:center;"><?php echo $tickets->job_tag; ?></td>
                                            <td style="text-align:center;"><?php echo $tickets->panel_type; ?></td>
                                            <td style="text-align:center;"><?php echo $tickets->service_type; ?></td>
                                            <td style="text-align:center;"><?php echo $tickets->warranty_type; ?></td>
                                        </tr>
                                    </tbody>
                                </table>                    
                            </div>
                        </div>
                        <br>
                        <div class="row" style="overflow:auto;">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead style="background-color: #F3F3F3;">
                                        <!-- <th>#</th> -->
                                        <th>Items</th>
                                        <th>Item Type</th>
                                        <th style="text-align:center;">Price</th>
                                        <th style="text-align:center;">Qty</th>
                                        <th style="text-align:center;">Discount</th>
                                        <th style="text-align:center;">Total</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach($items as $item){ ?>
                                        <tr>
                                            <!-- <td><?php //echo $i; ?></td> -->
                                            <td><?php echo $item->title; ?></td>
                                            <td><?php echo $item->item_type; ?></td>
                                            <td style="text-align:center;">$<?php echo number_format($item->costing,2); ?></td>
                                            <td style="text-align:center;"><?php echo $item->qty; ?></td>
                                            <td style="text-align:center;">$<?php echo '0'.number_format($item->discount,2); ?></td>
                                            <td style="text-align:center;">$<?php echo number_format($item->total,2); ?></td>
                                        </tr>
                                        <?php 
                                            $i++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-bordered" style="width:100%;">
                                    <tr>
                                        <td style="width:32%;"><b>Payment Method </b></td>
                                        <td style="text-align:;"><?php echo $tickets->payment_method; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Payment Amount</b></td>
                                        <td style="text-align:;">$<?php echo number_format($tickets->payment_amount,2); ?></td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div class="col-md-4 spaceDiv">
                            </div>
                            <div class="col-md-4 summaryArea">
                                <table class="table table-bordered">
                                    <tr style="font-weight:bold;">
                                        <td>Subtotal</td>
                                        <td style="text-align:right;">$<?php echo number_format($tickets->subtotal,2); ?></td>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td>Taxes</td>
                                        <td style="text-align:right;">$<?= $tickets->taxes > 0 ? number_format($tickets->taxes,2,".","") : '0.00'; ?></td>
                                    </tr>
                                    <?php if( $tickets->adjustment_value > 0 ){ ?>
                                      <td><b><?php echo $tickets->adjustment != '' ? $tickets->adjustment : 'Adjustment'; ?></b></td>
                                      <td style="text-align: right">$<?php echo number_format($tickets->adjustment_value,2); ?></td>
                                    <?php } ?>
                                    <tr style="font-weight:bold;">
                                        <td>Grand Total</td>
                                        <td style="text-align:right;">$<?php echo number_format($tickets->grandtotal,2); ?></td>
                                    </tr>
                                </table>
                                
                            </div>
                        </div>
                    </div>

                <br><br>
                
                <div class="nsm-card primary">
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <b>Assigned Technicians</b><br>
                            <ul class="list-assigned-tech">
                            <?php
                                $assigned_technician = unserialize($tickets->technicians);
                                if($assigned_technician){
                                    foreach($assigned_technician as $eid){
                                        $user = getUserName($eid);
                                        echo $custom_html = '<li><img src="'.userProfileImage($eid).'"><span class="tech-name">'.$user['name'].'</span></li>';
                                    }
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <hr />
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <b>Terms and Conditions</u></b><br> <?php echo $tickets->terms_conditions; ?>
                        </div>
                    </div>
                    <hr />
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <b>Instructions</u></b> <br> <?php if(empty($tickets->instructions)){ echo 'N/A'; }else{ echo $tickets->instructions; } ?> 
                        </div>
                    </div>
                    <hr />
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <span><b>Warranty Repair Service</b><br />During the term of your agreement, we will repair or service any defective part of the System as follows: (A) What is covered. If you to renewal your Premium warranty Service, then we will, so long as you are providing services contract. If you decline the Premium Service, however, then you agree to pay to <?php echo $ticketsCompany->business_name; ?> or its assignee the Grand Total Value of the service. So as long as we are providing service pursuant to your agreement, you will agree to a visit charge for each service call, and you agree to pay the same. We can use new or used parts of the same functionality and keep all replaced parts. (B) What is not covered: Act of God and any non-normal conditions. </span>
                        </div>
                    </div>
                </div>

            </div>

            <div id="printableArea" class="" style="width:100% !important; display:none;">
                <div class="invoice-paper" id="presenter-paper">
                    <div id="" style="width:100%">
                    
                        <style>
                            #background
                            {
                                position:absolute;
                                z-index:0;
                                display:block;
                                margin-top: -100px;
                                margin-left: 20%;
                                color:yellow;
                            }

                            #bg-text
                            {
                                color:lightgreen;
                                font-size:150px;
                                transform:rotate(300deg);
                                -webkit-transform:rotate(300deg);
                                opacity: 0.4;
                            }

                            #tbl-sales-rep #td-sales-rep {
                                text-align: center; background: #f4f4f4 !important; padding: 8px 0;
                            }
                        </style>

                        <div class="presenter-paper-sm" id="presenter-paper-sm"></div>
                        <div class="invoice-print" style="background: #ffffff;">
                            <table class="table-print" style="width: 100%; margin-bottom: 10px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-bottom: 20px;">
                                                <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 150px" />
                                            </div>

                                            <div id="presenter-from">
                                                <p style="margin: 0"><b><?php echo $clients->business_name; ?></b></p>
                                                <p style="margin: 0"><?php echo $clients->street; ?></p>
                                                <p style="margin: 0"><?php echo $clients->city; ?>, <?php echo $clients->state; ?> <?php echo $clients->postal_code; ?></p>
                                                <p style="margin: 0">Email: <?php echo strtolower($clients->business_email) != 'not specified' ? strtolower($clients->business_email) : ''; ?></p>
                                                <p style="margin: 0">Phone: <?php echo strtolower(formatPhoneNumber($clients->business_phone)); ?></p>
                                                <br>
                                            </div>

                                        </td>
                                        <td id="presenter-col-right" class="presenter-col-right" style="width: 50%; text-align: right;" valign="top">
                                            <div id="presenter-title-container" class="presenter-title-container" style="margin-top: 10px; margin-bottom: 20px;">
                                                <span class="presenter-title" style="font-size: 25pt;color:#8c97c0;">Service Ticket</span><br>
                                            </div>
                                            <div id="presenter-summary" class="presenter-summary">
                                                <table style="width: 100%">
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align: right;">Ticket No:</td>
                                                            <td style="width: 160px; text-align: right;" class="text-right">
                                                                <?php echo $tickets->ticket_no ? $tickets->ticket_no : '-';; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">Scheduled Date:</td>
                                                            <td style="width: 160px; text-align: right;" class="text-right">
                                                                <?php 
                                                                    $date = '-';
                                                                    if( strtotime($tickets->ticket_date) > 0 ){
                                                                        $date =  date("m/d/Y", strtotime($tickets->ticket_date)); 
                                                                    }
                                                                ?>
                                                                <?php echo $date ? $date : '-'; ?>                                               
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">Scheduled Time:</td>
                                                            <td style="width: 160px; text-align: right;" class="text-right"><?php echo $tickets->scheduled_time.' to '.$tickets->scheduled_time_to; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">Purchase Order No:</td>
                                                            <td style="width: 160px; text-align: right;" class="text-right"><?php echo $tickets->purchase_order_no ? $tickets->purchase_order_no : '-'; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;"><b>Status:</b></td>
                                                            <td style="width: 160px; text-align: right;" class="text-right"><b><?php echo $tickets->ticket_status ? $tickets->ticket_status : '-'; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;"><b>Business Name:</b></td>
                                                            <td style="width: 160px; text-align: right;" class="text-right"><b><?php echo $tickets->business_name ? $tickets->business_name : '-'; ?></b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table-print" style="width: 100%;margin-top: -60px;">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%" valign="top">
                                            <p style="margin: 0"><b><?php echo $tickets->first_name .' '. $tickets->middle_name .' '. $tickets->last_name; ?></b></p>
                                            <p style="margin: 0"><?php echo $tickets->mail_add; ?></p>
                                            <p style="margin: 0"><?php echo $tickets->city; ?></span>, <span><?php echo $tickets->state; ?></span> <span><?php echo $tickets->zip_code; ?></p>
                                            <p style="margin: 0">Email: <?php echo strtolower($tickets->email) != 'not specified' ? strtolower($tickets->email) : ''; ?></p>
                                            <p style="margin: 0">Phone: <?php echo formatPhoneNumber($tickets->phone_m); ?></p>
                                        </td>
                                        <td style="width: 70%" valign="top"></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <div id="background">
                                <p id="bg-text"><?php echo $tickets->ticket_status; ?></p>
                            </div>

                            <br><br>

                            <br><br>
                            <div class="table-items-container">
                                <table class="table-print table-items tbl-sales-rep" id="tbl-sales-rep" style="width: 100%; border-collapse: collapse; font-size: 12px">
                                    <tbody>
                                        <tr class="table-items__tr">
                                            <td colspan="4" style="text-align: left; background: #ffffff !important; padding: 8px 0;" >
                                                <p><b>Service Location: </b><br />
                                                <?php echo $tickets->service_location; ?></p>
                                            </td>
                                            <td colspan="1" id="td-sales-rep" class="td-sales-rep" style="" >
                                                <b>Sales Representative</b> <br>
                                                <?php echo $reps->FName.' '.$reps->LName; ?><br>
                                                <?php echo formatPhoneNumber($tickets->sales_rep_no); ?><br>
                                                <span>Team Lead/Mentor</span>: 
                                                <?php echo $tickets->tl_mentor; ?>                                               
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <br>

                            <div class="table-items-container">
                                <table class="table-print table-items" style="width: 100%; border-collapse: collapse; font-size: 12px">
                                    <thead>
                                        <tr>
                                            <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Job Tag</th>
                                            <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Panel Type</th>
                                            <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Service Type</th>
                                            <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Warranty Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-items__tr">
                                            <td style="text-align:center;" valign="top">
                                                <?php echo $tickets->job_tag ? $tickets->job_tag : '-'; ?>
                                            </td>
                                            <td style="text-align: center;" valign="top">
                                                <?php echo $tickets->panel_type ? $tickets->panel_type : '-'; ?>
                                            </td>
                                            <td style="text-align: center;" valign="top">
                                                <?php echo $tickets->service_type ? $tickets->service_type : '-'; ?>                  
                                            </td>
                                            <td style="text-align: center;" valign="top">
                                                <?php echo $tickets->warranty_type ? $tickets->warranty_type : '-'; ?>               
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </div>
                            <br><br>

                            <div class="table-items-container">
                                <?php $total_tax = 0; ?>
                                <table class="table table-bordered" style="width: 100%; border-collapse: collapse; font-size: 12px">
                                    <thead style="">
                                        <tr>
                                            <th style="background: #f4f4f4; text-align: center;">#</th>
                                            <th style="background: #f4f4f4; text-align: left;">Items</th>
                                            <th style="background: #f4f4f4; text-align: left; ">Item Type</th>
                                            <th style="background: #f4f4f4; text-align: center;">Price</th>
                                            <th style="background: #f4f4f4; text-align: center;">Qty</th>
                                            <th style="background: #f4f4f4; text-align: center;">Discount</th>
                                            <th style="background: #f4f4f4; text-align: right;" class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($items as $item){ ?>
                                            <tr class="table-items__tr">
                                                <td style="text-align:center;" valign="top"><?php echo $i; ?></td>
                                                <td style="text-align: left;" valign="top"><?php echo $item->title; ?></td>
                                                <td style="text-align: left;" valign="top"><?php echo $item->item_type; ?></td>
                                                <td style="text-align: center;" valign="top">$<?php echo number_format($item->costing,2); ?></td>
                                                <td style="text-align: center;" valign="top"><?php echo $item->qty; ?></td>
                                                <td style="text-align: center;" valign="top">$<?php echo number_format($item->discount,2); ?></td>
                                                <td style="text-align: right;" valign="top">$<?php echo number_format($item->total,2); ?></td>
                                            </tr>
                                            <tr class="table-items__tr-last">
                                                <td></td>
                                                <td colspan="6"></td>
                                            </tr>
                                        <?php $i++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" style="text-align: left"><b>Payment Method: </b</td>
                                            <td colspan="2" style="text-align: left"><?php echo $tickets->payment_method; ?></td>
                                            <td colspan="2" style="text-align: right"><b>Subtotal</b></td>
                                            <td style="text-align: right">$<?php echo number_format($tickets->subtotal,2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: left"><b>Payment Amount: </b</td>
                                            <td colspan="2" style="text-align: left">$<?php echo number_format($tickets->payment_amount,2); ?></td>
                                            <td colspan="2" style="text-align: right"><b>Taxes</b></td>
                                            <td style="text-align: right">$<?php if(empty($tickets->taxes)){ echo '0';} echo number_format($tickets->taxes,2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: left"><!-- <b>Billing Date: </b>--></td>
                                            <td colspan="2" style="text-align: left"><?php //echo $tickets->billing_date ? $tickets->billing_date : '-'; ?></td>
                                            <?php if( $tickets->adjustment_value > 0 ){ ?>
                                            <td colspan="2" style="text-align: right"><b><?php echo $tickets->adjustment != '' ? $tickets->adjustment : 'Adjustment'; ?></b></td>
                                            <td style="text-align: right">$<?php echo number_format($tickets->adjustment_value,2); ?></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2" style="text-align: right; background: #f4f4f4;"><b>Grand Total</b></td>
                                            <td style="text-align: right; background: #f4f4f4;"><b>$<?php echo number_format($tickets->grandtotal + $mmr + $icost,2); ?></b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br><br>
                            <hr style="border-color:#eaeaea;">
                            <div id="techArea" style="">
                                <b>Assigned Technicians</b> <br><br>
                                <?php
                                $assigned_technician = unserialize($tickets->technicians);
                                if($assigned_technician) {
                                    foreach($assigned_technician as $eid){
                                        $user = getUserName($eid);
                                        echo $custom_html = '<div style="vertical-align: middle"><img src="'.userProfileImage($eid).'" style="width: 40px; border-radius: 10px;">&nbsp;'.$user['name'].'</div>';
                                    }                    
                                } else {
                                    echo "-";                    
                                }
                                ?>
                            </div>
                                        
                            <br><br>
                            <hr style="border-color:#eaeaea;">
                            <p style="color:#888; margin: 0">
                                Business powered by nSmarTrac
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<?php include viewPath('includes/footer_pages'); ?>