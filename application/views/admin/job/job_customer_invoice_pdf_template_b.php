<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php 
$group_items = array();
$grand_total = 0;
foreach($jobs_data_items as $ji){
    $type = 'product';
    if( $ji->type != 'product' ){
        $type = 'service';
    }
    $group_items[$type][] = [
        'item_name' => $ji->title,
        'item_price' => $ji->price,
        'item_qty' => $ji->qty
    ];

    $grand_total += $ji->price * $ji->qty;
}
//$due_date = date("m/d/Y", strtotime("+30 days"));
$due_date     = date("m/d/Y", strtotime($jobs_data->invoice_due_date));
$invoice_date = date("m/d/Y", strtotime($jobs_data->invoice_date));
?>
<table style="font-size: 10px;" width="100%">
    <tr>
        <td width="40%">

            <table style="font-size: 10px;" width="100%">
                <tr>
                    <td width="70%"><img style="width: 100px;" alt="Attachment" src="<?= dirname(__DIR__, 3) . '/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image; ?>"></td>
                </tr>
                <tr>
                    <td width="70%"></td>
                </tr>
                <tr>
                    <td width="70%"></td>
                </tr>
                <tr>
                    <td width="70%"></td>
                </tr>
                <tr>
                    <td width="100%"><?= strtoupper($jobs_data->first_name.' '.$jobs_data->last_name); ?></td>
                </tr>
                <tr>
                    <td width="100%"><?= strtoupper($jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code); ?></td>
                </tr>
                <tr>
                    <td width="70%"></td>
                </tr>
                <tr>
                    <td width="70%"></td>
                </tr>
                <tr>
                    <td width="100%"><?= strtoupper(trim($company_info->business_name)); ?></td>
                </tr>
                <tr>
                    <td width="100%"><?= strtoupper($company_info->street); ?></td>
                </tr>
                <tr>
                    <td width="100%"><?= strtoupper($company_info->city.', '.$company_info->state.' '.$company_info->postal_code); ?></td>
                </tr>
                <tr>
                    <td width="100%">TEL: <?= $company_info->business_phone ; ?></td>
                </tr>
            </table>
        </td>
        <td width="60%">
            <table style="width: 100%;font-size: 10px;">
                <tr>
                    <td width="50%" style="padding:0px;">
                        <table>
                            <tr>
                                <td width="100%" style="text-align:left;page-break-after: always;display:block;font-weight:bold;font-size:13px;">ORIGINAL INVOICE</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;display:block;font-size:9px;">CUSTOMER INVOICE</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;display:block;font-size:9px;">PLEASE WRITE THIS NUMBER</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;display:block;font-size:9px;">ON ALL ORDERS AND CHECKS</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td width="100%" style="page-break-after: always;display:block;border-collapse: collapse;border:1px solid black;text-align:center;">
                                <table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;"><?=  $jobs_data->job_number; ?></span>
                                </td>    
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td style="text-align:left;display:block;font-size:15px;"></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;display:block;font-size:9px;font-weight:bold;">PLEASE PAY THIS AMOUNT</td>
                            </tr>
                            <tr>
                                <td style="text-align:right;display:block;font-size:8px;"></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;display:block;font-size:6px;"></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;display:block;font-size:9px;font-weight:bold;">DUE DATE</td>
                            </tr>
                            <tr>
                                <td style="text-align:right;display:block;font-size:9px;"></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;display:block;font-size:4px;"></td>
                            </tr>
                            <!-- <tr>
                                <td width="100%" style="text-align:left;page-break-after: always;display:block;font-weight:bold;font-size:13px;">REMIT TO:</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;display:block;font-size:9px;">SUBSMART INC., DBS ADI</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;display:block;font-size:9px;">PO BOX 32422</td>
                            </tr>
                            <tr>
                                <td style="text-align:left;display:block;font-size:9px;">DALLAS TEXAS</td>
                            </tr> -->
                        </table>
                    </td>
                    <td width="50%">
                        <table>
                            <tr>
                                <td width="40%" style="text-align:center;page-break-after: always;display:block;border:1px solid black;font-weight:bold;">PAGE</td>
                                <td width="60%" style="text-align:center;page-break-after: always;display:block;border:1px solid black;font-weight:bold;">INVOICE DATE</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;page-break-after: always;display:block;border:1px solid black;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;">1</span></td>
                                <td style="text-align:center;display:block;border:1px solid black;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;"><?= $invoice_date; ?></span></td>
                            </tr>
                            <tr><td style="font-size:4px;"></td></tr>
                            <tr>
                                <td width="100%" style="text-align:center;page-break-after: always;display:block;border:1px solid black;font-weight:bold;">JOB NUMBER</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;page-break-after: always;display:block;border:1px solid black;">
                                <table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;"><?=  $jobs_data->job_number; ?></span></td>
                            </tr>
                            <tr><td style="font-size:4px;"></td></tr>
                            <tr>
                                <td style="text-align:center;page-break-after: always;display:block;border:1px solid black;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;">$<?= number_format($grand_total,2); ?></span></td>
                            </tr>
                            <tr><td style="font-size:4px;"></td></tr>
                            <tr>
                                <td style="text-align:center;page-break-after: always;display:block;border:1px solid black;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;"><?= $due_date; ?></span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="text-align:right;display:block;font-size:5px;"></td>
                </tr>
                <tr>
                    <td style="text-align:center;display:block;font-size:9px;"><!-- TEL: <?= $company_info->business_phone ; ?> --></td>
                </tr>
                <tr>
                    <td style="text-align:center;display:block;font-size:9px;"></td>
                </tr>

            </table>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style="text-align:right;display:block;font-size:13px;"></td>
    </tr>
</table>
<table style="font-size: 10px;" width="100%">
    <tr>
        <td width="50%" style="text-align:center;display:block;font-size:9px;font-weight:bold;">Please detach and enclose top portion with your payment</td>
        <td width="50%" style="text-align:center;display:block;font-size:9px;font-weight:bold;">Make check payable and remit to above address</td>
    </tr>
</table>
<table style="font-size: 10px;" width="100%">
    <tr>
        <td style="text-align:right;display:block;font-size:3px;"></td>
    </tr>
    <tr>
        <td style="border-top:1px dashed black;"></td>
    </tr>
</table>
<br/>

<table style="font-size: 10px;" width="100%">
    <tr>
        <td width="20%">
            <img style="width: 50px;" alt="Attachment" src="<?= dirname(__DIR__, 3) . '/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image; ?>">
        </td>
        <!-- <td width="20%">
            <table>
                <tr>
                    <td width="100%" style="text-align:center;page-break-after: always;display:block;font-weight:bold;font-size:9px;">CUSTOMER NO#</td>
                </tr>
                <tr>
                    <td width="100%" style="text-align:center;page-break-after: always;display:block;border:1px solid black;font-weight:bold;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;">DP-311-00</span></td>
                </tr>
            </table>
        </td> -->
        <td width="20%">
            <table>
                <tr>
                    <td width="100%" style="text-align:center;page-break-after: always;display:block;font-weight:bold;font-size:9px;">JOB INVOICE NO#</td>
                </tr>
                <tr>
                    <td width="100%" style="text-align:center;page-break-after: always;display:block;border:1px solid black;font-weight:bold;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;"><?=  $jobs_data->job_number;  ?></span></td>
                </tr>
            </table>
        </td>
        <td width="20%">
            <table>
                <tr>
                    <td width="100%" style="text-align:center;page-break-after: always;display:block;font-weight:bold;font-size:9px;">DATE</td>
                </tr>
                <tr>
                    <td width="100%" style="text-align:center;page-break-after: always;display:block;border:1px solid black;font-weight:bold;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;"><?= date("m/d/Y"); ?></span></td>
                </tr>
            </table>
        </td>
        <td width="20%">
            <table>
                <tr>
                    <td width="100%" style="text-align:center;page-break-after: always;display:block;font-weight:bold;font-size:9px;"></td>
                </tr>
                <tr>
                    <td width="100%" style="text-align:left;page-break-after: always;display:block;font-weight:bold;"><span style="width:100%;display:block;text-align:left;">Retain this portion for your records</span></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table>
    <tr>
        <td style="text-align:right;display:block;font-size:13px;"></td>
    </tr>
</table>

<table style="font-size: 10px;" width="100%">
    <tr>
        <td width="40%" style="border:1px solid black;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;">ITEM DESCRIPTION</span></td>
        <td width="15%" style="border:1px solid black;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;">ITEM TYPE</span></td>
        <td width="15%" style="border:1px solid black;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;">QTY</span></td>
        <td width="15%" style="border:1px solid black;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;">UNIT PRICE</span></td>
        <td width="15%" style="border:1px solid black;"><table><tr><td></td></tr></table><span style="width:100%;display:block;text-align:center;">AMOUNT</span></td>
    </tr>
    <?php 
        $total_service = 0;
        $total_product = 0;
    ?>
    <?php foreach($group_items as $type => $items){ ?>
        <?php foreach($items as $i){ ?>
            <?php 
                $total    = $i['item_price'] * $i['item_qty']; 
                $subtotal = $subtotal + $total;
                if( $type == 'product' ){
                    $total_product += $total;
                }else{
                    $total_service += $total;
                }
            ?>
            <tr>
                <td width="40%" style="border:1px solid black;padding: 3px;"><?= $i['item_name']; ?></td>
                <td width="15%" style="border:1px solid black;padding: 3px;"><span style="width:100%;display:block;text-align:center;"><?= strtoupper($type); ?></span></td>
                <td width="15%" style="border:1px solid black;padding: 3px;"><span style="width:100%;display:block;text-align:center;"><?= $i['item_qty']; ?></span></td>
                <td width="15%" style="border:1px solid black;padding: 3px;"><span style="width:100%;display:block;text-align:center;">$<?= number_format((float)$i['item_price'],2,'.',','); ?></span></td>
                <td width="15%" style="border:1px solid black;padding: 3px;"><span style="width:100%;display:block;text-align:center;">$<?= number_format((float)$total,2,'.',','); ?></span></td>
            </tr>
        <?php } ?>
    <?php } ?>
    
    <tr>
        <td width="55%"><table><tr><td style="font-size:4px;"></td></tr></table><table><tr><td style="font-size:4px;"></td></tr></table><span style="font-size:8px;"><!-- REF VISA #------------5898 169.00 --></span></td>
        <td width="30%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;display:block;text-align:left;font-weight:bold;">TOTAL PRODUCT</span></td>
        <td width="15%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;display:block;text-align:right;">$<?= number_format((float)$total_product,2,'.',','); ?></span></td>
    </tr>
    <tr>
        <td width="55%"><span style="font-size:8px;"><!-- E-CHECK NOW AVAILABLE. CONTACT YOUR ADI CREDIT ANALYST. <br/> SIGN UP FOR E-INVOICING GO TO: ADIGLOBAL.COM/GOGREEN --></span></td>
        <td width="30%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;display:block;text-align:left;font-weight:bold;">TOTAL SERVICE</span></td>
        <td width="15%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;display:block;text-align:right;">$<?= number_format((float)$total_service,2,'.',','); ?></span></td>
    </tr>
    <!-- <tr>
        <td width="55%"></td>
        <td width="30%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;display:block;text-align:left;font-weight:bold;">SHIPPING & HANDLING</span></td>
        <td width="15%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;display:block;text-align:right;">-169.00</span></td>
    </tr> -->
    <tr>
        <td width="55%"><table><tr><td style="font-size:4px;"></td></tr></table></td>
        <td width="30%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;font-size:13px;display:block;text-align:left;font-weight:bold;">TOTAL INVOICE</span></td>
        <td width="15%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;display:block;text-align:right;">$<?= number_format((float)$grand_total,2,'.',','); ?></span></td>
    </tr>
    <tr>
        <td width="55%"><table><tr><td style="font-size:4px;"></td></tr></table></td>
        <td width="30%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;font-size:13px;display:block;text-align:left;font-weight:bold;">DUE DATE</span></td>
        <td width="15%" style="border:1px solid black;"><table><tr><td style="font-size:4px;"></td></tr></table><span style="width:100%;display:block;text-align:right;"><?= $due_date; ?></span></td>
    </tr>
</table>

<table>
    <tr>
        <td style="text-align:right;display:block;font-size:5px;"></td>
    </tr>
</table>

<br><br>
<table style="font-size: 10px;" width="100%">
    <tr>
        <td width="25%"><table><tr><td style="font-size:4px;"></td></tr></table><span style="text-align:center;color:red;font-size:12px;font-weight:bold;">THANK YOU FOR YOUR BUSINESS</td>
        <td width="50%"><span> </span></td>
        <td width="15%"><span> </span></td>
    </tr>
</table>
<br/>
<table style="font-size: 10px;" width="100%">
    <tr>
        <td width="100%"><table><tr><td style="font-size:4px;"></td></tr></table><span style="text-align:left;font-size:8px;font-weight:bold;">All claims must be made within 5 days after receipt of goods. Goods returned without our authorized return number on the carton will be refused. The purchase of products and services are subject to and governed solely by the Terms and Conditions.<br/><span style="color:blue;">https://nsmartrac.com/terms-and-condition</span> <br/> <span style="color:red;">Past due balances may be subject to a Late Charge not to exceed 1.5% per month.</span></td>
    </tr>
</table>





<!--
<table style="width: 100%;font-size: 10px;">
    <tr>
        <td>
            <img style="width: 100px;" alt="Attachment" src="<?= dirname(__DIR__) . '/uploads/users/business_profile/10/1.jpg'; ?>">
        </td>
    </tr>
    <tr>
        <td style="text-align: right;" colspan=2><span style="font-weight: 700;font-size: 16px;">1</span><br></td>
    </tr>
</table> -->