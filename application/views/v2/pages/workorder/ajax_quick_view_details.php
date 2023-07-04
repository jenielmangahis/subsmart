<style>
.quick-view-schedule-container .title-border{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
.total-summary{
    list-style: none;
    padding: 0px;
}
.total-summary li{
    display: inline-block;
    width: 49%;
    margin-bottom: 6px;
}
.total-summary li span{
    display: block;
}
.total-summary li .right-text{
    text-align: right;
}
</style>
<div class="">
    <div class="row">
        <div class="col-md-12">
        <div class="right-text">
            <span class="page-title " style="font-weight: bold;font-size: 2.5rem; float: right"><?=  $jobs_data->job_number;  ?>
            </span>
        </div>
        </div>
    </div>
    <div class="card-body quick-view-schedule-container">
        <div class="row">
            <div class="col-md-5">
                <?php if ($company_info->business_image != ""): ?>
                <img style="max-width: 130px; max-height: 130px;" id="attachment-image" alt="Attachment"
                    src="<?= base_url('/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image); ?>">
                <?php endif; ?>
            </div>
            <div class="col-md-7">
                <table class="right-text" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td align="right" width="35%">Account Type :</td>
                            <td align="right" width="">
                                <strong><?= $workorder->account_type;  ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="35%">Panel Type :</td>
                            <td align="right" width="">
                                <strong><?= $workorder->panel_type;  ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Tags:</td>
                            <td align="right">
                                <strong><?= $tags; ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Date :</td>
                            <td align="right">
                                <?= date('m/d/Y g:i a', strtotime($workorder->date_created)); ?>
                            </td>
                        </tr>                        
                        <tr>
                            <td align="right">Priority :</td>
                            <td align="right" style="color: darkred;">
                                <?=  $workorder->priority; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>            
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <h6 class="title-border">FROM :</h6>
                <div style="padding:0px 9px; font-size: 14px;">
                    <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                        <i class='bx bx-buildings'></i> <?= $company_info->business_name; ?>
                    </span>                    
                    <span><?= $company_info->street; ?></span><br>
                    <span><?= $company_info->city.', '.$company_info->state.' '.$company_info->postal_code; ?></span><br>
                    <?php if( $company_info->business_email != '' ){ ?>
                        <span> Email: <a href="mailto:<?= $company_info->business_email; ?>"><?= $company_info->business_email; ?></a></span><br />
                    <?php } ?>
                    <span> Contact Number: <?= formatPhoneNumber($company_info->business_phone); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <h6 class="title-border">TO : </h6>
                <div style="padding:0px 9px; font-size: 14px;">
                    <?php if( $customer->customer_type == 'Business' && $customer->business_name != '' ){ ?>
                        <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                            <i class='bx bx-user-circle' ></i> <?= $customer->first_name .' '. $customer->last_name; ?> - 
                            <i class='bx bx-buildings'></i> <?= $customer->business_name; ?>
                        </span>
                    <?php }else{ ?>
                        <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                            <i class='bx bx-user-circle' ></i> <?= $customer->first_name .' '. $customer->last_name; ?>
                        </span>
                    <?php } ?>                    
                    <span><?= $customer->mail_add; ?></span><br>
                    <span><?= $customer->city.', '.$customer->state.' '.$customer->zip_code; ?></span><br />
                    <?php if( $customer->email != '' ){ ?>
                        <span>Email: <a href="mailto:<?= $customer->email; ?>"><?= $customer->email; ?></a></span><br>
                    <?php } ?>                
                    <!-- <span>Phone: <?= $jobs_data->phone_h !="" || $jobs_data->phone_h !=null ? $jobs_data->phone_h : 'N/A'; ?> </span><br>    -->             
                    <span>Contact Number: <?= $customer->phone_m !="" || $customer->phone_m !=null ? formatPhoneNumber($customer->phone_m) : 'N/A'; ?></span><br>
                </div>
            </div>            
        </div>
        <div class="row mt-5">
            <div class=" col-md-12">                    
                <div class="behind_container" style="">
                    <table  class="table table-bordered">
                        <thead align="center">
                            <th>Items</th>
                            <th>Quantity</th>
                            <th>Location</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            <?php foreach($agree_items as $aItems) { ?>
                                <?php if( $aItems->qty > 0 && $aItems->price > 0 ){ ?>
                                <tr>
                                    <td><?php echo $aItems->item; if($aItems->check_data == NULL){ echo ''; }else{ echo ' ('. $aItems->check_data .') ';} ?></td>
                                    <td><?php echo $aItems->qty ?></td>
                                    <td><?php echo $aItems->location ?></td>
                                    <td><?php echo $aItems->price ?></td>
                                </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-2"> 
            <div class="col-md-12">
                <hr />
                <table class="table table-borderless">
                    <tr>
                        <td>Equipment Cost</td>
                        <td align="right"><h5>$ <?php echo number_format((Float)$workorder->subtotal,2); ?></h5> </td>
                    </tr>
                    <tr>
                        <td>Sales Tax</td>
                        <td align="right"><h5>$ <?php echo number_format((Float)$workorder->taxes,2); ?></h5> </td>
                    </tr>
                    <tr>
                        <td>Installation Cost</td>
                        <td align="right"><h5>$ <?php echo number_format((Float)$workorder->installation_cost,2); ?></h5> </td>
                    </tr>
                    <tr>
                        <td>One time (Program and Setup)</td>
                        <td align="right"><h5>$ <?php echo number_format((Float)$workorder->otp_setup,2); ?></h5> </td>
                    </tr>
                    <tr>
                        <td>Monthly Monitoring</td>
                        <td align="right"><h5>$ <?php echo number_format((Float)$workorder->monthly_monitoring,2); ?></h5></td>
                    </tr>
                    <tr>
                        <td>Total Due</td>
                        <td align="right"><h5>$ <?php echo number_format((Float)$workorder->grand_total,2); ?></h5></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>