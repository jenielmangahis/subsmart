<style>
.quick-view-schedule-container .title-border{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
</style>
<div class="row">                    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="right-text">
                    <span class="page-title " style="font-weight: bold;font-size: 2.5rem; float: right"><?=  $jobs_data->job_number;  ?>
                    </span>
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
                    <div class="col-md-3">
                        <table class="right-text">
                            <tbody>
                                <tr>
                                    <td align="right" width="45%">Job Type :</td>
                                </tr>
                                <tr>
                                    <td align="right">Job Tags:</td>
                                </tr>
                                <tr>
                                    <td align="right">Date :</td>
                                </tr>
                                <tr>
                                    <td align="right">Priority :</td>
                                </tr>
                                <tr>
                                    <td align="right">Status :</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="right-text float-end">
                            <tbody>
                                <tr>
                                    <td align="right" width="65%"><strong><?= $jobs_data->job_type;  ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><strong><?= $jobs_data->name;  ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" style="color: darkred;"><?=  $jobs_data->priority;  ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" style="font-weight: 600;" class="job-status">
                                        <?=  $jobs_data->status;  ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h6 class="title-border">FROM :</h6>
                        <b><?= $company_info->business_name; ?></b><br>
                        <span><?= $company_info->street; ?></span><br>
                        <span><?= $company_info->city.', '.$company_info->state.' '.$company_info->postal_code ; ?></span><br>
                        <span> Phone: <?= $company_info->business_phone ; ?></span>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <h6 class="title-border">TO :</h6>
                        <div class="row">
                            <div class="col-md-5">
                                <b><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></b><br>
                                <span><?= $jobs_data->mail_add; ?></span><br>
                                <span><?= $jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span>                                                
                                <span>Email: <?= $jobs_data->cust_email ; ?></span>
                                <a
                                    href="mailto:<?= $jobs_data->cust_email ; ?>"><span
                                        class="fa fa-envelope icon_preview"></span></a><br>
                                <span>Phone: </span>
                                <?php if ($jobs_data->phone_h!="" || $jobs_data->phone_h!=null): ?>
                                <?= $jobs_data->phone_h;  ?>
                                <span class="fa fa-phone icon_preview"></span>
                                <span class="fa fa-envelope-open-text icon_preview"></span>
                                <?php else : echo 'N/A';?>
                                <?php endif; ?>
                                <br>
                                <span>Mobile: </span>
                                <?php if ($jobs_data->phone_m!="" || $jobs_data->phone_m!=null): ?>
                                <!-- <?= $jobs_data->phone_h;  ?> -->
                                <?= $jobs_data->phone_m;  ?>
                                <span class="fa fa-phone icon_preview"></span>
                                <span class="fa fa-envelope-open-text icon_preview"></span>
                                <?php else : echo 'N/A';?>
                                <?php endif; ?>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 16px;">
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
                                    <td><?= $item->title; ?>
                                    </td>
                                    <td><?= $item->qty; ?>
                                    </td>
                                    <td>$<?= $item->price; ?>
                                    </td>
                                    <td>$<?= number_format((float)$total, 2, '.', ','); ?>
                                    </td>
                                </tr>
                                <?php
                                $subtotal = $subtotal + $total;
                                endforeach;
                                $GRAND_TOTAL = $subtotal + $jobs_data->tax_rate;
                            ?>
                            </tbody>
                        </table>
                        <hr>
                        <b>Sub Total:</b>
                        <span class="right-text">$<?= number_format((float)$subtotal, 2, '.', ','); ?></span>
                        <br>
                        <b>Tax Rate:</b>&nbsp;
                        <span class="right-text">$<?= number_format((float)$jobs_data->tax_rate, 2, '.', ','); ?></span>
                        <br>
                        <hr>

                        <?php if ($jobs_data->tax != null): ?>
                        <b>Tax </b>
                        <i class="right-text">$0.00</i>
                        <br>
                        <hr>
                        <?php endif; ?>

                        <?php if ($jobs_data->discount != null): ?>
                        <b>Discount </b>
                        <i class="right-text">$0.00</i>
                        <br>
                        <hr>
                        <?php endif; ?>

                        <b>Grand Total:</b>
                        <b class="right-text">$<?= number_format((float)$GRAND_TOTAL, 2, '.', ','); ?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>