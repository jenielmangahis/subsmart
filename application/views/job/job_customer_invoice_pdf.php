<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php 
$group_items = array();
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
}

?>
<table style="width: 100%;font-size: 10px;">
    <tr>
        <td style="text-align: right;" colspan=2><span style="font-weight: 700;font-size: 16px;"><?=  $jobs_data->job_number;  ?></span><br></td>
    </tr>
    <tr>
        <td style="width:50%;">
            <?php if($company_info->business_image != "" ): ?>
                <img style="width: 100px;" alt="Attachment" src="<?= dirname(__DIR__, 3) . '/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image; ?>">
            <?php endif; ?>
        </td>
        <td style="text-align: right;">
            <table>
                <tbody>
                <tr>
                    <td>Job Type :</td>
                    <td><?= $jobs_data->job_type;  ?></td>
                </tr>
                <tr>
                    <td>Job Tags:</td>
                    <td><?= $jobs_data->name;  ?></td>
                </tr>
                <tr>
                    <td>Date :</td>
                    <td><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?></td>
                </tr>
                <tr>
                    <td>Priority :</td>
                    <td style="color: darkred;"><?=  $jobs_data->priority;  ?></td>
                </tr>
                <tr>
                    <td>Status :</td>
                    <td style="font-weight: 600;"><?=  $jobs_data->status;  ?></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>
<br><br><br>
<table style="width: 100%;margin-top: 20px;font-size: 9px;">
    <tr>
        <td>
            <b>FROM</b><br><br>
            <b><?= trim($company_info->business_name); ?></b><br>
            <span><?= $company_info->street; ?></span><br>
            <span><?= $company_info->city.', '.$company_info->state.' '.$company_info->postal_code ; ?></span><br>
            <span>Phone: <?= $company_info->business_phone ; ?></span>
        </td>
        <td>
            <b>TO</b><br><br>
            <b><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></b><br>
            <span><?= $jobs_data->mail_add; ?></span><br>
            <span><?= $jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span><br>
            <span>Email: <?= $jobs_data->cust_email ; ?></span> <a href="mailto:<?= $jobs_data->cust_email ; ?>"></a><br>
            <span>Phone:  </span>
            <?php if($jobs_data->phone_h!="" || $jobs_data->phone_h!=NULL): ?>
                <?= $jobs_data->phone_h;  ?>
            <?php else : echo 'N/A';?>
            <?php endif; ?>
            / 
            <span>Mobile: </span>
            <?php if($jobs_data->phone_m!="" || $jobs_data->phone_m!=NULL): ?>
                <?= $jobs_data->phone_h;  ?>
                <?= $jobs_data->phone_m;  ?>
            <?php else : echo 'N/A';?>
            <?php endif; ?>
        </td>
    </tr>
</table>
<h4 style="font-size: 9px;">JOB DETAILS :</h4>
<?php foreach($group_items as $type => $items){ ?>
<table style="font-size: 9px;padding: 5px;">
    <tr>
        <td style="width:400px;border:1px solid black;"><b><?= ucfirst($type); ?></b></td>
        <td style="width:50px;border:1px solid black;">Qty</td>
        <td style="width:100px;border:1px solid black;">Price</td>
        <td style="width:100px;border:1px solid black;">Total</td>
    </tr>
    <?php foreach($items as $i){ ?>
    <?php 
        $total    = $i['item_price'] * $i['item_qty']; 
        $subtotal = $subtotal + $total;
    ?>
    <tr>
        <td style="border:1px solid black;"><?= $i['item_name']; ?></td>
        <td style="text-align: left;border:1px solid black;"><?= $i['item_qty']; ?></td>
        <td style="text-align: left;border:1px solid black;">$<?= $i['item_price']; ?></td>
        <td style="text-align: left;border:1px solid black;text-align: right;">$<?= number_format((float)$total,2,'.',','); ?></td>
    </tr>
    <?php } ?>
    <?php $grand_total += $subtotal; ?>
    <tr>
        <td style="background-color: #cfcfcf;border:1px solid black;"><b>Sub Total</b></td>
        <td colspan="3" style="background-color: #cfcfcf;border:1px solid black;text-align: right;"><b>$<?= number_format((float)$subtotal,2,'.',','); ?></b></td>
    </tr>
</table>
<br><br>
<?php } ?>

<table style="font-size: 10px;padding: 5px;margin: 0px;">
    <tr>
        <td colspan="3"><b>Grand Total</b></td>
        <td><b>$<?= number_format((float)$grand_total,2,'.',','); ?></b></td>
    </tr>
</table>
<table style="font-size: 10px;padding: 5px;">
    <tr>
        <td style="width: 50px;"><b>NOTES</b></td>
        <td><?=  $jobs_data->message; ?></td>
        <td><b>ASSIGNED TO</b></td>
        <td><?php
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
        </td>
        <!-- <td colspan="2"><b>URL LINK</b> :<span><a style="color: darkred;" target="_blank" href="<?= $jobs_data->link; ?>"><?= $jobs_data->link; ?></a></span></td> -->
    </tr>
</table>
<table style="font-size: 10px;padding: 5px;">
    <tr>
        <td><span style="font-weight: 700;font-size: 18px;color: darkred;">Total : $<?= number_format((float)$grand_total,2,'.',','); ?></span></td>
    </tr>
</table>

