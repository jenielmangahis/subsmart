<?php

?>

<style>
    .tbl-header {
        background-color:#6a4a86;
    }
    .tbl-sub-header {
        background-color:#6a4a86;
    }
</style>

<div class="container">
    <div class="main" style="background-color:#ffffff;">        
        
        <table style="width: 80% !important;">
            <tr class="tbl-header">
                <td colspan="2"><b style="font-size: 20px; color: white;">CUSTOMER</b></td>
            </tr>
            <tr>
                <td>
                    <b>Name</b><br />
                    <?= $jobs_data->first_name .' '. $jobs_data->last_name; ?>
                </td>
                <td>
                    <b>Address</b><br />
                    <?= $jobs_data->job_location; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Phone Number</b><br />
                    <?= $jobs_data->phone_m !="" || $jobs_data->phone_m !=null ? formatPhoneNumber($jobs_data->phone_m) : 'N/A'; ?>
                </td>
                <td>
                    <b>Email</b><br />
                    <?= $jobs_data->cust_email != "" ? $jobs_data->cust_email : "N/A"; ?>
                </td>
            </tr>
        </table><br />  

        <div class="clear"></div>

        <table style="width: 80% !important;">
            <tr class="tbl-header">
                <td colspan="3"><b style="font-size: 20px; color: white;">JOB INFORMATION</b></td>
            </tr>
            <tr>
                <td>
                    <b>JOB NUMBER</b><br />
                    <?= $jobs_data->job_number; ?><br />
                </td>
                <td>
                    <b>JOB TAGS</b><br />
                    <?= $jobs_data->tags != '' ? $jobs_data->tags : '---';  ?><br />
                </td>
                <td>
                    <b>JOB TYPE</b><br />
                    <?= $jobs_data->job_type != '' ? $jobs_data->job_type : '---';  ?><br />
                </td>
            </tr>
            <tr>
                <td>
                    <b>JOB LOCATION</b><br />
                    <?= $jobs_data->job_location != '' ? $jobs_data->job_location : '---'; ?><br />
                </td>
                <td>
                    <b>AMOUNT</b><br />
                    <?= number_format($job_total_amount,2,'.',','); ?><br />
                </td>
                <td>
                    <b>ASSIGNED USERS</b><br />
                    <?php 
                        $assigned_employees = array();
                        if( $jobs_data->employee2_id > 0 ){
                            $assigned_employees[] = $jobs_data->employee2_id;
                        }
                        if( $jobs_data->employee3_id > 0 ){
                            $assigned_employees[] = $jobs_data->employee3_id;
                        }
                        if( $jobs_data->employee4_id > 0 ){
                            $assigned_employees[] = $jobs_data->employee4_id;
                        }
                        if( $jobs_data->employee5_id > 0 ){
                            $assigned_employees[] = $jobs_data->employee5_id;
                        }
                        if( $jobs_data->employee6_id > 0 ){
                            $assigned_employees[] = $jobs_data->employee6_id;
                        }
                    ?>
                    <div class="techs">
                        <?php foreach($assigned_employees as $eid){ ?>
                            <?php echo userFullName($eid); ?><br />
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php if($jobs_data_items) { ?>
                <tr>
                    <td colspan="3">

                        <b style="margin-top: 15px; margin-bottom: 5px;">Job Item Listing: </b><hr />
                        <table style="width: 100% !important">
                            <tr class="">
                                <td><b>Item Name</b></td>
                                <td><b>Qty</b></td>
                                <td><b>Item Price</b></td>
                                <td><b>Item Type</b></td>
                                <td><b>Amount</b></td>
                            </tr>
                            <?php foreach($jobs_data_items as $jobs_data_item) { ?>
                            <tr>
                                <td><?php echo $jobs_data_item->title; ?></td>
                                <td><?php echo number_format($jobs_data_item->qty,2); ?></td>
                                <td><?php echo number_format($jobs_data_item->price,2); ?></td>
                                <td><?php echo $jobs_data_item->type; ?></td>
                                <td><?php echo number_format($jobs_data_item->total,2); ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
            <?php } ?>
        </table><br />  

        <div class="clear"></div>

    </div>
</div>