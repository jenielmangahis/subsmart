<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Estimate Print</title>
    <meta content="Admin Dashboard" name="description">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">     
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">     
</head>
<body>    
    <div class="doc-print">
        <div class="btn-print__cnt"><a class="btn-print" onclick="window.print();" href="#">Print</a></div>
        <div><h6 class="print-schedule-title">Estimates</h6></div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                <?php if (!empty($estimates)) { ?>
                    <table class="table table-hover table-to-list" data-id="work_orders">
                        <thead>
                        <tr>                                    
                            <th>Estimate Number</th>
                            <th>Job & Customer</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Is Email Seen</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($estimates)) : ?>
                                <?php
                                foreach ($estimates as $estimate) :
                                    switch($estimate->status):
                                        case "Draft":
                                            $badge = "";
                                            break;
                                        case "Submitted":
                                            $badge = "success";
                                            break;
                                        case "Accepted":
                                            $badge = "success";
                                            break;
                                        case "Invoiced":
                                            $badge = "primary";
                                            break;
                                        case "Lost":
                                            $badge = "secondary";
                                            break;
                                        case "Declined By Customer":
                                            $badge = "error";
                                            break;
                                    endswitch;
                                ?>
                                    <tr>
                                        <td class="fw-bold nsm-text-primary"><?php echo $estimate->estimate_number; ?></td>
                                        <td>
                                            <label class="d-block"><?php echo $estimate->job_name; ?></label>
                                            <?php echo get_customer_by_id($estimate->customer_id)->first_name . ' ' . get_customer_by_id($estimate->customer_id)->last_name ?>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($estimate->estimate_date)) ?></td>
                                        <td><?php echo $estimate->estimate_type; ?></td>
                                        <td><?= $estimate->status; ?></td>
                                        <td>
                                            <?php
                                            $total1 = ((float)$estimate->option1_total) + ((float)$estimate->option2_total);
                                            $total2 = ((float)$estimate->bundle1_total) + ((float)$estimate->bundle2_total);

                                            if ($estimate->estimate_type == 'Option') {
                                                echo '$ ' . number_format(floatval($total1),2);
                                            } elseif ($estimate->estimate_type == 'Bundle') {
                                                echo '$ ' . number_format(floatval($total2),2);
                                            } else {
                                                echo '$ ' . number_format(floatval($estimate->grand_total),2);
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if ($estimate->is_mail_open == 1){
                                                    echo 'Yes';
                                                }else{
                                                    echo 'No';
                                                }
                                            ?>                                                    
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>   
</body>

<style>
 
    .doc-print {
        margin-left: 3em;
        margin-right: 3em;
    }
    .btn-print__cnt {
    text-align: right;
    padding-top: 5px;
    padding-right: 10px;
}
.doc-print {
    margin-left: 1em;
    margin-right: 1em;
}
.btn-print__cnt {
    text-align: right; 
    padding-top: 5px;
    padding-right: 10px;      
}
@media print {
    .btn-print__cnt {
        display: none;
    }
}
.print-schedule-title {
    text-align: center;
    padding-top: 30px;
}
.print-schedule-title {
        display: block;
    }
@media print {
    .print-schedule-title {
        display: block;
    }
}
#myTabContent { margin-top: 42px; }
.fc-content { text-align: left; padding: 3px; }
</style>
</html>